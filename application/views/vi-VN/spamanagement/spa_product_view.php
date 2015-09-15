<div class="content-box" style="display:block;"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <h3>Quản lý dịch vụ SPA</h3>
                    
                    <ul class="content-box-tabs">                        
                        <li><a href="#tab2" id="prlist" class="default-tab">Cập nhật SP &  dịch vụ</a></li>
                    </ul>
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    <!-------------THEM SAN PHAM--------------->
                    <div class="tab-content default-tab" id="tab2">
                    
                        <form id="form_insert">
                            
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                            <table width="100%" >
                                <tr>
                                    <td>
                                        <label>Mã dịch vụ :</label>              
                                        <input id="txtProductIDTab2" type="text" readonly="readonly" value="<?php echo $product[0]->ProductID ;?>" class="text-input medium-input" />
                                    </td>
                                    <td>
                                        <label>Tên dịch vụ</label>
                                        <input class="text-input medium-input" type="text" value="<?php echo $product[0]->Name ;?>" id="txtNameTab2" name="txtNameTab2" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                         <label>Chọn SPA cung cấp<span style="color: red;">(*)</span></label>
                                         <a href="javascript:void(0);" class="button" onclick="ChonSpaThemMoi();" >Chọn spa</a>
                                         Mã spa: <span id="spanSpaChonTab2" class="spanSpaChonTab2"><?php echo $product[0]->SpaID ;?></span> 
                                         <span id="spanSpaNameChonTab2"></span> 
                                         <a href="javascript:void(0);" onclick="ShowSpaDetailTab2()">xem chi tiết</a><br/>
                                         <div id="divShowChiTietSpa" class="divSpaDetail" style="display: none;" ></div>
                                         <br />
                                         
                                    </td>
                                </tr>
                                <!--<tr>
                                    <td colspan="2"><label>Chọn nhóm khuyến mãi</label>
                                      
                                        <input type="checkbox"  id="checkpromotion" <?php //echo (substr($product[0]->ProductID, 0, 2)== "12")? "checked":""; ?> readonly="readonly"/>
                                    </td>
                                </tr> -->
                                <tr>
                                    <td colspan="2">
                                    <label>Mô tả dịch vụ</label>
                                    <textarea class="text-input textarea ckeditor" id="txtDescriptionTab2" name="txtDescriptionTab2" cols="79" rows="12">   <?php echo $product[0]->Description ;?>
                                    </textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>    
                                         <label>Trạng thái</label>              
                                        <select name="Status" id="cboStatusTab2" class="small-input">
                                            <?php 
                                            switch($product[0]->Status)
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
                                    </td>
                                    <td>
                                        <label>Loại dịch vụ<span style="color: red;">(*)</span></label>              
                                        <select name="ProductType" id="cboProductTypeTab2" class="" style="width: 350px;">
                                            <?php echo $productypelist ;?>
                                        </select> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                         <p>
                                            <label>Số chỗ còn trống </label>
                                            <input class="text-input small-input" type="text" value="<?php echo $product[0]->CurrentVouchers ;?>" id="CurrentVouchersTab2" name="CurrentVouchers" />
                                        </p>
                                        <p>
                                            <label>Thời lượng </label>
                                            <input class="text-input small-input" type="text" value="<?php echo $product[0]->Duration ;?>" id="DurationTab2" name="Duration" /> Phút
                                        </p>
                                        <p>
                                            <label>Số chỗ tối đa trong 1 thời điễm</label>
                                            <input class="text-input small-input" type="text" value="<?php echo $product[0]->MaxProductatOnce ;?>" id="MaxProductatOnceTab2" name="MaxProductatOnce" />
                                        </p>
                                    </td>
                                    <td>
                                         <p>
                                            <label>Bắt đầu từ lúc</label>
                                            <input class="text-input small-input tcal" type="text" value="<?php echo $product[0]->ValidTimeFrom ;?>" id="ValidTimeFromTab2" name="ValidTimeFrom" />
                                        </p>
                                        <p>
                                            <label>Kết thúc vào lúc</label>
                                            <input class="text-input small-input tcal" type="text" value="<?php echo $product[0]->ValidTimeTo ;?>" id="ValidTimeToTab2" name="ValidTimeTo" />
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <p>
                                            <label>Chính sách của dịch vụ</label>  
                                            <textarea class="ckeditor" id="txtPolicyTab2" name="txtPolicyTab2" cols="79" rows="10">
                                            <?php echo $product[0]->Policy ;?>
                                            </textarea>
                                        </p>
                                        <p>
                                            <label>Một số điều khoản cấm</label>
                                            
                                            <textarea class="ckeditor" id="txtRestrictionTab2" name="txtPolicyTab2" cols="79" rows="8">
                                            <?php echo $product[0]->Restriction ;?>
                                            </textarea>
                                        </p>
                                        <p>
                                            <label>Hướng dẫn </label>                                            
                                            <textarea class="ckeditor" id="txtTipsTab2" name="txtTipsTab2" cols="79" rows="5">
                                            <?php echo $product[0]->Tips ;?>
                                            </textarea>
                                        </p>
                                        <p>
                                            <label>Giá cơ bản<span style="color: red;">(*)</span></label>
                                            <input class="text-input small-input" type="text" id="PriceTab2" name="Price" value="<?php 
                                            if (count($listprice)>0)
                                             echo $listprice[0]->Price ;?>" />
                                        </p>
                                        <p>
                                            <input class="button" id="btnthemPro" name="btnthemPro" type="button" value="Cap nhat" onclick="CapNhatProducts();" />
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
                               Cập nhật thành công cho sản phẩm có mã  <b><?php echo $product[0]->ProductID ;?></b> !
                            </div>
                        </div>
                        
                        <div class="notification error png_bg ThemThatBai" style="display: none;">
                            <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                            <div>
                                Cập nhật không thành công cho sản phẩm có mã <b><?php echo $product[0]->ProductID ;?></b>>!
                            </div>
                        </div>
                        
                        
                        <div id="UploadHinhAnh" class="ThemThanhCong" >
                            
                                    
            <div class="content-box-header" ><h3>Vui lòng chọn hình ảnh cho Sản phẩm / Dịch vụ có mã: <?php echo $product[0]->ProductID ;?></h3> </div>          
       
        <div class="content-box-content">    
            <div class="tab-content default-tab">
                <form role="form" action="#" method="post" enctype="multipart/form-data" >
                <div class="form-group">
                    <input type="file" class="form-control" name="myfile" id="myfile" multiple>
                  </div>      
                  <input type="button" class="btn btn-default" value="Upload" onclick="return doUpload1('<?php echo base_url('/admin/products/UploadFile/')  ?>');" />
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
                    echo "<img src=\"" .base_url($listimage[$i]->URL). "\" width=\"180\"/>";
                    echo "<a href=\"javascript:void(0);\" onclick=\"XoaHinhProduct('" . $listimage[$i]->id . "');\">Xóa</a>";
                    echo "</div>";
                }
                echo "</div>";
             ?>
              </div>
              <div class="clear"></div>
            </div> 
       </div>   
                            
                            
                        </div> <!-- End hinh anh upload-->
                        
                        <div id="" class="ThemThanhCong" >
                             <div class="content-box-header" ><h3>Cấu hình thời gian hoạt động cho dịch vụ & sản phẩm có mã: <?php echo $product[0]->ProductID ;?></h3></div>
       
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
                                        <th>Ngày Lẽ</th>
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
                                  <input  class="button" name="btnthem" type="button" value="Cập nhật" onclick="CapNhatTimePRO();" />
                                </p>
                                
                                <div id="divTBKQCapNhatTimePRO" class="notification success png_bg" style="display: none;" >
                                    <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification " alt="close" /></a>
                                    <div>
                                       Cập nhật giờ hoạt động cho Sản phẩm thành công !
                                    </div>
                                </div>
                             </div>
                            
                        </div> <!-- End Them tgian hoat dong-->
                       
                        <p >
                        <input type="button" onclick="BackToProduct();" value="Quay lại"/>
                        </p>
                        
                    </div>  
                    <!-------------END THEM SAN PHAM--------------->
                    <!-------------END THEM SAN PHAM--------------->
                </div> <!-- End .content-box-content -->
                </div>