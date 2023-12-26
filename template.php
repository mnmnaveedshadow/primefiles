

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
							<h4>COURIER IMPORT CLEARANCE</h4>
						</div>
					</div>
					<!-- /add -->

					<div class="card">
					    <div class="card-body">
					        <div class="row">
					            <div class="col-4">
					                <form class="" action="backend/add_item.php" method="post">
					                    <div class="form-group">
					                        <label for="">Description</label>
					                        <input type="text" class="form-control" placeholder="Description" name="description" value="" required>
					                    </div>
					                    <div class="form-group">
					                        <label for="">UOM (Unit of Measure)</label>
					                        <input type="text" class="form-control" placeholder="UOM" name="uom" value="" required>
					                    </div>
					                    <div class="form-group">
					                        <label for="">Aed</label>
					                        <input type="number" class="form-control" placeholder="Aed" name="aed" value="" required>
					                    </div>
					                    <div class="form-group">
					                        <label for="">Min Aed</label>
					                        <input type="number" class="form-control" placeholder="Min Aed" name="min_aed" value="" required>
					                    </div>
					                    <div class="form-group">
					                        <label for="">Remarks</label>
					                        <input type="text" class="form-control" placeholder="Remarks" name="remarks" value="" required>
					                    </div>
					                    <div class="form-group">
					                        <label for="">VALIDITY</label>
					                        <input type="date" class="form-control" placeholder="VALIDITY" name="validity" value="" required>
					                    </div>
					                    <button type="submit" class="btn btn-primary btn-me2" name="button">Add</button>
					                </form>
					                <br><br>
					            </div>
					            <div class="col-8">
					                <table class="table">
					                    <thead>
					                        <tr>
					                            <th>Description</th>
					                            <th>UOM</th>
					                            <th>Aed</th>
					                            <th>Min Aed</th>
					                            <th>Remarks</th>
					                            <th>VALIDITY</th>
					                            <th>Modification/Delete</th>
					                        </tr>
					                    </thead>
					                    <tbody>
					                        <tr>
					                            <td>DNATA handling</td>
					                            <td>Per KG</td>
					                            <td>0.87</td>
					                            <td>87.00</td>
					                            <td></td>
					                            <td>31.12.2023</td>
					                            <td><a href="#" class="btn btn-danger btn-sm"> Delete </a></td>
					                        </tr>
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
		<script type="text/javascript">

		</script>
    </body>
</html>
