$(document).ready(function() {

    $("#CurrentVouchersTab2").ForceNumericOnly();
    $("#DurationTab2").ForceNumericOnly();
    $("#MaxProductatOnceTab2").ForceNumericOnly();

    $("#PriceTab2").number(true, 0);

    $("#cboPageNoPRO").change(function () {
        var trang = $("#cboPageNoPRO").val();
        searchProducts(trang);
    });
        
    //GetProductType();
    GetProductTypeNew();
});

function searchProducts(page) {    
   
    var ProductID = $("#txtProductID").val();
    var Name = $("#txtName").val();
    var ListSpa = $("#spanSPAList").text();
    var ProductType = $("#cboProductType").val();
    var Policy = $("#txtPolicy").val();   
    var Desciption = $("#txtDescription").val();

    curPage = page;    
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/products/search_products",
        dataType:"text",
        data: {
            proID: ProductID, proName: Name,
            spaList: ListSpa,
            proType: ProductType,
            policy: Policy, desciption: Desciption,
                 Page:page},
        cache:false,
        success:function (data) {
                if( data== "-1" || data==="-1" || data==-1 )
                {
                    alert("Ban Khong Co quyen tren chuc nang nay o trang nay !!! ");                    
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
        $("#panelDataPRO tbody tr").remove();
        $("#ListFoundPRO").tmpl(sRes.lst).appendTo("#panelDataPRO tbody");
        $("#panelDataPRO").show(500);
               
        //phÃ¢n trang
        var totalPage = parseInt(sRes.TotalPage);
        var Curpage = parseInt(sRes.CurPage);
        $("#divTBKQTim div").text("Tim duoc " + sRes.TotalRecord + " mau tin!!!");
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
}

////
function GetProductType() {
    $.ajax({
        url: getUrspal() + "admin/products/GetProductType",
        type: "POST",   
        contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                    GetProductType_Complete(data);
                },
        error: function () {
        }
    });
}
function GetProductType_Complete(data) {
    //var sRes = data;  
    var sRes = JSON.parse(data);  
    if (sRes != null) {
        $("#cboProductType option").remove();
        $("#cboProductType").append("<option value=\"\">Vui lòng chọn nếu cần ...</option>");
        for (var i = 0; i < sRes.length; i++) {
            var sStr = "";
            sStr = sStr + "<option value=\"" + sRes[i].CommonId + "\" CommonTypeId=\"" + sRes[i].CommonTypeId
            sStr = sStr + "\" >";
            sStr = sStr + sRes[i].CommonId + " - " + sRes[i].StrValue1 + "</option>";
            $("#cboProductType").append(sStr);
        }
    }
}


function GetProductTypeNew() {
    $.ajax({
        url: getUrspal() + "admin/products/getproducttypenew",
        type: "POST",
        contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                    GetProductTypeNew_Complete(data);
                },
        error: function () {
        }
    });
}

//<optgroup label="Swedish Cars">
//<option value="volvo">Volvo</option>
//<option value="saab">Saab</option>
//</optgroup>

function GetProductTypeNew_Complete(data) {
    //var sRes = data;  
    var sRes = JSON.parse(data);
    if (sRes != null) {
        $("#cboProductTypeTab2 optgroup").remove();
        $("#cboProductTypeTab2").append(sRes.Str);
        $("#cboProductType optgroup").remove();
        $("#cboProductType option").remove();
        $("#cboProductType").append(sRes.Str);
        //cboProductType
    }
}

