<?php include '../backend/conn.php'; ?>
  <div class="row">
      <?php
        $cid = $_SESSION['cus_id'];
        $tot_vol =0;
        $tot_weight =0;
        $charge_weight=0;
        $tot_qty=0;
        $sql = "SELECT * FROM tbl_package WHERE c_id='$cid' AND st='0' ORDER BY `tbl_package`.`p_id` DESC";
        $rs = $conn->query($sql);
        $i=1;
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
       <div class="col-12">
         <div class="card">
           <span style="padding:10px 10px 10px 10px;">#<?= $i ?></span>
           <div class="card-body">
              <div style="float:right;">
                <a onclick="del_p(<?= $row['p_id'] ?>)" class="btn btn-danger btn-sm"> X </a>
              </div>
             <hr>
            <span style="color:#22252a;font-weight:bold;">Packages:</span>  <?= $row['p_qnty'] ?>
             <hr>
             <span style="color:#22252a;font-weight:bold;">L x W x H :</span> <?= $row['p_l'] ?> x <?= $row['p_w'] ?> x <?= $row['p_h'] ?> Cm
             <hr>
             <span style="color:#22252a;font-weight:bold;">Volume:</span><?= round($vol,2) ?>cm³
             <hr>
             <span style="color:#22252a;font-weight:bold;">Weight:</span><?= $row['p_weight'] ?>
           </div>
         </div>
       </div>

     <?php $i++; } } ?>
     
            <div class="col-12">
         <div class="card">
           <div class="card-body">

            <span style="color:#22252a;font-weight:bold;">Total Volume:</span>  <?= round($tot_vol,2) ?>cm³
             <hr>
             <span style="color:#22252a;font-weight:bold;">Total Packages:</span> <?= $tot_qty ?>
             <hr>
             <span style="color:#22252a;font-weight:bold;">Total Weight:</span><?= $tot_weight ?> Kg
             <hr>
             <span style="color:#22252a;font-weight:bold;">Chargable Weight:</span><?= round($charge_weight,2) ?>
           </div>
         </div>
       </div>
     
   </div>


    </tbody>

  </table>
</div>
<br><br>
		<button type="button" name="button" class="btn btn-success" onclick="goToShipping()">Next</button>
