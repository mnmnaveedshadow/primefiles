

			<!-- Header -->
			<?php include './layouts/header.php'; ?>
			<!-- Header -->

           <!-- Sidebar -->
			<?php include './layouts/sidebar.php'; ?>
			<!-- /Sidebar -->

			<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="page-title">
							<h4>Cargo Types</h4>
						</div>
					</div>
					<!-- /add -->

					<div class="card">
					    <div class="card-body">
                <h4>Cargo Type</h4> <hr>
					        <div class="row">
					            <div class="col-4">
					                <form class="" action="backend/add_cargo_type.php" method="post">
					                    <div class="form-group">
					                        <label for="">Cargo Types</label>
					                        <input type="text" class="form-control" placeholder="Cargo Types" name="cargo_type" value="" required>
					                    </div>
															<div class="form-group">
																	<label for="">Cargo Priority</label>
																	<input type="number" min="1" class="form-control" placeholder="Ex:1" name="cargo_pr" value="" required>
															</div>
					                    <button type="submit" class="btn btn-primary btn-me2" name="button">Add</button>
					                </form>
					                <br><br>
					            </div>
					            <div class="col-8">
					                <table class="table datanew">
					                    <thead>
					                        <tr>
					                            <th>Cargo Type</th>
																			<th>Cargo Priority</th>
					                            <th>Modification</th>
																			<th>Delete</th>
					                        </tr>
					                    </thead>
					                    <tbody>
                                <?php
                                  $sql = "SELECT * FROM tbl_cargo_type";
                                  $rs = $conn->query($sql);
                                  if($rs->num_rows > 0){
                                    while($row_pt = $rs->fetch_assoc()){
                                 ?>
					                        <tr>
					                            <td><?= $row_pt['ctype'] ?></td>
																			<td><?= $row_pt['c_pr'] ?></td>
																			<td><a onclick="openEditCargoData(<?= $row_pt['ctype_id'] ?>)"> <img src="assets/img/icons/edit.svg" alt="img"> </a></td>
					                            <td><a href="backend/del_ct.php?id=<?= $row_pt['ctype_id'] ?>" onclick="return confirm('Are you sure you want to delete the [<?= $row_pt['ctype'] ?>] data?')" > <img src="assets/img/icons/delete.svg" alt="img"> </a></td>
					                        </tr>
                                <?php } } ?>
					                    </tbody>
					                </table>
					            </div>
					        </div>
                  <br>
					    </div>
					</div>


					<!-- /add -->
				</div>
			</div>
        </div>

				<div class="modal fade" style="" id="edit_cargo" tabindex="-1" aria-labelledby="edit_cargo"  aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document" >
						<div class="modal-content">
							<div class="modal-header">
								 <h5 class="modal-title" >Change User Level</h5>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body" id="edit_cargo_data">

							</div>
						</div>
					</div>
				</div>
		<!-- /Main Wrapper -->
    <?php include './layouts/footer.php' ?>
		<script type="text/javascript">
			function openEditCargoData(u_id){
				$('#edit_cargo').modal('show');
				$('#edit_cargo_data').load('ajax_pages/edit_cargo_data.php',{ id:u_id });
			}
		</script>
    </body>
</html>
