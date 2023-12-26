<?php
include 'conn.php';

  $id = $_REQUEST['id'];
  $qid = $_REQUEST['qid'];

  $sqlDeleteAd= "DELETE FROM tbl_warehouse_cat_q WHERE wc_id='$id'";
  $rsDelAd = $conn->query($sqlDeleteAd);

  $sqlDelete = "DELETE FROM tbl_warehouse_data_q WHERE wc_id='$id'";
  $rsDelete = $conn->query($sqlDelete);

  $uid=$_SESSION['uid'];
  $sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Deleted Warehouse Category on Q-ID:$qid','$current_date_time')";
  $rsActivity = $conn->query($sqlActivity);


  if($rsDelAd == 1){
    header('location:../quote_breakdown_warehousing.php?q_id='.$qid);
    exit();
  }
  else {
    header('location:../quote_breakdown_warehousing.php?q_id='.$qid);
    exit();
  }



 ?>
