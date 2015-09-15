$(document).ready(function() {
        $("#content_first").show();
        $("#content_second").hide();
        $("#phuongthucdanhsach").click(function () {
            $("#cboPageNoPRO1").hide();
            $("#cboPageNoPRO").show();
            $("#divTBKQTim").show(500);
            $("#khungtim").hide(300);
            $("#panelDataPRO").show(300);
            $("#content_first").show();
            $("#content_second").hide();
            searchProducts(1);
        });
        $("#cboPageNoPRO").change(function () {
            var trang = $("#cboPageNoPRO").val();
            searchProducts(trang);
        });
        $("#cboPageNoPRO1").change(function () {
            var trang = $("#cboPageNoPRO1").val();
            btntim(trang);
        });
        $("#phuongthuctim").click(function () {
            $("#content_first").show();
            $("#content_second").hide();
            $("#divTBKQTim").hide(500);
            $("#khungtim").show(500);
            $("#panelDataPRO").hide(300);
        });
        $("#quaylai").click(function () {
            $("#content_first").show();
            $("#content_second").hide();
        });
        $('#timngay').nopress();
});
jQuery.fn.nopress =
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
                (key >= 96 && key <= 105));
        });
    });
};
function ddmmyyyy_to_yyyymmdd(str)
{
        var thang=str.substr(0,2);
        var ngay=str.substr(3,2);
        var nam=str.substr(6,4);
        str= nam + "-" + thang + "-" + ngay;
        return str;
}
//reset
function Reset()
{
    //
    $("#timten").val("");
    $("#divChonSpa").html("");
    $("#spanSPAList").html("");
    $("#divChonproduct").html("");
    $("#spanproductList").html("");
    $("#timuserid").val("");
    $("#timbookingid").val("");
    $("#timngay").val("");
    $("#timthanhtoan option").removeAttr("selected");
}

//nhan nut danh sach
function searchProducts(page) {    
    curPage = page;    
    
    $.ajax({
        type:"POST",
        url: getUrspal() + "admin/bookingsearch/search_booking",
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
                searchProducts_Complete(data);
            }
          //alert(data);
        }
    });
}

function searchProducts_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
        if(sRes.TotalRecord !=0)
        {
            $("#khongtimthay").hide(200);
             $("#cboPageNoPRO").show(300);
            $("#panelDataPRO tbody tr").remove();
            $("#panelDataPRO tbody").html(sRes.str);
            $("#panelDataPRO").show(500);
                   
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
//chon spa
function SelectSpa() {
    $("#divSearchSpa").dialog({
        height: 600,
        width: 800,
        modal: true
    });
}
function XoaSPA(id) {
    $("#" + id).remove();
    var id1 = id.replace("SPA", "");
    var str = $("#spanSPAList").text();
    var str1 = str.replace(id1 + ";", "");
    $("#spanSPAList").text(str1);
}
function SearchSPA(page) {
    var spaName = $("#txtSpaName").val();    

    $.ajax({
        url: getUrspal() + "admin/bookingsearch/searchspa",
        type: "POST",
        data:{spaName: spaName, Page:page},
        cache:false,
        dataType:"text",
        //contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                     if( data== "-1" || data==="-1" || data==-1 )
                    {
                        alert("Ban Khong Co quyen tren chuc nang nay o trang nay !!! ");                    
                    }
                    else
                    {
                        SearchSPA_Complete(data);
                    }
                },
        error: function () {
        }
    });

}

