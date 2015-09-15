$(document).ready(function() {
    loadService(1);
    loadhinh();
    //alert("sfsd");
});
function editavatar()
{
    $("#contentbook").hide();
    $("#diveditavatar").show();
}
function loadService(page)
{
    $.ajax({
        type:"POST",
        url: getUrspal()+ "indexuser/loadService",
        dataType:"text",
        data: {
            dpage: page},
        cache:false,
        success:function (data) {
            loadService_Complete(data);
        },
        error: function () { alert("Có lỗi xảy ra!"); }
    });
}
function loadService_Complete(data)
{
    var sRes = JSON.parse(data);
    $("#content_list").html(sRes.str);
    $("#content_list").show();
    $("#numpage").html(sRes.str_numpage);
    $("#numpage").show();
    //alert(sRes.str_outstanding);
    $("#spanoutstanding").html(sRes.str_outstanding);
}
function cancelbooking(bookingid,page)
{
    var strconfirm = confirm("Bạn có chắc chắn huỷ không?");
    if (strconfirm == true)
    {
        $.ajax({
            type:"POST",
            url: getUrspal() +"indexuser/cancelbooking",
            dataType:"text",
            data: {
                dbookingid: bookingid,
                dpage: page},
            cache:false,
            success:function (data) {
                cancelbooking_Complete(data);
            },
            error: function () { alert("Có lỗi xảy ra!"); }
        });
    }
}
function cancelbooking_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes.tb=="" || sRes.tb==null)
        alert('Cập nhật không thành công, vui lòng thử lại');
    else
        loadService(sRes.page);
}
function loadhinh()
{
    $.ajax({
        type:"POST",
        url: getUrspal() + "indexuser/loadhinh",
        dataType:"text",
        cache:false,
        success:function (data) {
            loadhinh_Complete(data);
        },
        error: function () { alert("Có lỗi xảy ra!"); }
    });
}
function loadhinh_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes.sd==1 || sRes.sd=="1")
    {
        var url = sRes.urlhinh;
        $("#avatar_editindex").attr('style','background-image:url(' + url + ');');
        $("#preview").attr('style','background-image:url(' + url + ');');
    }
    else
    {
        $("#avatar_editindex").attr('style','background-image:url('+ getUrspal() + 'resources/front/images/nouserimages.png);');
        $("#preview").attr('style','background-image:url('+ getUrspal() + 'resources/front/images/nouserimages.png);');
    }
}