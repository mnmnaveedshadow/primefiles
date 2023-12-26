<?php include '../backend/conn.php';
  $id = $_REQUEST['cont_id'];

  $data = getDataBack($conn,'tbl_container','cr_id',$id,'cr_name');

?>

<form action="backend/edit_cont.php" method="post">
  <input type="hidden" name="id" value="<?= $id ?>">
  <div class="form-group">
    <label for="">Container Name</label>
    <input type="text" class="form-control" name="cont_name" value="<?= $data ?>" value="">
  </div>
  <button type="submit" class="btn btn-success btn-sm" name="button">Edit</button>
</form>
