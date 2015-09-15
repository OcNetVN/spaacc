

jQuery(document).ready(function($) {
    //$("#divPopupAdv").
    $('#divPopupAdv').bPopup();
      // $('.nav-stacked a').click(function(e) {
    //    e.preventDefault();
    //    
    //    var idx = $(this).parent().index();   
    //    
    //    $('.content:visible').fadeOut(function() {
    //        $('.content').eq(idx).fadeIn();
    //    })
    //    
    //});
   var spanUIDLogBanner    =   $("#spanUIDLogBanner").html();
    if(spanUIDLogBanner == "")
    {
        $("div.wrap-buttons button.btn").removeAttr("data-target");
        $("td.item-price button.btn").removeAttr("data-target");
        $("td.item-title a span").removeAttr("data-target");
        $("span.spanbook").removeAttr("data-target");
    }
    else
    {
        if($('div.wrap-buttons button.btn').hasAttr('data-target')) 
        {
            
        } else {
            $("div.wrap-buttons button.btn").attr("data-target","#serviceModal");
        }
        
        if($('td.item-price button.btn').hasAttr('data-target')) 
        {
            
        } else {
            $("td.item-price button.btn").attr("data-target","#serviceModal");
        }
        
        if($('td.item-title a span').hasAttr('data-target')) 
        {
            
        } else {
            $("td.item-title a span").attr("data-target","#serviceModal");
        }
        if($('span.spanbook').hasAttr('data-target')) 
        {
            
        } else {
            $("span.spanbook").attr("data-target","#serviceModal");
        }
    }
    $("div.wrap-buttons button.btn").bind("click",function(){
        var spanUIDLogBanner    =   $("#spanUIDLogBanner").html();
        if(spanUIDLogBanner == "")
        {
             $('#btnchualogin').trigger('click');
        }
    });
    
    $("td.item-price button.btn").bind("click",function(){
        var spanUIDLogBanner    =   $("#spanUIDLogBanner").html();
        if(spanUIDLogBanner == "")
        {
             $('#btnchualogin').trigger('click');
        }
    });
    
    $("td.item-title a span").bind("click",function(){
        var spanUIDLogBanner    =   $("#spanUIDLogBanner").html();
        if(spanUIDLogBanner == "")
        {
             $('#btnchualogin').trigger('click');
        }
    });
    
    $("span.spanbook").bind("click",function(){
        var spanUIDLogBanner    =   $("#spanUIDLogBanner").html();
        if(spanUIDLogBanner == "")
        {
             $('#btnchualogin').trigger('click');
        }
    });
});

function selectHourProduct(hour) {
    $('#txtSelectecHour').val(hour);
    $("#buttonBookProduct").show();
    $("#ChooseDateBooking").css("display", "");
    $("button.BackToChooseDay").show(500);
    var ste = $("#txtSelectedDay").val();
    $("#spanNgayDaChon").show(500);
    $("#spanNgayDaChon").text("Thời gian bạn đã chọn: " +ste + " " +hour);
   
}

function ReloadTimeForProduct(time) {
    var dayBook = $('#txtSelectedDay').val();
    $("#spanNgayDaChon").show(500);
    if (typeof (dayBook) != 'undefined' && dayBook != null) {
        // Do something with some_variable
        //var hourBook = $('#txtSelectecHour').val();
        var proID = $("#txtProductID").val();
        //alert("Ngay: " + dayBook + " Giờ: " + hourBook + " - MaSP: " + proID);
        
        var now = new Date();
        var ngay = $('#txtSelectedDay').val(); 
        var arr = ngay.split('/');
        var d = parseInt(arr[0]);
        var m = parseInt(arr[1]) - 1;
        var y = arr[2];
        if (y.length == 2) {
            y = parseInt("20" + y);
        }
        var d1 = new Date(y, m, d, 23, 59, 59, 0);  
        if (d1 >= now) {
            $("#divTheCalendar").hide(500);
            $("#btnBackToChooseDay").show();
            $("ul.BackToChooseDay").show();
            $("#spanNgayDaChon").text('Bạn đã chọn ngày: ' + ngay);
            $.ajax({
                type: "POST",
                url: getUrspal() + "index/ReloadTimeForProduct",
                dataType: "json",
                data: {
                    masp: proID,
                    ngaybook: dayBook
                },
                cache: false,
                success: function (data) {
                    ReloadTimeForProduct_complete(data);
                    //alert(data);
                }
            });
        }
        else {
            //alert("Thoi gian chon khong thoa man !!!");
            $("#spanNgayDaChon").text('Thoi gian chon khong thoa man !!! Ngay đã chọn: ' + ngay);
            $("#divTheCalendar").show(500);
            $("#btnBackToChooseDay").hide();
            $(".BackToChooseDay").hide();
        }
    }
}

