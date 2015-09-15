$(document).ready(function() {
        $("#timcardno").ForceNumericOnly();
        $("#timngaybd").notpress();
        $("#timngayhethan").notpress();
        $("#timgiatienthe").ForceNumericOnly();
        $("#themgiatienthe").ForceNumericOnly();
        $("#suagiatienthe").ForceNumericOnly();
        $("#minprice").ForceNumericOnly();
        $("#suaminprice").ForceNumericOnly();
        $("#totalvoucher").ForceNumericOnly();
        
        $("#suangayhethan").notpress();
        $("#themngaybd").notpress();
        $("#suangaybd").notpress();
        $("#themngayhethan").notpress();
        
        $("#phuongthucthem").click(function () {
           $("#divtab2").show(300);
           $("#divtab1").hide(300);
            $("#divtab3").hide(300);
            $("#divtab4").hide(300);
           $("#tbsuccess").hide();
           $("#tberr").hide(); 
           layloaithethem();
           $("#trchonsp").hide();
           $("#trchonspa").hide();
           $("#themtbsuccess").hide();
           $("#themtberr").hide();
        });
        $("#themapdung").change(function () {
            var themapdung = $("#themapdung").val();
            if(themapdung==0 || themapdung=="0")
            {
                $("#trchonsp").hide();
                $("#trchonspa").show();
                $("#trbtn").hide();
            }
            else
            {
                $("#trchonsp").hide();
                $("#trchonspa").hide();
                $("#trbtn").show();
            }
        });
        $("#suaapdung").change(function () {
            var suaapdung = $("#suaapdung").val();
            if(suaapdung==0 || suaapdung=="0")
            {
                $("#trchonspasua").show();
                //$("#trchonspsua").show();
                $("#trbtnsua").hide();
            }
            else
            {
                $("#trchonspasua").hide();
                $("#trchonspsua").hide();
                $("#trbtnsua").show();
            }
        });
        $("#phuongthucdanhsach").click(function () {
           $("#divtab1").show(300);
           $("#divtab2").hide(300);
           $("#divtab3").hide(300);
           $("#divtab4").hide(300);
           searchvoucher(1);
        });
        $("#phuongthuctim").click(function () {
           $("#divtab4").show(300);
           $("#divtab2").hide(300);
           $("#divtab3").hide(300);
           $("#divtab1").hide(300);
           layloaithe();
        });
        $("#cboPageNoPRO").change(function () {
            var trang = $("#cboPageNoPRO").val();
            searchvoucher(trang);
        });
        $("#timcboPageNoPRO").change(function () {
            var trang = $("#timcboPageNoPRO").val();
            searchvoucher(trang);
        });
        $("#cbchontatca").click( function(){
           if($(this).is(':checked') )
           {
                //alert("checked");
                $("#btnselectprothem").hide();
                $("#spanProList").html("");
                $("#spanProList").hide();
                $("#divChonPro").html("");
                $("#trbtn").show();
           } 
           else
           {
                $("#btnselectprothem").show();
                $("#trbtn").hide();
           }
        });
        $("#cbchontatcasua").click( function(){
           if($(this).is(':checked') )
           {
                //alert("checked");
                $("#btnselectprosua").hide();
                $("#spanProListsua").html("");
                $("#spanProListsua").hide();
                $("#divChonProsua").html("");
                $("#trbtnsua").show();
           } 
           else
           {
                $("#btnselectprosua").show();
                $("#trbtnsua").hide();
           }
        });
});
function validateEmail(email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if( !emailReg.test( email ) ) {
    return false;
  } else {
    return true;
  }
}
jQuery.fn.notpress =
function () {
    return this.each(function () {
        $(this).keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            //delete, backspace
            return (
                key == 8 ||
                key == 46);
        });
    });
};
jQuery.fn.notspace =
function () {
    return this.each(function () {
        $(this).keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
            key != 32);
        });
    });
};

