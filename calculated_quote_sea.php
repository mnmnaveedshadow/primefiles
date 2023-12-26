<?php include 'backend/conn.php'; ?>

<?php

$qid = $_REQUEST['q_id'];

$_SESSION['qid'] = $qid;

$sql_quote = "SELECT * FROM tbl_quote WHERE q_id='$qid'";
$rs_quote = $conn->query($sql_quote);

if($rs_quote->num_rows > 0){
	$row_q = $rs_quote->fetch_assoc();
}
else {
	header('location:index.php');
	exit();
}

$qout_st = $row_q['q_status'];

if($qout_st == 0){
	$sql_update = "UPDATE tbl_quote SET u_id='$u_id',q_status='4' WHERE q_id='$qid'";
	$rs_update = $conn->query($sql_update);
}

$sql_quote = "SELECT * FROM tbl_quote WHERE q_id='$qid'";
$rs_quote = $conn->query($sql_quote);

if($rs_quote->num_rows > 0){
	$row_q = $rs_quote->fetch_assoc();
}

$m_type = 1;

$q_validity = $row_q['q_validity'];
$q_profit = $row_q['q_profit'];

$qoute_user = $row_q['u_id'];

$q_cus = $row_q['c_id'];
$cus_airline = $row_q['airline_id'];

$sql_customer="SELECT * FROM tbl_customer_info WHERE c_id='$q_cus'";
$rs_customer = $conn->query($sql_customer);

if($rs_customer->num_rows >0){
	$rowC = $rs_customer->fetch_assoc();

	$cName = $rowC['c_name'];
	$cCompany = $rowC['c_company'];
	$cCountry = $rowC['country_id'];
	$cAddress = $rowC['c_address'];
	$cPhone = $rowC['u_phone'];
	$cEmail = $rowC['c_email'];
}

$sql_c_odm = "SELECT * FROM tbl_customer_odm WHERE q_id='$qid'";
$rs_c_odm = $conn->query($sql_c_odm);
if($rs_c_odm->num_rows > 0){
	$row_codm = $rs_c_odm->fetch_assoc();
}

$m_type = $row_codm['odm_mtype'];
$s_type = $row_codm['tos'];

$odm_orgin_country = $row_codm['odm_orgin_country'];
$odm_orgin_city = $row_codm['odm_orgin_city'];
$odm_orgin_a_s_b = $row_codm['odm_orgin_a_s_b'];

