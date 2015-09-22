<ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
    <li><a href="<?php echo base_url();?>">Quản lý Spa</a></li>
    <li class="active">Thống kê</li>            
</ol>
<html>
    <meta charset="utf-8">


<div class="main-content">


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