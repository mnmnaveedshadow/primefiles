

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
							<h4>Manage Carrier</h4>
						</div>
					</div>
					<!-- /add -->

					<div class="card">
					    <div class="card-body">
                <h4>Carrier</h4> <hr>
					        <div class="row">
					            <div class="col-4">
					                <form class="" action="backend/add_carrier.php" method="post">
					                    <div class="form-group">
					                        <label for="">Carrier Name</label>
					                        <input type="text" class="form-control" placeholder="Carrier Name" name="carrier_name" value="" required>
					                    </div>
					                    <button type="submit" class="btn btn-primary btn-me2" name="button">Add</button>
					                </form>
					                <br><br>
					            </div>
					            <div class="col-8">
					                <table class="table datanew">
					                    <thead>
					                        <tr>
					                            <th>Carrier Name</th>
					                            <th>Modification</th>
																			<th>Delete</th>
					                        </tr>
					                    </thead>
					                    <tbody>
                                <?php
                                  $sql = "SELECT * FROM tbl_sea_carrier";
                                  $rs = $conn->query($sql);
                                  if($rs->num_rows > 0){
                                    while($row_pt = $rs->fetch_assoc()){
                                 ?>
					                        <tr>
					                            <td><?= $row_pt['sc_name'] ?></td>
																			<td><a onclick="openEditCarrierData(<?= $row_pt['sc_id'] ?>)"> <img src="assets/img/icons/edit.svg" alt="img"> </a></td>
					                            <td><a href="backend/del_cr.php?id=<?= $row_pt['sc_id'] ?>"
																				 		 onclick="return confirm('Are you sure you want to delete the [<?= $row_pt['sc_name'] ?>] data?')" >
																						 <img src="assets/img/icons/delete.svg" alt="img"> </a></td>
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

				<div class="modal fade" style="" id="edit_carrier" tabindex="-1" aria-labelledby="edit_carrier"  aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document" >
						<div class="modal-content">
							<div class="modal-header">
								 <h5 class="modal-title" >Change Carrier Data</h5>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body" id="edit_carrier_data">

							</div>
						</div>
					</div>
				</div>
		<!-- /Main Wrapper -->
    <?php include './layouts/footer.php' ?>
		<script type="text/javascript">
			function openEditCarrierData(id){
				$('#edit_carrier').modal('show');
				$('#edit_carrier_data').load('ajax_pages/edit_carrier_data.php',{ c_id:id });
			}
		</script>
    </body>
</html>
