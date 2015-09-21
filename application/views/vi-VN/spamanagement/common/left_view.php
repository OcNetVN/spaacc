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
                  <i class="fa fa-home"></i>Quản lý Spa
                  <div class="pull-right"><span class="caret"></span></div>
              </a>
              <ul class="templatemo-submenu">
                  <li><a href="<?php echo base_url("spaman/spa_statistics"); ?>">Thống kê</a></li>
                  <li><a href="<?php echo base_url("spaman/spa_info"); ?>">Thông tin chi tiết</a></li>
                  <li><a href="<?php echo base_url("spaman/spa_hour"); ?>">Giờ mở cửa</a></li>
                  <li><a href="<?php echo base_url("spaman/spa_policy"); ?>">Chính sách</a></li>  
                  <li><a href="<?php echo base_url("spaman/spa_util"); ?>">Tiện ích spa</a></li>
                  <li><a href="<?php echo base_url("spaman/spa_product"); ?>">Sản phẩm & Dịch vụ</a></li>
                  <li><a href="<?php echo base_url("spaman/spa_price"); ?>">Quản lý Giá</a></li> 
                  <li><a href="<?php echo base_url("spaman/spa_km"); ?>">Khuyến mãi</a></li> 
              </ul>
          </li>
          <li class="sub">
            <a href="javascript:;">
              <i class="fa fa-database"></i> Tài chính 
              <div class="pull-right"><span class="caret"></span></div>
            </a>
            <ul class="templatemo-submenu">
              <li><a href="<?php echo base_url("spaman/spa_dt"); ?>">Doanh thu</a></li>
              <li><a href="<?php echo base_url("spaman/spa_cal"); ?>">Calendar</a></li>
              <li><a href="<?php echo base_url("spaman/spa_booking"); ?>">Online Booking</a></li> 
            </ul>
          </li>
          <li>
              <a href="<?php echo base_url("spaman/spa_notify"); ?>">
                  <i class="fa fa-cubes"></i>
                  <span class="badge pull-right">0</span>Thông báo
              </a>
          </li>
          <li class="<?php echo (isset($active) && $active == 3) ? 'active' : ''; ?>">
              <a href="<?php echo base_url("spaman/spa_user"); ?>">
                  <i class="fa fa-users"></i>
                  <span id="spandoinhomno" class="badge pull-right">0</span>Đội nhóm
              </a>
          </li>
          <!-- <li>
              <a href="<?php echo base_url("spaman/spa_report"); ?>">
                  <i class="fa fa-cog"></i>Báo cáo
              </a>
          </li> -->
          <li>             
              <a href="javascript:;" data-toggle="modal" data-target="#confirmModal">
                  <i class="fa fa-sign-out"></i>Thoát
              </a>
          </li>
        </ul>
    </div><!--end left menu-->
    <!-- Modal -->
      <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Đóng</span></button>
              <h4 class="modal-title" id="myModalLabel">Bạn có muốn thoát ?</h4>
            </div>
            <div class="modal-footer">
              <a href="spaman/thoat_info" class="btn btn-primary">Đồng ý</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
            </div>
          </div>
        </div>
      </div>

    
    <div class="template-page-wrapper">
        <div class="templatemo-content">