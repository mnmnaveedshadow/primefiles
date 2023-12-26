<?php include 'backend/conn.php'; ?>

<?php

$qid = $_SESSION['qid'];

$sql_quote = "SELECT * FROM tbl_quote WHERE q_id='$qid'";
$rs_quote = $conn->query($sql_quote);

if($rs_quote->num_rows > 0){
	$row_q = $rs_quote->fetch_assoc();
}
else {
	header('location:index.php');
	exit();
}

$m_type = 1;

$q_validity = $row_q['q_validity'];
$q_profit = $row_q['q_profit'];

$q_cus = $row_q['c_id'];

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

$odm_orgin_country = $row_codm['odm_orgin_country'];
$odm_orgin_city = $row_codm['odm_orgin_city'];
$odm_orgin_a_s_b = $row_codm['odm_orgin_a_s_b'];

$odm_desti_country = $row_codm['odm_desti_country'];
$odm_desti_city = $row_codm['odm_desti_city'];
$odm_desti_a_s_b = $row_codm['odm_desti_a_s_b'];

$currency_text=0;
$tot_air_charge=0;
$currency_text=0;

$myArray =  array();
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
									<p>Company:<?= $cCompany ?></p> <br>
									<p>Attn:<?= $cName ?></p>
									<p>Phone: <?= $cPhone ?></p>
									<p>Email: <?= $cEmail ?></p>
								</td>
								<td  style="float:right;">
									<p>Date: <?= date('Y-m-d') ?></p> <br>
												<p>Prime Logistics FZCO Warehouse <br> G09 PO Box 371961 <br> Dubai United Arab Emirates</p> <br>
												<p>Our Reference: <b>PL-I-<?= $qid ?> </b> </p> <br>
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
                                        Origin: <?= getDataBack($conn,'airports','airport_id',$odm_orgin_a_s_b,'code'); ?>
								</td>
								<td style="float:right;">

																				Valid To: 2023-12-31
																				<br><br>
                                                                                COUNTRY : <?= getDataBack($conn,'countries','country_id',$odm_desti_country,'name'); ?>
                <br>
                CITY: <?= getDataBack($conn,'cities','city_id',$odm_desti_city,'name'); ?>
                <br>
                DESTINATION:<?= getDataBack($conn,'airports','airport_id',$odm_desti_a_s_b,'code'); ?> <br>
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

																	Product : Genrel Cargo
																	<br><br>

            <div class="row">

              <div class="col-12">
                <table style="border-collapse: collapse;width: 100%;">
								  <thead>
								      <tr>
								          <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">No of packages</th>
							          	<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Length (CM) </th>
								          <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Width (CM)</th>
								          <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Height (CM)</th>
								          <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Volume </th>
													<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Total Volume </th>
								          <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Weight (Kg)</th>
								        </tr>
								  </thead>
								  <tbody>
								    <?php
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
																				$tot_vol_each = $vol * $row['p_qnty'];
												$tot_weight +=$row['p_weight'];


												$tot_vol += customRound($tot_vol_each);

												if($tot_weight > $tot_vol){
													$charge_weight = $tot_weight;
												}
												else {
													$charge_weight = $tot_vol;
												}

								     ?>
										 <tr>
								       <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row['p_qnty'] ?>  </td>
								       <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row['p_l'] ?>  </td>
								       <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row['p_w'] ?>  </td>
								       <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row['p_h'] ?>  </td>
								       <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= customRound($vol) ?>  </td>
                       <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= customRound($tot_vol_each) ?></td>
								       <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= customRound($row['p_weight']) ?>  </td>
								     </tr>
								   <?php } } ?>


								  </tbody>
								</table>
								<br> <br>
								<div style="width:25%;margin-right:10px;display:inline;">
									<p style="border:1px solid #000;padding:10px 10px 10px 10px;width:100%;display:inline;">Total Volume: <?= customRound($tot_vol) ?></p>
								</div>
								<div style="width:25%;margin-right:10px;display:inline;">
									<p style="border:1px solid #000;padding:10px 10px 10px 10px;width:100%;display:inline;">Total Qty: <?= $tot_qty ?></p>
								</div>
								<div style="width:25%;margin-right:10px;display:inline;">
									<p style="border:1px solid #000;padding:10px 10px 10px 10px;width:100%;display:inline;">Total Weight: <?= customRound($tot_weight) ?></p>
								</div>
								<div style="width:25%;margin-right:10px;display:inline;">
									<p style="border:1px solid #000;padding:10px 10px 10px 10px;width:100%;display:inline;">Chargeable Weight: <?= customRound($charge_weight) ?></p>
								</div>
								                                <?php $charge_weight =customRound($charge_weight); ?>
  <br><br> <br><br>

		<?php
		$sql_data = "SELECT * FROM tbl_air_frieght WHERE
									country_id='$odm_orgin_country' AND city_id='$odm_orgin_city' AND airport_id='$odm_orgin_a_s_b' AND
									country_id_dest='$odm_desti_country' AND city_id_dest='$odm_desti_city' AND airport_id_dest='$odm_desti_a_s_b' AND af_min_weight <= $charge_weight AND af_max_weight >= $charge_weight AND other_charge='0'";
		$rs_data=$conn->query($sql_data);
		if($rs_data->num_rows == 0){
		 ?>
		 <h3>Air Frieght Data not found for this quote</h3>
	 <?php }else{ ?>
		 <?php
		 $sqlAirline = "SELECT * FROM tbl_airlines";
		 $rsAirline = $conn->query($sqlAirline);
		 if($rsAirline->num_rows > 0){
			 while($rowAir = $rsAirline->fetch_assoc()){
			 $aid = $rowAir['al_id'];
			 $sql_data_check = "SELECT * FROM tbl_air_frieght WHERE al_id='$aid' AND
										 country_id='$odm_orgin_country' AND city_id='$odm_orgin_city' AND airport_id='$odm_orgin_a_s_b' AND
										 country_id_dest='$odm_desti_country' AND city_id_dest='$odm_desti_city' AND airport_id_dest='$odm_desti_a_s_b' AND af_min_weight <= $charge_weight AND af_max_weight >= $charge_weight";
			 $rs_data_check = $conn->query($sql_data_check);
			 if($rs_data_check->num_rows > 0){
			?>
			<br>
		 <h4>Air Freight Charges - <?= $rowAir['air_line_name'] ?></h4>
		 <br>
		 <div class="table-responsive">
			 <table class="table">
				 <thead>
					 <tr>
						 <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Vendor</th>
						 <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Airline</th>
						 <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Description</th>
						 <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Min Weight</th>
						 <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Max Weight</th>
						 <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Charge amount</th>
						 <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Total Amount</th>
						 <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Currency</th>
						 <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">UOM</th>
						 <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Validity</th>
					 </tr>
				 </thead>
				 <tbody>
					 <?php
					 $tot_air_charge=0;
					 $aircharge =0;
					 $odm_orgin_country = $row_codm['odm_orgin_country'];
					 $odm_orgin_city = $row_codm['odm_orgin_city'];
					 $odm_orgin_a_s_b = $row_codm['odm_orgin_a_s_b'];

					 $odm_desti_country = $row_codm['odm_desti_country'];
					 $odm_desti_city = $row_codm['odm_desti_city'];
					 $odm_desti_a_s_b = $row_codm['odm_desti_a_s_b'];

					 $sql_data = "SELECT * FROM tbl_air_frieght WHERE al_id='$aid' AND
												 country_id='$odm_orgin_country' AND city_id='$odm_orgin_city' AND airport_id='$odm_orgin_a_s_b' AND
												 country_id_dest='$odm_desti_country' AND city_id_dest='$odm_desti_city' AND airport_id_dest='$odm_desti_a_s_b' AND af_min_weight <= $charge_weight AND af_max_weight >= $charge_weight";
					 $rs_data = $conn->query($sql_data);

					 if($rs_data->num_rows > 0){
						 while($row_data= $rs_data->fetch_assoc()){
							 $id=$row_data['af_id'];

							 $country_id = $row_data['country_id'];
							 $city_id = $row_data['city_id'];
							 $airport_id = $row_data['airport_id'];

							 $country_dest_id = $row_data['country_id_dest'];
							 $city_dest_id = $row_data['city_id_dest'];
							 $airport_dest_id = $row_data['airport_id_dest'];

							 $uom = $row_data['af_uom'];
							 $currency = $row_data['af_currency'];
							 $v_id=$row_data['vn_id'];
							 $a_id=$row_data['al_id'];

							 if($row_data['other_charge'] == 1){
								 if($uom == 1){
									 $tot_air_charge +=$row_data['af_charge'];
								 }
								 else{
									 $tot_air_charge +=$row_data['af_charge'] * round($tot_weight,2);
								 }
							 } //othercharge
							 else {
								 if($row_data['af_min_weight'] == 0){
									 $tot_air_charge +=$row_data['af_charge'];
									 $aircharge  +=$row_data['af_charge'];
								 }else{
									 $tot_air_charge +=$row_data['af_charge'] * $charge_weight;
									 $aircharge  +=$row_data['af_charge'] * $charge_weight;
								 }

							 }
							 $currency_text=getCurrency($currency);
					 ?>
					 <tr>

						 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= getDataBack($conn,'tbl_air_vendor','av_id',$v_id,'av_name'); ?></td>
						 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= getDataBack($conn,'tbl_airlines','al_id',$a_id,'air_line_name'); ?></td>
						 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row_data['af_description'] ?> </td>
						 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row_data['af_min_weight'] ?> </td>
						 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row_data['af_max_weight'] ?> </td>
						 <?php if($row_data['other_charge'] == 1){
								 if($uom == 1){
								?>
							 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row_data['af_charge'] ?> </td>
							 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row_data['af_charge'] ?></td>
						 <?php }else{
						 ?>
						 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row_data['af_charge'] ?> * <?= customRound($charge_weight) ?> </td>
						 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row_data['af_charge'] * customRound($charge_weight) ?></td>
						 <?php
					 } }else{ ?>
																		 <?php if($row_data['af_min_weight'] == 0){
																			 	$add_profit = $row_data['af_charge'] * $q_profit / 100;
																			 ?>
						 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row_data['af_charge'] ?> </td>
						 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row_data['af_charge'] + $add_profit ?> </td>
																 <?php }else{ $add_profit = $row_data['af_charge'] * $q_profit / 100; ?>
																		 <td> <?= $row_data['af_charge'] ?> * <?= customRound($charge_weight) ?> </td>
						 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row_data['af_charge'] * customRound($charge_weight) + $add_profit ?>  </td>
																		 <?php } ?>
					 <?php } ?>
						 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= getCurrency($currency) ?></td>
						 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= getUom($uom) ?></td>
						 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row_data['af_validity'] ?> </td>
					 </tr>
					 <?php
				 } ?>
				 <tr>

					 <?php $myArray[] = array($rowAir['air_line_name'], customRound($tot_air_charge), customRound($aircharge)); ?>
					 <td colspan="16" style="border: 1px solid #dddddd;text-align: right;padding: 8px;"> <span style="font-weight:bold;">Total Air Charge:</span>  <?= customRound($tot_air_charge) + $add_profit ?> <?= $currency_text ?>

					 </td>
				 </tr>
			 <?php }
						?>
				 </tbody>
			 </table>
		 </div>
	 <?php } } ?>
 <?php } } ?>
     <br>
    <br><br>
    <div class="row">
      <?php if($m_type == 1 || $m_type == 2){ ?>
      <div class="col-12">
        <h4>Origin Charges</h4>
				<table class="table">
					<thead>
						<tr>
								<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Vendor</th>
								<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Description</th>
								<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Charge</th>
								<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Total Charge</th>
								<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Currency</th>
								<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">UOM</th>
								<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Minimum</th>
								<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">VALIDITY</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sql = "SELECT * FROM `tbl_air_orgin_charge` WHERE country_id='$odm_orgin_country' AND city_id='$odm_orgin_city' AND airport_id='$odm_orgin_a_s_b'";

						$rs = $conn->query($sql);
						if($rs->num_rows >0){

							$tot_orgin_charge= 0;
							while($row = $rs->fetch_assoc()){
								$id  = $row['aoc_id'];
								$country_id = $row['country_id'];
								$city_id = $row['city_id'];
								$airport_id = $row['airport_id'];

								$uom = $row['aoc_uom'];
								$currency = $row['aoc_currency'];
								$v_id=$row['aoc_vendor'];
								 ?>
							<tr>
								<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= getDataBack($conn,'tbl_air_vendor','av_id',$v_id,'av_name'); ?></td>
								<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $row['aoc_description'] ?></td>
								<?php
								$qnt_m=0;
									if($uom == 3){
										$qnt_m = $tot_qty;
									}
									elseif ($uom == 2) {
										$qnt_m = $charge_weight;
									}
									$currency_text=getCurrency($currency);
								 ?>

							<?php if($uom == 1){ ?>

												<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row['aoc_charge'] ?></td>
								<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row['aoc_charge'] ?></td>
							<?php $tot_orgin_charge +=$row['aoc_charge']; }else{
																						$chrg = $row['aoc_charge'] * customRound($qnt_m);
																						if($row['aoc_min'] > $chrg){
																				?>
																				<td><?= $row['aoc_min'] ?></td>
								<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row['aoc_min'] ?></td>
																				<?php $tot_orgin_charge +=$row['aoc_min']; }else{ ?>
								<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row['aoc_charge'] ?> * <?= customRound($qnt_m) ?></td>
								<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row['aoc_charge'] * customRound($qnt_m) ?></td>
																				<?php $tot_orgin_charge +=$row['aoc_charge'] * customRound($qnt_m); } ?>
							<?php  } ?>

								<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= getCurrency($currency) ?></td>
								<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= getUom($uom) ?></td>
								<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row['aoc_min'] ?></td>
								<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row['aoc_validity'] ?></td>

							</tr>
						<?php } ?>

						<tr>
							<td colspan="8" style="border: 1px solid #dddddd;text-align: right;padding: 8px;"> <span style="font-weight:bold;">Total Charge</span> <?= $tot_orgin_charge ?> <?= $currency_text ?> </td>
						</tr>
					<?php }else{ ?>
						<tr>
							<td colspan="5" style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> No Data Found</td>
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
        <table class="table">
          <thead>
            <tr>
                <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Country</th>
                <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">City</th>
                <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Airport</th>
                <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Vendor</th>
                <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Description</th>
                <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Charge</th>
                <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Total Charge</th>
                <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Currency</th>
                <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">UOM</th>
                <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Minimum</th>
                <th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">VALIDITY</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $tot_desti_charge = 0;
            $sql = "SELECT * FROM `tbl_air_dest_charge` WHERE country_id='$odm_desti_country' AND city_id='$odm_desti_city' AND airport_id='$odm_desti_a_s_b'";

            $rs = $conn->query($sql);
            if($rs->num_rows >0){
              while($row = $rs->fetch_assoc()){
                $id  = $row['adc_id'];
                $country_id = $row['country_id'];
                $city_id = $row['city_id'];
                $airport_id = $row['airport_id'];

                $uom = $row['adc_uom'];
                $currency = $row['adc_currency'];
                $v_id=$row['adc_vendor'];

                 ?>
              <tr>

                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= getDataBack($conn,'countries','country_id',$country_id,'name'); ?></td>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= getDataBack($conn,'cities','city_id',$city_id,'name'); ?></td>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= getDataBack($conn,'airports','airport_id',$airport_id,'code'); ?></td>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= getDataBack($conn,'tbl_air_vendor','av_id',$v_id,'av_name'); ?></td>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $row['adc_description'] ?></td>
                <?php
                $qnt_m=0;
                  if($uom == 3){
                    $qnt_m = $tot_qty;
                  }
                  elseif ($uom == 2) {
                    $qnt_m = $charge_weight;
                  }
                 ?>
                 <?php if($uom == 1){ ?>
                 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $row['adc_charge'] ?></td>
                 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $row['adc_charge'] ?></td>
               <?php $tot_desti_charge +=$row['adc_charge']; }else{ ?>
                 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $row['adc_charge'] ?> * <?= $qnt_m ?></td>
                 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $row['adc_charge'] * $qnt_m ?></td>
               <?php $tot_desti_charge +=$row['adc_charge'] * $qnt_m; } ?>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= getCurrency($currency) ?></td>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= getUom($uom) ?></td>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $row['adc_min'] ?></td>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $row['adc_validity'] ?></td>

              </tr>
            <?php  } ?>

              <tr>
                <td colspan="11" style="border: 1px solid #dddddd;text-align: right;padding: 8px;"> <span style="font-weight:bold;">Total Charge</span> <?= $tot_desti_charge ?> AED </td>
              </tr>
          <?php }else{ ?>
            <tr>
              <td colspan="5" style="border: 1px solid #dddddd;text-align: left;padding: 8px;">No Data Found</td>
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
			<table class="table">
				<thead>
					<tr>
							<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Description</th>
							<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Charge</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($rowO = $rs_other_charge->fetch_assoc()){
					 ?>
					 <tr>
						<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $rowO['oc_charge_name'] ?></td>
						<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $rowO['oc_charge'] ?></td>
					 </tr>
				 <?php $tot_other_charges +=$rowO['oc_charge']; } ?>
				</tbody>
			</table>
    </div>
  <?php } ?>
    </div>
    <br><br><br><br>
    <h5>Total Price</h5>
		<table class="table">
			<thead>
				<tr>
					<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">AirLine</th>
					<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Price</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($myArray as $row) {
					$tot_cost_cal = $row[2] * $q_profit /100;
					 ?>
				<tr>
					<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $row[0]  ?></td>
					<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?=  $row[1] + $tot_desti_charge + $tot_orgin_charge + $tot_other_charges + $tot_cost_cal  ?> </td>
				</tr>
			<?php } ?>
			</tbody>
		</table>

<br><br>
<br><br>
<br><br>
<br><br>
      <h3>Terms and Condition by Air Freight</h3>
			<br><br>
      <p>*Rate valid for stackable and for general cargo only. <br>
*Subject for space availability upon booking confirmation<br>
*Shipper and consignee should provide all required document and any certificate require in
origin and destination for export and clearance under their own license.<br>
*Shipment should be suitable packed by air cargo unless packing charge will apply.<br>
*Final chargeable weight will be based on the final AWB upon receiving the shipment in our
warehouse, whichever is higher from actual weight and dimension with calculation of L x W x H /
6000.<br>
*Its shipper and consignee responsibility to load and unload the shipment at Origin and Final
Destination, unless request.<br>
*Rate valid for 7 days or upon prior notice.<br>
*Other charges not mentioned above will be at cost if require, like shipping insurance, etc.
For any airline and to any destination: space is limited, timely booking is needed <br></p>

  </div>
              </div>
            </div>
    </div><!-- End of container -->

    <script type="text/javascript">
      print();
    </script>
  </body>
</html>
