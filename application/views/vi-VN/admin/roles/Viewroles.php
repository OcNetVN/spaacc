<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<?php
    if(!isset($_SESSION['AccUser']))
    {
        redirect('login');
    } 
    
    $lang = "vi-VN";
if(isset($_SESSION['Lang']))
{
  $lang = $_SESSION['Lang'];
}
else
{
   $_SESSION['Lang']=$this->m_mail->getSetting("LangaugeDefault"); 
}
?>
 <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!--tao datetimepicker-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/datetimepicker/tcal.css'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/css/jquery-ui-1.8.16.custom.css'); ?>" />
        <script type="text/javascript" src="<?php echo base_url('public/datetimepicker/tcal.js'); ?>"></script> 
        <!--end tao datetimepicker--> 
        <title>Spa Booking Nhập Liệu Spa</title>
        <link rel="stylesheet" href="<?php echo base_url('resources/css/reset.css'); ?>" type="text/css" media="screen" />
      
        <link rel="stylesheet" href="<?php echo base_url('resources/css/style.css'); ?>" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url('resources/css/products.css'); ?>" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url('resources/css/invalid.css'); ?>" type="text/css" media="screen" />    
        
        <!-- jQuery -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery-1.8.2.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery-ui.custom.js'); ?>"></script>
        <script src="<?php echo base_url('resources/front/js/common.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/menu.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/ckeditor/ckeditor.js'); ?>"></script> 
        <!-- jQuery Configuration -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/simpla.jquery.configuration.js'); ?>"></script>
        
        <!-- Facebox jQuery Plugin -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/facebox.js'); ?>"></script>
        
        <!-- jQuery WYSIWYG Plugin -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.wysiwyg.js'); ?>"></script>
        
        <!-- jQuery Datepicker Plugin -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.datePicker.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.date.js'); ?>"></script>
        
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.tmpl.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.number.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/Upload.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/roles.js'); ?>"></script>
        
        <!--[if IE]><script type="text/javascript" src="resources/scripts/jquery.bgiframe.js"></script><![endif]-->
        
    </head>
  
