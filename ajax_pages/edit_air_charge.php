<?php include '../backend/conn.php'; ?>
<?php
  $id = $_REQUEST['a_id'];
  $sql ="SELECT * FROM tbl_air_frieght WHERE af_id = '$id'";
  $rs = $conn->query($sql);
  if($rs->num_rows > 0){
    $row = $rs->fetch_assoc();
  }
 ?>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
              <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="">Origin Countries</label>
                      <select class="js-states form-control" id="countries_edit" class="countries" onchange="selectCity_edit(this.value)">
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
                      <label for="">Origin City</label>
                      <select class="form-control" id="city_edit" class="city_edit" onclick="selectAirport_edit(this.value)">

                      </select>
                    </div>
                    <div class="form-group">
                      <label for="">Origin Airport</label>
                      <select class="js-states form-control" id="airport_edit" class="airport">

                      </select>
                    </div>
                    <div class="form-group">
                      <label for="">Min Weight</label>
                      <input type="text" class="form-control" id="min_weight_edit" name="" value="<?= $row['af_min_weight'] ?>">
                    </div>
                    <div class="form-group">
					<label for="">Transit</label>
						<select class="form-control" id="transit">
							<option value="1">Direct</option>
							<option value="2">Transit</option>
						</select>
					</div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" class="form-control" id="desc_edit" placeholder="Description" name="description" value="<?= $row['af_description'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="">Currency</label>
                        <select class="form-control" name="" id="currency_edit">
                          <option value="1" <?php if($row['af_currency'] == 1){ echo "selected"; } ?>>AED</option>
                          <option value="2" <?php if($row['af_currency'] == 2){ echo "selected"; } ?>>USD</option>
                          <option value="3" <?php if($row['af_currency'] == 3){ echo "selected"; } ?>>SAR</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="">Cargo type</label>
                      <select class="js-states form-control" id="CargoType_edit">
                        <option value="">Select</option>
                        <?php
                          $sql = "SELECT * FROM `tbl_cargo_type`";
                          $rs= $conn->query($sql);
                          if($rs->num_rows > 0){
                            while($row_c = $rs->fetch_assoc()){
                         ?>
                         <option value="<?= $row_c['ctype_id'] ?>" <?php if($row['ctype_id'] == $row_c['ctype_id']){ echo "selected"; } ?>><?= $row_c['ctype'] ?></option>
                       <?php } } ?>
                      </select>
                    </div>

                    <div class="form-group">
                        <label for="">Transit Days</label>
                        <input type="text" class="form-control" id="tr_days_edit" placeholder="ex:1" name="tr_days" value="<?= $row['transit_days'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="">Aed</label>
                        <input type="number" class="form-control" id="aed_edit" placeholder="Aed" name="aed" value="<?= $row['af_charge'] ?>" required>
                    </div>

                    <button type="button" class="btn btn-primary btn-me2" onclick="editAfCharge(<?= $id ?>)" name="button">Edit</button>
                    <br><br>
                  </div>
                  <div class="col-6">

                    <div class="form-group">
                      <label for="">Destination Countries</label>
                      <select class="js-states form-control" id="countries_dest_edit" onchange="selectCityDest_edit(this.value)">
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
                      <label for="">Destination City</label>
                      <select class="form-control" id="city_dest_edit" onclick="selectAirportDest_edit(this.value)">

                      </select>
                    </div>
                    <div class="form-group">
                      <label for="">Destination Airport</label>
                      <select class="js-states form-control" id="airport_dest_edit">

                      </select>
                    </div>
                    <div class="form-group">
                        <label for="">UOM (Unit of Measure)</label>
                        <select class="form-control" name="" id="uom_edit">
                          <option value="1" <?php if($row['af_uom'] == 1){ echo "selected"; } ?>>Per Shipment</option>
                          <option value="2" <?php if($row['af_uom'] == 2){ echo "selected"; } ?>>Per Kg</option>
                          <option value="3" <?php if($row['af_uom'] == 3){ echo "selected"; } ?>>Per Label</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="">Max Weight</label>
                      <input type="text" class="form-control" id="max_weight_edit" name="" value="<?= $row['af_max_weight'] ?>">
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
                           <option value="<?= $row_c['av_id'] ?>" <?php if($row['vn_id'] == $row_c['av_id']){ echo "selected"; } ?>><?= $row_c['av_name'] ?></option>
                         <?php } } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Airline</label>
                        <select class="form-control" id="airline_edit">
                          <option value="">Select</option>
                          <?php
                            $sql = "SELECT * FROM `tbl_airlines`";
                            $rs= $conn->query($sql);
                            if($rs->num_rows > 0){
                              while($row_c = $rs->fetch_assoc()){
                           ?>
                           <option value="<?= $row_c['al_id'] ?>" <?php if($row['al_id'] == $row_c['al_id']){ echo "selected"; } ?>><?= $row_c['air_line_name'] ?></option>
                         <?php } } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">VALIDITY</label>
                        <input type="date" class="form-control" id="validity_edit" placeholder="VALIDITY" name="validity" value="<?= $row['af_validity'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="">Other Charges</label>
                        <input type="checkbox"  id="ocharge_edit" value="1" <?php if($row['other_charge'] == 1){ echo "checked"; } ?> required>
                    </div>
                  <br><br>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
