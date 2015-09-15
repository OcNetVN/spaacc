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
        
        <title>Spa Booking Nh?p Li?u</title>
        <link rel="stylesheet" href="<?php echo base_url('resources/css/reset.css'); ?>" type="text/css" media="screen" />
      
        <link rel="stylesheet" href="<?php echo base_url('resources/css/style.css'); ?>" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url('resources/css/products.css'); ?>" type="text/css" media="screen" />
        
        <link rel="stylesheet" href="<?php echo base_url('resources/css/invalid.css'); ?>" type="text/css" media="screen" />    
        
        <!-- jQuery -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery-1.8.2.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery-ui.custom.js'); ?>"></script>
        <script src="<?php echo base_url('resources/front/js/common.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/menu.js'); ?>"></script>
        
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
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/price.js'); ?>"></script>
        
        <!--[if IE]><script type="text/javascript" src="resources/scripts/jquery.bgiframe.js"></script><![endif]-->
        
    </head>
  
    <body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
        
        <div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
            
            <h1 id="sidebar-title"><a href="#">Spa Booking Nhap Lieu</a></h1>
          
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
                    
                    <h3>Quản lý dịch vụ giá sản phẩm</h3>
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        
                        <div id="phuongthuc">
                            <input type="button" class="button" id="phuongthucdanhsach" value="Danh sách"/>
                            <input type="button" class="button" id="phuongthuctim" value="Khung tìm kiếm"/>
                        </div>
                        <div class="cpbody" id="khungtim" style="display: none;">
                            <!-- khung tim kiem --->
                            <form id="form1" name="form1" method="post" action="">
                                  <table width="100%" border="0">
                                    <tr>
                                      <td  width="18%">Dịch vục cấp 1</td>
                                      <td  width="38%"><select id="loaicha" class="text-input medium-input">
                                        <option value="0">Tất cả</option>
                                      </select>
                                      </td>
                                      <td rowspan="2" valign="top"  width="11%">Thuộc SPA</td>
                                      <td rowspan="2" valign="top"  width="33%">
                                          <select id="listspa" class="text-input medium-input">
                                                <option value="0">Tất cả</option>
                                          </select>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Dịch vụ cấp 2</td>
                                      <td>
                                          <select id="loaicon" class="text-input medium-input">
                                                <option value="0">Tất cả</option>
                                          </select>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Tên sản phẩm</td>
                                      <td><input type="text" id="timten" class="text-input medium-input"/></td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td><input class="button" type="button" id="button" value="Tim" onclick="searchProducts(1);"/>
                                      <input class="button" type="button" id="reset" onclick="Resettim();" value="Reset" /></td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                  </table>
                            </form>
                            <!-- end khung tim kiem --->                            
                        </div>
                        <div id="khongtimthaygia" style="display: none; color: red; font-weight: bold;">Không tìm thấy kết quả nào của sản phẩm <span id="tensanphamtheogia"></span></div>
                <div id="khongtimthay" style="display: none; color: red; font-weight: bold;">Không tìm thấy kết quả nào</div>
                <div id="divTBKQTim" style="margin-top: 10px; display: none;" class="notification success png_bg">
                    <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                    <div>
                       Tìm được 0 mẫu tin!!!
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
                                            Trang số: 
                                            <select id="cboPageNoPRO">
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                            
                        </table>
                        <!--danh sach gia san pham-->
                        <div id="divTBKQTim1" style="margin-top: 10px; display: none;" class="notification success png_bg">
                            <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                            <div>
                               Tìm được 0 loại sản phẩm con!!!
                            </div>
                        </div>  
                        <table id="panelDataPRO1" style="display: none;" class="tableborder">                            
                            <thead>
                                <tr>
                                    <th>STT</th>
                                   <th>Tên sản phẩm</th>
                                   <th>Giá</th>
                                   <th>Người tạo</th>
								   <th>Ngày tạo</th>
                                   <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div>
                                            Trang số: 
                                            <select id="cboPageNoPRO1">
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                            
                        </table>
                        <!--end danh sach gia san pham-->
                        
                    </div> <!-- End #tab1 -->
                    
                   
                    <!-------------THEM gia SAN PHAM--------------->
                    <div class="cpbody" id="khungthemgia" style="display: none;">
                        <form id="themgia">
                            
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                <p>
                                    <label>Tên sản phẩm</label>              
                                    <input class="text-input medium-input" type="text" disabled="disabled" id="tensanphamthem" />
                                    <input type="hidden" id="masanphamgia" />
                                </p>
                                <p>
                                    <label>Giá</label>
                                    <input class="text-input medium-input" type="text" id="giathem"/>
                                </p>
                                <p>
                                    <input class="button" id="btngiathem" onclick="submitthemgia();" type="button" value="Submit" />
                                </p>
                            </fieldset>
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                        </form>
                    </div>
                    <!-------------END gia THEM SAN PHAM--------------->
                </div> <!-- End .content-box-content -->
                </div>
                
             
           
                
            <?php
                $this->load->view($lang.'/admin/footer.php');
            ?>    
            
            
        </div> <!-- End #main-content -->
    </div>
    
    <script id="ListFoundPRO" type="text/x-jquery-tmpl" > 
                            <tr>
                                <td>${STT}</td>
                                <td>${ProductID}<br>
                                Mã Spa: ${SpaID}
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
                                     <a href="javascript:void(0);" onclick="themgia('${ProductID}','${Name}');" title="Thêm giá"><img src="<?php echo base_url('resources/images/icons/pencil.png'); ?>" alt="Thêm giá" /></a>
                                     <a href="javascript:void(0);" onclick="ViewGia('${ProductID}','${Name}',1);"  title="Danh sách giá"><img src="<?php echo base_url('resources/images/icons/show.png'); ?>" alt="Danh sách giá" />
                                </td>
                            </tr>
                        </script> 
    <!-- Giá sản phẩm-->                   
    <script id="ListFoundPRO1" type="text/x-jquery-tmpl" > 
                            <tr>
                                <td>${STT}</td>
                                <td>
                                    ${Name} <br />
                                </td>
                                <td>
                                    ${Price}
                                </td>
                                <td>
                                    ${CreatedBy}
                                </td>
                                <td>
                                    ${CreatedDate}
                                </td>
                                <td>
                                    <a href="javascript:void(0);" onclick="xoagia('${Id}','${Name}','${ProductID}');"  title="Xóa"><img src="<?php echo base_url('resources/images/icons/cross.png'); ?>" alt="Xóa" /></a> 
                                </td>
                            </tr>
    </script> 
    <!-- end Giá sản phẩm-->  
    
    </body>
     


</html>