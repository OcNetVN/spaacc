<ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
    <li><a href="index.html">Quản lý Spa</a></li>
    <li class="active">Quản lý Giá</li>            
</ol>
<h2>Quản Lý Giá Dịch Vụ</h2>

<div class="col-sm-12">
    <input type="button" class="button col-sm-2 text-left" id="phuongthucdanhsach" value="Danh sách"/>
    <input type="hidden" id="spaid" value="<?php echo $_SESSION["AccSpa"]["spaid"]?>"/>
    <div id="searching" class="col-sm-10 text-right">
        <input type="text" class="button" id="keyword"  placeholder="Từ khóa"/>
        <input type="button" class="button" id="phuongthuctimkiem" value="Tìm kiếm"/>
    </div>
</div>
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
                  <th>Giá hiện tại</th>
                  <th>Giá trước đó</th>
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
            <span class="name">${Giahientai} VND</span>     
        </td>
        <td>
            ${GiaEdit}   VND
        </td>
        <td>
            Người tạo: ${CreatedBy} <br /><br />
            Ngày tạo : ${CreatedDate}
        </td>
        <td>                                        
             <a href="javascript:void(0);" onclick="themgia('${ProductID}','${Name}');" style='padding: 10px 5px;float: left;' title="Thêm giá"><img src="http://localhost:899/Spa/resources/images/icons/pencil.png" alt="Thêm giá" /></a>
             <a href="javascript:void(0);" onclick="ViewGia('${ProductID}','${Name}',1);" style='padding: 10px 5px;float: left;'  title="Danh sách giá"><img src="http://localhost:899/Spa/resources/images/icons/show.png" alt="Danh sách giá" />
        </td>
    </tr>





</script> 