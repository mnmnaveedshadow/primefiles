<?php
include 'conn.php';

$com_type_text =$conn->real_escape_string($_REQUEST['com_type_text']);

$normalized_name = strtolower(str_replace(' ', '', $com_type_text));

             $sqlValidity = "SELECT * FROM tbl_com_type WHERE LOWER(REPLACE(ct_name, ' ', '')) = '$normalized_name'";
             $rsValidity = $conn->query($sqlValidity);
             
             if ($rsValidity->num_rows > 0) {
                 // Exact match found, do not add
                 header('location:../package_datas.php?err');
                 exit();
             }

$sqlAdd = "INSERT INTO tbl_com_type (ct_name) VALUES ('$com_type_text')";
$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Commodity Type Added','$current_date_time')";
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
