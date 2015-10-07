<ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
     <li><a href="<?php echo base_url();?>">Quản lý Spa</a></li>
    <li class="active">Quản lý Sản Phẩm & Dịch Vụ</li>            
</ol>
<h2>Quản Lý Sản Phẩm & Dịch Vụ</h2>

<div class="col-sm-12">
    <input type="button" class="btn btn-primary col-sm-2 text-left" id="phuongthucdanhsach" value="Danh sách"/>
    <input type="button" class="btn btn-primary col-sm-2 text-right" id="new_product" style="float:right" value="Thêm mới"/>
    <input type="hidden" id="spaid" value="<?php echo $_SESSION["AccSpa"]["spaid"]?>"/>
   <!--  <div id="searching" class="col-sm-10 text-right" >
        <input type="text" class="button" id="keyword"  placeholder="Từ khóa"/>
        <input type="button" class="btn btn-primary" id="phuongthuctimkiem" value="Tìm kiếm"/>
    </div> -->
</div>

<div id="timkiemnangcao" class="col-sm-12">
    <table>
        <tr>
            <td class="lable_with"><label>Mã dịch vụ </label> </td>
            <td class="col_with">
               <input type="text" name="spaProductID" id="txtProductID" class="class-input-text">
            </td> 
            <td class="lable_with"><label>Tên dịch vụ </label></td>
            <td class="col_with">
                <input type="text" name="txtName" id="txtName" class="class-input-text">
            </td> 

            <td class="lable_with"><label>Loại dịch vụ </label></td>
            <td class="col_with">
                <select id="cboProductType" name="cboProductType" style="min-width: 320px;">

                </select> 
            </td>
        </tr>
        <tr>
            <td class="lable_with">
                 <input type="button" class="btn btn-primary" id="submit_timkiemnangcao" value="Tìm kiếm"/>
            </td>
            <td class="lable_with">
                 <input type="button" class="btn btn-primary" id="submit_reset" value="Reset"/>
            </td>
        </tr>
    </table>

</div>





<!--
//
BEGIN THÔNG TIN GIÁ DỊCH VỤ
//
-->
<div id="divTBKQTim" style="margin: 15px 0px; display: none;" class="col-sm-12 notification success png_bg">
    <div class="alert alert-success"style="color: #23527c;font-weight: bold;font-size: 12px;" id="notifysuccess">

    </div>
</div>
<div class="col-sm-12">
  <table id="panelDataPRO" class="table table-striped content_table"  style="display: none;">
          <thead>
              <tr>
                  <th>STT</th>
                  <th>Tên dịch vụ</th>
                   <th>Thông tin dịch vụ</th>
                  <th>Thông tin số chỗ</th>
                  <th>Thông Tin cập nhật</th>
                  <th>Thông Tin khởi tạo</th>
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
</div>
 <script id="ListFoundPRO" type="text/x-jquery-tmpl" >
    <tr>
        <td>${STT}</td>
        <td style='width: 100px;'><span class="name">${Name}</span><br /><br />
            Mã : ${ProductID}<br>
        </td>
        <td style='width: 150px;'>
            Loại : ${Loai}<br /><br />
            Thời lượng : ${Duration} phút<br /><br />
        </td>
        <td>
            Số chỗ còn lại: ${CurrentVouchers}<br /><br />
            Số chỗ tối đa trong 1 thời điểm: <input type='text' name='socho_toida' onchange="change_MaxProductatOnce(this.value,'${ProductID}','${Name}')" id='socho_toida' class='class-input-text' value='${MaxProductatOnce}'> <br /><br />
            Giá trị từ ngày: ${ValidTimeFrom} <br /><br />
            Giá trị đến ngày: ${ValidTimeTo} <br />
        </td>
        <td style='width: 150px;'>
            Người cập nhật: ${ModifiedBy} <br /><br />
            Ngày cập nhật : ${ModifiedDate}
        </td>
        <td style='width: 150px;'>
            Người tạo: ${CreatedBy} <br /><br />
            Ngày tạo : ${CreatedDate}
        </td>
        <td> 
             <a href="javascript:void(0);" onclick="Update_Trangthai('${ProductID}','${Status}','${Name}');" id="Trangthai_${ProductID}" style='padding: 10px ;float: left;' title="Trạng thái"><img src="../resources/images/active_${Status}.png" id="img_${ProductID}"/></a>                                       
             <a href="javascript:void(0);" onclick="Edit_Product('${ProductID}');" style='padding: 10px ;float: left;' title="Edit"><img src="http://localhost:899/Spa/resources/images/icons/pencil.png" alt="Edit" /></a>
        </td>
    </tr>
