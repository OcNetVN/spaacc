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
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Spa Booking Nhập Liệu </title>
    <link rel="stylesheet" href="<?php echo base_url('resources/css/reset.css'); ?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url('resources/css/style.css'); ?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url('resources/css/spa.css'); ?>" type="text/css" media="screen" />      
    <link rel="stylesheet" href="<?php echo base_url('resources/css/invalid.css'); ?>" type="text/css" media="screen" />   
    <!-- jQuery -->
    <link rel="stylesheet" href="<?php echo base_url('resources/css/jquery-ui-1.8.16.custom.css'); ?>" type="text/css" media="screen" />      
    <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery-1.8.2.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery-ui.custom.js'); ?>"></script>  
  
    <script type="text/javascript" src="<?php echo base_url('resources/ckeditor/ckeditor.js'); ?>"></script>
    <script src="<?php echo base_url('resources/front/js/common.js'); ?>"></script>    
    <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/menu.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('resources/scripts/simpla.jquery.configuration.js'); ?>"></script>       
    <!-- Facebox jQuery Plugin -->
    <script type="text/javascript" src="<?php echo base_url('resources/scripts/facebox.js'); ?>"></script>       
    <!-- jQuery WYSIWYG Plugin -->
    <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.wysiwyg.js'); ?>"></script>       
    <!-- jQuery Datepicker Plugin -->
    <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.datePicker.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.date.js'); ?>"></script>
    <!--[if IE]><script type="text/javascript" src="resources/scripts/jquery.bgiframe.js"></script><![endif]-->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>      
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
        <div class="content-box"><!-- Start Content Box -->
            <div class="content-box-header">
                <h3>Danh sách quản lý spa</h3>  
                <ul class="content-box-tabs">
                    <li><a href="#tab1" class="default-tab">Cập nhật tiện ích cho spa</a></li> 
                </ul>              
                    <div class="clear"></div>
                </div> <!-- End .content-box-header -->
                <div class="content-box-content">     
                    <div class="tab-content default-tab" id="tab1">                      
                        <!--------------------- Search information spa --------------------------->
                    <div class="cpbody" style="" >
                        <table>
                            <tr>
                                <td class="lable_with"><label>ID spa </label> </td>
                                <td class="col_with"><input type="text" name="spaID" id="txtspaID" class="class-input-text"></td> 
                                <td class="lable_with"><label>Địa chỉ </label></td>
                                <td class="col_with"><input type="text" name="address" id="txtAddress" class="class-input-text"></td>
                            </tr>
                            <tr>
                                <td class="lable_with"><label>Tên spa </label></td>
                                <td class="col_with"><input type="text" name="spaName" id="txtspaName" class="class-input-text"></td> 
                                <td class="lable_with"><label>Email </label></td>
                                <td class="col_with"><input type="text" name="email" id="txtemail" class="class-input-text"></td>
                            </tr>
                            <tr>
                                <td class="lable_with"><label>Điện thoại </label></td>
                                <td class="col_with"><input type="text" name="Tel" id="txtTel" class="class-input-text"></td>            
                                <td class="lable_with"><label>Ghi chú </label></td>
                                <td ><input type="text" name="txtnotes" id="txtnotes" class="class-input-text"> </td>
                            </tr>
                            <tr>
                                <td class="lable_with"><label>Mô tả </label></td>
                                <td colspan="3"><input type="text" name="txtDescription" id="txtDescription" class="class-input-text"></td>
                            </tr>
                            <tr>
                                <td class="lable_with"><label>Mô tả chi tiết</label></td>
                                <td colspan="3"><input type="text" name="txtMoreInfo" id="txtMoreInfo" class="class-input-text"></td>  
                            </tr>     
                        </table>
                    </div>
                    <div  style="margin-left:370px;margin-bottom: 30px;"> 
                        <input type="button" class="btn " value="Search" onclick="searchSpa(1);"  style="width:100px;height:30px;" >
                        <input type="button" class="btn " value="Reset" onclick="Reset();"  style="width:100px;height:30px;" >
                    </div> 
            <div class="clear"></div>
<!--====================================== hiển thị danh sách spa sau khi search=======================-->  
              
           <div class="divlistspa" id="divResult" style="display: none;">
                <div class="notification success png_bg ">
                    <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                    <div><span id="tbaoTimDc"></span></div>
                </div>
           </div>
                <div class="divcssTab">
                    <table id="panelData" class="tableborder">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Thông tin Spa</th>
                                <th>Mỹ Phẩm</th>
                                <th>Dược Liệu</th>
                            </tr>    
                        </thead> 
                        <tbody>
                        <!-- hiển thị danh sách bằng ajax-->
                        </tbody>                 
                        </table>
                </div>   
             
           <div>
                Trang so: 
                <select id="cboPageNo">
                </select>
           </div>           
   </div> <!-- End #tab1 -->
 <!--========================= Search information spa =====================================-->
         
