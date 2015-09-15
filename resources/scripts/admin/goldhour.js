var curPage =1; 
var curSpa  = 0;
var stt = 0;
$(document).ready(function() {
    $("#txtQuantity").ForceNumericOnly();
    $("#txtPromotionPrice").ForceNumericOnly();//txtPromotionPrice_total
    $("#txtPromotionPrice_total").ForceNumericOnly();//txtQuantity_total
    $("#txtQuantity_total").ForceNumericOnly();
    $("#totalPromotion").number(true, 0);//totalPromotion
    $("#cboPageNo").change(function () {
        var trang = $("#cboPageNo").val();
        searchPromotion(trang);
    });
    
    $("#cboPageNoSPAProduct").change(function () {
        var trang = $("#cboPageNoSPAProduct").val();
        SearchProductSpa(trang);
    });
    
});


function searchPromotion(page) { 
    var PromoID = $("#txt_promoID").val();
    var PromoName = $("#txt_promoName").val();
    var NameProduct = $("#txt_NameProduct").val();
    var BeginTime   = $("#BeginTime_Search").val();
    var EndTime     = $("#EndTime_Search").val();
    curPage = page;
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/goldhour/ajax_get_list",
        dataType:"text",
        data:{  promoID:PromoID,
                promoName:PromoName, 
                ProductName:NameProduct,
                Begin:BeginTime,
                End:EndTime,
                Page:page
              },
        cache:false,
        success:function (data) {
                if( data== "-1" || data==="-1" || data==-1 )
                {
                    alert("Ban Khong Co quyen tren chuc nang nay o trang nay !!! ");                    
                }
                else
                {
                    //alert("Co quyen them moi");
                    searchPromotion_Complete(data);
                }            
          //alert(data);
        }
    });
}

function searchPromotion_Complete(data) {
    var sRes = JSON.parse(data);
   // alert(data);
//    alert(sRes);
    if (sRes != null) {
        $("#divSearchListPromo tbody tr").remove();
        $("#ShowSearchListPromo").tmpl(sRes.lst).appendTo("#divSearchListPromo tbody");
        $("#divResult").show(500);
               
        //phÃ¢n trang
        var totalPage = parseInt(sRes.TotalPage);
        var Curpage = parseInt(sRes.CurPage);
        $("#tbaoTimDc").text("Tìm được " + sRes.TotalRecord + " mẫu tin!!!");
        TrangHienTai = Curpage;
        TongTrang = totalPage;
        $("#cboPageNo option").remove();
        for (var i = 1; i <= totalPage; i++) {
            var sStr = "";
            if (i == TrangHienTai) {
                sStr = "<option value=\"" + i + "\" selected=\"selected\">" + i + "</option>";
            }
            else {
                sStr = "<option value=\"" + i + "\" >" + i + "</option>";
            }
            $("#cboPageNo").append(sStr);
        }
    }
}

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
        url: getUrspal() + "admin/products/searchspa",
        type: "POST",
        data:{spaName: spaName, Page:page},
        cache:false,
        dataType:"text",
        //contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                    SearchSPA_Complete(data);
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

// thêm thông tin khuyến mãi cho cho sản phẩm
function ThemMoiPromotion() {

    var Name = $("#txtPromotionName").val();
    //convert string sang những ký tự đặc biệt
    var NamePromo = convert(Name);
    var Begin = $("#BeginTime").val();
    var To =    $("#EndTime").val();
    var Notes =  CKEDITOR.instances['txtInfo'].getData(); //$("#").val();
    var inbill = $("input:radio[name=send_mail]:checked").val();
    $.ajax({
        type: "POST",
        url: getUrspal() + "admin/promotion/them_moi_promotion",
        dataType: "text",
        data: {
            Name: NamePromo, 
            Begin: Begin,
            To: To,
            Notes: Notes, 
            Inbill: inbill
        },
        cache: false,
        success: function (data) {
            if(data == -1|| data == "-1" || data === -1){
                alert("Bạn không có quyền thực hiện chức năng này trên trang này");
            }
            else{
                 ThemMoiPromotion_Complete(data);
            }
           
            //alert(data);
        }
    });
}

