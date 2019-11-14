<?php

class MySQL{
  private $db_host;
  private $db_username;
  private $db_password;
  private $db_name;

  protected $users = 'users';

  protected $hanghoa = "trasua";

  protected $giohang = 'giohang';

  protected $ctgh = 'ctgh';

  protected $hoadon = "hoadon";
  
  protected function Connect(){
    $this->db_host = "localhost";
    $this->db_username = "root";
    $this->db_password = "";
    $this->db_name = "test";
    return mysqli_connect($this->db_host,$this->db_username,$this->db_password,$this->db_name);
  }
}