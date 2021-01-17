<?php 

include_once($_SERVER['DOCUMENT_ROOT'].'/database/web_content.php');
// Vẫn còn lỗi update tùy lúc không được
$web_content = new WebContent();
$id = $_POST['id'];
$data = $_POST['data'];
$type = $_POST['type'];

$ok = null;

if (!empty($data)) {
  $ok = $web_content->save_content($id, $data, $type);  
}

if ($ok) echo "Lưu dữ liệu content ".$id." thành công";
else echo "Lưu dữ liệu content ".$id." thất bại";


?>
