$(document).ready(function() {
    $("#giathem").number(true, 0);
        $("#phuongthucdanhsach").click(function () {
            $("#divTBKQTim").show(500);
            $("#khungtim").hide(300);
            $("#panelDataPRO").show(300);
            $("#loaicha").val(0);
            $("#listspa").val(0);
            $("#loaicon").val(0);
            $("#timten").val();
            searchProducts(1);
        });
        $("#phuongthuctim").click(function () {
            var sStr="";
            sStr += "<option value=\"0\">Tất cả</option>";
            $("#loaicon").html(sStr);
            $("#divTBKQTim").hide(300);
            layloaicha();
            layspa();
            $("#khungtim").show(500);
            $("#panelDataPRO").hide(300);
            
            $("#khongtimthay").hide(200);
            $("#panelDataPRO").hide(200);
            $("#cboPageNoPRO").hide(200);
            $("#divTBKQTim").hide(200);
            //hide list gia
            $("#panelDataPRO1").hide(200);
            $("#cboPageNoPRO1").hide(200);
            $("#divTBKQTim1").hide(200);
            $("#khongtimthaygia").hide(200);
        });
         $("#loaicha").change(function () {
            $("#loaicon").append("");
            $("#loaicon").html('<option value="0">Tất cả</option>');
            var idcha = $("#loaicha").val();
            loadloaicon(idcha);
        });
        
        $("#cboPageNoPRO").change(function () {
        var trang = $("#cboPageNoPRO").val();
        searchProducts(trang);
    });
        
       // $("#cboPageNoPRO1").change(function () {
//        var trang = $("#cboPageNoPRO1").val();
         // var cmtid = id;
//          var Name = name;
//          ViewGia(id,name,trang);
//        });
});

function layloaicha() {   
    var loaicha=0;
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/price/layloaicha",
        dataType:"text",
        data: {
            Loaicha: loaicha},
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                showloaicha(data);
            }
          //alert(data);
        }
    });
}
function showloaicha(data)
{
    var sRes = JSON.parse(data);
    var sStr = '';
   sStr += "<option value=\"0\">Tất cả</option>";
   for (var i = 0; i < sRes.sodong; i++) 
   {
        //var idloai= sRes.lst[i].StrValue2;
        //alert(idloai);
        sStr += "<option value=\"" + sRes.lst[i].CommonId + "\" >" + sRes.lst[i].StrValue2 + "</option>";
    }
    $("#loaicha").html(sStr);
}
//lay spa
function layspa() {   
    var loaispa=0;
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/price/layspa",
        dataType:"text",
        data: {
            Loaispa: loaispa},
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                showspa(data);
            }
          //alert(data);
        }
    });
}
function showspa(data)
{
    var sRes = JSON.parse(data);
    var sStr = '';
   sStr += "<option value=\"0\">Tất cả</option>";
   for (var i = 0; i < sRes.sodong; i++) 
   {
        //var idloai= sRes.lst[i].StrValue2;
        //alert(idloai);
        sStr += "<option value=\"" + sRes.lst[i].spaID + "\" >" + sRes.lst[i].spaName + "</option>";
    }
    $("#listspa").html(sStr);
}
//load loai con
function loadloaicon(idcha) {   
    var loaicon=0;
    var IDcha=idcha;
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/price/layloaicon",
        dataType:"text",
        data: {
            Loaicon: loaicon,
            IDCha: IDcha},
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                showloaicon(data);
            }
          //alert(data);
        }
    });
}
function showloaicon(data)
{
    var sRes = JSON.parse(data);
    var sStr = '';
   // alert(sRes.lst[0]['CommonId']);
   if(sRes.sodong>0)
   {
        for (var i = 0; i < sRes.sodong; i++) 
           {
                //var idloai= sRes.lst[i].StrValue2;
                //alert(idloai);
                sStr += "<option value=\"" + sRes.lst[i].CommonId + "\" >" + sRes.lst[i].StrValue2 + "</option>";
            }
            $("#loaicon").append(sStr);
   }
   
}


//reset
function Resettim()
{
    $("#loaicha option").removeAttr("selected");
    $("#listspa option").removeAttr("selected");
    $("#loaicon option").removeAttr("selected");
    $("#timten").removeAttr("value");
     $("#loaicon option").remove();
     $("#loaicon").html('<option value="0">Tất cả</option>');
     $("#listspa option").remove();
     $("#listspa").html('<option value="0">Tất cả</option>');
}

//nhan nut tim
function searchProducts(page) {    
   
    var loaicha = $("#loaicha").val();
    var listspa = $("#listspa").val();
    var loaicon = $("#loaicon").val();
    var timten = $("#timten").val();

    curPage = page;    
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/price/search_products",
        dataType:"text",
        data: {
            Loaicha: loaicha,
            Loaicon: loaicon,
            Listspa: listspa,
            Timten: timten,
            Page:page},
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                searchProducts_Complete(data);
            }
          //alert(data);
        }
    });
}

