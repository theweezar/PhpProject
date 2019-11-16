<div class="cart">
  <table class="cart-table">
    <tr>
      <th>Tên</th>
      <th>Số lượng</th>
      <th>Thành tiền</th>
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
    <tr>
      <td></td>
      <td></td>
      <td><b>Tổng cộng:</b> <?php echo $thanhtien ?>d</td>
    </tr>
  </table>
  <?php 
  if ($_SESSION['hascart']){
    ?>
    <button total='<?php echo $thanhtien ?>' id='pay'>Đặt hàng</button>
    <?php
  }
?>
  
</div>

<?php
  if (isset($data["done"])){
    if ($data["done"]) {
      ?>
        <script>alert("Thanh toan da duoc luu vao CSDL");</script>
      <?php
    }
  }
?>

<script>
document.getElementById('pay').addEventListener('click',function(){
  if (confirm("Ban co chac chan khong ?")){
    window.location = `/thanhtoan/${this.getAttribute('total')}`;
  }
});
</script>