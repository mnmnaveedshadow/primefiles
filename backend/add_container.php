<?php
include 'conn.php';


$container_name =$_REQUEST['container_name'];

$normalized_name = strtolower(str_replace(' ', '', $container_name));

$sqlValidity = "SELECT * FROM tbl_container WHERE LOWER(REPLACE(cr_name, ' ', '')) = '$normalized_name'";
$rsValidity = $conn->query($sqlValidity);

if ($rsValidity->num_rows > 0) {
    // Exact match found, do not add
    header('location:../containers.php?err');
    exit();
}

$sqlAdd = "INSERT INTO tbl_container (cr_name) VALUES ('$container_name')";
$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Container Name Added','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  header('location:../containers.php');
  exit();
}
else{
  header('location:../containers.php');
  exit();
}


 ?>
