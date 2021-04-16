<?php 
  include($_SERVER['DOCUMENT_ROOT'].'/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Resource</title>
  <link rel="stylesheet" href="../style/css/bootstrap.css">
  <style>
    .p-0{
      padding: 0!important;
    }
    .m-0{
      margin: 0!important;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <form class="w-50" method="post" action="./upload_video.php" enctype='multipart/form-data'>
      <div class="my-4">
        <h4>
          Upload Videos Section
        </h4>
      </div>
      <div class="row my-4">
        <div class="col-3">
          Video's name
        </div>
        <div class="col-9">
          <input placeholder="Video's name" class="w-100" type="text" required
          name="video_name" id="video_name">
        </div>
      </div>
      <div class="row my-4">
        <div class="col-3">
          Upload video
        </div>
        <div class="col-9">
          <input type='file' name='file' required
          accept="video/mp4, video/avi, video/3gp, video/mov, video/mpeg" />
        </div>
      </div>
      <!-- <div>
        <video id="" src=""></video>
      </div> -->
      <div class="my-4 text-center">
        <input type='submit' value='Upload Video' name='upload_button' class="btn btn-primary">
      </div>
    </form>
    <!-- ==================================================================================== -->
    <!-- ==================================================================================== -->
    <!-- ==================================================================================== -->
    <!-- ==================================================================================== -->
    <!-- ==================================================================================== -->
    <form class="w-50" method="post" action="./upload_mp3.php" enctype='multipart/form-data'>
      <div class="my-4">
        <h4>
          Upload Musics Section
        </h4>
      </div>
      <div class="row my-4">
        <div class="col-3">
          File's name
        </div>
        <div class="col-9">
          <input placeholder="File mp3's name" required class="w-100" type="text" name="file_mp3_name" id="file_mp3_name">
        </div>
      </div>
      <div class="row my-4">
        <div class="col-3">
          Author
        </div>
        <div class="col-9">
          <input placeholder="Author's name" required class="w-100" type="text" name="author_name" id="author_name">
        </div>
      </div>
      <div class="row my-4">
        <div class="col-3">
          Singer
        </div>
        <div class="col-9">
          <input placeholder="Singer's name" required class="w-100" type="text" name="singer_name" id="singer_name">
        </div>
      </div>
      <div class="row my-4">
        <div class="col-3">
          Upload MP3
        </div>
        <div class="col-9">
          <input type='file' name='file' required accept="audio/mp3" />
        </div>
      </div>
      <!-- <div>
        <video id="" src=""></video>
      </div> -->
      <div class="my-4 text-center">
        <input type='submit' value='Upload File MP3' name='upload_button' class="btn btn-primary">
      </div>
    </form>
  </div>

  <?php 
    if (isset($_SESSION['message'])){
      ?>
        <script>
          alert('<?php echo $_SESSION['message'] ?>')
        </script>
      <?php
      unset($_SESSION['message']);
    }
  ?>

</body>
</html>

