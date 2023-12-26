<?php
include 'conn.php';

$id = $_REQUEST['id'];
$carrier_name =$_REQUEST['carrier_name'];

$sqlAdd = "UPDATE tbl_sea_carrier SET sc_name='$carrier_name' WHERE sc_id='$id'";
$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Sea Carrier Data Edited','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsDelAd > 0){
  header('location:../sea_carrier.php');
  exit();
}
else{
  header('location:../sea_carrier.php');
  exit();
}


 ?>
