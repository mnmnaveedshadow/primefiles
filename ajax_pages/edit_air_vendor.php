<?php include '../backend/conn.php'; ?>

<?php
  $id = $_REQUEST['id'];
  $sql = "SELECT * FROM tbl_air_vendor WHERE av_id='$id'";
  $rs = $conn->query($sql);

  if($rs->num_rows > 0){
    $row = $rs->fetch_assoc();
 ?>
<form class="" action="backend/edit_air_vendor.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= $id ?>">
 <div class="form-group">
   <label for="">Air Vendor</label>
   <input type="text" class="form-control" placeholder="" name="v_name" value="<?= $row['av_name'] ?>" required>
 </div>
 <button type="submit" class="btn btn-warning btn-me2" name="button">Edit</button>
</form>
<?php  }else{ ?>
  <h1>No Data Found</h1>
<?php } ?>
