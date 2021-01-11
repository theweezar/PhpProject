<?php

class User extends MySQL{

  private $conn;

  public function __construct() {
    $this->conn = $this->getConnection();
  }

  public function exist($email, $username){
    // kiểm tra nếu email hay username có bị trùng hay không, nếu trùng thì không cho đăng ký
    $status = ["usernameE" => null, "emailE" => null];
    $result = mysqli_query($this->conn,"SELECT * FROM users WHERE username = '".$username."' ;");
    if (mysqli_num_rows($result) != 0) {
      $status["usernameE"] = true;
      // return true;
    }
    $result = mysqli_query($this->conn,"SELECT * FROM users WHERE email = '".$email."' ;");
    if (mysqli_num_rows($result) != 0) {
      $status["emailE"] = true;
      // return true;
    }
    return $status;
  }

  public function login($username, $password){
    // Tìm theo username trước
    $result = mysqli_query($this->conn,"SELECT * FROM users WHERE username = '".$username."' ;");
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

  public function check($str){
    return htmlspecialchars(stripslashes(trim($str)));
  }

  public function register($email, $username, $password, $repassword){
    $status = ["error" => true, "msg" => ""];
    $email = $this->check($email);
    $username = $this->check($username);
    $password = $this->check($password);
    $repassword = $this->check($repassword);
    if (strlen($email) == 0){
      $status["msg"] = "Không được để trống email";
    }
    else if (strlen($username) == 0){
      $status["msg"] = "Không được để trống username";
    }
    else if (strlen($password) == 0){
      $status["msg"] = "Không được để trống password";
    }
    else if (strlen($repassword) == 0){
      $status["msg"] = "Không được để trống phần Repassword";
    }
    else if (strcmp($password, $repassword) != 0){
      $status["msg"] = "Nhập password sai";
    }
    else {
      // Phương thức hash của php
      $hash_password = password_hash($password,PASSWORD_DEFAULT);
      // Mã hóa xong thì bắt đầu lưu vào csdl
      mysqli_query($this->conn,"INSERT INTO users (username,password,email) VALUES('".$username."','".$hash_password."','".$email."')");
      mysqli_commit($this->conn);
      // Gửi thông báo đăng kí thành công
      $status = ["error" => false, "msg" => "Đăng kí thành công"];
    }
    return $status;
  }
}