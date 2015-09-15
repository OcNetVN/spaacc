
$(document).ready(function () {
    getSpaWorkingTime();
    loadToaDo();
    
    $("#txtLocaionTabInsert").focusout(function(){
            var toado = $("#txtLocaionTabInsert").val().split(',');
            var content = $("#txtPostionTab").val()            ;
            init_map(parseFloat(toado[0]), parseFloat(toado[1]),content);
    });
        
     $("#btt_Addproduct").click(function(){
           
                $("#poupProduct").dialog({
                    height: 400,
                    width:  850,
                    modal: true
                });
                
               //$("#checkVieclam").attr("checked","checked"); 
        }); 
});

function loadToaDo(){
        var toado = $("#txtLocaionTabInsert").val().split(',');
        var content = $("#txtPostionTab").val()            ;
        init_map(parseFloat(toado[0]), parseFloat(toado[1]),content);
}

function CapnhatSpa(){
    // thanh cong
    var nots        = CKEDITOR.instances['txt_notes'].getData();
    var info        = CKEDITOR.instances['txt_Description'].getData();
    var MoreInfo    = CKEDITOR.instances['txt_MoreInfo'].getData();
    var form_data = {
            spaID : $('#txt_editspaID').val(),          
            spaName : $('#txt_editspaName').val(),
            Tel : $('#txt_Tel').val(),
            Address : $('#txt_Address').val(),
            Email : $('#txt_email').val(),
            Location : $('#txtLocaionTabInsert').val(),
            Note : nots,//txt_notes
            Intro : info,
            MoreInfo : MoreInfo,
            Postion :$('#txtPostionTab').val(),
            Productype: $('#txtCategoryID').val(),
            Status: $("#cboStatusTab2").val(),
            EmailSend:$('#txt_email1').val(),
            TelSend:$('#tx_tTel1').val(),
            Website:$("#tx_website").val()
           
            };
        $.ajax({
                url: getUrspal() + "admin/spa/updatespa",
                type: 'POST',
                async : false,
                data: form_data,
                dataType: 'json',
                success: function(data){
                if( data== "-1" || data==="-1" || data==-1 )
                {
                    alert("Ban Khong Co quyen tren chuc nang nay o trang nay !!! ");                    
                }
                else
                {
                    CapnhatSpa_Complete(data);
                }
            }
        });
        //return false;
}

function CapnhatSpa_Complete(data)
{
    var res = data;
    if (res.Result == "1") {
            $('#divUpdateSpaError').hide(0);
            $('#divUpdateSpaSuccess').show(500);
                 
       }else{
             $('#divUpdateSpaError').show(500);
            $('#divUpdateSpaSuccess').hide(0);//hide(0)
       }
}

function  getSpaWorkingTime()
{
    var spaid = $("#txt_editspaID").val();
   // var list = $('#input_gettimeSPA').val();
   $.ajax({
        type: "POST",
        url: getUrspal() + "admin/spa/get_spa_times",
        dataType: "text",
        data: {                       
            SpaID: spaid
        },
        cache: false,
        success: function (data) {
            getSpaWorkingTime_Complete(data);
            //alert(data);
        }
    });
}


 
 function ProductTypeChange()
 {
    var ProductID       =   $("#cbbProduct").val();
    var ProductName     =   $("#cbbProduct optgroup option[value='"+ProductID+"']").html();
    InsertProductType(ProductID,ProductName);
 }
 
 function InsertProductType(ProductID,ProductName)
{
       
        if($("#DivProductTypeID"+ProductID + " span").text()=="" && ProductID != "0")
        {
            var url = "resources/images/filecloseBTN.png";
            var str="<div id=\"DivProductTypeIDPop"+ProductID+"\" class=\"doituongDIV\" maid=\""+ProductID+"\" >";
            var str1="<div id=\"DivProductTypeID"+ProductID+"\" class=\"doituongDIV\" maid=\""+ProductID+"\" >";//
            
            str = str+ "<span>" +ProductName+"</span>";
            str1 = str1+ "<span>" +ProductName+"</span> ";
            
            str = str+ "<a href=\"javascript:void(0);\" onclick=\"XoaObject('DivProductTypeID"+ProductID+"');\"><img src="+ url +" height=\"12\" /></a>";
            
            
            str = str+ "</div>";    
            str1 = str1+ "</div>";  
            
             
            
            $("#tdProductPop").append(str);
            $("#tdShowProductType").append(str1);
            var list_spaproduct = [];
            var sss=$("#txtProductTypeID").val();
            if(!(sss.indexOf(ProductID+";")>=0))
            {     
                list_spaproduct.push(ProductID) ;                          
                sss = sss + ProductID+";";     
                $("#txtProductTypeID").val(sss);           
            }
        }
    }
 
