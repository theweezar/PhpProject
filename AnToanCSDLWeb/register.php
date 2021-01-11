<?php 
  include_once($_SERVER['DOCUMENT_ROOT'].'./index.php');
?>


<!-- Phần frontend của Đại -->
<div class="text-white">
  <a href="login.php" class="text-white"><i class="fa fa-arrow-left p-2 " aria-hidden="true"></i>Back to Login page</a>
  
</div>
<div class="col-lg-5 col-sm-7 col-md-8 text-white position-absolute top-center h-50" >
  <div class="pt-2">
    <div>
        <h1 class="cus_h1_form">SIGN UP</h1>         
    </div>
    <form id="rei_form" action="./register.php" method="POST" class="form-group container text-center py-3" >
      <div class="cus_input_control text-center">
          <!-- <h5 for="username">Username</h5> -->
          <input type="text" placeholder="Username" name="username" class="text-white sim_input" pattern="[a-zA-Z0-9]+" required>
      </div>
      <div class="cus_input_control text-center">
      <!-- <h5 for="username">Password</h5> -->
          <input type="password" placeholder="Password" name="password" class="text-white sim_input" pattern="[^\s]{8,}" required>
      </div>
      <div class="cus_input_control text-center">
      <!-- <h5 for="username">Password</h5> -->
          <input type="password" placeholder="Repassword" name="repassword" class="text-white sim_input" pattern="[^\s]{8,}" required>
      </div>
      <div class="cus_input_control text-center">
      <!-- <h5 for="username">Password</h5> -->
          <input type="text" placeholder="Email" name="email" class="text-white sim_input" pattern="[a-zA-Z0-9\W+]+" required>
      </div>
      <div class="error text-danger p-0 m-0 d-none" id="error">Wrong Password</div>
      <div id="result" class="text-success p-0 m-0 d-none">Success </div>
      <button id="sub" class="cus_but_form" type="submit">SIGN UP</button>  
        
    </form>
  <!-- <div class="text-center p-0 m-0"> I don't have account . I want to <a href="#">Sign up</a></div> -->
  </div>
  <div class="small p-0 m-0 text-center">All designed by Nhom2</div>          
</div>
<!-- Kết thúc frontend của Đại -->

<!-- Phần frontend -->
<!-- <form class="w-25" action="/register" method="post">
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
</form> -->
<!-- Kết thúc phần frontend -->

<!-- Phần xử lý -->
<?php
  if (isset($_POST["submit"])){
    $userTb = new User();
    $exist = $userTb->exist($_POST["email"], $_POST["username"]);
    if (isset($exist["emailE"])){
      // Báo lỗi
      echo "<script>alert('Email bị trùng');</script>";
    }
    else if (isset($exist["usernameE"])){
      // Báo lỗi
      echo "<script>alert('Username bị trùng');</script>";
    }
    else {
      $response = $userTb->register($_POST["email"], $_POST["username"], $_POST["password"], $_POST["repassword"]);
      if ($response["error"]){
        echo "<script>alert('".$response["msg"]."');</script>";
      }
      else {
        echo "<script>alert('".$response["msg"]."');</script>";
      }
    }
  }

?>
<!-- Kết thúc phần xử lý -->

<?php
  include_once($_SERVER['DOCUMENT_ROOT'].'./footer.php');
?>