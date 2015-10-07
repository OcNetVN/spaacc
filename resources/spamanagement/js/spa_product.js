/*
|----------------------------------------------------------------
| call funciton from common_function.js
| function check email
| function ForceNumericOnly
|----------------------------------------------------------------
*/
$(document).ready(function() { 
    // $("#searching").show(500);  
     getUrl_upload();
    $("#Gia_Them").number(true, 0);
    $("#Gia_hientai").number(true, 0);
    $("#txtProductID").number(true, 0);

    $("#Edit_CurrentVouchers_product").number(true, 0);
    $("#Edit_MaxProductatOnce_product").number(true, 0);
    $("#Edit_Duration_product").number(true, 0);

    $("#Add_CurrentVouchers_product").number(true, 0);
    $("#Add_MaxProductatOnce_product").number(true, 0);
    $("#Add_Duration_product").number(true, 0);
    $("#Add_Price_product").number(true, 0);



    GetProductType_Spa();

    $("#phuongthucdanhsach").click(function () {
        $("#keyword").val('');
        $("#spaid").val();
        searchProducts(1);
    });
    $("#new_product").click(function () {

        $("#notify_product_time_add").hide(500);
        $("#panelDataPRO2").hide(500);

        $("#notify_name_add").hide(500);
        $("#notify_loai_add").hide(500);
        $("#notify_socho_add").hide(500);
        $("#notify_sochotoida_add").hide(500);
        $("#notify_thoiluong_add").hide(500);
        $("#notify_gia_add").hide(500);
        $("#notify_time_batdau_add").hide(500);
        $("#notify_time_ketthuc_add").hide(500);
        $("#notify_time_ktbd_add").hide(500);
        $("#notifyerr_thongtin_add").hide(500);
        $("#notifysuccess_thongtin_add").hide(500);
        $("#notifysuccess_time_add").hide(500);

        $("#btn_add_thongtin").show(500);
        $("#btn_add_time").show(500);
        document.getElementById('ProductID_result').setAttribute("value","");



        $("#divTBKQTim_Search").hide(500);
        $("#panelDataPRO_Search").hide(500);
        $("#cboPageNoPRO_Search").hide(500);
        $("#panelDataPRO_Search").hide(500);

        $("#divTBKQTim").hide(500);
        $("#panelDataPRO").hide(500);
        $("#cboPageNoPRO").hide(500);
        $("#panelDataPRO").hide(500);

        $("#panelThem").show(500);


        $("#Add_Name_product").val("");
        $("#cboProductType_Add").val("");
        $("#Add_CurrentVouchers_product").val("");

        $("#Add_MaxProductatOnce_product").val("");
        $("#Add_Duration_product").val("");
        $("#Add_Price_product").val("");
        $("#Add_ValidTimeFrom_product").val("");
        $("#Add_ValidTimeTo_product").val("");


        CKEDITOR.instances['Add_Des_product'].setData("");
        CKEDITOR.instances['Add_Policy_product'].setData("");
        CKEDITOR.instances['Add_Restriction_product'].setData("");
        CKEDITOR.instances['Add_Tips_product'].setData("");


        /// time
        var arr_dayofweek          =   {
                                        2   :  "Monday",
                                        3   :  "Tuesday",
                                        4   :  "Wednesday",
                                        5   :  "Thursday",
                                        6   :  "Friday",
                                        7   :  "Saturday",
                                        8   :  "Sunday",
                                        9   :  "Holidays",
                                        };
        // console.log(arr_dayofweek[2]);
        // 
        var str_time = "<ul class='col-sm-12 week'>";
        // var str_check="";
        for (var i = 2; i < 10; i++) {
            // console.log(sRes.arr_images[i].id);
            // if(sRes.arr_time.AvailableHourFrom != 0 && sRes.arr_time.AvailableHourFrom != "0")
            //     str_check  =   "checked='checked'";
            // else
            //     str_check="";
            // console.log(sRes.arr_time[i].AvailableHourFrom);

            str_time+="<li class='on col-sm-6'>";
            str_time+="<div class='col-sm-3'>";
            str_time+="<label for='"+arr_dayofweek[i]+"'>"+arr_dayofweek[i]+"</label>";
            str_time+="</div>";

            str_time+="<div class='col-sm-6'>";
            str_time+="<select id='time_from_add_"+i+"'>";
            for (var j = 0 ; j < 25 ; j++) {
                str_time+="<option value='"+j+"' >"+j+" Giờ</option>";                
            }
            str_time+="</select> - ";
            str_time+="<select id='time_to_add_"+i+"'>";
            for (var j = 0 ; j < 25 ; j++) {
                str_time+="<option value='"+j+"' >"+j+" Giờ</option>";                
            }
            str_time+="</select>";
            str_time+="</div>";
            str_time+="</li>";
        }
        str_time+="</ul>";
       
       $("#divLoadthoigianDV_Add").children().remove();
       $("#divLoadthoigianDV_Add").append(str_time);


    });
    // $( "#btnsave" ).bind("click",function(){
    //     btnsave_spa_price();
    // });
    $("#cboPageNoPRO").change(function () {
        var trang = $("#cboPageNoPRO").val();
        searchProducts(trang);
        // search_nangcao_Products(trang);
    });
    $("#cboPageNoPRO_Search").change(function () {
        var trang = $("#cboPageNoPRO_Search").val();
        search_nangcao_Products(trang);
        // search_nangcao_Products(trang);
    });
    $("#phuongthuctimkiem").click(function () {
        $("#keyword").val();
        $("#spaid").val();
        if($("#keyword").val()== ''){
            alert('Vui lòng nhập từ khóa ');
            return;
        }
        searchProducts(1);
    });

    $("#submit_timkiemnangcao").click(function () {
        $("#txtProductID").val();
        $("#txtName").val();
        $("#cboProductType").val();
        $("#spaid").val();
        // console.log($("#txtProductID").val());
        // console.log($("#txtName").val());
        // console.log($("#cboProductType").val());

        // if($("#txtProductID").val()== '' && $("#txtName").val()== ''){
        //     alert('Vui lòng nhập thông tin tìm kiếm ');
        //     return;
        // }
        if($("#spaid").val()== ''){
            alert('Không thể tìm kiếm');
            return;
        }
        search_nangcao_Products(1);
    });
    $("#submit_reset").click(function () {
        $("#txtProductID").val("");
        $("#txtName").val("");
        $("#cboProductType").val("");
    });
    
    


});

