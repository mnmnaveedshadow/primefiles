<?php
include 'conn.php';

$alid = $_REQUEST['al_id'];
$airline_name =$_REQUEST['airline_name'];


$sqlAdd = "UPDATE tbl_airlines SET air_line_name='$airline_name' WHERE al_id='$alid'";
$rsAdd = $conn->query($sqlAdd);


$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Air Line Data Edited','$current_date_time')";
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
