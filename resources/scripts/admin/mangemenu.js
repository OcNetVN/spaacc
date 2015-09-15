$(document).ready(function() {
    $("#cboPageNo").change(function () {
        var trang = $("#cboPageNo").val();
        searchMenu(trang);
    });
    
});

var curPage =1; 
function searchMenu(page) { 
    var MenuID = $("#txtmenuID").val();
    var MenuName = $("#txtmenuName").val();
    var MenuNotes = $("#txt_Notes").val();
    curPage = page;
    $.ajax({
        type:"POST",
        url: getUrspal() +"admin/menu/ajax_get_list",
        dataType:"text",
        data:{  MenuID:MenuID,
                MenuName:MenuName, 
                MenuNotes:MenuNotes,
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
                    searchMenu_Complete(data);
                }            
          //alert(data);
        }
    });
}

function searchMenu_Complete(data) {
    var sRes = JSON.parse(data);
 
    if (sRes != null) {
        $("#tbSearchMenu tbody tr").remove();
        $("#ShowSearchListMenu").tmpl(sRes.lst).appendTo("#tbSearchMenu tbody");
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
    $('#txtmenuID').val("");
    $("#txtmenuName").val("");
    $("#txt_Notes").val("");
    $("#tbSearchMenu tbody tr").remove();
    $('#divResult').css("display",'none');
}


// Edit menu bang poup
function EditMenu(id) {
    $("#spanMenuID").text(id);
    $("#txt_MenuName").val($("#trmenu" + id + " td:eq(2) span").text());  // fix
    $("#spanUrl").text($("#trmenu" +    id + " td:eq(4)   span").text());
    $("#spanNotes").text($("#trmenu" + id + " td:eq(3)    span").text());
    $("#DivEditMenu").dialog({
        height: 300,
        width: 500,
        modal: true
    });
    
}

function CloseMenu(){
    $('#DivEditMenu').dialog('close');
}
// update menu bằng poup
function LuuCapNhatMenu(){
    var MenuID = $("#spanMenuID").text();
    var MenuName = $('#txt_MenuName').val();
    $.ajax({
        type:"POST",
        url: getUrspal() +"admin/menu/ajax_capnhat_menu",
        dataType:"text",
        data:{  MenuID:MenuID,
                MenuName:MenuName
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
                    CapnhatMenu_Complete(data);
                }            
          //alert(data);
        }
    });
}
function CapnhatMenu_Complete(data){
     var res = data;
    if(res == "1" || res == 1)
    {
        $("#divmessageSucess").show(500);
        $("#divmessageError").hide(0);
        searchMenu(curPage);
    }
    else
    {
        $("#divmessageSucess").hide(0);
        $("#divmessageError").show(500);
        searchMenu(curPage);
    }
}