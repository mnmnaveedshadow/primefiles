<?php include '../backend/conn.php';
  $id = $_REQUEST['wc_id'];
  $data = getDataBack($conn,'tbl_warehouse_cat_q','wc_id',$id,'wc_name');
  $qid = $_REQUEST['q_id'];
?>

<form action="backend/edit_wc_cat.php" method="post">
  <input type="hidden" name="qid" value="<?= $qid ?>">
  <input type="hidden" name="wc_id" value="<?= $id ?>">
  <div class="form-group">
    <label for="">Category Name</label>
    <input type="text" class="form-control" name="wc_cat_name" value="<?= $data ?>" value="">
  </div>
  <button type="submit" class="btn btn-success btn-sm" name="button">Edit</button>
</form>
