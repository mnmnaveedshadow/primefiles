<?php
include 'conn.php';


$wd_desc =$_REQUEST['wd_desc'];
$wd_uom =$_REQUEST['wd_uom'];
$wd_rate =$_REQUEST['wd_rate'];
$wd_remark =$_REQUEST['wd_remark'];
$wd_validity =$_REQUEST['wd_validity'];
$wd_w_cat =$_REQUEST['wd_w_cat'];


$sqlAdd = "INSERT INTO tbl_warehouse_data
            (wd_description,wd_uom,wd_rate,wd_remarks,wd_validity,wc_id) VALUES
            ('$wd_desc','$wd_uom','$wd_rate','$wd_remark','$wd_validity','$wd_w_cat')";
$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Ware House Data Added','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  echo 200;
}
else{
  echo 300;
}


 ?>
