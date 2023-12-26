<?php
include 'conn.php';
session_destroy();

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Logged Out','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

header('location:../index.php');
exit();
 ?>
