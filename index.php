<!-- Header -->
<?php include 'layouts/header.php'; ?>
<!-- Header -->

<!-- Sidebar -->
<?php include 'layouts/sidebar.php'; ?>
<!-- /Sidebar -->

<?php
if(isset($_REQUEST['from_date'])){
	$from_date =$_REQUEST['from_date'];
	$to_date = $_REQUEST['to_date'];
}
 ?>
 <?php
	 $sql_noti = "SELECT * FROM tbl_quote WHERE not_st=0 AND q_status=0 ORDER BY `q_id` DESC LIMIT 0,5";
	 $rs_noti = $conn->query($sql_noti);


	?>

<div class="page-wrapper">
	<div class="content">
		<div class="row">
			<div class="col-lg-6">
				<div class="dash-widget">
					<div class="dash-widgetimg">
						<span><img src="assets/img/icons/dash1.svg" alt="img"></span>
					</div>
					<div class="dash-widgetcontent">
						<h5 ><span class="counters" data-count="<?= $rs_noti->num_rows ?>"></span></h5>
						<h6>New Quotation Requests</h6>
						<hr>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="dash-widget">
					<div class="dash-widgetimg">
						<span><img src="assets/img/icons/users1.svg" alt="img"></span>
					</div>
					<div class="dash-widgetcontent">
						<h5 ><span class="counters" data-count="01"></span></h5>
						<h6>Active Users</h6>
						<hr>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div class="card">
					<div class="card-body">
						<h5>Quotation Status</h5>
						<hr>
						<ul class="mb-0 bullets">
							<li>Total Pending - <?= getQuoteStatusNumber($conn,0) ?> <hr> </li>
							<li>Total Under Review - <?= getQuoteStatusNumber($conn,4) ?> <hr></li>
							<li>Total Completed - <?= getQuoteStatusNumber($conn,2) ?> <hr> </li>
							<li>Total Accepted - <?= getQuoteStatusNumber($conn,3) ?> <hr> </li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card">
					<div class="card-body">
						<h5>Progress Numbers of Quotation List </h5>
						<hr>
						<div class="table-responsive dataview">
							<table class="table">
								<thead>
									<tr>
										<th>Staff ID</th>
										<th>Staff Name</th>
										<th>Access Level</th>
										<th>On Progress</th>
										<th>Completed</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$sql_users ="SELECT * FROM tbl_users WHERE u_level IN (1, 3)";
										$rs_users = $conn->query($sql_users);

										if($rs_users->num_rows > 0){
											while($rowUsers = $rs_users->fetch_assoc()){
												$user_level = $rowUsers['u_level'];
												$uid = $rowUsers['u_id'];
												$userText = '';
												switch ($user_level) {
														case '1':
																$userText = 'Super Admin';
																break;
														case '2':
																$userText = 'Data Handler';
																break;
														case '3':
																$userText = 'Staff';
																break;
														default:
																$userText = 'Something Went Wrong';
																break;
												}
									 ?>
									<tr>
										<td><?= $rowUsers['u_id'] ?></td>
										<td><?= $rowUsers['u_name'] ?></td>
										<td><?= $userText ?></td>
										<td><?= getUserProgressCount($conn,$uid,4) ?></td>
										<td><?= getUserProgressCount($conn,$uid,2) ?></td>
									</tr>
								<?php } }else{ ?>
									<tr>
										<td colspan="6">No Results Found</td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /Main Wrapper -->

<?php include 'layouts/footer.php' ?>

</body>
</html>
