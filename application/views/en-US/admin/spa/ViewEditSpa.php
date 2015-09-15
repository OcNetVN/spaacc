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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Spa Booking Nhập Liệu </title>
    <link rel="stylesheet" href="<?php echo base_url('resources/css/reset.css'); ?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url('resources/css/style.css'); ?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url('resources/css/spa.css'); ?>" type="text/css" media="screen" />      
    <link rel="stylesheet" href="<?php echo base_url('resources/css/invalid.css'); ?>" type="text/css" media="screen" />   
    <!-- jQuery -->
    <link rel="stylesheet" href="<?php echo base_url('resources/css/jquery-ui-1.8.16.custom.css'); ?>" type="text/css" media="screen" />      
    <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery-1.8.2.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery-ui.custom.js'); ?>"></script>  
  
    <script type="text/javascript" src="<?php echo base_url('resources/ckeditor/ckeditor.js'); ?>"></script>
    <script src="<?php echo base_url('resources/front/js/common.js'); ?>"></script>    
    <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/menu.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/spaedit.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('resources/scripts/simpla.jquery.configuration.js'); ?>"></script>          <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.number.js'); ?>"></script>  
    <!-- Facebox jQuery Plugin -->
    <script type="text/javascript" src="<?php echo base_url('resources/scripts/facebox.js'); ?>"></script>       
    <!-- jQuery WYSIWYG Plugin -->
    <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.wysiwyg.js'); ?>"></script>       
    <!-- jQuery Datepicker Plugin -->
    <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.datePicker.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.date.js'); ?>"></script>
    <!--[if IE]><script type="text/javascript" src="resources/scripts/jquery.bgiframe.js"></script><![endif]-->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
        
</head>
  