<body>
    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
        <div id="sidebar">
            <div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
                <h1 id="sidebar-title"><a href="#">Spa Booking Nhập Liệu</a></h1> 
                <!-- Logo (221px wide) -->
                <a href="#"><img id="logo" src="<?php echo base_url('resources/images/logo.png'); ?>" alt="Simpla Admin logo" /></a>
                <?php
                    $this->load->view($lang.'/admin/menu1.php');
                ?>  
                
            </div>
        </div> <!-- End #sidebar -->
        
    <div id="main-content"> <!-- Main Content Section with everything -->
        <div class="clear"></div> <!-- End .clear -->
            <div class="content-box" style="display:block;"><!-- Start Content Box -->
                <div class="content-box-header">
                    <h3>Quản lý phần quyền</h3>
                    <ul class="content-box-tabs">
                        <li><a href="#tab1" id="prlist" class="default-tab">Tra cứu module</a></li>
                        <li><a href="#tab2" id="prlist" >Thêm mới quyền hạn</a></li>
                    </ul>
                    <div class="clear"></div>
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">           
                    <div class="tab-content default-tab" id="tab1">                      
                       <div class="cpbody" style="" >
                        <table>
                            <tr>
                                <td class="lable_with"><label>Mã Role </label> </td>
                                <td class="col_with"><input type="text" name="moduleID" id="txtRoleID" class="class-input-text"></td> 
                            
                            </tr>
                             <tr>
                                <td class="lable_with"><label>Tên Phân quyền</label></td>
                                <td class="col_with"><input type="text" name="spaName" id="txtRoleName" class="class-input-text"></td>      
                            </tr>
                           
                        </table>
                    </div> 
                     <div  style="margin-left:370px;margin-bottom: 30px;"> 
                        <input type="button" class="btn " value="Search" onclick="searchRoles(1);"  style="width:100px;height:30px;" >
                        <input type="button" class="btn " value="Reset" onclick="Reset();"  style="width:100px;height:30px;" >
                    </div> 
            <div class="clear"></div>
            
            <div class="divlistspa" id="divResult" style="display: none;">
                <div class="notification success png_bg ">
                    <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                    <div><span id="tbaoTimDc"></span></div>
                </div>
           </div>
           <div class="divSearchListRoles">
                <table id="tbSearchRoles" >
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã Roles</th>
                            <th>Tên phân quyền</th>
                            <th>Thông tin chung</th>
                            <th>Thao tác</th>
                        </tr>    
                    </thead> 
                    <tbody>
                    <!-- hiển thị danh sách bằng ajax-->
                    </tbody>                 
                </table>
                    
               <script id="ShowSearchListRoles" type="text/x-jquery-tmpl" >        
                    <tr id="tr${RoleId}">
                            <td>${STT}</td>
                            <td><span> ${RoleId}</span></td>
                            <td><span>${RoleName}</span> </td>
                            <td>
                               <b>Ngày tạo:</b><span> ${CreatedDate}</span><br />
                               <b>Người tạo:</b><span>${CreatedBy}</span><br />
                            </td>
                            <td class="">
                              <a href="javascript:void(0)"  name='btn_del' id='btn_del' onclick="EditRoles('${RoleId}');">
                              <img src="<?php echo base_url('resources/images/icons/pencil.png'); ?>" alt="Chỉnh sửa" /><p class='icon-delete btndel'></p></a>
                              <a href="javascript:void(0)"  name='btn_del' id='btn_del' onclick="DeleteRoles('${RoleId}');">
                              <img src="<?php echo base_url('resources/images/icons/cross.png'); ?>" alt="Delete" /><p class='icon-delete btndel'></p></a>
                            </td>
                    </tr>
                </script>
                </div>   
             
           <div>
                Trang so: 
                <select id="cboPageNo">
                </select>
           </div>            
    </div> <!-- End #tab1 -->
                    <div class="tab-content" id="tab2"><!-- Start #tab2-->
                    <form id="form_Insert"> 
                        <fieldset> 
                            <table width="100%" >
                                <tr>
                                    <td><label>Mã Role</label></td>              
                                    <td><input id="_txtRoleID" type="text" class="text-input medium-input" /></td>
                                </tr>
                                <tr>
                                    <td><label>Tên phân quyền</label> </td>
                                    <td><input id="_txtRoleName" type="text" class="text-input medium-input" /></td>
                                </tr>
                            </table>
                        </fieldset>
                        <div id="divAddmessageSucess" class="notification success png_bg ThemThanhCong" style="display: none;">
                                <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification " alt="close" /></a>
                                <div>
                                   Thêm mới quyền thành công !
                                </div>
                            </div>
                        
                        <div id="divAddmessageError" class="notification error png_bg ThemThatBai" style="display: none;">
                            <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                            <div>
                                Thêm mới quyền không thành công !
                            </div>
                        </div>
                             <input type="button" value="Cập nhật" id="btn_CapNhat" onclick="TheMoiRole();" />
                            <div class="clear"></div><!-- End .clear -->  
                    </form>
               </div><!-- End #tab2 -->

<div id="DivEditRole" style="display:none;margin-left:30px">
<h2>Chỉnh sửa mô tả về role</h2>
    <form id="form_Edit"> 
        <fieldset> 
            <table width="100%" >
                <tr>
                    <td><label>Mã Role</label></td>              
                    <td><input id="txt_RoleID" type="text" class="text-input medium-input" readonly="readonly"/></td>
                </tr>
                <tr>
                    <td><label>Tên phân quyền</label> </td>
                    <td><input id="txt_RoleName" type="text" class="text-input medium-input" /></td>
                </tr>
            </table>
        </fieldset>
            <div id="divmessageSucess" class="notification success png_bg ThemThanhCong" style="display: none;">
                    <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification " alt="close" /></a>
                    <div>
                       Cập nhật mô tả thành công !
                    </div>
                </div>
                        
            <div id="divmessageError" class="notification error png_bg ThemThatBai" style="display: none;">
                <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                <div>
                    Cập nhật mô tả không thành công !
                </div>
            </div>
             <input type="button" value="Cập nhật" id="btn_CapNhat" onclick="LuuCapNhatRole();" />
             <input type="button" value="Đóng" id="btn_Close" onclick="CloseRole();" />
            <div class="clear"></div><!-- End .clear -->  
    </form>
</div> 
<!-------------END THEM SAN PHAM--------------->
<!-------------END THEM SAN PHAM--------------->
</div> <!-- End .content-box-content -->
</div>
            <?php
                $this->load->view($lang.'/admin/footer.php');
            ?>    
</div> <!-- End #main-content -->
</div>

    
</body>
     


</html>


                    