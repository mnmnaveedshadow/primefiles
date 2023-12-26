<!-- Header -->
<?php include 'layouts/header.php'; ?>
<!-- Header -->

<!-- Sidebar -->
<?php include 'layouts/sidebar.php'; ?>
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
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-4">
						<div class="form-group">
							<label for="">Warehouse Category</label>
							<select class="form-control" id="w_cat" name="">
								<?php
									$sqlSel = "SELECT * FROM tbl_warehouse_cat";
									$rsSel = $conn->query($sqlSel);

									if($rsSel->num_rows > 0){
										while($rowSel = $rsSel->fetch_assoc()){
								 ?>
									<option value="<?= $rowSel['wc_id'] ?>"><?= $rowSel['wc_name'] ?></option>
							 <?php } }else{ ?>
									<option value="">No Data Found</option>
							 <?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="">Description</label>
							<input type="text" class="form-control" id="desc" value="">
						</div>
						<div class="form-group">
							<label for="">UOM</label>
							<input type="text" class="form-control" id="uom" value="">
						</div>
						<div class="form-group">
							<label for="">Rate(AED)</label>
							<input type="text" class="form-control" id="rate" value="">
						</div>
						<div class="form-group">
							<label for="">Remark</label>
							<input type="text" class="form-control" id="remark" value="">
						</div>
						<div class="form-group">
							<label for="">Validity</label>
							<input type="date" class="form-control" id="validity" value="">
						</div>
						<button type="button" class="btn btn-primary btn-sm" onclick="addWareHouseData()" name="button">Add</button>
					</div>
					<div class="col-8" id="warehouse_data">

					</div>
				</div>
			</div>
		</div>
		<br><br>
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-4">
						<div class="form-group">
							<label for="">Warehouse Category</label>
							<input type="text" class="form-control" id="cat_name" value="">
						</div>
						<button type="button" class="btn btn-primary btn-sm" onclick="addWc()" name="button">Add</button>
					</div>
					<div class="col-8" id="warehouse_cat_list">

					</div>
				</div>
			</div>
		</div>


	</div>
</div>

</div>
<!-- /Main Wrapper -->

<?php include 'layouts/footer.php' ?>

<script>

	$('#warehouse_data').load('ajax_pages/warehouse_data.php');

	$('#warehouse_cat_list').load('ajax_pages/warehouse_cat.php');

	function addWareHouseData(){

				var w_cat= document.getElementById('w_cat').value;
				var desc= document.getElementById('desc').value;
				var uom= document.getElementById('uom').value;
				var rate= document.getElementById('rate').value;
				var remark= document.getElementById('remark').value;
				var validity= document.getElementById('validity').value;


				$.ajax({
					url:'backend/add_ware_data.php',
					method:'POST',
					data:{
						wd_w_cat:w_cat,
						wd_desc:desc,
						wd_uom:uom,
						wd_rate:rate,
						wd_remark:remark,
						wd_validity:validity
					},
					success:function(response){
						if(response == 200){
							document.getElementById('desc').value='';
							document.getElementById('uom').value='';
							document.getElementById('rate').value='';
							document.getElementById('remark').value='';
							$('#warehouse_data').load('ajax_pages/warehouse_data.php');
						}
						else {
							alert('Something Went Wrong');
						}
					}
				});
	}

function delWareData(wd_id){
	if(confirm('Are You Sure You Want To Delete?')){
		$.ajax({
			url:'backend/del_ware_data.php',
			method:'POST',
			data:{
				id:wd_id
			},
			success:function(response){
				if(response == 200){
					$('#warehouse_data').load('ajax_pages/warehouse_data.php');
				}
				else {
					alert('Something Went Wrong');
				}
			}
		});
	}
}

	// warehouse cat
	function addWc(){

		var cat_name= document.getElementById('cat_name').value;

		$.ajax({
			url:'backend/add_wc.php',
			method:'POST',
			data:{
				cName:cat_name
			},
			success:function(response){
				if(response == 200){
					document.getElementById('cat_name').value='';
					$('#warehouse_cat_list').load('ajax_pages/warehouse_cat.php');
				}
				else {
					alert('Something Went Wrong');
				}
			}
		});
	}

	function delWc(wc_id){
		if(confirm('Are You Sure You Want To Delete?')){
			$.ajax({
				url:'backend/del_wc.php',
				method:'POST',
				data:{
					id:wc_id
				},
				success:function(response){
					if(response == 200){
						$('#warehouse_cat_list').load('ajax_pages/warehouse_cat.php');
					}
					else {
						alert('Something Went Wrong');
					}
				}
			});
		}
	}

</script>

</body>
</html>
