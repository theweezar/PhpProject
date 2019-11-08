<?php

class Route extends Controller{

  

  public function home(){
    if (isset($_SESSION['logged'])) $this->view("home");
    else $this->view("login");
  }

  public function login(){
    if (isset($_POST['username']) && isset($_POST['password'])){
      $users = $this->model("Users");
      if ($users->validate($_POST['username'],$_POST['password'])){
        $_SESSION['logged'] = true;
        header("Location: /home");
      }
      else $this->view("login",["error"=>"dit me may"]);
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

  }

  

  public function pagenotfound(){
    echo "Page not found";
  }
}