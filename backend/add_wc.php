<?php
include 'conn.php';


$cName =$_REQUEST['cName'];

$normalized_name = strtolower(str_replace(' ', '', $cName));

             $sqlValidity = "SELECT * FROM tbl_package_type WHERE LOWER(REPLACE(wc_name, ' ', '')) = '$normalized_name'";
             $rsValidity = $conn->query($sqlValidity);
             
             if ($rsValidity->num_rows > 0) {
                 // Exact match found, do not add
                 echo 300;
                 exit();
             }

$sqlAdd = "INSERT INTO tbl_warehouse_cat (wc_name) VALUES ('$cName')";
$rsAdd = $conn->query($sqlAdd);



$uid=$_SESSION['uid'];
$sqlActivity = "INSERT INTO tbl_user_activity_report (u_id,data_feild,activity_datetime) VALUES('$uid','Added WareHouse Category','$current_date_time')";
$rsActivity = $conn->query($sqlActivity);

if($rsAdd > 0){
  echo 200;
}
else{
  echo 300;

}


 ?>
