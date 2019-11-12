<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="js/jquery.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/simple.css">
  <title>Document</title>
</head>
<body>

<header style="position: relative">
    <div class = "logo"> <img src="img/logo-6074.jpg" alt="logo" srcset="">
    </div>
    <nav >
      <ul>
        <!-- <li><a href="#">About Us</a></li> -->
        <li><a href="/home">
        <img src="img/fast-food.png" alt="">
            Thực đơn
        </a></li>
        <li><a href="/giohang">
        <img src="img/shopping-cart.png" alt="">
        <div id="index">3</div>
            Giỏ hàng
        <div id="cart">
            <h1>CHI TIẾT</h1>
            <div class="cartitem">
                <h2>Mã </h2>
                <p>Tên tà tưa</p>
                <p>giá * số lượng</p>
            </div>
            <div class="line"></div>
            <div class="cartitem">
                <h2>Mã </h2>
                <p>Tên tà tưa</p>
                <p>giá * số lượng</p>
            </div>
            <div class="line"></div>
            <div class="cartitem">
                <h2>Mã </h2>
                <p>Tên tà tưa</p>
                <p>giá * số lượng</p>
            </div>
            <div class="line"></div>
        </div>
        </a></li>
        <?php if(!$_SESSION['client']){
          echo '<li><a href="/themtrasua">Them tra sua</a></li>';
          echo '<li><a href="/qlnd">Quan ly nguoi dung</a></li>';
        } ?>
      </ul>
    </nav>
    <div class="account">Chào , <b> <?php echo $_SESSION['username'] ?> </b> 
    <div id="accountblock" >V </div>
    <div id = "more" class="unactive">
        <a class="out" href="/logout">
            <img src="img/logout.jfif" alt="">
        </a>
        <h3>Tên : <div> <?php echo $_SESSION['fname'] ?> </div></h3> 
        <h3>Số điện thoại : <div> <?php echo $_SESSION["sdt"] ?> </div></h3> 
        <h3>Email : <div><?php echo $_SESSION["email"] ?> </div></h3>  
    </div>
    </div>
</header>

<?php 
  require_once "../src/views/".$view.".php";
?>


<script src="js/script.js"></script>

</body>
</html>