<ol class="breadcrumb">
<li><a href="#">FCSE Spa</a></li>
<li><a href="#">Tài chính</a></li>
<li class="active">Booking online</li>            
</ol>
<h1>Tìm kiếm các booking</h1>
	<div class="row">
      <div class="col-md-3 margin-bottom-15">
        <label for="txtFromDate">From Date</label>
        <input type="text" class="form-control" id="txtFromDate" value="2015-01-13 16:17:46">  
                            
      </div>
      <div class="col-md-3 margin-bottom-15">
          <label for="txtToDate">To Date</label>
        <input type="text" class="form-control" id="txtToDate" value="2015-01-15 16:17:46">
      </div>
      <div class="col-md-3 margin-bottom-15">
          <label for="">Trạng thái</label>
          <br>
          <select>
              <option value="">Tất cả</option>
              <option value="">Đang active</option>
              <option value="">Đã quá hạn</option>
              <option value="">Đã hủy</option>
          </select>
      </div>
      <div class="col-md-2 margin-bottom-15">
         <br> 
        <button type="button" class="btn btn-primary" onclick="XemKetQua();">Xem Kết quả</button>
      </div>
    </div>

    <div class="row">
            <div class="col-md-12">
              <div id="DivBooking" style="display:none;">



             <!--  <div class="btn-group pull-right" id="templatemo_sort_btn">
                <button type="button" class="btn btn-default">Sắp xếp theo</button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Ngày book</a></li>
                  <li><a href="#">Sản phẩm</a></li>
                  <li><a href="#">Người đặt</a></li>
                </ul>
              </div> -->



               <div class="btn-group pull-right" id="templatemo_sort_btn">
                              <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Sắp xếp theo
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Ngày book</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Sản phẩm</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Người đặt</a></li>
                              </ul>
                </div>





              <div class="table-responsive" >
                <h4 class="margin-bottom-15">Danh sách booking tìm thấy</h4>
                <table class="table table-striped table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Mã Booking</th>
                      <th>TTin book</th>
                      <th>Tổng tiền</th>
                      <th>Action</th>
                      <th>Ghi chú</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Booking ID: 99#1
                          <br />Người book: admin
                          <br />Ngày Book: 2015-01-20 11:01:12
                      </td>
                      <td>Sản phẩm: 0220141202000027
                          <br /> Từ: 2015-01-22 12:15:00
                          <br /> Đến: 2015-01-22 13:45:00
                      </td>
                      <td>450.000</td>
                      <td>
                        <!-- Split button -->
                                                            
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Action
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Hủy</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Hoàn tất</a></li>
                              </ul>
                            </div>
                      </td>
                      <td>Đã thanh toán</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Booking ID: 99#2
                          <br />Người book: admin
                          <br />Ngày Book: 2015-01-20 11:01:12
                      </td>
                      <td>Sản phẩm: 0220141202000027
                          <br /> Từ: 2015-01-22 12:15:00
                          <br /> Đến: 2015-01-22 13:45:00
                      </td>
                      <td>450.000</td>
                      <td>
                        <!-- Split button -->
                        <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Action
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Hủy</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Hoàn tất</a></li>
                              </ul>
                            </div>
                      </td>
                      <td>Đã thanh toán</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Booking ID: 99#3
                          <br />Người book: admin
                          <br />Ngày Book: 2015-01-20 11:01:12
                      </td>
                      <td>Sản phẩm: 0220141202000027
                          <br /> Từ: 2015-01-22 12:15:00
                          <br /> Đến: 2015-01-22 13:45:00
                      </td>
                      <td>450.000</td>
                      <td>
                        <!-- Split button -->
                        <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Action
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Hủy</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Hoàn tất</a></li>
                              </ul>
                            </div>
                      </td>
                      <td>Đã thanh toán</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Booking ID: 99#1
                          <br />Người book: admin
                          <br />Ngày Book: 2015-01-20 11:01:12
                      </td>
                      <td>Sản phẩm: 0220141202000027
                          <br /> Từ: 2015-01-22 12:15:00
                          <br /> Đến: 2015-01-22 13:45:00
                      </td>
                      <td>450.000</td>
                      <td>
                        <!-- Split button -->
                        <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Action
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Hủy</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Hoàn tất</a></li>
                              </ul>
                            </div>
                      </td>
                      <td>Đã thanh toán</td>
                    </tr>                   
                  </tbody>
                </table>
              </div>
              <ul class="pagination pull-right">
                <li class="disabled"><a href="#">&laquo;</a></li>
                <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                <li><a href="#">2 <span class="sr-only">(current)</span></a></li>
                <li><a href="#">3 <span class="sr-only">(current)</span></a></li>
                <li><a href="#">4 <span class="sr-only">(current)</span></a></li>
                <li><a href="#">5 <span class="sr-only">(current)</span></a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>  
              </div>
            </div>
          </div>

          <!-- Modal -->
      <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Đóng</span></button>
              <h4 class="modal-title" id="myModalLabel">Bạn có muốn thoát ?</h4>
            </div>
            <div class="modal-footer">
              <a href="spa_login.html" class="btn btn-primary">Đồng ý</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
            </div>
          </div>
        </div>
      </div>

    <script src="resources/spamanagement/js/jquery.min.js"></script>
    <script src="resources/spamanagement/js/bootstrap.min.js"></script>
    <script src="resources/spamanagement/js/Chart.min.js"></script>
    <script src="resources/spamanagement/js/templatemo_script.js"></script>
    <script type="text/javascript">
    // Line chart
        function XemKetQua() {
            $("#DivBooking").toggle(500);
        }
       
  </script>