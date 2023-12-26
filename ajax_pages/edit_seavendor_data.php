<?php include '../backend/conn.php';
  $id = $_REQUEST['sv_id'];

  $data = getDataBack($conn,'tbl_sea_vendors','sv_id',$id,'sv_name');

?>

<form action="backend/edit_sv.php" method="post">
  <input type="hidden" name="id" value="<?= $id ?>">
  <div class="form-group">
    <label for="">Sea Vendor Name</label>
    <input type="text" class="form-control" name="sv_name" value="<?= $data ?>" value="">
  </div>
  <button type="submit" class="btn btn-success btn-sm" name="button">Edit</button>
</form>
