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
        
        <title>Spa Booking Admin</title>
        <link rel="stylesheet" href="<?php echo base_url('resources/css/reset.css'); ?>" type="text/css" media="screen" />
      
        <link rel="stylesheet" href="<?php echo base_url('resources/css/style.css'); ?>" type="text/css" media="screen" />
        
        <link rel="stylesheet" href="<?php echo base_url('resources/css/invalid.css'); ?>" type="text/css" media="screen" />    
        
        <!-- jQuery -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery-1.3.2.min.js'); ?>"></script>
        <script src="<?php echo base_url('resources/front/js/common.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/menu.js'); ?>"></script>
        <!-- jQuery Configuration -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/simpla.jquery.configuration.js'); ?>"></script>
        
        <!-- Facebox jQuery Plugin -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/facebox.js'); ?>"></script>
        
        <!-- jQuery WYSIWYG Plugin -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.wysiwyg.js'); ?>"></script>
        
        <!-- jQuery Datepicker Plugin -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.datePicker.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.date.js'); ?>"></script>
        
        <!--[if IE]><script type="text/javascript" src="resources/scripts/jquery.bgiframe.js"></script><![endif]-->
        <script type=" text/javascript">
  function CheckQuyenInsert()
  {
      $.ajax({
            type:"POST",
            url:"/nhaplieuspa/admin/welcome/TestQuyenInsert",
            dataType:"text",
            //data:{spaID:id},
            cache:false,
            success:function (data) {
                if(data=="-1" || data==="-1" || data==-1)
                {
                    alert("Khong Co quyen them moi");                    
                }
                else
                {
                    //alert("Co quyen them moi");
                }
              //alert(data);
            }
        });  
  }
</script>
        
    </head>
  
    <body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
        
        <div id="sidebar">
        <div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
            
            <h1 id="sidebar-title"><a href="#">Spa Booking Nhập Liệu</a></h1>
          
            <!-- Logo (221px wide) -->
            <a href="#"><img id="logo" src="<?php echo base_url('resources/images/logo.png'); ?>" alt="Simpla Admin logo" /></a>
          
            <!-- Sidebar Profile links -->
            
            <?php
                //require("menu1.php");
            ?>
            
            <?php
                $this->load->view($lang.'/admin/menu1.php');
            ?> 
            
        </div>
        </div> <!-- End #sidebar -->
        
        <div id="main-content"> <!-- Main Content Section with everything -->
             <h2>Chào mừng bạn đến với Spa booking nhập liệu</h2>
              <div class="clear"></div> <!-- End .clear -->
            
                <div class="content-box"><!-- Start Content Box -->
                 <p>Bạn có thể thao tác để quản lý thông tin spa booking một cách đơn giản</p>
                 <a href="javascript:void(0);" class="button" onclick="CheckQuyenInsert();">Ktra Quyen Insert</a>
                 <?php
            	    if(isset($path))
                    {
                        foreach($path as $item)
                        {
                            $this->load->view($item);
                        }
                    }
                 ?>
                 </div>
        </div> <!-- End #main-content -->
        
    </div></body>
  
  
<!-- Download From www.exet.tk-->
</html>
