<?php


namespace Controllers\Hal;

use Controllers\PurifierBase as PurifierBase;

class Status extends PurifierBase {
  function init(){
    $this->app->get('/haldor/test', [$this, 'test']);
    $this->app->post('/haldor/bootup', [$this, 'bootup']);
    $this->app->post('/haldor/checkup', [$this, 'checkup']);
  }
  
  function homepage($req, $res){
    return $this->render($res, 'main/homepage.php', 'Welcome', array(
      'layout_show_entrances' => true,
      'layout_no_footer' => true
    ));
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


$app->get('/hal/?', function() use ($app) {
  require_once 'hal_helpers.php';
  mark_old_switches();
  
  $latest = latest_changes();
  $app->render('hal/index.php', array('title' => 'HAL',
    'isOpen' => is_maglabs_open($latest),
    'isTechBad' => is_tech_bad($latest),
    'latestStatus' => $latest,
    'currentTime' => time()
    )
  );
});

$app->get('/hal/chart', function() use ($app) {
  require_once 'hal_helpers.php';
  
  $json = timeline_graph_json(time()-604800, time());
  $app->render('hal/chart.php', array('title' => 'HAL Charts',
    'graphJSON' => $json
    )
  );
});

$app->get('/hal/test', function() use ($app) {
  require_once 'hal_helpers.php';
  
  echo timeline_graph_json(time()-604800, time());
});
