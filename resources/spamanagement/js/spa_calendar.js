/*
|----------------------------------------------------------------
| call funciton from common_function.js
| function check email
| function ForceNumericOnly
|----------------------------------------------------------------
*/
$(document).ready(function() {
    // Load_Calendar('Moth',$("#ngay_xem").val());
  
});
function change_time(value){
    $('#divLoad').children().remove();
    $("#divLoad").append("<div id='calendar_booking'></div>");

    var hienthi = $('#hienthi_xem').val();

    Load_Calendar(hienthi,value);
    // alert(value);

}
function change_hienthi(hienthi){
    $('#divLoad').children().remove();
    $("#divLoad").append("<div id='calendar_booking'></div>");

    var value = $('#ngay_xem').val();
    // console.log(value);

    Load_Calendar(hienthi,value);
    // alert(value);

}

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

function Load_Calendar(hienthi,ngay){
    // BEGIN Khởi tạo Calendar
    var dp = new DayPilot.Calendar("calendar_booking"); // render Calendar có id="calendar_booking"
// console.log(ngay);
    // view
    // var d= new Date();
    if(hienthi=='Moth'){
        dp.viewType = "Days";
        dp.days = 30;
        dp.columnWidth = 145;

    }
    if(hienthi=='Week'){
        dp.viewType = "Days";
        dp.days = 7; 
        dp.columnWidth = 145;  
    }
    if(hienthi=='Day'){
        dp.viewType = "Days";
        dp.days = 1;
        dp.columnWidth = 1005;

    }



    dp.startDate = ngay;   
    dp.headerDateFormat = "yyyy-MM-dd";
    dp.headerHeightAutoFit = false;
    dp.headerHeight = 40;

    dp.crosshairType = "Full";
    dp.heightSpec = "Fixed";
    dp.height = 500; //968


    dp.columnWidthSpec = "Fixed";



    dp.durationBarVisible = true;
    // dp.timeHeaderCellDuration = 30;
    // dp.selectedColor ="#FF6600";














    // //sau khi render
    // dp.onAfterRender = function (args) {
    //     alert("Rendering finished.");
    // };
    // //truoc khi hien thi
    // dp.onBeforeEventRender = function(args) {
    // // // alert("ssssssssss");
    // // args.e.FontColor = "12";
    // // console.log(args.e);
    //     args.e.html = args.e.text + ":";
    // };







    // tooltip cho booking
    dp.bubble = new DayPilot.Bubble({
        onLoad: function (args) {
            var ev = args.source;
            // alert("event: " + ev);
            // console.log(ev.data);
            args.async = true;  // notify manually using .loaded()

            // simulating slow server-side load
            setTimeout(function () {
                args.html = "Khách Hàng : " + ev.data.FullName;
                args.loaded();
            }, 10);
        }
    });
    //click right booking có các option & event
    dp.contextMenu = new DayPilot.Menu({
        items: [
        { text: "Show event ID", onclick: function () { alert("Event value: " + this.source.value()); } },
        { text: "Show event text", onclick: function () { alert("Event text: " + this.source.text()); } },
        { text: "Show event start", onclick: function () { alert("Event start: " + this.source.start().toStringSortable()); } },
        { text: "Edit", onclick: function () { Modal_Edit_Booking_Calendar(this.source); } },
        { text: "Delete", onclick: function () { alert("aaaaaaaaa");dp.events.remove(this.source); } },
        { text:"CallBack: Delete this event", command: "delete"} ,
          {text:"submenu", items: [
                  {text:"Show event ID", onclick: function() {alert("Event value: " + this.source.value());} },
                  {text:"Show event text", onclick: function() {alert("Event text: " + this.source.text());} }
              ]
          }
        ],
        cssClassPrefix: "menu_default"
    });

    // event moving
    // dp.onEventMoved = function (args) {
    //     dp.message("Moved: " + args.e.text());
    // };
    // event moving


    // event resizing
    // Resize booking offline
    // dp.onEventResized = function (args) {
    //     dp.message("Resized: " + args.e.text());
    // };
    // // event resizing
    // Resize booking offline
   



    // Xóa
    // dp.eventDeleteHandling = "Update";
    // dp.onEventDelete = function(args) {
    //     if (!confirm("Do you really want to delete this event?")) {
    //         args.preventDefault();
    //     }
    // };
    // dp.onEventDeleted = function(args) {
    //     dp.message("Event deleted: " + args.e.text());
    // };
    // Xóa


    // Create Booking Offline
    // dp.onTimeRangeSelected = function (args) {
    //     var name = prompt("New event name:", "Event");
    //     if (!name) return;
    //     var e = new DayPilot.Event({
    //         start: args.start,
    //         end: args.end,
    //         id: DayPilot.guid(),
    //         resource: args.resource,
    //         text: "Event",
    //         backColor: "orange",
    //         Color: "red"

    //     });
    //     dp.events.add(e);
    //     dp.clearSelection();
    //     dp.message("Created");
    // };
    // Create Booking Offline

    //double click vào khoảng trống hiện thị thông tin vùng trống
    // dp.onTimeRangeDoubleClicked = function (args) {
    //     alert("DoubleClick: start: " + args.start + " end: " + args.end + " resource: " + args.resource);
    // };

    //View booking
    dp.onEventClick = function (args) {
        // alert("clicked aaaaaaaaaaaaaa: " + args.e.id());
        Modal_View_Booking_Calendar(args);
    };

    dp.showEventStartEnd = true;
    dp.scrollLabelsVisible = true;

    ngay = ngay.substring(0,10);

    $.ajax({
        type:"POST",
        url:"home_controller/Load_Calendar",
        dataType:"text",
        data: {
            ngay:ngay,
            songay:dp.days
        },
        cache:false,
        success:function (data) {
            // if( data== "-1" || data==="-1" || data==-1 )
            // {
            //     alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            // }
            // else
            // {
                // alert('Thêm thành công');
                // console.log(data);
                // return;
                Load_Calendar_Complete(dp,data);
            // }
          //alert(data);
        },
        
    });



    
}
function Load_Calendar_Complete(dp,data){  

    var sRes = JSON.parse(data);
    var count_b_on = 0;
    var count_b_off = 0;

    var arr = [];
    for (var i = 0; i < sRes.lst.length; i++) {
        var time = sRes.lst[i].Duration/60;
        var col = "#";
        if(sRes.lst[i].bookingpayment.PayMethod=="05"){ // booking offline
            col+= "FF9E78";  //đỏ   
            count_b_off+=1;       
        }
        else{ //booking online
            col+= "73D8F1"; // xanh 
            count_b_on+=1;
        }
        var a = {
              start: new DayPilot.Date(sRes.lst[i].FromTime),
              end:  new DayPilot.Date(sRes.lst[i].ToTime),
              // start: new DayPilot.Date("2015-10-0"+i+"T0"+i+":00:00"),
              // end: new DayPilot.Date("2015-10-0"+i+"T0"+i+":00:00").addHours(1),
              id: DayPilot.guid(),
              text: sRes.lst[i].Name,
              FullName: sRes.lst[i].booking_object.FullName,
              Duration: sRes.lst[i].Duration,
              FromTime: sRes.lst[i].FromTime,
              ToTime: sRes.lst[i].ToTime,
              Status: sRes.lst[i].Status,
              backColor: col,
              booking_object: sRes.lst[i].booking_object,
              bookingonlinepay: sRes.lst[i].bookingonlinepay,
              bookingpayment: sRes.lst[i].bookingpayment
            };
            arr.push(a);
    };
    // console.log(arr);
    var str="";
    str+="<p><span class='On_color' ></span> Booking Online : "+count_b_on+" </p>";
    str+="<p><span class='Off_color'></span> Booking Offline : "+count_b_off+" </p>";

    $('#Count_booking').children().remove();           
    $("#Count_booking").append(str);

    dp.dayBeginsHour = sRes.dayBeginsHour;

    dp.events.list = arr;
    dp.init();
    $('.calendar_default_corner div:eq(1)').remove();
}

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
function Modal_View_Booking_Calendar(args){ 
    // console.log(args.e.data.bookingdetail);
     // console.log(args.e.data.booking_object);

    var st = "";
    if(args.e.data.Status==1){ // chưa thanh toán
        st= "chưa thanh toán";
    }
    if(args.e.data.Status==2){ // đã thanh toán
        st= "Đã thanh toán";
    }
    if(args.e.data.Status==0){ // đã hủy
        st= "Đã hủy";
    }
    var str="<div class='row'id='View_detail'>";
    str+="<div class='col-md-3'>Tên Khách Hàng</div><div class='col-md-9'><span class='pull-left'>"+args.e.data.booking_object.FullName+"</span></div>";
    str+="<div class='col-md-3'>Dịch vụ</div><div class='col-md-9'><span class='pull-left'>"+args.e.data.text+"</span></div>";
    str+="<div class='col-md-3'>Thời lượng</div><div class='col-md-9'><span class='pull-left'>"+args.e.data.Duration+" phút</span></div>";
    str+="<div class='col-md-3'>Thời gian bắt đầu</div><div class='col-md-9'><span class='pull-left'>"+args.e.data.FromTime+"</span></div>";
    str+="<div class='col-md-3'>Thời gian kết thúc</div><div class='col-md-9'><span class='pull-left'>"+args.e.data.ToTime+"</span></div>";
    str+="<div class='col-md-3'>Thanh Toán</div><div class='col-md-9'><span class='pull-left'>"+args.e.data.bookingpayment.StrValue1+"</span></div>";
    str+="<div class='col-md-3'>Tình trạng</div><div class='col-md-9'><span class='pull-left'>"+st+"</span></div>";
    str+="</div>";


    $('#myModal_View_Booking_Calendar div.modal-body').children().remove();           
    $("#myModal_View_Booking_Calendar div.modal-body").append(str);

    $('#myModal_View_Booking_Calendar').modal()                      // initialized with defaults
    $('#myModal_View_Booking_Calendar').modal({ keyboard: false })   // initialized with no keyboard
    $('#myModal_View_Booking_Calendar').modal('show')                // initializes and invokes show immediately
}



