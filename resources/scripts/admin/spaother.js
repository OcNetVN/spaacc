var curPage =1;
var DaLuu = false;
var str_old ="";
var str_old_type = "";
var str_old_location = "";
$(document).ready(function() { 
        $("#cboPageNo").change(function () {
            var trang = $("#cboPageNo").val();            
            searchSpa(trang);
        }); 
        
        $("#cboPageNoSPATab2").change(function(){
           var trang = $("#cboPageNoSPATab2").val(); 
           SearchSpaLocation(trang);
        })    
        $("#tx_tTel").ForceNumericOnly();
        $("#txtLocaionTabInsert").focusout(function(){
            var toado =$("#txtLocaionTabInsert").val().split(',');
            var content = $("#txtPostionTab").val()            ;
            init_map(parseFloat(toado[0]), parseFloat(toado[1]),content);
        });
        
});

// when select nganh ngheef thay doi
$("#cbbSpaFacility").change(function(){
    var spaID = $('#spanSpaID_').text();
    var CommonID = $("#cbbSpaFacility").val();
    var StrValue =$("#cbbSpaFacility option[value='"+CommonID+"']").html();
    InsertSpaFacility(spaID,CommonID,StrValue);
}); 

//cbbSpaType
$("#cbbSpaType").change(function(){
    var spaID = $('#spanSpaID').text();
    var CommonID = $("#cbbSpaType").val();
    var StrValue =$("#cbbSpaType option[value='"+CommonID+"']").html();
    InsertSpaType(spaID,CommonID,StrValue);
});

function ChonSpaLocation(cmid,cm_str){
    var spaID = $("#spanSpaLocationID").text();
    
     $.ajax({
                url: getUrspal() + "admin/spautil/update_location",
                type: 'POST',
                async : false,
                data: {
                      spaID:spaID,
                      commID: cmid
                },
                dataType: 'json',
                success: function(data){
                    UpdateSpaLocation_Complete(data);
            }
        }); 
}

function UpdateSpaLocation_Complete(data){
    var res = data;
    if(data == "1" || data == 1){
        DaLuu = true;
        $("#divUpdateSuccessLocation").css("display","");
        LoadTienIchValoaiSpa();
        $("#poupSpaLocation").dialog('close');
    }
    else{
         DaLuu = false;
         $("#divUpdateErrorLocation").css("display","");
    }
}

function InsertSpaType(SpaID,CommonID,StrValue){
    var str = "";
    var str1 = "";
    var url = "../resources/images/filecloseBTN.png";
    var sodong = $('td#tdSaType div:last').index() + 1;//tdSaFacliity
    var i=0;
    for(i=0; i<sodong; i++)
    {
        var cmid = $('td#tdSaType div:eq('+i+')').attr("commonid");
        if(CommonID==cmid)
        {
           break; 
        }
    }
    if(i==sodong)
    {
        str = str +"<div commonid=\""+CommonID+"\" class=\"doituongDIV divSpaType"  +SpaID + CommonID +"\">";
        str1 = str1 +"<div commonid=\""+CommonID+"\" class=\"doituongDIV divSpaType"+SpaID + CommonID +"\">";
        str =str + StrValue;
        str1 =str1 + StrValue;
        str =str + "<a href=\"javascript:void(0);\" onclick=\"XoaType('"+SpaID+"','"+CommonID+"');\"><img src="+ url +" height=\"12\" /></a>";
        str = str + "<input type=\"text\" id=\"Dvalue"+ SpaID+ CommonID +"\" >";
        str = str +"</div>";
        str1 = str1 +"</div>";
        $("#tdSaType").html(str);
        $("#DivSpaTypeShow" +SpaID).html(str1);
    }
}

