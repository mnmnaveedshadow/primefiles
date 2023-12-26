<?php
include 'conn.php';

$wc_id = $_REQUEST['wc_id'];
$data = $_REQUEST['wc_cat_name'];
$qid = $_REQUEST['qid'];

$sqlUpdate = "UPDATE tbl_warehouse_cat_q SET wc_name='$data' WHERE wc_id='$wc_id'";
$rsUpdate = $conn->query($sqlUpdate);


$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Updated Warehouse Data Q-ID:$qid','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsUpdate == 1){
  header('location:../quote_breakdown_warehousing.php?q_id='.$qid);
  exit();
}
else {
  header('location:../quote_breakdown_warehousing.php?q_id='.$qid);
  exit();
}


 ?>
