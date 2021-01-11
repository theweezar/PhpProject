<?php
  session_start();
  if ($_SERVER['PHP_SELF'] == "/index.php") header("Location: homepage.php");
  // Phần kết nối mysql
  include_once($_SERVER['DOCUMENT_ROOT'].'./database/initdatabase.php');
  // Phần set biến true/false khi bật tắt lớp bảo vệ
  $protection = false;
  // Phần điều chỉnh tài nguyên động, set static for resource
  function setStatic($fileName){
    return $fileName;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forum</title>
  <link rel="stylesheet" href="<?php echo setStatic("css/bootstrap.css"); ?>">
  <link rel="icon" href="<?php echo setStatic("img/Chatlogo.png"); ?>">
  <link rel="stylesheet" href="<?php echo setStatic("css/all.min.css"); ?>">
  <link rel="stylesheet" href="<?php 
    if ($_SERVER['PHP_SELF'] == "/login.php" || $_SERVER["PHP_SELF"] == "/register.php") echo setStatic("css/loginapp.css");
    else echo setStatic("css/homepage.css");
  ?>">
</head>
<body>
  <?php
    
  ?>
  

