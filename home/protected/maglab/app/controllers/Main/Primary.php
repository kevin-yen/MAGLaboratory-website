<?php

namespace Controllers\Main;

use Controllers\PurifierBase as PurifierBase;

class Primary extends PurifierBase {
  function init(){
    $this->app->get('/', [$this, 'homepage']);
  }
  
  function homepage($req, $res){
    return $this->render($res, 'main/homepage.php', 'Welcome', array(
      'layout_show_entrances' => true
    ));
  }
}
