$(document).ready(function() {
        $("#timcardno").ForceNumericOnly();
        $("#timngaytao").notpress();
        $("#timngayhethan").notpress();
        $("#suangayhethan").notpress();
        $("#themngaytao").notpress();
        $("#themngayhethan").notpress();
        $("#phuongthucthem").click(function () {
           $("#divtab2").show(300);
           $("#divtab1").hide(300);
            $("#divtab3").hide(300);
            $("#divtab4").hide(300);
           $("#tbsuccess").hide();
           $("#tberr").hide(); 
           layloaithethem();
        });
        $("#phuongthucdanhsach").click(function () {
           $("#divtab1").show(300);
           $("#divtab2").hide(300);
           $("#divtab3").hide(300);
           $("#divtab4").hide(300);
           searchmembercard(1);
        });
        $("#phuongthuctim").click(function () {
           $("#divtab4").show(300);
           $("#divtab2").hide(300);
           $("#divtab3").hide(300);
           $("#divtab1").hide(300);
           layloaithe();
        });
        $("#cboPageNoPRO").change(function () {
            var trang = $("#cboPageNoPRO").val();
            searchmembercard(trang);
        });
        $("#timcboPageNoPRO").change(function () {
            var trang = $("#timcboPageNoPRO").val();
            searchmembercard(trang);
        });
});
function validateEmail(email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if( !emailReg.test( email ) ) {
    return false;
  } else {
    return true;
  }
}
jQuery.fn.notpress =
function () {
    return this.each(function () {
        $(this).keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            //delete, backspace
            return (
                key == 8 ||
                key == 46);
        });
    });
};
jQuery.fn.notspace =
function () {
    return this.each(function () {
        $(this).keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
            key != 32);
        });
    });
};

