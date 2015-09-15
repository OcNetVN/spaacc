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
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/bookingpayment.js'); ?>"></script>
        
        <!--[if IE]><script type="text/javascript" src="resources/scripts/jquery.bgiframe.js"></script><![endif]-->
        <style>
            .modalloading {
            display:    none;
            position:   fixed;
            z-index:    99999999;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255, 255, 255, .8 ) 
                        url('<?php echo base_url('resources/front/images/categoryloading.gif'); ?>')
                        50% 50% 
                        no-repeat;
            }
            
            /* When the body has the loading class, we turn
               the scrollbar off with overflow:hidden */
            body.loading {
                overflow: hidden;   
            }
            
            /* Anytime the body has the loading class, our
               modal element will be visible */
            body.loading .modalloading {
                display: block;
            }
        </style>
    </head>
  
    <body>
        <div class="modalloading"><!-- Place at bottom of page --></div>
        <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
        
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
                    
                    <h3>Quản lý thanh toán đặt chổ</h3>
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        <div id="content_first">
                        <div id="phuongthuc">
                            Spaname: <input class="form-control" list="list_spaname" id="txtspanamesearch"  placeholder="Tất cả spa">
                            <datalist id="list_spaname">
                                <!--load data-->
                            </datalist> &nbsp;
                                Ngày tạo: <input type="text" class="tcal tcalInput" id="txtdatesearch" placeholder="Tất cả ngày">
                            <br /><br />
                            <input type="button" class="button" id="phuongthucdanhsach" value="Danh sách"/>
                            <input type="button" class="button" id="phuongthucdanhsachhuy" value="Danh sách huỷ"/>
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
                                       <th>Mã đặt chổ</th>
                                       <th>Tên Spa</th>
                                       <th>Sản phẩm, dịch vụ</th>
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
                        </div> <!-- End #tab1 --><!--end divtab1-->
                        <div id="divtab2" style="display: none;">
                            <div id="khongtimthay1" style="display: none; color: red; font-weight: bold;">Không tìm thấy kết quả nào</div>
                            <div id="divTBKQTim1" style="margin-top: 10px; display: none;" class="notification success png_bg">
                                <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                                <div>
                                   Tìm được 0 mẫu tin!!!
                                </div>
                            </div>        
                            <table id="panelDataPRO1" style="display: none;" class="tableborder">                            
                                <thead>
                                    <tr>
                                       <th>STT</th>
                                       <th>Mã đặt chổ</th>
                                       <th>Tên Spa</th>
                                       <th>Sản phẩm, dịch vụ</th>
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
                                                <select id="cboPageNoPRO1">
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                                
                            </table>
                        </div> <!--end divtab2-->
                            </div>
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