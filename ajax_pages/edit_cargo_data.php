<?php include '../backend/conn.php'; ?>

<?php
  $id = $_REQUEST['id'];
  $sql = "SELECT * FROM tbl_cargo_type WHERE ctype_id ='$id'";
  $rs = $conn->query($sql);

  if($rs->num_rows > 0){
    $row = $rs->fetch_assoc();
 ?>
<form class="" action="backend/edit_cargo_type.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= $id ?>">
 <div class="form-group">
   <label for="">Cargo Type</label>
   <input type="text" class="form-control" placeholder="" name="c_name" value="<?= $row['ctype'] ?>" required>
 </div>
 <div class="form-group">
     <label for="">Cargo Priority</label>
     <input type="number" min="1" class="form-control" placeholder="Ex:1" name="cargo_pr" value="<?= $row['c_pr'] ?>" required>
 </div>
 <button type="submit" class="btn btn-warning btn-me2" name="button">Edit</button>
</form>
<?php  }else{ ?>
  <h1>No Data Found</h1>
<?php } ?>
