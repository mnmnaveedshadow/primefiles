<?php include '../backend/conn.php'; ?>
<script type="text/javascript">
var id =<?= $_REQUEST['show_id'] ?>;
if(id == 2){
	document.getElementById('airfrieght_form').style.display = "none";
	document.getElementById('seafreight_form').style.display = "block";
	document.getElementById('landfrieght_form').style.display = "none";
}
else if(id == 3){
	document.getElementById('airfrieght_form').style.display = "none";
	document.getElementById('seafreight_form').style.display = "none";
	document.getElementById('landfrieght_form').style.display = "block";
}
</script>
<img src="assets/img/icons/return1.svg" style="width:30px;cursor:pointer;" onclick="goBack(<?= $_REQUEST['back_id'] ?>)" alt="asd"> <br>
						<div id="airfrieght_form">
							<form class="" action="backend/gen_air_quote.php" method="post">
								<input type="hidden" name="service_type" value="1">
									<div class="row">
											<div class="col-6">
												<label for="">Movement Type</label>
												<select class="form-control" name="m_type">
													<option value="1">Door to Door</option>
													<option value="2">Door to Airport</option>
													<option value="3">Airport to Airport</option>
													<option value="4">Airport to Door</option>
												</select>
												<br>
											</div>
											<div class="col-12">
												<div class="row">

													<div class="col-6">
														<h3>Origin</h3>
														<hr>
														<div class="form-group">
															<label for="">Origin Countries</label>
															<select class="js-states form-control" name="orgin_country" id="countries_orgin_air" onchange="selectCityOrginAir(this.value)" required>
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
															<select class="form-control" id="city_orgin_air" name="orgin_city" onclick="selectAirportOrgin(this.value)" required>

															</select>
														</div>
														<div class="form-group">
															<label for="">Origin Airport</label>
															<select class="js-states form-control" name="orgin_airport" id="airport_orgin" required>

															</select>
														</div>
													</div>
													<div class="col-6">
														<h3>Destination</h3>
														<hr>
														<div class="form-group">
															<label for="">Destination Countries</label>
															<select class="js-states form-control" id="countries_destination_air" name="destination_country" onchange="selectCityDestiAir(this.value)" required>
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
															<select class="form-control" id="city_desti_air" name="destination_city" onclick="selectAirportDestination(this.value)" required>

															</select>
														</div>
														<div class="form-group">
															<label for="">Destination Airport</label>
															<select class="js-states form-control" name="destination_airport" id="airport_desti" required>

															</select>
														</div>
													</div>
												</div>
											</div>
											<br>
											<!-- <div class="col-12">
													<label for="other_charges">Other Charges</label>
													<div id="other_charges_container">
															<div class="input-group mb-3">
																	<input type="text" class="form-control" name="other_charge_names[]" placeholder="Charge Name">
																	<input type="text" class="form-control" name="other_charges[]" placeholder="Amount">
																	<div class="input-group-append">
																			<button type="button" class="btn btn-secondary" id="add_other_charge">Add</button>
																	</div>
															</div>
													</div>
											</div> -->
											<div class="col-12">
												 <br><br>
													<button type="submit" class="btn btn-primary" name="calculate_button">Request a Quote</button> <br><br>
											</div>
									</div>
							</form>
						</div>
						<!-- end of air_frieght_form -->
						<div id="seafreight_form" style="display:none;">
							<form class="" action="backend/gen_sea_quote.php" method="post">
								<input type="hidden" name="service_type" value="2">
									<div class="row">
											<div class="col-6">
												<label for="">Movement Type</label>
												<select class="form-control" name="m_type">
													<option value="1">Door to Door</option>
													<option value="1">Door to Seaport</option>
													<option value="1">Seaport to Seaport</option>
													<option value="1">Seaport to Door</option>
												</select>
												<br>
											</div>
											<div class="col-6">
												<label for="">Type Of Service</label>
												<select class="form-control" name="tos">
													<option value="2">LCL</option>
													<option value="1">FCL</option>
												</select>
												<br>
											</div>
											<div class="col-12">
												<div class="row">
													<div class="col-6">
														<h3>Origin</h3>
														<hr>
														<div class="form-group">
															<label for="">Origin Countries</label>
															<select class="js-states form-control"  name="orgin_country" id="countries_orgin_sea" onchange="selectCityOrginSea(this.value)">
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
															<select class="form-control" id="city_orgin_sea" name="orgin_city" onclick="selectSeaPortOrgin(this.value)">

															</select>
														</div>
														<div class="form-group">
															<label for="">Origin Sea Port</label>
															<select class="js-states form-control" name="orgin_seaport" id="seaport_sea_orgin">

															</select>
														</div>
													</div>
													<div class="col-6">
														<h3>Destination</h3>
														<hr>
														<div class="form-group">
															<label for="">Destination Countries</label>
															<select class="js-states form-control" id="countries_destination_sea" name="destination_country" onchange="selectCityDestiSea(this.value)">
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
															<select class="form-control" id="city_desti_sea" name="destination_city" onclick="selectSeaPortDesti(this.value)">

															</select>
														</div>
														<div class="form-group">
															<label for="">Destination Sea Port</label>
															<select class="js-states form-control" name="destination_seaport" id="seaport_sea_desti">

															</select>
														</div>
													</div>
												</div>
											</div>
											<!-- <div class="col-12">
													<label for="other_charges">Other Charges</label>
													<div id="other_charges_container">
															<div class="input-group mb-3">
																	<input type="text" class="form-control" name="other_charge_names[]" placeholder="Charge Name">
																	<input type="text" class="form-control" name="other_charges[]" placeholder="Amount">
																	<div class="input-group-append">
																			<button type="button" class="btn btn-secondary" id="add_other_charge">Add</button>
																	</div>
															</div>
													</div>
											</div> -->
											<div class="col-12">
												 <br><br>
													<button type="submit" class="btn btn-primary"  name="calculate_button">Request a Quote</button> <br><br>
											</div>
									</div>
							</form>
						</div>
						<!-- end of sea -->
						<div id="landfrieght_form" style="display:none;">
							<form class="" action="backend/gen_land_quote.php" method="post">
								<input type="hidden" name="service_type" value="3">
									<div class="row">
											<div class="col-6">
												<label for="">Movement Type</label>
												<select class="form-control" name="m_type">
													<option value="1">Door to Door</option>
													<option value="1">Door to Border</option>
													<option value="1">Border to Border</option>
													<option value="1">Border to Door</option>
												</select>
												<br>
											</div>
											<div class="col-6">
												<label for="">Type Of Service</label>
												<select class="form-control" name="tos">
													<option value="1">FTL</option>
													<option value="2">LTL</option>
												</select>
												<br>
											</div>
											<div class="col-12">
												<div class="row">
													<div class="col-6">
														<h3>Origin</h3>
														<hr>
														<div class="form-group">
															<label for="">Origin Countries</label>
															<select class="js-states form-control" name="orgin_country" id="countries_orgin_land" onchange="selectCityOrginLand(this.value)">
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
															<select class="form-control" id="city_orgin_land" name="orgin_city" onchange="selectBorderOrgin(this.value)">

															</select>
														</div>
														<div class="form-group">
															<label for="">Origin Border Land</label>
															<select class="js-states form-control" name="orgin_border" id="border_orgin">

															</select>
														</div>
													</div>
													<div class="col-6">
														<h3>Destination</h3>
														<hr>
														<div class="form-group">
															<label for="">Destination Countries</label>
															<select class="js-states form-control" name="destination_country" id="countries_destination_land" onchange="selectCityDestiLand(this.value)">
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
															<select class="form-control" id="city_desti_land" name="destination_city" onchange="selectBorderDesti(this.value)">

															</select>
														</div>
														<div class="form-group">
															<label for="">Destination Border Land</label>
															<select class="js-states form-control" name="destination_border" id="border_desti">

															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12">
												 <br><br>
													<button type="submit" class="btn btn-primary"
													 name="calculate_button">Request a Quote</button> <br><br>
											</div>
									</div>
							</form>
						</div>