function BackToChooseDay() {
    $("#divTheCalendar").show(500);
    $("#btnBackToChooseDay").hide(0);
    $("ul.BackToChooseDay").hide(0);
    $("button.BackToChooseDay").hide(0);
}

function ReloadTimeForProduct_complete(data) {
    
    if (data != null) {
        if (data.GotData == "yes") {
            $("#ulListTimeOfProduct").html(data.ReturnValue);
        }
    }
    //$("#ulListTimeOfProduct").show();
    $(".wrap-times").show();
    $("#ChooseDateBooking").css("display","none");
}

//

function SearchProType(proType) {
    var type = proType;
    var loc = "";
    var day = "";

    $.ajax({
        type: "POST",
        url: getUrspal() + "category/getvalueindex",
        dataType: "text",
        data: {
            producttype: type,
            location: loc
        },
        cache: false,
        success: function (data) {
            document.location.href = getUrspal() + "category";
            //searchspa_Complete(data);

        },
        error: function () { alert("Có lỗi xảy ra!"); }
    });
    //  alert("Loai: " + type + "  - Location: "+ loc + "   -  Ngày: " + day );
}

function SearchProTypeParent(proType) {
    var type = proType;
    var loc = "";
    var day = "";

    $.ajax({
        type: "POST",
        url: getUrspal() + "category/getvalueindex",
        dataType: "text",
        data: {
            producttypepartent: type,
            location: loc
        },
        cache: false,
        success: function (data) {
            document.location.href = getUrspal() + "category";
            //searchspa_Complete(data);

        },
        error: function () { alert("Có lỗi xảy ra!"); }
    });
    //  alert("Loai: " + type + "  - Location: "+ loc + "   -  Ngày: " + day );
}

function Search3()
{
    var mangae = "";
    var vali = true;
    var type =$("#txtProductTypeSearch").val(); 
    var loc = $("#txtLocationSearch").val(); 
    var day = $("#txtDateSearch").val(); 
    if(checkproductype(type) == false){
       return;
    }
    else{
        
             $.ajax({
            type:"POST",
            url: getUrspal() + "index/getvalueindex",
            dataType:"text",
            data: {
                producttype: type,
                location: loc
            },
            cache:false,
            success:function (data) {  
                document.location.href = getUrspal() + "category";
            },
            error: function () { alert("Có lỗi xảy ra!"); }
        });
      //  alert("Loai: " + type + "  - Location: "+ loc + "   -  Ngày: " + day );
        
    }
   
}

function checkproductype(type){
    //var vali = true;
    $.ajax({
            type:"POST",
            url: getUrspal() + "index/checkproducttype",
            dataType:"json",
            data: {Productype: type},
            cache:false,
            success:function (data) {
                checktype(data);   
            },
          
        });
}

function checktype(data){  
    var res = data;
    var vali = true;
    if(res != null){
        if(res.str == 0  || res.str =="0")
        {
            //alert("Goi mail thanh cong")
            vali =  false;
        }
        else{
            vali =  true;
        }
    }
    return vali;
}


