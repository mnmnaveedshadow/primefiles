<?php include '../backend/conn.php'; ?>
<table class="table  datanew">
  <thead>
    <tr>

      <th>Reference Number</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM `tbl_order_customer` ORDER BY `tbl_order_customer`.`order_id` DESC";

    $rs = $conn->query($sql);
    if($rs->num_rows >0){
      while($row = $rs->fetch_assoc()){
        $id  = $row['id']; ?>
      <tr>

      <td></td>

      </tr>
    <?php }} ?>

  </tbody>

</table>
