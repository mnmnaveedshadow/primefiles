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
										 	<h3 class="text-center text-primary" id="sel_air_text">Select The Air Line You Want to proceed with</h3>
											<hr>
											<div class="row">
					<?php
						if(isset($_REQUEST['qid'])){
							$qid = $_REQUEST['qid'];

							$tot_vol =0;
							$tot_weight =0;
							$charge_weight=0;
							$tot_qty=0;
							$sql = "SELECT * FROM tbl_package WHERE q_id='$qid' AND st=1";
							$rs = $conn->query($sql);

							if($rs->num_rows > 0){
								while($row = $rs->fetch_assoc()){
									$tot_qty +=$row['p_qnty'];
									$vol = $row['p_l'] * $row['p_w'] * $row['p_h'] / 6000;
									$tot_weight +=$row['p_weight'];


									$tot_vol +=$vol;

									if($tot_weight > $tot_vol){
										$charge_weight = $tot_weight;
									}
									else {
										$charge_weight = $tot_vol;
									}
								}
							}

							$charge_weight = round($charge_weight,2);

							$sql = "SELECT * FROM tbl_quote WHERE q_id='$qid'";
							$rs = $conn->query($sql);
							if($rs->num_rows > 0){
								$row = $rs->fetch_assoc();
								$qs =$row['q_service'];
								$q_sta = $row['q_status'];
								$ar_id =$row['airline_id'];
								if($q_sta ==2){
								if($qs == 1){

									$sql_c_odm = "SELECT * FROM tbl_customer_odm WHERE q_id='$qid'";
									$rs_c_odm = $conn->query($sql_c_odm);
									if($rs_c_odm->num_rows > 0){
										$row_codm = $rs_c_odm->fetch_assoc();
									}

									$m_type = $row_codm['odm_mtype'];

									$odm_orgin_country = $row_codm['odm_orgin_country'];
									$odm_orgin_city = $row_codm['odm_orgin_city'];
									$odm_orgin_a_s_b = $row_codm['odm_orgin_a_s_b'];

									$odm_desti_country = $row_codm['odm_desti_country'];
									$odm_desti_city = $row_codm['odm_desti_city'];
									$odm_desti_a_s_b = $row_codm['odm_desti_a_s_b'];

									$sqlAirline = "SELECT * FROM tbl_airlines";
									$rsAirline = $conn->query($sqlAirline);
									if($rsAirline->num_rows > 0){
										while($rowAir = $rsAirline->fetch_assoc()){
										$aid = $rowAir['al_id'];
										$sql_data_check = "SELECT * FROM tbl_air_frieght WHERE al_id='$aid' AND
																	country_id='$odm_orgin_country' AND city_id='$odm_orgin_city' AND airport_id='$odm_orgin_a_s_b' AND
																	country_id_dest='$odm_desti_country' AND city_id_dest='$odm_desti_city' AND airport_id_dest='$odm_desti_a_s_b'
																	 AND af_min_weight <= $charge_weight AND af_max_weight >= $charge_weight";
										$rs_data_check = $conn->query($sql_data_check);
										if($rs_data_check->num_rows > 0){
					 ?>
					 <div class="col-6">
						  <br>
						 <div class="text-center">
							 <a href="backend/accept_air_q.php?ar_id=<?= $aid ?>&q_id=<?= $qid ?>" class="btn btn-warning"><?= $rowAir['air_line_name'] ?></a>
						 </div><br>
					 </div>
				 <?php } }  }?>
			 </div>
			 <hr>
		 <?php } }elseif($q_sta ==3){ ?>
			 <h3 class="text-center text-primary">You have successfully accepted the quote from Prime Logistics for <?= getDataBack($conn,'tbl_airlines','al_id',$ar_id,'air_line_name') ?> </h3>
			 <p class="text-center">One of our agents will contact you soon.</p> <br>
			 <script type="text/javascript">
			 	document.getElementById('sel_air_text').innerHTML = "";
			 </script>
		 <?php } ?>
				 <?php } ?>
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
