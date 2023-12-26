

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
							<h4>Air Freight Origin Charge</h4>
						</div>
					</div>
					<!-- /add -->

					<div class="card">
					    <div class="card-body">
					        <div class="row">
					            <div class="col-4">
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
												      <select class="form-control" id="city" onclick="selectAirport(this.value)">

												      </select>
												    </div>
												    <div class="form-group">
												      <label for="">Airport</label>
												      <select class="js-states form-control" id="airport">

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
												          <option value="2">Per Kg</option>
												          <option value="3">Per Label</option>
												        </select>
												    </div>
														<div class="form-group">
																<label for="">Vendor</label>
																<select class="form-control" id="vendor">
													        <option value="">Select</option>
													        <?php
													          $sql = "SELECT * FROM `tbl_air_vendor`";
													          $rs= $conn->query($sql);
													          if($rs->num_rows > 0){
													            while($row_c = $rs->fetch_assoc()){
													         ?>
													         <option value="<?= $row_c['av_id'] ?>"><?= $row_c['av_name'] ?></option>
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
												        <label for="">VALIDITY</label>
												        <input type="date" class="form-control" id="validity" placeholder="VALIDITY" name="validity" value="" required>
												    </div>
												    <button type="button" class="btn btn-primary btn-me2" onclick="addAfoCharge()" name="button">Add</button>
					                <br><br>
					            </div>
					            <div class="col-8" id="show_o_charge">

					            </div>
					        </div>
					    </div>
					</div>

					<div class="modal fade" id="edit_o_a" tabindex="-1" aria-labelledby="edit_o_a" aria-hidden="true">
					    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
					        <div class="modal-content">
					            <div class="modal-header">
					                <h5 class="modal-title">Edit Air Freight Origin Charge</h5>
					                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					                    <span aria-hidden="true">×</span>
					                </button>
					            </div>
					            <div class="modal-body" id="edit_ocharge">

					            </div>
					        </div>
					    </div>
					</div>

					<!-- /add -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

    <?php include './layouts/footer.php' ?>
		<script type="text/javascript">

		function openEditAoc(aocD){
			$('#edit_o_a').modal('show');
			$('#edit_ocharge').load('ajax_pages/edit_ocharge.php',{
				a_oc_id:aocD
			});
		}


		function addAfoCharge(){
			var countries = document.getElementById('countries').value;
			var city = document.getElementById('city').value;
			var airport = document.getElementById('airport').value;
			var desc = document.getElementById('desc').value;
			var uom = document.getElementById('uom').value;
			var aed = document.getElementById('aed').value;
			var currency =document.getElementById('currency').value;
			var min_aed = document.getElementById('min_aed').value;
			var vendor = document.getElementById('vendor').value;
			var validity = document.getElementById('validity').value;

			$.ajax({
				url:'backend/add_afo_charge.php',
				method:'POST',
				data:{
					aoc_countries:countries,
					aoc_city:city,
					aoc_airport:airport,
					aoc_desc:desc,
					aoc_uom:uom,
					aoc_aed:aed,
					aoc_min_aed:min_aed,
					aoc_vendor:vendor,
					aoc_currency:currency,
					aoc_validity:validity
				},
				success:function(response){
          if(response == 200){
						$('#show_o_charge').load('ajax_pages/afo_charge_table.php');
		 				document.getElementById('desc').value="";
	 					document.getElementById('uom').value="";
	 					document.getElementById('aed').value="";
					 	document.getElementById('min_aed').value="";
				 		document.getElementById('vendor').value="";
					}
				}
			});
		}

		function updateOcharge(){
			var id = document.getElementById('aoc_id').value;
			var countries = document.getElementById('countries_edit').value;
			var city = document.getElementById('city_edit').value;
			var airport = document.getElementById('airport_edit').value;
			var desc = document.getElementById('desc_edit').value;
			var uom = document.getElementById('uom_edit').value;
			var aed = document.getElementById('aed_edit').value;
			var currency =document.getElementById('currency_edit').value;
			var min_aed = document.getElementById('min_aed_edit').value;
			var vendor = document.getElementById('vendor_edit').value;
			var validity = document.getElementById('validity_edit').value;

			$.ajax({
				url:'backend/edit_af_charge.php',
				method:'POST',
				data:{
					aoc_id:id,
					aoc_countries:countries,
					aoc_city:city,
					aoc_airport:airport,
					aoc_desc:desc,
					aoc_uom:uom,
					aoc_aed:aed,
					aoc_min_aed:min_aed,
					aoc_vendor:vendor,
					aoc_currency:currency,
					aoc_validity:validity
				},
				success:function(response){
					if(response == 200){
						$('#edit_o_a').modal('hide');
						$('#show_o_charge').load('ajax_pages/afo_charge_table.php');
					}
				}
			});
		}
		function deleteAoc(aoc_id){
			if(confirm('Are you sure you want to delete Origin charge?')){
				$.ajax({
					url:'backend/del_afo_charge.php',
					method:'POST',
					data:{
						aocId:aoc_id
					},
					success:function(response){
						console.log(response);
						if(response == 200){
							$('#show_o_charge').load('ajax_pages/afo_charge_table.php');
						}
					}
				});
			}
		}

		$('#show_o_charge').load('ajax_pages/afo_charge_table.php');

		function selectCity(cId){
			$('#city').load('ajax_pages/show_cities.php',{ c_id:cId });
		}

		function selectCityEdit(cId){
			$('#city_edit').load('ajax_pages/show_cities.php',{ c_id:cId });
		}
		function selectAirportEdit(aId){
			$('#airport_edit').load('ajax_pages/show_airport.php',{ ap_id:aId });
		}

		function selectAirport(aId){
			$('#airport').load('ajax_pages/show_airport.php',{ ap_id:aId });
		}

		</script>
    </body>
</html>
