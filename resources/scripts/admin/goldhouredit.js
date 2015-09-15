var curPage =1; 
var curSpa  = 0;
var stt = 0;
$(document).ready(function() {
    $("#txtQuantity").ForceNumericOnly();
    $("#totalPromotion").number(true, 0);
    $("#cboPageNo").change(function () {
        var trang = $("#cboPageNo").val();
        searchPromotion(trang);
    });
    
    $("#cboPageNoSPAProduct").change(function () {
        var trang = $("#cboPageNoSPAProduct").val();
        SearchProductSpa(trang);
    });
    
});
// thêm thông tin khuyến mãi cho cho sản phẩm
function CapnhatPromotion() {
    var promoID = $('#txtPromotionID').val();
    var Name = $("#txtPromotionName").val();
    //convert string sang những ký tự đặc biệt
    var NamePromo = convert(Name);
    var Begin = $("#BeginTime").val();
    var To =    $("#EndTime").val();
    var TimeBegin = $("#beginhours").val();
    var TimeEnd  = $("#endhours").val();
    var Notes =  CKEDITOR.instances['txtInfo'].getData(); //$("#").val();
    var inbill = $("input:radio[name=send_mail]:checked").val();
    var currentTime = new Date();
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();
    if (minutes < 10)
        minutes = "0" + minutes;
    if(hours < 10)
        hours = "0" + hours; 
    var  currenttime = hours + ":" +  minutes;
    var magage = "";
    var vali   = true;
    if(TimeBegin != ""){
        if(TimeBegin < currenttime){
           magage = "Thời gian bắt đầu khuyến mãi không được nhỏ hơn thời gian hiện tại ";
           vali = false; 
        }
    }
    else{
        magage = "Vui lòng nhập giờ phút ";
        vali = false;  
    }
    
   
    if(TimeEnd != ""){
        if(TimeEnd < currenttime){
           magage = "Thời gian kết thúc khuyến mãi không được nhỏ hơn thời gian hiện tại ";
           vali = false; 
        }
        if(TimeEnd < TimeBegin){
           magage = "Thời gian kết thúc khuyến mãi không được nhỏ hơn thời gian bắt đầu khuyến mãi ";
           vali = false;  
        }
    }
    else{
        magage = "Vui lòng nhập giờ phút ";
        vali = false; 
    }
    if(vali == false){
        alert(magage);
        return false;
    }
    else{
            $.ajax({
            type: "POST",
            url: getUrspal() + "admin/goldhour/capnhat_promotion",
            dataType: "text",
            data: {
                PromoID:promoID,
                Name: NamePromo, 
                Begin: Begin,
                To: To,
                TimeBegin:TimeBegin,
                TimeEnd:TimeEnd,
                Notes: Notes, 
                Inbill: inbill
            },
            cache: false,
            success: function (data) {
                CapnhatPromotion_Complete(data);
                //alert(data);
            }
        });
        
    }
    
}

function CapnhatPromotion_Complete(data) {
    if($.isEmptyObject(data))
    {
        
    }
    else
    {
        var res = JSON.parse(data);
        if (res.PromotionId != "") {
            $("#PromotionSuccess").show(500);
            $("#PromotionErrors").hide(0);
            $("#btnthemPromo").css("display", "none");
            $('.class_ThemThanhCong').show(500);
            $("#txtPromotionID").val(res.PromotionId);
        }
        else {
            $("#PromotionSuccess").hide(500);
            $("#PromotionErrors").show(500);
            $("#btnthemPromo").css("display", "");
        }
    }
    
}

function doUpload1(url) {
    var PromoID = $("#txtPromotionID").val();
    if (PromoID == "") {
        return false;
    } else {
        return doUpload(url + "/"+ PromoID);
    }
}

