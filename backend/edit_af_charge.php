<?php
include 'conn.php';

$aoc_id=$_REQUEST['aoc_id'];
$aoc_countries =$_REQUEST['aoc_countries'];
$aoc_city =$_REQUEST['aoc_city'];
$aoc_airport =$_REQUEST['aoc_airport'];
$aoc_vendor =$_REQUEST['aoc_vendor'];
$aoc_desc =$_REQUEST['aoc_desc'];
$aoc_aed =$_REQUEST['aoc_aed'];
$aoc_currency =$_REQUEST['aoc_currency'];
$aoc_uom =$_REQUEST['aoc_uom'];
$aoc_min_aed =$_REQUEST['aoc_min_aed'];
$aoc_validity =$_REQUEST['aoc_validity'];

if($aoc_countries == ""){
  $sqlAdd = "UPDATE tbl_air_orgin_charge SET aoc_vendor='$aoc_vendor',
                                            aoc_description='$aoc_desc',
                                            aoc_charge='$aoc_aed',
                                            aoc_currency='$aoc_currency',
                                            aoc_uom='$aoc_uom',
                                            aoc_min='$aoc_min_aed',
                                            aoc_validity='$aoc_validity' WHERE aoc_id='$aoc_id'";
}
else {
  $sqlAdd = "UPDATE tbl_air_orgin_charge SET country_id='$aoc_countries',
                                            city_id='$aoc_city',
                                            airport_id='$aoc_airport',
                                            aoc_vendor='$aoc_vendor',
                                            aoc_description='$aoc_desc',
                                            aoc_charge='$aoc_aed',
                                            aoc_currency='$aoc_currency',
                                            aoc_uom='$aoc_uom',
                                            aoc_min='$aoc_min_aed',
                                            aoc_validity='$aoc_validity' WHERE aoc_id='$aoc_id'";
}

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Edited Air Frieght Data','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

$rsAdd = $conn->query($sqlAdd);

if($rsAdd > 0){
  echo 200;
}
else{
  echo 300;

}


 ?>
