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

  public function getwithcode($mh){
    $result = mysqli_query($this->conn,"SELECT * FROM ".$this->hanghoa." WHERE mh = '".$mh."' ");
    if (isset($result)) return mysqli_fetch_assoc($result);
    else return null;
  }

  public function add($tenhang,$gia,$hinh){
    $result = mysqli_query($this->conn,"SELECT * FROM ".$this->hanghoa."");
    $count = mysqli_num_rows($result) + 1;
    mysqli_query($this->conn,"INSERT INTO ".$this->hanghoa." (mh,tenh,gia,con,hinh) VALUES('ts".$count."','".$tenhang."',".$gia.",1,'".$hinh."'); ");
    mysqli_commit($this->conn);
  }
}