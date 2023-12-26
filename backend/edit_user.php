<?php
include 'conn.php';

$uid = $_REQUEST['user_id'];
$uname =$_REQUEST['uname'];
$upass =$_REQUEST['upass'];
$utype =$_REQUEST['utype'];

$sqlSel = "SELECT * FROM tbl_users WHERE u_name='$uname' AND u_id !='$uid'";
$rsSel = $conn->query($sqlSel);

if($rsSel->num_rows > 0){
  $_SESSION['error']= true;
  header('location:../staff_managment.php');
  exit();
}

$sqlAdd = "UPDATE tbl_users SET u_name='$uname',u_pass='$upass',u_level='$utype' WHERE u_id='$uid'";
$rsAdd = $conn->query($sqlAdd);

$sql_validate = "SELECT * FROM tbl_users WHERE u_level=1";
$result_validate = $conn->query($sql_validate);


if($result_validate->num_rows == 0){
  $sqlAdd = "UPDATE tbl_users SET u_name='$uname',u_pass='$upass',u_level=1 WHERE u_id='$uid'";
  $rsAdd = $conn->query($sqlAdd);
  $_SESSION['admin_deleted'] = true;
  header('location:../staff_managment.php');
  exit();
}

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Edited User Data U-ID:$uid','$current_date_time')";
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
