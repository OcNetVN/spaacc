/*
|----------------------------------------------------------------
| call funciton from common_function.js
| function check email
| function ForceNumericOnly
|----------------------------------------------------------------
*/
$(document).ready(function() { 
    $("#txtPromotionID").number(true, 0);
    $("#Add_Quantity_promotion").number(true, 0);
    $("#Add_TotalAmount_promotion").number(true, 0);

    $("#phuongthucdanhsach").click(function () {
        $("#keyword").val('');
        $("#spaid").val();
        searchPromotion(1);
    });
    $("#new_promotion").click(function () {
        $("#panelThem").show(500);
        $("#notify_product_time_add").hide(500);
        $("#notify_name_add").hide(500);
        $("#notify_loai_add").hide(500);
        $("#notify_sochotoida_add").hide(500);
        $("#notify_gia_add").hide(500);
        $("#notify_time_batdau_add").hide(500);
        $("#notify_time_ketthuc_add").hide(500);
        $("#notify_time_ktbd_add").hide(500);
        $("#notifyerr_thongtin_add").hide(500);
        $("#notifysuccess_thongtin_add").hide(500);

        $("#btn_add_thongtin").show(500);

        $("#divTBKQTim_Search").hide(500);
        $("#panelDataPRO_Search").hide(500);
        $("#cboPageNoPRO_Search").hide(500);

        $("#divTBKQTim").hide(500);
        $("#panelDataPRO").hide(500);
        $("#cboPageNoPRO").hide(500);
        $("#panelDataPRO").hide(500);



        $("#Add_PromotionName_promotion").val("");
        $("#check_PromotionType").val("");

        $("#Add_Quantity_promotion").val("");
        $("#Add_TotalAmount_promotion").val("");
        $("#Add_BeginDateTime_promotion").val("");
        $("#Add_EndDateTime_promotion").val("");


        CKEDITOR.instances['Add_PromoText_promotion'].setData("");
        $('#chon_sanpham').children().remove(); 
        get_products_by_spa();

    });
    $("#cboPageNoPRO").change(function () {
        var trang = $("#cboPageNoPRO").val();
        searchPromotion(trang);
    });
    $("#cboPageNoPRO_Search").change(function () {
        var trang = $("#cboPageNoPRO_Search").val();
        search_nangcao_Promotion(trang);
        // search_nangcao_Promotion(trang);
    });
    $("#submit_timkiemnangcao").click(function () {
        $("#txtPromotionID").val();
        $("#txtName").val();
        $("#cboPromotionType").val();
        $("#spaid").val();
        if($("#spaid").val()== ''){
            alert('Không thể tìm kiếm');
            return;
        }
        search_nangcao_Promotion(1);
    });
    $("#submit_reset").click(function () {
        $("#txtPromotionID").val("");
        $("#txtName").val("");
        $("#cboPromotionType").val("");
    });
    
    


});

/*
|----------------------------------------------------------------
| function searchPromotion
|----------------------------------------------------------------
*/
function searchPromotion(page) {    

    $("#panelThem").hide(500);
    // $("#panelDataPRO2").hide(500);


    $("#divTBKQTim_Search").hide(500);
    $("#panelDataPRO_Search").hide(500);
    $("#cboPageNoPRO_Search").hide(500);
    $("#panelDataPRO_Search").hide(500);


    $("#divTBKQTim").show(500);
    $("#panelDataPRO").show(500);
    $("#cboPageNoPRO").show(500);
    // $("#searching").show(500);



    var keyword = $("#keyword").val();
    var spaid = $("#spaid").val();
    curPage = page;   

    $.ajax({
        type:"POST",
        url: "home_controller/list_promotions",
        dataType:"text",
        data: {
            spaid: spaid,
            keyword: keyword,
            Page:page
        },
        cache:false,
        success:function (data) {
            // if( data== "-1" || data==="-1" || data==-1 )
            // {
            //     alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            // }
            // else
            // {
                // console.log(data);
                searchPromotion_Complete(data);
            // }
          //alert(data);
        }
    });
}

