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
                <h3>Thiết lập file setting cho spa</h3>  
                <ul class="content-box-tabs">
                    <li><a href="#tab1" class="default-tab">Thiết lập</a></li> 
                </ul>              
                <div class="clear"></div>
            </div> <!-- End .content-box-header -->
                <div class="content-box-content">                          
                     <div class="tab-content default-tab" id="tab1">        
                        <form id="form_insert">  
                            <fieldset>
                            <table width="100%" >
                                <tr>
                                    <td><label>Thông số:</label></td>
                                    <td>
                                        <select id="dropdown">
                                            <option value="">-- Chọn thông số set --</option>
                                            <?php 
                                                foreach($setting as $key=>$value)
                                                {  ?>
                                                  <option value="<?php echo $key; ?>"><?php echo $key; ?></option>  
                                           <?php     }
                                            ?>
                                            
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Giá trị</label></td>
                                    <td>
                                        <?php 
                                            foreach($setting as $key=>$value){
                                           ?> 
                                              <input id="valuesetting<?php echo $key;?>" class = 'box <?php echo $key;?> class-input-text' type="text" value="<?php echo $value;?>" />  
                                                  
                                        <?php    }?>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td><input  type="button" value="Cập nhật" id="update_setting" onclick="UpdateSetting();"/></td>
                                </tr>
                            </table>
                            </fieldset>
                        </form>
                     </div> <!-- End .content-box-content -->
    
                </div> <!-- End .content-box -->
           
                  
            <div class="clear"></div>
            
            
            <?php
                $this->load->view($lang.'/admin/footer.php');
            ?> 
            
        </div> <!-- End #main-content -->
        
    </div></body>
  <!-- show danh sách lên view --->


<script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.tmpl.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/xml.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/Upload.js'); ?>"></script>

<!-- Download From www.exet.tk-->
</html>
