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
        
        <!--tao datetimepicker-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/datetimepicker/tcal.css'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/css/jquery-ui-1.8.16.custom.css'); ?>" />
        <script type="text/javascript" src="<?php echo base_url('public/datetimepicker/tcal.js'); ?>"></script> 
        <!--end tao datetimepicker-->
        
        <title>Spa Booking Nhập Liệu Spa</title>
        <link rel="stylesheet" href="<?php echo base_url('resources/css/reset.css'); ?>" type="text/css" media="screen" />
      
        <link rel="stylesheet" href="<?php echo base_url('resources/css/style.css'); ?>" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url('resources/css/products.css'); ?>" type="text/css" media="screen" />
        
        <link rel="stylesheet" href="<?php echo base_url('resources/css/invalid.css'); ?>" type="text/css" media="screen" />    
        
        <!-- jQuery -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery-1.8.2.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery-ui.custom.js'); ?>"></script>
        <script src="<?php echo base_url('resources/front/js/common.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/menu.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/ckeditor/ckeditor.js'); ?>"></script> 
        <script type="text/javascript" src="<?php echo base_url('public/datetimepicker/jquery-ui-timepicker-addon.js'); ?>"></script> 
        <script type="text/javascript" src="<?php echo base_url('public/datetimepicker/jquery-ui-sliderAccess.js'); ?>"></script> 
        <script type="text/javascript" src="<?php echo base_url('public/datetimepicker/script.js'); ?>"></script>
        <!-- jQuery Configuration -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/simpla.jquery.configuration.js'); ?>"></script>
        
        <!-- Facebox jQuery Plugin -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/facebox.js'); ?>"></script>
        
        <!-- jQuery WYSIWYG Plugin -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.wysiwyg.js'); ?>"></script>
        
        <!-- jQuery Datepicker Plugin -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.datePicker.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.date.js'); ?>"></script>
        
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.tmpl.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.number.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/Upload.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/goldhouredit.js'); ?>"></script>
        
        <!--[if IE]><script type="text/javascript" src="resources/scripts/jquery.bgiframe.js"></script><![endif]-->
        
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
        <div class="clear"></div> <!-- End .clear -->
            <div class="content-box" style="display:block;"><!-- Start Content Box -->
                <div class="content-box-header">
                    <h3>Quản lý khuyến mãi SPA</h3>
                    <ul class="content-box-tabs">
                        <li><a href="#tab2" id="prinsert">Chỉnh sửa khuyến mãi</a></li>
                    </ul>
                    <div class="clear"></div>
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">           
                    <!-------------THEM SAN PHAM--------------->
                    <!-------------THEM SAN PHAM--------------->
                    <div class="tab-content default-tab" id="tab2">
                        <form id="form_insert"> 
                            <fieldset> 
                            <table width="100%" >
                                <tr>
                                    <td>
                                        <label>Mã khuyến mãi</label>              
                                        <input id="txtPromotionID" type="text" readonly="readonly" value="<?php echo $promo[0]->PromotionId;?>" class="text-input medium-input" />
                                    </td>
                                    <td>
                                         <label>Tên khuyến mãi</label>
                                         <input id="txtPromotionName" type="text"   class="text-input medium-input"  value="<?php echo $promo[0]->PromotionName; ?>"/>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        <label>Bắt đầu khuyến mãi</label>
                                        <input class="text-input small-input" value="<?php echo date('Y-m-d',strtotime($promo[0]->BeginDateTime));?>" readonly="readonly"   type="text" id="BeginTime" name="ValidTimeFrom" />
                                        <input type="text" value="<?php echo date('H:i',strtotime($promo[0]->BeginDateTime));?>" id="beginhours" name="basic_example_2" class="text-input small-input"/>
                    
                                    </td>
                                    <td>
                                        <label>Kết thúc khuyến mãi</label>
                                        <input class="text-input small-input " value="<?php echo date('Y-m-d',strtotime($promo[0]->EndDateTime));?>" readonly="readonly"  type="text" id="EndTime" name="ValidTimeTo" />
                                        <input type="text" value="<?php echo date('H:i',strtotime($promo[0]->EndDateTime));?>" id="endhours" name="basic_example_2" class="text-input small-input"/>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="2">
                                    <label>Thông tin khuyến mãi</label>
                                    <textarea class="text-input textarea ckeditor" id="txtInfo" name="txtInfo" cols="79" rows="12">
                                    <?php echo $promo[0]->PromoText; ?>
                                    </textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>    
                                         <label>Giởi mail</label>
                                         <input type="radio" name="send_mail" id="send_yes" value="1" <?php echo ($promo[0]->PrintToBill == 1)?"checked":"";?> />Có
                                         <input type="radio" name="send_mail"  id="send_no" value="0" <?php echo ($promo[0]->PrintToBill == 0)?"checked":"";?>/>Không              
                                    </td>
                                    
                                </tr>
                            </table>
                            <p>
                        <input class="button" id="btnthemPromo" name="btnthemPro" type="button" value="Cập nhật" onclick="CapnhatPromotion();" />
                            </p>  
                            </fieldset>
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                        </form>
                        <div class="notification success png_bg ThemThanhCong" style="display: none;">
                            <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification " alt="close" /></a>
                            <div>
                               Cập nhật khuyến mãi sản phẩm thành công !
                            </div>
                        </div>
                        
                        <div class="notification error png_bg ThemThatBai" style="display: none;">
                            <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                            <div>
                                Cập nhật khuyến mãi sản phẩm không thành công!
                            </div>
                        </div>