function XemLaiHinhDaUp() {
    var PromoID = $("#txtPromotionID").val();    
    //$("#divXemLaiHinhDaUp").show(500); 
    $.ajax({
        url: getUrspal() + "admin/goldhour/gethinhpromotion",
        type: "POST",
        data: { Promotion: PromoID },
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


function CapNhatProductSpa() {
    var PromoID = $("#txtPromotionID").val();
    var ProductID = $('#spanProductSpaChon').text();
    var price = $('#txtPromotionPrice').val();
    var quantity = $('#txtQuantity').val();
    $.ajax({
        type: "POST",
        url: getUrspal() + "admin/goldhour/capnhat_promotiondetail",
        dataType: "text",
        data: {
            PromoID:PromoID, 
            ProID:  ProductID,
            Price:  price,
            Quantity: quantity
        },
        cache: false,
        success: function (data) {
            CapNhatProductSpa_Complete(data);
            //alert(data);
        }
    });
}

//ThemMoiProductSpa
function ThemMoiProductSpa() {
    var PromoID     = $("#txtPromotionID").val();
    var ProductID   = $('#spanProductSpaChon').text();
    var ProductName = $('#spanPrdouctNameChon').text();
    var price       = $('#txtPromotionPrice').val();
    var quantity    = $('#txtQuantity').val();
    var total       = (price*quantity);
    var message = "";
    var vali=true;
    
    if(PromoID == ""){
        message = "Vui lòng nhập mã khuyến mãi của sản phẩm";
    }
    
    if(ProductID == ""){
        message = "Vui lòng nhập mã của sản phẩm";
    }
   // if(price == ""){
//        message = "Vui lòng nhập đơn giá sản phẩm";
//    }
//    
//    if(quantity == ""){
//        message = "Vui lòng nhập số lượng sản phẩm";
//    }
    if(message != ""){
        vali = false;
    }
    if(vali == false){
        alert(message);
        return;
    }
     if($("#tbShowListProductPromo > tbody").children().length > 0){
         //stt = $("#tbShowListProductPromo > tbody").children().length;
         alert("Chỉ chọn được một sản phẩm cho khuyến mãi");
         return;
     }
        
    else{
        
        //stt++;    
        var str="";
        str = str + "<tr id=\"trPromotionDetail"+ProductID+"\">";
        str = str + "<td>1</td>";
        str = str + "<td><span>"+ProductID+"</span></td>";
        str = str + "<td><span>"+ProductName+"</span></td>";
        //str = str + "<td><span>"+ price+"</span></td>";
        str = str + "<td><span>1</span></td>";    
        //str = str + "<td><span>"+ total+"</span></td>";  
        str = str + "<td><a href=\"javascript:void(0)\" onclick=\"delete_plan('"+ProductID + "');\"><img src=\"<?php echo base_url('resources/images/icons/delete.png'); ?>\" title=\"Xóa số lượng\" alt=\"Xóa\" /></a></td>"; 
        str = str + "</tr>";
        $('#tbShowListProductPromo').css("display","");
    }
    
    //kiểm tra id product có tồn tại
    if($("#trPromotionDetail" + ProductID).length > 0)
    {
        alert("Sản phẩm này đã được thêm mới");
         $('#divAddmessageSucess').hide(0);
         $('#divAddmessageError').show(500); 
        return;
    }
    else{
         //stt++;
         $('#tbShowListProductPromo tbody').append(str); 
         $('#divAddmessageSucess').show(500);
         $('#divAddmessageError').hide(0);
    }
    
}
function sub_product(id){

    var quantity = $("#trPromotionDetail" + id + " td:eq(4) span").text();
    var price = $("#trPromotionDetail" + id + " td:eq(3) span").text();
    var totalAmount = 0;
    if(quantity == 1){
        alert("Không được giảm số lượng dưới 1");
        totalAmount =  (price*quantity);
    }
    else
     quantity = quantity-1;
     var totalAmount = (quantity*price);
    $("#trPromotionDetail" + id + " td:eq(4) span").text(quantity);
    $("#trPromotionDetail" + id + " td:eq(5) span").text(totalAmount);
    
    
}
function add_product(id){
    var quantity = $("#trPromotionDetail" + id + " td:eq(4) span").text();
    var price = $("#trPromotionDetail" + id + " td:eq(3) span").text();
    quantity = parseInt(quantity)+1;
    var totalAmount = (quantity*price);
    $("#trPromotionDetail" + id + " td:eq(4) span").text(quantity);
    $("#trPromotionDetail" + id + " td:eq(5) span").text(totalAmount);
}

function LuuCapNhatPromo() {
    //var tong = parseInt($("#spanSoCTPNSua").text());
    //var tongdetail = $("#totalPromotion").val();
//    if(tongdetail == 0)
//    {
//        alert("Vui lòng nhập tổng tiền cho khuyến mãi");
//        return;
//    }
//    else{
        
        var tong = $('table#tbShowListProductPromo tbody tr:last').index() + 1;
        if (tong > 0) {
            var list = [];
            var i = 0;
            while (i < tong) {
                var promodetail = {};
                promodetail.PromoId = $("#txtPromotionID").val();
                promodetail.ProId = $("#tbShowListProductPromo tbody tr:eq(" + i + ") td:eq(1) span").text();
                promodetail.DG = $("#tbShowListProductPromo tbody tr:eq(" + i + ") td:eq(3) span").text();
                promodetail.SL = 1;
                promodetail.TT = $("#tbShowListProductPromo tbody tr:eq(" + i + ") td:eq(5) span").text();
                list[i] = promodetail;
                i = i + 1;
            }

            $.ajax({
                url: getUrspal() + "admin/goldhour/capnhat_promotiondetail",
                type: "POST",
                data: {
                        promotiondetal: JSON.stringify(list)
                      },
                dataType: "json",
                //contentType: "application/json; charset=utf-8",
                success: function (data) {
                         UpdatePromontionDetail_Complete(data); 
                },
                error: function () { alert("Cập nhật CT KM không thành công!!"); }
            });
        }
        else {
            alert("Đã xóa KM !");
        }
        
    //}
    
}

function UpdatePromontionDetail_Complete(data) {
      var res = data;
      if (res.PromotionId != "") {
          $('#divmessageSucess_total').show(500);
          $('#divmessageError_total').hide(0);
      }
      else{
          $('#divmessageError_total').show(500);
          $('#divmessageSucess_total').hide(0);
      } 
}

function delete_plan(id){
    $("#trPromotionDetail" + id).remove();  
}

function CapNhatProductSpa_Complete(data) {
    if($.isEmptyObject(data))
    {
        
    }
    else
    {
        var res = JSON.parse(data);
        if (res.PromotionId != "") {
            $("#divmessageSucess").show(500);
            $("#divmessageError").hide(0);
            $("#btnthemPromo").css("display", "none");
            $('#divChooseSpa').show(500);
            //$("#txtPromotionID").val(res.PromotionId);
            ShowListProductProm(res.PromotionId);
        }
        else {
            $("#divmessageSucess").hide(500);
            $("#divmessageError").show(500);
            $("#btnthemPromo").css("display", "");
        }
    }
    
}
//end them mới product spa

function ShowListProductProm(id){
    $.ajax({
        type: "POST",
        url: getUrspal() + "admin/goldhour/showlistproductprom",
        dataType: "text",
        data: {
            PromoID: id
        },
        cache: false,
        success: function (data) {
            ShowListProductProm_Complete(data);
        }
    });
}

function ShowListProductProm_Complete(data){
     var sRes = JSON.parse(data);
    if (sRes != null) {
        $("#tbShowListProductPromo tbody tr").remove();
        $("#ShowListFoundSPAProduct").tmpl(sRes).appendTo("#tbShowListProductPromo tbody");
        $("#tbShowListProductPromo").css("display","");
    }
}

function ChonSpaThemMoi() {
    $("#divSearchSpaTab2").dialog({
        height: 600,
        width: 800,
        modal: true
    });
}
function ChonSpaProductThemMoi(){
     $("#divsearchProductSpa").dialog({
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
    $("#tdChooseProductSpa").show(500);
    if(curSpa != id && curSpa!=0)
    {  
          $("#spanProductSpaChon").text("");
          $("#spanPrdouctNameChon").text("");
          
    }
    curSpa = id;
       
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
function SearchProductSpa(page) {
    var ProductName = $("#spanSpaChonTab2").val();
    var spaID       = $("#spanSpaChonTab2").text();

    $.ajax({
        url: getUrspal() + "admin/goldhour/searchproductspa",
        type: "POST",
        data: { productName: ProductName, Page: page, spaID:spaID  },
        cache: false,
        dataType: "text",
        //contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                    SearchProductSpa_Complete(data);
                },
        error: function () {
        }
    });

}

function SearchProductSpa_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
        $("#panelDataSPAProduct tbody tr").remove();
        $("#ListFoundPRO").tmpl(sRes.lst).appendTo("#panelDataSPAProduct tbody");
        $("#panelDataSPAProduct").css("display", "");

        //phân trang
        $("#DivPhanTrangSPAProduct").show(500);
        var totalPage = parseInt(sRes.TotalPage);
        var Curpage = parseInt(sRes.CurPage);
        TrangHienTai = Curpage;
        TongTrang = totalPage;
        $("#cboPageNoSPAProduct option").remove();
        for (var i = 1; i <= totalPage; i++) {
            var sStr = "";
            if (i == TrangHienTai) {
                sStr = "<option value=\"" + i + "\" selected=\"selected\">" + i + "</option>";
            }
            else {
                sStr = "<option value=\"" + i + "\" >" + i + "</option>";
            }
            $("#cboPageNoSPAProduct").append(sStr);
        }
    }
}
function ChonSpaProduct(id) {
    $("#spanProductSpaChon").text(id);
    name = $("#trProductID" + id + " td:eq(2) span").html();
    $("#spanPrdouctNameChon").text(name);
    $("#divsearchProductSpa").dialog("close");
    $("#tdChooseProductSpa").show(500);
    LoadPriceNew(id);
}


function BackToGoldhour() {
    document.location.href = getUrspal() + "admin/goldhour" ;
}

function LoadPriceNew(id){
     $.ajax({
        url: getUrspal() + "admin/promotion/get_price_current",
        type: "POST",
        data: { ProductID:id },
        cache: false,
        dataType: "json",
        //contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                    if(data==-1|| data===-1||data=="-1")
                    {
                        arter("Bạn không có quyền thực hiện quyền này trên trang này");
                    }
                    else{
                        LoaPrice_Complete(data);
                    }
                    
                },
        error: function () {
        }
    });
}

function LoaPrice_Complete(data){
    if(data != null){
        if(data.res == "-1" || data.res == -1)
        {
            alert("Khong quyen!!");
        }
        else
        {
            $("#spaProductPrice").text(data.ProID);
            $(".SpanNumber").number(true, 0);
            $("#spaProductPrice").number(true, 0);
        }
        
    }
}