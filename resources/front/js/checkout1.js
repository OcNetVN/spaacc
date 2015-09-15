
$(document).ready(function() {
    $(".numberic").ForceNumericOnly();
    xoasessiongiamgia_diem();
});
function xoasessiongiamgia_diem()
{
    $.ajax({
            type:"POST",
            url:getUrspal() + "checkout1/xoasessiongiamgia_diem",
            dataType:"text",
            cache:false,
            success:function (data) {
            },
            error: function () { alert("Có lỗi xảy ra!"); }
        });
}
function applypointdiscount()
{
    var hidehavepoint=$("#hidehavepoint").html();
    if(hidehavepoint=="" || hidehavepoint==null)
        var havepoint=0;
    else
        var havepoint = parseFloat(hidehavepoint);
    var checkinputpoint = $("#inputpoint").val();
    var inputpoint = parseFloat(checkinputpoint);
    if(checkinputpoint!="")
    {
        if(havepoint<inputpoint)
        {
            //alert("sddf");
            $("#errpoint").html("Dữ liệu không đúng");
            $("#errpoint").show();
        }
        else
        {
            $.ajax({
                type:"POST",
                url:getUrspal() + "checkout1/getmaxpointdiscount",
                dataType:"text",
                cache:false,
                success:function (data) {
                    var res = JSON.parse(data);
                    var maxdiscountpoint=parseFloat(res.maxdiscountpoint);
                    var maxdiscountmoney=parseFloat(res.maxdiscountmoney);
                    if(inputpoint<=maxdiscountpoint)
                    {
                        applypointdiscount_step2(havepoint,inputpoint);
                    }
                    else
                    {
                        var point=ReplaceNumberWithCommas(maxdiscountpoint);
                        var money=ReplaceNumberWithCommas(maxdiscountmoney);
                        $("#errpoint").html("Chỉ cho phép thanh toán tối đa " + point + " điểm ~ " + money + " VNĐ");
                        $("#errpoint").show();
                    }
                },
                error: function () { alert("Có lỗi xảy ra!"); }
            });
        }
    }
    else
    {
        $("#errpoint").html("Không được rỗng");
        $("#errpoint").show();
    }
}

function ReplaceNumberWithCommas(yourNumber) {
    //Seperates the components of the number
    var n= yourNumber.toString().split(".");
    //Comma-fies the first part
    n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    //Combines the two sections
    return n.join(".");
}
function applypointdiscount_step2(havepoint,inputpoint)
{
    $.ajax({
        type:"POST",
        url:getUrspal() + "checkout1/applypointdiscount",
        dataType:"text",
        data: {
                havepoint: havepoint,
                inputpoint: inputpoint                                
                },
        cache:false,
        success:function (data) {
            applypointdiscount_Complete(data);
        },
        error: function () { alert("Có lỗi xảy ra!"); }
    });
}
function applypointdiscount_Complete(data)
{
    $("#divusepoint").hide();
    var sRes = JSON.parse(data);
    $("#divresultpoint").html(sRes.str);
    $("#divresultpoint").show();
}
function reloaddifpoint()
{
    $("#errpoint").hide();
    $("#diemconlai").html("");
    $("#diemdadung").html("");
    $("#divusepoint").show();
    $("#divresultpoint").hide();
}
//thanh toan bang outstanding
function applyoutstandingdiscount()
{
    var hidehaveoutstanding=$("#hidehaveoutstanding").html();
    if(hidehaveoutstanding=="" || hidehaveoutstanding==null)
        var haveoutstanding=0;
    else
        var haveoutstanding = parseFloat(hidehaveoutstanding);
    var checkinputoutstanding = $("#inputoutstanding").val();
    var inputoutstanding = parseFloat(parseFloat(checkinputoutstanding)*1000);
    if(checkinputoutstanding!="")
    {
        if(haveoutstanding<inputoutstanding)
        {
            //alert("sddf");
            $("#erroutstanding").html("Dữ liệu không đúng");
            $("#erroutstanding").show();
        }
        else
        {
            $.ajax({
                type:"POST",
                url:getUrspal() + "checkout1/applyoutstandingdiscount",
                dataType:"text",
                data: {
                        haveoutstanding: haveoutstanding,
                        inputoutstanding: inputoutstanding                                
                        },
                cache:false,
                success:function (data) {
                    applyoutstandingdiscount_Complete(data);
                },
                error: function () { alert("Có lỗi xảy ra!"); }
            });
        }
    }
    else
    {
        $("#erroutstanding").html("Không được rỗng");
        $("#erroutstanding").show();
    }
}
function applyoutstandingdiscount_Complete(data)
{
    $("#divuseoutstanding").hide();
    var sRes = JSON.parse(data);
    $("#divresultoutstanding").html(sRes.str);
    $("#divresultoutstanding").show();
}
function reloaddifoutstanding()
{
    $("#erroutstanding").hide();
    $("#outstandingconlai").html("");
    $("#outstandingdadung").html("");
    $("#divuseoutstanding").show();
    $("#divresultoutstanding").hide();
}
//end thanh toan bang outstanding
function changeQty_step1(proID,spaID,stt)
{
    //
    //trBookingTemp
    //lay tt cu
    var ttcu_str =$("#trBookingTemp" + proID + stt +" td:eq(5) span").text();
    ttcu_str= ReplaceAll(ttcu_str,",","");
    var ttcu = parseFloat(ttcu_str);
    //
    var qty_str= $("#trBookingTemp" +proID + stt +" td:eq(3) input").val();
        qty_str=ReplaceAll(qty_str,",","");
    var qty =1;
    if(qty_str==="" || qty_str == null)
        {qty = 1;
        $("#trBookingTemp" +proID + stt +" td:eq(3) input").val(1);
        }
    else
        {qty= parseFloat(qty_str);}
    
    var dg_str = $("#trBookingTemp" +proID + stt +" td:eq(4) span").text();
    dg_str=ReplaceAll(dg_str,",","");
    var dg = parseFloat(dg_str);
    var tt =qty*dg;
    
    var totcu_str =$("#totalmoney").text();
    var totspacu_str= $("#totalmoney_" +spaID).text();
    totcu_str=ReplaceAll(totcu_str,",","");
    totspacu_str=ReplaceAll(totspacu_str,",","");
    var totcu = parseFloat(totcu_str);
    var totspacu = parseFloat(totspacu_str);
    var total = totcu - ttcu +tt;
    var totalchung = totspacu - ttcu +tt;
    
    //gan lai 2 vi tri
    $("#trBookingTemp" +proID + stt +" td:eq(5) span").text(tt);
    $("#totalmoney").text(total);
    $("#totalPricecode").text(total);
    $("#totalmoney_" +spaID).text(totalchung);
    $("#totalmoney").number(true, 0);
    $("#totalPricecode").number(true, 0);
    $("#totalmoney_" +spaID).number(true, 0);
    $("#trBookingTemp" +proID + stt +" td:eq(5) span").number(true, 0);
    save_cart();
}