function ThemMoiSpaProduct(){
     // thanh cong
    var productype = $('#txtProductTypeID').val();
    var form_data = {          
            spaID : $('#txt_editspaID').val(),
            Productype: $('#txtProductTypeID').val()           
            };
     var message = "";
    var vali=true; 
    if(productype == ""){
        message =  "Vui lòng chọn loại sản phẩm cho spa";
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
                url: getUrspal() + "admin/spa/updateproduct",
                type: 'POST',
                async : false,
                data: form_data,
                dataType: 'json',
                success: function(data){
                if( data== "-1" || data==="-1" || data==-1 )
                {
                    alert("Ban Khong Co quyen tren chuc nang nay o trang nay !!! ");                    
                }
                else
                {
                    ThemSpaProduct_Complete(data);
                }
            }
        });
    }
        //return false;
}

function ThemSpaProduct_Complete(data){
    var res = data;
       //alert(data['thongbao']);
       if(res.SpaID != ""){
           // thành công
            $("#divSpaProductSucces").show(500);
            $("#diveditspaproducterror").hide(0);
           
       }else{
           // ko thanh cong
          
            $("#divSpaProductSucces").hide(0);
            $("#diveditspaproducterror").show(500);
       }
}

function doUpload1(url) {
    var SpaID = $("#txt_editspaID").val();
    if (SpaID == "") {
        return false;
    } else {
        return doUpload(url + "/"+ SpaID);
    }
}

