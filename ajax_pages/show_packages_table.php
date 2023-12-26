<?php include '../backend/conn.php'; ?>
<div class="table-responsive">
  <table class="table">
    <thead>
        <tr>
            <th>Cargo Type</th>
            <th>Commodity Type</th>
            <th>Package Type</th>
            <th>Number Of Packages</th>
            <th>Length (Cm)</th>
            <th>Width (Cm)</th>
            <th>Height (Cm)</th>
            <th>Volume </th>
            <th>Total Volume </th>
            <th>Weight(Kg)</th>
            <th>Action</th>
          </tr>
    </thead>
    <tbody>
      <?php
      $cid = $_SESSION['cus_id'];
      $tot_vol = 0;
      $tot_weight = 0;
      $charge_weight = 0;
      $tot_qty = 0;
      $sql = "SELECT * FROM tbl_package WHERE c_id='$cid' AND st='0'";
      $rs = $conn->query($sql);

      if ($rs->num_rows > 0) {
          while ($row = $rs->fetch_assoc()) {
              $tot_qty += $row['p_qnty'];
              $vol = $row['p_l'] * $row['p_w'] * $row['p_h'] / 6000;
              $tot_vol_each = $vol * $row['p_qnty'];
              $tot_weight += $row['p_weight'];

              $tot_vol += customRound($tot_vol_each);
              $cId= $row['ct_id'];
              $ptId =$row['pt_id'];
              $ctid = $row['ctype_id'];
              ?>
              <tr>
                  <td> <?= getDataBack($conn,'tbl_cargo_type','ctype_id',$ctid,'ctype'); ?> </td>
                  <td> <?= $cId ?> </td>
                  <td> <?= getDataBack($conn,'tbl_package_type','pt_id',$ptId,'pt_name'); ?> </td>
                  <td><?= $row['p_qnty'] ?></td>
                  <td><?= customRound($row['p_l']) ?></td>
                  <td><?= customRound($row['p_w']) ?></td>
                  <td><?= customRound($row['p_h']) ?></td>
                  <td><?= customRound($vol) ?></td>
                  <td><?= customRound($tot_vol_each) ?></td>
                  <td><?= $row['p_weight'] ?></td>
                  <td><a onclick="del_p_desktop(<?= $row['p_id'] ?>)" class="btn btn-danger btn-sm"> X </a></td>
              </tr>
          <?php }
          $charge_weight = max($tot_weight, $tot_vol);
      } ?>
      <tr>
          <td colspan="3"> Total Volume </td>
          <td colspan="4"> <?= customRound($tot_vol) ?> </td>
      </tr>
      <tr>
          <td colspan="3"> Total Qty </td>
          <td colspan="4"> <?= $tot_qty ?> </td>
      </tr>
      <tr>
          <td colspan="3"> Total Weight </td>
          <td colspan="4"> <?= customRound($tot_weight) ?> </td>
      </tr>
      <tr>
          <td colspan="3"> Chargable Weight </td>
          <td colspan="4"> <?= customRound($charge_weight) ?> </td>
      </tr>

    </tbody>

  </table>
</div>
<br><br>
		<button type="button" name="button" class="btn btn-success" onclick="shippingSubmit(1,4)">Next</button>
<script type="text/javascript">
  document.getElementById('total_volume').value=<?= $tot_vol ?>;
  document.getElementById('qnty').value=<?= $tot_qty ?>;
  document.getElementById('weight').value=<?= $tot_weight ?>;
</script>
