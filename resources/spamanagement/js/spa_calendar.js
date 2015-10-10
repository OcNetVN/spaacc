/*
|----------------------------------------------------------------
| call funciton from common_function.js
| function check email
| function ForceNumericOnly
|----------------------------------------------------------------
*/
$(document).ready(function() {
    // Load_Calendar('Moth',$("#ngay_xem").val());
    //  $("#Edit_FromTime").click(function () {
        
    //     document.getElementById("Edit_FromTime").setAttribute("onchange", "Check_Thoigianbatdau();");
    // });
    // 
    


  
});
function change_time(value){

    var hienthi = $('#hienthi_xem').val();
    Load_Calendar(hienthi,value);

}
function change_hienthi(hienthi){
    var value = $('#ngay_xem').val();
    Load_Calendar(hienthi,value);

}

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

function Load_Calendar(hienthi,ngay){
    $('#divLoad').children().remove();
    $("#divLoad").append("<div id='calendar_booking'></div>");
    // BEGIN Khởi tạo Calendar
    var dp = new DayPilot.Calendar("calendar_booking"); // render Calendar có id="calendar_booking"


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
            var st = "";
            if(ev.data.Status==1){ // chưa thanh toán
                st= "Chưa thanh toán";
            }
            if(ev.data.Status==2){ // đã thanh toán
                st= "Đã thanh toán";
            }
            if(ev.data.Status==0){ // đã hủy
                st= "Đã hủy";
            }
            // simulating slow server-side load
            setTimeout(function () {

                var str = "Khách hàng : " + ev.data.FullName+"<br/>";
                str+= "Thanh toán : "+ ev.data.bookingpayment.StrValue1+"<br/>";
                str+= "Tình trạng : "+ st +"<br/>";
                args.html = str;
                args.loaded();
            }, 10);
        }
    });
    //click right booking có các option & event
    dp.contextMenu = new DayPilot.Menu({
        items: [
        // { text: "Show event ID", onclick: function () { alert("Event value: " + this.source.value()); } },
        // { text: "Show event text", onclick: function () { alert("Event text: " + this.source.text()); } },
        // { text: "Show event start", onclick: function () { alert("Event start: " + this.source.start().toStringSortable()); } },
        { text: "Cập nhật", onclick: function () { Modal_Edit_Booking_Calendar(this.source); } },
        { text: "Xóa", 
            onclick: function () {
                if (!confirm("Bạn có muốn xóa booking này không ?")) {
                    return;
                }
                Modal_Delete_Booking_Calendar(this.source);
                // alert("aaaaaaaaa");dp.events.remove(this.source);

            } 

         }, 
        // { text:"CallBack: Delete this event", command: "delete"} ,
        // {text:"submenu", items: [
        //           {text:"Show event ID", onclick: function() {alert("Event value: " + this.source.value());} },
        //           {text:"Show event text", onclick: function() {alert("Event text: " + this.source.text());} }
        //       ]
        //   }
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
        if(sRes.lst[i].bookingpayment.PayMethod=="11"){ // booking offline
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
              bookingID:sRes.lst[i].bookingID,
              ProductID:sRes.lst[i].ProductID,
              text: sRes.lst[i].Name+" - "+sRes.lst[i].Duration+"phút",
              Name: sRes.lst[i].Name,
              FullName: sRes.lst[i].booking_object.FullName,
              Duration: sRes.lst[i].Duration,
              FromTime: sRes.lst[i].FromTime,
              ToTime: sRes.lst[i].ToTime,
              Qty: sRes.lst[i].Qty,
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
        st= "Chưa thanh toán";
    }
    if(args.e.data.Status==2){ // đã thanh toán
        st= "Đã thanh toán";
    }
    if(args.e.data.Status==0){ // đã hủy
        st= "Đã hủy";
    }
    var str="<div class='row'id='View_detail'>";
    str+="<div class='col-md-12'><div class='col-md-3'>Tên Khách Hàng</div><div class='col-md-9'><span class='pull-left'>"+args.e.data.booking_object.FullName+"</span></div></div>";
    str+="<div class='col-md-12'><div class='col-md-3'>Số điện thoại</div><div class='col-md-9'><span class='pull-left'>"+args.e.data.booking_object.Tel+"</span></div></div>";
    str+="<div class='col-md-12'><div class='col-md-3'>Email</div><div class='col-md-9'><span class='pull-left'>"+args.e.data.booking_object.Email+"</span></div></div>";
    str+="<div class='col-md-12'><div class='col-md-3'>Dịch vụ</div><div class='col-md-9'><span class='pull-left'>"+args.e.data.Name+"</span></div></div>";
    str+="<div class='col-md-12'><div class='col-md-3'>Thời lượng <sub>( phút )</sub></div><div class='col-md-9'><span class='pull-left'>"+args.e.data.Duration+"</span></div></div>";
    str+="<div class='col-md-12'><div class='col-md-3'>Thời gian bắt đầu</div><div class='col-md-9'><span class='pull-left'>"+args.e.data.FromTime+"</span></div></div>";
    str+="<div class='col-md-12'><div class='col-md-3'>Thời gian kết thúc</div><div class='col-md-9'><span class='pull-left'>"+args.e.data.ToTime+"</span></div></div>";
    str+="<div class='col-md-12'><div class='col-md-3'>Thanh Toán</div><div class='col-md-9'><span class='pull-left'>"+args.e.data.bookingpayment.StrValue1+"</span></div></div>";
    str+="<div class='col-md-12'><div class='col-md-3'>Số lượng</div><div class='col-md-9'><span class='pull-left'>"+args.e.data.Qty+"</span></div></div>";
    str+="<div class='col-md-12'><div class='col-md-3'>Tình trạng</div><div class='col-md-9'><span class='pull-left'>"+st+"</span></div></div>";
    str+="</div>";


    $('#myModal_View_Booking_Calendar div.modal-body').children().remove();           
    $("#myModal_View_Booking_Calendar div.modal-body").append(str);

    $('#myModal_View_Booking_Calendar').modal()                      // initialized with defaults
    $('#myModal_View_Booking_Calendar').modal({ keyboard: false })   // initialized with no keyboard
    $('#myModal_View_Booking_Calendar').modal('show')                // initializes and invokes show immediately
}



function Modal_Edit_Booking_Calendar(args){ 
    if(args.data.bookingpayment.PayMethod=="11")//booking ofline
    {
        $('#Edit_BookingID').val(''); 
        $('#Edit_ProductID').val('');
        $('#Edit_FullName').html('');
        $('#Edit_Tel').html(' '); 
        $('#Edit_Email').html(' '); 

        $('#Edit_TenDV').html('');   
        $('#Edit_Duration').html(''); 
        $('#Edit_FromTime').val('');
        $('#Edit_ToTime').html('');
        
        $('#Edit_Quantity').html('');
        $('#Edit_Thanhtoan').html('');
        $('#Edit_Status').html(''); 

        // document.getElementById("Edit_FromTime").onclick=null; 
        document.getElementById("Submit_Booking_Detail").onclick=null; 

        // console.log(args);
        var st = "";
        if(args.data.Status==1){ // chưa thanh toán
            st= "Chưa thanh toán";
        }
        if(args.data.Status==2){ // đã thanh toán
            st= "Đã thanh toán";
        }
        if(args.data.Status==0){ // đã hủy
            st= "Đã hủy";
        }
        $('#Edit_BookingID').val(args.data.bookingID); 
        $('#Edit_ProductID').val(args.data.ProductID);
        $('#Edit_FullName').append(args.data.booking_object.FullName); 
        $('#Edit_Tel').append(args.data.booking_object.Tel);  
        $('#Edit_Email').append(args.data.booking_object.Email); 
        $('#Edit_TenDV').append(args.data.Name);    
        $('#Edit_Duration').append(args.data.Duration); 
        $('#Edit_FromTime').val(args.data.FromTime);
        $('#Edit_ToTime').append(args.data.ToTime);
        $('#Edit_Thanhtoan').append(args.data.bookingpayment.StrValue1);
        $('#Edit_Quantity').append(args.data.Qty);
        $('#Edit_Status').append(st);
        
        document.getElementById("Submit_Booking_Detail").setAttribute("onclick", "Submit_Booking_Detail();");

        $('#myModal_Edit_Booking_Calendar').modal()                      // initialized with defaults
        $('#myModal_Edit_Booking_Calendar').modal({ keyboard: false })   // initialized with no keyboard
        $('#myModal_Edit_Booking_Calendar').modal('show')                // initializes and invokes show immediately
    }
    else{

        var thongbao= "Không thể cập nhật booking online";
        $('#myModal_Error div.modal-body').html('');           
        $("#myModal_Error div.modal-body").append(thongbao);

        $('#myModal_Error').modal();                      // initialized with defaults
        $('#myModal_Error').modal({ keyboard: false });   // initialized with no keyboard
        $('#myModal_Error').modal('show');
    }
}

function Submit_Booking_Detail(){
    var bookingID =  $('#Edit_BookingID').val();
    var pro = $('#Edit_ProductID').val();
    var time =  $('#Edit_FromTime').val();
    $.ajax({
        type: "POST",
        url:"home_controller/Submit_Booking_Detail",
        dataType: "json",
        data: {
            bookingID:bookingID,
            ProductID:pro,
            ngaybook: time
        },
        cache: false,
        success: function (data) {
            Submit_Booking_Detail_complete(data);
        }
    });


}

function Submit_Booking_Detail_complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes==0 || sRes=="0"){
        alert('Thời gian bắt đầu không hợp lệ');
        return ;
    }
    if(sRes==false || sRes=="false"){
        alert('Cập nhật không thành công');
        return ;
    }
        $('#myModal_Edit_Booking_Calendar').modal('hide') ;

        var thongbao= "Cập nhật thành công";
        $('#myModal_Error div.modal-body').html('');           
        $("#myModal_Error div.modal-body").append(thongbao);

        $('#myModal_Error').modal();                      // initialized with defaults
        $('#myModal_Error').modal({ keyboard: false });   // initialized with no keyboard
        $('#myModal_Error').modal('show');
        setTimeout(function(){
            $('#myModal_Error').modal('hide');
            var hienthi = $('#hienthi_xem').val();
            var value = $('#ngay_xem').val();
            Load_Calendar(hienthi,value);
        }, 1000);
}

