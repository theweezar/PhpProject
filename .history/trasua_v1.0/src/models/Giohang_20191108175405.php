<?php

class Giohang extends MySQL{
    private $conn;

    private $giohang = 'giohang';

    private $ctgh = 'ctgh';

    public function __construct(){
      $this->conn = $this->Connect();
    }

    public function themHang($mgh,$mh){
      mysqli_query($this->conn,"INSERT INTO ".$this->ctgh." (mghang,mh) VALUES('".$mgh."','".$mh."');");
      mysqli_commit($this->conn);
    }
}