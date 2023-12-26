<?php
include 'conn.php';

$id = $_REQUEST['id'];

$sdc_countries =$_REQUEST['sdc_countries'];
$sdc_city =$_REQUEST['sdc_city'];
$sdc_seaport =$_REQUEST['sdc_seaport'];
$sdc_vendor =$_REQUEST['sdc_vendor'];
$sdc_desc =$_REQUEST['sdc_desc'];
$sdc_aed =$_REQUEST['sdc_aed'];
$sdc_currency =$_REQUEST['sdc_currency'];
$sdc_uom =$_REQUEST['sdc_uom'];
$sdc_min_aed =$_REQUEST['sdc_min_aed'];
$sdc_validity =$_REQUEST['sdc_validity'];
$sdc_remark=$_REQUEST['sdc_remark'];

$sdc_typeOfService =$_REQUEST['sdc_typeOfService'];
$sdc_container_id =$_REQUEST['sdc_container_id'];

if($sdc_countries != ""){
  $sqlAdd = "UPDATE tbl_sea_dest_charge
              SET country_id='$sdc_countries',
                  city_id='$sdc_city',
                  sp_id='$sdc_seaport',
                  sdc_vendor='$sdc_vendor',
                  sdc_tos='$sdc_typeOfService',
                  sdc_toc='$sdc_container_id',
                  sdc_desc='$sdc_desc',
                  sdc_charge='$sdc_aed',
                  sdc_currency='$sdc_currency',
                  sdc_uom='$sdc_uom',
                  sdc_min='$sdc_min_aed',
                  sdc_remark='$sdc_remark',
                  sdc_validity='$sdc_validity' WHERE sdc_id='$id' ";
}
else {
  $sqlAdd = "UPDATE tbl_sea_dest_charge
              SET sdc_vendor='$sdc_vendor',
                  sdc_tos='$sdc_typeOfService',
                  sdc_toc='$sdc_container_id',
                  sdc_desc='$sdc_desc',
                  sdc_charge='$sdc_aed',
                  sdc_currency='$sdc_currency',
                  sdc_uom='$sdc_uom',
                  sdc_min='$sdc_min_aed',
                  sdc_remark='$sdc_remark',
                  sdc_validity='$sdc_validity' WHERE sdc_id='$id' ";
}


$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Sea Frieght Destination Charge Edited','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  echo 200;
}
else{
  echo 300;

}


 ?>