function XemLaiHinhDaUp() {
    var SpaID = $("#txt_editspaID").val();    
    //$("#divXemLaiHinhDaUp").show(500);
    
    $.ajax({
        url: getUrspal() + "admin/products/gethinhproducts",
        type: "POST",
        data: { ProductID: SpaID },
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

function getSpaWorkingTime_Complete(data)
{
    var res = JSON.parse(data);
    for(i=0; i<res.length ; i++)
    {
        if(res[i].DayOfWeek == "2" || res[i].DayOfWeek == 2)
        {
           $("#tableThemTgianPRO tr:eq(1) td:eq(0) select:eq(0) option:selected").removeAttr("selected");
           $("#tableThemTgianPRO tr:eq(1) td:eq(0) select:eq(0) option[value='" + res[i].AvailableHourFrom + "']").attr("selected", "selected");
            
            $("#tableThemTgianPRO tr:eq(1) td:eq(0) select:eq(1) option:selected").removeAttr("selected");
            $("#tableThemTgianPRO tr:eq(1) td:eq(0) select:eq(1) option[value='" + res[i].AvailableHourTo + "']").attr("selected", "selected");
        }
        
        if(res[i].DayOfWeek == "3" || res[i].DayOfWeek == 3)
        {
            $("#tableThemTgianPRO tr:eq(1) td:eq(1) select:eq(0) option:selected").removeAttr("selected");
            $("#tableThemTgianPRO tr:eq(1) td:eq(1) select:eq(0) option[value='" + res[i].AvailableHourFrom + "']").attr("selected", "selected");
            
            $("#tableThemTgianPRO tr:eq(1) td:eq(1) select:eq(1) option:selected").removeAttr("selected");
            $("#tableThemTgianPRO tr:eq(1) td:eq(1) select:eq(1) option[value='" + res[i].AvailableHourTo + "']").attr("selected", "selected");
        }
        
        if(res[i].DayOfWeek == "4" || res[i].DayOfWeek == 4)
        {
            $("#tableThemTgianPRO tr:eq(1) td:eq(2) select:eq(0) option:selected").removeAttr("selected");
            $("#tableThemTgianPRO tr:eq(1) td:eq(2) select:eq(0) option[value='" + res[i].AvailableHourFrom + "']").attr("selected", "selected");
            
            $("#tableThemTgianPRO tr:eq(1) td:eq(2) select:eq(1) option:selected").removeAttr("selected");
            $("#tableThemTgianPRO tr:eq(1) td:eq(2) select:eq(1) option[value='" + res[i].AvailableHourTo + "']").attr("selected", "selected");
        }
        
         if(res[i].DayOfWeek == "5" || res[i].DayOfWeek == 5)
        {
            $("#tableThemTgianPRO tr:eq(1) td:eq(3) select:eq(0) option:selected").removeAttr("selected");
            $("#tableThemTgianPRO tr:eq(1) td:eq(3) select:eq(0) option[value='" + res[i].AvailableHourFrom + "']").attr("selected", "selected");
            
            $("#tableThemTgianPRO tr:eq(1) td:eq(3) select:eq(1) option:selected").removeAttr("selected");
            $("#tableThemTgianPRO tr:eq(1) td:eq(3) select:eq(1) option[value='" + res[i].AvailableHourTo + "']").attr("selected", "selected");
        }
         if(res[i].DayOfWeek == "6" || res[i].DayOfWeek == 6)
        {
            $("#tableThemTgianPRO tr:eq(1) td:eq(4) select:eq(0) option:selected").removeAttr("selected");
            $("#tableThemTgianPRO tr:eq(1) td:eq(4) select:eq(0) option[value='" + res[i].AvailableHourFrom + "']").attr("selected", "selected");
            
            $("#tableThemTgianPRO tr:eq(1) td:eq(4) select:eq(1) option:selected").removeAttr("selected");
            $("#tableThemTgianPRO tr:eq(1) td:eq(4) select:eq(1) option[value='" + res[i].AvailableHourTo + "']").attr("selected", "selected");
        }
        
         if(res[i].DayOfWeek == "7" || res[i].DayOfWeek == 7)
        {
            $("#tableThemTgianPRO tr:eq(1) td:eq(5) select:eq(0) option:selected").removeAttr("selected");
            $("#tableThemTgianPRO tr:eq(1) td:eq(5) select:eq(0) option[value='" + res[i].AvailableHourFrom + "']").attr("selected", "selected");
            
            $("#tableThemTgianPRO tr:eq(1) td:eq(5) select:eq(1) option:selected").removeAttr("selected");
            $("#tableThemTgianPRO tr:eq(1) td:eq(5) select:eq(1) option[value='" + res[i].AvailableHourTo + "']").attr("selected", "selected");
        }
        
         if(res[i].DayOfWeek == "8" || res[i].DayOfWeek == 8)
        {
            $("#tableThemTgianPRO tr:eq(1) td:eq(6) select:eq(0) option:selected").removeAttr("selected");
            $("#tableThemTgianPRO tr:eq(1) td:eq(6) select:eq(0) option[value='" + res[i].AvailableHourFrom + "']").attr("selected", "selected");
            
            $("#tableThemTgianPRO tr:eq(1) td:eq(6) select:eq(1) option:selected").removeAttr("selected");
            $("#tableThemTgianPRO tr:eq(1) td:eq(6) select:eq(1) option[value='" + res[i].AvailableHourTo + "']").attr("selected", "selected");
        }
        
         if(res[i].DayOfWeek == "9" || res[i].DayOfWeek == 9)
        {
            $("#tableThemTgianPRO tr:eq(1) td:eq(7) select:eq(0) option:selected").removeAttr("selected");
            $("#tableThemTgianPRO tr:eq(1) td:eq(7) select:eq(0) option[value='" + res[i].AvailableHourFrom + "']").attr("selected", "selected");
            
            $("#tableThemTgianPRO tr:eq(1) td:eq(7) select:eq(1) option:selected").removeAttr("selected");
            $("#tableThemTgianPRO tr:eq(1) td:eq(7) select:eq(1) option[value='" + res[i].AvailableHourTo + "']").attr("selected", "selected");
        }
    }
}
 function XoaObject(id)
    {
        if(id.indexOf('DivCategoryID')>=0 )
        {
             var str = id.replace("DivCategoryID","");
             $("#DivProductTypeID"+str).remove();
             $("#DivProductTypeIDPop"+str).remove();
             
            var sss=$("#txtProductTypeID").val();
            if(sss.indexOf(str+";")>=0)
            {
                var sss1 = sss.replace(str+";","");     
                $("#txtProductTypeID").val(sss1);                               
            }
             
        }
        if(id.indexOf('DivCategoryIDShow')>=0 )
        {
             var str = id.replace("DivCategoryIDShow","");
             $("#DivCategoryID"+str).remove();
             $("#DivCategoryIDShow"+str).remove();
             
            var sss=$("#txtCategoryID").val();
            if(sss.indexOf("["+str+"];")>=0)
            {
                var sss1 = sss.replace("["+str+"];","");  
                $("#txtCategoryID").val(sss1);                  
            }
        }
    }

function closePoup(){
        $("#poupProduct").dialog("close");
 }
function CapNhatTimeSPA() {
    var SpaID = $("#txt_editspaID").val();
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

    $.ajax({
        type: "POST",
        url: getUrspal() + "admin/spa/capnhat_time_spa",
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
            SpaID: SpaID
        },
        cache: false,
        success: function (data) {
            CapNhatTimePRO_Complete(data);
            //alert(data);
        }
    });
}

function CapNhatTimePRO_Complete(data) {
    if (data != null) {
        var res = JSON.parse(data);
        if (res.Result == "1") {
            $("#divTBKQCapNhatTimePRO").removeClass("error");
            $("#divTBKQCapNhatTimePRO").removeClass("success");
            $("#divTBKQCapNhatTimePRO").addClass("success");
            $("#divTBKQCapNhatTimePRO div").html("Cập nhật thời gian hoạt động spa thành công !");
            $("#divTBKQCapNhatTimePRO").show(500);
        }
        else {
            $("#divTBKQCapNhatTimePRO").removeClass("error");
            $("#divTBKQCapNhatTimePRO").removeClass("success");
            $("#divTBKQCapNhatTimePRO").addClass("error");
            $("#divTBKQCapNhatTimePRO div").html("Cập nhật thời gian hoạt động spa không thành công !");
            $("#divTBKQCapNhatTimePRO").show(500);
        }
    }
    else {
        $("#divTBKQCapNhatTimePRO").removeClass("error");
        $("#divTBKQCapNhatTimePRO").removeClass("success");
        $("#divTBKQCapNhatTimePRO").addClass("error");
        $("#divTBKQCapNhatTimePRO div").html("Cap nhat thời gian hoạt động spa không thành công !");
        $("#divTBKQCapNhatTimePRO").show(500);
    }
}

function init_map(x, y,contentVal){
    var myOptions = {
        zoom:16,
        center:new google.maps.LatLng(x,y),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
    marker = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(x, y)}
        );
    infowindow = new google.maps.InfoWindow({
        content:contentVal });
    google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});
    infowindow.open(map,marker);
}