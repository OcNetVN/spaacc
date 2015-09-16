<ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
    <li><a href="index.html">Quản lý Spa</a></li>
    <li class="active">Thông báo</li>            
  </ol>



<div id="main-content"> <!-- Main Content Section with everything -->
        <div class="clear"></div> <!-- End .clear -->
            <div class="content-box" style="display:block;"><!-- Start Content Box -->
                <div class="content-box-header">
                    <h3>Thông Báo Của SPA</h3>
                    
                        <a href="#tab1" id="prlist" class="default-tab">Tra cứu thông tin</a>
                    
                    <div class="clear"></div>
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">                    
                    <!-------------THEM SAN PHAM--------------->
                    <div class="tab-content default-tab" id="tab1">
                        <form id="form_insert"> 
                            <fieldset> 
                            <table width="100%" >
                                <tr>
                                    <td>
                                        <label>Chọn thực mục cần cập nhật</label>              
                                        <select name="info" id="info">
                                            <option value="">Chọn thông tin  cần cập nhật</option>
                                            <?php
                                                foreach($infotype as $row){?>
                                                    <option value="<?php echo $row->CommonId?>"><?php echo $row->StrValue1; ?></option>
                                             <?php   }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                         <label>Chọn ngôn ngữ</label>
                                         <select name="langue" id="langue">
                                            <option value="">Chọn ngôn ngữ</option>
                                            <?php
                                                foreach($langtype as $row){?>
                                                    <option value="<?php echo $row->CommonId;?>"><?php echo $row->StrValue2; ?></option>
                                             <?php   }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                
                                        <label>Up hình</label>
                                        
                                        <input type="file" class="form-control" name="myfile" id="myfile" >
                        
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                       <input type="button" value="Upload" onclick="UploadFile();"/>                       
                                    </td>
                                    
                                </tr>
                                
                            </table>
                        <div class="notification success png_bg ThemThanhCong" style="display: none;">
                            <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification " alt="close" /></a>
                            <div>
                               Upload thành công !
                            </div>
                        </div>
                        
                        <div class="notification error png_bg ThemThatBai" style="display: none;">
                            <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                            <div>
                                Upload file không thành công !
                            </div>
                        </div>
                            
                        </fieldset>          
                    <div class="clear"></div><!-- End .clear -->  
            </form>
 



    
          
</div>  
<!-------------END THEM SAN PHAM--------------->
<!-------------END THEM SAN PHAM--------------->
</div> <!-- End .content-box-content -->
</div>
               
</div> <!-- End #main-content -->