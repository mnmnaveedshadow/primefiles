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

									<p>Our Reference: <b>PL-I-<?= $qid ?> </b> </p> <br>
									<p>Company:<?= $cCompany ?></p> <br>
									<p>Attn:<?= $cName ?></p>
									<p>Phone: <?= $cPhone ?></p>
									<p>Email: <?= $cEmail ?></p>
								</td>
								<td  style="float:right;">
									<p>Date: <?= date('Y-m-d') ?></p> <br>
												<p>Prime Logistics FZCO Warehouse <br> G09 PO Box 371961 <br> Dubai United Arab Emirates</p> <br>
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

																	Product : General Cargo
																	<br><br>

            <div class="row">

              <div class="col-12">
                <table style="border-collapse: collapse;width: 100%;">
								  <thead>
								      <tr>
								          <th style="text-align: left;padding: 8px;">No of packages</th>
							          	<th style="text-align: left;padding: 8px;">Length (CM) </th>
								          <th style="text-align: left;padding: 8px;">Width (CM)</th>
								          <th style="text-align: left;padding: 8px;">Height (CM)</th>
								          <th style="text-align: left;padding: 8px;">Volume </th>
													<th style="text-align: left;padding: 8px;">Total Volume </th>
								          <th style="text-align: left;padding: 8px;">Weight (Kg)</th>
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
								       <td style="text-align: left;padding: 8px;"> <?= $row['p_qnty'] ?>  </td>
								       <td style="text-align: left;padding: 8px;"> <?= $row['p_l'] ?>  </td>
								       <td style="text-align: left;padding: 8px;"> <?= $row['p_w'] ?>  </td>
								       <td style="text-align: left;padding: 8px;"> <?= $row['p_h'] ?>  </td>
								       <td style="text-align: left;padding: 8px;"> <?= customRound($vol) ?>  </td>
                       <td style="text-align: left;padding: 8px;"><?= customRound($tot_vol_each) ?></td>
								       <td style="text-align: left;padding: 8px;"> <?= customRound($row['p_weight']) ?>  </td>
								     </tr>
								   <?php } } ?>
									 <tr>
								     <td colspan="3" style="text-align: left;padding: 8px;"> Total Volume  </td>
								     <td colspan="4" style="text-align: left;padding: 8px;"> <?= customRound($tot_vol) ?>  </td>
								   </tr>
								   <tr>
								     <td colspan="3" style="text-align: left;padding: 8px;"> Total Qty  </td>
								     <td colspan="4" style="text-align: left;padding: 8px;"> <?= $tot_qty ?>  </td>
								   </tr>
								   <tr>
								     <td colspan="3" style="text-align: left;padding: 8px;"> Total Weight  </td>
								     <td colspan="4" style="text-align: left;padding: 8px;"> <?= customRound($tot_weight) ?>  </td>
								   </tr>
								   <tr>
								     <td colspan="3" style="text-align: left;padding: 8px;"> Chargeable Weight  </td>
								     <td colspan="4" style="text-align: left;padding: 8px;"> <?= customRound($charge_weight) ?>  </td>
								   </tr>
                                <?php $charge_weight =customRound($charge_weight); ?>
								  </tbody>

								</table>
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
		 <div>
			 <table style="width:100%;">
				 <thead>
					 <tr>
						 <th style="text-align: left;padding: 8px;">Description</th>
						 <th style="text-align: left;padding: 8px;">Charge amount</th>
						 <th style="text-align: right;padding: 8px;">Total Amount</th>
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

						 <td style="text-align: left;padding: 8px;"> <?= $row_data['af_description'] ?> </td>
						 <?php if($row_data['other_charge'] == 1){
								 if($uom == 1){
								?>
							 <td style="text-align: left;padding: 8px;"> <?= number_format($row_data['af_charge'],2) ?> <?= $currency_text ?> </td>
							 <td style="text-align: right;padding: 8px;"> <?= number_format($row_data['af_charge'],2) ?> <?= $currency_text ?></td>
						 <?php }else{
						 ?>
						 <td style="text-align: left;padding: 8px;"> <?= number_format($row_data['af_charge'],2) ?> * <?= customRound($charge_weight) ?> <?= $currency_text ?> </td>
						 <td style="text-align: right;padding: 8px;"> <?= number_format($row_data['af_charge'] * customRound($charge_weight),2) ?> <?= $currency_text ?></td>
						 <?php
					 } }else{ ?>
																		 <?php if($row_data['af_min_weight'] == 0){
																			 	$add_profit = $row_data['af_charge'] * $q_profit / 100;
																			 ?>
						 <td style="text-align: left;padding: 8px;"> <?= number_format($row_data['af_charge'] + $add_profit,2) ?> <?= $currency_text ?> </td>
						 <td style="text-align: right;padding: 8px;"> <?= number_format($row_data['af_charge'] + $add_profit,2) ?> <?= $currency_text ?> </td>
					 <?php }else{ $add_profit = ($row_data['af_charge'] * customRound($charge_weight)) * $q_profit / 100;
						 						$add_profit_single = $row_data['af_charge'] * $q_profit / 100;
						  ?>
																		 <td style="text-align: left;padding: 8px;"> <?= number_format($row_data['af_charge']+$add_profit_single,2) ?> * <?= customRound($charge_weight) ?> <?= $currency_text ?> </td>
						 <td style="text-align: right;padding: 8px;"> <?= number_format($row_data['af_charge'] * customRound($charge_weight) + $add_profit,2) ?> <?= $currency_text ?> </td>
																		 <?php } ?>
					 <?php } ?>
					 </tr>
					 <?php
				 } ?>
				 <tr>
					 <td colspan="3"> <hr> </td>
				 </tr>
				 <tr>


					 <?php $myArray[] = array($rowAir['air_line_name'], customRound($tot_air_charge), customRound($aircharge)); ?>
					 <td colspan="3" style="text-align: right;padding: 8px;"> <span style="font-size:16px;font-weight:bold;">Total Air Charge:  <?= customRound($tot_air_charge) + $add_profit ?> <?= $currency_text ?></span> </td>
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
				<table style="width:100%;">
					<thead>
						<tr>
								<th style="text-align: left;padding: 8px;">Description</th>
								<th style="text-align: left;padding: 8px;">Charge</th>
								<th style="text-align: right;padding: 8px;">Total Charge</th>
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
								<td style="text-align: left;padding: 8px;"><?= $row['aoc_description'] ?></td>
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

								<td style="text-align: left;padding: 8px;"> <?= number_format($row['aoc_charge'], 2); ?> <?= $currency_text ?></td>
								<td style="text-align: right;padding: 8px;"> <?= number_format($row['aoc_charge'],2) ?> <?= $currency_text ?></td>
								<?php $tot_orgin_charge +=$row['aoc_charge']; }else{
										$chrg = $row['aoc_charge'] * customRound($qnt_m);
										if($row['aoc_min'] > $chrg){
								?>
								<td style="text-align: left;padding: 8px;"><?= number_format($row['aoc_min'],2) ?> <?= $currency_text ?></td>
								<td style="text-align: right;padding: 8px;"> <?= number_format($row['aoc_min'],2) ?> <?= $currency_text ?></td>
								<?php $tot_orgin_charge +=$row['aoc_min']; }else{ ?>
								<td style="text-align: right;padding: 8px;"> <?= number_format($row['aoc_charge'],2) ?> * <?= customRound($qnt_m) ?> <?= $currency_text ?></td>
								<td style="text-align: right;padding: 8px;"> <?= number_format($row['aoc_charge'] * customRound($qnt_m),2) ?> <?= $currency_text ?></td>
								<?php $tot_orgin_charge +=$row['aoc_charge'] * customRound($qnt_m); } ?>
							<?php  } ?>
							</tr>
						<?php } ?>

						<tr>
							<td colspan="3"> <hr> </td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td style="text-align:right;"> <span style="font-size:16px;text-align: right;font-weight:bold;">Total Charge:  <?= number_format($tot_orgin_charge,2) ?> <?= $currency_text ?> </span> </td>
						</tr>
					<?php }else{ ?>
						<tr>
							<td colspan="5" style="text-align: left;padding: 8px;"> No Data Found</td>
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
                <th style="text-align: right;padding: 8px;">Total Charge</th>
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
                <td style="text-align: left;padding: 8px;"><?= $row['adc_description'] ?></td>
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
                 <td style="text-align: left;padding: 8px;"><?= number_format($row['adc_charge'],2) ?></td>
                 <td style="text-align: right;padding: 8px;"><?= number_format($row['adc_charge'],2) ?></td>
               <?php $tot_desti_charge +=$row['adc_charge']; }else{ ?>
                 <td style="text-align: left;padding: 8px;"><?= number_format($row['adc_charge'],2) ?> * <?= $qnt_m ?></td>
                 <td style="text-align: right;padding: 8px;"><?= number_format($row['adc_charge'],2) * $qnt_m ?></td>
               <?php $tot_desti_charge +=$row['adc_charge'] * $qnt_m; } ?>

              </tr>
            <?php  } ?>
						<tr>
							<td colspan="3"> <hr> </td>
						</tr>
              <tr>
                <td colspan="3" style="font-size:16px;text-align: right;padding: 8px;"> <span style="font-weight:bold;">Total Charge <?= $tot_desti_charge ?> AED </span> </td>
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
    <h3>Total Price By Airlines</h3>
		<table style="width:100%;">
			<tbody>
				<?php foreach ($myArray as $row) {
					$tot_cost_cal = $row[2] * $q_profit /100;
					 ?>
				<tr>
					<td style="text-align: left;padding: 8px;font-size:18px;font-weight:bold;"><?= $row[0]  ?></td>
					<td style="text-align: left;padding: 8px;font-size:18px;font-weight:bold;"><?=  number_format($row[1] + $tot_desti_charge + $tot_orgin_charge + $tot_other_charges + $tot_cost_cal,2)  ?> AED </td>
				</tr>
			<?php } ?>
			</tbody>
		</table>

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
      <h3>Terms and Condition by Air Freight</h3>
			<hr>
			<div>
					<?= getDataBack($conn,'tbl_tc','service_type',1,'tc_text') ?>
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