<!-- start up load hinh anh -->                        
<div id="UploadHinhAnh" class="class_ThemThanhCong" style="">                
    <div class="content-box-header" ><h3>Vui lòng chọn hình ảnh cho khuyến mãi</h3></div>          
        <div class="content-box-content">    
            <div class="tab-content default-tab">
                <form role="form" action="#" method="post" enctype="multipart/form-data" >
                <div class="form-group">
                    <input type="file" class="form-control" name="myfile" id="myfile" multiple>
                  </div>      
                  <input type="button" class="btn btn-default" value="Upload" onclick="return doUpload1('<?php echo base_url('/admin/goldhour/UploadFile/')  ?>');" />
                  <input type="button" class="btn btn-default" value="Cancle" onclick="cancleUpload();"/>
                </form>
                <hr>
                <div id="progress-group">
                    <div class="progress">
                      <div class="progress-bar" style="width: 60%;">
                        Tên file ở đây
                      </div>
                      <div class="progress-text">
                          Tiến trình ở đây
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar" style="width: 40%;">
                        Tên file ở đây
                      </div>
                      <div class="progress-text">
                          Tiến trình ở đây
                      </div>
                    </div>
                </div>
              <div class="clear"></div>
              <input type="hidden" id="didUrlImage"/>
                <p>
                  <input  id ="" class="button" name="btnthem" type="button" value="Xem lai hinh da upload" onclick="XemLaiHinhDaUp();" />
                </p> 
              <div id="divXemLaiHinhDaUp" style="display: none;">
              <?php
                echo "<div style=\"float: left;\">";
                for($i=0;$i<count($listimage);$i++)    
                {
                    echo "<div id=\"divLinks" . $listimage[$i]->id . "\" style=\"padding: 10px; float: left\">";
                    echo "<img src=\"/nhaplieuspa/" . $listimage[$i]->URL . "\" width=\"180\"/>";
                    echo "<a href=\"javascript:void(0);\" onclick=\"XoaHinhProduct('" . $listimage[$i]->id . "');\">Xóa</a>";
                    echo "</div>";
                }
                echo "</div>";
             ?>
              </div>
            </div> 
       </div>                                                    
</div> <!-- End hinh anh upload-->    
 
<!-- start chọn spa cho KM-->
<div id="divChooseSpa"  class="class_ThemThanhCong" style="">                
    <div class="content-box-header" ><h3>Vui lòng chọn sản phẩm cho khuyến mãi</h3></div>     
        <div class="content-box-content">    
            <div class="tab-content default-tab">
                <form role="form" action="#" method="post" enctype="multipart/form-data" >
                    <table>
                        <tr>
                            <td>
                                 <label>Chọn SPA khuyến mãi</label>
                                 <a href="javascript:void(0);" class="button" onclick="ChonSpaThemMoi();" >Chọn spa</a><br />
                              <div class="divSpaDetail">
                                 <b>Mã spa:</b> <span id="spanSpaChonTab2" class="spanSpaChonTab2"></span><br /> 
                                 <b>Tên spa:</b><span id="spanSpaNameChonTab2"></span> 
                              </div>
                                 <br />
                                 
                            </td>
                            <td style="display:none" id="tdChooseProductSpa">
                                 <label>Chọn sản phẩm cho spa</label>
                                 <a href="javascript:void(0);" class="button" onclick="ChonSpaProductThemMoi();" >Chọn sản phẩm</a><br />
                                 <div class="divSpaDetail">
                                     <b>Mã sản phẩm:</b> <span id="spanProductSpaChon" class="spanSpaChonTab2"></span> <br />
                                     <b>Tên sản phẩm:</b><span id="spanPrdouctNameChon"></span><br />
                                     <b>Giá mới nhất SP:</b><span id="spaProductPrice" class="SpanNumber"></span> 
                                 </div>
                                 <br />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Phần trăm khuyến mãi</label>
                                <input id="txtPromotionPrice" type="text" class="text-input small-input"  />
                            </td>
                            <td>
                                <label>Số lượng</label>
                                <input id="txtQuantity" type="text" class="text-input small-input" value="1" readonly="readonly" />
                            </td>
                        </tr>
                    </table>
                     <p>
                        <input class="button" id="btnthemPromoPro" name="btnthemPro" type="button" value="Cập nhật" onclick="ThemMoiProductSpa();" />
                            </p> 
                </form>
                <div id="divmessageSucess" class="notification success png_bg ThemThanhCong" style="display: none;">
                    <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification " alt="close" /></a>
                    <div>
                       Cập nhật sản phẩm khuyến mãi của spa thành công !
                    </div>
                </div>
                        
            <div id="divmessageError" class="notification error png_bg ThemThatBai" style="display: none;">
                <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                <div>
                    Cập nhật sản phẩm khuyến mãi của spa không thành công !
                </div>
            </div>
            <div id="divShowListProduct">
                <table id="tbShowListProductPromo" style="">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã sản phẩm</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Đơn giá</th>                    
                            <th>Số lượng</th>
                            <th>Thanh tiền</th>
                            <th>Thao tac</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                            echo $listpro;
                        ?> 
                    </tbody>        
                </table>
                 <input type="button" class="button" value="Cập nhật" id="btn_CapNhat" onclick="LuuCapNhatPromo();" />
            </div>
            <input onclick="BackToGoldhour();" value="Quay lại" type="button">
        </div>
    </div>
