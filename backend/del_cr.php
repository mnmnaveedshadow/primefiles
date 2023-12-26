<?php
include 'conn.php';

$id = $_REQUEST['id'];


  $sqlDeleteAd= "DELETE FROM tbl_sea_carrier WHERE sc_id='$id'";
  $rsDelAd = $conn->query($sqlDeleteAd);

  $uid=$_SESSION['uid'];
  $sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','sea_carrier Data Deleted','$current_date_time')";
  $rsActivity = $conn->query($sqlActivity);

  if ($rsDelAd > 0) {
    header('location:../sea_carrier.php');
    exit();
  }else {
    header('location:../sea_carrier.php');
    exit();
  }



 ?>