<body>
    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->       
    <div id="sidebar">
        <div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
            <h1 id="sidebar-title"><a href="#">Spa Booking Nhập Liệu</a></h1>
            <!-- Logo (221px wide) -->
            <a href="#"><img id="logo" src="<?php echo base_url('resources/images/logo.png'); ?>" alt="Simpla Admin logo" /></a>
            <?php
                $this->load->view($lang.'/admin/menu1.php');
            ?>  
        </div>
    </div> <!-- End #sidebar -->
        
    <div id="main-content"> <!-- Main Content Section with everything -->
        <div class="content-box"><!-- Start Content Box -->
            <div class="content-box-header">
                <h3>Danh sách quản lý spa</h3>  
                <ul class="content-box-tabs">
                    <li><a href="#tab1" class="default-tab">Chỉnh sửa SPA</a></li> 
                </ul>               
            </div> <!-- End .content-box-header -->
                <div class="content-box-content">     
                    <div class="tab-content default-tab" id="tab1">                      
                    <form action="#" method="post"> 
                     <fieldset> 
                     <div class="divspaAdd">
                        <div class="divspaleft">
                            <div class="input_spaid">
                                <label>ID spa </label>
                                <input type="text" name="spaID" id="txt_editspaID" class="input-text" readonly="readonly" value="<?php echo $spa[0]->spaID;?>">
                            </div><br />
                            <div class="input_spaName">
                                <label>Tên spa </label>
                                <input type="text" name="spaName" id="txt_editspaName" class="input-text" value="<?php echo $spa[0]->spaName;?>">
                            </div><br />
                            <div class="input_ToaDo">
                                 <label>Tọa độ </label>
                                 <?php
                                      $lc=  $spa[0]->Location;
                                      $toadolc= explode("|",$lc);
                                      $todo  = $toadolc[0];
                                      $vitrispa = $toadolc[1];
                                      
                                      
                                  ?>
                            <input  type="text" id="txtLocaionTabInsert" class="input-text" value="<?php echo $todo; ?>">
                            </div>
                            <br />      
                            <div class="input_Postion">
                                 <label>Vị trí spa </label>
                                 <input  type="text" id="txtPostionTab" class="input-text" value="<?php echo $vitrispa;?>">
                            </div><br />
                                        
                            <div class="input_ShowAddG">
                                  <div style="overflow:hidden;height:200px;width:350px;">
                                        <div id="gmap_canvas" style="height:200px;width:450px;"></div>
                                        
                                    </div>
                            </div><br />
                                        
                        </div> 
                        <div class="divsparight">
                             <div class="input_spaAddress">
                                 <label>Địa chỉ </label>
                                 <input type="text" name="address" id="txt_Address" class="input-text" value="<?php echo $spa[0]->Address;?>">                         
                            </div><br /> 
                            <div class="input_spaEmail">
                                 <label>Email </label>
                                 <input type="text" name="email" id="txt_email" class="input-text" value="<?php echo $spa[0]->Email1; ?>">                     
                            </div><br />
                            <div class="input_Tel">
                                 <label>Điện thoại </label>
                                 <input type="text" name="Tel" id="txt_Tel" class="input-text" value="<?php echo $spa[0]->Tel1;?>">
                            </div><br />
                            <div class="Status">
                                <label>Trạng thái</label>              
                                <select name="Status" id="cboStatusTab2" class="small-input">
                                    <?php 
                                            switch($spa[0]->Status)
                                            {
                                                case "0" :    
                                                {
                                                    echo "<option value=\"0\" selected=\"selected\">Khóa </option>
                                                            <option value=\"1\">Đang hoạt động </option>
                                                            <option value=\"2\">Hết hạn </option>";
                                                    break;
                                                }
                                                case "1" :    
                                                {
                                                    echo "<option value=\"0\" >Khóa </option>
                                                            <option value=\"1\" selected=\"selected\">Đang hoạt động </option>
                                                            <option value=\"2\">Hết hạn </option>";
                                                    break;
                                                }
                                                case "2" :    
                                                {
                                                    echo "<option value=\"0\" >Khóa </option>
                                                            <option value=\"1\">Đang hoạt động </option>
                                                            <option value=\"2\" selected=\"selected\">Hết hạn </option>";
                                                    break;
                                                }
                                            }
                                    ?>
                                </select>
                            </div><br/>
                            <div class="Email1">
                                <label>Email CSKH </label>
                                <input type="text" name="email" id="txt_email1" class="input-text" value="<?php echo $spa[0]->Email; ?>">
                            </div><br/>
                            <div class="Tel1">                                                      
                                <label>Điện thoại CSKH </label>
                                <input type="text" name="email" id="tx_tTel1" class="input-text" value="<?php echo $spa[0]->Tel; ?>">
                            </div><br/>

                            <div class="Tel1">                                                      
                                <label>Website</label>
                                <input type="text" name="email" id="tx_website" class="input-text" value="<?php echo $spa[0]->Website; ?>">
                            </div><br/>
                        </div>
         
            <div class="clear"></div>      
            <div class="divcenter">
                <div class="input_Notes">
                    <label>Ghi chú </label>
                    <textarea name="Notes" id="txt_notes" class="fl_left ckeditor"  rows="3" data-validation="required">
                       <?php echo $spa[0]->Note;?> 
                    </textarea>
                </div><br />
                <div class="input_Info">
                     <label>Thông tin </label>
                       <textarea name="Intro" id="txt_Description" class="fl_left ckeditor"  rows="3" data-validation="required">
                        <?php echo $spa[0]->Intro;?>
                       </textarea>
                </div><br />
                <div class="input_InfoMore">
                     <label>Thông tin thêm </label>
                      <textarea name="MoreInfo" id="txt_MoreInfo" class="fl_left ckeditor"  rows="3" data-validation="required">
                        <?php echo $spa[0]->MoreInfo;?>
                      </textarea>
                </div><br />
            </div>
        
     </div>  
    <p><input  id ="btnThemMoiSpa" class="button" name="btnthem" type="button" value="Cập nhật" onclick="CapnhatSpa();"/></p>  
     <div class="clear"></div>
    <div id="divUpdateSpaError" style="display: none;" class="notification error png_bg ThemMoiError">
        <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
        <div>
           Cập nhật thông tin spa không thành công!
        </div>
    </div>

    <div id="divUpdateSpaSuccess" style="display: none;" class="notification success png_bg UploadHinhAnh">
        <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
        <div>
             Cập nhật thông tin spa thành công !!!
        </div>
    </div>               
