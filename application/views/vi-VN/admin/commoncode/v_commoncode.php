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
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/commoncode.js'); ?>"></script>
        
        <!--[if IE]><script type="text/javascript" src="resources/scripts/jquery.bgiframe.js"></script><![endif]-->
        <style>
          .ui-autocomplete {
            max-height: 100px;
            overflow-y: auto;
            /* prevent horizontal scrollbar */
            overflow-x: hidden;
          }
          /* IE 6 doesn't support max-height
           * we use height instead, but this forces the menu to always be this tall
           */
          * html .ui-autocomplete {
            height: 100px;
          }
          </style>
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
                    
                    <h3>Quản lý CommonCode</h3>
                    
                    <ul class="content-box-tabs">
                        <li><a href="#tab1" id="prlist" class="default-tab">Tra cứu người dùng</a></li> <!-- href must be unique and match the id of target div -->
                        <!--<li><a href="#tab2" id="prinsert">Thêm mới người dùng</a></li>-->
                    </ul>
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        
                        <div id="phuongthuc">
                            <input type="button" class="button" id="phuongthucdanhsach" value="Danh sách"/>
                            <input type="button" class="button" id="phuongthuctim" value="Khung tìm kiếm"/>
                            <input type="button" class="button" id="themuser" value="Thêm CommonCode"/>
                        </div>
                        <div class="cpbody" id="khungtim" style="display: none;">
                            <!-- khung tim kiem --->
                            <form id="form1" name="form1" method="post" action="">
                                  <table width="100%" border="0">
                                    <tr>
                                      <td  width="18%">CommontypeID</td>
                                      <td  width="38%">
                                          <select id="timcmtypeid" class="text-input medium-input">
                                            <option value="0">Tất cả</option>
                                          </select>
                                      </td>
                                      <td valign="top"  width="11%"></td>
                                      <td valign="top"  width="33%"></td>
                                    </tr>
                                    <tr>
                                      <td>Giá trị chuỗi 1</td>
                                      <td>
                                          <input type="text" id="timgiatrichuoi1" class="text-input medium-input"/>
                                      </td>
                                      <td>Giá trị chuỗi 2</td>
                                      <td><input type="text" id="timgiatrichuoi2" class="text-input medium-input"/></td>
                                    </tr>
                                    <tr>
                                      <td>Giá trị số 1</td>
                                      <td><input type="text" id="timgiatriso1" class="text-input medium-input"/></td>
                                      <td>Giá trị số 2</td>
                                      <td><input type="text" id="timgiatriso2" class="text-input medium-input"/></td>
                                    </tr>
                                    <tr>
                                      <td><input class="button" type="button" id="button" value="Tim" onclick="searchcommoncode(1);"/>
                                      <input class="button" type="reset" id="reset" value="Reset" /></td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                  </table>
                            </form>
                            <!-- end khung tim kiem --->                            
                        </div>
                        <div id="khongtimthay" style="display: none; color: red; font-weight: bold; margin: 10px 10px;">Không tìm thấy kết quả nào.</div>
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
                                   <th>CommonTypeID</th>
                                   <th>Thông tin</th>
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
                        
                    </div> <!-- End #tab1 -->
                    
                   
                    <!-------------THEM gia SAN PHAM--------------->
                    <div class="cpbody" id="khunginsert" style="display: none;">
                        <form id="form1">
                              <table width="100%" border="0">
                                <tr>
                                  <td width="16%">CommonTypeID</td>
                                  <td width="38%">
                                  <select id="cmtypeidthem">
                                    <option value="0">Tất cả</option>
                                  </select>
                                  </td>
                                  <td></td>
                                  <td></td>
                                   <!--<td width="21%">Chọn cấp cần thêm</td>
                                  <td width="15%" id="td_capthem">
                                    <select id="choncapthem">
                                    <option value="1">Tất cả</option>
                                  </select>
                                  </td>-->
                                </tr>
                                </table>
                                <!--<table width="100%" border="0" id="tbl_hiencapthem" style="display: none;">
                                    <tr>
                                        <td id="hiencapthem">
                                        <select id="obcmtypeidthem">
                                            <option value="0">Tất cả</option>
                                          </select>
                                        </td>
                                    </tr>
                                </table>-->
                                <div id="show_tbl_cap" style="display: none;">
                                    <table width="100%" border="0" id="tbl_2cap" style="display: none;">
                                        <tr>
                                            <td>Cấp 1</td>
                                            <td>
                                                  <select id="haicap_1">
                                                    <option value="0">Chọn</option>
                                                  </select>
                                            </td>
                                            <td>Cấp 2</td>
                                            <td>
                                                  <select id="haicap_2">
                                                    <option value="0">Chọn</option>
                                                  </select>
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="100%" border="0" id="tbl_timnhieucap" style="display: none;">
                                        <tr>
                                            <td>Tìm loại cha</td>
                                            <td colspan="3">
                                                  <input type="text" id="loaichathem" class="text-input medium-input"/>
                                                  <input type="button" class="button" onclick="btn_chonloaicha();" value="Chọn" />
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="100%" border="0" id="detailthem" style="display: none;">
                                        <tr>
                                         <td>CommonID<span style="color:#F00;">(*)</span></td>
                                          <td colspan="3">
                                            <input type="text" id="cmidthem" class="text-input medium-input" disabled="disabled"/>
                                            <span id="thongbaoid" style="color: red; font-weight: bold; display: none;"></span>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Giá trị chuỗi 1<span style="color:#F00;">(*)</span></td>
                                          <td><input type="text" id="chuoi1them" class="text-input medium-input"/><span id="err_chuoithem" style="color: red; font-weight: bold; display: none;"></span></td>
                                          <td>Giá trị chuỗi 2</td>
                                          <td><input type="text" id="chuoi2them" class="text-input medium-input"/></td>
                                        </tr>
                                        <tr>
                                          <td>Giá trị số 1</td>
                                          <td><input type="text" id="so1them" class="text-input medium-input"/></td>
                                          <td>Giá trị số 2</td>
                                          <td><input type="text" id="so2them" class="text-input medium-input"/></td>
                                        </tr>
                                        <tr>
                                          <td>&nbsp;</td>
                                          <td><input type="button" class="button" onclick="btnthem_commoncode();" value="Thêm" />
                                          <!--<input type="reset" class="button" id="btnreset" value="Reset" />--></td>
                                          <td colspan="2"><span id="suggessadd" style="color: green; font-weight: bold; display: none;"></span></td>
                                        </tr>
                                  </table>
                              </div>
                            </form>
                    </div>
                    <!-------------END gia THEM SAN PHAM--------------->
                    <!--edit-->
                    <div class="cpbody" id="khungedit" style="display: none;">
                        <form id="form2">
                              <table width="100%" border="0">
                                        <tr>
                                          <td>CommonTypeID<span style="color:#F00;">(*)</span></td>
                                          <td><input type="text" id="cmtidsua" class="text-input medium-input" disabled="disabled" /></td>
                                          <td>CommonID</td>
                                          <td><input type="text" id="cmidsua" class="text-input medium-input" disabled="disabled" /></td>
                                        </tr>
                                        <tr>
                                          <td>Giá trị chuỗi 1<span style="color:#F00;">(*)</span></td>
                                          <td><input type="text" id="chuoi1sua" class="text-input medium-input"/><span id="err_chuoisua" style="color: red; font-weight: bold; display: none;"></span></td>
                                          <td>Giá trị chuỗi 2</td>
                                          <td><input type="text" id="chuoi2sua" class="text-input medium-input"/></td>
                                        </tr>
                                        <tr>
                                          <td>Giá trị số 1</td>
                                          <td><input type="text" id="so1sua" class="text-input medium-input"/></td>
                                          <td>Giá trị số 2</td>
                                          <td><input type="text" id="so2sua" class="text-input medium-input"/></td>
                                        </tr>
                                        <tr>
                                          <td>&nbsp;</td>
                                          <td><input type="button" class="button" onclick="btnsua_commoncode();" value="Hoành thành" />
                                          <!--<input type="reset" class="button" id="btnreset" value="Reset" />--></td>
                                          <td colspan="2"><span id="suggessedit" style="color: green; font-weight: bold; display: none;"></span></td>
                                        </tr>
                              </table>
                            </form>
                    </div>
                    <!--end edit-->
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
                                <td>
                                    CommonTypeID: ${CommonTypeId} <br />
                                    CommonID: ${CommonId}
                                </td>
                                <td>
                                    Chuỗi 1: ${StrValue1} <br />
                                    Chuỗi 2: ${StrValue2} <br />
                                    Số 1: ${NumValue1} <br />
                                    Số 2: ${NumValue2}
                                </td>
                                <td>
                                    Người tạo: ${CreatedBy} <br />
                                    Ngày tạo : ${CreatedDate}
                                </td>
                                <td>                                        
                                     <a href="javascript:void(0);" onclick="suacommoncode('${CommonId}');" title="Sửa"><img src="<?php echo base_url('resources/images/icons/pencil.png'); ?>" alt="Sửa" /></a>
                                     <a href="javascript:void(0);" onclick="xoacommoncode('${CommonId}','${CommonTypeId}');"  title="Xóa"><img src="<?php echo base_url('resources/images/icons/cross.png'); ?>" alt="Xóa" /></a> 
                                </td>
                            </tr>
                        </script> 
    
    </body>
</html>