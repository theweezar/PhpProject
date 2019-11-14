<div class="history">
  <table>
    <tr>
      <th>YYYY-MM-DD</th>
      <th>Tổng tiền</th>
      <th>Action</th>
    </tr>

    <?php 
      foreach ($data["allbills"] as $key => $bill) {
        # code...
        ?>
          <tr>
            <td><?php echo $bill["created_at"] ?></td>
            <td><?php echo $bill["thanhtien"] ?></td>
            <td><a href="/lichsu/<?php echo $bill["mgh"] ?>">Xem</a></td>
          </tr>
        <?php
      }
    ?>
    

  </table>
</div>