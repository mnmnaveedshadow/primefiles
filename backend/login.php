<?php
  include 'conn.php';

  $userName = $_REQUEST['uname'];
  $uPassword = $_REQUEST['upass'];

  $sql = "SELECT * FROM tbl_users WHERE u_name='$userName' AND u_pass='$uPassword'";
  $rs = $conn->query($sql);



  if($rs->num_rows == 1){
  
    $rowUser = $rs->fetch_assoc();

    $_SESSION['uid'] = $rowUser['u_id'];
    $_SESSION['u_name'] = $rowUser['u_name'];
    $_SESSION['u_level'] = $rowUser['u_level'];

    $uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Logged IN','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

    header('location:../index.php');
    exit();
  }
  else {
    $_SESSION['error'] = true;
    header('location:../signin.php');
    exit();
  }
 ?>
