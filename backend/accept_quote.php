<?php
include 'conn.php';

$qid = $_REQUEST['q_id'];

$sql ="UPDATE tbl_quote SET q_status='3' WHERE q_id='$qid'";
$rs = $conn->query($sql);

if($rs > 0){
  header('location:../accepted_quote.php?qid='.$qid);
  exit();
}
else {
  header('location:../accepted_quote.php?err';
  exit();
}
