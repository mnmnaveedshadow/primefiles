<?php
include 'conn.php';


$qid =$_REQUEST['q_id'];
$note =$_REQUEST['note'];

$sql_add = "INSERT INTO tbl_extra_note (q_id,ex_note_text) VALUES ('$qid','$note')";
$rs_add = $conn->query($sql_add);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Extra Note Added To Q-ID:$qid','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rs_add == 1){
  header('location:../quote_breakdown_sea.php?q_id='.$qid."&#extranote");
  exit();
}
else {
  header('location:../quote_breakdown_sea.php?q_id='.$qid);
  exit();
}

 ?>