function change_MaxProductatOnce(value,id,name){
    // alert(this);
    // console.log(value);
    // console.log(id);
    var MaxProductatOnce = value;
    var ProductID = id;

    if(MaxProductatOnce == "" || isNaN(MaxProductatOnce) || ProductID== "" || MaxProductatOnce == 0){
        alert("không hợp lệ !");
        return;
    }
    $.ajax({
        type:"POST",
        url:"home_controller/Update_MaxProductatOnce",
        dataType:"text",
        data: {
            id: ProductID,
            atOnce: MaxProductatOnce},
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
                Update_MaxProductatOnce_Complete(data,name);
            // }
          //alert(data);
        },
        
    });
}
function Update_MaxProductatOnce_Complete(data,name)
{
    var sRes = JSON.parse(data);
    if(sRes==true || sRes=="true"){
        alert('Dịch vụ : '+name+' \n\nSố chỗ tối đa trong 1 thời điểm \n\nCập nhật thành công !');
    }
}




/*
|----------------------------------------------------------------
| function getlocation_by_spa
|----------------------------------------------------------------
*/

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
        $("#cboProductType option").remove();
        $("#cboProductType").append(sRes);

        $("#cboProductType_Add option").remove();
        $("#cboProductType_Add").append(sRes);

    }
}



/*
|----------------------------------------------------------------
| function searchProducts
|----------------------------------------------------------------
*/
function searchProducts(page) {    

    $("#panelThem").hide(500);
    $("#panelDataPRO2").hide(500);


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
        url: "home_controller/list_products",
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
                searchProducts_Complete(data);
            // }
          //alert(data);
        }
    });
}

