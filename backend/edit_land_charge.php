<?php
include 'conn.php';

$ln_id = $_REQUEST['id'];

$lf_countries =$_REQUEST['lf_countries'];
$lf_city =$_REQUEST['lf_city'];
$lf_border_orgin =$_REQUEST['lf_border_orgin'];

$lf_countries_dest =$_REQUEST['lf_countries_dest'];
$lf_city_dest =$_REQUEST['lf_city_dest'];
$lf_border_desti =$_REQUEST['lf_border_desti'];

$lf_transit =$_REQUEST['lf_transit'];

$lf_min_weight =$_REQUEST['lf_min_weight'];
$lf_max_weight =$_REQUEST['lf_max_weight'];

$lf_desc =$_REQUEST['lf_desc'];
$lf_uom =$_REQUEST['lf_uom'];
$lf_aed =$_REQUEST['lf_aed'];

$lf_currency =$_REQUEST['lf_currency'];
$lf_vendor =$_REQUEST['lf_vendor'];
$lf_validity =$_REQUEST['lf_validity'];

$lf_min_cbm = $_REQUEST['lf_min_cbm'];
$lf_max_cbm = $_REQUEST['lf_max_cbm'];
$lf_toservice = $_REQUEST['lf_toservice'];

if($lf_countries == ""){
  $sqlAdd = "UPDATE tbl_land_charge SET
                            vn_id='$lf_vendor',
                            type_of_s='$lf_toservice',
                            lc_desc='$lf_desc',
                            currency='$lf_currency',
                            rate='$lf_aed',
                            min_weight='$lf_min_weight',
                            max_weight='$lf_max_weight',
                            min_cbm='$lf_min_cbm',
                            max_cbm='$lf_max_cbm',
                            oum='$lf_uom',
                            transit='$lf_transit',
                            validity='$lf_validity' WHERE lc_id ='$ln_id'";
}
else {
  $sqlAdd = "UPDATE tbl_land_charge SET
                            country_id='$lf_countries',
                            city_id='$lf_city',
                            border_id='$lf_border_orgin',
                            country_id_dest='$lf_countries_dest',
                            city_id_dest='$lf_city_dest',
                            border_id_dest='$lf_border_desti',
                            vn_id='$lf_vendor',
                            type_of_s='$lf_toservice',
                            lc_desc='$lf_desc',
                            currency='$lf_currency',
                            rate='$lf_aed',
                            min_weight='$lf_min_weight',
                            max_weight='$lf_max_weight',
                            min_cbm='$lf_min_cbm',
                            max_cbm='$lf_max_cbm',
                            oum='$lf_uom',
                            transit='$lf_transit',
                            validity='$lf_validity' WHERE lc_id ='$ln_id'";
}


$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Land Charge Added','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  echo 200;
}
else{
  echo 300;

}


 ?>
