<ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
     <li><a href="<?php echo base_url();?>">Quản lý Spa</a></li>
    <li class="active">Quản lý Khuyến Mãi</li>            
</ol>
<h2>Quản Lý Khuyến Mãi</h2>

<div class="col-sm-12">
    <input type="button" class="btn btn-primary col-sm-2 text-left" id="phuongthucdanhsach" value="Danh sách"/>
    <input type="button" class="btn btn-primary col-sm-2 text-right" id="new_promotion" style="float:right" value="Thêm mới"/>
    <input type="hidden" id="spaid" value="<?php echo $_SESSION["AccSpa"]["spaid"]?>"/>
</div>

<div id="timkiemnangcao" class="col-sm-12">
    <table>
        <tr>
            <td class="lable_with"><label>Mã khuyến mãi </label> </td>
            <td class="col_with">
               <input type="text" name="spaProductID" id="txtPromotionID" class="class-input-text">
            </td> 
            <td class="lable_with"><label>Tên khuyến mãi </label></td>
            <td class="col_with">
                <input type="text" name="txtName" id="txtName" class="class-input-text">
            </td> 

            <td class="lable_with"><label>Loại khuyến mãi </label></td>
            <td class="col_with">
                <select id="cboPromotionType" name="cboPromotionType" style="min-width: 320px;">
                    <option value="">Khuyến mãi</option>
                    <option value="KMDB">Khuyến mãi đặc biệt</option>
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
BEGIN THÔNG TIN KHUYẾN MÃI
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
                  <th>Thông tin khuyến mãi</th>
                  <th>Thông tin dịch vụ</th>
                  <th>Thời gian bắt đầu</th>
                  <th>Thời gian kết thúc</th>
                  <th>Thông tin khởi tạo</th>
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
        <td style='width: 200px;'><span class="name">${PromotionName}</span><br /><br />
            <span >Mã : ${PromotionId}</span><br /><br />
            {{if PromotionType=="KMDB"}} <b>Khuyến mãi đặc biệt : </b><img src="../resources/images/KMDB.png"style="width: 15px;margin-top: -2px;"/>{{else}} Khuyến mãi đặc biệt : <img src="../resources/images/no_KMDB.png" style="width: 12px;margin-top: -2px;"/>{{/if}}
        </td>
        <td style='width: 200px;'>
            <span id="Ma_Promotion_${PromotionId}"></span><br /><br />
        </td>
        <td>
            ${BeginDateTime}<br /><br />
        </td>
        <td>
            ${EndDateTime}<br /><br />
            <span id="Hoatdong_${PromotionId}"></span><br /><br />
        </td>
        <td>
             Người tạo : ${CreatedBy}<br /><br />
             Ngày tạo : ${CreatedDate}<br /><br />
        </td>
    </tr>
</script> 
<!--
//
END THÔNG TIN KHUYẾN MÃI
//
-->




<!--
//
BEGIN THÔNG TIN KHUYẾN MÃI SEARCH
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
                  <th>Thông tin khuyến mãi</th>
                  <th>Thông tin dịch vụ</th>
                  <th>Thời gian bắt đầu</th>
                  <th>Thời gian kết thúc</th>
                  <th>Thông tin khởi tạo</th>
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
        <td style='width: 200px;'><span class="name">${PromotionName}</span><br /><br />
            <span >Mã : ${PromotionId}</span><br /><br />
            {{if PromotionType=="KMDB"}} <b>Khuyến mãi đặc biệt : </b><img src="../resources/images/KMDB.png"style="width: 15px;margin-top: -2px;"/>{{else}} Khuyến mãi đặc biệt : <img src="../resources/images/no_KMDB.png" style="width: 12px;margin-top: -2px;"/>{{/if}}
        </td>
        <td style='width: 200px;'>
            <span id="Ma_Promotion_Search_${PromotionId}"></span><br /><br />
        </td>
        <td>
            ${BeginDateTime}<br /><br />
        </td>
        <td>
            ${EndDateTime}<br /><br />
            <span id="Hoatdong_Search_${PromotionId}"></span><br /><br />
        </td>
        <td>
             Người tạo : ${CreatedBy}<br /><br />
             Ngày tạo : ${CreatedDate}<br /><br />
        </td>
    </tr>
