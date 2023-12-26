<?php include 'backend/conn.php';?>


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
		<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css?new1">

		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css?new1">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css?new1">

		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css?newv2">
		<link rel="stylesheet" href="assets/css/website.css?new2">


	</head>
	<body>
		<div id="global-loader" >
			<div class="whirly-loader"> </div>
		</div>

    <div class="container">
			<input type="hidden" id="brok_st" name="" value="0">
			<br>
    <div class="card card-border">
      <div class="card-body">
          <div class="row">
            <div class="col-lg-3">
              <img src="logo/New-logo-Prime.png" style="width:180px;" alt="">
            </div>
            <div class="col-lg-9">
              <div style="float:right;">
                <h4><img src="icons/calendar.png" style="width:20px;" alt=""> <?= date('Y-m-d') ?></h4> <hr>
              </div>
            </div>
          </div>
          <h3 class="text-center">Get a quote with prime logistics</h3>
          <hr>

					<!-- end of customer info -->
					<br>
					<h3 id="service_text"></h3> <span id="ship_text"></span> <br>
					<div id="load">

					</div>
					<div class="row">
						<div class="col-lg-6">
							<h4> <img src="icons/email.png" style="width:20px;" alt=""> pricing@primelogistics.ae</h4>
							<br>
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


<script src="assets/plugins/select2/js/select2.min.js"></script>
<script src="assets/plugins/select2/js/custom-select.js"></script>

<!-- Sweetalert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom JS -->

<!-- Datetimepicker JS -->
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

<script src="homepage.js?v=0.0000040">  </script>
<script src="assets/js/script.js?v=0.000010"></script>
<script type="text/javascript">


	$('#load').load('website_pages/customer.php');

	function selectCustomerState(cId)
	{
		$('#state').load('ajax_pages/sel_cus_state.php',{ c_id:cId });
	}

	function selectCustomerCity(sId)
	{
		$('#city').load('ajax_pages/sel_cus_city.php',{ s_id:sId });
	}
</script>
</body>
</html>
