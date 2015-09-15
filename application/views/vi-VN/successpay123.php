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
    <link rel="icon" href="<?php echo base_url('resources/front/favicon.ico'); ?>" />
    <?php require("head.php"); ?>
    <script type="text/javascript" src="<?php echo base_url('resources/front/js/successpay123.js'); ?>"></script>
</head>

<body>
<?php require("loadloading.php"); ?>
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
        
        <!--thanh toan bang 123pay-->
        <?php @include_once 'resources/front/123pay/common.class.php'; ?> 
        <!--step 3-->
       <div id="loadcontent2" style="display: none;">
       
       </div>
        <!--end step 3-->
        <!--end thanh toan banng 123pay-->
       	</div>
        <br />
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><button type="button" class="btn btn-default">Back</button></td>
            <td>
                <button type="button" class="btn btn-default">Continue</button>
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
    <?php require("booking.php"); ?>
</header>

<?php
     require("footer.php");
 ?> 

<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "42ca428d-6cd0-4b93-b360-fa0d0bfa3696", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script> 
    
</body>
<!-- InstanceEnd --></html>
