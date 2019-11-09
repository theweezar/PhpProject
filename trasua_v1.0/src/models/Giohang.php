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
      mysqli_query($this->conn,"INSERT INTO ".$this->ctgh." (mgh,mh) VALUES('".$mgh."','".$mh."');");
      mysqli_commit($this->conn);
    }

    public function getgiohangwithusername($username){
      $result = mysqli_query($this->conn,"SELECT mgh FROM ".$this->giohang." WHERE username = '".$username."' AND pay = 0 ;");
      if (mysqli_num_rows($result) != 0) return mysqli_fetch_assoc($result)["mgh"];
      else return "";
    }

    public function getCTGHwithMGH($mgh){
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