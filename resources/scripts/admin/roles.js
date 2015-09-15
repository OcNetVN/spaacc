$(document).ready(function() {
    $("#cboPageNo").change(function () {
        var trang = $("#cboPageNo").val();
        searchRoles(trang);
    });
    
});

var curPage =1; 
function searchRoles(page) { 
    var RoleID = $("#txtRoleID").val();
    var RoleName = $("#txtRoleName").val();
    curPage = page;
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/role/ajax_get_list",
        dataType:"text",
        data:{  RoleID:RoleID, 
                RoleName:RoleName,
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
                    searchRoles_Complete(data);
                }            
          //alert(data);
        }
    });
}

function searchRoles_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
        $("#tbSearchRoles tbody tr").remove();
        $("#ShowSearchListRoles").tmpl(sRes.lst).appendTo("#tbSearchRoles tbody");
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
    $("#txtRoleName").val("");
    $("#tbSearchRoles tbody tr").remove();
    $('#divResult').css("display",'none');
}

// close poup
function CloseRole(){
    //DivEditRole
    $('#DivEditRole').dialog('close');
}
// Edit menu bang poup
function EditRoles(id) {
    if(id == "admin"){
       alert("Không được phép chỉnh sửa"); 
    }
    else{
        $("#txt_RoleID").val(id);
        $("#txt_RoleName").val($("#tr" + id + " td:eq(2) span").text());  // fix
        $("#DivEditRole").dialog({
            height: 300,
            width: 500,
            modal: true
        });
    }
    
    $('#divmessageSucess').hide(0);
     $('#divmessageError').hide(0);
    
}

// update menu bằng poup
function LuuCapNhatRole(){
    var RoleID = $("#txt_RoleID").val();
    var RoleName = $('#txt_RoleName').val();
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/role/ajax_capnhat_role",
        dataType:"text",
        data:{  RoleID:RoleID,
                RoleName:RoleName
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
                    LuuCapNhatRole_Complete(data);
                }            
          //alert(data);
        }
    });
}
function LuuCapNhatRole_Complete(data){
     var res = data;
    if(res == "1" || res == 1)
    {
        $("#divmessageSucess").show(500);
        $("#divmessageError").hide(0);
        searchRoles(curPage);
    }
    else
    {
        $("#divmessageSucess").hide(0);
        $("#divmessageError").show(500);
        searchRoles(curPage);
    }
}

// thêm thông tin khuyến mãi cho cho sản phẩm
function TheMoiRole() {
    var RoleID = $("#_txtRoleID").val();
    var RoleName = $("#_txtRoleName").val();
    $.ajax({
        type: "POST",
        url: getUrspal() + "admin/role/them_moi_role",
        dataType: "text",
        data: {
            RoleID: RoleID, 
            RoleName: RoleName
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
    var res = data;
    if(res == "1" || res == 1)
    {
        $("#divAddmessageSucess").show(500);
        $("#divAddmessageError").hide(0);
    }
    else
    {
        $("#divAddmessageSucess").hide(0);
        $("#divAddmessageError").show(500);
    }
    
}
function DeleteRoles(id){
    if(id == 'admin'){
        alert("Không được quyền phép xóa admin");
    }
    else{
        var strconfirm = confirm("Bạn có chắc chắn xóa không?");
        if (strconfirm == true) {
            $.ajax({
            type:"POST",
            url:getUrspal() + "admin/role/delete_role",
            dataType:"text",
            data:{RoleID:id},
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
}

function XoaRole_Complete(data){
     var res = data;
    if(res == "1" || res == 1)
    {
        
        searchRoles(curPage);
    }
   
}
