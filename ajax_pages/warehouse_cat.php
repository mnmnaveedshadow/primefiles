<?php include '../backend/conn.php'; ?>
<table class="table">
  <thead>
    <tr>

      <th>WareHouse Category Name</th>
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

      <td> <?= $row['wc_name'] ?> </td>
      <td> <a href="#" onclick="delWc(<?= $id ?>)" class="btn btn-danger btn-sm"> Delete </a> </td>

      </tr>
    <?php }} ?>

  </tbody>

</table>
