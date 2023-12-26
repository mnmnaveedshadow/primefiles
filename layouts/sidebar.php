<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
      <ul>
        <?php $pg_name = basename($_SERVER['PHP_SELF']); ?>

        <?php
            $dasboard_link ="website.php";
         ?>

         <li class="<?php if($pg_name=='index.php'){echo('active');} ?>" >
           <a href="index.php" ><img src="assets/img/icons/dashboard.svg" alt="img"><span> Dashboard</span> </a>
         </li>
         <?php
           if($u_level == 1 || $u_level == 3){
          ?>
         <li class="<?php if($pg_name=='quote_list.php'){echo('active');} ?>" >
           <a href="quote_list.php" ><img src="assets/img/icons/mail.svg" alt="img"><span> Quotation List</span> </a>
         </li>
       <?php } ?>
        <li class="<?php if($pg_name==$dasboard_link){echo('active');} ?>" >
          <a href="<?= $dasboard_link ?>" ><img src="assets/img/icons/Calculator.svg" alt="img"><span> Request a Quote</span> </a>
        </li>
        <?php
          if($u_level == 1 || $u_level == 2){
         ?>
        <li class="submenu">
          <a href="javascript:void(0);"><img src="assets/img/icons/flight.svg" alt="img"><span> Air Freight Data</span> <span class="menu-arrow"></span></a>
          <ul>
            <li><a class="<?php if($pg_name=='a_f_o_charge.php'){echo('active');} ?>" href="a_f_o_charge.php">Airfreight Origin Charges</a></li>
            <li><a class="<?php if($pg_name=='a_f_charge.php'){echo('active');} ?>" href="a_f_charge.php">Airfreight Charges</a></li>
            <li><a class="<?php if($pg_name=='a_f_d_charge.php'){echo('active');} ?>" href="a_f_d_charge.php">Airfreight Destination Charges</a></li>
            <li><a class="<?php if($pg_name=='air_lines.php'){echo('active');} ?>" href="air_lines.php">Airlines</a></li>
            <li><a class="<?php if($pg_name=='air_vendors.php'){echo('active');} ?>" href="air_vendors.php">Vendors</a></li>
          </ul>
        </li>
        <li class="submenu">
          <a href="javascript:void(0);"><img src="assets/img/icons/ship.svg" alt="img"><span> Sea Freight Data</span> <span class="menu-arrow"></span></a>
          <ul>
            <li><a class="<?php if($pg_name=='s_f_o_charge.php'){echo('active');} ?>" href="s_f_o_charge.php">Sea Freight Origin Charges</a></li>
            <li><a class="<?php if($pg_name=='s_f_charge.php'){echo('active');} ?>" href="s_f_charge.php">Sea Freight Charges</a></li>
            <li><a class="<?php if($pg_name=='s_f_d_charge.php'){echo('active');} ?>" href="s_f_d_charge.php">Sea Freight Destination Charges</a></li>
            <li><a class="<?php if($pg_name=='sea_vendors.php'){echo('active');} ?>" href="sea_vendors.php">Sea Vendors</a></li>
            <li><a class="<?php if($pg_name=='containers.php'){echo('active');} ?>" href="containers.php">Containers</a></li>
            <li><a class="<?php if($pg_name=='sea_carrier.php'){echo('active');} ?>" href="sea_carrier.php">Carrier</a></li>
          </ul>
        </li>
        <li class="submenu">
          <a href="javascript:void(0);"><img src="assets/img/icons/truck.svg" alt="img"><span> Land Freight Data</span> <span class="menu-arrow"></span></a>
          <ul>
            <li><a class="<?php if($pg_name=='l_f_o_charge.php'){echo('active');} ?>" href="l_f_o_charge.php">Land Freight Origin Charges</a></li>
            <li><a class="<?php if($pg_name=='l_f_charge.php'){echo('active');} ?>" href="l_f_charge.php">Land Freight Charges</a></li>
            <li><a class="<?php if($pg_name=='l_f_d_charge.php'){echo('active');} ?>" href="l_f_d_charge.php">Land Freight Destination Charges</a></li>
            <li><a class="<?php if($pg_name=='road_vendors.php'){echo('active');} ?>" href="road_vendors.php">Road Freight Vendors</a></li>
          </ul>
        </li>
        <li class="<?php if($pg_name=='warehousing_data.php'){echo('active');} ?>" >
          <a href="warehousing_data.php"><img src="assets/img/icons/warehouse.svg" alt="img"><span>Warehousing Data </span></a>
        </li>
        <?php
        }
         ?>
        <li class="<?php if($pg_name=='location.php'){echo('active');} ?>" >
          <a href="location.php"><img src="assets/img/icons/places.svg" alt="img"><span> Locations</span></a>
        </li>
        <?php
          if($u_level == 1){
         ?>
         <li class="<?php if($pg_name=='cargo_type.php'){echo('active');} ?>" >
           <a href="cargo_type.php" ><i class="fas fa-box-open" data-bs-toggle="tooltip" title=""></i><span> Cargo Types</span> </a>
         </li>
         <li class="<?php if($pg_name=='package_datas.php'){echo('active');} ?>" >
           <a href="package_datas.php" ><i class="fas fa-box-open" data-bs-toggle="tooltip" title=""></i><span> Package Datas</span> </a>
         </li>
         <li class="<?php if($pg_name=='terms_c.php'){echo('active');} ?>" >
           <a href="terms_c.php" ><i class="fa fa-file" data-bs-toggle="tooltip" title=""></i><span> Terms & Condition</span> </a>
         </li>
        <li class="<?php if($pg_name=='staff_managment.php'){echo('active');} ?>" >
          <a href="staff_managment.php" ><i class="fa fa-user" data-bs-toggle="tooltip" title=""></i><span> Staff Management</span> </a>
        </li>
        <li class="<?php if($pg_name=='activity_report.php'){echo('active');} ?>" >
          <a href="activity_report.php" ><i class="fa fa-user" data-bs-toggle="tooltip" title=""></i><span>Staff Activity Report</span> </a>
        </li>
      <?php } ?>

      </ul>
    </div>
  </div>
</div>
