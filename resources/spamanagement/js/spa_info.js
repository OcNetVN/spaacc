/*
|----------------------------------------------------------------
| call funciton from common_function.js
| function check email
| function ForceNumericOnly
|----------------------------------------------------------------
*/
$(document).ready(function() {
    getlocation_by_spa();
    show_map();
    $("#txtTel").ForceNumericOnly();
    $("#txtTel1").ForceNumericOnly();
    $("#txtLoctionGPS").focusout(function(){
        show_map();
    });
    $("#txtLoctionName").focusout(function(){
        show_map();
    });
    $( "#btnsave" ).bind("click",function(){
        btnsave_spainfo();
    });
    $( "#secity" ).bind("change",function(){
        var key = $(this).val();
        load_location_child_by_location_parent(key,"");
    });
    $( "#btnreset" ).bind("click",function(){
        btnreset_spainfo();
    });
});
/*
|----------------------------------------------------------------
| function save spa info
|----------------------------------------------------------------
*/
function btnsave_spainfo()
{
    $( "[id*=notify]" ).hide();
    var txtSpaName          =   $( "#txtSpaName" ).val();
    var txtSpaAdd           =   $( "#txtSpaAdd" ).val();
    var txtTel1             =   $( "#txtTel1" ).val();
    var txtTel              =   $( "#txtTel" ).val();

    var txtEmail1           =   $( "#txtEmail1" ).val();
    var txtEmail            =   $( "#txtEmail" ).val();
    var txtLoctionGPS       =   $("#txtLoctionGPS").val();
    var findchar            =   txtLoctionGPS.indexOf(",");



    var txtLoctionName      =   $("#txtLoctionName").val();
    
    var txtWebsite          =   $("#txtWebsite").val();

    var flag = 0;

    if(txtSpaName   == ""){
        $( "#notifyspaname" ).show();
        $( "#txtSpaName" ).focus();
        flag = 1;
        
    }
    if(txtSpaAdd   == ""){
        $( "#notifyspaadd" ).show();
        $( "#txtSpaAdd" ).focus();
        flag = 1;
    }
    if(txtTel1   == ""){
        $( "#notifyspatel1" ).show();
        $( "#txtTel1" ).focus();
        flag = 1;
    }
    if(txtTel   == ""){
        $( "#notifyspatel" ).show();
        $( "#txtTel" ).focus();
        flag = 1;
    }
    if(txtEmail1   == "" || !checkemail(txtEmail1)){
        $( "#notifyspaemail1" ).show();
        $( "#txtEmail1" ).focus();
        flag = 1;
    }
    if(txtEmail   == "" || !checkemail(txtEmail)){
        $( "#notifyspaemail" ).show();
        $( "#txtEmail" ).focus();
        flag = 1;
    }

    if(txtLoctionGPS   == "" || findchar == -1){
        $( "#notifyspalocationGPS" ).show();
        $( "#txtLoctionGPS" ).focus();
        flag = 1;
    }    
    if(txtLoctionName   == ""){
        $( "#notifyspalocationName" ).show();
        $( "#txtLoctionName" ).focus();
        flag = 1;
    }
    if(txtWebsite   == ""){
        $( "#notifyspawebsite" ).show();
        $( "#txtWebsite" ).focus();
        flag = 1;
    }



    if(flag == 1)
    {
         $("#notifyerr").show();
         return;
    }
        btnsave_spainfo_step2();        
}
function btnsave_spainfo_step2()
{
    var txtSpaName          =   $( "#txtSpaName" ).val();
    var txtSpaAdd           =   $( "#txtSpaAdd" ).val();
    var txtTel1             =   $( "#txtTel1" ).val();
    var txtTel              =   $( "#txtTel" ).val();
    var txtEmail1           =   $( "#txtEmail1" ).val();
    var txtEmail            =   $( "#txtEmail" ).val();
    var txtLoctionGPS       =   $( "#txtLoctionGPS" ).val();
    var txtLoctionName      =   $( "#txtLoctionName" ).val();
    var sedistrict          =   $( "#sedistrict" ).val();
    var txtWebsite          =   $("#txtWebsite").val();
    var txtIntro            =   CKEDITOR.instances['txtIntro'].getData();
    // var txtMoreInfo         =   CKEDITOR.instances['txtMoreInfo'].getData();
    var txtNote             =   CKEDITOR.instances['txtNote'].getData();

    $.ajax({
        type:"POST",
        url: "home_controller/btnsave_spainfo",
        dataType:"text",
        data: {
            txtSpaName          :   txtSpaName,
            txtSpaAdd           :   txtSpaAdd,
            txtTel1             :   txtTel1,
            txtTel              :   txtTel,
            txtEmail1           :   txtEmail1,
            txtEmail            :   txtEmail,
            txtLoctionGPS       :   txtLoctionGPS,
            txtLoctionName      :   txtLoctionName,
            sedistrict          :   sedistrict,
            txtWebsite          :   txtWebsite,
            txtIntro            :   txtIntro,
            // txtMoreInfo         :   txtMoreInfo,
            txtNote             :   txtNote,
            },
        cache:false,
        success:function (data) {
            btnsave_spainfo_Complete(data);
        }
    });
}
function btnsave_spainfo_Complete(data)
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
function btnreset_spainfo()
{
    $( "[id*=txt]" ).val("");
    $( "[id*=notify]" ).hide();
    CKEDITOR.instances['txtNote'].setData("");
    CKEDITOR.instances['txtMoreInfo'].setData("");
    CKEDITOR.instances['txtIntro'].setData("");
}
/*
|----------------------------------------------------------------
| function get location by spa
|----------------------------------------------------------------
*/
function getlocation_by_spa()
{
    $.ajax({
        type:"POST",
        url:"home_controller/getlocation_by_spa",
        dataType:"text",
        cache:false,
        success:function (data) {
            getlocation_by_spa_Complete(data);
        }
    });
}
function getlocation_by_spa_Complete(data)
{
    var sRes = JSON.parse(data);
    // console.log(sRes);
    $("#secity").html(sRes.str_location_level1);
    load_location_child_by_location_parent(sRes.location_level1,sRes.LocationID);
}
//change city ->autoload district 
function load_location_child_by_location_parent(locationparentid,LocationID)
{
    $.ajax({
        type:"POST",
        url: "home_controller/load_location_child_by_location_parent",
        dataType:"text",
        data: {
            Locationparentid: locationparentid
            },
        cache:false,
        success:function (data) {
            loadlocationchild_Complete(data,LocationID);
        }
    });
}
function loadlocationchild_Complete(data,LocationID)
{
     var sRes = JSON.parse(data);
    if(sRes.sodong>0)
    {
        var sStr_locationchild = '';
       for (var j = 0; j < sRes.sodong; j++) 
       {
            if(LocationID   == sRes.lst[j].CommonId)
                sStr_locationchild += "<option value=\"" + sRes.lst[j].CommonId + "\" selected=\"selected\" >" + sRes.lst[j].StrValue1 + "</option>";
            else
                sStr_locationchild += "<option value=\"" + sRes.lst[j].CommonId + "\" >" + sRes.lst[j].StrValue1 + "</option>";
       }
       $("#sedistrict").html(sStr_locationchild);
    }
}
/*
|----------------------------------------------------------------
| function uploadfile
|----------------------------------------------------------------
*/
function doUpload1(url) {
    var id      = $("#txtSpaID").html();
    if (id      == "") {
        return false;
    } else {
        return doUpload(url + "/"+ id);
    }
}
/*
|----------------------------------------------------------------
| function preview image uploaded
|----------------------------------------------------------------
*/
function previewimage_spainfo() {
    $("#notifylistimage").hide();
    $("#notifysuccessdelimage").hide(); 
    $("#notifyerrdelimage").hide();  
    $("#divlistimage").html("");
    
    var id      = $("#txtSpaID").html();
    
    $.ajax({
        type:"POST",
        url:"home_controller/previewimage_spainfo",
        dataType:"text",
        data: {
                id:id
                },
        cache:false,
        success:function (data) {
            previewimage_spainfo_Complete(data);
        }
    });
}
function previewimage_spainfo_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes.flag ==1)
    {
        $("#divlistimage").html(sRes.str_res);
    }
    else
    {
        $("#notifylistimage").show();
    }
    
}
/*
|----------------------------------------------------------------
| function delete image
|----------------------------------------------------------------
*/
function deleteimage(objectidd,type)
{
    $("#notifysuccessdelimage").hide(); 
    $("#notifyerrdelimage").hide();    
    var strconfirm = confirm("Do you want continue?");
    if (strconfirm == true)
    {
        $.ajax({
            type:"POST",
            url:"home_controller/deleteimage",
            dataType:"text",
            data: {
                    objectidd   :  objectidd,
                    type        :  type
                    },
            cache:false,
            success:function (data) {
                deleteimage_Complete(data);
            }
        });
    }
}
function deleteimage_Complete(data)
{
    var sRes    = JSON.parse(data);
    if(sRes     == 1 )
        $("#notifysuccessdelimage").show(); 
    else
        $("#notifyerrdelimage").show();  
    previewimage_spainfo();  
}
/*
|----------------------------------------------------------------
| function show map
|----------------------------------------------------------------
*/
function show_map()
{
    var toado =$("#txtLoctionGPS").val().split(',');
    var content = $("#txtLoctionName").val()  ;
    //call funciton from common_function.js
    init_map(parseFloat(toado[0]), parseFloat(toado[1]),content,"gmap_canvas");
}