<div class="template-page-wrapper">
    <!--left menu-->
    <div class="navbar-collapse collapse templatemo-sidebar">
        <ul class="templatemo-sidebar-menu">
          <li>
            <form class="navbar-form">
              <input type="text" class="form-control" id="templatemo_search_box" placeholder="Tìm kiếm...">
              <span class="btn btn-default">Tìm</span>
            </form>
          </li>
          <li class="<?php echo (isset($active) && $active == 0 || !isset($active)) ? 'active open' : ''; ?> sub">
              <a href="javascript:void(0)">
                  <i class="fa fa-home"></i>Management Spa
                  <div class="pull-right"><span class="caret"></span></div>
              </a>
              <ul class="templatemo-submenu">
                  <li><a href="<?php echo base_url("spaman/spa_info"); ?>">Information details</a></li>
                  <li><a href="<?php echo base_url("spaman/spa_hour"); ?>">Hours of operation</a></li>
                  <li><a href="<?php echo base_url("spaman/spa_policy"); ?>">Policy</a></li>  
                  <li><a href="<?php echo base_url("spaman/spa_util"); ?>">Utilities spa</a></li>
                  <li><a href="<?php echo base_url("spaman/spa_product"); ?>">Products & Services</a></li>
                  <li><a href="<?php echo base_url("spaman/spa_price"); ?>">Management Price</a></li> 
                  <li><a href="<?php echo base_url("spaman/spa_km"); ?>">Promotion</a></li> 
              </ul>
          </li>
          <li class="sub">
            <a href="javascript:;">
              <i class="fa fa-database"></i> Finance
              <div class="pull-right"><span class="caret"></span></div>
            </a>
            <ul class="templatemo-submenu">
              <li><a href="<?php echo base_url("spaman/spa_dt"); ?>">Revenue</a></li>
              <li><a href="<?php echo base_url("spaman/spa_cal"); ?>">Calendar</a></li>
              <li><a href="<?php echo base_url("spaman/spa_booking"); ?>">Online Booking</a></li> 
            </ul>
          </li>
          <li>
              <a href="<?php echo base_url("spaman/spa_notify"); ?>">
                  <i class="fa fa-cubes"></i>
                  <span class="badge pull-right">0</span>Notify
              </a>
          </li>
          <li class="<?php echo (isset($active) && $active == 3) ? 'active' : ''; ?>">
              <a href="<?php echo base_url("spaman/spa_user"); ?>">
                  <i class="fa fa-users"></i>
                  <span id="spandoinhomno" class="badge pull-right">0</span>Team
              </a>
          </li>
          <li>
              <a href="<?php echo base_url("spaman/spa_report"); ?>">
                  <i class="fa fa-cog"></i>Reports
              </a>
          </li>
          <li>             
              <a href="<?php echo base_url("spaman/thoat_info")?>" >
                  <i class="fa fa-sign-out"></i>Logout
              </a>
          </li>
        </ul>
    </div><!--end left menu-->
    
    <div class="template-page-wrapper">
        <div class="templatemo-content">