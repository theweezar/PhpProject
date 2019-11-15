
<center><div class="bill">
  <p>Chi tiết giao dịch (<?php echo $data["created_at"]; ?>) </p>
  <table>
    <?php
      foreach ($data["ctgh"] as $key => $gh) {
        # code...
        ?>
        <tr>
          <td><?php echo $gh["hang"]["tenh"]; ?></td>
          <td>x</td>
          <td><?php echo $gh["soluong"]; ?></td>
          <td><?php echo $gh["hang"]["gia"] * $gh["soluong"] ?>đ</td>
        </tr>
        <?php
      }
    ?>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td style="font-weight: bold; text-transform:uppercase;">Tổng cộng: </td>
      <td></td>
      <td></td>
      <td style="border-top:2px solid black;"><?php echo $data["thanhtien"];?>đ</td>
    </tr>
  </table>
</div></center>