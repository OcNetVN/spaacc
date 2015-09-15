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
   //$lang= 
}
 ?>
 <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        <!--tao datetimepicker-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/datetimepicker/tcal.css'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/css/jquery-ui-1.8.16.custom.css'); ?>" />
        <script type="text/javascript" src="<?php echo base_url('public/datetimepicker/tcal.js'); ?>"></script> 
        <!--end tao datetimepicker-->
        
        <title>Spa Booking Nhập Liệu</title>
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
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/products.js'); ?>"></script>
        
        <!--[if IE]><script type="text/javascript" src="resources/scripts/jquery.bgiframe.js"></script><![endif]-->
        
    </head>
  
    <body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
        
        <div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
            
            <h1 id="sidebar-title"><a href="#">Spa Booking Nhập Liệu</a></h1>
          
            <!-- Logo (221px wide) -->
            <a href="#"><img id="logo" src="<?php echo base_url('resources/images/logo.png'); ?>" alt="Simpla Admin logo" /></a>
          
            <?php
                
                $this->load->view($lang.'/admin/menu1.php');
            ?>  
            
        </div></div> <!-- End #sidebar -->
        
        <div id="main-content"> <!-- Main Content Section with everything -->
            <div class="clear"></div> <!-- End .clear -->
            <div class="content-box" style="display:block;"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <h3>Quản lý dịch vụ SPA</h3>
                    
                    <ul class="content-box-tabs">
                        <li><a href="#tab1" id="prlist" class="default-tab">Tra cứu dịch vụ</a></li> <!-- href must be unique and match the id of target div -->
                        <li><a href="#tab2" id="prinsert">Thêm mới dịch vụ</a></li>
                    </ul>
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        
                        
                        <div class="cpbody" style="" >
                        <table>
                            <tr>
                                <td class="lable_with"><label>Mã DV </label> </td>
                                <td class="col_with">
                                   <input type="text" name="spaProductID" id="txtProductID" class="class-input-text">
                                </td> 
                                <td class="lable_with"><label>Thuộc SPA </label></td>
                                <td class="col_with">                                   
                                    <a href="javascript:void(0);" onclick="SelectSpa();" title="Chọn SPA" class="button">Chọn SPA</a>
                                    <span id="spanSPAList" style="display:none;"></span>
                                    <div id="divChonSpa" style="margin-top:10px;" >
                                        
                                        <!--
                                        <div id="SPA001" class="doituongDIV">
                                            <span>001 - Nguyen Van An</span> 
                                            <a href="javascript:void(0);" onclick="XoaSPA('SPA001');"><img src="resources/images/icons/cross_grey_small.png" height="10" /></a>
                                        </div>
                                        -->
                                    </div>
                                    
                                </td>
                            </tr>
                            <tr>
                               <td class="lable_with"><label>Tên sản phẩm </label></td>
                                <td class="col_with">
                                    <input type="text" name="txtName" id="txtName" class="class-input-text">
                                </td> 
                                <td class="lable_with"><label>Loại sàn phẩm </label></td>
                                <td class="col_with">
                                    <select id="cboProductType" name="cboProductType" style="min-width: 320px;">
                                        <option value="" selected="selected">Vui lòng chọn</option>
                                        <option value="option2">Option 2</option>
                                        <option value="option3">Option 3</option>
                                        <option value="option4">Option 4</option>
                                    </select> 
                                </td>
                            </tr>
                            <tr>
                                <td class="lable_with"><label>Chính Sách </label></td>
                                <td colspan="3">
                                    <input type="text" name="txtPolicy" id="txtPolicy" class="class-input-text">   
                                </td>
                            </tr>
                            <tr>
                                <td class="lable_with"><label>Mô tả </label></td>
                                <td colspan="3">
                                    <input type="text" name="txtDescription" id="txtDescription" class="class-input-text">  
                                </td>
                            </tr>
                        </table>
                </div>
                <div  > 
                <input type="button" class="button " value="Search" onclick="searchProducts(1);"  style="width:100px;height:30px;" >
                <input type="button" class="button " value="Reset" onclick="Reset();"  style="width:100px;height:30px;" >
                
                </div>
                <div id="divTBKQTim" style="margin-top: 10px; display: none;" class="notification success png_bg">
                    <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                    <div>
                       Tìm được 20 mẫu tin!!!
                    </div>
                </div>        
                        <table id="panelDataPRO" style="display: none;" class="tableborder">                            
                            <thead>
                                <tr>
                                   <th>STT</th>
                                   <th>Mã dịch vụ</th>
                                   <th>Thông tin dịch vụ</th>
                                   <th>Thông tin số chỗ</th>
                                   <th>TTin khời tạo</th>
                                   <th>Thao tác</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div>
                                            Trang so: 
                                            <select id="cboPageNoPRO">
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                            
                        </table>
                        
                    </div> <!-- End #tab1 -->
                    
                    <!-------------THEM SAN PHAM--------------->
                    <!-------------THEM SAN PHAM--------------->
                    <div class="tab-content" id="tab2">
                    
                        <form id="form_insert">
                            
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                            <table width="100%" >
                                <tr>
                                    <td>
                                        <label>Mã dịch vụ :</label>              
                                        <input id="txtProductIDTab2" type="text" readonly="readonly" value="" class="text-input medium-input" />
                                    </td>
                                    <td>
                                        <label>Tên dịch vụ</label>
                                        <input class="text-input medium-input" type="text" id="txtNameTab2" name="txtNameTab2" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                         <label>Chọn SPA cung cấp<span style="color: red;">(*)</span></label>
                                         <a href="javascript:void(0);" class="button" onclick="ChonSpaThemMoi();" >Chọn spa</a>
                                         Mã spa: <span id="spanSpaChonTab2" class="spanSpaChonTab2"></span> 
                                         <span id="spanSpaNameChonTab2"></span> 
                                         <a href="javascript:void(0);" onclick="ShowSpaDetailTab2()">xem chi tiết</a><br />
                                         <div id="divShowChiTietSpa" class="divSpaDetail" style="display: none;" ></div>
            
                                         <br />
                                         
                                    </td>
                                </tr>
                                <tr><td colspan="2"><label>Chọn nhóm khuyến mãi</label><input type="checkbox"  id="checkpromotion"/></td></tr>
                                <tr>
                                    <td colspan="2">
                                    <label>Mô tả dịch vụ</label>
                                    <textarea class="text-input textarea ckeditor" id="txtDescriptionTab2" name="txtDescriptionTab2" cols="79" rows="12"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>    
                                         <label>Trạng thái</label>              
                                        <select name="Status" id="cboStatusTab2" class="small-input">
                                            <option value="0">Khóa </option>
                                            <option value="1">Đang hoạt động </option>
                                            <option value="2">Hết hạn </option>
                                        </select>
                                    </td>
                                    <td>
                                        <label>Loại dịch vụ<span style="color:red;">(*)</span></label>              
                                        <select name="ProductType" id="cboProductTypeTab2" class="" style="width: 350px;">
                                            <optgroup label="Swedish Cars">
                                                <option value="volvo">Volvo</option>
                                                <option value="saab">Saab</option>
                                              </optgroup>
                                              <optgroup label="German Cars">
                                                <option value="mercedes">Mercedes</option>
                                                <option value="audi">Audi</option>
                                              </optgroup>
                                        </select> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                         <p>
                                            <label>Số chỗ còn trống </label>
                                            <input class="text-input small-input" type="text" id="CurrentVouchersTab2" name="CurrentVouchers" />
                                        </p>
                                        <p>
                                            <label>Thời lượng </label>
                                            <input class="text-input small-input" type="text" id="DurationTab2" name="Duration" /> Phút
                                        </p>
                                        <p>
                                            <label>Số chỗ tối đa trong 1 thời điễm</label>
                                            <input class="text-input small-input" type="text" id="MaxProductatOnceTab2" name="MaxProductatOnce" />
                                        </p>
                                    </td>
                                    <td>
                                         <p>
                                            <label>Bắt đầu từ lúc</label>
                                            <input class="text-input small-input tcal" type="text" id="ValidTimeFromTab2" name="ValidTimeFrom" />
                                        </p>
                                        <p>
                                            <label>Kết thúc vào lúc</label>
                                            <input class="text-input small-input tcal" type="text" id="ValidTimeToTab2" name="ValidTimeTo" />
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <p>
                                            <label>Chính sách của dịch vụ</label>                                            
                                            <textarea class="ckeditor" id="txtPolicyTab2" name="txtPolicyTab2" cols="79" rows="10"></textarea>
                                        </p>
                                        <p>
                                            <label>Một số điều khoản cấm</label>
                                            
                                            <textarea class="ckeditor" id="txtRestrictionTab2" name="txtPolicyTab2" cols="79" rows="8"></textarea>
                                        </p>
                                        <p>
                                            <label>Hướng dẫn </label>
                                            
                                            <textarea class="ckeditor" id="txtTipsTab2" name="txtTipsTab2" cols="79" rows="5"></textarea>
                                        </p>
                                        <p>
                                            <label>Giá cơ bản <span style="color: red;">(*)</span></label>
                                            <input class="text-input small-input" type="text" id="PriceTab2" name="Price" />
                                        </p>
                                        <p>
                                            <input class="button" id="btnthemPro" name="btnthemPro" type="button" value="Them moi" onclick="ThemMoiProducts();" />
                                        </p>
                                    </td>
                                </tr>
                            </table>
                                
                            </fieldset>
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                        </form>
                        <div class="notification success png_bg ThemThanhCong" style="display: none;">
                            <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification " alt="close" /></a>
                            <div>
                               Thêm mới sản phẩm thành công !
                            </div>
                        </div>
                        
                        <div class="notification error png_bg ThemThatBai" style="display: none;">
                            <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                            <div>
                                Thêm mới sản phẩm không thành công!
                            </div>
                        </div>
                        
                        
                        <div id="UploadHinhAnh" class="ThemThanhCong" style="display: none;">
                            
                                    
            <div class="content-box-header" ><h3>Vui lòng chọn hình ảnh cho SPA</h3></div>          
       
        <div class="content-box-content">    
            <div class="tab-content default-tab">
                <form role="form" action="#" method="post" enctype="multipart/form-data" >
                <div class="form-group">
                    <input type="file" class="form-control" name="myfile" id="myfile" multiple>
                  </div>      
                  <input type="button" class="btn btn-default" value="Upload" onclick="return doUpload1('<?php echo base_url('/admin/products/UploadFile/')  ?>');" />
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
                
              </div>
            </div> 
       </div>   
                            
                            
                        </div> <!-- End hinh anh upload-->
                        
                        <div id="" class="ThemThanhCong" style="display: none;">
                             <div class="content-box-header" ><h3>Cấu hình thời gian hoạt động cho dịch vụ & sản phẩm này</h3></div>
       
                             <div class="content-box-content"> 
                                <table id="tableThemTgianPRO">
                                    <tr>
                                        <th>Thứ 2</th>
                                        <th>Thứ 3</th>
                                        <th>Thứ 4</th>
                                        <th>Thứ 5</th>
                                        <th>Thứ 6</th>
                                        <th>Thứ 7</th>
                                        <th>CN</th>
                                        <th>Ngày Lẽ</th>
                                    </tr>
                                    <tr>
                                        <td>
                                        Từ lúc <br/>
                                        <select>
                                            <option value="0">0 Giờ </option>
                                            <option value="1">1 Giờ </option>
                                            <option value="2">2 Giờ </option>
                                            <option value="3">3 Giờ </option>
                                            <option value="4">4 Giờ </option>
                                            <option value="5">5 Giờ </option>
                                            <option value="6">6 Giờ </option>
                                            <option value="7">7 Giờ </option>
                                            <option value="8" selected="selected">8 Giờ </option>
                                            <option value="9">9 Giờ </option>
                                            <option value="10">10 Giờ </option>                                           
                                            <option value="11">11 Giờ </option>
                                            <option value="12">12 Giờ </option>
                                            <option value="13">13 Giờ </option>
                                            <option value="14">14 Giờ </option>
                                            <option value="15">15 Giờ </option>
                                            <option value="16">16 Giờ </option>
                                            <option value="17">17 Giờ </option>
                                            <option value="18">18 Giờ </option>
                                            <option value="19">19 Giờ </option>
                                            <option value="20">20 Giờ </option>
                                            <option value="21">21 Giờ </option>
                                            <option value="22">22 Giờ </option>
                                            <option value="23">23 Giờ </option>                                            
                                        </select> <br /><br />
                                        Đến <br />
                                        <select>
                                            <option value="0">0 Giờ </option>
                                            <option value="1">1 Giờ </option>
                                            <option value="2">2 Giờ </option>
                                            <option value="3">3 Giờ </option>
                                            <option value="4">4 Giờ </option>
                                            <option value="5">5 Giờ </option>
                                            <option value="6">6 Giờ </option>
                                            <option value="7">7 Giờ </option>
                                            <option value="8">8 Giờ </option>
                                            <option value="9">9 Giờ </option>
                                            <option value="10">10 Giờ </option>                                           
                                            <option value="11">11 Giờ </option>
                                            <option value="12">12 Giờ </option>
                                            <option value="13">13 Giờ </option>
                                            <option value="14">14 Giờ </option>
                                            <option value="15">15 Giờ </option>
                                            <option value="16">16 Giờ </option>
                                            <option value="17">17 Giờ </option>
                                            <option value="18">18 Giờ </option>
                                            <option value="19">19 Giờ </option>
                                            <option value="20" selected="selected">20 Giờ </option>
                                            <option value="21">21 Giờ </option>
                                            <option value="22">22 Giờ </option>
                                            <option value="23">23 Giờ </option>                                            
                                        </select>
                                        </td>
                                        <td>
                                        Từ lúc <br/>
                                        <select>
                                            <option value="0">0 Giờ </option>
                                            <option value="1">1 Giờ </option>
                                            <option value="2">2 Giờ </option>
                                            <option value="3">3 Giờ </option>
                                            <option value="4">4 Giờ </option>
                                            <option value="5">5 Giờ </option>
                                            <option value="6">6 Giờ </option>
                                            <option value="7">7 Giờ </option>
                                            <option value="8" selected="selected">8 Giờ </option>
                                            <option value="9">9 Giờ </option>
                                            <option value="10">10 Giờ </option>                                           
                                            <option value="11">11 Giờ </option>
                                            <option value="12">12 Giờ </option>
                                            <option value="13">13 Giờ </option>
                                            <option value="14">14 Giờ </option>
                                            <option value="15">15 Giờ </option>
                                            <option value="16">16 Giờ </option>
                                            <option value="17">17 Giờ </option>
                                            <option value="18">18 Giờ </option>
                                            <option value="19">19 Giờ </option>
                                            <option value="20">20 Giờ </option>
                                            <option value="21">21 Giờ </option>
                                            <option value="22">22 Giờ </option>
                                            <option value="23">23 Giờ </option>                                            
                                        </select> <br /><br />
                                        Đến <br />
                                        <select>
                                            <option value="0">0 Giờ </option>
                                            <option value="1">1 Giờ </option>
                                            <option value="2">2 Giờ </option>
                                            <option value="3">3 Giờ </option>
                                            <option value="4">4 Giờ </option>
                                            <option value="5">5 Giờ </option>
                                            <option value="6">6 Giờ </option>
                                            <option value="7">7 Giờ </option>
                                            <option value="8">8 Giờ </option>
                                            <option value="9">9 Giờ </option>
                                            <option value="10">10 Giờ </option>                                           
                                            <option value="11">11 Giờ </option>
                                            <option value="12">12 Giờ </option>
                                            <option value="13">13 Giờ </option>
                                            <option value="14">14 Giờ </option>
                                            <option value="15">15 Giờ </option>
                                            <option value="16">16 Giờ </option>
                                            <option value="17">17 Giờ </option>
                                            <option value="18">18 Giờ </option>
                                            <option value="19">19 Giờ </option>
                                            <option value="20" selected="selected">20 Giờ </option>
                                            <option value="21">21 Giờ </option>
                                            <option value="22">22 Giờ </option>
                                            <option value="23">23 Giờ </option>                                            
                                        </select>
                                        </td>
                                        <td>
                                        Từ lúc <br/>
                                        <select>
                                            <option value="0">0 Giờ </option>
                                            <option value="1">1 Giờ </option>
                                            <option value="2">2 Giờ </option>
                                            <option value="3">3 Giờ </option>
                                            <option value="4">4 Giờ </option>
                                            <option value="5">5 Giờ </option>
                                            <option value="6">6 Giờ </option>
                                            <option value="7">7 Giờ </option>
                                            <option value="8" selected="selected">8 Giờ </option>
                                            <option value="9">9 Giờ </option>
                                            <option value="10">10 Giờ </option>                                           
                                            <option value="11">11 Giờ </option>
                                            <option value="12">12 Giờ </option>
                                            <option value="13">13 Giờ </option>
                                            <option value="14">14 Giờ </option>
                                            <option value="15">15 Giờ </option>
                                            <option value="16">16 Giờ </option>
                                            <option value="17">17 Giờ </option>
                                            <option value="18">18 Giờ </option>
                                            <option value="19">19 Giờ </option>
                                            <option value="20">20 Giờ </option>
                                            <option value="21">21 Giờ </option>
                                            <option value="22">22 Giờ </option>
                                            <option value="23">23 Giờ </option>                                            
                                        </select> <br /><br />
                                        Đến <br />
                                        <select>
                                            <option value="0">0 Giờ </option>
                                            <option value="1">1 Giờ </option>
                                            <option value="2">2 Giờ </option>
                                            <option value="3">3 Giờ </option>
                                            <option value="4">4 Giờ </option>
                                            <option value="5">5 Giờ </option>
                                            <option value="6">6 Giờ </option>
                                            <option value="7">7 Giờ </option>
                                            <option value="8">8 Giờ </option>
                                            <option value="9">9 Giờ </option>
                                            <option value="10">10 Giờ </option>                                           
                                            <option value="11">11 Giờ </option>
                                            <option value="12">12 Giờ </option>
                                            <option value="13">13 Giờ </option>
                                            <option value="14">14 Giờ </option>
                                            <option value="15">15 Giờ </option>
                                            <option value="16">16 Giờ </option>
                                            <option value="17">17 Giờ </option>
                                            <option value="18">18 Giờ </option>
                                            <option value="19">19 Giờ </option>
                                            <option value="20" selected="selected">20 Giờ </option>
                                            <option value="21">21 Giờ </option>
                                            <option value="22">22 Giờ </option>
                                            <option value="23">23 Giờ </option>                                            
                                        </select>
                                        </td>
                                        <td>
                                        Từ lúc <br/>
                                        <select>
                                            <option value="0">0 Giờ </option>
                                            <option value="1">1 Giờ </option>
                                            <option value="2">2 Giờ </option>
                                            <option value="3">3 Giờ </option>
                                            <option value="4">4 Giờ </option>
                                            <option value="5">5 Giờ </option>
                                            <option value="6">6 Giờ </option>
                                            <option value="7">7 Giờ </option>
                                            <option value="8" selected="selected">8 Giờ </option>
                                            <option value="9">9 Giờ </option>
                                            <option value="10">10 Giờ </option>                                           
                                            <option value="11">11 Giờ </option>
                                            <option value="12">12 Giờ </option>
                                            <option value="13">13 Giờ </option>
                                            <option value="14">14 Giờ </option>
                                            <option value="15">15 Giờ </option>
                                            <option value="16">16 Giờ </option>
                                            <option value="17">17 Giờ </option>
                                            <option value="18">18 Giờ </option>
                                            <option value="19">19 Giờ </option>
                                            <option value="20" >20 Giờ </option>
                                            <option value="21">21 Giờ </option>
                                            <option value="22">22 Giờ </option>
                                            <option value="23">23 Giờ </option>                                            
                                        </select> <br /><br />
                                        Đến <br />
                                        <select>
                                            <option value="0">0 Giờ </option>
                                            <option value="1">1 Giờ </option>
                                            <option value="2">2 Giờ </option>
                                            <option value="3">3 Giờ </option>
                                            <option value="4">4 Giờ </option>
                                            <option value="5">5 Giờ </option>
                                            <option value="6">6 Giờ </option>
                                            <option value="7">7 Giờ </option>
                                            <option value="8" >8 Giờ </option>
                                            <option value="9">9 Giờ </option>
                                            <option value="10">10 Giờ </option>                                           
                                            <option value="11">11 Giờ </option>
                                            <option value="12">12 Giờ </option>
                                            <option value="13">13 Giờ </option>
                                            <option value="14">14 Giờ </option>
                                            <option value="15">15 Giờ </option>
                                            <option value="16">16 Giờ </option>
                                            <option value="17">17 Giờ </option>
                                            <option value="18">18 Giờ </option>
                                            <option value="19">19 Giờ </option>
                                            <option value="20" selected="selected">20 Giờ </option>
                                            <option value="21">21 Giờ </option>
                                            <option value="22">22 Giờ </option>
                                            <option value="23">23 Giờ </option>                                            
                                        </select>
                                        </td>
                                        <td>
                                        Từ lúc <br/>
                                        <select>
                                            <option value="0">0 Giờ </option>
                                            <option value="1">1 Giờ </option>
                                            <option value="2">2 Giờ </option>
                                            <option value="3">3 Giờ </option>
                                            <option value="4">4 Giờ </option>
                                            <option value="5">5 Giờ </option>
                                            <option value="6">6 Giờ </option>
                                            <option value="7">7 Giờ </option>
                                            <option value="8" selected="selected">8 Giờ </option>
                                            <option value="9">9 Giờ </option>
                                            <option value="10">10 Giờ </option>                                           
                                            <option value="11">11 Giờ </option>
                                            <option value="12">12 Giờ </option>
                                            <option value="13">13 Giờ </option>
                                            <option value="14">14 Giờ </option>
                                            <option value="15">15 Giờ </option>
                                            <option value="16">16 Giờ </option>
                                            <option value="17">17 Giờ </option>
                                            <option value="18">18 Giờ </option>
                                            <option value="19">19 Giờ </option>
                                            <option value="20" >20 Giờ </option>
                                            <option value="21">21 Giờ </option>
                                            <option value="22">22 Giờ </option>
                                            <option value="23">23 Giờ </option>                                            
                                        </select> <br /><br />
                                        Đến <br />
                                        <select>
                                            <option value="0">0 Giờ </option>
                                            <option value="1">1 Giờ </option>
                                            <option value="2">2 Giờ </option>
                                            <option value="3">3 Giờ </option>
                                            <option value="4">4 Giờ </option>
                                            <option value="5">5 Giờ </option>
                                            <option value="6">6 Giờ </option>
                                            <option value="7">7 Giờ </option>
                                            <option value="8" >8 Giờ </option>
                                            <option value="9">9 Giờ </option>
                                            <option value="10">10 Giờ </option>                                           
                                            <option value="11">11 Giờ </option>
                                            <option value="12">12 Giờ </option>
                                            <option value="13">13 Giờ </option>
                                            <option value="14">14 Giờ </option>
                                            <option value="15">15 Giờ </option>
                                            <option value="16">16 Giờ </option>
                                            <option value="17">17 Giờ </option>
                                            <option value="18">18 Giờ </option>
                                            <option value="19">19 Giờ </option>
                                            <option value="20" selected="selected">20 Giờ </option>
                                            <option value="21">21 Giờ </option>
                                            <option value="22">22 Giờ </option>
                                            <option value="23">23 Giờ </option>                                            
                                        </select>
                                        </td>
                                        <td>
                                        Từ lúc <br/>
                                        <select>
                                            <option value="0">0 Giờ </option>
                                            <option value="1">1 Giờ </option>
                                            <option value="2">2 Giờ </option>
                                            <option value="3">3 Giờ </option>
                                            <option value="4">4 Giờ </option>
                                            <option value="5">5 Giờ </option>
                                            <option value="6">6 Giờ </option>
                                            <option value="7">7 Giờ </option>
                                            <option value="8" selected="selected">8 Giờ </option>
                                            <option value="9">9 Giờ </option>
                                            <option value="10">10 Giờ </option>                                           
                                            <option value="11">11 Giờ </option>
                                            <option value="12">12 Giờ </option>
                                            <option value="13">13 Giờ </option>
                                            <option value="14">14 Giờ </option>
                                            <option value="15">15 Giờ </option>
                                            <option value="16">16 Giờ </option>
                                            <option value="17">17 Giờ </option>
                                            <option value="18">18 Giờ </option>
                                            <option value="19">19 Giờ </option>
                                            <option value="20">20 Giờ </option>
                                            <option value="21">21 Giờ </option>
                                            <option value="22">22 Giờ </option>
                                            <option value="23">23 Giờ </option>                                            
                                        </select> <br /><br />
                                        Đến <br />
                                        <select>
                                            <option value="0">0 Giờ </option>
                                            <option value="1">1 Giờ </option>
                                            <option value="2">2 Giờ </option>
                                            <option value="3">3 Giờ </option>
                                            <option value="4">4 Giờ </option>
                                            <option value="5">5 Giờ </option>
                                            <option value="6">6 Giờ </option>
                                            <option value="7">7 Giờ </option>
                                            <option value="8">8 Giờ </option>
                                            <option value="9">9 Giờ </option>
                                            <option value="10">10 Giờ </option>                                           
                                            <option value="11">11 Giờ </option>
                                            <option value="12">12 Giờ </option>
                                            <option value="13">13 Giờ </option>
                                            <option value="14">14 Giờ </option>
                                            <option value="15">15 Giờ </option>
                                            <option value="16">16 Giờ </option>
                                            <option value="17">17 Giờ </option>
                                            <option value="18">18 Giờ </option>
                                            <option value="19">19 Giờ </option>
                                            <option value="20" selected="selected">20 Giờ </option>
                                            <option value="21">21 Giờ </option>
                                            <option value="22">22 Giờ </option>
                                            <option value="23">23 Giờ </option>                                            
                                        </select>
                                        </td>
                                        <td>
                                        Từ lúc <br/>
                                        <select>
                                            <option value="0">0 Giờ </option>
                                            <option value="1">1 Giờ </option>
                                            <option value="2">2 Giờ </option>
                                            <option value="3">3 Giờ </option>
                                            <option value="4">4 Giờ </option>
                                            <option value="5">5 Giờ </option>
                                            <option value="6">6 Giờ </option>
                                            <option value="7">7 Giờ </option>
                                            <option value="8">8 Giờ </option>
                                            <option value="9">9 Giờ </option>
                                            <option value="10">10 Giờ </option>                                           
                                            <option value="11">11 Giờ </option>
                                            <option value="12">12 Giờ </option>
                                            <option value="13">13 Giờ </option>
                                            <option value="14">14 Giờ </option>
                                            <option value="15">15 Giờ </option>
                                            <option value="16">16 Giờ </option>
                                            <option value="17">17 Giờ </option>
                                            <option value="18">18 Giờ </option>
                                            <option value="19">19 Giờ </option>
                                            <option value="20">20 Giờ </option>
                                            <option value="21">21 Giờ </option>
                                            <option value="22">22 Giờ </option>
                                            <option value="23">23 Giờ </option>                                            
                                        </select> <br /><br />
                                        Đến <br />
                                        <select>
                                            <option value="0">0 Giờ </option>
                                            <option value="1">1 Giờ </option>
                                            <option value="2">2 Giờ </option>
                                            <option value="3">3 Giờ </option>
                                            <option value="4">4 Giờ </option>
                                            <option value="5">5 Giờ </option>
                                            <option value="6">6 Giờ </option>
                                            <option value="7">7 Giờ </option>
                                            <option value="8">8 Giờ </option>
                                            <option value="9">9 Giờ </option>
                                            <option value="10">10 Giờ </option>                                           
                                            <option value="11">11 Giờ </option>
                                            <option value="12">12 Giờ </option>
                                            <option value="13">13 Giờ </option>
                                            <option value="14">14 Giờ </option>
                                            <option value="15">15 Giờ </option>
                                            <option value="16">16 Giờ </option>
                                            <option value="17">17 Giờ </option>
                                            <option value="18">18 Giờ </option>
                                            <option value="19">19 Giờ </option>
                                            <option value="20">20 Giờ </option>
                                            <option value="21">21 Giờ </option>
                                            <option value="22">22 Giờ </option>
                                            <option value="23">23 Giờ </option>                                            
                                        </select>
                                        </td>
                                        <td>
                                        Từ lúc <br/>
                                        <select>
                                            <option value="0">0 Giờ </option>
                                            <option value="1">1 Giờ </option>
                                            <option value="2">2 Giờ </option>
                                            <option value="3">3 Giờ </option>
                                            <option value="4">4 Giờ </option>
                                            <option value="5">5 Giờ </option>
                                            <option value="6">6 Giờ </option>
                                            <option value="7">7 Giờ </option>
                                            <option value="8">8 Giờ </option>
                                            <option value="9">9 Giờ </option>
                                            <option value="10">10 Giờ </option>                                           
                                            <option value="11">11 Giờ </option>
                                            <option value="12">12 Giờ </option>
                                            <option value="13">13 Giờ </option>
                                            <option value="14">14 Giờ </option>
                                            <option value="15">15 Giờ </option>
                                            <option value="16">16 Giờ </option>
                                            <option value="17">17 Giờ </option>
                                            <option value="18">18 Giờ </option>
                                            <option value="19">19 Giờ </option>
                                            <option value="20">20 Giờ </option>
                                            <option value="21">21 Giờ </option>
                                            <option value="22">22 Giờ </option>
                                            <option value="23">23 Giờ </option>                                            
                                        </select> <br /><br />
                                        Đến <br />
                                        <select>
                                            <option value="0">0 Giờ </option>
                                            <option value="1">1 Giờ </option>
                                            <option value="2">2 Giờ </option>
                                            <option value="3">3 Giờ </option>
                                            <option value="4">4 Giờ </option>
                                            <option value="5">5 Giờ </option>
                                            <option value="6">6 Giờ </option>
                                            <option value="7">7 Giờ </option>
                                            <option value="8">8 Giờ </option>
                                            <option value="9">9 Giờ </option>
                                            <option value="10">10 Giờ </option>                                           
                                            <option value="11">11 Giờ </option>
                                            <option value="12">12 Giờ </option>
                                            <option value="13">13 Giờ </option>
                                            <option value="14">14 Giờ </option>
                                            <option value="15">15 Giờ </option>
                                            <option value="16">16 Giờ </option>
                                            <option value="17">17 Giờ </option>
                                            <option value="18">18 Giờ </option>
                                            <option value="19">19 Giờ </option>
                                            <option value="20">20 Giờ </option>
                                            <option value="21">21 Giờ </option>
                                            <option value="22">22 Giờ </option>
                                            <option value="23">23 Giờ </option>                                            
                                        </select>
                                        </td>
                                    </tr>                                    
                                </table>
                                <p>
                                  <input  class="button" name="btnthem" type="button" value="Cập nhật" onclick="CapNhatTimePRO();" />
                                </p>
                                
                                <div id="divTBKQCapNhatTimePRO" class="notification success png_bg" style="display: none;" >
                                    <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification " alt="close" /></a>
                                    <div>
                                       Thêm mới thời gian hoạt động của sản phẩm thành công !
                                    </div>
                                </div>
                                
                                <p class="ThemThanhCong" style="display: none;">
                                    <input type="button" value="Tiếp tục thêm mới sản phẩm khác!" onclick="ResetThemMoi();" />
                                </p>
                             </div>
                            
                        </div> <!-- End Them tgian hoat dong-->
                        
                        
                        
                    </div>  
                    <!-------------END THEM SAN PHAM--------------->
                    <!-------------END THEM SAN PHAM--------------->
                </div> <!-- End .content-box-content -->
                </div>
            <?php
                $this->load->view($lang.'/admin/footer.php');
            ?>    

        </div> <!-- End #main-content -->
        <div style="display:none;width:800px;height:600px;" id="divSearchSpa" >
        <span>Tên SPA: </span> <input type="text"  id="txtSpaName"/>        
        <input type="button"  class="button" value="Tìm SPA" onclick="SearchSPA(1);"/>
        <span id="spanKQTim"></span>
        <br /><br />

        <table class="tableborder table-fill" id="panelDataSPA"  width="100%">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã SPA</th>
                    <th>TTin SPA</th>                    
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>        
        </table>
         <script id="ListFoundSPA" type="text/x-jquery-tmpl" >        
            <tr id="trSPA${spaID}">
                    <td>${STT}</td>
                    <td>${spaID}</td>
                    <td>
                        Tên Spa: <span>${spaName}</span> <br />
                        Địa chỉ: ${Address} <br />
                        ĐT: ${Tel} <br />
                    </td>
                    <td><input type="checkbox" /></td>
                </tr>
         </script>
        <div id="DivPhanTrangSPA" style="margin:0;text-align:right;padding:0; margin-right:10px;">         
        Trang số:
        <select id="cboPageNoSPA" style="width:35px;" onchange="SearchSPACBB();">
            <option>1</option>
            <option>2</option>
        </select>
    </div>
        <input type="button" value="Hoàn tất" onclick="SelectFinish();"/>

    </div>
    
    
    <div style="display:none;width:900px;height:500px;" id="divSearchSpaTab2" >
        <span>Tên SPA: </span><br />
        <input type="text" id="txtSpaNameTab2"/>        
        
        <input class ="button" type="button" value="Tìm SPA" onclick="SearchSPATab2(1);"/>
        
        <span id="spanKQTimTab2"></span>
        <br /><br />

        <table class="table-fill" id="panelDataSPATab2"  width="100%">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã SPA</th>
                    <th>TTin SPA</th>                    
                    <th>Thao tác</th>
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
    
    
    </div>
    
    <script id="ListFoundPRO" type="text/x-jquery-tmpl" > 
            <tr id="trProductID${ProductID}">
                <td>${STT}</td>
                <td>${ProductID}<br>
                Mã Spa: ${SpaID} <a href="javascript:void(0);" onclick="ShowSpaDetail('${SpaID}','${ProductID}');"> Xem chi tiết</a>
                <br>
                <div id="divSPA${ProductID}" class="divSpaDetail" style="display:none;"></div>
                </td>
                <td>
                    Tên DV: ${Name} <br />
                    Mô tả: ${desc1} <br />
                    Trạng thái: ${StatusName} <br />
                    Loại SP: ${ProductTypeName} <br />
                    Thời lượng : ${Duration} giờ
                </td>
                <td>
                    Số chỗ còn lại: ${CurrentVouchers} <br />
                    Số chỗ tối đa trong 1 thời điểm: ${MaxProductatOnce} <br />
                    Giá trị từ ngày: ${ValidTimeFrom} <br />
                    Giá trị đến ngày: ${ValidTimeTo} <br />
                </td>
                <td>
                    Người tạo: ${CreatedBy} <br />
                    Ngày tạo : ${CreatedDate}
                </td>
                <td>                                        
                     <a href="javascript:void(0);" onclick="EditProduct('${ProductID}');" title="Sửa"><img src="<?php echo base_url('resources/images/icons/pencil.png'); ?>" alt="Sửa" /></a>
                     <a href="javascript:void(0);" onclick="DeleteProduct('${ProductID}');"  title="Xóa"><img src="<?php echo base_url('resources/images/icons/cross.png'); ?>" alt="Xóa" /></a> 
                     <a href="javascript:void(0);" onclick="ViewProduct('${ProductID}');"  title="Xem chi tiết"><img src="<?php echo base_url('resources/images/icons/show.png'); ?>" alt="Chi tiết" />
                </td>
            </tr>
    </script> 
    
 </body>
     


</html>


                    