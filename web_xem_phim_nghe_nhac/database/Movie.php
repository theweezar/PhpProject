<?php 
  include_once($_SERVER['DOCUMENT_ROOT'].'/database/Mysql.php');

class Movie extends MySQL{

  // biến kết nối
  private $conn = null;

  public function __construct() {
    // Khi khởi tạo, sẽ kết nối tới mysql
    $this->conn = $this->getConnection();
  }

  // Thêm các thuộc tính của movie vào trong database
  public function insert($movie_name, $movie_path){
    try {
      mysqli_query($this->conn,"INSERT INTO movies (movie_name,movie_path) VALUES('".$movie_name."','".$movie_path."')");
      mysqli_commit($this->conn);
      $_SESSION['message'] = 'Insert into database '.$movie_name.' and '.$movie_path;
    } catch (Exception $e) {
      //throw $th;
      $_SESSION['message'] = 'Database error';
    }
  }

  // Lấy hết data của table movie ra để load vô màn hình
  public function get_all(){
    try{
      $result = mysqli_query($this->conn,"SELECT * FROM movies");
      return $result;
    }
    catch(Exception $e){
      // echo('Lỗi ở get_newest_embed_content()');
      $_SESSION['message'] = 'Database error';
      return null;
    }
  }
}