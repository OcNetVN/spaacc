$(document).ready(function() {
   
});
function loadloai(maloaitin)
{
    $.ajax({
        type:"POST",
        url: getUrspal() + "News/loadloai",
        dataType:"text",
        data: {
            maloaitin: maloaitin
        },
        cache:false,
        success:function (data) {  
            loadloai_complete(data)
        },
        error: function () { alert("Có lỗi xảy ra!"); }
    });
}
function loadloai_complete(data) {
    var sRes = JSON.parse(data);
    $("#dsloai li").removeClass('active');
    $("#li_" + sRes.maloaitin).addClass('active');
    $("#newsintopic").html(sRes.str);
}
function loadnews(newsid)
{
    $.ajax({
        type:"POST",
        url: getUrspal() + "News/loadnews",
        dataType:"text",
        data: {
            newsid: newsid
        },
        cache:false,
        success:function (data) {  
            loadnews_complete(data)
        },
        error: function () { alert("Có lỗi xảy ra!"); }
    });
}
function loadnews_complete(data)
{
    var sRes = JSON.parse(data);
    $("#welcome").html(sRes.str_mainnews);
    $("#firstrelatednews").html(sRes.str_firstrelatednews);
    $("#secondrelatednews").html(sRes.str_secondrelatednews);
    $("#listtinlienquan").html(sRes.str_listrelatednews);
    $("#pagetinlienquan").html(sRes.str_pagerelatednews);
}
function loadpage(vitriload,page,maloaitintuc)
{
    $.ajax({
        type:"POST",
        url: getUrspal() + "News/loadpage",
        dataType:"text",
        data: {
            vitriload: vitriload,
            page: page,
            maloaitintuc: maloaitintuc
        },
        cache:false,
        success:function (data) {  
            loadpage_complete(data)
        },
        error: function () { alert("Có lỗi xảy ra!"); }
    });
}
function loadpage_complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes.vitriload==0 || sRes.vitriload=="0")
    {
        $("#newsintopic").html(sRes.str);
    }
    if(sRes.vitriload==1 || sRes.vitriload=="1")
    {
        $("#newnews").html(sRes.str);
    }
    if(sRes.vitriload==2 || sRes.vitriload=="2")
    {
        $("#avlistmain").html(sRes.str);
    }
}



