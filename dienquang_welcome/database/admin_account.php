<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/database/mysqlconnection.php');

class AdminAccount extends MySQL{
  
  private $conn = null;

  public function __construct() {
    try{
      $this->conn = $this->getConnection();
    }
    catch(Exception $e){
      echo('<p>Kết nối database thất bại</p>');
    }
  }

  public function validate_input($input){
    return htmlspecialchars(stripslashes(trim($input)));
  }

  public function login($username, $password){
    try{
      $username = $this->validate_input($username);
      $password = $this->validate_input($password);
      // Tìm theo username trước
      $result = mysqli_query($this->conn,"SELECT * FROM user WHERE username = '".$username."' ;");
      // Nếu username ko tồn tại thì bye bye
      if (mysqli_num_rows($result) == 0) return false;
      else{
        // Nếu username tồn tại thì bắt đầu mã hóa password người dụng nhập vào để kiểm tra với password
        // dc lưu trong csdl. Nếu đúng thì đăng nhập thành công
        $val = mysqli_fetch_assoc($result);
        if (password_verify($password, $val["password"])) return true;
        else return false;
      }
    }
    catch(Exception $e){
      return false;
    }
  }

  public function setup(){
    $username = 'admin';
    $password = '12345';
    $hash_password = password_hash($password,PASSWORD_DEFAULT);
    try{
      mysqli_query($this->conn,"INSERT INTO user (username,password) VALUES('".$username."','".$hash_password."')");
      mysqli_commit($this->conn);
      echo('<p>Khởi tạo tài khoản admin thành công</p>');
    }
    catch(Exception $e){
      echo('<p>Khởi tạo tài khoản admin thất bại</p>');
    }
  }
};


