<?php

// include($_SERVER['DOCUMENT_ROOT'].'/config.php');

// file cấu hình để kết nối tới mysql phpmyadmin
class MySQL{
  private $db_host;
  private $db_username;
  private $db_password;
  private $db_name;
  
  protected function getConnection(){
    $this->db_host = "localhost"; // 127.0.0.1 
    // tài khoản mặc định của mysql
    $this->db_username = "root";
    $this->db_password = "";
    // tên database
    $this->db_name = "web_movies_musics";
    // phương thức kết nối và trả về cái kết nối đó, nếu lỗi thì trả về null
    return mysqli_connect($this->db_host,$this->db_username,$this->db_password,$this->db_name);
  }
}