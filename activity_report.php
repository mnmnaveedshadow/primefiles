

			<!-- Header -->
			<?php include './layouts/header.php'; ?>
			<!-- Header -->

           <!-- Sidebar -->
			<?php include './layouts/sidebar.php'; ?>
			<!-- /Sidebar -->
			<?php
				if($u_level != 1){
					header('location:index.php');
					$_SESSION['invalid_access'] = true;
					exit();
				}
			 ?>

			<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="page-title">
							<h4>Activity Reports Of The Staff</h4>
						</div>
					</div>
					<!-- /add -->


					<div class="card">
						<div class="card-body">
                            <hr>
                                <a href="backend/download_activity_report.php" class="btn btn-success btn-sm">Download Excel</a>
                            <hr>
							<div class="row">
								<div class="col-12">
									<table class="table datanew" >
									  <thead>
									    <tr>
									      <th>User Name</th>
									      <th>User Level</th>
									      <th>Activity</th>
                                          <th>Date & Time</th>
									    </tr>
									  </thead>
									  <tbody>
									    <?php
									      $sql_users ="SELECT * FROM tbl_user_activity_report  ORDER BY `tbl_user_activity_report`.`ar_id` DESC";
									      $rs_users = $conn->query($sql_users);

									      if($rs_users->num_rows > 0){
									        while($rowUsers = $rs_users->fetch_assoc()){
                                                        $uid = $rowUsers['u_id'];
                                                        $u_level_id = getDataBack($conn,'tbl_users','u_id',$uid,'u_level');
                                                        $user_name = getDataBack($conn,'tbl_users','u_id',$uid,'u_name');
														$user_level = $u_level_id;

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
									      <td><?= $user_name ?></td>
									      <td><?= $userText ?></td>
                                          <td> <?= $rowUsers['data_feild'] ?> </td>
                                          <td> <?= $rowUsers['activity_datetime'] ?> </td>
									
									    </tr>
									  <?php } } ?>

									  </tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- /add -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

    <?php include './layouts/footer.php' ?>

    </body>
</html>
