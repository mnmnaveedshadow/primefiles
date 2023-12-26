<?php

include './conn.php';

$id=$_REQUEST['id'];
$rv_name = mysqli_real_escape_string($conn, $_REQUEST['rv_name']);

$sql = "UPDATE tbl_road_vendors SET rv_name='$rv_name' WHERE rv_id = '$id'";
$rs = $conn->query($sql);

if($rs > 0){
  header("location:../road_vendors.php");
  exit();
}else{
  header("location:../road_vendors.php");
  exit();
}
