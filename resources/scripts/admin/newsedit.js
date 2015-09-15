function UpdateNews() {
    var id = $("#txt_id").val();
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
    
    //if(NewsType == ""){
//        message =  "Vui lòng chọn loại tin tức";
//    }
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
            url: getUrspal() + "admin/newsmanage/cap_nhat_news",
            dataType: "text",
            data: {
                id:id, 
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
                    UpdateNews_Complete(data);
                }
                //alert(data);
            }
        });
    }
    
}

function UpdateNews_Complete(data) {
    if($.isEmptyObject(data))
    {
        
    }
    else
    {
        var req = JSON.parse(data);
        if (req.$res != "1" || req.$res != 1 ) {
            $(".ThemThanhCong").show(500);
            $(".ThemThatBai").hide(0);
            $("#btnthemPro").css("display", "none");
            //$("#txtProductIDTab2").val(res.ProductID);
        }
        else {
            $(".ThemThanhCong").hide(500);
            $(".ThemThatBai").show(500);
            $("#btnthemPro").css("display", "");
        }
    }
    
}

function doUpload1(url) {
    var id =  $("#txt_id").val();
    if (id == "") {
        return false;
    } else {
        return doUpload(url + "/"+ id);
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

function BackToProduct() {
    document.location.href = getUrspal() + "admin/newsmanage" ;
}