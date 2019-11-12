
<table class="cart-table">
  <tr>
    <th>Tên trà sữa</th>
    <th>Số lượng</th>
    <th>Giá tiền</th>
  </tr>

<?php

// print_r($data["giohang"]);

$thanhtien = 0;

foreach ($data["giohang"] as $key => $hang) {
  # code...
  ?>
  <tr>
    <td><?php echo $data["trasua"][$key]["tenh"] ?></td>
    <td><?php echo $hang["soluong"] ?></td>
    <td><?php $thanhtien += $data["trasua"][$key]["gia"] * $hang["soluong"]; 
    echo $data["trasua"][$key]["gia"] * $hang["soluong"]; ?></td>
  </tr>
<?php } ?>
</table>

<?php 
  if ($_SESSION['hascart']){
    ?>
    <a total='<?php echo $thanhtien ?>' id='thanhtoan'>Thanh toán</a>
    <?php
  }
?>

<?php
  if (isset($data["done"])){
    if ($data["done"]) {
      ?>
        <script>alert("Thanh toan da duoc luu vao CSDL");</script>
      <?php
    }
  }
?>

