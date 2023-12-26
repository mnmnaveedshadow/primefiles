<?php
include 'conn.php';


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

$sqlAdd = "INSERT INTO tbl_sea_dest_charge (country_id,city_id,sp_id,sdc_vendor,sdc_tos,sdc_toc,sdc_desc,sdc_charge,sdc_currency,sdc_uom,sdc_min,sdc_remark,sdc_validity) VALUES
            ('$sdc_countries','$sdc_city','$sdc_seaport',
              '$sdc_vendor','$sdc_typeOfService','$sdc_container_id',
              '$sdc_desc','$sdc_aed','$sdc_currency',
              '$sdc_uom','$sdc_min_aed','$sdc_remark','$sdc_validity')";
$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Sea Freight Destination Charge Added','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  echo 200;
}
else{
  echo $sqlAdd;

}


 ?>
