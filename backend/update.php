<?php

include './conn.php';

$id=$_REQUEST['id'];
$ = mysqli_real_escape_string($conn, $_REQUEST['']);

$sql = "UPDATE tbl_expiry_date SET expiry_date='$expiry_date' WHERE id = '$id'";
$rs = $conn->query($sql);

if($rs > 0){
  header("location:");
  exit();
}else{
  header("location:");
  exit();
}
