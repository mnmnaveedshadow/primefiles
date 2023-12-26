<?php

include './conn.php';

$id=$_REQUEST['id'];
$sv_name = mysqli_real_escape_string($conn, $_REQUEST['sv_name']);

$sql = "UPDATE tbl_sea_vendors SET sv_name='$sv_name' WHERE sv_id = '$id'";
$rs = $conn->query($sql);

if($rs > 0){
  header("location:../sea_vendors.php");
  exit();
}else{
  header("location:../sea_vendors.php");
  exit();
}
