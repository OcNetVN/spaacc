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
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/voucher.js'); ?>"></script>
        
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
                    
                    <h3>Quản lý Voucher</h3>
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
                                      <td>Mã phát sinh</td>
                                      <td><input type="text" name="themmaphatsinh" id="themmaphatsinh" disabled="disabled" readonly="readonly"/></td>
                                      </select></td>
                                    </tr>
                                    <tr>
                                      <td>Ngày bắt đầu:<span style="color: red; font-weight: bold;">(*)</span></td>
                                      <td>
                                        <input type="text" name="themngaybd" id="themngaybd" class="tcal"/>
                                        <span id="tberrthemngaybd" style="display: none; color: red;"></span>
                                      </td>
                                      <td>Ngày hết hạn:<span style="color: red; font-weight: bold;">(*)</span></td>
                                      <td>
                                        <input type="text" name="themngayhethan" id="themngayhethan" class="tcal"/>
                                        <span id="tberrthemngayhethan" style="display: none; color: red;"></span>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Giá tiền thẻ:<span style="color: red; font-weight: bold;">(*)</span></td>
                                      <td>
                                        <input type="text" name="themgiatienthe" id="themgiatienthe" />
                                        <span id="tberrthemgiatienthe" style="display: none; color: red;"></span>
                                      </td>
                                      <td>UserID:<span style="color: red; font-weight: bold;">(*)</span></td>
                                      <td>
                                        <input type="text" name="themuerid" id="themuerid" />
                                        <span id="tberrthemuserid" style="display: none; color: red;"></span>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Loại thẻ:</td>
                                      <td><select name="themloaithe" id="themloaithe">
                                      <td>Trạng thái:</td>
                                      <td><select name="themtrangthai" id="themtrangthai">
                                            <option value="1">Đang dùng</option>
                                            <option value="0">Đã huỷ</option>
                                      </select></td>
                                    </tr>
                                    <tr>
                                      <td>Áp dụng:</td>
                                      <td><select name="themapdung" id="themapdung">
                                            <option value="1">Tất cả</option>
                                            <option value="2">Tất cả, cả khuyến mãi</option>
                                            <option value="0">Một số sản phẩm</option>
                                      </select></td>
                                      <td>Giá tiền tối thiểu áp dụng:</td>
                                      <td><input id="minprice" type="text" value="0" /> VNĐ &nbsp; <span id="tberrminprice" style="display: none; color: red;"></span></td>
                                    </tr>
                                    <tr>
                                      <td>Số lượng Voucher:</td>
                                      <td><input id="totalvoucher" type="text" value="1" /> &nbsp;<span id="tberrtotalvoucher" style="display: none; color: red;"></span></td>
                                    </tr>
                                    <tr id="trchonspa" style="display: none;">
                                      <td>Spa:</td>
                                      <td><a href="javascript:void(0);" class="button" onclick="ChonSpaThemMoi();" >Chọn spa</a></td>
                                      <td colspan="2">
                                         <span id="showchonmaspatab2" style="display: none;">Mã spa: <span id="spanSpaChonTab2" class="spanSpaChonTab2"></span></span> 
                                         <span id="showchontenspatab2" style="display: none;">Tên spa: <span id="spanSpaNameChonTab2"></span></span>
                                      </td>
                                    </tr>
                                    <tr id="trchonsp" style="display: none;">
                                      <td>Sản phẩm:</td>
                                      <td><input type="checkbox" checked="checked" id="cbchontatca"/>Chọn tất cả sản phẩm&nbsp; &nbsp; &nbsp;<a href="javascript:void(0);" onclick="Selectpro();" title="Chọn sản phẩm" class="button" id="btnselectprothem" style="display: none;">Chọn sản phẩm</a></td>
                                      <td colspan="2">
                                        <span id="spanProList" style="display:none;"></span>
                                        <div id="divChonPro" style="margin-top:10px;" >
                                            
                                            <!--
                                            <div id="SPA001" class="doituongDIV">
                                                <span>001 - Nguyen Van An</span> 
                                                <a href="javascript:void(0);" onclick="XoaSPA('SPA001');"><img src="resources/images/icons/cross_grey_small.png" height="10" /></a>
                                            </div>
                                            -->
                                        </div>
                                      </td>
                                    </tr>
                                    <tr id="trbtn">
                                      <td colspan="4" align="center">
                                      <input type="button" name="btnthem" id="btnthem" value="Hoàn thành" onclick="clickbtnthem();" />
                                      <input type="reset" name="themreset" id="themreset" value="Làm mới" />
                                      <p id="themtbsuccess" style="color: green; font-weight: bold; display: none;"></p>
                                      <p id="themtberr" style="color: red; font-weight: bold; display: none;"></p></td>
                                    </tr>
                                  </table>
                                </form>
                                <form id="export" name="export" method="post" action="<?php echo base_url('admin/voucher/export_excel_them'); ?>">
                   					<input class="btn btn-info" style="margin-left:60px;" id="export" name="export" type="submit" value="Export Excel">
                 			    </form>
                        </div> <!--end divtab2-->
                        <div id="divtab3" style="display: none;"> <!--sua-->
                            <form id="fsua" name="fsua">
                                  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                      <td>Mã thẻ:</td>
                                      <td><input type="text" name="suacardno" id="suacardno" disabled="disabled" readonly="readonly"/></td>
                                      <td>Mã phát sinh</td>
                                      <td><input type="text" name="suamaphatsinh" id="suamaphatsinh" disabled="disabled" readonly="readonly"/></td>
                                      </select></td>
                                    </tr>
                                    <tr>
                                      <td>Ngày bắt đầu:<span style="color: red; font-weight: bold;">(*)</span></td>
                                      <td>
                                        <input type="text" name="suangaybd" id="suangaybd" class="tcal"/>
                                        <span id="tberrsuangaybd" style="display: none; color: red;"></span>
                                      </td>
                                      <td>Ngày hết hạn:<span style="color: red; font-weight: bold;">(*)</span></td>
                                      <td>
                                        <input type="text" name="suangayhethan" id="suangayhethan" class="tcal"/>
                                        <span id="tberrsuangayhethan" style="display: none; color: red;"></span>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Giá tiền thẻ:<span style="color: red; font-weight: bold;">(*)</span></td>
                                      <td>
                                        <input type="text" name="suagiatienthe" id="suagiatienthe" />
                                        <span id="tberrsuagiatienthe" style="display: none; color: red;"></span>
                                      </td>
                                      <td>UserID:<span style="color: red; font-weight: bold;">(*)</span></td>
                                      <td>
                                        <input type="text" name="suauerid" id="suauerid" />
                                        <span id="tberrsuauserid" style="display: none; color: red;"></span>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Loại thẻ:</td>
                                      <td><select name="sualoaithe" id="sualoaithe">
                                      <td>Trạng thái:</td>
                                      <td><select name="suatrangthai" id="suatrangthai">
                                            <option value="1">Đang dùng</option>
                                            <option value="0">Đã huỷ</option>
                                      </select></td>
                                    </tr>
                                    <tr>
                                      <td>Áp dụng:</td>
                                      <td><select name="suaapdung" id="suaapdung">
                                            <option value="1">Tất cả</option>
                                            <option value="2">Tất cả, cả khuyến mãi</option>
                                            <option value="0">Một số sản phẩm</option>
                                      </select></td>
                                      <td>Giá tiền tối thiểu áp dụng:</td>
                                      <td><input id="suaminprice" type="text" value="0" /> VNĐ &nbsp; <span id="tberrsuaminprice" style="display: none; color: red;"></span></td>
                                    </tr>
                                    <tr id="trchonspasua" style="display: none;">
                                      <td>Spa:</td>
                                      <td><a href="javascript:void(0);" class="button" onclick="ChonSpasua1();" >Chọn spa</a></td>
                                      <td colspan="2">
                                         <span id="showchonmaspasua" style="display: none;">Mã spa: <span id="spanSpaChonsua" class="spanSpaChonsua"></span></span> 
                                         <span id="showchontenspasua" style="display: none;">Tên spa: <span id="spanSpaNameChonsua"></span></span>
                                      </td>
                                    </tr>
                                    <tr id="trchonspsua" style="display: none;">
                                      <td>Sản phẩm:</td>
                                      <td><input type="checkbox" checked="checked" id="cbchontatcasua"/>Chọn tất cả sản phẩm&nbsp; &nbsp; &nbsp;<a href="javascript:void(0);" onclick="Selectprosua();" title="Chọn sản phẩm" class="button" id="btnselectprosua" style="display: none;">Chọn sản phẩm</a></td>
                                      <td colspan="2">
                                        <span id="spanProListsua" style="display:none;"></span>
                                        <div id="divChonProsua" style="margin-top:10px;" >
                                            
                                            <!--
                                            <div id="SPA001" class="doituongDIV">
                                                <span>001 - Nguyen Van An</span> 
                                                <a href="javascript:void(0);" onclick="XoaSPA('SPA001');"><img src="resources/images/icons/cross_grey_small.png" height="10" /></a>
                                            </div>
                                            -->
                                        </div>
                                      </td>
                                    </tr>
                                    <tr id="trbtnsua">
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
                                      <td>Ngày bắt đầu:</td>
                                      <td><input type="text" name="timngaybd" id="timngaybd" class="tcal" /></td>
                                      <td>Ngày hết hạn:</td>
                                      <td><input type="text" name="timngayhethan" id="timngayhethan" class="tcal"/></td>
                                    </tr>
                                    <tr>
                                      <td>Giá tiền thẻ:</td>
                                      <td><input type="text" name="timgiatienthe" id="timgiatienthe" /></td>
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
                                      <td>Áp dụng:</td>
                                      <td><select name="timapdung" id="timapdung">
                                      		<option value="9">---</option>
                                            <option value="1">Tất cả</option>
                                            <option value="2">Tất cả, cả khuyến mãi</option>
                                            <option value="0">Một số sản phẩm</option>
                                      </select></td>
                                    </tr>
                                    <tr>
                                      <td colspan="4" align="center">
                                      <input type="button" name="btnsearch" id="btnsearch" value="Hoàn thành" onclick="clickbtnsearch();" />
                                      <input type="reset" name="reset" id="reset" value="Làm mới" />
                                      </td>
                                    </tr>
                                  </table>
                                </form>
                                 <form id="export" name="export" method="post" action="<?php echo base_url('admin/voucher/export_excel_voucher'); ?>">
                   					<input class="btn btn-info" style="margin-left:60px;" id="export" name="export" type="submit" value="Export Excel">
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
        <div style="display:none;width:800px;height:600px;" id="divSearchPro" > <!-- bubup chon sp them-->
        <span>Tên Sản phẩm: </span> <input type="text"  id="txtProName"/>        
        <input type="button"  class="button" value="Tìm Sản phẩm" onclick="SearchPro(1);"/>
        <span id="spanKQTim"></span>
        <br /><br />

        <table class="tableborder table-fill" id="panelDataPro"  width="100%">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã Sản phẩm</th>
                    <th>TT sản phẩm</th>                    
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody id="contentbuthem">
                
            </tbody>        
        </table>
         <script id="ListFoundPro" type="text/x-jquery-tmpl" >        
            <tr id="trPro${ProductID}">
                    <td>${STT}</td>
                    <td>${ProductID}</td>
                    <td>
                        Tên sản phẩm: <span>${Name}</span> <br />
                        Tên Spa: ${spaName}
                    </td>
                    <td><input type="checkbox" /></td>
                </tr>
         </script>
        <div id="DivPhanTrangPro" style="margin:0;text-align:right;padding:0; margin-right:10px;">         
        Trang số:
        <select id="cboPageNoPro" style="width:35px;" onchange="SearchProCBB();">
            <option>1</option>
        </select>
    </div>
        <input type="button" value="Hoàn tất" onclick="SelectFinish();"/>

    </div><!--end bubup chon sp them-->
    <div style="display:none;width:800px;height:600px;" id="divSearchProsua" > <!-- bubup chon sp sua -->
        <span>Tên Sản phẩm: </span> <input type="text"  id="txtProNamesua"/>        
        <input type="button"  class="button" value="Tìm Sản phẩm" onclick="SearchProsua(1);"/>
        <span id="spanKQTimsua"></span>
        <br /><br />

        <table class="tableborder table-fill" id="panelDataProsua"  width="100%">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã Sản phẩm</th>
                    <th>TT sản phẩm</th>                    
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody id="contentbusua">
                
            </tbody>        
        </table>
         <script id="ListFoundProsua" type="text/x-jquery-tmpl" >        
            <tr id="trProsua${ProductID}">
                    <td>${STT}</td>
                    <td>${ProductID}</td>
                    <td>
                        Tên sản phẩm: <span>${Name}</span> <br />
                        Tên Spa: ${spaName}
                    </td>
                    <td><input type="checkbox" /></td>
                </tr>
         </script>
        <div id="DivPhanTrangProsua" style="margin:0;text-align:right;padding:0; margin-right:10px;">         
        Trang số:
        <select id="cboPageNoProsua" style="width:35px;" onchange="SearchProCBBsua();">
            <option>1</option>
        </select>
    </div>
        <input type="button" value="Hoàn tất" onclick="SelectFinishsua();"/>

    </div><!--end bubup chon sp -->
    <div style="display:none;width:900px;height:500px;" id="divSearchSpaTab2" ><!-- bubup chon spa -->
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

    </div><!-- end bubup chon spa -->
    <div style="display:none;width:900px;height:500px;" id="divSearchSpasua" ><!-- bubup chon spa sua -->
        <span>Tên SPA: </span><br />
        <input type="text" id="txtSpaNamesua"/>        
        
        <input class ="button" type="button" value="Tìm SPA" onclick="SearchSPAsua(1);"/>
        
        <span id="spanKQTimsua"></span>
        <br /><br />

        <table class="table-fill" id="panelDataSPAsua"  width="100%">
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
         <script id="ListFoundSPAsua" type="text/x-jquery-tmpl" >        
            <tr id="trSPAsua${spaID}">
                    <td>${STT}</td>
                    <td>${spaID}</td>
                    <td>
                        Tên Spa: <span>${spaName}</span> <br />
                        Địa chỉ: ${Address} <br />
                        ĐT: ${Tel} <br />
                    </td>
                    <td><a href="javascript:void(0);" onclick="ChonSpasua('${spaID}');" >Chọn</a></td>
                </tr>
         </script>
        <div id="DivPhanTrangSPAsua" style="margin:0;text-align:right;padding:0; margin-right:10px;">         
        Trang số:
        <select id="cboPageNoSPAsua" style="width:35px;" onchange="SearchSPACBBTab2();">
            <option>1</option>
            <option>2</option>
        </select>
    </div>        

    </div><!-- end bubup chon spa sua -->
    </div>
    </body>
</html>