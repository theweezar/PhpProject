<?php

class Hoadon extends MySQL{
  private $conn = null;

  public function __construct(){
    $this->conn = $this->Connect();
  }

  public function createNewbill($mgh,$thanhtien){
    $result = mysqli_query($this->conn,"SELECT * FROM ".$this->hoadon." ");
    $count = mysqli_num_rows($result) + 1;
    mysqli_query($this->conn,"INSERT INTO ".$this->hoadon." (mahd,mgh,thanhtien) VALUES('hd".$count."','".$mgh."',".$thanhtien.") ;");
    mysqli_commit($this->conn);
  }

  public function getPaidBill($username){
    $result = mysqli_query($this->conn,"SELECT * FROM ".$this->hoadon." JOIN ".$this->giohang." ON ".$this->giohang.".mgh = ".$this->hoadon.".mgh WHERE ".$this->giohang.".username = '".$username."' AND ".$this->giohang.".pay = 1 ORDER BY ".$this->hoadon.".created_at DESC");
    $data = array();
    for($i = 0; $i < mysqli_num_rows($result); $i++){
      array_push($data,mysqli_fetch_assoc($result));
    }
    return $data;
  }

  public function getPrice($mgh){
    $result = mysqli_query($this->conn,"SELECT thanhtien FROM ".$this->hoadon." WHERE mgh = '".$mgh."' ");
    return mysqli_fetch_assoc($result)["thanhtien"];
  }
}