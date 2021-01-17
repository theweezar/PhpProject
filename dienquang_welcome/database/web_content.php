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

  public function save_content($id, $data, $type){
    try{
      mysqli_query($this->conn,"UPDATE web_content SET content='".$data."',type=".$type." WHERE id=".$id." ");
      mysqli_commit($this->conn);
    }
    catch(Exception $e){
      return false;
    }
    return true;
  }

  public function load_content_with_id($id){
    try{
      $result = mysqli_query($this->conn,"SELECT * FROM web_content WHERE id=".$id.";");
      return $result;
    }
    catch(Exception $e){
      return null;
    }
  }

}