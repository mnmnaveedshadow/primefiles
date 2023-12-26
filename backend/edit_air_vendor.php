<?php
include 'conn.php';

$id = $_REQUEST['id'];
$v_name =$_REQUEST['v_name'];


$sqlAdd = "UPDATE tbl_air_vendor SET av_name='$v_name' WHERE av_id='$id'";
$rsAdd = $conn->query($sqlAdd);


$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Air Vendor Data Edited','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  header('location:../air_vendors.php');
  exit();
}
else{
  header('location:../air_vendors.php');
  exit();
}


 ?>
