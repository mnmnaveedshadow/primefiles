<?php
include 'conn.php';


$u_name =$_REQUEST['u_name'];
$u_email =$_REQUEST['u_email'];
$u_phoneNumber =$_REQUEST['u_phoneNumber'];
$u_companyName =$_REQUEST['u_companyName'];
$u_countries =$_REQUEST['u_countries'];
$u_city =$_REQUEST['u_city'];
$u_address =$_REQUEST['u_address'];

$sql="SELECT * FROM tbl_customer_info WHERE c_email='$u_email'";
$rs=$conn->query($sql);

if($rs->num_rows == 1){

  $cusid=getDataBack($conn,'tbl_customer_info','c_email',$u_email,'c_id');
  $sqlAdd = "UPDATE tbl_customer_info SET c_name='$u_name',
                                              c_company='$u_companyName',
                                              country_id='$u_countries',
                                              city_id='$u_city',
                                              c_address='$u_address',
                                              u_phone='$u_phoneNumber' WHERE  c_email='$u_email'";
                                              $rsAdd = $conn->query($sqlAdd);
                                              $_SESSION['cus_id'] =$cusid;
}
else {
  $sqlAdd = "INSERT INTO tbl_customer_info (c_name,c_company,country_id,city_id,c_address,u_phone,c_email)
            VALUES ('$u_name','$u_companyName','$u_countries','$u_city','$u_address','$u_phoneNumber','$u_email')";
            $rsAdd = $conn->query($sqlAdd);
            $_SESSION['cus_id'] = $conn->insert_id;
}

if($rsAdd > 0){
  echo 200;
}
else{
  echo 400;
}


 ?>
