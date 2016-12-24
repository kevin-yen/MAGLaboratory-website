<?php

namespace Helpers;

final class LessQL {
  public static function Instance(){
    static $inst = null;
    if ($inst === null) {
      $inst = new LessQL(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);
    }
    return $inst;
  }
  
  private function __construct($host, $user, $pass, $db){
    $this->pdo = new \PDO( 'mysql:host=' . $host . ';dbname=' . $db, $user, $pass );
    $this->db = new \LessQL\Database( $this->pdo );
  }
}