function DoLogin()
{
    //alert("OKKKK");
    var sUsername = $("#txtUserIDEmail").val();
    var sPassword = $("#txtPass").val();
    if ($.trim(sUsername) === "") {
        $("#spanTBLogin").text("Vui lòng nhập tên đăng nhập !");
        $("#spanTBLogin").css("display", "");
        return;
    }

    if ($.trim(sPassword) === "") {
        $("#spanTBLogin").text("Vui lòng nhập mật mã !");
        $("#spanTBLogin").css("display", "");
        return ;
    }

    //ShowLoading();
    if ($('#checkremember').is(':checked')) 
    {
        $.ajax({
            type:"POST",
            url: getUrspal() + "index/rememberuser",
            dataType:"text",
            data: {
                uid: sUsername,
                pwd: sPassword
            },
            cache:false,
            success:function (data) {
                //cho nay nen viet gi?
            }
        });
    }
    //co khi nao doan duoi phai dua vao if o tren?
    $.ajax({
        url: getUrspal() + "index/Login",
        type: "POST",        
        data: {
            uid: sUsername,
            pwd: sPassword
        },
        dataType: "json",
        //contentType: "application/json; charset=utf-8",
        success: function (data) {
            if (data !== null) {
                if (data.Return === "1" || data.Return === 1) {
                    $(".ChuaLogin").css("display", "none");
                    $(".DaLogin").css("display", "");
                    //TabUserMenu
                    if (data.Modules !== null) {
                        //$("#TabUserMenu ul li").remove();
                        for (i = 0; i < data.Modules.length; i++) {
                            $("#TabUserMenu ul").append("<li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\""+ data.Modules[i].url +"\">" + data.Modules[i].Description + "</a></li>");
                        }
                    }
                    //spanUIDLogBanner
                    $("#spanUIDLogBanner").text(data.Objects.FullName);
                    //spanLastLoginBanner
                    $("#spanLastLoginBanner").text(data.Users.LastLogin);
                    
                    //nghia them ngay 04/05/2015
                    var spanUIDLogBanner    =   $("#spanUIDLogBanner").html();
                    if(spanUIDLogBanner == "")
                    {
                        $("div.wrap-buttons button.btn").removeAttr("data-target");
                        $("td.item-price button.btn").removeAttr("data-target");
                        $("td.item-title a span").removeAttr("data-target");
                        $("span.spanbook").removeAttr("data-target");
                    }
                    else
                    {
                        var attr = $("div.wrap-buttons button.btn").attr('data-target');
                        if (typeof attr !== typeof undefined && attr !== false) {
                            // ...
                        }
                        else {
                            $("div.wrap-buttons button.btn").attr("data-target","#serviceModal");
                        }
                        
                        var attr = $("td.item-price button.btn").attr('data-target');
                        if (typeof attr !== typeof undefined && attr !== false) {
                            // ...
                        }
                        else {
                            $("td.item-price button.btn").attr("data-target","#serviceModal");
                        }
                        
                        var attr = $("td.item-title a span").attr('data-target');
                        if (typeof attr !== typeof undefined && attr !== false) {
                            // ...
                        }
                        else {
                            $("td.item-title a span").attr("data-target","#serviceModal");
                        }
                        
                        var attr = $("span.spanbook").attr('data-target');
                        if (typeof attr !== typeof undefined && attr !== false) {
                            // ...
                        }
                        else {
                            $("span.spanbook").attr("data-target","#serviceModal");
                        }
                    }
                    //end nghia them ngay 04/05/2015
                    
                    $("#spanTBLogin").text("Đăng nhập thành công !");
                    $("#spanTBLogin").css("display", "");
                    //$('#loginModal').collapse();
                    //$("#loginModal").collapse();
                    //$('#loginModal').modal('hide');
                    //$('#loginModal').close();;
                    //btnCloseloginModal
                    $("button#btnCloseloginModal").click();
                    //$('#loginModal.modal.in').modal('hide');
                    //$("#loginModal").removeClass("in");
                    //$(".modal-backdrop").remove();
                    //$("#loginModal").hide();

                    //$('#loginModal').modal('hide');
                    //$(this).modal('hide');
                }
                else if (data.Return === "-1" || data.Return === -1) {
                    $("#spanTBLogin").text("Người dùng này chưa kích hoạt hoặc bị khóa !");
                    $("#spanTBLogin").css("display", "");
                }
                else {
                    $("#spanTBLogin").text("Tên đăng nhập hoặc mật mã không chính xác !");
                    $("#spanTBLogin").css("display", "");
                }
            }

            //CloseLoading();
        },
        error: function () {
            //$("#pLogin").css("display", "");
            //CloseLoading(); 
        }
    });
}

// show forget pass
function ForgetPass(){
    $("#divForgetPass").css("display","");
    $("#divlogin").css("display","none");
}

function BackDoLogin(){
     $("#divlogin").css("display","");
     $("#divForgetPass").css("display","none");
}

function SendForgetPass(){
    var email = $("#txtFogetEmail").val();
    if($.trim(email) === ""){
         $("#spanFogetPass").text("Vui lòng nhập email !!!");
         return;
    }
    else{
        if(ValidateEmail(email)=== false){
           $("#spanFogetPass").text("Email không đúng định dạng !!!");
             return;                                
        }
    }
    
    $.ajax({
        url: getUrspal() + "index/ForgetPass",
        type: "POST",        
        data: {
            email: email
        },
        dataType: "json",
        //contentType: "application/json; charset=utf-8",
        success: function (data) {
            if (data !== null) {
                if (data.Return == "1" || data.Return == 1) {
                    $("#spanFogetPass").text("Gởi lại mật khẩu thành công !");
                }
                
                if (data.Return == "0" || data.Return == 0) {
                    $("#spanFogetPass").text("Email không tồn tại trong hệ thống");
                }
                
                if(data.GMT === "1" || data.GMT === 1){
                   $("#spanFogetPass").text("Gởi lại mật khẩu thành công - Vui lòng kiểm tra lại email !");
                   document.location.href = getUrspal() + "index" ; 
                }
                else{
                     $("#spanFogetPass").text("Gởi mail không thành công - Lỗi đường truyền"); 
                }                                                          
            }

            //CloseLoading();
        },
        error: function () {
            //$("#pLogin").css("display", "");
            //CloseLoading(); 
        }
    });
}
function ValidateEmail(sEmail) {
    if (sEmail.length === 0)
        return false;
    var RE_EMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (RE_EMail.test(sEmail))
        return true;
    return false;
}
      
