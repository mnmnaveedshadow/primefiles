<?php
include 'conn.php';

$id = $_REQUEST['air_id'];


  $sqlDeleteAd= "DELETE FROM airports WHERE airport_id ='$id'";
  $rsDelAd = $conn->query($sqlDeleteAd);

  $uid=$_SESSION['uid'];
  $sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Deleted Air Port Data','$current_date_time')";
  $rsActivity = $conn->query($sqlActivity);

  if ($rsDelAd > 0) {
    echo 200;
    exit();
  }



 ?>