</script> 
<!--
//
END THÔNG TIN KHUYẾN MÃI SEARCH
//
-->








<!--
//
BEGIN THÊM SẢN PHẨM
//
-->
<div id="panelThem" class="col-sm-12"  style="padding: 15px;padding-left:0px;margin: 15px 0px;display: none;background:#F9F9F9">
        <h3 class="tieude_capnhat">Thêm Khuyến Mãi </h3>
        <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Tên khuyến mãi</label>              
            <input class="col-sm-3 text-input medium-input" type="text" id="Add_PromotionName_promotion" />
            <span class="notify_error_ngang" style="display: none;" id="notify_name_add"><span class="caret_muiten_ngang"></span>Vui lòng nhập Tên khuyến mãi</span> 
        </p><br/>
        <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Số lượng tối đa </label>              
            <input class="col-sm-3 text-input medium-input" type="text" id="Add_Quantity_promotion"/>
            <span class="notify_error_ngang" style="display: none;" id="notify_sochotoida_add"><span class="caret_muiten_ngang"></span>Vui lòng nhập Số lượng tối đa</span> 
        </p><br/>
        <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Bắt đầu từ ngày</label>              
            <input class="col-sm-3 text-input medium-input" type="text"  id="Add_BeginDateTime_promotion" name="Add_BeginDateTime_promotion" />
            <span class="notify_error_ngang" style="display: none;" id="notify_time_batdau_add"><span class="caret_muiten_ngang"></span>Vui lòng nhập Thời gian bắt đâu</span> 
            
        </p><br/>
        <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Kết thúc đến ngày</label>              
            <input class="col-sm-3 text-input medium-input" type="text"  id="Add_EndDateTime_promotion"   name="Add_EndDateTime_promotion" />
            <span class="notify_error_ngang" style="display: none;" id="notify_time_ketthuc_add"><span class="caret_muiten_ngang"></span>Vui lòng nhập Thời gian kết thúc</span> 
            <span class="notify_error_ngang" style="display: none;" id="notify_time_ktbd_add"><span class="caret_muiten_ngang"></span>Thời gian kết thúc phải lớn hơn Thời gian bắt đầu</span> 
        </p><br/>
        
        <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Chọn sản phẩm</label>

            <span id="chon_sanpham"></span>
            <span class="notify_error_ngang" style="display: none;" id="notify_loai_add"><span class="caret_muiten"></span>Vui lòng chọn sản phẩm</span> 
        </p><br/>
        <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Tổng tiền</label>              
            <input class="col-sm-3 text-input medium-input" type="text" id="Add_TotalAmount_promotion" />
            <span class="notify_error_ngang" style="display: none;" id="notify_gia_add"><span class="caret_muiten_ngang"></span>Vui lòng nhập Tổng tiền</span>
            <span class="notify_error_ngang" style="display: none;" id="notify_over_add"><span class="caret_muiten_ngang"></span>Tổng tiền không được vượt quá 50%</span> 
        </p><br/>
        <p class="col-sm-12">
            <label >Thông tin khuyến mãi</label>       
            <textarea class="text-input textarea ckeditor" id="Add_PromoText_promotion" name="Add_PromoText_promotion" cols="79" rows="15"></textarea>
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
            <input class="btn btn-primary" id="btn_add_thongtin" onclick="submit_add_promotion();" type="button" value="Thêm" />
            <!-- <input type="hidden" id="PromotionID_result"/> -->
        </p>
         
</div>              
<div id="divTBKQThem" style="margin: 15px 0px; display: none;" class="col-sm-12 notification success png_bg">
    <div class="alert alert-success"style="color: #23527c;font-weight: bold;font-size: 12px;" id="notifysuccess2">
        
    </div>
</div>



<!--
//
END THÊM THÔNG TIN 
//
-->