<?php
include 'conn.php';


$name =$_REQUEST['cName'];

$sql ="SELECT * FROM countries WHERE name ='$name'";
$rs = $conn->query($sql);

if($rs->num_rows > 0){
  echo 500;
  exit();
}

$sqlAdd = "INSERT INTO countries (name) VALUES ('$name')";
$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Country Name Added','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  echo 200;
}
else{
  echo 300;

}


 ?>
