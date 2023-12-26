<?php
include 'conn.php';

$qid = $_REQUEST['qid'];
$con_id= $_REQUEST['con_id'];


$sql ="UPDATE tbl_quote SET sel_con='$con_id' WHERE q_id='$qid'";
$rs = $conn->query($sql);

if($rs > 0){
  header('location:../quote_breakdown_sea.php?q_id='.$qid);
  exit();
}
else {
  header('location:../quote_breakdown_sea.php?q_id='.$qid);
  exit();
}


 ?>
