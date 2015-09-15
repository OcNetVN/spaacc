$(document).ready(function() {
    $( "button[id*='btnxembot_']" ).hide();
    $("#price-range").on("slideStop", function(slideEvt) {
         var sStr = "<option value=\"1\" selected=\"selected\">" + 1 + "</option>";
         $("#selPageNo").html(sStr);
        searchspa();       
    });
    $("#selPageNo").change(function () {
        searchspa();
        window.location.href="#bookmark1";
     });
    $('#txtLocationSearch').focusout(function(){
        var sStr = "<option value=\"1\" selected=\"selected\">" + 1 + "</option>";
         $("#selPageNo").html(sStr);
        searchspa();
    }); 
     $("#sesortby").change(function () {
        searchspa();     
     });
    $('#btnsearchhead').bind("click",function(){
        searchspa();
    });
});
function stepcbb()
{
    var sStr = "<option value=\"1\" selected=\"selected\">" + 1 + "</option>";
         $("#selPageNo").html(sStr);
        searchspa();
}
function loadloaispcon()
{
    $("#txtsearchhead").val("");
    $("#childproducttype").hide();
    var producttype = $('input:radio[name=optionsProductType]:checked').val();
    if(producttype!='0' && producttype!=0 && producttype!="" && producttype!=null)
    {
        //alert(producttype);
        $.ajax({
            type:"POST",
            url: getUrspal() + "category/loadloaispcon",
            dataType:"text",
            data: {
                producttype: producttype //price
            },
            cache:false,
            success:function (data) { 
                loadloaispcon_Complete(data);
            },
            error: function () { alert("Có lỗi xảy ra!"); }
        });
    }
    else
    {
        var sStr = "<option value=\"1\" selected=\"selected\">" + 1 + "</option>";
         $("#selPageNo").html(sStr);
        searchspa();
    }
}
function loadloaispcon_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes.sodong>0)
    {
        $("#childproducttype").html(sRes.str);
        $("#childproducttype").show();
    }
    var sStr = "<option value=\"1\" selected=\"selected\">" + 1 + "</option>";
         $("#selPageNo").html(sStr);
    searchspa();
}
function searchspa()
{
    $("body").addClass("loading");
    var arrspafacilities = [];
    var i= 0;
    $('input:checkbox[name=spafacilities]:checked').each(function(){
     arrspafacilities[i++] = $(this).val();
     });
     var arrspatype = [];
    var j= 0;
    $('input:checkbox[name=spatype]:checked').each(function(){
     arrspatype[j++] = $(this).val();
     });
     var arrchildproducttype = [];
     if($(".childproducttype"))
     {
        var k= 0;
        $('input:checkbox[name=childproducttype]:checked').each(function(){
         arrchildproducttype[k++] = $(this).val();
         });
     }
     //alert(arrchildproducttype);
    var producttype = $('input:radio[name=optionsProductType]:checked').val();
    var location= $("#txtLocationSearch").val();
    var selPageNo= $("#selPageNo").val(); //trang
    var sesortby= $("#sesortby").val();
    var SpaName= $("#txtsearchhead").val();
    var amount= $("#amount").val();

    //alert(location);
    $.ajax({
        type:"POST",
        url: getUrspal() + "category/searchspa",
        dataType:"text",
        data: {
            arrspatype: arrspatype,
            arrspafacilities:arrspafacilities,
            arrchildproducttype: arrchildproducttype,
            producttype: producttype,
            location: location,
            SpaName: SpaName,
            page: selPageNo,
            sortby: sesortby,
            amount: amount //price
        },
        cache:false,
        success:function (data) { 
            searchspa_Complete(data);
        },
        error: function () { alert("Có lỗi xảy ra!"); $("body").removeClass("loading"); }
    });
}
function searchspa_Complete(data)
{
    var sRes = JSON.parse(data);  
    $("#showlistspa").html(sRes.str);
    $("#tongmautin").html(sRes.tongmautin);
    $("#selPageNo option").remove();
    var totalPage = parseInt(sRes.sotrang);
    var TrangHienTai = parseInt(sRes.TrangHienTai);
    //alert(totalPage);
    var sStr = "";
    for (var i = 1; i <= totalPage; i++) {
        if (i == TrangHienTai) {
            sStr += "<option value=\"" + i + "\" selected=\"selected\">" + i + "</option>";
        }
        else {
            sStr += "<option value=\"" + i + "\" >" + i + "</option>";
        }
    }
    //alert(sStr);
    $("#selPageNo").html(sStr);
    $("body").removeClass("loading");
}
function showless(spaid)
{
    var spaID=spaid;
    $("#btnxembot_" + spaID).hide();
    $( "tbody[id*='tbody_" + spaID + "']" ).removeAttr( "style" );
    $( "tbody[id*='tbody_" + spaID + "']" ).attr( "style", "display:none;" );
    $("#tbody_" + spaID + "_1").removeAttr( "style" );
    var textonclick = $("#btnxemthem_" + spaID).attr( "onclick" );
    //alert(textonclick);
    var arr = textonclick.split(',');
    var textres=arr[0] + "," + 2 + "," + arr[2];
    //alert(textres);
    $("#btnxemthem_" + spaID).removeAttr( "onclick" );
    $("#btnxemthem_" + spaID).attr( "onclick", textres );
    window.location.href="#bookmark_" + spaID;
}
function showlistpro(spaid, page, totalpage)
{
    $("#btnxembot_" + spaid).show();
    var page=parseInt(page);
    var newpage=parseInt(page) + 1;
    var totalpage=parseInt(totalpage);
    $("#tbody_" + spaid + "_" + page).show(200);
    if(totalpage != page)
        $("#btnxemthem_" + spaid).attr("onclick","showlistpro('" + spaid + "'," + newpage + ",'" + totalpage + "')");
    else
        $("#trbutton_" + spaid).hide();
}
function re_searchspa()
{
    $("#txtsearchhead").val("");
    searchspa();
}
