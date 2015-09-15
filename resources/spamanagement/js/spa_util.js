/*
|----------------------------------------------------------------
| call funciton from common_function.js
| function check email
| function ForceNumericOnly
|----------------------------------------------------------------
*/
$(document).ready(function() { 
    $("input:radio[name=checkall_util]").bind("click",function(){
        var value   = $(this).val();
        if(value    ==  1 || value    ==  "1")
            $("input:checkbox[name=cbutil]").attr('checked', true);
        else
            $("input:checkbox[name=cbutil]").removeAttr('checked');
    });
    $( "#btnsave" ).bind("click",function(){
        btnsave_spa_util();
    });
});
/*
|----------------------------------------------------------------
| function save spa util
|----------------------------------------------------------------
*/

function btnsave_spa_util()
{
    var arrcbutil               =   [];
    $('input:checkbox[name=cbutil]:checked').each(function(){
        var rowutil             =   $(this).val();
        arrcbutil.push(rowutil);
    });
    
    var cbtype                  =   $("input:radio[name=cbtype]").val();
    
    var arr_producttype         =   [];
    $('input:checkbox[name=cbproducttype]:checked').each(function(){
        var row_producttype     =   $(this).val();
        arr_producttype.push(row_producttype);
    });
    
    $.ajax({
        type:"POST",
        url: "home_controller/btnsave_spa_util",
        dataType:"text",
        data: {
            arrcbutil           :   arrcbutil,
            cbtype              :   cbtype,
            arr_producttype     :   arr_producttype,
            },
        cache:false,
        success:function (data) {
            btnsave_spa_util_Complete(data);
        },
        error: function () { alert("Error!"); }
    });
}
function btnsave_spa_util_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes.stt ==1)
    {
        $("#notifysuccess").show();
        $("#notifyerr").hide();
        
        setTimeout(function(){
            var url      =  window.location.href;
            window.location.replace(url);
        }, 1000);
    }
    else
    {
        $("#notifyerr").show();
        $("#notifysuccess").hide();
    }    
}