<?php

class Giohang extends MySQL{
    private $conn;

    private $giohang = 'giohang';

    private $ctgh = 'ctgh';

    public function __construct(){
      $this->conn = $this->Connect();
    }

    public function getAll(){
      // $result = mysqli_query("SELECT * FROM ".$this->giohang." ")
    }

    public function themHang($mgh,$mh){
      /**
       * đầu tiên kiểm tra xem loại hàng đó đã được order chứ
       * nếu chưa thì ta sẽ insert mới vào với số lượng là 1
       * nếu tồn tại rồi thì ta tìm đên món hàng đó và tăng lên 1 đơn vị
       */
      $result = mysqli_query($this->conn,"SELECT * FROM ".$this->ctgh." WHERE mgh = '".$mgh."' AND mh = '".$mh."' ;");
      if (mysqli_num_rows($result) == 0){
        mysqli_query($this->conn,"INSERT INTO ".$this->ctgh." (mgh,mh,soluong) VALUES('".$mgh."','".$mh."',1);");
        mysqli_commit($this->conn);
      }
      else{
        $data = mysqli_fetch_assoc($result);
        $soluong = $data["soluong"] + 1;
        mysqli_query($this->conn,"UPDATE ".$this->ctgh." SET soluong = ".$soluong." WHERE mgh = '".$mgh."' AND mh = '".$mh."' ;");
        mysqli_commit($this->conn);
      }
    }

    public function checkExist($username){
      $result = mysqli_query($this->conn,"SELECT * FROM ".$this->giohang." WHERE username = '".$username."' AND pay = 0 ");
      if (mysqli_num_rows($result) == 0) return false;
      else return true;
    }

    public function createnewgiohang($username){
      /**
       * vì giỏ hàng ko bao giờ xóa nên ta sẽ select tất cả từ giỏ hàng ra, sau đó đếm số lượng
       * tạo giỏ hàng mới với mgh + "soluong + 1"
       */
      $result = mysqli_query($this->conn,"SELECT * FROM ".$this->giohang." ");
      $count = mysqli_num_rows($result) + 1;
      mysqli_query($this->conn,"INSERT INTO ".$this->giohang." (mgh,username,pay) VALUES('mgh".$count."','".$username."',0); ");
      mysqli_commit($this->conn);
      return $count;
    }

    public function getgiohangwithusername($username){
      /**
       * Lấy mã giỏ hàng theo username
       */
      $result = mysqli_query($this->conn,"SELECT mgh FROM ".$this->giohang." WHERE username = '".$username."' AND pay = 0 ;");
      if (mysqli_num_rows($result) != 0) return mysqli_fetch_assoc($result)["mgh"];
      else return "";
    }

    public function getCTGHwithMGH($mgh){
      /**
       * lấy toàn bộ order theo mã giỏ hàng
       */
      $result = mysqli_query($this->conn,"SELECT * FROM ".$this->ctgh." WHERE mgh = '".$mgh."';");
      if (mysqli_num_rows($result) == 0) return array();
      else{
        $data = array();
        for ($i=0;$i<mysqli_num_rows($result);$i++){
          array_push($data,mysqli_fetch_assoc($result));
        }
        return $data;
      }
    }
}