function Call_myModal_Add_Booking_Calendar()
{

    var str="<div class='row'id='View_detail'>";
    str+="<div class='col-md-12'>";
        str+="<div class='col-md-3'>Tên Khách Hàng</div>";
        str+="<div class='col-md-9'>";
            str+="<span class='pull-left'><input type='text' class='form-control' id='Add_TenKhachHang' name='Add_TenKhachHang' ></span>";
            str+=" <span class='notify_error_ngang' style='display: none;' id='tb_FullName'><span class='caret_muiten_ngang'></span>Nhập Tên Khách Hàng</span>";
        str+="</div>";
    str+="</div>";

    str+="<div class='col-md-12'>";
        str+="<div class='col-md-3'>Số điện thoại</div>";
        str+="<div class='col-md-9'>";
            str+="<span class='pull-left'><input type='text' class='form-control' id='Add_Tel' name='Add_Tel' ></span>";
            str+=" <span class='notify_error_ngang' style='display: none;' id='tb_Tel'><span class='caret_muiten_ngang'></span>Nhập Số điện thoại</span>";
        str+="</div>";
    str+="</div>";

    str+="<div class='col-md-12'>";
        str+="<div class='col-md-3'>Email</div>";
        str+="<div class='col-md-9'>";
            str+="<span class='pull-left'><input type='text' class='form-control' id='Add_Email' name='Add_Email' ></span>";
            str+=" <span class='notify_error_ngang' style='display: none;' id='tb_Email'><span class='caret_muiten_ngang'></span>Nhập Email</span>";
        str+="</div>";
    str+="</div>";

    str+="<div class='col-md-12'>";
        str+="<div class='col-md-3'>Lọai dịch vụ</div>";
        str+="<div class='col-md-9'>";
            str+="<span id='show_ldv'><select id='cboProductType_Add' class='form-control' name='cboProductType_Add' style='width: 207px;float: left;' onchange='Load_DV(this.value);'></select></span>";
            str+=" <span class='notify_error_ngang' style='display: none;' id='show_tb'><span class='caret_muiten_ngang'></span>Chọn loại dịch vụ khác</span>";
        str+="</div>";
    str+="</div>";


    str+="<div class='col-md-12'>";
        str+="<div class='col-md-12'>";
            str+="<span id='show_dv'></span>";
            str+=" <span class='notify_error_ngang' style='display: none;' id='tb_dv'><span class='caret_muiten'></span>Chọn dịch vụ</span>";
        str+="</div>";
    str+="</div>";

    str+="<div class='col-md-12'><div class='col-md-3'>Ghi chú</div><div class='col-md-9'><span class='pull-left'><textarea class='form-control col-xs-12' id='Add_Note' name='Add_Note'></textarea></span></div></div>";
    str+="</div>";

    GetProductType_Spa();



    $('#myModal_Add_Booking_Calendar div.modal-body').html('');           
    $("#myModal_Add_Booking_Calendar div.modal-body").append(str);
    $('#myModal_Add_Booking_Calendar').modal();                      // initialized with defaults
    $('#myModal_Add_Booking_Calendar').modal({ keyboard: false });   // initialized with no keyboard
    $('#myModal_Add_Booking_Calendar').modal('show');


    
}