function ThemMoiPromotion_Complete(data) {
    if($.isEmptyObject(data))
    {
        
    }
    else
    {
        var res = JSON.parse(data);
        if (res.PromotionId != "") {
            $(".ThemThanhCong").show(500);
            $(".ThemThatBai").hide(0);
            $("#btnthemPromo").css("display", "none");
            $('.class_ThemThanhCong').show(500);
            $("#txtPromotionID").val(res.PromotionId);
        }
        else {
            $(".ThemThanhCong").hide(500);
            $(".ThemThatBai").show(500);
            $("#btnthemPromo").css("display", "");
        }
    }
    
}


function formatDollar(num) {
    var p = num.toFixed(2).split(".");
    return  p[0].split("").reverse().reduce(function(acc, num, i, orig) {
        return  num + (i && !(i % 3) ? "," : "") + acc;
    }, "") + "." + p[1];
}

$(function () {
     $("input[name='Promotion']").on("change", function () {
         if ($("#RaPromotionDetail").attr("checked")) {
             // mặc định có giá
             $("#HiddenSelected").css("display","");
             // button thêm mới
             $("#p_PromoPro_dis").css("display","");
             // table 
             $("#divShowListProduct").css("display","");
             $("#tr_Percent_Count").css("display","");
             $("#Total_PromotionDetail").css("display","");
         }
         else{
              $("#HiddenSelected").css("display","none");
              $("#p_PromoPro_dis").css("display","none");
              $("#divShowListProduct").css("display","none");
              $("#tr_Percent_Count").css("display","none");
              $("#Total_PromotionDetail").css("display","none");
         }
         
         if ($("#RaPromotion").attr("checked")) {
             $("#p_PromoPro").css("display","");
             $("#p_PromoPro_dis").css("display","none");
             $("#divShowPromoTottal").css("display","");
             $("#HiddenSelected").css("display","none");
             $("#tr_Percent_Count_total").css("display","");
             $("#Total_PromotionTotal").css("display","");
         }
         else{
             $("#p_PromoPro").css("display","none");
             $("#p_PromoPro_dis").css("display","");
             $("#divShowPromoTottal").css("display","none");
             $("#HiddenSelected").css("display","");
             $("#tr_Percent_Count_total").css("display","none");
             $("#Total_PromotionTotal").css("display","none");
         }
         
    });
});

