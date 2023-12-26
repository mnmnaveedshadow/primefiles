<?php
include 'conn.php';

$city_name =$_REQUEST['cityName'];
$name = $_REQUEST['airCode'];

$name = strtoupper(str_replace(' ','',$name));

$sqlValidity = "SELECT * FROM airports WHERE code='$name'";
$rsValidity = $conn->query($sqlValidity);
if($rsValidity->num_rows > 0){
  echo 500;
  exit();
}

$sqlAdd = "INSERT INTO airports (city_id,code) VALUES ('$city_name','$name')";
$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Air Port Code Added','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  echo 200;
}
else{
  echo 300;

}


 ?>
