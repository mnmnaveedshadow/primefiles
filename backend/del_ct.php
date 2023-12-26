<?php
include 'conn.php';

$id = $_REQUEST['id'];


  $sqlDeleteAd= "DELETE FROM tbl_cargo_type WHERE ctype_id  ='$id'";
  $rsDelAd = $conn->query($sqlDeleteAd);

  $uid=$_SESSION['uid'];
  $sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Deleted Cargo Type Data','$current_date_time')";
  $rsActivity = $conn->query($sqlActivity);


  if($rsDelAd > 0){
    header('location:../cargo_type.php');
    exit();
  }
  else{
    header('location:../cargo_type.php');
    exit();
  }



 ?>
