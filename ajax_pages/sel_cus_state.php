<?php include '../backend/conn.php'; ?>


<?php

  $country_id = $_REQUEST['c_id'];

  $phoneCode = getDataBack($conn_loc,'countries','id',$country_id,'phonecode');
  ?>
  <script type="text/javascript">
    document.getElementById('phoneNumber').value = <?= $phoneCode ?>;
  </script>
  <?php

  $sql = "SELECT * FROM `states` WHERE country_id='$country_id'";
  $rs= $conn_loc->query($sql);
  if($rs->num_rows > 0){
    ?>
    <option value="">Select State</option>
    <?php
    while($row_s = $rs->fetch_assoc()){
 ?>
 <option value="<?= $row_s['id'] ?>"><?= $row_s['name'] ?>  </option>
<?php } }else{ ?>
  <option value="">Not Found</option>
<?php } ?>
