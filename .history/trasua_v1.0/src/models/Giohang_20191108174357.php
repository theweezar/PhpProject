<?php

class Giohang extends MySQL{
    private $conn;

    private $tb_name = 'giohang';

    
  
    public function __construct(){
      $this->conn = $this->Connect();
    }
}