<?php
class Controller{

  protected $defaultLayout = "layout";

  public function model($model){
    require_once '../src/models/ConnectSQL.php';
    require_once '../src/models/'.$model.'.php';
    return new $model();
  }

  public function view($view,$layout = true,$data=[]){
    if ($layout) require_once '../src/views/'.$this->defaultLayout.'.php';
    else require_once '../src/views/'.$view.'.php';
  }
}