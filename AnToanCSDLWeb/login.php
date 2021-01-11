<?php 
  include_once($_SERVER['DOCUMENT_ROOT'].'./index.php');
?>

<!-- Phần frontend của Đại -->
<div class="col-lg-5 col-sm-7 text-white position-absolute top-center h-50" >
  <div class="pt-5">
      <div>
        <h1 class="cus_h1_form">SIGN IN</h1>
      </div>
      <form action="./login.php" id="log_form" class="form-group container text-center py-3" >
        <div class="cus_input_control text-center">
            <!-- <h5 for="username">Username</h5> -->
            <input type="text" name ="username" placeholder="Username" class="text-white sim_input" pattern="[a-zA-Z0-9]+" required>
        </div>
        <div class="cus_input_control text-center">
        <!-- <h5 for="username">Password</h5> -->
          <input type="password" name="password" placeholder="Password" class="text-white sim_input" pattern="[^\s]{8,}" required>
        </div>
        <div class="error text-danger p-0 m-0 d-none" id="error">Wrong Password</div>
        <div id="result" class="text-success p-0 m-0 d-none">Success </div>
        <button class="cus_but_form" type="submit">SIGN IN</button>  
      </form>
  <div class="text-center p-0 m-0"> I don't have account . I want to <a href="register.php">Sign up</a></div>
</div>
<div class="small p-0 m-0 text-center">All designed by Nhom2</div> 
</div>
<!-- Kết thúc phần frontend của Đại -->

<!-- Phần frontend -->
<!-- <form class="w-25" action="/login" method="post">
  <div class="input-group input-group-sm mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroup-sizing-sm">Username</span>
    </div>
    <input name="username" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
  </div>
  <div class="input-group input-group-sm mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroup-sizing-sm">Password</span>
    </div>
    <input name="password" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
  </div>
  <input type="submit" value="Login" name="submit">
</form> -->
<!-- Kết thúc phần frontend -->

<!-- Phần xử lý -->
<?php
  if (isset($_POST["submit"])){
    $userTb = new User();
    if ($protection){

    }
    else{
      if ($userTb->login($_POST["username"], $_POST["password"])){
        echo "Đăng nhập thành công";
      }
      else echo "Đăng nhập thất bại. Sai tên tài khoản hoặc mật khẩu";
    }
  }
?>


<!-- Kết thúc phần xử lý -->

<?php
  include_once($_SERVER['DOCUMENT_ROOT'].'./footer.php');
?>