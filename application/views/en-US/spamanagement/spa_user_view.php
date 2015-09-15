
  <ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
    <li><span>Quản lý thành viên của SPa</span></li>                       
  </ol>
  <h1>Quản lý thành viên của SPa</h1>
  <p>Cập nhật & chỉnh sửa thông tin thành viên quản trị của SPA</p>

  <div class="row margin-bottom-30">
    <div class="col-md-8">
      <ul class="nav nav-pills" id="ultab">
        <li id = "li_9" class="active"><a href="javascript:void(0)">Tất cả <span class="badge" id="spanallno">0</span></a></li>
        <li id = "li_1"><a href="javascript:void(0)">Admin <span class="badge" id="spanadminno">0</span></a></li>
        <li id = "li_2"><a href="javascript:void(0)">Hỗ trợ <span class="badge" id="spanhotrono">0</span></a></li>
        <li id = "li_3"><a href="javascript:void(0)">Nhân viên <span class="badge" id="spannhanvienno">0</span></a></li>
      </ul>          
    </div>
    <div class="col-md-4">
        <div class="text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addthanhvienmodal">Thêm thành viên</button>
        </div>
    </div>
  </div> 
  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <h4 class="margin-bottom-15">Danh sách thành viên Spa</h4>
        <span id="notifyres"></span>
        <table class="table table-striped table-hover table-bordered" id="tbllistuser">
          <thead>
            <tr>
              <th>#</th>
              <th>Thông tin cá nhân</th>
              <th>TTin Đăng nhập</th>                      
              <th>Trạng thái</th>
              <th>Action</th>
              <th>Xóa</th>
              <th>Ghi chú</th>
            </tr>
          </thead>
          <tbody id="tbodylistuser">
                <!--load data-->             
          </tbody>
        </table>
      </div>
      <ul class="pagination pull-right" id="divpagination">
            <!--show pagination-->
      </ul>  
    </div>
  </div>
  
  <!-- modal add thanh vien spa-->
    <div class="modal fade bs-example-modal-lg" id="addthanhvienmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Thêm thành viên</h4>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-9">
                    <label for="txtsearch">Tên đăng nhập/Email: </label>
                    <input type="text" class="form-control" id="txtsearch" />
                </div>
                <div class="col-md-3">
                    <br />
                    <button type="button" id="btnsearchuser" class="btn btn-info" style="vertical-align: bottom;">Tìm</button>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <span id="notifyresmodal"></span>
                            <table class="table table-striped table-hover table-bordered" id="tbllistusermodal">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Chọn</th>
                                  <th>Họ tên</th>
                                  <th>Tên đăng nhập</th>                      
                                  <th>Email</th>
                                </tr>
                              </thead>
                              <tbody id="tbodylistusermodal">
                                    <!--load data-->             
                              </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <select class="form-control" id="serolemodal" style="display: none;">
                                <option value="adminspa">Admin spa</option>
                                <option value="hotrospa">Hỗ trợ spa</option>
                                <option value="nhanvienspa" selected="selected">Nhân viên spa</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <ul class="pagination pull-right" id="divpaginationmodal">
                                <!--show pagination-->
                            </ul> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-2">
                            <span style="color: red; display: none;" id="notifynochoosemodal">Vui lòng chọn</span>
                        </div>
                    </div>
                    
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnsavemodal" class="btn btn-primary">Lưu lại</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
          </div>
        </div>
      </div>
    </div>
    <!-- end modal add thanh vien spa-->