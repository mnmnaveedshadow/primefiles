<?php include '../backend/conn.php'; ?>
<?php
$id = $_REQUEST['ld_id'];
$sql = "SELECT * FROM `tbl_road_destination_charge` WHERE rdc_id = '$id'";

$rs = $conn->query($sql);
if($rs->num_rows >0){

    $row = $rs->fetch_assoc();

    $id  = $row['rdc_id'];
    $country_id = $row['country_id'];
    $city_id = $row['city_id'];
    $border_id = $row['border_id'];

    $uom = $row['uom'];
    $currency = $row['currency'];
    $service = $row['rdc_tos'];
}

     ?>
     <input type="hidden" id="ld_id" name="" value="<?= $id ?>">
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
  <select class="form-control" id="cityEdit" onclick="selectBorderEdit(this.value)">

  </select>
</div>
<div class="form-group">
  <label for="">Border</label>
  <select class="js-states form-control" id="border_orgiEdit">

  </select>
</div>
<div class="form-group">
    <label for="">Description</label>
    <input type="text" class="form-control" id="descEdit" placeholder="Description" name="description" value="<?= $row['rdc_desc'] ?>" required>
</div>
<div class="form-group">
    <label for="">UOM (Unit of Measure)</label>
    <select class="form-control" name="" id="uomEdit">
      <option value="1" <?php if($uom == 1){ echo "selected"; } ?>>Per Shipment</option>
      <option value="2" <?php if($uom == 2){ echo "selected"; } ?>>Per Kg</option>
      <option value="3" <?php if($uom == 3){ echo "selected"; } ?>>Per Label</option>
    </select>
</div>
<div class="form-group">
																<label for="">Vendor</label>
																<select class="form-control" id="vendorEdit">
                                                                    <?php
                                                                        $sql = "SELECT * FROM tbl_road_vendors";
                                                                        $rs =$conn->query($sql);
                                                                        if($rs->num_rows > 0){
                                                                            while($row = $rs->fetch_assoc()){
                                                                    ?>
													        <option value="<?= $row['rv_name'] ?>"><?= $row['rv_name'] ?></option>
                                                                    <?php } } ?>
													      </select>
														</div>
<div class="form-group">
  <label for="">Type Of Service</label>
  <select class="form-control" id="typeOfServiceEdit" name="">
    <option value="1" <?php if($service == 1){ echo "selected"; } ?>>FTL</option>
      <option value="2" <?php if($service == 1){ echo "selected"; } ?>>LTL</option>
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
    <input type="number" class="form-control" id="aedEdit" placeholder="Aed" name="aed" value="<?= $row['rdc_charge'] ?>" required>
</div>
<div class="form-group">
    <label for="">Min Aed</label>
    <input type="number" class="form-control" id="min_aedEdit" placeholder="Min Aed" name="min_aed" value="<?= $row['rdc_min'] ?>" required>
</div>
<div class="form-group">
    <label for="">VALIDITY</label>
    <input type="date" class="form-control" id="validityEdit" placeholder="VALIDITY" name="validity" value="<?= $row['rdc_validity'] ?>" required>
</div>
<button type="button" class="btn btn-primary btn-me2" onclick="editlfdCharge()" name="button">Edit</button>
<br><br>
