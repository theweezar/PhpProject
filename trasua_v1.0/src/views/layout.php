<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="js/jquery.min.js"></script>
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <link rel="stylesheet" href="css/simple.css">
  <title>Document</title>
</head>
<body>

<div class="header">
  <nav>
    <ul>
      <li><a href="/giohang">Gio hang</a></li>
      <li><a href="/logout">Dang xuat</a></li>
      <?php if(!$_SESSION['client']) echo '<li><a href="/themtrasua">Them tra sua</a></li>'; ?>
    </ul>
  </nav>
  <div class="infor-board"></div>
</div>

<?php 
  require_once "../src/views/".$view.".php";
?>

</body>
</html>