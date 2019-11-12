<!-- <h1>home</h1> -->

<?php
  // print_r($data["giohang"]);
?>

<menu>
  <?php 
    foreach ($data["trasua"] as $key => $trasua) {
      ?>
      <div class="box">
        <div class="infor">
          <img src="img/<?php echo $trasua['hinh']?>" alt="">
          <div class="data">
            <div class="name"><?php echo $trasua['tenh']?></div>
            <div class="price">Gia: <?php echo $trasua['gia']?>d</div>
          </div>
        </div>
        <button class="btn-add" id="btn-<?php echo $key ?>">+ Add</button>
      </div>
    <?php } ?>
</menu>




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