<!--========================= screen created new spa =====================================-->                     
     <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
    
</div> <!-- End .content-box -->
  
<!--- load tiện ích của spa -->
<div id="poupSpaFa" style="width:400px;display:none;margin-left: 30px;">
    <h3>Thêm danh sách thông tin mỹ phẩm của spa <span id="spanSpaID_"></span></h3>
        <table style="width:380px;">
            <tr>
                <td style="width:150px;"><p><label>Chọn thông tin mỹ phẩm spa</label></p></td>
                <td>
                    <select name="cate" id="cbbSpaFacility" class="small-input">
                        <?php echo $list_spaFac ;?>
                    </select>
                </td>
            </tr>
            <tr>  
                <td style="width: 150px;">Danh sách thông tin mỹ phẩm spa:</td>  
                <td  id ="tdSaFacliity" style=" text-align:left;" > </td>

            </tr>                
        </table> 
         <div id="divUpdateSuccessFac" style="display: none;" class="notification success png_bg ThemMoiError">
             <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
             <div>       
                    Cập nhật thông tin mỹ phẩm thành công!
             </div>
         </div>
        <div id="divUpdateErrorFac" style="display: none;" class="notification error png_bg ThemMoiError">
         <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
         <div>      
            Cập nhật thông tin mỹ phẩm không thành công!
        </div>
         </div>
            <div style="clear:both; position: absolute;bottom: 50px;">
                 <input type="button" id="btnUpdateSpaFacitily"  name="clear" value="Cập nhật tiện ích" onclick="UpdateSpaFacitily();">
                <input id="btnClosePopupFac" type="button"  name="clear" value="Đóng"  onclick="closePoup();">          
            </div>  
</div>
<!-- end tiện ích của spa -->  

<!--- load loại spa -->
<div id="poupSpaType" style="width:400px;display:none;margin-left: 30px;">
    <h3>Thêm danh sách dược liệu spa <span id="spanSpaID"></span></h3>
        <table style="width:380px;">
            <tr>
                <td style="width:150px;"><p><label>Chọn loại thông tin dược liệu spa</label></p></td>
                <td>
                    <select name="cate" id="cbbSpaType" class="small-input">
                        <?php echo $list_spatype ;?>
                    </select>
                </td>
            </tr>
            <tr>  
                <td style="width: 150px;">Danh sách dược liệu:</td>  
                <td  id ="tdSaType" style=" text-align:left;" > </td>
            </tr>                
        </table> 
        <div id="divUpdateSuccessType" style="display: none;" class="notification success png_bg ThemMoiError">
            <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
             <div>          
                Cập nhật thông tin dược liệu spa thành công!
            </div>
         </div>
        <div id="divUpdateErrorType" style="display: none;" class="notification error png_bg ThemMoiError">
            <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
             <div>          
                Cập nhật thông tin dược liệu spa không thành công!
            </div>
         </div>
        <div style="clear:both;position: absolute;bottom: 50px;">
            <input type="button" id="btnUpdateSpaType" name="clear" value="Cập nhật loại"  onclick="UpdateSpaType();">
            <input type="button" id="btnClosePopupType" name="clear" value="Đóng"  onclick="closePoupType();">          
        </div>  
</div>
<!-- end tiện ích của spa -->       


<?php
    $this->load->view($lang.'/admin/footer.php');
?>       
    </div></body>
  <!-- show danh sách lên view --->
<div id="dialog-confirm" title="Xác đinh" style="display:none;"></div>
<script type="text/x-jquery-tmpl" id="DSHHtimduoc">
 <tr>                                      
    <td>${STT}</td>
    <td>
        <b>ID:</b><span>${spaID}</span><br/>
        <b>Tên Spa: </b>${spaName}</br/>
        <b>Tel:</b>${Tel}<br/>
        <b>Địa chỉ:</b>${Address}</br/>
        <b>Email:</b>${Email}</br/>
    </td>
    <td class="" id="tdSpaFac${spaID}">  
      <div id="DivSpaFacilityShow${spaID}"></div>
      <input  type="button" name="AddProduct" id="SpaFacility" value="Chọn mỹ phẫm" onclick="SelectSpaUtil('${spaID}');"/>
    </td>
     <td class="" id="tdSpaType${spaID}">
      <div id="DivSpaTypeShow${spaID}"></div>
      <input  type="button" name="AddProduct" id="SpaType" value="Chọn dược liệu" onclick="SelectSpaType('${spaID}');"/>
     </td>
    
    
</tr>
</script>
<script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.tmpl.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/spaother.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/Upload.js'); ?>"></script>

<!-- Download From www.exet.tk-->
</html>
