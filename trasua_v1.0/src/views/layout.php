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

<!-- <div class="header">
  <nav>
    <ul>
      <li><a href="/giohang">Gio hang</a></li>
      <li><a href="/logout">Dang xuat</a></li>
      <?php 
      // if(!$_SESSION['client']) echo '<li><a href="/themtrasua">Them tra sua</a></li>'; 
      ?>
    </ul>
  </nav>
  <div class="infor-board"></div>
</div> -->

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
        <?php if(!$_SESSION['client']) echo '<li><a href="/themtrasua">Them tra sua</a></li>'; ?>
      </ul>
    </nav>
    <div class="account">Chào , <b> <?php echo $_SESSION['username'] ?> </b> 
    <div id="accountblock" >V </div>
    <div id = "more" class="unactive">
        <a class="out" href="/logout">
            <img src="img/logout.jfif" alt="">
        </a>
        <h3>Tên : <div> <?php echo $_SESSION['username'] ?> </div></h3> 
        <h3>Số điện thoại : <div> 0582213537 </div></h3> 
        <h3>Email : <div>daiphan308@gmail.com </div></h3> 
        <h3>Địa chỉ : <div> 235/45 D Bạch Đằng, P.15, Quận Bình Thạnh</div></h3> 
    </div>
    </div>
</header>

<?php 
  require_once "../src/views/".$view.".php";
?>


<script src="js/script.js"></script>

</body>
</html>