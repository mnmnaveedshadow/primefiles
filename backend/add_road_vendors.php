<?php
include 'conn.php';


$road_v_name =$_REQUEST['road_v_name'];

$normalized_name = strtolower(str_replace(' ', '', $road_v_name));

$sqlValidity = "SELECT * FROM tbl_road_vendors WHERE LOWER(REPLACE(rv_name, ' ', '')) = '$normalized_name'";
$rsValidity = $conn->query($sqlValidity);

if ($rsValidity->num_rows > 0) {
    // Exact match found, do not add
    header('location:../road_vendors.php?err');
    exit();
}

$sqlAdd = "INSERT INTO tbl_road_vendors (rv_name) VALUES ('$road_v_name')";
$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Road Vendor Data Added','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  header('location:../road_vendors.php');
  exit();
}
else{
  header('location:../road_vendors.php');
  exit();
}


 ?>
