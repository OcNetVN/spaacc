 $(document).ready(function() {
            $("#telthem").ForceNumericOnly();
            $("#teledit").ForceNumericOnly();
            $("#taxcodethem").ForceNumericOnly();
            $("#taxcodeedit").ForceNumericOnly();
         $("#cboPageNoPRO").change(function () {
            var trang = $("#cboPageNoPRO").val();
                searchuser(trang);
         });
         $("#btnreset").click(function () {
             $("#err_tendn").hide(300);
             $("#err_pass").hide(300);
             $("#err_hoten").hide(300);
             $("#err_email").hide(300);
             $("#suggessadd").hide(300);
        });
        $("#phuongthucdanhsach").click(function () {
             $("#khungtim").hide(300);
             $("#panelDataPRO").hide(300);
             $("#divTBKQTim").hide(300);
             $("#khongtimthay").hide(300);
             $("#khungthemgia").hide(300);
             $("#khunginsert").hide(300);
             $("#khungedit").hide(300);
             
             $("#objgroup").val("");
            $("#objtype").val("");
            $("#timtendn").val("");
            $("#timhoten").val("");
            $("#timdienthoai").val("");
            $("#timemail").val("");
            searchuser(1);
        });
        $("#phuongthuctim").click(function () {
            layobjgroup();
            layobjtype();
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
             $("#khungthemgia").hide(300);
            $("#khunginsert").show(500);
            $("#khungedit").hide(300);
            $("#scorethem").number(true, 0);
            $("#telthem").ForceNumericOnly();
            $("#teledit").ForceNumericOnly();
            $("#taxcodethem").ForceNumericOnly();
            $("#taxcodeedit").ForceNumericOnly();
            loadobjgroup();
            loadobjtype();
            loadrole();
            
            //xoa du lieu tren cac input
            $("#tendnthem").val("");
            $("#passwordthem").val("");
            $("#hotenthem").val("");
            $("#scorethem").val("");
            $("#pidthem").val("");
            $("#pdistatethem").val(""); 
            $("#pidissuethem").val(""); 
            $("#dobthem").val(""); 
            $("#pobthem").val(""); 
            $("#peraddthem").val("");
            $("#temaddthem").val("");
            $("#provinceidthem").val("");
            $("#telthem").val("");
            $("#faxthem").val("");
            $("#emailthem").val("");
            $("#websitethem").val("");
            $("#taxcodethem").val("");
            $("#notethem").val(""); 
        });
});
//lay object group
function layobjgroup() {  
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/user/layobjgroup",
        dataType:"text",
        cache:false,
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				showobjgroup(data);
			}
          //alert(data);
        }
    });
}
function showobjgroup(data)
{
    var sRes = JSON.parse(data);
    var sStr = '';
   // alert(sRes.lst[0]['CommonId']);
   sStr += "<option value=\"0\">Tất cả</option>";
   for (var i = 0; i < sRes.sodong; i++) 
   {
        //var idloai= sRes.lst[i].StrValue2;
        //alert(idloai);
        sStr += "<option value=\"" + sRes.lst[i].CommonId + "\" >" + sRes.lst[i].StrValue1 + "</option>";
    }
    $("#objgroup").html(sStr);
}
//end lay object group
//lay object type
function layobjtype() {  
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/user/layobjtype",
        dataType:"text",
        cache:false,
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				showobjtype(data);
			}
          //alert(data);
        }
    });
}
function showobjtype(data)
{
    var sRes = JSON.parse(data);
    var sStr = '';
   sStr += "<option value=\"0\">Tất cả</option>";
   for (var i = 0; i < sRes.sodong; i++) 
   {
        //var idloai= sRes.lst[i].StrValue2;
        //alert(idloai);
        sStr += "<option value=\"" + sRes.lst[i].CommonId + "\" >" + sRes.lst[i].StrValue1 + "</option>";
    }
    $("#objtype").html(sStr);
}
//end lay object type

