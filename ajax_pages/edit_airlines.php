<?php include '../backend/conn.php'; ?>

<?php
  $aid = $_REQUEST['al_id'];
  $sql = "SELECT * FROM tbl_airlines WHERE al_id='$aid'";
  $rs = $conn->query($sql);

  if($rs->num_rows > 0){
    $row = $rs->fetch_assoc();
 ?>
<form class="" action="backend/edit_airlines.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="al_id" value="<?= $aid ?>">
 <div class="form-group">
   <label for="">Airlines</label>
   <input type="text" class="form-control" placeholder="" name="airline_name" value="<?= $row['air_line_name'] ?>" required>
 </div>
 <button type="submit" class="btn btn-warning btn-me2" name="button">Edit</button>
</form>
<?php  }else{ ?>
  <h1>No Data Found</h1>
<?php } ?>
