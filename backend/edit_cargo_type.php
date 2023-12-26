<?php
include 'conn.php';

$id = $_REQUEST['id'];
$c_name =$_REQUEST['c_name'];
$cargo_pr = $_REQUEST['cargo_pr'];

$sqlAdd = "UPDATE tbl_cargo_type SET ctype='$c_name',c_pr='$cargo_pr' WHERE ctype_id='$id'";
$rsAdd = $conn->query($sqlAdd);


$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Cargo Type Data Edited','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsDelAd > 0){
  header('location:../cargo_type.php');
  exit();
}
else{
  header('location:../cargo_type.php');
  exit();
}


 ?>
