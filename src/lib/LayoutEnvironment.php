<?php

namespace MtHaml;

class LayoutEnvironment extends Environment {

    public function compileFileWithLayout($filename){
      $body = $this->compileString(file_get_contents($filename), $filename);

      $layout = null;
      $layout_paths = explode('/', $filename);
      while(array_pop($layout_paths) and count($layout_paths) > 0){
        array_push($layout_paths, array_pop($layout_paths) . '.layout.haml');
        $fileCheck = implode($layout_paths, '/');
        if(file_exists($fileCheck)){
          $layout = $fileCheck;
          break;
        }
      }

      if($layout){
        return $this->compileString(file_get_contents($layout), $layout, $body);
      } else {
        return $body;
      }
    }

}
