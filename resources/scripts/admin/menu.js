// JavaScript Document

$(document).ready(function () {
    //============== Show time Taiwan ==========================
   
    ShowLocation();
    
});

function ShowLocation() {
    var pathname = window.location.toString();//.split('/');
    //pathname = pathname[pathname.length - 1];
    var url = pathname.toLowerCase();
    //var sss = url1.split('.');
    //var url = url1;
    
     $("#main-nav a").removeClass("current");
     $(".nav-pills").removeClass("active");
    // menu welcome
    var welcome = url.indexOf("/admin/welcome");
     if(welcome >=0){   
       $("#MenuCha01 a").addClass("current");
       $("#MenuCon0101 a").addClass("current");
    } 
    // menu product
     var product = url.indexOf("/admin/products");
     if(product >=0){
       $("#MenuCha02 a.nav-top-item").addClass("current");
       $("#MenuCon0201 a").addClass("current");
    } 
    
    // menu price
     var productprice = url.indexOf("/admin/price");
     if(productprice >=0){
       $("#MenuCha02 a.nav-top-item").addClass("current");
       $("#MenuCon0202 a").addClass("current");
    } 
    
    // menu producttype
     var producttype = url.indexOf("/admin/producttype");
     if(producttype >=0){
       $("#MenuCha02 a.nav-top-item").addClass("current");
       $("#MenuCon0203 a").addClass("current");
    } 
    
    // promotion
     var menu_promo = url.indexOf("/admin/promotion");
    if(menu_promo >= 0)
    {
        
        $("#MenuCha02 a.nav-top-item").addClass("current");
        $("#MenuCon0204 a").addClass("current");
    }
    
    // goldhour
     var menu_goldhour = url.indexOf("/admin/goldhour");
    if(menu_goldhour >= 0)
    {
        
        $("#MenuCha02 a.nav-top-item").addClass("current");
        $("#MenuCon0205 a").addClass("current");
    }
     // menu spauser
    var spauser = url.indexOf("/admin/spauser");
     if(spauser >=0){
        $("#MenuCha06 a.nav-top-item").addClass("current");
        $("#MenuCon0602 a").addClass("current");
    } 
    
    //menu spautil
    var spa = url.indexOf("/admin/spa"); 
    if(spa >=0 && url.substring(spa,url.length)=="/admin/spa"){
        $("#MenuCha06 a.nav-top-item").addClass("current");
        $("#MenuCon0601 a").addClass("current");
    } 
   //menu spautil
    var spa = url.indexOf("/admin/spafacility"); 
    if(spa >=0 && url.substring(spa,url.length)=="/admin/spafacility"){
        $("#MenuCha06 a.nav-top-item").addClass("current");
        $("#MenuCon0604 a").addClass("current");
    } 
    
    //menu spautil
    var spa = url.indexOf("/admin/spautil"); 
    if(spa >=0 && url.substring(spa,url.length)=="/admin/spautil"){
        $("#MenuCha06 a.nav-top-item").addClass("current");
        $("#MenuCon0603 a").addClass("current");
    } 
    
     //menu spa othere 
    var spa = url.indexOf("/admin/spaother"); 
    if(spa >=0 && url.substring(spa,url.length)=="/admin/spaother"){
        $("#MenuCha06 a.nav-top-item").addClass("current");
        $("#MenuCon0605 a").addClass("current");
    } 
    // menu commontype
    var common = url.indexOf("/admin/commontype");
    if(common >=0){
        $("#MenuCha09 a.nav-top-item").addClass("current");
        $("#MenuCon0901 a").addClass("current");
      
    } 
    
    //menu commoncode
    var commoncode = url.indexOf("/admin/commoncode");
    if(commoncode >= 0){
        $("#MenuCha09 a.nav-top-item").addClass("current");
        $("#MenuCon0902 a").addClass("current");
    }
    
    //menu thống kê hệ thống
    var commoncode = url.indexOf("/admin/thongkehethong");
    if(commoncode >= 0){
        $("#MenuCha09 a.nav-top-item").addClass("current");
        $("#MenuCon0903 a").addClass("current");
    }
    
    //menu lịch sử hoạt động
    var commoncode = url.indexOf("/admin/actionhistory");
    if(commoncode >= 0){
        $("#MenuCha09 a.nav-top-item").addClass("current");
        $("#MenuCon0904 a").addClass("current");
    }
    
     //menu tin tức
    var commoncode = url.indexOf("/admin/newsmanage");
    if(commoncode >= 0){
        $("#MenuCha09 a.nav-top-item").addClass("current");
        $("#MenuCon0905 a").addClass("current");
    }
     
    //menu tin tức
    var commoncode = url.indexOf("/admin/information");
    if(commoncode >= 0){
        $("#MenuCha09 a.nav-top-item").addClass("current");
        $("#MenuCon0906 a").addClass("current");
    }
    // menu user
    var n = url.indexOf("/admin/user");
    if (n >=0)
    {
       $("#MenuCha03 a.nav-top-item").addClass("current");
       $("#MenuCon0301 a").addClass("current");
    }
    
    // menu object
    var n = url.indexOf("/admin/objects");
    if (n >=0)
    {
       $("#MenuCha03 a.nav-top-item").addClass("current");
       $("#MenuCon0302 a").addClass("current");
    }
    
    // booking
    var booking = url.indexOf("/admin/bookingpayment");
    if(booking>=0)
    {
        $("#MenuCha04 a.nav-top-item").addClass("current");
        $("#MenuCon0401 a").addClass("current");
    }
    
    var bookingsearch = url.indexOf("/admin/bookingsearch");
    if(bookingsearch >=0)
    {
        $("#MenuCha04 a.nav-top-item").addClass("current");
        $("#MenuCon0402 a").addClass("current");
    }
    
    // quản lý điểm
    var score = url.indexOf("/admin/score");
    if(score>=0)
    {
        $("#MenuCha05 a.nav-top-item").addClass("current");
        $("#MenuCon0501 a").addClass("current");
    }
    
	// quản lý phân quyền
	var menu = url.indexOf("/admin/menu");
	if(menu>=0)
	{
		$("#MenuCha07 a.nav-top-item").addClass("current");
		$("#MenuCon0701 a").addClass("current");
	}
	var module = url.indexOf("/admin/module");
	if(module>=0)
	{
		
		$("#MenuCha07 a.nav-top-item").addClass("current");
		$("#MenuCon0702 a").addClass("current");
	}
	var accessforgroup = url.indexOf("/admin/rolemenumodule");
	if(accessforgroup>=0 && url.substring(accessforgroup,url.length)=="/admin/rolemenumodule")
	{
		
		$("#MenuCha07 a.nav-top-item").addClass("current");
		$("#MenuCon0703 a").addClass("current");
	}
	var asigngroupforuser = url.indexOf("/admin/role");//role
	if(asigngroupforuser>=0 )
	{
		
		$("#MenuCha07 a.nav-top-item").addClass("current");
		$("#MenuCon0704 a").addClass("current");
	}
	
    // quảng cáo
    var quangcao = url.indexOf("/admin/quangcao");
	if(quangcao>=0)
    {
        
        $("#MenuCha08 a.nav-top-item").addClass("current");
        $("#MenuCon0801 a").addClass("current");
    }
    
    
    
    //bao cao 1
  
    var report_1 = url.indexOf("/admin/baocao1");
    if(report_1 >= 0)
    {
        
        $("#MenuCha10 a.nav-top-item").addClass("current");
        $("#MenuCon1001 a").addClass("current");
    }
    // bao cao 2
    var report_2 = url.indexOf("/admin/baocao2");
    if(report_2 >= 0)
    {  
        $("#MenuCha10 a.nav-top-item").addClass("current");
        $("#MenuCon1002 a").addClass("current");
    }
    // bao cao 3
     var report_3 = url.indexOf("/admin/baocao3");
    if(report_3  >= 0)
    {
        $("#MenuCha10 a.nav-top-item").addClass("current");
        $("#MenuCon1003 a").addClass("current");
    }
    
       // about
    var about = url.indexOf("/about");
    if(about >=0){
        $("#menu_about").addClass("active");
    }
    
    // contact
    var contact = url.indexOf("/contact");
    if(contact >=0){
        $("#menu_contact").addClass("active");
    }
    
    // contact
    var hiring = url.indexOf("/hiring");
    if(hiring >=0){
        $("#menu_hiring").addClass("active");
    }
    
     // term
    var term = url.indexOf("/term");
    if(term >=0){
        $("#menu_term").addClass("active");
    }
}

 
    
