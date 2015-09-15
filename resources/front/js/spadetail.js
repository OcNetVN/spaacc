$(document).ready(function() {
    $("#selPageNo").change(function () {
        searchspa();
        window.location.href="#bookmark1";
     });
}); 

//login
function DoLogin()
{
    //alert("OKKKK");
    var sUsername = $("#txtUserIDEmail").val();
    var sPassword = $("#txtPass").val();
    var strRes = "";
  
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

    $.ajax({
        url: getUrspal() + "spadetail/Login",
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
                    
                    $("#spanTBLogin").text("Đăng nhập thành công !");
                    $("#spanTBLogin").css("display", "");
                    $("button#btnCloseloginModal").click();
                }
                else {
                    //strRes
                    $("#spanTBLogin").text("Tên đăng nhập hoặc mật mã không chính xác !");
                    $("#spanTBLogin").css("display", "");
                }
            }
            
            //CloseLoading();
        },
        error: function () {
        }
    });

    //return strRes;
}
function btnsendcomment(cmtid,spaid)
{
    var content=$("#contentaddcmt_" + cmtid).val();
    //alert(content);
    $.ajax({
        type:"POST",
        url: getUrspal() + "spadetail/btnsendcomment",
        dataType:"text",
        data: {
            dcmtid: cmtid,
            dspaid: spaid,
            dcontent: content},
        cache:false,
        success:function (data) {
            btnsendcomment_Complete(data);
        },
        error: function () { alert("Có lỗi xảy ra!"); }
    });
}
function btnsendcomment_Complete(data)
{
    var sRes = JSON.parse(data);
    $("#addcomment__" + sRes.formcmt).hide();
    if(sRes.tbchung=="ok")
    {
        alert("Bình luận của bạn đang chờ xét duyệt");
    }
    else
    {
        alert("Có lỗi xảy ra!");
    }
}