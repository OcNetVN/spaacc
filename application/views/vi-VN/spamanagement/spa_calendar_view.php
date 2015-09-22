<!DOCTYPE html>
<head>
	<meta charset="utf-8">
  <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
  <title>FCSE Spa - Quản lý dành cho Spa </title>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width">        
 
    <!-- daypilot libraries -->
    <script src="resources/spamanagement/js/daypilot-all.min.js?v=1514" type="text/javascript"></script>
</head>

      
          <ol class="breadcrumb">
            <li><a href="#">FCSE Spa</a></li>
            <li><a href="#">Tài chính</a></li>
            <li class="active">Calendar</li>            
          </ol>
          <h1>Thời gian biểu</h1>
          
           <div class="note"><b>Ghi chú:</b> Bạn có thể cập & xem lịch booking <a href="http://javascript.daypilot.org/calendar/"></a>.</div>

            <div id="dp"></div>

            <script type="text/javascript">

                var dp = new DayPilot.Calendar("dp");

                //dp.cellDuration = 120;
                //dp.timeHeaderCellDuration = 120;
                //dp.cellHeight = 60;

                // view
                dp.startDate = "2013-03-25";  // or just dp.startDate = "2013-03-25";
                dp.viewType = "Week";
                dp.allDayEventHeight = 25;
                dp.initScrollPos = 9 * 40;

                dp.eventDeleteHandling = "Update";
                dp.onEventDelete = function (args) {
                    alert("Xóa: " + args.e.text());
                };
                
                // bubble, with async loading
                dp.bubble = new DayPilot.Bubble({
                    onLoad: function (args) {
                        var ev = args.source;
                        //alert("event: " + ev);
                        args.async = true;  // notify manually using .loaded()

                        // simulating slow server-side load
                        setTimeout(function () {
                            args.html = "testing bubble for: <br>" + ev.text();
                            args.loaded();
                        }, 500);
                    }
                });

                dp.contextMenu = new DayPilot.Menu({
                    items: [
                    { text: "Show event ID", onclick: function () { alert("Event value: " + this.source.value()); } },
                    { text: "Show event text", onclick: function () { alert("Event text: " + this.source.text()); } },
                    { text: "Show event start", onclick: function () { alert("Event start: " + this.source.start().toStringSortable()); } },
                    { text: "Delete", onclick: function () { dp.events.remove(this.source); } }
                    ]
                });

                // event moving
                dp.onEventMoved = function (args) {
                    dp.message("Moved: " + args.e.text());
                };

                // event resizing
                dp.onEventResized = function (args) {
                    dp.message("Resized: " + args.e.text());
                };

                // event creating
                dp.onTimeRangeSelected = function (args) {
                    var name = prompt("New event name:", "Event");
                    if (!name) return;
                    var e = new DayPilot.Event({
                        start: args.start,
                        end: args.end,
                        id: DayPilot.guid(),
                        resource: args.resource,
                        text: "Event"
                    });
                    dp.events.add(e);
                    dp.clearSelection();
                    dp.message("Created");
                };

                dp.onTimeRangeDoubleClicked = function (args) {
                    alert("DoubleClick: start: " + args.start + " end: " + args.end + " resource: " + args.resource);
                };

                dp.onEventClick = function (args) {
                    alert("clicked: " + args.e.id());
                };

                dp.showEventStartEnd = true;
                dp.scrollLabelsVisible = true;

                var e = new DayPilot.Event({
                    start: new DayPilot.Date("2013-03-25T12:00:00"),
                    end: new DayPilot.Date("2013-03-25T12:00:00").addHours(3),
                    id: DayPilot.guid(),
                    text: "Khách đặt"
                });
                dp.events.add(e);

                dp.columns = [
                    { name: "One" },
                    { name: "Two" },
                ];

                dp.init();
            </script>
             
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

 </div>
     

     </html>