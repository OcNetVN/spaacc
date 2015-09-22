<ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
    <li><a href="<?php echo base_url();?>">Quản lý Spa</a></li>
    <li class="active">Thống kê</li>            
</ol>
<html>
    <meta charset="utf-8">
<ul class="dropdown-menu">
    <li><a href="#">Action</a></li>
    <li><a href="#">Another action</a></li>
    <li><a href="#">Something else here</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="#">Separated link</a></li>
  </ul>

<div class="main-content">
    <div class="dashboard-actions clearfix">
            <div class="top-search home-search">
                <div class="txt-input">
                    <input type="text" placeholder="Search: client, phone#, order#..." id="top-search" name="top-search" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                    <a class="clear-search" href="#" style="display: none;"><div class="icons-clear-search-mini"></div></a>
                    <div class="search-loader" style="display: none;"></div>
                </div>
            <ul class="ui-autocomplete ui-menu ui-widget ui-widget-content ui-corner-all search-results" role="listbox" aria-activedescendant="ui-active-menuitem" style="top: 0px; left: 0px; display: none;"></ul></div>
    </div>
    <a href="<?php echo site_url('thong-ke/dash-board') ?>">
        <span class="glyphicon glyphicon-dashboard"></span>
            DashBoard
        </span>
    </a>
    <h2>Xin chào, admin</h2>
    <p>Bạn là người quản trị cho FCSE Spa. Hiện tại bạn đang có các thông tin tổng quan như sau:</p>
    <div class="row">
                            <div class="col-md-12">
                              <div class="wrap-widget shadow-box">
                                <h3 class="sub-header">Thông tin Spa</h3>
                                  <p>Tên Spa: </p>
                                  <p>Địa chỉ: </p>
                                  <p>Email: </p>
                                  <p>Số ĐT quản lý: </p>
                                  <p>Số điểm của Spa tiêu phí còn lại:  </p>
                              </div>
                            </div>
        </div>
    <div class="margin-bottom-30">
            <div class="row">
              <div class="col-md-12">
                <ul class="nav nav-pills">
                  <li class="active"><a href="#">Thông báo <span class="badge">10</span></a></li>
                  <li class="active"><a href="#">Người quản lý <span class="badge">8</span></a></li>
                  <li class="active"><a href="#">Số đơn hàng mới <span class="badge">56</span></a></li>
                </ul>          
              </div>
            </div>
          </div>         

          <div class="row">           
            <div class="col-md-12">
              <div class="templatemo-progress">
                <div class="list-group">
                  <a class="list-group-item active" href="#">
                    <h4 class="list-group-item-heading">Đơn hàng mới nhất</h4>
                    <p class="list-group-item-text">Khách hàng <b>Nguyễn Văn A</b> đặt chỗ <br>
                        Dịch vụ: [Tắm trắng toàn thân] <br>
                        Vào lúc : 18:00 đến 19:00 ngày 25/04/2015<br>
                        Thông tin : Book thông qua VISA CARD...
                    </p>
                  </a>
                  <a class="list-group-item" href="#">
                    <h4 class="list-group-item-heading">Dịch vụ mới nhất</h4>
                    <p class="list-group-item-text">
                        Tên Dịch vụ: [Tắm trắng toàn thân] <br>
                        Giá : 250.000 vnd<br>
                        Ngày cập nhật : 11-04-2015
                    </p>
                  </a>
                </div>
                
              </div> 
            </div>
          </div>

        <div class="templatemo-panels">
            <div class="row">
              <div class="col-md-6 col-sm-6 margin-bottom-30">
                <div class="panel panel-success">
                  <div class="panel-heading">Thống kê doanh thu</div>
                  <canvas width="520" height="156" id="templatemo-line-chart" style="width: 520px; height: 156px;"></canvas>
                </div> 
                <span class="btn btn-success"><a href="data-visualization.html">Chi tiết</a></span>
              </div>   
              <div class="col-md-6 col-sm-6 margin-bottom-30">
                <div class="panel panel-primary">
                  <div class="panel-heading">Thành viên của Spa</div>
                  <div class="panel-body">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Họ Tên</th>
                          <th>Vai trò</th>
                          <th>Tên đăng nhập</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Trần Kiều</td>
                          <td>Admin</td>
                          <td>kieutr@yahoo.com</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Lý Văn Tòng</td>
                          <td>Theo dõi</td>
                          <td>tongly@gmail.com</td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>TRịnh Hoạt</td>
                          <td>Staff</td>
                          <td>hoattr@gmail.com</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <span class="btn btn-primary"><a href="tables.html">Xem chi tiết</a></span>
              </div>       
            </div>
            
          </div>

        

        <div class="content-box home-bookings b-home-bookings">
            <h2 class="box-hd">
                Booking chưa được xác nhận
                <span class="amount v-count hidden" style="display: none;"></span>
            </h2>
            <a class="view-all" href="spaman/home_controller/spa_dt">Xem tất cả booking</a>
            <div class="data-table">
                <table>
                    <tbody>
                    <tr class="empty">
                        <td>
                            Không có booking nào đang được xử lý trong thời điểm hiện tại
                        </td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>

        <div class="stats-columns">
            <table>
                <tbody><tr>
                    <td class="content-box sales no-sales" id="monthly-sales">
                        <h2 class="box-hd">Doanh số hiện tại(Từ đầu tháng)</h2>
                        <div class="totals">
                            <div class="stats-item">
                                <span class="title">Tổng lượt booking</span>
                                <span class="value v-bookings">0</span>
                            </div>
                            <div class="stats-item">
                                <span class="title">Tổng doanh thu</span>
                                <span class="value v-ttv">0.00 VNĐ</span>
                            </div>
                        </div>
                        
                        <div style="min-height: 300px" class="graph" id="monthly-sales-graph"></div>
                    </td>
                    <td class="empty"><span>&nbsp;</span></td>
                    <td class="content-box tops">
                        <div id="top-services">
                            <h2 class="box-hd">Dịch vụ được đặt nhiều nhất</h2>
                            <table>
                                <thead>
                                    <tr>
                                        <th class="box-subhd">Tính theo số lượt booking</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="empty">
                                        <th>Chưa có.</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="box-separator"></div>

                        <div id="top-performers">
                            <h2 class="box-hd v-title">Nhân viên làm việc tốt nhất</h2>
                            <table>
                                <thead>
                                    <tr>
                                        <th class="box-subhd">Đánh giá bởi quản lý Spa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="empty">
                                        <th>Chưa có.</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="box-separator"></div>

                        <div id="top-services">
                            <h2 class="box-hd">Chi tiết dịch vụ được khách hàng xem nhiều nhất</h2>
                            <table>
                                <thead>
                                    <tr>
                                        <th class="box-subhd">Tính theo số lượt view</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="empty">
                                        <th>Chưa có.</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </td>
                </tr>
            </tbody></table>
        </div>

        <div class="stats-marketplace">
            <table>
                <tbody><tr>
                    <td data-tooltip="&lt;strong&gt;Wahanda Bookings&lt;/strong&gt; - Number of bookings done so far this month" class="b-bookings" aria-describedby="ui-tooltip-0">
                        <div class="graph graph-clicks">
    <span title="Apr 2015: 0" style="height: 5%" class="bar"></span><span title="May 2015: 0" style="height: 5%" class="bar"></span><span title="Jun 2015: 0" style="height: 5%" class="bar"></span><span title="Jul 2015: 0" style="height: 5%" class="bar"></span><span title="Aug 2015: 0" style="height: 5%" class="bar"></span><span title="Sep 2015: 0" style="height: 5%" class="bar"></span>
