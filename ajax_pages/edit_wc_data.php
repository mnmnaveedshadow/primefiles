<?php include '../backend/conn.php';
  $id = $_REQUEST['wc_id'];
  $qid = $_REQUEST['q_id'];

  $sql = "SELECT * FROM tbl_warehouse_data_q WHERE wd_id='$id'";
  $rs = $conn->query($sql);

  if($rs->num_rows > 0){
    $row_data = $rs->fetch_assoc();

     }
?>

<form action="backend/edit_wc_data.php" method="post">
  <input type="hidden" name="qid" value="<?= $qid ?>">
  <input type="hidden" name="wc_id" value="<?= $id ?>">
  <div class="form-group">
    <label for="">Description</label>
    <input type="text" class="form-control" name="desc" value="<?= $row_data['wd_description'] ?>">
  </div>
  <div class="form-group">
    <label for="">UOM</label>
    <input type="text" class="form-control" name="uom" value="<?= $row_data['wd_uom'] ?>">
  </div>
  <div class="form-group">
    <label for="">Rate(AED)</label>
    <input type="text" class="form-control" name="rate" value="<?= $row_data['wd_rate'] ?>">
  </div>
  <div class="form-group">
    <label for="">Remark</label>
    <input type="text" class="form-control" name="remark" value="<?= $row_data['wd_remarks'] ?>">
  </div>
  <div class="form-group">
    <label for="">Validity</label>
    <input type="date" class="form-control" name="validity" value="<?= $row_data['wd_validity'] ?>">
  </div>
  <button type="submit" class="btn btn-success btn-sm" name="button">Edit</button>
</form>