function layloaithethem()
{
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/membercard/layloaithethem",
        dataType:"text",
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                layloaithethem_Complete(data);
            }
        }
    });
}
function layloaithethem_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes!="" && sRes!=null)
    {
        $("#themloaithe").html(sRes);
    }
}
function layloaithe()
{
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/membercard/layloaithe",
        dataType:"text",
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                layloaithe_Complete(data);
            }
        }
    });
}
function layloaithe_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes!="" && sRes!=null)
    {
        $("#timloaithe").html(sRes);
    }
}
function clickbtnsearch()
{
    var timcardno=$("#timcardno").val();
    var timloaithe=$("#timloaithe").val();
    //alert(timloaithe);
    var timngaytao=$("#timngaytao").val();
    var timngayhethan=$("#timngayhethan").val();
    var timnguoidung=$("#timnguoidung").val();
    var timuerid=$("#timuerid").val();
    var timtrangthai=$("#timtrangthai").val();
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/membercard/clickbtnsearch",
        dataType:"text",
        data: {
            timcardno:timcardno,
            timloaithe: timloaithe,
            timngaytao: timngaytao,
            timngayhethan: timngayhethan,
            timnguoidung: timnguoidung,
            timuerid: timuerid,
            timtrangthai: timtrangthai
            },
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                clickbtnsearch_Complete(data);
            }
        }
    });
}
function clickbtnsearch_Complete(data)
{
    var sRes = JSON.parse(data);
    if (sRes != null) {
        if(sRes.TotalRecord !=0)
        {
            $("#timkhongtimthay").hide(200);
             $("#timcboPageNoPRO").show(300);
            $("#timpanelDataPRO tbody tr").remove();
            $("#timpanelDataPRO tbody").html(sRes.str);
            $("#timpanelDataPRO").show(500);
                   
            //phÃ¢n trang
            var totalPage = parseInt(sRes.TotalPage);
            var Curpage = parseInt(sRes.CurPage);
            $("#timdivTBKQTim div").text("Tìm được " + sRes.TotalRecord + " mẫu tin!!!");
            $("#timdivTBKQTim").show(500);
            TrangHienTai = Curpage;
            TongTrang = totalPage;
            $("#timcboPageNoPRO option").remove();
            for (var i = 1; i <= totalPage; i++) {
                var sStr = "";
                if (i == TrangHienTai) {
                    sStr = "<option value=\"" + i + "\" selected=\"selected\">" + i + "</option>";
                }
                else {
                    sStr = "<option value=\"" + i + "\" >" + i + "</option>";
                }
                $("#timcboPageNoPRO").append(sStr);
            }
        }
        else
        {
            $("#timkhongtimthay").show(500);
            $("#timpanelDataPRO").hide(200);
            $("#timcboPageNoPRO").hide(200);
            $("#timdivTBKQTim").hide(200);
        }
    }
}
function clickbtnthem()
{
    $("#themcardno").val("");  
    $("#themmaphatsinh").val("");
    $("#tberrthemngayhethan").hide();
    $("#tberrthemuserid").hide();
    $("#tberrthemnguoidung").hide();
    
    var themloaithe=$("#themloaithe").val();
    //alert(themloaithe);
    var themngayhethan=$("#themngayhethan").val();
    var themnguoidung=$("#themnguoidung").val();
    var themuerid=$("#themuerid").val();
    var themtrangthai=$("#themtrangthai").val();
    if(themngayhethan=="" || themngayhethan==null)
    {
        $("#tberrthemngayhethan").html("Không dược rỗng");
        $("#tberrthemngayhethan").show();
    }
    else
    {
        if(themnguoidung=="" || themnguoidung==null)
        {
            $("#tberrthemnguoidung").html("Không dược rỗng");
            $("#tberrthemnguoidung").show();
        }
        else
        {
            if(themuerid=="" || themuerid==null)
            {
                $("#tberrthemuserid").html("Không dược rỗng");
                $("#tberrthemuserid").show();
            }
            else
            {
                //if(validateEmail(themuerid))
                //{
                    $.ajax({
                        type:"POST",
                        url:getUrspal() + "admin/membercard/clickbtnthem",
                        dataType:"text",
                        data: {
                            themloaithe: themloaithe,
                            themngayhethan: themngayhethan,
                            themnguoidung: themnguoidung,
                            themuerid: themuerid,
                            themtrangthai: themtrangthai
                            },
                        cache:false,
                        success:function (data) {
                            if( data== "-1" || data==="-1" || data==-1 )
                            {
                                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
                            }
                            else
                            {
                                clickbtnthem_Complete(data);
                            }
                        }
                    });
                /*}
                else
                {
                    $("#tberrthemuserid").html("Phải là email");
                    $("#tberrthemuserid").show();
                }*/
            }
        }
    }
}
function clickbtnthem_Complete(data)
{
    $("#themtbsuccess").hide();
    $("#themtberr").hide();
    var sRes = JSON.parse(data);
    if(sRes.sd==1 || sRes.sd=="1")
    {
        $("#themtbsuccess").html(sRes.tb);
        $("#themtbsuccess").show(); 
        $("#themcardno").val(sRes.cardno);  
        $("#themmaphatsinh").val(sRes.generatedID);  
    }
    else
    {
        $("#themtberr").html(sRes.tb);
        $("#themtberr").show(); 
    }
}
//nhan nut danh sach
function searchmembercard(page) {    
    curPage = page;    
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/membercard/searchmembercard",
        dataType:"text",
        data: {
            Page:page},
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                searchmembercard_Complete(data);
            }
          //alert(data);
        }
    });
}

