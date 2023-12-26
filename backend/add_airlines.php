<?php
include 'conn.php';


$airline_name =$_REQUEST['airline_name'];

$normalized_airline_name = strtolower(str_replace(' ', '', $airline_name));

$sqlValidity = "SELECT * FROM tbl_airlines WHERE LOWER(REPLACE(air_line_name, ' ', '')) = '$normalized_airline_name'";
$rsValidity = $conn->query($sqlValidity);

if ($rsValidity->num_rows > 0) {
    // Exact match found, do not add
    header('location:../air_lines.php?err');
    exit();
}

$sqlAdd = "INSERT INTO tbl_airlines (air_line_name) VALUES ('$airline_name')";
$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Air Line Data Added','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  header('location:../air_lines.php');
  exit();
}
else{
  header('location:../air_lines.php');
  exit();
}


 ?>