</script> 
<!--
//
END THÔNG TIN GIÁ DỊCH VỤ
//
-->




<!--
//
BEGIN THÔNG TIN GIÁ DỊCH VỤ SEARCH
//
-->
<div id="divTBKQTim_Search" style="margin: 15px 0px; display: none;" class="col-sm-12 notification success png_bg">
    <div class="alert alert-success"style="color: #23527c;font-weight: bold;font-size: 12px;" id="notifysuccess_Search">

    </div>
</div>
<div class="col-sm-12">
  <table id="panelDataPRO_Search" class="table table-striped content_table"  style="display: none;">
          <thead>
              <tr>
                  <th>STT</th>
                  <th>Tên dịch vụ</th>
                   <th>Thông tin dịch vụ</th>
                  <th>Thông tin số chỗ</th>
                  <th>Thông Tin cập nhật</th>
                  <th>Thông Tin khởi tạo</th>
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
                          <select id="cboPageNoPRO_Search">
                          </select>
                      </div>
                  </td>
              </tr>
          </tfoot>

          
  </table>
</div>
 <script id="ListFoundPRO_Search" type="text/x-jquery-tmpl" >
     <tr>
        <td>${STT}</td>
        <td style='width: 100px;'><span class="name">${Name}</span><br /><br />
            Mã : ${ProductID}<br>
        </td>
        <td style='width: 150px;'>
            Loại : ${Loai}<br /><br />
            Thời lượng : ${Duration} phút<br /><br />
        </td>
        <td>
            Số chỗ còn lại: ${CurrentVouchers}<br /><br />
            Số chỗ tối đa trong 1 thời điểm: <input type='text' name='socho_toida' onchange="change_MaxProductatOnce(this.value,'${ProductID}','${Name}')" id='socho_toida' class='class-input-text' value='${MaxProductatOnce}'> <br /><br />
            Giá trị từ ngày: ${ValidTimeFrom} <br /><br />
            Giá trị đến ngày: ${ValidTimeTo} <br />
        </td>
        <td style='width: 150px;'>
            Người cập nhật: ${ModifiedBy} <br /><br />
            Ngày cập nhật : ${ModifiedDate}
        </td>
        <td style='width: 150px;'>
            Người tạo: ${CreatedBy} <br /><br />
            Ngày tạo : ${CreatedDate}
        </td>
        <td> 
             <a href="javascript:void(0);" onclick="Update_Trangthai('${ProductID}','${Status}','${Name}');" id="Trangthai_${ProductID}" style='padding: 10px ;float: left;' title="Trạng thái"><img src="../resources/images/active_${Status}.png" id="img_${ProductID}"/></a>                                       
             <a href="javascript:void(0);" onclick="Edit_Product('${ProductID}');" style='padding: 10px ;float: left;' title="Edit"><img src="http://localhost:899/Spa/resources/images/icons/pencil.png" alt="Edit" /></a>
        </td>
    </tr>
</script> 
<!--
//
END THÔNG TIN GIÁ DỊCH VỤ SEARCH
//
-->








