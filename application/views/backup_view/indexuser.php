<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- InstanceBeginEditable name="doctitle" -->
	<title>the Booking - Spa - User Profile</title>
	<!-- InstanceEndEditable -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('resources/front/favicon.ico'); ?>" />
    <?php require("head.php"); ?>
    <script type="text/javascript" src="<?php echo base_url('resources/front/js/indexuser.js'); ?>"></script>
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
    	<h1 class="page-title-bar">Thông tin người dùng</h1>
        
    	<div class="wrap-2cols nav-left userprofile">
        	<div class="col-nav">
                <div class="wrap-avatar" id="avatar_edit">
                </div>
                <h4 class="user-name">
                	<?php 
                        echo $ttuser->FullName;
                    ?>
                </h4>
                <p>
               	 <span class="glyphicon glyphicon-star" aria-hidden="true"></span> 
                 <?php 
                    if($ttuser->ScoreBalance!="" && ($ttuser->ScoreBalance)>0)
                    {
                        echo "Tổng điểm: <span>".number_format($ttuser->ScoreBalance)."</span> điểm";
                    }
                    else
                        echo "Bạn chưa có điểm";
                 ?>
                </p>
                <button type="button" class="btn btn-default" style="width:100%;" onClick="parent.location='useredit'">Sửa thông tin</button>
                <hr />
                <h5>Tên đăng nhập của tôi</h5>
                <?php echo $_SESSION['AccUser']['User']->UserId; ?>
                <hr />
                <h5>Public Profile</h5>
                Know as <strong>username</strong> on The Booking Spa<br />
                <a href="javascript:void(0);" onClick="parent.location='user-profile-public.html'">
                	Check how others see your profile
                </a>
            </div>
            <div class="col-content">
                <div class="content">
                     <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                          <li class="active"><a href="#overview" role="tab" data-toggle="tab" >Lịch sử đặt chổ</a></li>
                        </ul>
                        <?php 
                            if(isset($count_bookingid) && $count_bookingid->total>0)
                            {
                         ?>
                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div class="tab-pane active" id="overview">
                          		<h3>Lịch sử đặt chổ</h3>
                            <ul class="nav nav-pills pull-right">
                                  <li role="presentation" class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                      All <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                      <li><a href="#">This Month</a></li>
                                      <li><a href="#">Last Month</a></li>
                                    </ul>
                                  </li>
                                </ul>
                                <div class="wrap-table" id="content_list">
                                	
                                </div>
                                <nav id="numpage">
                                  
                                </nav>
                          </div>                          
                        </div><!-- End Tab Content -->
                        <?php 
                            }else
                            {
                        ?>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="overview">
                                        <h3>Bạn chưa đặt chổ</h3>
                                    </div>
                                </div>
                        <?php            
                            }
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

<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "42ca428d-6cd0-4b93-b360-fa0d0bfa3696", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script> 
    
</body>
<!-- InstanceEnd --></html>
