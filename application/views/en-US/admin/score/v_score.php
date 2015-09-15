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
        
        <title>Spa Booking Nhập Liệu</title>
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
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/score.js'); ?>"></script>
        
        <!--[if IE]><script type="text/javascript" src="resources/scripts/jquery.bgiframe.js"></script><![endif]-->
        
    </head>
  
    <body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
        
        <div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
            
            <h1 id="sidebar-title"><a href="#">Spa Booking Nhập Liệu</a></h1>
          
            <!-- Logo (221px wide) -->
            <a href="#"><img id="logo" src="<?php echo base_url('resources/images/logo.png'); ?>" alt="Simpla Admin logo" /></a>
          
            <?php
                $this->load->view($lang.'/admin/menu1.php');
            ?>  
            
        </div></div> <!-- End #sidebar -->
        
        <div id="main-content"> <!-- Main Content Section with everything -->
            <div class="clear"></div> <!-- End .clear -->
            <div class="content-box" style="display:block;"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <h3>Quản lý tin tức</h3>
                    
                    <ul class="content-box-tabs">
                        <li><a href="#tab1" id="prlist" class="default-tab">Tra cứu điểm</a></li>
                    </ul>
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1">
                        <div class="cpbody" style="" >
                        <table>
                            <tr>
                                <td class="lable_with"><label>Loại đối tượng </label></td>
                                <td class="col_with">
                                    <select id="cboNewObj" name="cboNewObj" style="min-width: 320px;">
                                        <option value="" selected="selected">Vui lòng chọn</option>
                                        <option value="SPA">SPA</option>
                                        <option value="MEMBER">MEMBER</option>
                                    </select> 
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="lable_with"><label>Mã  </label> </td>
                                <td class="col_with">
                                   <input type="text" name="title" id="txt_ID" class="class-input-text">
                                </td> 
                                <td class="lable_with"><label>Tên</label> </td>
                                <td>
                                    <input type="text" name="Name" id="txt_Name" class="class-input-text">
                                </td>
                                
                            </tr>
                        </table>
                </div>
                <div  > 
                <input type="button" class="button " value="Search" onclick="searchScore(1);"  style="width:100px;height:30px;" >
                <input type="button" class="button " value="Reset" onclick="Reset();"  style="width:100px;height:30px;" >
                
                </div>
                <div id="divTBKQTim" style="margin-top: 10px; display: none;" class="notification success png_bg">
                    <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                    <div>
                       Tìm được 20 mẫu tin!!!
                    </div>
                </div>        
                        <table id="panelDataPRO" style="display: none;" class="tableborder">                            
                            <thead>
                                <tr>
                                   <th>STT</th>
                                   <th>Thông tin đối tượng</th>
                                   <th>Loại</th>
                                   <th>Số dư</th>
                                   <th>Ngày cập nhật</th>
                                   <th>Thao tác</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div>
                                            Trang so: 
                                            <select id="cboPageNoPRO">
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                            
                        </table>
                        
    <div id="showScoreTrans">
        <table id="panelDataScore" style="display: none;" class="tableborder">                            
                            <thead>
                                <tr>
                                   <th>STT</th>
                                   <th>Mã</th>
                                   <th>Loại</th>
                                   <th>Số dư</th>
                                   <th>Ngày cập nhật</th>
                                   <th>Thao tác</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div>
                                            Trang so: 
                                            <select id="cboPageNoPRO">
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                            
                        </table>
    </div>
    
    <!-- reset điểm  -->
<div id="DivRestScore" style="display:none;margin-left: 50px;">
<h2>Reset điểm của đối tượng <span id="ObjectID"></span></h2>
    <form id="form_Edit"> 
        <fieldset> 
            <table width="100%" >
                
                <tr>
                    <td><label>Bạn có thể rest lại điểm cho đối tương</label> </td>
                    
                </tr>
                <tr>
                    <td><input id="txt_Score" type="text" class="text-input medium-input" /></td>
                </tr>
                
            </table>
        </fieldset>
            <div id="divmessageSucess" class="notification success png_bg ThemThanhCong" style="display: none;">
                    <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification " alt="close" /></a>
                    <div>
                       Reset điểm thành công thành công !
                    </div>
                </div>
                        
            <div id="divmessageError" class="notification error png_bg ThemThatBai" style="display: none;">
                <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                <div>
                    Reset điểm không thành công !
                </div>
            </div>
             <input type="button" value="Cập nhật" id="btn_CapNhat" onclick="ResetCore();" />
             <input  type="button" value="Đóng" id="btn_CloseMenu" onclick="CloseDiv();"/>
            <div class="clear"></div><!-- End .clear -->  
    </form>
</div> 
    <!-- end reset điểm -->

<!-- show thông tin chi tiết điểm -->
<div id="showScoreTrans" style="">
<div id="divTBKQTimScoreTrans" style="margin-top: 10px; display: none;" class="notification success png_bg">
                    <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                    <div>
                       Tìm được 20 mẫu tin!!!
                    </div>
                </div> 
    <table id="panelDataScoreTrans" style="display: none;" class="tableborder">                            
        <thead>
            <tr>
               <th>Mã đối tượng</th>
               <th>Mã booking</th>
               <th>Tổng điểm</th>
               <th>Thông tin cập nhật</th>
               
            </tr>
            
        </thead>
        <tbody>      
        </tbody>                 
     </table>
     
      <script id="ListFoundScore" type="text/x-jquery-tmpl" > 
            <tr >
                
                <td>${ObjectIDD}</td>
                <td> <a href="/nhaplieuspa/admin/scores/getbooking/${RefID}">${RefID}</a></td>
                <td> ${TotalScore} </td>
                <td>
                    Người cập nhật: ${CreatedBy} <br />
                    Ngày cập nhật: ${CreatedDate} <br />
                </td>
                
            </tr>
    </script> 
</div>
<!-- end thông tin chi tiết của điểm -->
   
                        
                    </div> <!-- End #tab1 -->
               
         </div> <!-- End .content-box-content -->
     </div>
            <?php
                $this->load->view($lang.'/admin/footer.php');
            ?>    

        </div> <!-- End #main-content -->
    
    
    </div>
    
    <script id="ListFoundPRO" type="text/x-jquery-tmpl" > 
            <tr id="tr${id}">
                <td>${STT}</td>
                <td>
                    Mã: <span>${ID}</span><br>
                    Tên: <span>${Name}</span>
                </td>
                <td> ${Type}</td>
                <td> ${ScoreBalance} </td>
                <td>
                    Người cập nhật: ${ModifiedBy} <br />
                    Ngày cập nhật: ${ModifiedDate} <br />
                </td>
                <td>                                        
                     <a href="javascript:void(0);" onclick="ResetDiem('${ID}');" title="Xem chi tiết"><img src="<?php echo base_url('resources/images/icons/pencil.png'); ?>" alt="Sửa" /></a>
                     <a href="javascript:void(0);" onclick="ShowDetail('${ID}');"  title="Xem chi tiết"><img src="<?php echo base_url('resources/images/icons/show.png'); ?>" alt="Chi tiết" />
                </td>
            </tr>
    </script> 
    
 </body>
     


</html>


                    