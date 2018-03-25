<?php

require_once __DIR__ . "/haml_compile/YieldContent.php";
require_once __DIR__ . "/haml_compile/LayoutEnvironment.php";

function save($content, $target){
  $paths = explode('/', $target);
  array_pop($paths);
  $target_path = TARGET . '';
  while($dirname = array_shift($paths)){
    $target_path .= '/' . $dirname;
    if(!is_dir($target_path)){
      mkdir($target_path);
    }
  }
  if($fh = fopen(TARGET . '/' . $target, 'w')){
    fwrite($fh, $content);
    echo "$target\n";
    return fclose($fh);
  }
}


function saveDirectory($globular = null){
  global $haml;
  $globling = $globular;
  if(!$globling){ $globling = '*/*'; }
  foreach(glob($globling) as $filename){
    if(is_dir($filename)){ saveDirectory($filename . '/*'); continue; }
    
    $fpath = explode('.', $filename);
    
    if(array_pop($fpath) == 'haml'){
      if($fpath[count($fpath)-1] == 'layout'){ continue; } // skip layout files
      $content = $haml->compileFileWithLayout($filename);
      save($content, implode($fpath, '.'));
    } else {
      save(file_get_contents($filename), $filename);
    }
  }
}

function outputFile($filename){
  global $haml;

  $fpath = explode('.', $filename);

  if(array_pop($fpath) == 'haml'){
    if($fpath[count($fpath)-1] == 'layout'){ continue; }
    $content = $haml->compileFileWithLayout($filename);
    echo $content;
  } else {
    echo file_get_contents($filename);
  }
}
