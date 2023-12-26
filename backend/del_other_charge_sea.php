<?php
include 'conn.php';

$qid = $_REQUEST['qid'];
$id =$_REQUEST['id'];

$sql_add_profit_ratio = "DELETE FROM tbl_other_charges WHERE oc_id='$id'";
$rs_add_profit_ratio = $conn->query($sql_add_profit_ratio);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Deleted Other Charges in Q-ID:$qid','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rs_add_profit_ratio == 1){
  header('location:../quote_breakdown_sea.php?q_id='.$qid);
  exit();
}
else {
  header('location:../quote_breakdown_sea.php?q_id='.$qid);
  exit();
}

 ?>
