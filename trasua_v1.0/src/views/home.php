<!DOCTYPE html>
<html lang="en">
  <head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <style>
    <?php 
      require_once "css/style.css";
    ?>
    </style>
  </head>
  <body>
  <?php 
    require_once "../src/views/layout.php";
  ?>

  <script>
    <?php 
      require_once "js/script.js";
    ?>
    document.getElementById("them").addEventListener("click",function(){
      <?php
        $data["giohang"]->themHang("mgh1","ts1");
      ?>
    });
    
  </script>
  </body>
</html>