function searchPromotion_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
        if(sRes.TotalRecord !=0)
        {
            $("#divTBKQTim").show(500);
            var node = document.getElementById("notifysuccess");
            $('#notifysuccess').children().remove();           
            $("#notifysuccess").append("<span class='success_bg'>Tìm được "+sRes.TotalRecord+" mẫu tin!</span>");



            $("#panelDataPRO").show(500);
             
            $("#panelDataPRO tbody tr").remove();
            $("#ListFoundPRO").tmpl(sRes.lst).appendTo("#panelDataPRO tbody");
            // $("#panelDataPRO").show(500);
            // console.log(sRes.lst[0].DS_Products[0].Name);
            // console.log(sRes.lst.length);
            for (var i = 0; i<sRes.lst.length; i++) {
                var str="";

                for (var j = 0; j<sRes.lst[i].DS_Products.length; j++) {
                    str+= "<b>"+sRes.lst[i].DS_Products[j].ProductID+"</b> - "+sRes.lst[i].DS_Products[j].Name+"<br/><br/>";
                }
                $("#Ma_Promotion_"+sRes.lst[i].PromotionId).append(str);
                

                var time_now = js_yyyy_mm_dd_hh_mm_ss();
                var time_end = sRes.lst[i].EndDateTime;
                var hoatdong= "<b class='ngunghoatdong'>Ngưng hoạt động</b>";
                if(time_now <= time_end ){
                    hoatdong= "<b class='hoatdong'>Đang hoạt động</b>";
                }
                $("#Hoatdong_"+sRes.lst[i].PromotionId).append(hoatdong);
            }

                   
            //phÃ¢n trang
            var totalPage = parseInt(sRes.TotalPage);
            var Curpage = parseInt(sRes.CurPage);
            // $("#divTBKQTim div").text("Tìm được " + sRes.TotalRecord + " mẫu tin!!!");
            // $("#divTBKQTim").show(500);
            var TrangHienTai = Curpage;
            var TongTrang = totalPage;
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
            $("#panelDataPRO tbody tr").remove();
            $("#panelDataPRO").hide(500);

            $("#divTBKQTim").show(500);
            var node = document.getElementById("notifysuccess");
            $('#notifysuccess').children().remove();           
            $("#notifysuccess").append("<span class='error_bg'>Không tìm thấy mẫu tin!</span>");

           
        }
    }
}




/*
|----------------------------------------------------------------
| function search_nangcao_Promotion
|----------------------------------------------------------------
*/
function search_nangcao_Promotion(page) {    

    $("#panelThem").hide(500);
    $("#panelDataPRO2").hide(500);


    $("#divTBKQTim_Search").show(500);
    $("#panelDataPRO_Search").show(500);
    $("#cboPageNoPRO_Search").show(500);
    // $("#searching").show(500);


    var txtPromotionID = $("#txtPromotionID").val();
    var txtName = $("#txtName").val();
    var cboPromotionType = $("#cboPromotionType").val();
    var spaid = $("#spaid").val();
    curPage = page;   

        // alert("ok");
    $.ajax({
        type:"POST",
        url: "home_controller/search_nangcao_Promotions",
        dataType:"text",
        data: {
            spaid: spaid,
            PromotionId: txtPromotionID,
            PromotionName: txtName,
            PromotionType: cboPromotionType,
            Page:page
        },
        cache:false,
        success:function (data) {
            // if( data== "-1" || data==="-1" || data==-1 )
            // {
            //     alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            // }
            // else
            // {
                // console.log(data);
                search_nangcao_Promotion_Complete(data);
            // }
          //alert(data);
        }
    });
}


