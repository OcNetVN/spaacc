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
                                <!-- <tr>
                                    <td>
                                
                                        <label>Up hình</label>
                                        
                                        <input type="file" class="form-control" name="myfile" id="myfile" >
                        
                                    </td>
                                    
                                </tr> -->
                                <!-- <tr>
                                    <td>
                                       <input type="button" value="Upload" onclick="UploadFile();"/>                       
                                    </td>
                                    
                                </tr> -->
                                
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
                    <div class="clear"></div><!-- End .clear   
            </form>
 



    
          
</div>  
<!-------------END THEM SAN PHAM--------------->
<!-------------END THEM SAN PHAM--------------->
</div> <!-- End .content-box-content -->
</div>
               
</div> <!-- End #main-content -->

<div class="row">
    <div class="col-md-12">
      <form role="form" id="templatemo-preferences-form" method="POST" action="">
   
        <div class="row">
          <div class="col-md-12 margin-bottom-15">
            <label for="txtIntro">Cập nhật quảng cáo</label>
            <textarea class="form-control ckeditor" name="txtIntro" rows="7" id="txtIntro" >
                <?php echo $spa_notify->MoreInfo; ?>
            </textarea>
          </div>
        </div>
         
        <div class="col-md-8 col-md-offset-2">
              <span style="color: red; display: none;" id="notifyerr">Sửa không thành công</span>
              <span style="color: blue; display: none;" id="notifysuccess">Sửa thành công</span>
        </div>
        <div class="row templatemo-form-buttons">
          <div class="col-md-12">
            <button type="button" id="btnsave" class="btn btn-primary">Cập nhật</button>
            <button type="button" id="btnreset" class="btn btn-default">Reset</button>    
          </div>
        </div>
      </form>
    </div>
  </div>