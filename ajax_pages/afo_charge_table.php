<?php include '../backend/conn.php'; ?>
<div class="table-responsive">
<table class="table  datanew">
  <thead>
    <tr>
        <th>Country</th>
        <th>City</th>
        <th>Airport</th>
        <th>Vendor</th>
        <th>Description</th>
        <th>Charge</th>
        <th>Currency</th>
        <th>UOM</th>
        <th>Minimum</th>
        <th>VALIDITY</th>
        <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM `tbl_air_orgin_charge` ORDER BY `tbl_air_orgin_charge`.`country_id` ASC";

    $rs = $conn->query($sql);
    if($rs->num_rows >0){
      while($row = $rs->fetch_assoc()){
        $id  = $row['aoc_id'];
        $country_id = $row['country_id'];
        $city_id = $row['city_id'];
        $airport_id = $row['airport_id'];

        $uom = $row['aoc_uom'];
        $currency = $row['aoc_currency'];
        $v_id=$row['aoc_vendor'];

         ?>
      <tr>

        <td><?= getDataBack($conn,'countries','country_id',$country_id,'name'); ?></td>
        <td><?= getDataBack($conn,'cities','city_id',$city_id,'name'); ?></td>
        <td><?= getDataBack($conn,'airports','airport_id',$airport_id,'code'); ?></td>
        <td><?= getDataBack($conn,'tbl_air_vendor','av_id',$v_id,'av_name'); ?></td>
        <td><?= $row['aoc_description'] ?></td>
        <td><?= $row['aoc_charge'] ?></td>
        <td><?= getCurrency($currency) ?></td>
        <td><?= getUom($uom) ?></td>
        <td><?= $row['aoc_min'] ?></td>
        <td><?= $row['aoc_validity'] ?></td>
        <td>
          <a href="#" class="btn btn-warning btn-sm" onclick="openEditAoc(<?= $id ?>)"> Edit </a>
          ||
          <a href="#" class="btn btn-danger btn-sm" onclick="deleteAoc(<?= $id ?>)"> Delete </a>
        </td>

      </tr>
    <?php } } ?>

  </tbody>

</table>
</div>
