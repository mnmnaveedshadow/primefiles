

			<!-- Header -->
			<?php include './layouts/header.php'; ?>
			<!-- Header -->

           <!-- Sidebar -->
			<?php include './layouts/sidebar.php'; ?>
			<!-- /Sidebar -->
			<?php
			if ($u_level != 1 && $u_level != 2) {
			    header('location:index.php');
			    $_SESSION['invalid_access'] = true;
			    exit();
			}
			 ?>
			<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="page-title">
							<h4>Sea Vendors Management</h4>
						</div>
					</div>
					<!-- /add -->


					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4">
									<form class="" action="backend/add_sea_vendors.php" method="post">
										<div class="form-group">
											<label for="">Sea Vendors</label>
											<input type="text" class="form-control" placeholder="" name="sea_v_name" value="" required>
										</div>
										<button type="submit" class="btn btn-primary btn-me2" name="button">Add</button>
									</form>
									<br><br>
								</div>
								<div class="col-8">
									<table class="table datanew" >
									  <thead>
									    <tr>
									      <th>Sea Vendor</th>
												<th>Modification</th>
												<th>Action</th>
									    </tr>
									  </thead>
									  <tbody>
									    <?php
									      $sql ="SELECT * FROM tbl_sea_vendors";
									      $rs = $conn->query($sql);

									      if($rs->num_rows > 0){
									        while($row = $rs->fetch_assoc()){
														$id = $row['sv_id'];

									     ?>
									    <tr>
									      <td><?= $row['sv_name'] ?></td>
												<td><a onclick="openEditSeaVendorData(<?= $id ?>)"> <img src="assets/img/icons/edit.svg" alt="img"> </a></td>
									      <td>
									        <a href="backend/del_seavendor.php?id=<?= $id ?>" onclick="return confirm('Are you sure you want to remove the sea vendor?')">
														<img src="assets/img/icons/delete.svg" alt="img">
													</a>
									      </td>
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
					<!-- /add -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->


		<div class="modal fade" style="" id="edit_SeaVendor" tabindex="-1" aria-labelledby="edit_SeaVendor"  aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document" >
				<div class="modal-content">
					<div class="modal-header">
						 <h5 class="modal-title" >Change Sea Vendor Data</h5>
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body" id="edit_SeaVendor_data">

					</div>
				</div>
			</div>
		</div>

    <?php include './layouts/footer.php' ?>
		<script type="text/javascript">

		function openEditSeaVendorData(id){
			$('#edit_SeaVendor').modal('show');
			$('#edit_SeaVendor_data').load('ajax_pages/edit_seavendor_data.php',{ sv_id:id });
		}


		</script>
    </body>
</html>
