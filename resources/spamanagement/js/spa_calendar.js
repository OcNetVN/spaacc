/*
|----------------------------------------------------------------
| call funciton from common_function.js
| function check email
| function ForceNumericOnly
|----------------------------------------------------------------
*/
$(document).ready(function() {
    $( "#btnsave" ).bind("click",function(){
        btnsave_spa_policy_step2();
    });
    $( "#btnreset" ).bind("click",function(){
        btnreset_spa_policy();
    });
});
/*
|----------------------------------------------------------------
| function save spa policy
|----------------------------------------------------------------
*/

function btnsave_spa_policy_step2()
{
    var txtMoreInfo         =   CKEDITOR.instances['txtMoreInfo'].getData();

    $.ajax({
        type:"POST",
        url: "home_controller/btnsave_spa_policy",
        dataType:"text",
        data: {
            txtMoreInfo         :   txtMoreInfo
            },
        cache:false,
        success:function (data) {
            btnsave_spa_policy_Complete(data);
        }
    });
}
function btnsave_spa_policy_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes.stt ==1)
    {
        $("#notifysuccess").show();
        $("#notifyerr").hide();
        
        setTimeout(function(){
            var url      =  window.location.href;

            window.location.replace(url);
        }, 2000);

    }
    else
    {
        $("#notifyerr").show();
        $("#notifysuccess").hide();

    }    
}
/*
|----------------------------------------------------------------
| function reset form
|----------------------------------------------------------------
*/
function btnreset_spa_policy()
{
    $( "[id*=txt]" ).val("");
    $( "[id*=notify]" ).hide();
    CKEDITOR.instances['txtMoreInfo'].setData("");
}
/*
|----------------------------------------------------------------
| function get location by spa
|----------------------------------------------------------------
*/
