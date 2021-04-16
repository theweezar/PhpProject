<?php 
  include_once($_SERVER['DOCUMENT_ROOT'].'/database/Movie.php');
  include_once($_SERVER['DOCUMENT_ROOT'].'/database/Music.php');
?>
<!-- giao diện cho client -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style/css/bootstrap.css">
  <title>Enjoy</title>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <h1>Xem phim</h1>
        <?php 
          // Gọi lớp Movie vô
          $movie = new Movie();
          // Kêu Movie đưa dữ liêu để show ra cho client coi
          $movie_rs = $movie->get_all();
          // Nếu Movie có dữ liệu thì sẽ chạy những thẻ html lên client
          if ($movie_rs != null){
            foreach ($movie_rs as $key => $mv) {
              # code...
              ?>
                <div>
                  <p>
                    <?php echo $mv['movie_name']; ?>
                  </p>
                  <div>
                    <video width="50%" height="auto" controls>
                      <source src="admin/<?php echo $mv['movie_path']; ?>" type="video/mp4">
                    </video>
                  </div>
                </div>
              <?php
            }
          }
        ?>
      </div>
      <div class="col-6">
        <h1>Nghe nhạc</h1>
        <?php 
          $music = new Music();
          $music_rs = $music->get_all();
          if ($music_rs != null){
            foreach ($music_rs as $key => $ms) {
              # code...
              ?>
                <div>
                  <p>
                    Tên bài hát: <?php echo $ms['file_name']; ?>
                  </p>
                  <p>
                    Tên nhạc sĩ: <?php echo $ms['author']; ?>
                  </p>
                  <p>
                    Tên ca sĩ  :<?php echo $ms['singer']; ?>
                  </p>
                  <div>
                    <audio controls>
                      <source src="admin/<?php echo $ms['file_path']; ?>" type="video/mp4">
                    </audio>
                  </div>
                </div>
              <?php
            }
          }
        ?>
      </div>
    </div>
  </div>
</body>
</html>