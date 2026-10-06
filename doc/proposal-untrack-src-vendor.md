# Proposal: stop committing `src/vendor`, install it with Composer

Status: proposed. This builds on the PHP 8.2 bump (`bump-docker-to-php8`).

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
2. **Create `src/patches/mthaml-midblock-skip.patch`** from `54508ec`, with paths relative to the package root (`lib/MtHaml/NodeVisitor/Midblock.php`).
3. **Untrack vendor:** add `/src/vendor` to `.gitignore`, then `git rm -r --cached src/vendor`.
4. **Regenerate `src/composer.lock`** so it includes the plugin, and commit it.
5. **Add a guard to `src/compile.php` and `src/check.php`:** if `vendor/autoload.php` is missing, print "Run composer install in src/ first (see README)" and exit with status 1.
6. **Update the README:** make `composer install` an explicit first-time setup step, and note that `src/vendor` is gitignored.
7. **Dockerfile:** no change, because a build-time install would be hidden by the bind mount (issue 2).

## Verification

1. `rm -rf src/vendor`, then `docker run -v $(pwd):/website --rm -w /website/src maglaboratory/website composer install`. The output should report that the patch was applied, and `Midblock.php` should contain `protected $skip;`.
2. `docker run -v $(pwd):/website --rm maglaboratory/website php -f src/compile.php 2>&1 | grep -c Deprecated` should print `0`.
3. `git status home/protected/maglab/app/views` should show no changes, meaning the compiled output is identical.
4. `src/vendor` should not show up in `git status`.
5. With `src/vendor` moved aside, `compile.php` should print the guard message instead of a fatal error.
