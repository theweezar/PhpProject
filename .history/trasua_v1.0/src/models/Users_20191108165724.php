<?php

class Users extends MySQL{

  private $conn;

  private $tb_name = 'users';

  public function __construct(){
    $this->conn = $this->Connect();
  }

  public function CheckInput($input){
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
  }

  public function getAllUsers(){
    $result = mysqli_query($this->conn,"SELECT * FROM ".$this->tb_name."");
    $data = array();
    for ($i=0;$i<mysqli_num_rows($result);$i++){
      array_push($data,mysqli_fetch_assoc($result));
    }
    return $data;
  }

  public function validate($username,$password){
    $username = $this->CheckInput($username);
    // $password = hash("md5",$this->CheckInput($password),false);
    $result = mysqli_query($this->conn,"SELECT * FROM ".$this->tb_name." WHERE username= '".$username."' ;");
    if (mysqli_num_rows($result)==0) return false;
    else{
      $val = mysqli_fetch_assoc($result);
      if ($password == $val['password']) return ["logged"=>true,"infor"=>$val];
      else return ["logged"=>false];
    }
  }

  public function createUser($fullname,$username,$password,$sdt,$email,$client){
    mysqli_query($this->conn,"INSERT INTO ".$this->tb_name." (username,password,client,fname,sdt,email) VALUES(".$username.",'".$password."',".$client.",'".$fname."','".$sdt."','".$email."') ;");
    mysqli_commit($this->conn);
  }
}