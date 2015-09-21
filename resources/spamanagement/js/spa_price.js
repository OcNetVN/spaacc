/*
|----------------------------------------------------------------
| call funciton from common_function.js
| function check email
| function ForceNumericOnly
|----------------------------------------------------------------
*/
$(document).ready(function() { 
    $("#phuongthucdanhsach").click(function () {
        $("#keyword").val('');
        $("#spaid").val();
        searchProducts(1);
    });
    // $( "#btnsave" ).bind("click",function(){
    //     btnsave_spa_price();
    // });
    $("#cboPageNoPRO").change(function () {
        var trang = $("#cboPageNoPRO").val();
        searchProducts(trang);
    });
    $("#phuongthuctimkiem").click(function () {
        $("#keyword").val();
        $("#spaid").val();
        if($("#keyword").val()== ''){
            alert('Vui lòng nhập từ khóa ');
            return;
        }
        searchProducts(1);
    });
});
/*
|----------------------------------------------------------------
| function save spa price
|----------------------------------------------------------------
*/
function searchProducts(page) {    
    var keyword = $("#keyword").val();
    var spaid = $("#spaid").val();
    curPage = page;   

    $.ajax({
        type:"POST",
        url: "home_controller/search_products",
        dataType:"text",
        data: {
            spaid: spaid,
            keyword: keyword,
            Page:page
        },
        cache:false,
        success:function (data) {
            // if( data== "-1" || data==="-1" || data==-1 )
            // {
            //     alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            // }
            // else
            // {
                // console.log(data);
                searchProducts_Complete(data);
            // }
          //alert(data);
        }
    });
}

function searchProducts_Complete(data) {
    var sRes = JSON.parse(data);
    // console.log(sRes);
    if (sRes != null) {
        if(sRes.TotalRecord !=0)
        {
            $("#divTBKQTim").show(500);
            var node = document.getElementById("notifysuccess");
            $('#notifysuccess').children().remove();           
            $("#notifysuccess").append("<span class='success_bg'>Tìm được "+sRes.TotalRecord+" mẫu tin!</span>");



            $("#panelDataPRO").show(500);


            // $("#panelDataPRO1").hide(200);
            // $("#cboPageNoPRO1").hide(200);
            // $("#divTBKQTim").hide(200);
            // $("#khongtimthaygia").hide(200);
            // $("#khungthemgia").hide(200);
            
            // $("#khongtimthay").hide(200);
             // $("#cboPageNoPRO").show(300);
             // 
             
            $("#panelDataPRO tbody tr").remove();
            $("#ListFoundPRO").tmpl(sRes.lst).appendTo("#panelDataPRO tbody");
            // $("#panelDataPRO").show(500);
                   
            //phÃ¢n trang
            var totalPage = parseInt(sRes.TotalPage);
            var Curpage = parseInt(sRes.CurPage);
            // $("#divTBKQTim div").text("Tìm được " + sRes.TotalRecord + " mẫu tin!!!");
            // $("#divTBKQTim").show(500);
            var TrangHienTai = Curpage;
            var TongTrang = totalPage;
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
        else
        {
            $("#panelDataPRO tbody tr").remove();
            $("#panelDataPRO").hide(500);

            $("#divTBKQTim").show(500);
            var node = document.getElementById("notifysuccess");
            $('#notifysuccess').children().remove();           
            $("#notifysuccess").append("<span class='error_bg'>Không tìm thấy mẫu tin!</span>");


            // $("#khongtimthay").show(500);
            // $("#panelDataPRO").hide(200);
            // $("#cboPageNoPRO").hide(200);
            // $("#divTBKQTim").hide(200);
            
            // //an list gia
            // $("#panelDataPRO1").hide(200);
            // $("#cboPageNoPRO1").hide(200);
            // $("#divTBKQTim1").hide(200);
            // $("#khongtimthaygia").hide(200);
            
        }
    }
}














































function btnsave_spa_price()
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
        url: "home_controller/btnsave_spa_price",
        dataType:"text",
        data: {
            arrcbdayofweek          :   arrcbdayofweek,
            arr_hour                :   arr_hour,
            },
        cache:false,
        success:function (data) {
            btnsave_spa_price_Complete(data);
        },
        error: function () { alert("Error!"); }
    });
}
function btnsave_spa_price_Complete(data)
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