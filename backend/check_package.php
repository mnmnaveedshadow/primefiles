<?php
include 'conn.php';

if(!isset($_SESSION['cus_id'])){
  echo 700;
  exit();
}

$c_id =$_SESSION['cus_id'];

$sql_check_packages = "SELECT * FROM tbl_package WHERE st='0' AND c_id='$c_id'";
$rs_check_pack= $conn->query($sql_check_packages);
if($rs_check_pack->num_rows > 0){
    if(isset($_SESSION['bst'])){
        echo 1001;
    }else{
        echo 200;
    }

}
else {
  echo 500;
}
