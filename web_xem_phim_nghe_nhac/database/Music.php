<?php 
  include_once($_SERVER['DOCUMENT_ROOT'].'/database/Mysql.php');

class Music extends MySQL{

  private $conn = null;

  public function __construct() {
    $this->conn = $this->getConnection();
  }

  // Thêm các thuộc tính của music vào trong database
  public function insert($music_name, $author, $singer, $music_path){
    try {
      mysqli_query($this->conn,"INSERT INTO musics (file_name, author, singer, file_path) 
      VALUES('".$music_name."','".$author."','".$singer."','".$music_path."')");
      mysqli_commit($this->conn);
      $_SESSION['message'] = 'Insert into database music';
    } catch (Exception $e) {
      //throw $th;
      $_SESSION['message'] = 'Database error';
    }
  }

  // Lấy hết data của table music ra để load vô màn hình
  public function get_all(){
    try{
      $result = mysqli_query($this->conn,"SELECT * FROM musics");
      return $result;
    }
    catch(Exception $e){
      // echo('Lỗi ở get_newest_embed_content()');
      $_SESSION['message'] = 'Database error';
      return null;
    }
  }
}