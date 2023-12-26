

			<!-- Header -->
			<?php include './layouts/header.php'; ?>
			<!-- Header -->

           <!-- Sidebar -->
			<?php include './layouts/sidebar.php'; ?>
			<!-- /Sidebar -->
			<?php
			if ($u_level != 1 && $u_level != 2) {
			    header('location:index.php');
			    $_SESSION['invalid_access'] = true;
			    exit();
			}
			 ?>
			<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="page-title">
							<h4>Sea Freight Charges</h4>
						</div>
					</div>
					<!-- /add -->

					<div class="card">
					    <div class="card-body">
					        <div class="row">
					            <div class="col-12">
												<div class="row">
												    <div class="col-6">
															<div class="form-group">
													      <label for="">Origin Countries</label>
													      <select class="js-states form-control" id="countries" onchange="selectCity(this.value)">
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
													      <select class="form-control" id="city" onclick="selectSeaportOrgi(this.value)">

													      </select>
													    </div>
															<div class="form-group">
													      <label for="">Origin Seaport</label>
													      <select class="js-states form-control" id="orgin_seaport">

													      </select>
													    </div>
															<div class="form-group">
																<label for="">Type Of Service</label>
																<select class="form-control" id="typeOfService" name="">
																	<option value="1">FCL</option>
																		<option value="2">LCL</option>
																</select>
															</div>
															<div class="form-group">
																<label for="">Transit</label>
													      <select class="form-control" id="transit">
													        <option value="1">Direct</option>
																	<option value="2">Transit</option>
													      </select>
															</div>
															<div class="form-group">
																<label for="">Min Weight</label>
																<input type="text" class="form-control" id="min_weight" name="" value="">
															</div>
															<div class="form-group">
																<label for="">Min CBM</label>
																<input type="text" class="form-control" id="min_cbm" name="" value="">
															</div>
													    <div class="form-group">
													        <label for="">Description</label>
													        <input type="text" class="form-control" id="desc" placeholder="Description" name="description" value="" required>
													    </div>

															<div class="form-group">
																	<label for="">Currency</label>
																	<select class="form-control" name="" id="currency">
																		<option value="1">AED</option>
																		<option value="2">USD</option>
																		<option value="3">SAR</option>
																	</select>
															</div>
															<div class="form-group">
																	<label for="">Transit Days</label>
																	<input type="number" class="form-control" id="tr_days" min="1" placeholder="ex:10,20" name="tr_days" value="" required>
															</div>
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
													    <div class="form-group">
													        <label for="">Charge Amount</label>
													        <input type="number" class="form-control" id="aed" min="1" placeholder="" name="aed" value="" required>
													    </div>

													    <button type="button" class="btn btn-primary btn-me2" onclick="addsfCharge()" name="button">Add</button>
															<br><br>
												    </div>
														<div class="col-6">

															<div class="form-group">
													      <label for="">Destination Countries</label>
													      <select class="js-states form-control" id="dest_countries" onchange="selectCityDest(this.value)">
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
													      <select class="form-control" id="dest_city" onclick="selectSeaportDesti(this.value)">

													      </select>
													    </div>
															<div class="form-group">
													      <label for="">Destination Seaport</label>
													      <select class="js-states form-control" id="destination_seaport">

													      </select>
													    </div>
															<div class="form-group">
																<label for="">Containers</label>
																<select class="js-states form-control" id="container_id">
																	<option value="">Select</option>
																	<?php
																		$sql = "SELECT * FROM `tbl_container`";
																		$rs= $conn->query($sql);
																		if($rs->num_rows > 0){
																			while($row_c = $rs->fetch_assoc()){
																	 ?>
																	 <option value="<?= $row_c['cr_id'] ?>"><?= $row_c['cr_name'] ?></option>
																 <?php } } ?>
																</select>
															</div>
													    <div class="form-group">
																<label for="">UOM (Unit of Measure)</label>
												        <select class="form-control" name="" id="uom">
												          <option value="1">Per Shipment</option>
																	<option value="6">Per Container</option>
												          <option value="4">Per B/L</option>
												          <option value="5">Per W/M</option>
												        </select>
													    </div>
															<div class="form-group">
																<label for="">Max Weight</label>
																<input type="text" class="form-control" id="max_weight" name="" value="">
															</div>
															<div class="form-group">
																<label for="">Max CBM</label>
																<input type="text" class="form-control" id="max_cbm" name="" value="">
															</div>
															<div class="form-group">
																	<label for="">Vendor</label>
																	<select class="form-control" id="vendor">
														        <option value="">Select</option>
														        <?php
														          $sql = "SELECT * FROM `tbl_sea_vendors`";
														          $rs= $conn->query($sql);
														          if($rs->num_rows > 0){
														            while($row_c = $rs->fetch_assoc()){
														         ?>
														         <option value="<?= $row_c['sv_id'] ?>"><?= $row_c['sv_name'] ?></option>
														       <?php } } ?>
														      </select>
															</div>
															<div class="form-group">
																<label for="">Carrier</label>
																<select class="js-states form-control" id="carrier">
																	<option value="">Select</option>
																	<?php
																		$sql = "SELECT * FROM `tbl_sea_carrier`";
																		$rs= $conn->query($sql);
																		if($rs->num_rows > 0){
																			while($row_c = $rs->fetch_assoc()){
																	 ?>
																	 <option value="<?= $row_c['sc_id'] ?>"><?= $row_c['sc_name'] ?></option>
																 <?php } } ?>
																</select>
															</div>
													    <div class="form-group">
													        <label for="">VALIDITY</label>
													        <input type="date" class="form-control" id="validity" placeholder="VALIDITY" name="validity" value="" required>
													    </div>
						                <br><br>
														</div>
													</div>
					            </div>
					            <div class="col-12" id="show_sf_charge">

					            </div>
					        </div>
					    </div>
					</div>


					<!-- /add -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

				<div class="modal fade" id="edit_s" tabindex="-1" aria-labelledby="edit_s" aria-hidden="true">
						<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
								<div class="modal-content">
										<div class="modal-header">
												<h5 class="modal-title">Edit Sea Freight Origin Charge</h5>
												<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
												</button>
										</div>
										<div class="modal-body" id="edit_sea_charge">

										</div>
								</div>
						</div>
				</div>

    <?php include './layouts/footer.php' ?>
		<script type="text/javascript">

		$('#show_sf_charge').load('ajax_pages/sf_charge_table.php');

		function openEditSc(sc_id){
			$('#edit_s').modal('show');
			$('#edit_sea_charge').load('ajax_pages/edit_sea_charge.php',{
				id:sc_id
			});
		}

		function editSeaCharge(){
			var sea_id = document.getElementById('sea_id').value;
			var countries = document.getElementById('countriesEdit').value;
			var city = document.getElementById('cityEdit').value;
			var orgin_seaport = document.getElementById('orgin_seaportEdit').value;

			var countries_dest = document.getElementById('dest_countriesEdit').value;
			var city_dest = document.getElementById('dest_cityEdit').value;
			var destination_seaport = document.getElementById('destination_seaportEdit').value;

			var transit = document.getElementById('transitEdit').value;

			var min_weight = document.getElementById('min_weightEdit').value;
			var max_weight = document.getElementById('max_weightEdit').value;

			var min_cbm = document.getElementById('min_cbmEdit').value;
			var max_cbm = document.getElementById('max_cbmEdit').value;

			var toservice = document.getElementById('typeOfServiceEdit').value;
			var tocontainer = document.getElementById('container_idEdit').value;

			var desc = document.getElementById('descEdit').value;
			var uom = document.getElementById('uomEdit').value;
			var aed = document.getElementById('aedEdit').value;
			var currency =document.getElementById('currencyEdit').value;
			var vendor = document.getElementById('vendorEdit').value;
			var validity = document.getElementById('validityEdit').value;

			var tr_days = document.getElementById('tr_daysEdit').value;
			var carrier = document.getElementById('carrierEdit').value;
			var cargoType = document.getElementById('CargoTypeEdit').value;

			$.ajax({
				url:'backend/edit_sea_charge.php',
				method:'POST',
				data:{
					id:sea_id,
					sf_countries:countries,
					sf_city:city,

					sf_orgin_seaport:orgin_seaport,

					sf_countries_dest:countries_dest,
					sf_city_dest:city_dest,

					sf_min_cbm:min_cbm,
					sf_max_cbm:max_cbm,

					sf_toservice:toservice,
					sf_tocontainer:tocontainer,

					sf_destination_seaport:destination_seaport,

					sf_transit:transit,
					sf_min_weight:min_weight,
					sf_max_weight:max_weight,
					sf_desc:desc,
					sf_uom:uom,
					sf_aed:aed,
					sf_currency:currency,
					sf_vendor:vendor,
					sf_validity:validity,
					sf_tr_days:tr_days,
					sf_carrier:carrier,
					sf_cargoType:cargoType

				},
				success:function(response){
					console.log(response);
					if(response == 200){
						$('#show_sf_charge').load('ajax_pages/sf_charge_table.php');
									$('#edit_s').modal('hide');
					}
					else {
						console.log(response);
					}
				}
			});
		}

		function addsfCharge(){
			var countries = document.getElementById('countries').value;
			var city = document.getElementById('city').value;
			var orgin_seaport = document.getElementById('orgin_seaport').value;

			var countries_dest = document.getElementById('dest_countries').value;
			var city_dest = document.getElementById('dest_city').value;
			var destination_seaport = document.getElementById('destination_seaport').value;

			var transit = document.getElementById('transit').value;

			var min_weight = document.getElementById('min_weight').value;
			var max_weight = document.getElementById('max_weight').value;

			var min_cbm = document.getElementById('min_cbm').value;
			var max_cbm = document.getElementById('max_cbm').value;

			var toservice = document.getElementById('typeOfService').value;
			var tocontainer = document.getElementById('container_id').value;

			var desc = document.getElementById('desc').value;
			var uom = document.getElementById('uom').value;
			var aed = document.getElementById('aed').value;
			var currency =document.getElementById('currency').value;
			var vendor = document.getElementById('vendor').value;
			var validity = document.getElementById('validity').value;

			var tr_days = document.getElementById('tr_days').value;
			var carrier = document.getElementById('carrier').value;

			var cargoType = document.getElementById('CargoType').value;

			if (
		countries === "" ||
		city === "" ||
		orgin_seaport === "" ||
		countries_dest === "" ||
		city_dest === "" ||
		destination_seaport === "" ||
		transit === "" ||
		min_weight === "" ||
		max_weight === "" ||
		min_cbm === "" ||
		max_cbm === "" ||
		toservice === "" ||
		tocontainer === "" ||
		desc === "" ||
		uom === "" ||
		aed === "" ||
		currency === "" ||
		vendor === "" ||
		validity === "" ||
		tr_days === "" ||
		carrier === "" ||
		cargoType === ""
) {
		alert("All fields are required. Please fill in all the fields.");
		return false; // Prevent form submission
}

			$.ajax({
				url:'backend/add_sea_charge.php',
				method:'POST',
				data:{
					sf_countries:countries,
					sf_city:city,

					sf_orgin_seaport:orgin_seaport,

					sf_countries_dest:countries_dest,
					sf_city_dest:city_dest,

					sf_min_cbm:min_cbm,
					sf_max_cbm:max_cbm,

					sf_toservice:toservice,
					sf_tocontainer:tocontainer,

					sf_destination_seaport:destination_seaport,

					sf_transit:transit,
					sf_min_weight:min_weight,
					sf_max_weight:max_weight,
					sf_desc:desc,
					sf_uom:uom,
					sf_aed:aed,
					sf_currency:currency,
					sf_vendor:vendor,
					sf_validity:validity,
					sf_tr_days:tr_days,
					sf_carrier:carrier,
					sf_cargoType:cargoType

				},
				success:function(response){
					console.log(response);
					if(response == 200){
						$('#show_sf_charge').load('ajax_pages/sf_charge_table.php');

						document.getElementById('transit').value='';

						document.getElementById('min_weight').value='';
						document.getElementById('max_weight').value='';
						document.getElementById('min_cbm').value='';
						document.getElementById('max_cbm').value='';
						document.getElementById('desc').value='';
	 					document.getElementById('uom').value='';
	 					document.getElementById('aed').value='';
						document.getElementById('currency').value='';
				 		document.getElementById('vendor').value='';
					}
					else {
						console.log(response);
					}
				}
			});
		}

		function deleteSc(sf_id){
			if(confirm('Are you sure you want to delete charge?')){
				$.ajax({
					url:'backend/del_sf_charge.php',
					method:'POST',
					data:{
						sfId:sf_id
					},
					success:function(response){
						console.log(response);
						if(response == 200){
							$('#show_sf_charge').load('ajax_pages/sf_charge_table.php');
						}
					}
				});
			}
		}

		function selectCityDest(cId){
			$('#dest_city').load('ajax_pages/show_cities.php',{ c_id:cId });
		}

		function selectCity(cId){
			$('#city').load('ajax_pages/show_cities.php',{ c_id:cId });
		}

		function selectSeaportOrgi(cId){
			$('#orgin_seaport').load('ajax_pages/show_seaport.php',{ id:cId });
		}

		function selectSeaportDesti(cId){
			$('#destination_seaport').load('ajax_pages/show_seaport.php',{ id:cId });
		}
		// ssssssssssss
		function selectCityDestEdit(cId){
			$('#dest_cityEdit').load('ajax_pages/show_cities.php',{ c_id:cId });
		}

		function selectCityEdit(cId){
			$('#cityEdit').load('ajax_pages/show_cities.php',{ c_id:cId });
		}

		function selectSeaportOrgiEdit(cId){
			$('#orgin_seaportEdit').load('ajax_pages/show_seaport.php',{ id:cId });
		}

		function selectSeaportDestiEdit(cId){
			$('#destination_seaportEdit').load('ajax_pages/show_seaport.php',{ id:cId });
		}

		</script>
    </body>
</html>
