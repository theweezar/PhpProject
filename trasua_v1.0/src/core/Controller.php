<?php
class Controller{

  protected $defaultLayout = "layout";

  
  // public function static_folder($filename){
  //   $type = explode(".",$filename)[1];
    
  // }
  protected $static = 0;
  public function setStatic($n = 0){
    $this->static = $n;
  }

  public function static_folder($dirname='',$filename=''){
    for($i = 0; $i < $this->static; $i++){
      
    }
  }

  public function model($model){
    require_once '../src/models/MySQL.php';
    require_once '../src/models/'.$model.'.php';
    return new $model();
  }

  public function view($view,$layout = true,$data=[]){
    if ($layout) require_once '../src/views/'.$this->defaultLayout.'.php';
    else require_once '../src/views/'.$view.'.php';
  }
}