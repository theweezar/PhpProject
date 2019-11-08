<?php

class Route extends Controller{
  public function home(){
    echo "Welcome to Homepage";
  }

  public function login($username,$password){

  }

  public function users(){
    $users = $this->model("Users");
  }

  public function pagenotfound(){
    echo "Page not found";
  }
}