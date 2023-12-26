<?php
include 'conn.php';


$uname =$_REQUEST['uname'];
$upass =$_REQUEST['upass'];
$utype =$_REQUEST['utype'];

$sqlSel = "SELECT * FROM tbl_users WHERE u_name='$uname'";
$rsSel = $conn->query($sqlSel);

if($rsSel->num_rows > 0){
  $_SESSION['error']= true;
  header('location:../staff_managment.php');
  exit();
}

$sqlAdd = "INSERT INTO tbl_users (u_name,u_pass,u_level) VALUES ('$uname','$upass','$utype')";
$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Created an user','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  header('location:../staff_managment.php');
  exit();
}
else{
  header('location:../staff_managment.php');
  exit();
}


 ?>