function GetProductType_Spa() {
    $.ajax({
        url: "home_controller/GetProductType_Spa",
        type: "POST",   
        contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                    GetProductType_Spa_Complete(data);
                },
        error: function () {
        }
    });
}
function GetProductType_Spa_Complete(data) {
    var sRes = JSON.parse(data);  
    if (sRes != null) {
        // $("#cboProductType option").remove();
        // $("#cboProductType").append(sRes);

        $("#cboProductType_Add option").remove();
        $("#cboProductType_Add").append(sRes);

    }
}

function Load_DV(value)
{
    $("#tb_dv").hide(10);
    $.ajax({
        type: "POST",
        url:"home_controller/get_products_by_spa_ProductType",
        dataType: "text",
        data: {
            ProductType: value
        },
        cache: false,
        success: function (data) {
            var sRes = JSON.parse(data);
            var demo=$('ul').hasClass('loai_'+value);
            if(sRes.lst.length!=0 && demo ==false){
                $("#show_tb").hide(100);
                var str_dv="<ul class='loai_"+value+" col-sm-12' style='padding:0px;'>";
                for (var i = 0; i <sRes.lst.length; i++) {
                    if(sRes.lst[i].Giahientai!=null){
                        str_dv+="<li class='col-sm-12 list-group-item' style='background: #F0F7ED;'>";
                        str_dv+="<input type='checkbox' id='check_product_"+sRes.lst[i].ProductID+"' name='check_product' value="+sRes.lst[i].ProductID+" onchange='Check_Product(this.value);'> ";
                        str_dv+="<b style='font-size: 12px;'>"+sRes.lst[i].Name+"</b>";
                        str_dv+="<p class='Giahientai'>Giá - "+sRes.lst[i].Giahientai+" VND</p>";
                        str_dv+="<div id='soluong_thoigian_"+sRes.lst[i].ProductID+"' class='soluong_thoigian' style='display:none'>"
                        str_dv+="<p><label>Số lượng </label><input type='text' id='Add_SoLuong_"+sRes.lst[i].ProductID+"' name='Add_SoLuong_"+sRes.lst[i].ProductID+"' value='1'><span class='notify_error_ngang' style='display: none;float: none;' id='ssll_"+sRes.lst[i].ProductID+"'><span class='caret_muiten_ngang'></span>Nhập số lượng</span></p>";
                        str_dv+="<p><label>Thời gian</label><input type='text' id='Add_FromTime_"+sRes.lst[i].ProductID+"' name='Add_FromTime_"+sRes.lst[i].ProductID+"' ><span class='notify_error_ngang' style='display: none;float: none;' id='thgian_"+sRes.lst[i].ProductID+"'><span class='caret_muiten_ngang'></span>Chọn thời gian khác</span></p>";
                        str_dv+="</div>";
                        str_dv+="</li>"; 
                    }
                }
                str_dv+="</ul>";         
                $("#show_dv").prepend(str_dv);
            }
            else{
                $("#show_tb").show(500);
            }
            
        }
    });
}

