
<!-- Phần frontend -->
<form class="w-25" action="/login" method="post">
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
</form>
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