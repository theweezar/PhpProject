<!DOCTYPE html>
<html lang="en">
  <head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/stylelogin.css">
  </head>
  <body>
    
  
<form action="/login" method="post">
  <h1> ĐĂNG NHẬP </h1>
  <input placeholder="Username" type="text" name="username" id="">
  <input placeholder="Password" type="password" name="password" id="">
  <input type="submit" value="Login">
  <div class="error">
  <?php 
  if (isset($data["error"])) echo $data["error"];
  ?>
  </div>
  <div>Hoặc đăng kí thành viên <a href="/register">tại đây</a></div>
</form>

</body>