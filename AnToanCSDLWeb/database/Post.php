<?php

class Post extends MySQL{

  private $conn;
  public function __construct() {
    $this->conn = $this->getConnection();
  }

  public function create_post(){
    
  }
}