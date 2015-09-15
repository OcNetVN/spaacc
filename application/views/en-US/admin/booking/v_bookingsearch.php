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
        
        <title>Spa Booking Nhập liệu</title>
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
       
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/Upload.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/bookingsearch.js'); ?>"></script>
        
        <!--[if IE]><script type="text/javascript" src="resources/scripts/jquery.bgiframe.js"></script><![endif]-->
        
    </head>
  
    <body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
        
        <div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
            
            <h1 id="sidebar-title"><a href="#">Spa Booking Nhập liệu</a></h1>
          
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
                    
                    <h3>Quản lý tìm kiếm đặt chổ</h3>
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        <div id="content_first">
                        <div id="phuongthuc">
                            <input type="button" class="button" id="phuongthucdanhsach" value="Danh sách"/>
                            <input type="button" class="button" id="phuongthuctim" value="Khung tìm kiếm"/>
                        </div>
                        <div class="cpbody" id="khungtim" style="display: none;">
                            <!-- khung tim kiem --->
                            <form id="form1" name="form1" method="post" action="">
                                  <table width="100%" border="0">
                                      <tr>
                                        <td>Tên người đặt chổ</td>
                                        <td><input type="text" id="timten" /></td>
                                        <td><a href="javascript:void(0);" onclick="Selectproduct();" title="Chọn dịch vụ, sản phẩm" class="button">Chọn dịch vụ</a></td>
                                        <td>
                                            <span id="spanproductList" style="display:none;"></span>
                                            <div id="divChonproduct" style="margin-top:10px;" >
                                                
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
                                        <td>Userid</td>
                                        <td><input type="text" id="timuserid" /></td>
                                        <td><a href="javascript:void(0);" onclick="SelectSpa();" title="Chọn SPA" class="button">Chọn SPA</a></td>
                                        <td>
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
                                        <td>Mã đặt chổ</td>
                                        <td><input type="text" id="timbookingid" /></td>
                                        <td>Ngày </td>
                                        <td><input type="text" class="tcal" id="timngay" /></td>
                                      </tr>
                                      <tr>
                                        <td>Phương thức thanh toán</td>
                                        <td><select name="select" id="timthanhtoan">
                                          <option value="2">Đã thanh toán</option>
                                          <option value="1">Chưa thanh toán</option>
                                          <option value="0">Đã huỷ</option>
                                        </select></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td>
                                          <input type="button" onclick="btntim(1);" value="Tìm kiếm" />
                                          <input type="button" onclick="Reset();" value="Reset" />
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table>
                            </form>
                            <!-- end khung tim kiem --->                            
                        </div>
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
                                   <th>Mã đặt chổ</th>
                                   <th>Tên spa</th>
                                   <th>Tổng tiền</th>
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
                                            <select id="cboPageNoPRO1" style="display: none;">
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                            
                        </table>
                    </div> <!-- End #tab1 -->
                    <div id="content_second" style="display: none;">
                        <div>
                            <input type="button" class="button" id="quaylai" value="Quay lại"/>
                        </div>
                        <div class="cpbody" id="khungdetail">
                        </div>
                    </div>
                </div>
                </div> <!-- End .content-box-content -->
                </div>
            <?php
                $this->load->view($lang.'/admin/footer.php');
            ?>    
        </div> <!-- End #main-content -->
        <!--chon spa-->
        <div style="display:none;width:800px;height:600px;" id="divSearchSpa" >
            <span>Tên SPA: </span><br />
            <input type="text" id="txtSpaName"/>        
            
            <br />
            <input type="button" value="Tìm SPA" onclick="SearchSPA(1);"/>
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
        <!--end chon spa-->
        <!--chon product-->
        <div style="display:none;width:800px;height:600px;" id="divSearchproduct" >
            <span>Tên dịch vụ, sản phẩm: </span><br />
            <input type="text" id="txtproductName"/>        
            
            <br />
            <input type="button" value="Tìm dịch vụ, sản phẩm" onclick="Searchproduct(1);"/>
            <span id="spanKQTimproduct"></span>
            <br /><br />
    
            <table class="tableborder table-fill" id="panelDataproduct"  width="100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã dịch vụ, sản phẩm</th>
                        <th>TTin dịch vụ, sản phẩm</th>                    
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>        
            </table>
             <script id="ListFoundproduct" type="text/x-jquery-tmpl" >        
                <tr id="trproduct${ProductID}">
                        <td>${STT}</td>
                        <td>${ProductID}</td>
                        <td>
                            Tên dịch vụ: <span>${Name}</span> <br />
                            Tên spa: ${spaName}
                        </td>
                        <td><input type="checkbox" /></td>
                    </tr>
             </script>
            <div id="DivPhanTrangproduct" style="margin:0;text-align:right;padding:0; margin-right:10px;">         
            Trang số:
            <select id="cboPageNoproduct" style="width:35px;" onchange="SearchproductCBB();">
                <option>1</option>
                <option>2</option>
            </select>
        </div>
            <input type="button" value="Hoàn tất" onclick="SelectFinishproduct();"/>
    
        </div>
        <!--end chon product-->
    </div>
    <script id="ListFoundPRO" type="text/x-jquery-tmpl" > 
            <tr>
                <td>${STT}</td>
                <td>${bookingID}</td>
                <td>${spaName}</td>
                <td>
                    Tổng tiền: ${TotalAmt} <br />
                    Trạng thái: ${Status}
                </td>
                <td>
                    Người tạo: ${FullName} <br />
                    Ngày tạo : ${CreatedDate}
                </td>
                <td> 
                     <a href="javascript:void(0);" onclick="xemdetail('${bookingID}','2');"  title="Xem chi tiết"><img src="<?php echo base_url('resources/images/icons/show.png'); ?>" alt="Chi tiết" />
                </td>
            </tr>
    </script> 
    </body>
</html>