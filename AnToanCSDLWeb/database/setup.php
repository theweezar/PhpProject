<?php
include_once('mysqlconnection.php');

class Setup extends MySQL{

  private $conn;

  public function __construct() {
    $this->conn = $this->getConnection();
  }

  public function createUserTable(){
    $sql = "CREATE TABLE `forum`.`users` ( `id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(100) NOT NULL , `password` VARCHAR(1024) NOT NULL , `email` VARCHAR(100) NOT NULL , `about` TEXT NOT NULL , PRIMARY KEY (`id`), UNIQUE (`username`), UNIQUE (`email`)) ENGINE = InnoDB;";
    mysqli_query($this->conn,$sql);
    mysqli_commit($this->conn);
  }

  public function run(){
    $this->createUserTable();
  }
}

$setup = new Setup();
$setup->run();
