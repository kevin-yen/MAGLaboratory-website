# Proposal: stop committing `src/vendor`, install it with Composer

Status: implemented. This builds on the PHP 8.2 bump (`bump-docker-to-php8`). See "Findings during implementation" below for where the work differed from the plan.

## Background

`src/` is the **dev-only** HAML→PHP view compiler (`src/compile.php`, `src/check.php`, `src/auto.sh`). It writes into `home/protected/maglab/app/views/`, and that output *is* committed.

Deployment only ships `home/`: `deploy/nfsn_deploy.php` diffs `-- home`, and the README's rsync copies `home/*`. **`src/vendor` never reaches production, so removing it from git has no effect on what gets deployed.**

## Merits

- **Less noise.** Commit `b530cda` ("chore: composer install") changed 887 lines of generated `src/vendor/composer/*` code that nobody reviews.
- **No drift.** `vendor/` always matches `composer.lock`, so nobody can edit vendor files by hand without it being noticed.
- **Patches become visible.** The MtHaml PHP 8.2 fix (`54508ec`) is currently a one-line edit hidden inside vendor. As a `.patch` file, it is documented and re-applied on every install.
- **Simpler Dependabot PRs.** Updates for `/src` (for example, the parsedown bump in #21) would only touch `composer.json` and `composer.lock`.
- **Composer is already available.** The Docker image already includes Composer, and the README already documents `composer install` in `src/`.
- **Small, low-risk change.** It touches 453 files (3.4 MB) with no runtime impact.

## Issues to handle

1. **The MtHaml patch would be lost.** `protected $skip;` in `MtHaml/NodeVisitor/Midblock.php` exists only in vendor. MtHaml 1.8.0 is abandoned, so no upstream fix is coming. Without a patch mechanism, the PHP 8.2 deprecation notices come back.
2. **The bind mount hides a build-time install.** The dev workflow runs `docker run -v $(pwd):/website`, which mounts over `/website`. A `RUN composer install` in the Dockerfile would be invisible at run time. Vendor has to live in the host checkout (gitignored), created by `composer install` through the container.
3. **Network access is needed, and every package comes from a GitHub zipball.** coffeescript-php 1.3.1, parsedown 1.6.0 and MtHaml 1.8.0 are old or abandoned. If one of those repos disappeared, a fresh install would fail. All of them resolve today. The risk is acceptable because the compiler is dev-only and its output is committed.
4. **Fresh clones fail confusingly.** `require __DIR__ . "/vendor/autoload.php"` gives a fatal error until someone runs `composer install`.
5. **No platform pin.** `src/composer.json` has no `config.platform.php`, unlike `home/protected/maglab/composer.json` (8.2.20).
6. **Git history doesn't shrink.** Old commits keep the vendor files. At 3.4 MB that doesn't matter, and no history rewrite is proposed.

### Out of scope: `home/protected/maglab/vendor`

This vendor directory **is** deployed. NFSN deploys are a plain rsync/sftp of `home/` with no build step on the server. Removing it would need a "build, then deploy" step, which is a bigger change. It stays committed for now.

## Plan

1. **Add a patch mechanism** in `src/composer.json`:
   - `require-dev`: `"cweagans/composer-patches": "^1.7"`.
   - `config.allow-plugins`: `{"cweagans/composer-patches": true}`.
   - `config.platform.php`: `"8.2.20"`.
   - `extra.patches`: `{"mthaml/mthaml": {"Declare Midblock::$skip for PHP 8.2": "patches/mthaml-midblock-skip.patch"}}`.
2. **Create `src/patches/mthaml-midblock-skip.patch`** from `54508ec`, with paths relative to the package root (`lib/MtHaml/NodeVisitor/Midblock.php`). Also create `src/patches/mthaml-maglab-customizations.patch` (see Findings).
3. **Untrack vendor:** add `/src/vendor` to `.gitignore`, then `git rm -r --cached src/vendor`.
4. **Regenerate `src/composer.lock`** so it includes the plugin, and commit it.
5. **Add a guard to `src/compile.php` and `src/check.php`:** if `vendor/autoload.php` is missing, print "Run composer install in src/ first (see README)" and exit with status 1.
6. **Update the README:** make `composer install` an explicit first-time setup step, and note that `src/vendor` is gitignored.
7. **Dockerfile:** install `unzip`. The `php:*-apache` image has neither `unzip` nor the `zip` extension, so Composer can't extract packages and a fresh `composer install` fails. Do not add a build-time `composer install`, because the bind mount would hide it (issue 2).

## Findings during implementation

- **The vendored MtHaml had undocumented local edits.** Besides the Midblock fix, commits `b924cc8` ("add option to remove indentation") and `8cdc895` ("add render watcher for capture blocks") had edited four MtHaml files directly: `Environment.php`, `Node/Run.php`, `NodeVisitor/PhpRenderer.php` and `NodeVisitor/RendererAbstract.php`. Without them, stock MtHaml re-indents all 20 compiled views. They are now kept in `src/patches/mthaml-maglab-customizations.patch`. After both patches are applied, the installed MtHaml is identical to the copy that used to be committed.
- **`coffeescript/coffeescript` can no longer be installed.** Its GitHub repo (`alxlit/coffeescript-php`) has been deleted, so Packagist's download URL returns 404. None of the `.haml` views use the `:coffee` filter, so the dependency was removed and `compile.php` and `check.php` no longer register the filter.
- **`unzip` was missing from the image.** Composer needs it to extract packages, so it was added to the Dockerfile (step 7).
- **Vendor files were owned by root.** Running Composer through the container as root left `src/vendor` owned by root on the host. The README command now passes `-u $(id -u):$(id -g) -e COMPOSER_HOME=/tmp/composer`.
- **Not addressed:**
  - `src/check.php` was already broken before this change. It references `MtHaml\Filter\YieldingContent`, which doesn't exist in the repo.
  - `erusev/parsedown` 1.6.0 has two advisories (CVE-2018-1000162, CVE-2019-10905). Dependabot PR #21 covers that bump.

## Verification

1. `rm -rf src/vendor`, then `docker run -v $(pwd):/website --rm -w /website/src maglaboratory/website composer install`. The output should report that the patch was applied, and `Midblock.php` should contain `protected $skip;`.
2. `docker run -v $(pwd):/website --rm maglaboratory/website php -f src/compile.php 2>&1 | grep -c Deprecated` should print `0`.
3. `git status home/protected/maglab/app/views` should show no changes, meaning the compiled output is identical.
4. `src/vendor` should not show up in `git status`.
5. With `src/vendor` moved aside, `compile.php` should print the guard message instead of a fatal error.
