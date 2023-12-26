<?php
include 'conn.php';

$service_type =$_REQUEST['service_type'];


$cus_id = $_SESSION['cus_id'];

$sqlAdd = "INSERT INTO tbl_quote (c_id,q_service,q_d_time) VALUES ('$cus_id','$service_type','$current_date_time')";
$rsAdd = $conn->query($sqlAdd);

$q_id = $conn->insert_id;

$sql = "SELECT * FROM `tbl_warehouse_cat`";
$rs = $conn->query($sql);
if($rs->num_rows >0){
  while($row = $rs->fetch_assoc()){
    $id  = $row['wc_id'];
    $wc_name = $row['wc_name'];

    $sql_data = "SELECT * FROM `tbl_warehouse_data` WHERE wc_id='$id'";
    $rs_data = $conn->query($sql_data);

    $sqlQdataC="INSERT INTO tbl_warehouse_cat_q (wc_name,q_id) VALUES ('$wc_name','$q_id')";
    $rsQDataC = $conn->query($sqlQdataC);

    $wq_id=$conn->insert_id;

    if($rs_data->num_rows > 0){
      while($row_data = $rs_data->fetch_assoc()){
        $wd_description = $row_data['wd_description'];
        $wd_uom = $row_data['wd_uom'];
        $wd_rate = $row_data['wd_rate'];
        $wd_remarks = $row_data['wd_remarks'];
        $wd_validity = $row_data['wd_validity'];

        $sqlAdd = "INSERT INTO tbl_warehouse_data_q
                    (wd_description,wd_uom,wd_rate,wd_remarks,wd_validity,wc_id,q_id) VALUES
                    ('$wd_description','$wd_uom','$wd_rate','$wd_remarks','$wd_validity','$wq_id','$q_id')";
        $rsAdd = $conn->query($sqlAdd);
      }
    }
  }
}

if(isset($_SESSION['mobile'])){
  header('location:../mobile_app_quote_requested.php');
  exit();
}


if($rsAdd > 0){
  header('location:../website_quote_requested.php');
}
else{
  header('location:../website_quote_requested.php');
}


 ?>
