<script src="<?php echo base_url('resources/spamanagement/js/daypilot-all.min.js?v=1514'); ?>"></script>

<ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
    <li><a href="#">Tài chính</a></li>
    <li class="active">Calendar</li>            
</ol>
<h1>Thời gian biểu</h1>

<div class="col-sm-12 note" style="padding:0px"><b>Ghi chú:</b> Bạn có thể cập & xem lịch booking <a href="http://javascript.daypilot.org/calendar/"></a>.</div>

<div class="col-sm-12" style="padding:15px 0px 15px;">
  <div class="col-sm-6" style="padding:0px">
      <label>Hiển thị</label>
      <select id="hienthi_xem"  onchange="change_hienthi(this.value)">
        <option value="Moth" selected="selected">Tháng</option>
        <option value="Week">Tuần</option>
        <option value="Day">Ngày</option>
      </select>

      <label style="margin-left:10px">Ngày</label>
      <input type="hidden" id="spaid" value="<?php echo $_SESSION["AccSpa"]["spaid"]?>" />
      <input name="ngay_xem" id="ngay_xem"type="text" value="" onchange="change_time(this.value)" />
  </div>
  <div class="col-sm-6" style="padding:0px">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_Add_Booking_Calendar" style="float:right">
        Tạo Booking Offline
      </button>

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_Closed_Time_Booking" style="float:right;margin-right: 15px;">
        Đóng Khung Giờ
      </button>
    
  </div>
</div>
<div class="col-sm-12" style="padding:0px;font-size: 11px;color: #337AB7;" id="Count_booking"></div>


<div id="divLoad" class="col-sm-12" style="padding:0px;margin-bottom:20px;">
    <div id="calendar_booking"></div>       
</div>

<!-- myModal_View_Booking_Calendar -->
<div class="modal fade" id="myModal_View_Booking_Calendar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Booking Detail</h4>
      </div>
      <div class="modal-body">
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>        





<!-- myModal_Edit_Booking_Calendar -->
<div class="modal fade" id="myModal_Edit_Booking_Calendar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cập nhật Booking Detail</h4>
      </div>
      <div class="modal-body">
            <div class="row" id="View_detail">
                <div class="col-md-3">Tên Khách Hàng</div><div class="col-md-9"><span class="pull-left" id="Edit_FullName"></span></div>
                <div class="col-md-3">Dịch vụ</div><div class="col-md-9"><span class="pull-left" id="Edit_TenDV"></span></div>
                <div class="col-md-3">Thời lượng</div><div class="col-md-9"><span class="pull-left" id="Edit_Duration"></span></div>
                <div class="col-md-3">Thời gian bắt đầu</div><div class="col-md-9"><span class="pull-left"><input type="text" class="form-control" id="Edit_FromTime" name="Edit_FromTime" ></span></div>
                <div class="col-md-3">Thời gian kết thúc</div><div class="col-md-9"><span class="pull-left"><input type="text" class="form-control" id="Edit_ToTime" name="Edit_ToTime" ></span></div>
                <div class="col-md-3">Thanh Toán</div><div class="col-md-9"><span class="pull-left" id="Edit_Thanhtoan"></span></div>
                <div class="col-md-3">Tình trạng</div><div class="col-md-9"><span class="pull-left" id="Edit_Status"></span></div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="Edit_Booking_Detail">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!-- myModal_Add_Booking_Calendar -->
<div class="modal fade" id="myModal_Add_Booking_Calendar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        Add
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!-- myModal_Add_Booking_Calendar -->
<div class="modal fade" id="myModal_Closed_Time_Booking" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        Closed
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


