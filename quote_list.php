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



<div class="page-wrapper">
	<div class="content">
		<div class="card">
			<div class="card-body">
				<h3>Quotes List</h3>
                <hr>
                   <a href="backend/quote_list_download.php" class="btn btn-success btn-sm">Download Excel</a>
                <hr>
				<table class="table datanew" id="q_list">
					<thead>
						<tr>
							<th>Ref ID</th>
							<th>Customer Name</th>
							<th>Service</th>
							<th>Review Status</th>
							<th>Date Time</th>
							<th>Staff</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sql_list = "SELECT * FROM tbl_quote ORDER BY `tbl_quote`.`q_id` DESC";
							$rs_list = $conn->query($sql_list);
							if($rs_list->num_rows > 0){
								while($row = $rs_list->fetch_assoc()){
									$cid = $row['c_id'];
									$ser_t = $row['q_service'];
									$st = $row['q_status'];
									$this_id = $row['u_id'];
									$user_name = getDataBack($conn,'tbl_users','u_id',$this_id,'u_name');
									$link = 0;

									if($ser_t == 1){
										$link ="quote_breakdown_air.php?q_id=".$row['q_id'];
									}
									else if($ser_t == 2){
										$link ="quote_breakdown_sea.php?q_id=".$row['q_id'];
									}
									else if($ser_t == 3){
										$link ="quote_breakdown_land.php?q_id=".$row['q_id'];
									}
									else if($ser_t == 4){
										$link ="quote_breakdown_warehousing.php?q_id=".$row['q_id'];
									}
                                    $qid=$row['q_id'];
                                    $date_time=$row['q_d_time'];
                                    $year_month = date_create_from_format('Y-m-d H:i:s', $date_time)->format('ym');
                                    $formatted_qid = sprintf('%03d', $qid);
                                    $result_id = "PRL{$year_month}{$formatted_qid}";
						 ?>
						<tr>
							<td><?= $result_id ?></td>
							<td><?= getDataBack($conn,'tbl_customer_info','c_id',$cid,'c_name') ?></td>
							<td>
															<?= getServiceType($ser_t); ?> </td>
							<td>
								<?= getQuoteStatus($st); ?>
							</td>
							<td> <?= $row['q_d_time'] ?> </td>
							<td> <?php if($st != 0){ echo $user_name; } ?> </td>
							<td> <a href="<?= $link ?>" class="btn btn-success" style="color:#fff;">Review Quote</a> </td>
						</tr>
					<?php } } ?>
					</tbody>
					<tbody>


					</tbody>

				</table>
			</div>
		</div>

	</div>
</div>
<!-- /Main Wrapper -->

<?php include 'layouts/footer.php' ?>
<script>
$(document).ready(function () {
    // Check if the DataTable is already initialized
    if ($.fn.dataTable.isDataTable('#q_list')) {
        // If yes, destroy the existing DataTable
        $('#q_list').DataTable().destroy();
    }

    // Now, you can initialize the DataTable with your desired options
    $('#q_list').DataTable({
        "order": [[0, 'desc']]
        // Add other DataTable options as needed
    });
});

</script>
</body>
</html>