function SearchSPACBB() {
    var page = $("#cboPageNoSPA").val();
    var SpaName = $("#txtSpaName").val();

    $.ajax({
        url: getUrspal() + "admin/bookingsearch/searchspa",
        type: "POST",
        data:{spaName:SpaName, Page:page},
        cache:false,
        dataType: "text",
        //contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                    SearchSPA_Complete(data);
                },
        error: function () {
        }
    });

}
function SearchSPA_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
        $("#panelDataSPA tbody tr").remove();
        $("#ListFoundSPA").tmpl(sRes.lst).appendTo("#panelDataSPA tbody");
        $("#panelDataSPA").css("display","");

        //phân trang
        $("#DivPhanTrangSPA").show(500);
        var totalPage = parseInt(sRes.TotalPage);
        var Curpage = parseInt(sRes.CurPage);
        TrangHienTai = Curpage;
        TongTrang = totalPage;
        $("#cboPageNoSPA option").remove();
        for (var i = 1; i <= totalPage; i++) {
            var sStr = "";
            if (i == TrangHienTai) {
                sStr = "<option value=\"" + i + "\" selected=\"selected\">" + i + "</option>";
            }
            else {
                sStr = "<option value=\"" + i + "\" >" + i + "</option>";
            }
            $("#cboPageNoSPA").append(sStr);
        }
    }
}
function SelectFinish() {
    var rowCount = $('table#panelDataSPA tbody tr:last').index() + 1;
    for (var i = 0; i < rowCount; i++) {
        if ($("table#panelDataSPA tbody tr:eq(" + i.toString() + ") input[type='checkbox']:eq(0)").is(":checked")) {
            var id = $("table#panelDataSPA tbody tr:eq(" + i.toString() + ") td:eq(1)").html();
            var HoTen = $("table#panelDataSPA tbody tr:eq(" + i.toString() + ") td:eq(2) span:eq(0)").html();
            var str = "<div id=\"SPA" + id + "\" class=\"doituongDIV\">";
            str = str + "<span>" + id + " - " + HoTen + "</span>";
            str = str + "<a href=\"javascript:void(0);\" onclick=\"XoaSPA('SPA" + id + "');\"><img src=\"resources/images/icons/cross_grey_small.png\" height=\"10\" /></a></div>";
            if ($("#SPA" + id + " span").text().length > 0) {

            }
            else {
                $("#divChonSpa").append(str);
                $("#spanSPAList").append(id + ";");
            }
        }
    }
    $("#divSearchSpa").dialog("close");
}
//end chon spa
//chon product
function Selectproduct() {
    $("#divSearchproduct").dialog({
        height: 600,
        width: 800,
        modal: true
    });
}
function Xoaproduct(id) {
    $("#" + id).remove();
    var id1 = id.replace("product", "");
    var str = $("#spanproductList").text();
    var str1 = str.replace(id1 + ";", "");
    $("#spanproductList").text(str1);
}
function Searchproduct(page) {
    var productName = $("#txtproductName").val();    

    $.ajax({
        url: getUrspal() + "admin/bookingsearch/searchproduct",
        type: "POST",
        data:{productName: productName, Page:page},
        cache:false,
        dataType:"text",
        //contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                     if( data== "-1" || data==="-1" || data==-1 )
                    {
                        alert("Ban Khong Co quyen tren chuc nang nay o trang nay !!! ");                    
                    }
                    else
                    {
                        Searchproduct_Complete(data);
                    }
                },
        error: function () {
        }
    });

}

