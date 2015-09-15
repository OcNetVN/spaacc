<?php
  
?>
<div id="profile-links">
    Hello, <?php if(isset($_SESSION['AccUser']['user_name'])) echo $_SESSION['AccUser']['user_name'] ?>
    <br />
    <a href="<?php echo base_url('admin/welcome/'); ?>" title="View the Site">Trang chủ</a> | <a href="<?php echo base_url('admin/user/logout'); ?>" title="Thoát">Thoát</a>
</div>   
<ul id="main-nav">  <!-- Accordion Menu -->
                
    <li id="menuWelcome">
        <a  href="<?php echo base_url('admin/welcome/');  ?>" class="nav-top-item no-submenu current"> <!-- Add the class "no-submenu" to menu items with no sub menu -->
            Chào mừng
        </a>       
    </li>
    
    <li id="menuProductCha"> 
        <a href="#" class="nav-top-item "> <!-- Add the class "current" to current menu item -->
        Sản phầm & dịch vụ
        </a>
        <ul>
            <li id="menuProducts"><a href="<?php echo base_url('admin/products/'); ?>">Cập nhật sản phẩm</a></li>
            <li id="menuPice"><a href="<?php echo base_url('admin/price/'); ?>">Quản lý giá SP</a></li> <!-- Add class "current" to sub menu items also -->
            <li id="menuProducttype"><a href="<?php echo base_url('admin/producttype/'); ?>">Cập nhật nhóm SP & DV</a></li>  
			<li id="menuPakage"><a href="<?php echo base_url('admin/package/'); ?>">Cập nhật quản lý Pakage sản phẩm</a></li>
			<li id="menuProductPromotion"><a href="<?php echo base_url('admin/promotion/'); ?>">Khuyến mãi</a></li>	
        </ul>
    </li>
                
    <li id="menuUserCha" >
        <a href="#" class="nav-top-item">
            Người dùng - Users
        </a>
        <ul>
            <li id="menuUsers" ><a href="/nhaplieuspa/admin/user">Người dùng</a></li>
        </ul>
    </li>
    
     <li id="menuSpaCha">
        <a href="#" class="nav-top-item">
            Spa - Quản lý Spa
        </a>
        <ul>
            <li id="menuSpa"><a href="/nhaplieuspa/admin/spa">Quản lý spa</a></li>
            <li id="menuSpaUser"><a href="/nhaplieuspa/admin/spauser">Người dùng spa</a></li>
        </ul>
    </li>
       
    
    <li id="menuUncontructionCha">
        <a href="#" class="nav-top-item">
           Phân quyền
        </a>
        <ul>
            <li id="menu"><a href="/nhaplieuspa/admin/menu">Menu</a></li>
            <li id="module"><a href="/nhaplieuspa/admin/module">Module</a></li>
            <li id="groupuser"><a href="/nhaplieuspa/admin/groupuser">Nhóm người dùng</a></li>
            <li id="accessforgroup"><a href="/nhaplieuspa/admin/accessforgroup">Phân quyền cho nhóm</a></li>
            <li id="asigngroupforuser"><a href="/nhaplieuspa/admin/asigngroupforuser">Gán nhóm cho người dùng</a></li>
        </ul>
    </li>
    <li id="menuQuangcao">
        <a href="#" class="nav-top-item">
            Quảng cáo
		</a>
        <ul>
            <li id="menuCNQuangCao"><a href="/nhaplieuspa/admin/quangcao">Cập nhật quảng cáo</a></li>            
        </ul>
	</li>
    <li id="menuCommonCha">
        <a href="#" class="nav-top-item">
            Cài đặt
        </a>
        <ul>
            <li id="menuCommontype"><a href="/nhaplieuspa/admin/commontype">Common Types</a></li>
            <li id="menuCommoncode"><a href="/nhaplieuspa/admin/commoncode">Common Codes</a></li>   
			<li id="menuTKHT"><a href="/nhaplieuspa/admin/thongkehethong">Thông số hệ thống</a></li> 
			<li id="menuHistory"><a href="/nhaplieuspa/admin/actionhistory">Lịch sử giao dịch</a></li> 
        </ul>
    </li>  
	<li id="MenuReportCha">
        <a href="#" class="nav-top-item">
            Báo cáo
		</a>
		<ul>
			<li id="menuBaocao1"><a href="/nhaplieuspa/admin/baocao1">Báo cáo 1</a></li>
			<li id="menuBaocao2"><a href="/nhaplieuspa/admin/baocao2">Báo cáo 2</a></li>
			<li id="menuBaocao3"><a href="/nhaplieuspa/admin/baocao3">Báo cáo 3</a></li>
		</ul>
	</li>
    
</ul> <!-- End #main-nav -->
