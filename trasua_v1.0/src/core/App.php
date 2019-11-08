<?php
class App{
  protected $controller = 'home';

  protected $method = 'default';

  protected $params;

  public function __construct(){
    $url = $this->parseURL();
    print_r($url);
  }

  public function parseURL(){
    if(isset($_GET['url'])){
      return $url = explode('/',filter_var(rtrim($_GET['url']), FILTER_SANITIZE_URL));
    }
  }

  public function get($path='',$callback=''){
    
  }
}