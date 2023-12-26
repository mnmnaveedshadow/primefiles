<?php include '../backend/conn.php'; ?>
<br><br>
<table class="table  datanew" id="airport_coded">
  <thead>
    <tr>
      <th>Air Port Code</th>
      <th>City Name</th>
            <th>Edit</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM `airports` ORDER BY `airports`.`city_id` ASC";

    $rs = $conn->query($sql);
    if($rs->num_rows >0){
      while($row = $rs->fetch_assoc()){
        $city_id = $row['city_id'];
        $air = $row['airport_id'];
        ?>
      <tr>
        <td> <?= $row['code'] ?> </td>
        <td> <?= getDataBack($conn,'cities','city_id',$city_id,'name') ?> </td>
                <td> <a class="btn btn-warning btn-sm" style="color:#fff;" onclick="#">Edit</a> </td>
        <td> <a class="btn btn-danger btn-sm" style="color:#fff;" onclick="delAirport(<?= $air ?>)">Delete</a> </td>
      </tr>
    <?php }} ?>

  </tbody>

</table>
<script>
            $(document).ready(function () {
                $('#airport_coded').DataTable();
            });
        </script>
