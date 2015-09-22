<html>
<ol class="breadcrumb">
  <li><a href="#">FCSE Spa</a></li>
  <li><a href="index.html">Tài chính</a></li>
  <li class="active">Doanh Thu</li>            
</ol>
<h1>Doanh thu Spa</h1>


<p><?php echo anchor('log-in/doanh-thu/xuat-ban-doanh-thu','Xuất Bản Báo Cáo Doanh Thu') ?></p>
  <div class="templatemo-charts">
    <div class="row">
          <div class="col-md-3 margin-bottom-15">
            <label for="txtFromDate">From Date</label>
            <input type="text" class="form-control" id="txtFromDate" value="2015-01-13 16:17:46" disabled>  
          </div>
          <div class="col-md-3 margin-bottom-15">
              <label for="txtToDate">To Date</label>
            <input type="text" class="form-control" id="txtToDate" value="2015-01-15 16:17:46" disabled>
          </div>
          <div class="col-md-3 margin-bottom-15">
             <br /> 
            <button type="button" class="btn btn-primary" onclick="XemKetQua();">Xem Kết quả</button>
          </div>
        </div>
        <div id="DivDoanhThu" >
    <div class="row"  >
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-info">
          <div class="panel-heading">Thống kê theo sản phẩm &amp; </div>
        </div>
        <div class="row templatemo-chart-row">

          <div class="templatemo-chart-box col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <canvas id="templatemo-pie-chart"></canvas>
            <h4>Theo nhóm sản phẩm</h4>
            <span class="text-muted">Các nhóm sản phẩm của SPA</span>  
          </div>
          
          <div class="templatemo-chart-box col-lg-3 col-md-3 col-sm-4 col-xs-12">           
            <canvas id="templatemo-doughnut-chart"></canvas>
            <h4>Theo mức giá</h4>
            <span class="text-muted">Mức giá sản phẩm</span> 
          </div>
          
          <div class="templatemo-chart-box col-lg-3 col-md-3 col-sm-4 col-xs-12">           
            <canvas id="templatemo-radar-chart"></canvas>
            <h4>Theo khách hàng</h4>
            <span class="text-muted">Thói quen booking</span> 
          </div>

          <div class="templatemo-chart-box col-lg-3 col-md-3 col-sm-4 col-xs-12">           
            <canvas id="templatemo-polar-chart"></canvas>
            <h4>Thống kê khác</h4>
            <span class="text-muted">Theo giờ booking</span> 
          </div>

        </div>                  
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-6">
        <div class="panel panel-success">
          <div class="panel-heading">Doanh số Theo tháng</div>
          <canvas id="templatemo-line-chart"></canvas>
        </div>                       
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="panel panel-primary">
          <div class="panel-heading">Doanh số theo ngày</div>
          <canvas id="templatemo-bar-chart"></canvas>
        </div>
      </div> 
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
    //
        
        // Line chart
        var randomScalingFactor = function () { return Math.round(Math.random() * 100) };
        var lineChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
            }
            ]

        } // lineChartData

        var pieChartData = [
        {
            value: 300,
            color: "#F7464A",
            highlight: "#FF5A5E",
            label: "Red"
        },
        {
            value: 50,
            color: "#46BFBD",
            highlight: "#5AD3D1",
            label: "Green"
        },
        {
            value: 100,
            color: "#FDB45C",
            highlight: "#FFC870",
            label: "Yellow"
        }
        ] // pie chart data

        // radar chart
        var radarChartData = {
            labels: ["ATM/Visa", "Voucher", "Điểm", "At Venue", "At Home", "Thu tiền sau"],
            datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 90, 81, 56, 55]
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [28, 48, 40, 19, 96, 27]
            }
            ]
        }; // radar chart

        // polar area chart
        var polarAreaChartData = [
        {
            value: 300,
            color: "#F7464A",
            highlight: "#FF5A5E",
            label: "Red"
        },
        {
            value: 50,
            color: "#46BFBD",
            highlight: "#5AD3D1",
            label: "Green"
        },
        {
            value: 100,
            color: "#FDB45C",
            highlight: "#FFC870",
            label: "Yellow"
        },
        {
            value: 40,
            color: "#949FB1",
            highlight: "#A8B3C5",
            label: "Grey"
        },
        {
            value: 120,
            color: "#4D5360",
            highlight: "#616774",
            label: "Dark Grey"
        }

        ];

        //window.onload = function () {
        //    var ctx_line = document.getElementById("templatemo-line-chart").getContext("2d");
        //    var ctx_bar = document.getElementById("templatemo-bar-chart").getContext("2d");
        //    var ctx_pie = document.getElementById("templatemo-pie-chart").getContext("2d");
        //    var ctx_doughnut = document.getElementById("templatemo-doughnut-chart").getContext("2d");
        //    var ctxRadar = document.getElementById("templatemo-radar-chart").getContext("2d");
        //    var ctxPolar = document.getElementById("templatemo-polar-chart").getContext("2d");

        //    window.myLine = new Chart(ctx_line).Line(lineChartData, {
        //        responsive: true
        //    });
        //    window.myBar = new Chart(ctx_bar).Bar(lineChartData, {
        //        responsive: true
        //    });
        //    window.myPieChart = new Chart(ctx_pie).Pie(pieChartData, {
        //        responsive: true
        //    });
        //    window.myDoughnutChart = new Chart(ctx_doughnut).Doughnut(pieChartData, {
        //        responsive: true
        //    });
        //    var myRadarChart = new Chart(ctxRadar).Radar(radarChartData, {
        //        responsive: true
        //    });
        //    var myPolarAreaChart = new Chart(ctxPolar).PolarArea(polarAreaChartData, {
        //        responsive: true
        //    });
        //}
    </script>
    <script type="text/javascript">
        function XemKetQua() {
            //$("#DivDoanhThu").show();
            LoadData();
        }
        function LoadData() {
            var ctx_line = document.getElementById("templatemo-line-chart").getContext("2d");
            var ctx_bar = document.getElementById("templatemo-bar-chart").getContext("2d");
            var ctx_pie = document.getElementById("templatemo-pie-chart").getContext("2d");
            var ctx_doughnut = document.getElementById("templatemo-doughnut-chart").getContext("2d");
            var ctxRadar = document.getElementById("templatemo-radar-chart").getContext("2d");
            var ctxPolar = document.getElementById("templatemo-polar-chart").getContext("2d");

            window.myLine = new Chart(ctx_line).Line(lineChartData, {
                responsive: true
            });
            window.myBar = new Chart(ctx_bar).Bar(lineChartData, {
                responsive: true
            });
            window.myPieChart = new Chart(ctx_pie).Pie(pieChartData, {
                responsive: true
            });
            window.myDoughnutChart = new Chart(ctx_doughnut).Doughnut(pieChartData, {
                responsive: true
            });
            var myRadarChart = new Chart(ctxRadar).Radar(radarChartData, {
                responsive: true
            });
            var myPolarAreaChart = new Chart(ctxPolar).PolarArea(polarAreaChartData, {
                responsive: true
            });
        }
    </script>
</html>