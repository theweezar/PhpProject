<!-- <h1>home</h1> -->

<?php
  // print_r($data["giohang"]);
?>

<div class="menu">
  <?php 
    foreach ($data["trasua"] as $key => $trasua) {
      ?>
      <div class="product">
        <div class="img">
          <img src="img/<?php echo $trasua["hinh"] ?>" alt="" srcset="">
        </div>
        <div class="order">
          <div class="ten"><?php echo $trasua["tenh"] ?></div>
          <div class="gia"><?php echo $trasua["gia"] ?></div>
          <button class="btn-add" id="btn-<?php echo $key ?>">Add</button>
        </div>
      </div>
    <?php } ?>
</div>




<script>
$(document).ready(function()
{
  <?php 
    foreach ($data["trasua"] as $key => $trasua) {
      ?>
      $(`#btn-<?php echo $key ?>`).click(function()
      {
        var mh = "<?php echo $trasua["mh"]?>"

        $.ajax({
            url: `add/${mh}`,
            type: 'POST',
            data: { mh:mh },
            success: function(data)
            {
                //whatever you want to do
                console.log(data);
            }
        })
      });
    <?php } ?>
  
});

</script>

