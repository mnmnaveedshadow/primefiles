<?php
include 'conn.php';

$c_id =$_REQUEST['cName'];
$name =$_REQUEST['cityName'];

$name = ucwords($_REQUEST['cityName']);

$sqlValidity = "SELECT * FROM cities WHERE name = '$name'";
$rsValidity =$conn->query($sqlValidity);

if($rsValidity->num_rows > 0){
  echo 500;
  exit();
}

$sqlAdd = "INSERT INTO cities (country_id,name) VALUES ('$c_id','$name')";
$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','City Added','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  echo 200;
}
else{
  echo 300;

}


 ?>
