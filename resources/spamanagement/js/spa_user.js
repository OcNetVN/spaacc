/*
|----------------------------------------------------------------
| call funciton from common_function.js
| function check email
| function ForceNumericOnly
|----------------------------------------------------------------
*/
$(document).ready(function() { 
    getlistuser(1,9);
    $( "#ultab li" ).bind("click",function(){
        $( "[id*='li_']" ).removeAttr("class");
        $(this).attr( "class", "active" );
        get_number_user_show_ultab();
        
        var stridtab        =   $(this).attr("id");
        var idtab           =   stridtab.substr(3,1);
        getlistuser(1, idtab);
    });
    $( "#btnsearchuser" ).bind("click",function(){
        var txtsearch       =   $( "#txtsearch" ).val();
        searchuser(1,txtsearch);
    });
    $( "#btnsavemodal" ).bind("click",function(){
        addspausermodal();
    });
    
});
/*
|----------------------------------------------------------------
| function get list user 
|----------------------------------------------------------------
*/
function getlistuser(page, tab)
{
    get_number_user_show_ultab();
    /*
    |   tab: 9: taball,
    |   tab: 1: tabadmin,
    |   tab: 2: tabhotro,
    |   tab: 3: tabnhanvien,
    */
    $.ajax({
        type:"POST",
        url: "home_controller/getlistuser",
        dataType:"text",
        data: {
            page            :   page,
            tab             :   tab
            },
        cache:false,
        success:function (data) {
            getlistuser_Complete(data);
        },
        error: function () { alert("Error!"); }
    });
}
function getlistuser_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes.totalrow > 0)
    {
        $("#notifyres").hide();
        $("#tbodylistuser").html(sRes.str_list);
        $("#divpagination").html(sRes.str_numpage);
        $("#tbllistuser").show();
    }
    else
    {
        $("#tbllistuser").hide();
        $("#notifyres").html(sRes.notfound);
        $("#notifyres").show();
        $("#divpagination").html("");
    }
}
/*
|----------------------------------------------------------------
|click change status
|----------------------------------------------------------------
*/
function changestatus(status,id)
{
    $.ajax({
        type:"POST",
        url:"home_controller/changestatus_spauser",
        dataType:"text",
        data: {
                status: status,
                id: id                              
                },
        cache:false,
        success:function (data) {
            changestatus_Complete(data);
        },
        error: function () { alert("Error!");}
    });
}
function changestatus_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes.status!=1 && sRes.status!="1")
    {
        alert(sRes.notify);
    }
    
    var page    = parseFloat($("ul.pagination li.active a").html());
    var tab     =   $("#ultab li.active").attr("id");
    tab         =   parseInt(tab.substr(3, 1));
    getlistuser(page, tab);
}
/*
|----------------------------------------------------------------
|click button edit
|----------------------------------------------------------------
*/
function btnedit(id)
{
    $("#notifysuccess").hide();
    $("#notifyerr").hide();
    
    $.ajax({
        type:"POST",
        url:"home_controller/btnedit",
        dataType:"text",
        data: {
                id: id                              
                },
        cache:false,
        success:function (data) {
            btnedit_Complete(data);
        },
        error: function () { alert("Error!");}
    });
}
function btnedit_Complete(data)
{
    var sRes = JSON.parse(data);
    load_location_child_by_location_parent(sRes.location_level1,"LOAD_EDIT");
    
    $("#seuserlevel").html(sRes.str_userlevel);
    $("#seusertype").html(sRes.str_usertype);
    $("#divstatus").html(sRes.str_userstatus);
    $("#secity").html(sRes.str_location_level1);
    $("#txtusername").val(sRes.user_info.UserId);
    $("#txtobjectid").val(sRes.user_info.ObjectId);
    $("#txtscorebalance").val(sRes.user_info.ScoreBalance);
    $("#txtoutstanding").val(sRes.user_info.OutStanding);
    $("#iduser").val(sRes.id);
    
    //show object
    $("#txtfullname").val(sRes.object.FullName);
    $("#divgender").html(sRes.str_objectgeder);
    $("#txtphone").val(sRes.object.Tel);
    $("#txtfax").val(sRes.object.Fax);
    $("#txtemail").val(sRes.object.Email);
    $("#txtnote").val(sRes.object.Note);
}
function changerole(id)
{
    var value           =   $("#serole_" + id + " option:selected").val();
    $.ajax({
        type:"POST",
        url:"home_controller/changerole_spauser",
        dataType:"text",
        data: {
                id          :   id,
                value       :   value 
                },
        cache:false,
        success:function (data) {
            changerole_spauser_Complete(data);
        },
        error: function () { alert("Error!");}
    });
}
function changerole_spauser_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes.flag == 0 || sRes.stt   ==  0   ||  sRes.flag == "0" || sRes.stt   ==  "0")
    {
        alert(sRes.notify);
    }
    
    var page    = parseFloat($("ul.pagination li.active a").html());
    var tab     =   $("#ultab li.active").attr("id");
    tab         =   parseInt(tab.substr(3, 1));
    getlistuser(page, tab);
}
/*
|----------------------------------------------------------------
|click button delete
|----------------------------------------------------------------
*/
function btndelete(id)
{
    var strconfirm = confirm("Bạn muốn tiếp tục?");
    if (strconfirm == true)
    {
        $.ajax({
            type:"POST",
            url:"home_controller/btndelete_spauser",
            dataType:"text",
            data: {
                    id: id                              
                    },
            cache:false,
            success:function (data) {
                btndelete_Complete(data);
            },
            error: function () { alert("Error!");}
        });
    }
}
function btndelete_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes.status!=1 && sRes.status!="1")
    {
        alert(sRes.notify);
    }
    
    var page    =   parseFloat($("ul.pagination li.active a").html());
    var tab     =   $("#ultab li.active").attr("id");
    tab         =   parseInt(tab.substr(3, 1));
    getlistuser(page, tab);
}
/*
|----------------------------------------------------------------
|function get number user to show ultab
|----------------------------------------------------------------
*/
function get_number_user_show_ultab()
{
    $.ajax({
        type:"POST",
        url:"home_controller/get_number_user_show_ultab",
        dataType:"text",
        cache:false,
        success:function (data) {
            get_number_user_show_ultab_Complete(data);
        },
        error: function () { alert("Error!");}
    });
}
function get_number_user_show_ultab_Complete(data)
{
    var sRes    =   JSON.parse(data);
    $("#spanallno").html(sRes.total_taball);
    $("#spandoinhomno").html(sRes.total_taball);
    $("#spanadminno").html(sRes.total_tabadmin);
    $("#spanhotrono").html(sRes.total_tabhotro);
    $("#spannhanvienno").html(sRes.total_tabnhanvien);
}
/*
|----------------------------------------------------------------
|function search user by username, email modal
|----------------------------------------------------------------
*/
function searchuser(page,txtsearch)
{
    $.ajax({
        type:"POST",
        url:"home_controller/searchuser_spauser",
        dataType:"text",
        data: {
                page        :   page,
                txtsearch   :   txtsearch                              
                },
        cache:false,
        success:function (data) {
            searchuser_Complete(data);
        },
        error: function () { alert("Error!");}
    });
}
function searchuser_Complete(data)
{
    var sRes    =   JSON.parse(data);
    if(sRes.totalrow > 0)
    {
        $("#notifyresmodal").hide();
        $("#serolemodal").show();
        $("#tbodylistusermodal").html(sRes.str_list);
        $("#divpaginationmodal").html(sRes.str_numpage);
        $("#tbllistusermodal").show();
    }
    else
    {
        $("#tbllistusermodal").hide();
        $("#serolemodal").hide();
        $("#notifyresmodal").html(sRes.notfound);
        $("#notifyresmodal").show();
        $("#divpaginationmodal").html("");
    }
}
/*
|----------------------------------------------------------------
|function add spa user modal
|----------------------------------------------------------------
*/
function addspausermodal()
{
    $("#notifynochoosemodal").hide();
    
    var arrcbchooseusermodal            =   [];
    $('input:checkbox[name=cbchooseusermodal]:checked').each(function(){
        var rowcbchooseusermodal        =   $(this).val();
        arrcbchooseusermodal.push(rowcbchooseusermodal);
    });
    var serolemodal                     =   $("#serolemodal").val();
    if(arrcbchooseusermodal.length < 1)
        $("#notifynochoosemodal").show();
    else
    {
        $.ajax({
            type:"POST",
            url: "home_controller/addspausermodal_spauser",
            dataType:"text",
            data: {
                arrcbchooseusermodal        :   arrcbchooseusermodal,
                serolemodal                 :   serolemodal,
                },
            cache:false,
            success:function (data) {
                addspausermodal_Complete(data);
            },
            error: function () { alert("Error!"); }
        });   
    }
}
function addspausermodal_Complete(data)
{
    var page    =   parseFloat($("ul.pagination li.active a").html());
    var tab     =   $("#ultab li.active").attr("id");
    tab         =   parseInt(tab.substr(3, 1));
    getlistuser(page, tab);
}