function layloaithethem()
{
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/voucher/layloaithethem",
        dataType:"text",
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                layloaithethem_Complete(data);
            }
        }
    });
}
function layloaithethem_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes!="" && sRes!=null)
    {
        $("#themloaithe").html(sRes);
    }
}
function layloaithe()
{
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/voucher/layloaithe",
        dataType:"text",
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                layloaithe_Complete(data);
            }
        }
    });
}
function layloaithe_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes!="" && sRes!=null)
    {
        $("#timloaithe").html(sRes);
    }
}
//
function Selectpro() {
    $("#divSearchPro").dialog({
        height: 700,
        width: 900,
        modal: true
    });
}
function SearchPro(page) {
    var ProName = $("#txtProName").val();
    var spanSpaChonTab2=$("#spanSpaChonTab2").html();
    //alert(spanSpaChonTab2);
    $.ajax({
        url: getUrspal() + "admin/voucher/searchpro",
        type: "POST",
        data:{ProName:ProName,spanSpaChonTab2: spanSpaChonTab2, Page:page},
        cache:false,
        dataType: "text",
        //contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                    SearchPro_Complete(data);
                },
        error: function () {
        }
    });

}
function SearchProCBB() {
    var page = $("#cboPageNoPro").val();
    var ProName = $("#txtProName").val();
    var spanSpaChonTab2=$("#spanSpaChonTab2").html();
    $.ajax({
        url: getUrspal() + "admin/voucher/searchpro",
        type: "POST",
        data:{ProName:ProName, spanSpaChonTab2: spanSpaChonTab2, Page:page},
        cache:false,
        dataType: "text",
        //contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                    SearchPro_Complete(data);
                },
        error: function () {
        }
    });

}
function SearchPro_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
        $("#panelDataPro tbody tr").remove();
        $("#ListFoundPro").tmpl(sRes.lst).appendTo("#panelDataPro tbody");
        $("#panelDataPro").css("display","");

        //phân trang
        $("#DivPhanTrangPro").show(500);
        var totalPage = parseInt(sRes.TotalPage);
        var Curpage = parseInt(sRes.CurPage);
        TrangHienTai = Curpage;
        TongTrang = totalPage;
        $("#cboPageNoPro option").remove();
        for (var i = 1; i <= totalPage; i++) {
            var sStr = "";
            if (i == TrangHienTai) {
                sStr = "<option value=\"" + i + "\" selected=\"selected\">" + i + "</option>";
            }
            else {
                sStr = "<option value=\"" + i + "\" >" + i + "</option>";
            }
            $("#cboPageNoPro").append(sStr);
        }
    }
}
function SelectFinish() {
    var rowCount = $('table#panelDataPro tbody tr:last').index() + 1;
    for (var i = 0; i < rowCount; i++) {
        if ($("table#panelDataPro tbody tr:eq(" + i.toString() + ") input[type='checkbox']:eq(0)").is(":checked")) {
            var id = $("table#panelDataPro tbody tr:eq(" + i.toString() + ") td:eq(1)").html();
            var HoTen = $("table#panelDataPro tbody tr:eq(" + i.toString() + ") td:eq(2) span:eq(0)").html();
            var str = "<div id=\"Pro" + id + "\" class=\"doituongDIV\">";
            str = str + "<span>" + id + " - " + HoTen + "</span>";
            str = str + "<a href=\"javascript:void(0);\" onclick=\"XoaPro('Pro" + id + "');\"><img src=\"resources/images/icons/cross_grey_small.png\" height=\"10\" /></a></div>";
            if ($("#Pro" + id + " span").text().length > 0) {

            }
            else {
                $("#divChonPro").append(str);
                $("#spanProList").append(id + ";");
            }
        }
    }
    var spanProList=$("#spanProList").html();
    if(spanProList!="" && spanProList!=null)
        $("#trbtn").show();
    else
        $("#trbtn").hide();
    $("#divSearchPro").dialog("close");
}
function XoaPro(id) {
    $("#" + id).remove();
    var id1 = id.replace("Pro", "");
    var str = $("#spanProList").text();
    var str1 = str.replace(id1 + ";", "");
    $("#spanProList").text(str1);
    var spanProList=$("#spanProList").html();
    if(spanProList!="" && spanProList!=null)
        $("#trbtn").show();
    else
        $("#trbtn").hide();
}
function XoaProsua(id) {
    $("#" + id).remove();
    var id1 = id.replace("Prosua", "");
    var str = $("#spanProListsua").text();
    var str1 = str.replace(id1 + ";", "");
    $("#spanProListsua").text(str1);
    var spanProListsua=$("#spanProListsua").html();
    if(spanProListsua!="" && spanProListsua!=null)
        $("#trbtnsua").show();
    else
        $("#trbtnsua").hide();
}
function Selectprosua() {
    $("#divSearchProsua").dialog({
        height: 700,
        width: 900,
        modal: true
    });
}
function SearchProsua(page) {
    var ProNamesua = $("#txtProNamesua").val();
    var spanSpaChonTab2=$("#spanSpaChonsua").html();
    $.ajax({
        url: getUrspal() + "admin/voucher/searchpro",
        type: "POST",
        data:{ProName:ProNamesua, spanSpaChonTab2: spanSpaChonTab2, Page:page},
        cache:false,
        dataType: "text",
        //contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                    SearchProsua_Complete(data);
                },
        error: function () {
        }
    });

}
function SearchProCBBsua() {
    var page = $("#cboPageNoProsua").val();
    var ProNamesua = $("#txtProNamesua").val();
    var spanSpaChonTab2=$("#spanSpaChonsua").html();
    $.ajax({
        url: getUrspal() + "admin/voucher/searchpro",
        type: "POST",
        data:{ProName:ProNamesua, spanSpaChonTab2: spanSpaChonTab2, Page:page},
        cache:false,
        dataType: "text",
        //contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                    SearchProsua_Complete(data);
                },
        error: function () {
        }
    });

}
function SearchProsua_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
        $("#panelDataProsua tbody tr").remove();
        $("#ListFoundProsua").tmpl(sRes.lst).appendTo("#panelDataProsua tbody");
        $("#panelDataProsua").css("display","");

        //phân trang
        $("#DivPhanTrangProsua").show(500);
        var totalPage = parseInt(sRes.TotalPage);
        var Curpage = parseInt(sRes.CurPage);
        TrangHienTai = Curpage;
        TongTrang = totalPage;
        $("#cboPageNoProsua option").remove();
        for (var i = 1; i <= totalPage; i++) {
            var sStr = "";
            if (i == TrangHienTai) {
                sStr = "<option value=\"" + i + "\" selected=\"selected\">" + i + "</option>";
            }
            else {
                sStr = "<option value=\"" + i + "\" >" + i + "</option>";
            }
            $("#cboPageNoProsua").append(sStr);
        }
    }
}
function SelectFinishsua() {
    var rowCount = $('table#panelDataProsua tbody tr:last').index() + 1;
    for (var i = 0; i < rowCount; i++) {
        if ($("table#panelDataProsua tbody tr:eq(" + i.toString() + ") input[type='checkbox']:eq(0)").is(":checked")) {
            var id = $("table#panelDataProsua tbody tr:eq(" + i.toString() + ") td:eq(1)").html();
            var HoTen = $("table#panelDataProsua tbody tr:eq(" + i.toString() + ") td:eq(2) span:eq(0)").html();
            var str = "<div id=\"Prosua" + id + "\" class=\"doituongDIV\">";
            str = str + "<span>" + id + " - " + HoTen + "</span>";
            str = str + "<a href=\"javascript:void(0);\" onclick=\"XoaProsua('Prosua" + id + "');\"><img src=\"resources/images/icons/cross_grey_small.png\" height=\"10\" /></a></div>";
            if ($("#Prosua" + id + " span").text().length > 0) {

            }
            else {
                $("#divChonProsua").append(str);
                $("#spanProListsua").append(id + ";");
            }
        }
    }
    var spanProListsua=$("#spanProListsua").html();
    if(spanProListsua!="" && spanProListsua!=null)
        $("#trbtnsua").show();
    else
        $("#trbtnsua").hide();
    $("#divSearchProsua").dialog("close");
}
//
function clickbtnsearch()
{
    var timcardno=$("#timcardno").val();
    var timloaithe=$("#timloaithe").val();
    //alert(timloaithe);
    var timngaybd=$("#timngaybd").val();
    var timngayhethan=$("#timngayhethan").val();
    var timgiatienthe=$("#timgiatienthe").val();
    var timuerid=$("#timuerid").val();
    var timtrangthai=$("#timtrangthai").val();
    var timapdung=$("#timapdung").val();
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/voucher/clickbtnsearch",
        dataType:"text",
        data: {
            timcardno:timcardno,
            timloaithe: timloaithe,
            timngaybd: timngaybd,
            timngayhethan: timngayhethan,
            timgiatienthe: timgiatienthe,
            timuerid: timuerid,
            timtrangthai: timtrangthai,
            timapdung: timapdung
            },
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                clickbtnsearch_Complete(data);
            }
        }
    });
}
function clickbtnsearch_Complete(data)
{
    var sRes = JSON.parse(data);
    if (sRes != null) {
        if(sRes.TotalRecord !=0)
        {
            $("#timkhongtimthay").hide(200);
             $("#timcboPageNoPRO").show(300);
            $("#timpanelDataPRO tbody tr").remove();
            $("#timpanelDataPRO tbody").html(sRes.str);
            $("#timpanelDataPRO").show(500);
                   
            //phÃ¢n trang
            var totalPage = parseInt(sRes.TotalPage);
            var Curpage = parseInt(sRes.CurPage);
            $("#timdivTBKQTim div").text("Tìm được " + sRes.TotalRecord + " mẫu tin!!!");
            $("#timdivTBKQTim").show(500);
            TrangHienTai = Curpage;
            TongTrang = totalPage;
            $("#timcboPageNoPRO option").remove();
            for (var i = 1; i <= totalPage; i++) {
                var sStr = "";
                if (i == TrangHienTai) {
                    sStr = "<option value=\"" + i + "\" selected=\"selected\">" + i + "</option>";
                }
                else {
                    sStr = "<option value=\"" + i + "\" >" + i + "</option>";
                }
                $("#timcboPageNoPRO").append(sStr);
            }
        }
        else
        {
            $("#timkhongtimthay").show(500);
            $("#timpanelDataPRO").hide(200);
            $("#timcboPageNoPRO").hide(200);
            $("#timdivTBKQTim").hide(200);
        }
    }
}
function clickbtnthem()
{
    $("#themcardno").val("");  
    $("#themmaphatsinh").val("");
    $("#tberrthemngaybd").hide();
    $("#tberrthemngayhethan").hide();
    $("#tberrthemuserid").hide();
    $("#tberrtotalvoucher").hide();
    $("#tberrminprice").hide();
    $("#tberrthemgiatienthe").hide();
    
    var themloaithe=$("#themloaithe").val();
    //alert(themloaithe);
    var themngaybd=$("#themngaybd").val();
    var themngayhethan=$("#themngayhethan").val();
    var themgiatienthe=$("#themgiatienthe").val();
    var themuerid=$("#themuerid").val();
    var themtrangthai=$("#themtrangthai").val();
    var themapdung=$("#themapdung").val();
    var minprice=$("#minprice").val();
    var totalvoucher=$("#totalvoucher").val();
    if(themngayhethan=="" || themngayhethan==null)
    {
        $("#tberrthemngayhethan").html("Không dược rỗng");
        $("#tberrthemngayhethan").show();
    }
    else
    {
        if(themngaybd=="" || themngaybd==null)
        {
            $("#tberrthemngaybd").html("Không dược rỗng");
            $("#tberrthemngaybd").show();
        }
        else
        {
            if(themgiatienthe=="" || themgiatienthe==null)
            {
                $("#tberrthemgiatienthe").html("Không dược rỗng");
                $("#tberrthemgiatienthe").show();
            }
            else
            {
                if(themuerid=="" || themuerid==null)
                {
                    $("#tberrthemuserid").html("Không dược rỗng");
                    $("#tberrthemuserid").show();
                }
                else
                {
                    if(minprice=="" || minprice==null)
                    {
                        $("#tberrminprice").html("Không dược rỗng");
                        $("#tberrminprice").show();
                    }
                    else
                    {
                        if(totalvoucher=="" || totalvoucher==null)
                        {
                            $("#tberrtotalvoucher").html("Không dược rỗng");
                            $("#tberrtotalvoucher").show();
                        }
                        else
                        {
                            var tongvoucher = parseFloat(totalvoucher);
                            if(tongvoucher<1)
                            {
                                $("#tberrtotalvoucher").html("Phải là số nguyên lớn hơn 0");
                                $("#tberrtotalvoucher").show();
                            }
                            else
                            {
                                if(themapdung==1 || themapdung=="1") //tat ca
                                {
                                    $.ajax({
                                        type:"POST",
                                        url:getUrspal() + "admin/voucher/clickbtnthem",
                                        dataType:"text",
                                        data: {
                                            themloaithe: themloaithe,
                                            themngaybd: themngaybd,
                                            themngayhethan: themngayhethan,
                                            themgiatienthe: themgiatienthe,
                                            themuerid: themuerid,
                                            themtrangthai: themtrangthai,
                                            themapdung: themapdung,
                                            minprice: minprice,
                                            totalvoucher: tongvoucher
                                            },
                                        cache:false,
                                        success:function (data) {
                                            if( data== "-1" || data==="-1" || data==-1 )
                                            {
                                                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
                                            }
                                            else
                                            {
                                                clickbtnthem_Complete(data);
                                            }
                                        }
                                    });
                                }
                                else // 1 so san pham
                                {
                                    var spanProList = $("#spanProList").html();
                                    var spanSpaChonTab2 = $("#spanSpaChonTab2").html();
                                       if($("#cbchontatca").is(':checked') )
                                            var tatcaspspa=1; //tat ca sp cua spa da chon
                                       else
                                           var tatcaspspa=0; //1 so sp cu the cua spa do thoi
                                    //alert(spanProList);
                                    $.ajax({
                                        type:"POST",
                                        url:getUrspal() + "admin/voucher/clickbtnthem",
                                        dataType:"text",
                                        data: {
                                            themloaithe: themloaithe,
                                            themngaybd: themngaybd,
                                            themngayhethan: themngayhethan,
                                            themgiatienthe: themgiatienthe,
                                            themuerid: themuerid,
                                            themtrangthai: themtrangthai,
                                            themapdung: themapdung,
                                            spanProList: spanProList,
                                            tatcaspspa: tatcaspspa,
                                            spanSpaChonTab2: spanSpaChonTab2,
                                            minprice: minprice,
                                            totalvoucher: totalvoucher
                                            },
                                        cache:false,
                                        success:function (data) {
                                            if( data== "-1" || data==="-1" || data==-1 )
                                            {
                                                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
                                            }
                                            else
                                            {
                                                clickbtnthem_Complete(data);
                                            }
                                        }
                                    });
                                }
                            }
                        }
                    }
                                
                }
            }
        }
    }
}
function clickbtnthem_Complete(data)
{
    $("#themtbsuccess").hide();
    $("#themtberr").hide();
    var sRes = JSON.parse(data);
    if(sRes.sd==1 || sRes.sd=="1")
    {
        $("#themtbsuccess").html(sRes.tb);
        $("#themtbsuccess").show(); 
        //$("#themcardno").val(sRes.cardno);  
        //$("#themmaphatsinh").val(sRes.generatedID);  
    }
    else
    {
        $("#themtberr").html(sRes.tb);
        $("#themtberr").show(); 
    }
}
//nhan nut danh sach
function searchvoucher(page) {    
    curPage = page;    
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/voucher/searchvoucher",
        dataType:"text",
        data: {
            Page:page},
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                searchvoucher_Complete(data);
            }
          //alert(data);
        }
    });
}