<!--==================== cretead new list product for spa =================-->                        
        <div id="divAddProductHide" style="">
           <div class="content-box-header" >
                <h3>Vui lòng chọn loại sản phẩm cho spa</h3>
           </div>          
            <div class="content-box-content">    
                <div class="tab-content default-tab">
                     <table>
                        <tr>
                            <td class="lable_with"><label>Loại sản phẩm </label></td>
                            <td >
                               <input  type="button" name="AddProduct" id="btt_Addproduct" value="Thêm loại sản phẩm"/>
                            </td > 
                        </tr>
                        <tr>
                            <td colspan = "2" id="tdShowProductType" style=" text-align:left;" >
                                <?php for($i=0;$i<count($listproduct);$i++)    
                                    {?>
                              <div id="DivProductTypeID<?php echo $listproduct[$i]->ProductType; ?>" class="doituongDIV" maid="<?php echo $listproduct[$i]->ProductType; ?>">
                                    <span><?php echo $listproduct[$i]->ProductType; ?> - <?php echo $listproduct[$i]->StrValue1; ?></span> 
                              </div>
                              <?php }?>
                                
                            </td>
                        </tr>
                        <tr style="display: none;">
                            <td>Hidden loại sản phẩm:</td>
                           
                             <td><input type="text" id="txtProductTypeID" name="category" value="<?php  
                             for($i=0;$i<count($listproduct);$i++)    
                            { 
                             echo $listproduct[$i]->ProductType; 
                             echo ";";
                             }
                             ?>" /></td>   
                            
                            
                        </tr>
                     </table>
                     
                     
                     </div>
                      <div class="clear"></div>
                      <p><input  id ="btnThemMoiSpaProduct" class="button" name="btnthem" type="button" value="Cập nhật" onclick="ThemMoiSpaProduct();"/></p> 
                    </div> <!-- End #tab3 -->           
                </div> <!-- End .content-box-content -->
                  <div id="diveditspaproducterror" style="display: none;" class="notification error png_bg ThemMoiError">
                    <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                    <div>
                       Cập nhật loại sản phẩm không thành công!
                    </div>
                  </div>
                                
                <div id="divSpaProductSucces" style="display: none;" class="notification success png_bg  ThemMoiSuccess">
                    <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                    <div>
                        Cập nhật loại sản phẩm  thành công !!!
                    </div>
                </div>      
           </div>                        
 <!--====================created new list image for spa =================-->                       
    <div id="UploadHinhAnh"  style="">
        <div class="content-box-header" ><h3>Vui lòng chọn hình ảnh cho SPA</h3></div>          
            <div class="content-box-content">    
                <div class="tab-content default-tab">
                    <form role="form" action="#" method="post" enctype="multipart/form-data" >
                    <div class="form-group">
                        <input type="file" class="form-control" name="myfile" id="myfile" multiple>
                    </div>      
                    <input type="button" class="btn btn-default" value="Upload" onclick="return doUpload1('<?php echo base_url('/admin/spa/UploadFile/')  ?>');" />
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
                        echo "<img src=\"" . base_url($listimage[$i]->URL). "\" width=\"180\"/>";
                        echo "<a href=\"javascript:void(0);\" onclick=\"XoaHinhProduct('" . $listimage[$i]->id . "');\">Xóa</a>";
                        echo "</div>";
                    }
                    echo "</div>";
                 ?>
              </div>
              <div class="clear"></div> 
            </div> <!-- End #tab3 -->           
            
        </div> <!-- End .content-box-content -->
                
   </div>
 <div class="clear"></div>   
   <!-- add list danh sách sản phẩm ---------->

<div id="poupProduct" style="width:700px;display:none;margin-left: 30px;">
    <h3>Thêm danh sách loại sản phẩm</h3>
        <table style="width:780px;">
            <tr>
                <td style="width:150px;"><p><label>Chọn loại sản phẩm</label></p></td>
                <td>
                    <select name="cate" id="cbbProduct" class="small-input" onchange="ProductTypeChange();">
                        <?php echo $productypelist ;?>
                    </select>
                </td>
            </tr>
            <tr>  
                <td style="width: 150px;">Danh sách loại sản phẩm:</td>  
                <td  id ="tdProductPop" style=" text-align:left;" > 
                <?php for($i=0;$i<count($listproduct);$i++)   
                { ?>
                  <div id="DivProductTypeIDPop<?php echo $listproduct[$i]->ProductType; ?>" class="doituongDIV" maid="<?php echo $listproduct[$i]->ProductType; ?>">
                <span><?php echo $listproduct[$i]->ProductType; ?> - <?php echo $listproduct[$i]->StrValue1; ?></span> 
                <a href="javascript:void(0);" onclick="XoaObject('DivCategoryID<?php echo $listproduct[$i]->ProductType; ?>');"><img src="{{URL::to('/images/filecloseBTN.png')}}" height="12"></a>
                        </div>  
               <?php }?>
                
                </td>

            </tr>                
        </table> 
            <div style="clear:both; margin-left:350px;position: absolute;bottom: 50px;">
                <input type="button" id="clear" name="clear" value="Đóng" style="width:55px;height:28px;" onclick="closePoup();">            
            </div>  
