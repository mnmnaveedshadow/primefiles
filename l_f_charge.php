

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
							<h4>Air Freight Charges</h4>
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
													      <select class="form-control" id="city" onclick="selectBorderOrgin(this.value)">

													      </select>
													    </div>
															<div class="form-group">
													      <label for="">Origin Border</label>
													      <select class="js-states form-control" id="border_orgin">

													      </select>
													    </div>
															<div class="form-group">
																<label for="">Type Of Service</label>
																<select class="form-control" id="typeOfService" name="">
																	<option value="1">FTL</option>
																		<option value="2">LTL</option>
																</select>
															</div>

															<div class="form-group">
																<label for="">Transit Days</label>
																<input type="text" class="form-control" id="transit" name="" value="">
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
													        <label for="">Charge Amount</label>
													        <input type="number" class="form-control" id="aed" placeholder="20" name="aed" value="" required>
													    </div>

													    <button type="button" class="btn btn-primary btn-me2" onclick="addlfCharge()" name="button">Add</button>
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
													      <select class="form-control" id="dest_city" onclick="selectBorderDesti(this.value)">

													      </select>
													    </div>
															<div class="form-group">
													      <label for="">Destination Land Border</label>
													      <select class="js-states form-control" id="border_desti">

													      </select>
													    </div>
													    <div class="form-group">
													        <label for="">UOM (Unit of Measure)</label>
													        <select class="form-control" name="" id="uom">
													          <option value="1">Per Shipment</option>
													          <option value="2">Per Kg</option>
													          <option value="7">Per Truck</option>
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
													        <label for="">VALIDITY</label>
													        <input type="date" class="form-control" id="validity" placeholder="VALIDITY" name="validity" value="" required>
													    </div>
						                <br><br>
														</div>
													</div>
					            </div>
					            <div class="col-12" id="show_lf_charge">

					            </div>
					        </div>
					    </div>
					</div>


					<!-- /add -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		<div class="modal fade" id="edit_land" tabindex="-1" aria-labelledby="edit_land" aria-hidden="true">
				<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
						<div class="modal-content">
								<div class="modal-header">
										<h5 class="modal-title">Edit Land Freight Charge</h5>
										<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
										</button>
								</div>
								<div class="modal-body" id="edit_land_charge">

								</div>
						</div>
				</div>
		</div>


    <?php include './layouts/footer.php' ?>
		<script type="text/javascript">

		$('#show_lf_charge').load('ajax_pages/lf_charge_table.php');

		function openEditLandChargeModal(id){
			$('#edit_land').modal('show');
			$('#edit_land_charge').load('ajax_pages/edit_land_charge.php',{l_id:id});
		}

		function editlfCharge(){
			var lid = document.getElementById('lid').value;
			var countries = document.getElementById('countriesEdit').value;
			var city = document.getElementById('cityEdit').value;
			var border_orgin = document.getElementById('border_orginEdit').value;

			var countries_dest = document.getElementById('dest_countriesEdit').value;
			var city_dest = document.getElementById('dest_cityEdit').value;
			var border_desti = document.getElementById('border_destiEdit').value;

			var transit = document.getElementById('transitEdit').value;

			var min_weight = document.getElementById('min_weightEdit').value;
			var max_weight = document.getElementById('max_weightEdit').value;

			var min_cbm = document.getElementById('min_cbmEdit').value;
			var max_cbm = document.getElementById('max_cbmEdit').value;

			var toservice = document.getElementById('typeOfServiceEdit').value;

			var desc = document.getElementById('descEdit').value;
			var uom = document.getElementById('uomEdit').value;
			var aed = document.getElementById('aedEdit').value;
			var currency =document.getElementById('currencyEdit').value;
			var vendor = document.getElementById('vendorEdit').value;
			var validity = document.getElementById('validityEdit').value;

			$.ajax({
				url:'backend/edit_land_charge.php',
				method:'POST',
				data:{
					id:lid,
					lf_countries:countries,
					lf_city:city,

					lf_border_orgin:border_orgin,

					lf_countries_dest:countries_dest,
					lf_city_dest:city_dest,

					lf_min_cbm:min_cbm,
					lf_max_cbm:max_cbm,

					lf_toservice:toservice,

					lf_border_desti:border_desti,

					lf_transit:transit,
					lf_min_weight:min_weight,
					lf_max_weight:max_weight,
					lf_desc:desc,
					lf_uom:uom,
					lf_aed:aed,
					lf_currency:currency,
					lf_vendor:vendor,
					lf_validity:validity
				},
				success:function(response){
					console.log(response);
					if(response == 200){
						$('#show_lf_charge').load('ajax_pages/lf_charge_table.php');
					}
					else {
						console.log(response);
					}
				}
			});
		}

		function addlfCharge(){
			var countries = document.getElementById('countries').value;
			var city = document.getElementById('city').value;
			var border_orgin = document.getElementById('border_orgin').value;

			var countries_dest = document.getElementById('dest_countries').value;
			var city_dest = document.getElementById('dest_city').value;
			var border_desti = document.getElementById('border_desti').value;

			var transit = document.getElementById('transit').value;

			var min_weight = document.getElementById('min_weight').value;
			var max_weight = document.getElementById('max_weight').value;

			var min_cbm = document.getElementById('min_cbm').value;
			var max_cbm = document.getElementById('max_cbm').value;

			var toservice = document.getElementById('typeOfService').value;

			var desc = document.getElementById('desc').value;
			var uom = document.getElementById('uom').value;
			var aed = document.getElementById('aed').value;
			var currency =document.getElementById('currency').value;
			var vendor = document.getElementById('vendor').value;
			var validity = document.getElementById('validity').value;

			if (
		countries === "" ||
		city === "" ||
		border_orgin === "" ||
		countries_dest === "" ||
		city_dest === "" ||
		border_desti === "" ||
		transit === "" ||
		min_weight === "" ||
		max_weight === "" ||
		min_cbm === "" ||
		max_cbm === "" ||
		toservice === "" ||
		desc === "" ||
		uom === "" ||
		aed === "" ||
		currency === "" ||
		vendor === "" ||
		validity === ""
		) {
				alert("All fields are required. Please fill in all the fields.");
				return false; // Prevent form submission
		}

			$.ajax({
				url:'backend/add_land_charge.php',
				method:'POST',
				data:{
					lf_countries:countries,
					lf_city:city,

					lf_border_orgin:border_orgin,

					lf_countries_dest:countries_dest,
					lf_city_dest:city_dest,

					lf_min_cbm:min_cbm,
					lf_max_cbm:max_cbm,

					lf_toservice:toservice,

					lf_border_desti:border_desti,

					lf_transit:transit,
					lf_min_weight:min_weight,
					lf_max_weight:max_weight,
					lf_desc:desc,
					lf_uom:uom,
					lf_aed:aed,
					lf_currency:currency,
					lf_vendor:vendor,
					lf_validity:validity
				},
				success:function(response){
					console.log(response);
					if(response == 200){
						$('#show_lf_charge').load('ajax_pages/lf_charge_table.php');

						document.getElementById('transit').value='';

						document.getElementById('min_weight').value='';
						document.getElementById('max_weight').value='';
						document.getElementById('min_cbm').value='';
						document.getElementById('max_cbm').value='';
						document.getElementById('desc').value='';
	 					document.getElementById('uom').value='';
	 					document.getElementById('aed').value='';
						document.getElementById('currency').value='';
					}
					else {
						console.log(response);
					}
				}
			});
		}

		function deleteLc(l_id){
			if(confirm('Are you sure you want to delete charge?')){
				$.ajax({
					url:'backend/del_l_charge.php',
					method:'POST',
					data:{
						lcId:l_id
					},
					success:function(response){
						console.log(response);
						if(response == 200){
							$('#show_lf_charge').load('ajax_pages/lf_charge_table.php');
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

		function selectBorderOrgin(cId){
				$('#border_orgin').load('ajax_pages/show_border.php',{ id:cId });
		}

		function selectBorderDesti(cId){
				$('#border_desti').load('ajax_pages/show_border.php',{ id:cId });
		}
		// edit ---------------
		function selectCityDestEdit(cId){
			$('#dest_cityEdit').load('ajax_pages/show_cities.php',{ c_id:cId });
		}

		function selectCityEdit(cId){
			$('#cityEdit').load('ajax_pages/show_cities.php',{ c_id:cId });
		}

		function selectBorderOrginEdit(cId){
				$('#border_orginEdit').load('ajax_pages/show_border.php',{ id:cId });
		}

		function selectBorderDestiEdit(cId){
				$('#border_destiEdit').load('ajax_pages/show_border.php',{ id:cId });
		}
		</script>
    </body>
</html>
