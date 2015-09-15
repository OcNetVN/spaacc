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
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/quangcao.js'); ?>"></script>
        
        
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
                    <h3>Quảng cáo</h3>
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
 
    
    </div>


<!-- end list sản phẩm khuyến mãi -->

    
</body>
     


</html>


                    