$(document).ready(function() {
        $("#cboPageNoPRO").change(function () {
            var trang = $("#cboPageNoPRO").val();
                searchcommontype(trang);
         });
        $("#btnreset").click(function () {
             $("#err_cmttypeidthem").hide(300);
             $("#suggessadd").hide(300);
        });
        $("#phuongthucdanhsach").click(function () {
             $("#khungtim").hide(300);
             $("#panelDataPRO").hide(300);
             $("#divTBKQTim").hide(300);
             $("#khongtimthay").hide(300);
             $("#khunginsert").hide(300);
             $("#khungedit").hide(300);
            
            $("#timcmtypeid").val("");
            $("#timmota").val("");
            $("#timghichu").val("");
            $("#timhngaytao").val("");
            searchcommontype(1);
        });
        $("#phuongthuctim").click(function () {
            $("#khungtim").show(500);
            $("#khunginsert").hide(300);
            $("#panelDataPRO").hide(300);
             $("#divTBKQTim").hide(300);
             $("#khungedit").hide(300);
             loadcmtypeid();
        });
        $("#themuser").click(function () {
            //xoa cac field
            $("#cmttypeidthem").val("");
            $("#motathem").val("");
            $("#ghichuthem").val("");
            
             $("#khungtim").hide(300);
             $("#panelDataPRO").hide(300);
             $("#divTBKQTim").hide(300);
             $("#khongtimthay").hide(300);
             $("#err_cmttypeidthem").hide();
            $("#khunginsert").show(500);
            $("#khungedit").hide(300);
            $("#suggessadd").hide(300);
            
        });
});
//load commontype id
function loadcmtypeid()
{
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/commontype/loadcmtypeid",
        dataType:"text",
        cache:false,
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				loadcmtypeid_Complete(data);
			}
          //alert(data);
        }
    });
}
function loadcmtypeid_Complete(data)
{
    var sRes = JSON.parse(data);
    var sStr = '';
    sStr ="<option value=\"0\">Tất cả</option>"
    if (sRes != null) 
    {
        if(sRes.sodong>0)
        {
                for (var i = 0; i < sRes.sodong; i++) 
               {
                    //var idloai= sRes.lst[i].StrValue2;
                    //alert(idloai);
                    sStr += "<option value=\"" + sRes.lst[i].CommonTypeId + "\" >" + sRes.lst[i].CommonTypeId + "</option>";
                }
                $("#timcmtypeid").html(sStr);
        }
    }
}
//end load commontypeid

//nhan nut tim
function searchcommontype(page) {    
   
    var timcmtypeid = $("#timcmtypeid").val();
    var timmota = $("#timmota").val();
    var timghichu = $("#timghichu").val();
    var timhngaytao = $("#timhngaytao").val();
    curPage = page;    
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/commontype/search_commontype",
        dataType:"text",
        data: {
            Cmtypeid: timcmtypeid,
            Mota: timmota,
            Ghichu: timghichu,
            Ngaytao: timhngaytao,
            Page:page},
        cache:false,
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				searchcommontype_Complete(data);
			}
          //alert(data);
        }
    });
}
function searchcommontype_Complete(data)
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
            $("#divTBKQTim div").text("Tìm được " + sRes.TotalRecord + " mẫu tin!!");
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
//them commontype
function btnthem_cmtype()
{
    var cmttypeidthem = $("#cmttypeidthem").val();
    var motathem = $("#motathem").val();
    var ghichuthem = $("#ghichuthem").val();
    var phatsinhmathem = $("#phatsinhmathem").val();
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/commontype/btnthem_cmtype",
        dataType:"text",
        data: {
            Cmttypeidthem: cmttypeidthem,
            Motathem: motathem,
            Ghichuthem: ghichuthem,
            Phatsinhmathem: phatsinhmathem},
        cache:false,
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				btnthem_cmtype_Complete(data);
			}
          //alert(data);
        }
    });
}
function btnthem_cmtype_Complete(data)
{
	$("#suggessadd").hide(300);
    $("#err_cmttypeidthem").hide();
    var sRes = JSON.parse(data);
    if(sRes.tbcmttypeid!="")
    {
        $("#err_cmttypeidthem").html(sRes.tbcmttypeid);
        $("#err_cmttypeidthem").show();
    }
    if(sRes.tbchung!="")
    {
        $("#err_cmttypeidthem").hide();
        $("#suggessadd").html(sRes.tbchung);
        $("#suggessadd").show();
    }
}

//sua 
function suacmtype(cmtypeid) {
    $("#tbupdate").hide();
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/commontype/editcommontype",
        dataType:"text",
        data: {
            dcmtypeid: cmtypeid},
        cache:false,
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				suacmtype_Complete(data);
			}
          //alert(data);
        }
    });
}
function suacmtype_Complete(data)
{
    var sRes = JSON.parse(data);
     $("#khungtim").hide(300);
     $("#panelDataPRO").hide(300);
     $("#divTBKQTim").hide(300);
     $("#khongtimthay").hide(300);
     $("#khunginsert").hide(300);
    
    $("#cmttypeidedit").val(sRes.lst_cmtype[0].CommonTypeId);
    $("#motaedit").val(sRes.lst_cmtype[0].Description);
    $("#ghichuedit").val(sRes.lst_cmtype[0].Note);
    
    var idtype;
    if(sRes.lst_cmtype[0].IDgerenateType==1)
        idtype = "Tự nhập";
    if(sRes.lst_cmtype[0].IDgerenateType==2)
        idtype = "Tự phát sinh";
    if(sRes.lst_cmtype[0].IDgerenateType==3)
        idtype = "Nhiều cấp";
    if(sRes.lst_cmtype[0].IDgerenateType==4)
        idtype = "2 cấp";
    $("#IDgerenateTypeedit").val(idtype);
    
     $("#khungedit").show(300);
}
function btnedit()
{
    $("#tbupdate").hide();
    var cmttypeidedit = $("#cmttypeidedit").val();
    var motaedit = $("#motaedit").val();
    var ghichuedit = $("#ghichuedit").val();
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/commontype/btnedit",
        dataType:"text",
        data: {
            dcmttypeidedit: cmttypeidedit,
            dmotaedit: motaedit,
            dghichuedit: ghichuedit},
        cache:false,
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				editcmtype_Complete(data);
			}
          //alert(data);
        }
    });
}
function editcmtype_Complete(data)
{
    var sRes = JSON.parse(data);
    
     $("#tbupdate").html(sRes.tbchung);
     $("#tbupdate").show();
}
//end sua
//xoa user
function xoacmtype(cmtypeid)
{
    var strconfirm = confirm("Bạn có chắc chắn xóa không?");
    if (strconfirm == true)
    {
        $.ajax({
            type:"POST",
            url:getUrspal() + "admin/commontype/xoacommontype",
            dataType:"text",
            data: {
                dobjid: cmtypeid},
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
					searchcommontype(1);
				}
            }
        });
    }
}