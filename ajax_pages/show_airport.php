<?php include '../backend/conn.php'; ?>


<?php

  $country_id = $_REQUEST['ap_id'];

  $sql = "SELECT * FROM `airports` WHERE city_id='$country_id'";
  $rs= $conn->query($sql);
  if($rs->num_rows > 0){
    ?>
    <option value="">Select Airport</option>
    <?php
    while($row_s = $rs->fetch_assoc()){
 ?>
 <option value="<?= $row_s['airport_id'] ?>"><?= $row_s['code'] ?></option>
<?php } } ?>
