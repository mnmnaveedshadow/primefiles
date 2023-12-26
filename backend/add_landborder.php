<?php
include 'conn.php';

$city_name =$_REQUEST['cityName'];

$name = ucwords($_REQUEST['landCode']);

$sqlValidity = "SELECT * FROM tbl_land_border WHERE lb_name = '$name'";
$rsValidity =$conn->query($sqlValidity);

if($rsValidity->num_rows > 0){
  echo 500;
  exit();
}

$sqlAdd = "INSERT INTO tbl_land_border (city_id,lb_name) VALUES ('$city_name','$name')";
$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Land Border Data Added','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  echo 200;
}
else{
  echo 300;

}


 ?>