</div>
                        <div class="stats-item">
                            <span class="title">Spa the booking VN</span>
                            <span class="value v-value">0</span>
                        </div>
                    </td>
                    <td data-tooltip="&lt;strong&gt;Visits to Venue Page&lt;/strong&gt; - Number of people who visited the venue page on Wahanda this month" class="b-visits" aria-describedby="ui-tooltip-1">
                        <div class="graph graph-visits">
    <span title="Apr 2015: 0" style="height: 5%" class="bar"></span><span title="May 2015: 0" style="height: 5%" class="bar"></span><span title="Jun 2015: 0" style="height: 5%" class="bar"></span><span title="Jul 2015: 0" style="height: 5%" class="bar"></span><span title="Aug 2015: 0" style="height: 5%" class="bar"></span><span title="Sep 2015: 0" style="height: 5%" class="bar"></span>
</div>
                        <div class="stats-item">
                            <span class="title">Lượt khách vãng lai</span>
                            <span class="value v-value">0</span>
                        </div>
                    </td>
                    <td data-tooltip="&lt;strong&gt;Phone views&lt;/strong&gt; - Number of times customers clicked to see the phone number on the venue page this month" class="b-phoneViews" aria-describedby="ui-tooltip-2">
                        <div class="graph graph-pviews">
    <span title="Apr 2015: 0" style="height: 5%" class="bar"></span><span title="May 2015: 0" style="height: 5%" class="bar"></span><span title="Jun 2015: 0" style="height: 5%" class="bar"></span><span title="Jul 2015: 0" style="height: 5%" class="bar"></span><span title="Aug 2015: 0" style="height: 5%" class="bar"></span><span title="Sep 2015: 0" style="height: 5%" class="bar"></span>
