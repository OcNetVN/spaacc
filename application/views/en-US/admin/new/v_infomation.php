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
        <script src="<?php echo base_url('resources/front/js/spachung.js'); ?>"></script>
        <!--<script src="<?php echo base_url('resources/front/js/common.js'); ?>"></script>-->
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
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/information.js'); ?>"></script>
        
        
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
                    <h3>Quản lý khuyến mãi SPA</h3>
                    <ul class="content-box-tabs">
                        <li><a href="#tab1" id="prlist" class="default-tab">Tra cứu thông tin</a></li>
                    </ul>
                    <div class="clear"></div>
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">                    
                    <!-------------THEM SAN PHAM--------------->
                    <div class="tab-content default-tab" id="tab1">
                        <form id="form_insert"> 
                            <fieldset> 
                            <table width="100%" >
                                <tr>
                                    <td>
                                        <label>Chọn thực mục cần cập nhật</label>              
                                        <select name="info" id="info">
                                            <option value="">Chọn thông tin  cần cập nhật</option>
                                            <?php
                                                foreach($infotype as $row){?>
                                                    <option value="<?php echo $row->CommonId?>"><?php echo $row->StrValue1; ?></option>
                                             <?php   }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                         <label>Chọn ngôn ngữ</label>
                                         <select name="langue" id="langue">
                                            <option value="">Chọn ngôn ngữ</option>
                                            <?php
                                                foreach($langtype as $row){?>
                                                    <option value="<?php echo $row->CommonId;?>"><?php echo $row->StrValue2; ?></option>
                                             <?php   }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                
                                        <label>Up hình</label>
                                        
                                        <input type="file" class="form-control" name="myfile" id="myfile" >
                        
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                       <input type="button" value="Upload" onclick="UploadFile();"/>                       
                                    </td>
                                    
                                </tr>
                                
                            </table>
                        <div class="notification success png_bg ThemThanhCong" style="display: none;">
                            <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification " alt="close" /></a>
                            <div>
                               Upload thành công !
                            </div>
                        </div>
                        
                        <div class="notification error png_bg ThemThatBai" style="display: none;">
                            <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                            <div>
                                Upload file không thành công !
                            </div>
                        </div>
                            
                        </fieldset>          
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

<!-- search danh sách spa  27/11/2014 -->
<div style="display:none;width:800px;height:600px;" id="divSearchSpaTab2" >
        <span>Tên SPA: </span><br />
        <input type="text" id="txtSpaNameTab2"/>        
        <br />
        <input type="button" value="Tìm SPA" onclick="SearchSPATab2(1);"/>
        <span id="spanKQTimTab2"></span>
        <br /><br />

        <table class="tableborder table-fill" id="panelDataSPATab2"  width="100%">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã SPA</th>
                    <th>TTin SPA</th>                    
                    <th>Chọn</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>        
        </table>
         <script id="ListFoundSPATab2" type="text/x-jquery-tmpl" >        
            <tr id="trSPA${spaID}">
                    <td>${STT}</td>
                    <td>${spaID}</td>
                    <td>
                        Tên Spa: <span>${spaName}</span> <br />
                        Địa chỉ: ${Address} <br />
                        ĐT: ${Tel} <br />
                    </td>
                    <td><a href="javascript:void(0);" onclick="ChonSpaTab2('${spaID}');" >Chọn</a></td>
                </tr>
         </script>
        <div id="DivPhanTrangSPATab2" style="margin:0;text-align:right;padding:0; margin-right:10px;">         
        Trang số:
        <select id="cboPageNoSPATab2" style="width:35px;" onchange="SearchSPACBBTab2();">
            <option>1</option>
            <option>2</option>
        </select>
    </div>        

</div>
<!-- end search danh sách spa -->   
    
    </div>

<!-- search danh sách sản phẩm của spa -->
 <div id="divsearchProductSpa" style="display:none;width:800px;height:600px;">
     <span>Tên sản phẩm: </span><br />
        <input type="text" id="txtProductNameTab2"/>          
        <br />
        <input type="button" value="Tìm sản phẩm" onclick="SearchProductSpa(1);"/>
        <span id="spanKQTimProTab2"></span>
        <br /><br />

        <table class="tableborder table-fill" id="panelDataSPAProduct" >
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã sản phẩm</th>
                    <th>TTin Sản phẩm</th>                    
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>        
        </table>
         <script id="ListFoundPRO" type="text/x-jquery-tmpl" >        
            <tr id="trProductID${ProductID}">
                <td>${STT}</td>
                <td>${ProductID}</td>
                <td>
                    Tên DV: <span>${Name}</span> <br />
                    Thời lượng : ${Duration} giờ
                    Số chỗ còn lại: ${CurrentVouchers} <br />
                    Số chỗ tối đa trong 1 thời điểm: ${MaxProductatOnce} <br />
                    Giá trị từ ngày: ${ValidTimeFrom} <br />
                    Giá trị đến ngày: ${ValidTimeTo} <br />
                </td>
                <td><a href="javascript:void(0);" onclick="ChonSpaProduct('${ProductID}');" >Chọn</a></td>
             </tr>                  
         </script>
        <div id="DivPhanTrangSPAProduct" style="margin:0;text-align:right;padding:0; margin-right:10px;">         
            Trang số:
            <select id="cboPageNoSPAProduct" style="width:35px;" onchange="SearchSPACBBTab2();">
                <option>1</option>
                <option>2</option>
            </select>
        </div>        
</div> 
<!-- end list sản phẩm khuyến mãi -->

    
</body>
     


</html>


                    