///
function SelectSpa() {
    $("#divSearchSpa").dialog({
        height: 700,
        width: 900,
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


/////
function SearchSPA(page) {
    var spaName = $("#txtSpaName").val();    

    $.ajax({
        url: getUrspal() + "admin/products/searchspa",
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
        url: getUrspal() + "admin/products/searchspa",
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



function ShowSpaDetail(spaID,ProID) {
    if ($("#divSPA" + ProID).html().length > 10) {
        $("#divSPA" + ProID).toggle();
    }
    else {
        $.ajax({
            url: getUrspal() + "admin/products/searchspatheoID",
            type: "POST",
            data: { spaid: spaID },
            cache: false,
            dataType: "text",
            //contentType: "application/json; charset=utf-8",
            success:
                    function (data) {
                        var res = JSON.parse(data);
                        var str = "<b>Tên SPA:</b> " + res[0].spaName + "<br/>";
                        str = str + "<b>Địa chỉ:</b> " + res[0].Address + "<br/>";
                        str = str + "<b>Điện Thoại:</b> " + res[0].Tel + "<br/>";
                        $("#divSPA" + ProID).html(str);
                        $("#divSPA" + ProID).toggle();
                    },
            error: function () {
            }
        });
    }
}

function Reset()
{
    //
    $("#cboProductType option").removeAttr("selected");
    $("#cboChuyenNganh option:eq(0)").attr("selected", true);
    //
    $("#txtProductID").val("");
    $("#divChonSpa").html("");
    $("#spanSPAList").html("");
    $("#txtName").val("");
    $("#txtPolicy").val("");
    $("#txtRestriction").val("");
    $("#txtDescription").val("");
}

function ThemMoiProducts() {

    var Name = $("#txtNameTab2").val();
    var spaID = $("#spanSpaChonTab2").text();
    var ProductType = $("#cboProductTypeTab2").val();
    var Policy =  CKEDITOR.instances['txtPolicyTab2'].getData(); //$("#").val();

    var currentVouchers = $("#CurrentVouchersTab2").val();
    var duration = $("#DurationTab2").val();
    var maxProductatOnce = $("#MaxProductatOnceTab2").val();
    var validTimeFrom = $("#ValidTimeFromTab2").val();
    var validTimeTo = $("#ValidTimeToTab2").val();

    var tips = CKEDITOR.instances['txtTipsTab2'].getData();  //$("#txtTipsTab2").val();
    var status = $("#cboStatusTab2").val();
    var Desciption = CKEDITOR.instances['txtDescriptionTab2'].getData();//$("#txtDescriptionTab2").val();
    var restriction = CKEDITOR.instances['txtRestrictionTab2'].getData();// $("#txtRestrictionTab2").val();
    var price = $("#PriceTab2").val();
    
   var checkpromotion;
    if($("#checkpromotion").is(':checked'))
        checkpromotion = 1;  // checked
    else
       checkpromotion = 0;  
    ///curPage = page;
    var message = "";
    var vali=true; 
    if(spaID == ""){
        message =  "Vui lòng chọn spa cho sản phẩm";
    }
    
    if(ProductType == ""){
        message =  "Vui lòng chọn loại dịch vụ";
    }
    
    if(validTimeFrom > validTimeTo){
        message =  "Thời gian bắt đầu không được lớn hơn thời gian kết thúc";
    }
    
    if(price == ""){
       message =  "Giá cơ bản không được bỏ trống"; 
    }
   
    if(message != ""){
        vali = false;
    }
    if(vali == false){
        alert(message);
        return;
    }
    else{
            $.ajax({
                type: "POST",
                url: getUrspal() + "admin/products/them_moi_product",
                dataType: "text",
                data: {
                    SpaID: spaID, proName: Name,
                    Status: status,
                    proType: ProductType,
                    policy: Policy, desciption: Desciption,
                    CurrentVouchers: currentVouchers, Duration: duration,
                    MaxProductatOnce: maxProductatOnce,
                    ValidTimeFrom: validTimeFrom, ValidTimeTo: validTimeTo,
                    Restriction: restriction, Tips: tips,
                    Price:price,
                    CheckProm:checkpromotion
                },
                cache: false,
                success: function (data) {
                        if( data== "-1" || data==="-1" || data==-1 )
                        {
                            alert("Ban Khong Co quyen tren chuc nang nay o trang nay !!! ");                    
                        }
                        else
                        {
                            ThemMoiProducts_Complete(data);
                        }
                }
            });
      }
}

function ThemMoiProducts_Complete(data) {
    if($.isEmptyObject(data))
    {
        
    }
    else
    {
        var res = JSON.parse(data);
        if (res.ProductID != "") {
            $(".ThemThanhCong").show(500);
            $(".ThemThatBai").hide(0);
            $("#btnthemPro").css("display", "none");
            $("#txtProductIDTab2").val(res.ProductID);
        }
        else {
            $(".ThemThanhCong").hide(500);
            $(".ThemThatBai").show(500);
            $("#btnthemPro").css("display", "");
        }
    }
    
}


function doUpload1(url) {
    var ProID = $("#txtProductIDTab2").val();
    if (ProID == "") {
        return false;
    } else {
        return doUpload(url + "/"+ ProID);
    }
}

function XemLaiHinhDaUp() {
    var ProID = $("#txtProductIDTab2").val();    
    //$("#divXemLaiHinhDaUp").show(500);
    
    $.ajax({
        url: getUrspal() + "admin/products/gethinhproducts",
        type: "POST",
        data: { ProductID: ProID },
        cache: false,
        dataType: "text",
        //contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                    XemLaiHinhDaUp_Complete(data);
                },
        error: function () {
        }
    });
}
function XemLaiHinhDaUp_Complete(data) {
    //var sRes = data;  
    var sRes = JSON.parse(data);
    if (sRes != null) {
        var str = "<div style=\"float: left;\">";

        for (i = 0; i < sRes.length; i++) {
            str = str + "<div id=\"divLinks" + sRes[i].id + "\" style=\"padding: 10px; float: left\">";
            str = str + "<img src="+ getUrspal() + sRes[i].URL + " width=\"180\"/>";
            str = str + "<a href=\"javascript:void(0);\" onclick=\"XoaHinhProduct('" + sRes[i].id + "');\">Xóa</a>";
            str = str + "</div>";
        }

        str = str + "</div>";
        $("#divXemLaiHinhDaUp").html("");
        $("#divXemLaiHinhDaUp").append(str);
        //cboProductType
        $("#divXemLaiHinhDaUp").dialog({
            height: 600,
            width: 800,
            modal: true
        });
    }
}

function XoaHinhProduct(id) {
    var strconfirm = confirm("Bạn có chắc chắn xóa không?");
    if (strconfirm == true) {
        $.ajax({
            url: getUrspal() + "admin/products/xoahinh",
            type: "POST",
            data: { ID: id },
            cache: false,
            dataType: "text",
            //contentType: "application/json; charset=utf-8",
            success:
                    function (data) {
                        //XoaHinhProduct_Complete(data);
                        var res = JSON.parse(data);
                        if (res.Result == "1") {
                            $("#divLinks" + id).remove();
                        }
                    },
            error: function () {
            }
        });
    }
}


function CapNhatTimePRO() {
    var ProID = $("#txtProductIDTab2").val();
    var FT2 = $("#tableThemTgianPRO tr:eq(1) td:eq(0) select:eq(0)").val();
    var TT2 = $("#tableThemTgianPRO tr:eq(1) td:eq(0) select:eq(1)").val();

    var FT3 = $("#tableThemTgianPRO tr:eq(1) td:eq(1) select:eq(0)").val();
    var TT3 = $("#tableThemTgianPRO tr:eq(1) td:eq(1) select:eq(1)").val();

    var FT4 = $("#tableThemTgianPRO tr:eq(1) td:eq(2) select:eq(0)").val();
    var TT4 = $("#tableThemTgianPRO tr:eq(1) td:eq(2) select:eq(1)").val();

    var FT5 = $("#tableThemTgianPRO tr:eq(1) td:eq(3) select:eq(0)").val();
    var TT5 = $("#tableThemTgianPRO tr:eq(1) td:eq(3) select:eq(1)").val();

    var FT6 = $("#tableThemTgianPRO tr:eq(1) td:eq(4) select:eq(0)").val();
    var TT6 = $("#tableThemTgianPRO tr:eq(1) td:eq(4) select:eq(1)").val();

    var FT7 = $("#tableThemTgianPRO tr:eq(1) td:eq(5) select:eq(0)").val();
    var TT7 = $("#tableThemTgianPRO tr:eq(1) td:eq(5) select:eq(1)").val();

    var FTCN = $("#tableThemTgianPRO tr:eq(1) td:eq(6) select:eq(0)").val();
    var TTCN = $("#tableThemTgianPRO tr:eq(1) td:eq(6) select:eq(1)").val();

    var FTLE = $("#tableThemTgianPRO tr:eq(1) td:eq(7) select:eq(0)").val();
    var TTLE = $("#tableThemTgianPRO tr:eq(1) td:eq(7) select:eq(1)").val();
    ///curPage = page;
    var message = "";
    var vali = true;
    if(parseInt(FT2) > parseInt(TT2))
    {
        message = "Thời gian bắt đầu hoạt động không được lớn hơn thời gian kết thúc của ngày thứ 2";
    }
    
    if(parseInt(FT3) > parseInt(TT3)){
        
        message = "Thời gian bắt đầu hoạt động không được lớn hơn thời gian kết thúc của ngày thứ 3";  
    }
    if(parseInt(FT4) > parseInt(TT4)){
        
        message = "Thời gian bắt đầu hoạt động không được lớn hơn thời gian kết thúc của ngày thứ 4";  
    }
    if(parseInt(FT5) > parseInt(TT5)){
        
        message = "Thời gian bắt đầu hoạt động không được lớn hơn thời gian kết thúc của ngày thứ 5";  
    }
    
    if(parseInt(FT6) > parseInt(TT6)){
        message = "Thời gian bắt đầu hoạt động không được lớn hơn thời gian kết thúc của ngày thứ 6 ";  
    }
    if(parseInt(FT7) > parseInt(TT7)){
        message = "Thời gian bắt đầu hoạt động không được lớn hơn thời gian kết thúc của ngày thứ 7";  
    }
    
    if(parseInt(FTCN) > parseInt(TTCN)){
        
        message = "Thời gian bắt đầu hoạt động không được lớn hơn thời gian kết thúc của ngày chủ nhật";  
    }
    
    if(parseInt(FTLE) > parseInt(TTLE)){
        message = "Thời gian bắt đầu hoạt động không được lớn hơn thời gian kết thúc của ngày lễ";  
    }

    if(message != ""){
        vali = false;
    }
    if(vali == false){
        alert(message);
        return;
    }
    else{
           $.ajax({
            type: "POST",
            url: getUrspal() + "admin/products/capnhat_time_product",
            dataType: "text",
            data: {
                ft2: FT2, tt2: TT2,
                ft3: FT3, tt3: TT3,
                ft4: FT4, tt4: TT4,
                ft5: FT5, tt5: TT5,
                ft6: FT6, tt6: TT6,
                ft7: FT7, tt7: TT7,
                ftcn: FTCN, ttcn: TTCN,
                ftle: FTLE, ttle: TTLE,
                ProductID: ProID
            },
            cache: false,
            success: function (data) {
                CapNhatTimePRO_Complete(data);
                //alert(data);
            }
        });
    }
   
}

function CapNhatTimePRO_Complete(data) {
    if (data != null) {
        var res = JSON.parse(data);
        if (res.Result == "1") {
            $("#divTBKQCapNhatTimePRO").removeClass("error");
            $("#divTBKQCapNhatTimePRO").removeClass("success");
            $("#divTBKQCapNhatTimePRO").addClass("success");
            $("#divTBKQCapNhatTimePRO div").html("Cap nhat thanh cong !");
            $("#divTBKQCapNhatTimePRO").show(500);
        }
        else {
            $("#divTBKQCapNhatTimePRO").removeClass("error");
            $("#divTBKQCapNhatTimePRO").removeClass("success");
            $("#divTBKQCapNhatTimePRO").addClass("error");
            $("#divTBKQCapNhatTimePRO div").html("Cap nhat không thanh cong !");
            $("#divTBKQCapNhatTimePRO").show(500);
        }
    }
    else {
        $("#divTBKQCapNhatTimePRO").removeClass("error");
        $("#divTBKQCapNhatTimePRO").removeClass("success");
        $("#divTBKQCapNhatTimePRO").addClass("error");
        $("#divTBKQCapNhatTimePRO div").html("Cap nhat không thanh cong !");
        $("#divTBKQCapNhatTimePRO").show(500);
    }
}


function ChonSpaThemMoi() {
    $("#divSearchSpaTab2").dialog({
        height: 600,
        width: 800,
        modal: true
    });
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

function ChonSpaTab2(id) {
    $("#spanSpaChonTab2").text(id);
    name = $("#trSPA" + id + " td:eq(2) span").html();
    $("#spanSpaNameChonTab2").text(name);
    $("#divSearchSpaTab2").dialog("close");
}

function ShowSpaDetailTab2() {
    spaID = $("#spanSpaChonTab2").text();
    if ($("#divShowChiTietSpa").html().length > 10) {
        $("#divShowChiTietSpa").toggle();
    }
    else {
        $.ajax({
            url: getUrspal() + "admin/products/searchspatheoID",
            type: "POST",
            data: { spaid: spaID },
            cache: false,
            dataType: "text",
            //contentType: "application/json; charset=utf-8",
            success:
                    function (data) {
                        var res = JSON.parse(data);
                        var str = "<b>Tên SPA:</b> " + res[0].spaName + "<br/>";
                        str = str + "<b>Địa chỉ:</b> " + res[0].Address + "<br/>";
                        str = str + "<b>Điện Thoại:</b> " + res[0].Tel + "<br/>";
                        $("#divShowChiTietSpa").html(str);
                        $("#divShowChiTietSpa"  ).toggle();
                    },
            error: function () {
            }
        });
    }
}

function EditProduct(id) {
    document.location.href = getUrspal() + "admin/products/edit/"+id;
}


function DeleteProduct(id) {
    var strconfirm = confirm("Bạn có chắc chắn xóa không?");
    if (strconfirm == true) {
        $.ajax({
            url: getUrspal() + "admin/products/xoaproducts",
            type: "POST",
            data: { ProductID: id },
            cache: false,
            dataType: "text",
            //contentType: "application/json; charset=utf-8",
            success:
                    function (data) {
                        if( data== "-1" || data==="-1" || data==-1 )
                        {
                            alert("Ban Khong Co quyen tren chuc nang nay o trang nay !!! ");                    
                        }
                        else
                        {
                            DeleteProduct_Complete(data);
                        }
                    },
            error: function () {
            }
        });
    }
}

function DeleteProduct_Complete(data) {
    var res = JSON.parse(data);
    if (res.Result == "1" || res.Result == 1) {
        //$("")
        var trang = $("#cboPageNoPRO").val();
        searchProducts(trang);
    }
}

function ResetThemMoi() {
    $("#txtProductIDTab2").val("");
    $("#txtNameTab2").val("");
    $("#spanSpaChonTab2").text("");
    $("#spanSpaNameChonTab2").text("");
    $('#divShowChiTietSpa').css("display","none");

    $("#panelDataSPATab2 tbody tr").remove();

    CKEDITOR.instances['txtDescriptionTab2'].setData("");

    $("#cboStatusTab2 option:selected").removeAttr("selected");
    $("#cboStatusTab2 option[value='1']").attr("selected", "selected");

    $("#cboProductTypeTab2 option:selected").removeAttr("selected");
    $("#cboProductTypeTab2 optgroup:eq(0) option[value='']").attr("selected", "selected");

    $("#CurrentVouchersTab2").val("100");
    $("#DurationTab2").val("0");
    $("#MaxProductatOnceTab2").val("1");
    $("#ValidTimeFromTab2").val("");
    $("#ValidTimeToTab2").val("");

    CKEDITOR.instances['txtPolicyTab2'].setData("");
    CKEDITOR.instances['txtRestrictionTab2'].setData("");
    CKEDITOR.instances['txtTipsTab2'].setData("");

    $("#PriceTab2").val("");

    ///
    $(".ThemThanhCong").css("display", "none");
    $(".ThemThatBai").css("display", "none");

    $(".notification").css("display", "none");
    $(".error").css("display", "none");

    $("#txtProductIDTab2").val("");
    $("#btnthemPro").show(500);

}
