<?php include '../backend/conn.php'; ?>


<?php

  $st_id = $_REQUEST['s_id'];

  $sql = "SELECT * FROM `cities` WHERE state_id='$st_id'";
  $rs= $conn_loc->query($sql);
  if($rs->num_rows > 0){
    ?>
    <option value="">Select City</option>
    <?php
    while($row_s = $rs->fetch_assoc()){
 ?>
 <option value="<?= $row_s['id'] ?>"><?= $row_s['name'] ?></option>
<?php } }?>
