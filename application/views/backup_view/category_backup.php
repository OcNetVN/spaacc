<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>the Booking - Spa - Spa Day Booking</title>
    <!-- InstanceEndEditable -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('resources/front/favicon.ico'); ?>">
    <?php require("head.php"); ?>
    <script src="<?php echo base_url('resources/front/js/bootstrap-slider.js'); ?>" type="text/javascript"></script>
    <link href="<?php echo base_url('resources/front/css/slider.css'); ?>" rel="stylesheet" type="text/css" /> 
        
    <script type="text/javascript">
        $(document).ready(function(e) {
            $("#price-range").slider({
            });
            
            $("#amount").val('50k - 10000k');

            $("#price-range").on("slide", function(slideEvt) {
                $("#amount").val(slideEvt.value[0] + "k - " +slideEvt.value[1]+"k");
            });
        });
    </script>
    <script src="<?php echo base_url('resources/front/js/category.js'); ?>" type="text/javascript"></script>
        
<<<<<<< .mine
        
        <script type="text/javascript">
            $(document).ready(function(e) {
                $("#price-range").slider({
                });
                
                $("#amount").val('50k - 10000k');

                $("#price-range").on("slide", function(slideEvt) {
                    $("#amount").val(slideEvt.value[0] + "k - " +slideEvt.value[1]+"k");
                });
                
            });
            
            (function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=328255327368217&version=v2.0";
                  fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <script src="<?php echo base_url('resources/front/js/category.js'); ?>" type="text/javascript"></script>
    <!-- InstanceEndEditable -->
    <link href="<?php echo base_url('resources/front/css/style.css'); ?>" rel="stylesheet" type="text/css" />
=======
>>>>>>> .r831
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
        <h1 class="page-title-bar">AFTERNOON TEA AND PAMPERING EXPERIENCES</h1>
        <div class="wrap-2cols nav-left product-category">
            <div class="col-nav">
                <h2 class="section-title">Filter Search Results</h2>
                <div class="section-filter">
                    <h3 class="section-title-filter">Availability</h3>
                    <div class="filters">
                        <div class="form-group">
                            <div class="input-group">                          
                              <input class="form-control datepicker" type="text" placeholder="Any Date">
                              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                        <div class="form-group">
                             <div class="input-group">                          
                              <input type="text" class="form-control" placeholder="Any Time">
                              <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                            </div>
                        </div>
                        <div class="form-group">
                             <div class="input-group">                          
                              <input type="text" class="form-control" placeholder="Location" id="txtLocationSearch" <?php if(isset($_SESSION['indexsearch']) && $_SESSION['indexsearch']['location']) echo 'value="'.$_SESSION['indexsearch']['location'].'"'; ?>>
                              <span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="section-filter">
                    <h3 class="section-title-filter">Treatment Type</h3>
                    <div class="filters">
                        <?php 
                            if(isset($_SESSION['indexsearch']))
                            {
                                 if(isset($id_chaproducttype) && $id_chaproducttype!="")
                                 {
                                    echo '<div class="radio">';
                                      echo '<label>';
                                        echo '<input name="optionsProductType" type="radio" id="optionsRadios1" onclick="loadloaispcon();" value="0">Any';
                                      echo '</label>';
                                    echo '</div>';
                                 }
                                 else
                                 {
                                    echo '<div class="radio">';
                                      echo '<label>';
                                        echo '<input name="optionsProductType" type="radio" id="optionsRadios1" onclick="loadloaispcon();" value="0" checked="checked">Any';
                                      echo '</label>';
                                    echo '</div>';
                                 }
                                    foreach($ProductTypeCap1 as $pt)
                                     {
                                    ?>
                                    <div class="radio">
                                      <label>
                                        <input type="radio" name="optionsProductType" id="optionsRadios1" onclick="loadloaispcon();" value="<?php echo $pt->CommonId; ?>" <?php if(isset($id_chaproducttype) && $id_chaproducttype!="" && ($id_chaproducttype == $pt->CommonId)) echo 'checked="checked"'; ?>>
                                        <?php
                                             echo $pt->StrValue1;
                                         ?>
                                      </label>
                                    </div>
                                    <?php         
                                         }            
                            }
                            else
                            {
                        ?>
                                <div class="radio">
                                  <label>
                                    <input name="optionsProductType" type="radio" id="optionsRadios1" onclick="loadloaispcon();" value="0" checked="checked">Any
                                  </label>
                                </div>
                                <?php
                                     foreach($ProductTypeCap1 as $pt)
                                     {
                                ?>
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="optionsProductType" id="optionsRadios1" onclick="loadloaispcon();" value="<?php echo $pt->CommonId; ?>">
                                    <?php
                                         echo $pt->StrValue1;
                                     ?>
                                  </label>
                                </div>
                                <?php         
                                     }
                                 ?>
                        <?php        
                            }
                        ?>
                        
                    </div>
                </div>
                <span id="childproducttype" <?php if(!isset($_SESSION['indexsearch'])) echo 'style="display: none;"'; ?>><!--load loai sp con theo loai cha-->
                    <div class="section-filter">
                        <div class="filters">
                        <?php 
                            if(isset($_SESSION['indexsearch']))
                            {
                                if(isset($list_childproducttype) && count($list_childproducttype)>0)
                                {
                                    foreach($list_childproducttype as $row_childproducttype)
                                    {
                                        $check='';
                                        if($id_childproducttype==$row_childproducttype->CommonId)
                                            $check='checked="checked"';
                                        echo '<input type="checkbox" name="childproducttype" class="childproducttype" id="childproducttype_'.$row_childproducttype->CommonId.'" value="'.$row_childproducttype->CommonId.'"  onclick="searchspa();" '.$check.'/>'.$row_childproducttype->StrValue1.'<br />';
                                    }
                                }
                                unset($_SESSION['indexsearch']);
                            }
                        ?>
                        </div>
                    </div>
                </span> <!--end load loai sp con theo loai cha-->
                <?php
                    if(isset($listtienichspa) && count($listtienichspa)>0)
                    {
                ?>
                <div class="section-filter"> <!--tien ich spa-->
                    <h3 class="section-title-filter">Tiện ích Spa</h3>
                    <div class="filters">
                        <?php 
                            foreach($listtienichspa as $row_tienichspa)
                            {
                                echo '<input type="checkbox" name="spafacilities" id="spafacilities_'.$row_tienichspa->CommonId.'" value="'.$row_tienichspa->CommonId.'"  onclick="searchspa();"/>'.$row_tienichspa->StrValue1.'<br />';
                            }
                        ?>
                    </div>
                </div><!--end tien ich spa -->
                <?php } ?>
                <?php
                    if(isset($listloaispa) && count($listloaispa)>0)
                    {
                ?>
                <div class="section-filter"> <!--loai spa spa-->
                    <h3 class="section-title-filter">Loại Spa</h3>
                    <div class="filters">
                        <?php 
                            foreach($listloaispa as $row_loaispa)
                            {
                                echo '<input type="checkbox" name="spatype" id="spatype_'.$row_loaispa->CommonId.'" value="'.$row_loaispa->CommonId.'"  onclick="searchspa();"/>'.$row_loaispa->StrValue1.'<br />';
                            }
                        ?>
                    </div>
                </div><!--end loai spa-->
                <?php } ?>
                
                <div class="section-filter">
                    <h3 class="section-title-filter">Price Range</h3>
                    <div class="filters">
                        <input type="text" id="amount" style="border: 0; color: #f6931f; font-weight: bold;" />
                        
                        <input id="price-range" type="text" value="" data-slider-min="50" data-slider-max="10000" data-slider-step="1" data-slider-value="[50,10000]"/>
                    </div>
                </div>
                
            </div>
            <div class="col-content">
                <div class="content">
                    <div class="row">
                        <div class="col-md-8">
                            Tìm thấy <span id="tongmautin"><?php if(isset($listspa)) echo $listspa['tongmautin']; ?></span> kết quả
                        </div>
                        <div class="col-md-4">
                            <div class="form-horizontal">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Sort by:</label>
                                <div class="col-sm-8">
                                <select class="form-control" id="sesortby">                                  
                                  <?php
                                       foreach($SortBy as $sb)
                                       {
                                           if($sb->CommonId=="01")
                                           {
                                               echo"<option value=\"" .$sb->CommonId."\" selected=\"selected\">".$sb->StrValue1."</option>";
                                           }else
                                           {
                                            echo"<option value=\"" .$sb->CommonId."\">".$sb->StrValue1."</option>";       
                                           }
                                        
                                       }
                                   ?>
                                  
                                </select>
                                </div>
                              </div>
                               </div>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="showlistspa"> <!--load list spa-->
                                  <?php 
                                    if(isset($listspa))
                                    {
                                        echo $listspa['str'];
                                    }
                                  ?>
                            </div><!--end load list spa-->
                        </div>
                    <div class="row">
                  <div class="clearfix"></div>     
                  <div class="row">
                        <div class="col-md-8">
                           
                        </div>
                        <div class="col-md-4">
                            <div class="form-horizontal">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Trang:</label>
                                <div class="col-sm-8">
                                <select id="selPageNo" class="form-control">                                  
                                  
                                  <?php 
                                    if(isset($listspa))
                                    {
                                        $trang=$listspa['sotrang'];
                                        for($i=1;$i<=$trang;$i++)
                                        {
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                    }
                                  ?>                                
                                </select>
                                </div>
                              </div>
                               </div>                            
                        </div>
                    </div>  
                </div>
            </div>
            
        </div>
        </div>
        </div>
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
                    <link href="<?php echo base_url('resources/front/css/jquery.supercal.css'); ?>" rel="stylesheet">
                    <script src="<?php echo base_url('resources/front/js/jquery.supercal.js'); ?>"></script>
            
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
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="width:100%; margin-bottom:15px;" onClick="parent.location='check-out1.html'">BOOK NOW</button>

                </div>                                
            </div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
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

<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "42ca428d-6cd0-4b93-b360-fa0d0bfa3696", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script> 
    
</body>
<!-- InstanceEnd --></html>
