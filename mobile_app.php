<?php include 'backend/conn.php';

$_SESSION['mobile'] = true;

?>


<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<meta name="robots" content="noindex, nofollow">
		<title>Prime Logistics Get A Quote</title>

		<!-- Favicon -->
		<link rel="shortcut icon" type="image/x-icon" href="../../assets/img/favicon.png">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">


		<!-- Animation CSS -->
		<link rel="stylesheet" href="assets/css/animate.css">



		<!-- Datatable CSS -->
		<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css?new">

		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css?new">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css?new">

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css?newv1">
		<link rel="stylesheet" href="assets/css/mobile.css?v=0.01">


	</head>
	<body>
		<div class="bottom-navigation">
		    <a href="#request" class="activ_bot"><i class="fas fa-file-alt"></i>  <br> Request a Quote</a>
		    <a href="#my-quotes"><i class="fas fa-list"></i> <br>My Quotes</a>
		  </div>
		<div id="loader-container">
	    <div id="logo">
	      <!-- Add your logo image or text here -->
	      <img src="logo/New-logo-Prime.png" style="width:1380px;" alt="">
	    </div>
	    <div id="loading-circle"></div>
	  </div>

    <div class="container" style="margin-bottom:100px;">
			<input type="hidden" id="brok_st" name="" value="0">
			<br>
    <div class="card card-border">
      <div class="card-body">
          <div class="row">
						<div class="col-6 text-center">
              <img src="logo/New-logo-Prime.png" style="width:180px;" alt="">
            </div>
            <div class="col-6">
              <div style="float:right;">
                <h4><img src="icons/calendar.png" style="width:20px;" alt=""> <?= date('Y-m-d') ?></h4> <hr>
              </div>
            </div>
          </div>
					<div class="title-card">
					  <h3 style="color: #333; font-size: 19px; margin-bottom: 10px; margin-top: 10px;">Get a Quote with Prime Logistics</h3>
					</div>
<br>
          <div id="customer_info">
						<h4>Your Informations</h4>
						<hr>
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

	  					<div class="row">
	  						<div class="col-12 text-center">
									<button type="button" class="btn btn-prime" onclick="addOrUpdateCustomerInfo()"
			  					 name="button">Next Step <img src="assets/img/icons/right-arrow.svg" alt=""> </button>
	  						</div>
	  					</div>
          </div>
					<!-- end of customer info -->
					<br>
					<h3 id="service_text"></h3> <span id="ship_text"></span> <br>
					<div id="customer_service" style="display:none;">
						<div class="row">
							<div class="col-lg-4 col-6">
								<div class="card">
									<div class="card-body">
										<a onclick="selectService(1)">
											<img src="service_images/shipping.png" style="width:100%;" alt="">
											<hr>
											<h3 class="text-center service_text">Shipping</h3>
										</a>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-6">
								<div class="card">
									<div class="card-body">
										<a onclick="selectService(3)">
											<img src="service_images/brokerage.png" style="width:100%;" alt="">
											<hr>
											<h3 class="text-center service_text">Brokerage</h3>
										</a>
									</div>
								</div>
							</div>
							<!-- end of shipping -->
							<!-- end of brokerage -->
							<div class="col-lg-4 col-6 mx-auto">
								<div class="card">
									<div class="card-body">
										<a onclick="selectService(2)">
											<img src="service_images/warehousing.png" style="width:100%;" alt="">
											<hr>
											<h3 class="text-center service_text_2">Warehousing</h3>
										</a>
									</div>
								</div>
							</div>
							<!-- end of warehousing -->
						</div>
					</div>
					<br>
					<div id="shipping_services" style="display:none;">
							<div class="row">
								<div class="col-4">
									<br><br>
									<div class="shipping-main-option" onclick="selectShipping(1)">
										<img src="service_images/air.png" style="width:100%;" alt="">
									</div>
								</div>
								<div class="col-4">
										<br><br>
										<div class="shipping-main-option" onclick="selectShipping(2)">
											<img src="service_images/ship.png" style="width:100%;" alt="">
										</div>
									</div>
								<div class="col-4">
									<br><br>
									<div class="shipping-main-option" onclick="selectShipping(3)">
										<img src="service_images/land.png" style="width:100%;" alt="">
									</div>
								</div>
							</div>
							<br>
					</div>
					<div id="service">

					</div>
					<!-- end of brokerage -->
