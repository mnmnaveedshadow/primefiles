<?php
include 'conn.php';


$qid =$_REQUEST['q_id'];
$other_charge_name =$_REQUEST['other_charge_name'];
$ex_charge =$_REQUEST['ex_charge'];

$sql_add_profit_ratio = "INSERT INTO tbl_other_charges (oc_charge_name,oc_charge,q_id) VALUES ('$other_charge_name','$ex_charge','$qid')";
$rs_add_profit_ratio = $conn->query($sql_add_profit_ratio);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Other Charges Added Q-ID:$qid','$current_date_time')";
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
