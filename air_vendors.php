

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
							<h4>Vendors Management</h4>
						</div>
					</div>
					<!-- /add -->


					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4">
									<form class="" action="backend/add_vendors.php" method="post" enctype="multipart/form-data">
										<div class="form-group">
											<label for="">Vendors</label>
											<input type="text" class="form-control" placeholder="" name="air_vendor_name" value="" required>
										</div>
										<button type="submit" class="btn btn-primary btn-me2" name="button">Add</button>
									</form>
									<br><br>
								</div>
								<div class="col-8">
									<table class="table datanew" >
									  <thead>
									    <tr>
									      <th>Vendors</th>
                                          <th>Modification</th>
                                          <th>Delete</th>
									    </tr>
									  </thead>
									  <tbody>
									    <?php
									      $sql ="SELECT * FROM tbl_air_vendor";
									      $rs = $conn->query($sql);

									      if($rs->num_rows > 0){
									        while($row = $rs->fetch_assoc()){
														$id = $row['av_id'];

									     ?>
									    <tr>
									      <td><?= $row['av_name'] ?></td>
                                          <td>
									        <a onclick="openEditAirVendor(<?= $id ?>)"><img src="assets/img/icons/edit.svg" alt="img"> </a>
									      </td>
									      <td>
									        <a href="backend/del_vendor.php?id=<?= $id ?>"
														 onclick="return confirm('Are you sure you want to remove the vendor?')"><img src="assets/img/icons/delete.svg" alt="img"> </a>
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
        <div class="modal fade" style="" id="vendor_edit" tabindex="-1" aria-labelledby="vendor_edit"  aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document" >
				<div class="modal-content">
					<div class="modal-header">
						 <h5 class="modal-title" >Change Vendor Data</h5>
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body" id="load_vendor_edit">

					</div>
				</div>
			</div>
		</div>

    <?php include './layouts/footer.php' ?>
    <script type="text/javascript">
			function openEditAirVendor(v_id){
				$('#vendor_edit').modal('show');
				$('#load_vendor_edit').load('ajax_pages/edit_air_vendor.php',{ id:v_id });
			}




		</script>
    </body>
</html>