function ShowLoading() {
    SetLoaddingCenter($("#divLoading"));
    $("#divLoading").removeClass("HideLoader");
    $("#divLoading").addClass("Loader");
}

function CloseLoading() {
    $("#divLoading").removeClass("Loader").addClass("HideLoader");
}

//load ten loai auto complete
function autoloai()
{
    var loai=0;
    $.ajax({
        type:"POST",
        url: getUrspal() + "index/listkind",
        dataType:"text",
        data: {
            Loai: loai},
        cache:false,
        success:function (data) {
            searchkind(data);
            //alert(data);
        }
    });
}



function searchkind(data) { 
    var sRes = JSON.parse(data);
    if (sRes != null) {
        //alert(count(sRes.lst));
        var availableLoai = [];
        for (var i = 0; i < sRes.sodong; i++) 
        {
            availableLoai[i] = sRes.lst[i].StrValue2;
        }
        $( "#listkind" ).autocomplete({
            source: availableLoai
        });
    }
}
//end load ten loai auto complete

//load load place auto complete
function autoplace()
{
    var loai=1;
    $.ajax({
        type:"POST",
        url: getUrspal() + "index/listplace",
        dataType:"text",
        data: {
            Loai: loai},
        cache:false,
        success:function (data) {
            searchplace(data);
            //alert(data);
        }
    });
}
function searchplace(data) { 
    var sRes = JSON.parse(data);
    if (sRes != null) {
        //alert(count(sRes.lst));
        var availableLoai = [];
        for (var i = 0; i < sRes.sodong; i++) 
        {
            availableLoai[i] = sRes.lst[i].StrValue1;
        }
        $( "#listplace" ).autocomplete({
            source: availableLoai
        });
    }
}
//end load place auto complete

//dang nhap trang index
function button_login()
{
    var username_login = $("#username_login").val();
    var exampleInputPassword2 = $("#exampleInputPassword2").val();
    $.ajax({
        type:"POST",
        url:"/nhaplieuspa/index/actionlogin",
        dataType:"text",
        data: {
            Username_login: username_login,
            ExampleInputPassword2: exampleInputPassword2},
        cache:false,
        success:function (data) {
            actionlogin_complete(data);
            //alert(data);
        }
    });
}
function actionlogin_complete(data) {
    var sRes = JSON.parse(data);
    if (sRes.sodong != 0) {
        $('#login_logout').hide();
        //alert(sRes.lst[0].UserId);
        $('#name_user').html(sRes.lst[0].UserId);
        $('#complete_login').show();
        $('#login_err').hide();
    }
    else
    {
        $('#login_err').show();
    }
}
//check session_user
function check_accuser()
{
    var loai=2;
    $.ajax({
        type:"POST",
        url: getUrspal() + "index/checkuser",
        dataType:"text",
        data: {
            Loai: loai},
        cache:false,
        success:function (data) {
            check_accuser_complete(data);
            //alert(data);
        }
    });
}
function check_accuser_complete(data) { 
    var sRes = JSON.parse(data);
    if (sRes.sodong > 0) {
        $('#login_logout').hide();
        //alert(sRes.lst[0].UserId);
        $('#name_user').html(sRes.user_name);
        $('#complete_login').show();
    }
}
//logout session user
function button_logout()
{
    var loai=3; //khong co dung
    $.ajax({
        type:"POST",
        url: getUrspal() + "index/actionlogout",
        dataType:"text",
        data: {
            Loai: loai},
        cache:false,
        success:function (data) {
            button_logout_complete(data);
            //alert(data);
        }
    });
}
function button_logout_complete(data) { 
    var sRes = JSON.parse(data);
    if (sRes.check == "yes") {
        $('#complete_login').hide();
        $('#login_logout').show();

    }
}
// show chi tiet san pham
function showdetailpro(id,promotionid)
{       
    $('#spanNgayDaChon').hide(0);
    BackToChooseDay();
    var ID=id;
    $.ajax({
        type:"POST",
        url: getUrspal() + "index/getdetailpro",
        dataType:"text",
        data: {
            masp: ID,
            promotionid: promotionid},
        cache:false,
        success:function (data) {
            showdetailpro_complete(data);
            //alert(data);
        }
    });
    
    
}
//divTheCalendar div.supercal-footer span.supercal-input

