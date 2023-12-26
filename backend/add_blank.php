<?php
include 'conn.php';


$name =$_REQUEST['name'];


$sqlAdd = "INSERT INTO tbl_brand (name,image) VALUES ('$name','$image')";
$rsAdd = $conn->query($sqlAdd);


if($rsAdd > 0){
  echo 200;
}
else{
  echo 300;

}


 ?>
