<?php

class MssqlConnection{

  // protected $host;
  protected $database = "MILKTEASHOP";
  protected $username = "sa";
  protected $password = "123";

  protected function getConnection(){
    try {
      //code...
      $conn = new PDO( "sqlsrv:server=(local) ; Database = $database", $username, $password);  
      $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
      $conn->setAttribute( PDO::SQLSRV_ATTR_QUERY_TIMEOUT, 1 );
      return $conn;
    } catch (Exception $e) {
      //throw $th;
      return null;
    }
  }

}