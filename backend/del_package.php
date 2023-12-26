<?php
include 'conn.php';

$id = $_REQUEST['pack_id'];


  $sqlDeleteAd= "DELETE FROM tbl_package WHERE p_id ='$id'";
  $rsDelAd = $conn->query($sqlDeleteAd);
  if ($rsDelAd > 0) {
    echo 200;
    exit();
  }



 ?>
