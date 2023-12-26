<?php include '../backend/conn.php'; ?>
<div class="table-responsive">
<table class="table" id="dataTable">
  <thead>
    <tr>
      <th>Origin City</th>
      <th>Origin Airport</th>
      <th>Destination City</th>
      <th>Destination Airport</th>
      <th>Vendor</th>
      <th>Airline</th>
      <th>Cargo Type</th>
      <th>Description</th>
      <th>Min Weight</th>
      <th>Max Weight</th>
      <th>Charge amount</th>
      <th>Currency</th>
      <th>UOM</th>
      <th>Transit Days</th>
      <th>Validity</th>
      <th>Edit</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql_data = "SELECT * FROM tbl_air_frieght ORDER BY `tbl_air_frieght`.`country_id` ASC";
    $rs_data = $conn->query($sql_data);

    if($rs_data->num_rows > 0){
      while($row_data= $rs_data->fetch_assoc()){
        $id=$row_data['af_id'];

        $country_id = $row_data['country_id'];
        $city_id = $row_data['city_id'];
        $airport_id = $row_data['airport_id'];

        $country_dest_id = $row_data['country_id_dest'];
        $city_dest_id = $row_data['city_id_dest'];
        $airport_dest_id = $row_data['airport_id_dest'];

        $uom = $row_data['af_uom'];
        $currency = $row_data['af_currency'];
        $v_id=$row_data['vn_id'];
        $a_id=$row_data['al_id'];

        $ctpye_id = $row_data['ctype_id'];
    ?>
    <tr>
      <td><?= getDataBack($conn,'cities','city_id',$city_id,'name'); ?></td>
      <td><?= getDataBack($conn,'airports','airport_id',$airport_id,'code'); ?></td>
      <td><?= getDataBack($conn,'cities','city_id',$city_dest_id,'name'); ?></td>
      <td><?= getDataBack($conn,'airports','airport_id',$airport_dest_id,'code'); ?></td>


      <td><?= getDataBack($conn,'tbl_air_vendor','av_id',$v_id,'av_name'); ?></td>
      <td><?= getDataBack($conn,'tbl_airlines','al_id',$a_id,'air_line_name'); ?></td>
      <td><?= getDataBack($conn,'tbl_cargo_type','ctype_id',$ctpye_id,'ctype'); ?></td>
      <td> <?= $row_data['af_description'] ?> </td>
      <td> <?= $row_data['af_min_weight'] ?> </td>
      <td> <?= $row_data['af_max_weight'] ?> </td>
      <td> <?= $row_data['af_charge'] ?> </td>
      <td><?= getCurrency($currency) ?></td>
      <td><?= getUom($uom) ?></td>
      <td><?= $row_data['transit_days'] ?> </td>
      <td> <?= $row_data['af_validity'] ?> </td>
      <td>
        <a href="#" class="btn btn-warning btn-sm" onclick="openEditAirChargeModal(<?= $id ?>)"> Edit </a>
      </td>
      <td> <a class="btn btn-danger btn-sm" onclick="deleteAc(<?= $id ?>)">Remove</a> </td>
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
