var curPage =1;
$(document).ready(function() { 
        $("#cboPageNo").change(function () {
            var trang = $("#cboPageNo").val();            
            searchSpa(trang);
        });     
        $("#tx_tTel").ForceNumericOnly();
        $("#txtLocaionTabInsert").focusout(function(){
            var toado =$("#txtLocaionTabInsert").val().split(',');
            var content = $("#txtPostionTab").val()            ;
            init_map(parseFloat(toado[0]), parseFloat(toado[1]),content);
        });
        // load danh sách product
        $("#btt_Addproduct").click(function(){
           
                $("#poupProduct").dialog({
                    height: 400,
                    width:  850,
                    modal: true
                });
                
               //$("#checkVieclam").attr("checked","checked"); 
        }); 
        
        // when select nganh ngheef thay doi
        $("#cbbProduct").change(function(){
            var ProductID = $("#cbbProduct").val();
            var ProductName =$("#cbbProduct optgroup option[value='"+ProductID+"']").html();
            InsertCategory(ProductID,ProductName);
        }); 
      
        
});
 function closePoup(){
        $("#poupProduct").dialog("close");
 }
function InsertCategory(ProductID,ProductName)
{
       
        if($("#DivCategoryID"+ProductID + " span").text()=="" && ProductID != "0")
        {
            var url = "resources/images/filecloseBTN.png";
            var str="<div id=\"DivCategoryID"+ProductID+"\" class=\"doituongDIV\" maid=\""+ProductID+"\" >";
            var str1="<div id=\"DivCategoryIDShow"+ProductID+"\" class=\"doituongDIV\" maid=\""+ProductID+"\" >";
            
            str = str+ "<span>" + ProductName+"</span>";
            str1 = str1+ "<span>" +ProductName+"</span> ";
            
            str = str+ "<a href=\"javascript:void(0);\" onclick=\"XoaObject('DivCategoryID"+ProductID+"');\"><img src="+ url +" height=\"12\" /></a>";
            
            
            str = str+ "</div>";    
            str1 = str1+ "</div>";  
            
             
            
            $("#tdProduct").append(str);
            $("#tdShowCategory").append(str1);
            var list_spaproduct = [];
            var sss=$("#txtCategoryID").val();
            if(!(sss.indexOf("["+ProductID+"];")>=0))
            {     
                list_spaproduct.push(ProductID) ;                          
                sss = sss +"["+ ProductID+"];";     
                $("#txtCategoryID").val(sss);           
            }
        }
    }
    
    
    function XoaObject(id)
    {
        if(id.indexOf('DivCategoryID')>=0 )
        {
             var str = id.replace("DivCategoryID","");
             $("#DivCategoryID"+str).remove();
             $("#DivCategoryIDShow"+str).remove();
             
            var sss=$("#txtCategoryID").val();
            if(sss.indexOf("["+str+"];")>=0)
            {
                var sss1 = sss.replace("["+str+"];","");     
                $("#txtCategoryID").val(sss1);                               
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

function searchSpa(page) {
    var ob ={};
    
    ob.spaID = $("#txtspaID").val();
    ob.spaName  = $("#txtspaName").val();
    ob.Notes = $("#txtTel").val();
    ob.MoreInfo = $("#txtTel").val();
    ob.Address = $("#txtTel").val();
    ob.desciption = $("#txtTel").val();
    ob.location = $("#txtTel").val();
    ob.Tel = $("#txtTel").val();
   
    var spaID = $("#txtspaID").val();
    var spaName = $("#txtspaName").val();
    var Tel = $("#txtTel").val();
    var Notes = $("#txtnotes").val();
    var MoreInfo = $("#txtMoreInfo").val();
    var Address = $("#txtAddress").val();  
    var  email  = $("#txtemail").val(); 
    var desciption = $("#txtDescription").val();
    var location = $("#txtlocation").val();
    
    curPage = page;
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/spa/ajax_get_list",
        dataType:"text",
        data:{spaID:spaID,spaName:spaName,
                Tel:Tel, Notes:Notes,
                MoreInfo:MoreInfo,address:Address,
                email:email,desci:desciption,
                Loaction:location, Page:page},
        cache:false,
        success:function (data) {
            if(data == -1 || data == "-1" || data === "-1"){
                alert("Bạn không có quyền hạn ở chức năng này trên trang này");
            }else{
                searchSpa_Complete(data);
            }
            
        }
    });
}

function searchSpa_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
        $("#panelData tbody tr").remove();
        $("#DSHHtimduoc").tmpl(sRes.lst).appendTo("#panelData tbody");
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


function DeleteSpa(id)
{
    var strconfirm = confirm("Bạn có chắc chắn xóa không?");
    if(strconfirm == true){
         $.ajax({
            type:"POST",
            url:getUrspal() + "admin/spa/xoa_mot_spa",
            dataType:"json",
            data:{spaID:id},
            cache:false,
            success:function(data) {
                if( data== "-1" || data==="-1" || data==-1 )
                {
                    alert("Ban Khong Co quyen tren chuc nang nay o trang nay !!! ");                    
                }
                else
                {
                    DeleteSpa_Complete(data);
                }
                                
            },
            error: function () {
            }
        });  
   }     
    
}

function DeleteSpa_Complete(data)
{
        var res = data;   
        if(res.Result == "0" || res.Result == 0 || res.Result === "0"){
            alert("Vui lòng xóa sản phẩm trước khi xóa spa");
            
        }

        if(res.Result == 1 || res.Result == "1" || res.Result === "1"){
            var trang = $("#cboPageNo").val();
            searchSpa(trang);
        }
            
}
   

function ShowHinhSpa(id){
    
}

function ThemMoiImage(){
    var form_data = {          
        spaID : $('#txt_spaID').val(),
        url: $('#didUrlImage').val(),
     };
        $.ajax({
                url: getUrspal() + "admin/spa/themmoiImage",
                type: 'POST',
                async : false,
                data: form_data,
                dataType: 'text',
                success: function(data){
                    if( data== "-1" || data==="-1" || data==-1 )
                    {
                        alert("Ban Khong Co quyen tren chuc nang nay o trang nay !!! ");                    
                    }
                    else
                    {
                        ThemImage_Complete(data);
                        $("#btnThemMoiSpaProduct").css("display","none");
                    }
                        
                    },
                error: function() {
                    alert("Loi");
                }
        });
}  

function ThemImage_Complete(data){  
    var res = data;
       if(res.SpaID != ""){
           // thành công
            $(".ThemThanhCong").show(500);
            $("#UploadHinhAnh").show(500);
            $(".ThemMoiError").hide(0);
            $("#btnThemMoiSpa").css("display","none");
            $('#txt_spaID').val(res.SpaID);//btnThemMoiSpaProduct
            $("#btnThemMoiSpaProduct").css("display","none");//btnThemMoiSpaProduct
       }else{
           // ko thanh cong
            $(".ThemThanhCong").hide(0);
            $("#UploadHinhAnh").hide(0);
            $(".ThemMoiError").show(500);
       }
    
}

function doUpload1(url) {
    var SpaID = $("#txt_spaID").val();
    if (SpaID == "") {
        return false;
    } else {
        return doUpload(url + "/"+ SpaID);
    }
}

function XemLaiHinhDaUp() {
    var SpaID = $("#txt_spaID").val();    
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

function ThemMoiSpaProduct(){
     // thanh cong
   var productype = $('#txtCategoryID').val();
    var form_data = {          
            spaID : $('#txt_spaID').val(),
            Productype: $('#txtCategoryID').val(),
           
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
                url: getUrspal() + "admin/spa/themspaproduct",
                type: 'POST',
                async : false,
                data: form_data,
                dataType: 'json',
                success: function(data){
               if( data== "-1" || data==="-1" || data==-1 )
                { 
                }
                else{
                    ThemSpaProduct_Complete(data);
                }    
                  
            }
        });
    }
       
        //return false;
}

