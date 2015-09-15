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
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/productsedit.js'); ?>"></script>
        
        <!--[if IE]><script type="text/javascript" src="resources/scripts/jquery.bgiframe.js"></script><![endif]-->
        
    </head>
  
    <body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
        
        <div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
            
            <h1 id="sidebar-title"><a href="#">Spa Booking Nh?p Li?u</a></h1>
          
            <!-- Logo (221px wide) -->
            <a href="#"><img id="logo" src="<?php echo base_url('resources/images/logo.png'); ?>" alt="Simpla Admin logo" /></a>
          
            
            <?php
                $this->load->view($lang.'/admin/menu1.php');
            ?>  
            
            <div id="messages" style="display: none"> <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->
                
                <h3>3 Messages</h3>
             
                <p>
                    <strong>17th May 2009</strong> by Admin<br />
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue.
                    <small><a href="#" class="remove-link" title="Remove message">Remove</a></small>
                </p>
             
                <form action="#" method="post">
                    
                    <h4>New Message</h4>
                    
                    <fieldset>
                        <textarea class="textarea" name="textfield" cols="79" rows="5"></textarea>
                    </fieldset>
                    
                    <fieldset>
                    
                        <select name="dropdown" class="small-input">
                            <option value="option1">Send to...</option>
                            <option value="option2">Everyone</option>
                            <option value="option3">Admin</option>
                            <option value="option4">Jane Doe</option>
                        </select>
                        
                        <input class="button" type="submit" value="Send" />
                        
                    </fieldset>
                    
                </form>
                
            </div> <!-- End #messages -->
            
        </div></div> <!-- End #sidebar -->
        
        <div id="main-content"> <!-- Main Content Section with everything -->
            <div class="clear"></div> <!-- End .clear -->
            <div class="content-box" style="display:block;"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <h3>Quản lý dịch vụ SPA</h3>
                    
                    <ul class="content-box-tabs">                        
                        <li><a href="#tab2" id="prlist" class="default-tab">Cập nhật SP &  dịch vụ</a></li>
                    </ul>
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    <!-------------THEM SAN PHAM--------------->
                    <div class="tab-content default-tab" id="tab2">
                    
                        <form id="form_insert">
                            
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                            <table width="100%" >
                                <tr>
                                    <td>
                                        <label>Mã dịch vụ :</label>              
                                        <input id="txtProductIDTab2" type="text" readonly="readonly" value="<?php echo $product[0]->ProductID ;?>" class="text-input medium-input" />
                                    </td>
                                    <td>
                                        <label>Tên dịch vụ</label>
                                        <input class="text-input medium-input" type="text" value="<?php echo $product[0]->Name ;?>" id="txtNameTab2" name="txtNameTab2" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                         <label>Chọn SPA cung cấp<span style="color: red;">(*)</span></label>
                                         <a href="javascript:void(0);" class="button" onclick="ChonSpaThemMoi();" >Chọn spa</a>
                                         Mã spa: <span id="spanSpaChonTab2" class="spanSpaChonTab2"><?php echo $product[0]->SpaID ;?></span> 
                                         <span id="spanSpaNameChonTab2"></span> 
                                         <a href="javascript:void(0);" onclick="ShowSpaDetailTab2()">xem chi tiết</a><br/>
                                         <div id="divShowChiTietSpa" class="divSpaDetail" style="display: none;" ></div>
                                         <br />
                                         
                                    </td>
                                </tr>
                                <!--<tr>
                                    <td colspan="2"><label>Chọn nhóm khuyến mãi</label>
                                      
                                        <input type="checkbox"  id="checkpromotion" <?php //echo (substr($product[0]->ProductID, 0, 2)== "12")? "checked":""; ?> readonly="readonly"/>
                                    </td>
                                </tr> -->
                                <tr>
                                    <td colspan="2">
                                    <label>Mô tả dịch vụ</label>
                                    <textarea class="text-input textarea ckeditor" id="txtDescriptionTab2" name="txtDescriptionTab2" cols="79" rows="12">   <?php echo $product[0]->Description ;?>
                                    </textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>    
                                         <label>Trạng thái</label>              
                                        <select name="Status" id="cboStatusTab2" class="small-input">
                                            <?php 
                                            switch($product[0]->Status)
                                            {
                                                case "0" :    
                                                {
                                                    echo "<option value=\"0\" selected=\"selected\">Khóa </option>
                                                            <option value=\"1\">Đang hoạt động </option>
                                                            <option value=\"2\">Hết hạn </option>";
                                                    break;
                                                }
                                                case "1" :    
                                                {
                                                    echo "<option value=\"0\" >Khóa </option>
                                                            <option value=\"1\" selected=\"selected\">Đang hoạt động </option>
                                                            <option value=\"2\">Hết hạn </option>";
                                                    break;
                                                }
                                                case "2" :    
                                                {
                                                    echo "<option value=\"0\" >Khóa </option>
                                                            <option value=\"1\">Đang hoạt động </option>
                                                            <option value=\"2\" selected=\"selected\">Hết hạn </option>";
                                                    break;
                                                }
                                            }
                                            ?>
                                            
                                        </select>
                                    </td>
                                    <td>
                                        <label>Loại dịch vụ<span style="color: red;">(*)</span></label>              
                                        <select name="ProductType" id="cboProductTypeTab2" class="" style="width: 350px;">
                                            <?php echo $productypelist ;?>
                                        </select> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                         <p>
                                            <label>Số chỗ còn trống </label>
                                            <input class="text-input small-input" type="text" value="<?php echo $product[0]->CurrentVouchers ;?>" id="CurrentVouchersTab2" name="CurrentVouchers" />
                                        </p>
                                        <p>
                                            <label>Thời lượng </label>
                                            <input class="text-input small-input" type="text" value="<?php echo $product[0]->Duration ;?>" id="DurationTab2" name="Duration" /> Phút
                                        </p>
                                        <p>
                                            <label>Số chỗ tối đa trong 1 thời điễm</label>
                                            <input class="text-input small-input" type="text" value="<?php echo $product[0]->MaxProductatOnce ;?>" id="MaxProductatOnceTab2" name="MaxProductatOnce" />
                                        </p>
                                    </td>
                                    <td>
                                         <p>
                                            <label>Bắt đầu từ lúc</label>
                                            <input class="text-input small-input tcal" type="text" value="<?php echo $product[0]->ValidTimeFrom ;?>" id="ValidTimeFromTab2" name="ValidTimeFrom" />
                                        </p>
                                        <p>
                                            <label>Kết thúc vào lúc</label>
                                            <input class="text-input small-input tcal" type="text" value="<?php echo $product[0]->ValidTimeTo ;?>" id="ValidTimeToTab2" name="ValidTimeTo" />
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <p>
                                            <label>Chính sách của dịch vụ</label>  
                                            <textarea class="ckeditor" id="txtPolicyTab2" name="txtPolicyTab2" cols="79" rows="10">
                                            <?php echo $product[0]->Policy ;?>
                                            </textarea>
                                        </p>
                                        <p>
                                            <label>Một số điều khoản cấm</label>
                                            
                                            <textarea class="ckeditor" id="txtRestrictionTab2" name="txtPolicyTab2" cols="79" rows="8">
                                            <?php echo $product[0]->Restriction ;?>
                                            </textarea>
                                        </p>
                                        <p>
                                            <label>Hướng dẫn </label>                                            
                                            <textarea class="ckeditor" id="txtTipsTab2" name="txtTipsTab2" cols="79" rows="5">
                                            <?php echo $product[0]->Tips ;?>
                                            </textarea>
                                        </p>
                                        <p>
                                            <label>Giá cơ bản<span style="color: red;">(*)</span></label>
                                            <input class="text-input small-input" type="text" id="PriceTab2" name="Price" value="<?php 
                                            if (count($listprice)>0)
                                             echo $listprice[0]->Price ;?>" />
                                        </p>
                                        <p>
                                            <input class="button" id="btnthemPro" name="btnthemPro" type="button" value="Cap nhat" onclick="CapNhatProducts();" />
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
                               Cập nhật thành công cho sản phẩm có mã  <b><?php echo $product[0]->ProductID ;?></b> !
                            </div>
                        </div>
                        
                        <div class="notification error png_bg ThemThatBai" style="display: none;">
                            <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                            <div>
                                Cập nhật không thành công cho sản phẩm có mã <b><?php echo $product[0]->ProductID ;?></b>>!
                            </div>
                        </div>
                        
                        
                        <div id="UploadHinhAnh" class="ThemThanhCong" >
                            
                                    
            <div class="content-box-header" ><h3>Vui lòng chọn hình ảnh cho Sản phẩm / Dịch vụ có mã: <?php echo $product[0]->ProductID ;?></h3> </div>          
       
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
               
              <div id="divXemLaiHinhDaUp" >
            <?php
                echo "<div style=\"float: left;\">";
                for($i=0;$i<count($listimage);$i++)    
                {
                    echo "<div id=\"divLinks" . $listimage[$i]->id . "\" style=\"padding: 10px; float: left\">";
                    echo "<img src=\"" .base_url($listimage[$i]->URL). "\" width=\"180\"/>";
                    echo "<a href=\"javascript:void(0);\" onclick=\"XoaHinhProduct('" . $listimage[$i]->id . "');\">Xóa</a>";
                    echo "</div>";
                }
                echo "</div>";
             ?>
              </div>
              <div class="clear"></div>
            </div> 
       </div>   
                            
                            
                        </div> <!-- End hinh anh upload-->
                        
                        <div id="" class="ThemThanhCong" >
                             <div class="content-box-header" ><h3>Cấu hình thời gian hoạt động cho dịch vụ & sản phẩm có mã: <?php echo $product[0]->ProductID ;?></h3></div>
       
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
                                       Cập nhật giờ hoạt động cho Sản phẩm thành công !
                                    </div>
                                </div>
                             </div>
                            
                        </div> <!-- End Them tgian hoat dong-->
                       
                        <p >
                        <input type="button" onclick="BackToProduct();" value="Quay lại"/>
                        </p>
                        
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
        <span>Tên SPA: </span><br />
        <input type="text" id="txtSpaName"/>        
        
        <br />
        <input type="button" value="Tìm SPA" onclick="SearchSPA(1);"/>
        <span id="spanKQTim"></span>
        <br /><br />

        <table class="tableborder" id="panelDataSPA" border="1" cellpadding="1" cellspacing="0" style="border: 1px #666 solid; padding: 2px;" width="100%">
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
                            <tr>
                                <td>${STT}</td>
                                <td>${ProductID}<br>
                                Mã Spa: ${SpaID} <a href="javascript:void(0);" onclick="ShowSpaDetail('${SpaID}','${ProductID}');"> Xem chi tiết</a>
                                <br>
                                <div id="divSPA${ProductID}" class="divSpaDetail" style="display:none;"></div>
                                </td>
                                <td>
                                    Tên DV: ${Name} <br />
                                    Mô tả: ${Description} <br />
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


                    