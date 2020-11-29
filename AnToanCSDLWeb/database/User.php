<?php

class User extends MySQL{

  private $conn;

  public function __construct() {
    $this->conn = $this->getConnection();
  }

  public function exist($email, $username){
    $status = ["usernameE" => null, "emailE" => null];
    $result = mysqli_query($this->conn,"SELECT * FROM users WHERE username = '".$username."' ;");
    if (mysqli_num_rows($result) != 0) {
      $status["usernameE"] = true;
      return true;
    }
    $result = mysqli_query($this->conn,"SELECT * FROM users WHERE email = '".$email."' ;");
    if (mysqli_num_rows($result) != 0) {
      $status["emailE"] = true;
      return false;
    }
    return true;
  }

  public function login($username, $password){
    $result = mysqli_query($this->conn,"SELECT * FROM users WHERE username = '".$username."' ;");
    if (mysqli_num_rows($result) == 0) return false;
    else{
      $val = mysqli_fetch_assoc($result);
      if (password_verify($password, $val["password"])) return true;
      else return false;
    }
  }

  public function register($email, $username, $password, $about){
    // Phương thức hash của php
    $hash_password = password_hash($password,PASSWORD_DEFAULT);
    mysqli_query($this->conn,"INSERT INTO users (username,password,email,about) VALUES('".$username."','".$hash_password."','".$email."','".$about."')");
    mysqli_commit($this->conn);
  }
}