function showdetailpro_complete(data) { 
    var sRes = JSON.parse(data);
    if (sRes !== null) {
        var pro = sRes.Product;
        var pri = sRes.Price;
        var proTime = sRes.ProductTime;
        var spa = sRes.Spa;
        var loc = sRes.Location;
        var spaTime = sRes.SpaTime;
        var comment  = sRes.Comment;
        var commentcon = sRes.CommentCon;
        var comentcreadedBy = sRes.CreadbyComment;
        //alert(comment);

        $("#imgProductLinks").attr("src", sRes.ImgLinks);
        $("#promotionid").attr("value",sRes.promotionid);
        if (pri != null) {
            if(sRes.promotionid != 0 && sRes.promotionid!="0")
            {
                //alert(sRes.price_save);
                $(".spanProductPrice").html('<strike id="firstprice">'+pri.Price+'</strike>');
                $("#firstprice").number(true,0);
                $("#spanProductSavePrice").html(sRes.price_save);
                $("#spanProductSavePrice").number(true,0);
                $("#divsaveprice").show();
            }
            else
            {
                $(".spanProductPrice").html(pri.Price);
                $(".spanProductPrice").number(true,0);
                $("#divsaveprice").hide();
            }
            //$(".spanProductPrice").number(true,0);
        }

        if (pro != null) {
            $linkpro = "productdetail/index/" + pro.ProductID;
            $("#faceboklink").attr("data-href",$linkpro);
            $("#linkproductID").attr("href",$linkpro );
            $("#spanProductName").text(pro.Name);
            $("#txtProductID").val(pro.ProductID);
            $("#divProductDetail0").html(pro.Description);
            $("#divProductDetail1").html(pro.Policy);
            $("#divProductDetail2").html(pro.Restriction);
            $("#divProductDetail3").html(pro.Tips);
            $(".spanProductDuration").text(pro.Duration);
            $("#buttonBookProduct").attr("onclick", "BookThisProduct('" + pro.ProductID + "');");
        }
        
        if (spa != null) {
            $link = "spadetail/index/" + spa.spaID;
            $("#linkspa").attr("href",$link );
            $(".spanSpaName").html(spa.spaName);
            $(".spanSpaAddress").html(spa.Address);

            $("#myModalLabel").html(spa.spaName);
            $("#spanSpaNameModalLabelService").html(spa.spaName);
            var locStr = spa.Location;
            var locArr = locStr.split('|');
            var loc_content = locArr[1];
            var toadoArr = locArr[0].split(',');
            var td_x = parseFloat(toadoArr[0]);
            var td_y = parseFloat(toadoArr[1]);
            init_map(td_x, td_y, loc_content);
            google.maps.event.addDomListener(window, 'load', init_map);
            $(".spanSpaTel").text(spa.Tel);
            $(".spanSpaEmail").text(spa.Email);
            $(".spanSpaWebsite").text(spa.Website);
            $("a.spanSpaWebsite").attr("href","http://"+spa.Website);
        }

        if (loc != null) {
            $(".spanLoactionSpa").text(loc.StrValue1);
            $("#spanLoactionSpa").text(loc.StrValue1);
        }
        
        // add them comment cho popup for product
        if(comment != null){
            if(comment.length > 0){
                 $(".wrap-review-list div").remove();
                  var str = "";
                  for (var i = 0; i < comment.length; i++) {
                      str = str + "<div class=\"wrap-2cols nav-left wrap-review\">";
                      if(comentcreadedBy != null){
                         for(var h = 0; h < comentcreadedBy.length; h++){
                             if(comentcreadedBy[h].UserId == comment[i].CreatedBy){
                                 
                                  var image = comentcreadedBy[h].Avatar;
                                  if(image == ""){
                                      image = "resources/front/images/no-pic-avatar.png";
                                  }
                                  str = str + "<div class=\"col-nav\"><div class=\"wrap-thumb\" style=\"background-image:url("+image+")\"></div></div>";
                                  str = str + "<div class=\"col-content\">";
                                  str = str + "<div class=\"content\">";
                                  str = str + "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"2\" border=\"0\"><tbody>";
                                  str = str + "<tr><td><strong>"+ comentcreadedBy[h].FullName+ "</strong></td> <td align=\"right\">"+ comment[i].CreatedDate +"</td></tr>";
                             }
                            
                         }
                      }
                      
                      
                      str = str + "<tr><td colspan= \"2\">"+ comment[i].Content;
                      str = str + "<div id=\"wrap-add-comment2-popup\" class=\"wrap-add-comment\" style=\"\display:none\">";
                      str = str + "<form role=\"form\">";
                      str = str + "<div class=\"form-group\" ><lable>Nội dung bình luận</lable>";
                      str = str + "<textarea class=\"form-control\" rows=\"3\" id=\"ContentCommetCon\"></textarea>";
                      str = str + "</div>";
                      str = str + "<a href=\"javascript:void(0)\" onclick= \"SendCommentCon("+comment[i].id+")\" class=\"btn btn-default pull-right\">Gởi Bình Luận</a>";
                      str = str + "<a onclick=\"$('#wrap-add-comment2-popup').toggle(300);\">Bình Luận</a>";
                      str = str + "<span id=\"MessageCon2\"></span>";
                      if(commentcon != null){
                          if(commentcon.length > 0){
                              for(var j = 0; j <commentcon.length ; j++){
                                   if(commentcon[j].ParentID == comment[i].id){
                                        str = str + "<div class=\"wrap-2cols nav-left wrap-review\">";
                                        if(comentcreadedBy != null){
                                            for(var e = 0; e < comentcreadedBy.length; e++){
                                                if(comentcreadedBy[e].UserId == commentcon[j].CreatedBy){
                                                     var image = comentcreadedBy[e].Avatar;
                                                      if(image == ""){
                                                          image = "resources/front/images/no-pic-avatar.png";
                                                      }
                                                      
                                                      str = str + "<div class=\"col-nav\"><div class=\"wrap-thumb\" style=\"background-image:url("+image+")\"></div></div>";
                                                     str = str + "<div class=\"col-content\">";
                                                     str = str + "<div class=\"content\">";
                                                     str = str + "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"2\" border=\"0\"><tbody>";
                                                     str = str + "<tr><td><strong>"+ comentcreadedBy[e].FullName+ "</strong></td> <td align=\"right\">"+ commentcon[j].CreatedDate +"</td></tr>";
                                                }
                                            }
                                        }
                                        
                                          str = str + "<tr><td colspan= \"2\">"+ commentcon[j].Content + "</td></tr>";
                                          str = str + "</tbody></table>";
                                          str = str + "</div>";
                                          str = str + "</div>";
                                          str = str + "</div>";
                                   }
                              }
                              
                          }
                      }
                      str = str + "</td></tr>";
                      if(commentcon == null)
                      {
                           str = str + "<tr><td align=\"right\" colspan=\"2\">";
                          str = str + "<a onclick=\"$('#wrap-add-comment2-popup').toggle(300);\">Bình Luận</a>";
                          str = str + "</td></tr>";
                          str = str + "<tr><td colspan=\"2\">";
                          str = str + "<div id=\"wrap-add-comment2-popup\" class=\"wrap-add-comment\" style=\"\display:none\">";
                          str = str + "<form role=\"form\">";
                          str = str + "<div class=\"form-group\" ><lable>Nội dung bình luận</lable>";
                          str = str + "<textarea class=\"form-control\" rows=\"3\" id=\"ContentCommetCon\"></textarea>";
                          str = str + "</div>";
                          str = str + "<a href=\"javascript:void(0)\" onclick= \"SendCommentCon("+comment[i].id+")\" class=\"btn btn-default pull-right\">Gởi Bình Luận</a>";
                          str = str + "<span id=\"messageCommentCon\"></span>";
                          str = str + "</form></div>";
                          str = str + "</td></tr>";
                      }
                     

                      str = str + "</tbody></table>";
                      str = str + "</div>";
                      str = str + "</div>";
                      str = str + "</div>";
                  }
                 $(".wrap-review-list").html(str);
                 alert(str);
            }  
        }
        else{
            $(".wrap-review-list").remove();
        }
        //tableSpaWorkingTime
        if (spaTime != null) {
            //var tt = $("#tableSpaWorkingTime tbody tr:last").index() + 1;
            if (spaTime.length > 0) {
                $("#tableSpaWorkingTime tbody tr").remove();
                var str = "";
                for (var i = 0; i < spaTime.length; i++) {
                    if (spaTime[i].DayOfWeek == "2" || spaTime[i].DayOfWeek == 2) {
                        str = str + "<tr><td nowrap=\"nowrap\">MON</td> <td width=\"100%\" align=\"right\">" + spaTime[i].AvailableHourFrom +":00 - " + spaTime[i].AvailableHourTo +
                        ":00 </td></tr>";
                    }
                    if (spaTime[i].DayOfWeek == "3" || spaTime[i].DayOfWeek == 3) {
                        str = str + "<tr><td nowrap=\"nowrap\">TUE</td> <td width=\"100%\" align=\"right\">" + spaTime[i].AvailableHourFrom + ":00 - " + spaTime[i].AvailableHourTo +
                        ":00 </td></tr>";
                    }
                    if (spaTime[i].DayOfWeek == "4" || spaTime[i].DayOfWeek == 4) {
                        str = str + "<tr><td nowrap=\"nowrap\">WED</td> <td width=\"100%\" align=\"right\">" + spaTime[i].AvailableHourFrom + ":00 - " + spaTime[i].AvailableHourTo +
                        ":00 </td></tr>";
                    }
                    if (spaTime[i].DayOfWeek == "5" || spaTime[i].DayOfWeek == 5) {
                        str = str + "<tr><td nowrap=\"nowrap\">THU</td> <td width=\"100%\" align=\"right\">" + spaTime[i].AvailableHourFrom + ":00 - " + spaTime[i].AvailableHourTo +
                        ":00 </td></tr>";
                    }
                    if (spaTime[i].DayOfWeek == "6" || spaTime[i].DayOfWeek == 6) {
                        str = str + "<tr><td nowrap=\"nowrap\">FRI</td> <td width=\"100%\" align=\"right\">" + spaTime[i].AvailableHourFrom + ":00 - " + spaTime[i].AvailableHourTo +
                        ":00 </td></tr>";
                    }
                    if (spaTime[i].DayOfWeek == "7" || spaTime[i].DayOfWeek == 7) {
                        str = str + "<tr><td nowrap=\"nowrap\">SAT</td> <td width=\"100%\" align=\"right\">" + spaTime[i].AvailableHourFrom + ":00 - " + spaTime[i].AvailableHourTo +
                        ":00 </td></tr>";
                    }
                    if (spaTime[i].DayOfWeek == "8" || spaTime[i].DayOfWeek == 8) {
                        str = str + "<tr><td nowrap=\"nowrap\">SUN</td> <td width=\"100%\" align=\"right\">" + spaTime[i].AvailableHourFrom + ":00 - " + spaTime[i].AvailableHourTo + 
                        ":00 </td></tr>";
                    }
                    if (spaTime[i].DayOfWeek == "9" || spaTime[i].DayOfWeek == 9) {
                        str = str + "<tr><td nowrap=\"nowrap\">HOLIDAYS</td> <td width=\"100%\" align=\"right\">" + spaTime[i].AvailableHourFrom + ":00 - " + spaTime[i].AvailableHourTo +
                        ":00 </td></tr>";
                    }
                }
                $("#tableSpaWorkingTime tbody").append(str);
            }
        }
    }
    
    $(".wrap-times").hide(0);
    $("#buttonBookProduct").hide((0));
    
}
//load review
function BookThisProduct(id) {
    var now = new Date();
    var ngay = $('#txtSelectedDay').val();
    var gio = $('#txtSelectecHour').val();
    var arrgrio = gio.split(':');

    var minutes = parseInt(arrgrio[1]);
    var hours = parseInt(arrgrio[0]);
    var arr = ngay.split('/');
    var d = parseInt(arr[0]);
    var m = parseInt(arr[1]) - 1;
    var y = arr[2];
    if (y.length == 2) {
        y =  parseInt("20" + y);
    }
    //var d1 = new Date(y + '-' + m + '-' + d + ' ' + gio);
    var d1 = new Date(y, m, d, hours, minutes, 0, 0);
    if (d1 > now) {
        //alert("Thoi gian thoa man !!!");
        $("#spanNgayDaChon").text("Thoi gian bạn đặt chỗ: " + d1.toLocaleTimeString());
        BookThisProduct1(id);
    }
    else {
        //
        //alert("Thoi gian chon khong thoa man !!!");
        $("#spanNgayDaChon").text("Thoi gian chon khong thoa man !!!");
    }
}

