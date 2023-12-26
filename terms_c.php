

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
							<h4>Terms & Condition</h4>
						</div>
					</div>
					<!-- /add -->

					<div class="card">
					    <div class="card-body">
					        <div class="row">
					            <div class="col-4">
					                <form class="" action="backend/add_terms_c.php" method="post">
														<div class="form-group">
															<label for="">Select Service</label>
															<select class="form-control" name="service_type" id="service_type">
																<?php
																	foreach ($prime_services as $key => $value) {
																 ?>
																 	<option value="<?= $key ?>"><?= $value ?></option>
															 <?php } ?>
															</select>

														</div>
					                    <div class="form-group">
					                        <label for="">Description</label>
					                        <textarea name="text" class="form-control" id="editText" rows="8" cols="80"></textarea>
					                    </div>
					                    <button type="submit" class="btn btn-primary btn-me2" name="button">Add/Update</button>
					                </form>
					                <br><br>
					            </div>
											<div class="col-8">
												<?php
													$keyText =1;
													foreach ($prime_services as $key => $value) {
												 ?>
												<h4><?= $value ?></h4>
												<hr>
												<div id="service_text<?= $keyText ?>">
													<?= getDataBack($conn,'tbl_tc','service_type',$key,'tc_text'); ?>
												</div>
												<hr>
												<a class="btn btn-warning btn-sm" onclick="editText(<?= $keyText ?>,<?= $key ?>)">Edit</a>
												<hr><hr>
											<?php $keyText++; } ?>
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
		<script src="https://cdn.tiny.cloud/1/x57alsk2twg5ra6ya33eg7gtbae6bu0i1ylh60wgavb662xt/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
		<script>
		tinymce.init({
		    selector: 'textarea', // Use a more specific selector if needed
		    height: 300, // Set the height of the editor
		    plugins: [
		        'advlist autolink lists link image charmap print preview anchor',
		        'searchreplace visualblocks code fullscreen',
		        'insertdatetime media table paste code help wordcount'
		    ],
		    toolbar: 'undo redo | formatselect | ' +
		        'bold italic backcolor | alignleft aligncenter ' +
		        'alignright alignjustify | bullist numlist outdent indent | ' +
		        'removeformat | help',
		    content_css: '//www.tiny.cloud/css/codepen.min.css', // Optional: Add a custom CSS file
		    // Add the decodeEntities option
		    decodeEntities: true
		});

		</script>
		<script type="text/javascript">
		function editText(keyText, valueToSelect) {
		    var selectElement = document.getElementById('service_type');
		    selectElement.value = valueToSelect;

		    // Get the TinyMCE editor instance
		    var tinyMCEEditor = tinymce.get('editText');

		    // Get the content of the service_text div
		    var textElement = document.getElementById('service_text' + keyText);
		    var text = textElement.innerHTML; // Use innerHTML to get the raw HTML content

		    // Set the content of the TinyMCE editor with the "raw" format option
		    tinyMCEEditor.setContent(text, { format: 'raw' });
		}


		</script>
    </body>
</html>
