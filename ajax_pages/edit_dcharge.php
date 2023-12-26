<?php include '../backend/conn.php'; ?>

<?php
$a_dc_id = $_REQUEST['a_dc_id'];
$sql = "SELECT * FROM `tbl_air_dest_charge` WHERE adc_id='$a_dc_id'";

$rs = $conn->query($sql);
if($rs->num_rows >0){
  $row = $rs->fetch_assoc();
    $id  = $row['adc_id'];
    $country_id = $row['country_id'];
    $city_id = $row['city_id'];
    $airport_id = $row['airport_id'];

    $uom = $row['adc_uom'];
    $currency = $row['adc_currency'];
    $v_id=$row['adc_vendor'];

  }
  else {
    exit();
  }

   ?>
<input type="hidden" id="adc_id" name="" value="<?= $a_dc_id ?>">
<div class="form-group">
  <label for="">Countries</label>
  <select class="js-states form-control" id="countries_edit" onchange="selectCityEdit(this.value)">
    <option value="">Select</option>
    <?php
      $sql = "SELECT * FROM `countries` ORDER BY `countries`.`name` ASC";
      $rs= $conn->query($sql);
      if($rs->num_rows > 0){
        while($row_c = $rs->fetch_assoc()){
     ?>
     <option value="<?= $row_c['country_id'] ?>" ><?= $row_c['name'] ?></option>
   <?php } } ?>
  </select>
</div>
<div class="form-group">
  <label for="">City</label>
  <select class="form-control" id="city_edit" onchange="selectAirportEdit(this.value)">

  </select>
</div>
<div class="form-group">
  <label for="">Airport</label>
  <select class="js-states form-control" id="airport_edit">

  </select>
</div>
<div class="form-group">
    <label for="">Description</label>
    <input type="text" class="form-control" id="desc_edit"  placeholder="Description" name="description" value="<?= $row['adc_description'] ?>" required>
</div>
<div class="form-group">
    <label for="">UOM (Unit of Measure)</label>
    <select class="form-control" name="" id="uom_edit">
      <option value="1" <?php if($uom == 1){ echo "selected"; } ?>>Per Shipment</option>
      <option value="2" <?php if($uom == 2){ echo "selected"; } ?>>Per Kg</option>
      <option value="3" <?php if($uom == 3){ echo "selected"; } ?>>Per Label</option>
    </select>
</div>
<div class="form-group">
    <label for="">Vendor</label>
    <select class="form-control" id="vendor_edit">
      <option value="">Select</option>
      <?php
        $sql = "SELECT * FROM `tbl_air_vendor`";
        $rs= $conn->query($sql);
        if($rs->num_rows > 0){
          while($row_c = $rs->fetch_assoc()){
       ?>
       <option value="<?= $row_c['av_id'] ?>" <?php if($v_id == $row_c['av_id']){ echo "selected"; } ?>><?= $row_c['av_name'] ?></option>
     <?php } } ?>
    </select>
</div>
<div class="form-group">
    <label for="">Currency</label>
    <select class="form-control" name="" id="currency_edit">
      <option value="1" <?php if($currency == 1){ echo "selected"; } ?>>AED</option>
      <option value="2" <?php if($currency == 2){ echo "selected"; } ?>>USD</option>
      <option value="3" <?php if($currency == 3){ echo "selected"; } ?>>SAR</option>
    </select>
</div>
<div class="form-group">
    <label for="">Aed</label>
    <input type="number" class="form-control" id="aed_edit" placeholder="Aed" name="aed" value="<?= $row['adc_charge'] ?>" required>
</div>
<div class="form-group">
    <label for="">Min Aed</label>
    <input type="number" class="form-control" id="min_aed_edit" placeholder="Min Aed" name="min_aed" value="<?= $row['adc_min'] ?>" required>
</div>
<div class="form-group">
    <label for="">VALIDITY</label>
    <input type="date" class="form-control" id="validity_edit" placeholder="VALIDITY" name="validity" value="<?= $row['adc_validity'] ?>" required>
</div>
<button type="button" class="btn btn-primary btn-me2" onclick="updateDcharge()" name="button">Update</button>
<br><br>
