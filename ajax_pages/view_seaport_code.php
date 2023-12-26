<?php include '../backend/conn.php'; ?>
<br><br>
<table class="table datanew" id="sae_port_code">
  <thead>
    <tr>
      <th>Sea Port Code</th>
      <th>City Name</th>
      <th>Edit</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM `tbl_sea_port` ORDER BY `tbl_sea_port`.`city_id` ASC";

    $rs = $conn->query($sql);
    if($rs->num_rows >0){
      while($row = $rs->fetch_assoc()){
        $city_id = $row['city_id'];
        $sp_id = $row['sp_id'];
        ?>
      <tr>
        <td> <?= $row['sp_name'] ?> </td>
        <td> <?= getDataBack($conn,'cities','city_id',$city_id,'name') ?> </td>
                <td> <a class="btn btn-warning btn-sm" style="color:#fff;" onclick="#">Edit</a> </td>
        <td> <a class="btn btn-danger btn-sm" style="color:#fff;" onclick="delSeaPort(<?= $sp_id ?>)">Delete</a> </td>
      </tr>
    <?php }} ?>

  </tbody>

</table>
<script>
            $(document).ready(function () {
                $('#sae_port_code').DataTable();
            });
        </script>
