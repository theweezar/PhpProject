<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/database/web_content.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/dashboard/tools.php');

$rand_str = get_random_string(10);
$web_content = new WebContent();
$uploadOk = true;
$id = $_POST["id"];
$name = $_POST["name"];

// $uploaded_file = false;

if ($_POST["status"] == 1) {
  $target_dir = realpath(dirname(getcwd()))."/dashboard/upload/";

  $target_file = $target_dir .$rand_str. basename($_FILES["image_to_upload"]["name"]);
  
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
      $old_data = mysqli_fetch_assoc($web_content->load_content_with_id($id));
      $dirname = explode("/",$old_data['content'])[1];
      $filename = explode("/",$old_data['content'])[2];
      unlink("./".$dirname."/".$filename);
    } catch (Exception $e) {
      echo "File ko tồn tại để xóa.";
    }
    // Lưu đường link
    $data = '/upload/'.$rand_str.$_FILES["image_to_upload"]['name'];
    $web_content->save_content($id, $data, 2);
    $web_content->change_name($id, $name);
    // upload và đưa vào thư mục upload
    // tmp_name là cái file của host này đang chứa
    $success = move_uploaded_file($_FILES["image_to_upload"]['tmp_name'], $target_file);
    if ($success) echo "Lưu dữ liệu ảnh content ".$id." thành công";
    else echo "Có lỗi khi tải ảnh vào thư mục ".$target_file;
  }
  else echo "Lưu dữ liệu ảnh content ".$id." thất bại";  
}
else if ($_POST['status'] == 0){
  $web_content->change_name($id, $name);
  echo "Thay đổi tên của content ".$id." thành công";
}