</div>

<!-- end chọn spa cho KM-->                      
          
</div>  
<!-------------END THEM SAN PHAM--------------->
<!-------------END THEM SAN PHAM--------------->
</div> <!-- End .content-box-content -->
</div>
            <?php
                $this->load->view($lang.'/admin/footer.php');
            ?>    
</div> <!-- End #main-content -->

<!-- search danh sách spa  27/11/2014 -->
<div style="display:none;width:800px;height:600px;" id="divSearchSpaTab2" >
        <span>Tên SPA: </span><br />
        <input type="text" id="txtSpaNameTab2"/>        
        <br />
        <input type="button" value="Tìm SPA" onclick="SearchSPATab2(1);"/>
        <span id="spanKQTimTab2"></span>
        <br /><br />

        <table class="table-fill" id="panelDataSPATab2"  width="100%">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã SPA</th>
                    <th>TTin SPA</th>                    
                    <th>Chọn</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>        
        </table>
         <script id="ListFoundSPATab2" type="text/x-jquery-tmpl" >        
            <tr id="trSPA${spaID}">
                    <td>${STT}</td>
                    <td>${spaID}</td>
                    <td>
                        Tên Spa: <span>${spaName}</span> <br />
                        Địa chỉ: ${Address} <br />
                        ĐT: ${Tel} <br />
                    </td>
                    <td><a href="javascript:void(0);" onclick="ChonSpaTab2('${spaID}');" >Chọn</a></td>
                </tr>
         </script>
        <div id="DivPhanTrangSPATab2" style="margin:0;text-align:right;padding:0; margin-right:10px;">         
        Trang số:
        <select id="cboPageNoSPATab2" style="width:35px;" onchange="SearchSPACBBTab2();">
            <option>1</option>
            <option>2</option>
        </select>
    </div>        

</div>
<!-- end search danh sách spa -->   
    
    </div>

<!-- search danh sách sản phẩm của spa -->
 <div id="divsearchProductSpa" style="display:none;width:800px;height:600px;">
     <span>Tên sản phẩm: </span><br />
        <input type="text" id="txtProductNameTab2"/>          
        <br />
        <input type="button" value="Tìm sản phẩm" onclick="SearchProductSpa(1);"/>
        <span id="spanKQTimProTab2"></span>
        <br /><br />

        <table class="table-fill" id="panelDataSPAProduct"  width="100%">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã sản phẩm</th>
                    <th>TTin Sản phẩm</th>                    
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>        
        </table>
         <script id="ListFoundPRO" type="text/x-jquery-tmpl" >        
            <tr id="trProductID${ProductID}">
                                <td>${STT}</td>
                                <td>${ProductID}</td>
                                <td>
                                    Tên DV: <span>${Name}</span> <br />
                                    Thời lượng : ${Duration} giờ
                                    Số chỗ còn lại: ${CurrentVouchers} <br />
                                    Số chỗ tối đa trong 1 thời điểm: ${MaxProductatOnce} <br />
                                    Giá trị từ ngày: ${ValidTimeFrom} <br />
                                    Giá trị đến ngày: ${ValidTimeTo} <br />
                                </td>
                                <td><a href="javascript:void(0);" onclick="ChonSpaProduct('${ProductID}');" >Chọn</a></td>
             </tr>                  
         </script>
        <div id="DivPhanTrangSPAProduct" style="margin:0;text-align:right;padding:0; margin-right:10px;">         
            Trang số:
            <select id="cboPageNoSPAProduct" style="width:35px;" onchange="SearchSPACBBTab2();">
                <option>1</option>
                <option>2</option>
            </select>
        </div>        
</div> 
<!-- end list sản phẩm khuyến mãi -->

    
</body>
     


</html>


                    
?>
