$(document).ready(function() {
        $("#so1them").ForceNumericOnly();
        $("#so2them").ForceNumericOnly();
        $("#cmidthem").ForceNumericOnly();
        $("#so1sua").ForceNumericOnly();
        $("#so2sua").ForceNumericOnly();
        
        $("#cboPageNoPRO").change(function () {
            var trang = $("#cboPageNoPRO").val();
                searchcommoncode(trang);
         });
        $("#phuongthucdanhsach").click(function () {
             $("#khungtim").hide(300);
             $("#panelDataPRO").hide(300);
             $("#divTBKQTim").hide(300);
             $("#khongtimthay").hide(300);
             $("#khunginsert").hide(300);
             $("#khungedit").hide(300);
             
             $("#timgiatrichuoi1").val("");
            $("#timgiatrichuoi2").val("");
             $("#timgiatriso1").val("");
            $("#timgiatriso2").val("");
             $("#timcmcodeid").val("");
            
            searchcommoncode(1);
        });
        $("#phuongthuctim").click(function () {
            laycommontypetim();
            $("#khungtim").show(500);
            $("#khunginsert").hide(300);
            $("#panelDataPRO").hide(300);
             $("#divTBKQTim").hide(300);
             $("#khungedit").hide(300);
        });
        $("#themuser").click(function () {
             $("#khungtim").hide(300);
             $("#panelDataPRO").hide(300);
             $("#divTBKQTim").hide(300);
             $("#khongtimthay").hide(300);
            $("#khunginsert").show(500);
            $("#khungedit").hide(300);
            laycommontypethem();
            loadradiocapthem();
            $("#tbl_hiencapthem").hide();
            $("#show_tbl_cap").hide();
            $("#detailthem").hide();
            var capcanthem=$("#choncapthem").val();
            var cmtypeidthem = $("#cmtypeidthem").val();
            hiencapthem(2,cmtypeidthem);
            $("#err_chuoithem").hide();
            $("#suggessadd").hide();
            $("#thongbaoid").hide();
            
        });
        $("#cmtypeidthem").change(function () {
            $("#tbl_hiencapthem").hide();
            $("#show_tbl_cap").hide();
            $("#tbl_timnhieucap").hide(); 
            $("#tbl_2cap").hide();
            //loadradiocapthem();
            var cmtypeidthem = $("#cmtypeidthem").val();            
            //hiencapthem(2,cmtypeidthem);
            taocommonid_2cap(1,cmtypeidthem,0);
            autoloai(cmtypeidthem);
            showidgerenatetype(cmtypeidthem);
            
            $("#err_chuoithem").hide();
            $("#suggessadd").hide();
            $("#thongbaoid").hide();
            
        });
        $("#choncapthem").change(function () {
            $("#tbl_hiencapthem").hide();
            var capcanthem=$("#choncapthem").val();
            //alert(capcanthem);
            var cmtypeidthem = $("#cmtypeidthem").val();
            //alert(cmtypeidthem);
           hiencapthem(2,cmtypeidthem);
         });
         $("#haicap_1").change(function () {
            $("#err_chuoithem").hide();
            $("#suggessadd").hide();
            $("#thongbaoid").hide();
            var cap_1_2cap=$("#haicap_1").val();
            var cmtypeidthem = $("#cmtypeidthem").val();
           laycm2theo1_2cap(cap_1_2cap);
           if(cap_1_2cap!="0" || cap_1_2cap!=0)
                taocommonid_2cap(2,cmtypeidthem,cap_1_2cap);
           else
                taocommonid_2cap(1,cmtypeidthem,0);
         });
         $("#haicap_2").change(function () {
            $("#err_chuoithem").hide();
            $("#suggessadd").hide();
            $("#thongbaoid").hide();
            var cap_1_2cap=$("#haicap_1").val();
            var cap_2_2cap=$("#haicap_2").val();
            var cmtypeidthem = $("#cmtypeidthem").val();
           if(cap_2_2cap!="0" || cap_1_2cap!=0)
                taocommonid_2cap(3,cmtypeidthem,cap_2_2cap);
           else
                taocommonid_2cap(2,cmtypeidthem,cap_1_2cap);
         });
});
//load commontype tim
function laycommontypetim()
{
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/commoncode/laycommontypetim",
        dataType:"text",
        cache:false,
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				showcommontypetim(data);
			}
          //alert(data);
        }
    });
}
function showcommontypetim(data)
{
    var sRes = JSON.parse(data);
    var sStr = '';
    sStr += "<option value=\"0\">Tất cả</option>";
   // alert(sRes.lst[0]['CommonId']);
   for (var i = 0; i < sRes.sodong; i++) 
   {
        sStr += "<option value=\"" + sRes.lst[i].CommonTypeId + "\" >" + sRes.lst[i].CommonTypeId + "</option>";
    }
    $("#timcmtypeid").html(sStr);
}
//nhan nut tim
function searchcommoncode(page) {    
   
    var timcmtypeid = $("#timcmtypeid").val();
    var timgiatrichuoi1 = $("#timgiatrichuoi1").val();
    var timgiatrichuoi2 = $("#timgiatrichuoi2").val();
    var timgiatriso1 = $("#timgiatriso1").val();
    var timgiatriso2 = $("#timgiatriso2").val();
    curPage = page;    
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/commoncode/searchcommoncode",
        dataType:"text",
        data: {
            Timcmtypeid: timcmtypeid,
            Timgiatrichuoi1: timgiatrichuoi1,
            Timgiatrichuoi2: timgiatrichuoi2,
            Timgiatriso1: timgiatriso1,
            Timgiatriso2: timgiatriso2,
            Page:page},
        cache:false,
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				searchcommoncode_Complete(data);
			}
          //alert(data);
        }
    });
}
function searchcommoncode_Complete(data)
{
    var sRes = JSON.parse(data);
    if (sRes != null) 
    {
        if(sRes.TotalRecord !=0)
        {
            $("#khongtimthay").hide(200);
             $("#cboPageNoPRO").show(300);
            $("#panelDataPRO tbody tr").remove();
            $("#ListFoundPRO").tmpl(sRes.lst).appendTo("#panelDataPRO tbody");
            $("#panelDataPRO").show(500);
                   
            //phân trang
            var totalPage = parseInt(sRes.TotalPage);
            var Curpage = parseInt(sRes.CurPage);
            $("#divTBKQTim div").text("Tim duoc " + sRes.TotalRecord + " mau tin!!!");
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
//load commontype them
//load commontype tim
function laycommontypethem()
{
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/commoncode/laycommontypethem",
        dataType:"text",
        cache:false,
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				showcommontypethem(data);
			}
          //alert(data);
        }
    });
}
function showcommontypethem(data)
{
    var sRes = JSON.parse(data);
    var sStr = '';
     sStr += "<option value=\"0\">Chọn</option>";
   for (var i = 0; i < sRes.sodong; i++) 
   {
        sStr += "<option value=\"" + sRes.lst[i].CommonTypeId + "\" >" + sRes.lst[i].CommonTypeId + "</option>";
    }
    $("#cmtypeidthem").html(sStr);
}
//load select cap them
function loadradiocapthem()
{
    var cmtypeidthem = $("#cmtypeidthem").val();
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/commoncode/loadradiocapthem",
        dataType:"text",
        cache:false,
        data: {
            Cmtypeidthem: cmtypeidthem},
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				loadradiocapthem_Complete(data);
			}
          //alert(data);
        }
    });
}
function loadradiocapthem_Complete(data)
{
    var sRes = JSON.parse(data);
    //alert(sRes.socap);
    var sStr = '';
   for (var i = 1; i <= sRes.socap; i++) 
   {
        sStr += "<option value=\"" + i + "\" >Cấp " + i + "</option>";
        //sStr += "<input type=\"radio\" name=\"capthem\" id=\"capthem" + i + "\" value=\"" + i + "\" /> Cấp " + i;
    }
    //$("#td_capthem").html(sStr);
    $("#choncapthem").html(sStr);
}
//hien ra cap them
function hiencapthem(capcanthem,cmtypeidthem)
{
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/commoncode/hiencapthem",
        dataType:"text",
        cache:false,
        data: {
            Capcanthem: capcanthem,
            Cmtypeidthem: cmtypeidthem},
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				hiencapthem_Complete(data);
			}
          //alert(data);
        }
    });
}
function hiencapthem_Complete(data)
{
    var sRes = JSON.parse(data);
    var sStr = '';
    if(sRes.Capcanthem==1 || sRes.Capcanthem=="1")
    {
        
    }
    else
    {
        if(sRes.sodong>0)
        {
            sStr += "Cấp 1 <select id=\"obcmtypeidthem\">";
            sStr += "<option value=\"1\">Tất cả</option>";
            for (var i = 0; i < sRes.sodong; i++) 
            {
                sStr += "<option value=\"" + sRes.lst_cmidcha[i].CommonId + "\" >" + sRes.lst_cmidcha[i].StrValue1 + "</option>";
            }
            sStr += "</select>";
            $("#hiencapthem").html(sStr);
            $("#tbl_hiencapthem").show();
        }
    }
}
function showidgerenatetype(cmtypeidthem)
{
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/commoncode/showidgerenatetype",
        dataType:"text",
        cache:false,
        data: {
            Cmtypeidthem: cmtypeidthem},
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				showidgerenatetype_Complete(data);
			}
          //alert(data);
        }
    });
}
function showidgerenatetype_Complete(data)
{
    $("#show_tbl_cap").hide();
        
    var sRes = JSON.parse(data);
    if(sRes.sodong>0)
    {
        $("#show_tbl_cap").show();
        if(sRes.lst[0].IDgenerateType==4)
        {
            laycommon_2cap(sRes.Cmtypeidthem);
            $("#tbl_timnhieucap").hide(); 
            $("#tbl_2cap").show();
            
        }
        /*if(sRes.lst[0].IDgenerateType==3)
        {
            $("#detailthem").show();
        }*/
    }
    else
    {
        $("#show_tbl_cap").hide();
    }
}
function laycommon_2cap(cmtypeidthem)
{
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/commoncode/laycommon_2cap",
        dataType:"text",
        cache:false,
        data: {
            Cmtypeidthem: cmtypeidthem},
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				laycommon_2cap_Complete(data);
			}
          //alert(data);
        }
    });
}
function laycommon_2cap_Complete(data)
{
    var sRes = JSON.parse(data);
    var sStr = '';
    sStr += "<option value=\"0\">Chọn</option>";
    if(sRes.sodong>0)
    {
        for (var i = 0; i < sRes.sodong; i++) 
        {
            sStr += "<option value=\"" + sRes.lst[i].CommonId + "\" >" + sRes.lst[i].StrValue1 + "</option>";
        }
    }
    $("#haicap_1").html(sStr);
}
//load list cap 2 cua commontypegerenateid
function laycm2theo1_2cap(idcap_1)
{ 
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/commoncode/laycm2theo1_2cap",
        dataType:"text",
        cache:false,
        data: {
            Idcap_1: idcap_1},
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				laycm2theo1_2cap_Complete(data);
			}
          //alert(data);
        }
    });
}
function laycm2theo1_2cap_Complete(data)
{
    var sRes = JSON.parse(data);
    var sStr = '';
    sStr += "<option value=\"0\">Chọn</option>";
    if(sRes.sodong>0)
    {
        for (var i = 0; i < sRes.sodong; i++) 
        {
            sStr += "<option value=\"" + sRes.lst[i].CommonId + "\" >" + sRes.lst[i].StrValue1 + "</option>";
        }
    }
    $("#haicap_2").html(sStr);
}
function taocommonid_2cap(cap,cmtypeidthem,cmid)
{
    //alert(cap);
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/commoncode/taocommonid_2cap",
        dataType:"text",
        cache:false,
        data: {
            Cap: cap,
            Cmtypeidthem: cmtypeidthem,
            Cmid: cmid},
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				taocommonid_2cap_Complete(data);
			}
          //alert(data);
        }
    });
}
function taocommonid_2cap_Complete(data)
{
    $("#detailthem").hide();
        $("#tbl_2cap").hide();
    var sRes = JSON.parse(data);
    if(sRes.lst_cmtype[0].IDgenerateType==1 || sRes.lst_cmtype[0].IDgenerateType=="1")
    {
        $("#cmidthem").val("");
        $("#cmidthem").removeAttr("disabled");
    }
    else
    {
        $("#cmidthem").attr("disabled", "disabled");
        $("#cmidthem").val(sRes.ma);
    }
    if(sRes.lst_cmtype[0].IDgenerateType==3 || sRes.lst_cmtype[0].IDgenerateType=="3")
    {
        $("#detailthem").hide();
        $("#tbl_2cap").hide();
        $("#tbl_timnhieucap").show();        
    }
    else
    {
        $("#tbl_timnhieucap").hide(); 
        $("#detailthem").show();
    }
}
//load ten loai auto complete
function autoloai(cmtypeidthem)
{
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/commoncode/loadcmcode",
        dataType:"text",
        data: {
            Cmtypeidthem: cmtypeidthem},
        cache:false,
        success:function (data) {
            searchkind(data);
          //alert(data);
        }
    });
}
function searchkind(data) { 
    var sRes = JSON.parse(data);
    if (sRes != null) {
        //alert(count(sRes.lst));
        var availableLoai = [];
        for (var i = 0; i < sRes.sodong; i++) 
        {
            availableLoai[i] = sRes.lst[i].StrValue1;
        }
        $( "#loaichathem" ).autocomplete({
          source: availableLoai
        });
    }
}
//end load ten loai auto complete
function btn_chonloaicha()
{
    $("#detailthem").hide();
    var loaichathem = $("#loaichathem").val();
    var cmtypeidthem = $("#cmtypeidthem").val();
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/commoncode/btn_chonloaicha",
        dataType:"text",
        data: {
            Loaichathem: loaichathem,
            Cmtypeidthem: cmtypeidthem},
        cache:false,
        success:function (data) {
            btn_chonloaicha_Complete(data);
          //alert(data);
        }
    });
}
function btn_chonloaicha_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes.ma != "" && sRes.ma != null && sRes.ma != 0 && sRes.ma != "0")
    {
        $("#cmidthem").attr("disabled", "disabled");
        $("#cmidthem").val(sRes.ma);
        $("#detailthem").show();
    }
}
//them commoncode
function btnthem_commoncode()
{
    var cmtypeidthem = $("#cmtypeidthem").val();
    var cmidthem = $("#cmidthem").val();
    var chuoi1them = $("#chuoi1them").val();
    var chuoi2them = $("#chuoi2them").val();
    var so1them = $("#so1them").val();
    var so2them = $("#so2them").val();
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/commoncode/btnthem_commoncode",
        dataType:"text",
        data: {
            dcmtypeidthem: cmtypeidthem,
            dcmidthem: cmidthem,
            dchuoi1them: chuoi1them,
            dchuoi2them: chuoi2them,
            dso1them: so1them,
            dso2them: so2them},
        cache:false,
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				btnthem_commoncode_Complete(data);
			}
          //alert(data);
        }
    });
}
function btnthem_commoncode_Complete(data)
{
    $("#err_chuoithem").hide();
    $("#suggessadd").hide();
    var sRes = JSON.parse(data);
    if(sRes.tbchung!="")
    {
        $("#suggessadd").html(sRes.tbchung);
        $("#suggessadd").show();
    }
    if(sRes.thongbaochuoi1!="")
    {
        $("#err_chuoithem").html(sRes.thongbaochuoi1);
        $("#err_chuoithem").show();
    }
    if(sRes.thongbaoid!="")
    {
        $("#thongbaoid").html(sRes.thongbaoid);
        $("#thongbaoid").show();
    }
}
//xoa
function xoacommoncode(CommonId,CommonTypeId)
{
    var strconfirm = confirm("Bạn có chắc chắn xóa không?");
    if (strconfirm == true)
    {
        $.ajax({
            type:"POST",
            url:getUrspal() + "admin/commoncode/xoacommoncode",
            dataType:"text",
            data: {
                commonId: CommonId,
                commonTypeId: CommonTypeId},
            cache:false,
            success:function (data) {
				if( data== "-1" || data==="-1" || data==-1 )
				{
					alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
				}
				else
				{
					var sRes = JSON.parse(data);
					alert(sRes.tbchung);
					searchcommoncode(1);
				}
            }
        });
    }
}
//sua
function suacommoncode(CommonId)
{
    $("#khungtim").hide(300);
     $("#panelDataPRO").hide(300);
     $("#divTBKQTim").hide(300);
     $("#khongtimthay").hide(300);
     $("#khunginsert").hide(300);
     $("#khungedit").hide(300);
     $("#suggessedit").hide();
     $("#err_chuoisua").hide();
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/commoncode/suacommoncode",
        dataType:"text",
        data: {
            commonId: CommonId},
        cache:false,
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				suacommoncode_Complete(data);
			}
          //alert(data);
        }
    });
}
function suacommoncode_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes.sodong>0)
    {
        $("#cmtidsua").val(sRes.lst[0].CommonTypeId);
        $("#cmidsua").val(sRes.lst[0].CommonId);
        $("#chuoi1sua").val(sRes.lst[0].StrValue1);
        $("#chuoi2sua").val(sRes.lst[0].StrValue2);
        $("#so1sua").val(sRes.lst[0].NumValue1);
        $("#so2sua").val(sRes.lst[0].NumValue2);
        $("#khungedit").show(300);
    }
}
function btnsua_commoncode()
{
    var cmtidsua = $("#cmtidsua").val();
    var cmidsua = $("#cmidsua").val();
    var chuoi1sua = $("#chuoi1sua").val();
    var chuoi2sua = $("#chuoi2sua").val();
    var so1sua = $("#so1sua").val();
    var so2sua = $("#so2sua").val(); 
    $("#err_chuoisua").hide();
    $("#suggessedit").hide();  
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/commoncode/btnsua_commoncode",
        dataType:"text",
        data: {
            Cmtidsua: cmtidsua,
            Cmidsua: cmidsua,
            Chuoi1sua: chuoi1sua,
            Chuoi2sua: chuoi2sua,
            So1sua: so1sua,
            So2sua: so2sua},
        cache:false,
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				btnsua_commoncode_Complete(data);
			}
          //alert(data);
        }
    });
}
function btnsua_commoncode_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes.tbchuoi != "")
    {
        $("#err_chuoisua").html(sRes.tbchuoi);
        $("#err_chuoisua").show();
    }
    if(sRes.tbchung != "")
    {
        $("#suggessedit").html(sRes.tbchung);
        $("#suggessedit").show();
    }
}
//end sua