function ThemMoiProductSpaTotal(){
    var PromoID     = $("#txtPromotionID").val();
    var ProductID   = $('#spanProductSpaChon').text();
    var ProductName = $('#spanPrdouctNameChon').text();
    //var percent       = $('#txtPromotionPrice_total').val();
    //var quantity    = $('#txtQuantity_total').val();
    var message = "";
    var vali=true; 
    if(ProductID == ""){
        message =  "Vui lòng nhập mã của sản phẩm";
    }
    
    //if(percent == "" ){
//        message =  "Vui lòng phần trăm khuyến mãi";
//    }
//    else{
//        if(percent < 0){
//          message =  "Phần trăm khuyến mãi không được nhỏ hơn 0";  
//        }
//        if(percent > 100){
//           message =  "Phần trăm khuyến mãi không được lớn hơn 100%";  
//        }
//    }
    
   // if(quantity == ""){
//        message =  "Vui lòng nhập số lượng sản phẩm ";
//    }
  
    if(message != ""){
        vali = false;
    }
    if(vali == false){
        alert(message);
        return;
    }
    if($("#tbShowListProductPromoTotal > tbody").children().length > 0){
         //stt = $("#tbShowListProductPromo > tbody").children().length;
         alert("Chỉ chọn được một sản phẩm duy nhất, vui lòng xóa để chọn sản phẩm khác");
         return;
     }
        
    else{
        
        var str="";
        str = str + "<tr id=\"trPromotionDetailTotal"+ProductID+"\">";
        str = str + "<td>1</td>";
        str = str + "<td><span>"+ProductID+"</span></td>";
        str = str + "<td><span>"+ProductName+"</span></td>";
        str = str + "<td><span>1</span></td>";      
        str = str + "<td><a href=\"javascript:void(0)\" onclick=\"delete_plan_total('"+ProductID + "');\"><img src=\"<?php echo base_url('resources/images/icons/delete.png'); ?>\" title=\"Xóa số lượng\" alt=\"Xóa\" /></a></td>";
        str = str + "</tr>";
        $('#tbShowListProductPromoTotal').css("display","");
        
    }
    
    //kiểm tra id product có tồn tại
    if($("#trPromotionDetailTotal" + ProductID).length > 0)
    {
        $('#divAddmessageSucess').hide(0);
        $('#divAddmessageError').show(500); 
    }
    else{
        stt++;
       $('#tbShowListProductPromoTotal tbody').append(str);
       $('#divAddmessageSucess').show(500);
       $('#divAddmessageError').hide(0);  
    }
    
    $(".SpanNumber").number(true, 0);
    
}

function ThemMoiProductSpa() {
    
    var PromoID         = $("#txtPromotionID").val();
    var ProductID       = $('#spanProductSpaChon').text();
    var ProductName     = $('#spanPrdouctNameChon').text();
    //var ProductPrice = $('#spaProductPrice').text();
    var ProductPrice    = $('#spaProductPrice').text();
    ProductPrice        =  ReplaceAll(ProductPrice,",","");
    var ProPrice        = parseFloat(ProductPrice);
    var price           = $('#txtPromotionPrice').val();
    if(price != 0){
        AmountTotal = ProPrice -((price*ProPrice)/100);
    }
    else{
        AmountTotal = ProPrice;
    }
    var quantity    = $('#txtQuantity').val();
    //var total       = (price*quantity);
    var total       = (AmountTotal*quantity);
    var message = "";
    var vali=true; 
    if(ProductID == ""){
        message =  "Vui lòng nhập mã của sản phẩm";
    }
    
    if(price == "" ){
        message =  "Vui lòng nhập phần trăm khuyến mãi cho sản phẩm ";
    }
    else{
        if(price < 0){
          message =  "Phần trăm khuyến mãi không được nhỏ hơn 0 ";  
        }
        if(price > 100){
           message =  "Phần trăm khuyến mãi không được lớn 100%  ";  
        }
    }
    
    if(quantity == ""){
        message =  "Vui lòng nhập số lượng sản phẩm ";
    }
  
    if(message != ""){
        vali = false;
    }
    if(vali == false){
        alert(message);
        return;
    }
     if($("#tbShowListProductPromo > tbody").children().length > 0){
         //stt = $("#tbShowListProductPromo > tbody").children().length;
         alert("Chỉ chọn được 1 sản phẩm duy nhất, Vui lòng xóa sản phẩm để chọn sản phẩm khác");
         return;
     }
        
    else{
        var str="";
        str = str + "<tr id=\"trPromotionDetail"+ProductID+"\">";
        str = str + "<td>1</td>";
        str = str + "<td><span>"+ProductID+"</span></td>";
        str = str + "<td><span>"+ProductName+"</span></td>";
        str = str + "<td><span class=\"SpanNumber\">"+ AmountTotal+"</span></td>";
        str = str + "<td><span>"+ quantity+"</span></td>";
        str = str + "<td><span class=\"SpanNumber\">"+ total+"</span></td>";       
        str = str + "<td><a href=\"javascript:void(0)\" onclick=\"delete_plan('"+ProductID + "');\"><img src=\"<?php echo base_url('resources/images/icons/delete.png'); ?>\" title=\"Xóa số lượng\" alt=\"Xóa\" /></a></td>"; 
        str = str + "</tr>";
        $('#tbShowListProductPromo').css("display","");
    }
    //kiểm tra id product có tồn tại
    if($("#trPromotionDetail" + ProductID).length > 0)
    {
        $('#divAddmessageSucess').hide(0);
        $('#divAddmessageError').show(500); 
    }
    else{
      
       stt++;
       $('#tbShowListProductPromo tbody').append(str);
       $('#divAddmessageSucess').show(500);
       $('#divAddmessageError').hide(0);  
    }
    
    $(".SpanNumber").number(true, 0);
    
}
function sub_product(id){

    var quantity = $("#trPromotionDetail" + id + " td:eq(4) span").text();
    var price = $("#trPromotionDetail" + id + " td:eq(3) span").text();
    price      = ReplaceAll(price,",","");
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
    $(".SpanNumber").number(true, 0);
    
    
}
function add_product(id){
    var quantity = $("#trPromotionDetail" + id + " td:eq(4) span").text();
    var price = $("#trPromotionDetail" + id + " td:eq(3) span").text();
    price      = ReplaceAll(price,",","");
    quantity = parseInt(quantity)+1;
    var totalAmount = (quantity*price);
    $("#trPromotionDetail" + id + " td:eq(4) span").text(quantity);
    $("#trPromotionDetail" + id + " td:eq(5) span").text(totalAmount);
    $(".SpanNumber").number(true, 0);
}