</div>
                        <div class="stats-item">
                            <span class="title">Lượt đặt vé qua điện thoại</span>
                            <span class="value v-value">0</span>
                        </div>
                    </td>
                    <td data-tooltip="&lt;strong&gt;Enquiries&lt;/strong&gt; - Number of sales leads sent from the venue page by Wahanda customers this month" class="b-enquiries">
                        <div class="graph graph-enquiries">
    <span title="Apr 2015: 0" style="height: 5%" class="bar"></span><span title="May 2015: 0" style="height: 5%" class="bar"></span><span title="Jun 2015: 0" style="height: 5%" class="bar"></span><span title="Jul 2015: 0" style="height: 5%" class="bar"></span><span title="Aug 2015: 0" style="height: 5%" class="bar"></span><span title="Sep 2015: 0" style="height: 5%" class="bar"></span>
</div>
                        <div class="stats-item">
                            <span class="title">Lượt góp ý bình luận</span>
                            <span class="value v-value">0</span>
                        </div>
                    </td>
                </tr>
            </tbody></table>
        </div>
        
    </div>




<style>
.clearfix::before, .clearfix::after {
    content: "";
    display: table;
}
.clearfix::after {
    clear: both;
}
.clearfix::before, .clearfix::after {
    content: "";
    display: table;
}
.home-bookings {
    padding-bottom: 0;
    position: relative;
}
.content-box {
    border: 1px solid #e3e3e1;
    margin-bottom: 20px;
    padding: 15px;
}
.stats-columns table {
    width: 100%;
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}
.stats-columns table td {
    width: 50%;
}
.sales {
    padding-left: 0;
    padding-right: 0;
}
.content-box {
    border: 1px solid #e3e3e1;
    margin-bottom: 20px;
    padding: 15px;
}

.stats-columns table td.empty {
    width: 1px;
}
.stats-columns table td {
    width: 50%;
}

.stats-marketplace table {
    border: 1px solid #e3e3e1;
    width: 100%;
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}

.stats-marketplace table td {
    border: 1px solid #e3e3e1;
    padding: 10px 0 3px 10px;
    width: 25%;
}
.disclaimer {
    color: #999;
    margin-top: 17px;
}
.top-search.home-search {
    background: #e3e3e1 none repeat scroll 0 0;
    float: right;
    margin-bottom: 19px;
    padding: 3px;
    position: relative;
    right: auto;
    top: auto;
    z-index: 21;
}
.top-search {
    bottom: auto;
    left: auto;
    position: absolute;
    right: 6px;
    top: 5px;
    width: 250px;
}
.top-search.home-search .txt-input {
    margin-bottom: 0;
}
.top-search .txt-input {
    position: relative;
    width: 248px;
}
.txt-input {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #c6c7bf;
    border-radius: 3px;
    height: 22px;
    margin-bottom: 2px;
}
.top-search .txt-input input {
    background: rgba(0, 0, 0, 0) url("resources/images/icons/searchstatistic.png") no-repeat scroll 6px 49%;
    padding-left: 20px;
    padding-right: 4px;
    position: relative;
    width: 224px;
    z-index: 999;
}
.txt-input input {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: 0 none;
    height: 22px;
    padding: 0;
    text-indent: 4px;
    width: 100%;
}
input, textarea, button {
    color: #111;
    font-family: DINWebPro,Arial,Helvetica,sans-serif;
    font-size: 14px;
}
input, select, textarea {
    margin: 0;
}
.content-box .box-hd {
    margin-top: -9px;
}
.box-hd {
    font-size: 17px;
    line-height: 1.1em;
}
.home-bookings table td {
    border-top: 1px solid #e6e6e3;
    font-size: 12px;
    height: 28px;
    line-height: 14px;
    padding: px 0 2px 19px;
    vertical-align: middle;
}
#home-holder.content-holder a {
    text-decoration: none;
}
.home-bookings .view-all {
    background: #f0f0f0 none repeat scroll 0 0;
    border-radius: 3px;
    color: #333;
    font-size: 13px;
    height: 25px;
    line-height: 25px;
    padding: 2px 10px 0;
    position: absolute;
    right: 15px;
    text-decoration: none;
    top: 13px;
}
.fo-right-ribbon a:hover, .fo-right-ribbon a:focus, a {
    color: initial;
    text-decoration: none;
}
a {
    color: #546899;
    outline: medium none;
    /*text-decoration: underline;*/
}
/*.sales .box-hd {
    padding: 0 15px;
}*/
.content-box .box-hd {
    margin-top: -1px;
}
/*.box-hd {
    font-size: 22px;
    line-height: 1.1em;*/
}
.sales .totals {
    background: #f7f7f7 none repeat scroll 0 0;
    margin: 15px 0 0;
    padding: 10px 15px 3px;
}
.sales .totals .stats-item:first-child {
    border-left: 0 none;
    padding-left: 0;
}
.sales .totals .stats-item {
    border-left: 1px dotted #bfbfbd;
    padding: 0 19px;
}
.stats-item {
    display: inline-block;
}
.sales .totals .stats-item {
    border-left: 1px dotted #bfbfbd;
    padding: 0 19px;
}
.stats-item {
    display: inline-block;
}
.stats-item .title {
    color: #666;
    display: block;
    font-size: 10px;
    line-height: 1em;
    padding-bottom: 3px;
    text-transform: uppercase;
}
.stats-item .value {
    display: block;
    font-size: 20px;
    font-weight: bold;
    line-height: 1em;
    margin-bottom: -5px;
}

