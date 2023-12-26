<?php
include 'conn.php';

$id = $_REQUEST['sdcId'];


  $sqlDeleteAd= "DELETE FROM tbl_sea_dest_charge WHERE sdc_id ='$id'";
  $rsDelAd = $conn->query($sqlDeleteAd);

  $uid=$_SESSION['uid'];
  $sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Deleted Sea Frieght Destination Charge','$current_date_time')";
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
