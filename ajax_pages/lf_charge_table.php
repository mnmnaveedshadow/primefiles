<?php include '../backend/conn.php'; ?>
<div class="table-responsive">
  <table class="table" id="dataTable">
    <thead>
      <tr>
        <th>Origin/Destination</th>
        <th>Origin/Destination City</th>
        <th>Origin/Destination Border</th>
        <th>Vendor</th>
        <th>Type Of Service</th>
        <th>Description</th>
        <th>Min Weight</th>
        <th>Max Weight</th>
        <th>Min CBM</th>
        <th>Max CBM</th>
        <th>Charge amount</th>
        <th>Currency</th>
        <th>UOM</th>
        <th>Transit</th>
        <th>Validity</th>
        <th>Modification</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql_data = "SELECT * FROM tbl_land_charge ORDER BY `tbl_land_charge`.`country_id` ASC";
      $rs_data = $conn->query($sql_data);

      if($rs_data->num_rows > 0){
        while($row_data= $rs_data->fetch_assoc()){
          $id=$row_data['lc_id'];

          $country_id = $row_data['country_id'];
          $city_id = $row_data['city_id'];
          $border_id = $row_data['border_id'];

          $country_dest_id = $row_data['country_id_dest'];
          $city_dest_id = $row_data['city_id_dest'];
          $border_id_dest = $row_data['border_id_dest'];

          $uom = $row_data['oum'];
          $currency = $row_data['currency'];

          $service = $row_data['type_of_s'];

      ?>
      <tr>
        <td>  <?= getDataBack($conn,'countries','country_id',$country_id,'name'); ?> - <?= getDataBack($conn,'countries','country_id',$country_dest_id,'name'); ?></td>
        <td><?= getDataBack($conn,'cities','city_id',$city_id,'name'); ?> - <?= getDataBack($conn,'cities','city_id',$city_dest_id,'name'); ?></td>
        <td><?= getDataBack($conn,'tbl_land_border','lb_id',$border_id,'lb_name'); ?> - <?= getDataBack($conn,'tbl_land_border','lb_id',$border_id_dest,'lb_name'); ?></td>

        <td><?= $row_data['vn_id'] ?></td>
        <td><?= getServiceLand($service) ?></td>
        <td> <?= $row_data['lc_desc'] ?> </td>
        <td> <?= $row_data['min_weight'] ?> </td>
        <td> <?= $row_data['max_weight'] ?> </td>
        <td> <?= $row_data['min_cbm'] ?> </td>
        <td> <?= $row_data['max_cbm'] ?> </td>
        <td> <?= $row_data['rate'] ?> </td>
        <td><?= getCurrency($currency) ?></td>
        <td><?= getUom($uom) ?></td>
        <td><?= $row_data['transit'] ?></td>
        <td> <?= $row_data['validity'] ?> </td>
        <td>
          <a href="#" class="btn btn-warning btn-sm" onclick="openEditLandChargeModal(<?= $id ?>)"> Edit </a>
        </td>
        <td> <a class="btn btn-danger btn-sm" onclick="deleteLc(<?= $id ?>)">Remove</a> </td>
      </tr>
      <?php
      } }
       ?>
    </tbody>
  </table>
</div>
<script>
            $(document).ready(function () {
                $('#dataTable').DataTable();
            });
        </script>