function ReplaceAll(Source, stringToFind, stringToReplace) {
    var temp = Source;
    var index = temp.indexOf(stringToFind);
    while (index != -1) {
        temp = temp.replace(stringToFind, stringToReplace);
        index = temp.indexOf(stringToFind);
    }
    return temp;
}

function deletesubcart(ProID,spaID,stt)
{
   /* var tongdong1 = $('table#tbl_resproduct tbody tr:last').index(); //khac tong dong phia duoi
    if(dong != tongdong1)
        $("#tbl_resproduct tbody tr:eq(" + dong + ")").remove();*/
     //lay tt cu
    var ttcu_str =$("#trBookingTemp" +ProID + stt +" td:eq(5) span").text();
    ttcu_str= ReplaceAll(ttcu_str,",","");
    var ttcu = parseFloat(ttcu_str);
    
    var totcu_str =$("#totalmoney").text();
    var totspacu_str =$("#totalmoney_" +spaID).text();
    totcu_str=ReplaceAll(totcu_str,",","");
    totspacu_str=ReplaceAll(totspacu_str,",","");
    var totcu = parseFloat(totcu_str);
    var totspacu = parseFloat(totspacu_str);
    
    var total = totcu - ttcu;  
    var totalspa = totspacu - ttcu;  
    $("#totalmoney").text(total);
    $("#totalPricecode").text(total);
    $("#totalmoney_" +spaID).text(totalspa);
    $("#totalmoney").number(true, 0);
    $("#totalPricecode").number(true, 0);
    $("#totalmoney_" +spaID).number(true, 0);
    
    $("#trBookingTemp" + ProID + stt).remove();
    
    var tongdong = $('table#tbl_resproduct_' +spaID +' tbody tr:last').index() + 1;
    if(tongdong > 2)
    {
        for(var i=1; i <tongdong-1; i++)
        {
            $("#tbl_resproduct_"+spaID +" tbody tr:eq(" + i + ") td:eq(0)").html(i);
        }
    }
    else
    {
        $('#div_' +spaID).remove();
        var totalspa=$("#totalspa").text();
        totalspa = parseInt(totalspa);
        totalspa=totalspa-1;
        $("#totalspa").html(totalspa);
        
        if(totalspa==0 || totalspa=='0')
        {
            $("#divcontent").hide();
            $("#divcontentnull").show();
            $("#btncontinue").hide();
            $("#btnReload").show();
        }
    }
    save_cart();
}

