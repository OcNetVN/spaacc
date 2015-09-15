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
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/vouchertype.js'); ?>"></script>
        
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
                    
                    <h3>Quản lý loại voucher</h3>
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        <div id="phuongthuc">
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
                                       <th>Loại voucher</th>
                                       <th>ApplicationID</th>
                                       <th>Mô tả</th>
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
                            <form id="fthem" name="fthem" method="" action="">
                              <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                <tr>
                                  <td>Loại voucher</td>
                                  <td><input type="text" name="vouchertype" id="vouchertype" />
                                    <span style="color: red;font-weight: bold; display: none;" id="tbvouchertype"></span>
                                  </td>
                                </tr>
                                <tr>
                                  <td>ApplicationID</td>
                                  <td><input type="text" name="appid" id="appid" />
                                        <span style="color: red;font-weight: bold; display: none;" id="tbappid"></span>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Mô tả </td>
                                  <td><label for="textarea"></label>
                                  <textarea name="mota" id="mota" rows="3" style="width:60%"></textarea></td>
                                </tr>
                                <tr>
                                  <td colspan="2" align="center"><input type="button" name="button" id="button" onclick="btnthem();" value="Hoàn thành" />
                                  <input type="reset" name="reset" id="reset" value="Reset" />
                                  <p style="color: green;font-weight: bold; display: none;" id="tbsuccess"></p>
                                  <p style="color: red;font-weight: bold; display: none;" id="tberr"></p>
                                  </td>
                                </tr>
                              </table>
                            </form>
                        </div> <!--end divtab2-->
                        <div id="divtab3" style="display: none;"> <!--sua-->
                            <form id="fsua" name="ftsua" method="" action="">
                              <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                <tr>
                                  <td>Loại voucher</td>
                                  <td><input type="text" name="suavouchertype" id="suavouchertype" />
                                    <span style="color: red;font-weight: bold; display: none;" id="suatbvouchertype"></span>
                                  </td>
                                </tr>
                                <tr>
                                  <td>ApplicationID</td>
                                  <td><input type="text" name="suaappid" id="suaappid" />
                                        <span style="color: red;font-weight: bold; display: none;" id="suatbappid"></span>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Mô tả </td>
                                  <td><label for="textarea"></label>
                                  <textarea name="suamota" id="suamota" rows="3" style="width:60%"></textarea>
                                  <input type="hidden" name="suaid" id="suaid" /></td>
                                </tr>
                                <tr>
                                  <td colspan="2" align="center"><input type="button" name="button" id="button" onclick="btnsua();" value="Hoàn thành" />
                                  <p style="color: green;font-weight: bold; display: none;" id="suatbsuccess"></p>
                                  <p style="color: red;font-weight: bold; display: none;" id="suatberr"></p>
                                  </td>
                                </tr>
                              </table>
                            </form>
                        </div> <!--end divtab3-->
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