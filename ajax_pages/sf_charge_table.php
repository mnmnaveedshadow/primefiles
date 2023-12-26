<?php include '../backend/conn.php'; ?>
<div class="table-responsive">
  <table class="table datanew" id="dataTable">
    <thead>
      <tr>
        <th>Origin City</th>
        <th>Origin SeaPort</th>
        <th>Destination City</th>
        <th>Destination SeaPort</th>
        <th>Vendor</th>
        <th>Type Of Service</th>
        <th>Type Of Container</th>
        <th>Carrier</th>
        <th>Description</th>
        <th>Min Weight</th>
        <th>Max Weight</th>
        <th>Min CBM</th>
        <th>Max CBM</th>
        <th>Charge amount</th>
        <th>Transit Days</th>
        <th>Cargo Type</th>
        <th>Currency</th>
        <th>UOM</th>
        <th>Validity</th>
        <th>Modify</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql_data = "SELECT * FROM tbl_sea_charges ORDER BY `tbl_sea_charges`.`country_id` ASC";
      $rs_data = $conn->query($sql_data);

      if($rs_data->num_rows > 0){
        while($row_data= $rs_data->fetch_assoc()){
          $id=$row_data['sc_id'];

          $country_id = $row_data['country_id'];
          $city_id = $row_data['city_id'];
          $seaport_id = $row_data['seaport_id'];

          $country_dest_id = $row_data['country_id_dest'];
          $city_dest_id = $row_data['city_id_dest'];
          $seaport_dest_id = $row_data['seaport_id_dest'];

          $uom = $row_data['sc_uom'];
          $currency = $row_data['sc_currency'];
          $v_id=$row_data['vn_id'];

          $tocontainer = $row_data['sc_toc'];
          $service = $row_data['sc_tos'];

          $scrid = $row_data['sc_cr_id'];
          $ctpye_id = $row_data['cargo_type'];

      ?>
      <tr>
        <td><?= getDataBack($conn,'cities','city_id',$city_id,'name'); ?></td>
        <td><?= getDataBack($conn,'tbl_sea_port','sp_id',$seaport_id,'sp_name'); ?></td>

        <td><?= getDataBack($conn,'cities','city_id',$city_dest_id,'name'); ?></td>
        <td><?= getDataBack($conn,'tbl_sea_port','sp_id',$seaport_dest_id,'sp_name'); ?></td>

        <td><?= getDataBack($conn,'tbl_sea_vendors','sv_id',$v_id,'sv_name'); ?></td>
        <td><?= getService($service) ?></td>
        <td><?= getDataBack($conn,'tbl_container','cr_id',$tocontainer,'cr_name'); ?></td>
        <td><?= getDataBack($conn,'tbl_sea_carrier','sc_id',$scrid,'sc_name'); ?></td>
        <td> <?= $row_data['sc_desc'] ?> </td>
        <td> <?= $row_data['sc_min_weight'] ?> </td>
        <td> <?= $row_data['sc_max_weight'] ?> </td>
        <td> <?= $row_data['sc_min_cbm'] ?> </td>
        <td> <?= $row_data['sc_max_cbm'] ?> </td>
        <td> <?= $row_data['sc_charge_amount'] ?> </td>
        <td> <?= $row_data['sc_transit_days'] ?> </td>
        <td><?= getDataBack($conn,'tbl_cargo_type','ctype_id',$ctpye_id,'ctype'); ?></td>
        <td><?= getCurrency($currency) ?></td>
        <td><?= getUom($uom) ?></td>
        <td> <?= $row_data['sc_validity'] ?> </td>
        <td> <a class="btn btn-warning btn-sm" onclick="openEditSc(<?= $id ?>)">Edit</a> </td>
        <td> <a class="btn btn-danger btn-sm" onclick="deleteSc(<?= $id ?>)">Remove</a> </td>
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
