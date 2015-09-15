<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- InstanceBeginEditable name="doctitle" -->
	<title>the Booking - Spa - About Thebooking.vn</title>
	<!-- InstanceEndEditable -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <?php require("head.php"); ?>
</head>

<body>

<header>
	<div class="navbar" role="navigation">
    	<div class="full-bar top-bar">
        	<div class="container">
                    <div class="row"> 
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
    	<h1 class="page-title-bar">TERM & LEGAL</h1>
    	<div class="wrap-2cols nav-left normal-page">
        	<div class="col-nav">
              <?php
                require("cm_about.php");
              ?>
            </div>
            <div class="col-content">
                <div class="content">
               	  <?php
                     echo  $HTMLInfo;
                 ?>
               	   
                	<div class="clearfix"></div>     
              </div>
            </div>
            
        </div>
	<!-- InstanceEndEditable -->
    </div>
    
</header>
<?php
     require("footer.php");
?>

</body>

</html>
