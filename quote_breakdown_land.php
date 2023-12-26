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

$odm_orgin_country = $row_codm['odm_orgin_country'];
$odm_orgin_city = $row_codm['odm_orgin_city'];
$odm_orgin_a_s_b = $row_codm['odm_orgin_a_s_b'];

$odm_desti_country = $row_codm['odm_desti_country'];
$odm_desti_city = $row_codm['odm_desti_city'];
$odm_desti_a_s_b = $row_codm['odm_desti_a_s_b'];

$toc = $row_codm['tos'];

 ?>


<div class="page-wrapper">
	<div class="content">

		<div class="card">
		    <div class="card-body">
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
											<td style="font-weight:bold;">Land Border Code</td>
											<td><?= getDataBack($conn,'tbl_land_border','lb_id',$odm_orgin_a_s_b,'lb_name'); ?></td>
											<td><?= getDataBack($conn,'tbl_land_border','lb_id',$odm_desti_a_s_b,'lb_name'); ?></td>
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
								            <th>Volume </th>
								            <th>Total Volume </th>
								            <th>Weight(Kg)</th>
								          </tr>
								    </thead>
								    <tbody>
								      <?php
                                      $cus_cargo = array();
								      $tot_vol = 0;
								      $tot_weight = 0;
								      $charge_weight = 0;
								      $tot_qty = 0;
								      $sql = "SELECT * FROM tbl_package WHERE q_id='$qid' AND st=1";
								      $rs = $conn->query($sql);

								      if ($rs->num_rows > 0) {
								          while ($row = $rs->fetch_assoc()) {
								              $tot_qty += $row['p_qnty'];
								              $vol = $row['p_l'] * $row['p_w'] * $row['p_h'] / 5000;
								              $tot_vol_each = $vol * $row['p_qnty'];
								              $tot_weight += $row['p_weight'];

								              $tot_vol += customRound($tot_vol_each);
								              $cId= $row['ct_id'];
								              $ptId =$row['pt_id'];
															$ctid = $row['ctype_id'];
                                                            array_push($cus_cargo,$ctid);
								              ?>
								              <tr>
																	<td> <?= getDataBack($conn,'tbl_cargo_type','ctype_id',$ctid,'ctype'); ?> </td>
								                  <td> <?= $cId ?> </td>
								                  <td> <?= getDataBack($conn,'tbl_package_type','pt_id',$ptId,'pt_name'); ?> </td>
								                  <td><?= $row['p_qnty'] ?></td>
								                  <td><?= customRound($row['p_l']) ?></td>
								                  <td><?= customRound($row['p_w']) ?></td>
								                  <td><?= customRound($row['p_h']) ?></td>
								                  <td><?= customRound($vol) ?></td>
								                  <td><?= customRound($tot_vol_each) ?></td>
								                  <td><?= $row['p_weight'] ?></td>
								              </tr>
								          <?php }
								          $charge_weight = max($tot_weight, $tot_vol);
								      } ?>
								      <tr>
								          <td colspan="3"> Total Volume </td>
								          <td colspan="4"> <?= customRound($tot_vol) ?> </td>
								      </tr>
								      <tr>
								          <td colspan="3"> Total Qty </td>
								          <td colspan="4"> <?= $tot_qty ?> </td>
								      </tr>
								      <tr>
								          <td colspan="3"> Total Weight </td>
								          <td colspan="4"> <?= customRound($tot_weight) ?> </td>
								      </tr>
								      <tr>
								          <td colspan="3"> Chargable Weight </td>
								          <td colspan="4"> <?= customRound($charge_weight) ?> </td>
								      </tr>
											<tr>
													<td colspan="3"> Selected Service </td>
													<td colspan="4"> <?= getServiceLand($toc); ?>  </td>
											</tr>

								    </tbody>
                                      <?php array_unique($cus_cargo); ?>
								  </table>
								</div>
								<?php $charge_weight = customRound($charge_weight,2); ?>
							</div>
						</div>
                        <?php
                            $pr =999999999;
                            $carg_type=0;  // cargo type
                            $cus_cargo_values = implode(',', array_map('intval', $cus_cargo));
                            $sql_select_array = "SELECT * FROM tbl_cargo_type WHERE ctype_id IN ($cus_cargo_values)";
                            $rs_select_array = $conn->query($sql_select_array);
                            if($rs_select_array->num_rows > 0){
                                while($rowS = $rs_select_array->fetch_assoc()){

                                    if($rowS['c_pr'] < $pr){
                                        $pr=$rowS['c_pr'];
                                        $carg_type = $rowS['ctype_id'];
                                    }

                                }
                            }
                        ?>
						<hr>
		        <h2>Quote Breakdown  </h2>
						<hr>
							<h4>Land Freight Charges</h4>
						 <br>
						<hr>
						<hr><hr>
						<div class="row">
							<?php if($m_type == 1 || $m_type == 2){ ?>
							<div class="col-12">
								<h4>Origin Charges</h4>
								<table class="table">
								  <thead>
								    <tr>
								        <th>Vendor</th>
								        <th>Description</th>
								        <th>Charge</th>
												<th>Total Charge</th>
								        <th>Currency</th>
								        <th>UOM</th>
								        <th>Minimum</th>
								        <th>VALIDITY</th>
								    </tr>
								  </thead>
								  <tbody>

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
								        <th>Vendor</th>
								        <th>Description</th>
												<th>Charge</th>
												<th>Total Charge</th>
								        <th>Currency</th>
								        <th>UOM</th>
								        <th>Minimum</th>
								        <th>VALIDITY</th>
								    </tr>
								  </thead>
								  <tbody>

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
										<td> <a href="backend/del_other_charge_land.php?id=<?= $rowO['oc_id'] ?>&qid=<?= $qid ?>" class="btn btn-danger btn-sm">Remove</a> </td>
									 </tr>
								 <?php $tot_other_charges +=$rowO['oc_charge']; } ?>
								</tbody>
							</table>
						</div>
					<?php } ?>
						</div> <br><br>
						<h5>Total Price</h5> <hr>
						<table class="table">
							<thead>
								<tr>
									<th>Cost Price</th>
									<th>Price with <?= $q_profit ?>% profit</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td></td>
									<td> </td>
								</tr>
							</tbody>
						</table>
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
							<a href="backend/del_note_land.php?id=<?= $rowEx['en_id'] ?>&qid=<?= $qid ?>"><span class="btn btn-danger btn-sm">X</span></a> <br> <br>
							<p style="border:1px solid #000;padding:20px 20px 20px 20px;"><?= $rowEx['ex_note_text'] ?> </p>

						<?php } ?>
						<br><br>
					<?php } ?>
					<!-- You can refer to other pages like example add_profit_land.php you can use add_profit.php same for all -->
						<div class="row">
							<div class="col-6">
								<form class="" action="backend/add_profit_land.php" method="post">
									<div class="form-group">
										<input type="hidden" name="q_id" value="<?= $qid ?>">
										<label for="">Profit Ratio</label>
										<input type="number" class="form-control" id="profit" name="profit_ratio" value="" placeholder="%">
									</div>
									<button type="submit" class="btn btn-success"  name="submit">Add</button>
								</form>
								<hr>
								<form class="" action="backend/add_extra_note_land.php" method="post">
									<div class="form-group">
										<input type="hidden" name="q_id" value="<?= $qid ?>">
										<label for="">Extra Note</label>
										<textarea name="note" class="form-control" rows="8" cols="80"></textarea>
									</div>
									<button type="submit" class="btn btn-success"  name="submit">Add</button>
								</form>
							</div>
							<div class="col-6">
								<form class="" action="backend/add_other_charges_land.php" method="post">
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
						<a href="backend/genrate_pdf_land.php?qid=<?= $qid ?>" class="btn btn-primary"> Sent To Customer</a>
					<?php } ?>
						<a href="calculated_quote_land.php?q_id=<?= $qid ?>" class="btn btn-success"> Quote Preview</a>

		    </div>
		</div>












	</div>
</div>

</div>
<!-- /Main Wrapper -->

<?php include 'layouts/footer.php' ?>

</body>
</html>
