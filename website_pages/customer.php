<?php include '../backend/conn.php'; ?>
<div id="customer_info">
  <h4>Your Information</h4>
    <div class="row">
      <div class="col-lg-4">
        <div class="form-group">
          <label for="">Name</label>
          <input type="text" name="" id="customerName" class="form-control" value="">
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <label for="">Email</label>
          <input type="text" name="" id="email" class="form-control" value="">
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
                      <label for="">Company Name</label>
                      <input type="text" name="" id="companyName" class="form-control" value="">
                    </div>
      </div>
      <div class="col-lg-4">

                    <div class="form-group">
                      <label for="">Countries</label>
                      <select class="form-control js-example-basic-single select2" id="countries" onchange="selectCustomerState(this.value)">
                        <option value="">Select</option>
                        <?php
                          $sql = "SELECT * FROM `countries`";
                          $rs= $conn_loc->query($sql);
                          if($rs->num_rows > 0){
                            while($row_c = $rs->fetch_assoc()){
                         ?>
                         <option value="<?= $row_c['id'] ?>"><?= $row_c['name'] ?> - <?= $row_c['iso2'] ?></option>
                       <?php } } ?>
                      </select>
                    </div>
      </div>
      <div class="col-lg-4">

                    <div class="form-group">
                      <label for="">State</label>
                      <select class="form-control" id="state" onchange="selectCustomerCity(this.value)">
                      </select>
                    </div>

      </div>
      <div class="col-lg-4">

                    <div class="form-group">
                      <label for="">City</label>
                      <select class="form-control" id="city">
                      </select>
                    </div>

      </div>

      <div class="col-lg-4">
        <div class="form-group">
                      <label for="">Phone Number</label>
                      <input type="text" name="" id="phoneNumber" class="form-control" value="">
                    </div>
      </div>
      <div class="col-lg-4">

                    <div class="form-group">
                      <label for="">Address</label>
                      <input type="text" name="" class="form-control" id="address" value="">
                    </div>
      </div>

    </div>

    <button type="button" class="btn btn-primary" onclick="addOrUpdateCustomerInfo()"
     name="button">Next</button>
</div> <br>
