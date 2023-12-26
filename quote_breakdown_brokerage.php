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

$sql_c_odm = "SELECT * FROM tbl_customer_odm";
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
 ?>


<div class="page-wrapper">
	<div class="content">

		<div class="card">
		    <div class="card-body">
						<h4>Customer Information</h4>
						<hr>
						<div class="row">
							<div class="col-lg-6">
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
									</tbody>
								</table>
							</div>
							<div class="col-lg-6">
								<table class="table">
								  <thead>
								      <tr>

								          <th>Qty</th>
								          <th>Length</th>
								          <th>Width</th>
								          <th>Height</th>
								          <th>Volume</th>
								          <th>Weight</th>
								        </tr>
								  </thead>
								  <tbody>
								    <?php
								      $tot_vol =0;
								      $tot_weight =0;
								      $charge_weight=0;
								      $tot_qty=0;
								      $sql = "SELECT * FROM tbl_package WHERE c_id='$q_cus'";
								      $rs = $conn->query($sql);

								      if($rs->num_rows > 0){
								        while($row = $rs->fetch_assoc()){
								          $tot_qty +=$row['p_qnty'];
								          $vol = $row['p_l'] * $row['p_w'] * $row['p_h'] / 6000;
								          $tot_weight +=$row['p_weight'] * $row['p_qnty'];


								          $tot_vol +=$vol;

								          if($tot_weight > $tot_vol){
								            $charge_weight = $tot_weight;
								          }
								          else {
								            $charge_weight = $tot_vol;
								          }



								     ?>
								     <tr>
								       <td> <?= $row['p_qnty'] ?>  </td>
								       <td> <?= $row['p_l'] ?>  </td>
								       <td> <?= $row['p_w'] ?>  </td>
								       <td> <?= $row['p_h'] ?>  </td>
								       <td> <?= round($vol,2) ?>  </td>
								       <td> <?= $row['p_weight'] ?>  </td>
								     </tr>
								   <?php } } ?>
								   <tr>
								     <td colspan="3"> Total Volume  </td>
								     <td colspan="4"> <?= round($tot_vol,2) ?>  </td>
								   </tr>
								   <tr>
								     <td colspan="3"> Total Qty  </td>
								     <td colspan="4"> <?= $tot_qty ?>  </td>
								   </tr>
								   <tr>
								     <td colspan="3"> Total Weight  </td>
								     <td colspan="4"> <?= $tot_weight ?>  </td>
								   </tr>
								   <tr>
								     <td colspan="3"> Chargable Weight  </td>
								     <td colspan="4"> <?= round($charge_weight,2) ?>  </td>
								   </tr>

								  </tbody>

								</table>
								<?php $charge_weight = round($charge_weight,2); ?>
							</div>
						</div>
						<hr>
		        <h2>Quote Break Down  </h2>
						<hr>
						<h4>Air Frieght Charges</h4>
						<div class="table-responsive">
							<table class="table">
							  <thead>
							    <tr>
							      <th>Origin/Destination</th>
							      <th>Origin/Destination City</th>
							      <th>Origin/Destination Airport</th>
							      <th>Vendor</th>
							      <th>Airline</th>
							      <th>Description</th>
							      <th>Min Weight</th>
							      <th>Max Weight</th>
							      <th>Charge amount</th>
										<th>Total Amount</th>
							      <th>Currency</th>
							      <th>UOM</th>
							      <th>Validity</th>
							    </tr>
							  </thead>
							  <tbody>
							    <?php

									$odm_orgin_country = $row_codm['odm_orgin_country'];
									$odm_orgin_city = $row_codm['odm_orgin_city'];
									$odm_orgin_a_s_b = $row_codm['odm_orgin_a_s_b'];

									$odm_desti_country = $row_codm['odm_desti_country'];
									$odm_desti_city = $row_codm['odm_desti_city'];
									$odm_desti_a_s_b = $row_codm['odm_desti_a_s_b'];

							    $sql_data = "SELECT * FROM tbl_air_frieght WHERE
																country_id='$odm_orgin_country' AND city_id='$odm_orgin_city' AND airport_id='$odm_orgin_a_s_b' AND
																country_id_dest='$odm_desti_country' AND city_id_dest='$odm_desti_city' AND airport_id_dest='$odm_desti_a_s_b' AND af_min_weight <= $charge_weight AND af_max_weight >= $charge_weight";
							    $rs_data = $conn->query($sql_data);
									$tot_air_charge
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

							    ?>
							    <tr>
							      <td>  <?= getDataBack($conn,'countries','country_id',$country_id,'name'); ?></td>
							      <td><?= getDataBack($conn,'cities','city_id',$city_id,'name'); ?></td>
							      <td><?= getDataBack($conn,'airports','airport_id',$airport_id,'code'); ?></td>

							      <td><?= getDataBack($conn,'tbl_air_vendor','av_id',$v_id,'av_name'); ?></td>
							      <td><?= getDataBack($conn,'tbl_airlines','al_id',$a_id,'air_line_name'); ?></td>
							      <td> <?= $row_data['af_description'] ?> </td>
							      <td> <?= $row_data['af_min_weight'] ?> </td>
							      <td> <?= $row_data['af_max_weight'] ?> </td>
										<?php if($row_data['other_charge'] == 1){ ?>
											<td> <?= $row_data['af_charge'] ?> * <?= $tot_qty ?> </td>
											<td> <?= $row_data['af_charge'] * $tot_qty ?> </td>
										<?php }else{ ?>
							      <td> <?= $row_data['af_charge'] ?> * <?= $charge_weight ?> </td>
										<td> <?= $row_data['af_charge'] * $charge_weight ?> </td>
									<?php } ?>
							      <td><?= getCurrency($currency) ?></td>
							      <td><?= getUom($uom) ?></td>
							      <td> <?= $row_data['af_validity'] ?> </td>
							    </tr>
							    <tr>
							      <td><?= getDataBack($conn,'countries','country_id',$country_dest_id,'name'); ?></td>
							      <td><?= getDataBack($conn,'cities','city_id',$city_dest_id,'name'); ?></td>
							      <td><?= getDataBack($conn,'airports','airport_id',$airport_dest_id,'code'); ?></td>
							      <td colspan="13"> <span style="font-weight:bold;"><?php if($row_data['other_charge'] == 1){ echo "Other Charges"; }else{ echo "Air Charge"; } ?></span> </td>
							    </tr>
							    <?php
							    } }
							     ?>
							  </tbody>
							</table>
						</div>
						 <br>
						<hr>
						<hr><hr>
						<div class="row">
							<?php if($m_type == 1 || $m_type == 2){ ?>
							<div class="col-12">
								<h4>Orgin Charges</h4>
								<table class="table">
								  <thead>
								    <tr>
								        <th>Country</th>
								        <th>City</th>
								        <th>Airport</th>
								        <th>Vendor</th>
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
								    $sql = "SELECT * FROM `tbl_air_orgin_charge`";

								    $rs = $conn->query($sql);
								    if($rs->num_rows >0){
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

								        <td><?= getDataBack($conn,'countries','country_id',$country_id,'name'); ?></td>
								        <td><?= getDataBack($conn,'cities','city_id',$city_id,'name'); ?></td>
								        <td><?= getDataBack($conn,'airports','airport_id',$airport_id,'code'); ?></td>
								        <td><?= getDataBack($conn,'tbl_air_vendor','av_id',$v_id,'av_name'); ?></td>
								        <td><?= $row['aoc_description'] ?></td>
								        <td><?= $row['aoc_charge'] ?></td>
								        <td><?= getCurrency($currency) ?></td>
								        <td><?= getUom($uom) ?></td>
								        <td><?= $row['aoc_min'] ?></td>
								        <td><?= $row['aoc_validity'] ?></td>

								      </tr>
								    <?php } } ?>
										<tr>
											<td colspan="5"> Total Charge 488 AED </td>
										</tr>
								  </tbody>

								</table>
								<br><br>
							</div>
						<?php }  ?>
						<?php if($m_type == 1 || $m_type == 4){ ?>
							<div class="col-12">
								<h4>Destination Charges</h4>
								<table class="table">
								  <thead>
								    <tr>
								        <th>Country</th>
								        <th>City</th>
								        <th>Airport</th>
								        <th>Vendor</th>
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
										$tot_charge = 0;
								    $sql = "SELECT * FROM `tbl_air_dest_charge`";

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

								        <td><?= getDataBack($conn,'countries','country_id',$country_id,'name'); ?></td>
								        <td><?= getDataBack($conn,'cities','city_id',$city_id,'name'); ?></td>
								        <td><?= getDataBack($conn,'airports','airport_id',$airport_id,'code'); ?></td>
								        <td><?= getDataBack($conn,'tbl_air_vendor','av_id',$v_id,'av_name'); ?></td>
								        <td><?= $row['adc_description'] ?></td>
								        <td><?= $row['adc_charge'] ?></td>
								        <td><?= getCurrency($currency) ?></td>
								        <td><?= getUom($uom) ?></td>
								        <td><?= $row['adc_min'] ?></td>
								        <td><?= $row['adc_validity'] ?></td>

								      </tr>
								    <?php $tot_charge += $row['adc_charge']; } } ?>
										<tr>
											<td colspan="5"> Total Charge <?= $tot_charge ?> SAR </td>
										</tr>
								  </tbody>

								</table>
							</div>
						<?php }  ?>

						</div> <br><br>
						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<label for="">Profit Ratio</label>
									<input type="text" class="form-control" id="profit" name="" value="" placeholder="%">
								</div>
								<button type="button" class="btn btn-success" onclick="addProfit()" name="button">Add</button>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="">Extra charge name</label>
									<input type="text" class="form-control"  name="" value="">
								</div>
								<div class="form-group">
									<label for="">Extra Charges</label>
									<input type="text" class="form-control" name="" value="">
								</div>
								<button type="button" class="btn btn-success" name="button">Add</button>
							</div>
						</div> <br><br>

						<button type="button" class="btn btn-primary" name="button"> Sent To Customer</button>
						<a href="calculated_quote.php" class="btn btn-success"> Quote Privew</a>

		    </div>
		</div>












	</div>
</div>

</div>
<!-- /Main Wrapper -->

<?php include 'layouts/footer.php' ?>

<script>
	function addProfit(){
		var profit = document.getElementById('profit').value;

		document.getElementById('profit_text').innerHTML = "+ "+profit+"% = ";

		var profit_cal = (profit + 755) / 100;
		document.getElementById('total_profit').innerHTML =profit_cal + 755 + " AED";


		document.getElementById('profit_text_2').innerHTML = " + "+profit+"% = ";

		var profit_cal = (profit + 327) / 100;
		document.getElementById('total_profit_2').innerHTML =profit_cal + 327 + " AED";
	}

</script>
</body>
</html>