jQuery.fn.ForceNumericOnly =
function () {
    return this.each(function () {
        $(this).keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
                key == 8 ||
                key == 9 ||
                key == 46 ||
                key == 110 ||
                key == 190 ||
                (key >= 35 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        });
    });
};


// goto step2
function gotostep2()
{
    //alert("dfsd");return;
    $.ajax({
    type:"POST",
    url:getUrspal() + "checkout1/checkissetsession",
    dataType:"text",
    cache:false,
    success:function (data) {
        if(data == 1 || data == "1")
            gotostep2_step2();
        else
        {
            var spanUIDLogBanner    =   $("#spanUIDLogBanner").html();
            if(spanUIDLogBanner == "")
            {
                 $('#btnchualogin').trigger('click');
            }
        }
    },
    error: function () { alert("Có lỗi xảy ra!"); }
    });
}
function gotostep2_step2()
{
    var disccode = $('input:radio[name=disccode]:checked').val();
    if(disccode==3 || disccode=="3") //book bang diem
    {
        var Percentage = "";
        var DiscountAmt= "";
        var DiscountCode= "SCORE";
        var textrequestmember="";
        var generatedID="";
        var DiscountType="";
        var htmldiemdadung=$("#diemdadung").html();
        if(htmldiemdadung!="" && htmldiemdadung!=null && htmldiemdadung!=0 && htmldiemdadung!="0")
        {
            $.ajax({
            type:"POST",
            url:getUrspal() + "checkout1/getmoneymemberbypoint",
            dataType:"text",
            cache:false,
            success:function (data) {
                var sRes = JSON.parse(data);
                var pointbymoney= parseFloat(sRes.ScoreRate);
                //alert(pointbymoney);
                DiscountType="Point";
                var diemdadung=parseFloat($("#diemdadung").html());
                var tiengiam=diemdadung*pointbymoney; //1 diem = ? vnd
                var DiscountAmt = parseFloat(tiengiam);
            },
            error: function () { alert("Có lỗi xảy ra!"); }
            });
            
        }
        else
            var DiscountAmt = 0;
        
            $.ajax({
            type:"POST",
            url:getUrspal() + "checkout2/savediscount",
            dataType:"text",
            cache:false,
            data: {
                    DiscountType: DiscountType,
                    Percentage: Percentage,
                    DiscountAmt: DiscountAmt,
                    DiscountCode: DiscountCode,
                    textrequestmember: textrequestmember,
                    generatedID: generatedID                                
                    },
            success:function (data) {
                gotostep2_step3();
            },
            error: function () { alert("Có lỗi xảy ra!"); }
        });
    }
    else
    {
        if(disccode==5 || disccode=="5") //book bang outstanding
        {
            var Percentage = "";
            var DiscountAmt= "";
            var DiscountCode= "OUTSTANDING";
            var textrequestmember="";
            var generatedID="";
            var DiscountType="";
            var htmloutstandingdadung=$("#outstandingdadung").html();
            if(htmloutstandingdadung!="" && htmloutstandingdadung!=null && htmloutstandingdadung!=0 && htmloutstandingdadung!="0")
            {
                DiscountType="Outstanding";
                var outstandingdadung=parseFloat($("#outstandingdadung").html());
                var tiengiam=outstandingdadung;
                var DiscountAmt = parseFloat(tiengiam);
            }
            else
                var DiscountAmt = 0;
            
                $.ajax({
                type:"POST",
                url:getUrspal() + "checkout2/savediscount",
                dataType:"text",
                cache:false,
                data: {
                        DiscountType: DiscountType,
                        Percentage: Percentage,
                        DiscountAmt: DiscountAmt,
                        DiscountCode: DiscountCode,
                        textrequestmember: textrequestmember,
                        generatedID: generatedID                                
                        },
                success:function (data) {
                    gotostep2_step3();
                },
                error: function () { alert("Có lỗi xảy ra!"); }
            });
        }
        else
        {
            gotostep2_step2();
        }
    }
}
function gotostep2_step2()
{
    $("#scoreuser").hide();
    var DiscountType = $("#spanDiscountType").html();
    var DiscountCode = $("#spanDiscountCode").html();
    var textrequestmember = $("#textrequestmember").val();  
    var generatedID = $("#spangeneratedID").html();    
    //alert(generatedID);        
    var Percentage = "";
    var DiscountAmt= "";
    if(DiscountType=="Member")
    {
        Percentage = $("#spanPercentage").html();
    }
    else
    {
        if(DiscountType=="Voucher")
            DiscountAmt = $("#spanDiscountAmt").html();
    }
    //alert(DiscountAmt);    
    $.ajax({
        type:"POST",
        url:getUrspal() + "checkout2/savediscount",
        dataType:"text",
        cache:false,
        data: {
                DiscountType: DiscountType,
                Percentage: Percentage,
                DiscountAmt: DiscountAmt,
                DiscountCode: DiscountCode,
                textrequestmember: textrequestmember,
                generatedID: generatedID                                
                },
        success:function (data) {
            gotostep2_step3();
        },
        error: function () { alert("Có lỗi xảy ra!"); }
    });
}
function gotostep2_step3()
{
    //var totalspa=$("#totalspa").text();
    var totalspa=$("#totalspasession").text();
    var totalspaInt = parseInt(totalspa);
    var list = [];
    for(var j=0; j<totalspaInt; j++)
    {
        var listpro = [];
        var spa = {};
        spa.spaid = $("#divcontent div.DivSpa:eq(" + j + ") div:eq(0)").html();
        
        var tongdong = parseInt($('table#tbl_resproduct_' + spa.spaid + ' tbody tr:last').index() + 1);
        if(tongdong > 2)
        {
            for(var i=1; i <tongdong-1; i++)
            {
                var id=i-1;
                var pro = {};
                pro.ProductID = $("#tbl_resproduct_" + spa.spaid + " tbody tr:eq(" + i + ") td:eq(7)").html();
                pro.Qty = $("#tbl_resproduct_" + spa.spaid + " tbody tr:eq(" + i + ") td:eq(3) input").val();
                var proprice = $("#tbl_resproduct_" + spa.spaid + " tbody tr:eq(" + i + ") td:eq(4) span").text();
                proprice=ReplaceAll(proprice,",","");
                pro.Price = parseFloat(proprice);
                pro.FromTime = $("#tbl_resproduct_" + spa.spaid + " tbody tr:eq(" + i + ") td:eq(2) span:eq(0)").text();
                pro.ToTime = $("#tbl_resproduct_" + spa.spaid + " tbody tr:eq(" + i + ") td:eq(2) span:eq(1)").text();
                listpro[id] = pro;
            }
        }
        spa.listpro=listpro;
        list[j] = spa;
    }
    $.ajax({
        url: getUrspal() +"checkout1/gotostep2",
        type: "POST",
        data: {listspa: JSON.stringify(list)  },
        dataType: "json",
        success: function (data) {
            gotostep2_Complete(data); 
        },
        error: function () { alert("Có lỗi xảy ra!!"); }
    });
}
function gotostep2_Complete(data) {
    
      parent.location='checkout2';
}
//nghia viet them 06/02/2015
function save_cart()
{
    $("body").addClass("loading");
    
    $("#divusecode").hide();
    $("#divusepoint").hide();
    $("#divuseoutstanding").hide();
    $("#divresultpoint").hide();
    $('input[name=disccode][value=4]').prop('checked', 'checked');
    xoasessiongiamgia_diem();
    //var totalspa=$("#totalspa").text();
    var totalspa=$("#totalspasession").text();
    var totalspaInt = parseInt(totalspa);
    var list = [];
    for(var j=0; j<totalspaInt; j++)
    {
        var listpro = [];
        var spa = {};
        spa.spaid = $("#divcontent div.DivSpa:eq(" + j + ") div:eq(0)").html();
        
        var tongdong = parseInt($('table#tbl_resproduct_' + spa.spaid + ' tbody tr:last').index() + 1);
        if(tongdong > 2)
        {
            for(var i=1; i <tongdong-1; i++)
            {
                var id=i-1;
                var pro = {};
                pro.ProductID = $("#tbl_resproduct_" + spa.spaid + " tbody tr:eq(" + i + ") td:eq(7)").html();
                pro.Qty = $("#tbl_resproduct_" + spa.spaid + " tbody tr:eq(" + i + ") td:eq(3) input").val();
                var proprice = $("#tbl_resproduct_" + spa.spaid + " tbody tr:eq(" + i + ") td:eq(4) span").text();
                proprice=ReplaceAll(proprice,",","");
                pro.Price = parseFloat(proprice);
                pro.FromTime = $("#tbl_resproduct_" + spa.spaid + " tbody tr:eq(" + i + ") td:eq(2) span:eq(0)").text();
                pro.ToTime = $("#tbl_resproduct_" + spa.spaid + " tbody tr:eq(" + i + ") td:eq(2) span:eq(1)").text();
                listpro[id] = pro;
            }
        }
        spa.listpro=listpro;
        list[j] = spa;
    }
    $.ajax({
        url: getUrspal() +"checkout1/gotostep2",
        type: "POST",
        data: {listspa: JSON.stringify(list)  },
        dataType: "json",
        success: function (data) {
            $("body").removeClass("loading"); 
        },
        error: function () { alert("Có lỗi xảy ra!!");$("body").removeClass("loading"); }
    });
}
//end nghia viet them 06/02/2015