function ShowTimeVN() {
    VNTime.setSeconds(VNTime.getSeconds() + 1);
    if (parseInt(VNTime.getHours()) < 10)
        $("#pHours").text("0" + VNTime.getHours());
    else
        $("#pHours").text(VNTime.getHours());

    if (parseInt(VNTime.getMinutes()) < 10)
        $("#pMinus").text("0" + VNTime.getMinutes());
    else
        $("#pMinus").text(VNTime.getMinutes());
    if (parseInt(VNTime.getSeconds()) < 10)
        $("#pSeconds").text("0" + VNTime.getSeconds());
    else
        $("#pSeconds").text(VNTime.getSeconds());
    $("#spanDay").text(VNTime.getDate() + "/" + parseInt(VNTime.getMonth() + 1) + "/" +  VNTime.getFullYear());
    setTimeout("ShowTimeVN()",999);
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


function ValidatePass(sPassword) {
    var RE_PASS = /^(\w{6,12})$/;
    return RE_PASS.test(sPassword);
}

function ValidateEmail(sEmail) {
    if (sEmail.length === 0)
        return false;
    var RE_EMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (RE_EMail.test(sEmail))
        return true;
    return false;
}


function ValidateUser(sUser) {
    if (sUser.length < 6 || sUser.length > 12)
        return false;
    var RE_USER = /^([a-zA-Z0-9_\.\-])+$/;
    if (RE_USER.test(sUser))
        return true;
    return false;
}

function convert(str){
    str = str.replace(/"/g, "&quot;");
    str = str.replace(/'/g, "&#039;");  
    return str;
}

function ValidateAge(sBirthday) {
    var sBirth = sBirthday.split('/');
    var year = sBirth[2];
    var yearCurrent = new Date().getFullYear();
    if (parseInt(yearCurrent - year) >= 18)
        return true;
    return false;
}

function ValidateAge2(sBirthday) {
    var now = new Date();
    if (now.getFullYear() - sBirthday.getFullYear() >= 18)
        return true;
    return false;
}

function ValidatePhone(sPhone) {
    sPhone = sPhone.replace("+", "");
    sPhone = sPhone.replace(";", "");
    var RE_NUM = /^([0-9]{5,20})$/;
    //return RE_NUM.test(sPhone);
    if(RE_NUM.test(sPhone))
        return true;
    return false;
}

function ReplaceAll(Source, stringToFind, stringToReplace) {
    var temp = Source;
    var index = temp.indexOf(stringToFind);
    while (index != -1) {
        temp = temp.replace(stringToFind, stringToReplace);
        index = temp.indexOf(stringToFind);
    }
    return temp;
}

function ValidateIsNumeric(value) {
    var numericExp = /^[0-9]+\.?$/;
    if (value.match(numericExp))
        return true;
    else
        return false;
}

function CheckIsNumber(val) {
    var ValidChar = "0123456789.-";
    var data = val.replace(/,/g, "");
    var iCount = data.length;

    //Check validate character
    for (var i = 0; i < iCount; i++) {
        if (ValidChar.indexOf(data.charAt(i)) < 0) {
            return false;
        }
    }
    //Check validate number
    if (parseFloat(data) < 0 || isNaN(data) == true) {
        return false;
    }

    if (val.substring(0, 1) == '.')
        return false;

    if (val.length === 0)
        return false;
    return true;
}