.stats-columns table td.empty span {
    display: block;
    width: 20px;
}
.tops th {
    text-align: left;
    width: 99%;
}
.tops th, .tops td {
    line-height: 18px;
    padding-bottom: 8px;
    vertical-align: top;
}
.box-subhd {
    color: #999;
    font-size: 10px;
    line-height: 1em;
    text-transform: uppercase;
}
.tops .box-separator {
    margin-top: 12px;
}
.box-separator {
    background: #e3e3e1 none repeat scroll 0 0;
    clear: both;
    height: 1px;
    margin: 18px -15px;
    padding: 0;
}
.stats-marketplace .graph {
    float: left;
    height: 28px;
    line-height: 49px;
    margin-right: 6px;
    overflow: hidden;
    vertical-align: bottom;
    width: 34px;
}
element.style {
    height: 5%;
}
.stats-marketplace .graph.graph-clicks .bar {
    background: #f1c100 none repeat scroll 0 0;
}
.stats-marketplace .graph .bar {
    display: inline-block;
    width: 4.66667px;
}
.stats-marketplace .graph.graph-visits .bar {
    background: #adbd02 none repeat scroll 0 0;
}
.stats-marketplace .graph .bar + .bar {
    margin-left: 1px;
}
.stats-marketplace .graph .bar {
    display: inline-block;
    width: 4.66667px;
}
.stats-marketplace .graph.graph-pviews .bar {
    background: #ff9800 none repeat scroll 0 0;
}
.stats-marketplace .graph .bar + .bar {
    margin-left: 1px;
}
.stats-marketplace .graph .bar {
    display: inline-block;
    width: 4.66667px;
}
.stats-marketplace .graph.graph-enquiries .bar {
    background: #546899 none repeat scroll 0 0;
}
.stats-marketplace .graph .bar + .bar {
    margin-left: 1px;
}
.stats-marketplace .graph .bar {
    display: inline-block;
    width: 4.66667px;
}
</style>




<div class="disclaimer">
    <span class="icon icons-info-grey"></span>
    Dữ liệu thống kê không theo thời gian hiện hành
</div>
<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
        <script>
        $(function(){
            $('.datepicker').datepicker({
                format: 'mm-dd-yyyy'
            });         
        });
    </script>

<style>
.wrap-widget {
    background: #ffffff none repeat scroll 0 0;
    box-sizing: border-box;
    margin-bottom: 40px;
    padding: 10px;
}
.shadow-box {
    box-shadow: 0 0 5px #888888;
}
* {
    box-sizing: border-box;
}
</style>




<script src="js/jquery.min.js"></script>
    <script src="resources/js/bootstrap.min.js"></script>
    <script src="resources/js/Chart.min.js"></script>
    <script src="resources/js/templatemo_script.js"></script>
    <script type="text/javascript">
    // Line chart
    var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
    var lineChartData = {
      labels : ["T1","T2","T3","T4","T5","T6","T7"],
      datasets : [
      {
        label: "Doanh Thu",
        fillColor : "rgba(220,220,220,0.2)",
        strokeColor : "rgba(220,220,220,1)",
        pointColor : "rgba(220,220,220,1)",
        pointStrokeColor : "#fff",
        pointHighlightFill : "#fff",
        pointHighlightStroke : "rgba(220,220,220,1)",
        data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
      },
      {
        label: "Lượng khách",
        fillColor : "rgba(151,187,205,0.2)",
        strokeColor : "rgba(151,187,205,1)",
        pointColor : "rgba(151,187,205,1)",
        pointStrokeColor : "#fff",
        pointHighlightFill : "#fff",
        pointHighlightStroke : "rgba(151,187,205,1)",
        data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
      }
      ]

    }

    window.onload = function(){
      var ctx_line = document.getElementById("templatemo-line-chart").getContext("2d");
      window.myLine = new Chart(ctx_line).Line(lineChartData, {
        responsive: true
      });
    };

    $('#myTab a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
    });

    $('#loading-example-btn').click(function () {
      var btn = $(this);
      btn.button('loading');
      // $.ajax(...).always(function () {
      //   btn.button('reset');
      // });
  });
  </script>
</html>