function searchmembercard_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
        if(sRes.TotalRecord !=0)
        {
            $("#khongtimthay").hide(200);
             $("#cboPageNoPRO").show(300);
            $("#panelDataPRO tbody tr").remove();
            $("#panelDataPRO tbody").html(sRes.str);
            $("#panelDataPRO").show(500);
                   
            //phÃ¢n trang
            var totalPage = parseInt(sRes.TotalPage);
            var Curpage = parseInt(sRes.CurPage);
            $("#divTBKQTim div").text("Tìm được " + sRes.TotalRecord + " mẫu tin!!!");
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
        else
        {
            $("#khongtimthay").show(500);
            $("#panelDataPRO").hide(200);
            $("#cboPageNoPRO").hide(200);
            $("#divTBKQTim").hide(200);
        }
    }
}
function sua(id)
{
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/membercard/sua",
        dataType:"text",
        data: {
            id:id},
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                sua_Complete(data);
            }
          //alert(data);
        }
    });
}
function sua_Complete(data)
{
    $("#divtab2").hide(300);
   $("#divtab1").hide(300);
    $("#divtab3").show(300);
    $("#divtab4").hide(300);
    var sRes = JSON.parse(data);
    if (sRes != null) {
        $("#suacardno").val(sRes.card.CardNo);
        $("#suamaphatsinh").val(sRes.card.generatedID);
        var ExpireDate = sRes.card.ExpireDate;
        var datehethan = ExpireDate.split(' ')[0];
        var datehethansx=datehethan.split('-')[1] + "/" + datehethan.split('-')[2] + "/" + datehethan.split('-')[0];
        //alert(datehethansx);
        $("#suangayhethan").val(datehethansx);
        $("#suanguoidung").val(sRes.card.CardHolderName);
        $("#suauerid").val(sRes.card.RefUserID);
        $("#sualoaithe").html(sRes.strloai);
        $("#suatrangthai").html(sRes.strtt);
    }
}
function clickbtnsua()
{
    $("#tberrsuangayhethan").hide();
    $("#tberrsuauserid").hide();
    $("#tberrsuanguoidung").hide();
    
    var suacardno=$("#suacardno").val();    
    var sualoaithe=$("#sualoaithe").val();
    //alert(sualoaithe);
    var suangayhethan=$("#suangayhethan").val();
    var suanguoidung=$("#suanguoidung").val();
    var suauerid=$("#suauerid").val();
    var suatrangthai=$("#suatrangthai").val();
    if(suangayhethan=="" || suangayhethan==null)
    {
        $("#tberrsuangayhethan").html("Không dược rỗng");
        $("#tberrsuangayhethan").show();
    }
    else
    {
        if(suanguoidung=="" || suanguoidung==null)
        {
            $("#tberrsuanguoidung").html("Không dược rỗng");
            $("#tberrsuanguoidung").show();
        }
        else
        {
            if(suauerid=="" || suauerid==null)
            {
                $("#tberrsuauserid").html("Không dược rỗng");
                $("#tberrsuauserid").show();
            }
            else
            {
                if(validateEmail(suauerid))
                {
                    $.ajax({
                        type:"POST",
                        url:getUrspal() + "admin/membercard/clickbtnsua",
                        dataType:"text",
                        data: {
                            suacardno: suacardno,
                            sualoaithe: sualoaithe,
                            suangayhethan: suangayhethan,
                            suanguoidung: suanguoidung,
                            suauerid: suauerid,
                            suatrangthai: suatrangthai
                            },
                        cache:false,
                        success:function (data) {
                            if( data== "-1" || data==="-1" || data==-1 )
                            {
                                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
                            }
                            else
                            {
                                clickbtnsua_Complete(data);
                            }
                        }
                    });
                }
                else
                {
                    $("#tberrsuauserid").html("Phải là email");
                    $("#tberrsuauserid").show();
                }
            }
        }
    }
}
function clickbtnsua_Complete(data)
{
    $("#suatbsuccess").hide();
    $("#suatberr").hide();
    var sRes = JSON.parse(data);
    if(sRes.sd==1 || sRes.sd=="1")
    {
        $("#suatbsuccess").html(sRes.tb);
        $("#suatbsuccess").show();        
    }
    else
    {
        $("#suatberr").html(sRes.tb);
        $("#suatberr").show(); 
    }
}
function xoa(id)
{
    var page = $("#cboPageNoPRO").val();
    if(page=="" || page==null)
        var page = $("#timcboPageNoPRO").val();
    //alert(id);
    //alert(page);
    var strconfirm = confirm("Bạn muốn tiếp tục?");
    if (strconfirm == true)
    {
        $.ajax({
            type:"POST",
            url:getUrspal() + "admin/membercard/xoa",
            dataType:"text",
            data: {
                id: id,
                page: page },
            cache:false,
            success:function (data) {
                if( data== "-1" || data==="-1" || data==-1 )
                {
                    alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
                }
                else
                {
                    xoa_Complete(data);
                }
              //alert(data);
            }
        });
    }
}
function xoa_Complete(data)
{
    var sRes = JSON.parse(data);
    if (sRes != null) {
        if(sRes.page!="")
            var page = sRes.page;
        else
            var page = 1;
        if(sRes.tt==1 || sRes.tt=="1") //xoa dc
        {
            $("#divtab1").show(300);
           $("#divtab2").hide(300);
           $("#divtab3").hide(300);
           $("#divtab4").hide(300);
           searchmembercard(page);
        }
        else
        {
            alert("Có lỗi xảy ra, vui lòng thử lại");
        }
    }
    
}