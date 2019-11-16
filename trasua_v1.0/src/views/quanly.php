<div class="users">
  <table class="users-table">
    <tr>
      <th>Fullname</th>
      <th>Username</th>
      <th>Password</th>
      <th>Phone number</th>
      <th>Email</th>
      <th>Đơn hàng hiện tại</th>
    </tr>
    <?php 
    foreach ($data["users"] as $key => $user) {
      # code...
      ?>
      <tr>
        <td><?php echo $user["fname"]; ?></td>
        <td><?php echo $user["username"]; ?></td>
        <td><?php echo $user["password"]; ?></td>
        <td><?php echo $user["sdt"]; ?></td>
        <td><?php echo $user["email"]; ?></td>
        <td style="text-align:center;"><a href="/quanly/<?php echo $user["username"];?>">Xem</a></td>
      </tr>
      <?php 
    }
    ?>
  </table>
</div>