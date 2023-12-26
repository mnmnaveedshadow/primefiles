<?php
include 'conn.php';

$id = $_REQUEST['locId'];


  $sqlDeleteAd= "DELETE FROM tbl_road_orgin_charge WHERE roc_id ='$id'";
  $rsDelAd = $conn->query($sqlDeleteAd);
  
  $uid=$_SESSION['uid'];
  $sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Deleted Land Orgin Charge','$current_date_time')";
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