//nhan nut tim
function searchuser(page) {    
   
    var objgroup = $("#objgroup").val();
    var objtype = $("#objtype").val();
    var timtendn = $("#timtendn").val();
    var timhoten = $("#timhoten").val();
    var timdienthoai = $("#timdienthoai").val();
    var timemail = $("#timemail").val();
    var tungay   =  $("#todate").val();
    var dengay   = $("#endate").val();
    
    if(tungay != "" && dengay != "" ){
        if(tungay >= dengay){
           alert("Từ ngày không được lớn hơn đến ngày");
           return; 
        }
        
    }

    curPage = page;    
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/user/search_user",
        dataType:"text",
        data: {
            Objgroup: objgroup,
            Objtype: objtype,
            Timtendn: timtendn,
            Timhoten: timhoten,
            Timdienthoai: timdienthoai,
            Timemail: timemail,
            tungay:tungay,
            denngay:dengay, 
            Page:page},
        cache:false,
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				searchuser_Complete(data);
			}
          //alert(data);
        }
    });
}
function searchuser_Complete(data)
{
    var sRes = JSON.parse(data);
    if (sRes != null) 
    {
        if(sRes.TotalRecord !=0)
        {
            $("#khungthemgia").hide(200);
            $("#khongtimthay").hide(200);
             $("#cboPageNoPRO").show(300);
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
        else
        {
            $("#khongtimthay").show(500);
            $("#panelDataPRO").hide(200);
            $("#cboPageNoPRO").hide(200);
            $("#divTBKQTim").hide(200);
        }
    }
}
//show thong tin chi tiet user
function xemuser(UserId,ObjectId,ObjectGroup,ObjectType) {
    //var objgroup = $("#objgroup").val();
    //var objtype = $("#objtype").val();
    //var timtendn = $("#timtendn").val();
    //var timhoten = $("#timhoten").val();
    //var timdienthoai = $("#timdienthoai").val();
    //var timemail = $("#timemail").val();

    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/user/dialoguser",
        dataType:"text",
        data: {
            dUserId: UserId,
            dObjectId: ObjectId,
            dObjectGroup: ObjectGroup,
            dObjectType: ObjectType},
        cache:false,
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				xemuser_Complete(data);
			}
          //alert(data);
        }
    });
}
function xemuser_Complete(data)
{
    var sRes = JSON.parse(data);
    if (sRes != null) 
    {        
        $("#showUserId").html(sRes.lstuser[0].UserId);
        $("#showFullName").html(sRes.lstuser[0].FullName);
        $("#showObjectGroup").html(sRes.lstobjgroup[0].StrValue1);
        $("#showObjectType").html(sRes.lstobjtype[0].StrValue1);
        $("#showPID").html(sRes.lstuser[0].PID);
        $("#showPIDState").html(sRes.lstuser[0].PIDState);
        $("#showPIDIssue").html(sRes.lstuser[0].PIDIssue);
        $("#showDoB").html(sRes.lstuser[0].DoB);
        $("#showPoB").html(sRes.lstuser[0].PoB);
        $("#showPerAdd").html(sRes.lstuser[0].PerAdd);
        if(sRes.lstuser[0].Gender == 0 || sRes.lstuser[0].Gender == "0")
            $("#showGender").html("Nam");
        else
            $("#showGender").html("Nữ");
        $("#showProvinceId").html(sRes.lstuser[0].ProvinceId);
        $("#showTel").html(sRes.lstuser[0].Tel);
        $("#showFax").html(sRes.lstuser[0].Fax);
        $("#showEmail").html(sRes.lstuser[0].Email);
        $("#showWebsite").html(sRes.lstuser[0].Website);
        $("#showTaxCode").html(sRes.lstuser[0].TaxCode);
        if(sRes.lstuser[0].Status == 0 || sRes.lstuser[0].Status == "0")
            $("#showGender").html("Khoá");
        else
            $("#showGender").html("Đang hoạt động");
        //$("#showStatus").html(sRes.lstuser[0].Status);
        $("#showCreatedBy").html(sRes.lstuser[0].CreatedBy);
        $("#showCreatedDate").html(sRes.lstuser[0].CreatedDate);
        
        
        $("#divxemuser").dialog({
            height: 400,
            width: 400,
            modal: true
        });
    }
}
function okshowuser()
{
    $("#divxemuser").hide();
}
//load obj group
function loadobjgroup()
{
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/user/loadobjgroup",
        dataType:"text",
        cache:false,
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				loadobjgroup_Complete(data);
			}
          //alert(data);
        }
    });
}
function loadobjgroup_Complete(data)
{
    var sRes = JSON.parse(data);
    var sStr = '';
    if (sRes != null) 
    {
        if(sRes.sodong>0)
        {
                for (var i = 0; i < sRes.sodong; i++) 
               {
                    //var idloai= sRes.lst[i].StrValue2;
                    //alert(idloai);
                    sStr += "<option value=\"" + sRes.lst[i].CommonId + "\" >" + sRes.lst[i].StrValue1 + "</option>";
                }
                $("#objgroupthem").html(sStr);
        }
    }
}
//end load objgroup
//load obj type
function loadobjtype()
{
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/user/loadobjtype",
        dataType:"text",
        cache:false,
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				loadobjtype_Complete(data);
			}
          //alert(data);
        }
    });
}
function loadobjtype_Complete(data)
{
    var sRes = JSON.parse(data);
    var sStr = '';
    if (sRes != null) 
    {
        if(sRes.sodong>0)
        {
                for (var i = 0; i < sRes.sodong; i++) 
               {
                    //var idloai= sRes.lst[i].StrValue2;
                    //alert(idloai);
                    sStr += "<option value=\"" + sRes.lst[i].CommonId + "\" >" + sRes.lst[i].StrValue1 + "</option>";
                }
                $("#objtypethem").html(sStr);
        }
    }
}
//end load obj type
//load role
function loadrole()
{
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/user/loadrole",
        dataType:"text",
        cache:false,
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				loadrole_Complete(data);
			}
          //alert(data);
        }
    });
}
function loadrole_Complete(data)
{
    var sRes = JSON.parse(data);
    var sStr = '';
    if (sRes != null) 
    {
        if(sRes.sodong>0)
        {
                for (var i = 0; i < sRes.sodong; i++) 
               {
                    //var idloai= sRes.lst[i].StrValue2;
                    //alert(idloai);
                    sStr += "<option value=\"" + sRes.lst[i].RoleId + "\" >" + sRes.lst[i].RoleName + "</option>";
                }
                $("#rolethem").html(sStr);
        }
    }
}
//end load role
//them user
function btnthem_user()
{
    var tendnthem = $("#tendnthem").val();
    var passwordthem = $("#passwordthem").val();
    var hotenthem = $("#hotenthem").val();
    var rolethem = $("#rolethem").val();
    var statusthem = $("#statusthem").val();
    var scorethem = $("#scorethem").val();
    var objgroupthem = $("#objgroupthem").val();
    var objtypethem = $("#objtypethem").val();
    var pidthem = $("#pidthem").val();
    var pdistatethem = $("#pdistatethem").val();
    if(pdistatethem==null||pdistatethem=="")
    {
        var d = new Date(); 
        var date=d.getDate();
        var month=d.getMonth()+1;
        var year=d.getFullYear();
        pdistatethem=month+ "/" + date + "/" + year;
    }
    //alert(pdistatethem); 
    var pidissuethem = $("#pidissuethem").val(); 
    var dobthem = $("#dobthem").val(); 
    if(dobthem==null||dobthem=="")
    {
        var d = new Date(); 
        var date=d.getDate();
        var month=d.getMonth()+1;
        var year=d.getFullYear();
        dobthem=month+ "/" + date + "/" + year;
    }
    //alert(dobthem);
    var pobthem = $("#pobthem").val(); 
    var peraddthem = $("#peraddthem").val();
    var temaddthem = $("#temaddthem").val();
    var gerderthem = $("#gerderthem").val();
    var provinceidthem = $("#provinceidthem").val();
    var telthem = $("#telthem").val();
    var faxthem = $("#faxthem").val();
    var emailthem = $("#emailthem").val();
    var websitethem = $("#websitethem").val();
    var taxcodethem = $("#taxcodethem").val();
    var notethem = $("#notethem").val();   
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/user/btnthem",
        dataType:"text",
        data: {
            ttendnthem: tendnthem,
            tpasswordthem: passwordthem,
            thotenthem: hotenthem,
            trolethem: rolethem,
            tstatusthem: statusthem,
            tscorethem: scorethem,
            tobjgroupthem: objgroupthem,
            tobjtypethem: objtypethem,
            tpidthem: pidthem,
            tpdistatethem: pdistatethem,
            tpidissuethem: pidissuethem,
            tdobthem: dobthem,
            tpobthem: pobthem,
            tperaddthem: peraddthem,
            ttemaddthem: temaddthem,
            tgerderthem: gerderthem,
            tprovinceidthem: provinceidthem,
            ttelthem: telthem,
            tfaxthem: faxthem,
            temailthem: emailthem,
            twebsitethem: websitethem,
            ttaxcodethem: taxcodethem,
            tnotethem: notethem},
        cache:false,
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				themuser_Complete(data);
			}
          //alert(data);
        }
    });
}
function themuser_Complete(data)
{
    $("#err_tendn").hide();
    $("#err_pass").hide();
    $("#err_hoten").hide();
    $("#err_email").hide();
    $("#suggessadd").hide();
    var sRes = JSON.parse(data);
    if(sRes.tbtendn!="")
    {
        $("#err_tendn").html(sRes.tbtendn);
        $("#err_tendn").show();
    }
    if(sRes.tbpass!="")
    {
        $("#err_pass").html(sRes.tbpass);
        $("#err_pass").show();
    }
    if(sRes.tbhoten!="")
    {
        $("#err_hoten").html(sRes.tbhoten);
        $("#err_hoten").show();
    }
    if(sRes.tbemail!="")
    {
        $("#err_email").html(sRes.tbemail);
        $("#err_email").show();
    }
    if(sRes.tbchung!="")
    {
        $("#suggessadd").html(sRes.tbchung);
        $("#suggessadd").show();
        $("#useridthem").val(sRes.UserId); 
        $("#objidthem").val(sRes.ObjectID); 
        $("#UploadHinhAnh").show(); 
        $("#err_tendn").hide();
        $("#err_pass").hide();
        $("#err_hoten").hide();
        $("#err_email").hide();
        //$("#khunginsert").hide(300);
        //searchuser(1);
    }
}