function SearchproductCBB() {
    var page = $("#cboPageNoproduct").val();
    var productName = $("#txtproductName").val();

    $.ajax({
        url: getUrspal() + "admin/bookingsearch/searchproduct",
        type: "POST",
        data:{productName:productName, Page:page},
        cache:false,
        dataType: "text",
        //contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                    Searchproduct_Complete(data);
                },
        error: function () {
        }
    });

}
function Searchproduct_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
        $("#panelDataproduct tbody tr").remove();
        $("#ListFoundproduct").tmpl(sRes.lst).appendTo("#panelDataproduct tbody");
        $("#panelDataproduct").css("display","");

        //phân trang
        $("#DivPhanTrangproduct").show(500);
        var totalPage = parseInt(sRes.TotalPage);
        var Curpage = parseInt(sRes.CurPage);
        TrangHienTai = Curpage;
        TongTrang = totalPage;
        $("#cboPageNoproduct option").remove();
        for (var i = 1; i <= totalPage; i++) {
            var sStr = "";
            if (i == TrangHienTai) {
                sStr = "<option value=\"" + i + "\" selected=\"selected\">" + i + "</option>";
            }
            else {
                sStr = "<option value=\"" + i + "\" >" + i + "</option>";
            }
            $("#cboPageNoproduct").append(sStr);
        }
    }
}
function SelectFinishproduct() {
    var rowCount = $('table#panelDataproduct tbody tr:last').index() + 1;
    for (var i = 0; i < rowCount; i++) {
        if ($("table#panelDataproduct tbody tr:eq(" + i.toString() + ") input[type='checkbox']:eq(0)").is(":checked")) {
            var id = $("table#panelDataproduct tbody tr:eq(" + i.toString() + ") td:eq(1)").html();
            var HoTen = $("table#panelDataproduct tbody tr:eq(" + i.toString() + ") td:eq(2) span:eq(0)").html();
            var str = "<div id=\"product" + id + "\" class=\"doituongDIV\">";
            str = str + "<span>" + id + " - " + HoTen + "</span>";
            str = str + "<a href=\"javascript:void(0);\" onclick=\"Xoaproduct('product" + id + "');\"><img src=\"resources/images/icons/cross_grey_small.png\" height=\"10\" /></a></div>";
            if ($("#product" + id + " span").text().length > 0) {

            }
            else {
                $("#divChonproduct").append(str);
                $("#spanproductList").append(id + ";");
            }
        }
    }
    $("#divSearchproduct").dialog("close");
}
//end chon product
//nhan nut tim
function btntim(page)
{
    var timten = $("#timten").val();
    var timuserid = $("#timuserid").val();
    var timbookingid = $("#timbookingid").val();
    var timthanhtoan = $("#timthanhtoan").val();
    var timngay = $("#timngay").val();
    if(timngay!="")
        timngay=ddmmyyyy_to_yyyymmdd(timngay);
    //alert(timngay);
    var spanSPAList = $("#spanSPAList").text();
    var spanproductList = $("#spanproductList").text();
    
    curPage = page;    
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/bookingsearch/btntim",
        dataType:"text",
        data: {
            dtimten:timten,
            dtimuserid:timuserid,
            dtimbookingid:timbookingid,
            dtimthanhtoan:timthanhtoan,
            dtimngay:timngay,
            dspanSPAList:spanSPAList,
            dspanproductList:spanproductList,
            Page:page},
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                btntim_Complete(data);
            }
          //alert(data);
        }
    });
}
function btntim_Complete(data) {
    $("#cboPageNoPRO").hide();
    $("#cboPageNoPRO1").show();
    var sRes = JSON.parse(data);
    if (sRes != null) {
        if(sRes.TotalRecord !=0)
        {
            $("#khongtimthay").hide(200);
             $("#cboPageNoPRO1").show(300);
            $("#panelDataPRO tbody tr").remove();
            $("#ListFoundPRO").tmpl(sRes.lst).appendTo("#panelDataPRO tbody");
            $("#panelDataPRO").show(500);
                   
            //phÃ¢n trang
            var totalPage = parseInt(sRes.TotalPage);
            var Curpage = parseInt(sRes.CurPage);
            $("#divTBKQTim div").text("Tìm được " + sRes.TotalRecord + " mẫu tin!!!");
            $("#divTBKQTim").show(500);
            TrangHienTai = Curpage;
            TongTrang = totalPage;
            $("#cboPageNoPRO1 option").remove();
            for (var i = 1; i <= totalPage; i++) {
                var sStr = "";
                if (i == TrangHienTai) {
                    sStr = "<option value=\"" + i + "\" selected=\"selected\">" + i + "</option>";
                }
                else {
                    sStr = "<option value=\"" + i + "\" >" + i + "</option>";
                }
                $("#cboPageNoPRO1").append(sStr);
            }
        }
        else
        {
            $("#khongtimthay").show(500);
            $("#panelDataPRO").hide(200);
            $("#cboPageNoPRO1").hide(200);
            $("#divTBKQTim").hide(200);
        }
    }
}
function xemdetail(bookingid,loaitrang)
{
    $("#content_first").hide();
    $("#content_second").show();
    var pagetype=loaitrang; //1 la danh sach, 2 la timkiem
    var page="";
    if(pagetype==1 || pagetype=='1')
    {
        page=$("#cboPageNoPRO").val();
    }
    if(pagetype==2 || pagetype=='2')
    {
        page=$("#cboPageNoPRO1").val();
    }
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/bookingsearch/xemdetail",
        dataType:"text",
        data: {
            dbookingid:bookingid,
            dpagetype:pagetype,
            Page:page},
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                xemdetail_Complete(data);
            }
          //alert(data);
        }
    });
}
function xemdetail_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
       $("#khungdetail").html(sRes.str);
       if(sRes.dpagetype==1 || sRes.dpagetype=='1')
            $("#quaylai").attr('onclick','searchProducts(' + sRes.Page + ');')
       if(sRes.dpagetype==2 || sRes.dpagetype=='2')
            $("#quaylai").attr('onclick','btntim(' + sRes.Page + ');')
    }
}


