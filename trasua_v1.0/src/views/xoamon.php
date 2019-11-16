<div class="del-table">
  <table>
    <tr>
      <th>Tên trà sữa</th>
      <th>Giá</th>
      <th>Action</th>
    </tr>

    <?php
    foreach ($data["alldrinks"] as $key => $trasua) {
      # code...
      ?>
      <tr>
        <td><?php echo $trasua["tenh"];?></td>
        <td><?php echo $trasua["gia"];?></td>
        <?php
          if ($trasua["con"]){
            ?>
            <td><a href="/xoamon/<?php echo $trasua["mh"]; ?>">Ngừng bán</a></td>
            <?php
          }
          else {
            ?>
            <td><a href="/moban/<?php echo $trasua["mh"]; ?>">Mở bán</a></td>
            <?php
          }
        ?>
      </tr>
      <?php
    }
    ?>
  </table>
</div>