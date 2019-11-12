<?php

class Hoadon extends MySQL{
  private $conn = null;

  private $tb_name = "hoadon";

  public function __construct(){
    $this->conn = $this->Connect();
  }

  public function createNewbill($mgh,$thanhtien){
    $result = mysqli_query($this->conn,"SELECT * FROM ".$this->tb_name." ");
    $count = mysqli_num_rows($result) + 1;
    mysqli_query($this->conn,"INSERT INTO ".$this->tb_name." (mahd,mgh,thanhtien) VALUES('hd".$count."','".$mgh."',".$thanhtien.") ;");
    mysqli_commit($this->conn);
  }

  
}