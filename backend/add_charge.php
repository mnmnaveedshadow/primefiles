<?php
include 'conn.php';


$af_countries =$_REQUEST['af_countries'];
$af_city =$_REQUEST['af_city'];
$af_airport =$_REQUEST['af_airport'];
$af_countries_dest =$_REQUEST['af_countries_dest'];
$af_city_dest =$_REQUEST['af_city_dest'];
$af_airport_dest =$_REQUEST['af_airport_dest'];
$af_transit =$_REQUEST['af_transit'];
$af_airline =$_REQUEST['af_airline'];
$af_min_weight =$_REQUEST['af_min_weight'];
$af_max_weight =$_REQUEST['af_max_weight'];
$af_desc =$_REQUEST['af_desc'];
$af_uom =$_REQUEST['af_uom'];
$af_aed =$_REQUEST['af_aed'];
$af_currency =$_REQUEST['af_currency'];
$af_vendor =$_REQUEST['af_vendor'];
$af_validity =$_REQUEST['af_validity'];

$af_cargo_type = $_REQUEST['af_ctype'];

$af_ocharge = $_REQUEST['af_ocharge'];

$af_tr_days = $_REQUEST['af_tr_days'];

$sqlAdd = "INSERT INTO tbl_air_frieght (country_id,city_id,airport_id,country_id_dest,
                        city_id_dest,airport_id_dest,vn_id,al_id,ctype_id,af_description,af_min_weight,
                        af_max_weight,af_charge,af_currency,af_uom,af_validity,other_charge,transit_days)
            VALUES ('$af_countries','$af_city','$af_airport','$af_countries_dest',
                    '$af_city_dest','$af_airport_dest','$af_vendor','$af_airline','$af_cargo_type',
                    '$af_desc','$af_min_weight','$af_max_weight','$af_aed','$af_currency','$af_uom','$af_validity','$af_ocharge','$af_tr_days')";
$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Air Freight Charge Added','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  echo 200;
}
else{
  echo 300;

}


 ?>
