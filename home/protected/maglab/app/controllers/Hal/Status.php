<?php


namespace Controllers\Hal;

use Controllers\PurifierBase as PurifierBase;

class Status extends PurifierBase {
  function init(){
    $this->app->get('/hal', [$this, 'index']);
    $this->app->get('/hal/test', [$this, 'test']);
    $this->app->get('/hal/chart', [$this, 'chart']);
  }
  
  function index($req, $res){
    mark_old_switches();
    $latest = latest_changes();
    
    return $this->render($res, 'hal/index.php', 'HAL 2017 Status', array(
      'layout_show_entrances' => true,
      'layout_no_footer' => true,
      'isOpen' => is_maglabs_open($latest),
      'isTechBad' => is_tech_bad($latest),
      'latestStatus' => $latest,
      'currentTime' => time()
    ));
  }
  
  function chart($req, $res){
    $json = timeline_graph_json(time()-604800, time());
    $this->render('hal/chart.php', 'HAL Charts', array(
      'graphJSON' => $json
      )
    );
  }
  
  function test($req, $res){
    echo timeline_graph_json(time()-604800, time());
  }
}
