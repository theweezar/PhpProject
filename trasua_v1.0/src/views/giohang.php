
<table class="cart-table">
  <tr>
    <th>Tên trà sữa</th>
    <th>Số lượng</th>
    <th>Giá tiền</th>
  </tr>

<?php

// print_r($data["giohang"]);

foreach ($data["giohang"] as $key => $hang) {
  # code...
  ?>
  <tr>
    <td><?php echo $hang["mh"] ?></td>
    <td>0</td>
    <td><?php echo "0d"; ?></td>
  </tr>


<?php } ?>
</table>