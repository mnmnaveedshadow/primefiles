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


 ?>


<div class="page-wrapper">
	<div class="content">

		<div class="card">
		    <div class="card-body">
						<h4>Customer Information</h4>
						<hr>
						<div class="row">
							<div class="col-lg-12">
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

						</div>
						<hr>
		        <h2>Warehousing Data  </h2>
						<hr>
						<table class="table">
						  <thead>
						    <tr>

						      <th>Description</th>
						      <th>UOM</th>
						      <th>Rate (AED)</th>
						      <th>Remarks</th>
						      <th>Validity</th>
									<th>Edit</th>
									<th>Action</th>
						    </tr>
						  </thead>
						  <tbody>
						    <?php
						    $sql = "SELECT * FROM `tbl_warehouse_cat_q` WHERE q_id='$qid'";

						    $rs = $conn->query($sql);
						    if($rs->num_rows >0){
						      while($row = $rs->fetch_assoc()){
						        $id  = $row['wc_id']; ?>
						      <tr>
						        <td colspan="5">
						          <span style="font-weight:bold;text-transform: capitalize;">
						            <?= $row['wc_name'] ?>
						          </span>
						        </td>
										<td> <a href="#" onclick="editCatWc(<?= $id ?>)"><img src="assets/img/icons/edit.svg" alt="img"></a> </td>
										<td> <a href="backend/del_wc_q.php?id=<?= $id ?>&qid=<?= $qid ?>" onclick="return confirm('Are you really want to delete this category?')"><img src="assets/img/icons/delete.svg" alt="img"></a></td>
						      </tr>

						        <?php
						          $sql_data = "SELECT * FROM `tbl_warehouse_data_q` WHERE wc_id='$id' AND q_id='$qid'";
						          $rs_data = $conn->query($sql_data);

						          if($rs_data->num_rows > 0){
						            while($row_data = $rs_data->fetch_assoc()){
													$d_id =$row_data['wd_id'];
						         ?>
						           <tr>
						            <td> --<?= $row_data['wd_description'] ?> </td>
						            <td> <?= $row_data['wd_uom'] ?> </td>
						            <td> <?= $row_data['wd_rate'] ?> </td>
						            <td> <?= $row_data['wd_remarks'] ?> </td>
						            <td> <?= $row_data['wd_validity'] ?> </td>
												<td> <a href="#" onclick="editCatWcData(<?= $d_id ?>)"><img src="assets/img/icons/edit.svg" alt="img"></a> </td>
												<td> <a href="backend/del_wcdata_q.php?id=<?= $d_id ?>&qid=<?= $qid ?>" onclick="return confirm('Are you really want to delete this Data?')"><img src="assets/img/icons/delete.svg" alt="img"></a></td>
						          </tr>
						      <?php } } ?>

						    <?php }} ?>

						  </tbody>

						</table>

						<br><br>
						<a href="backend/genrate_pdf_warehouse.php?qid=<?= $qid ?>" class="btn btn-primary"> Sent To Customer</a>
						<a href="calculated_quote_warehouseing.php?q_id=<?= $qid ?>" class="btn btn-success"> Quote Preview</a>

		    </div>
		</div>


		<div class="modal fade" id="edit_ware_house_data_cat" tabindex="-1" aria-labelledby="edit_ware_house_data_cat" aria-hidden="true">
				<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
						<div class="modal-content">
								<div class="modal-header">
										<h5 class="modal-title">Change The Category Name</h5>
										<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
										</button>
								</div>
								<div class="modal-body" id="load_cat_wc">

								</div>
						</div>
				</div>
		</div>

		<div class="modal fade" id="edit_ware_house_data" tabindex="-1" aria-labelledby="edit_ware_house_data" aria-hidden="true">
				<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
						<div class="modal-content">
								<div class="modal-header">
										<h5 class="modal-title">Change The Data</h5>
										<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
										</button>
								</div>
								<div class="modal-body" id="load_data_wc">

								</div>
						</div>
				</div>
		</div>









	</div>
</div>

</div>
<!-- /Main Wrapper -->

<?php include 'layouts/footer.php' ?>

<script>
 function editCatWc(id){
	 $('#edit_ware_house_data_cat').modal('show');
	 $('#load_cat_wc').load('ajax_pages/edit_wc_cat.php',{ wc_id:id,q_id:<?= $qid ?> });
 }

 function editCatWcData(id){
	$('#edit_ware_house_data').modal('show');
	$('#load_data_wc').load('ajax_pages/edit_wc_data.php',{ wc_id:id,q_id:<?= $qid ?> });
 }

</script>
</body>
</html>
