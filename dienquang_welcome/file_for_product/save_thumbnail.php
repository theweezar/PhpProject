<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/database/web_content.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/dashboard/tools.php');

$web_content = new WebContent();

$rand_str = get_random_string(10);
$embed_id = $_POST["id"];
$target_dir = realpath(dirname(getcwd()))."/dashboard/upload/";
$target_file = $target_dir .$rand_str. basename($_FILES["image_to_upload"]["name"]);
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
  try {
    // Lấy content ảnh cũ ra và xóa
    $rs = $web_content->load_thumbnail($embed_id);
    if ($rs != null){
      $old_data = mysqli_fetch_assoc($rs);
      if (!empty($old_data['thumbnail_link'])){
        $dirname = explode("/",$old_data['thumbnail_link'])[1];
        $filename = explode("/",$old_data['thumbnail_link'])[2];
        unlink("./".$dirname."/".$filename);
      }
    }
  } catch (Exception $e) {
    echo "File ko tồn tại để xóa.";
  }
  // Lưu đường link
  $data = '/upload/'.$rand_str.$_FILES["image_to_upload"]['name'];
  $web_content->save_thumbnail($embed_id, $data);
  // upload và đưa vào thư mục upload
  // tmp_name là cái file của host này đang chứa
  move_uploaded_file($_FILES["image_to_upload"]['tmp_name'], $target_file);
  echo "Lưu dữ liệu ảnh thumbnail ".$embed_id." thành công";
}
else echo "Lưu dữ liệu ảnh thumbnail ".$embed_id." thất bại";
