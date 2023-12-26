<?php
include 'conn.php';

$id = $_REQUEST['loc_id'];

$loc_countries =$_REQUEST['loc_countries'];
$loc_city =$_REQUEST['loc_city'];
$loc_border =$_REQUEST['loc_border'];

$loc_vendor =$_REQUEST['loc_vendor'];
$loc_desc =$_REQUEST['loc_desc'];

$loc_aed =$_REQUEST['loc_aed'];
$loc_currency =$_REQUEST['loc_currency'];

$loc_uom =$_REQUEST['loc_uom'];
$loc_min_aed =$_REQUEST['loc_min_aed'];
$loc_validity =$_REQUEST['loc_validity'];

$loc_tos =$_REQUEST['loc_tos'];

if($loc_countries != ""){
  $sqlAdd = "UPDATE tbl_road_orgin_charge SET
               country_id='$loc_countries',
               city_id='$loc_city',
               border_id='$loc_border',
               v_id='$loc_vendor',
               roc_tos='$loc_tos',
               roc_desc='$loc_desc',
               roc_charge='$loc_aed',
               currency='$loc_currency',
               uom='$loc_uom',
               roc_min='$loc_min_aed',
               roc_validity='$loc_validity' WHERE roc_id='$id'";
}
else {
  $sqlAdd = "UPDATE tbl_road_orgin_charge SET
                v_id='$loc_vendor',
               roc_tos='$loc_tos',
               roc_desc='$loc_desc',
               roc_charge='$loc_aed',
               currency='$loc_currency',
               uom='$loc_uom',
               roc_min='$loc_min_aed',
               roc_validity='$loc_validity' WHERE roc_id='$id'";
}

$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Land Orgin Data Edited','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  echo 200;
}
else{
  echo 300;
}


 ?>
