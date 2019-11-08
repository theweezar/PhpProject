<?php
class Controller{

  public function model($model){

  }

  public function view($view,$data=[]){
    require_once '../src/views/'.$view.'.php';
  }
}