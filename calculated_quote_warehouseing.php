<?php include 'backend/conn.php'; ?>

<?php

$qid = $_SESSION['qid'];

$sql_quote = "SELECT * FROM tbl_quote WHERE q_id='$qid'";
$rs_quote = $conn->query($sql_quote);

if($rs_quote->num_rows > 0){
	$row_q = $rs_quote->fetch_assoc();
}
else {
	header('location:index.php');
	exit();
}

$m_type = 1;

$q_validity = $row_q['q_validity'];
$q_profit = $row_q['q_profit'];

$q_cus = $row_q['c_id'];

$sql_customer="SELECT * FROM tbl_customer_info WHERE c_id='$q_cus'";
$rs_customer = $conn->query($sql_customer);

if($rs_customer->num_rows >0){
	$rowC = $rs_customer->fetch_assoc();

	$cName = $rowC['c_name'];
	$cCompany = $rowC['c_company'];
	$cCountry = $rowC['country_id'];
	$cAddress = $rowC['c_address'];
	$cPhone = $rowC['u_phone'];
	$cEmail = $rowC['c_email'];
}


$currency_text=0;
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Prime Logistics Quotation</title>

  </head>
  <body>

    <div class="container-fluid">
			<header >
				<table style="width:100%;">
					<tr>
						<td>
							<img src="https://skillheist.com/prime/logo/New-logo-Prime.png" style="width:200px;" alt="">
						</td>
						<td>
							<img src="https://skillheist.com/prime/logo/prime_ex.jpg" style="width:200px;float:right;" alt="">
						</td>
					</tr>
				</table>
			</header>




            <h1 class="text-center">Quotation</h1>
						<table style="width:100%;">
							<tr>
								<td>
									<p>Company:<?= $cCompany ?></p> <br>
									<p>Attn:<?= $cName ?></p>
									<p>Phone: <?= $cPhone ?></p>
									<p>Email: <?= $cEmail ?></p>
								</td>
								<td  style="float:right;">
									<p>Date: <?= date('Y-m-d') ?></p> <br>
												<p>Prime Logistics FZCO Warehouse <br> G09 PO Box 371961 <br> Dubai United Arab Emirates</p> <br>
												<p>Our Reference: <b>PL-I-<?= $qid ?> </b> </p> <br>
												<p>Telephone: +97104 299 0060</p> <br>
								</td>
							</tr>
						</table> <br>
						<table style="width:100%;">
							<tr>
								<td>
									Quotation Date: <?= date('Y-m-d') ?>
									<br><br>
								</td>
								<td style="float:right;">

																				Valid To: 2023-12-31
																				<br><br>
								</td>
							</tr>
						</table> <br>
						<br>
						<table style="border-collapse: collapse;width: 100%;">
							<thead>
								<tr>

									<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Description</th>
									<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">UOM</th>
									<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Rate (AED)</th>
									<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;">Remarks</th>
								</tr>
							</thead>
							<tbody>
						    <?php
						    $sql = "SELECT * FROM `tbl_warehouse_cat_q` WHERE q_id='$qid'";

						    $rs = $conn->query($sql);
						    if($rs->num_rows >0){
						      while($row = $rs->fetch_assoc()){
						        $id  = $row['wc_id']; ?>
						      <tr>
						        <td colspan="5" style="border: 1px solid #dddddd;text-align: left;padding: 8px;">
						          <span style="font-weight:bold;text-transform: capitalize;">
						            <?= $row['wc_name'] ?>
						          </span>
						        </td>
							 		</tr>

						        <?php
						          $sql_data = "SELECT * FROM `tbl_warehouse_data_q` WHERE wc_id='$id' AND q_id='$qid'";
						          $rs_data = $conn->query($sql_data);

						          if($rs_data->num_rows > 0){
						            while($row_data = $rs_data->fetch_assoc()){
													$d_id =$row_data['wd_id'];
						         ?>
						           <tr>
						            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> --<?= $row_data['wd_description'] ?> </td>
						            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row_data['wd_uom'] ?> </td>
						            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row_data['wd_rate'] ?> </td>
						            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> <?= $row_data['wd_remarks'] ?> </td>
 												</tr>
						      <?php } } ?>

						    <?php }} ?>

						  </tbody>

						</table>

            </div>
    </div><!-- End of container -->

    <script type="text/javascript">
      print();
    </script>
  </body>
</html>
