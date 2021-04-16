<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/database/Music.php');

if(isset($_POST['upload_button'])){
  $maxsize = 5242880; // 5MB
  if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ''){
    $name = $_FILES['file']['name'];
    $target_dir = "musics/";
    $target_file = $target_dir . generateRandomString(20) . '.mp3';

    // Select file type
    $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("mp3");

    // Check extension
    if(in_array($extension,$extensions_arr) ){

        // Check file size
        if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
          $_SESSION['message'] = "File too large. File must be less than 5MB.";
        }
        else{
          // Upload
          if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
            $_SESSION['message'] = "Upload successfully.";
            $music = new Music();
            $music->insert($_POST['file_mp3_name'], $_POST['author_name'], $_POST['singer_name'], $target_file);
          }
        }

    }
    else{
      $_SESSION['message'] = "Invalid file mp3 extension.";
    }
  }
  else{
    $_SESSION['message'] = "Please select a mp3 file.";
  }
  header('Location: ./index.php');
} 
?>