function search_nangcao_Promotion_Complete(data) {
    var sRes = JSON.parse(data);
    // console.log(sRes);
    if (sRes != null) {
        if(sRes.TotalRecord !=0)
        {
            $("#divTBKQTim_Search").show(500);
            var node = document.getElementById("notifysuccess_Search");
            $('#notifysuccess_Search').children().remove();           
            $("#notifysuccess_Search").append("<span class='success_bg'>Tìm được "+sRes.TotalRecord+" mẫu tin!</span>");


            $("#panelDataPRO_Search").show(500);



            $("#panelDataPRO").hide(500);
            $("#cboPageNoPRO").hide(500);
            $("#divTBKQTim").hide(500);

            $("#panelDataPRO_Search tbody tr").remove();
            $("#ListFoundPRO_Search").tmpl(sRes.lst).appendTo("#panelDataPRO_Search tbody");
            // $("#panelDataPRO").show(500);
            for (var i = 0; i<sRes.lst.length; i++) {
                var str="";

                for (var j = 0; j<sRes.lst[i].DS_Products.length; j++) {
                    str+= "<b>"+sRes.lst[i].DS_Products[j].ProductID+"</b> - "+sRes.lst[i].DS_Products[j].Name+"<br/><br/>";
                }
                $("#Ma_Promotion_Search_"+sRes.lst[i].PromotionId).append(str);
                

                var time_now = js_yyyy_mm_dd_hh_mm_ss();
                var time_end = sRes.lst[i].EndDateTime;
                var hoatdong= "<b class='ngunghoatdong'>Ngưng hoạt động</b>";
                if(time_now <= time_end ){
                    hoatdong= "<b class='hoatdong'>Đang hoạt động</b>";
                }
                $("#Hoatdong_Search_"+sRes.lst[i].PromotionId).append(hoatdong);
            }
                   
            //phÃ¢n trang
            var totalPage = parseInt(sRes.TotalPage);
            var Curpage = parseInt(sRes.CurPage);
            // $("#divTBKQTim div").text("Tìm được " + sRes.TotalRecord + " mẫu tin!!!");
            // $("#divTBKQTim").show(500);
            var TrangHienTai = Curpage;
            var TongTrang = totalPage;
            $("#cboPageNoPRO_Search option").remove();
            for (var i = 1; i <= totalPage; i++) {
                var sStr = "";
                if (i == TrangHienTai) {
                    sStr = "<option value=\"" + i + "\" selected=\"selected\">" + i + "</option>";
                }
                else {
                    sStr = "<option value=\"" + i + "\" >" + i + "</option>";
                }
                $("#cboPageNoPRO_Search").append(sStr);
            }
        }
        else
        {
            $("#panelDataPRO_Search tbody tr").remove();
            $("#panelDataPRO_Search").hide(500);

            $("#divTBKQTim_Search").show(500);
            var node = document.getElementById("notifysuccess_Search");
            $('#notifysuccess_Search').children().remove();           
            $("#notifysuccess_Search").append("<span class='error_bg'>Không tìm thấy mẫu tin!</span>");

           
        }
    }
}

/*
|----------------------------------------------------------------
| function get_products_by_spa
|----------------------------------------------------------------
*/
function get_products_by_spa(){
    var spaid = $("#spaid").val();
    $.ajax({
        type:"POST",
        url: "home_controller/get_products_by_spa",
        dataType:"text",
        data: {
            spaid: spaid
        },
        cache:false,
        success:function (data) {
            // if( data== "-1" || data==="-1" || data==-1 )
            // {
            //     alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            // }
            // else
            // {
                // console.log(data);
                get_products_by_spa_Complete(data);
            // }
          //alert(data);
        }
    });
}

function get_products_by_spa_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes.lst.length!=0){
        var str="<ul class='col-sm-12' style='padding:0px;'>";
        for (var i = 0; i <sRes.lst.length; i++) {
                str+="<li class='list-group-item'>";
                str+="<input type='checkbox' name='check_product'  value="+sRes.lst[i].ProductID+"> ";
                str+=sRes.lst[i].Name;
                str+="<b style='float: right;'>"+sRes.lst[i].Giahientai+" VND</b>";
                str+="</li>";
        }
        str+="</ul>";
        $('#chon_sanpham').children().remove();           
        $("#chon_sanpham").append(str);
    }
    else{
        $("#panelThem").hide(500);
        alert("Vui lòng thêm dịch vụ & sản phẩm \n\n Để tạo khuyến mãi");
    }

}




