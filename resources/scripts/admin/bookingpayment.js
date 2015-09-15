$(document).ready(function() {
        $("#phuongthucdanhsach").click(function () {
            $("#khongtimthay").hide(500);
            $("#divTBKQTim").show(500);
            $("#divtab2").hide(500);
            $("#divtab1").show(500);
            $("#panelDataPRO").show(300);
            var txtdatesearch =  $('#txtdatesearch').val();
            if(txtdatesearch != "")
            {
                if(isDate(txtdatesearch))
                    searchProducts(1);
                else
                    alert('Giá trị ngày không chính xác');
            }
            else
                searchProducts(1);
        });
        $("#phuongthucdanhsachhuy").click(function () {
            $("#divtab1").hide(500);
            $("#divtab2").show(500);
            var txtdatesearch =  $('#txtdatesearch').val();
            if(txtdatesearch != "")
            {
                if(isDate(txtdatesearch))
                    searchcancel(1);
                else
                    alert('Giá trị ngày không chính xác');
            }
            else
                searchcancel(1);
        });
        $("#cboPageNoPRO").change(function () {
            var trang = $("#cboPageNoPRO").val();
            searchProducts(trang);
        });
        /*--load spaname for search ---*/
        load_spaname_search();
        
});
//nhan nut danh sach
function searchProducts(page) {    
    curPage = page;    
    var txtspanamesearch    = $("#txtspanamesearch").val();
    var txtdatesearch       = $("#txtdatesearch").val();
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/bookingpayment/search_booking",
        dataType:"text",
        data: {
            Page                : page,
            txtspanamesearch    : txtspanamesearch,
            txtdatesearch       : txtdatesearch},
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
function checkpayment(paymenttype,bookingid,productid,UserId,Email,ObjectId)
{
    var strconfirm = confirm("Bạn muốn tiếp tục?");
    if (strconfirm == true)
    {
        $("body").addClass("loading");
        var page = $("#cboPageNoPRO").val();
        $.ajax({
            type:"POST",
            url:getUrspal() + "admin/bookingpayment/checkpayment",
            dataType:"text",
            data: {
                dpaymenttype:paymenttype,
                dproductid:productid,
                dbookingid:bookingid,
                UserId: UserId,
                Email: Email,
                ObjectId: ObjectId,
                dpage: page},
            cache:false,
            success:function (data) {
                if( data== "-1" || data==="-1" || data==-1 )
                {
                    alert("Bạn không có quyền trên chức năng này ở trang này !!! "); 
                    $("body").removeClass("loading");                   
                }
                else
                {
                    checkpayment_Complete(data);
                }
              //alert(data);
            }
        });
    }
}
function checkpayment_Complete(data)
{
    var sRes = JSON.parse(data);
    if (sRes != null) {
        var arr_bookingid = sRes.arr_bookingid;
        var UserId = sRes.UserId;
        var Email = sRes.Email;
        var ObjectId = sRes.ObjectId;
        //alert("Chuoi xuat"+sRes.status);
        if(sRes.status==1 || sRes.status=='1')
        {
            $.ajax({
                type:"POST",
                url:getUrspal() + "admin/bookingpayment/sendmail",
                dataType:"text",
                data: {
                    dstr_bookingid: arr_bookingid,
                    UserId: UserId,
                    Email: Email,
                    ObjectId: ObjectId},
                cache:false,
                success:function (data) {
                    alert("Cập nhật thành công");
                    searchProducts(sRes.page);
                    $("body").removeClass("loading");
                },
                error: function () { alert("Có lỗi xảy ra!"); $("body").removeClass("loading");
                }
            });
        }
    }
}
//nghia viet 14/1/2015
function searchcancel(page) {    
    curPage = page;    
    var txtspanamesearch    = $("#txtspanamesearch").val();
    var txtdatesearch       = $("#txtdatesearch").val();
        
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/bookingpayment/searchcancel",
        dataType:"text",
        data: {
            Page                : page,
            txtspanamesearch    : txtspanamesearch,
            txtdatesearch       : txtdatesearch},
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                searchcancel_Complete(data);
            }
          //alert(data);
        }
    });
}
function searchcancel_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
        if(sRes.TotalRecord !=0)
        {
            $("#khongtimthay1").hide(200);
             $("#cboPageNoPRO1").show(300);
            $("#panelDataPRO1 tbody tr").remove();
            $("#panelDataPRO1 tbody").html(sRes.str);
            $("#panelDataPRO1").show(500);
                   
            //phÃ¢n trang
            var totalPage = parseInt(sRes.TotalPage);
            var Curpage = parseInt(sRes.CurPage);
            $("#divTBKQTim1 div").text("Tìm được " + sRes.TotalRecord + " mẫu tin!!!");
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
            $("#khongtimthay1").show(500);
            $("#panelDataPRO1").hide(200);
            $("#cboPageNoPRO1").hide(200);
            $("#divTBKQTim1").hide(200);
        }
    }
}
function btnhuytt(bookingdetailid,page)
{
    var strconfirm = confirm("Bạn muốn tiếp tục?");
    if (strconfirm == true)
    {
        $.ajax({
            type:"POST",
            url:getUrspal() + "admin/bookingpayment/btnhuytt",
            dataType:"text",
            data: {
                bookingdetailid: bookingdetailid,
                page: page },
            cache:false,
            success:function (data) {
                if( data== "-1" || data==="-1" || data==-1 )
                {
                    alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
                }
                else
                {
                    btnhuytt_Complete(data);
                }
              //alert(data);
            }
        });
    }
}
function btnhuytt_Complete(data)
{
    var sRes = JSON.parse(data);
    if (sRes != null) {
        if(sRes.tb==1 || sRes.tb=="1")
        {
            searchcancel(sRes.page);
        }
        else
        {
            alert("Có lỗi xảy ra");
            searchcancel(sRes.page);
        }
    }
}
//end nghia viet 14/1/2015
//nghia viet 20/1/2015
function btnkhongchohuytt(bookingdetailid,page)
{
    var strconfirm = confirm("Bạn muốn tiếp tục?");
    if (strconfirm == true)
    {
        $.ajax({
            type:"POST",
            url:getUrspal() + "admin/bookingpayment/btnkhongchohuytt",
            dataType:"text",
            data: {
                bookingdetailid: bookingdetailid,
                page: page },
            cache:false,
            success:function (data) {
                if( data== "-1" || data==="-1" || data==-1 )
                {
                    alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
                }
                else
                {
                    btnkhongchohuytt_Complete(data);
                }
              //alert(data);
            }
        });
    }
}
function btnkhongchohuytt_Complete(data)
{
    var sRes = JSON.parse(data);
    if (sRes != null) {
        if(sRes.tb==1 || sRes.tb=="1")
        {
            searchProducts(sRes.page);
        }
        else
        {
            alert("Có lỗi xảy ra");
            searchProducts(sRes.page);
        }
    }
}
//end nghia viet 20/1/2015

/*----------------
|--------------------------------
|function load spaname for serach
|---------------------------------
*/
function load_spaname_search()
{
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/bookingpayment/load_spaname_search",
        dataType:"text",
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                load_spaname_search_Complete(data);
            }
          //alert(data);
        }
    });
}
function load_spaname_search_Complete(data)
{
    var sRes = JSON.parse(data);
    $("#list_spaname").html(sRes.str_res);
}
function isDate(txtDate)
{
    var currVal = txtDate;
    if(currVal == '')
        return false;
    
    var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/; //Declare Regex
    var dtArray = currVal.match(rxDatePattern); // is format OK?
    
    if (dtArray == null) 
        return false;
    
    //Checks for mm/dd/yyyy format.
    dtMonth = dtArray[1];
    dtDay= dtArray[3];
    dtYear = dtArray[5];        
    
    if (dtMonth < 1 || dtMonth > 12) 
        return false;
    else if (dtDay < 1 || dtDay> 31) 
        return false;
    else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31) 
        return false;
    else if (dtMonth == 2) 
    {
        var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
        if (dtDay> 29 || (dtDay ==29 && !isleap)) 
                return false;
    }
    return true;
}