<?php include '../backend/conn.php'; ?>

<?php
$s_oc_id = $_REQUEST['s_oc_id'];
$sql = "SELECT * FROM `tbl_sea_orgin_charge` WHERE soc_id='$s_oc_id'";

$rs = $conn->query($sql);
if($rs->num_rows >0){
  $row = $rs->fetch_assoc();
    $id  = $row['soc_id'];
    $country_id = $row['country_id'];
    $city_id = $row['city_id'];
    $sp_id = $row['sp_id'];

    $uom = $row['soc_uom'];
    $currency = $row['soc_currency'];
    $v_id=$row['soc_vendor'];

    $service = $row['soc_tos'];
    $tocontainer = $row['soc_toc'];

  }
  else {
    exit();
  }

   ?>
<input type="hidden" id="soc_id" name="" value="<?= $s_oc_id ?>">
<div class="form-group">
  <label for="">Countries</label>
  <select class="js-states form-control" id="countriesEdit" onchange="selectCityEdit(this.value)">
    <option value="">Select</option>
    <?php
      $sql = "SELECT * FROM `countries` ORDER BY `countries`.`name` ASC";
      $rs= $conn->query($sql);
      if($rs->num_rows > 0){
        while($row_c = $rs->fetch_assoc()){
     ?>
     <option value="<?= $row_c['country_id'] ?>"><?= $row_c['name'] ?></option>
   <?php } } ?>
  </select>
</div>
<div class="form-group">
  <label for="">City</label>
  <select class="form-control" id="cityEdit" onclick="selectSeaportEdit(this.value)">

  </select>
</div>
<div class="form-group">
  <label for="">Seaport</label>
  <select class="js-states form-control" id="seaportEdit">

  </select>
</div>
<div class="form-group">
  <label for="">Type Of Service</label>
  <select class="form-control" id="typeOfServiceEdit" name="">
    <option value="1" <?php if($service == 1){ echo "selected"; } ?>>FCL</option>
      <option value="2" <?php if($service == 2){ echo "selected"; } ?>>LCL</option>
  </select>
</div>
<div class="form-group">
  <label for="">Containers</label>
  <select class="js-states form-control" id="containerEdit">
    <option value="">Select</option>
    <?php
      $sql = "SELECT * FROM `tbl_container`";
      $rs= $conn->query($sql);
      if($rs->num_rows > 0){
        while($row_c = $rs->fetch_assoc()){
     ?>
     <option value="<?= $row_c['cr_id'] ?>" <?php if($row_c['cr_id'] == $tocontainer){ echo "selected"; } ?>><?= $row_c['cr_name'] ?></option>
   <?php } } ?>
  </select>
</div>
<div class="form-group">
    <label for="">Description</label>
    <input type="text" class="form-control"
     id="descEdit" placeholder="Description" name="description" value="<?= $row['soc_desc'] ?>" required>
</div>
<div class="form-group">
  <label for="">UOM (Unit of Measure)</label>
  <select class="form-control" name="" id="uomEdit">
    <option value="1" <?php if($uom == 1){ echo "selected"; } ?>>Per Shipment</option>
    <option value="6" <?php if($uom == 6){ echo "selected"; } ?>>Per Container</option>
    <option value="4" <?php if($uom == 4){ echo "selected"; } ?>>Per B/L</option>
    <option value="5" <?php if($uom == 5){ echo "selected"; } ?>>Per W/M</option>
  </select>
</div>
<div class="form-group">
	<label for="">Vendor</label>
		<select class="form-control" id="vendorEdit">
			<option value="">Select</option>
				<?php
					$sql = "SELECT * FROM `tbl_sea_vendors`";
					$rs= $conn->query($sql);
					if($rs->num_rows > 0){
						while($row_c = $rs->fetch_assoc()){
				?>
					<option value="<?= $row_c['sv_name'] ?>"><?= $row_c['sv_name'] ?></option>
				<?php } } ?>
		</select>
</div>
<div class="form-group">
    <label for="">Currency</label>
    <select class="form-control" name="" id="currencyEdit">
      <option value="1" <?php if($currency == 1){ echo "selected"; } ?>>AED</option>
      <option value="2" <?php if($currency == 2){ echo "selected"; } ?>>USD</option>
      <option value="3" <?php if($currency == 3){ echo "selected"; } ?>>SAR</option>
    </select>
</div>
<div class="form-group">
    <label for="">Aed</label>
    <input type="number" class="form-control" id="aedEdit" placeholder="Aed" name="aed" value="<?= $row['soc_charge'] ?>" required>
</div>
<div class="form-group">
    <label for="">Min Aed</label>
    <input type="number" class="form-control" id="min_aedEdit" placeholder="Min Aed" name="min_aed" value="<?= $row['soc_min'] ?>" required>
</div>
<div class="form-group">
  <label for="">Remark</label>
  <input type="text" class="form-control" id="remarkEdit" placeholder="" value="<?= $row['soc_remark'] ?>" required>
</div>
<div class="form-group">
    <label for="">VALIDITY</label>
    <input type="date" class="form-control" id="validityEdit" placeholder="VALIDITY" name="validity" value="<?= $row['soc_validity'] ?>" required>
</div>
<button type="button" class="btn btn-warning btn-me2" onclick="editSfoCharge()" name="button">Edit</button>
<br><br>