function submit_add_promotion()
{
    $("#notify_name_add").hide(100);
    $("#notify_sochotoida_add").hide(100);
    $("#notify_time_batdau_add").hide(100);
    $("#notify_time_ketthuc_add").hide(100);
    $("#notify_time_ktbd_add").hide(100);
    $("#notify_loai_add").hide(100);
    $("#notify_gia_add").hide(100);
    $("#notifyerr_thongtin_add").hide(100);
    $("#notify_over_add").hide(100);



    var PromotionName = $("#Add_PromotionName_promotion").val();
    var Quantity = $("#Add_Quantity_promotion").val();
    var BeginDateTime = $("#Add_BeginDateTime_promotion").val();
    var EndDateTime = $("#Add_EndDateTime_promotion").val();
    var PromoText = CKEDITOR.instances['Add_PromoText_promotion'].getData(); 
    var TotalAmount = $("#Add_TotalAmount_promotion").val();

    var Product_check               =   [];
    $('input:checkbox[name=check_product]:checked').each(function(){
        var rowutil             =   $(this).val();
        Product_check.push(rowutil);
    });


    var flag = 0;
    if(PromotionName ==""){
        $("#notify_name_add").show(500);
        $("#Add_PromotionName_promotion" ).focus();
        flag = 1;
    }
    if(Quantity =="" || isNaN(Quantity) || Quantity ==0){
        $("#notify_sochotoida_add").show(500);
        $("#Add_Quantity_promotion" ).focus();
        flag = 1;
    }
    if(BeginDateTime ==""){
        $("#notify_time_batdau_add").show(500);
        flag = 1;
    }
    var check = 0;
    if(EndDateTime ==""){
        $("#notify_time_ketthuc_add").show(500);
        flag = 1;
        check = 1;
    }


    // var TimeFrom = parseDate(BeginDateTime).getTime();
    // var TimeTo = parseDate(EndDateTime).getTime();

    if(BeginDateTime > EndDateTime && check == 0){
        $("#notify_time_ketthuc_add").hide(500);
        $("#notify_time_ktbd_add").show(500);
        flag = 1;
    }
    if(Product_check.length==0){
        $("#notify_loai_add").show(500);
        flag = 1;
    }
    if(TotalAmount =="" || TotalAmount == 0){
        $("#notify_gia_add").show(500);
        $("#Add_TotalAmount_promotion" ).focus();
        flag = 1;
    }


    if(flag == 1)
    {
         $("#notifyerr_thongtin_add").show(500);
         return;
    }
    $.ajax({
        type:"POST",
        url:"home_controller/submit_add_promotion",
        dataType:"text",
        data: {
            PromotionName : PromotionName,
            Quantity : Quantity,
            BeginDateTime : BeginDateTime,
            EndDateTime : EndDateTime,
            Product_check : Product_check,
            TotalAmount : TotalAmount,
            PromoText : PromoText
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
                submit_add_promotion_Complete(data);
            // }
          //alert(data);
        },
        
    });
}
function submit_add_promotion_Complete(data)
{
    var sRes = JSON.parse(data);
    console.log(sRes.result);
    // return;
    if(sRes.result==true || sRes.result=="true"){

        $("#notifyerr_thongtin_add").hide(500);
        $("#notify_over_add").hide(500);
        $("#notifysuccess_thongtin_add").show(500);

        $("#btn_add_thongtin").hide(500);

        // document.getElementById('PromotionID_result').setAttribute("value",sRes.ProductID);
        setTimeout(function(){
          $("#notifysuccess_thongtin_add").hide(500);
          searchPromotion(1);
        }, 5000);
        return;
    }
    if(sRes.result=="over"){

        $("#notify_over_add").show(500);
        $("#notifyerr_thongtin_add").show(500);
        return;
    }
    else{
        $("#notifyerr_thongtin_add").show(500);
        
    }

}














// function doUpload1(url) {
//     var ProID = $("#Ma_Product").val();
//     if (ProID == "") {
//         return false;
//     } else {
//         return doUpload(url + "/"+ ProID);
//     }
// }



function js_yyyy_mm_dd_hh_mm_ss () {
  now = new Date();
  year = "" + now.getFullYear();
  month = "" + (now.getMonth() + 1); if (month.length == 1) { month = "0" + month; }
  day = "" + now.getDate(); if (day.length == 1) { day = "0" + day; }
  hour = "" + now.getHours(); if (hour.length == 1) { hour = "0" + hour; }
  minute = "" + now.getMinutes(); if (minute.length == 1) { minute = "0" + minute; }
  second = "" + now.getSeconds(); if (second.length == 1) { second = "0" + second; }
  return year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
}
























































