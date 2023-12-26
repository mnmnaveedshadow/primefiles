<?php
include 'conn.php';


$name =$_REQUEST['air_vendor_name'];

$normalized_name = strtolower(str_replace(' ', '', $name));

$sqlValidity = "SELECT * FROM tbl_air_vendor WHERE LOWER(REPLACE(av_name, ' ', '')) = '$normalized_name'";
$rsValidity = $conn->query($sqlValidity);

if ($rsValidity->num_rows > 0) {
    // Exact match found, do not add
    header('location:../air_vendors.php?err');
    exit();
}

$sqlAdd = "INSERT INTO tbl_air_vendor (av_name) VALUES ('$name')";
$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Air Vendor Data Added','$current_date_time')";
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
