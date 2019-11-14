<form action="/themtrasua" method="post" enctype="multipart/form-data">
  <div class="input-text">
    <div>
      <input placeholder="Tên hàng" type="text" name="tenhang" id="">
    </div>
    <div>
      <input placeholder="Giá tiền" type="number" name="gia" id="">
    </div>
    <div>
      <input name="upload" type="submit" value="Submit">
    </div>
  </div>
  <div class="input-img">
    <div>
      <input required="required" type="file" name="fileToUpload" id="">
    </div>
  </div>
</form>

<?php
  if (isset($data["msg"])){
    ?>
    <script>
      alert("<?php echo $data["msg"] ?>");
      <?php
        if (isset($data["done"]))?>window.location = "/";<?php
      ?>
    </script>
    <?php
  }
?>