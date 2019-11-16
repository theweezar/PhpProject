
<?php 
  if (isset($data["ctgh"])){

  
?>

<center><div class="bill">
  <p>Chi tiết đơn hàng <?php if (isset($data["created_at"])) echo "(".$data["created_at"].")"; ?> </p>
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
      <td style="border-top:2px solid black;"><?php if(isset($data["thanhtien"])) echo $data["thanhtien"];?>đ</td>
    </tr>
  </table>
</div></center>

<?php
  }
  else{
    ?>
    <center><h1>Không có đơn hàng hiện tại</h1></center>
    <?php
  } 
?>