function Check_Product(ProductID)
{
    // var d = document.getElementById('check_product_'+ProductID);
    // var x = $('#check_product_'+ProductID).is(':checked')
    $('*[name=Add_FromTime_'+ProductID+']').appendDtpicker();


    if($('#check_product_'+ProductID).is(':checked')==true)
    {
        document.getElementById('check_product_'+ProductID).setAttribute("checked", "true");
        $("#soluong_thoigian_"+ProductID).show(500);
    }
    else{
        document.getElementById('check_product_'+ProductID).setAttribute("checked", "false");
        $("#soluong_thoigian_"+ProductID).hide(500);
        $("#ssll_"+ProductID).hide(500);
        $("#Add_SoLuong_"+ProductID).val('1');
        $("#thgian_"+ProductID).hide(500);



    }
    // alert(ProductID);
}


function Submit_Add_Booking_Offline()
{
    $("#tb_FullName").hide(10);
    $("#tb_Tel").hide(10);
    $("#tb_Email").hide(10);
    $("#tb_dv").hide(10);
    $("#show_tb").hide(10);


    var FullName      =     $('#Add_TenKhachHang').val();
    var Tel           =     $('#Add_Tel').val();
    var Email         =     $('#Add_Email').val();
    var Note          =     $('#Add_Note').val();

    var Product_check =   [];
    $('input:checkbox[name=check_product]:checked').each(function(){

        var ProductID            =   $(this).val();
        // var soluong = document.getElementById('Add_SoLuong_'+ProductID).value;

        var arr                 =   {
                                        ProductID : ProductID,
                                        Qty       : $('#Add_SoLuong_'+ProductID).val(),
                                        FromTime  : $('#Add_FromTime_'+ProductID).val(),
                                    };

        Product_check.push(arr);
        $("#ssll_"+ProductID).hide(10);
        $("#thgian_"+ProductID).hide(10);
    });

    var flag = 0;

    if(FullName==""){
        $("#tb_FullName").show(500);
        $("#Add_TenKhachHang").focus();
        flag = 1;
    }
    if(Tel=="" || isNaN(Tel) ){
        $("#tb_Tel").show(500);
        $("#Add_Tel").focus();
        flag = 1;
    }
    if(Email=="" || !checkemail(Email)){
        $("#tb_Email").show(500);
        $("#Add_Email").focus();
        flag = 1;
    }

    if(Product_check.length==0){
        $("#tb_dv").show(500);
        flag = 1;
    }
    for (var i = 0 ; i < Product_check.length ; i++) {
        if(isNaN(Product_check[i].Qty)){
            $("#ssll_"+Product_check[i].ProductID).show(500);
            flag = 1;
        }
    }
    // console.log(Product_check);
    if(flag == 1)
    {
         return;
    }
    // alert("Luu");
    $.ajax({
        type: "POST",
        url:"home_controller/Submit_Add_Booking_Offline",
        dataType: "text",
        data: {
            FullName: FullName,
            Tel: Tel,
            Email: Email,
            Note: Note,            
            Product_check: Product_check
        },
        cache: false,
        success: function (data) {
             // if( data== "-1" || data==="-1" || data==-1 )
            // {
            //     alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            // }
            // else
            // {
                // alert('Thêm thành công');
                // console.log(data);
                // return;
                Submit_Add_Booking_Offline_Complete(data);
            // }
          //alert(data);
            
        }
    });
}

