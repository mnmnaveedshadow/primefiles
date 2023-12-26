<?php include '../backend/conn.php'; ?>
<div class="table-responsive">
<table class="table  datanew" id="dataTable">
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
        <th>Edit</th>
        <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM `tbl_air_dest_charge` ORDER BY `tbl_air_dest_charge`.`country_id` ASC";

    $rs = $conn->query($sql);
    if($rs->num_rows >0){
      while($row = $rs->fetch_assoc()){
        $id  = $row['adc_id'];
        $country_id = $row['country_id'];
        $city_id = $row['city_id'];
        $airport_id = $row['airport_id'];

        $uom = $row['adc_uom'];
        $currency = $row['adc_currency'];
        $v_id=$row['adc_vendor'];

         ?>
      <tr>

        <td><?= getDataBack($conn,'countries','country_id',$country_id,'name'); ?></td>
        <td><?= getDataBack($conn,'cities','city_id',$city_id,'name'); ?></td>
        <td><?= getDataBack($conn,'airports','airport_id',$airport_id,'code'); ?></td>
        <td><?= getDataBack($conn,'tbl_air_vendor','av_id',$v_id,'av_name'); ?></td>
        <td><?= $row['adc_description'] ?></td>
        <td><?= $row['adc_charge'] ?></td>
        <td><?= getCurrency($currency) ?></td>
        <td><?= getUom($uom) ?></td>
        <td><?= $row['adc_min'] ?></td>
        <td><?= $row['adc_validity'] ?></td>
        <td>
          <a href="#" class="btn btn-warning btn-sm" onclick="openEditAdc(<?= $id ?>)"> Edit </a>
        </td>
        <td>
          <a href="#" class="btn btn-danger btn-sm" onclick="deleteAdc(<?= $id ?>)"> Delete </a></td>

      </tr>
    <?php } } ?>

  </tbody>

</table>
      </div>
      <script>
            $(document).ready(function () {
                $('#dataTable').DataTable();
            });
        </script>
