  <?php
  include '../backend/conn.php';
    $user_id = $_REQUEST['uid'];

    $sql_users ="SELECT * FROM tbl_users WHERE u_id='$user_id' ORDER BY `tbl_users`.`u_id` DESC";
    $rs_users = $conn->query($sql_users);

    if($rs_users->num_rows > 0){
        $rowUsers = $rs_users->fetch_assoc();
        $user_level = $rowUsers['u_level'];
    }
   ?>
						<form class="" action="backend/edit_user.php" method="post" enctype="multipart/form-data">
							<input type="hidden" name="user_id"  value="<?= $user_id ?>">
							<div class="form-group">
								<label for="">Staff User Name</label>
								<input type="text" class="form-control" placeholder="User Name" name="uname" value="<?= $rowUsers['u_name'] ?>" required>
								<small>(Always better to avoid space during account creation)</small>
							</div>
							<div class="form-group">
								<label for="">Staff Password</label>
								<input type="text" class="form-control" placeholder="xxxxxxxx" name="upass" value="<?= $rowUsers['u_pass'] ?>" required>
							</div>
							<div class="form-group">
								<label for="">Select Staff Access Level</label>
								<select class="form-control" name="utype" required>
										<option value="1" <?php if($user_level == 1){ echo "selected"; } ?>>Super Admin</option>
										<option value="2" <?php if($user_level == 2){ echo "selected"; } ?>>Data Handler</option>
										<option value="3" <?php if($user_level == 3){ echo "selected"; } ?>>Staff</option>
								</select>
							</div><br>
							<button type="submit" class="btn btn-warning btn-me2" name="button">Edit</button>
						</form>
