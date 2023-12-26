<?php include '../backend/conn.php'; ?>
<div class="table-responsive">
  <table class="table  datanew">
    <thead>
      <tr>
          <th>Country</th>
          <th>City</th>
          <th>Border</th>
          <th>Vendor</th>
          <th>Type Of Service</th>
          <th>Description</th>
          <th>Charge</th>
          <th>Currency</th>
          <th>UOM</th>
          <th>Minimum</th>
          <th>VALIDITY</th>
          <th>Modification</th>
          <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT * FROM `tbl_road_destination_charge` ORDER BY `tbl_road_destination_charge`.`country_id` ASC";

      $rs = $conn->query($sql);
      if($rs->num_rows >0){
        while($row = $rs->fetch_assoc()){
          $id  = $row['rdc_id'];
          $country_id = $row['country_id'];
          $city_id = $row['city_id'];
          $border_id = $row['border_id'];

          $uom = $row['uom'];
          $currency = $row['currency'];
          $service = $row['rdc_tos'];


           ?>
        <tr>

          <td><?= getDataBack($conn,'countries','country_id',$country_id,'name'); ?></td>
          <td><?= getDataBack($conn,'cities','city_id',$city_id,'name'); ?></td>
          <td><?= getDataBack($conn,'tbl_land_border','lb_id',$border_id,'lb_name'); ?></td>
          <td><?= $row['v_id'] ?></td>
          <td><?= getServiceLand($service) ?></td>
          <td><?= $row['rdc_desc'] ?></td>
          <td><?= $row['rdc_charge'] ?></td>
          <td><?= getCurrency($currency) ?></td>
          <td><?= getUom($uom) ?></td>
          <td><?= $row['rdc_min'] ?></td>
          <td><?= $row['rdc_validity'] ?></td>
          <td>
            <a href="#" class="btn btn-warning btn-sm" onclick="openEditLoc(<?= $id ?>)"> Edit </a>
          </td>
          <td>
            <a href="#" class="btn btn-danger btn-sm" onclick="deleteLdc(<?= $id ?>)"> Delete </a>
          </td>

        </tr>
      <?php } } ?>

    </tbody>

  </table>
</div>
