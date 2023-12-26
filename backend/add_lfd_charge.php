<?php
include 'conn.php';


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

$sqlAdd = "INSERT INTO tbl_road_destination_charge
           (country_id,city_id,border_id,v_id,rdc_tos,rdc_desc,
             rdc_charge,currency,uom,rdc_min,rdc_validity)
            VALUES ('$ldc_countries','$ldc_city','$ldc_border','$ldc_validity','$ldc_tos',
              '$ldc_desc','$ldc_aed','$ldc_currency','$ldc_uom','$ldc_min_aed','$ldc_validity')";
$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Land Destination Data Added','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  echo 200;
}
else{
  echo $sqlAdd;

}


 ?>
