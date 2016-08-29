<?php

namespace Models;

class Base {

  public function __construct(){
    $this->db = Maria::Instance();
  }

}
