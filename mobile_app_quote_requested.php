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

		<div class="container">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-3">
							<img src="logo/New-logo-Prime.png" style="width:180px;" alt="">
						</div>
						<div class="col-lg-9">
							<div style="float:right;">
								<h4><img src="icons/calendar.png" style="width:20px;" alt=""> <?= date('Y-m-d') ?></h4> <hr>
								<h4> <img src="icons/email.png" style="width:20px;" alt=""> info@primelogistics.ae</h4><hr>
								<h4><img src="icons/location.png" style="width:20px;" alt=""> Warehouse G09,Dubai Airport<br> &nbsp;&nbsp;&nbsp;&nbsp;  Freezone,Dubai, UAE</h4>
							</div>
						</div>
					</div>
					<hr><hr>
					<h3 class="text-center">Your Request Sent To Prime Logistics</h3>
					<p class="text-center">One Of Our Agent Will Contact You Soon</p> <br>

					<div class="text-center">
						<a href="mobile_app.php" class="btn btn-prime">Request Another Quote</a>
					</div>
					<hr><hr>
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
