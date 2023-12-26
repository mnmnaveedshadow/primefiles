

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
							<h4>Airlines Management</h4>
						</div>
					</div>
					<!-- /add -->


					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4">
									<form class="" action="backend/add_airlines.php" method="post" enctype="multipart/form-data">
										<div class="form-group">
											<label for="">Airlines</label>
											<input type="text" class="form-control" placeholder="" name="airline_name" value="" required>
										</div>
										<button type="submit" class="btn btn-primary btn-me2" name="button">Add</button>
									</form>
									<br><br>
								</div>
								<div class="col-8">
									<table class="table datanew" >
									  <thead>
									    <tr>
									      <th>Airlines</th>
												<th>Edit</th>
												<th>Delete</th>
									    </tr>
									  </thead>
									  <tbody>
									    <?php
									      $sql ="SELECT * FROM tbl_airlines";
									      $rs = $conn->query($sql);

									      if($rs->num_rows > 0){
									        while($row = $rs->fetch_assoc()){
														$id = $row['al_id'];

									     ?>
									    <tr>
									      <td><?= $row['air_line_name'] ?></td>

									      <td>
													<a href="#"
														 onclick="openEditUserModal(<?= $id ?>)"><img src="assets/img/icons/edit.svg" alt="img"> </a>
									      </td>
												<td>

													<a href="backend/del_airline.php?id=<?= $id ?>"
														 onclick="return confirm('Are you sure you want to remove the airline?')"><img src="assets/img/icons/delete.svg" alt="img"> </a>
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
		<div class="modal fade" style="" id="airline_edit" tabindex="-1" aria-labelledby="airline_edit"  aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document" >
				<div class="modal-content">
					<div class="modal-header">
						 <h5 class="modal-title" >Change Airline</h5>
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body" id="edit_airlines">

					</div>
				</div>
			</div>
		</div>
    <?php include './layouts/footer.php' ?>
		<script type="text/javascript">
			function openEditUserModal(u_id){
				$('#airline_edit').modal('show');
				$('#edit_airlines').load('ajax_pages/edit_airlines.php',{ al_id:u_id });
			}




		</script>
    </body>
</html>
