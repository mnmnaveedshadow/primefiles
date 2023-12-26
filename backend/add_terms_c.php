<?php
include 'conn.php';

$sid = $_REQUEST['service_type'];
$text= $_REQUEST['text'];

$sql = "SELECT * FROM tbl_tc WHERE service_type='$sid'";
$rs = $conn->query($sql);
if($rs->num_rows == 1){
  $sql ="UPDATE tbl_tc SET tc_text='$text' WHERE service_type='$sid'";
  $rs = $conn->query($sql);
}
else {
  $sql ="INSERT INTO tbl_tc (service_type,tc_text) VALUES ('$sid','$text')";
  $rs = $conn->query($sql);
}



if($rs > 0){
  header('location:../terms_c.php');
  exit();
}
else {
  header('location:../terms_c.php?eerr');
  exit();
}