function InsertSpaType(spaID,CommonID,StrValue)
{
    var str = "";
    var str1 = "";
    var url = "../resources/images/filecloseBTN.png";
    var sodong = $('td#tdSaType div:last').index() + 1;//tdSaFacliity
    var i=0;
    for(i=0; i<sodong; i++)
    {
        var cmid = $('td#tdSaType div:eq('+i+')').attr("commonid");
        if(CommonID==cmid)
        {
           break; 
        }
    }
    if(i==sodong)
    {
        str = str +"<div commonid=\""+CommonID+"\" class=\"doituongDIV divSpaType"+spaID+CommonID +"\">";
            str1 =  str1 +"<div commonid=\""+CommonID+"\" class=\"doituongDIV divSpaType"+spaID+CommonID +"\">";
            str =   str + StrValue;
            str1 =  str1 + StrValue;
            str =   str + "<a href=\"javascript:void(0);\" onclick=\"XoaFacility('"+spaID+"','"+CommonID+"');\"><img src="+ url +" height=\"12\" /></a>";
            str =   str + "<input type=\"text\" id=\"Dvalue"+ spaID +CommonID +"\">";
            str =   str +"</div>";
            str1 =  str1 +"</div>";
            $("#tdSaType").append(str);
            $("#DivSpaTypeShow" +spaID).append(str1);
    }
     
}


function InsertSpaFacility(spaID,CommonID,StrValue)
{
    var str = "";
    var str1 = "";
    var url = "../resources/images/filecloseBTN.png";
    var sodong = $('td#tdSaFacliity div:last').index() + 1;//tdSaFacliity
    var i=0;
    for(i=0; i<sodong; i++)
    {
        var cmid = $('td#tdSaFacliity div:eq('+i+')').attr("commonid");
        if(CommonID==cmid)
        {
           break; 
        }
    }
    if(i==sodong)
    {
        str = str +"<div commonid=\""+CommonID+"\" class=\"doituongDIV divSpaFacility"+spaID+CommonID +"\">";
            str1 =  str1 +"<div commonid=\""+CommonID+"\" class=\"doituongDIV divSpaFacility"+spaID+CommonID +"\">";
            str =   str + StrValue;
            str1 =  str1 + StrValue;
            str =   str + "<a href=\"javascript:void(0);\" onclick=\"XoaFacility('"+spaID+"','"+CommonID+"');\"><img src="+ url +" height=\"12\" /></a>";
            str =   str + "<input type=\"text\" id=\"value"+ spaID +CommonID +"\">";
            str =   str +"</div>";
            str1 =  str1 +"</div>";
            $("#tdSaFacliity").append(str);
            $("#DivSpaFacilityShow" +spaID).append(str1);
    }
     
}

function XoaLocation(spaid,cmid)
{
    $(".divSpaLocation" +spaid+cmid).remove();
}
function XoaFacility(spaid,cmid)
{
    $(".divSpaFacility" +spaid+cmid).remove();
}

function XoaType(spaid,cmid)
{
    $(".divSpaType" +spaid+cmid).remove();
}
 
 
 function SelectSpaType(spaID){
    DaLuu = false;
    var str = "";
    var url = "../resources/images/filecloseBTN.png";
    str_old_type = $("#DivSpaTypeShow" +spaID).html();
    var sodiv = $('div#DivSpaTypeShow'+ spaID+' div:last').index() + 1;
    if(sodiv > 0){
      for(i=0; i<sodiv; i++)
      {
        var cmid = $("#DivSpaTypeShow"+ spaID+" div:eq("+i+")").attr("commonid");
        var cm_str=$("#DivSpaTypeShow"+ spaID+" div:eq("+i+")").html();
        str = str +"<div commonid=\""+cmid+"\" class=\"doituongDIV divSpaType"+spaID+ cmid +"\">";
        str = str + cm_str;
        str =str + "<a href=\"javascript:void(0);\" onclick=\"XoaType('"+spaID+"','"+cmid+"');\"><img src="+ url +" height=\"12\" /></a>";
        str = str + "<input type=\"text\" id=\"Dvalue"+spaID + cmid+"\">";
        str = str +"</div>";
      }
    }
    $("#poupSpaType").dialog({
                    height: 400,
                    width:  550,
                    modal: true
                });
    $("#spanSpaID").text(spaID);
    $("#tdSaType").html(str);
    $("#btnClosePopupType").attr("onclick","closePoupType('"+spaID+"');");
    $('#btnUpdateSpaType').attr("onclick","UpdateSpaType('"+spaID+"');");
}

