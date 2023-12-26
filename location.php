

			<!-- Header -->
			<?php include './layouts/header.php'; ?>
			<!-- Header -->

           <!-- Sidebar -->
			<?php include './layouts/sidebar.php'; ?>
			<!-- /Sidebar -->

			<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="page-title">
							<h4>Locations</h4>
						</div>
					</div>
					<!-- /add -->


					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4">
									<h3>Add Country</h3>
										<div class="form-group">
											<label for="">Add Country</label>
											<input type="text" class="form-control" placeholder="" id="c_name" name="c_name" value="" required>
										</div>
										<button type="submit" class="btn btn-primary btn-me2" onclick="addCountry()" name="button">Add</button>

										<hr><hr>
										<!-- end of country -->


								</div>
								<div class="col-8" id="show_country">

								</div>
								<div class="col-4">
									<h3>Add City</h3>
									<div class="form-group">
										<label for="">Countries</label>
										<select class="form-control" name="c_name" id="countries">
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
										<label for="">Add City</label>
										<input type="text" class="form-control" placeholder="" id="city_name" value="" required>
									</div>
									<button type="submit" class="btn btn-primary btn-me2" onclick="addCity()" name="button">Add</button>
									<hr><hr>
									<!-- end of city -->
								</div>
								<div class="col-8" id="view_city">

								</div>
								<div class="col-4">

																												<h3>Add Airport Code</h3>
																												<div class="form-group">
																													<label for="">Countries</label>
																													<select class="js-states form-control" name="c_name" onchange="selectCity(this.value)"  id="countries_dropdown_air">
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
																													<label for="">Select City</label>
																													<select class="form-control" name="c_name" id="city_dropdown">

																													</select>
																												</div>
																												<div class="form-group">
																													<label for="">Enter Airport Code</label>
																													<input type="text" class="form-control" placeholder="" id="air_code" value="" required>
																												</div>
																												<button type="submit" class="btn btn-primary btn-me2" onclick="addAirportCode()" name="button">Add</button>
																												<hr><hr>
								</div>
								<div class="col-8" id="view_airport_codes">

								</div>
								<!-- end of airport_code -->
								<div class="col-4">


																												<h3>Add Sea Port</h3>
																												<div class="form-group">
																													<label for="">Countries</label>
																													<select class="js-states form-control" name="c_name" onchange="selectCitySea(this.value)"  id="countries_dropdown_sea">
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
																													<label for="">Select City</label>
																													<select class="form-control" name="c_name" id="city_dropdown_sea">

																													</select>
																												</div>
																												<div class="form-group">
																													<label for="">Enter Sea Port Code</label>
																													<input type="text" class="form-control" placeholder="" id="sea_port" value="" required>
																												</div>
																												<button type="submit" class="btn btn-primary btn-me2" onclick="addSeaPort()" name="button">Add</button>
																												<hr><hr>

								</div>
								<div class="col-8" id="view_seaport_codes">

								</div>
								<div class="col-4">

																			<h3>Add Land Border</h3>
																			<div class="form-group">
																				<label for="">Countries</label>
																				<select class="js-states form-control" name="c_name" onchange="selectCityLand(this.value)"  id="countries_dropdown_land">
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
																				<label for="">Select City</label>
																				<select class="form-control" name="c_name" id="city_dropdown_land">

																				</select>
																			</div>
																			<div class="form-group">
																				<label for="">Enter Land Border</label>
																				<input type="text" class="form-control" placeholder="" id="land_code" value="" required>
																			</div>
																			<button type="submit" class="btn btn-primary btn-me2" onclick="add_landborder()" name="button">Add</button>
																			<hr><hr>
								</div>
								<div class="col-8" id="view_land_codes">

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
			$('#show_country').load('ajax_pages/show_countries.php');
			$('#view_city').load('ajax_pages/view_cities.php');

			$('#view_airport_codes').load('ajax_pages/view_airport_code.php');
			$('#view_seaport_codes').load('ajax_pages/view_seaport_code.php');
			$('#view_land_codes').load('ajax_pages/view_land_code.php');

			function addCountry(){
				var c_name = document.getElementById('c_name').value;
				$.ajax({
					url:'backend/add_country.php',
					method:'POST',
					data:{
						cName:c_name
					},
					success:function(response){
						if(response == 200){
							$('#show_country').load('ajax_pages/show_countries.php');
							document.getElementById('c_name').value='';
						}
						else if (response == 500) {
							document.getElementById('c_name').value='';
							alert('Country Already Added in the list');
						}
					}
				});
			}

			function delCountry(cId){
				if(confirm('Are You sure You Want to delete the country?')){
					$.ajax({
						url:'backend/del_country.php',
						method:'POST',
						data:{
							id:cId
						},
						success:function(response){
							if(response == 200){
								$('#show_country').load('ajax_pages/show_countries.php');
							}
						}
					});
				}
			}



			function addCity(){
				var c_name = document.getElementById('countries').value;
				var city_name = document.getElementById('city_name').value;
				$.ajax({
					url:'backend/add_city.php',
					method:'POST',
					data:{
						cName:c_name,
						cityName:city_name
					},
					success:function(response){
						if(response == 200){
							document.getElementById('city_name').value ="";
							$('#view_city').load('ajax_pages/view_cities.php');
						}
						else if (response == 500) {
							document.getElementById('city_name').value='';
							alert('City Name Already Found');
						}
					}
				});
			}

			function delCity(city_id){
				if(confirm('Are You sure You Want to delete the city?')){
					$.ajax({
						url:'backend/del_city.php',
						method:'POST',
						data:{
							id:city_id
						},
						success:function(response){
							if(response == 200){
								$('#view_city').load('ajax_pages/view_cities.php');
							}
						}
					});
				}
			}

			function addAirportCode(){
				var city_name = document.getElementById('city_dropdown').value;
				var air_code = document.getElementById('air_code').value;
				$.ajax({
					url:'backend/add_aircode.php',
					method:'POST',
					data:{
						cityName:city_name,
						airCode:air_code
					},
					success:function(response){
						if(response == 200){
							document.getElementById('air_code').value='';
							$('#view_airport_codes').load('ajax_pages/view_airport_code.php');
						}
						else if (response == 500) {
							document.getElementById('air_code').value='';
							alert('Air Code Already Found');
						}
					}
				});
			}

			function delAirport(aId){
				if(confirm('Are you sure you want to delete the airport code?')){
					$.ajax({
						url:'backend/del_airport.php',
						method:'POST',
						data:{
							air_id:aId
						},
						success:function(response){
							if(response == 200){
								$('#view_airport_codes').load('ajax_pages/view_airport_code.php');
							}
						}
					});
				}
			}

			function addSeaPort(){
				var city_name = document.getElementById('city_dropdown_sea').value;
				var sea_code = document.getElementById('sea_port').value;
				$.ajax({
					url:'backend/add_seacode.php',
					method:'POST',
					data:{
						cityName:city_name,
						seaCode:sea_code
					},
					success:function(response){
						if(response == 200){
							document.getElementById('sea_port').value='';
							$('#view_seaport_codes').load('ajax_pages/view_seaport_code.php');
						}
						else if (response == 500) {
							document.getElementById('sea_port').value='';
							alert('Sea Code Already Found');
						}
						else {
							console.log(response);
						}
					}
				});
			}

			function delSeaPort(sPid){
				if(confirm('Are you sure you want to delete the seaport code?')){
					$.ajax({
						url:'backend/del_seaport.php',
						method:'POST',
						data:{
							s_port:sPid
						},
						success:function(response){
							if(response == 200){
								$('#view_seaport_codes').load('ajax_pages/view_seaport_code.php');
							}
						}
					});
				}
			}

			function add_landborder(){
				var city_name = document.getElementById('city_dropdown_land').value;
				var land_code = document.getElementById('land_code').value;
				$.ajax({
					url:'backend/add_landborder.php',
					method:'POST',
					data:{
						cityName:city_name,
						landCode:land_code
					},
					success:function(response){
						if(response == 200){
							document.getElementById('land_code').value='';
										$('#view_land_codes').load('ajax_pages/view_land_code.php');
						}
						else if (response == 500) {
							document.getElementById('sea_port').value='';
							alert('Land Border Already Found');
						}
						else {
							console.log(response);
						}
					}
				});
			}

			function delLandBorder(lBId){
				if(confirm('Are you sure you want to delete the landborder?')){
					$.ajax({
						url:'backend/del_land_border.php',
						method:'POST',
						data:{
							l_border:lBId
						},
						success:function(response){
							if(response == 200){
								$('#view_land_codes').load('ajax_pages/view_land_code.php');
							}
						}
					});
				}
			}


			function selectCity(cId){
				$('#city_dropdown').load('ajax_pages/show_cities.php',{ c_id:cId });
			}
			function selectCitySea(cId){
				$('#city_dropdown_sea').load('ajax_pages/show_cities.php',{ c_id:cId });
			}
			function selectCityLand(cId){
				$('#city_dropdown_land').load('ajax_pages/show_cities.php',{ c_id:cId });
			}




		</script>

    </body>
</html>