// thêm hàm comment 

function SendComment(){
    var conent = $("#ContentCommet").val();
    var proID  = $("#txtProductID").val();
     $.ajax({
        type: "POST",
        url: getUrspal() + "index/sendcomments",
        dataType: "text",
        data: {
            content: conent,
            proID:proID
        },
        cache: false,
        success: function (data) {
            SendComment_complete(data);
            //alert(data);
        }
    });
}

function SendComment_complete(data){  
        if(data == "1" || data == 1){
            $('#Message_success').text("Vui lòng chờ duyệt");
            $('#messageCommentCon').text("Vui lòng chờ duyệt");//MessageCon2
            $('#MessageCon2').text("Vui lòng chờ duyệt");
        }
        else{
            $('#Message_success').text("Bình luận không thành công do chưa đăng nhâp");
            $('#messageCommentCon').text("Bình luận không thành công do chưa đăng nhâp");
            $('#MessageCon2').text("Bình luận không thành công do chưa đăng nhâp");
        }
}

function SendCommentCon(id){
    var conent = $("#ContentCommetCon").val();
    var proID  = $("#txtProductID").val();
     $.ajax({
        type: "POST",
        url: getUrspal() + "index/sendcommentcone",
        dataType: "text",
        data: {
            parentID:id,
            content: conent,
            proID:proID
        },
        cache: false,
        success: function (data) {
            //SendComment_complete(data);
            //alert(data);
        }
    });
}