<!--
//
BEGIN THÊM SẢN PHẨM
//
-->
<div id="panelThem" class="col-sm-12"  style="padding: 15px;padding-left:0px;margin: 15px 0px;display: none;background:#F9F9F9">
        <h3 class="tieude_capnhat">Thêm Sản Phẩm & Dịch Vụ </h3>
        <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Tên dịch vụ</label>              
            <input class="col-sm-3 text-input medium-input" type="text" id="Add_Name_product" />
            <span class="notify_error_ngang" style="display: none;" id="notify_name_add"><span class="caret_muiten_ngang"></span>Vui lòng nhập Tên dịch vụ</span> 
        </p><br/>
        <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Loại dịch vụ</label>              
            <select id="cboProductType_Add" name="cboProductType_Add" style="min-width: 320px;float: left;">

            </select> 
            <span class="notify_error_ngang" style="display: none;" id="notify_loai_add"><span class="caret_muiten_ngang"></span>Vui lòng chọn loại dịch vụ</span> 
        </p><br/>
        <p class="col-sm-12">
            <label >Mô tả</label>       
            <textarea class="text-input textarea ckeditor" id="Add_Des_product" name="Add_Des_product" cols="79" rows="15"></textarea>
        </p><br/>
        <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Số chỗ còn lại</label>              
            <input class="col-sm-3 text-input medium-input" type="text" id="Add_CurrentVouchers_product" />
            <span class="notify_error_ngang" style="display: none;" id="notify_socho_add"><span class="caret_muiten_ngang"></span>Vui lòng nhập Số chỗ</span> 
        </p><br/>
        <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Số chỗ tối đa trong 1 thời điểm</label>              
            <input class="col-sm-3 text-input medium-input" type="text" id="Add_MaxProductatOnce_product" />
            <span class="notify_error_ngang" style="display: none;" id="notify_sochotoida_add"><span class="caret_muiten_ngang"></span>Vui lòng nhập Số chỗ tối đa</span> 
        </p><br/>
        <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Thời lượng</label>              
            <input class="col-sm-3 text-input medium-input" type="text" id="Add_Duration_product" />
            <span class="notify_error_ngang" style="display: none;" id="notify_thoiluong_add"><span class="caret_muiten_ngang"></span>Vui lòng nhập Thời lượng</span> 
        </p><br/>
        <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Giá</label>              
            <input class="col-sm-3 text-input medium-input" type="text" id="Add_Price_product" />
            <span class="notify_error_ngang" style="display: none;" id="notify_gia_add"><span class="caret_muiten_ngang"></span>Vui lòng nhập Giá</span> 
        </p><br/>
        <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Bắt đầu từ ngày</label>              
            <input class="col-sm-3 text-input medium-input" type="text" id="Add_ValidTimeFrom_product" name="Add_ValidTimeFrom_product"/>
            <span class="notify_error_ngang" style="display: none;" id="notify_time_batdau_add"><span class="caret_muiten_ngang"></span>Vui lòng nhập Thời gian bắt đâu</span> 
            
        </p><br/>
        <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Kết thúc đến ngày</label>              
            <input class="col-sm-3 text-input medium-input" type="text" id="Add_ValidTimeTo_product" name="Add_ValidTimeTo_product" />
            <span class="notify_error_ngang" style="display: none;" id="notify_time_ketthuc_add"><span class="caret_muiten_ngang"></span>Vui lòng nhập Thời gian kết thúc</span> 
            <span class="notify_error_ngang" style="display: none;" id="notify_time_ktbd_add"><span class="caret_muiten_ngang"></span>Thời gian kết thúc phải lớn hơn Thời gian bắt đầu</span> 
        </p><br/>
        <p class="col-sm-12">
            <label >Chính sách</label>       
            <textarea class="text-input textarea ckeditor" id="Add_Policy_product" name="Add_Policy_product" cols="79" rows="15"></textarea>
        </p><br/>
        <p class="col-sm-12">
            <label >Điều cấm</label>       
            <textarea class="text-input textarea ckeditor" id="Add_Restriction_product" name="Add_Restriction_product" cols="79" rows="15"></textarea>
        </p><br/>
        <p class="col-sm-12">
            <label >Hướng dẫn</label>       
            <textarea class="text-input textarea ckeditor" id="Add_Tips_product" name="Add_Tips_product" cols="79" rows="15"></textarea>
        </p><br/>


        <div class="row">
          <div class="col-md-12">
                <div class="alert alert-danger"style="color: red; display: none;" id="notifyerr_thongtin_add">
                  <span >Thêm thất bại</span>
                </div>
                <div class="alert alert-success"style="color: blue; display: none;" id="notifysuccess_thongtin_add">
                  <span >Thêm thành công</span>
                </div>
          </div>
        </div>
        <p class="col-sm-12">
            <input class="btn btn-primary" id="btn_add_thongtin" onclick="submit_add_thongtin();" type="button" value="Thêm" />
            <input type="hidden" id="ProductID_result"/>
        </p>





        <div id="UploadHinhAnh" class="col-sm-12">        
              <div class="content-box-header" ><h3 class="tieude_capnhat">Hình ảnh cho Sản phẩm / Dịch vụ </h3> </div>          
              <div class="content-box-content">    
                  <div class="tab-content default-tab">
                      <form role="form" action="#" method="post" enctype="multipart/form-data" >
                      <div class="form-group">
                          <input type="file" class="form-control" name="myfile" id="myfile" multiple>
                        </div>      
                        <input type="button" class="btn btn-default" value="Upload" onclick="return doUpload1('<?php echo base_url('/admin/products/UploadFile/')  ?>');" />
                        <input type="button" class="btn btn-default" value="Cancel" onclick="cancleUpload();"/>
                      </form>
                      <hr>
                      <!-- <div id="progress-group">
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
                      </div> -->
                    <div class="clear"></div>
                    <input type="hidden" id="didUrlImage"/>
                     
                    <div id="divXemLaiHinhDaUp" >
                  
                    </div>
                    <p class="col-sm-12">
                        <input class="btn btn-primary" id="btngiathem" onclick="submit_update();" type="button" value="Thêm" />
                    </p>
                    <div class="clear"></div>
                  </div> 
             </div>   
          </div> <!-- End hinh anh upload-->
          <div class="clear"></div>
          <div id="" class="col-sm-12" style="margin-top:15px;">
             <div class="content-box-header"><h3 class="tieude_capnhat">Cấu hình thời gian hoạt động cho dịch vụ & sản phẩm </h3></div>
             <div class="content-box-content">
                  <div id="divLoadthoigianDV_Add" >
                
                  </div> 
                  <div class="row">
                    <div class="col-md-12">
                          <div class="alert alert-danger"style="color: red; display: none;" id="notify_product_time_add">
                            <span >Bạn chưa thêm mới thông tin dịch vụ & sản phẩm</span>
                          </div>
                          <div class="alert alert-danger"style="color: red; display: none;" id="notifyerr_time_add">
                            <span >Thêm thất bại</span>
                          </div>
                          <div class="alert alert-success"style="color: blue; display: none;" id="notifysuccess_time_add">
                            <span >Thêm thành công</span>
                          </div>
                    </div>
                  </div>
                  <p class="col-sm-12">
                      <input class="btn btn-primary" id="btn_add_time" onclick="submit_add_time();" type="button" value="Thêm" />
                  </p>              
             </div>
          </div>   