//sua 
function suauser(UserId,Name,ObjectId,ObjectGroup,ObjectType,RoleId,Gender) {
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/user/edituser",
        dataType:"text",
        data: {
            dUserId: UserId,
            dName: Name,
            dObjectId: ObjectId,
            dObjectGroup: ObjectGroup,
            dObjectType: ObjectType,
            dRoleId: RoleId,
            dGender: Gender},
        cache:false,
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				suauser_Complete(data);
			}
          //alert(data);
        }
    });
}
function suauser_Complete(data)
{
    var sRes = JSON.parse(data);
     $("#khungtim").hide(300);
     $("#panelDataPRO").hide(300);
     $("#divTBKQTim").hide(300);
     $("#khongtimthay").hide(300);
     $("#khungthemgia").hide(300);
     $("#khunginsert").hide(300);
     $("#scoreedit").number(true, 0);
    //$("#scoreedit").ForceNumericOnly();
     //obj group
    if(sRes != null)
    {
        var sStr = "";
            for (var i = 0; i < sRes.trow_objgroup; i++) 
           {
                //var idloai= sRes.lst[i].StrValue2;
                //alert(idloai);
                if(sRes.lst_obj[0].ObjectGroup==sRes.lst_objgroup[i].CommonId)
                {
                    sStr += "<option selected=\"selected\" value=\"" + sRes.lst_objgroup[i].CommonId + "\" >" + sRes.lst_objgroup[i].StrValue1 + "</option>";
                }
                else
                {
                    sStr += "<option value=\"" + sRes.lst_objgroup[i].CommonId + "\" >" + sRes.lst_objgroup[i].StrValue1 + "</option>";
                }
            }
            $("#objgroupedit").html(sStr);
    }
    //obj type
    if(sRes != null)
    {
        var sStr = "";
            for (var i = 0; i < sRes.trow_objtype; i++) 
           {
                //var idloai= sRes.lst[i].StrValue2;
                //alert(idloai);
                if(sRes.lst_obj[0].ObjectType==sRes.lst_objtype[i].CommonId)
                {
                    sStr += "<option selected=\"selected\" value=\"" + sRes.lst_objtype[i].CommonId + "\" >" + sRes.lst_objtype[i].StrValue1 + "</option>";
                }
                else
                {
                    sStr += "<option value=\"" + sRes.lst_objtype[i].CommonId + "\" >" + sRes.lst_objtype[i].StrValue1 + "</option>";
                }
            }
            $("#objtypeedit").html(sStr);
    }
    //role
    if(sRes != null)
    {
        var sStr = "";
            for (var i = 0; i < sRes.trow_role; i++) 
           {
                //var idloai= sRes.lst[i].StrValue2;
                //alert(idloai);
                if(sRes.lst_user[0].RoleId==sRes.lst_role[i].RoleId)
                {
                    sStr += "<option selected=\"selected\" value=\"" + sRes.lst_role[i].RoleId + "\" >" + sRes.lst_role[i].RoleName + "</option>";
                }
                else
                {
                    sStr += "<option value=\"" + sRes.lst_role[i].RoleId + "\" >" + sRes.lst_role[i].RoleName + "</option>";
                }
            }
            $("#roleedit").html(sStr);
    }
    //gioi tinh
    if(sRes != null)
    {
        var sStr = "";
        if(sRes.lst_obj[0].Gender==1)
        {
            sStr += "<option selected=\"selected\" value=\"1\" >Nữ</option>";
            sStr += "<option value=\"0\" >Nam</option>";
        }
        else
        {
            sStr += "<option selected=\"selected\" value=\"0\" >Nam</option>";
            sStr += "<option value=\"1\" >Nữ</option>";
        }
        $("#gerderedit").html(sStr);
    }
    //status
    if(sRes != null)
    {
        var sStr = "";
        if(sRes.lst_user[0].Status==1)
        {
            sStr += "<option selected=\"selected\" value=\"1\" >Đang hoạt động</option>";
            sStr += "<option value=\"0\" >Khoá</option>";
        }
        else
        {
            sStr += "<option selected=\"selected\" value=\"0\" >Khoá</option>";
            sStr += "<option value=\"1\" >Đang hoạt động</option>";
        }
        $("#statusedit").html(sStr);
    }
    $("#edit_tendn").val(sRes.lst_user[0].UserId);
    $("#edit_obj").val(sRes.lst_user[0].ObjectId);
    $("#edit_obj_user").val(sRes.lst_user[0].ObjectId); //phuc vu cho uphinh
    $("#edit_userid").val(sRes.lst_user[0].UserId);
        XemLaiHinhDaUp_edit();
    $("#scoreedit").val(sRes.lst_user[0].ScoreBalance);
    $("#hotenedit").val(sRes.lst_obj[0].FullName);
    $("#eidt_email").val(sRes.lst_obj[0].Email);
    $("#pidedit").val(sRes.lst_obj[0].PID);
    var str=sRes.lst_obj[0].PIDState;
    if(str != null)
    {
        str = str.substr(0,10);
        var d =str.substr(8,2);
        var m=str.substr(5,2);
        var y=str.substr(0,4);
        var dmy = m +"/"+ d +"/"+ y; 
    }
        
    else{
        str = "";
        d   = "";
        m   = "";
        y   = "";
        dmy = "";
    }
        
    //var d =str.substr(8,2);
//    var m=str.substr(5,2);
//    var y=str.substr(0,4);
    
    //alert(dmy);
    $("#pdistateedit").val(dmy);
    $("#pidissueedit").val(sRes.lst_obj[0].PIDIssue);
    var str2=sRes.lst_obj[0].DoB;
    if(str2 != null){
         str2 = str2.substr(0,10);
        var d2=str2.substr(8,2);
        var m2=str2.substr(5,2);
        var y2=str2.substr(0,4);
        var dmy2 = m2 +"/"+ d2 +"/"+ y2;
    }
    else{
        str = "";
        dmy2 = "";
    }
   
    //alert(dmy2);
    $("#dobedit").val(dmy2);
    $("#pobedit").val(sRes.lst_obj[0].PoB);
    $("#peraddedit").val(sRes.lst_obj[0].PerAdd);
    $("#temaddedit").val(sRes.lst_obj[0].TemAdd);
    $("#provinceidedit").val(sRes.lst_obj[0].ProvinceId);
    $("#teledit").val(sRes.lst_obj[0].Tel);
    $("#faxedit").val(sRes.lst_obj[0].Fax);
    $("#websiteedit").val(sRes.lst_obj[0].Website);
    $("#taxcodeedit").val(sRes.lst_obj[0].TaxCode);
    $("#noteedit").val(sRes.lst_obj[0].Note);
    
     $("#khungedit").show(300);
}
function btnedit()
{
    $("#tbupdate").hide();
    var tendnedit = $("#edit_tendn").val();
    var edit_obj = $("#edit_obj").val();
    var passwordedit = $("#passwordedit").val();
    var hotenedit = $("#hotenedit").val();
    var roleedit = $("#roleedit").val();
    var statusedit = $("#statusedit").val();
    var scoreedit = $("#scoreedit").val();
    var objgroupedit = $("#objgroupedit").val();
    var objtypeedit = $("#objtypeedit").val();
    var pidedit = $("#pidedit").val();
    
    var pdistateedit = $("#pdistateedit").val(); 
    if(pdistateedit==null||pdistateedit=="")
    {
        var d = new Date(); 
        var date=d.getDate();
        var month=d.getMonth()+1;
        var year=d.getFullYear();
        pdistateedit=month+ "/" + date + "/" + year;
    }
    //alert(pdistateedit);
    var pidissueedit = $("#pidissueedit").val(); 
    var dobedit = $("#dobedit").val(); 
    if(dobedit==null||dobedit=="")
    {
        var d = new Date(); 
        var date=d.getDate();
        var month=d.getMonth()+1;
        var year=d.getFullYear();
        dobedit=month+ "/" + date + "/" + year;
    }
    //alert(dobedit);
    var pobedit = $("#pobedit").val(); 
    var peraddedit = $("#peraddedit").val();
    var temaddedit = $("#temaddedit").val();
    var gerderedit = $("#gerderedit").val();
    var provinceidedit = $("#provinceidedit").val();
    var teledit = $("#teledit").val();
    var faxedit = $("#faxedit").val();
    var emailedit = $("#eidt_email").val();
    var websiteedit = $("#websiteedit").val();
    var taxcodeedit = $("#taxcodeedit").val();
    var noteedit = $("#noteedit").val();   
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/user/btnedit",
        dataType:"text",
        data: {
            ttendnedit: tendnedit,
            tedit_obj: edit_obj,
            tpasswordedit: passwordedit,
            thotenedit: hotenedit,
            troleedit: roleedit,
            tstatusedit: statusedit,
            tscoreedit: scoreedit,
            tobjgroupedit: objgroupedit,
            tobjtypeedit: objtypeedit,
            tpidedit: pidedit,
            tpdistateedit: pdistateedit,
            tpidissueedit: pidissueedit,
            tdobedit: dobedit,
            tpobedit: pobedit,
            tperaddedit: peraddedit,
            ttemaddedit: temaddedit,
            tgerderedit: gerderedit,
            tprovinceidedit: provinceidedit,
            tteledit: teledit,
            tfaxedit: faxedit,
            temailedit: emailedit,
            twebsiteedit: websiteedit,
            ttaxcodeedit: taxcodeedit,
            tnoteedit: noteedit},
        cache:false,
        success:function (data) {
			if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				edituser_Complete(data);
			}
          //alert(data);
        }
    });
}
function edituser_Complete(data)
{
    var sRes = JSON.parse(data);
    
    $("#err_hotenedit").html(sRes.tbten);
     $("#tbupdate").html(sRes.tbchung);
     $("#tbupdate").show();
}
//end sua
//xoa user
function xoauser(userid,objid)
{
    var strconfirm = confirm("Bạn có chắc chắn xóa không?");
    if (strconfirm == true)
    {
        $.ajax({
            type:"POST",
            url:getUrspal() + "admin/user/xoauser",
            dataType:"text",
            data: {
                duserid: userid,
                dobjid: objid},
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
					searchuser(1);
				}
            }
        });
    }
}
//upload hinh
function doUpload1(url) {
    var PromoID = $("#objidthem").val();
    if (PromoID == "") {
        return false;
    } else {
        return doUpload(url + "/"+ PromoID);
    }
}
function doUpload_edit1(url) {
    var PromoID = $("#edit_obj_user").val();
    //alert(url + "/"+ PromoID);
    if (PromoID == "") {
        return false;
    } else {
        //alert(PromoID);
        return doUpload_edit(url + "/"+ PromoID);
    }
}