function BookThisProduct1(id) {
    //alert(id); 
    var ngay = $('#txtSelectedDay').val(); //$("#divTheCalendar div.supercal-footer span.supercal-input").text();
    var promotionid = $('#promotionid').val();
    var gio = $('#txtSelectecHour').val();//$('input[name="SpaWorkingTime"]:checked').val();
    //alert("Bạn đã đặt chỗ vào ngày: " + ngay + " - Gio: " + gio );
    $.ajax({
        type: "POST",
        url: getUrspal() + "index/bookintoSession",
        dataType: "text",
        data: {
            promotionid: promotionid,
            masp: id,
            NgaySD: ngay,
            GioSD:gio
        },
        cache: false,
        success: function (data) {
            BookThisProduct_complete(data);
            //alert(data);
        }
    });
}

function BookThisProduct_complete(data) {
    if (data == 1 || data === "1")
    {
        parent.location = getUrspal() + "checkout1";
        var sosp = parseInt($("#spanCardTotalList").text());
        sosp = sosp + 1;
        $("#spanCardTotalList").text(sosp);
    }
}


function loadreview(id)
{
    var ID=id;
    $.ajax({
        type:"POST",
        url: getUrspal() + "index/laycmt",
        dataType:"text",
        data: {
            Id: ID},
        cache:false,
        success:function (data) {
            loadreview_complete(data);
            //alert(data);
        }
    });
}
function loadreview_complete(data) { 
    var sRes = JSON.parse(data);
    $('#review_content').html(sRes.str);
}
//dang ki 
function actionregister()
{
    $('#email_err').hide();
    $('#pass_err').hide();
    $('#thongbaochung').hide();
    var inputEmail3 = $("#inputEmail3").val();
    var inputPassword3 = $("#inputPassword3").val();
    var re_inputPassword3 = $("#re_inputPassword3").val();
    var inputname1 = $("#inputname1").val();
    var inputname2 = $("#inputname2").val();
    var sex = $("#sex").val();
    var Postcode = $("#Postcode").val();
    $.ajax({
        type:"POST",
        url: getUrspal() + "index/actionregister",
        dataType:"text",
        data: {
            username: inputEmail3,
            pass1: inputPassword3,
            pass2: re_inputPassword3,
            ho: inputname1,
            ten: inputname2,
            gioitinh: sex,
            Pcode: Postcode},
        cache:false,
        success:function (data) {
            actionregister_complete(data);
            //alert(data);
        }
    });
}
function actionregister_complete(data) { 
    var sRes = JSON.parse(data);
    if(sRes.thongbao_email!='')
    {
        $('#email_err').html(sRes.thongbao_email);
        $('#email_err').show();
    }
    else
    {
        if(sRes.thongbao_pass!='')
        {
            $('#pass_err').html(sRes.thongbao_pass);
            $('#pass_err').show();
        }
        else
        {
            $('#thongbaochung').html(sRes.thongbaochung);
            $('#thongbaochung').show();
        }
    }

}

function init_map(_x, _y, _content) {
    var myOptions = {
        zoom: 15,
        center: new google.maps.LatLng(_x, _y),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("gmap_canvas_popup"), myOptions);
    marker = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(_x, _y)
    });
    infowindow = new google.maps.InfoWindow({
        content: _content
    });
    google.maps.event.addListener(marker, "click", function () {
        infowindow.open(map, marker);
    });
    infowindow.open(map, marker);
}




