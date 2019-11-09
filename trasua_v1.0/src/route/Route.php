<?php

class Route extends Controller{

  
  public function home(){
    if (isset($_SESSION['logged'])){
      $hanghoa = $this->model("Hanghoa");
      $trasua = $hanghoa->getAll();
      $this->view("home",true,["trasua"=>$trasua]);
    }
    else $this->view("login",false);
  }

  public function login(){
    if (isset($_POST['username']) && isset($_POST['password'])){
      $users = $this->model("Users");
      $curr_user = $users->validate($_POST['username'],$_POST['password']);
      if ($curr_user['logged']){
        $_SESSION['logged'] = true;
        $_SESSION['username'] = $curr_user['infor']['username'];
        $_SESSION['client'] = $curr_user['infor']['client'];
        header("Location: /home");
      }
      else $this->view("login",false,["error"=>"Wrong password or username"]);
    }
    else header("Location: home");
  }

  public function logout(){
    if (isset($_SESSION['logged'])) session_destroy();
    header("Location: home");
  }

  public function users(){
    $users = $this->model("Users");
    $allusers = $users->getAllUsers();
    print_r($allusers);
  }

  public function register(){
    if (!isset($_SESSION['logged'])){
      if (isset($_POST['fullname']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['sdt']) && isset($_POST['email'])){
        $users = $this->model("Users");
        $fname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sdt = $_POST['sdt'];
        $email = $_POST['email'];
        $users->createUser($fname,$username,$password,$sdt,$email,true);
        // header("Location: home");
        echo "succesfully";
      }
      else $this->view("register",false);
    }
    else header("Location: home");
  }

  public function add($mh=''){
    $giohang = $this->model("Giohang");
    $giohang->themHang("mgh1",$mh);
  }

  public function giohang(){
    $giohang = $this->model("Giohang");
    $cur_mgh = $giohang->getgiohangwithusername($_SESSION['username']);
    $cur_giohang = array();
    if ($cur_mgh != ""){
      $cur_giohang = $giohang->getCTGHwithMGH($cur_mgh);
    }
    $this->view("giohang",true,["giohang"=>$cur_giohang]);
  }

  public function pagenotfound(){
    echo "Page not found";
  }
}