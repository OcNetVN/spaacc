$(document).ready(function() {
    $("#cboPageNo").change(function () {
        var trang = $("#cboPageNo").val();
        searchScore(trang);
    });
    
});

var curPage =1;
function searchScore(page) {    

    var ID = $("#txt_ID").val();
    var Name = $("#txt_Name").val();
    var NewTypeObj = $("#cboNewObj").val();
    curPage = page;    
    
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/scores/search_scores",
        dataType:"text",
        data: {
                ID: ID, 
                Name: Name,
                NewTypeObj: NewTypeObj,
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
                    searchScore_Complete(data);
                }
          //alert(data);
        }
    });
}

function searchScore_Complete(data) {
    var sRes = JSON.parse(data);
    if (sRes != null) {
        if(sRes == 0 || sRes == '0')
        {
            $("#panelDataPRO tbody tr").remove();
            alert("Vui lòng chọn loại đối tượng để thông tin biết điểm");
            return false;
        }
        $("#panelDataPRO tbody tr").remove();
        $("#ListFoundPRO").tmpl(sRes.lst).appendTo("#panelDataPRO tbody");
        $("#panelDataPRO").show(500);
               
        //phÃ¢n trang
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
}

function ShowDetail(id){
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/scores/show_scores",
        dataType:"text",
        data: {ID: id},
        cache:false,
        success:function (data) {
                if( data== "-1" || data==="-1" || data==-1 )
                {
                    alert("Ban Khong Co quyen tren chuc nang nay o trang nay !!! ");                    
                }
                else
                {
                    ShowDetail_Complete(data);
                }
          //alert(data);
        }
    });
}

function ShowDetail_Complete(data){
    var sRes = JSON.parse(data);
    if (sRes != null) {
        if(sRes == 0 || sRes == '0')
        {
            //$("#panelDataPRO tbody tr").remove();
//            alert("Vui lòng chọn loại đối tượng để thông tin biết điểm");
//            return false;
        }
        $("#panelDataScoreTrans tbody tr").remove();
        $("#ListFoundScore").tmpl(sRes.lst).appendTo("#panelDataScoreTrans tbody");
        $("#panelDataScoreTrans").show(500);
       // $("#divTBKQTim div").text("Tim duoc " + sRes.TotalRecord + " mau tin!!!");
       
       
    }
}

function ResetDiem(id){
     $('#ObjectID').text(id);
     $("#DivRestScore").dialog({
        height: 300,
        width: 500,
        modal: true
    });
     
}

function ResetCore(){
    var id = $('#ObjectID').text();
    var score = $('#txt_Score').val();
    $.ajax({
        type:"POST",
        url:getUrspal() + "admin/scores/restScore",
        dataType:"json",
        data: {ID: id,
                Score:score},
        cache:false,
        success:function (data) {
                if( data== "-1" || data==="-1" || data==-1 )
                {
                    alert("Ban Khong Co quyen tren chuc nang nay o trang nay !!! ");                    
                }
                else
                {
                    ResetScore_Complete(data);
                }
          //alert(data);
        }
    });
}

function ResetScore_Complete(data) {
    var res = data;
    if(res == "1" || res == 1)
    {
        $("#divmessageSucess").show(500);
        $("#divmessageError").hide(0);
        searchScore(curPage);
        
    }
    else
    {
        $("#divmessageSucess").hide(0);
        $("#divmessageError").show(500);
        
    }
}

function CloseDiv(){
    $('#DivRestScore').dialog('close');
}