<?php
include 'conn.php';

$wc_id = $_REQUEST['wc_id'];
$qid = $_REQUEST['qid'];

$desc = $_REQUEST['desc'];
$uom = $_REQUEST['uom'];
$rate = $_REQUEST['rate'];
$remark = $_REQUEST['remark'];
$validity = $_REQUEST['validity'];

$sqlUpdate = "UPDATE tbl_warehouse_data_q
                     SET wd_description='$desc',
                         wd_uom='$uom',
                         wd_rate='$rate',
                         wd_remarks='$remark',
                         wd_validity='$validity'
                     WHERE wd_id='$wc_id'";
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
