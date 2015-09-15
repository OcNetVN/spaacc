
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
                 
              }
              
         },{scope: 'email,read_stream,publish_stream,user_birthday,user_location,user_work_history,user_hometown,user_photos'}); //permissions for facebook
 }
 
 function LoginBangFb(data)
 {
    $.ajax({
            type:"POST",
            url: getUrspal() + "register/fblogin",
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
 
 // 
 
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
function register(){
    document.location.href = getUrspal() + "register";
}
