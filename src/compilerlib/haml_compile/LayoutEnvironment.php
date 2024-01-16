<?php

namespace MtHaml;

class LayoutEnvironment extends Environment {

    public function compileString($string, $filename, $yield_body = '')
    {
        $target = $this->getTarget();
        $this->options['yield'] = $yield_body;

        $node = $target->parse($this, $string, $filename);

        foreach ($this->getVisitors() as $visitor) {
            $node->accept($visitor);
        }

        $code = $target->compile($this, $node, $filename);

        return $code;
    }

    public function compileFileWithLayout($filename){
      $body = $this->compileString(file_get_contents($filename), $filename);

      $layout = null;
      $layout_paths = explode('/', $filename);
      if($layout_paths[count($layout_paths)-1][0] != '_'){
        while(array_pop($layout_paths) and count($layout_paths) > 0){
          array_push($layout_paths, array_pop($layout_paths) . '.layout.haml');
          $fileCheck = implode('/', $layout_paths);
          if(file_exists($fileCheck)){
            $layout = $fileCheck;
            break;
          }
        }
      }

      if($layout){
        return $this->compileString(file_get_contents($layout), $layout, $body);
      } else {
        return $body;
      }
    }

}
