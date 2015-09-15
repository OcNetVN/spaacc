 $(document).ready(function() {
    $("#cboPageNo").change(function () {
        var trang = $("#cboPageNo").val();
        searchRoleMenuModule(trang);
    });

    $("#_txtMenuID").change(function(){
        var MenuID = $("#_txtMenuID").val();
        var MenuName =$("#_txtMenuID option[value='"+MenuID+"']").html();
        InsertMenu(MenuID,MenuName);
    }); 
    
});


function InsertMenu(MenuID,MenuName)
{
    if($("#DivMenuID"+MenuID + " span").text()=="" && MenuID != "0")
    {
            var url = "resources/images/filecloseBTN.png";
            var str="<div id=\"DivMenuID"+MenuID+"\" class=\"doituongDIV\" maid=\""+MenuID+"\" >";
            //var str1="<div id=\"DivCategoryIDShow"+ProductID+"\" class=\"doituongDIV\" maid=\""+ProductID+"\" >";    
            str = str+ "<span>" + MenuName+"</span>";
            //str1 = str1+ "<span>" +ProductName+"</span> ";    
            str = str+ "<a href=\"javascript:void(0);\" onclick=\"XoaObject('DivMenuID"+MenuID+"');\"><img src="+ url +" height=\"12\" /></a>";
            str = str+ "</div>";    
            //str1 = str1+ "</div>";  
       
            //$("#tdProduct").append(str);
            $("#tdShowMenu").append(str);
            var list_menu = [];
            var sss=$("#txt_MenuID").val();
            if(!(sss.indexOf("["+MenuID+"];")>=0))
            {     
                list_menu.push(MenuID) ;                          
                sss = sss +"["+ MenuID+"];";     
                $("#txt_MenuID").val(sss);           
            }
    }
}

function XoaObject(id)
{
    if(id.indexOf('DivMenuID')>=0 )
    {
         var str = id.replace("DivMenuID","");
         $("#DivMenuID"+str).remove();
         //$("#DivCategoryIDShow"+str).remove();
        var sss=$("#txt_MenuID").val();
        if(sss.indexOf("["+str+"];")>=0)
        {
            var sss1 = sss.replace("["+str+"];","");     
            $("#txt_MenuID").val(sss1);                               
        }          
    }     
}



var curPage =1; 
function searchRoleMenuModule(page) { 
    var RoleID = $("#txtRoleID").val();
    var MenuID = $("#txtMenuID").val();
    var ModuleID = $("#txtModuleID").val();
    curPage = page;
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/rolemenumodule/ajax_get_list",
        dataType:"text",
        data:{  RoleID:RoleID, 
                MenuID:MenuID,
                ModuleID:ModuleID,
                Page:page
              },
        cache:false,
        success:function (data) {
                if( data== "-1" || data==="-1" || data==-1 )
                {
                    alert("Ban Khong Co quyen tren chuc nang nay o trang nay !!! ");                    
                }
                else
                {
                    //alert("Co quyen them moi");
                    searchRoleMenuModule_Complete(data);
                }            
          //alert(data);
        }
    });
}

function searchRoleMenuModule_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
        $("#tbSearchRolesMenu tbody tr").remove();
        $("#ShowSearchListRolesMenu").tmpl(sRes.lst).appendTo("#tbSearchRolesMenu tbody");
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
    }
}

function Reset(){
    $('#txtRoleID').val("");
    $("#txtMenuID").val("");
    $("#txtModuleID").val("");
    $("#tbSearchRolesMenu tbody tr").remove();
    $('#divResult').css("display",'none');
}

//DeleteRoleModule(roleid,menuid,moduleid)
// Edit menu bang poup
function EditRoleModule(roleid,menuid,moduleid) {
    
        $("#txt_RoleID").text(roleid);
        $("#txt_MenuID").text(menuid);
        $("#txt_ModuleID").text(moduleid);
        var allonew = $("#trRoleId" + roleid + menuid + moduleid +" td:eq(7) span:eq(0)").text();
        var alloedit = $("#trRoleId" + roleid + menuid + moduleid +" td:eq(7) span:eq(1)").text();
        var allodele = $("#trRoleId" + roleid + menuid + moduleid +" td:eq(7) span:eq(2)").text();
        var alloview = $("#trRoleId" + roleid + menuid + moduleid +" td:eq(7) span:eq(3)").text();
        var alloprint = $("#trRoleId" + roleid + menuid + moduleid +" td:eq(7) span:eq(4)").text();
        if(allonew == 1 || allonew == "1"){
            $('#_AllowNew').attr("checked", "checked");
        }
        if(alloview == 1 || alloview == "1"){
            $('#_AllowView').attr("checked", "checked");
        }
        if(alloedit == 1 || alloedit == "1"){
            $('#_AllowEdit').attr("checked", "checked");
        }
        if(allodele == 1 || allodele == "1"){
            $('#_AllowDelete').attr("checked", "checked");
        }
        if(alloprint == 1 || alloprint == "1"){
            $('#_AllowPrint').attr("checked", "checked");
        }
        
        $("#DivEditRoleModule").dialog({
            height: 400,
            width: 600,
            modal: true
        });
}

