<?php include '../backend/conn.php'; ?>
<br><br>
<table class="table  datanew" id="land_port_code">
  <thead>
    <tr>
      <th>Land Border</th>
      <th>City Name</th>
      <th>Edit</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM `tbl_land_border` ORDER BY `tbl_land_border`.`city_id` ASC";

    $rs = $conn->query($sql);
    if($rs->num_rows >0){
      while($row = $rs->fetch_assoc()){
        $lb_id  = $row['lb_id'];
        $city_id = $row['city_id'];
        ?>
      <tr>
        <td> <?= $row['lb_name'] ?> </td>
        <td> <?= getDataBack($conn,'cities','city_id',$city_id,'name') ?> </td>
                <td> <a class="btn btn-warning btn-sm" style="color:#fff;" onclick="#">Edit</a> </td>
        <td> <a class="btn btn-danger btn-sm" style="color:#fff;" onclick="delLandBorder(<?= $lb_id ?>)">Delete</a> </td>
      </tr>
    <?php }} ?>

  </tbody>

</table>
<script>
            $(document).ready(function () {
                $('#land_port_code').DataTable();
            });
        </script>
