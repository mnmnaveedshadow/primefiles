<?php include '../backend/conn.php'; ?>
<br><br>
<table class="table  datanew" id="cityTable">
  <thead>
    <tr>

      <th>City Name</th>
      <th>Country</th>
      <th>Edit</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM `cities` ORDER BY `cities`.`country_id` ASC";

    $rs = $conn->query($sql);
    if($rs->num_rows >0){
      while($row = $rs->fetch_assoc()){
        $cid  = $row['country_id'];
        $city_id = $row['city_id'];
        ?>
      <tr>
        <td> <?= $row['name'] ?> </td>
        <td> <?= getDataBack($conn,'countries','country_id',$cid,'name') ?> </td>
                <td> <a class="btn btn-warning btn-sm" style="color:#fff;" onclick="#">Edit</a> </td>
        <td> <a class="btn btn-danger btn-sm" style="color:#fff;" onclick="delCity(<?= $city_id ?>)">Delete</a> </td>
      </tr>
    <?php }} ?>

  </tbody>

</table>
<script>
            $(document).ready(function () {
                $('#cityTable').DataTable();
            });
        </script>