<div class="col-12" id="warehouse_price" style="display:none;">
<br><br>
<form class="" action="backend/gen_warehouse_quote.php" method="post">
	<input type="hidden" name="service_type" value="4">
	<div class="text-center">
		<button type="submit" class="btn btn-my">GET A QUOTE</button>
	</div>
</form>
</div>
<!-- ware_housing price -->
<br>

<div id="package_details" style="display:none;">
	<div class="row">
		<div class="col-md-2">
				<div class="form-group">
						<label for="quantity">No of packages</label>
						<input type="number" id="p_qty" min="0" onkeyup="dontAllowMinus(this)" class="form-control" name="quantity">
				</div>
		</div>
		<div class="col-3">
				<div class="form-group">
						<label for="length">Length (CM)</label>
						<input type="number" id="p_l" min="0" onkeyup="dontAllowMinus(this)" class="form-control" name="length">
				</div>
		</div>
		<div class="col-3">
				<div class="form-group">
						<label for="width">Width (CM)</label>
						<input type="number" id="p_w" min="0" onkeyup="dontAllowMinus(this)" class="form-control" name="width">
				</div>
		</div>
		<div class="col-3">
				<div class="form-group">
						<label for="height">Height (CM)</label>
						<input type="number" id="p_h" min="0" onkeyup="dontAllowMinus(this)" class="form-control" name="height">
				</div>
		</div>
		<div class="col-3">
				<div class="form-group">
						<label for="weight">Weight (Kg)</label>
						<input type="number" id="p_we" min="0" onkeyup="dontAllowMinus(this)" class="form-control" name="weight">
				</div>
		</div>
</div>
<button type="button" id="add-package" onclick="add_package_details()" class="btn btn-primary">Add Package</button> <br><br>

		<div class="col-12" id="show_packages">

		</div> <br><br>

</div>
<hr>
<div class="row">
	<div class="col-lg-6">

		<h4> <img src="icons/email.png" style="width:20px;" alt=""> info@primelogistics.ae</h4>
		<br>
	</div>
	<div class="col-lg-6">

		<h4><img src="icons/location.png" style="width:20px;" alt=""> Warehouse G09,Dubai Airport<br> &nbsp;&nbsp;&nbsp;&nbsp;  Freezone,Dubai, UAE</h4>
	</div>
</div>
      </div>
    </div>
    </div>












<!-- jQuery -->
    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <!-- Feather Icon JS -->
<script src="assets/js/feather.min.js"></script>

<!-- Slimscroll JS -->
<script src="assets/js/jquery.slimscroll.min.js"></script>

<!-- Datatable JS -->
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>

<!-- Bootstrap Core JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

<!-- Owl JS Added-->
<script src="assets/plugins/owlcarousel/owl.carousel.min.js"></script>

<script src="assets/plugins/select2/js/select2.min.js"></script>
<script src="assets/plugins/select2/js/custom-select.js"></script>

<!-- Sweetalert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom JS -->

<!-- Datetimepicker JS -->
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

<!-- Chart JS -->
<script src="assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="assets/plugins/apexchart/chart-data.js"></script>
<script src="homepage.js?newv8">  </script>
<script src="assets/js/script.js?new"></script>
<script type="text/javascript">
	function selectCustomerState(cId)
	{
		$('#state').load('ajax_pages/sel_cus_state.php',{ c_id:cId });
	}

	function selectCustomerCity(sId)
	{
		$('#city').load('ajax_pages/sel_cus_city.php',{ s_id:sId });
	}
	// Display loader
	var loaderContainer = document.getElementById('loader-container');

	// Hide loader after 3 seconds
	setTimeout(function () {
		loaderContainer.style.display = 'none';
	}, 1000);

	// Add event listener for page load
	window.addEventListener('load', function () {
		// Display loader after page load
		loaderContainer.style.display = 'flex';
	});
</script>
</body>
</html>