</div>
<!--- end list danh sách sản phẩm ---------->    
<!-- add list thoi cho spa -->
<div id="divThemSpaTime" class="ThemThanhCong" style="">
    <input  type="hidden" id = "txt_SpaID2"/>
    <div class="content-box-header" >
        <h3>Cấu hình thời gian hoạt động của SPA</h3>
    </div> 
     <div class="content-box-content"> 
       
        <table id="tableThemTgianPRO">
            <tr>
                <th>Thứ 2</th>
                <th>Thứ 3</th>
                <th>Thứ 4</th>
                <th>Thứ 5</th>
                <th>Thứ 6</th>
                <th>Thứ 7</th>
                <th>CN</th>
                <th>Ngày Lễ</th>
            </tr>
            <tr>
                <td>
                Từ lúc <br/>
                <select>
                    <option value="0">0 Giờ </option>
                    <option value="1">1 Giờ </option>
                    <option value="2">2 Giờ </option>
                    <option value="3">3 Giờ </option>
                    <option value="4">4 Giờ </option>
                    <option value="5">5 Giờ </option>
                    <option value="6">6 Giờ </option>
                    <option value="7">7 Giờ </option>
                    <option value="8">8 Giờ </option>
                    <option value="9">9 Giờ </option>
                    <option value="10">10 Giờ </option>                                           
                    <option value="11">11 Giờ </option>
                    <option value="12">12 Giờ </option>
                    <option value="13">13 Giờ </option>
                    <option value="14">14 Giờ </option>
                    <option value="15">15 Giờ </option>
                    <option value="16">16 Giờ </option>
                    <option value="17">17 Giờ </option>
                    <option value="18">18 Giờ </option>
                    <option value="19">19 Giờ </option>
                    <option value="20">20 Giờ </option>
                    <option value="21">21 Giờ </option>
                    <option value="22">22 Giờ </option>
                    <option value="23">23 Giờ </option>                                            
                </select> <br /><br />
                Đến <br />
                <select>
                    <option value="0">0 Giờ </option>
                    <option value="1">1 Giờ </option>
                    <option value="2">2 Giờ </option>
                    <option value="3">3 Giờ </option>
                    <option value="4">4 Giờ </option>
                    <option value="5">5 Giờ </option>
                    <option value="6">6 Giờ </option>
                    <option value="7">7 Giờ </option>
                    <option value="8">8 Giờ </option>
                    <option value="9">9 Giờ </option>
                    <option value="10">10 Giờ </option>                                           
                    <option value="11">11 Giờ </option>
                    <option value="12">12 Giờ </option>
                    <option value="13">13 Giờ </option>
                    <option value="14">14 Giờ </option>
                    <option value="15">15 Giờ </option>
                    <option value="16">16 Giờ </option>
                    <option value="17">17 Giờ </option>
                    <option value="18">18 Giờ </option>
                    <option value="19">19 Giờ </option>
                    <option value="20">20 Giờ </option>
                    <option value="21">21 Giờ </option>
                    <option value="22">22 Giờ </option>
                    <option value="23">23 Giờ </option>                                            
                </select>
                </td>
                <td>
                Từ lúc <br/>
                <select>
                    <option value="0">0 Giờ </option>
                    <option value="1">1 Giờ </option>
                    <option value="2">2 Giờ </option>
                    <option value="3">3 Giờ </option>
                    <option value="4">4 Giờ </option>
                    <option value="5">5 Giờ </option>
                    <option value="6">6 Giờ </option>
                    <option value="7">7 Giờ </option>
                    <option value="8">8 Giờ </option>
                    <option value="9">9 Giờ </option>
                    <option value="10">10 Giờ </option>                                           
                    <option value="11">11 Giờ </option>
                    <option value="12">12 Giờ </option>
                    <option value="13">13 Giờ </option>
                    <option value="14">14 Giờ </option>
                    <option value="15">15 Giờ </option>
                    <option value="16">16 Giờ </option>
                    <option value="17">17 Giờ </option>
                    <option value="18">18 Giờ </option>
                    <option value="19">19 Giờ </option>
                    <option value="20">20 Giờ </option>
                    <option value="21">21 Giờ </option>
                    <option value="22">22 Giờ </option>
                    <option value="23">23 Giờ </option>                                            
                </select> <br /><br />
                Đến <br />
                <select>
                    <option value="0">0 Giờ </option>
                    <option value="1">1 Giờ </option>
                    <option value="2">2 Giờ </option>
                    <option value="3">3 Giờ </option>
                    <option value="4">4 Giờ </option>
                    <option value="5">5 Giờ </option>
                    <option value="6">6 Giờ </option>
                    <option value="7">7 Giờ </option>
                    <option value="8">8 Giờ </option>
                    <option value="9">9 Giờ </option>
                    <option value="10">10 Giờ </option>                                           
                    <option value="11">11 Giờ </option>
                    <option value="12">12 Giờ </option>
                    <option value="13">13 Giờ </option>
                    <option value="14">14 Giờ </option>
                    <option value="15">15 Giờ </option>
                    <option value="16">16 Giờ </option>
                    <option value="17">17 Giờ </option>
                    <option value="18">18 Giờ </option>
                    <option value="19">19 Giờ </option>
                    <option value="20">20 Giờ </option>
                    <option value="21">21 Giờ </option>
                    <option value="22">22 Giờ </option>
                    <option value="23">23 Giờ </option>                                            
                </select>
                </td>
                <td>
                Từ lúc <br/>
                <select>
                    <option value="0">0 Giờ </option>
                    <option value="1">1 Giờ </option>
                    <option value="2">2 Giờ </option>
                    <option value="3">3 Giờ </option>
                    <option value="4">4 Giờ </option>
                    <option value="5">5 Giờ </option>
                    <option value="6">6 Giờ </option>
                    <option value="7">7 Giờ </option>
                    <option value="8">8 Giờ </option>
                    <option value="9">9 Giờ </option>
                    <option value="10">10 Giờ </option>                                           
                    <option value="11">11 Giờ </option>
                    <option value="12">12 Giờ </option>
                    <option value="13">13 Giờ </option>
                    <option value="14">14 Giờ </option>
                    <option value="15">15 Giờ </option>
                    <option value="16">16 Giờ </option>
                    <option value="17">17 Giờ </option>
                    <option value="18">18 Giờ </option>
                    <option value="19">19 Giờ </option>
                    <option value="20">20 Giờ </option>
                    <option value="21">21 Giờ </option>
                    <option value="22">22 Giờ </option>
                    <option value="23">23 Giờ </option>                                            
                </select> <br /><br />
                Đến <br />
                <select>
                    <option value="0">0 Giờ </option>
                    <option value="1">1 Giờ </option>
                    <option value="2">2 Giờ </option>
                    <option value="3">3 Giờ </option>
                    <option value="4">4 Giờ </option>
                    <option value="5">5 Giờ </option>
                    <option value="6">6 Giờ </option>
                    <option value="7">7 Giờ </option>
                    <option value="8">8 Giờ </option>
                    <option value="9">9 Giờ </option>
                    <option value="10">10 Giờ </option>                                           
                    <option value="11">11 Giờ </option>
                    <option value="12">12 Giờ </option>
                    <option value="13">13 Giờ </option>
                    <option value="14">14 Giờ </option>
                    <option value="15">15 Giờ </option>
                    <option value="16">16 Giờ </option>
                    <option value="17">17 Giờ </option>
                    <option value="18">18 Giờ </option>
                    <option value="19">19 Giờ </option>
                    <option value="20">20 Giờ </option>
                    <option value="21">21 Giờ </option>
                    <option value="22">22 Giờ </option>
                    <option value="23">23 Giờ </option>                                            
                </select>
                </td>
                <td>
                Từ lúc <br/>
                <select>
                    <option value="0">0 Giờ </option>
                    <option value="1">1 Giờ </option>
                    <option value="2">2 Giờ </option>
                    <option value="3">3 Giờ </option>
                    <option value="4">4 Giờ </option>
                    <option value="5">5 Giờ </option>
                    <option value="6">6 Giờ </option>
                    <option value="7">7 Giờ </option>
                    <option value="8">8 Giờ </option>
                    <option value="9">9 Giờ </option>
                    <option value="10">10 Giờ </option>                                           
                    <option value="11">11 Giờ </option>
                    <option value="12">12 Giờ </option>
                    <option value="13">13 Giờ </option>
                    <option value="14">14 Giờ </option>
                    <option value="15">15 Giờ </option>
                    <option value="16">16 Giờ </option>
                    <option value="17">17 Giờ </option>
                    <option value="18">18 Giờ </option>
                    <option value="19">19 Giờ </option>
                    <option value="20">20 Giờ </option>
                    <option value="21">21 Giờ </option>
                    <option value="22">22 Giờ </option>
                    <option value="23">23 Giờ </option>                                            
                </select> <br /><br />
                Đến <br />
                <select>
                    <option value="0">0 Giờ </option>
                    <option value="1">1 Giờ </option>
                    <option value="2">2 Giờ </option>
                    <option value="3">3 Giờ </option>
                    <option value="4">4 Giờ </option>
                    <option value="5">5 Giờ </option>
                    <option value="6">6 Giờ </option>
                    <option value="7">7 Giờ </option>
                    <option value="8">8 Giờ </option>
                    <option value="9">9 Giờ </option>
                    <option value="10">10 Giờ </option>                                           
                    <option value="11">11 Giờ </option>
                    <option value="12">12 Giờ </option>
                    <option value="13">13 Giờ </option>
                    <option value="14">14 Giờ </option>
                    <option value="15">15 Giờ </option>
                    <option value="16">16 Giờ </option>
                    <option value="17">17 Giờ </option>
                    <option value="18">18 Giờ </option>
                    <option value="19">19 Giờ </option>
                    <option value="20">20 Giờ </option>
                    <option value="21">21 Giờ </option>
                    <option value="22">22 Giờ </option>
                    <option value="23">23 Giờ </option>                                            
                </select>
                </td>
                <td>
                Từ lúc <br/>
                <select>
                    <option value="0">0 Giờ </option>
                    <option value="1">1 Giờ </option>
                    <option value="2">2 Giờ </option>
                    <option value="3">3 Giờ </option>
                    <option value="4">4 Giờ </option>
                    <option value="5">5 Giờ </option>
                    <option value="6">6 Giờ </option>
                    <option value="7">7 Giờ </option>
                    <option value="8">8 Giờ </option>
                    <option value="9">9 Giờ </option>
                    <option value="10">10 Giờ </option>                                           
                    <option value="11">11 Giờ </option>
                    <option value="12">12 Giờ </option>
                    <option value="13">13 Giờ </option>
                    <option value="14">14 Giờ </option>
                    <option value="15">15 Giờ </option>
                    <option value="16">16 Giờ </option>
                    <option value="17">17 Giờ </option>
                    <option value="18">18 Giờ </option>
                    <option value="19">19 Giờ </option>
                    <option value="20">20 Giờ </option>
                    <option value="21">21 Giờ </option>
                    <option value="22">22 Giờ </option>
                    <option value="23">23 Giờ </option>                                            
                </select> <br /><br />
                Đến <br />
                <select>
                    <option value="0">0 Giờ </option>
                    <option value="1">1 Giờ </option>
                    <option value="2">2 Giờ </option>
                    <option value="3">3 Giờ </option>
                    <option value="4">4 Giờ </option>
                    <option value="5">5 Giờ </option>
                    <option value="6">6 Giờ </option>
                    <option value="7">7 Giờ </option>
                    <option value="8">8 Giờ </option>
                    <option value="9">9 Giờ </option>
                    <option value="10">10 Giờ </option>                                           
                    <option value="11">11 Giờ </option>
                    <option value="12">12 Giờ </option>
                    <option value="13">13 Giờ </option>
                    <option value="14">14 Giờ </option>
                    <option value="15">15 Giờ </option>
                    <option value="16">16 Giờ </option>
                    <option value="17">17 Giờ </option>
                    <option value="18">18 Giờ </option>
                    <option value="19">19 Giờ </option>
                    <option value="20">20 Giờ </option>
                    <option value="21">21 Giờ </option>
                    <option value="22">22 Giờ </option>
                    <option value="23">23 Giờ </option>                                            
                </select>
                </td>
                <td>
                Từ lúc <br/>
                <select>
                    <option value="0">0 Giờ </option>
                    <option value="1">1 Giờ </option>
                    <option value="2">2 Giờ </option>
                    <option value="3">3 Giờ </option>
                    <option value="4">4 Giờ </option>
                    <option value="5">5 Giờ </option>
                    <option value="6">6 Giờ </option>
                    <option value="7">7 Giờ </option>
                    <option value="8">8 Giờ </option>
                    <option value="9">9 Giờ </option>
                    <option value="10">10 Giờ </option>                                           
                    <option value="11">11 Giờ </option>
                    <option value="12">12 Giờ </option>
                    <option value="13">13 Giờ </option>
                    <option value="14">14 Giờ </option>
                    <option value="15">15 Giờ </option>
                    <option value="16">16 Giờ </option>
                    <option value="17">17 Giờ </option>
                    <option value="18">18 Giờ </option>
                    <option value="19">19 Giờ </option>
                    <option value="20">20 Giờ </option>
                    <option value="21">21 Giờ </option>
                    <option value="22">22 Giờ </option>
                    <option value="23">23 Giờ </option>                                            
                </select> <br /><br />
                Đến <br />
                <select>
                    <option value="0">0 Giờ </option>
                    <option value="1">1 Giờ </option>
                    <option value="2">2 Giờ </option>
                    <option value="3">3 Giờ </option>
                    <option value="4">4 Giờ </option>
                    <option value="5">5 Giờ </option>
                    <option value="6">6 Giờ </option>
                    <option value="7">7 Giờ </option>
                    <option value="8">8 Giờ </option>
                    <option value="9">9 Giờ </option>
                    <option value="10">10 Giờ </option>                                           
                    <option value="11">11 Giờ </option>
                    <option value="12">12 Giờ </option>
                    <option value="13">13 Giờ </option>
                    <option value="14">14 Giờ </option>
                    <option value="15">15 Giờ </option>
                    <option value="16">16 Giờ </option>
                    <option value="17">17 Giờ </option>
                    <option value="18">18 Giờ </option>
                    <option value="19">19 Giờ </option>
                    <option value="20">20 Giờ </option>
                    <option value="21">21 Giờ </option>
                    <option value="22">22 Giờ </option>
                    <option value="23">23 Giờ </option>                                            
                </select>
                </td>
                <td>
                Từ lúc <br/>
                <select>
                    <option value="0">0 Giờ </option>
                    <option value="1">1 Giờ </option>
                    <option value="2">2 Giờ </option>
                    <option value="3">3 Giờ </option>
                    <option value="4">4 Giờ </option>
                    <option value="5">5 Giờ </option>
                    <option value="6">6 Giờ </option>
                    <option value="7">7 Giờ </option>
                    <option value="8">8 Giờ </option>
                    <option value="9">9 Giờ </option>
                    <option value="10">10 Giờ </option>                                           
                    <option value="11">11 Giờ </option>
                    <option value="12">12 Giờ </option>
                    <option value="13">13 Giờ </option>
                    <option value="14">14 Giờ </option>
                    <option value="15">15 Giờ </option>
                    <option value="16">16 Giờ </option>
                    <option value="17">17 Giờ </option>
                    <option value="18">18 Giờ </option>
                    <option value="19">19 Giờ </option>
                    <option value="20">20 Giờ </option>
                    <option value="21">21 Giờ </option>
                    <option value="22">22 Giờ </option>
                    <option value="23">23 Giờ </option>                                            
                </select> <br /><br />
                Đến <br />
                <select>
                    <option value="0">0 Giờ </option>
                    <option value="1">1 Giờ </option>
                    <option value="2">2 Giờ </option>
                    <option value="3">3 Giờ </option>
                    <option value="4">4 Giờ </option>
                    <option value="5">5 Giờ </option>
                    <option value="6">6 Giờ </option>
                    <option value="7">7 Giờ </option>
                    <option value="8">8 Giờ </option>
                    <option value="9">9 Giờ </option>
                    <option value="10">10 Giờ </option>                                           
                    <option value="11">11 Giờ </option>
                    <option value="12">12 Giờ </option>
                    <option value="13">13 Giờ </option>
                    <option value="14">14 Giờ </option>
                    <option value="15">15 Giờ </option>
                    <option value="16">16 Giờ </option>
                    <option value="17">17 Giờ </option>
                    <option value="18">18 Giờ </option>
                    <option value="19">19 Giờ </option>
                    <option value="20">20 Giờ </option>
                    <option value="21">21 Giờ </option>
                    <option value="22">22 Giờ </option>
                    <option value="23">23 Giờ </option>                                            
                </select>
                </td>
                <td>
                Từ lúc <br/>
                <select>
                    <option value="0">0 Giờ </option>
                    <option value="1">1 Giờ </option>
                    <option value="2">2 Giờ </option>
                    <option value="3">3 Giờ </option>
                    <option value="4">4 Giờ </option>
                    <option value="5">5 Giờ </option>
                    <option value="6">6 Giờ </option>
                    <option value="7">7 Giờ </option>
                    <option value="8">8 Giờ </option>
                    <option value="9">9 Giờ </option>
                    <option value="10">10 Giờ </option>                                           
                    <option value="11">11 Giờ </option>
                    <option value="12">12 Giờ </option>
                    <option value="13">13 Giờ </option>
                    <option value="14">14 Giờ </option>
                    <option value="15">15 Giờ </option>
                    <option value="16">16 Giờ </option>
                    <option value="17">17 Giờ </option>
                    <option value="18">18 Giờ </option>
                    <option value="19">19 Giờ </option>
                    <option value="20">20 Giờ </option>
                    <option value="21">21 Giờ </option>
                    <option value="22">22 Giờ </option>
                    <option value="23">23 Giờ </option>                                            
                </select> <br /><br />
                Đến <br />
                <select>
                    <option value="0">0 Giờ </option>
                    <option value="1">1 Giờ </option>
                    <option value="2">2 Giờ </option>
                    <option value="3">3 Giờ </option>
                    <option value="4">4 Giờ </option>
                    <option value="5">5 Giờ </option>
                    <option value="6">6 Giờ </option>
                    <option value="7">7 Giờ </option>
                    <option value="8">8 Giờ </option>
                    <option value="9">9 Giờ </option>
                    <option value="10">10 Giờ </option>                                           
                    <option value="11">11 Giờ </option>
                    <option value="12">12 Giờ </option>
                    <option value="13">13 Giờ </option>
                    <option value="14">14 Giờ </option>
                    <option value="15">15 Giờ </option>
                    <option value="16">16 Giờ </option>
                    <option value="17">17 Giờ </option>
                    <option value="18">18 Giờ </option>
                    <option value="19">19 Giờ </option>
                    <option value="20">20 Giờ </option>
                    <option value="21">21 Giờ </option>
                    <option value="22">22 Giờ </option>
                    <option value="23">23 Giờ </option>                                            
                </select>
                </td>
            </tr>                                    
        </table>
        <p>
          <input  class="button" name="btnthem" type="button" value="Cập nhật" onclick="CapNhatTimeSPA();" />
        </p>
        
        <div id="divTBKQCapNhatTimePRO" class="notification success png_bg" style="display: none;" >
            <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification " alt="close" /></a>
            <div>
               Cập nhật thành công !
            </div>
        </div>
        <div id="divTBKQCapNhatTimePRO" class="notification error png_bg" style="display: none;" >
            <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification " alt="close" /></a>
            <div>
               Cập nhật thất bại !
            </div>
        </div>
     </div>
    