function searchProducts_Complete(data) {
    var sRes = JSON.parse(data);
    // console.log(sRes);
    if (sRes != null) {
        if(sRes.TotalRecord !=0)
        {
            $("#divTBKQTim").show(500);
            var node = document.getElementById("notifysuccess");
            $('#notifysuccess').children().remove();           
            $("#notifysuccess").append("<span class='success_bg'>Tìm được "+sRes.TotalRecord+" mẫu tin!</span>");



            $("#panelDataPRO").show(500);


            // $("#panelThem").hide(500);
            
            // $("#divTBKQTim").hide(500);
            // $("#khongtimthaygia").hide(500);
            // $("#khungthemgia").hide(500);
            
            // $("#khongtimthay").hide(500);
             // $("#cboPageNoPRO").show(300);
             // 
             
            $("#panelDataPRO tbody tr").remove();
            $("#ListFoundPRO").tmpl(sRes.lst).appendTo("#panelDataPRO tbody");
            // $("#panelDataPRO").show(500);
                   
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
| function search_nangcao_Products
|----------------------------------------------------------------
*/
function search_nangcao_Products(page) {    

    $("#panelThem").hide(500);
    $("#panelDataPRO2").hide(500);


    $("#divTBKQTim_Search").show(500);
    $("#panelDataPRO_Search").show(500);
    $("#cboPageNoPRO_Search").show(500);
    // $("#searching").show(500);


    var txtProductID = $("#txtProductID").val();
    var txtName = $("#txtName").val();
    var cboProductType = $("#cboProductType").val();
    var spaid = $("#spaid").val();
    curPage = page;   

    $.ajax({
        type:"POST",
        url: "home_controller/search_nangcao_Products",
        dataType:"text",
        data: {
            spaid: spaid,
            ProductID: txtProductID,
            Name: txtName,
            ProductType: cboProductType,
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
                search_nangcao_Products_Complete(data);
            // }
          //alert(data);
        }
    });
}


function search_nangcao_Products_Complete(data) {
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

            // $("#khongtimthaygia").hide(500);
            // $("#khungthemgia").hide(500);
            
            // $("#khongtimthay").hide(500);
             // $("#cboPageNoPRO").show(300);
             // 
             
            $("#panelDataPRO_Search tbody tr").remove();
            $("#ListFoundPRO_Search").tmpl(sRes.lst).appendTo("#panelDataPRO_Search tbody");
            // $("#panelDataPRO").show(500);
                   
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





function Edit_Product(id)
{

    $("#panelDataPRO").hide(500);
    $("#cboPageNoPRO").hide(500);
    $("#divTBKQTim").hide(500);

    $("#divTBKQTim_Search").hide(500);
    $("#panelDataPRO_Search").hide(500);
    $("#cboPageNoPRO_Search").hide(500);
    $("#panelDataPRO_Search").hide(500);
    // $("#Edit_title_product").removeChild();

    // $("#Name_Gia").val(ten);
    // $("#Gia_hientai").val(giahientai);
    // $("#Ma_Product").val(id);
    $.ajax({
        type:"POST",
        url:"home_controller/Edit_Product",
        dataType:"text",
        data: {
            id: id
        },
        cache:false,
        success:function (data) {
                // return;
                $("#panelDataPRO2").show(500);
                Edit_Product_Complete(data);
        },
        
    });
}
function Edit_Product_Complete(data)
{ 
    var sRes = JSON.parse(data);
    // console.log(sRes.Name);
    if(sRes != null){


        // var kt =$("#Edit_title_product").children().lenghth;
        // if(kt >0)
        
        $("#Edit_title_product").children().remove();
        $("#Edit_CurrentVouchers_product").val('');
        $("#Edit_MaxProductatOnce_product").val('');
        $("#Edit_Duration_product").val('');
        // $("#Edit_Price_product").val('');
        $("#Edit_ValidTimeFrom_product").val('');
        $("#Edit_ValidTimeTo_product").val('');
        document.getElementById('Ma_Product').setAttribute("value","");




        $("#Edit_title_product").append("<p>"+sRes.arr_products.Name+"</p>");
        $("#Edit_CurrentVouchers_product").val(sRes.arr_products.CurrentVouchers);
        $("#Edit_MaxProductatOnce_product").val(sRes.arr_products.MaxProductatOnce);
        $("#Edit_Duration_product").val(sRes.arr_products.Duration);
        // $("#Edit_Price_product").val(sRes.arr_products.MaxProductatOnce);
        $("#Edit_ValidTimeFrom_product").val(sRes.arr_products.ValidTimeFrom);
        $("#Edit_ValidTimeTo_product").val(sRes.arr_products.ValidTimeTo);



        CKEDITOR.instances['Edit_Des_product'].setData(sRes.arr_products.Description);
        CKEDITOR.instances['Edit_Policy_product'].setData(sRes.arr_products.Policy);
        CKEDITOR.instances['Edit_Restriction_product'].setData(sRes.arr_products.Restriction);
        CKEDITOR.instances['Edit_Tips_product'].setData(sRes.arr_products.Tips);

        document.getElementById('Ma_Product').setAttribute("value", sRes.arr_products.ProductID);

            // console.log(sRes.arr_images.length);



        /////////////////////
        var str_images = "<div style='float: left;'>";
        for (var i = 0; i < sRes.arr_images.length; i++) {
            // console.log(sRes.arr_images[i].id);
            str_images+="<div id='divLinks"+sRes.arr_images[i].id+"' style='padding: 10px; float: left'>";
            str_images+="<img src='../"+sRes.arr_images[i].URL+"' width='180'/>";
            str_images+="<a href='javascript:void(0);' onclick='XoaHinhProduct('"+sRes.arr_images[i].id+"');'>Xóa</a>";
            str_images+="</div>";

        }
        str_images+="</div>";

        $("#divXemLaiHinhDaUp").children().remove();
        $("#divXemLaiHinhDaUp").append(str_images);
        // console.log(str_images);
        //  CHUA LUU HINH ANH 
        //  ////////////////////////////////////////////


        var arr_dayofweek          =   {
                                        2   :  "Monday",
                                        3   :  "Tuesday",
                                        4   :  "Wednesday",
                                        5   :  "Thursday",
                                        6   :  "Friday",
                                        7   :  "Saturday",
                                        8   :  "Sunday",
                                        9   :  "Holidays",
                                        };
        // console.log(arr_dayofweek[2]);
        // 
        var str_time = "<ul class='col-sm-12 week'>";
        var str_check="";
        for (var i = 0; i < sRes.arr_time.length; i++) {
            // console.log(sRes.arr_images[i].id);
            // if(sRes.arr_time.AvailableHourFrom != 0 && sRes.arr_time.AvailableHourFrom != "0")
            //     str_check  =   "checked='checked'";
            // else
            //     str_check="";
            // console.log(sRes.arr_time[i].AvailableHourFrom);

            str_time+="<li class='on col-sm-6'>";
            str_time+="<div class='col-sm-3'>";
            str_time+="<label for='"+arr_dayofweek[sRes.arr_time[i].DayOfWeek]+"'>"+arr_dayofweek[sRes.arr_time[i].DayOfWeek]+"</label>";
            str_time+="</div>";

            str_time+="<div class='col-sm-6'>";
            str_time+="<select id='time_from_"+sRes.arr_time[i].DayOfWeek+"'>";
            for (var j = 0 ; j < 25 ; j++) {
                var selected="";
                if(sRes.arr_time[i].AvailableHourFrom == j)
                    selected  =   "selected='selected'";
                str_time+="<option value='"+j+"' "+selected+">"+j+" Giờ</option>";                
            }
            str_time+="</select> - ";
            str_time+="<select id='time_to_"+sRes.arr_time[i].DayOfWeek+"'>";
            for (var j = 0 ; j < 25 ; j++) {
                var selected="";
                if(sRes.arr_time[i].AvailableHourTo == j)
                    selected  =   "selected='selected'";
                str_time+="<option value='"+j+"' "+selected+">"+j+" Giờ</option>";                
            }
            str_time+="</select>";
            str_time+="</div>";
            str_time+="</li>";
        }
        str_time+="</ul>";
        // console.log(str_time);
        // return;


       
       $("#divLoadthoigianDV").children().remove();
       $("#divLoadthoigianDV").append(str_time);



        // $("#panelDataPRO2 p").remove();
        // $("#ListFoundPRO2").tmpl(sRes).appendTo("#panelDataPRO2");
        // status = 1-status;
        // var str = "Update_Trangthai('"+id+"','"+status+"','"+name+"');";        
        // document.getElementById('Trangthai_'+id).setAttribute("onclick", str);

        // var str1 = "../resources/images/active_"+status+".png";
        // document.getElementById('img_'+id).setAttribute("src", str1);

        // var str_thongbao ="";
        // if(status==0 || status=="0")
        //     str_thongbao = "Không hoạt động";
        // else
        //     str_thongbao = "Hoạt động";
        // alert('Dịch vụ : '+name+' \n\nChuyển trạng thái : '+str_thongbao);
    }
}





function submit_update_thongtin()
{
    $("#notify_socho").hide(100);
    $("#notify_sochotoida").hide(100);
    $("#notify_thoiluong").hide(100);
    $("#notify_time_batdau").hide(100);
    $("#notify_time_ketthuc").hide(100);
    $("#notify_time_ktbd_update").hide(100);
    $("#notifyerr_thongtin").hide(100);




    var ProductID = $("#Ma_Product").val();
    var Description = CKEDITOR.instances['Edit_Des_product'].getData(); 
    var CurrentVouchers = $("#Edit_CurrentVouchers_product").val();
    var MaxProductatOnce = $("#Edit_MaxProductatOnce_product").val();
    var Duration = $("#Edit_Duration_product").val();

    var ValidTimeFrom = $("#Edit_ValidTimeFrom_product").val();
    var ValidTimeTo = $("#Edit_ValidTimeTo_product").val();

    var Policy = CKEDITOR.instances['Edit_Policy_product'].getData();
    var Restriction = CKEDITOR.instances['Edit_Restriction_product'].getData();
    var Tips = CKEDITOR.instances['Edit_Tips_product'].getData();


    var flag = 0;
    if(ProductID ==""){
        alert("Không hợp lệ !");
        flag = 1;
    }
    if(CurrentVouchers =="" || isNaN(CurrentVouchers)){
        $("#notify_socho").show(500);
        $("#notify_socho" ).focus();
        flag = 1;
    }
    if(MaxProductatOnce =="" || isNaN(MaxProductatOnce)){
        $("#notify_sochotoida").show(500);
        $("#notify_sochotoida" ).focus();
        flag = 1;
    }
    if(Duration =="" || isNaN(Duration)){
        $("#notify_thoiluong").show(500);
        $("#notify_thoiluong" ).focus();
        flag = 1;
    }
    if(ValidTimeFrom ==""){
        $("#notify_time_batdau").show(500);
        $("#notify_time_batdau" ).focus();
        flag = 1;
    }
    var check = 0;
    if(ValidTimeTo ==""){
        $("#notify_time_ketthuc").show(500);
        $("#notify_time_ketthuc" ).focus();
        flag = 1;
        check = 1;
    }
    if(ValidTimeFrom > ValidTimeTo && check == 0){
        $("#notify_time_ktbd_update").show(500);
        $("#notify_time_ketthuc").hide(500);
        flag = 1;
    }




    if(flag == 1)
    {
         $("#notifyerr_thongtin").show(500);
         return;
    }
//cap nhat
    // console.log("OK");
    // return;
    $.ajax({
        type:"POST",
        url:"home_controller/submit_update_thongtin_product",
        dataType:"text",
        data: {
            ProductID : ProductID,
            Description : Description,
            CurrentVouchers : CurrentVouchers,
            MaxProductatOnce : MaxProductatOnce,
            Duration : Duration,
            ValidTimeFrom : ValidTimeFrom,
            ValidTimeTo : ValidTimeTo,
            Policy : Policy,
            Restriction : Restriction,
            Tips : Tips
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
                submit_update_thongtin_product_Complete(data);
            // }
          //alert(data);
        },
        
    });
}
function submit_update_thongtin_product_Complete(data)
{
    var sRes = JSON.parse(data);
    // console.log(sRes);
    if(sRes==true || sRes=="true"){
        $("#notifysuccess_thongtin").show(500);
        setTimeout(function(){
          $("#notifysuccess_thongtin").hide(500);
        }, 5000);


        // $("#divTBKQTim2").show(500);
        // // $("#btngiathem").hide(500);
        // $("#Gia_Them").val("");

        // var node = document.getElementById("notifysuccess2");
        // $('#notifysuccess2').children().remove();           
        // $("#notifysuccess2").append("<span class='success_bg'>Cập nhật giá thành công ! Vui lòng chờ xét duyệt .</span>");
    }
    else{
        $("#notifyerr_thongtin").show(500);
    }

}






///////Cập nhật product time
function submit_update_time()
{
    var ProductID = $("#Ma_Product").val();
    // var arrcbdayofweek = [];
    // var i= 0;
    // $('input:checkbox[name= ]:checked').each(function(){
    //     arrcbdayofweek[i++] = $(this).val();
    // });

    var arr_hour            =   [];
    for(var i = 2; i < 10; i ++)
    {
        var hour_from       =   $("#time_from_" + i).val();
        var hour_to         =   $("#time_to_" + i).val();
        
        var arr_hour_ele    = {dayofweek : i, time_from : hour_from, time_to : hour_to};
        arr_hour.push(arr_hour_ele);
        // console.log(arr_hour_ele);
    }
    $.ajax({
        type:"POST",
        url: "home_controller/submit_update_time_product",
        dataType:"text",
        data: {
            ProductID               :   ProductID,
            // arrcbdayofweek          :   arrcbdayofweek,
            arr_hour                :   arr_hour,
            },
        cache:false,
        success:function (data) {
            submit_update_time_product_Complete(data);
        }
    });
}
function submit_update_time_product_Complete(data)
{
    var sRes = JSON.parse(data);
    console.log(sRes);
    if(sRes==true || sRes=="true"){
        $("#notifysuccess_time").show(500);
        setTimeout(function(){
          $("#notifysuccess_time").hide(500);
        }, 5000);


        // $("#divTBKQTim2").show(500);
        // // $("#btngiathem").hide(500);
        // $("#Gia_Them").val("");

        // var node = document.getElementById("notifysuccess2");
        // $('#notifysuccess2').children().remove();           
        // $("#notifysuccess2").append("<span class='success_bg'>Cập nhật giá thành công ! Vui lòng chờ xét duyệt .</span>");
    }
    else{
        $("#notifyerr_time").show(500);
    }

}


//Update_Trangthai của sản phẩm
function Update_Trangthai(id,status,name) {   
    $.ajax({
        type:"POST",
        url:"home_controller/Update_Trangthai",
        dataType:"text",
        data: {
            id: id,
            status:status
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
                // return;
                Update_Trangthai_Complete(data,id,status,name);
            // }
          //alert(data);
        }
    });
}


function Update_Trangthai_Complete(data,id,status,name)
{
    var sRes = JSON.parse(data);
    if(sRes==true || sRes=="true"){

        status = 1-status;
        var str = "Update_Trangthai('"+id+"','"+status+"','"+name+"');";        
        document.getElementById('Trangthai_'+id).setAttribute("onclick", str);

        var str1 = "../resources/images/active_"+status+".png";
        document.getElementById('img_'+id).setAttribute("src", str1);

        var str_thongbao ="";
        if(status==0 || status=="0")
            str_thongbao = "Không hoạt động";
        else
            str_thongbao = "Hoạt động";
        alert('Dịch vụ : '+name+' \n\nChuyển trạng thái : '+str_thongbao);
    }
}




function submit_add_thongtin()
{
    $("#notify_name_add").hide(100);
    $("#notify_loai_add").hide(100);
    $("#notify_socho_add").hide(100);
    $("#notify_sochotoida_add").hide(100);
    $("#notify_thoiluong_add").hide(100);
    $("#notify_gia_add").hide(100);
    $("#notify_time_batdau_add").hide(100);
    $("#notify_time_ketthuc_add").hide(100);
    $("#notify_time_ktbd_add").hide(100);
    $("#notifyerr_thongtin_add").hide(100);




    $("#notify_product_time_add").hide(100);
    // alert("OK");
    // return
    var Name = $("#Add_Name_product").val();
    var ProductType = $("#cboProductType_Add").val();
    var Description = CKEDITOR.instances['Add_Des_product'].getData(); 
    var CurrentVouchers = $("#Add_CurrentVouchers_product").val();
    var MaxProductatOnce = $("#Add_MaxProductatOnce_product").val();
    var Duration = $("#Add_Duration_product").val();

    var ValidTimeFrom = $("#Add_ValidTimeFrom_product").val();
    var ValidTimeTo = $("#Add_ValidTimeTo_product").val();

    var Policy = CKEDITOR.instances['Add_Policy_product'].getData();
    var Restriction = CKEDITOR.instances['Add_Restriction_product'].getData();
    var Tips = CKEDITOR.instances['Add_Tips_product'].getData();

    var Gia = $("#Add_Price_product").val();


    var flag = 0;
    if(Name ==""){
        $("#notify_name_add").show(500);
        $("#Add_Name_product" ).focus();
        flag = 1;
    }
    if(ProductType ==""){
        $("#notify_loai_add").show(500);
        $("#cboProductType_Add" ).focus();
        flag = 1;
    }
    if(CurrentVouchers =="" || isNaN(CurrentVouchers) || CurrentVouchers ==0){
        $("#notify_socho_add").show(500);
        $("#Add_CurrentVouchers_product" ).focus();
        flag = 1;
    }
    if(MaxProductatOnce =="" || isNaN(MaxProductatOnce) || MaxProductatOnce ==0){
        $("#notify_sochotoida_add").show(500);
        $("#Add_MaxProductatOnce_product" ).focus();
        flag = 1;
    }
    if(Duration =="" || isNaN(Duration) || Duration==0){
        $("#notify_thoiluong_add").show(500);
        $("#Add_Duration_product" ).focus();
        flag = 1;
    }
    if(Gia =="" || Gia == 0){
        $("#notify_gia_add").show(500);
        $("#Add_Price_product" ).focus();
        flag = 1;
    }
    if(ValidTimeFrom ==""){
        $("#notify_time_batdau_add").show(500);
        flag = 1;
    }
    var check = 0;
    if(ValidTimeTo ==""){
        $("#notify_time_ketthuc_add").show(500);
        flag = 1;
        check = 1;
    }

    if(ValidTimeFrom > ValidTimeTo && check == 0){
        $("#notify_time_ketthuc_add").hide(500);
        $("#notify_time_ktbd_add").show(500);
        flag = 1;
    }




    if(flag == 1)
    {
         $("#notifyerr_thongtin_add").show(500);
         return;
    }
    $.ajax({
        type:"POST",
        url:"home_controller/submit_add_thongtin_product",
        dataType:"text",
        data: {
            Gia : Gia,
            Name : Name,
            ProductType : ProductType,
            Description : Description,
            CurrentVouchers : CurrentVouchers,
            MaxProductatOnce : MaxProductatOnce,
            Duration : Duration,
            ValidTimeFrom : ValidTimeFrom,
            ValidTimeTo : ValidTimeTo,
            Policy : Policy,
            Restriction : Restriction,
            Tips : Tips
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
                submit_add_thongtin_product_Complete(data);
            // }
          //alert(data);
        },
        
    });
}
function submit_add_thongtin_product_Complete(data)
{
    var sRes = JSON.parse(data);
    // console.log(sRes);
    if(sRes.result==true || sRes.result=="true"){

        // $("#Add_Name_product").val("");
        // $("#cboProductType_Add").val("");
        // $("#Add_CurrentVouchers_product").val("");

        // $("#Add_MaxProductatOnce_product").val("");
        // $("#Add_Duration_product").val("");
        // $("#Add_Price_product").val("");
        // $("#Add_ValidTimeFrom_product").val("");
        // $("#Add_ValidTimeTo_product").val("");


        // CKEDITOR.instances['Add_Des_product'].setData("");
        // CKEDITOR.instances['Add_Policy_product'].setData("");
        // CKEDITOR.instances['Add_Restriction_product'].setData("");
        // CKEDITOR.instances['Add_Tips_product'].setData("");


        $("#notifysuccess_thongtin_add").show(500);


        $("#btn_add_thongtin").hide(500);
        $("#notify_product_time_add").hide(500);

        document.getElementById('ProductID_result').setAttribute("value",sRes.ProductID);
        // setTimeout(function(){
        //   $("#notifysuccess_thongtin_add").hide(500);
        // }, 5000);


        // $("#divTBKQTim2").show(500);
        // // $("#btngiathem").hide(500);
        // $("#Gia_Them").val("");

        // var node = document.getElementById("notifysuccess2");
        // $('#notifysuccess2').children().remove();           
        // $("#notifysuccess2").append("<span class='success_bg'>Cập nhật giá thành công ! Vui lòng chờ xét duyệt .</span>");
    }
    else{
        $("#notifyerr_thongtin_add").show(500);
    }

}



///////Thêm product time
function submit_add_time()
{
    // var ProductID = "11111";
    var ProductID = $("#ProductID_result").val();
    if(ProductID==""||isNaN(ProductID)){
        $("#notify_product_time_add").show(500);
        return;
    }

    var arr_hour            =   [];
    for(var i = 2; i < 10; i ++)
    {
        var hour_from       =   $("#time_from_add_" + i).val();
        var hour_to         =   $("#time_to_add_" + i).val();
        
        var arr_hour_ele    = {dayofweek : i, time_from_add : hour_from, time_to_add : hour_to};
        arr_hour.push(arr_hour_ele);
        // console.log(arr_hour_ele);
    }
    $.ajax({
        type:"POST",
        url: "home_controller/submit_add_time_product",
        dataType:"text",
        data: {
            ProductID               :   ProductID,
            // arrcbdayofweek          :   arrcbdayofweek,
            arr_hour                :   arr_hour,
            },
        cache:false,
        success:function (data) {
            submit_add_time_product_Complete(data);
        }
    });
}
function submit_add_time_product_Complete(data)
{
    var sRes = JSON.parse(data);
    console.log(sRes);
    if(sRes==true || sRes=="true"){
        $("#notifysuccess_time_add").show(500);

        $("#btn_add_time").hide(500);
        setTimeout(function(){
          searchProducts(1);
        }, 5000);
    }
    else{
        $("#notifyerr_time_add").show(500);
    }

}















function doUpload1(url) {
    var ProID = $("#Ma_Product").val();
    if (ProID == "") {
        return false;
    } else {
        return doUpload(url + "/"+ ProID);
    }
}

function getUrl_upload()
{
//http://www.test.com:8082/index.php#tab2?foo=123
// window.location.host                   www.test.com:8082
//window.location.hostname               www.test.com
//window.location.port                   8082
//window.location.protocol               http
//window.location.pathname               index.php
//window.location.href                   http://www.test.com:8082/index.php#tab2
//window.location.hash                   #tab2
//window.location.search                 ?foo=123

    var str= window.location.href.toString() ;
    var host = window.location.host.toString() ;
    str = str.toLowerCase();
    var res = "";
    if(str.indexOf("localhost") >=0 || str.indexOf("127.0.0.1")>=0 || str.indexOf("nhaplieuspa")>=0)
    {
        var str1 =  window.location.pathname;
        //alert("str1 : "+str1);
        var arr = str1.split('/');
        res= "http://" + host + "/" + arr[1] + "/";    
        //return res;    
    }
    else
    {
       res = "http://" + host + "/";   
       //alert("str : "+str);
       
    }
    // console.log(res);
    // return;
    return res;
}




























































