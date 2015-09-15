$(document).ready(function() {
    $("#inputsdt").ForceNumericOnly();
    loadeditprofile();
    $("#se_city").change(function () {
        var locationparentid = $("#se_city").val();
        loadlocationchild(locationparentid);
    });
});
jQuery.fn.ForceNumericOnly =
function () {
    return this.each(function () {
        $(this).keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
                key == 8 ||
                key == 9 ||
                key == 46 ||
                key == 110 ||
                key == 190 ||
                (key >= 35 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        });
    });
};

function loadeditprofile()
{
    $.ajax({
        type:"POST",
        url: getUrspal() + "checkout/loadeditprofile",
        dataType:"text",
        cache:false,
        success:function (data) {
            loadeditprofile_Complete(data);
        },
        error: function () { alert("Có lỗi xảy ra!"); }
    });
}
function loadeditprofile_Complete(data) {
    var sRes = JSON.parse(data);
        //load location
        var sStr_locationfirst = '';
       sStr_locationfirst += "<option value=\"0\">Chọn</option>";
       for (var i = 0; i < sRes.sodong_first_location; i++) 
       {
            sStr_locationfirst += "<option value=\"" + sRes.first_location[i].CommonId + "\" >" + sRes.first_location[i].StrValue1 + "</option>";
        }
        $("#se_city").html(sStr_locationfirst);
}
function loadlocationchild(locationparentid)
{
    $.ajax({
        type:"POST",
        url: getUrspal() + "checkout/loadlocationchild",
        dataType:"text",
        data: {
            Locationparentid: locationparentid},
        cache:false,
        success:function (data) {
            loadlocationchild_Complete(data);
        },
        error: function () { alert("Có lỗi xảy ra!"); }
    });
}
function loadlocationchild_Complete(data)
{
     var sRes = JSON.parse(data);
     //alert(sRes.sodong);
    if(sRes.sodong>0)
    {
        //cap 2 location
        var sStr_locationchild = '';
       for (var j = 0; j < sRes.sodong; j++) 
       {
            sStr_locationchild += "<option value=\"" + sRes.lst[j].CommonId + "\" >" + sRes.lst[j].StrValue1 + "</option>";
        }
        $("#se_dis").html(sStr_locationchild);
    }
}
function btnsubmit()
{
    var inputEmail = $("#inputEmail").val();
    var inputsdt = $("#inputsdt").val();
    var inputdc = $("#inputdc").val();
    var se_city = $("#se_city").val();
    var se_dis = $("#se_dis").val();
    var Fullname = $("#fullname").val();
    $("#err_email").hide();
    $("#err_dt").hide();
    $("#err_city").hide();
    $("#err_hoten").hide();
    if(inputEmail=="" || inputEmail==null || inputEmail==0)
    {
        $("#err_email").html("Không được rỗng");
        $("#err_email").show();
    }
    else
    {
		if(Fullname=="" || Fullname==null || Fullname==0)
		{
			$("#err_hoten").html("Không được rỗng");
			$("#err_hoten").show();
		}
		else
		{
			if(inputsdt=="" || inputsdt==null || inputsdt==0)
			{
				$("#err_dt").html("Không được rỗng");
				$("#err_dt").show();
			}
			else
			{
				if(inputsdt.length>11 || inputsdt.length<10)
				{
					$("#err_dt").html("Số điện thoại không đúng");
					$("#err_dt").show();
				}
				else
				{
					if(se_city=="0" || se_city==null || se_city==0)
					{
						$("#err_city").html("Vui lòng chọn");
						$("#err_city").show();
					}
					else
					{
						$.ajax({
							type:"POST",
							url: getUrspal() + "checkout/btnsubmit",
							dataType:"text",
							data: {
								Email: inputEmail,
								fullname: Fullname,
								sdt: inputsdt,
								dc: inputdc,
								dis: se_dis},
							cache:false,
							success:function (data) {
								btnsubmit_Complete(data);
							},
							error: function () { alert("Có lỗi xảy ra!"); }
						});
					}
				}
			}
		}
    }
}
function btnsubmit_Complete(data)
{
    $("#err_email").hide();
    $("#err_pass").hide();
    $("#err_repass").hide();
    $("#err_dt").hide();
    $("#err_city").hide();
    $("#err_hoten").hide();
    var sRes = JSON.parse(data);
    if(sRes.tbchung=="ok")
    {
        parent.location='checkout1';
        
    }
    else
    {
        $("#err_email").html(sRes.tbemail);
        $("#err_email").show();
    }
}
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
        url: getUrspal() + "checkout/Login",
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
                    //$('#loginModal').modal('toggle');
                    parent.location='checkout1';
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