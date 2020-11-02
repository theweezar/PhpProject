<?php
  // Phần kết nối mysql
  include_once($_SERVER['DOCUMENT_ROOT'].'/../database/initdatabase.php');
  // Phần set biến true/false khi bật tắt lớp bảo vệ
  $protection = false;
  // Phần lọc tách đường link url 
  function parseURL(){
    if(isset($_GET['url'])){
      return $url = explode('/',filter_var(rtrim($_GET['url']), FILTER_SANITIZE_URL));
    }
  }
  $url = parseURL();
  // Phần điều chỉnh tài nguyên động, set static for resource
  function setStatic($fileName, $url_t){
    if ($url_t != null){
      for($i = 0; $i < sizeof($url_t) - 1; $i++){
        $fileName = "../".$fileName;
      }
    }
    return $fileName;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forum</title>
  <link rel="stylesheet" href="<?php echo setStatic("css/bootstrap.css", $url); ?>">
</head>
<body>
  <?php
    print_r($url);
    if (isset($url) && file_exists($_SERVER['DOCUMENT_ROOT'].'/../'.$url[0].'.php')){
      include_once($_SERVER['DOCUMENT_ROOT'].'/../'.$url[0].'.php');
    }
    else if (!isset($url)){
      include_once($_SERVER['DOCUMENT_ROOT'].'/../newfeed.php');
    }
    else{
      include_once($_SERVER['DOCUMENT_ROOT'].'/../error.php');
    }
  ?>
</body>
</html>

