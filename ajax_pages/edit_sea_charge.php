<?php include '../backend/conn.php'; ?>

<?php
$id = $_REQUEST['id'];
$sql_data = "SELECT * FROM tbl_sea_charges WHERE sc_id='$id'";
$rs_data = $conn->query($sql_data);

if($rs_data->num_rows > 0){
  $row_data= $rs_data->fetch_assoc();
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
  }
  else {
    header('location:../404.php');
    exit();
  }

?>
<input type="hidden" id="sea_id" name="" value="<?= $id ?>">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
              <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="">Origin Countries</label>
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
                      <label for="">Origin City</label>
                      <select class="form-control" id="cityEdit" onclick="selectSeaportOrgiEdit(this.value)">

                      </select>
                    </div>
                    <div class="form-group">
                      <label for="">Origin Seaport</label>
                      <select class="js-states form-control" id="orgin_seaportEdit">

                      </select>
                    </div>
                    <div class="form-group">
                      <label for="">Type Of Service</label>
                      <select class="form-control" id="typeOfServiceEdit" name="">
                        <option value="1" <?php if($service == 1){ echo "selected"; } ?> >FCL</option>
                          <option value="2" <?php if($service == 2){ echo "selected"; } ?>>LCL</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="">Transit</label>
                      <select class="form-control" id="transitEdit">
                        <option value="1">Direct</option>
                        <option value="2">Transit</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="">Min Weight</label>
                      <input type="text" class="form-control" id="min_weightEdit" name="" value="<?= $row_data['sc_min_weight'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="">Min CBM</label>
                      <input type="text" class="form-control" id="min_cbmEdit" name="" value="<?= $row_data['sc_min_cbm'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" class="form-control" id="descEdit" placeholder="Description" name="description" value="<?= $row_data['sc_desc'] ?>" required>
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
                        <label for="">Transit Days</label>
                        <input type="number" class="form-control" id="tr_daysEdit" min="1" placeholder="ex:10,20" name="tr_days" value="<?= $row_data['sc_transit_days'] ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="">Cargo type</label>
                      <select class="js-states form-control" id="CargoTypeEdit">
                        <option value="">Select</option>
                        <?php
                          $sql = "SELECT * FROM `tbl_cargo_type`";
                          $rs= $conn->query($sql);
                          if($rs->num_rows > 0){
                            while($row_c = $rs->fetch_assoc()){
                         ?>
                         <option value="<?= $row_c['ctype_id'] ?>" <?php if($row_c['ctype_id'] == $row_data['cargo_type']){ echo "selected"; } ?>><?= $row_c['ctype'] ?></option>
                       <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="">Charge Amount</label>
                        <input type="number" class="form-control" id="aedEdit" min="1" placeholder="" name="aed" value="<?= $row_data['sc_charge_amount'] ?>" required>
                    </div>

                    <button type="button" class="btn btn-primary btn-me2" onclick="editSeaCharge()" name="button">Edit</button>
                    <br><br>
                  </div>
                  <div class="col-6">

                    <div class="form-group">
                      <label for="">Destination Countries</label>
                      <select class="js-states form-control" id="dest_countriesEdit" onchange="selectCityDestEdit(this.value)">
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
                      <label for="">Destination City</label>
                      <select class="form-control" id="dest_cityEdit" onclick="selectSeaportDestiEdit(this.value)">

                      </select>
                    </div>
                    <div class="form-group">
                      <label for="">Destination Seaport</label>
                      <select class="js-states form-control" id="destination_seaportEdit">

                      </select>
                    </div>
                    <div class="form-group">
                      <label for="">Containers</label>
                      <select class="js-states form-control" id="container_idEdit">
                        <option value="">Select</option>
                        <?php
                          $sql = "SELECT * FROM `tbl_container`";
                          $rs= $conn->query($sql);
                          if($rs->num_rows > 0){
                            while($row_c = $rs->fetch_assoc()){
                         ?>
                         <option value="<?= $row_c['cr_id'] ?>" <?php if($tocontainer == $row_c['cr_id']){ echo "selected"; } ?>><?= $row_c['cr_name'] ?></option>
                       <?php } } ?>
                      </select>
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
                      <label for="">Max Weight</label>
                      <input type="text" class="form-control" id="max_weightEdit" name="" value="<?= $row_data['sc_max_weight'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="">Max CBM</label>
                      <input type="text" class="form-control" id="max_cbmEdit" name="" value="<?= $row_data['sc_max_cbm'] ?>">
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
                           <option value="<?= $row_c['sv_id'] ?>" <?php if($v_id == $row_c['sv_id']){ echo "selected"; } ?>><?= $row_c['sv_name'] ?></option>
                         <?php } } ?>
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="">Carrier</label>
                      <select class="js-states form-control" id="carrierEdit">
                        <option value="">Select</option>
                        <?php
                          $sql = "SELECT * FROM `tbl_sea_carrier`";
                          $rs= $conn->query($sql);
                          if($rs->num_rows > 0){
                            while($row_c = $rs->fetch_assoc()){
                         ?>
                         <option value="<?= $row_c['sc_id'] ?>" <?php if($scrid == $row_c['sc_id']){ echo "selected"; } ?>><?= $row_c['sc_name'] ?></option>
                       <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="">VALIDITY</label>
                        <input type="date" class="form-control" id="validityEdit" placeholder="VALIDITY" name="validity" value="<?= $row_data['sc_validity'] ?>" required>
                    </div>
                  <br><br>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
