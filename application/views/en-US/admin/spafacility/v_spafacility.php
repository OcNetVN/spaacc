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
       
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/Upload.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/spafacility.js'); ?>"></script>
        
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
             
                <form action="#" >
                    
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
                    
                    <h3>Quản lý loại sản phẩm</h3>
                    <ul class="content-box-tabs">
                        <li><a href="#tab1" id="prlist" class="default-tab">Tìm tiện ích</a></li> <!-- href must be unique and match the id of target div -->
                        <li><a href="#tab2" id="prinsert">Thêm tiện ích</a></li>
                    </ul>
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                       
                <div  > 
                <input type="hidden" id="loaicha" value="loaicha" />  
                <input type="hidden" id="loaicon" value="loaicon" />     
                <input type="hidden" id="idcha" value="" />         
                <input type="button" class="button" id="btnsearch" value="Search" onclick="searchProducts(1);" >
                <input type="button" class="button" id="quaylai" value="Quay lai" onclick="searchProducts(1);" style="display: none;" style="width:100px;height:30px;" >
                </div>
                <div id="divTBKQTim" style="margin-top: 10px; display: none;" class="notification success png_bg">
                    <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                    <div>
                       Tìm được 0 mẫu tin!
                    </div>
                </div>        
                        <table id="panelDataPRO" style="display: none;" class="tableborder">                            
                            <thead>
                                <tr>
                                   <th>STT</th>
                                   <th>Mã</th>
                                   <th>Giá trị chuỗi 1</th>
								   <th>Giá trị chuổi 2</th>
                                   <th>TTin khởi tạo</th>
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
                        <!--sua san pham-->
                        <div id="pannel_suasanpham" style="display: none;">    
                            <form id="form_update">
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                <p>
                                    <label>Giá trị chuỗi 1</label>
                                    <input class="text-input medium-input" type="text" id="tenvnsua" name="tenvnsua" />
									<span id="err_tenvnsua" style="display: none; color: red; font-weight: bold;">Không được rỗng</span>
                                    <input type="hidden" id="idsua" name="idsua" value="" />
                                </p>
                                <p>
                                    <label>Giá trị chuổi 2</label>
                                    <input class="text-input medium-input" type="text" id="tenensua" name="tenensua" />
                                </p>
                                <p>
                                    <label>Trạng thái</label>              
                                    <select id="trangthaisua" class="small-input">
                                        <option value="0">Khoá</option>
                                        <option value="1">Đang hoạt động</option>
                                    </select> 
                                </p>
                                <p>
                                    <input class="button" id="btnsua" onclick="sualoai();" type="button" value="Submit" />
                                    
                                </p>
                            </fieldset>
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                        </form>
                            
                       </div>
                        <!--end sua san pham-->
                        
                    </div> <!-- End #tab1 -->
                    
                    <!-------------THEM SAN PHAM--------------->
                    <!-------------THEM SAN PHAM--------------->
                    <div class="tab-content" id="tab2">
                    
                        <form id="form_insert">
                            
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                
                                <p>
                                    <label>Giá trị chuỗi 1</label>
                                    <input class="text-input medium-input" type="text" id="tenvn" name="tenvn" />
                                    <span id="err_tenvn" style="display: none; color: red; font-weight: bold;">Không được rỗng</span>
                                </p>
                                <p>
                                    <label>Giá trị chuỗi 2</label>
                                    <input class="text-input medium-input" type="text" id="tenen" name="tenen" />
                                </p>
                                <p>
                                    <label>Trạng thái</label>              
                                    <select id="trangthai" class="small-input">
                                        <option id="status_1" value="0">Khoá</option>
                                        <option id="status_2" value="1">Đang hoạt động</option>
                                    </select> 
                                </p>
                                <p>
                                    <input class="button" id="btnthem" onclick="themloai();" type="button" value="Submit" />
                                    <input class="button" id="btnreset" type="button" onclick="resetthem();" value="Reset" />
                                </p>
                            </fieldset>
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                        </form>
                        
                    </div>  
                    <!-------------END THEM SAN PHAM--------------->
                    <!-------------END THEM SAN PHAM--------------->
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
                                    Mã: ${CommonId} <br />
                                    Tình trạng:${NumValue1}
                                </td>
                                <td>
                                    ${StrValue1}
                                </td>
                                <td>
                                    ${StrValue2}
                                </td>
                                <td>
                                    Ngày tạo: ${CreatedDate} <br />
                                    Người tạo: ${CreatedBy} <br />
                                </td>
                                <td>                                        
                                     <a href="javascript:void(0);" onclick="loadsualoai('${CommonId}');" title="Sửa"><img src="<?php echo base_url('resources/images/icons/pencil.png'); ?>" alt="Sua" /></a>
                                     <a href="javascript:void(0);" onclick="DeleteProduct('${CommonId}');"  title="Xóa"><img src="<?php echo base_url('resources/images/icons/cross.png'); ?>" alt="Xóa" /></a> 
                                </td>
                            </tr>
                        </script> 
    </body>
     
</html>