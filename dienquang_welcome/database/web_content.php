<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/database/mysqlconnection.php');

class WebContent extends MySQL{
  
  private $conn = null;

  public function __construct() {
    try{
      $this->conn = $this->getConnection();
    }
    catch(Exception $e){
      echo('<p>Kết nối database thất bại</p>');
    }
  }

  public function load_content(){
    try{
      $result = mysqli_query($this->conn,"SELECT * FROM web_content;");
      return $result;
    }
    catch(Exception $e){
      return null;
    }
  }

  public function edit_content(){

  }

  public function save_content(){

  }
}