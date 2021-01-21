<?php 

include_once($_SERVER['DOCUMENT_ROOT'].'/database/web_content.php');
// Vẫn còn lỗi update tùy lúc không được
$web_content = new WebContent();
$id = $_POST['id'];
$name = $_POST['name'];
$data = $_POST['data'];
$type = $_POST['type'];
$status = $_POST['status'];

$ok = null;

if ($status == 1) $ok = $web_content->save_content($id, $data, $type);
$web_content->change_name($id, $name);

if ($ok) echo "Lưu dữ liệu content ".$id." thành công";
else echo "Thay đổi tên content ".$id." thành công";


?>