function subproduct_total(id){

    var quantity = $("#trPromotionDetailTotal" + id + " td:eq(3) span").text();
    if(quantity == 1){
        alert("Không được giảm số lượng dưới 1");
    }
    else
    quantity = quantity - 1;
    $("#trPromotionDetailTotal" + id + " td:eq(3) span").text(quantity);

}
function addproduct_total(id){
    var quantity = $("#trPromotionDetailTotal" + id + " td:eq(3) span").text();
    quantity = parseInt(quantity) + 1;
    $("#trPromotionDetailTotal" + id + " td:eq(3) span").text(quantity);
}


function LuuCapNhatPromo() {
    //var tong = parseInt($("#spanSoCTPNSua").text());
    var tong = $('table#tbShowListProductPromo tbody tr:last').index() + 1;
    if (tong > 0) {
        var list = [];
        var i = 0;
        while (i < tong) {
            var promodetail = {};
            promodetail.PromoId = $("#txtPromotionID").val();
            promodetail.ProId = $("#tbShowListProductPromo tbody tr:eq(" + i + ") td:eq(1) span").text();
            promodetail.DG = $("#tbShowListProductPromo tbody tr:eq(" + i + ") td:eq(3) span").text();
            promodetail.SL = $("#tbShowListProductPromo tbody tr:eq(" + i + ") td:eq(4) span").text();
            promodetail.TT = $("#tbShowListProductPromo tbody tr:eq(" + i + ") td:eq(5) span").text();
            list[i] = promodetail;
            i = i + 1;
        }
        $.ajax({
            url: getUrspal() + "admin/promotion/capnhat_promotiondetail",
            type: "POST",
            data: {promotiondetal: JSON.stringify(list)  },
            dataType: "json",
            //contentType: "application/json; charset=utf-8",
            success: function (data) {
                 if( data== "-1" || data==="-1" || data==-1 )
                {
                    alert("Ban Khong Co quyen tren chuc nang nay o trang nay !!! ");                    
                }
                else
                {
                     UpdatePromontionDetail_Complete(data); 
                }
            },
            error: function () { alert("Cập nhật CT KM không thành công!!"); }
        });
    }
    else {
        alert("Đã xóa KM !");
    }
}


