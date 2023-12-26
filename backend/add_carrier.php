<?php
include 'conn.php';

$carrier_name =$_REQUEST['carrier_name'];

$normalized_name = strtolower(str_replace(' ', '', $carrier_name));

$sqlValidity = "SELECT * FROM tbl_sea_carrier WHERE LOWER(REPLACE(sc_name, ' ', '')) = '$normalized_name'";
$rsValidity = $conn->query($sqlValidity);

if ($rsValidity->num_rows > 0) {
    // Exact match found, do not add
    header('location:../sea_carrier.php?err');
    exit();
}

$sqlAdd = "INSERT INTO tbl_sea_carrier (sc_name) VALUES ('$carrier_name')";
$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','sea_carrier data Added','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  header('location:../sea_carrier.php');
  exit();
}
else{
  header('location:../sea_carrier.php');
  exit();
}


 ?>
