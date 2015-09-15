<?php
  
?>
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
        <link rel="stylesheet" href="<?php echo base_url('resources/css/bootstrap-multiselect.css'); ?>" type="text/css" media="screen" />     
        
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
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/bootstrap-multiselect.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.number.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/Upload.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/rolemenumodule.js'); ?>"></script>
        
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
                    <h3>Quản lý phân quyền cho nhóm</h3>
                    <ul class="content-box-tabs">
                        <li><a href="#tab1" id="prlist" class="default-tab">Tra cứu phân quyền cho nhóm</a></li>
                        <li><a href="#tab2" id="prlist" >Thêm mới </a></li>
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
                                <td class="lable_with"><label>Mã menu</label></td>
                                <td class="col_with"><input type="text" name="MenuID" id="txtMenuID" class="class-input-text"></td>      
                            </tr>
                           <tr>
                                <td class="lable_with"><label>Mã module</label></td>
                                <td class="col_with"><input type="text" name="ModuleID" id="txtModuleID" class="class-input-text"></td>      
                            </tr>
                        </table>
                    </div> 
                     <div  style="margin-left:370px;margin-bottom: 30px;"> 
                        <input type="button" class="btn " value="Search" onclick="searchRoleMenuModule(1);"  style="width:100px;height:30px;" >
                        <input type="button" class="btn " value="Reset" onclick="Reset();"  style="width:100px;height:30px;" >
                    </div> 
            <div class="clear"></div>
            
            <div class="divlistspa" id="divResult" style="display: none;">
                <div class="notification success png_bg ">
                    <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                    <div><span id="tbaoTimDc"></span></div>
                </div>
           </div>
           <div class="divSearchListRolesMenu">
                <table id="tbSearchRolesMenu" >
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã Roles</th>
                            <th>Mã menu</th>
                            <th>Mã module</th>
                            <th>Quyền hạn</th>
                            <th>Thông tin chung</th>
                            <th>Thao tác</th>
                        </tr>    
                    </thead> 
                    <tbody>
                    <!-- hiển thị danh sách bằng ajax-->
                    </tbody>                 
                </table>
                    
               <script id="ShowSearchListRolesMenu" type="text/x-jquery-tmpl" >        
                    <tr id="trRoleId${RoleId}${MenuId}${ModuleId}">
                            <td>${STT}</td>
                            <td><span> ${RoleId}</span></td>
                            <td><span>${MenuId}</span> </td>
                            <td><span>${ModuleId}</span> </td>
                            <td>
                                <b>Được phép tạo: </b><span>${allnew}</span><br/>
                                <b>Được phép sửa: </b><span>${alledit}</span><br/>
                                <b>Được phép xóa: </b><span>${allde}</span><br/>
                                <b>Được phép xem: </b><span>${allview}</span><br/>
                                <b>Được phép in: </b><span>${allprint}</span><br/>
                            </td>
                            <td>
                               <b>Ngày tạo:</b><span> ${CreatedDate}</span><br />
                               <b>Người tạo:</b><span>${CreatedBy}</span><br />
                            </td>
                            <td class="">
                              <a href="javascript:void(0)"  name='btn_del' id='btn_del' onclick="EditRoleModule('${RoleId}','${MenuId}','${ModuleId}');">
                              <img src="<?php echo base_url('resources/images/icons/pencil.png'); ?>" alt="Chỉnh sửa" /><p class='icon-delete btndel'></p></a>
                              <a href="javascript:void(0)"  name='btn_del' id='btn_del' onclick="DeleteRoleModule('${RoleId}','${MenuId}','${ModuleId}');">
                              <img src="<?php echo base_url('resources/images/icons/cross.png'); ?>" alt="Delete" /><p class='icon-delete btndel'></p></a>
                            </td>
                            
                            <td style="display:none">
                                <span>${AllowNew}</span>
                                <span>${AllowEdit}</span>
                                <span>${AllowDelete}</span>
                               <span>${AllowView}</span>
                               <span>${AllowPrint}</span>
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
                                    <td>
                                        <label>Tên Role</label>
                                        <select name="RoleName" id="_txtRoleID" class="" style="width: 350px;">
                                            <?php echo $role;?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Tên Menu</label>
                                        <select name="MenuName" id="_txtMenuID" class="" style="width: 350px;">
                                            <?php echo $menu;?>
                                        </select>
                                    </td>
                                    <td id="tdShowMenu"></td>
                                </tr>

                                 <tr style="display:none;">
                                    <td>
                                        <input type="text" id="txt_MenuID">
                                    </td> 
                                </tr>

                                <tr>
                                    <td>
                                        <label>Tên Module</label>
                                        <select name="ModuleName" id="_txtModuleID" class="" style="width: 350px;">
                                            <?php echo $module;?>
                                        </select>
                                    </td>
                                     <td > </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Quyền hạn</label>
                                        <input type="checkbox"   id="AllowNew" value="1" checked />Tạo mới
                                        <input type="checkbox"   id="AllowEdit" value="1" />Sửa
                                        <input type="checkbox"   id="AllowDelete" value="1" />Xóa
                                        <input type="checkbox"   id="AllowPrint" value="1" />In
                                        <input type="checkbox"   id="AllowView" value="1" />Xem
                                    </td>
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
                           
                        </div>
                        <div id="divmessageunit" style="display: none;">
                            <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /> </a>
                            <div>
                                   Đã được phân quyền vui lòng thêm mới quyền hạn khác !!
                            </div>
                           
                        </div>
                             <input type="button" value="Thêm mới" id="btn_CapNhat" onclick="TheMoiRoleMenuModule();" />
                             <input type="button" value="Reset" id="btn_Reset" onclick="ResetModule();" />
                            <div class="clear"></div><!-- End .clear -->  
                    </form>
               </div><!-- End #tab2 -->

<div id="DivEditRoleModule" style="display:none;margin-left:15px">
<h2>Chỉnh sửa phân quyền cho từng nhóm</h2>
    <form id="form_Edit"> 
        <fieldset> 
            <table width="100%" >
                <tr>
                    <td><label>Mã Role</label></td>              
                    <td><span id="txt_RoleID"></span></td>
                </tr>
                <tr>
                    <td><label>Mã Menu</label> </td>
                    <td><span id="txt_MenuID"></span></td>
                </tr>
                <tr>
                    <td><label>Mã Module</label> </td>
                    <td><span id="txt_ModuleID"></span></td>
                </tr>
                <tr>
                    <td><label>Quyền hạn</label></td>
                    <td>
                        <input type="checkbox"   id="_AllowNew" value="1" />Tạo mới
                        <input type="checkbox"   id="_AllowEdit" value="1" />Sửa
                        <input type="checkbox"   id="_AllowDelete" value="1"/>Xóa
                        <input type="checkbox"   id="_AllowPrint" value="1" />In
                        <input type="checkbox"   id="_AllowView" value="1"/>Xem
                    </td>
                </tr>
            </table>
        </fieldset>
            <div id="divmessageSucess" class="notification success png_bg ThemThanhCong" style="display: none;">
                    <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification " alt="close" /></a>
                    <div>
                       Cập nhật quyền hạn thành công !
                    </div>
                </div>
                        
            <div id="divmessageError" class="notification error png_bg ThemThatBai" style="display: none;">
                <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                <div>
                    Cập nhật quyền hạn không thành công !
                </div>
            </div>
             <input type="button" value="Cập nhật" id="btn_CapNhat" onclick="LuuCapNhatRoleMenuModule();" />
             <input type="button" value="Đóng" id="btn_Close" onclick="CloseRoleMenuModule();" />
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


                    