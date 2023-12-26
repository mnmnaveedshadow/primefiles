<?php include '../backend/conn.php'; ?>
<div class="table-responsive">
<table class="table" id="dataTable">
  <thead>
    <tr>

      <th>Description</th>
      <th>UOM</th>
      <th>Rate (AED)</th>
      <th>Remarks</th>
      <th>Validity</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM `tbl_warehouse_cat`";

    $rs = $conn->query($sql);
    if($rs->num_rows >0){
      while($row = $rs->fetch_assoc()){
        $id  = $row['wc_id']; ?>
      <tr>
        <td colspan="6">
          <span style="font-weight:bold;text-transform: capitalize;">
            <?= $row['wc_name'] ?>
          </span>
        </td>
      </tr>

        <?php
          $sql_data = "SELECT * FROM `tbl_warehouse_data` WHERE wc_id='$id'";
          $rs_data = $conn->query($sql_data);

          if($rs_data->num_rows > 0){
            while($row_data = $rs_data->fetch_assoc()){
         ?>
           <tr>
            <td> --<?= $row_data['wd_description'] ?> </td>
            <td> <?= $row_data['wd_uom'] ?> </td>
            <td> <?= $row_data['wd_rate'] ?> </td>
            <td> <?= $row_data['wd_remarks'] ?> </td>
            <td> <?= $row_data['wd_validity'] ?> </td>
            <td> <a href="#" class="btn btn-danger btn-sm"
              onclick="delWareData(<?= $row_data['wd_id'] ?>)">Delete</a> </td>
          </tr>
      <?php } } ?>

    <?php }} ?>

  </tbody>

</table>
</div>

<script>
            $(document).ready(function () {
                $('#dataTable').DataTable();
            });
        </script>