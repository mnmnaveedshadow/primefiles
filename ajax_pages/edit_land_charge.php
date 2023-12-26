<?php
  include '../backend/conn.php';
  $id = $_REQUEST['l_id'];

  $sql_data = "SELECT * FROM tbl_land_charge WHERE lc_id ='$id'";
  $rs_data = $conn->query($sql_data);

  if($rs_data->num_rows > 0){
    $row_data= $rs_data->fetch_assoc();

    $country_id = $row_data['country_id'];
    $city_id = $row_data['city_id'];
    $border_id = $row_data['border_id'];

    $country_dest_id = $row_data['country_id_dest'];
    $city_dest_id = $row_data['city_id_dest'];
    $border_id_dest = $row_data['border_id_dest'];

    $uom = $row_data['oum'];
    $currency = $row_data['currency'];

    $service = $row_data['type_of_s'];
  }

 ?>
 <input type="hidden" name="" id="lid" value="<?= $id ?>">
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
              <select class="form-control" id="cityEdit" onclick="selectBorderOrginEdit(this.value)">

              </select>
            </div>
            <div class="form-group">
              <label for="">Origin Border</label>
              <select class="js-states form-control" id="border_orginEdit">

              </select>
            </div>
            <div class="form-group">
              <label for="">Type Of Service</label>
              <select class="form-control" id="typeOfServiceEdit" name="">
                <option value="1" <?php if($service == 1){ echo "selected"; } ?>>FTL</option>
                  <option value="2" <?php if($service == 2){ echo "selected"; } ?>>LTL</option>
              </select>
            </div>

            <div class="form-group">
              <label for="">Transit Days</label>
              <input type="text" class="form-control" id="transitEdit" name="" value="<?= $row_data['transit'] ?>">
            </div>
            <div class="form-group">
              <label for="">Min Weight</label>
              <input type="text" class="form-control" id="min_weightEdit" name="" value="<?= $row_data['min_weight'] ?>">
            </div>
            <div class="form-group">
              <label for="">Min CBM</label>
              <input type="text" class="form-control" id="min_cbmEdit" name="" value="<?= $row_data['min_cbm'] ?>">
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <input type="text" class="form-control" id="descEdit" placeholder="Description" name="description" value="<?= $row_data['lc_desc'] ?>" required>
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
                <label for="">Charge Amount</label>
                <input type="number" class="form-control" id="aedEdit" placeholder="20" name="aed" value="<?= $row_data['rate'] ?>" required>
            </div>

            <button type="button" class="btn btn-primary btn-me2" onclick="editlfCharge()" name="button">Add</button>
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
              <select class="form-control" id="dest_cityEdit" onclick="selectBorderDestiEdit(this.value)">

              </select>
            </div>
            <div class="form-group">
              <label for="">Destination Land Border</label>
              <select class="js-states form-control" id="border_destiEdit">

              </select>
            </div>
            <div class="form-group">
                <label for="">UOM (Unit of Measure)</label>
                <select class="form-control" name="" id="uomEdit">
                  <option value="1" <?php if($uom == 1){ echo "selected"; } ?>>Per Shipment</option>
                  <option value="2" <?php if($uom == 2){ echo "selected"; } ?>>Per Kg</option>
                  <option value="7" <?php if($uom == 7){ echo "selected"; } ?>>Per Truck</option>
                </select>
            </div>
            <div class="form-group">
              <label for="">Max Weight</label>
              <input type="text" class="form-control" id="max_weightEdit" name="" value="<?= $row_data['max_weight'] ?>">
            </div>
            <div class="form-group">
              <label for="">Max CBM</label>
              <input type="text" class="form-control" id="max_cbmEdit" name="" value="<?= $row_data['max_cbm'] ?>">
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
                <option value="<?= $row['rv_name'] ?>" <?php if($row_data['vn_id'] == $row['rv_name']){ echo "selected"; } ?>><?= $row['rv_name'] ?></option>
                                                  <?php } } ?>
              </select>
          </div>
            <div class="form-group">
                <label for="">VALIDITY</label>
                <input type="date" class="form-control" id="validityEdit" placeholder="VALIDITY" name="validity" value="<?= $row_data['validity'] ?>" required>
            </div>
          <br><br>
          </div>
        </div>
    </div>
</div>
