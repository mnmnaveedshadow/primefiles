<?php include '../backend/conn.php';
  $id = $_REQUEST['rv_id'];

  $data = getDataBack($conn,'tbl_road_vendors','rv_id',$id,'rv_name');

?>

<form action="backend/edit_rv.php" method="post">
  <input type="hidden" name="id" value="<?= $id ?>">
  <div class="form-group">
    <label for="">Road Vendor Name</label>
    <input type="text" class="form-control" name="rv_name" value="<?= $data ?>" value="">
  </div>
  <button type="submit" class="btn btn-success btn-sm" name="button">Edit</button>
</form>
