$(document).ready(function() {
        $("#phuongthucthem").click(function () {
           $("#divtab2").show(300);
           $("#divtab1").hide(300);
            $("#divtab3").hide(300);
           $("#tbsuccess").hide();
           $("#tberr").hide(); 
        });
        $("#phuongthucdanhsach").click(function () {
           $("#divtab1").show(300);
           $("#divtab2").hide(300);
           $("#divtab3").hide(300);
           searchvoucher(1);
        });
        $("#appid").notspace();
        $("#vouchertype").notspace();
        $("#suavouchertype").notspace();
        $("#suaappid").notspace();
        $("#cboPageNoPRO").change(function () {
            var trang = $("#cboPageNoPRO").val();
            searchvoucher(trang);
        });
});
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
function btnthem()
{
    var vouchertype=$("#vouchertype").val();
    var appid=$("#appid").val();
    var mota=$("#mota").val();
    if(vouchertype=="" || vouchertype==null)
    {
        $("#tbvouchertype").html("Không được rỗng");
        $("#tbvouchertype").show();
    }
    else
    {
        if(appid=="" || appid==null)
        {
            $("#tbappid").html("Không được rỗng");
            $("#tbappid").show();
        }
        else
        {
            $.ajax({
                type:"POST",
                url:getUrspal() + "admin/vouchertype/btnthem",
                dataType:"text",
                data: {
                    vouchertype:vouchertype,
                    appid: appid,
                    mota: mota},
                cache:false,
                success:function (data) {
                    if( data== "-1" || data==="-1" || data==-1 )
                    {
                        alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
                    }
                    else
                    {
                        btnthem_Complete(data);
                    }
                }
            });
        }
    }
}
function btnthem_Complete(data)
{
    $("#tbvouchertype").hide();
    $("#tbappid").hide();
    var sRes = JSON.parse(data);
    if(sRes.sd==1 || sRes.sd=="1")
    {
        $("#tbsuccess").html(sRes.tb);
        $("#tbsuccess").show();        
    }
    else
    {
        $("#tberr").html(sRes.tb);
        $("#tberr").show(); 
    }
}
//nhan nut danh sach
function searchvoucher(page) {    
    curPage = page;    
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/vouchertype/searchvoucher",
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
                searchvoucher_Complete(data);
            }
          //alert(data);
        }
    });
}

function searchvoucher_Complete(data) {
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
        url:getUrspal() + "admin/vouchertype/sua",
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
    var sRes = JSON.parse(data);
    if (sRes != null) {
        $("#suavouchertype").val(sRes.VourcherType);
        $("#suaappid").val(sRes.AppID);
        //alert(sRes.Description);
        $("#suamota").val(sRes.Description);
        $("#suaid").val(sRes.id);
    }
}
function btnsua()
{
    $("#suatbvouchertype").hide();
    $("#suatbappid").hide();
    var id=$("#suaid").val();
    var vouchertype=$("#suavouchertype").val();
    var appid=$("#suaappid").val();
    var mota=$("#suamota").val();
    if(vouchertype=="" || vouchertype==null)
    {
        $("#suatbvouchertype").html("Không được rỗng");
        $("#suatbvouchertype").show();
    }
    else
    {
        if(appid=="" || appid==null)
        {
            $("#suatbappid").html("Không được rỗng");
            $("#suatbappid").show();
        }
        else
        {
            $.ajax({
                type:"POST",
                url:getUrspal() + "admin/vouchertype/btnsua",
                dataType:"text",
                data: {
                    vouchertype:vouchertype,
                    appid: appid,
                    id: id,
                    mota: mota},
                cache:false,
                success:function (data) {
                    if( data== "-1" || data==="-1" || data==-1 )
                    {
                        alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
                    }
                    else
                    {
                        btnsua_Complete(data);
                    }
                }
            });
        }
    }
}
function btnsua_Complete(data)
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
    //alert(id);
    //alert(page);
    var strconfirm = confirm("Bạn muốn tiếp tục?");
    if (strconfirm == true)
    {
        $.ajax({
            type:"POST",
            url:getUrspal() + "admin/vouchertype/xoa",
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
            searchvoucher(page);
        else
        {
            if(sRes.tt==2 || sRes.tt=="2") //co voucher nen khong dc xoa
            {
                alert("Loại này không được xoá");
                searchvoucher(page);
            }
            else //xoa bi loi
            {
                alert("Có lỗi xảy ra, vui lòng thử lại");
                searchvoucher(page);
            } 
        }
    }
    
}