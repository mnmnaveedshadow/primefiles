<?php include '../backend/conn.php'; ?>
<div class="table-responsive">
  <table class="table  datanew">
    <thead>
      <tr>
          <th>Country</th>
          <th>City</th>
          <th>Seaport</th>
          <th>Vendor</th>
          <th>Type Of Service</th>
          <th>Type Of Container</th>
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
      $sql = "SELECT * FROM `tbl_sea_dest_charge` ORDER BY `tbl_sea_dest_charge`.`country_id` ASC";

      $rs = $conn->query($sql);
      if($rs->num_rows >0){
        while($row = $rs->fetch_assoc()){
          $id  = $row['sdc_id'];
          $country_id = $row['country_id'];
          $city_id = $row['city_id'];
          $seaport_id = $row['sp_id'];

          $uom = $row['sdc_uom'];
          $currency = $row['sdc_currency'];
          $v_id=$row['sdc_vendor'];
          $service = $row['sdc_tos'];
          $tocontainer = $row['sdc_toc'];
           ?>
        <tr>

          <td><?= getDataBack($conn,'countries','country_id',$country_id,'name'); ?></td>
          <td><?= getDataBack($conn,'cities','city_id',$city_id,'name'); ?></td>
          <td><?= getDataBack($conn,'tbl_sea_port','sp_id',$seaport_id,'sp_name'); ?></td>
          <td><?= $v_id ?></td>
          <td><?= getService($service) ?></td>
          <td><?= getDataBack($conn,'tbl_container','cr_id',$tocontainer,'cr_name'); ?></td>
          <td><?= $row['sdc_desc'] ?></td>
          <td><?= $row['sdc_charge'] ?></td>
          <td><?= getCurrency($currency) ?></td>
          <td><?= getUom($uom) ?></td>
          <td><?= $row['sdc_min'] ?></td>
          <td><?= $row['sdc_validity'] ?></td>
          <td>
            <a href="#" class="btn btn-warning btn-sm" onclick="openSfdEdit(<?= $id ?>)"> Edit </a>
          </td>
          <td>
            <a href="#" class="btn btn-danger btn-sm" onclick="deleteSoc(<?= $id ?>)"> Delete </a>
          </td>

        </tr>
      <?php } } ?>

    </tbody>

  </table>

</div>
