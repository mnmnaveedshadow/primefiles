<?php
include 'conn.php';

$ad_id = $_REQUEST['a_id'];

$af_countries =$_REQUEST['af_countries'];
$af_city =$_REQUEST['af_city'];
$af_airport =$_REQUEST['af_airport'];

$af_countries_dest =$_REQUEST['af_countries_dest'];
$af_city_dest =$_REQUEST['af_city_dest'];
$af_airport_dest =$_REQUEST['af_airport_dest'];

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

if($af_countries == ""){
  $sqlAdd = "UPDATE tbl_air_frieght SET vn_id='$af_vendor',
                                        al_id='$af_airline',
                                        ctype_id='$af_cargo_type',
                                        af_description='$af_desc',
                                        af_min_weight='$af_min_weight',
                                        af_max_weight='$af_max_weight',
                                        af_charge='$af_aed',
                                        af_currency='$af_currency',
                                        af_uom='$af_uom',
                                        af_validity='$af_validity',
                                        other_charge='$af_ocharge',
                                        transit_days = '$af_tr_days'
                                         WHERE af_id ='$ad_id'";
}
else {
  $sqlAdd = "UPDATE tbl_air_frieght SET country_id='$af_countries',
                                        city_id='$af_city',
                                        airport_id='$af_airport',
                                        country_id_dest='$af_countries_dest',
                                        city_id_dest='$af_city_dest',
                                        airport_id_dest='$af_airport_dest',
                                        vn_id='$af_vendor',
                                        al_id='$af_airline',
                                        ctype_id='$af_cargo_type',
                                        af_description='$af_desc',
                                        af_min_weight='$af_min_weight',
                                        af_max_weight='$af_max_weight',
                                        af_charge='$af_aed',
                                        af_currency='$af_currency',
                                        af_uom='$af_uom',
                                        af_validity='$af_validity',
                                        other_charge='$af_ocharge',transit_days = '$af_tr_days'  WHERE af_id ='$ad_id'";
}

$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Air Freight Charge Edit','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  echo 200;
}
else{
  echo 300;

}


 ?>
