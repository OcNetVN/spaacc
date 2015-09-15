<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- InstanceBeginEditable name="doctitle" -->
	<title>the Booking - Spa - The Garage Spa</title>
    <link rel="icon" href="<?php echo base_url('resources/front/favicon.ico'); ?>" />
    <?php require("head.php"); ?>
    <script src="<?php echo base_url('resources/front/js/productdetail.js'); ?>"></script>
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
          $(document).ready(function(){                 
                $('.product_banner').bxSlider({
                    auto: true       
                  });
                                      
            });
		</script>
    <!-- InstanceEndEditable -->
    
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
    	
        <!-- Modal -->
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    <a href="" id="linkspa">
                    <span class="spanSpaName" id="spanSpaNameModalLabelService">
                        
                    </span>
                    </a>
                </h4>
              </div>
              <div class="modal-body">
                  <div class="product-top-box box-padding">
                    <h1 class="title">
                        <a href="" id="linkproductID" style="color:white;font-weight: bold;">
                            <span id="spanProductName"></span>
                        </a>
                        <div class="wrap-button-like">
                            <div id="fb-root"></div>
                            <div id ="faceboklink" class="fb-like" data-href="" data-layout="button_count"  data-action="like" data-show-faces="true" data-share="false"></div>
                        </div>
                    </h1>
                    <div class="shop-location"><span id="spanLoactionSpa"></span></div>
                    <div class="wrap-2cols spa-detail-popup">
                        <div class="col-content">
                            <div class="content">
                                <div id="product-banner-popup">
                                       <img id="imgProductLinks" src="" width="980" height="400" /> 
                                </div>
                                
                                <div class="" style="background:white; color:black; padding:10px;">
                                    <ul class="nav nav-tabs" role="tablist">
                                      <li class="active"><a href="#overview-popup" role="tab" data-toggle="tab">Chi tiết</a></li>                          
                                      <li><a href="#reviews-popup" role="tab" data-toggle="tab">Đánh giá</a></li>
                                      <li><a href="#venue-popup" role="tab" data-toggle="tab">Thông tin</a></li>
                                      <li><a href="#venue-manual" role="tab" data-toggle="tab">Hướng dẫn đặt chỗ</a></li>
                                    </ul>
                                    
                                    <div class="tab-content">
                                      <div class="tab-pane active" id="overview-popup">
                                            <input type="text" id="txtProductID" style="display: none;" value="" />
                                            <h4>Thời gian dịch vụ: <span class="spanProductDuration">00</span> Phút</h4>
                                            <h4>Giá dịch vụ: <span class="spanProductPrice"></span></h4>
                                            <h4 style="display: none;" id="divsaveprice">Giá khuyến mãi: <span id="spanProductSavePrice"></span></h4>
                                            <h4>Thông tin dịch vụ</h4>
                                            <p id="divProductDetail0"></p>
                                            <h4>Chính sách dịch vụ</h4>
                                            <p id="divProductDetail1"></p>
                                            <h4>Các điều khoản khác</h4>
                                            <p id="divProductDetail2"></p>
                                            <h4>Liệu trình chăm sóc</h4>
                                            <p id="divProductDetail3"></p>
                                      </div>
                                      <div class="tab-pane" id="venue-manual">
                                      <h4> Xem hướng dẫn đặt chỗ tại đây</h4>
                                      <iframe width="650" height="360" src=			"https://www.youtube.com/embed/NClL1y9OmKg?feature=player_embedded" frameborder="0" allowfullscreen></iframe>
                                      </div>
                                      <div class="tab-pane" id="venue-popup">
                                        <h3 class="section-title-filter"><span class="spanSpaName"></span></h3>
                                            <span class="spanSpaAddress">Ullswater Road,</span><br>                                   
                                            <span class="spanLoactionSpa">UK</span><br>
                                            <div class="wrap-shop-map" >
                                                <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor="></script>                                        <div style="overflow:hidden;height:268px;width:100%;">
                                                    <div id="gmap_canvas_popup" style="height:268px;width:480px;">
                                                    </div>
                                                <style>#gmap_canvas img{max-width:480px!important;background:none!important}</style>
                                            </div>
                                            <script type="text/javascript">  
                                            </script>
                                        </div>
                                            
                                            <div class="wrap-method-contact">
                                                <dl class="dl-horizontal">
                                                  <dt><img src="<?php echo base_url('resources/front/images/icon-tel.png'); ?>" width="21" height="21" alt="Telephone"></dt>
                                                  <dd><span class="spanSpaTel"></span> </dd>
                                                  <dt><img src="<?php echo base_url('resources/front/images/icon-tel.png'); ?>" width="21" height="21" alt="Email"></dt>
                                                  <dd><span class="spanSpaEmail"></span> </dd>
                                                  <dt><img src="<?php echo base_url('resources/front/images/icon-hand.png'); ?>" width="21" height="21" alt="Website"></dt>
                                                  <dd><a href="#" target="_blank" class="spanSpaWebsite"> <span class="spanSpaWebsite"></span> </a></dd>
                                                </dl>
                                            </div>
                                          <h3 class="section-title-filter">Opening Hours</h3>
                                            <table id="tableSpaWorkingTime" width="100%" border="0" cellspacing="2" cellpadding="2" style="margin-bottom:20px;">
                                              <tbody>
                                              <tr><td nowrap="nowrap">MON-FRI</td> <td width="100%" align="right"></td></tr>
                                              <tr>
                                                <td nowrap="nowrap">SAT</td>
                                                <td width="100%" align="right"></td>
                                              </tr>
                                              <tr>
                                                <td nowrap="nowrap">SUN</td>
                                                <td width="100%" align="right"></td>
                                              </tr>
                                            </tbody></table>
                                            
                                            <div class="booking-option">
                                                <dl class="dl-horizontal">
                                                  <dt><img src="<?php echo base_url('resources/front/images/icon-mouse.png'); ?>" width="45" height="44" alt="Accept Online Booking"></dt>
                                                  <dd>Accept Online Booking</dd>
                                                  <dt><img src="<?php echo base_url('resources/front/images/icon-ticket.png'); ?>" width="45" height="44" alt="Accepts eVouchers"></dt>
                                                  <dd>Accepts eVouchers</dd>
                                                  <dt><img src="<?php echo base_url('resources/front/images/icon-no-gift.png'); ?>" width="45" height="44" alt="no gift voucher"></dt>
                                                  <dd>TheBooking.vn gift voucher not accepted</dd>
                                                </dl>
                                            </div>
                                      </div>
                                      
                                      <div class="tab-pane" id="reviews-popup">
                                            <h3>Bình luận</h3>
                                            <button class="btn btn-default pull-right" onclick="$('#wrap-add-comment-popup').toggle(300);">Viết đánh giá</button>
                                            
                                            <div id="wrap-add-comment-popup" style="display: none" class="wrap-add-comment">
                                                <form role="form">
                                                    <div class="form-group">
                                                        <label>Nội dung bình luận</label>
                                                        <textarea class="form-control" rows="3" id="ContentCommet"></textarea>
                                                    </div>
                                                    <a  href="javascript:void(0)"  class="btn btn-default pull-right" onclick="SendComment();">Gửi bình luận</a>
                                                    <!--<button type="button" class="btn btn-default pull-right" onclick="SendComment()">Gửi bình luận</button>-->
                                                    <span id="Message_success" style="color: red"></span>
                                                </form>
                                            </div>  
                                        
                                            <div class="wrap-review-list">
                                               
                                               
                                            </div>
                                            
                                            <div class="clearfix"></div>
                                      </div>
                                    </div>
                                    
                                </div>                    
                            </div>                    
                        </div>
                        <div class="col-nav"> 
                            <h2 style="background: #0088cc; padding: 6px; color: white; margin-top: 10px;text-align: center;">Booking Appointment</h2>
                            <div id="divTheCalendar" class="the-calendar"></div>
                            <button id="btnBackToChooseDay" value="Back" style="display: none;" onclick="BackToChooseDay();">Chọn lại ngày</button>
                            <span id="spanNgayDaChon" style="color: blue; font-family: arial; font-size: 13px; font-style: italic;"></span>
                            <link href="<?php echo base_url('resources/front/css/jquery.supercal.css'); ?>" rel="stylesheet">
                            <script src="<?php echo base_url('resources/front/js/jquery.supercal.js'); ?>"></script>
                    
                            <script>
                                $('.the-calendar').supercal({     
                                    transition: 'carousel-vertical'
                                });
                            </script>
                            <br /><br />
                            
                            <div class="wrap-times" class="BackToChooseDay">
                                  <div class="form-group" id="ChooseDateBooking" style="display: none;">
                                    <div class="input-group" style="display: none;">
                                      <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>                              
                                        <input readonly="readonly" id="txtSelectedDay" class="form-control" type="text" value="20/12/2014">
                                        
                                        <input id="txtSelectecHour" type="text" value="09:00" readonly="readonly" class="form-control"  />
                                      
                                    </div>
                                  </div>
                                    <ul id="ulListTimeOfProduct" class="BackToChooseDay" >
                                        
                                    </ul>
                                
                                
                            </div>
                            
                            <input type="hidden" id="promotionid" />
                            <button  id="buttonBookProduct" onclick="" type="button" class="btn btn-default DaChonNgay BackToChooseDay"  style="width:100%; margin-bottom:15px;">BOOK NOW</button>
        
                        </div>                                
                    </div>
                </div>
                <div class="clearfix"></div>
              </div>
        <!-- End Modal -->
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
