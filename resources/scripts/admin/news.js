$(document).ready(function() {

    $("#CurrentVouchersTab2").ForceNumericOnly();
    $("#DurationTab2").ForceNumericOnly();
    $("#MaxProductatOnceTab2").ForceNumericOnly();

    $("#PriceTab2").number(true, 0);

    $("#cboPageNoPRO").change(function () {
        var trang = $("#cboPageNoPRO").val();
        searchNews(trang);
    });
    
});

function searchNews(page) {    
   
    var title = $("#txttitle").val();
    var newscont = $("#txtNewsBrief").val();
    var time = $("#txttime").text();
    var NewType = $("#cboNewType").val();
    curPage = page;    
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/newsmanage/search_new",
        dataType:"text",
        data: {
                title: title, 
                time: time,
                newscont: newscont,
                NewsType: NewType,
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
                    searchNews_Complete(data);
                }
          //alert(data);
        }
    });
}

function searchNews_Complete(data) {
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

function Reset()
{
    $("#cboNewType option").removeAttr("selected");
    $("#txttitle").val("");
    $("#txtNewsBrief").val("");
    $("#txttime").val("");
   
}

function ThemMoiNew() {

    var title = $("#txt_title").val();  
    var NewsType = $("#cbo_NewType").val();
    var NewsBrief =  CKEDITOR.instances['txt_NewsBrief'].getData(); 
    var NewDetail = CKEDITOR.instances['txtNewDetail'].getData();  
    
    ///curPage = page;
    var message = "";
    var vali=true; 
    if(title == ""){
        message =  "Vui lòng nhập tiêu đề";
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
                url: getUrspal() + "admin/newsmanage/them_moi_new",
                dataType: "text",
                data: {
                    title: title, 
                    NewsType: NewsType,
                    NewsBrief: NewsBrief,
                    NewDetail: NewDetail
                },
                cache: false,
                success: function (data) {
                        if( data== "-1" || data==="-1" || data==-1 )
                        {
                            alert("Ban Khong Co quyen tren chuc nang nay o trang nay !!! ");                    
                        }
                        else
                        {
                            ThemMoiNew_Complete(data);
                        }
                }
            });
      }
}

function ThemMoiNew_Complete(data) {
    if($.isEmptyObject(data))
    {
        
    }
    else
    {
        var req = JSON.parse(data);
        if (req.id != "") {    
            $("#id_new").text(req.id);
        }
        else {
            $(".ThemThanhCong").hide(500);
            $(".ThemThatBai").show(500);
            $("#btnthemPro").css("display", "");
        }
        if(req.res == 1 || req.res == "1"){
            $(".ThemThanhCong").show(500);
            $(".ThemThatBai").hide(0);
            $("#btnthemPro").css("display", "none"); 
            $("#UploadHinhAnh").css("display","");
        }
        else{
             $(".ThemThanhCong").hide(500);
            $(".ThemThatBai").show(500);
            $("#btnthemPro").css("display", "");
        }
    }
    
}

function doUpload1(url) {
    var id = $("#id_new").text();
    if (id == "") {
        return false;
    } else {
        return doUpload(url + "/"+ id);
    }
}

function XemLaiHinhDaUp() {
    var id = $("#id_new").text();   
    //$("#divXemLaiHinhDaUp").show(500);
    
    $.ajax({
        url: getUrspal() + "admin/newsmanage/gethinh",
        type: "POST",
        data: { ProductID: id },
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
            str = str + "<img src= "+getUrspal() + sRes[i].URL +" width=\"180\"/>";
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
            url: getUrspal() + "admin/newsmanage/xoahinh",
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




function EditNews(id) {
    document.location.href = getUrspal() + "admin/newsmanage/edit/"+id;
}




function DeleteNews(id) {
    var strconfirm = confirm("Bạn có chắc chắn xóa không?");
    if (strconfirm == true) {
        $.ajax({
            url: getUrspal() + "admin/newsmanage/xoanews",
            type: "POST",
            data: { ID: id },
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
                            DeleteNews_Complete(data);
                        }
                    },
            error: function () {
            }
        });
    }
}

function DeleteNews_Complete(data) {
    var res = JSON.parse(data);
    if (res.Result == "1" || res.Result == 1) {
        //$("")
        var trang = $("#cboPageNoPRO").val();
        searchNews(trang);
    }
}

