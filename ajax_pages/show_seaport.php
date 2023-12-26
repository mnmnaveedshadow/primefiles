<?php include '../backend/conn.php'; ?>


<?php

  $city_id = $_REQUEST['id'];

  $sql = "SELECT * FROM `tbl_sea_port` WHERE city_id='$city_id'";
  $rs= $conn->query($sql);
  if($rs->num_rows > 0){
    ?>
    <option value="">Select SeaPort</option>
    <?php
    while($row_s = $rs->fetch_assoc()){
 ?>
 <option value="<?= $row_s['sp_id'] ?>"><?= $row_s['sp_name'] ?></option>
<?php } } ?>
