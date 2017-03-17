<?php

namespace Controllers\Hal;

class Halley {
  public function __construct($app = null){
    $this->app = $app;
    $this->init();
  }

  function init(){
    $this->app->get('/', [$this, 'homepage']);
    $this->app->get('/donate/class_deposit', [$this, 'class_deposit']);
    $this->app->get('/donate', [$this, 'donate']);
    $this->app->get('/subscribe', [$this, 'subscribe']);
    $this->app->get('/membership', [$this, 'membership']);
    $this->app->get('/membership/pay4keyed', [$this, 'pay4keyed']);
    
  }
  
  function homepage($req, $res){
    return $this->render($res, 'main/homepage.php', 'Welcome', array(
      'layout_show_entrances' => true,
      'layout_no_footer' => true
    ));
  }
  
  function donate($req, $res){
    return $this->render($res, 'main/donate.php', 'Donate');
  }
  
  function subscribe($req, $res){
    return $this->redirect($res, 'http://eepurl.com/bJC_aX');
  }
  
  function membership($req, $res){
    $this->render($res, 'main/membership.php', 'Membership Information', array(
      'skip_membership_link' => true
    ));
  }
  
  function class_deposit($req, $res){
    $this->render($res, 'main/class_deposit.php', 'Class Deposit', array(
      'deposit_class' => 'Raspberry Pi'
    ));
  }
  
  function pay4keyed($req, $res){
    $this->render($res, 'main/pay4keyed.php', 'Pay for Keyed Membership');
  }
}



$app->post('/halley/bootup', function() use ($app) {
  authenticate($app);
  $session = generate_session();
  save_payload($app);
  echo $session;
});

$app->post('/halley/output', function() use ($app) {
  authenticate($app);
  save_payload($app);
  parse_halley_output($app);
  echo 'OK';
});

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
