<?php

class Hanghoa extends MySQL{
  private $conn;

  public function __construct(){
    $this->conn = $this->Connect();
  }

  public function getAll(){
    $result = mysqli_query($this->conn,"SELECT * FROM ".$this->hanghoa." ");
    $data = array();
    for ($i=0;$i<mysqli_num_rows($result);$i++){
      array_push($data,mysqli_fetch_assoc($result));
    }
    return $data;
  }

  public function getAllStillSell(){
    $result = mysqli_query($this->conn,"SELECT * FROM ".$this->hanghoa." WHERE con = 1 ");
    $data = array();
    for ($i=0;$i<mysqli_num_rows($result);$i++){
      array_push($data,mysqli_fetch_assoc($result));
    }
    return $data;
  }

  public function getwithcode($mh){
    $result = mysqli_query($this->conn,"SELECT * FROM ".$this->hanghoa." WHERE mh = '".$mh."' ");
    if (mysqli_num_rows($result) != 0) return mysqli_fetch_assoc($result);
    else return null;
  }

  public function add($tenhang,$gia,$hinh){
    $result = mysqli_query($this->conn,"SELECT * FROM ".$this->hanghoa."");
    $count = mysqli_num_rows($result) + 1;
    mysqli_query($this->conn,"INSERT INTO ".$this->hanghoa." (mh,tenh,gia,con,hinh) VALUES('ts".$count."','".$tenhang."',".$gia.",1,'".$hinh."'); ");
    mysqli_commit($this->conn);
  }

  public function isExist($mh){
    
  }

  public function stopSelling($mh){
    mysqli_query($this->conn,"UPDATE ".$this->hanghoa." SET con = 0 WHERE mh = '".$mh."' ");
    mysqli_commit($this->conn);
  }

  public function startSelling($mh){
    mysqli_query($this->conn,"UPDATE ".$this->hanghoa." SET con = 1 WHERE mh = '".$mh."' ");
    mysqli_commit($this->conn);
  }
}