</div> <!-- End Them tgian hoat dong-->                
   
<!-- end list chon thoi gian cho spa -->                           
                        
        </div> <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
     <?php  $this->load->view($lang.'/admin/footer.php');?>    
</div> <!-- End .content-box -->
             
       
            
        </div> <!-- End #main-content -->
        
</body>
  <!-- show danh sách lên view --->
<div id="dialog-confirm" title="Xác đinh" style="display:none;"></div>
<script type="text/x-jquery-tmpl" id="DSHHtimduoc">
 <tr>                                      
    <td>${STT}</td>
    <td>
        <b>ID:</b>${spaID}<br/>
        <b>Tên Spa: </b>${spaName}</br/>
        <b>Tel:</b>${Tel}<br/>
        <b>Địa chỉ:</b>${Address}</br/>
        <b>Email:</b>${Email}</br/>
    </td>
    <td>
        ${Note}    
    </td>
    <td>
        ${Intro}
    </td>   
    <td>${MoreInfo}</td>
    <td>${Location}</td>
    <td>
        <b>Người tạo: </b> ${CreatedBy}<br/>
        <b>Ngày tạo: </b>${CreatedDate}<br>
        <b>Người CN: </b> ${ModifiedBy}<br/>
        <b>Ngày CN: </b>${ModifiedDate}
    </td>
    <td class="">
      <a href="<?php echo base_url('admin/spa/edit/${spaID}');?>" name='btn_edit' id='btn_edit'>
      <p class='icon-edit2 btnedit'></p><img src="<?php echo base_url('resources/images/icons/pencil.png'); ?>" alt="Edit" /></a>
      <a href="javascript:void(0)"  name='btn_del' id='btn_del' onclick="DeleteSpa('${spaID}');">
      <img src="<?php echo base_url('resources/images/icons/cross.png'); ?>" alt="Delete" /><p class='icon-delete btndel'></p></a>
      <a href="javascript:void(0)"  name='btn_del' id='btn_del' onclick="ShowHinhSpa('${spaID}');">
      <img src="<?php echo base_url('resources/images/icons/show.png'); ?>" width="16" alt="Xem hinh" /><p class='icon-delete btndel'></p></a>
    </td>
</tr>
</script>
<script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.tmpl.min.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/Upload.js'); ?>"></script>
 

<!-- Download From www.exet.tk-->
</html>
