<?php
include 'conn.php';

  $id = $_REQUEST['id'];


  $sqlDeleteAd= "DELETE FROM tbl_com_type WHERE ct_id='$id'";
  $rsDelAd = $conn->query($sqlDeleteAd);

  $uid=$_SESSION['uid'];
  $sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Commodity Data Deleted','$current_date_time')";
  $rsActivity = $conn->query($sqlActivity);


  if($rsAdd > 0){
    header('location:../package_datas.php');
    exit();
  }
  else{
    header('location:../package_datas.php');
    exit();
  }



 ?>