function ThemSpaProduct_Complete(data){
    var res = data;
       if(res.SpaID != ""){
           // thành công
            $("#DivAddProductSucces").show(500);// div thong bao thanh cong
            $("#DivAddProductError").hide(0);// div thong bao loi
            $("#btnThemMoiSpa").css("display","none");
            $("#btnThemMoiSpaProduct").css("display","none");
            $("#UploadHinhAnh").show(500); //divThemSpaTime
            $("#divThemSpaTime").show(500);      
            $('#txt_SpaID2').val(res.SpaID);//btnThemMoiSpaProduct//divThemSpaTime
            
       }else{
           // ko thanh cong
            $("#DivAddProductError").show(500);// div thong bao thanh cong
            $("#DivAddProductSucces").hide(0);// div thong bao loi
            $("#btnThemMoiSpa").css("display","none");
            
       }        
}

function ThemMoiSpa(){
    // thanh cong
    var valid = false;
    var str = "";
    var email = $('#txt_email').val();
    var emailsend = $('#txt_email1').val();
    var Telsend   = $('#tx_tTel1').val();
    var status = $("#cboStatusTab2").val();
    var website = $("#tx_website").val();
    if(status == ""){
        str = "Vui lòng chọn trạng thái";
    }
    if(email != ""){
        if(ValidateEmail(email) == false)
        {
            str ="Vui lòng nhập đúng định dạng email <br />";
            
        }
    }
    var phone  = $('#tx_tTel').val();
    if(phone != ""){
        if(ValidatePhone(phone) == false){
            str = str + "Vui lòng nhập đúng định dạng số điện thoại";
        }
    }
    if(str == ""){
        valid = true;
    }
    else{
         valid = false;
    }
    if(valid == true){
        var nots        = CKEDITOR.instances['txt_notes'].getData();
        var info        = CKEDITOR.instances['txt_Description'].getData();
        var MoreInfo    = CKEDITOR.instances['txt_MoreInfo'].getData();
        var form_data = {          
                spaName : $('#txt_spaName').val(),
                Tel : $('#tx_tTel').val(),
                Address : $('#txt_Address').val(),
                Email : $('#txt_email').val(),
                Location : $('#txtLocaionTabInsert').val(),
                Note : nots,//txt_notes
                Intro : info,
                MoreInfo : MoreInfo,
                Postion :$('#txtPostionTab').val(),
                Productype: $('#txtCategoryID').val(),
                Status: status,
                EmailSend:emailsend,
                TelSend:Telsend,
                Website:website 
                };
            $.ajax({
                    url: getUrspal() + "admin/spa/themspa",
                    type: 'POST',
                    async : false,
                    data: form_data,
                    dataType: 'json',
                    success: function(data){
                    if( data== "-1" || data=== "-1" || data==-1 )
                    {
                        alert("Ban Khong Co quyen tren chuc nang nay o trang nay !!! "); 
                    }
                    else{
                          ThemSpa_Complete(data);
                    }
                   
                }
            });
            //return false;
    }else{
        alert(str);
    }
}

