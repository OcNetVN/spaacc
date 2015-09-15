<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- InstanceBeginEditable name="doctitle" -->
	<title>the Booking - Spa</title>
	<!-- InstanceEndEditable -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('resources/front/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('resources/front/css/datepicker.css'); ?>" rel="stylesheet">
    
    <link href="<?php echo base_url('resources/front/css/yamm.css'); ?>" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug>
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    	<!-- Bootstrap core JavaScript
    ================================================== -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo base_url('resources/front/js/bootstrap.min.js'); ?>"></script>

    <!-- Bootstrap date picker -->
    <script src="<?php echo base_url('resources/front/js/jquery.js'); ?>"></script>
    <script src="<?php echo base_url('resources/front/js/bootstrap-datepicker.js'); ?>"></script>
    
    <script src="<?php echo base_url('resources/front/js/jquery.bgpos.js'); ?>"></script>
    <script>
		$(function(){
			$('.datepicker').datepicker({
				format: 'mm-dd-yyyy'
			});			
		});
		
		$(document).on('click', '.yamm .dropdown-menu', function(e) {
		  e.stopPropagation()
		})
	</script>

    <!-- bxSlider Javascript file -->
	<script src="<?php echo base_url('resources/front/js/jquery.bxslider.min.js'); ?>"></script>
    <!-- bxSlider CSS file -->
	<link href="<?php echo base_url('resources/front/css/jquery.bxslider.css'); ?>" rel="stylesheet" type="text/css" />
    
    <script type="text/javascript">
		$(document).ready(function(){
			$('.bxslider').bxSlider({
				controls:false,
				autoHover:true,
				autoStart:true,
				minSlides: 1,
				maxSlides: 1,
				moveSlides: 1,
				slideMargin: 10
		  });
		});
	</script>
    
    <!-- InstanceBeginEditable name="head" -->
		<script src="<?php echo base_url('resources/front/js/jquery-ui.min.js'); ?>"></script>
		<link href="<?php echo base_url('resources/front/css/jquery-ui.theme.min.css'); ?>" rel="stylesheet" type="text/css" />
        <script>
		  $(function() {
			$( "#accordion" ).accordion({
			  heightStyle: "content"
			});
			$( "#accordion-popup" ).accordion({
			  heightStyle: "content"
			});
		  });
		</script>
    <!-- InstanceEndEditable -->
	<link href="<?php echo base_url('resources/front/css/style.css'); ?>" rel="stylesheet" type="text/css" />
</head>

<body>

<header>
	<div class="navbar" role="navigation">
    	<div class="full-bar top-bar">
        	<div class="container">
                    <div class="row" id="loadheader">
                        <?php
                             require("header.php");
                         ?>
                    </div>                    
                    
                  </div>
        </div>
        <div class="clearfix"></div>
        <?php
             require("headersearch.php");
         ?>
    </div>
    <?php
             require("menu.php");
    ?>
    <div class="clearfix"></div>
    
	<!-- InstanceBeginEditable name="Full Content" -->
    <!-- InstanceEndEditable -->    
    
    <div class="container" style="padding-top:10px; padding-bottom:10px;">
    <!-- InstanceBeginEditable name="Main Content" -->
    <div id="content_page1">
    	<h1 class="page-title-bar">Thông tin thanh toán</h1>
        <div class="tab-content">
        
       
        <!--step 3-->
       <div id="loadcontent2" >
       Bạn đã hủy thanh toán đơn hàng hoặc thanh toán không thành công! Vui lòng quay lại để chọn lại hình thức thanh toán!
       </div>
        <!--end step 3-->
        <!--end thanh toan banng 123pay-->
       	</div>
        <br />
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><button type="button" class="btn btn-default" onClick="parent.location='checkout2'">Back</button></td>
            <td>
                <form name="frmMain" name="frmMain" method="post" enctype="multipart/form-data">
                    
                </form>
            </td>
          </tr>
        </table>
       </div> 
     <div id="content_page2" style="display: none;">
        
     </div>
     <div id="loadtb" class="col-md-8 col-md-offset-2" style="display: none; color: green; font-weight: bold;">
       
       </div>
        
    
	<!-- InstanceEndEditable -->
    </div>
    
</header>

<?php
     require("footer.php");
 ?> 



<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "42ca428d-6cd0-4b93-b360-fa0d0bfa3696", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script> 
    
</body>
<!-- InstanceEnd --></html>
