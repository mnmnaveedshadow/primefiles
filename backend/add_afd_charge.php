<?php
include 'conn.php';



$adc_countries =$_REQUEST['adc_countries'];
$adc_city =$_REQUEST['adc_city'];
$adc_airport =$_REQUEST['adc_airport'];
$adc_vendor =$_REQUEST['adc_vendor'];
$adc_desc =$_REQUEST['adc_desc'];
$adc_aed =$_REQUEST['adc_aed'];
$adc_currency =$_REQUEST['adc_currency'];
$adc_uom =$_REQUEST['adc_uom'];
$adc_min_aed =$_REQUEST['adc_min_aed'];
$adc_validity =$_REQUEST['adc_validity'];


$sqlAdd = "INSERT INTO tbl_air_dest_charge
           (country_id,city_id,airport_id,adc_vendor,adc_description,
             adc_charge,adc_currency,adc_uom,adc_min,adc_validity)
            VALUES ('$adc_countries','$adc_city','$adc_airport','$adc_vendor',
              '$adc_desc','$adc_aed','$adc_currency','$adc_uom','$adc_min_aed','$adc_validity')";
$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Air Freight Destination Data Added','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  echo 200;
}
else{
  echo 300;

}


 ?>
