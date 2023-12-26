

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
							<h4>Package Data</h4>
						</div>
					</div>
					<!-- /add -->

					<div class="card">
					    <div class="card-body">
                <h4>Package Type</h4> <hr>
					        <div class="row">
					            <div class="col-4">
					                <form class="" action="backend/add_package_type.php" method="post">
					                    <div class="form-group">
					                        <label for="">Package Type</label>
					                        <input type="text" class="form-control" placeholder="Package Type" name="package_desc" value="" required>
					                    </div>
					                    <button type="submit" class="btn btn-primary btn-me2" name="button">Add</button>
					                </form>
					                <br><br>
					            </div>
					            <div class="col-8">
					                <table class="table datanew">
					                    <thead>
					                        <tr>
					                            <th>Package Type</th>
					                            <th>Modification/Delete</th>
					                        </tr>
					                    </thead>
					                    <tbody>
                                <?php
                                  $sql = "SELECT * FROM tbl_package_type";
                                  $rs = $conn->query($sql);
                                  if($rs->num_rows > 0){
                                    while($row_pt = $rs->fetch_assoc()){
                                 ?>
					                        <tr>
					                            <td><?= $row_pt['pt_name'] ?></td>
					                            <td><a href="backend/del_pt.php?id=<?= $row_pt['pt_id'] ?>" > <img src="assets/img/icons/delete.svg" alt="img"> </a></td>
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
		<!-- /Main Wrapper -->
    <?php include './layouts/footer.php' ?>
		<script type="text/javascript">

		</script>
    </body>
</html>