function searchvoucher_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
        if(sRes.TotalRecord !=0)
        {
            $("#khongtimthay").hide(200);
             $("#cboPageNoPRO").show(300);
            $("#timpanelDataPRO tbody tr").remove();
            $("#timpanelDataPRO tbody").html(sRes.str);
            $("#timpanelDataPRO").show(500);
                   
            //phÃ¢n trang
            var totalPage = parseInt(sRes.TotalPage);
            var Curpage = parseInt(sRes.CurPage);
            $("#divTBKQTim div").text("Tìm được " + sRes.TotalRecord + " mẫu tin!!!");
            $("#divTBKQTim").show(500);
            TrangHienTai = Curpage;
            TongTrang = totalPage;
            $("#cboPageNoPRO option").remove();
            for (var i = 1; i <= totalPage; i++) {
                var sStr = "";
                if (i == TrangHienTai) {
                    sStr = "<option value=\"" + i + "\" selected=\"selected\">" + i + "</option>";
                }
                else {
                    sStr = "<option value=\"" + i + "\" >" + i + "</option>";
                }
                $("#cboPageNoPRO").append(sStr);
            }
        }
        else
        {
            $("#khongtimthay").show(500);
            $("#panelDataPRO").hide(200);
            $("#cboPageNoPRO").hide(200);
            $("#divTBKQTim").hide(200);
        }
    }
}
function sua(id)
{
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/voucher/sua",
        dataType:"text",
        data: {
            id:id},
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                sua_Complete(data);
            }
          //alert(data);
        }
    });
}
function sua_Complete(data)
{
    $("#divtab2").hide(300);
   $("#divtab1").hide(300);
    $("#divtab3").show(300);
    $("#divtab4").hide(300);
    var sRes = JSON.parse(data);
    if (sRes != null) {
        $("#suacardno").val(sRes.card.VoucherID);
        $("#suamaphatsinh").val(sRes.card.GeneratedID);
        var ValidForm = sRes.card.ValidForm;
        var datebd = ValidForm.split(' ')[0];
        var datebdsx=datebd.split('-')[1] + "/" + datebd.split('-')[2] + "/" + datebd.split('-')[0];
        var ValidTo = sRes.card.ValidTo;
        var datehethan = ValidTo.split(' ')[0];
        var datehethansx=datehethan.split('-')[1] + "/" + datehethan.split('-')[2] + "/" + datehethan.split('-')[0];
        //alert(datehethansx);
        $("#suangaybd").val(datebdsx);
        $("#suangayhethan").val(datehethansx);
        $("#suagiatienthe").val(sRes.card.Discount);
        $("#suauerid").val(sRes.card.RefUserID);
        $("#sualoaithe").html(sRes.strloai);
        $("#suatrangthai").html(sRes.strtt);
        $("#suaapdung").html(sRes.strad);
        var suaapdung=$("#suaapdung").val();
        if(suaapdung==0 || suaapdung=="0") //ap dung cho 1 so sp
        {
            $("#trchonspasua").show();
            $("#trchonspsua").show();
            if(sRes.tatcaspspa == 1 || sRes.tatcaspspa == "1")
            {
                $("#cbchontatcasua").attr("checked","checked");
                $("#divChonProsua").html("");
                $("#spanProListsua").html("");
            }
            else
            {
                if(sRes.tatcaspspa == 0 || sRes.tatcaspspa == "0")
                {
                    $("#btnselectprosua").show();
                    $("#cbchontatcasua").removeAttr("checked");
                    $("#divChonProsua").append(sRes.strsp);
                    $("#spanProListsua").append(sRes.strspid);
                }
            } 
            $("#spanSpaChonsua").html(sRes.spaid);
            $("#showchonmaspasua").show();
            $("#spanSpaNameChonsua").html(sRes.spaname);
            $("#showchontenspasua").show();
        }
        else
        {
            $("#trchonspasua").hide();
            $("#trchonspsua").hide();
        }
    }
}
function clickbtnsua()
{
    $("#tberrsuangaybd").hide();
    $("#tberrsuangayhethan").hide();
    $("#tberrsuauserid").hide();
    $("#tberrsuagiatienthe").hide();
    $("#tberrsuaminprice").hide();
    $("#suatbsuccess").hide();
    $("#suatberr").hide();
    
    var suacardno=$("#suacardno").val();
    var sualoaithe=$("#sualoaithe").val();
    
    //alert(sualoaithe);
    var suangaybd=$("#suangaybd").val();
    var suangayhethan=$("#suangayhethan").val();
    var suagiatienthe=$("#suagiatienthe").val();
    var suauerid=$("#suauerid").val();
    var suatrangthai=$("#suatrangthai").val();
    var suaapdung=$("#suaapdung").val();
    var suaminprice=$("#suaminprice").val();
    if(suangayhethan=="" || suangayhethan==null)
    {
        $("#tberrsuangayhethan").html("Không dược rỗng");
        $("#tberrsuangayhethan").show();
    }
    else
    {
        if(suangaybd=="" || suangaybd==null)
        {
            $("#tberrsuangaybd").html("Không dược rỗng");
            $("#tberrsuangaybd").show();
        }
        else
        {
            if(suagiatienthe=="" || suagiatienthe==null)
            {
                $("#tberrsuagiatienthe").html("Không dược rỗng");
                $("#tberrsuagiatienthe").show();
            }
            else
            {
                if(suauerid=="" || suauerid==null)
                {
                    $("#tberrsuauserid").html("Không dược rỗng");
                    $("#tberrsuauserid").show();
                }
                else
                {
                    if(suaminprice=="" || suaminprice==null)
                    {
                        $("#tberrsuaminprice").html("Không dược rỗng");
                        $("#tberrsuaminprice").show();
                    }
                    else
                    {
                            if(suaapdung==1 || suaapdung=="1") // ap dung cho tat ca 
                            {
                                $.ajax({
                                    type:"POST",
                                    url:getUrspal() + "admin/voucher/clickbtnsua",
                                    dataType:"text",
                                    data: {
                                        suacardno: suacardno,
                                        sualoaithe: sualoaithe,
                                        suangaybd: suangaybd,
                                        suangayhethan: suangayhethan,
                                        suagiatienthe: suagiatienthe,
                                        suauerid: suauerid,
                                        suatrangthai: suatrangthai,
                                        suaapdung: suaapdung,
                                        suaminprice: suaminprice
                                        },
                                    cache:false,
                                    success:function (data) {
                                        if( data== "-1" || data==="-1" || data==-1 )
                                        {
                                            alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
                                        }
                                        else
                                        {
                                            clickbtnsua_Complete(data);
                                        }
                                    }
                                });
                            }
                            else
                            {
                                var spanProList = $("#spanProListsua").html();
                                var spanSpaChonsua = $("#spanSpaChonsua").html();
                                   if($("#cbchontatcasua").is(':checked') )
                                        var tatcaspspa=1; //tat ca sp cua spa da chon
                                   else
                                       var tatcaspspa=0; //1 so sp cu the cua spa do thoi
                                //alert(spanProList);
                                $.ajax({
                                    type:"POST",
                                    url:getUrspal() + "admin/voucher/clickbtnsua",
                                    dataType:"text",
                                    data: {
                                        suacardno: suacardno,
                                        sualoaithe: sualoaithe,
                                        suangaybd: suangaybd,
                                        suangayhethan: suangayhethan,
                                        suagiatienthe: suagiatienthe,
                                        suauerid: suauerid,
                                        suatrangthai: suatrangthai,
                                        suaapdung: suaapdung,
                                        spanProList: spanProList,
                                        tatcaspspa: tatcaspspa,
                                        spanSpaChonsua: spanSpaChonsua,
                                        suaminprice: suaminprice
                                        },
                                    cache:false,
                                    success:function (data) {
                                        if( data== "-1" || data==="-1" || data==-1 )
                                        {
                                            alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
                                        }
                                        else
                                        {
                                            clickbtnsua_Complete(data);
                                        }
                                    }
                                });
                            }
                    }
                }
            }
        }
    }
}
function clickbtnsua_Complete(data)
{
    $("#suatbsuccess").hide();
    $("#suatberr").hide();
    var sRes = JSON.parse(data);
    if(sRes.sd==1 || sRes.sd=="1")
    {
        $("#suatbsuccess").html(sRes.tb);
        $("#suatbsuccess").show(); 
        //$("#suacardno").val(sRes.cardno);  
        //$("#suamaphatsinh").val(sRes.generatedID);  
    }
    else
    {
        $("#suatberr").html(sRes.tb);
        $("#suatberr").show(); 
    }
}
function xoa(id)
{
    var page = $("#cboPageNoPRO").val();
    if(page=="" || page==null)
        var page = $("#timcboPageNoPRO").val();
    //alert(id);
    //alert(page);
    var strconfirm = confirm("Bạn muốn tiếp tục?");
    if (strconfirm == true)
    {
        $.ajax({
            type:"POST",
            url:getUrspal() + "admin/voucher/xoa",
            dataType:"text",
            data: {
                id: id,
                page: page },
            cache:false,
            success:function (data) {
                if( data== "-1" || data==="-1" || data==-1 )
                {
                    alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
                }
                else
                {
                    xoa_Complete(data);
                }
              //alert(data);
            }
        });
    }
}
function xoa_Complete(data)
{
    var sRes = JSON.parse(data);
    if (sRes != null) {
        if(sRes.page!="")
            var page = sRes.page;
        else
            var page = 1;
        if(sRes.tt==1 || sRes.tt=="1") //xoa dc
        {
            $("#divtab1").show(300);
           $("#divtab2").hide(300);
           $("#divtab3").hide(300);
           $("#divtab4").hide(300);
           searchvoucher(page);
        }
        else
        {
            alert("Có lỗi xảy ra, vui lòng thử lại");
        }
    }
    
}
//nghia viet them 24/1/2015
function ChonSpaThemMoi() {
    $("#divSearchSpaTab2").dialog({
        height: 600,
        width: 800,
        modal: true
    });
}
function ChonSpaTab2(id) {
    
    $("#contentbuthem").html("");
    $("#cboPageNoPro").html("");
    $("#divChonPro").html("");
    $("#spanProList").html("");
    $("#spanSpaChonTab2").text(id);
    name = $("#trSPA" + id + " td:eq(2) span").html();
    $("#spanSpaNameChonTab2").text(name);
    $("#showchonmaspatab2").show();
    $("#showchontenspatab2").show();
    $("#trchonsp").show();
    $("#trbtn").show();
    $("#divSearchSpaTab2").dialog("close");
}
function SearchSPATab2(page) {
    var spaName = $("#txtSpaNameTab2").val();

    $.ajax({
        url: getUrspal() + "admin/products/searchspa",
        type: "POST",
        data: { spaName: spaName, Page: page },
        cache: false,
        dataType: "text",
        //contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                    SearchSPATab2_Complete(data);
                },
        error: function () {
        }
    });

}
function SearchSPACBBTab2() {
    var page = $("#cboPageNoSPATab2").val();
    var SpaName = $("#txtSpaNameTab2").val();

    $.ajax({
        url: getUrspal() + "admin/products/searchspa",
        type: "POST",
        data: { spaName: SpaName, Page: page },
        cache: false,
        dataType: "text",
        //contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                    SearchSPATab2_Complete(data);
                },
        error: function () {
        }
    });

}

