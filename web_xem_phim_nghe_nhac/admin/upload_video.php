<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/database/Movie.php');

// isset là hàm kiểm tra xem các biến truyền vô có tồn tại hay ko ?
// trong trường hợp này là kiểm tra xem nút 'upload video' có được ấn vô hay ko
if(isset($_POST['upload_button'])){
  // kích thước tối đa của file mà đang được upload
  $maxsize = 5242880; // 5MB
  // Kiểm tra xem file có được upload vào frontend chưa
  if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ''){
    // tên file
    $name = $_FILES['file']['name'];
    // tên folder mà cái file đó sẽ được lưu vào
    $target_dir = "videos/";
    // tên file khi mà nó được lưu vào
    $target_file = $target_dir . generateRandomString(20) . '.mp4';

    // Select file type - tên đuôi file
    $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("mp4");

    // Check extension - kiểm tra tên đuôi file
    if(in_array($extension,$extensions_arr) ){

        // Check file size - kiểm tra file có lớn hơn kích thước quy định hay ko
        if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
          $_SESSION['message'] = "File too large. File must be less than 5MB.";
        }
        else{
          // Upload - nếu đúng điều kiện trên thì bắt đầu tải file vừa upload vào trong folder $target_dir
          if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
            // Insert record - phiên toàn cục
            $_SESSION['message'] = "Upload video ".$_POST['video_name']." successfully.";
            // gọi lớp Movie để thêm dữ liệu
            $movie = new Movie();
            // Phương thức thêm dữ liệu được dùng ở đây
            $movie->insert($_POST['video_name'], $target_file);
          }
        }

    }
    else{
      $_SESSION['message'] = "Invalid file video extension.";
    }
  }
  else{
    $_SESSION['message'] = "Please select a video file.";
  }
  header('Location: ./index.php');
} 
?>