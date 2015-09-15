$(document).ready(function() {
    $("#btnlistcomment").hide();
    $("#btnsearch").bind("click",function(){
        var txtseach                =   $("#txtsearch").val();
        var txtdatefromsearch       =   $("#txtdatefromsearch").val();
        var txtdatetosearch         =   $("#txtdatetosearch").val();
        var sestatussearch          =   $("#sestatussearch").val();
        
        btnsearch(1,txtseach,txtdatefromsearch,txtdatetosearch,sestatussearch); 
    });
});
function btnsearch(page,txtsearch,datefrom,dateto,status)
{
    $.ajax({
        type:"POST",
        url:"comment/btnsearch",
        dataType:"text",
        data: {
                page            :   page,
                txtsearch       :   txtsearch,
                datefrom        :   datefrom,
                dateto          :   dateto,
                status          :   status,
                },
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				btnsearch_Complete(data);
			}
        },
        error: function () { alert("Error!");}
    });
}
function btnsearch_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes.totalrow > 0)
    {
        $("#notifyres").hide();
        $("#tbodylistcomment").html(sRes.str_list);
        $("#divpagination").html(sRes.str_numpage);
        $("#btnlistcomment").show();
    }
    else
    {
        $("#btnlistcomment").hide();
        $("#notifyres").html(sRes.notfound);
        $("#notifyres").show();
        $("#divpagination").html("");
    }
}
/*
|----------------------------------------------------------------
|change status
|----------------------------------------------------------------
*/

function changestatus(id)
{
    var value           =   $("#sestatusedit_" + id + " option:selected").val();
    
    $.ajax({
        type:"POST",
        url:"comment/changestatus",
        dataType:"text",
        data: {
                id          :   id,
                value       :   value 
                },
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
				changestatus_Complete(data);
			}
        },
        error: function () { alert("Error!");}
    });
}
function changestatus_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes.status == 0 ||  sRes.status == "0")
    {
        alert(sRes.notify);
    }
    
    var page    =   parseFloat($("ul.pagination li.active a").html());
    var txtseach                =   $("#txtsearch").val();
    var txtdatefromsearch       =   $("#txtdatefromsearch").val();
    var txtdatetosearch         =   $("#txtdatetosearch").val();
    var sestatussearch          =   $("#sestatussearch").val();
    
    btnsearch(page,txtseach,txtdatefromsearch,txtdatetosearch,sestatussearch); 
}
/*
|----------------------------------------------------------------
|click button delete
|----------------------------------------------------------------
*/
function deletecomment(id)
{
    var strconfirm = confirm("Bạn muốn tiếp tục?");
    if (strconfirm == true)
    {
        $.ajax({
            type:"POST",
            url:"comment/deletecomment",
            dataType:"text",
            data: {
                    id: id                              
                    },
            cache:false,
            success:function (data) {
                if( data== "-1" || data==="-1" || data==-1 )
                {
                    alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
                }
                else
                {
    				deletecomment_Complete(data);
    			}
            },
            error: function () { alert("Error!");}
        });
    }
}
function deletecomment_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes.status!=1 && sRes.status!="1")
    {
        alert(sRes.notify);
    }
    
    var page    =   parseFloat($("ul.pagination li.active a").html());
    var txtseach                =   $("#txtsearch").val();
    var txtdatefromsearch       =   $("#txtdatefromsearch").val();
    var txtdatetosearch         =   $("#txtdatetosearch").val();
    var sestatussearch          =   $("#sestatussearch").val();
    
    btnsearch(page,txtseach,txtdatefromsearch,txtdatetosearch,sestatussearch); 
}