function SearchSPATab2_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
        $("#panelDataSPATab2 tbody tr").remove();
        $("#ListFoundSPATab2").tmpl(sRes.lst).appendTo("#panelDataSPATab2 tbody");
        $("#panelDataSPATab2").css("display", "");

        //phân trang
        $("#DivPhanTrangSPATab2").show(500);
        var totalPage = parseInt(sRes.TotalPage);
        var Curpage = parseInt(sRes.CurPage);
        TrangHienTai = Curpage;
        TongTrang = totalPage;
        $("#cboPageNoSPATab2 option").remove();
        for (var i = 1; i <= totalPage; i++) {
            var sStr = "";
            if (i == TrangHienTai) {
                sStr = "<option value=\"" + i + "\" selected=\"selected\">" + i + "</option>";
            }
            else {
                sStr = "<option value=\"" + i + "\" >" + i + "</option>";
            }
            $("#cboPageNoSPATab2").append(sStr);
        }
    }
}
function export_excel()
{
    $.ajax({
        url: getUrspal() + "admin/voucher/export_excel_voucher",
        type: "POST",
        cache: false,
        dataType: "text",
        //contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                    
                },
        error: function () {
        }
    });
}
function ChonSpasua1() {
    $("#divSearchSpasua").dialog({
        height: 600,
        width: 800,
        modal: true
    });
}
function ChonSpasua(id) {
    
    $("#contentbusua").html("");
    $("#cboPageNoProsua").html("");
    $("#divChonProsua").html("");
    $("#spanProListsua").html("");
    $("#spanSpaChonsua").text(id);
    name = $("#trSPAsua" + id + " td:eq(2) span").html();
    $("#spanSpaNameChonsua").text(name);
    $("#showchonmaspasua").show();
    $("#showchontenspasua").show();
    $("#trchonspsua").show();
    $("#trbtnsua").show();
    $("#divSearchSpasua").dialog("close");
}
function SearchSPAsua(page) {
    var spaName = $("#txtSpaNamesua").val();

    $.ajax({
        url: getUrspal() + "admin/products/searchspa",
        type: "POST",
        data: { spaName: spaName, Page: page },
        cache: false,
        dataType: "text",
        //contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                    SearchSPAsua_Complete(data);
                },
        error: function () {
        }
    });

}
function SearchSPACBBsua() {
    var page = $("#cboPageNoSPAsua").val();
    var SpaName = $("#txtSpaNamesua").val();

    $.ajax({
        url: getUrspal() + "admin/products/searchspa",
        type: "POST",
        data: { spaName: SpaName, Page: page },
        cache: false,
        dataType: "text",
        //contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                    SearchSPAsua_Complete(data);
                },
        error: function () {
        }
    });

}

function SearchSPAsua_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
        $("#panelDataSPAsua tbody tr").remove();
        $("#ListFoundSPAsua").tmpl(sRes.lst).appendTo("#panelDataSPAsua tbody");
        $("#panelDataSPAsua").css("display", "");

        //phân trang
        $("#DivPhanTrangSPAsua").show(500);
        var totalPage = parseInt(sRes.TotalPage);
        var Curpage = parseInt(sRes.CurPage);
        TrangHienTai = Curpage;
        TongTrang = totalPage;
        $("#cboPageNoSPAsua option").remove();
        for (var i = 1; i <= totalPage; i++) {
            var sStr = "";
            if (i == TrangHienTai) {
                sStr = "<option value=\"" + i + "\" selected=\"selected\">" + i + "</option>";
            }
            else {
                sStr = "<option value=\"" + i + "\" >" + i + "</option>";
            }
            $("#cboPageNoSPAsua").append(sStr);
        }
    }
}
//end nghia viet them 24/1/2015