<ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
     <li><a href="<?php echo base_url();?>">Quản lý Spa</a></li>
    <li class="active">Quản lý Giá</li>            
</ol>
<h2>Quản Lý Giá Dịch Vụ</h2>

<div class="col-sm-12">
    <input type="button" class="btn btn-primary col-sm-2 text-left" id="phuongthucdanhsach" value="Danh sách"/>
    <input type="hidden" id="spaid" value="<?php echo $_SESSION["AccSpa"]["spaid"]?>"/>
    <div id="searching" class="col-sm-10 text-right" >
        <input type="text" class="button" id="keyword"  placeholder="Từ khóa"/>
        <input type="button" class="btn btn-primary" id="phuongthuctimkiem" value="Tìm kiếm"/>
    </div>
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
                  <th>Giá hiện tại (VND)</th>
                  <th>Giá trước đó (VND)</th>
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
            Trạng thái: <img src="../resources/images/active_${Status}.png"/><br />
        </td>
        <td>
            Số chỗ còn lại: ${CurrentVouchers}<br /><br />
            Số chỗ tối đa trong 1 thời điểm: ${MaxProductatOnce} <br /><br />
            Giá trị từ ngày: ${ValidTimeFrom} <br /><br />
            Giá trị đến ngày: ${ValidTimeTo} <br />
        </td>
        <td>
            <span class="name">${Giahientai}</span><br/>
            <span {{if GiaXetDuyet>0}}class="xetduyet"{{/if}} title="Giá đang chờ xét duyệt"> ${GiaXetDuyet}  </span> 
        </td>
        <td>
            ${GiaEdit}
        </td>
        <td style='width: 150px;'>
            Người tạo: ${CreatedBy} <br /><br />
            Ngày tạo : ${CreatedDate}
        </td>
        <td>                                        
             {{if GiaXetDuyet==null}}<a href="javascript:void(0);" onclick="themgia_Product('${ProductID}','${Name}',${Giahientai});" style='padding: 10px ;float: left;' title="Thêm giá"><img src="http://localhost:899/Spa/resources/images/icons/add.png" alt="Thêm giá" /></a>{{/if}}
             <a href="javascript:void(0);" onclick="XemGia_Product('${ProductID}','${Name}',1);" style='padding: 10px ;float: left;'  title="Danh sách giá"><img src="http://localhost:899/Spa/resources/images/icons/show.png" alt="Danh sách giá" />
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
BEGIN DANH SÁCH GIÁ TRƯỚC ĐÓ
//
-->

<div id="divTBKQTim1" style="margin: 15px 0px; display: none;" class="col-sm-12 notification success png_bg">
    <div class="alert alert-success"style="color: #23527c;font-weight: bold;font-size: 12px;" id="notifysuccess1">

    </div>
</div>
<div class="col-sm-12">
  <table id="panelDataPRO1" class="table table-striped content_table"  style="display: none;">
          <thead>
              <tr>
                  <th>STT</th>
                  <th>Tên Dịch Vụ</th>
                  <th>Giá (VND)</th>
                  <th>Create By</th>
                  <th>CreatedDate</th>
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
</div>                
<script id="ListFoundPRO1" type="text/x-jquery-tmpl" > 
    <tr>
        <td>${STT}</td>
        <td>
            ${Name} <br />
        </td>
        <td>
            <span class="name">${Price}</span>
        </td>
        <td>
            ${CreatedBy}
        </td>
        <td>
            ${CreatedDate}
            <input type="hidden" id="id_xemgia" value="${ProductID}"/>
            <input type="hidden" id="name_xemgia" value="${Name}"/>
        </td>
    </tr>
</script> 
<!--
//
END DANH SÁCH GIÁ TRƯỚC ĐÓ
//
-->


















<!--
//
BEGIN THÊM GIÁ
//
-->

<div id="panelDataPRO2" class="col-sm-6"  style="padding: 15px;padding-left:0px;margin: 15px 0px;display: none;background:#F9F9F9">
        <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Tên sản phẩm</label>              
            <input class="col-sm-10 text-input medium-input" type="text" disabled="disabled" id="Name_Gia" />
            <input type="hidden" id="Ma_Product" />
        </p>
         <p class="col-sm-12">
            <label class="col-sm-12" style="padding:0px">Giá hiện tại (VND)</label>              
            <input class="col-sm-5 text-input medium-input" type="text" disabled="disabled" id="Gia_hientai" />
        </p>
        <p class="col-sm-12">
            <label class="col-sm-12"  style="padding:0px">Giá mới (VND)</label>
            <input class="col-sm-5 text-input medium-input" type="text" id="Gia_Them"/>
        </p>
        <p class="col-sm-12">
            <input class="button" id="btngiathem" onclick="submitthemgia();" type="button" value="Thêm giá" />
        </p>

        
</div>              
<div id="divTBKQTim2" style="margin: 15px 0px; display: none;" class="col-sm-12 notification success png_bg">
    <div class="alert alert-success"style="color: #23527c;font-weight: bold;font-size: 12px;" id="notifysuccess2">

    </div>
</div>

<!--
//
END THÊM GIÁ
//
-->