function LuuCapNhatPromoTotal(){
    var PromoID           = $("#txtPromotionID").val();
    var  totalPromo       = $("#totalPromotion").val();
    totalPromo            = ReplaceAll(totalPromo,",","");
    totalPromo            = parseFloat(totalPromo);
    var BeTime = $('#beginhours').val();
    var EnTime = $('#endhours').val();
    //var percent = $('#txtPromotionPrice_total').val();
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
    if(totalPromo == 0){
      magage = "Vui lòng nhập tổng tiền cho khuyến mãi ";  
      vali = false;
    }
    if(BeTime != ""){
        if(BeTime < currenttime){
           magage = "Thời gian bắt đầu khuyến mãi không được nhỏ hơn thời gian hiện tại ";
           vali = false; 
        }
    }
    else{
        magage = "Vui lòng nhập giờ phút ";
        vali = false;  
    }
    
   
    if(EnTime != ""){
        if(EnTime < currenttime){
           magage = "Thời gian kết thúc khuyến mãi không được nhỏ hơn thời gian hiện tại ";
           vali = false; 
        }
        if(EnTime < BeTime){
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
        var list_promo = {};
        list_promo.Name =  $("#txtPromotionName").val();
        list_promo.Begin = $("#BeginTime").val();
        list_promo.To    = $("#EndTime").val();
        list_promo.BeginTime = BeTime;
        list_promo.EndTime   = EnTime;
        list_promo.Notes = CKEDITOR.instances['txtInfo'].getData();
        list_promo.inbill =  $("input:radio[name=send_mail]:checked").val();
        var tong = $('table#tbShowListProductPromoTotal tbody tr:last').index() + 1;
        if (tong > 0) {
            // danh cho show giá tổng cho khuyến mãi
                var promodetail = {};
                promodetail.PromoId = $("#txtPromotionID").val();
                promodetail.ProId   = $("#tbShowListProductPromoTotal tbody tr td:eq(1) span").text();
                promodetail.SL      = 1;
                var soluong         = $("#tbShowListProductPromoTotal tbody tr    td:eq(3) span").text();
                var TT = totalPromo;        
                 $.ajax({
                    url: getUrspal() + "admin/goldhour/capnhat_promotiontotal",
                    type: "POST",
                    data: {
                            PromoID:PromoID,
                            Total: TT,
                            promotiontotal: JSON.stringify(promodetail),
                            promotion:      JSON.stringify(list_promo)
                           },
                    dataType: "json",
                    //contentType: "application/json; charset=utf-8",
                    success: function (data) {
                         if( data== "-1" || data==="-1" || data==-1 )
                        {
                            alert("Ban Khong Co quyen tren chuc nang nay o trang nay !!! ");                    
                        }
                        else
                        {
                             UpdatePromontion_Complete(data); 
                        }
                    },
                    error: function () { alert("Cập nhật CT KM không thành công!!"); }
                });
         
           
        }
        else {
            alert("Đã xóa danh sách sản phẩm khuyến mãi!");
        }
    }
    
}

function UpdatePromontion_Complete(data) {
      var res = data;
      if (res.PromotionId.length > 2) {// insert thanh cong      
          $("#txtPromotionID").val(res.PromotionId);
          $('#divmessageSucess_total').show(500);
          $('#divmessageError_total').hide(0);
          $('#UploadHinhAnh').css("display","");
          
      }
      else{
          if(res.PromotionId == 1 || res.PromotionId =="1") // cap nhat thanh cong
          {
              //$("#txtPromotionID").val(res.PromotionId);
              $('#divmessageSucess_total').show(500);
              $('#divmessageError_total').hide(0);
              $('#UploadHinhAnh').css("display","");
          }
          else
          {
              $('#divmessageSucess_total').show(0);
              $('#divmessageError_total').show(500);
          }
      } 
   
}

/*function LuuCapNhatPromo1() {
    var PromoID = $("#txtPromotionID").val();
    var list_promo = {};
        list_promo.Name = $("#txtPromotionName").val();
        list_promo.Begin = $("#BeginTime").val();
        list_promo.To    = $("#EndTime").val();
        list_promo.BeginTime = $('#beginhours').val();
        list_promo.EndTime  = $('#endhours').val();
        list_promo.Notes = CKEDITOR.instances['txtInfo'].getData();
        list_promo.inbill =  $("input:radio[name=send_mail]:checked").val();
    var tong = $('table#tbShowListProductPromo tbody tr:last').index() + 1;
    if (tong > 0) {
        var list = [];
        var i = 0;
        while (i < tong) {
            var promodetail = {};
            promodetail.PromoId = $("#txtPromotionID").val();
            promodetail.ProId = $("#tbShowListProductPromo tbody tr:eq(" + i + ") td:eq(1) span").text();
            promodetail.DG = $("#tbShowListProductPromo tbody tr:eq(" + i + ") td:eq(3) span").text();
            promodetail.SL = $("#tbShowListProductPromo tbody tr:eq(" + i + ") td:eq(4) span").text();
            promodetail.TT = $("#tbShowListProductPromo tbody tr:eq(" + i + ") td:eq(5) span").text();
            list[i] = promodetail;
            i = i + 1;
        }
        $.ajax({
            url: getUrspal() + "admin/goldhour/capnhat_promotiondetail1",
            type: "POST",
            data: {
                    PromoID:PromoID,
                    promotiondetal: JSON.stringify(list),
                    promotion:      JSON.stringify(list_promo)
                   },
            dataType: "json",
            //contentType: "application/json; charset=utf-8",
            success: function (data) {
                 if( data== "-1" || data==="-1" || data==-1 )
                {
                    alert("Ban Khong Co quyen tren chuc nang nay o trang nay !!! ");                    
                }
                else
                {
                     UpdatePromontionDetail_Complete(data); 
                }
            },
            error: function () { alert("Cập nhật CT KM không thành công!!"); }
        });
    }
    else {
        alert("Đã xóa danh sách sản phẩm khuyến mãi!");
    }
}*/

function LuuCapNhatPromo1() {
    var PromoID = $("#txtPromotionID").val();
    var BeTime = $('#beginhours').val();
    var EnTime = $('#endhours').val();
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
    if(BeTime != ""){
        if(BeTime < currenttime){
           magage = "Thời gian bắt đầu khuyến mãi không được nhỏ hơn thời gian hiện tại ";
           vali = false; 
        }
    }
    else{
        magage = "Vui lòng nhập giờ phút ";
        vali = false;  
    }
    
    if(EnTime != ""){
        if(EnTime < currenttime){
           magage = "Thời gian bắt đầu khuyến mãi không được nhỏ hơn thời gian hiện tại ";
           vali = false; 
        }
        if(EnTime < BeTime){
           magage = "Thời gian kết thúc khuyến mãi không được nhỏ hơn thời gian hiện tại ";
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
            var list_promo = {};
                list_promo.Name = $("#txtPromotionName").val();
                list_promo.Begin = $("#BeginTime").val();
                list_promo.To    = $("#EndTime").val();
                list_promo.BeginTime = $('#beginhours').val();
                list_promo.EndTime  = $('#endhours').val();
                list_promo.Notes = CKEDITOR.instances['txtInfo'].getData();
                list_promo.inbill =  $("input:radio[name=send_mail]:checked").val();
            var tong = $('table#tbShowListProductPromo tbody tr:last').index() + 1;
            if (tong > 0) {
                
                    var promodetail = {};
                    promodetail.PromoId = $("#txtPromotionID").val();
                    promodetail.ProId = $("#tbShowListProductPromo tbody tr td:eq(1) span").text();
                    var dongia = $("#tbShowListProductPromo tbody tr  td:eq(3) span").text();
                    dongia       = ReplaceAll(dongia,",","");
                    promodetail.DG = parseFloat(dongia);
                    promodetail.SL = $("#tbShowListProductPromo tbody tr  td:eq(4) span").text();
                    var thanhtien = $("#tbShowListProductPromo tbody tr  td:eq(5) span").text();
                    thanhtien       = ReplaceAll(thanhtien,",","");
                    promodetail.TT = parseFloat(thanhtien);
                $.ajax({
                    url: getUrspal() + "admin/goldhour/capnhat_promotiondetail1",
                    type: "POST",
                    data: {
                            PromoID:PromoID,
                            promotiondetal: JSON.stringify(promodetail),
                            promotion:      JSON.stringify(list_promo)
                           },
                    dataType: "json",
                    //contentType: "application/json; charset=utf-8",
                    success: function (data) {
                         if( data== "-1" || data==="-1" || data==-1 )
                        {
                            alert("Ban Khong Co quyen tren chuc nang nay o trang nay !!! ");                    
                        }
                        else
                        {
                             UpdatePromontionDetail_Complete(data); 
                        }
                    },
                    error: function () { alert("Cập nhật CT KM không thành công!!"); }
                });
            }
            else {
                alert("Đã xóa danh sách sản phẩm khuyến mãi!");
            }
    }
}

function UpdatePromontionDetail_Complete(data) {
      var res = data;
      if (res.PromotionId.length > 2) {// insert thanh cong      
          $("#txtPromotionID").val(res.PromotionId);
          $('#divmessageSucess').show(500);
          $('#divmessageError').hide(0);
          $('#UploadHinhAnh').css("display","");
          
      }
      else{
          if(res.PromotionId == 1 || res.PromotionId =="1") // cap nhat thanh cong
          {
              //$("#txtPromotionID").val(res.PromotionId);
              $('#divmessageSucess').show(500);
              $('#divmessageError').hide(0);
              $('#UploadHinhAnh').css("display","");
          }
          else
          {
              $('#divmessageSucess').show(0);
              $('#divmessageError').show(500);
          }
      } 
   
}

function delete_plan(id){
    $("#trPromotionDetail" + id).remove();  
}


function ThemMoiProductSpa_Complete(data) {
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
        url:getUrspal() + "admin/goldhour/gethinhpromotion",
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
            str = str + "<img src=\"/nhaplieuspa/" + sRes[i].URL + "\" width=\"180\"/>";
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

// chọn spa cũ rồi  ngày 3/1/2015
//function ChonSpaTab2(id) {  
//    $("#spanSpaChonTab2").text(id);
//    name = $("#trSPA" + id + " td:eq(2) span").html();
//    $("#spanSpaNameChonTab2").text(name);
//    $("#divSearchSpaTab2").dialog("close");
//    $("#tdChooseProductSpa").show(500);
//    $("#spanSpaChonTab2").css("display","");
//    $("#spanSpaNameChonTab2").css("display","");
//    $('#choose_spa').css("display","none");
//    $("#ChooseSProduct").css("display","");
//       
//}

// chọn spa mới hơn ngày 3/1/2015

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
          $("#spaProductPrice").text("");
          
    }
    curSpa = id;
       
}

function ChonSpaProduct(id) {
    $("#spanProductSpaChon").text(id);
    name = $("#trProductID" + id + " td:eq(2) span").html();
    $("#spanPrdouctNameChon").text(name);
    $("#divsearchProductSpa").dialog("close");
    $("#tdChooseProductSpa").show(500);
    LoadPriceNew(id);
    //$("#ChooseSProduct").css("display","none"); vẫn cho hiển thị nút chọn product ngày 3/1/2015
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
             if($("#RaPromotionDetail").attr('checked')){
                $("#spaProductPrice").text(data.ProID);
                $(".SpanNumber").number(true, 0);
                $("#spaProductPrice").number(true, 0);
               $("#HiddenSelected").css("display","");
              }
              else{
                   $("#HiddenSelected").css("display","none");
              }
              $("#RaPromotionDetail").click(function(event){
                $("#spaProductPrice").text(data.ProID);
                $(".SpanNumber").number(true, 0);
                $("#spaProductPrice").number(true, 0);
               $("#HiddenSelected").css("display","");
              });
              
              $("#RaPromotion").click(function(event){
                 $("#HiddenSelected").css("display","none");
            });    
            
        }
        
    }
}

