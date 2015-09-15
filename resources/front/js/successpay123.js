$(document).ready(function() {
    getvalue123pay();    
});

function getvalue123pay()
{
    Bat_Loading();
    var stt = GetQueryStringParams("status");
    if(stt==1 || stt =="1")
    {
        $.ajax({
            type:"POST",
            url: getUrspal() + "successpay123/getvalue123pay",
            dataType:"text",
            cache:false,
            success:function (data) {
                getvalue123pay_Complete(data);
            },
            error: function () { alert("Có lỗi xảy ra!"); }
        });
    }
    else
    {
        parent.location='cancelpay123';
    }
}

function getvalue123pay_Complete(data)
{
    var sRes = JSON.parse(data);
    //alert(JSON.stringify(sRes));
    var mTransactionID = sRes.mTransactionID;
    var merchantCode = sRes.merchantCode;
    var clientip = sRes.clientip;
    var passcode = sRes.passcode;
    $.ajax({
        type:"POST",
        url:getUrspal() + "successpay123/post123pay",
        dataType:"text",
        data: {
            dmTransactionID: mTransactionID,
            dmerchantCode: merchantCode,
            dclientip: clientip,
            dpasscode: passcode},
        cache:false,
        success:function (data) {
            loadlocationchild_Complete(data);
            
        },
        error: function () { alert("Có lỗi xảy ra!"); }
    });
}
function loadlocationchild_Complete(data)
{
    var sRes = JSON.parse(data);
    //alert(JSON.stringify(sRes));
    if(sRes.tbao=="ok")
    {
        gotostep3();
    }
    else
    {
        parent.location='checkout2';
    } 
}

function gotostep3()
{
    
    //var Payment_method = $("#Payment_method").val();
    var Payment_method = "01";
    //alert(Payment_method);
        $.ajax({
            type:"POST",
            url: getUrspal() + "checkout2/gotostep3",
            dataType:"text",
            data: {
                dPayment_method: Payment_method},
            cache:false,
            success:function (data) {
                gotostep3_Complete(data);
            },
            error: function () { alert("Có lỗi xảy ra!"); Tat_Loading();}
        });
}
function gotostep3_Complete(data) {
    var sRes = JSON.parse(data);
    //alert('sfsdfd');
    var arr_bookingid = sRes.arr_bookingid;
    $("#content_page1").hide();
    $("#content_page2").html(sRes.str_showtep3);
    $("#content_page2").show();
    //alert('sfsdfd');
    if(sRes.tb123pay==1 || sRes.tb123pay=="1") //1:vua moi dc cap nhat+gui mail; 0:da cap nhat tu truoc+KO gui mail;2:rollback du lieu
    {
        $.ajax({
            type:"POST",
            url: getUrspal() +"checkout2/sendmail",
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
    else
    {
        Tat_Loading();
    }
    
}

function GetQueryStringParams( sParam ){
   var sPageURL = window.location.search.substring(1);
   var sURLVariables = sPageURL.split('&');
   var res = "";
   for (var i = 0; i < sURLVariables.length; i++)
   {
      var sParameterName = sURLVariables[i].split('=');
      if (sParameterName[0] == sParam)
      {
           res = sParameterName[1];
           break;
      }
   }
   return res;
}
function Bat_Loading()
{
    $(".loader").fadeIn(0);
}

function Tat_Loading()
{
    $(".loader").fadeOut("slow");    
}