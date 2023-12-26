<?php include '../backend/conn.php'; ?>

<?php
  $id = $_REQUEST['c_id'];
  $sql = "SELECT * FROM tbl_sea_carrier WHERE sc_id ='$id'";
  $rs = $conn->query($sql);

  if($rs->num_rows > 0){
    $row = $rs->fetch_assoc();
 ?>
<form class="" action="backend/edit_carrier_data.php" method="post">
  <input type="hidden" name="id" value="<?= $id ?>">
 <div class="form-group">
   <label for="">Carrier Name</label>
   <input type="text" class="form-control" placeholder="" name="carrier_name" value="<?= $row['sc_name'] ?>" required>
 </div>
 <button type="submit" class="btn btn-warning btn-me2" name="button">Edit</button>
</form>
<?php  }else{ ?>
  <h1>No Data Found</h1>
<?php } ?>
