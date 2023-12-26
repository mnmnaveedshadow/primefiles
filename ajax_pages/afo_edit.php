<?php include '../backend/conn.php'; ?>

<?php
  $aoc_id =$_REQUEST['aoc_id'];
 $sql = "SELECT * FROM `tbl_air_orgin_charge` WHERE aoc_id='$aoc_id'";

 $rs = $conn->query($sql);
 if($rs->num_rows >0){
   $row = $rs->fetch_assoc();

     $id  = $row['aoc_id'];
     $country_id = $row['country_id'];
     $city_id = $row['city_id'];
     $airport_id = $row['airport_id'];
     $uom = $row['aoc_uom'];


}
}
  ?>

<div class="form-group">
    <label for="">Description</label>
    <input type="text" class="form-control" id="desc" placeholder="Description" name="description" value="<?=   $row['aoc_vendor'] ?>" required>
</div>
<div class="form-group">
    <label for="">UOM (Unit of Measure)</label>
    <select class="form-control" name="" id="uom">
      <option value="1">Per Shipment</option>
      <option value="2">Per Kg</option>
      <option value="3">Per Label</option>
    </select>
</div>
<div class="form-group">
    <label for="">Vendor</label>
    <select class="form-control" name="" id="vendor">
      <option value="1">DNATA</option>
    </select>
</div>
<div class="form-group">
    <label for="">Currency</label>
    <select class="form-control" name="" id="currency">
      <option value="1">AED</option>
      <option value="2">USD</option>
      <option value="3">SAR</option>
    </select>
</div>
<div class="form-group">
    <label for="">Aed</label>
    <input type="number" class="form-control"  id="aed" placeholder="Aed" name="aed" value="<?=   $row['aoc_charge'] ?>" required>
</div>
<div class="form-group">
    <label for="">Min Aed</label>
    <input type="number" class="form-control" id="min_aed" placeholder="Min Aed" name="min_aed" value="<?=   $row['aoc_min'] ?>" required>
</div>
<div class="form-group">
    <label for="">VALIDITY</label>
    <input type="date" class="form-control" id="validity" placeholder="VALIDITY" name="validity" value="<?=   $row['aoc_validity'] ?>" required>
</div>
<button type="button" class="btn btn-primary btn-me2" onclick="editAoc()" name="button">Edit</button>
<br><br>
