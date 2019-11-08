<form action="/login" method="post">
  <input placeholder="Username" type="text" name="username" id="">
  <input placeholder="Password" type="password" name="password" id="">
  <input type="submit" value="Login">
</form>

<?php 
  if (isset($data["error"])) echo $data["error"];
?>