function ChonSpaThemMoi() {
    $("#divSearchSpaTab2").dialog({
        height: 600,
        width: 800,
        modal: true
    });
}

// start product ngày 27/11/2014 
function ChonSpaProductThemMoi(){
     $("#divsearchProductSpa").dialog({
        height: 600,
        width: 800,
        modal: true
    });
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
                    if(data==-1|| data===-1||data=="-1")
                    {
                        arter("Bạn không có quyền thực hiện quyền này trên trang này");
                    }
                    else{
                        SearchProductSpa_Complete(data);
                    }
                    
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

// end date 27/11/2014
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

function ChonProductSpaTab2(id) {
    $("#spanProductSpaChonTab2").text(id);
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
            url:getUrspal() + "admin/products/searchspatheoID",
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


function DeletePromo(id) {
    var strconfirm = confirm("Bạn có chắc chắn xóa không?");
    if (strconfirm == true) {
        $.ajax({
            url: getUrspal() + "admin/goldhour/xoapromotions",
            type: "POST",
            data: { PromoID: id },
            cache: false,
            dataType: "text",
            //contentType: "application/json; charset=utf-8",
            success:
                    function (data) {
                     if(data==-1|| data===-1||data=="-1")
                     {
                        arter("Bạn không có quyền thực hiện quyền này trên trang này");
                     }
                     else{
                         DeletePromo_Complete(data);
                     }
                        

                    },
            error: function () {
            }
        });
    }
}

function DeletePromo_Complete(data) {
    var res = JSON.parse(data);
    if (res.Result == "1" || res.Result == 1) {
        searchPromotion(curPage);
    }
}

function ResetThemMoi() {
    $("#txtProductIDTab2").val("");
    $("#txtNameTab2").val("");
    $("#spanSpaChonTab2").text("");
    $("#spanSpaNameChonTab2").text("");

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

}

function Reset(){
    $("#txt_promoID").val("");
    $("#txt_promoName").val("");
    $("#BeginTime_Search").val("");
    $("#EndTime_Search").val("");
    $("#txt_NameProduct").val("");
}

function ResetThemPromotion(){
    $("#txtPromotionID").val("");
    $("#txtPromotionName").val("");
    $("#beginhours").val("");
    $("#endhours").val("");
    CKEDITOR.instances['txtInfo'].setData("");
    $("#choose_spa").css("display","");
    $("#spanSpaChonTab2").css("display","none");
    $("#spanSpaNameChonTab2").css("display","none");
    $("#ChooseSProduct").css("display","none");
    $("#tdChooseProductSpa").css("display","none");
    $("#txtPromotionPrice").val("");
    //$("#txtQuantity").val("");
    $("#txtPromotionPrice_total").val();
    //$("#txtQuantity_total").val();
    $("#tbShowListProductPromo tbody tr").remove();
    //tbShowListProductPromoTotal
    $("#tbShowListProductPromoTotal tbody tr").remove();
    $("#txtPromotionPrice_total").val("");
    $("#totalPromotion").val("");
    $("#RaPromotion").removeAttr("checked");
    $("#RaPromotionDetail").attr("checked", "checked");
    $("#UploadHinhAnh").css("display","none");
    $("#divAddmessageSucess").css("display","none");
    $('#divmessageSucess_total').css("display","none");
    $('#divmessageSucess').css("display","none");
}

function delete_plan_total(id){
    $("#trPromotionDetailTotal" + id).remove();  
} 