<?php
include 'conn.php';


$seaVendor =$_REQUEST['sea_v_name'];

$normalized_name = strtolower(str_replace(' ', '', $seaVendor));

$sqlValidity = "SELECT * FROM tbl_sea_vendors WHERE LOWER(REPLACE(sv_name, ' ', '')) = '$normalized_name'";
$rsValidity = $conn->query($sqlValidity);

if ($rsValidity->num_rows > 0) {
    // Exact match found, do not add
    header('location:../sea_vendors.php?err');
    exit();
}

$sqlAdd = "INSERT INTO tbl_sea_vendors (sv_name) VALUES ('$seaVendor')";
$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Sea Vendor Name Added','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  header('location:../sea_vendors.php');
  exit();
}
else{
  header('location:../sea_vendors.php');
  exit();
}


 ?>
