<?php
include 'conn.php';



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


$sqlAdd = "INSERT INTO tbl_air_orgin_charge
           (country_id,city_id,airport_id,aoc_vendor,aoc_description,
             aoc_charge,aoc_currency,aoc_uom,aoc_min,aoc_validity)
            VALUES ('$aoc_countries','$aoc_city','$aoc_airport','$aoc_vendor',
              '$aoc_desc','$aoc_aed','$aoc_currency','$aoc_uom','$aoc_min_aed','$aoc_validity')";
$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Air Freight Origin Data Added','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  echo 200;
}
else{
  echo 300;

}


 ?>
