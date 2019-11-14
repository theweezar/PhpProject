<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/main.css">
  <script src="js/jquery.min.js"></script>
  <title>Design page</title>
</head>
<body>
  <div class="wall2"></div>
  <nav>
    <ul>
      <li>
        <p>Chào, <b><?php echo $_SESSION['username'] ?></b> <i id="more-btn"></i> </p>
        <ul id='more-infor' class='none'>
          <li>
            <a href="/logout">Logout</a>
          </li>
          <li>Fullname: <?php echo $_SESSION['fname'] ?> </li>
          <li>Email: <?php echo $_SESSION["email"] ?> </li>
          <li>Phone: <?php echo $_SESSION["sdt"] ?></li>
        </ul>
      </li>
      <li><a href="/lichsu">Lịch sử giao dịch</a></li>
      <li>
        <a style="padding: 0;" href="/giohang">
          <img src="img/shopping-cart.png" style="width: 25px; height: 25px; transform: translateY(5px);" alt="" srcset="">
        </a>
      </li>
      <?php if(!$_SESSION['client']){
        echo '<li><a href="/themtrasua">Thêm món</a></li>';
        echo '<li><a href="/qlnd">Quản lý tài khoản</a></li>';
      } ?>
      <li><a href="/home">Menu</a></li>
    </ul>
  </nav>

  <?php 
    require_once "../src/views/".$view.".php";
  ?>

  <script src="js/script.js"></script>
</body>
</html>