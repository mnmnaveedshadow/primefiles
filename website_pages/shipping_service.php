<?php
    session_start();
    if(isset($_REQUEST['bst'])){
        if(!isset($_SESSION['bst'])){
            $_SESSION['bst'] = true;
        }
    }
    else{
        if(isset($_SESSION['bst'])){
             unset($_SESSION['bst']);
        }
    }
?>
<div id="shipping_services">
    <img src="assets/img/icons/return1.svg" style="width:30px;cursor:pointer;" onclick="goBack(2)" alt="asd">
    <div class="row">
      <div class="col-4">
        <br><br>
        <div class="shipping-main-option" onclick="selectShipping(1)">
          <img src="service_images/air.png" style="width:100%;" alt="">
        </div>
      </div>
      <div class="col-4">
          <br><br>
          <div class="shipping-main-option" onclick="selectShipping(2)">
            <img src="service_images/ship.png" style="width:100%;" alt="">
          </div>
        </div>
      <div class="col-4">
        <br><br>
        <div class="shipping-main-option" onclick="selectShipping(3)">
          <img src="service_images/land.png" style="width:100%;" alt="">
        </div>
      </div>
    </div>
    <br>
</div>
