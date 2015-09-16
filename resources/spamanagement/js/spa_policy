/*
|----------------------------------------------------------------
| call funciton from common_function.js
| function check email
| function ForceNumericOnly
|----------------------------------------------------------------
*/
$(document).ready(function() { 
    $( "#btnsave" ).bind("click",function(){
        btnsave_spa_hour();
    });
});
/*
|----------------------------------------------------------------
| function save spa hour
|----------------------------------------------------------------
*/

function btnsave_spa_hour()
{
    var arrcbdayofweek = [];
    var i= 0;
    $('input:checkbox[name=cbdayofweek]:checked').each(function(){
        arrcbdayofweek[i++] = $(this).val();
    });
     
    var arr_hour            =   [];
    for(var i = 2; i < 10; i ++)
    {
        var hour_from       =   $("#time_from_" + i).val();
        var hour_to         =   $("#time_to_" + i).val();
        
        var arr_hour_ele    = {dayofweek : i, time_from : hour_from, time_to : hour_to};
        arr_hour.push(arr_hour_ele);
    }
    $.ajax({
        type:"POST",
        url: "home_controller/btnsave_spa_hour",
        dataType:"text",
        data: {
            arrcbdayofweek          :   arrcbdayofweek,
            arr_hour                :   arr_hour,
            },
        cache:false,
        success:function (data) {
            btnsave_spa_hour_Complete(data);
        },
        error: function () { alert("Error!"); }
    });
}
function btnsave_spa_hour_Complete(data)
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