function SelectSpaLocation(spaID){
    DaLuu = false;
    var str = "";
    var url = "../resources/images/filecloseBTN.png";
    str_old_location = $("#DivSpaLocationShow" +spaID).html();
    var sodiv = $('div#DivSpaLocationShow'+ spaID+' div:last').index() + 1;
    if(sodiv > 0){
        var cmid = $("#DivSpaLocationShow" + spaID + " div" ).attr("commonid");
        var cm_str = $("#DivSpaLocationShow" + spaID + " div" ).html(); 
        str = str + "<div commonid=\""+cmid +"\" class= \"doituongDIV divSpaLocation"+ spaID + cmid + "\">";
        str = str + cm_str;
        str =str + "<a href=\"javascript:void(0);\" onclick=\"XoaLocation('"+spaID+"','"+cmid+"');\"><img src="+ url +" height=\"12\" /></a>";
        str = str +"</div>"; 
}
    
    $("#poupSpaLocation").dialog({
                    height: 700,
                    width:  950,
                    modal: true
                });
    $("#spanSpaLocationID").text(spaID);
    $("#tdSaLocation").html(str);
    $("#btnClosePopupLocation").attr("onclick","closePoupLocation('"+spaID+"');");
    $('#btnUpdateSpaLocation').attr("onclick","UpdateSpaLocation('"+spaID+"');");
}

function SearchSpaLocation(page) {
    var Name = $("#txtSpaLocationName").val();

    $.ajax({
        url: getUrspal() + "admin/spautil/searchlocation",
        type: "POST",
        data: { Name: Name, Page: page },
        cache: false,
        dataType: "text",
        //contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                    SearchSpaLocation_Complete(data);
                },
        error: function () {
        }
    });
}

function SearchSpaLocation_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
        $("#panelDataSPATab2 tbody tr").remove();
        $("#ListFoundSPATab2").tmpl(sRes.lst).appendTo("#panelDataSPATab2 tbody");
        $("#panelDataSPATab2").css("display", "");

        //phân trang
        $("#DivPhanTrangSPATab2").show(500);
        var totalPage = parseInt(sRes.TotalPage);
        var Curpage = parseInt(sRes.CurPage);
        TrangHienTai = Curpage;
        TongTrang = totalPage;
        $("#cboPageNoSPATab2 option").remove();
        for (var i = 1; i <= totalPage; i++) {
            var sStr = "";
            if (i == TrangHienTai) {
                sStr = "<option value=\"" + i + "\" selected=\"selected\">" + i + "</option>";
            }
            else {
                sStr = "<option value=\"" + i + "\" >" + i + "</option>";
            }
            $("#cboPageNoSPATab2").append(sStr);
        }
    }
}
 
function SelectSpaUtil(spaID){
    DaLuu = false;
    var url = "../resources/images/filecloseBTN.png";
    str_old =$("#DivSpaFacilityShow" +spaID).html();
    var str ="";
    var sodiv = $('div#DivSpaFacilityShow'+ spaID+' div:last').index() + 1;
    for(i=0; i<sodiv; i++)
    {
        var cmid = $("#DivSpaFacilityShow"+ spaID+" div:eq("+i+")").attr("commonid");
        var cm_str=$("#DivSpaFacilityShow"+ spaID+" div:eq("+i+")").html();
        str = str +"<div commonid=\""+cmid+"\" class=\"doituongDIV divSpaFacility"+spaID+ cmid +"\">";
        str = str + cm_str;
        str =str + "<a href=\"javascript:void(0);\" onclick=\"XoaFacility('"+spaID+"','"+cmid+"');\"><img src="+ url +" height=\"12\" /></a>";
        str = str + "<input type=\"text\" id=\"value"+spaID + cmid+"\">";
        str = str +"</div>";
    }
    
    
    $("#poupSpaFa").dialog({
                    height: 400,
                    width:  550,
                    modal: true
                });
      
    $("#tdSaFacliity").html(str);// co xoa tren popup
    $("#btnClosePopupFac").attr("onclick","closePoup('"+spaID+"');");
    $('#btnUpdateSpaFacitily').attr("onclick","UpdateSpaFacitily('"+spaID+"');");
    $('#spanSpaID_').text(spaID);
}

