<?php include '../backend/conn.php'; ?>
<h5>Air Freight</h5>
<hr>
<div id="package_details">
	<img src="assets/img/icons/return1.svg" style="width:30px;cursor:pointer;" onclick="goBack(3)" alt="asd">
	<div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="">Cargo type</label>
                <select class="js-states form-control" id="CargoType">
                    <option value="">Select</option>
                <?php
                    $sql = "SELECT * FROM `tbl_cargo_type`";
                    $rs= $conn->query($sql);
                     if($rs->num_rows > 0){
                    while($row_c = $rs->fetch_assoc()){
                ?>
                    <option value="<?= $row_c['ctype_id'] ?>"><?= $row_c['ctype'] ?></option>
                <?php } } ?>
                </select>
             </div>
            </div>
        <div class="col-md-2">
				<div class="form-group">
						<label for="height">Commodity</label>
						<input type="text" id="com_type" class="form-control" name="" id="">
				</div>
		</div>
		<div class="col-md-2">
				<div class="form-group">
						<label for="height">Package Type</label>
						<select name="" id="p_type" class="form-control">
								<?php
									$sql = "SELECT * FROM tbl_package_type";
									$rs = $conn->query($sql);
									if($rs->num_rows > 0){
										while($row = $rs->fetch_assoc()){
								 ?>
								 <option value="<?= $row['pt_id'] ?>"><?= $row['pt_name'] ?></option>
							 <?php }} ?>
						</select>
				</div>
		</div>
		<div class="col-md-2">
				<div class="form-group">
						<label for="quantity">No of packages</label>
						<input type="number" id="p_qty" min="0" onkeyup="dontAllowMinus(this)" class="form-control" name="quantity">
				</div>
		</div>
    <div class="col-md-2">
				<div class="form-group">
						<label for="height">Unit Convertion</label>
						<select name="" id="u_conv" class="form-control">
                        <option value="CM">CM</option>
                            <option value="inch">Inches</option>
                            <option value="MM">MM</option>
														<option value="M">M</option>
                        </select>
				</div>
		</div>
		<div class="col-md-2">
				<div class="form-group">
						<label for="length">Length  </label>
						<input type="number" id="p_l" min="0" onkeyup="dontAllowMinus(this)" class="form-control" name="length">
				</div>
		</div>
		<div class="col-md-2">
				<div class="form-group">
						<label for="width">Width </label>
						<input type="number" id="p_w" min="0" onkeyup="dontAllowMinus(this)" class="form-control" name="width">
				</div>
		</div>
		<div class="col-md-2">
				<div class="form-group">
						<label for="height">Height </label>
						<input type="number" id="p_h" min="0" onkeyup="dontAllowMinus(this)" class="form-control" name="height">
				</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
					<label for="height">Unit</label>
					<select name="" id="u_conv_kl" class="form-control">
													<option value="kg">KG</option>
													<option value="lbs">LBS</option>
											</select>
			</div>
</div>
		<div class="col-md-2">
				<div class="form-group">
						<label for="weight">Weight</label>
						<input type="number" id="p_we" min="0" onkeyup="dontAllowMinus(this)" class="form-control" name="weight">
				</div>
		</div>
</div>
<button type="button" id="add-package" onclick="add_package_detailsDesk()" class="btn btn-primary">Add Package</button> <br><br>

		<div class="col-12" id="show_packages">

		</div> <br><br>

</div>
<script type="text/javascript">
	$('#show_packages').load('ajax_pages/show_packages_table.php');
</script>
