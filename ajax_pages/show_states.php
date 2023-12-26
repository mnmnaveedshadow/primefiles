<?php include '../backend/conn.php'; ?>


<?php

  $country_id = $_REQUEST['co_id'];

  $sql = "SELECT * FROM `states` WHERE country_id='$country_id'";
  $rs= $conn->query($sql);
  if($rs->num_rows > 0){
    ?>
    <option value="">Select State</option>
    <?php
    while($row_s = $rs->fetch_assoc()){
 ?>
 <option value="<?= $row_s['state_id'] ?>"><?= $row_s['name'] ?></option>
<?php } } ?>