function searchProducts_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
        if(sRes.TotalRecord !=0)
        {
            $("#panelDataPRO1").hide(200);
            $("#cboPageNoPRO1").hide(200);
            $("#divTBKQTim1").hide(200);
            $("#khongtimthaygia").hide(200);
            $("#khungthemgia").hide(200);
            
            $("#khongtimthay").hide(200);
             $("#cboPageNoPRO").show(300);
            $("#panelDataPRO tbody tr").remove();
            $("#ListFoundPRO").tmpl(sRes.lst).appendTo("#panelDataPRO tbody");
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
            
            //an list gia
            $("#panelDataPRO1").hide(200);
            $("#cboPageNoPRO1").hide(200);
            $("#divTBKQTim1").hide(200);
            $("#khongtimthaygia").hide(200);
            
        }
    }
}
// xem danh sach gia cua san pham
function ViewGia(id,name,page) {    
   
    var cmtid = id;
    var Name = name;
    curPage = page;    
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/price/ViewGia",
        dataType:"text",
        data: {
            id: cmtid,
            NAME:Name,
            Page:page},
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                ViewGia_Complete(data);
            }
          //alert(data);
        }
    });
}
function ViewGia_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
         $("#khongtimthay").hide(200);
        $("#panelDataPRO").hide(200);
        $("#cboPageNoPRO").hide(200);
        $("#divTBKQTim").hide(200);
        $("#khungthemgia").hide(200);
        $("#cboPageNoPRO1").show(200);
        if(sRes.TotalRecord>0)
        {
            $("#panelDataPRO1 tbody tr").remove();
            $("#ListFoundPRO1").tmpl(sRes.lst).appendTo("#panelDataPRO1 tbody");
            $("#panelDataPRO1").show(500);
                   
            //phân trang
            var totalPage = parseInt(sRes.TotalPage);
            var Curpage = parseInt(sRes.CurPage);
            $("#divTBKQTim1 div").text("Tìm được " + sRes.TotalRecord + " mẫu tin của loại "+ sRes.lst[0].Name);
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
        }
        else
        {
            $("#tensanphamtheogia").html(sRes.tensp);
            $("#khongtimthaygia").show(200);  
            $("#panelDataPRO1").hide(200);
            $("#cboPageNoPRO1").hide(200);
            $("#divTBKQTim1").hide(200); 
        }
    }
}
//them gia cho san pham
function themgia(id,ten)
{
    $("#masanphamgia").val(id);
    $("#tensanphamthem").val(ten);
    
    $("#khongtimthaygia").hide(200);  
    $("#panelDataPRO1").hide(200);
    $("#cboPageNoPRO1").hide(200);
    $("#divTBKQTim1").hide(200); 
    $("#panelDataPRO").hide(200);
    $("#cboPageNoPRO").hide(200);
    $("#divTBKQTim").hide(200); 
    $("#khongtimthay").hide(200);
    $("#khungthemgia").show(300);
}

function ReplaceAll(Source, stringToFind, stringToReplace) {
    var temp = Source;
    var index = temp.indexOf(stringToFind);
    while (index != -1) {
        temp = temp.replace(stringToFind, stringToReplace);
        index = temp.indexOf(stringToFind);
    }
    return temp;
}


function submitthemgia()
{
    var masanphamgia = $("#masanphamgia").val();
    var tensanphamthem = $("#tensanphamthem").val();
    var giathem = $("#giathem").val();
    if(giathem == ""){
        alert("Vui lòng nhập giá cho sản phẩm");
        return;
    }
    
    giathem =  ReplaceAll(giathem,",","");
    giathem = parseFloat(giathem);
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/price/themgia",
        dataType:"text",
        data: {
            id: masanphamgia,
            tensp: tensanphamthem,
            Giathem: giathem},
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                alert('Thêm thành công');
                submitthemgia_Complete(data);
            }
          //alert(data);
        },
        error:function(){
            alert('Loi');
        }
        
    });
}
function submitthemgia_Complete(data)
{
    var sRes = JSON.parse(data);
    $("#khongtimthaygia").hide(200);  
    $("#panelDataPRO1").hide(200);
    $("#cboPageNoPRO1").hide(200);
    $("#divTBKQTim1").hide(200); 
    $("#panelDataPRO").hide(200);
    $("#cboPageNoPRO").hide(200);
    $("#divTBKQTim").hide(200); 
    $("#khongtimthay").hide(200);
    $("#khungthemgia").hide(200);
    ViewGia(sRes.masp,sRes.tensp,1);
}
//xoa gia sp
function xoagia(id,ten,idsanpham)
{
    var ID=id;
    var Ten=ten;
    var Idsanpham = idsanpham; 
    var strconfirm = confirm("Bạn có chắc chắn xóa không?");
    if (strconfirm == true)
    {
            $.ajax({
                type:"POST",
                url:getUrspal() + "admin/price/xoagia",
                dataType:"text",
                data: {
                    ma: ID,
                    ten: Ten,
                    IDsanpham: Idsanpham},
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
    ViewGia(sRes.masanpham,sRes.ten,1);
}





