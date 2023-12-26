<?php
include 'conn.php';

$adc_id=$_REQUEST['adc_id'];
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

if($adc_countries == ""){
  $sqlAdd = "UPDATE tbl_air_dest_charge SET adc_vendor='$adc_vendor',
                                            adc_description='$adc_desc',
                                            adc_charge='$adc_aed',
                                            adc_currency='$adc_currency',
                                            adc_uom='$adc_uom',
                                            adc_min='$adc_min_aed',
                                            adc_validity='$adc_validity' WHERE adc_id='$adc_id'";
}
else {
  $sqlAdd = "UPDATE tbl_air_dest_charge SET country_id='$adc_countries',
                                            city_id='$adc_city',
                                            airport_id='$adc_airport',
                                            adc_vendor='$adc_vendor',
                                            adc_description='$adc_desc',
                                            adc_charge='$adc_aed',
                                            adc_currency='$adc_currency',
                                            adc_uom='$adc_uom',
                                            adc_min='$adc_min_aed',
                                            adc_validity='$adc_validity' WHERE adc_id='$adc_id'";
}


$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Edited Air Frieght Destination Data','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  echo 200;
}
else{
  echo 300;

}


 ?>