function UpdateSpaType(spaId){
    var list_commoID = [];
    var sodiv = $('td#tdSaType div:last').index() + 1;
    for(i=0;i<sodiv;i++)
    {
       var  listspa = {};   
        var cmid = $('td#tdSaType div:eq('+i+')').attr("commonid");
        var valueid  = $("#Dvalue" + spaId + cmid).val();
        listspa.commoID = cmid;
        listspa.valueID = valueid;
        list_commoID[i]= listspa;   
    }
    
    $.ajax({
                url: getUrspal() + "admin/spaother/updatespatype",
                type: 'POST',
                async : false,
                data: {
                        spaID:spaId,
                        commID: JSON.stringify(list_commoID)
                },
                dataType: 'json',
                success: function(data){
                    UpdateSpaType_Complete(data);
                    // thanh cong --> DaLuu = true;
               //if( data== "-1" || data==="-1" || data==-1 )
//                { 
//                }
//                else{
//                    UpdateSpaFacility_Complete(data);
//                }    
                  
            }
        }); 
}
function UpdateSpaType_Complete(data){
    var res = data;
    if(data == "1" || data == 1){
        DaLuu = true;
        $("#divUpdateSuccessType").css("display","");
    }
    else{
         DaLuu = false;
         $("#divUpdateErrorType").css("display","");
    }
}



function UpdateSpaLocation(spaId){
    var cmid = "";
    var sodiv = $('td#tdSaLocation div:last').index() + 1;
    if(sodiv > 0){
         cmid=$('td#tdSaLocation div').attr("commonid");
    }
    
    $.ajax({
                url: getUrspal() + "spautil/update_location",
                type: 'POST',
                async : false,
                data: {
                      spaID:spaId,
                      commID: cmid
                },
                dataType: 'json',
                success: function(data){
                    UpdateSpaLocation_Complete(data);
            }
        }); 
}

// closePoupLocation
function closePoupLocation(spaID)
{
    if(DaLuu==true)
    {
        LoadTienIchValoaiSpa();
    }
    else
    {
        $("#DivSpaLocationShow" +spaID).html(str_old_location);
    }
     $("#poupSpaLocation").dialog('close');
     $("#divUpdateSuccessLocation").css("display","none");
     $("#divUpdateErrorLocation").css("display","none");
}
//closePoupType
function closePoupType(spaID)
{
    if(DaLuu==true)
    {
        LoadTienIchValoaiSpa();
    }
    else
    {
        $("#DivSpaTypeShow" +spaID).html(str_old_type);
    }
     $("#poupSpaType").dialog('close');
     $("#divUpdateSuccessType").css("display","none");
     $("#divUpdateErrorType").css("display","none");
}

function UpdateSpaFacitily(spaId){
    var list_commoID = [];
    //var list_value   = [];
    var sodiv = $('td#tdSaFacliity div:last').index() + 1;
    for(i=0;i<sodiv;i++)
    {
       var  listspa = {};   
        var cmid = $('td#tdSaFacliity div:eq('+i+')').attr("commonid");
        var valueid  = $("#value" + spaId + cmid).val();
        listspa.commoID = cmid;
        listspa.valueID = valueid;
        list_commoID[i]= listspa;   
    }
        
    $.ajax({
                url: getUrspal() + "admin/spaother/updatespafaclity",
                type: 'POST',
                async : false,
                data: {
                      kind:'SpaFacility',
                      spaID:spaId,
                      commID: JSON.stringify(list_commoID)
                },
                dataType: 'json',
                success: function(data){
                    UpdateSpaFacility_Complete(data);
                    // thanh cong --> DaLuu = true;
               //if( data== "-1" || data==="-1" || data==-1 )
//                { 
//                }
//                else{
//                    UpdateSpaFacility_Complete(data);
//                }    
                  
            }
        });
    
}

