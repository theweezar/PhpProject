
<!-- Phần frontend -->
<form class="w-25" action="/register" method="post">
  <div class="input-group input-group-sm mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroup-sizing-sm">Email</span>
    </div>
    <input name="email" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
  </div>
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
  <div class="input-group input-group-sm mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroup-sizing-sm">Một vài điều về bạn (nếu có)</span>
    </div>
    <input name="about" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
  </div>
  <input type="submit" value="Submit" name="submit">
</form>
<!-- Kết thúc phần frontend -->

<!-- Phần xử lý -->
<?php
  if (isset($_POST["submit"])){
    $userTb = new User();
    $exist = $userTb->exist($_POST["email"], $_POST["username"]);
    if (isset($exist["usernameE"])){
      // Báo lỗi
      echo "<script>alert('Username trùng')</script>";
    }
    else if (isset($exist["emailE"])){
      // Báo lỗi
      echo "<script>alert('Email')</script>";
    }
    else $userTb->register($_POST["email"], $_POST["username"], $_POST["password"], $_POST["about"]);
  }

?>
<!-- Kết thúc phần xử lý -->