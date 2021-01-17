<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/database/web_content.php');
// Vẫn còn lỗi update tùy lúc không được
$web_content = new WebContent();

$id = $_POST["id"];
$target_dir = realpath(dirname(getcwd()))."\\dashboard\\upload\\";
$target_file = $target_dir . basename($_FILES["image_to_upload"]["name"]);
$uploadOk = true;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
try {
  $check = getimagesize($_FILES["image_to_upload"]["tmp_name"]);
// Hàm getimagesize() sẽ trả về kết quả dưới này, ví dụ
// Array
// (
//     [0] => 1920
//     [1] => 1080
//     [2] => 2
//     [3] => width="1920" height="1080"
//     [bits] => 8
//     [channels] => 3
//     [mime] => image/jpeg
// )
  if (!$check) $uploadOk = false; 
} catch (Exception $th) {
  $uploadOk = false;
}

// echo $target_file;

if ($uploadOk){
  // Lấy content ảnh cũ ra và xóa
  $old_data = mysqli_fetch_assoc($web_content->load_content_with_id($id));
  $dirname = explode("/",$old_data['content'])[1];
  $filename = explode("/",$old_data['content'])[2];
  // Hàm xóa
  unlink("./".$dirname."/".$filename);
  // Lưu đường link
  $data = './upload/'.$_FILES["image_to_upload"]['name'];
  $web_content->save_content($id, $data, 2);
  // upload và đưa vào thư mục upload
  // tmp_name là cái file của host này đang chứa
  move_uploaded_file($_FILES["image_to_upload"]['tmp_name'], $target_file);
  echo "Lưu dữ liệu ảnh content ".$id." thành công";
}
else echo "Lưu dữ liệu ảnh content ".$id." thất bại";
