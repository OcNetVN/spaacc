$(document).ready(function() {
    $("#inputEmail").focusout(function() { 
      var email = $('#inputEmail').val();
        $.ajax({
            type:"POST",
            url: getUrspal() + "register/checkemail",
            dataType:"json",
            data: {email: email},
            cache:false,
            success:function (data) {
                
                    CheckEmail_Complete(data);
            }
        });
    
        
    });  
    
});

 window.fbAsyncInit = function() {
      //Initiallize the facebook using the facebook javascript sdk
     FB.init({ 
       appId:'1562058260674106', // App ID 
       cookie:true, // enable cookies to allow the server to access the session
       status:true, // check login status
       xfbml:true, // parse XFBML
       oauth : true //enable Oauth 
     });
   };
   //Read the baseurl from the config.php file
   (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1562058260674106&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

    //Onclick for fb login
 //$('#facebook').click(function(e) {
 function singupfacebook(){
            FB.login(function(response) {
              if(response.authResponse) {
                      if(response.status === "connected"){
                      FB.api('/me',function(data){
                          if(data.email == null)
                          {
                              //alert(JSON.stringify(data));
                              // TTin fb ko day du de dag nhap
                          }else{
                              //alert(JSON.stringify(data));
                              //$("#inputNote").val(JSON.stringify(data));
                              LoginBangFb(data);
                          }
                      });
                  }
                  //alert(JSON.stringify(response));
                  //parent.location ='register/fblogin'; //redirect uri after closing the facebook popup
              }
              
         },{scope: 'email,read_stream,publish_stream,user_birthday,user_location,user_work_history,user_hometown,user_photos'}); //permissions for facebook
 }

 function LoginBangFb(data)
 {
    $.ajax({
            type:"POST",
            url: getUrspal() +"register/fblogin",
            dataType:"json",
            data: {
                DuLieuFB:JSON.stringify(data)
                },
            cache:false,
            success:function (data) {                
                    LoginBangFb_Complete(data);
            }
    });
 }  
 
 function LoginBangFb_Complete(data)
 {
     if(data!=null)
     {
         if(data.Return == 1 ||data.Return == "1")
         {
             parent.location = "index";
         }
         else if(data.Return == -1 ||data.Return == "-1")
         {
             alert("Tai khoan FB nay dda bi khoa!!!");
         }
         else
         {
             alert("That bai !!!");
         }
     }
 }
        

function CheckEmail_Complete(data){
    var res = data;
    if(res != "" || res != null){
        $('#email_err').css("display","");
        $('#email_err').html(res);
        return false;
    }
    
}
//them objects 
function actionregister()
{
    var email = $("#inputEmail").val();
    var password = $("#inputPassword").val();
    var re_passowrd = $("#re_inputPassword").val();
    var fullname = $("#inputname").val();
    var perAdd = $("#inputPerAdd").val();
    var TemAdd = $("#inputTemAdd").val();
    var provinceId = $("#inputProvinceId").val();
    var image = $("#inputImage").val();
    var Tel = $("#inputTel").val();
    var DoB = $("#inputDoB").val(); 
    var cmnd = $("#inputcmnd").val();
    var pidissue = $("#inputPIDIssue").val();
    var  pidi        =  $("#inputPIDI").val();
    var fax = $("#inputFax").val();
    var website = $("#inputWebsite").val();
    var note = $("#inputNote").val();
    var genter = $("input:radio[name=sex]:checked").val();   
    var massgererror = $('#email_err').html();
    var str="";
    var vail = false;
    if(email != ""){
        if(ValidateEmail(email)== false){
            str = "Vui lòng nhập đúng định đạng mail";
        }
    }
    else{
        str = "Email không được bỏ trống";
    }
    if(Tel != ""){
        if(ValidatePhone(Tel) == false){
            str = "Định dạng số điện thoại không đúng";
        }
    }
    else{
        str = "Số điện thoại không được bỏ trống";
    }
    if(password == ""){
        str = "Mật khẩu không được bỏ trống";
    }
    if(re_passowrd == ""){
        str = "Mật khẩu  không được bỏ trống"
    }
    if(password != re_passowrd){
        str = "Mật khẩu và xác nhận mật khẩu trong trùng khớp";
    }
    
    if(str == ""){
        vail = true;
    }
    else{
        vail=false;
    }
    if(vail == true){
            $.ajax({
            type:"POST",
            url: getUrspal() +"register/signup",
            dataType:"json",
            data: {
                email: email,
                password: password,
                re_passowrd: re_passowrd,
                fullname: fullname,
                perAdd: perAdd,
                TemAdd: TemAdd,
                provinceId: provinceId,
                image: image,
                Tel: Tel,
                DoB: DoB,
                cmnd: cmnd,
                pidissue: pidissue,
                pidi: pidi,
                fax: fax,
                website: website,
                note: note,
                genter: genter},
            cache:false,
            success:function (data) {
                
                    Register_Complete(data);
            }
        });
    }
    else{
        alert(str);
        return false;
    }
    
}
function Register_Complete(data)
{
    var res = data;
    var str = "";
    var vali = false;
    if(res != null){
        if(res.GuiMailTC ==1 || res.GuiMailTC =="1")
        {
            str = str + "Bạn đã đăng ký tài khoản thành công";
            vali = true;
            
            //alert("Goi mail thanh cong")
        }
        if(res.ThemMoiTC ==1 || res.ThemMoiTC =="1")
        {
            str = str + ".Vui lòng vào mail để kiểm tra. Hãy kiểm tra trong mục Hộp thư đến hoặc trong mục Spam.";
            vali = true;
            
        }
        if(vali == true){
            alert(str);
        }
        document.location.href = getUrspal() + "index" ;
        //$('#thongbaochung').css('display','');
    }
}

function ValidateEmail(sEmail) {
    if (sEmail.length === 0)
        return false;
    var RE_EMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (RE_EMail.test(sEmail))
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