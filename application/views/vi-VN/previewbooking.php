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
    <script type="text/javascript" src="<?php echo base_url('resources/front/js/previewbooking.js'); ?>"></script>
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
       <!--step 3-->
       <div id="loadcontent2">
            <?php 
                if(isset($str) && $str!="")
                    echo $str;
                else
                    echo "<h1 style='margin-left:100px;'>Mã đặt chổ không tồn tại</h1>";
            ?>
       </div>
<!-- Modal -->
<div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">The Spa at Thorpe Park Hotel & Spa, a Shire Hotel</h4>
      </div>
      <div class="modal-body">
      	<div class="product-top-box box-padding">
        	<h1 class="title">Afternoon Tea and Pamper Spa Day
            	<div class="wrap-button-like"><iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.aotambikini.com&amp;layout=button_count&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;" style="overflow:hidden;width:100%;height:80px;" scrolling="no" frameborder="0" allowtransparency="true"></iframe></div>
            </h1>
            <div class="shop-location">Penrith, Cumbria, UK</div>
            <div class="wrap-2cols spa-detail-popup">
            	<div class="col-content">
                	<div class="content">
                    	<div id="product-banner-popup">
                   	    	<img src="images/images.jpg" width="980" height="400" /> 
                        </div>
                        
                        <div class="" style="background:white; color:black; padding:10px;">
                        	<ul class="nav nav-tabs" role="tablist">
                              <li class="active"><a href="#overview-popup" role="tab" data-toggle="tab">Detail</a></li>                          
                              <li><a href="#reviews-popup" role="tab" data-toggle="tab">Reviews</a></li>
                              <li><a href="#venue-popup" role="tab" data-toggle="tab">About Venue</a></li>
                            </ul>
                            
                            <div class="tab-content">
                              <div class="tab-pane active" id="overview-popup">
                                    <h3>Introduction</h3>
                                    <p>Lift your spirits without lifting a finger. Make time to dissolve stress and supercharge your senses - rejuvenate and renew with a therapeutic facial or cocoon yourself in a tranquil body wrap. We use the best spa treatment and beauty products from the internationally acclaimed ESPA range - including natural oils, revitalising seaweeds and marine algae.
    North Lakes physiotherapy specialises in a variety of musculoskeletal and soft tissue treatments including: Manual techniques...</p>
    
                              </div>
                              
                              <div class="tab-pane" id="venue-popup">
                                <h3 class="section-title-filter">THE SPA AT NORTH LAKES HOTEL</h3>
                                    Ullswater Road,<br>
                                    Penrith, Cumbria, Lake District, CA11 8QT <br>
                                    United Kingdom<br>
                                    <div class="wrap-shop-map">
										<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script><div style="overflow:hidden;height:268px;width:100%;"><div id="gmap_canvas-popup" style="height:268px;width:100%;"></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style><a class="google-map-code" href="http://www.trivoo.net" id="get-map-data">www.trivoo.net</a></div><script type="text/javascript"> function init_map(){var myOptions = {zoom:15,center:new google.maps.LatLng(10.7578883,106.67340769999998),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas-popup"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(10.7578883, 106.67340769999998)});infowindow = new google.maps.InfoWindow({content:"<b>An Dong Market</b><br/>18 An Duong Vuong<br/> Ho Chi Minh" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
                                    </div>
                                    
                                    <div class="wrap-method-contact">
                                        <dl class="dl-horizontal">
                                          <dt><img src="images/icon-tel.png" width="21" height="21" alt="Telephone"></dt>
                                          <dd>01768867414</dd>
                                          <dt><img src="images/icon-email.png" width="21" height="21" alt="Email"></dt>
                                          <dd>Contact@email.com</dd>
                                          <dt><img src="images/icon-hand.png" width="21" height="21" alt="Website"></dt>
                                          <dd><a href="http://www.websiteurl.com" target="_blank">www.websiteurl.com</a></dd>
                                        </dl>
                                    </div>
                                  <h3 class="section-title-filter">Opening Hours</h3>
                                    <table width="100%" border="0" cellspacing="2" cellpadding="2" style="margin-bottom:20px;">
                                      <tbody><tr>
                                        <td nowrap="nowrap">MON-FRI</td>
                                        <td width="100%" align="right">9:00 am - 7:00 pm</td>
                                      </tr>
                                      <tr>
                                        <td nowrap="nowrap">SAT</td>
                                        <td width="100%" align="right">9:00 am - 7:00 pm</td>
                                      </tr>
                                      <tr>
                                        <td nowrap="nowrap">SUN</td>
                                        <td width="100%" align="right">9:00 am - 7:00 pm</td>
                                      </tr>
                                    </tbody></table>
                                    
                                    <div class="booking-option">
                                        <dl class="dl-horizontal">
                                          <dt><img src="images/icon-mouse.png" width="45" height="44" alt="Accept Online Booking"></dt>
                                          <dd>Accept Online Booking</dd>
                                          <dt><img src="images/icon-ticket.png" width="45" height="44" alt="Accepts eVouchers"></dt>
                                          <dd>Accepts eVouchers</dd>
                                          <dt><img src="images/icon-no-gift.png" width="45" height="44" alt="no gift voucher"></dt>
                                          <dd>Wahanda gift voucher not accepted</dd>
                                        </dl>
                                    </div>
                              </div>
                              
                              <div class="tab-pane" id="reviews-popup">
                                    <h3>Reviews</h3>
                                    <button class="btn btn-default pull-right" onclick="$('#wrap-add-comment-popup').toggle(300);">Write a review</button>
                                    
                                    <div id="wrap-add-comment-popup" style="display: none" class="wrap-add-comment">
                                        <form role="form">
                                            <div class="form-group">
                                                <label>Nội dung bình luận</label>
                                                <textarea class="form-control" rows="3"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-default pull-right">Gửi bình luận</button>
                                        </form>
                                    </div>  
                                
                                    <div class="wrap-review-list">
                                        <div class="wrap-2cols nav-left wrap-review">
                                            <div class="col-nav">
                                                <div class="wrap-thumb" style="background-image:url(images/no-pic-avatar.png);"> </div>
                                            </div>
                                            <div class="col-content">
                                                <div class="content">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                                      <tbody><tr>
                                                        <td><strong>User name</strong></td>
                                                        <td align="right"><span class="small">Posted 4 weeks ago</span></td>
                                                      </tr>
                                                      <tr>
                                                        <td>&nbsp;</td>
                                                        <td align="right"><small class="small">Visisted October 2014</small></td>
                                                      </tr>
                                                      <tr>
                                                        <td colspan="2">
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse auctor, ipsum facilisis iaculis venenatis, tellus dolor consectetur enim, et semper nisl tortor ut erat.
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td colspan="2" align="right"><a href="javascript:void(0)" onclick="$('#wrap-add-comment2-popup').toggle(300);">Comment</a></td>
                                                      </tr>
                                                      <tr>
                                                        <td colspan="2">
                                                            <div id="wrap-add-comment2-popup" style="display: none" class="wrap-add-comment">
                                                                <form role="form">
                                                                    <div class="form-group">
                                                                        <label>Nội dung bình luận</label>
                                                                        <textarea class="form-control" rows="3"></textarea>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-default pull-right">Gửi bình luận</button>
                                                                </form>
                                                              </div>
                                                        </td>
                                                      </tr>
                                                      
                                                    </tbody></table>
            
                                                </div>
                                            </div>
                                        </div>
                                         
                                        <div class="wrap-2cols nav-left wrap-review">
                                            <div class="col-nav">
                                                <div class="wrap-thumb" style="background-image:url(images/no-pic-avatar.png);"> </div>
                                            </div>
                                            <div class="col-content">
                                                <div class="content">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                                      <tbody><tr>
                                                        <td><strong>User name</strong></td>
                                                        <td align="right"><span class="small">Posted 4 weeks ago</span></td>
                                                      </tr>
                                                      <tr>
                                                        <td>&nbsp;</td>
                                                        <td align="right"><small class="small">Visisted October 2014</small></td>
                                                      </tr>
                                                      <tr>
                                                        <td colspan="2">
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse auctor, ipsum facilisis iaculis venenatis, tellus dolor consectetur enim, et semper nisl tortor ut erat.
                                                            <div class="wrap-2cols nav-left wrap-review">
                                                                <div class="col-nav">
                                                                    <div class="wrap-thumb" style="background-image:url(images/no-pic-avatar.png);"> </div>
                                                                </div>
                                                                <div class="col-content">
                                                                    <div class="content">
                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                                                          <tbody><tr>
                                                                            <td><strong>User name</strong></td>
                                                                            <td align="right"><span class="small">Posted 4 weeks ago</span></td>
                                                                          </tr>
                                                                          <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td align="right"><small class="small">Visisted October 2014</small></td>
                                                                          </tr>
                                                                          <tr>
                                                                            <td colspan="2">
                                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse auctor, ipsum facilisis iaculis venenatis, tellus dolor consectetur enim, et semper nisl tortor ut erat.
                                                                            </td>
                                                                          </tr>
                                                                          <tr>
                                                                            <td colspan="2" align="right"><a href="javascript:void(0)">Comment</a></td>
                                                                          </tr>
                                                                        </tbody></table>
                                
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                      </tr>
                                                    </tbody></table>
            
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wrap-2cols nav-left wrap-review">
                                            <div class="col-nav">
                                                <div class="wrap-thumb" style="background-image:url(images/no-pic-avatar.png);"> </div>
                                            </div>
                                            <div class="col-content">
                                                <div class="content">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                                      <tbody><tr>
                                                        <td><strong>User name</strong></td>
                                                        <td align="right"><span class="small">Posted 4 weeks ago</span></td>
                                                      </tr>
                                                      <tr>
                                                        <td>&nbsp;</td>
                                                        <td align="right"><small class="small">Visisted October 2014</small></td>
                                                      </tr>
                                                      <tr>
                                                        <td colspan="2">
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse auctor, ipsum facilisis iaculis venenatis, tellus dolor consectetur enim, et semper nisl tortor ut erat.
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td colspan="2" align="right"><a href="javascript:void(0)">Comment</a></td>
                                                      </tr>
                                                    </tbody></table>
            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                              </div>
                            </div>
                            
                        </div>
                        
                        
                        
                        
                        
                        
                    </div>                	
                </div>
                <div class="col-nav"> 
                	<h2 style="background: grey; padding: 6px; color: white; margin-top: 10px;text-align: center;">Booking Appointment</h2>
                	<div class="the-calendar"></div>
                    <link href="css/jquery.supercal.css" rel="stylesheet">
                    <script src="js/jquery.supercal.js"></script>
            
                    <script>
                        $('.the-calendar').supercal({
                            transition: 'carousel-vertical'
                        });
                    </script>
                    <br /><br />
                    <div class="wrap-schedule">
                    	<table width="100%" border="0" cellspacing="5" cellpadding="5" class="table table-striped table-hover">
                          <tr>
                            <td width="100%"><label><input name="spa-time" type="radio" value="" /> 5:15 PM</label></td>
                            <td class="old-price">120.000d</td>
                            <td class="new-price">90.000d</td>
                          </tr>
                          <tr>
                            <td><label><input name="spa-time" type="radio" value="" /> 5:30 PM</label></td>
                            <td class="old-price">120.000d</td>
                            <td class="new-price">90.000d</td>
                          </tr>
                          <tr>
                            <td><label><input name="spa-time" type="radio" value="" /> 5:45 PM</label></td>
                            <td class="old-price">120.000d</td>
                            <td class="new-price">90.000d</td>
                          </tr>
                          <tr>
                            <td><label><input name="spa-time" type="radio" value="" /> 5:50 PM</label></td>
                            <td class="old-price">120.000d</td>
                            <td class="new-price">90.000d</td>
                          </tr>
                          <tr>
                            <td><label><input name="spa-time" type="radio" value="" /> 5:55 PM</label></td>
                            <td class="old-price">120.000d</td>
                            <td class="new-price">90.000d</td>
                          </tr>
                        </table>

                    </div>
					<button type="button" class="btn btn-default" data-dismiss="modal" style=" margin-bottom:15px;">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" style=" margin-bottom:15px;">Cancel</button>

                </div>                                
            </div>
        </div>
        <div class="clearfix"></div>
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>
  </div>
</div>
<!-- End Modal -->
    
	<!-- InstanceEndEditable -->
    </div>
    
</header>

<?php
     require("footer.php");
 ?> 

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Login</h4>
      </div>
      <div class="modal-body">
      	<div class="row">        	
            <div class="col-md-12">
            
            	<form class="form" role="form">
                	<div class="form-group">
                    <button type="button" class="btn btn-default btn-google" style="width:100%;">Google Account</button>
                  </div>
                  	<div class="form-group">
                    <button type="button" class="btn btn-default btn-facebook" style="width:100%;">Facebook Account</button>
                  </div>
                  <hr />
                  
                  <div class="form-group">
                    Username
                    <div class="input-group">
                      <div class="input-group-addon">@</div>
                      <input class="form-control" type="email" placeholder="Enter email">
                    </div>
                  </div>
                  <div class="form-group">
                    Password
                    <label class="sr-only" for="exampleInputPassword2">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"> Remember me
                    </label>
                  </div>
                  <div class="form-group">
                    <button type="button" class="btn btn-default" onClick="window.location.href = 'user-profile.html';">Sign in</button>
                  </div>
                    <div class="form-group">
                    <a href="#" onClick="window.location.href = 'forgot-pass.html';">Forgot password?</a>
                  </div>
                </form>
            </div>
        </div>
      </div>
</div>
<!-- End Modal -->

<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "42ca428d-6cd0-4b93-b360-fa0d0bfa3696", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script> 
    
</body>
<!-- InstanceEnd --></html>
