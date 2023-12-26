

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
							<h4>Containers Management</h4>
						</div>
					</div>
					<!-- /add -->
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4">
									<form class="" action="backend/add_container.php" method="post" enctype="multipart/form-data">
										<div class="form-group">
											<label for="">Containers</label>
											<input type="text" class="form-control" placeholder="" name="container_name" value="" required>
										</div>
										<button type="submit" class="btn btn-primary btn-me2" name="button">Add</button>
									</form>
									<br><br>
								</div>
								<div class="col-8">
									<table class="table datanew" >
									  <thead>
									    <tr>
									      <th>Containers</th>
												<th>Modification</th>
												<th>Delete</th>
									    </tr>
									  </thead>
									  <tbody>
									    <?php
									      $sql ="SELECT * FROM tbl_container";
									      $rs = $conn->query($sql);

									      if($rs->num_rows > 0){
									        while($row = $rs->fetch_assoc()){
														$id = $row['cr_id'];

									     ?>
									    <tr>
									      <td><?= $row['cr_name'] ?></td>
												<td><a onclick="openEditContainerData(<?= $id ?>)"> <img src="assets/img/icons/edit.svg" alt="img"> </a></td>
									      <td>
									        <a href="backend/del_container.php?id=<?= $id ?>"
														 onclick="return confirm('Are you sure you want to remove the container?')"><img src="assets/img/icons/delete.svg" alt="img"> </a>
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

		<div class="modal fade" style="" id="edit_Container" tabindex="-1" aria-labelledby="edit_Container"  aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document" >
				<div class="modal-content">
					<div class="modal-header">
						 <h5 class="modal-title" >Change Container Data</h5>
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body" id="edit_Container_data">

					</div>
				</div>
			</div>
		</div>

    <?php include './layouts/footer.php' ?>
		<script type="text/javascript">
				function openEditContainerData(id){
					$('#edit_Container').modal('show');
					$('#edit_Container_data').load('ajax_pages/edit_container_data.php',{ cont_id:id });
				}
		</script>
    </body>
</html>
