<?php

include './conn.php';

$id=$_REQUEST['id'];
$cont_name = mysqli_real_escape_string($conn, $_REQUEST['cont_name']);

$sql = "UPDATE tbl_container SET cr_name='$cont_name' WHERE cr_id = '$id'";
$rs = $conn->query($sql);

if($rs > 0){
  header("location:../containers.php");
  exit();
}else{
  header("location:../containers.php");
  exit();
}
