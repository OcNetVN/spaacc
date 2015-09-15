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
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/Upload_edit.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/objects.js'); ?>"></script>
        
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
                    
                    <h3>Quản lý Object</h3>
                    
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
                            <input type="button" class="button" id="themuser" value="Thêm Object"/>
                        </div>
                        <div class="cpbody" id="khungtim" style="display: none;">
                            <!-- khung tim kiem --->
                            <form id="form1" name="form1" method="post" action="">
                                  <table width="100%" border="0">
                                    <tr>
                                      <td  width="18%">Object group</td>
                                      <td  width="38%">
                                          <select id="objgroup" class="text-input medium-input">
                                            <option value="0">Tất cả</option>
                                          </select>
                                      </td>
                                      <td valign="top"  width="11%">Object type</td>
                                      <td valign="top"  width="33%">
                                          <select id="objtype" class="text-input medium-input">
                                                <option value="0">Tất cả</option>
                                          </select>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Website</td>
                                      <td><input type="text" id="timwebsite" class="text-input medium-input"/></td>
                                      <td>Họ và tên</td>
                                      <td>
                                          <input type="text" id="timhoten" class="text-input medium-input"/>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Điện thoại</td>
                                      <td><input type="text" id="timdienthoai" class="text-input medium-input"/></td>
                                      <td>Email</td>
                                      <td><input type="text" id="timemail" class="text-input medium-input"/></td>
                                    </tr>
                                    <tr>
                                      <td><input class="button" type="button" id="button" value="Tim" onclick="searchobject(1);"/>
                                      <input class="button" type="button" id="reset" onclick="Resettim();" value="Reset" /></td>
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
                                   <th>Thông tin 1</th>
                                   <th>Thông tin 2</th>
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
                                  <td width="16%">Họ tên<span style="color:#F00;">(*)</span></td>
                                  <td width="38%">
                                  <input type="text" id="hotenthem" class="text-input medium-input"/><span id="err_hoten" style="color: red; font-weight: bold; display: no;"></span>
                                  <input type="hidden" id="objidthem" />
                                  </td>
                                  <td width="11%">Status</td>
                                  <td width="35%"><select id="statusthem">
                                    <option value="0">Khoá</option>
                                    <option value="1">Hoạt động</option>
                                  </select></td>
                                </tr>
                                <tr>
                                  <td>Object Group</td>
                                  <td><select id="objgroupthem">
                                    <option value="0">Tất cả</option>
                                  </select></td>
                                  <td>Object Type</td>
                                  <td><select id="objtypethem">
                                    <option value="0">Tất cả</option>
                                  </select></td>
                                </tr>
                                <tr>
                                  <td>PID</td>
                                  <td><input type="text" id="pidthem" class="text-input medium-input"/></td>
                                  <td>PIDState</td>
                                  <td><input type="text" id="pdistatethem" class="text-input medium-input tcal"/></td>
                                </tr>
                                <tr>
                                  <td>PIDIssue</td>
                                  <td><input type="text" id="pidissuethem" class="text-input medium-input"/></td>
                                  <td>DoB</td>
                                  <td><input type="text" id="dobthem" class="text-input medium-input tcal"/></td>
                                </tr>
                                <tr>
                                  <td>PoB</td>
                                  <td><input type="text" id="pobthem" class="text-input medium-input"/></td>
                                  <td>PerAdd</td>
                                  <td><input type="text" id="peraddthem" class="text-input medium-input"/></td>
                                </tr>
                                <tr>
                                  <td>TemAdd</td>
                                  <td><input type="text" id="temaddthem" class="text-input medium-input"/></td>
                                  <td>Gender</td>
                                  <td><select id="gerderthem">
                                    <option value="0">Nữ</option>
                                    <option value="1">Nam</option>
                                  </select></td>
                                </tr>
                                <td>Image</td>
                                  <td>
                                  <!-- start up load hinh anh -->                        
                                    <div id="UploadHinhAnh" class="class_ThemThanhCong" style="display: none;">          
                                            <div class="content-box-content">    
                                                <div class="tab-content default-tab">
                                                    <form role="form" action="#" method="post" enctype="multipart/form-data" >
                                                    <div class="form-group">
                                                        <input type="file" class="form-control" name="myfile" id="myfile" multiple>
                                                      </div>      
                                                      <input type="button" class="btn btn-default" value="Upload" onclick="return doUpload1('<?php echo base_url('admin/objects/UploadFile')  ?>');" />
                                                      <input type="button" class="btn btn-default" value="Cancle" onclick="cancleUpload();"/>
                                                    </form>
                                                    <hr>
                                                    <div id="progress-group">
                                                        <div class="progress">
                                                          <div class="progress-bar" style="width: 60%;">
                                                            Tên file:
                                                          </div>
                                                          <div class="progress-text">
                                                              Tiến trình:
                                                          </div>
                                                        </div>
                                                        <div class="progress">
                                                          <div class="progress-bar" style="width: 40%;">
                                                            Tên file:
                                                          </div>
                                                          <div class="progress-text">
                                                              Tiến trình:
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
                                    </div> <!-- End hinh anh upload-->   
                                  </td>
                                  <td>ProvinceId</td>
                                  <td><input type="text" id="provinceidthem" class="text-input medium-input"/></td>
                                </tr>
                                <tr>
                                  <td>Tel</td>
                                  <td><input type="text" id="telthem" class="text-input medium-input"/></td>
                                  <td>Fax</td>
                                  <td><input type="text" id="faxthem" class="text-input medium-input"/></td>
                                </tr>
                                <tr>
                                  <td>Email<span style="color:#F00;">(*)</span></td>
                                  <td><input type="text" id="emailthem" class="text-input medium-input"/><span id="err_email" style="color: red; font-weight: bold; display: no;"></span></td>
                                  <td>Website</td>
                                  <td><input type="text" id="websitethem" class="text-input medium-input"/></td>
                                </tr>
                                <tr>
                                  <td>TaxCode</td>
                                  <td><input type="text" id="taxcodethem" class="text-input medium-input"/></td>
                                  <td>Note</td>
                                  <td><input type="text" id="notethem" class="text-input medium-input"/></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td><input type="button" class="button" onclick="btnthem_object();" value="Thêm" />
                                  <input type="reset" class="button" id="btnreset" value="Reset" /></td>
                                  <td colspan="2"><span id="suggessadd" style="color: green; font-weight: bold; display: no;"></span></td>
                                </tr>
                              </table>
                            </form>
                    </div>
                    <!-------------END gia THEM SAN PHAM--------------->
                    <!--edit-->
                    <div class="cpbody" id="khungedit" style="display: none;">
                        <form id="form2">
                              <table width="100%" border="0">
                                <tr>
                                  <td width="16%">Họ tên<span style="color:#F00;">(*)</span></td>
                                  <td width="38%">
                                    <input type="text" id="hotenedit" class="text-input medium-input"/><span id="err_hotenedit" style="color: red; font-weight: bold; display: none;"></span>
                                    <input id="edit_obj" type="hidden"/>
                                  </td>
                                    <td width="11%">Status</td>
                                      <td width="35%"><select id="statusedit">
                                        <option value="0">Khoá</option>
                                        <option value="1">Hoạt động</option>
                                      </select></td>
                                </tr>
                                <tr>
                                  <td>Object Group</td>
                                  <td><select id="objgroupedit">
                                    <option value="0">Tất cả</option>
                                  </select></td>
                                  <td>Object Type</td>
                                  <td><select id="objtypeedit">
                                    <option value="0">Tất cả</option>
                                  </select></td>
                                </tr>
                                <tr>
                                  <td>PID</td>
                                  <td><input type="text" id="pidedit" class="text-input medium-input"/></td>
                                  <td>PIDState</td>
                                  <td><input type="text" id="pdistateedit" class="text-input medium-input tcal"/></td>
                                </tr>
                                <tr>
                                  <td>PIDIssue</td>
                                  <td><input type="text" id="pidissueedit" class="text-input medium-input"/></td>
                                  <td>DoB</td>
                                  <td><input type="text" id="dobedit" class="text-input medium-input tcal"/></td>
                                </tr>
                                <tr>
                                  <td>PoB</td>
                                  <td><input type="text" id="pobedit" class="text-input medium-input"/></td>
                                  <td>PerAdd</td>
                                  <td><input type="text" id="peraddedit" class="text-input medium-input"/></td>
                                </tr>
                                <tr>
                                  <td>TemAdd</td>
                                  <td><input type="text" id="temaddedit" class="text-input medium-input"/></td>
                                  <td>Gender</td>
                                  <td><select id="gerderedit">
                                    <option value="0">Nữ</option>
                                    <option value="1">Nam</option>
                                  </select></td>
                                </tr>
                                <tr>
                                  <td>ProvinceId</td>
                                  <td><input type="text" id="provinceidedit" class="text-input medium-input"/></td>
                                  <td>
                                  </td>
                                </tr>
                                <tr>
                                    <td>Images</td>
                                    <td colspan="3">
                                    <!-- start up load hinh anh -->                        
                                    <!-- <div id="UploadHinhAnh" class="class_ThemThanhCong"> -->    
                                            <div class="content-box-content">    
                                                <div class="tab-content default-tab">
                                                    <form role="form" action="#" method="post" enctype="multipart/form-data" >
                                                    <div class="form-group">
                                                        <input type="file" class="form-control" name="myfile_edit" id="myfile_edit" multiple>
                                                      </div>      
                                                      <input type="button" class="btn btn-default" value="Upload" onclick="return doUpload_edit1('<?php echo base_url('admin/objects/UploadFile_edit')  ?>');" />
                                                      <input type="button" class="btn btn-default" value="Cancle" onclick="cancleUpload();"/>
                                                    </form>
                                                    <hr>
                                                    <div id="progress-group_edit">
                                                        <div class="progress_edit">
                                                          <div class="progress-bar_edit" style="width: 60%;">
                                                            Tên file:
                                                          </div>
                                                          <!--<div class="progress-text_edit">
                                                              Tiến trình:
                                                          </div>-->
                                                        </div>
                                                    </div>
                                                  <div class="clear"></div>
                                                  <input type="hidden" id="didUrlImage_eidt"/>
                                                  <div id="divXemLaiHinhDaUp_edit">
                                                    
                                                  </div>
                                                </div>                                             
                                    </div> <!-- End hinh anh upload--> 
                                    </td>
                                </tr>
                                <tr>
                                  <td>Tel</td>
                                  <td><input type="text" id="teledit" class="text-input medium-input"/></td>
                                  <td>Fax</td>
                                  <td><input type="text" id="faxedit" class="text-input medium-input"/></td>
                                </tr>
                                <tr>
                                  <td>Email</td>
                                  <td><input type="text" id="eidt_email" disabled="disabled" class="text-input medium-input"/></td>
                                  <td>Website</td>
                                  <td><input type="text" id="websiteedit" class="text-input medium-input"/></td>
                                </tr>
                                <tr>
                                  <td>TaxCode</td>
                                  <td><input type="text" id="taxcodeedit" class="text-input medium-input"/></td>
                                  <td>Note</td>
                                  <td><input type="text" id="noteedit" class="text-input medium-input"/></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td><input type="button" class="button" onclick="btnedit();" value="Hoàn thành" />
                                  <td colspan="2"><span id="tbupdate" style="color: green; font-weight: bold; display: none;"></span></td>
                                  
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
        <div style="display:none;width:800px;height:600px;" id="divxemobjects" >
            <span>Họ tên: </span><span id="showFullName"></span><br />
            <span>ObjectGroup: </span><span id="showObjectGroup"></span><br />
            <span>ObjectType: </span><span id="showObjectType"></span><br />
            <span>PID: </span><span id="showPID"></span><br />
            <span>PIDState: </span><span id="showPIDState"></span><br />
            <span>PIDIssue: </span><span id="showPIDIssue"></span><br />
            <span>DoB: </span><span id="showDoB"></span><br />
            <span>PoB: </span><span id="showPoB"></span><br />
            <span>PerAdd: </span><span id="showPerAdd"></span><br />
            <span>TemAdd: </span><span id="showTemAdd"></span><br />
            <span>Giới tính: </span><span id="showGender"></span><br />
            <span>ProvinceId: </span><span id="showProvinceId"></span><br />
            <span>Điện thoại: </span><span id="showTel"></span><br />
            <span>Fax: </span><span id="showFax"></span><br />
            <span>Email: </span><span id="showEmail"></span><br />
            <span>Website: </span><span id="showWebsite"></span><br />
            <span>TaxCode: </span><span id="showTaxCode"></span><br />
            <span>Status: </span><span id="showStatus"></span><br />
            <span>CreatedBy: </span><span id="showCreatedBy"></span><br />
            <span>CreatedDate: </span><span id="showCreatedDate"></span><br />
        </div>
    </div>
    
    <script id="ListFoundPRO" type="text/x-jquery-tmpl" > 
                            <tr>
                                <td>${STT}</td>
                                <td>
                                    Tên: ${FullName} <br />
                                    Website: ${Website} <br />
                                    Ghi chú: ${Note}
                                </td>
                                <td>
                                    Điện thoại: ${Tel} <br />
                                    Email: ${Email}
                                </td>
                                <td>
                                    Người tạo: ${CreatedBy} <br />
                                    Ngày tạo : ${CreatedDate}
                                </td>
                                <td>                                        
                                     <a href="javascript:void(0);" onclick="suaobjects('${ObjectId}','${ObjectGroup}','${ObjectType}','${Gender}');" title="Sửa"><img src="<?php echo base_url('resources/images/icons/pencil.png'); ?>" alt="Sửa" /></a>
                                     <a href="javascript:void(0);" onclick="xoaobjects('${ObjectId}');"  title="Xóa"><img src="<?php echo base_url('resources/images/icons/cross.png'); ?>" alt="Xóa" /></a> 
                                     <a href="javascript:void(0);" onclick="xemobjects('${ObjectId}','${ObjectGroup}','${ObjectType}');"  title="Xem chi tiết"><img src="<?php echo base_url('resources/images/icons/show.png'); ?>" alt="Xem chi tiết" />
                                </td>
                            </tr>
                        </script> 
    
    </body>
     


</html>