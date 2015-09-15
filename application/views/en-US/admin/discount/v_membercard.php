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
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.number.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/Upload.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/membercard.js'); ?>"></script>
        
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
            
        </div></div> <!-- End #sidebar -->
        
        <div id="main-content"> <!-- Main Content Section with everything -->
            <div class="clear"></div> <!-- End .clear -->
            <div class="content-box" style="display:block;"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <h3>Quản lý thanh toán đặt chổ</h3>
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        <div id="phuongthuc">
                            <input type="button" class="button" id="phuongthuctim" value="Tìm kiếm"/>
                            <input type="button" class="button" id="phuongthucdanhsach" value="Danh sách"/>
                            <input type="button" class="button" id="phuongthucthem" value="Thêm mới"/>
                        </div>
                        <div id="divtab1">
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
                                       <th>TT thẻ</th>
                                       <th>TT người dùng</th>
                                       <th>Trạng thái</th>
                                       <th>Mã phát sinh</th>
                                       <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <div>
                                                Trang số: 
                                                <select id="cboPageNoPRO">
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                                
                            </table>
                        </div> <!-- End #tab1 --><!--end divtab1-->
                        <div id="divtab2" style="display: none;"> <!--them moi-->
                            <form id="fthem" name="fthem">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                      <td>Mã thẻ:</td>
                                      <td><input type="text" name="themcardno" id="themcardno" disabled="disabled" readonly="readonly"/></td>
                                      <td>Loại thẻ:</td>
                                      <td><select name="themloaithe" id="themloaithe">
                                      </select></td>
                                    </tr>
                                    <tr>
                                      <td>Mã phát sinh</td>
                                      <td><input type="text" name="themmaphatsinh" id="themmaphatsinh" disabled="disabled" readonly="readonly"/></td>
                                      <td>Ngày hết hạn:<span style="color: red; font-weight: bold;">(*)</span></td>
                                      <td>
                                        <input type="text" name="themngayhethan" id="themngayhethan" class="tcal"/>
                                        <span id="tberrthemngayhethan" style="display: none; color: red;"></span>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Tên người dùng:<span style="color: red; font-weight: bold;">(*)</span></td>
                                      <td>
                                        <input type="text" name="themnguoidung" id="themnguoidung" />
                                        <span id="tberrthemnguoidung" style="display: none; color: red;"></span>
                                      </td>
                                      <td>UserID:<span style="color: red; font-weight: bold;">(*)</span></td>
                                      <td>
                                        <input type="text" name="themuerid" id="themuerid" />
                                        <span id="tberrthemuserid" style="display: none; color: red;"></span>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Trạng thái:</td>
                                      <td><select name="themtrangthai" id="themtrangthai">
                                            <option value="1">Đang dùng</option>
                                            <option value="0">Đã huỷ</option>
                                      </select></td>
                                    </tr>
                                    <tr>
                                      <td colspan="4" align="center">
                                      <input type="button" name="btnthem" id="btnthem" value="Hoàn thành" onclick="clickbtnthem();" />
                                      <input type="reset" name="themreset" id="themreset" value="Làm mới" />
                                      <p id="themtbsuccess" style="color: green; font-weight: bold; display: none;"></p>
                                      <p id="themtberr" style="color: red; font-weight: bold; display: none;"></p></td>
                                    </tr>
                                  </table>
                                </form>
                        </div> <!--end divtab2-->
                        <div id="divtab3" style="display: none;"> <!--sua-->
                            <form id="fsua" name="fsua">
                              <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                <tr>
                                  <td>Mã thẻ:</td>
                                  <td><input type="text" name="suacardno" id="suacardno" disabled="disabled" readonly="readonly"/></td>
                                  <td>Loại thẻ:</td>
                                  <td><select name="sualoaithe" id="sualoaithe">
                                  </select></td>
                                </tr>
                                <tr>
                                  <td>Mã phát sinh</td>
                                  <td><input type="text" name="suamaphatsinh" id="suamaphatsinh" disabled="disabled" readonly="readonly"/></td>
                                  <td>Ngày hết hạn:<span style="color: red; font-weight: bold;">(*)</span></td>
                                  <td>
                                    <input type="text" name="suangayhethan" id="suangayhethan" class="tcal"/>
                                    <span id="tberrsuangayhethan" style="display: none; color: red;"></span>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Tên người dùng:<span style="color: red; font-weight: bold;">(*)</span></td>
                                  <td>
                                    <input type="text" name="suanguoidung" id="suanguoidung" />
                                    <span id="tberrsuanguoidung" style="display: none; color: red;"></span>
                                  </td>
                                  <td>UserID:<span style="color: red; font-weight: bold;">(*)</span></td>
                                  <td>
                                    <input type="text" name="suauerid" id="suauerid" />
                                    <span id="tberrsuauserid" style="display: none; color: red;"></span>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Trạng thái:</td>
                                  <td><select name="suatrangthai" id="suatrangthai">
                                        <option value="1">Đang dùng</option>
                                        <option value="0">Đã huỷ</option>
                                  </select></td>
                                </tr>
                                <tr>
                                  <td colspan="4" align="center">
                                  <input type="button" name="btnsua" id="btnsua" value="Hoàn thành" onclick="clickbtnsua();" />
                                  <p id="suatbsuccess" style="color: green; font-weight: bold; display: none;"></p>
                                  <p id="suatberr" style="color: red; font-weight: bold; display: none;"></p></td>
                                </tr>
                              </table>
                            </form>
                        </div> <!--end divtab3-->
                        <div id="divtab4" style="display: none;"> <!--tim kiem-->
                            <form id="fsearch" name="fsearch">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                      <td>Mã thẻ:</td>
                                      <td><input type="text" name="timcardno" id="timcardno" /></td>
                                      <td>Loại thẻ:</td>
                                      <td><select name="timloaithe" id="timloaithe">
                                      </select></td>
                                    </tr>
                                    <tr>
                                      <td>Ngày tạo:</td>
                                      <td><input type="text" name="timngaytao" id="timngaytao" class="tcal" /></td>
                                      <td>Ngày hết hạn:</td>
                                      <td><input type="text" name="timngayhethan" id="timngayhethan" class="tcal"/></td>
                                    </tr>
                                    <tr>
                                      <td>Tên người dùng:</td>
                                      <td><input type="text" name="timnguoidung" id="timnguoidung" /></td>
                                      <td>UserID:</td>
                                      <td><input type="text" name="timuerid" id="timuerid" /></td>
                                    </tr>
                                    <tr>
                                      <td>Trạng thái:</td>
                                      <td><select name="timtrangthai" id="timtrangthai">
                                      		<option value="9">Tất cả</option>
                                            <option value="1">Đang dùng</option>
                                            <option value="0">Đã huỷ</option>
                                      </select></td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td colspan="4" align="center">
                                      <input type="button" name="btnsearch" id="btnsearch" value="Hoàn thành" onclick="clickbtnsearch();" />
                                      <input type="reset" name="reset" id="reset" value="Làm mới" /></td>
                                    </tr>
                                  </table>
                                </form>
                                <!--show ket qua tim kiem-->
                                <div id="timkhongtimthay" style="display: none; color: red; font-weight: bold;">Không tìm thấy kết quả nào</div>
                                <div id="timdivTBKQTim" style="margin-top: 10px; display: none;" class="notification success png_bg">
                                    <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                                    <div>
                                       Tìm được 0 mẫu tin!!!
                                    </div>
                                </div>        
                                <table id="timpanelDataPRO" style="display: none;" class="tableborder">                            
                                    <thead>
                                        <tr>
                                           <th>STT</th>
                                           <th>TT thẻ</th>
                                           <th>TT người dùng</th>
                                           <th>Trạng thái</th>
                                           <th>Mã phát sinh</th>
                                           <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5">
                                                <div>
                                                    Trang số: 
                                                    <select id="timcboPageNoPRO">
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                    
                                </table>
                        </div> <!--end divtab4-->
                            </div> <!-- End .content-box-content -->
                            </div>
                </div> 
                
                
            <?php
                $this->load->view($lang.'/admin/footer.php');
            ?>    
        </div> <!-- End #main-content -->
    </div>
    </body>
</html>