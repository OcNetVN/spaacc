$(document).ready(function() {
        $("#cboPageNoPRO").change(function () {
        var trang = $("#cboPageNoPRO").val();
            searchProducts(trang);
        });
        $("#cboPageNoPRO1").change(function () {
        var trang1 = $("#cboPageNoPRO1").val();
         var idcha = $("#idcha").val();
            searchProductsCon(idcha,trang1);
        });
        $("#cap").change(function () {
        var cap = $("#cap").val();
            function_cap(cap);
        });
        
       //phatsinhmaloai();
});

function searchProducts(page) {    
   
    var loaicha = $("#loaicha").val();

    curPage = page;    
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/producttype/search_producttype",
        dataType:"text",
        data: {
            PrTy: loaicha,
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
//producttype con
function searchProductsCon(id,page) {    
   
    var loaicon = $("#loaicon").val();
    var cmtid = id;
    curPage = page;    
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/producttype/search_producttype_con",
        dataType:"text",
        data: {
            PrTy: loaicon,
            id: cmtid,
            Page:page},
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                searchProductsCon_Complete(data);
            }
          //alert(data);
        }
    });
}
function searchProductsCon_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
        $("#panelDataPRO1 tbody tr").remove();
        $("#ListFoundPRO1").tmpl(sRes.lst).appendTo("#panelDataPRO1 tbody");
        $("#panelDataPRO1").show(500);
               
        //phân trang
        var totalPage = parseInt(sRes.TotalPage);
        var Curpage = parseInt(sRes.CurPage);
        $("#divTBKQTim1 div").text("Tim duoc " + sRes.TotalRecord + " mau tin cua loai "+ sRes.loaicha);
        $("#divTBKQTim1").show(500);
        TrangHienTai = Curpage;
        TongTrang = totalPage;
        $("#cboPageNoPRO1 option").remove();
        for (var i = 1; i <= totalPage; i++) {
            var sStr = "";
            if (i == TrangHienTai) {
                sStr = "<option value=\"" + i + "\" selected=\"selected\">" + i + "</option>";
            }
            else {
                sStr = "<option value=\"" + i + "\" >" + i + "</option>";
            }
            $("#cboPageNoPRO1").append(sStr);
        }
        $("#idcha").attr("value", sRes.idcha);
    }
}
function themloai()
{
    var cap = $("#cap").val();
    var loaispcha = $("#loaispcha").val();
    var tenvn = $("#tenvn").val();
    var tenen = $("#tenen").val();
    var trangthai = $("#trangthai").val();
    if(tenvn == "")    
    {
        
        $("#err_tenvn").show(300);
    }
    else
    {
        if(tenen == "")
        {
            $("#err_tenen").show(300);
        }
        else
        {
                $.ajax({
                    type:"POST",
                    url:getUrspal() + "admin/producttype/themloaisp",
                    dataType:"text",
                    data: {
                        Cap: cap,
                        Loaispcha: loaispcha,
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
                            //function_cap(cap);
                            $('#ploaicha').removeAttr('style');
                            $("#ploaicha").attr('style','display: none');
                        }
                      //alert(data);
                      }
                });
        }
    }
}
//end producttype con

////
/*function phatsinhmaloai(cap) {
    var capsp = cap;
    $.ajax({
        type:"POST",
        url:getUrspal() + "producttype/phatsinhmaloai",
        dataType:"text",
        data: {
            Capsanpham: capsp},
        cache:false,
        success:function (data) {
          $('#idloaisanpham').html(data['maloai']);  
        }
    });
}*/
function function_cap(cap)
{
    var taocap = cap;
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/producttype/taocap",
        dataType:"text",
        data: {
            TaoCap: taocap},
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                 $("#ploaicha").hide(300); 
                function_cap_success(data);
            }
        }
    });
}
function function_cap_success(data)
{      
    var sRes = JSON.parse(data);
    //var sRes = data;
    if (sRes != null) {
        
       $('#ploaicha').removeAttr('style');
       $( '#ploaicha' ).attr( 'style', sRes.kq );
       //alert(sRes.kq);
    }
}
//sua loai sp
function loadsualoai(CommonId)
{
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
        url:getUrspal() + "admin/producttype/layloaisptheoid",
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
        $("#psualoai").show();
        $("#tenloaichasua").attr("value", sRes.lst[0]['StrValue2']);
        $("#tenvnsua").attr("value", sRes.lst[0]['StrValue2']);
       $("#tenensua").attr("value", sRes.lst[0]['StrValue1']);  
        $("#idsua").attr("value", sRes.lst[0]['CommonId']);
       $('#capsua').empty().append('<option value=0>' + sRes.loai + '</option>');
       if(sRes.loaicha != "")
       {
         $('#psualoai').show();
         $("#tenloaichasua").attr("value", sRes.loaicha);
       }
       else
       {
            $('#psualoai').hide();
            $("#tenloaichasua").attr("value", "");
       }
        //alert(sRes.sql);
    }
}
function sualoai()
{
    var idsua = $("#idsua").val();
    var tenvn = $("#tenvnsua").val();
    var tenen = $("#tenensua").val();
    var trangthai = $("#trangthaisua").val();
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/producttype/suasanpham",
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
                alert('Sua thanh cong');
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
function Resetthem()
{
    $("#cap option").removeAttr("selected");
    $("#loaispcha option").removeAttr("selected");
    $("#tenvn").removeAttr("value");
    $("#tenen").removeAttr("value");
    $("#trangthai option").removeAttr("selected");
    $('#op_cap1').attr('selected','selected');
    $('#status_1').attr('selected','selected');
}
//xoa
function DeleteProduct(id,loai)
{
    var ID=id;
    var Loai=loai;
    var strconfirm = confirm("Bạn có chắc chắn xóa không?");
    if (strconfirm == true)
    {
            $.ajax({
                type:"POST",
                url:getUrspal() + "admin/producttype/xoaloai",
                dataType:"text",
                data: {
                    ma: ID,
                    Caploai: Loai},
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
    if(sRes.loaicha!=0)
    {
        searchProductsCon(sRes.loaicha,1);
    }
}
//reset them
function resetthem()
{
    $("#ploaicha").hide(300);
    $("#err_tenvn").hide(300);
    $("#err_tenen").hide(300);
    $('#op_cap1').attr('selected','selected');
    $('#status_1').attr('selected','selected');
    $("#tenvn").removeAttr("value");
    $("#tenen").removeAttr("value");
}











