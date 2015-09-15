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
        <script type="text/javascript" src="<?php echo base_url('resources/ckeditor/ckeditor.js'); ?>"></script> 
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
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/newsedit.js'); ?>"></script>
        
        <!--[if IE]><script type="text/javascript" src="resources/scripts/jquery.bgiframe.js"></script><![endif]-->
        
    </head>
  
    <body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
        
        <div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
            
            <h1 id="sidebar-title"><a href="#">Spa Booking Nhập Liệu</a></h1>
          
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
                    
                    <h3>Quản lý dịch vụ SPA</h3>
                    
                    <ul class="content-box-tabs">                        
                        <li><a href="#tab2" id="prlist" class="default-tab">Chỉnh sửa tin tức</a></li>
                    </ul>
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    <!-------------THEM SAN PHAM--------------->
                    <div class="tab-content default-tab" id="tab2">
                    
                       <form id="form_insert">
                            
                            <fieldset> 
                            <input type="hidden" id="txt_id" value="<?php echo $news[0]->id;?>"/>
                            <table width="100%" >
                                <tr>
                                    
                                    <td>
                                        <label>Tiêu đề tin tức</label>
                                        <input class="text-input medium-input" type="text" id="txt_title" name="txtNameTab2" value="<?php echo $news[0]->Title;?>" />
                                    </td>
                                  
                                    <td class="col_with">
                                        <label>Loại tin tức </label>
                                        <select id="cbo_NewType" name="cbo_NewType" style="min-width: 320px;">
                                            <option value="" selected="selected">Vui lòng chọn</option>
                                             <?php
                                                foreach($typeNew as $new){?>
                                                    <option value="<?php echo $new->CommonId;?> "><?php echo $new->StrValue1;?></option>  
                                             <?php
                                                } 
                                             ?> 
                                        </select> 
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="2">
                                    <label>Thông tin</label>
                                    <textarea class="text-input textarea ckeditor" id="txt_NewsBrief" name="txt_NewsBrief" cols="79" rows="12"><?php echo $news[0]->NewsBrief;?>
                                    </textarea>
                                    </td>
                                </tr>
                               
                                
                                <tr>
                                    <td colspan="2">
                                        <p>
                                            <label>Thông tin chi tiết</label>                                            
                                            <textarea class="ckeditor" id="txtNewDetail" name="txtNewDetail" cols="79" rows="10">
                                            <?php echo $news[0]->NewsDetail;?>
                                            </textarea>
                                        </p>
                                        
                                        <p>
                                <input class="button" id="btnthemPro" name="btnthemPro" type="button" value="Cập nhật" onclick="UpdateNews();" />
                                        </p>
                                    </td>
                                </tr>
                            </table>
                                
                            </fieldset>
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                        </form>
                        <div class="notification success png_bg ThemThanhCong" style="display: none;">
                            <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification " alt="close" /></a>
                            <div>
                               Cập nhật thành công cho sản phẩm có mã  <b></b> !
                            </div>
                        </div>
                        
                        <div class="notification error png_bg ThemThatBai" style="display: none;">
                            <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                            <div>
                                Cập nhật không thành công cho sản phẩm có mã <b></b>!
                            </div>
                        </div>
                        
                        
<div id="UploadHinhAnh" class="ThemThanhCong" >                          
            <div class="content-box-header" ><h3>Vui lòng chọn hình ảnh cho tin tức </h3> </div>          
       
        <div class="content-box-content">    
                <div class="tab-content default-tab">
                    <form role="form" action="#" method="post" enctype="multipart/form-data" >
                    <div class="form-group">
                        <input type="file" class="form-control" name="myfile" id="myfile" multiple>
                    </div>      
                    <input type="button" class="btn btn-default" value="Upload" onclick="return doUpload1('<?php echo base_url('/admin/newsmanage/UploadFile/')  ?>');" />
                    <input type="button" class="btn btn-default" value="Cancle" onclick="cancleUpload();"/>
                    </form>
                    <hr>
                    <div id="progress-group">
                        <div class="progress">
                          <div class="progress-bar" style="width: 60%;">
                            Tên file ở đây
                          </div>
                          <div class="progress-text">
                              Tiến trình ở đây
                          </div>
                        </div>
                        <div class="progress">
                          <div class="progress-bar" style="width: 40%;">
                            Tên file ở đây
                          </div>
                          <div class="progress-text">
                              Tiến trình ở đây
                          </div>
                        </div>
                    </div>
              <div class="clear"></div>
              <input type="hidden" id="didUrlImage"/>
              <div id="divXemLaiHinhDaUp" >
                <?php
                    echo "<div style=\"float: left;\">";
                    for($i=0;$i<count($listimage);$i++)    
                    {
                        echo "<div id=\"divLinks" . $listimage[$i]->id . "\" style=\"padding: 10px; float: left\">";
                        echo "<img src=\"/nhaplieuspa/" . $listimage[$i]->URL . "\" width=\"180\"/>";
                        echo "<a href=\"javascript:void(0);\" onclick=\"XoaHinhProduct('" . $listimage[$i]->id . "');\">Xóa</a>";
                        echo "</div>";
                    }
                    echo "</div>";
                 ?>
              </div>
              <div class="clear"></div> 
            </div> <!-- End #tab3 -->           
            
        </div> <!-- End .content-box-content -->
                            
                            
 </div> <!-- End hinh anh upload-->
                        
                       
                       
                        <p >
                        <input type="button" onclick="BackToProduct();" value="Quay lại"/>
                        </p>
                        
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
    
  
    
    </body>
     


</html>


                    