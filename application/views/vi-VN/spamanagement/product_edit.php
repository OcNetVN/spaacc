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
    <a href="<?php echo site_url('thong-ke/dash-board') ?>">
        <span class="glyphicon glyphicon-dashboard"></span>
            Dashboard 
        </span>
    </a>

    
        <div class="dashboard-actions clearfix">
            <div class="top-search home-search">
                <div class="txt-input">
                    <input type="text" placeholder="Search: client, phone#, order#..." id="top-search" name="top-search" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                    <a class="clear-search" href="#" style="display: none;"><div class="icons-clear-search-mini"></div></a>
                    <div class="search-loader" style="display: none;"></div>
                </div>
            <ul class="ui-autocomplete ui-menu ui-widget ui-widget-content ui-corner-all search-results" role="listbox" aria-activedescendant="ui-active-menuitem" style="top: 0px; left: 0px; display: none;"></ul></div>
        </div>

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


<div class="content">
                        <h1 class="page-header">Dashboard</h1>
            
                        <div class="row">
                            <div class="col-md-3">
                                <div class="wrap-widget shadow-box">
                                    <h4 class="sub-header">Giao dịch trực tuyến</h4>
                                    
                                    <script type="text/javascript">
                                      google.load('visualization', '1', {packages: ['gauge']});
                                      google.setOnLoadCallback(drawGauge);
                                    
                                      var gaugeOptions = {min: 0, max: 280, yellowFrom: 200, yellowTo: 250,
                                        redFrom: 250, redTo: 280, minorTicks: 5};
                                      var gauge;
                                    
                                      function drawGauge() {
                                        gaugeData = new google.visualization.DataTable();
                                        gaugeData.addColumn('number', 'Engine');
                                        gaugeData.addColumn('number', 'Torpedo');
                                        gaugeData.addRows(2);
                                        gaugeData.setCell(0, 0, 120);
                                        gaugeData.setCell(0, 1, 80);
                                    
                                        gauge = new google.visualization.Gauge(document.getElementById('gauge_div'));
                                        gauge.draw(gaugeData, gaugeOptions);
                                      }
                                    
                                      function changeTemp(dir) {
                                        gaugeData.setValue(0, 0, gaugeData.getValue(0, 0) + dir * 25);
                                        gaugeData.setValue(0, 1, gaugeData.getValue(0, 1) + dir * 20);
                                        gauge.draw(gaugeData, gaugeOptions);
                                      }
                                    </script>
                                    <div style="width: 100%; height: 150px;" id="gauge_div"><table cellspacing="0" cellpadding="0" align="center" style="border: 0px none; padding: 0px; margin: 0px;"><tbody><tr style="border: 0px none; padding: 0px; margin: 0px;"><td style="border: 0px none; padding: 0px; margin: 0px; width: 113px;"><div style="position: relative;"><div style="position: relative; width: 113px; height: 113px;" dir="ltr"><div style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;"><svg width="113" height="113" style="overflow: hidden;" aria-label="Một biểu đồ."><defs id="defs"/><g><circle cx="56" cy="56" r="51" stroke="#333333" stroke-width="1" fill="#cccccc"/><circle cx="56" cy="56" r="45" stroke="#e0e0e0" stroke-width="2" fill="#f7f7f7"/><path d="M91.21569216835967,34.686684862871225A41,41,0,0,1,95.89761019974908,67.85025596841882L86.04820764981181,65.0126919763141A30.75,30.75,0,0,0,82.53676912626975,40.14001364715341Z" stroke="none" stroke-width="0" fill="#ff9900"/><path d="M95.8976101997491,67.8502559684188A41,41,0,0,1,85.49137802864846,85.49137802864844L78.24353352148637,78.24353352148631A30.75,30.75,0,0,0,86.04820764981181,65.01269197631412Z" stroke="none" stroke-width="0" fill="#dc3912"/><text text-anchor="middle" x="56.5" y="46.35" font-family="arial" font-size="11" stroke="none" stroke-width="0" fill="#333333">Engine</text><text text-anchor="start" x="35.42821792064088" y="79.67178207935912" font-family="arial" font-size="6" stroke="none" stroke-width="0" fill="#333333">0</text><text text-anchor="end" x="77.57178207935914" y="79.67178207935909" font-family="arial" font-size="6" stroke="none" stroke-width="0" fill="#333333">280</text><path d="M25.037577935334,75.78019703801851L21.54175326148222,77.9224411533539M21.40601454870884,67.90272709243555L17.506682831898708,69.16969676937285M19.71375038524758,59.39514063235748L15.626389316941754,59.71682292484165M20.054300232039417,50.727568240015486L16.00477803559935,50.08618693335054M26.647272907564435,34.81072419040775L23.330303230627152,32.4008046560086M32.535367016616206,28.441019869358872L29.872630018462452,25.323355410398747M39.74775055961072,23.62185925744923L37.886389510678576,19.968732508276922M47.8858660737171,20.61954993732573L46.92874008190789,16.632833263695254M65.11413392628289,20.61954993732573L66.0712599180921,16.632833263695254M73.25224944038928,23.621859257449223L75.11361048932142,19.968732508276915M80.46463298338378,28.441019869358865L83.12736998153754,25.323355410398737M86.35272709243556,34.81072419040773L89.66969676937285,32.40080465600859M92.94569976796058,50.72756824001547L96.99522196440064,50.086186933350525M93.28624961475242,59.39514063235745L97.37361068305825,59.716822924841615M91.59398545129116,67.90272709243555L95.4933171681013,69.16969676937283M87.96242206466601,75.78019703801849L91.4582467385178,77.92244115335387" stroke="#666666" stroke-width="1" fill-opacity="1" fill="none"/><path d="M33.306897577081244,79.69310242291877L27.508621971351555,85.49137802864846M26.196751333629784,43.94798341842507L18.620939167037236,40.809979273031345M56.49999999999999,23.699999999999996L56.49999999999999,15.5M86.80324866637021,43.94798341842506L94.37906083296275,40.80997927303133M79.69310242291878,79.69310242291874L85.49137802864848,85.49137802864841" stroke="#333333" stroke-width="2" fill-opacity="1" fill="none"/><g><text text-anchor="middle" x="56.5" y="91.35" font-family="arial" font-size="11" stroke="none" stroke-width="0" fill="#000000">120</text><path d="M43.61911658374848,19.68855011797367C59.20894515798501,55.55209909218867,61.81782132245451,67.35264950979474,60.46334874346201,67.8265999637004C59.1088761644695,68.30055041760606,53.79105484201499,57.44790090781133,43.61911658374848,19.68855011797367" stroke="#c63310" stroke-width="1" fill-opacity="0.7" fill="#dc3912"/><circle cx="56" cy="56" r="6" stroke="#666666" stroke-width="1" fill="#4684ee"/></g></g></svg></div></div><div style="display: none; position: absolute; top: 123px; left: 123px; white-space: nowrap; font-family: Arial; font-size: 8px;" aria-hidden="true">GViz is Great.</div></div></td><td style="border: 0px none; padding: 0px; margin: 0px; width: 113px;"><div style="position: relative;"><div style="position: relative; width: 113px; height: 113px;" dir="ltr"><div style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;"><svg width="113" height="113" style="overflow: hidden;" aria-label="Một biểu đồ."><defs id="defs"/><g><circle cx="56" cy="56" r="51" stroke="#333333" stroke-width="1" fill="#cccccc"/><circle cx="56" cy="56" r="45" stroke="#e0e0e0" stroke-width="2" fill="#f7f7f7"/><path d="M91.21569216835967,34.686684862871225A41,41,0,0,1,95.89761019974908,67.85025596841882L86.04820764981181,65.0126919763141A30.75,30.75,0,0,0,82.53676912626975,40.14001364715341Z" stroke="none" stroke-width="0" fill="#ff9900"/><path d="M95.8976101997491,67.8502559684188A41,41,0,0,1,85.49137802864846,85.49137802864844L78.24353352148637,78.24353352148631A30.75,30.75,0,0,0,86.04820764981181,65.01269197631412Z" stroke="none" stroke-width="0" fill="#dc3912"/><text text-anchor="middle" x="56.5" y="46.35" font-family="arial" font-size="11" stroke="none" stroke-width="0" fill="#333333">Torpedo</text><text text-anchor="start" x="35.42821792064088" y="79.67178207935912" font-family="arial" font-size="6" stroke="none" stroke-width="0" fill="#333333">0</text><text text-anchor="end" x="77.57178207935914" y="79.67178207935909" font-family="arial" font-size="6" stroke="none" stroke-width="0" fill="#333333">280</text><path d="M25.037577935334,75.78019703801851L21.54175326148222,77.9224411533539M21.40601454870884,67.90272709243555L17.506682831898708,69.16969676937285M19.71375038524758,59.39514063235748L15.626389316941754,59.71682292484165M20.054300232039417,50.727568240015486L16.00477803559935,50.08618693335054M26.647272907564435,34.81072419040775L23.330303230627152,32.4008046560086M32.535367016616206,28.441019869358872L29.872630018462452,25.323355410398747M39.74775055961072,23.62185925744923L37.886389510678576,19.968732508276922M47.8858660737171,20.61954993732573L46.92874008190789,16.632833263695254M65.11413392628289,20.61954993732573L66.0712599180921,16.632833263695254M73.25224944038928,23.621859257449223L75.11361048932142,19.968732508276915M80.46463298338378,28.441019869358865L83.12736998153754,25.323355410398737M86.35272709243556,34.81072419040773L89.66969676937285,32.40080465600859M92.94569976796058,50.72756824001547L96.99522196440064,50.086186933350525M93.28624961475242,59.39514063235745L97.37361068305825,59.716822924841615M91.59398545129116,67.90272709243555L95.4933171681013,69.16969676937283M87.96242206466601,75.78019703801849L91.4582467385178,77.92244115335387" stroke="#666666" stroke-width="1" fill-opacity="1" fill="none"/><path d="M33.306897577081244,79.69310242291877L27.508621971351555,85.49137802864846M26.196751333629784,43.94798341842507L18.620939167037236,40.809979273031345M56.49999999999999,23.699999999999996L56.49999999999999,15.5M86.80324866637021,43.94798341842506L94.37906083296275,40.80997927303133M79.69310242291878,79.69310242291874L85.49137802864848,85.49137802864841" stroke="#333333" stroke-width="2" fill-opacity="1" fill="none"/><g><text text-anchor="middle" x="56.5" y="91.35" font-family="arial" font-size="11" stroke="none" stroke-width="0" fill="#000000">80</text><path d="M23.477756230096915,35.750749015901874C58.02693205959901,54.06990154821482,67.4241564205389,61.669335692291455,66.6606903907394,62.88438491818404C65.8972243609399,64.09943414407662,54.97306794040099,58.93009845178518,23.477756230096915,35.750749015901874" stroke="#c63310" stroke-width="1" fill-opacity="0.7" fill="#dc3912"/><circle cx="56" cy="56" r="6" stroke="#666666" stroke-width="1" fill="#4684ee"/></g></g></svg></div></div><div style="display: none; position: absolute; top: 123px; left: 123px; white-space: nowrap; font-family: Arial; font-size: 8px;" aria-hidden="true">GViz is Great.</div></div></td></tr></tbody></table></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="wrap-widget shadow-box">
                                    <h4 class="sub-header">Tỷ lệ chuyển đổi</h4>
                                    <script type="text/javascript">
                                          google.load("visualization", "1", {packages:["corechart"]});
                                    google.setOnLoadCallback(drawChart);
                                    function drawChart() {
                                    
                                      var data = google.visualization.arrayToDataTable([
                                        ['Năm', 'Sales', 'Expenses'],
                                        ['2004',  1000,      400],
                                        ['2005',  1170,      460],
                                        ['2006',  660,       1120],
                                        ['2007',  1030,      540]
                                      ]);
                                    
                                      var options = {
                                        title: 'Hiệu suất Spa',
                                        hAxis: {title: 'Năm', titleTextStyle: {color: 'red'}}
                                      };
                                    
                                      var chart = new google.visualization.ColumnChart(document.getElementById('chart_column'));
                                    
                                      chart.draw(data, options);
                                    
                                    }
                                    </script><script type="text/javascript" src="https://www.google.com/uds/?file=visualization&amp;v=1&amp;packages=corechart&amp;sig=5504f76db3d3b530b98671471f05820f&amp;have=gauge%2Cdefault%2Cui%2Cformat"></script><script type="text/javascript" src="https://www.google.com/uds/api/visualization/1.0/5504f76db3d3b530b98671471f05820f/corechart+vi.js"></script>
                                    <div style="width: 100%; height: 150px;" id="chart_column"><div style="position: relative;"><div style="position: relative; width: 227px; height: 150px;" dir="ltr"><div style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;" aria-label="Một biểu đồ."><svg width="227" height="150" style="overflow: hidden;" aria-label="Một biểu đồ."><defs id="defs"><clipPath id="_ABSTRACT_RENDERER_ID_3"><rect x="44" y="29" width="140" height="93"/></clipPath></defs><rect x="0" y="0" width="227" height="150" stroke="none" stroke-width="0" fill="#ffffff"/><g><text text-anchor="start" x="44" y="17.65" font-family="Arial" font-size="9" font-weight="bold" stroke="none" stroke-width="0" fill="#000000">Hiệu suất Spa</text></g><g><rect x="193" y="29" width="25" height="24" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/><g><rect x="193" y="29" width="25" height="9" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/><g><text text-anchor="start" x="214" y="36.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">.</text><rect x="214" y="29" width="4" height="9" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/></g><rect x="193" y="29" width="18" height="9" stroke="none" stroke-width="0" fill="#3366cc"/></g><g><rect x="193" y="44" width="25" height="9" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/><g><text text-anchor="start" x="214" y="51.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">.</text><rect x="214" y="44" width="4" height="9" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/></g><rect x="193" y="44" width="18" height="9" stroke="none" stroke-width="0" fill="#dc3912"/></g></g><g><rect x="44" y="29" width="140" height="93" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/><g clip-path="url(file:///C:/Users/Admin/AppData/Roaming/Skype/My%20Skype%20Received%20Files/HTML%20-%20KPI/template.html#_ABSTRACT_RENDERER_ID_3)"><g><rect x="44" y="121" width="140" height="1" stroke="none" stroke-width="0" fill="#cccccc"/><rect x="44" y="98" width="140" height="1" stroke="none" stroke-width="0" fill="#cccccc"/><rect x="44" y="75" width="140" height="1" stroke="none" stroke-width="0" fill="#cccccc"/><rect x="44" y="52" width="140" height="1" stroke="none" stroke-width="0" fill="#cccccc"/><rect x="44" y="29" width="140" height="1" stroke="none" stroke-width="0" fill="#cccccc"/></g><g><rect x="51" y="45" width="10" height="76" stroke="none" stroke-width="0" fill="#3366cc"/><rect x="86" y="32" width="10" height="89" stroke="none" stroke-width="0" fill="#3366cc"/><rect x="120" y="71" width="10" height="50" stroke="none" stroke-width="0" fill="#3366cc"/><rect x="155" y="43" width="10" height="78" stroke="none" stroke-width="0" fill="#3366cc"/><rect x="62" y="91" width="10" height="30" stroke="none" stroke-width="0" fill="#dc3912"/><rect x="97" y="87" width="10" height="34" stroke="none" stroke-width="0" fill="#dc3912"/><rect x="131" y="36" width="10" height="85" stroke="none" stroke-width="0" fill="#dc3912"/><rect x="166" y="81" width="10" height="40" stroke="none" stroke-width="0" fill="#dc3912"/></g><g><rect x="44" y="121" width="140" height="1" stroke="none" stroke-width="0" fill="#333333"/></g></g><g/><g><g><text text-anchor="middle" x="61.875" y="132.98333333333335" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">2004</text></g><g><text text-anchor="middle" x="96.625" y="132.98333333333335" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">2005</text></g><g><text text-anchor="middle" x="131.375" y="132.98333333333335" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">2006</text></g><g><text text-anchor="middle" x="166.125" y="132.98333333333335" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">2007</text></g><g><text text-anchor="end" x="35" y="124.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#444444">0</text></g><g><text text-anchor="end" x="35" y="101.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#444444">300</text></g><g><text text-anchor="end" x="35" y="78.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#444444">600</text></g><g><text text-anchor="end" x="35" y="55.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#444444">900</text></g><g><text text-anchor="end" x="35" y="32.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#444444">1.200</text></g></g></g><g><g><text text-anchor="middle" x="114" y="145.3166666666667" font-family="Arial" font-size="9" font-style="italic" stroke="none" stroke-width="0" fill="#ff0000">Year</text></g></g><g/></svg><div aria-label="Một đại diện của dữ liệu dưới dạng bảng biểu trong biểu đồ." style="position: absolute; left: -10000px; top: auto; width: 1px; height: 1px; overflow: hidden;"><table><thead><tr><th>Year</th><th>Sales</th><th>Expenses</th></tr></thead><tbody><tr><td>2004</td><td>1000</td><td>400</td></tr><tr><td>2005</td><td>1170</td><td>460</td></tr><tr><td>2006</td><td>660</td><td>1120</td></tr><tr><td>2007</td><td>1030</td><td>540</td></tr></tbody></table></div></div></div><div style="display: none; position: absolute; top: 160px; left: 237px; white-space: nowrap; font-family: Arial; font-size: 9px;" aria-hidden="true">.</div><div></div></div></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="wrap-widget shadow-box">
                                    <h4 class="sub-header">Số lần truy cập của trang</h4>
                                    <script type="text/javascript">
                                      google.load("visualization", "1", {packages:["corechart"]});
                                      google.setOnLoadCallback(drawChart);
                                      function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                          ['Year', 'Sales', 'Expenses'],
                                          ['2004',  1000,      400],
                                          ['2005',  1170,      460],
                                          ['2006',  660,       1120],
                                          ['2007',  1030,      540]
                                        ]);
                                
                                        var options = {
                                          title: 'Hiệu suất Spa'
                                        };
                                
                                        var chart = new google.visualization.LineChart(document.getElementById('chart_line'));
                                
                                        chart.draw(data, options);
                                      }
                                    </script>
                                    <div style="width: 100%; height: 150px;" id="chart_line"><div style="position: relative;"><div style="position: relative; width: 227px; height: 150px;" dir="ltr"><div style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;" aria-label="Một biểu đồ."><svg width="227" height="150" style="overflow: hidden;" aria-label="Một biểu đồ."><defs id="defs"><clipPath id="_ABSTRACT_RENDERER_ID_4"><rect x="44" y="29" width="140" height="93"/></clipPath></defs><rect x="0" y="0" width="227" height="150" stroke="none" stroke-width="0" fill="#ffffff"/><g><text text-anchor="start" x="44" y="17.65" font-family="Arial" font-size="9" font-weight="bold" stroke="none" stroke-width="0" fill="#000000">Hiệu suất Spa</text></g><g><rect x="193" y="29" width="25" height="24" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/><g><rect x="193" y="29" width="25" height="9" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/><g><text text-anchor="start" x="214" y="36.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">.</text><rect x="214" y="29" width="4" height="9" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/></g><path d="M193,33.5L211,33.5" stroke="#3366cc" stroke-width="2" fill-opacity="1" fill="none"/></g><g><rect x="193" y="44" width="25" height="9" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/><g><text text-anchor="start" x="214" y="51.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">.</text><rect x="214" y="44" width="4" height="9" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/></g><path d="M193,48.5L211,48.5" stroke="#dc3912" stroke-width="2" fill-opacity="1" fill="none"/></g></g><g><rect x="44" y="29" width="140" height="93" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/><g clip-path="url(file:///C:/Users/Admin/AppData/Roaming/Skype/My%20Skype%20Received%20Files/HTML%20-%20KPI/template.html#_ABSTRACT_RENDERER_ID_4)"><g><rect x="44" y="121" width="140" height="1" stroke="none" stroke-width="0" fill="#cccccc"/><rect x="44" y="98" width="140" height="1" stroke="none" stroke-width="0" fill="#cccccc"/><rect x="44" y="75" width="140" height="1" stroke="none" stroke-width="0" fill="#cccccc"/><rect x="44" y="52" width="140" height="1" stroke="none" stroke-width="0" fill="#cccccc"/><rect x="44" y="29" width="140" height="1" stroke="none" stroke-width="0" fill="#cccccc"/></g><g><rect x="44" y="121" width="140" height="1" stroke="none" stroke-width="0" fill="#333333"/></g><g><path d="M61.875,44.83333333333334L96.625,31.80000000000001L131.375,70.9L166.125,42.533333333333346" stroke="#3366cc" stroke-width="2" fill-opacity="1" fill="none"/><path d="M61.875,90.83333333333334L96.625,86.23333333333333L131.375,35.63333333333334L166.125,80.1" stroke="#dc3912" stroke-width="2" fill-opacity="1" fill="none"/></g></g><g/><g><g><text text-anchor="middle" x="61.875" y="135.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">2004</text></g><g><text text-anchor="middle" x="96.625" y="135.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">2005</text></g><g><text text-anchor="middle" x="131.375" y="135.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">2006</text></g><g><text text-anchor="middle" x="166.125" y="135.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">2007</text></g><g><text text-anchor="end" x="35" y="124.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#444444">0</text></g><g><text text-anchor="end" x="35" y="101.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#444444">300</text></g><g><text text-anchor="end" x="35" y="78.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#444444">600</text></g><g><text text-anchor="end" x="35" y="55.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#444444">900</text></g><g><text text-anchor="end" x="35" y="32.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#444444">1.200</text></g></g></g><g/></svg><div aria-label="Một đại diện của dữ liệu dưới dạng bảng biểu trong biểu đồ." style="position: absolute; left: -10000px; top: auto; width: 1px; height: 1px; overflow: hidden;"><table><thead><tr><th>Year</th><th>Sales</th><th>Expenses</th></tr></thead><tbody><tr><td>2004</td><td>1000</td><td>400</td></tr><tr><td>2005</td><td>1170</td><td>460</td></tr><tr><td>2006</td><td>660</td><td>1120</td></tr><tr><td>2007</td><td>1030</td><td>540</td></tr></tbody></table></div></div></div><div style="display: none; position: absolute; top: 160px; left: 237px; white-space: nowrap; font-family: Arial; font-size: 9px;" aria-hidden="true">.</div><div></div></div></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="wrap-widget shadow-box">
                                    <h4 class="sub-header">Thời gian truy cập trung bình</h4>
                                    <script type="text/javascript">
                                      google.load("visualization", "1", {packages:["corechart"]});
                                      google.setOnLoadCallback(drawChart);
                                      function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                          ['Năm', 'Sales', 'Expenses'],
                                          ['2013',  1000,      400],
                                          ['2014',  1170,      460],
                                          ['2015',  660,       1120],
                                          ['2016',  1030,      540]
                                        ]);
                                
                                        var options = {
                                          title: 'Hiệu suất Spa',
                                          hAxis: {title: 'Năm',  titleTextStyle: {color: '#333'}},
                                          vAxis: {minValue: 0}
                                        };
                                
                                        var chart = new google.visualization.AreaChart(document.getElementById('chart_area'));
                                        chart.draw(data, options);
                                      }
                                    </script>
                                    <div style="width: 100%; height: 150px;" id="chart_area"><div style="position: relative;"><div style="position: relative; width: 227px; height: 150px;" dir="ltr"><div style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;" aria-label="Một biểu đồ."><svg width="227" height="150" style="overflow: hidden;" aria-label="Một biểu đồ."><defs id="defs"><clipPath id="_ABSTRACT_RENDERER_ID_5"><rect x="44" y="29" width="140" height="93"/></clipPath></defs><rect x="0" y="0" width="227" height="150" stroke="none" stroke-width="0" fill="#ffffff"/><g><text text-anchor="start" x="44" y="17.65" font-family="Arial" font-size="9" font-weight="bold" stroke="none" stroke-width="0" fill="#000000">Hiệu suất Spa</text></g><g><rect x="193" y="29" width="25" height="24" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/><g><rect x="193" y="29" width="25" height="9" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/><g><text text-anchor="start" x="214" y="36.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">.</text><rect x="214" y="29" width="4" height="9" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/></g><rect x="193" y="33.5" width="18" height="4.5" stroke="none" stroke-width="0" fill-opacity="0.3" fill="#3366cc"/><path d="M193,33.5L211,33.5" stroke="#3366cc" stroke-width="2" fill-opacity="1" fill="none"/></g><g><rect x="193" y="44" width="25" height="9" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/><g><text text-anchor="start" x="214" y="51.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">.</text><rect x="214" y="44" width="4" height="9" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/></g><rect x="193" y="48.5" width="18" height="4.5" stroke="none" stroke-width="0" fill-opacity="0.3" fill="#dc3912"/><path d="M193,48.5L211,48.5" stroke="#dc3912" stroke-width="2" fill-opacity="1" fill="none"/></g></g><g><rect x="44" y="29" width="140" height="93" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/><g clip-path="url(file:///C:/Users/Admin/AppData/Roaming/Skype/My%20Skype%20Received%20Files/HTML%20-%20KPI/template.html#_ABSTRACT_RENDERER_ID_5)"><g><rect x="44" y="121" width="140" height="1" stroke="none" stroke-width="0" fill="#cccccc"/><rect x="44" y="98" width="140" height="1" stroke="none" stroke-width="0" fill="#cccccc"/><rect x="44" y="75" width="140" height="1" stroke="none" stroke-width="0" fill="#cccccc"/><rect x="44" y="52" width="140" height="1" stroke="none" stroke-width="0" fill="#cccccc"/><rect x="44" y="29" width="140" height="1" stroke="none" stroke-width="0" fill="#cccccc"/></g><g><g><path d="M44.5,121.5L44.5,121.5L44.5,44.83333333333334L90.83333333333334,31.80000000000001L137.16666666666669,70.9L183.5,42.533333333333346L183.5,121.5L183.5,121.5Z" stroke="none" stroke-width="0" fill-opacity="0.3" fill="#3366cc"/></g><g><path d="M44.5,121.5L44.5,121.5L44.5,90.83333333333334L90.83333333333334,86.23333333333333L137.16666666666669,35.63333333333334L183.5,80.1L183.5,121.5L183.5,121.5Z" stroke="none" stroke-width="0" fill-opacity="0.3" fill="#dc3912"/></g></g><g><rect x="44" y="121" width="140" height="1" stroke="none" stroke-width="0" fill="#333333"/></g><g><path d="M44.5,44.83333333333334L90.83333333333334,31.80000000000001L137.16666666666669,70.9L183.5,42.533333333333346" stroke="#3366cc" stroke-width="2" fill-opacity="1" fill="none"/><path d="M44.5,90.83333333333334L90.83333333333334,86.23333333333333L137.16666666666669,35.63333333333334L183.5,80.1" stroke="#dc3912" stroke-width="2" fill-opacity="1" fill="none"/></g></g><g/><g><g><text text-anchor="middle" x="44.5" y="132.98333333333335" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">2013</text></g><g><text text-anchor="middle" x="90.83333333333334" y="132.98333333333335" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">2014</text></g><g><text text-anchor="middle" x="137.16666666666669" y="132.98333333333335" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">2015</text></g><g><text text-anchor="middle" x="183.5" y="132.98333333333335" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">2016</text></g><g><text text-anchor="end" x="35" y="124.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#444444">0</text></g><g><text text-anchor="end" x="35" y="101.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#444444">300</text></g><g><text text-anchor="end" x="35" y="78.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#444444">600</text></g><g><text text-anchor="end" x="35" y="55.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#444444">900</text></g><g><text text-anchor="end" x="35" y="32.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#444444">1.200</text></g></g></g><g><g><text text-anchor="middle" x="114" y="145.3166666666667" font-family="Arial" font-size="9" font-style="italic" stroke="none" stroke-width="0" fill="#333333">Năm</text></g></g><g/></svg><div aria-label="Một đại diện của dữ liệu dưới dạng bảng biểu trong biểu đồ." style="position: absolute; left: -10000px; top: auto; width: 1px; height: 1px; overflow: hidden;"><table><thead><tr><th>Năm</th><th>Sales</th><th>Expenses</th></tr></thead><tbody><tr><td>2013</td><td>1000</td><td>400</td></tr><tr><td>2014</td><td>1170</td><td>460</td></tr><tr><td>2015</td><td>660</td><td>1120</td></tr><tr><td>2016</td><td>1030</td><td>540</td></tr></tbody></table></div></div></div><div style="display: none; position: absolute; top: 160px; left: 237px; white-space: nowrap; font-family: Arial; font-size: 9px;" aria-hidden="true">.</div><div></div></div></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-3">
                                <div class="wrap-widget shadow-box">
                                    <h4 class="sub-header">Tỷ lệ phần trăm doanh thu các dịch vụ</h4>
                                    <script type="text/javascript">
                                      google.load("visualization", "1", {packages:["corechart"]});
                                      google.setOnLoadCallback(drawChart);
                                      function drawChart() {
                                
                                        var data = google.visualization.arrayToDataTable([
                                          ['Task', 'Hours per Day'],
                                          ['Hair',     11],
                                          ['Spa',      2],
                                          ['Body',  2],
                                          ['Massage', 2],
                                          ['Face',    7]
                                        ]);
                                
                                        var options = {
                                          title: 'Phần trăm chi tiết dịch vụ'
                                        };
                                
                                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                                
                                        chart.draw(data, options);
                                      }
                                    </script>
                                    <div style="width: 100%; height: 150px;" id="piechart"><div style="position: relative;"><div style="position: relative; width: 227px; height: 150px;" dir="ltr"><div style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;" aria-label="Một biểu đồ."><svg width="227" height="150" style="overflow: hidden;" aria-label="Một biểu đồ."><defs id="defs"/><rect x="0" y="0" width="227" height="150" stroke="none" stroke-width="0" fill="#ffffff"/><g><text text-anchor="start" x="44" y="17.65" font-family="Arial" font-size="9" font-weight="bold" stroke="none" stroke-width="0" fill="#000000">Dịch vụ hàng ngày của Spa</text></g><g><rect x="146" y="29" width="38" height="69" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/><g><rect x="146" y="29" width="38" height="9" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/><g><text text-anchor="start" x="158" y="36.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">Làm tóc</text></g><circle cx="150.5" cy="33.5" r="4.5" stroke="none" stroke-width="0" fill="#3366cc"/></g><g><rect x="146" y="44" width="38" height="9" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/><g><text text-anchor="start" x="158" y="51.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">Làm móng</text></g><circle cx="150.5" cy="48.5" r="4.5" stroke="none" stroke-width="0" fill="#dc3912"/></g><g><rect x="146" y="59" width="38" height="9" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/><g><text text-anchor="start" x="158" y="66.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">Spa</text><rect x="158" y="59" width="26" height="9" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/></g><circle cx="150.5" cy="63.5" r="4.5" stroke="none" stroke-width="0" fill="#ff9900"/></g><g><rect x="146" y="74" width="38" height="9" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/><g><text text-anchor="start" x="158" y="81.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">Massage</text><rect x="158" y="74" width="26" height="9" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/></g><circle cx="150.5" cy="78.5" r="4.5" stroke="none" stroke-width="0" fill="#109618"/></g><g><rect x="146" y="89" width="38" height="9" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"/><g><text text-anchor="start" x="158" y="96.65" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#222222">Khác</text></g><circle cx="150.5" cy="93.5" r="4.5" stroke="none" stroke-width="0" fill="#990099"/></g></g><g><path d="M88,76L88,33A43,43,0,0,1,99.12921893940839,117.53481053042994L88,76A0,0,0,0,0,88,76" stroke="#ffffff" stroke-width="1" fill="#3366cc"/><text text-anchor="start" x="95.23663911802687" y="76.48579591733697" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#ffffff">45.8%</text></g><g><path d="M88,76L46.46518946957007,87.1292189394084A43,43,0,0,1,88,33L88,76A0,0,0,0,0,88,76" stroke="#ffffff" stroke-width="1" fill="#990099"/><text text-anchor="start" x="58.60268910797792" y="66.5679008222701" font-family="Arial" font-size="9" stroke="none" stroke-width="0" fill="#ffffff">29.2%</text></g><g><path d="M88,76L57.59440840897846,106.40559159102155A43,43,0,0,1,46.46518946957007,87.1292189394084L88,76A0,0,0,0,0,88,76" stroke="#ffffff" stroke-width="1" fill="#109618"/></g><g><path d="M88,76L76.87078106059161,117.53481053042994A43,43,0,0,1,57.59440840897846,106.40559159102155L88,76A0,0,0,0,0,88,76" stroke="#ffffff" stroke-width="1" fill="#ff9900"/></g><g><path d="M88,76L99.12921893940839,117.53481053042994A43,43,0,0,1,76.87078106059161,117.53481053042994L88,76A0,0,0,0,0,88,76" stroke="#ffffff" stroke-width="1" fill="#dc3912"/></g><g/></svg><div aria-label="Một đại diện của dữ liệu dưới dạng bảng biểu trong biểu đồ." style="position: absolute; left: -10000px; top: auto; width: 1px; height: 1px; overflow: hidden;"><table><thead><tr><th>Task</th><th>Hours per Day</th></tr></thead><tbody><tr><td>Work</td><td>11</td></tr><tr><td>Eat</td><td>2</td></tr><tr><td>Commute</td><td>2</td></tr><tr><td>Watch TV</td><td>2</td></tr><tr><td>Sleep</td><td>7</td></tr></tbody></table></div></div></div><div style="display: none; position: absolute; top: 160px; left: 237px; white-space: nowrap; font-family: Arial; font-size: 9px;" aria-hidden="true">Sleep</div><div></div></div></div>
                                </div>                  
                            </div>
                            <div class="col-md-9">
                                <div class="wrap-widget shadow-box">
                                    <h4 class="sub-header">Dịch vụ hủy nhiều nhất trong 3 tháng</h4>
                                    <div style="height:150px; overflow:auto;" class="table-responsive">
                                        <table class="table table-striped">
                                          <thead>
                                            <tr>
                                              <th>#</th>
                                              <th>Làm tóc</th>
                                              <th>Làm móng</th>
                                              <th>Spa</th>
                                              <th>Massage</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td>Tháng 01</td>
                                              <td>Lorem</td>
                                              <td>ipsum</td>
                                              <td>dolor</td>
                                              <td>sit</td>
                                            </tr>
                                            <tr>
                                              <td>Tháng 02</td>
                                              <td>amet</td>
                                              <td>consectetur</td>
                                              <td>adipiscing</td>
                                              <td>elit</td>
                                            </tr>
                                            <tr>
                                              <td>Tháng 03</td>
                                              <td>Integer</td>
                                              <td>nec</td>
                                              <td>odio</td>
                                              <td>Praesent</td>
                                            </tr>
                                            <tr>
                                              <td>Tháng 04</td>
                                              <td>libero</td>
                                              <td>Sed</td>
                                              <td>cursus</td>
                                              <td>ante</td>
                                            </tr>
                                            <tr>
                                              <td>Tháng 05</td>
                                              <td>dapibus</td>
                                              <td>diam</td>
                                              <td>Sed</td>
                                              <td>nisi</td>
                                            </tr>
                                            <tr>
                                              <td>Tháng 06</td>
                                              <td>Nulla</td>
                                              <td>quis</td>
                                              <td>sem</td>
                                              <td>at</td>
                                            </tr>
                                            <tr>
                                              <td>Tháng 07</td>
                                              <td>nibh</td>
                                              <td>elementum</td>
                                              <td>imperdiet</td>
                                              <td>Duis</td>
                                            </tr>
                                            <tr>
                                              <td>Tháng 08</td>
                                              <td>sagittis</td>
                                              <td>ipsum</td>
                                              <td>Praesent</td>
                                              <td>mauris</td>
                                            </tr>
                                            <tr>
                                              <td>Tháng 09</td>
                                              <td>Fusce</td>
                                              <td>nec</td>
                                              <td>tellus</td>
                                              <td>sed</td>
                                            </tr>
                                            <tr>
                                              <td>Tháng 10</td>
                                              <td>augue</td>
                                              <td>semper</td>
                                              <td>porta</td>
                                              <td>Mauris</td>
                                            </tr>
                                            <tr>
                                              <td>Tháng 11</td>
                                              <td>massa</td>
                                              <td>Vestibulum</td>
                                              <td>lacinia</td>
                                              <td>arcu</td>
                                            </tr>
                                            <tr>
                                              <td>Tháng 12</td>
                                              <td>eget</td>
                                              <td>nulla</td>
                                              <td>Class</td>
                                              <td>aptent</td>
                                            </tr>
                                            
                                          </tbody>
                                        </table>
                                      </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="wrap-widget shadow-box">
                                    <h4 class="sub-header">Từ khóa được khách tìm kiếm nhiều nhất    (Không quảng cáo)</h4>
                                    <div class="table-responsive">
                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="table table-striped">
                                          <tbody><tr>
                                            <td width="100%">Lorem ipsum</td>
                                            <td align="center"><strong>35</strong></td>
                                            <td width="30" align="center"><span class="box-value up">9</span></td>
                                          </tr>
                                          <tr>
                                            <td>dolor sit</td>
                                            <td align="center"><strong>21</strong></td>
                                            <td align="center"><span class="box-value down">-4</span></td>
                                          </tr>
                                          <tr>
                                            <td>consequat</td>
                                            <td align="center"><strong>11</strong></td>
                                            <td align="center"><span class="box-value down">-6</span></td>
                                          </tr>
                                          <tr>
                                            <td>lacus purus blandit</td>
                                            <td align="center"><strong>10</strong></td>
                                            <td align="center"><span class="box-value down">-4</span></td>
                                          </tr>
                                          <tr>
                                            <td>sit amet euismod</td>
                                            <td align="center"><strong>9</strong></td>
                                            <td align="center"><span class="box-value down">-5</span></td>
                                          </tr>
                                          <tr>
                                            <td>Nullam auctor</td>
                                            <td align="center"><strong>8</strong></td>
                                            <td align="center"><span class="box-value up">8</span></td>
                                          </tr>
                                          <tr>
                                            <td>Donec vestibulum</td>
                                            <td align="center"><strong>8</strong></td>
                                            <td align="center"><span class="box-value down">-5</span></td>
                                          </tr>
                                          <tr>
                                            <td>Aenean sit amet mi id eros;</td>
                                            <td align="center"><strong>7</strong></td>
                                            <td align="center"><span class="box-value down">-3</span></td>
                                          </tr>
                                          <tr>
                                            <td>Mauris</td>
                                            <td align="center"><strong>7</strong></td>
                                            <td align="center"><span class="box-value down">-4</span></td>
                                          </tr>
                                          <tr>
                                            <td>Praesent tempus</td>
                                            <td align="center"><strong>6</strong></td>
                                            <td align="center"><span class="box-value up">5</span></td>
                                          </tr>
                                        </tbody></table>
                                        
                                  </div>
                                </div>
                            </div>            
                            <div class="col-md-6">
                                <div class="wrap-widget shadow-box">
                                    <h4 class="sub-header">Thiết bị được khách sử dụng nhiều nhất</h4>
                                    <div class="table-responsive">
                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="table table-striped">
                                          <tbody><tr>
                                            <td width="100%">Apple</td>
                                            <td align="center"><strong>35</strong></td>
                                            <td width="30" align="center"><span class="box-value up">34</span></td>
                                          </tr>
                                          <tr>
                                            <td>Samsung</td>
                                            <td align="center"><strong>21</strong></td>
                                            <td align="center"><span class="box-value down">-4</span></td>
                                          </tr>
                                          <tr>
                                            <td>Dell</td>
                                            <td align="center"><strong>11</strong></td>
                                            <td align="center"><span class="box-value down">-6</span></td>
                                          </tr>
                                          <tr>
                                            <td>Nokia</td>
                                            <td align="center"><strong>10</strong></td>
                                            <td align="center"><span class="box-value down">-4</span></td>
                                          </tr>
                                          <tr>
                                            <td>Google</td>
                                            <td align="center"><strong>9</strong></td>
                                            <td align="center"><span class="box-value down">-5</span></td>
                                          </tr>
                                          <tr>
                                            <td>Asus</td>
                                            <td align="center"><strong>8</strong></td>
                                            <td align="center"><span class="box-value notchange">-</span></td>
                                          </tr>
                                          <tr>
                                            <td>HTC</td>
                                            <td align="center"><strong>8</strong></td>
                                            <td align="center"><span class="box-value down">-5</span></td>
                                          </tr>
                                          <tr>
                                            <td>LG</td>
                                            <td align="center"><strong>7</strong></td>
                                            <td align="center"><span class="box-value new">NEW</span></td>
                                          </tr>
                                          <tr>
                                            <td>Acer</td>
                                            <td align="center"><strong>7</strong></td>
                                            <td align="center"><span class="box-value down">-4</span></td>
                                          </tr>
                                          <tr>
                                            <td>BlackBerry</td>
                                            <td align="center"><strong>6</strong></td>
                                            <td align="center"><span class="box-value up">5</span></td>
                                          </tr>
                                        </tbody></table>
                                        
                                  </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>

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





</html>