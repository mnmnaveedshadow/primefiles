<?php
include 'conn.php';

$id = $_REQUEST['id'];
$sf_countries =$_REQUEST['sf_countries'];
$sf_city =$_REQUEST['sf_city'];
$sf_orgin_seaport =$_REQUEST['sf_orgin_seaport'];

$sf_countries_dest =$_REQUEST['sf_countries_dest'];
$sf_city_dest =$_REQUEST['sf_city_dest'];
$sf_destination_seaport =$_REQUEST['sf_destination_seaport'];

$sf_transit =$_REQUEST['sf_transit'];

$sf_min_weight =$_REQUEST['sf_min_weight'];
$sf_max_weight =$_REQUEST['sf_max_weight'];

$sf_desc =$_REQUEST['sf_desc'];

$sf_uom =$_REQUEST['sf_uom'];
$sf_aed =$_REQUEST['sf_aed'];

$sf_currency =$_REQUEST['sf_currency'];
$sf_vendor =$_REQUEST['sf_vendor'];
$sf_validity =$_REQUEST['sf_validity'];

$sf_min_cbm = $_REQUEST['sf_min_cbm'];
$sf_max_cbm = $_REQUEST['sf_max_cbm'];

$sf_toservice = $_REQUEST['sf_toservice'];
$sf_tocontainer = $_REQUEST['sf_tocontainer'];

$sf_carrier = $_REQUEST['sf_carrier'];
$sf_tr_days = $_REQUEST['sf_tr_days'];
$sf_cargoType = $_REQUEST['sf_cargoType'];


if($sf_countries !=""){
  $sqlAdd = "UPDATE tbl_sea_charges
                            SET country_id='$sf_countries',
                                city_id='$sf_city',
                                seaport_id='$sf_orgin_seaport',
                                country_id_dest='$sf_countries_dest',
                                city_id_dest='$sf_city_dest',
                                seaport_id_dest='$sf_destination_seaport',
                                vn_id='$sf_vendor',
                                sc_tos='$sf_toservice',
                                sc_toc='$sf_tocontainer',
                                sc_desc='$sf_desc',
                                sc_min_weight='$sf_min_weight',
                                sc_max_weight='$sf_max_weight',
                                sc_min_cbm='$sf_min_cbm',
                                sc_max_cbm='$sf_max_cbm',
                                sc_charge_amount='$sf_aed',
                                sc_currency='$sf_currency',
                                sc_uom='$sf_uom',
                                sc_transit_days='$sf_tr_days',
                                cargo_type='$sf_cargoType',
                                sc_validity='$sf_validity',
                                sc_cr_id='$sf_carrier' WHERE sc_id='$id'";
}
else {
  $sqlAdd = "UPDATE tbl_sea_charges
                            SET vn_id='$sf_vendor',
                                sc_tos='$sf_toservice',
                                sc_toc='$sf_tocontainer',
                                sc_desc='$sf_desc',
                                sc_min_weight='$sf_min_weight',
                                sc_max_weight='$sf_max_weight',
                                sc_min_cbm='$sf_min_cbm',
                                sc_max_cbm='$sf_max_cbm',
                                sc_charge_amount='$sf_aed',
                                sc_currency='$sf_currency',
                                sc_uom='$sf_uom',
                                sc_transit_days='$sf_tr_days',
                                cargo_type='$sf_cargoType',
                                sc_validity='$sf_validity',
                                sc_cr_id='$sf_carrier' WHERE sc_id='$id'";
}

$rsAdd = $conn->query($sqlAdd);

$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Sea Charge Data Edited','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  echo 200;
}
else{
  echo 300;

}


 ?>
