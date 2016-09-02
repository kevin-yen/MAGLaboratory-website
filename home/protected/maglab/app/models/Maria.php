<?php

namespace Models;
use mysqli;

# This is a singleton that provides access to mysqli and helpers
final class Maria {
  public static function Instance(){
    static $inst = null;
    if ($inst === null) {
      $inst = new Maria();
    }
    return $inst;
  }
  
  private function __construct(){
    $this->mysqli = null;
  }
  
  function connection(){
    if($this->mysqli){
      return $this->mysqli;
    } else {
      try {
        $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);
      } catch (Exception $e){
        $this->mysqli = false;
      }
      if(mysqli_connect_errno()){
        return false;
      }
      return $this->mysqli;
    }
  }
  
  function mysqli_or_die(){
    $mysqli = $this->get_mysqli();
    if($mysqli){ return $mysqli; }
    else { die('unable to connect to database'); }
  }
  
  function mysqli_prepare($query){
    $mysqli = $this->mysqli_or_die();
    $stmt = $mysqli->prepare($query);
    
    if($stmt){ return $stmt; } else { die("Can't prepare this query."); }
  }

  function mysqli_results($stmt, $kind = MYSQLI_ASSOC){
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all($kind);
  }
  
  function mysqli_result($stmt, $kind = MYSQLI_ASSOC){
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_array($kind);
  }

}
