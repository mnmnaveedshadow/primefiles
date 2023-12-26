<?php
include 'conn.php';

$cargo_type =$_REQUEST['cargo_type'];
$cargo_pr = $_REQUEST['cargo_pr'];

$normalized_name = strtolower(str_replace(' ', '', $cargo_type));

             $sqlValidity = "SELECT * FROM tbl_cargo_type WHERE LOWER(REPLACE(ctype, ' ', '')) = '$normalized_name'";
             $rsValidity = $conn->query($sqlValidity);
             
             if ($rsValidity->num_rows > 0) {
                 // Exact match found, do not add
                 header('location:../cargo_type.php?err');
                 exit();
             }

$sqlAdd = "INSERT INTO tbl_cargo_type (ctype,c_pr) VALUES ('$cargo_type','$cargo_pr')";
$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Cargo Type Added','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  header('location:../cargo_type.php');
  exit();
}
else{
  header('location:../cargo_type.php');
  exit();
}


 ?>
