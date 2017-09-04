<?php

namespace Controllers;
use HTMLPurifier_Config;
use HTMLPurifier;
use Controllers\Base as Base;

class PurifierBase extends Base {

  public function getPurifier(){
    if($this->purifier){ return $this->purifier; }
    $config = HTMLPurifier_Config::createDefault();
    $config->set('Cache.SerializerPath', '/tmp');
    $config->set('AutoFormat.Linkify', true);
    $this->purifier = new HTMLPurifier($config);
    return $this->purifier;
  }

  public function purify($dirty_html){
    return $this->getPurifier()->purify($dirty_html);
  }


  function getRenderer(){
    if(!$this->phpRenderer){ $this->phpRenderer = new \Slim\Views\PhpRenderer(__DIR__ . "/../views/"); }
    $this->phpRenderer->addAttribute('purifier', $this->getPurifier());
    return $this->phpRenderer;
  }

}
