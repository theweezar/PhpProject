<?php

class MySQL{
  private $db_host;
  private $db_username;
  private $db_password;
  private $db_name;
  
  protected function getConnection(){
    $this->db_host = "localhost";
    $this->db_username = "root";
    $this->db_password = "";
    $this->db_name = "forum";
    return mysqli_connect($this->db_host,$this->db_username,$this->db_password,$this->db_name);
  }
}