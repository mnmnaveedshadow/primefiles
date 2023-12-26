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
		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


		<!-- Animation CSS -->
		<link rel="stylesheet" href="assets/css/animate.css">



		<!-- Datatable CSS -->
		<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">

		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css?new">
		<link rel="stylesheet" href="assets/css/website.css">


	</head>
	<body>
		<div id="global-loader" >
			<div class="whirly-loader"> </div>
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
					<hr>

											<div class="row">
					<?php
						if(isset($_REQUEST['qid'])){
							$qid = $_REQUEST['qid'];

							$sql ="UPDATE tbl_quote SET q_status='3' WHERE q_id='$qid'";
							$rs = $conn->query($sql);
							?>
							<h3 class="text-center text-primary">You have successfully accepted the quote from Prime Logistics for warehousing </h3>
							<p class="text-center">One of our agents will contact you soon.</p> <br>
				<?php }else{ ?>
					<h3 class="text-center text-primary">Something went wrong</h3>
					<p class="text-center">Please contact us for any information.</p> <br>
				<?php } ?>
					<hr>
				</div>
			</div>
    </div>












<!-- jQuery -->
    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <!-- Feather Icon JS -->
<script src="assets/js/feather.min.js"></script>

<!-- Slimscroll JS -->
<script src="assets/js/jquery.slimscroll.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Datatable JS -->
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>

<!-- Bootstrap Core JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

<!-- Owl JS Added-->
<script src="assets/plugins/owlcarousel/owl.carousel.min.js"></script>



<!-- Sweetalert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom JS -->
<script src="assets/js/script.js"></script>

<!-- Datetimepicker JS -->
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

<!-- Chart JS -->
<script src="assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="assets/plugins/apexchart/chart-data.js"></script>
<script src="homepage.js">  </script>
</body>
</html>
