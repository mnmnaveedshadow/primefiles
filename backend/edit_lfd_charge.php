<?php
include 'conn.php';

$id = $_REQUEST['id'];

$ldc_countries =$_REQUEST['ldc_countries'];
$ldc_city =$_REQUEST['ldc_city'];
$ldc_border =$_REQUEST['ldc_border'];

$ldc_vendor =$_REQUEST['ldc_vendor'];
$ldc_desc =$_REQUEST['ldc_desc'];
$ldc_aed =$_REQUEST['ldc_aed'];
$ldc_currency =$_REQUEST['ldc_currency'];
$ldc_uom =$_REQUEST['ldc_uom'];
$ldc_min_aed =$_REQUEST['ldc_min_aed'];
$ldc_validity =$_REQUEST['ldc_validity'];

$ldc_tos =$_REQUEST['ldc_tos'];

if($ldc_countries !=""){
  $sqlAdd = "UPDATE tbl_road_destination_charge SET
              country_id='$ldc_countries',
              city_id='$ldc_city',
              border_id='$ldc_border',
              v_id='$$ldc_vendor',
              rdc_tos='$ldc_tos',
              rdc_desc='$ldc_desc',
              rdc_charge='$ldc_aed',
              currency='$ldc_currency',
              uom='$ldc_uom',
              rdc_min='$ldc_min_aed',
              rdc_validity='$ldc_validity' WHERE rdc_id ='$id'";
}
else {
  $sqlAdd = "UPDATE tbl_road_destination_charge SET
              v_id='$$ldc_vendor',
              rdc_tos='$ldc_tos',
              rdc_desc='$ldc_desc',
              rdc_charge='$ldc_aed',
              currency='$ldc_currency',
              uom='$ldc_uom',
              rdc_min='$ldc_min_aed',
              rdc_validity='$ldc_validity' WHERE rdc_id ='$id'";
}


$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Land Destination Data Edited','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  echo 200;
}
else{
  echo $sqlAdd;

}


 ?>
