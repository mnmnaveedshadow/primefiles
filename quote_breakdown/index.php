<?php include '../backend/conn.php'; ?>
<?php

$qid = $_REQUEST['q_id'];

$sql_quote = "SELECT * FROM tbl_quote WHERE q_id='$qid'";
$rs_quote = $conn->query($sql_quote);

if($rs_quote->num_rows > 0){
	$row_q = $rs_quote->fetch_assoc();
}
else {
	header('location:../index.php');
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

$sql_c_odm = "SELECT * FROM tbl_customer_odm WHERE q_id='$qid'";
$rs_c_odm = $conn->query($sql_c_odm);
if($rs_c_odm->num_rows > 0){
	$row_codm = $rs_c_odm->fetch_assoc();
}

$m_type = $row_codm['odm_mtype'];

$odm_orgin_country = $row_codm['odm_orgin_country'];
$odm_orgin_city = $row_codm['odm_orgin_city'];
$odm_orgin_a_s_b = $row_codm['odm_orgin_a_s_b'];

$odm_desti_country = $row_codm['odm_desti_country'];
$odm_desti_city = $row_codm['odm_desti_city'];
$odm_desti_a_s_b = $row_codm['odm_desti_a_s_b'];
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Document</title>
  </head>
  <body class="m-5">
    <div class="d-flex justify-content-between">
      <div>
        <img src="./New-logo-Prime.png" alt="logo" width="150px" />
      </div>
      <div><img src="./prime_ex.jpg" alt="logo" width="150px" /></div>
    </div>

    <header class="d-flex justify-content-center my-4">
      <h1 class="title text-primary fw-bold">PRIME LOGISTICS QUOTATION</h1>
    </header>

    <div class="d-flex justify-content-between">
      <div class="d-flex flex-column">
        <table>
          <tr>
            <td>Company </td>
            <td>: Mancode</td>
          </tr>
          <tr>
            <td>Attn </td>
            <td>: Mohamed Naveed</td>
          </tr>
          <tr>
            <td>Quotation Date </td>
            <td>: 2023-11-24</td>
          </tr>
        </table>
      </div>
      <div class="d-flex flex-column">
        <table>
          <tr>
            <td>Date </td>
            <td>: 2023-11-24</td>
          </tr>
          <tr>
            <td>Our Reference </td>
            <td>: PL-I-31</td>
          </tr>
          <tr>
            <td>Telephone </td>
            <td>: +31(0)20-6533322</td>
          </tr>
          <tr>
            <td>Valid To </td>
            <td>: 2023-12-31</td>
          </tr>
        </table>
      </div>
    </div>

    <div class="d-flex flex-column mb-4 w-25">
      <table>
        <tr>
          <td>Origin </td>
          <td>: DXB</td>
        </tr>
        <tr>
          <td>Destination </td>
          <td>: RUH</td>
        </tr>
        <tr>
          <td>Product </td>
          <td>: General Cargo</td>
        </tr>
      </table>
      <div>Door to door</div>
    </div>

    <div class="mb-5 shadow"   style="height:450px;">
      <table class="table">
        <thead>
            <tr>

                <th class="bg-primary text-light">No of packages</th>
                <th class="bg-primary text-light">Length (CM) </th>
                <th class="bg-primary text-light">Width (CM)</th>
                <th class="bg-primary text-light">Height (CM)</th>
                <th class="bg-primary text-light">Volume </th>
                <th class="bg-primary text-light">Weight (Kg)</th>
              </tr>
        </thead>
        <tbody>
          <?php
            $tot_vol =0;
            $tot_weight =0;
            $charge_weight=0;
            $tot_qty=0;
            $sql = "SELECT * FROM tbl_package WHERE c_id='$q_cus'";
            $rs = $conn->query($sql);

            if($rs->num_rows > 0){
              while($row = $rs->fetch_assoc()){
                $tot_qty +=$row['p_qnty'];
                $vol = $row['p_l'] * $row['p_w'] * $row['p_h'] / 6000;
                $tot_weight +=$row['p_weight'] * $row['p_qnty'];


                $tot_vol +=$vol;

                if($tot_weight > $tot_vol){
                  $charge_weight = $tot_weight;
                }
                else {
                  $charge_weight = $tot_vol;
                }



           ?>
           <tr>
             <td> <?= $row['p_qnty'] ?>  </td>
             <td> <?= $row['p_l'] ?>  </td>
             <td> <?= $row['p_w'] ?>  </td>
             <td> <?= $row['p_h'] ?>  </td>
             <td> <?= round($vol,2) ?>  </td>
             <td> <?= $row['p_weight'] ?>  </td>
           </tr>
         <?php } } ?>


        </tbody>

      </table>

      <div class="d-flex justify-content-end">
        <table class="table w-25">
          <tbody class="fw-bold">
            <tr class="table-border-color">
              <td>Total Volume</td>
              <td><?= round($tot_vol,2) ?></td>
            </tr>
            <tr class="table-border-color">
              <td>Total QTY</td>
              <td><?= $tot_qty ?></td>
            </tr>
            <tr class="table-border-color">
              <td>Total Weight</td>
              <td><?= $tot_weight ?></td>
            </tr>
            <tr class="table-border-color">
              <td>Chargeable Weight</td>
              <td><?= round($charge_weight,2) ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <?php $charge_weight =round($charge_weight,2); ?>
    <div class="row">

      <h2>Quote Break Down  </h2>
      <hr>

      <?php
      $sql_data = "SELECT * FROM tbl_air_frieght WHERE
                    country_id='$odm_orgin_country' AND city_id='$odm_orgin_city' AND airport_id='$odm_orgin_a_s_b' AND
                    country_id_dest='$odm_desti_country' AND city_id_dest='$odm_desti_city' AND airport_id_dest='$odm_desti_a_s_b' AND af_min_weight <= $charge_weight AND af_max_weight >= $charge_weight AND other_charge='0'";
      $rs_data=$conn->query($sql_data);
      if($rs_data->num_rows == 0){
       ?>
       <h3>Air Frieght Data not found for this quote</h3>
     <?php }else{ ?>

       <?php
                   $tot_air_charge =0;
       $sqlAirline = "SELECT * FROM tbl_airlines";
       $rsAirline = $conn->query($sqlAirline);
       if($rsAirline->num_rows > 0){
         while($rowAir = $rsAirline->fetch_assoc()){
         $aid = $rowAir['al_id'];
         $sql_data_check = "SELECT * FROM tbl_air_frieght WHERE al_id='$aid' AND
                       country_id='$odm_orgin_country' AND city_id='$odm_orgin_city' AND airport_id='$odm_orgin_a_s_b' AND
                       country_id_dest='$odm_desti_country' AND city_id_dest='$odm_desti_city' AND airport_id_dest='$odm_desti_a_s_b' AND af_min_weight <= $charge_weight AND af_max_weight >= $charge_weight";
         $rs_data_check = $conn->query($sql_data_check);
         if($rs_data_check->num_rows > 0){
        ?>
        <br>
       <h4>Air Frieght Charges - <?= $rowAir['air_line_name'] ?></h4>
       <br>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Vendor</th>
              <th>Airline</th>
              <th>Description</th>
              <th>Charge amount</th>
              <th>Total Amount</th>
              <th>Currency</th>
              <th>UOM</th>
              <th>Validity</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $sql_data = "SELECT * FROM tbl_air_frieght WHERE al_id='$aid' AND
                          country_id='$odm_orgin_country' AND city_id='$odm_orgin_city' AND airport_id='$odm_orgin_a_s_b' AND
                          country_id_dest='$odm_desti_country' AND city_id_dest='$odm_desti_city' AND airport_id_dest='$odm_desti_a_s_b' AND af_min_weight <= $charge_weight AND af_max_weight >= $charge_weight";
            $rs_data = $conn->query($sql_data);

            if($rs_data->num_rows > 0){
              while($row_data= $rs_data->fetch_assoc()){
                $id=$row_data['af_id'];

                $country_id = $row_data['country_id'];
                $city_id = $row_data['city_id'];
                $airport_id = $row_data['airport_id'];

                $country_dest_id = $row_data['country_id_dest'];
                $city_dest_id = $row_data['city_id_dest'];
                $airport_dest_id = $row_data['airport_id_dest'];

                $uom = $row_data['af_uom'];
                $currency = $row_data['af_currency'];
                $v_id=$row_data['vn_id'];
                $a_id=$row_data['al_id'];

                $perc = $row_data['af_charge'] * $q_profit / 100;
                $calAirTot =$row_data['af_charge'] + $perc;
            ?>
            <tr>

              <td><?= getDataBack($conn,'tbl_air_vendor','av_id',$v_id,'av_name'); ?></td>
              <td><?= getDataBack($conn,'tbl_airlines','al_id',$a_id,'air_line_name'); ?></td>
              <td> <?= $row_data['af_description'] ?> </td>
              <?php if($row_data['other_charge'] == 1){ ?>
                <td> <?= $row_data['af_charge'] ?> * <?= $tot_qty ?> </td>
                <td> <?= $row_data['af_charge'] * $tot_qty ?></td>
              <?php }else{ ?>
                  <?php if($row_data['af_min_weight'] == 0){ ?>
              <td> <?= $row_data['af_charge'] + $perc ?> </td>
              <td> <?= $calAirTot ?>  </td>
              <?php $tot_air_charge +=$calAirTot; ?>
              <?php }else{ ?>
                  <td> <?= $row_data['af_charge'] + $perc ?> * <?= $charge_weight ?> </td>
              <td> <?= $calAirTot * $charge_weight ?>  </td>
              <?php $tot_air_charge +=$calAirTot * $charge_weight; ?>
                  <?php }?>
            <?php } ?>
              <td><?= getCurrency($currency) ?></td>
              <td><?= getUom($uom) ?></td>
              <td> <?= $row_data['af_validity'] ?> </td>
            </tr>
            <?php
          } ?>
          <tr>
            <td colspan="10"> Total Charge <?= $tot_air_charge ?> AED </td>
          </tr>
        <?php }
             ?>
          </tbody>
        </table>
      </div>
    <?php } } ?>
    <?php } } ?>
       <br>
      <hr>
      <br> <br>  <br> <br>
      <div class="row">
        <?php if($m_type == 1 || $m_type == 2){ ?>
        <div class="col-12">
          <h4>Orgin Charges</h4>
          <table class="table">
            <thead>
              <tr>
                  <th>Country</th>
                  <th>City</th>
                  <th>Airport</th>
                  <th>Vendor</th>
                  <th>Description</th>
                  <th>Charge</th>
                  <th>Total Charge</th>
                  <th>Currency</th>
                  <th>UOM</th>
                  <th>Minimum</th>
                  <th>VALIDITY</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM `tbl_air_orgin_charge` WHERE country_id='$odm_orgin_country' AND city_id='$odm_orgin_city' AND airport_id='$odm_orgin_a_s_b'";

              $rs = $conn->query($sql);
              if($rs->num_rows >0){

                $tot_orgin_charge= 0;
                while($row = $rs->fetch_assoc()){
                  $id  = $row['aoc_id'];
                  $country_id = $row['country_id'];
                  $city_id = $row['city_id'];
                  $airport_id = $row['airport_id'];

                  $uom = $row['aoc_uom'];
                  $currency = $row['aoc_currency'];
                  $v_id=$row['aoc_vendor'];
                   ?>
                <tr>

                  <td><?= getDataBack($conn,'countries','country_id',$country_id,'name'); ?></td>
                  <td><?= getDataBack($conn,'cities','city_id',$city_id,'name'); ?></td>
                  <td><?= getDataBack($conn,'airports','airport_id',$airport_id,'code'); ?></td>
                  <td><?= getDataBack($conn,'tbl_air_vendor','av_id',$v_id,'av_name'); ?></td>
                  <td><?= $row['aoc_description'] ?></td>
                  <?php
                  $qnt_m=0;
                    if($uom == 3){
                      $qnt_m = $tot_qty;
                    }
                    elseif ($uom == 2) {
                      $qnt_m = $charge_weight;
                    }
                   ?>

                  <?php if($uom == 1){ ?>
                  <td><?= $row['aoc_charge'] ?></td>
                  <td><?= $row['aoc_charge'] ?></td>
                <?php $tot_orgin_charge +=$row['aoc_charge']; }else{ ?>
                  <td><?= $row['aoc_charge'] ?> * <?= $qnt_m ?></td>
                  <td><?= $row['aoc_charge'] * $qnt_m ?></td>
                <?php $tot_orgin_charge +=$row['aoc_charge'] * $qnt_m; } ?>
                  <td><?= getCurrency($currency) ?></td>
                  <td><?= getUom($uom) ?></td>
                  <td><?= $row['aoc_min'] ?></td>
                  <td><?= $row['aoc_validity'] ?></td>

                </tr>
              <?php } ?>

              <tr>
                <td colspan="5"> Total Charge <?= $tot_orgin_charge ?> AED </td>
              </tr>
            <?php }else{ ?>
              <tr>
                <td colspan="5"> No Data Found</td>
              </tr>
            <?php } ?>
            </tbody>

          </table>
          <br><br>
        </div>
      <?php }  ?>
      <?php if($m_type == 1 || $m_type == 4){ ?>
        <br><br><br>  <br><br><br><br><br><br><br><br><br>
        <div class="col-12">

          <h4>Destination Charges</h4>
          <table class="table">
            <thead>
              <tr>
                  <th>Country</th>
                  <th>City</th>
                  <th>Airport</th>
                  <th>Vendor</th>
                  <th>Description</th>
                  <th>Charge</th>
                  <th>Total Charge</th>
                  <th>Currency</th>
                  <th>UOM</th>
                  <th>Minimum</th>
                  <th>VALIDITY</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $tot_desti_charge = 0;
              $sql = "SELECT * FROM `tbl_air_dest_charge` WHERE country_id='$odm_desti_country' AND city_id='$odm_desti_city' AND airport_id='$odm_desti_a_s_b'";

              $rs = $conn->query($sql);
              if($rs->num_rows >0){
                while($row = $rs->fetch_assoc()){
                  $id  = $row['adc_id'];
                  $country_id = $row['country_id'];
                  $city_id = $row['city_id'];
                  $airport_id = $row['airport_id'];

                  $uom = $row['adc_uom'];
                  $currency = $row['adc_currency'];
                  $v_id=$row['adc_vendor'];

                   ?>
                <tr>

                  <td><?= getDataBack($conn,'countries','country_id',$country_id,'name'); ?></td>
                  <td><?= getDataBack($conn,'cities','city_id',$city_id,'name'); ?></td>
                  <td><?= getDataBack($conn,'airports','airport_id',$airport_id,'code'); ?></td>
                  <td><?= getDataBack($conn,'tbl_air_vendor','av_id',$v_id,'av_name'); ?></td>
                  <td><?= $row['adc_description'] ?></td>
                  <?php
                  $qnt_m=0;
                    if($uom == 3){
                      $qnt_m = $tot_qty;
                    }
                    elseif ($uom == 2) {
                      $qnt_m = $charge_weight;
                    }
                   ?>
                   <?php if($uom == 1){ ?>
                   <td><?= $row['adc_charge'] ?></td>
                   <td><?= $row['adc_charge'] ?></td>
                 <?php $tot_desti_charge +=$row['adc_charge']; }else{ ?>
                   <td><?= $row['adc_charge'] ?> * <?= $qnt_m ?></td>
                   <td><?= $row['adc_charge'] * $qnt_m ?></td>
                 <?php $tot_desti_charge +=$row['adc_charge'] * $qnt_m; } ?>
                  <td><?= getCurrency($currency) ?></td>
                  <td><?= getUom($uom) ?></td>
                  <td><?= $row['adc_min'] ?></td>
                  <td><?= $row['adc_validity'] ?></td>

                </tr>
              <?php  } ?>

                <tr>
                  <td colspan="5"> Total Charge <?= $tot_desti_charge ?> SAR </td>
                </tr>
            <?php }else{ ?>
              <tr>
                <td colspan="5">No Data Found</td>
              </tr>
            <?php } ?>
            </tbody>

          </table>
        </div>
      <?php }  ?>
      <br>

        <?php
          $sql_other_charge = "SELECT * FROM tbl_other_charges WHERE q_id='$qid'";
          $rs_other_charge = $conn->query($sql_other_charge);
          if($rs_other_charge->num_rows > 0){
         ?>
      <div class="col-12">
        <br><br>
        <h4>Other Charges</h4>
        <table class="table">
          <thead>
            <tr>
                <th>Description</th>
                <th>Charge</th>
                <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while($rowO = $rs_other_charge->fetch_assoc()){
             ?>
             <tr>
              <td><?= $rowO['oc_charge_name'] ?></td>
              <td><?= $rowO['oc_charge'] ?></td>
              <td> <a href="backend/del_other_charge.php?id=<?= $rowO['oc_id'] ?>&qid=<?= $qid ?>" class="btn btn-danger btn-sm">Remove</a> </td>
             </tr>
           <?php } ?>
          </tbody>
        </table>
      </div>
    <?php } ?>
      </div>
    <hr>
    <br><br>
        <h3>Terms and Condition by Air Freight</h3>
        <hr>
        <p>*Rate valid for stackable and for general cargo only. <br>
    *Subject for space availability upon booking confirmation<br>
    *Shipper and consignee should provide all required document and any certificate require in
    origin and destination for export and clearance under their own license.<br>
    *Shipment should be suitable packed by air cargo unless packing charge will apply.<br>
    *Final chargeable weight will be based on the final AWB upon receiving the shipment in our
    warehouse, whichever is higher from actual weight and dimension with calculation of L x W x H /
    6000.<br>
    *Its shipper and consignee responsibility to load and unload the shipment at Origin and Final
    Destination, unless request.<br>
    *Rate valid for 7 days or upon prior notice.<br>
    *Other charges not mentioned above will be at cost if require, like shipping insurance, etc.
    For any airline and to any destination: space is limited, timely booking is needed <br></p>

      </div>

    <hr />

    <footer class="d-flex justify-content-center mt-4">
      <div class="text-dark-emphasis">Thank You!</div>
    </footer>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script src="index.js"></script>
  </body>
</html>
