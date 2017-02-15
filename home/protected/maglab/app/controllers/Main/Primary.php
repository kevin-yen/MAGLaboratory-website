<?php

namespace Controllers\Main;

use Controllers\PurifierBase as PurifierBase;

class Primary extends PurifierBase {
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