function XemLaiHinhDaUp() {
    var PromoID = $("#objidthem").val();    
    $("#divXemLaiHinhDaUp").show(500); 
    $.ajax({
        url: getUrspal() + "admin/user/gethinhpromotion",
        type: "POST",
        data: { Promotion: PromoID },
        cache: false,
        dataType: "text",
        contentType: "application/json; charset=utf-8",
        success:
                function (data) {
                    XemLaiHinhDaUp_Complete(data);
                },
        error: function () {
        }
    });
}

function XemLaiHinhDaUp_Complete(data) {
    var sRes = data;  
    var sRes = JSON.parse(data);
    if (sRes != null) {
        var str = "<div style=\"float: left;\">";

        for (i = 0; i < sRes.length; i++) {
            str = str + "<div id=\"divLinks" + sRes[i].id + "\" style=\"padding: 10px; float: left\">";
            str = str + "<img src= " + getUrspal()  + sRes[i].URL + " width=\"180\"/>";
            str = str + "<a href=\"javascript:void(0);\" onclick=\"XoaHinhProduct('" + sRes[i].id + "');\">Xóa</a>";
            str = str + "</div>";
        }

        str = str + "</div>";
        $("#divXemLaiHinhDaUp").html("");
        $("#divXemLaiHinhDaUp").append(str);
        cboProductType
        $("#divXemLaiHinhDaUp").dialog({
            height: 600,
            width: 800,
            modal: true
        });
    }
}

