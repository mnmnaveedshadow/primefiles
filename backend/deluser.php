<?php
include 'conn.php';

$id = $_REQUEST['id'];

  $sql_check = "SELECT * FROM tbl_users WHERE u_id ='$id' AND u_level='1'";
  $rs_check = $conn->query($sql_check);

  if($rs_check->num_rows == 1){
    $sql_validate = "SELECT * FROM tbl_users WHERE u_level=1";
    $result_validate = $conn->query($sql_validate);


    if($result_validate->num_rows == 1){
      $_SESSION['admin_deleted'] = true;
      header('location:../staff_managment.php');
      exit();
    }
  }

  $sqlDeleteAd= "DELETE FROM tbl_users WHERE u_id ='$id'";
  $rsDelAd = $conn->query($sqlDeleteAd);

  $uid=$_SESSION['uid'];
  $sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Deleted User Data','$current_date_time')";
  $rsActivity = $conn->query($sqlActivity);

  
  if ($rsDelAd > 0) {
    header('location:../staff_managment.php');
    exit();
  }
  else {
    header('location:../staff_managment.php');
    exit();
  }



 ?>
