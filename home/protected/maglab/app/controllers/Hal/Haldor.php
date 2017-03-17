<?php

namespace Controllers\Hal;

class Haldor {
  public function __construct($app = null){
    $this->app = $app;
    $this->init();
  }

  function init(){
    $this->app->get('/haldor/test', [$this, 'test']);
    $this->app->post('/haldor/bootup', [$this, 'bootup']);
    $this->app->post('/haldor/checkup', [$this, 'checkup']);
  }
  
  function test($req, $res){
    var_dump('test ok');
  }
  
  function bootup($req, $res){
    authenticate($req);
    $session = generate_session();
    set_boot_switch($req, $session);
    echo $session;
  }
  
  function checkup($req, $res){
    authenticate($req);
    save_payload($req);
    save_switches($req);
    echo 'OK';
  }
}

