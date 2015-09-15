$(document).ready(function() {
    $("#inputtel").ForceNumericOnly();
    $("#inputcmnd").ForceNumericOnly();
    $("#inputmsthue").ForceNumericOnly();
    loadeditprofile();
    $("#se_city").change(function () {
        var locationparentid = $("#se_city").val();
        loadlocationchild(locationparentid);
    });
    //loadex_info();
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
        url: getUrspal() + "useredit/loadeditprofile",
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
    //alert(sRes.rowuser[0].Email);
    //alert(sRes.sodong_hinh);
    if(sRes.sodong>0)
    {
        $("#inputEmail").val(sRes.rowuser[0].Email);
        $("#inputtel").val(sRes.rowuser[0].Tel);
        $("#inputadd").val(sRes.rowuser[0].PerAdd);
        ////
        $("#inputname").val(sRes.rowuser[0].FullName);
        $("#inputcmnd").val(sRes.rowuser[0].PID);
        var ngaycap="";
        //alert(sRes.rowuser[0].PIDState);
        //alert(sRes.rowuser[0].DoB);
        if(sRes.rowuser[0].PIDState != "" && sRes.rowuser[0].PIDState != "0000-00-00 00:00:00" && sRes.rowuser[0].PIDState != null)
        {
            ngaycap=yyyymmddhhmmss_to_ddmmyyyy(sRes.rowuser[0].PIDState);
        }
        $("#inputngaycap").val(ngaycap);
        $("#inputnoicap").val(sRes.rowuser[0].PIDIssue);
        var ngaysinh="";
        if(sRes.rowuser[0].DoB != "" && sRes.rowuser[0].DoB != "0000-00-00 00:00:00" && sRes.rowuser[0].DoB != null)
            ngaysinh=yyyymmddhhmmss_to_ddmmyyyy(sRes.rowuser[0].DoB);
        $("#inputngaysinh").val(ngaysinh);
        $("#inputnoisinh").val(sRes.rowuser[0].PoB);
        $("#inputthuongtru").val(sRes.rowuser[0].PerAdd);
        $("#inputtamtru").val(sRes.rowuser[0].TemAdd);
        $("#inputfax").val(sRes.rowuser[0].Fax);
        $("#inputwebsite").val(sRes.rowuser[0].Website);
        $("#inputmsthue").val(sRes.rowuser[0].TaxCode);
        $("#inputghichu").val(sRes.rowuser[0].Note);
        //load location
        var sStr_locationfirst = '';
        if(sRes.locationparent!="")
            sStr_locationfirst += "<option value=\"" + sRes.locationparent[0].CommonId + "\">" + sRes.locationparent[0].StrValue1 + "</option>";
       for (var i = 0; i < sRes.sodong_first_location; i++) 
       {
            sStr_locationfirst += "<option value=\"" + sRes.first_location[i].CommonId + "\" >" + sRes.first_location[i].StrValue1 + "</option>";
        }
        $("#se_city").html(sStr_locationfirst);
        
        //cap 2 location
        var sStr_locationchild = '';
        if(sRes.locationchild_now!="")
            sStr_locationchild += "<option value=\"" + sRes.locationchild_now[0].CommonId + "\">" + sRes.locationchild_now[0].StrValue1 + "</option>";
       for (var j = 0; j < sRes.sodong_locationchild; j++) 
       {
            sStr_locationchild += "<option value=\"" + sRes.locationchild[j].CommonId + "\" >" + sRes.locationchild[j].StrValue1 + "</option>";
        }
        $("#se_dis").html(sStr_locationchild);
        
         var sStr_gander = '';
         if(sRes.rowuser[0].Gender=='1' || sRes.rowuser[0].Gender=='1')
         {
            sStr_gander += "<option value=\"1\" selected=\"selected\">Nữ</option>";
            sStr_gander += "<option value=\"0\">Nam</option>";
         }
         else
         {
            sStr_gander += "<option value=\"0\" selected=\"selected\">Nam</option>";
            sStr_gander += "<option value=\"1\">Nữ</option>";
         }
        $("#se_gander").html(sStr_gander);
        
        if(sRes.sodong_hinh>0)
        {
            var url= getUrspal() + sRes.rowhinh[0].URL;
            $("#avatar_profile").attr('style','background-image:url(' + url + ');');
        }
        else
        {
            $("#avatar_profile").attr('style','background-image:url(' + getUrspal() + 'resources/front/images/nouserimages.png);');
        }
    }
}
function yyyymmddhhmmss_to_ddmmyyyy(str)
{
        var strymdhms=str.substr(0,10);
        var ngay=strymdhms.substr(8,2);
        var thang=strymdhms.substr(5,2);
        var nam=strymdhms.substr(0,4);
        strymdhms= thang + "/" + ngay + "/" + nam;
        return strymdhms;
}
function loadlocationchild(locationparentid)
{
    $.ajax({
        type:"POST",
        url: getUrspal() + "useredit/loadlocationchild",
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
function extention_info(flag)
{
    
    if(flag==1 || flag=="1")
    {
        var str="";
        str += "<a href=\"javascript:void(0);\" onclick=\"extention_info(0);\">";
        str += "Thông tin mở rộng";
        str += "</a>";
        $("#div_ex_info").html(str);
        $("#ex_infomation").show();
    }
    else
    {
        if(flag==0 || flag=="0")
        {
            var str="";
            str += "<a href=\"javascript:void(0);\" onclick=\"extention_info(1);\">";
            str += "Thông tin mở rộng";
            str += "</a>";
            $("#div_ex_info").html(str);
            $("#ex_infomation").hide();
        }
    }
}
function btnsave()
{
    $("#err_tel").hide();
    $("#err_ngaycap").hide();
    $("#err_ngaysinh").hide();
    $("#err_website").hide();
    $("#success").hide();
    
    var inputEmail=$("#inputEmail").val();
    var inputtel=$("#inputtel").val();
    var se_dis=$("#se_dis").val();
    var inputadd=$("#inputadd").val();
    var inputname=$("#inputname").val();
    var inputcmnd=$("#inputcmnd").val();
    var inputngaycap=$("#inputngaycap").val();
    var inputnoicap=$("#inputnoicap").val();
    var inputngaysinh=$("#inputngaysinh").val();
    var inputnoisinh=$("#inputnoisinh").val();
    var inputtamtru=$("#inputtamtru").val();
    var inputthuongtru=$("#inputthuongtru").val();
    var se_gander=$("#se_gander").val();
    var inputfax=$("#inputfax").val();
    var inputwebsite=$("#inputwebsite").val();
    var inputmsthue=$("#inputmsthue").val();
    var inputghichu=$("#inputghichu").val();
    
    var usertype=$("#usertype").val();
    if(usertype==0 || usertype=="0") //fb or g+
    {
                $.ajax({
                    type:"POST",
                    url: getUrspal() + "useredit/btnsave",
                    dataType:"text",
                    data: {
                        dinputEmail: inputEmail,
                        dinputtel: inputtel,
                        dse_dis: se_dis,
                        dinputadd: inputadd,
                        dinputname: inputname,
                        dinputcmnd: inputcmnd,
                        dinputngaycap: inputngaycap,
                        dinputnoicap: inputnoicap,
                        dinputngaysinh: inputngaysinh,
                        dinputnoisinh: inputnoisinh,
                        dinputtamtru: inputtamtru,
                        dinputthuongtru: inputthuongtru,
                        dse_gander: se_gander,
                        dinputfax: inputfax,
                        dinputwebsite: inputwebsite,
                        dinputmsthue: inputmsthue,
                        dinputghichu: inputghichu,
                        },
                    cache:false,
                    success:function (data) {
                        btnsave_Complete(data);
                    },
                    error: function () { alert("Có lỗi xảy ra!"); }
                });
    }
    else //member account
    {
                    if(inputngaycap.length>10 || (inputngaycap.length<10 && inputngaycap!=""))
                    {
                        $("#err_ngaycap").html('Không chính xác');
                        $("#err_ngaycap").show();
                    }
                    else
                    {
                        if(inputngaysinh.length>10 || (inputngaysinh.length<10 && inputngaysinh!=""))
                        {
                            $("#err_ngaysinh").html('Không chính xác');
                            $("#err_ngaysinh").show();
                        }
                        else
                        {
                            $.ajax({
                                type:"POST",
                                url: getUrspal() + "useredit/btnsave",
                                dataType:"text",
                                data: {
                                    dinputEmail: inputEmail,
                                    dinputtel: inputtel,
                                    dse_dis: se_dis,
                                    dinputadd: inputadd,
                                    dinputname: inputname,
                                    dinputcmnd: inputcmnd,
                                    dinputngaycap: inputngaycap,
                                    dinputnoicap: inputnoicap,
                                    dinputngaysinh: inputngaysinh,
                                    dinputnoisinh: inputnoisinh,
                                    dinputtamtru: inputtamtru,
                                    dinputthuongtru: inputthuongtru,
                                    dse_gander: se_gander,
                                    dinputfax: inputfax,
                                    dinputwebsite: inputwebsite,
                                    dinputmsthue: inputmsthue,
                                    dinputghichu: inputghichu,
                                    },
                                cache:false,
                                success:function (data) {
                                    btnsave_Complete(data);
                                },
                                error: function () { alert("Có lỗi xảy ra!"); }
                            });
                        }
                    }
    }
}
function btnsave_Complete(data)
{
    var sRes = JSON.parse(data);
        if(sRes.tbwebsite!="" && sRes.tbwebsite!=null)
        {
            //alert(sRes.tbwebsite);
            $("#err_website").html(sRes.tbwebsite);
            $("#err_website").show();
        }
        else
        {
            if(sRes.tbngaycap!="" && sRes.tbngaycap!=null)
            {
                //alert(sRes.tbngaycap);
                $("#err_ngaycap").html(sRes.tbngaycap);
                $("#err_ngaycap").show();
            }
            else
            {
                if(sRes.tbngaysinh!="" && sRes.tbngaysinh!=null)
                {
                   // alert(sRes.tbngaysinh);
                    $("#err_ngaysinh").html(sRes.tbngaysinh);
                    $("#err_ngaysinh").show();
                }
                else
                {
                    if(sRes.resquery=="1" && sRes.resquery==1)
                    {
                        //alert(sRes.resquery);
                        $("#success").html('Cập nhật thành công');
                        $("#success").show();
                        setTimeout(function(){
                            parent.location=getUrspal() + "admin/user/logout";
                        }, 1500);
                    }
                    else
                    {
                        //alert(sRes.resquery);
                        $("#success").html('Có lỗi xảy ra');
                        $("#success").show();
                    }
                }
            }
        }
}
function btncancel()
{
    parent.location='indexuser';
}
function btndoipass()
{
    $("#resultchangepass").hide();
    $("#err_remkmoi").hide();
    $("#err_mkmoi").hide();
    $("#err_mkcu").hide();
    var OldPassword=$("#OldPassword").val();
    //alert(OldPassword);
    var NewPassword=$("#NewPassword").val();
    var ReNewPassword=$("#ReNewPassword").val();
    if(OldPassword=="")
    {
        $("#err_mkcu").html('Không được rỗng');
        $("#err_mkcu").show();
    }
    else
    {
        if(NewPassword=="")
        {
            $("#err_mkmoi").html('Không được rỗng');
            $("#err_mkmoi").show();
        }
        else
        {
            if(ReNewPassword=="")
            {
                $("#err_remkmoi").html('Không được rỗng');
                $("#err_remkmoi").show();
            }
            else
            {
                if(NewPassword!=ReNewPassword)
                {
                    $("#err_remkmoi").html('Không chính xác');
                    $("#err_remkmoi").show();
                }
                else
                {
                    $.ajax({
                        type:"POST",
                        url: getUrspal() + "useredit/btndoipass",
                        dataType:"text",
                        data: {
                            dOldPassword: OldPassword,
                            dNewPassword: NewPassword
                            },
                        cache:false,
                        success:function (data) {
                            btndoipass_Complete(data);
                        },
                        error: function () { alert("Có lỗi xảy ra!"); }
                    });
                }
            }
        }
    }
}
function btndoipass_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes.tbmatkhau!="")
    {
        $("#err_mkcu").html('Không chính xác');
        $("#err_mkcu").show();
    }
    else
    {
        if(sRes.query=="1" && sRes.query==1)
        {
            //alert(sRes.resquery);
            $("#resultchangepass").html('Cập nhật thành công');
            $("#resultchangepass").show();
        }
        else
        {
            //alert(sRes.resquery);
            $("#resultchangepass").html('Có lỗi xảy ra');
            $("#resultchangepass").show();
        }
    }
}