$(document).ready(function() {
    $("#cboPageNo").change(function () {
        var trang = $("#cboPageNo").val();
        searchModule(trang);
    });
    
});

var curPage =1; 
function searchModule(page) { 
    var ModuleID = $("#txtmoduleID").val();
    var ModuleNotes = $("#txtNotes").val();
    curPage = page;
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/module/ajax_get_list",
        dataType:"text",
        data:{  ModuleID:ModuleID, 
                ModuleNotes:ModuleNotes,
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
                    searchModule_Complete(data);
                }            
          //alert(data);
        }
    });
}

function searchModule_Complete(data) {
    var sRes = JSON.parse(data);
 
    if (sRes != null) {
        $("#tbSearchModule tbody tr").remove();
        $("#ShowSearchListModule").tmpl(sRes.lst).appendTo("#tbSearchModule tbody");
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
    $('#txtmoduleID').val("");
    $("#txtNotes").val("");
    $("#tbSearchModule tbody tr").remove();
    $('#divResult').css("display",'none');
}


// Edit menu bang poup
function EditModule(id) {
    $("#spanModuleID").text(id);
    $("#txt_Description").val($("#trmodule" + id + " td:eq(2) span").text());  // fix
    $("#DivEditModule").dialog({
        height: 300,
        width: 500,
        modal: true
    });
    
}

function CloseModule(){
  $('#DivEditModule').dialog('close')  
}
// update menu bằng poup
function LuuCapNhatModule(){
    var ModuleID = $("#spanModuleID").text();
    var Description = $('#txt_Description').val();
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/module/ajax_capnhat_module",
        dataType:"text",
        data:{  ModuleID:ModuleID,
                Description:Description
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
                    CapnhatModule_Complete(data);
                }            
          //alert(data);
        }
    });
}
function CapnhatModule_Complete(data){
     var res = data;
    if(res == "1" || res == 1)
    {
        $("#divmessageSucess").show(500);
        $("#divmessageError").hide(0);
        searchModule(curPage);
    }
    else
    {
        $("#divmessageSucess").hide(0);
        $("#divmessageError").show(500);
        searchModule(curPage);
    }
}