function  Submit_Add_Booking_Offline_Complete(data){
    // alert("OK");
     var sRes = JSON.parse(data);
    if(sRes.result==true || sRes.result=="true"){
        $('#myModal_Add_Booking_Calendar').modal('hide') ;

        var thongbao= "Tạo booking offline thành công";
        $('#myModal_Error div.modal-body').html('');           
        $("#myModal_Error div.modal-body").append(thongbao);

        $('#myModal_Error').modal();                      // initialized with defaults
        $('#myModal_Error').modal({ keyboard: false });   // initialized with no keyboard
        $('#myModal_Error').modal('show');
        setTimeout(function(){
            $('#myModal_Error').modal('hide');
            var hienthi = $('#hienthi_xem').val();
            var value = $('#ngay_xem').val();
            Load_Calendar(hienthi,value);
        }, 5000);

    }
    else{
        if(sRes.action=="FromTime"){
            $("#thgian_"+sRes.fix.ProductID).show(500);
            return;
        }
        else{
            $('#myModal_Add_Booking_Calendar').modal('hide') ;

            var thongbao= "Xảy ra lỗi trong quá trình xử lý";
            $('#myModal_Error div.modal-body').html('');           
            $("#myModal_Error div.modal-body").append(thongbao);

            $('#myModal_Error').modal();                      // initialized with defaults
            $('#myModal_Error').modal({ keyboard: false });   // initialized with no keyboard
            $('#myModal_Error').modal('show');
            setTimeout(function(){
                $('#myModal_Error').modal('hide');
                var hienthi = $('#hienthi_xem').val();
                var value = $('#ngay_xem').val();
                Load_Calendar(hienthi,value);
            }, 5000);

        }


    }
}



