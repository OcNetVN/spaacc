$(document).ready(function() {
    $("#inputpoint").ForceNumericOnly();
    $("#inputoutstanding").ForceNumericOnly();
    $("#04").click(function () { //nhan vo check tra tien bang diem
        getpoint();
    });
    $("[id^='tabpayment_']").click(function () {
                $("#divinfospa").hide();
    });
    $("#tabpayment_02").click(function () {
                $("#divinfospa").show();
    });
    $("#tabpayment_03").click(function () {
                $("#divinfospa").show();
    });
    $("#tabpayment").click(function () { //nhan vo check tra tien bang diem
        $("#divinfospa").hide();
    });
    $("input[name='disccode']").click(function(){
            var discode=$('input:radio[name=disccode]:checked').val();
            //alert(discode);
            $("#divresultpoint").hide();
            $("#divresultoutstanding").hide();
            if(discode==5 || discode=="5") //dung outstanding
            {
                $("#outstandingconlai").html("");
                $("#outstandingdadung").html("");
                $("#erroutstanding").hide();
                $("#divresultoutstanding").hide();
                $("#divusepoint").hide();
                loadoutstandinguser();
                $("#divusecode").hide();
                $("#divuseoutstanding").show();
            }
            else
            {
                if(discode==4 || discode=="4")
                {
                    $("#divusecode").hide();
                    $("#divusepoint").hide();
                    $("#divuseoutstanding").hide();
                    
                }
                else
                {
                    if(discode==3 || discode=="3") //dung diem
                    {
                        $("#diemconlai").html("");
                        $("#diemdadung").html("");
                        $("#errpoint").hide();
                        $("#divresultpoint").hide();
                        
                        loaddiemuser();
                        $("#divusecode").hide();
                        $("#divusepoint").show();
                        $("#divuseoutstanding").hide();
                    }
                    else
                    {
                        $("#divresultpoint").hide();
                        $("#divusecode").show();
                        $("#divusepoint").hide();
                        $("#divuseoutstanding").hide();
                    }
                }
            }
    });
});
function loadoutstandinguser()
{
    $.ajax({
        type:"POST",
        url:getUrspal() + "checkout1/loadoutstandinguser",
        dataType:"text",
        cache:false,
        success:function (data) {
            loadoutstandinguser_Complete(data);
        },
        error: function () { alert("Có lỗi xảy ra!"); }
    });
}
function loadoutstandinguser_Complete(data)
{
    var sRes = JSON.parse(data);
    var outstanding= sRes.outstanding;
    
    var str="";
    if(sRes.flag==1 || sRes.flag=="1") //co khuyen mai
    {
        var outstanding = outstanding.split('.')[0];
        var formatoutstanding = ReplaceNumberWithCommas(outstanding);
        str += '<label>Bạn đang có <span id="haveoutstanding">'+formatoutstanding+'</span> điểm</label><br />';
        str += '<label style="color:red;">Bạn không thể áp dụng tiền dư cho thanh toán này</label><br />';
        $("#divuseoutstanding").html(str);
    }
    else
    {
        $("#haveoutstanding").html(outstanding);
        $("#haveoutstanding").number(true,0);
        var hideoutstanding = outstanding.split('.')[0];
        $("#hidehaveoutstanding").html(hideoutstanding);
    }
}
function ReplaceNumberWithCommas(yourNumber) {
    //Seperates the components of the number
    var n= yourNumber.toString().split(".");
    //Comma-fies the first part
    n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    //Combines the two sections
    return n.join(".");
}
function loaddiemuser()
{
    $.ajax({
            type:"POST",
            url:getUrspal() + "checkout1/loaddiemuser",
            dataType:"text",
            cache:false,
            success:function (data) {
                loaddiemuser_Complete(data);
            },
            error: function () { alert("Có lỗi xảy ra!"); }
        });
}
function loaddiemuser_Complete(data)
{
    var sRes = JSON.parse(data);
    var diem= sRes.diem;
    
    var str="";
    if(sRes.flag==1 || sRes.flag=="1") //co khuyen mai
    {
		$.ajax({
		type:"POST",
		url:getUrspal() + "checkout1/getmoneymemberbypoint",
		dataType:"text",
		cache:false,
		success:function (data) {
			var sRespoint = JSON.parse(data);
			var pointbymoney= parseFloat(sRespoint.ScoreRate);
			//alert(pointbymoney);
			
			var point = diem.split('.')[0];
			str += '<label style="color: red;">1 điểm = '+pointbymoney+' VNĐ</label><br />';
			str += '<label>Bạn đang có <span id="havepoint">'+point+'</span> điểm</label><br />';
			str += '<label style="color:red;">Bạn không thể áp dụng điểm cho thanh toán này</label><br />';
			str += '<span style="color: blue;">' + sRes.NoteBookByPoint + '</span><br />';
			$("#divusepoint").html(str);
		},
		error: function () { alert("Có lỗi xảy ra!"); }
		});
    }
    else
    {
        $("#havepoint").html(diem);
        $("#havepoint").number(true,0);
        var hidepoint = diem.split('.')[0];
        $("#hidehavepoint").html(hidepoint);
    }
}
function getpoint()
{
    $("#scoreuser").hide();
    $.ajax({
            type:"POST",
            url:getUrspal() + "checkout2/getpoint",
            dataType:"text",
            cache:false,
            success:function (data) {
                getpoint_Complete(data);
            },
            error: function () { alert("Có lỗi xảy ra!"); }
        });
}
function getpoint_Complete(data)
{
    var sRes = JSON.parse(data);
    if(sRes.sodong!="0" && sRes.sodong!=0)
    {
        $("#scoreuser").html(sRes.rowpoint);
        $("#scoreuser").show();
        //alert(sRes.rowpoint);
    }
}
function gotostep3()
{
    $("#scoreuser").hide();
    var DiscountType = $("#spanDiscountType").html();
    var DiscountCode = $("#spanDiscountCode").html();
    var textrequestmember = $("#textrequestmember").val();   
    var generatedID = $("#spangeneratedID").html();   
    //alert(generatedID);  
    var Percentage = "";
    var DiscountAmt= "";
    if(DiscountType=="Member")
    {
        Percentage = $("#spanPercentage").html();
    }
    else
    {
        if(DiscountType=="Voucher")
            DiscountAmt = $("#spanDiscountAmt").html();
    }
    //alert(DiscountAmt);    
    $.ajax({
        type:"POST",
        url:getUrspal() + "checkout2/savediscount",
        dataType:"text",
        cache:false,
        data: {
                DiscountType: DiscountType,
                Percentage: Percentage,
                DiscountAmt: DiscountAmt,
                DiscountCode: DiscountCode,
                textrequestmember: textrequestmember,
                generatedID:generatedID                                
                },
        success:function (data) {
            gotostep3_step2();
        },
        error: function () { alert("Có lỗi xảy ra!"); }
    });
}
function gotostep3_step2()
{
    $("#scoreuser").hide();
    //var Payment_method = $("#Payment_method").val();
    var Payment_method = $('input:radio[name=pay-method]:checked').val();
    //alert(Payment_method);
    if(Payment_method=="01")
    {
        var the = $("#SelCardTypeFor123Pay").val();
        $.ajax({
            type:"POST",
            url:getUrspal() + "checkout2/luusessionthe",
            dataType:"text",
            data: {
                the: the
                },
            cache:false,
            success:function (data) {
                parent.location=getUrspal() + 'check123pay';
            },
            error: function () { alert("Có lỗi xảy ra!"); }
        });
    }
    else
    {
        if(Payment_method=="04") //thanh toan bang diem
        {
            document.location.href = getUrspal() + "checkout2/paypoint";
        }
        else
        {
            Bat_Loading();
            $.ajax({
                type:"POST",
                url:getUrspal() + "checkout2/gotostep3",
                dataType:"text",
                data: {
                    dPayment_method: Payment_method
                    },
                cache:false,
                success:function (data) {
                    gotostep3_Complete(data);
                },
                error: function () { alert("Có lỗi xảy ra!"); Tat_Loading();}
            });
        }
    }
}
function gotostep3_Complete(data) {
    var sRes = JSON.parse(data);
    //alert('sfsdfd');
    var arr_bookingid = sRes.arr_bookingid;
    $("#loadcontent1").hide();
    $("#loadcontent2").html(sRes.str_showtep3);
    $("#loadcontent2").show();
    //alert('sfsdfd');
    /*$.ajax({
        type:"POST",
        url:getUrspal() + "checkout2/sendmail",
        dataType:"text",
        data: {
            dstr_bookingid: arr_bookingid},
        cache:false,
        success:function (data) {
            $('#spanCardTotalList').html('0');
            //alert("sdf");
            $("#loadtb").html("Đã hoàn tất, vui lòng vào mail để kiểm tra. Hãy kiểm tra trong mục Hộp thư đến hoặc trong mục Spam.");
            $("#loadtb").show(); 
            Tat_Loading();
        },
        error: function () { alert("Có lỗi xảy ra!"); 
            Tat_Loading();
        }
    });*/
}
//nghia viet them 09/01/2015
function applycodediscount()
{
    $("#spanDiscountType").html("");
    $("#spanPercentage").html("");
    $("#spanDiscountAmt").html("");
    $("#spanDiscountCode").html("");
    $("#spangeneratedID").html("");
    $("#divbtnreload").hide();
    $("#tberr").hide();
    $("#tberr_pcodeid").hide();
    
    var codetype = $('input:radio[name=disccode]:checked').val();
    var clickok=$("#clickok").html();
    //codetype = 1: the thanh vien/member
    //codetype = 2: the giam gia/voucher
    var txtcode=$("#txtcardcode").val();
    if(txtcode!="")
    {
        if(clickok==1 || clickok=="1")
        {
            $("#pcodeid").show();
            $("#clickok").html("2");
        }
        else
        {
            if(clickok==2 || clickok=="2")
            {
                var txtgenerated=$("#txtgenerated").val(); //ma generated
                if(txtgenerated!="")
                {
                    //$("#clickok").html("1");
                        $("#pcodeid").hide();
                        $.ajax({
                            type:"POST",
                            url:getUrspal() + "checkout2/applycodediscount",
                            dataType:"text",
                            data: {
                                codetype: codetype,
                                txtcode: txtcode,
                                txtgenerated: txtgenerated},
                            cache:false,
                            success:function (data) {
                                applycodediscount_Complete(data);
                            },
                            error: function () { alert("Có lỗi xảy ra!"); }
                        });
                }
                else
                {
                    $("#tberr_pcodeid").html("<span style=\"margin-left:10px;\"> Vui lòng nhập mã code </span>");
                    $("#tberr_pcodeid").show();
                }
            }
        }
    }
    else
    {
        $("#tberr").html("<span style=\"margin-left:10px;\"> Vui lòng nhập mã </span>");
        $("#tberr").show();
    }
}
function applycodediscount_Complete(data) {
    $("#divbtnreload").hide();
    $("#tberr").hide();
    var txtcode=$("#txtcardcode").val();
    var txtgeneratedID=$("#txtgenerated").val();
    
    var sRes = JSON.parse(data);
    if(sRes.flag==1 || sRes.flag=="1")
    { 
        $("#spanDiscountType").html("");
        $("#spanPercentage").html("");
        $("#spanDiscountAmt").html("");
        
        $("#divusecode").hide();
        $("#divresultvouchermembercard").html(sRes.str);
        $("#divresultvouchermembercard").show();
        $("#divbtnreload").html("<button type=\"button\" class=\"btn btn-danger\" id=\"reloadcode\" onclick=\"reloaddifcode();\">Reload</button>");
        $("#divbtnreload").show();
        $("#spanDiscountType").html(sRes.discount['DiscountType']);
        $("#spanPercentage").html(sRes.discount['Percentage']);
        $("#spanDiscountAmt").html(sRes.discount['DiscountAmt']);
        $("#spanDiscountCode").html(txtcode);
        $("#spangeneratedID").html(txtgeneratedID);
    }
    else
    {
        $("#spanDiscountType").html("");
        $("#spanPercentage").html("");
        $("#spanDiscountAmt").html("");
        $("#spanDiscountCode").html("");
        $("#spangeneratedID").html("");
        $("#pcodeid").show();
                
        $("#tberr").html("<span>" + sRes.tbkhongdung + "</span>");
        $("#tberr").show();
    }
}
function reloaddifcode()
{
    $("#divusecode").show();
    $("#divresultvouchermembercard").html("");
    $("#divresultvouchermembercard").hide();
    $("#divbtnreload").hide();
    $("#pcodeid").show();
    
	/*$.ajax({
		type:"POST",
		url:getUrspal() + "checkout1/getmoneymemberbypoint",
		dataType:"text",
		cache:false,
		success:function (data) {
			reloaddifcode_step2(data);
		},
		error: function () { alert("Có lỗi xảy ra!"); }
	});*/
}
function reloaddifcode_step2(data)
{
    
	var sRespoint = JSON.parse(data);
	var pointbymoney= parseFloat(sRespoint.ScoreRate);
	//alert(pointbymoney);
    $("#spanDiscountType").html("");
    $("#spanPercentage").html("");
    $("#spanDiscountAmt").html("");
    $("#spanDiscountCode").html("");
    $("#spangeneratedID").html("");
                var str = '<h4>Mã thẻ giảm giá</h4>';
                str+= '<label><input type="radio" name="disccode" value="4" checked="checked"/>Không áp dụng</label><br />';
                str+= '<label><input type="radio" name="disccode" value="1" />Mã thành viên</label><br />';
                str+= '<label><input type="radio" name="disccode" value="2" />Mã giảm giá</label><br />';
                str+= '<label><input type="radio" name="disccode" value="3"/>Dùng điểm</label><br />';
                str+= '<label><input type="radio" name="disccode" value="5"/>Dùng số tiền dư</label><br />';
                str+= '<div id="divusecode" style="display: none;">';
                    str+= '<input type="text" class="form-control" id="txtcardcode" />';
                    str+= '<p id="pcodeid" style="display: none;"><label>Mã code: </label><input type="text" class="form-control" id="txtgenerated" /></p>';
                    str+= '<span id="tberr_pcodeid" style="color: red; font-weight: bold; display: none;"></span><br />';
                    str+= '<span id="tberr" style="color: red; font-weight: bold; display: none;"></span>';
                    str+= '<span id="clickok" style="display: none;">1</span><br />';
                    str+= '<button type="button" class="btn btn-danger" id="applycode" onclick="applycodediscount();">Xác nhận</button>';
                str+= '</div>';
                str+= '<div id="divusepoint" style="display: none;">';
                    str+= '<label style="color: red;">1 điểm = '+pointbymoney+' VNĐ</label><br />';
                    str+= '<label>Bạn đang có <span id="havepoint">0</span> điểm</label>';
                    str+= '<span id="hidehavepoint" style="display: none;"></span><br />';
                    str+= '<label style="width:100%;"><label>Bạn muốn dùng </label><input type="text" class="form-control" id="inputpoint" /> <label> điểm</label></label><br />';
                    str+= '<p id="errpoint" style="display: none; color: red;"></p>';
                    str+= '<span style="color: blue;">';
                    
                    str+= '</span><br />';
                    str+= '<button type="button" class="btn btn-danger" id="applypoint" onclick="applypointdiscount();">Xác nhận</button>';
                str+= '</div>';
                str+= '<div id="divuseoutstanding" style="display: none;">';
                    str+= '<label>Bạn đang có <span id="haveoutstanding">0</span> VNĐ</label>';
                    str+= '<span id="hidehaveoutstanding" style="display: none;"></span><br />';
                    str+= '<label style="width:100%;"><label>Bạn muốn dùng </label><input type="text" class="form-control" id="inputoutstanding" />*1000 <label> VNĐ</label></label><br />';
                    str+= '<p id="erroutstanding" style="display: none; color: red;"></p>';
                    str+= '<button type="button" class="btn btn-danger" id="applyoutstanding" onclick="applyoutstandingdiscount();">Xác nhận</button>';
                str+= '</div>';
                str+= '<div id="divresultpoint" style="display: none;"></div>';
                str+= '<div id="divresultoutstanding" style="display: none;"></div>';
            str+= '</div>';
            str+= '<div id="divbtnreload" style="display: none;">';
            str+= '</div>';
            str+= '<div id="resdiscount" style="display: none;">';
                str+= '<span id="spanDiscountCode" style="display: none;"></span>';
                str+= '<span id="spanDiscountType" style="display: none;"></span>';
                str+= '<span id="spanPercentage" style="display: none;"></span>';
                str+= '<span id="spanDiscountAmt" style="display: none;"></span>';
                str+= '<span id="spangeneratedID" style="display: none;"></span>';
                        
    $("#inputdiscount").html(str);
    $("#divbtnreload").hide();
}
jQuery.fn.ForceNumericOnly =
function () {
    return this.each(function () {
        $(this).keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
                key == 8 ||
                key == 9 ||
                key == 46 ||
                key == 110 ||
                key == 190 ||
                (key >= 35 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        });
    });
};
function Bat_Loading()
{
    $(".loader").fadeIn(0);
}

function Tat_Loading()
{
    $(".loader").fadeOut("slow");    
}
//end nghia viet them 09/01/2015