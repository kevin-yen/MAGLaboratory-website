<?php

if(!chdir(PROJECT_ROOT)){
  puts("Can not cd into project root at " . PROJECT_ROOT);
  exit(1);
}

$check_clean = `git status`;

function puts($msg){ echo "$msg\n"; }

if(strpos($check_clean, 'On branch master') === false){
  puts("Go to master to deploy.");
  exit();
}

if(!in_array('dirty_ok', $argv) and (strpos($check_clean, 'nothing to commit') === false or strpos($check_clean, 'working tree clean') === false)){
  puts("Refusing to deploy. Current HEAD is dirty. Commit changes to master to deploy.");
  exit();
}

$last_deploy = explode("\n", file_get_contents(DEPLOY_DIRECTORY . '/deploy.sftp'));

$commit = array();
preg_match('/Commit: ([0-9a-f]+) ([0-9a-f]+)/', $last_deploy[0], $commit);

$last_deploy_msg = "Last deploy is {$commit[1]} -> {$commit[2]}\n\n";


$changed_files = explode("\n", trim(`git diff {$commit[2]} HEAD --name-only -- home`));

# This strips out the home/ part in the filename
array_walk($changed_files, function(&$i){
  $i = substr($i, 5);
});

#$changed_files = array_filter($changed_files, function($i){
#  return !((strpos($i, 'src') !== false and strpos($i, 'src') < 1) or (strpos($i, 'deploy') !== false and strpos($i, 'test') < 1) or (strpos($i, 'test') !== false and strpos($i, 'test') < 1) or (strpos($i, 'private') !== false and strpos($i, 'private') < 1));
#});

$changed_files = array_diff($changed_files, ['', ".gitignore"]);

$changed_files_msg = count($changed_files) . " files changed.";
puts($changed_files_msg);

$added_files = explode("\n", trim(`git diff {$commit[2]} HEAD --name-status -- home | grep ^A`));

array_walk($added_files, function(&$i){
  $x = explode("\t", $i);
  if(count($x)==2){
    $i = substr($x[1], 5);
  }
});

if(isset($deploy_marker)){
  array_push($added_files, "{$deploy_marker['remote_target']}");
}

if(!chdir('home')){
  echo "Can not chdir into project home " . PROJECT_ROOT . '/home';
  exit(2);
}

$current_head = chop(`git rev-parse HEAD`);
$deploy_header_msg = "Commit: {$commit[2]} {$current_head}";
$deploy_headers = ["!echo \"{$deploy_header_msg}\""];
$deploy = [];
$create_dirs = [];
$skip_dirs = array();

array_walk($changed_files, function($changed_file) {
  global $added_files;
  global $deploy;
  $i = array_search($changed_file, $added_files);
  if($i !== false){
    $path = explode("/", $changed_file);
    array_pop($path);
    array_walk($path, function($p, $i) use($path) {
      global $create_dirs;
      global $skip_dirs;
      $new_path_parts = array_merge(array_slice($path, 0, $i), [$p]);
      $new_path = implode("/", $new_path_parts);
      array_pop($new_path_parts);
      $parent_path = implode("/", $new_path_parts);
      
      # This is too inefficient, creates a new connection for each directory! ugh
      if(!isset($skip_dirs[$new_path])){
        if(array_search($parent_path, $create_dirs) !== false){
          # Parent directory does not exist, so all paths under will not either
          $check = 'CREATED_PARENT';
        } else {
          $check = shell_exec("ssh " . SSH_USERHOST . " \"ls -d '". DEPLOY_HOME ."{$new_path}' && echo DIR_EXISTS\"");
        }
        $skip_dirs[$new_path] = true;
        if(strpos($check, 'DIR_EXISTS') === false){
          array_push($create_dirs, $new_path);
        }
      }
    });
    unset($added_files[$i]);
  }

  if(file_exists($changed_file)){
    array_push($deploy, "put '{$changed_file}' '{$changed_file}'");
  } else {
    array_push($deploy, "rm '{$changed_file}'");
  }

});


if(isset($deploy_marker)){
  echo "Generating deploy marker from {$deploy_marker['template']}\n";
  $deploy_marker_contents = str_replace('$~COMMIT~', $commit[2], file_get_contents($deploy_marker['template']));
  $deployed_marker = $deploy_marker['template'] . '.deployed';
  file_put_contents($deployed_marker, $deploy_marker_contents);
  array_push($deploy, "put '{$deployed_marker}' '{$deploy_marker['remote_target']}'");
}


puts("Writing deploy.sftp");

$create_dirs = array_unique($create_dirs);
array_walk($create_dirs, function(&$i){
  $i = "mkdir {$i}";
});

$deploy_sftp = implode("\n", array_merge($deploy_headers, $create_dirs, $deploy));

file_put_contents(DEPLOY_DIRECTORY . '/deploy.sftp', $deploy_sftp);

puts("\nDeploying\n\n");

if(DEPLOY_TEST){
  echo "Deploy? Anything other than 'YES' will exit: ";
  $stdin = fopen('php://stdin', 'r');
  if(trim(fgets($stdin)) != 'YES'){ exit(10); }
  fclose($stdin);
}

$deploy_result = -1;
$deploy_output = system("sftp -b " . DEPLOY_DIRECTORY . "/deploy.sftp " . SSH_USERHOST . ":" . DEPLOY_HOME , $deploy_result);

if($deploy_output and $deploy_result == 0){
  echo "\nDeploy Succeeded.\n\n";
  passthru("git commit -am\"Deployment {$deploy_header_msg}\n\n{$last_deploy_msg}\n{$changed_files_msg}\"");
} else {
  echo "\n!!! Deploy Failed !!!\n";
  echo "Please inspect output for errors\n\n";
}
