<?php

class Route extends Controller{

  

  public function home(){
    if (isset($_SESSION['logged'])) $this->view("home");
    else $this->view("login");
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
        // echo $_SESSION['client'];
      }
      else $this->view("login",["error"=>"Wrong password or username"]);
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
    if (isset($_POST['fullname']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['sdt']) && isset($_POST['email'])){
      $users = $this->model("Users");
      $fname = $_POST['fullname'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $sdt = $_POST['sdt'];
      $email = $_POST['email'];
      $users->createUser($fname,$username,$password,$sdt,$email,1);
      header("Location: home");
    }
    else $this->view("register",["error"=>"Thieu dieu kien"]);
  }

  

  public function pagenotfound(){
    echo "Page not found";
  }
}