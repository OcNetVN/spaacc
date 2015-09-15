
function checkpointgotostep3()
{
    $.ajax({
        type:"POST",
        url:"/nhaplieuspa/checkout2/usesessioncheck2",
        dataType:"text",
        cache:false,
        success:function (data) {
            checkpointgotostep3_step2(data);
        },
        error: function () { alert("Có lỗi xảy ra!"); }
    });
}
function checkpointgotostep3_step2()
{
    Bat_Loading();
    var Payment_method="04";
    $.ajax({
        type:"POST",
        url:"/nhaplieuspa/checkout2/gotostep3",
        dataType:"text",
        data: {
            dPayment_method: Payment_method
            },
        cache:false,
        success:function (data) {
            checkpointgotostep3_Complete(data);
        },
        error: function () { alert("Có lỗi xảy ra!"); Tat_Loading();}
    });
}
function checkpointgotostep3_Complete(data) {
    var sRes = JSON.parse(data);
    //alert('sfsdfd');
    var arr_bookingid = sRes.arr_bookingid;
    $("#loadcontent1").hide();
    $("#loadcontent2").html(sRes.str_showtep3);
    $("#loadcontent2").show();
    //alert('sfsdfd');
    $.ajax({
        type:"POST",
        url:"/nhaplieuspa/checkout2/sendmail",
        dataType:"text",
        data: {
            dstr_bookingid: arr_bookingid},
        cache:false,
        success:function (data) {
            $('#spanCardTotalList').html('0');
            //alert("sdf");
            $("#loadtb").html("Đã hoàn tất, vui lòng vào mail để kiểm tra. Hãy kiểm tra trong mục Hộp thư đến hoặc trong mục Spam.");
            $("#loadtb").show(); 
            Tat_Loading();
        },
        error: function () { alert("Có lỗi xảy ra!"); Tat_Loading();}
    });
}
function Bat_Loading()
{
    $(".loader").fadeIn(0);
}

function Tat_Loading()
{
    $(".loader").fadeOut("slow");    
}