function XoaHinhProduct(id) {
    var strconfirm = confirm("Bạn có chắc chắn xóa không?");
    if (strconfirm == true) {
        $.ajax({
            url: getUrspal() + "admin/products/xoahinh",
            type: "POST",
            data: { ID: id },
            cache: false,
            dataType: "text",
            contentType: "application/json; charset=utf-8",
            success:
                    function (data) {
                        XoaHinhProduct_Complete(data);
                        var res = JSON.parse(data);
                        if (res.Result == "1") {
                            $("#divLinks" + id).remove();
                        }
                    },
            error: function () {
            }
        });
    }
}
    //show nhung hinh cua object do
    function XemLaiHinhDaUp_edit() {
        var PromoID = $("#edit_obj").val();
        //alert(PromoID); 
        $("#divXemLaiHinhDaUp").show(500); 
        $.ajax({
            url: getUrspal() + "admin/user/gethinhpromotionedit",
            type: "POST",
            data: { Promotion_edit: PromoID },
            cache: false,
            dataType: "text",
            contentType: "application/json; charset=utf-8",
            success:
                    function (data) {
                        XemLaiHinhDaUp_edit_Complete(data);
                    },
            error: function () {
            }
        });
    }
    function XemLaiHinhDaUp_edit_Complete(data) {
        var sRes = data;  
        var sRes = JSON.parse(data);
        if (sRes != null) {
            var str = "<div style=\"float: left;\">";
    
            for (i = 0; i < sRes.length; i++) {
                str = str + "<span id=\"divLinks" + sRes[i].id + "\" style=\"padding: 10px; float: left\">";
                str = str + "<img src="+ getUrspal()  + sRes[i].URL + " width=\"100\"/>";
                str = str + "<a href=\"javascript:void(0);\" onclick=\"XoaHinhProduct('" + sRes[i].id + "');\">Xóa</a>";
                str = str + "</span>";
            }
    
            str = str + "</div>";
            $("#divXemLaiHinhDaUp_edit").html("");
            $("#divXemLaiHinhDaUp_edit").append(str);
        }
    }
//end upload hinh