function Modal_Edit_Booking_Calendar(args){ 
    if(args.data.bookingpayment.PayMethod=="05"){ //booking ofline

        $('#Edit_FullName').html(''); 
        $('#Edit_TenDV').html('');   
        $('#Edit_Duration').html(''); 
        $('#Edit_FromTime').val('');
        $('#Edit_TomTime').val('');
        $('#Edit_Thanhtoan').html('');
        $('#Edit_Status').html('');  
         document.getElementById("Edit_Booking_Detail").onclick=null; 


        // console.log(args);
        var st = "";
        if(args.data.Status==1){ // chưa thanh toán
            st= "chưa thanh toán";
        }
        if(args.data.Status==2){ // đã thanh toán
            st= "Đã thanh toán";
        }
        if(args.data.Status==0){ // đã hủy
            st= "Đã hủy";
        }
        $('#Edit_FullName').append(args.data.booking_object.FullName); 
        $('#Edit_TenDV').append(args.data.text);    
        $('#Edit_Duration').append(args.data.Duration+" phút"); 
        $('#Edit_FromTime').val(args.data.FromTime);
        $('#Edit_ToTime').val(args.data.ToTime);
        $('#Edit_Thanhtoan').append(args.data.bookingpayment.StrValue1); 
        $('#Edit_Status').append(st);

        document.getElementById("Edit_Booking_Detail").setAttribute("onclick", "Edit_Booking_Detail();");

        



        $('#myModal_Edit_Booking_Calendar').modal()                      // initialized with defaults
        $('#myModal_Edit_Booking_Calendar').modal({ keyboard: false })   // initialized with no keyboard
        $('#myModal_Edit_Booking_Calendar').modal('show')                // initializes and invokes show immediately
    }
}

// function Edit_Booking_Detail(value){
//     $('#divLoad').children().remove();
//     $("#divLoad").append("<div id='calendar_booking'></div>");

//     var hienthi = $('#hienthi_xem').val();

//     Load_Calendar(hienthi,value);
//     // alert(value);

// }



