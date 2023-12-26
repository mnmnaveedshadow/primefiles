<?php include '../backend/conn.php'; ?>
<table class="table datanew" id="countryTable">
  <thead>
    <tr>

      <th>Country Name</th>
            <th>Edit</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM `countries`";

    $rs = $conn->query($sql);
    if($rs->num_rows >0){
      while($row = $rs->fetch_assoc()){
        $id  = $row['country_id']; ?>
      <tr>
        <td> <?= $row['name'] ?> </td>
        <td> <a class="btn btn-warning btn-sm" style="color:#fff;" onclick="#">Edit</a> </td>
        <td> <a class="btn btn-danger btn-sm" style="color:#fff;" onclick="delCountry(<?= $id ?>)">Delete</a> </td>
      </tr>
    <?php }} ?>

  </tbody>

</table>
<script>
            $(document).ready(function () {
                $('#countryTable').DataTable();
            });
        </script>