function Modal_Delete_Booking_Calendar(args)
{     
    if(args.data.bookingpayment.PayMethod=="11")//booking ofline
    {
        console.log(args);
        var bookingID = args.data.bookingID;
        var ProductID = args.data.ProductID;

        $.ajax({
            type: "POST",
            url:"home_controller/Submit_Delete_Booking_Offline",
            dataType: "text",
            data: {
                bookingID: bookingID,
                ProductID: ProductID
            },
            cache: false,
            success: function (data) {
                 // if( data== "-1" || data==="-1" || data==-1 )
                // {
                //     alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
                // }
                // else
                // {
                    // alert('Thêm thành công');
                    // console.log(data);
                    // return;
                    Submit_Delete_Booking_Offline_Complete(data);
                // }
              //alert(data);
                
            }
        });
       
    }
    else{

        var thongbao= "Không thể xóa booking online";
        $('#myModal_Error div.modal-body').html('');           
        $("#myModal_Error div.modal-body").append(thongbao);

        $('#myModal_Error').modal();                      // initialized with defaults
        $('#myModal_Error').modal({ keyboard: false });   // initialized with no keyboard
        $('#myModal_Error').modal('show');
    }
}



function  Submit_Delete_Booking_Offline_Complete(data){
    // alert("OK");
    var sRes = JSON.parse(data);
    console.log(sRes);
    // if(sRes.result==true || sRes.result=="true"){
    //     $('#myModal_Add_Booking_Calendar').modal('hide') ;

    //     var thongbao= "Tạo booking offline thành công";
    //     $('#myModal_Error div.modal-body').html('');           
    //     $("#myModal_Error div.modal-body").append(thongbao);

    //     $('#myModal_Error').modal();                      // initialized with defaults
    //     $('#myModal_Error').modal({ keyboard: false });   // initialized with no keyboard
    //     $('#myModal_Error').modal('show');
    //     setTimeout(function(){
    //         $('#myModal_Error').modal('hide');
    //         var hienthi = $('#hienthi_xem').val();
    //         var value = $('#ngay_xem').val();
    //         Load_Calendar(hienthi,value);
    //     }, 5000);

    // }
    // else{
    //     if(sRes.action=="FromTime"){
    //         $("#thgian_"+sRes.fix.ProductID).show(500);
    //         return;
    //     }
    //     else{
    //         $('#myModal_Add_Booking_Calendar').modal('hide') ;

    //         var thongbao= "Xảy ra lỗi trong quá trình xử lý";
    //         $('#myModal_Error div.modal-body').html('');           
    //         $("#myModal_Error div.modal-body").append(thongbao);

    //         $('#myModal_Error').modal();                      // initialized with defaults
    //         $('#myModal_Error').modal({ keyboard: false });   // initialized with no keyboard
    //         $('#myModal_Error').modal('show');
    //         setTimeout(function(){
    //             $('#myModal_Error').modal('hide');
    //             var hienthi = $('#hienthi_xem').val();
    //             var value = $('#ngay_xem').val();
    //             Load_Calendar(hienthi,value);
    //         }, 5000);

    //     }


    // }
}