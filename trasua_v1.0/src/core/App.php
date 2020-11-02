<?php
class App{
  protected $controller;

  protected $method = 'home';

  protected $params;

  public function __construct(){
    // localhost
    $url = $this->parseURL(); // => []
    $notfound = false;
    require_once '../src/route/Route.php';
    $this->controller = new Route();
    if (isset($url[0])){
      if (method_exists($this->controller,$url[0])){
        $this->method = $url[0];
      }
      else {
        $this->method = "pagenotfound";
        $notfound = true;
      }
      unset($url[0]);
    }
    $this->params = $url ? array_values($url) : [];
    $this->controller->setStatic(sizeof($this->params));
    call_user_func_array([$this->controller,$this->method],$this->params);
    
  }

  public function parseURL(){
    if(isset($_GET['url'])){
      return $url = explode('/',filter_var(rtrim($_GET['url']), FILTER_SANITIZE_URL));
    }
  }
}