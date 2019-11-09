<?php

class Hanghoa extends MySQL{
  private $conn;

  private $hanghoa = "trasua";

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
}