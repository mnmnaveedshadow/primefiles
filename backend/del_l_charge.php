<?php
include 'conn.php';

$id = $_REQUEST['lcId'];


  $sqlDeleteAd= "DELETE FROM tbl_land_charge WHERE lc_id='$id'";
  $rsDelAd = $conn->query($sqlDeleteAd);

  $uid=$_SESSION['uid'];
  $sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Deleted Land Charge','$current_date_time')";
  $rsActivity = $conn->query($sqlActivity);


  if ($rsDelAd > 0) {
    echo 200;
    exit();
  }
  else {
    echo 300;
    exit();
  }



 ?>
