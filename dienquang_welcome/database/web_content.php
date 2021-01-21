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

  public function insert_content($name, $content, $type){
    try {
      mysqli_query($this->conn,"INSERT INTO web_content (name, content, type) 
      VALUES('".$name."','".$content."',".$type.")");
      mysqli_commit($this->conn);
    } catch (Exception $e) {
      echo('Lỗi database ở insert_content()');
    }
  }

  public function insert_thumbnail($embed_id, $thumbnail){
    try {
      mysqli_query($this->conn,"INSERT INTO thumbnail (thumbnail_link, embed_id) 
      VALUES('".$thumbnail."',".$embed_id.")");
      mysqli_commit($this->conn);
    } catch (Exception $e) {
      echo('Lỗi database ở insert_thumbnail()');
    }
  }

  public function delete_content($id){
    try {
      mysqli_query($this->conn,"DELETE FROM web_content WHERE id=".$id."");
      mysqli_commit($this->conn);
    } catch (Exception $e) {
      echo('Lỗi database ở delete_content()');
    }
  }

  public function delete_thumbnail($embed_id){
    try {
      mysqli_query($this->conn,"DELETE FROM thumbnail WHERE embed_id=".$embed_id."");
      mysqli_commit($this->conn);
    } catch (Exception $e) {
      echo('Lỗi database ở delete_thumbnail()');
    }
  }

  public function get_newest_embed_content(){
    try{
      $result = mysqli_query($this->conn,"SELECT * FROM web_content WHERE type = 3 ORDER BY id DESC LIMIT 1");
      return $result;
    }
    catch(Exception $e){
      echo('Lỗi ở get_newest_embed_content()');
      return null;
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
      mysqli_query($this->conn,"UPDATE web_content SET content='".$data."'
      ,type=".$type." WHERE id=".$id." ");
      mysqli_commit($this->conn);
    }
    catch(Exception $e){
      return false;
    }
    return true;
  }

  public function change_name($id, $name){
    try{
      mysqli_query($this->conn,"UPDATE web_content SET name='".$name."' WHERE id=".$id." ");
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

  public function load_content_with_name($name){
    try{
      $result = mysqli_query($this->conn,"SELECT * FROM web_content WHERE name='".$name."';");
      return $result;
    }
    catch(Exception $e){
      return null;
    }
  }

  public function load_content_with_type($type){
    try{
      $result = mysqli_query($this->conn,"SELECT * FROM web_content WHERE type=".$type.";");
      return $result;
    }
    catch(Exception $e){
      return null;
    }
  }

  public function save_thumbnail($embed_id, $thumbnail){
    try{
      mysqli_query($this->conn,"UPDATE thumbnail SET thumbnail_link='".$thumbnail."' WHERE embed_id=".$embed_id." ");
      mysqli_commit($this->conn);
    }
    catch(Exception $e){
      return false;
    }
    return true;
  }

  public function load_all_thumbnail_order_embed_id(){
    try{
      $result = mysqli_query($this->conn,"SELECT * FROM thumbnail ORDER BY embed_id");
      return $result;
    }
    catch(Exception $e){
      return null;
    }
  }

  public function load_thumbnail($embed_id){
    try{
      $result = mysqli_query($this->conn,"SELECT * FROM thumbnail WHERE embed_id=".$embed_id.";");
      return $result;
    }
    catch(Exception $e){
      return null;
    }
  }

}