function UpdateSpaFacility_Complete(data){
    var res = data;
    if(data == "1" || data == 1){
        $("#divUpdateSuccessFac").css("display","");
        DaLuu = true;
    }
    else{
        $("#divUpdateErrorFac").css("display","");
         DaLuu = false;
    }
}

function closePoup(spaID)
{
    if(DaLuu==true)
    {
        LoadTienIchValoaiSpa();
    }
    else
    {
        $("#DivSpaFacilityShow" +spaID).html(str_old);
    }
    $("#poupSpaFa").dialog('close');
    //divUpdateErrorFac
    //divUpdateSuccessFac
    $("#divUpdateSuccessFac").css("display","none");
    $("#divUpdateErrorFac").css("display","none");
}


function searchSpa(page) {
    var spaID = $("#txtspaID").val();
    var spaName = $("#txtspaName").val();
    var Tel = $("#txtTel").val();
    var Notes = $("#txtnotes").val();
    var MoreInfo = $("#txtMoreInfo").val();
    var Address = $("#txtAddress").val();  
    var  email  = $("#txtemail").val(); 
    var desciption = $("#txtDescription").val();
    var location = $("#txtlocation").val();   
    curPage = page;
    
    $.ajax({
        type:"POST",
        url: getUrspal() + "admin/spa/ajax_get_list",
        dataType:"text",
        data:{spaID:spaID,spaName:spaName,
                Tel:Tel, Notes:Notes,
                MoreInfo:MoreInfo,address:Address,
                email:email,desci:desciption,
                Loaction:location, Page:page},
        cache:false,
        success:function (data) {
            if(data == -1 || data == "-1" || data === "-1"){
                alert("Bạn không có quyền hạn ở chức năng này trên trang này");
            }else{
                searchSpa_Complete(data);
            }
            
        }
    });
}

function searchSpa_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
        $("#panelData tbody tr").remove();
        $("#DSHHtimduoc").tmpl(sRes.lst).appendTo("#panelData tbody");
        $("#divResult").show(500);
               
        //phÃ¢n trang
        var totalPage = parseInt(sRes.TotalPage);
        var Curpage = parseInt(sRes.CurPage);
        $("#tbaoTimDc").text("Tìm được " + sRes.TotalRecord + " mẫu tin!!!");
        TrangHienTai = Curpage;
        TongTrang = totalPage;
        $("#cboPageNo option").remove();
        for (var i = 1; i <= totalPage; i++) {
            var sStr = "";
            if (i == TrangHienTai) {
                sStr = "<option value=\"" + i + "\" selected=\"selected\">" + i + "</option>";
            }
            else {
                sStr = "<option value=\"" + i + "\" >" + i + "</option>";
            }
            $("#cboPageNo").append(sStr);
        }
        
        LoadTienIchValoaiSpa();
    }
    //LoadTienIchValoaiSpa();
}

function LoadTienIchValoaiSpa(){
    var rowCount = $('table#panelData tbody tr:last').index() + 1;
    var list= [];
    for(i=0;i<rowCount; i++)
    {
        var spaid = $("table#panelData tbody tr:eq("+i+") td:eq(1) span").text();
        list[i] = spaid;
    }
    
    if(list.length >0)
    {
            $.ajax({
            type:"POST",
            url:getUrspal() + "admin/spaother/getspainfo",
            dataType:"json",
            data:{ListSpaID: JSON.stringify(list)},
            cache:false,
            success:function (data) {
                   if(data!=null && data.length>0)         
                   {
                       for(i=0; i<data.length; i++)
                       {
                           $("#DivSpaFacilityShow" + data[i].SpaID).html(data[i].ListFacStr);
                           $("#DivSpaTypeShow" + data[i].SpaID).html(data[i].SpaTypeStr);
                           $("#DivSpaLocationShow" + data[i].SpaID).html(data[i].SpaLocation);
                           
                       }
                   }
            }
        });
    }
    
}






