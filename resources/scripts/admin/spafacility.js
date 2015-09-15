$(document).ready(function() {
        $("#cboPageNoPRO").change(function () {
        var trang = $("#cboPageNoPRO").val();
            searchProducts(trang);
        });
		$("#err_tenvn").hide();
       //phatsinhmaloai();
});

function searchProducts(page) {    
    curPage = page;    
    $("#err_tenvn").hide();
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/spafacility/search_producttype",
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
                 $("#pannel_suasanpham").attr('style','display: none');
                 $("#divTBKQTim1").attr('style','display: none');
                 $("#panelDataPRO1").attr('style','display: none');
                searchProducts_Complete(data);
            }
          //alert(data);
        }
    });
}

function searchProducts_Complete(data) {
    
    $("#pannel_suasanpham").attr('style','display: none');
    $("#quaylai").hide(300);
    $('#btnsearch').show(300);
    var sRes = JSON.parse(data);
    if (sRes != null) {
        $("#panelDataPRO tbody tr").remove();
        $("#ListFoundPRO").tmpl(sRes.lst).appendTo("#panelDataPRO tbody");
        $("#panelDataPRO").show(500);
               
        //phân trang
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
}

function themloai()
{
	$("#err_tenvn").hide();
    var tenvn = $("#tenvn").val();
    var tenen = $("#tenen").val();
    var trangthai = $("#trangthai").val();
    if(tenvn == "")    
    {
        
        $("#err_tenvn").show(300);
    }
    else
    {
                $.ajax({
                    type:"POST",
                    url:getUrspal() + "admin/spafacility/themloaisp",
                    dataType:"text",
                    data: {
                        Tenvn: tenvn,
                        Tenen: tenen,
                        Trangthai:trangthai},
                    cache:false,
                    success:function (data) {
                        if( data== "-1" || data==="-1" || data==-1 )
                        {
                            alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
                        }
                        else
                        {
                            Resetthem();
                            alert('Thêm thành công');
                        }
                      //alert(data);
                      }
                });
    }
}
//end spafacility con

//sua loai sp
function loadsualoai(CommonId)
{
	$("#err_tenvnsua").hide();
    $('#panelDataPRO').removeAttr('style');
    $('#panelDataPRO1').removeAttr('style');
    $('#divTBKQTim1').removeAttr('style');
    $('#divTBKQTim').removeAttr('style');
    $('#quaylai').removeAttr('style');
    
    $('#panelDataPRO').attr('style','display: none');
    $('#btnsearch').attr('style','display: none');
    $("#panelDataPRO1").attr('style','display: none');
    $('#divTBKQTim1').attr('style','display: none');
    $("#divTBKQTim").attr('style','display: none');
    $('#pannel_suasanpham').removeAttr('style');
    var Id = CommonId;
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/spafacility/layloaisptheoid",
        dataType:"text",
        data: {
            ID: Id},
        cache:false,
        success:function (data) {
            function_loadloaisp(data);
        }
    });
}
function function_loadloaisp(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
        $("#tenvnsua").attr("value", sRes.lst[0]['StrValue1']);
       $("#tenensua").attr("value", sRes.lst[0]['StrValue2']);  
        $("#idsua").attr("value", sRes.lst[0]['CommonId']);
    }
}
function sualoai()
{
    var idsua = $("#idsua").val();
    var tenvn = $("#tenvnsua").val();
    var tenen = $("#tenensua").val();
    var trangthai = $("#trangthaisua").val();
	if(tenvn == "")    
    {
        
        $("#err_tenvnsua").show(300);
    }
    else
    {
		$.ajax({
			type:"POST",
			url:getUrspal() + "admin/spafacility/suasanpham",
			dataType:"text",
			data: {
				ID: idsua,
				Tenvn: tenvn,
				Tenen: tenen,
				Trangthai: trangthai},
			cache:false,
			success:function (data) {
				if( data== "-1" || data==="-1" || data==-1 )
				{
					alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
				}
				else
				{
					alert('Sửa thành công');
					$('#panelDataPRO').removeAttr('style');
					$('#panelDataPRO1').removeAttr('style');
					$('#divTBKQTim').removeAttr('style');
					$('#divTBKQTim1').removeAttr('style');
					searchProducts(1);
					$("#panelDataPRO1").attr('style','display: none');
					$("#pannel_suasanpham").attr('style','display: none');
				}
			}
		});
	}
}
function Resetthem()
{
    $("#tenvn").removeAttr("value");
    $("#tenen").removeAttr("value");
    $("#trangthai option").removeAttr("selected");
    $('#status_1').attr('selected','selected');
}
//xoa
function DeleteProduct(id)
{
    var ID=id;
    var strconfirm = confirm("Bạn có chắc chắn xóa không?");
    if (strconfirm == true)
    {
            $.ajax({
                type:"POST",
                url:getUrspal() + "admin/spafacility/xoaloai",
                dataType:"text",
                data: {
                    ma: ID},
                cache:false,
                success:function (data) {
                    if( data== "-1" || data==="-1" || data==-1 )
                    {
                        alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
                    }
                    else
                    {
                        xoathanhcong(data);
                    }
                }
            });
    }
}
function xoathanhcong(data)
{
    var sRes = JSON.parse(data);
    alert(sRes.thongbao);
    $("#divTBKQTim").attr('style','display: none');
    $("#panelDataPRO").attr('style','display: none');
    $("#divTBKQTim1").attr('style','display: none');
    $("#panelDataPRO1").attr('style','display: none');
    searchProducts(1);
}
//reset them
function resetthem()
{
    $("#err_tenvn").hide(300);
    $("#err_tenen").hide(300);
    $("#tenvn").removeAttr("value");
    $("#tenen").removeAttr("value");
}











