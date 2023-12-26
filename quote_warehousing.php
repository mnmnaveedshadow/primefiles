<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Prime Logistics Quotation</title>

    <link rel="stylesheet" href="css/quote_master.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script type="text/javascript">
      alert('System Identified Master Cost Sheet Data and Calculation Logic MisMatch');
    </script>

  </head>
  <body>
    <div class="container-fluid">
        <img src="logo/New-logo-Prime.png" style="width:200px;" alt="">

            <h1 class="text-center">Quotation</h1>
            <div class="row">
              <div class="col-12">
                <p style="float:right;">Prime Logistics FZCO Warehouse <br> G09 PO Box 371961 <br> Dubai United Arab Emirates</p>
              </div>
              <div class="col-6">
                <?php
                  $company = "Mancode Pvt Ltd <br> Sri lanka <br> Kandy";
                  $customerName = "Mohamed Naveed";
                 ?>
                <p><?= $company ?></p> <br>
                <p>Attn:<?= $customerName ?></p>

              </div>
              <div class="col-6" style="float:right;">
                <p>Date: Sep 01</p>
                <p>Our Reference: <b>PL-I-001</b> </p>
                <p>Telephone: +31(0)20-6533322</p>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                Quotation Date: <?= date('Y-m-d') ?>
                <hr>
                Origin:DXB<br>
                Quantity: 10 <br>
                Chargeable Weight:3072 kg
              </div>
              <div class="col-6">
                Valid To: 2023-12-31
                <hr>
                Origin:RUH <br>
                Weight: 1000Kg <br>
                Volume: 3072.00 m³
              </div>
              <div class="col-12">
                <hr>
                <div class="text-center">
                  Door To Door
                </div>
                <hr>
              </div>
              <div class="col-12">
                <table class="table">
    <thead>
      <tr>
        <th>Qty</th>
        <th>Dimensions</th>
        <th>Weight</th>
        <th>Volume</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>5</td>
        <td>120 x 80 x 160 cm </td>
        <td>100 kg</td>
        <td>307.2 m³</td>
      </tr>
    </tbody>
  </table>
  <hr>
  <div class="row">
    <div class="col-12">
      Product : Genrel Cargo ||
      Supplier: Saudi Airlines
      <hr>
    </div>
    <div class="col-6">
      Air Freight Charges:<br>
      Origin Charges: <br>
      Destination Charge:
      <hr>
      Total:
    </div>
    <div class="col-6">
      <b>95.50 AED</b> <br>
      <b>756 AED</b> <br>
      <b>66 AED</b> <br>
      <hr>
      <b>917.5 AED</b>

    </div>
  </div>
              </div>
            </div>
    </div><!-- End of container -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
