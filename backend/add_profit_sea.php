<?php
include 'conn.php';


$qid =$_REQUEST['q_id'];
$profit_ratio =$_REQUEST['profit_ratio'];

$sql_add_profit_ratio = "UPDATE tbl_quote SET q_profit='$profit_ratio' WHERE q_id='$qid'";
$rs_add_profit_ratio = $conn->query($sql_add_profit_ratio);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Profit Added to Q-ID:$qid','$current_date_time')";
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