</div>              
<div id="divTBKQThem" style="margin: 15px 0px; display: none;" class="col-sm-12 notification success png_bg">
    <div class="alert alert-success"style="color: #23527c;font-weight: bold;font-size: 12px;" id="notifysuccess2">
        
    </div>
</div>



<!--
//
END CẬP NHẬT THÔNG TIN 
//
-->
<!--
//
END DANH SÁCH GIÁ TRƯỚC ĐÓ
//
-->

















<!--
//
BEGIN CẬP NHẬT THÔNG TIN 
//
-->
<div id="panelDataPRO2" class="col-sm-12"  style="padding: 15px;padding-left:0px;margin: 15px 0px;display: none;background:#F9F9F9">
        <h3 class="tieude_capnhat">Cập Nhật Sản Phẩm & Dịch Vụ </h3>
        <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px" id="Edit_title_product"></label>              
            <input type="hidden" id="Ma_Product" />
        </p>
        <p class="col-sm-12">
            <label >Mô tả</label>       
            <textarea class="text-input textarea ckeditor" id="Edit_Des_product" name="Edit_Des_product" cols="79" rows="15"></textarea>
        </p><br/>
        <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Số chỗ còn lại</label>              
            <input class="col-sm-3 text-input medium-input" type="text" id="Edit_CurrentVouchers_product" />
            <span class="notify_error_ngang" style="display: none;" id="notify_socho"><span class="caret_muiten_ngang"></span>Vui lòng nhập Số chỗ</span> 
        </p><br/>
        <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Số chỗ tối đa trong 1 thời điểm</label>              
            <input class="col-sm-3 text-input medium-input" type="text" id="Edit_MaxProductatOnce_product" />
            <span class="notify_error_ngang" style="display: none;" id="notify_sochotoida"><span class="caret_muiten_ngang"></span>Vui lòng nhập Số chỗ tối đa</span> 
        </p><br/>
        <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Thời lượng</label>              
            <input class="col-sm-3 text-input medium-input" type="text" id="Edit_Duration_product" />
            <span class="notify_error_ngang" style="display: none;" id="notify_thoiluong"><span class="caret_muiten_ngang"></span>Vui lòng nhập Thời lượng</span> 
        </p><br/>
        <!-- <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Giá</label>              
            <input class="col-sm-3 text-input medium-input" type="text" id="Edit_Price_product" />
        </p><br/> -->
        <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Bắt đầu từ ngày</label>              
            <input class="col-sm-3 text-input medium-input" type="text" id="Edit_ValidTimeFrom_product" name="Edit_ValidTimeFrom_product"/>
            <span class="notify_error_ngang" style="display: none;" id="notify_time_batdau"><span class="caret_muiten_ngang"></span>Vui lòng nhập Thời gian bắt đâu</span> 
            
        </p><br/>
        <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Kết thúc đến ngày</label>              
            <input class="col-sm-3 text-input medium-input" type="text" id="Edit_ValidTimeTo_product" name="Edit_ValidTimeTo_product"/>
            <span class="notify_error_ngang" style="display: none;" id="notify_time_ketthuc"><span class="caret_muiten_ngang"></span>Vui lòng nhập Thời gian kết thúc</span> 
            <span class="notify_error_ngang" style="display: none;" id="notify_time_ktbd_update"><span class="caret_muiten_ngang"></span>Thời gian kết thúc phải lớn hơn Thời gian bắt đầu</span> 
        </p><br/>
        <p class="col-sm-12">
            <label >Chính sách</label>       
            <textarea class="text-input textarea ckeditor" id="Edit_Policy_product" name="Edit_Policy_product" cols="79" rows="15"></textarea>
        </p><br/>
        <p class="col-sm-12">
            <label >Điều cấm</label>       
            <textarea class="text-input textarea ckeditor" id="Edit_Restriction_product" name="Edit_Restriction_product" cols="79" rows="15"></textarea>
        </p><br/>
        <p class="col-sm-12">
            <label >Hướng dẫn</label>       
            <textarea class="text-input textarea ckeditor" id="Edit_Tips_product" name="Edit_Tips_product" cols="79" rows="15"></textarea>
        </p><br/>


        <div class="row">
          <div class="col-md-12">
                <div class="alert alert-danger"style="color: red; display: none;" id="notifyerr_thongtin">
                  <span >Cập nhật thất bại</span>
                </div>
                <div class="alert alert-success"style="color: blue; display: none;" id="notifysuccess_thongtin">
                  <span >Cập nhật thành công</span>
                </div>
          </div>
        </div>
        <p class="col-sm-12">
            <input class="btn btn-primary" id="btngiathem" onclick="submit_update_thongtin();" type="button" value="Cập nhật" />
        </p>





        <div id="UploadHinhAnh" class="col-sm-12" >        
              <div class="content-box-header" ><h3 class="tieude_capnhat">Hình ảnh cho Sản phẩm / Dịch vụ </h3> </div>          
              <div class="content-box-content">    
                  <div class="tab-content default-tab">
                      <form role="form" action="#" method="post" enctype="multipart/form-data" >
                      <div class="form-group">
                          <input type="file" class="form-control" name="myfile" id="myfile" multiple>
                        </div>      
                        <input type="button" class="btn btn-default" value="Upload" onclick="return doUpload1('<?php echo base_url('/admin/products/UploadFile/')  ?>');" />
                        <input type="button" class="btn btn-default" value="Cancel" onclick="cancleUpload();"/>
                      </form>
                      <hr>
                      <!-- <div id="progress-group">
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
                      </div> -->
                    <div class="clear"></div>
                    <input type="hidden" id="didUrlImage"/>
                     
                    <div id="divXemLaiHinhDaUp" >
                  
                    </div>
                    <p class="col-sm-12">
                        <input class="btn btn-primary" id="btngiathem" onclick="submit_update();" type="button" value="Cập nhật" />
                    </p>
                    <div class="clear"></div>
                  </div> 
             </div>   
          </div> <!-- End hinh anh upload-->
          <div class="clear"></div>
          <div id="" class="col-sm-12" style="margin-top:15px;">
             <div class="content-box-header"><h3 class="tieude_capnhat">Cấu hình thời gian hoạt động cho dịch vụ & sản phẩm </h3></div>
             <div class="content-box-content">
                  <div id="divLoadthoigianDV" >
                
                  </div> 
                  <div class="row">
                    <div class="col-md-12">
                          <div class="alert alert-danger"style="color: red; display: none;" id="notifyerr_time">
                            <span >Cập nhật thất bại</span>
                          </div>
                          <div class="alert alert-success"style="color: blue; display: none;" id="notifysuccess_time">
                            <span >Cập nhật thành công</span>
                          </div>
                    </div>
                  </div>
                  <p class="col-sm-12">
                      <input class="btn btn-primary" id="btngiathem" onclick="submit_update_time();" type="button" value="Cập nhật" />
                  </p>              
             </div>
          </div>




        
</div>              
<div id="divTBKQTim2" style="margin: 15px 0px; display: none;" class="col-sm-12 notification success png_bg">
    <div class="alert alert-success"style="color: #23527c;font-weight: bold;font-size: 12px;" id="notifysuccess2">
        
    </div>
</div>



<!--
//
END CẬP NHẬT THÔNG TIN 
//
-->