$odm_desti_country = $row_codm['odm_desti_country'];
$odm_desti_city = $row_codm['odm_desti_city'];
$odm_desti_a_s_b = $row_codm['odm_desti_a_s_b'];

											$tot_air_charge=0;
											$currency_text=0;

											$myArray =  array();
											$myArray2 =array();
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Prime Logistics Quotation</title>

  </head>
  <body>

    <div class="container-fluid">
			<table style="width:100%;">
				<tr>
					<td>
						<img src="https://skillheist.com/prime/logo/New-logo-Prime.png" style="width:200px;" alt="">
					</td>
					<td>
						<img src="https://skillheist.com/prime/logo/prime_ex.jpg" style="width:200px;float:right;" alt="">
					</td>
				</tr>
			</table>




            <h1 class="text-center">Quotation</h1>
						<table style="width:100%;">
							<tr>
								<td>

									<p>Our Reference: <b>PL-I-<?= $qid ?> </b> </p> <br>
									<p>Company:<?= $cCompany ?></p> <br>
									<p>Attn:<?= $cName ?></p>
									<p>Phone: <?= $cPhone ?></p>
									<p>Email: <?= $cEmail ?></p>
								</td>
								<td  style="float:right;">
									<p>Date: <?= date('Y-m-d') ?></p> <br>
												<p>Prime Logistics FZCO <br> Warehouse G09 PO Box 371961 <br> Dubai United Arab Emirates</p> <br>
												<p>Telephone: +97104 299 0060</p> <br>
								</td>
							</tr>
						</table> <br>

						<table style="width:100%;">
							<tr>
								<td>
									Quotation Date: <?= date('Y-m-d') ?>
									<br><br>
                                        COUNTRY : <?= getDataBack($conn,'countries','country_id',$odm_orgin_country,'name'); ?>
                                        <br>
                                        CITY: <?= getDataBack($conn,'cities','city_id',$odm_orgin_city,'name'); ?>
                                        <br>
                                        Origin: <?= getDataBack($conn,'tbl_sea_port','sp_id',$odm_orgin_a_s_b,'sp_name'); ?>
								</td>
								<td style="float:right;">

																				Valid To: 2023-12-31
																				<br><br>
                                                                                COUNTRY : <?= getDataBack($conn,'countries','country_id',$odm_desti_country,'name'); ?>
                <br>
                CITY: <?= getDataBack($conn,'cities','city_id',$odm_desti_city,'name'); ?>
                <br>
                DESTINATION:<?= getDataBack($conn,'tbl_sea_port','sp_id',$odm_desti_a_s_b,'sp_name'); ?> <br>
								</td>
							</tr>
						</table> <br>



																	<p style="text-align:center;">
																		<?php
																			if($m_type == 1){
																				echo "Door to Door";
																			}
																			elseif ($m_type == 2) {
																				echo "Door to Airport";
																			}
																			elseif ($m_type == 3) {
																				echo "Airport to Airport";
																			}
																			elseif ($m_type == 4) {
																				echo "Airport to Door";
																			}
																		 ?>
																	</p>

																	Product : General Cargo
																	<br><br>

            <div class="row">

              <div class="col-12">
                <table style="border-collapse: collapse;width: 100%;">
								  <thead>
								      <tr>
													<th style="text-align: left;padding: 8px;">Cargo Type</th>
													<th style="text-align: left;padding: 8px;">Commodity Type</th>
													<th style="text-align: left;padding: 8px;">Package Type</th>
													<th style="text-align: left;padding: 8px;">Number Of Packages</th>
													<th style="text-align: left;padding: 8px;">Length (Cm)</th>
													<th style="text-align: left;padding: 8px;">Width (Cm)</th>
													<th style="text-align: left;padding: 8px;">Height (Cm)</th>
													<th style="text-align: left;padding: 8px;">Volume M3 </th>
													<th style="text-align: left;padding: 8px;">Weight(Kg)</th>
								        </tr>
								  </thead>
								  <tbody>
										<?php
										$tot_vol = 0;
										$tot_weight = 0;
										$charge_weight = 0;
										$tot_qty = 0;
										$sql = "SELECT * FROM tbl_package WHERE q_id='$qid' AND st=1";
										$rs = $conn->query($sql);

										if ($rs->num_rows > 0) {
												while ($row = $rs->fetch_assoc()) {
													$tot_qty += $row['p_qnty'];
													$vol = $row['p_l'] * $row['p_w'] * $row['p_h'] / 1000000;
													$tot_vol_each = $vol * $row['p_qnty'];
													$tot_weight += $row['p_weight'];

													$tot_vol += customRound($tot_vol_each);
													$cId= $row['ct_id'];
													$ptId =$row['pt_id'];
													$ctid = $row['ctype_id'];
														?>
														<tr>
															<td style="text-align: left;padding: 8px;"> <?= getDataBack($conn,'tbl_cargo_type','ctype_id',$ctid,'ctype'); ?> </td>
															<td style="text-align: left;padding: 8px;"> <?= $cId ?> </td>
															<td style="text-align: left;padding: 8px;"> <?= getDataBack($conn,'tbl_package_type','pt_id',$ptId,'pt_name'); ?> </td>
																<td style="text-align: left;padding: 8px;"><?= $row['p_qnty'] ?></td>
																<td style="text-align: left;padding: 8px;"><?= customRound($row['p_l']) ?></td>
																<td style="text-align: left;padding: 8px;"><?= customRound($row['p_w']) ?></td>
																<td style="text-align: left;padding: 8px;"><?= customRound($row['p_h']) ?></td>
																<td style="text-align: left;padding: 8px;"><?= customRound($tot_vol_each) ?></td>
																<td style="text-align: left;padding: 8px;"><?= $row['p_weight'] ?></td>
														</tr>
								   <?php } } ?>

									 <?php
									 $charge_weight = customRound($charge_weight,2);
									 $rpVolune = customRound($tot_vol);
										?>
								  </tbody>

								</table> <br> <br><br><br><br><br> <br>
								<table style="width:100%;">
									<tr>
										<td><h6 style="font-size:16px;">Total Volume: <?= $tot_vol ?></h6></td>
										<td><h6 style="font-size:16px;">Total Qty: <?= $tot_qty ?></h6></td>
										<td><h6 style="font-size:16px;">Total Weight: <?= $tot_weight ?></h6></td>
									</tr>
									<tr>
										<td><h6 style="font-size:16px;">Round UP Volume: <?= customRound($tot_vol) ?></h6></td>
										<td><h6 style="font-size:16px;">Round UP Weight: <?= customRound($tot_weight/1000) ?></h6></td>
										<td><h6 style="font-size:16px;">Chargable Weight: <?= customRound($charge_weight) ?></h6></td>
									</tr>
									<tr>
										<td colspan="3"><h6 style="font-size:16px;">Selected Service: <?= getService($s_type); ?></h6></td>
									</tr>
								</table>







  <br><br> <br><br>

	<h2>Quote Breakdown  </h2> <hr>
	<h4>Sea Freight Charge</h4> <hr>
	<?php
		$sel_con =0;
		if($row_q['sel_con'] == 0){
			$sqlSeaCharge = "SELECT * FROM tbl_sea_charges WHERE
			country_id='$odm_orgin_country' AND city_id='$odm_orgin_city' AND seaport_id='$odm_orgin_a_s_b' AND
			country_id_dest='$odm_desti_country' AND city_id_dest='$odm_desti_city' AND seaport_id_dest='$odm_desti_a_s_b'
			AND sc_min_weight <= $charge_weight AND sc_max_weight >= $charge_weight AND sc_min_cbm <= $tot_vol AND sc_max_cbm >= $tot_vol AND sc_tos='$s_type'";
		}else{
			$sel_con = $row_q['sel_con'];
			$sqlSeaCharge = "SELECT * FROM tbl_sea_charges WHERE
			country_id='$odm_orgin_country' AND city_id='$odm_orgin_city' AND seaport_id='$odm_orgin_a_s_b' AND
			country_id_dest='$odm_desti_country' AND city_id_dest='$odm_desti_city' AND seaport_id_dest='$odm_desti_a_s_b'
			AND sc_min_weight <= $charge_weight AND sc_max_weight >= $charge_weight AND sc_min_cbm <= $tot_vol AND sc_max_cbm >= $tot_vol AND sc_tos='$s_type' AND sc_toc='$sel_con'";
		}
		$rsSeaCharge = $conn->query($sqlSeaCharge);
	 ?>
	 <div class="table-responsive">
		 <table class="table" style="width:100%;">
			 <thead>
				 <tr>
					 <th style="text-align: left;padding: 8px;">Type Of Container</th>
					 <th style="text-align: left;padding: 8px;">Description</th>
					 <th style="text-align: left;padding: 8px;">Charge amount</th>
					 <th style="text-align: left;padding: 8px;">Transit Days</th>
				 </tr>
			 </thead>
			 <tbody>
				 <?php
				 $totSeaCharge=0;
				 if($rsSeaCharge->num_rows > 0){
					 while($row_data= $rsSeaCharge->fetch_assoc()){
						 $id=$row_data['sc_id'];

						 $country_id = $row_data['country_id'];
						 $city_id = $row_data['city_id'];
						 $seaport_id = $row_data['seaport_id'];

						 $country_dest_id = $row_data['country_id_dest'];
						 $city_dest_id = $row_data['city_id_dest'];
						 $seaport_dest_id = $row_data['seaport_id_dest'];

						 $uom = $row_data['sc_uom'];
						 $currency = $row_data['sc_currency'];
						 $v_id=$row_data['vn_id'];

						 $tocontainer = $row_data['sc_toc'];
						 $service = $row_data['sc_tos'];

						 $scrid = $row_data['sc_cr_id'];
						 $ctpye_id = $row_data['cargo_type'];

				 ?>
				 <tr>
					 <?php if($row_q['sel_con'] != 0 && $s_type == 1){ ?>
					 <td style="text-align: left;padding: 8px;"> <?= getDataBack($conn,'tbl_container','cr_id',$tocontainer,'cr_name'); ?></td>
				 <?php }else{ ?>
					 <td style="text-align: left;padding: 8px;"> <a href="backend/sel_container.php?qid=<?= $qid ?>&con_id=<?= $tocontainer ?>"><?= getDataBack($conn,'tbl_container','cr_id',$tocontainer,'cr_name'); ?></a> </td>
				 <?php } ?>
					 <td style="text-align: left;padding: 8px;"> <?= $row_data['sc_desc'] ?> </td>
					 <td style="text-align: left;padding: 8px;"> <?= $row_data['sc_charge_amount'] ?> <?= getCurrency($currency) ?></td>
					 <td style="text-align: left;padding: 8px;"> <?= $row_data['sc_transit_days'] ?> </td>
				 </tr>
				 <?php $totSeaCharge +=$row_data['sc_charge_amount']; ?>
				 <?php
			 } }else{
					?>
						<tr>
							<td colspan="5" style="text-align: left;padding: 8px;">No Data Found</td>
						</tr>
				<?php } ?>
			 </tbody>
		 </table>
	 </div> <br><br>
	 <h6 style="font-size:16px;text-align: right;font-weight:bold;text-align:right;"> Total Sea Freight Charge: <?= customRound($totSeaCharge) ?> AED </h6>
	 <br><br>
    <br><br>
    <div class="row">
      <?php if($m_type == 1 || $m_type == 2){ ?>
      <div class="col-12">
        <h4>Origin Charges</h4>
				<table style="width:100%;">
					<thead>
						<tr>
								<th style="text-align: left;padding: 8px;">Description</th>
								<th style="text-align: left;padding: 8px;">Charge</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$totSeaOriginCharge=0;
						$sql = "SELECT * FROM `tbl_sea_orgin_charge` WHERE country_id='$odm_orgin_country' AND city_id='$odm_orgin_city' AND sp_id='$odm_orgin_a_s_b' AND soc_tos='$s_type' AND soc_toc='$sel_con'";
						$rs = $conn->query($sql);
						if($rs->num_rows >0){
							while($row = $rs->fetch_assoc()){
								$id  = $row['soc_id'];
								$country_id = $row['country_id'];
								$city_id = $row['city_id'];
								$seaport_id = $row['sp_id'];

								$uom = $row['soc_uom'];
								$currency = $row['soc_currency'];
								$v_id=$row['soc_vendor'];
								$service = $row['soc_tos'];
								$tocontainer = $row['soc_toc'];
								 ?>
							<tr>
								<td style="text-align: left;padding: 8px;"><?= $row['soc_desc'] ?></td>
								<td style="text-align: left;padding: 8px;"> <?= number_format($row['soc_charge'], 2); ?> AED</td>
							</tr>
						<?php $totSeaOriginCharge+=$row['soc_charge']; }  ?>

						<tr>
							<td colspan="2"> <hr> </td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td style="text-align:right;"> <span style="font-size:16px;text-align: right;font-weight:bold;">Total Charge:  <?= number_format($totSeaOriginCharge,2) ?> AED </span> </td>
						</tr>
					<?php }else{ ?>
						<tr>
							<td colspan="2" style="text-align: left;padding: 8px;"> No Data Found</td>
						</tr>
					<?php } ?>
					</tbody>

				</table>
        <br><br>
      </div>
    <?php }  ?>
    <?php if($m_type == 1 || $m_type == 4){ ?>

      <div class="col-12">
  <br><br><br>
        <h4>Destination Charges</h4>
        <table style="width:100%;">
          <thead>
            <tr>
                <th style="text-align: left;padding: 8px;">Description</th>
                <th style="text-align: left;padding: 8px;">Charge</th>
            </tr>
          </thead>
          <tbody>
						<?php
						$totSeaDestiCharge=0;
						$sql = "SELECT * FROM `tbl_sea_dest_charge`
						WHERE country_id='$odm_desti_country' AND
						city_id='$odm_desti_city' AND sp_id='$odm_desti_a_s_b' AND sdc_tos='$s_type' AND sdc_toc='$sel_con'";

						$rs = $conn->query($sql);
						if($rs->num_rows >0){
							while($row = $rs->fetch_assoc()){
								$id  = $row['sdc_id'];
								$country_id = $row['country_id'];
								$city_id = $row['city_id'];
								$seaport_id = $row['sp_id'];

								$uom = $row['sdc_uom'];
								$currency = $row['sdc_currency'];
								$v_id=$row['sdc_vendor'];
								$service = $row['sdc_tos'];
								$tocontainer = $row['sdc_toc'];
								 ?>
              <tr>
														           <td style="text-align: left;padding: 8px;"><?= $row['sdc_desc'] ?></td>
														           <td style="text-align: left;padding: 8px;"><?= $row['sdc_charge'] ?></td>
              </tr>
            <?php  $totSeaDestiCharge+=$row['sdc_charge']; } ?>
						<tr>
							<td colspan="3"> <hr> </td>
						</tr>
              <tr>
                <td colspan="3" style="font-size:16px;text-align: right;padding: 8px;"> <span style="font-weight:bold;">Total Charge <?= $totSeaDestiCharge ?> AED </span> </td>
              </tr>
          <?php }else{ ?>
            <tr>
              <td colspan="3" style="text-align: left;padding: 8px;">No Data Found</td>
            </tr>
          <?php } ?>
          </tbody>

        </table>
      </div>
    <?php }  ?>
    <br>

      <?php
      $tot_other_charges =0;
        $sql_other_charge = "SELECT * FROM tbl_other_charges WHERE q_id='$qid'";
        $rs_other_charge = $conn->query($sql_other_charge);
        if($rs_other_charge->num_rows > 0){
       ?>
    <div class="col-12">
      <br><br>
      <h4>Other Charges</h4>
			<table style="width:100%;">
				<thead>
					<tr>
							<th style="text-align: left;padding: 8px;">Description</th>
							<th style="text-align: right;padding: 8px;">Charge</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($rowO = $rs_other_charge->fetch_assoc()){
					 ?>
					 <tr>
						<td style="text-align: left;padding: 8px;"><?= $rowO['oc_charge_name'] ?></td>
						<td style="text-align: right;padding: 8px;"><?= number_format($rowO['oc_charge'],2) ?> AED</td>
					 </tr>
				 <?php $tot_other_charges +=$rowO['oc_charge']; } ?>
				 <tr>
					 <td colspan="3"> <hr> </td>
				 </tr>
				 <tr>
				 	<td> &nbsp;  </td>
					<td style="font-size:16px;text-align: right;padding: 8px;font-weight:bold;"> Total Charge: <?= number_format($tot_other_charges,2) ?> </td>
				 </tr>
				</tbody>
			</table>
    </div>
  <?php } ?>
    </div>
    <br><br><br><br>
		<?php $cal_profit = $totSeaCharge * $q_profit/100; ?>
    <h3 style="text-align: left;padding: 8px;font-size:18px;font-weight:bold;">Total Price: 	<?= customRound($totSeaDestiCharge + $totSeaOriginCharge + $totSeaCharge + $cal_profit + $tot_other_charges) ?> AED</h3>


<?php
	$sqlNote = "SELECT * FROM tbl_extra_note WHERE q_id='$qid'";
	$rsNote = $conn->query($sqlNote);
	if($rsNote->num_rows > 0){
 ?>
<br><br>
<br><br>
<br><br>
<h3>Dispatch by Prime Logistics</h3>
<hr>
<?php while($rowN = $rsNote->fetch_assoc()){ ?>
	<p><?= $rowN['ex_note_text'] ?></p>
<?php } ?>
<?php }  ?>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
      <h3>Terms and Condition by Sea Freight</h3>
			<hr>
			<div>
					<?= getDataBack($conn,'tbl_tc','service_type',2,'tc_text') ?>
			</div>


  </div>
              </div>
            </div>
    </div><!-- End of container -->

    <script type="text/javascript">
      print();
    </script>
  </body>
</html>
