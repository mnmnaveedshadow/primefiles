<!-- Header -->
<?php include 'layouts/header.php'; ?>
<!-- Header -->

<!-- Sidebar -->
<?php include 'layouts/sidebar.php'; ?>
<!-- /Sidebar -->
<?php
if ($u_level != 1 && $u_level != 3) {
		header('location:index.php');
		$_SESSION['invalid_access'] = true;
		exit();
}
 ?>
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

											$currency_text=0;

 ?>


<div class="page-wrapper">
	<div class="content">
    <h4>Customer Information</h4>
						<hr>
						<div class="row">
							<div class="col-lg-4">
								<table class="table">
									<thead>
										<tr>
											<th>Description</th>
											<th>Info</th>
										</tr>
									</thead>
									<tbody>

										<tr>
											<td style="font-weight:bold;">Customer Name</td>
											<td><?= $cName ?></td>
										</tr>
										<tr>
											<td style="font-weight:bold;">Customer Company</td>
											<td><?= $cCompany ?></td>
										</tr>
										<tr>
											<td style="font-weight:bold;">Customer Address</td>
											<td><?= $cAddress ?></td>
										</tr>
										<tr>
											<td style="font-weight:bold;">Customer Phone</td>
											<td><?= $cPhone ?></td>
										</tr>
										<tr>
											<td style="font-weight:bold;">Customer Email</td>
											<td><?= $cEmail ?></td>
										</tr>
										<tr>
											<td colspan="2"> <?= getQuoteStatus($qout_st) ?>  </td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-lg-3">
								<table class="table">
									<thead>
										<tr>
											<th>Description</th>
											<th>Origin</th>
											<th>Destination</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td style="font-weight:bold;">Country</td>
											<td>  <?= getDataBack($conn,'countries','country_id',$odm_orgin_country,'name'); ?></td>
											<td>  <?= getDataBack($conn,'countries','country_id',$odm_desti_country,'name'); ?></td>
										</tr>
										<tr>
											<td style="font-weight:bold;">City</td>
											<td><?= getDataBack($conn,'cities','city_id',$odm_orgin_city,'name'); ?></td>
											<td><?= getDataBack($conn,'cities','city_id',$odm_desti_city,'name'); ?></td>
										</tr>
										<tr>
											<td style="font-weight:bold;">Seaport Code</td>
											<td><?= getDataBack($conn,'tbl_sea_port','sp_id',$odm_orgin_a_s_b,'sp_name'); ?></td>
											<td><?= getDataBack($conn,'tbl_sea_port','sp_id',$odm_desti_a_s_b,'sp_name'); ?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-lg-5">
								<div class="table-responsive">
									<table class="table">
								    <thead>
								        <tr>
														<th>Cargo Type</th>
								            <th>Commodity Type</th>
								            <th>Package Type</th>
								            <th>Number Of Packages</th>
								            <th>Length (Cm)</th>
								            <th>Width (Cm)</th>
								            <th>Height (Cm)</th>
								            <th>Volume M3 </th>
								            <th>Weight(Kg)</th>
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
								                <td> <?= getDataBack($conn,'tbl_cargo_type','ctype_id',$ctid,'ctype'); ?> </td>
								                <td> <?= $cId ?> </td>
								                <td> <?= getDataBack($conn,'tbl_package_type','pt_id',$ptId,'pt_name'); ?> </td>
								                  <td><?= $row['p_qnty'] ?></td>
								                  <td><?= customRound($row['p_l']) ?></td>
								                  <td><?= customRound($row['p_w']) ?></td>
								                  <td><?= customRound($row['p_h']) ?></td>
								                  <td><?= customRound($tot_vol_each) ?></td>
								                  <td><?= $row['p_weight'] ?></td>
								              </tr>
								          <?php }
								          $charge_weight = max($tot_weight/1000, customRound($tot_vol));
								      } ?>
								      <tr>
								          <td colspan="3"> Total Volume </td>
								          <td colspan="4"> <?= $tot_vol ?> </td>
								      </tr>
								      <tr>
								          <td colspan="3"> Total Qty </td>
								          <td colspan="4"> <?= $tot_qty ?> </td>
								      </tr>
								      <tr>
								          <td colspan="3"> Total Weight </td>
								          <td colspan="4"> <?= $tot_weight ?> </td>
								      </tr>
											<tr>
								          <td colspan="3"> Total Round UP Volume </td>
								          <td colspan="4"> <?= customRound($tot_vol) ?> </td>
								      </tr>
								      <tr>
								          <td colspan="3"> Total Round UP Weight </td>
								          <td colspan="4"> <?= customRound($tot_weight/1000) ?> </td>
								      </tr>
								      <tr>
								          <td colspan="3"> Chargable Weight </td>
								          <td colspan="4"> <?= customRound($charge_weight) ?> </td>
								      </tr>
											<tr>
													<td colspan="3"> Selected Service </td>
													<td colspan="4"> <?= getService($s_type); ?> </td>
											</tr>

								    </tbody>
								  </table>
								</div>
								<?php
								$charge_weight = customRound($charge_weight,2);
								$rpVolune = customRound($tot_vol);
								 ?>
							</div>
						</div>
						<h2>Quote Breakdown  </h2>
						<hr>
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
							 <table class="table">
  					     <thead>
  					       <tr>
  					         <th>Origin City</th>
  					         <th>Origin SeaPort</th>
  					         <th>Destination City</th>
  					         <th>Destination SeaPort</th>
  					         <th>Vendor</th>
  					         <th>Type Of Service</th>
  					         <th>Type Of Container</th>
  					         <th>Carrier</th>
  					         <th>Description</th>
  					         <th>Min Weight</th>
  					         <th>Max Weight</th>
  					         <th>Min CBM</th>
  					         <th>Max CBM</th>
  					         <th>Charge amount</th>
  					         <th>Transit Days</th>
  					         <th>Cargo Type</th>
  					         <th>Currency</th>
  					         <th>UOM</th>
  					         <th>Validity</th>
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
  					         <td><?= getDataBack($conn,'cities','city_id',$city_id,'name'); ?></td>
  					         <td><?= getDataBack($conn,'tbl_sea_port','sp_id',$seaport_id,'sp_name'); ?></td>

  					         <td><?= getDataBack($conn,'cities','city_id',$city_dest_id,'name'); ?></td>
  					         <td><?= getDataBack($conn,'tbl_sea_port','sp_id',$seaport_dest_id,'sp_name'); ?></td>

  					         <td><?= getDataBack($conn,'tbl_sea_vendors','sv_id',$v_id,'sv_name'); ?></td>
  					         <td><?= getService($service) ?></td>
										 <?php if($row_q['sel_con'] != 0 && $s_type == 1){ ?>
  					         <td> <?= getDataBack($conn,'tbl_container','cr_id',$tocontainer,'cr_name'); ?></td>
									 <?php }else{ ?>
										 <td> <a href="backend/sel_container.php?qid=<?= $qid ?>&con_id=<?= $tocontainer ?>"><?= getDataBack($conn,'tbl_container','cr_id',$tocontainer,'cr_name'); ?></a> </td>
									 <?php } ?>
										 <td><?= getDataBack($conn,'tbl_sea_carrier','sc_id',$scrid,'sc_name'); ?></td>
  					         <td> <?= $row_data['sc_desc'] ?> </td>
  					         <td> <?= $row_data['sc_min_weight'] ?> </td>
  					         <td> <?= $row_data['sc_max_weight'] ?> </td>
  					         <td> <?= $row_data['sc_min_cbm'] ?> </td>
  					         <td> <?= $row_data['sc_max_cbm'] ?> </td>
  					         <td> <?= $row_data['sc_charge_amount'] ?> </td>
  					         <td> <?= $row_data['sc_transit_days'] ?> </td>
  					         <td><?= getDataBack($conn,'tbl_cargo_type','ctype_id',$ctpye_id,'ctype'); ?></td>
  					         <td><?= getCurrency($currency) ?></td>
  					         <td><?= getUom($uom) ?></td>
  					         <td> <?= $row_data['sc_validity'] ?> </td>
  					       </tr>
									 <?php $totSeaCharge +=$row_data['sc_charge_amount']; ?>
  					       <?php
								 } }else{
  					        ?>
											<tr>
												<td colspan="19">No Data Found</td>
											</tr>
									<?php } ?>
  					     </tbody>
  					   </table>
						 </div> <br><br>
						 <h6> Total Sea Freight Charge: <?= customRound($totSeaCharge) ?> AED </h6>
						 <br><br>
						 <h4>Sea Freight Origin Charge</h4> <hr>
						 <div class="table-responsive">
						 <table class="table  datanew" id="dataTable">
						   <thead>
						     <tr>
						         <th>Country</th>
						         <th>City</th>
						         <th>Seaport</th>
						         <th>Vendor</th>
						         <th>Type Of Service</th>
						         <th>Type Of Container</th>
						         <th>Description</th>
						         <th>Charge</th>
						         <th>Currency</th>
						         <th>UOM</th>
						         <th>Minimum</th>
						         <th>VALIDITY</th>
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

						         <td><?= getDataBack($conn,'countries','country_id',$country_id,'name'); ?></td>
						         <td><?= getDataBack($conn,'cities','city_id',$city_id,'name'); ?></td>
						         <td><?= getDataBack($conn,'tbl_sea_port','sp_id',$seaport_id,'sp_name'); ?></td>
						         <td><?= getDataBack($conn,'tbl_air_vendor','av_id',$v_id,'av_name'); ?></td>
						         <td><?= getService($service) ?></td>
						         <td><?= getDataBack($conn,'tbl_container','cr_id',$tocontainer,'cr_name'); ?></td>
						         <td><?= $row['soc_desc'] ?></td>
						         <td><?= $row['soc_charge'] ?></td>
						         <td><?= getCurrency($currency) ?></td>
						         <td><?= getUom($uom) ?></td>
						         <td><?= $row['soc_min'] ?></td>
						         <td><?= $row['soc_validity'] ?></td>
						       </tr>
						     <?php $totSeaOriginCharge+=$row['soc_charge']; } } ?>

						   </tbody>

						 </table>
						 </div>
						 <br><br>
						 <h6> Total Sea Freight Origin Charge: <?= customRound($totSeaOriginCharge) ?> AED </h6>
						 <br><br>
						 <h4>Sea Freight Destination Charge</h4> <hr>
						 <div class="table-responsive">
						   <table class="table  datanew">
						     <thead>
						       <tr>
						           <th>Country</th>
						           <th>City</th>
						           <th>Seaport</th>
						           <th>Vendor</th>
						           <th>Type Of Service</th>
						           <th>Type Of Container</th>
						           <th>Description</th>
						           <th>Charge</th>
						           <th>Currency</th>
						           <th>UOM</th>
						           <th>Minimum</th>
						           <th>VALIDITY</th>
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

						           <td><?= getDataBack($conn,'countries','country_id',$country_id,'name'); ?></td>
						           <td><?= getDataBack($conn,'cities','city_id',$city_id,'name'); ?></td>
						           <td><?= getDataBack($conn,'tbl_sea_port','sp_id',$seaport_id,'sp_name'); ?></td>
						           <td><?= $v_id ?></td>
						           <td><?= getService($service) ?></td>
						           <td><?= getDataBack($conn,'tbl_container','cr_id',$tocontainer,'cr_name'); ?></td>
						           <td><?= $row['sdc_desc'] ?></td>
						           <td><?= $row['sdc_charge'] ?></td>
						           <td><?= getCurrency($currency) ?></td>
						           <td><?= getUom($uom) ?></td>
						           <td><?= $row['sdc_min'] ?></td>
						           <td><?= $row['sdc_validity'] ?></td>
						         </tr>
						       <?php $totSeaDestiCharge+=$row['sdc_charge']; } } ?>

						     </tbody>

						   </table>

						 </div>
						 <br><br>
						 <h6> Total Sea Freight Destination Charge: <?= customRound($totSeaDestiCharge) ?> AED </h6>
						 <br><br>
						 <?php
							 $tot_other_charges =0;
							 $sql_other_charge = "SELECT * FROM tbl_other_charges WHERE q_id='$qid'";
							 $rs_other_charge = $conn->query($sql_other_charge);
							 if($rs_other_charge->num_rows > 0){
							?>
						 <h4>Other Charges</h4>
						 <table class="table">
							 <thead>
								 <tr>
										 <th>Description</th>
										 <th>Charge</th>
										 <th>Action</th>
								 </tr>
							 </thead>
							 <tbody>
								 <?php
									 while($rowO = $rs_other_charge->fetch_assoc()){
									?>
									<tr>
									 <td><?= $rowO['oc_charge_name'] ?></td>
									 <td><?= $rowO['oc_charge'] ?></td>
									 <td> <a href="backend/del_other_charge_sea.php?id=<?= $rowO['oc_id'] ?>&qid=<?= $qid ?>" class="btn btn-danger btn-sm">Remove</a> </td>
									</tr>
								<?php $tot_other_charges +=$rowO['oc_charge']; } ?>
							 </tbody>
						 </table>
					 <br><br>
				 <?php } ?>

						 <h6> Total Sea Freight Charge Cost: <?= customRound($totSeaDestiCharge + $totSeaOriginCharge + $totSeaCharge + $tot_other_charges) ?> AED </h6>
						 <br><br>
						 <br><br>
						 <?php $cal_profit = $totSeaCharge * $q_profit/100; ?>
						 <h6> Total Sea Freight Charge With "<?= $q_profit ?>%" Profit: <?= customRound($totSeaDestiCharge + $totSeaOriginCharge + $totSeaCharge + $cal_profit + $tot_other_charges) ?> AED </h6>
						 <br><br>
						 <br><br id="extranote">
						 <?php
						 $sqlEx = "SELECT * FROM tbl_extra_note WHERE q_id='$qid'";
						 $rsEx = $conn->query($sqlEx);
						 if($rsEx->num_rows > 0){
							 ?>
							 <h4>Extra Note</h4> <hr>
							 <?php
							 while ($rowEx = $rsEx->fetch_assoc()) {
							 ?>
							 <a href="backend/del_note_sea.php?id=<?= $rowEx['en_id'] ?>&qid=<?= $qid ?>"><span class="btn btn-danger btn-sm">X</span></a> <br> <br>
							 <p style="border:1px solid #000;padding:20px 20px 20px 20px;"><?= $rowEx['ex_note_text'] ?> </p>

						 <?php } }?>
						 <br><br>
						 <div class="row">
							 <div class="col-6">
								 <form class="" action="backend/add_profit_sea.php" method="post">
									 <div class="form-group">
										 <input type="hidden" name="q_id" value="<?= $qid ?>">
										 <label for="">Profit Ratio</label>
										 <input type="number" class="form-control" id="profit" name="profit_ratio" value="" placeholder="%">
									 </div>
									 <button type="submit" class="btn btn-success"  name="submit">Add</button>
								 </form>
								 <hr>
								 <form class="" action="backend/add_extra_note_sea.php" method="post">
									 <div class="form-group">
										 <input type="hidden" name="q_id" value="<?= $qid ?>">
										 <label for="">Extra Note</label>
										 <textarea name="note" class="form-control" rows="8" cols="80"></textarea>
									 </div>
									 <button type="submit" class="btn btn-success"  name="submit">Add</button>
								 </form>
							 </div>
							 <div class="col-6">
								 <form class="" action="backend/add_other_charges_sea.php" method="post">
									 <input type="hidden" name="q_id" value="<?= $qid ?>">
									 <div class="form-group">
										 <label for="">Extra charge name</label>
										 <input type="text" class="form-control"  name="other_charge_name" value="">
									 </div>
									 <div class="form-group">
										 <label for="">Extra Charges</label>
										 <input type="text" class="form-control" name="ex_charge" value="">
									 </div>
									 <button type="submit" class="btn btn-success" name="button">Add</button>
								 </form>
							 </div>
						 </div> <br><br>
						 <?php if($qoute_user == $u_id || $u_level == 1){ ?>
						 <a href="#backend/genrate_pdf.php?qid=<?= $qid ?>" class="btn btn-primary"> Sent To Customer</a>
					 <?php } ?>
						 <a href="calculated_quote_sea.php?q_id=<?= $qid ?>" class="btn btn-success"> Quote Preview</a>


	</div>
</div>

</div>
<!-- /Main Wrapper -->

<?php include 'layouts/footer.php' ?>

</body>
</html>
