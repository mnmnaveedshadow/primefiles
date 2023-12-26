

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
							<h4>Sea Freight Origin Charge</h4>
						</div>
					</div>
					<!-- /add -->

					<div class="card">
					    <div class="card-body">
					        <div class="row">
					            <div class="col-2">
												    <div class="form-group">
												      <label for="">Countries</label>
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
												      <label for="">City</label>
												      <select class="form-control" id="city" onclick="selectSeaport(this.value)">

												      </select>
												    </div>
												    <div class="form-group">
												      <label for="">Seaport</label>
												      <select class="js-states form-control" id="seaport">

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
												        <label for="">Description</label>
												        <input type="text" class="form-control" id="desc" placeholder="Description" name="description" value="" required>
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
																	<label for="">Vendor</label>
																	<select class="form-control" id="vendor">
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
																<select class="form-control" name="" id="currency">
																	<option value="1">AED</option>
																	<option value="2">USD</option>
																	<option value="3">SAR</option>
																</select>
														</div>
												    <div class="form-group">
												        <label for="">Aed</label>
												        <input type="number" class="form-control" id="aed" placeholder="Aed" name="aed" value="" required>
												    </div>
												    <div class="form-group">
												        <label for="">Min Aed</label>
												        <input type="number" class="form-control" id="min_aed" placeholder="Min Aed" name="min_aed" value="" required>
												    </div>
														<div class="form-group">
															<label for="">Remark</label>
															<input type="text" class="form-control" id="remark" placeholder="" value="" required>
														</div>
												    <div class="form-group">
												        <label for="">VALIDITY</label>
												        <input type="date" class="form-control" id="validity" placeholder="VALIDITY" name="validity" value="" required>
												    </div>
												    <button type="button" class="btn btn-primary btn-me2" onclick="addSfoCharge()" name="button">Add</button>
					                <br><br>
					            </div>
					            <div class="col-10" id="show_o_charge">

					            </div>
					        </div>
					    </div>
					</div>


					<!-- /add -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

		<div class="modal fade" id="edit_o_s" tabindex="-1" aria-labelledby="edit_o_s" aria-hidden="true">
				<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
						<div class="modal-content">
								<div class="modal-header">
										<h5 class="modal-title">Edit Sea Freight Origin Charge</h5>
										<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
										</button>
								</div>
								<div class="modal-body" id="edit_o_sea_charge">

								</div>
						</div>
				</div>
		</div>

    <?php include './layouts/footer.php' ?>
		<script type="text/javascript">

		function openEditSoc(id){
			$('#edit_o_s').modal('show');
			$('#edit_o_sea_charge').load('ajax_pages/edit_o_sea_charge.php',{
				s_oc_id:id
			});
		}

		function editSfoCharge(){
			var id = document.getElementById('soc_id').value;

			var countries = document.getElementById('countriesEdit').value;
			var city = document.getElementById('cityEdit').value;
			var seaport = document.getElementById('seaportEdit').value;

			var desc = document.getElementById('descEdit').value;
			var uom = document.getElementById('uomEdit').value;
			var aed = document.getElementById('aedEdit').value;

			var currency =document.getElementById('currencyEdit').value;
			var min_aed = document.getElementById('min_aedEdit').value;
			var vendor = document.getElementById('vendorEdit').value;

			var validity = document.getElementById('validityEdit').value;

			var typeOfService = document.getElementById('typeOfServiceEdit').value;
			var container_id = document.getElementById('containerEdit').value;
			var remark = document.getElementById('remarkEdit').value;

			$.ajax({
				url:'backend/edit_sfo_charge.php',
				method:'POST',
				data:{
					soc_id:id,
					soc_countries:countries,
					soc_city:city,
					soc_seaport:seaport,
					soc_desc:desc,
					soc_uom:uom,
					soc_aed:aed,
					soc_min_aed:min_aed,
					soc_vendor:vendor,
					soc_currency:currency,
					soc_validity:validity,
					soc_typeOfService:typeOfService,
					soc_container_id:container_id,
					soc_remark:remark
				},
				success:function(response){
					if(response == 200){
						$('#show_o_charge').load('ajax_pages/sfo_charge_table.php');
						$('#edit_o_s').modal('hide');
					}
					else {
						console.log(response);
					}
				}
			});
		}

		function addSfoCharge(){
			var countries = document.getElementById('countries').value;
			var city = document.getElementById('city').value;
			var seaport = document.getElementById('seaport').value;
			var desc = document.getElementById('desc').value;
			var uom = document.getElementById('uom').value;
			var aed = document.getElementById('aed').value;
			var currency =document.getElementById('currency').value;
			var min_aed = document.getElementById('min_aed').value;
			var vendor = document.getElementById('vendor').value;
			var validity = document.getElementById('validity').value;

			var typeOfService = document.getElementById('typeOfService').value;
			var container_id = document.getElementById('container_id').value;
			var remark = document.getElementById('remark').value;

			if (
					countries === "" ||
					city === "" ||
					seaport === "" ||
					desc === "" ||
					uom === "" ||
					aed === "" ||
					currency === "" ||
					min_aed === "" ||
					vendor === "" ||
					validity === "" ||
					typeOfService === "" ||
					container_id === "" ||
					remark === ""
			) {
					alert("All fields are required. Please fill in all the fields.");
					return false; // Prevent form submission
			}


			$.ajax({
				url:'backend/add_sfo_charge.php',
				method:'POST',
				data:{
					soc_countries:countries,
					soc_city:city,
					soc_seaport:seaport,
					soc_desc:desc,
					soc_uom:uom,
					soc_aed:aed,
					soc_min_aed:min_aed,
					soc_vendor:vendor,
					soc_currency:currency,
					soc_validity:validity,
					soc_typeOfService:typeOfService,
					soc_container_id:container_id,
					soc_remark:remark
				},
				success:function(response){
					console.log(response);
					if(response == 200){
						$('#show_o_charge').load('ajax_pages/sfo_charge_table.php');
		 				document.getElementById('desc').value="";
	 					document.getElementById('uom').value="";
	 					document.getElementById('aed').value="";
						document.getElementById('currency').value;
					 	document.getElementById('min_aed').value="";
				 		document.getElementById('vendor').value="";
					}
					else {
						console.log(response);
					}
				}
			});
		}

		function deleteSoc(soc_id){
			if(confirm('Are you sure you want to delete Origin charge?')){
				$.ajax({
					url:'backend/del_sfo_charge.php',
					method:'POST',
					data:{
						socId:soc_id
					},
					success:function(response){
						console.log(response);
						if(response == 200){
							$('#show_o_charge').load('ajax_pages/sfo_charge_table.php');
						}
					}
				});
			}
		}

		$('#show_o_charge').load('ajax_pages/sfo_charge_table.php');

		function selectCity(cId){
			$('#city').load('ajax_pages/show_cities.php',{ c_id:cId });
		}

		function selectSeaport(cId){
			$('#seaport').load('ajax_pages/show_seaport.php',{ id:cId });
		}

		function selectCityEdit(cId){
			$('#cityEdit').load('ajax_pages/show_cities.php',{ c_id:cId });
		}

		function selectSeaportEdit(cId){
			$('#seaportEdit').load('ajax_pages/show_seaport.php',{ id:cId });
		}

		</script>
    </body>
</html>
