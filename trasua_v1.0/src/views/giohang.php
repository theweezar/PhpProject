
<table>
  <tr>
    <th>Ten tra sua</th>
    <th>Gia tien</th>
  </tr>

<?php

print_r($data["giohang"]);

foreach ($data["giohang"] as $key => $hang) {
  # code...
  ?>
  <tr>
    <td><?php echo $hang["mh"] ?></td>
    <td><?php 1; ?></td>
  </tr>


<?php } ?>
</table>