function ThemSpa_Complete(data)
{
    var res = data;
       if(res.SpaID != ""){
           // thành công
            $("#DivAddSpaSuccess").show(500);// div thong bao thanh cong
            $("#DivAddSpaError").hide(0);// div thong bao loi
            $("#btnThemMoiSpa").css("display","none");
            $("#divAddProductHide").show(500);          
            $('#txt_spaID').val(res.SpaID);// return spaID
       }else{
           // ko thanh cong
            $("#DivAddSpaSuccess").show(500);// div thong bao thanh cong
            $("#DivAddSpaError").hide(0);// div thong bao loi
       }
}

function Reset()
{
    $("#txtspaID").val("");
    $("#txtspaName").val("");
    $("#txtTel").val("");
    $("#txtDescription").val("");
    $("#txtMoreInfo").val("");
    $("#txtAddress").val("");
    $("#txtemail").val("");
    $("#txtnotes").val("");
   
}

function ResetAdd(){
    
    $('#txt_spaID').val("");
    $('#txt_Address').val("");
    $('#txt_spaName').val("");
    $('#txt_email').val("");
    $('#tx_tTel').val("");
    $("#txtLocaionTabInsert").val("");
    $('#txtPostionTab').val("");
    CKEDITOR.instances['txt_notes'].setData("");
    CKEDITOR.instances['txt_Description'].setData("");
    CKEDITOR.instances['txt_MoreInfo'].setData("");
    //$('#txt_notes').val("");
//    $('#txt_Description').val("");
//    $('#txt_MoreInfo').val("");
    // reset lại sản phẩm
    $('#tdShowCategory div').remove();
    $('#tdProduct div').remove();
    // reset cap nhật thời gian
    $("#tableThemTgianPRO tr:eq(1) td:eq(0) select:eq(0)").val("");
    $("#tableThemTgianPRO tr:eq(1) td:eq(0) select:eq(1)").val("");
    
    var FT3 = $("#tableThemTgianPRO tr:eq(1) td:eq(1) select:eq(0)").val("");
    var TT3 = $("#tableThemTgianPRO tr:eq(1) td:eq(1) select:eq(1)").val("");

    var FT4 = $("#tableThemTgianPRO tr:eq(1) td:eq(2) select:eq(0)").val("");
    var TT4 = $("#tableThemTgianPRO tr:eq(1) td:eq(2) select:eq(1)").val("");

    var FT5 = $("#tableThemTgianPRO tr:eq(1) td:eq(3) select:eq(0)").val("");
    var TT5 = $("#tableThemTgianPRO tr:eq(1) td:eq(3) select:eq(1)").val("");

    var FT6 = $("#tableThemTgianPRO tr:eq(1) td:eq(4) select:eq(0)").val("");
    var TT6 = $("#tableThemTgianPRO tr:eq(1) td:eq(4) select:eq(1)").val("");

    var FT7 = $("#tableThemTgianPRO tr:eq(1) td:eq(5) select:eq(0)").val("");
    var TT7 = $("#tableThemTgianPRO tr:eq(1) td:eq(5) select:eq(1)").val("");

    var FTCN = $("#tableThemTgianPRO tr:eq(1) td:eq(6) select:eq(0)").val("");
    var TTCN = $("#tableThemTgianPRO tr:eq(1) td:eq(6) select:eq(1)").val("");

    var FTLE = $("#tableThemTgianPRO tr:eq(1) td:eq(7) select:eq(0)").val("");
    var TTLE = $("#tableThemTgianPRO tr:eq(1) td:eq(7) select:eq(1)").val("");
    
    // câu thông báo
    $('#DivAddSpaError').hide(0);
    $('#DivAddSpaSuccess').hide(0);
    $('#DivAddProductError').hide(0);
    $('#DivAddProductSucces').hide(0);
    $('#divTBKQCapNhatTimePRO').hide(0);
    // ẩn thêm sản phẩm
    $('#btnThemMoiSpaProduct').show(500);//btnThemMoiSpaProduct
    $('#divAddProductHide').css("display","none");//$divAddProductHide
    //ẩn upload hình ảnh
    $('#UploadHinhAnh').css("display","none");//UploadHinhAnh
    //$('#btnThemMoiLinks').hide(0);
    
    // ẩn cập nhật thời gian hoạt động của spa
    $('#divThemSpaTime').css("display","none");//divThemSpaTime
    $('#btn_UpdateTiemSPA').show(500);
    $('#resert').hide(0);
    $("#btnThemMoiSpa").show(500);
    //$("#btnThemMoiSpaProduct").show(500);
}

function CapNhatTimeSPA() {
    var SpaID = $("#txt_SpaID2").val();
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
            if( data== "-1" || data==="-1" || data==-1 )
                {
                    alert("Ban Khong Co quyen tren chuc nang nay o trang nay !!! ");                    
                }
                else
                {
                    CapNhatTimePRO_Complete(data);
                }
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
            $("#divTBKQCapNhatTimePRO div").html("Cap nhat thanh cong !");
            $("#divTBKQCapNhatTimePRO").show(500);
            $('#resert').show(500);
        }
        else {
            $("#divTBKQCapNhatTimePRO").removeClass("error");
            $("#divTBKQCapNhatTimePRO").removeClass("success");
            $("#divTBKQCapNhatTimePRO").addClass("error");
            $("#divTBKQCapNhatTimePRO div").html("Cap nhat không thanh cong !");
            $("#divTBKQCapNhatTimePRO").show(500);
            $('#resert').show(500);
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
  