// update menu bằng poup
function LuuCapNhatRoleMenuModule(){
    var RoleID = $("#txt_RoleID").text();
    var MenuID = $("#txt_MenuID").text();
    var ModuleID = $("#txt_ModuleID").text();
    var AllowNew = $("#_AllowNew").attr("checked") ? 1 : 0;
    var AllowEdit = $("#_AllowEdit").attr("checked") ? 1 : 0;
    var AllowPrint = $("#_AllowPrint").attr("checked") ? 1 : 0;//_AllowDelete _AllowPrint _AllowView
    var AllowView = $("#_AllowView").attr("checked") ? 1 : 0;//AllowDelete
    var AllowDelete = $("#_AllowDelete").attr("checked") ? 1 : 0;
    $.ajax({
        type: "POST",
        url: getUrspal() + "admin/rolemenumodule/capnhat_rolemenumodule",
        dataType: "text",
        data: {
            RoleID: RoleID, 
            MenuID: MenuID,
            ModuleID: ModuleID,
            AllowNew:AllowNew,
            AllowEdit: AllowEdit,
            AllowPrint: AllowPrint,
            AllowView: AllowView,
            AllowDelete:AllowDelete
        },
        cache: false,
        success: function (data) {
            if(data == -1|| data == "-1" || data === -1){
                alert("Bạn không có quyền thực hiện chức năng này trên trang này");
            }
            else{
                 LuuCapNhatRoleMenuModule_Complete(data);
            }
           
            //alert(data);
        }
    });
}
function LuuCapNhatRoleMenuModule_Complete(data){
     var res = data;
    if(res == "1" || res == 1)
    {
        $("#divmessageSucess").show(500);
        $("#divmessageError").hide(0);
        searchRoleMenuModule(curPage);
    }
    else
    {
        $("#divmessageSucess").hide(0);
        $("#divmessageError").show(500);
        searchRoleMenuModule(curPage);
    }
}

// thêm thông tin khuyến mãi cho cho sản phẩm
function TheMoiRoleMenuModule() {
    var RoleID = $("#_txtRoleID").val();
    var MenuID = $("#_txtMenuID").val();
    var listMenID = $("#txt_MenuID").val();
    var ModuleID = $("#_txtModuleID").val();
    var AllowNew = $("#AllowNew").attr("checked") ? 1 : 0;
    var AllowEdit = $("#AllowEdit").attr("checked") ? 1 : 0;
    var AllowPrint = $("#AllowPrint").attr("checked") ? 1 : 0;
    var AllowView = $("#AllowView").attr("checked") ? 1 : 0;//AllowDelete
    var AllowDelete = $("#AllowDelete").attr("checked") ? 1 : 0;
    $.ajax({
        type: "POST",
        url: getUrspal() + "admin/rolemenumodule/them_moi_rolemenumodule",
        dataType: "text",
        data: {
            RoleID: RoleID, 
            MenuID: MenuID,
            ListMenuID:listMenID,
            ModuleID: ModuleID,
            AllowNew:AllowNew,
            AllowEdit: AllowEdit,
            AllowPrint: AllowPrint,
            AllowView: AllowView,
            AllowDelete:AllowDelete
        },
        cache: false,
        success: function (data) {
            if(data == -1|| data == "-1" || data === -1){
                alert("Bạn không có quyền thực hiện chức năng này trên trang này");
            }
            else{
                 TheMoiRole_Complete(data);
            }
           
            //alert(data);
        }
    });
}



function TheMoiRole_Complete(data) {
    //var res = data;
    if(data.res == "1" || data.res == 1)
    {
        $("#divAddmessageSucess").show(500);
        $("#divAddmessageError").hide(0);
    }
    else
    {
        $("#divAddmessageSucess").hide(0);
        $("#divAddmessageError").show(500);
    }
    
    if(data.str != ""){
        $("#divmessageunit").show(500);
    }
    
}

function DeleteRoleModule(roleid,menuid,moduleid){  
        var strconfirm = confirm("Bạn có chắc chắn xóa không?");
        if (strconfirm == true) {
            $.ajax({
            type:"POST",
            url:getUrspal() + "admin/rolemenumodule/delete_rolemenumodule",
            dataType:"text",
            data:{  RoleID:roleid,
                    MenuID:menuid,
                    ModuleID:moduleid
                 },
            cache:false,
            success:function (data) {
                    if( data== "-1" || data==="-1" || data==-1 )
                    {
                        alert("Ban Khong Co quyen tren chuc nang nay o trang nay !!! ");                    
                    }
                    else
                    {
                        //alert("Co quyen them moi");
                        XoaRole_Complete(data);
                    }            
              //alert(data);
            }
        });
      }      
}

function XoaRole_Complete(data){
     var res = data;
    if(res == "1" || res == 1)
    {
        
        searchRoleMenuModule(curPage);
    }
   
}

function ResetModule(){
    $("#_txtRoleID option").removeAttr("selected");
    $("#_txtMenuID option").removeAttr("selected");//_txtMenuID
    $("#_txtModuleID option").removeAttr("selected");//_txtModuleID
}

function CloseRoleMenuModule(){
    $('#DivEditRoleModule').dialog('close');
    $('#divmessageSucess').hide(0);
    $('#divmessageError').hide(0);
    
}
