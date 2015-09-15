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
        <link href="<?php echo base_url('resources/front/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url('resources/css/reset.css'); ?>" type="text/css" media="screen" />
      
        <link rel="stylesheet" href="<?php echo base_url('resources/css/style.css'); ?>" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url('resources/css/products.css'); ?>" type="text/css" media="screen" />
        
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
        <script src="<?php echo base_url('resources/front/js/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/comment.js'); ?>"></script>
        
        <!--[if IE]><script type="text/javascript" src="resources/scripts/jquery.bgiframe.js"></script><![endif]-->
        
    </head>
  
    <body>
        <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
        
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
                    
                    <h3>Quản lý comment</h3>
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        <div id="content_first">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="txtsearch">Tên/Mã sản phẩm: </label><input class="form-control" id="txtsearch" type="text"  placeholder="Tất cả sản phẩm">
                                </div>
                                <div class="col-md-3">
                                    <label for="txtdatefromsearch">Từ ngày: </label><input type="text" class="form-control tcal tcalInput" id="txtdatefromsearch" placeholder="Tất cả ngày">
                                </div>
                                <div class="col-md-3">
                                    <label for="txtdatetosearch">Đến ngày: </label><input type="text" class="form-control tcal tcalInput" id="txtdatetosearch" placeholder="Tất cả ngày">
                                </div>
                                <div class="col-md-3">
                                    <label for="sestatussearch">Trạng thái: </label>
                                    <select id="sestatussearch" class="form-control">
                                        <option value="9">Tất cả</option>
                                        <option value="3">Chưa duyệt</option>
                                        <option value="1">Cho phép</option>
                                        <option value="2">Không cho phép</option>
                                    </select>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="button" class="form-control btn btn-info" id="btnsearch" value="Tìm"/>
                                </div>
                            </div>
                            <span id="notifyres"></span>
                            <table id="btnlistcomment" class="table table-striped">                            
                                <thead>
                                    <tr>
                                       <th>STT</th>
                                       <th>Nội dung</th>
                                       <th>Trạng thái</th>
                                       <th>Cmt cha</th>
                                       <th>Sản phẩm</th>
                                       <th>Thông tin khởi tạo</th>
                                       <th>Thông tin duyệt</th>
                                       <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodylistcomment">
                                    <!--show data-->
                                </tbody>
                                
                            </table>
                            <div id="divpagination" class="pull-right">
                                <!--show pagination-->
                            </div> 
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