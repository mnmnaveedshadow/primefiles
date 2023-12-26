<?php
include 'conn.php';

$id = $_REQUEST['soc_id'];
$soc_countries =$_REQUEST['soc_countries'];
$soc_city =$_REQUEST['soc_city'];
$soc_seaport =$_REQUEST['soc_seaport'];

$soc_vendor =$_REQUEST['soc_vendor'];
$soc_desc =$_REQUEST['soc_desc'];

$soc_aed =$_REQUEST['soc_aed'];
$soc_currency =$_REQUEST['soc_currency'];
$soc_min_aed =$_REQUEST['soc_min_aed'];

$soc_uom =$_REQUEST['soc_uom'];


$soc_validity =$_REQUEST['soc_validity'];
$soc_remark=$_REQUEST['soc_remark'];

$soc_typeOfService =$_REQUEST['soc_typeOfService'];
$soc_container_id =$_REQUEST['soc_container_id'];

if($soc_countries != ""){
  $sqlAdd = "UPDATE tbl_sea_orgin_charge
              SET country_id='$soc_countries',
                  city_id='$soc_city',
                  sp_id='$soc_seaport',
                  soc_vendor='$soc_vendor',
                  soc_tos='$soc_typeOfService',
                  soc_toc='$soc_container_id',
                  soc_desc='$soc_desc',
                  soc_charge='$soc_aed',
                  soc_currency='$soc_currency',
                  soc_uom='$soc_uom',
                  soc_min='$soc_min_aed',
                  soc_remark='$soc_remark',
                  soc_validity='$soc_validity' WHERE soc_id='$id' ";
}
else {
  $sqlAdd = "UPDATE tbl_sea_orgin_charge
              SET soc_vendor='$soc_vendor',
                  soc_tos='$soc_typeOfService',
                  soc_toc='$soc_container_id',
                  soc_desc='$soc_desc',
                  soc_charge='$soc_aed',
                  soc_currency='$soc_currency',
                  soc_uom='$soc_uom',
                  soc_min='$soc_min_aed',
                  soc_remark='$soc_remark',
                  soc_validity='$soc_validity' WHERE soc_id='$id' ";
}


$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Sea Frieght Orgin Charge Edited','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  echo 200;
}
else{
  echo $sqlAdd;

}


 ?>
