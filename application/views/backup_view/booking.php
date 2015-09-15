<!-- Modal -->
<div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">
        <span class="spanSpaName" id="spanSpaNameModalLabelService">
        The Spa at Thorpe Park Hotel & Spa, a Shire Hotel
        </span></h4>
      </div>
      <div class="modal-body">
          <div class="product-top-box box-padding">
            <h1 class="title"><span id="spanProductName">Tea and Pamper Spa Day</span> 
                <div class="wrap-button-like">
                <!--<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.aotambikini.com&amp;layout=button_count&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;" style="overflow:hidden;width:100%;height:80px;" scrolling="no" frameborder="0" allowtransparency="true"></iframe>-->
                <div id="fb-root"></div>
                <div class="fb-like" data-href="<?php echo $link_spainfo; ?>" data-layout="button_count"  data-action="like" data-show-faces="true" data-share="false"></div>
                </div>
            </h1>
            <div class="shop-location"><span id="spanLoactionSpa">Penrith, Cumbria, UK</span></div>
            <div class="wrap-2cols spa-detail-popup">
                <div class="col-content">
                    <div class="content">
                        <div id="product-banner-popup">
                               <img id="imgProductLinks" src="images/images.jpg" width="980" height="400" /> 
                        </div>
                        
                        <div class="" style="background:white; color:black; padding:10px;">
                            <ul class="nav nav-tabs" role="tablist">
                              <li class="active"><a href="#overview-popup" role="tab" data-toggle="tab">Detail</a></li>                          
                              <li><a href="#reviews-popup" role="tab" data-toggle="tab">Reviews</a></li>
                              <li><a href="#venue-popup" role="tab" data-toggle="tab">About Venue</a></li>
                            </ul>
                            
                            <div class="tab-content">
                              <div class="tab-pane active" id="overview-popup">
                                    <input type="text" id="txtProductID" style="display: none;" value="" />
                                    <h3>Giá dịch vụ: <span class="spanProductPrice"></span></h3>
                                    <h3>Thông tin dịch vụ</h3>
                                    <p id="divProductDetail0">Lift your spirits without lifting a finger. Make time to dissolve stress and supercharge your senses - rejuvenate and renew with a therapeutic facial or cocoon yourself in a tranquil body wrap. We use the best spa treatment and beauty products from the internationally acclaimed ESPA range - including natural oils, revitalising seaweeds and marine algae.
    North Lakes physiotherapy specialises in a variety of musculoskeletal and soft tissue treatments including: Manual techniques...</p>
                                    <h3>Chính sách dịch vụ</h3>
                                    <p id="divProductDetail1">Lift your spirits without lifting a finger. Make time to dissolve stress and supercharge your senses - rejuvenate and renew with a therapeutic facial or cocoon yourself in a tranquil body wrap. We use the best spa treatment and beauty products from the internationally acclaimed ESPA range - including natural oils, revitalising seaweeds and marine algae.
    North Lakes physiotherapy specialises in a variety of musculoskeletal and soft tissue treatments including: Manual techniques...</p>
                                    <h3>Các điều khoản khác</h3>
                                    <p id="divProductDetail2">Lift your spirits without lifting a finger. Make time to dissolve stress and supercharge your senses - rejuvenate and renew with a therapeutic facial or cocoon yourself in a tranquil body wrap. We use the best spa treatment and beauty products from the internationally acclaimed ESPA range - including natural oils, revitalising seaweeds and marine algae.
    North Lakes physiotherapy specialises in a variety of musculoskeletal and soft tissue treatments including: Manual techniques...</p>
                                    <h3>Tips</h3>
                                    <p id="divProductDetail3">Lift your spirits without lifting a finger. Make time to dissolve stress and supercharge your senses - rejuvenate and renew with a therapeutic facial or cocoon yourself in a tranquil body wrap. We use the best spa treatment and beauty products from the internationally acclaimed ESPA range - including natural oils, revitalising seaweeds and marine algae.
    North Lakes physiotherapy specialises in a variety of musculoskeletal and soft tissue treatments including: Manual techniques...</p>
                              </div>
                              
                              <div class="tab-pane" id="venue-popup">
                                <h3 class="section-title-filter"><span class="spanSpaName">THE SPA AT NORTH LAKES HOTEL</span></h3>
                                    <span class="spanSpaAddress">Ullswater Road,</span><br>                                   
                                    <span class="spanLoactionSpa">UK</span><br>
                                    <div class="wrap-shop-map">
                                        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>                                        <div style="overflow:hidden;height:268px;width:100%;">
                                            <div id="gmap_canvas-popup" style="height:268px;width:100%;">
                                            </div>
                                        <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
                                    </div>
                                    <script type="text/javascript"> 
                                    function init_map(_x,_y,_content){
                                        var myOptions = {
                                            zoom:15,
                                            center:new google.maps.LatLng(_x,_y),
                                            mapTypeId: google.maps.MapTypeId.ROADMAP
                                        };
                                        map = new google.maps.Map(document.getElementById("gmap_canvas-popup"), myOptions);
                                        marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(_x, _y)});
                                        infowindow = new google.maps.InfoWindow({content: _content });
                                        google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});
                                        infowindow.open(map,marker);
                                    }
                                    google.maps.event.addDomListener(window, 'load', init_map);
                                    </script>
                                </div>
                                    
                                    <div class="wrap-method-contact">
                                        <dl class="dl-horizontal">
                                          <dt><img src="<?php echo base_url('resources/front/images/icon-tel.png'); ?>" width="21" height="21" alt="Telephone"></dt>
                                          <dd><span class="spanSpaTel">01768867414</span> </dd>
                                          <dt><img src="<?php echo base_url('resources/front/images/icon-tel.png'); ?>" width="21" height="21" alt="Email"></dt>
                                          <dd><span class="spanSpaEmail"></span> </dd>
                                          <dt><img src="<?php echo base_url('resources/front/images/icon-hand.png'); ?>" width="21" height="21" alt="Website"></dt>
                                          <dd><a href="#" target="_blank" class="spanSpaWebsite"> <span class="spanSpaWebsite">www.websiteurl.com</span> </a></dd>
                                        </dl>
                                    </div>
                                  <h3 class="section-title-filter">Opening Hours</h3>
                                    <table id="tableSpaWorkingTime" width="100%" border="0" cellspacing="2" cellpadding="2" style="margin-bottom:20px;">
                                      <tbody>
                                      <tr><td nowrap="nowrap">MON-FRI</td> <td width="100%" align="right">9:00 am - 7:00 pm</td></tr>
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
                                                <div class="wrap-thumb" style="background-image:url(<?php echo base_url('resources/front/images/no-pic-avatar.png'); ?>);"> </div>
                                            </div>
                                            <div class="col-content">
                                                <div class="content">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                                      <tbody>
                                                      <tr>
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
                                                <div class="wrap-thumb" style="background-image:url(<?php echo base_url('resources/front/images/no-pic-avatar.png'); ?>);"> </div>
                                            </div>
                                            <div class="col-content">
                                                <div class="content">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                                      <tbody><tr>
                                                        <td><strong>User name 1</strong></td>
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
                                                                    <div class="wrap-thumb" style="background-image:url(<?php echo base_url('resources/front/images/no-pic-avatar.png'); ?>);"> </div>
                                                                </div>
                                                                <div class="col-content">
                                                                    <div class="content">
                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                                                          <tbody><tr>
                                                                            <td><strong>User name 1 1</strong></td>
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
                                                                        </tbody>
                                                                        </table>
                                
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
                                                <div class="wrap-thumb" style="background-image:url(<?php echo base_url('resources/front/images/no-pic-avatar.png'); ?>);"> </div>
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
                    <h2 style="background: #0088cc; padding: 6px; color: white; margin-top: 10px;text-align: center;">Booking Appointment</h2>
                    <div id="divTheCalendar" class="the-calendar"></div>
                    <link href="<?php echo base_url('resources/front/css/jquery.supercal.css'); ?>" rel="stylesheet">
                    <script src="<?php echo base_url('resources/front/js/jquery.supercal.js'); ?>"></script>
            
                    <script>
                        $('.the-calendar').supercal({
                            transition: 'carousel-vertical'
                        });
                    </script>
                    <br /><br />
                    
                    <div class="wrap-times">
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>                              
                                <input readonly="readonly" id="txtSelectedDay" class="form-control" type="text" value="20/12/2014">
                                
                                <input id="txtSelectecHour" type="text" value="09:00" readonly="readonly" class="form-control"  />
                              
                            </div>
                        </div>
                        <ul id="ulListTimeOfProduct"  >
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('09:00');">09:00</a></li>
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('09:30');">09:30</a></li>
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('10:00');">10:00</a></li>
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('10:30');">10:30</a></li>
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('11:00');">11:00</a></li>
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('11:30');">11:30</a></li>
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('12:00');">12:00</a></li>
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('12:30');">12:30</a></li>
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('13:00');">13:00</a></li>
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('13:30');">13:30</a></li>
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('14:00');">14:00</a></li>
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('14:30');">14:30</a></li>
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('15:00');">15:00</a></li>
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('15:30');">15:30</a></li>
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('16:00');">16:00</a></li>
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('16:30');">16:30</a></li>
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('17:00');">17:00</a></li>
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('17:30');">17:30</a></li>
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('18:00');">18:00</a></li>
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('18:30');">18:30</a></li>
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('19:00');">19:00</a></li>
                            <li><a href="javascript:void(0);" onclick="selectHourProduct('19:30');">19:30</a></li>
                        </ul>
                    </div>
                    
                    <button  id="buttonBookProduct" onclick="" type="button" class="btn btn-default DaChonNgay"  style="width:100%; margin-bottom:15px;">BOOK NOW</button>

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