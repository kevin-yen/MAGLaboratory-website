<?php

namespace Controllers;

class Base {
  protected $app;

  public function __construct($app = null){
    $this->app = $app;
    $this->init();
    $this->current_user = null;
    $this->respond = array();
    $this->purifier = null;
    $this->phpRenderer = null;
  }

  function init(){}

  public function render($res, $template, $title, $data = []){
    if(!$this->phpRenderer){ $this->phpRenderer = new \Slim\Views\PhpRenderer(__DIR__ . "/../views/"); }
    return $this->phpRenderer->render($res, $template,
      array_merge(
        array('title' => $title),
        $this->respond,
        $data
      )
    );
  }
  
  public function partial($template, $data = []){
    if(!$this->phpRenderer){ $this->phpRenderer = new \Slim\Views\PhpRenderer(__DIR__ . "/../views/"); }
    return $this->phpRenderer->fetch($template, array_merge($this->respond, $data));
  }
  
  public function capture($closure){
    ob_start();
    $closure();
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
  }
  
  public function redirect($res, $target, $code = 302){
    $res = $res->withStatus($code);
    $res = $res->withHeader('Location', $target);
    
    return $res;
  }
  
  public function email_html($to, $subject, $html){
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $headers .= 'From: MAGLaboratory.org <website@maglaboratory.org>' . "\r\n";
    $headers .= 'Reply-To: website@maglaboratory.org' . "\r\n";
    mail($to, $subject, $html, $headers);
  }

  public function hash_password($plaintext){
    return password_hash($plaintext, PASSWORD_BCRYPT);
  }
  
  function params($req){
    return $req->getParsedBody();
  }


}
