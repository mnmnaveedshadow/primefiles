<?php
include 'conn.php';

$package_desc =$_REQUEST['package_desc'];

$normalized_name = strtolower(str_replace(' ', '', $package_desc));

             $sqlValidity = "SELECT * FROM tbl_package_type WHERE LOWER(REPLACE(pt_name, ' ', '')) = '$normalized_name'";
             $rsValidity = $conn->query($sqlValidity);
             
             if ($rsValidity->num_rows > 0) {
                 // Exact match found, do not add
                 header('location:../package_datas.php?err');
                 exit();
             }

$sqlAdd = "INSERT INTO tbl_package_type (pt_name) VALUES ('$package_desc')";
$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Package Type Added','$current_date_time')";
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
