<?php
include 'conn.php';

$id = $_REQUEST['id'];
$qid = $_REQUEST['qid'];

  $sqlDeleteAd= "DELETE FROM tbl_extra_note WHERE en_id ='$id'";
  $rsDelAd = $conn->query($sqlDeleteAd);

  $uid=$_SESSION['uid'];
  $sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Deleted Air Line  Data','$current_date_time')";
  $rsActivity = $conn->query($sqlActivity);

  if($rsDelAd == 1){
    header('location:../quote_breakdown_sea.php?q_id='.$qid."&#extranote");
    exit();
  }
  else {
    header('location:../quote_breakdown_sea.php?q_id='.$qid);
    exit();
  }



 ?>
