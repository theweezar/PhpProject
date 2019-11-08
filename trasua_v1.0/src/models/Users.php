<?php

class Users extends MySQL{

  private $conn;

  private $tb_name = 'users';

  public function __construct(){
    $this->conn = $this->Connect();
  }
}