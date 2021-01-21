<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/database/mysqlconnection.php');

class TestConnection extends MySQL{
  public function __construct() {
    try {
      $conn = $this->getConnection();
      if ($conn == null) throw new Exception();
      else echo "Kết nối thành công";
    } catch (\Throwable $th) {
      //throw $th;
      echo "Kết nối thất bại";
    }
  }
}

$test = new TestConnection();