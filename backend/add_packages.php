<?php
include 'conn.php';

if(!isset($_SESSION['cus_id'])){
  echo 700;
  exit();
}

$qty =$_REQUEST['qty'];
$leng =$_REQUEST['leng'];

$width =$_REQUEST['width'];
$height =$_REQUEST['height'];
$weight =$_REQUEST['weight'];

$pack_type = $_REQUEST['pack_type'];
$commo_type = $_REQUEST['commo_type'];
$cargo_type = $_REQUEST['cargo_type'];

$p_volume = $width * $height * $weight / 5000 ;
$c_id =$_SESSION['cus_id'];


$sqlAdd = "INSERT INTO tbl_package
            (p_qnty,p_l,p_w,p_h,p_volume,p_weight,c_id,pt_id,ct_id,ctype_id) VALUES
            ('$qty','$leng',
              '$width','$height',
              '$p_volume','$weight',
              '$c_id','$pack_type','$commo_type','$cargo_type')";
$rsAdd = $conn->query($sqlAdd);


if($rsAdd > 0){
  echo 200;
}
else{
  echo 300;

}


 ?>
