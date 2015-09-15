var days =0;
var hours = 0;
var mins =0;
var secs=0;

jQuery(document).ready(function() {

    /*
        Background slideshow
    */
    $('.coming-soon').backstretch([
      "assets/img/backgrounds/1.jpg"
    , "assets/img/backgrounds/2.jpg"
    , "assets/img/backgrounds/3.jpg"
    , "assets/img/backgrounds/4.jpg"
    , "assets/img/backgrounds/5.jpg"
    , "assets/img/backgrounds/6.jpg"
    ], {duration: 3000, fade: 750});

    /*
        Countdown initializer
    */
    GetTime();
   

    /*
        Tooltips
    */
    $('.social a.facebook').tooltip();
    $('.social a.twitter').tooltip();
    $('.social a.dribbble').tooltip();
    $('.social a.googleplus').tooltip();
    $('.social a.pinterest').tooltip();
    $('.social a.flickr').tooltip();

    /*
        Subscription form
    */
    $('.success-message').hide();
    $('.error-message').hide();

   
    
    
    $('.subscribe form').submit(function() {
        var postdata = $('.subscribe form').serialize();
        $.ajax({
            type: 'POST',
            url: 'assets/sendmail.php',
            data: postdata,
            dataType: 'json',
            success: function(json) {
                if(json.valid == 0) {
                    $('.success-message').hide();
                    $('.error-message').hide();
                    $('.error-message').html(json.message);
                    $('.error-message').fadeIn();
                }
                else {
                    $('.error-message').hide();
                    $('.success-message').hide();
                    $('.subscribe form').hide();
                    $('.success-message').html(json.message);
                    $('.success-message').fadeIn();
                }
            }
        });
        return false;
    });

});

function GetTime(){
 //   $.ajax({
//            type: 'POST',
//            url: 'assets/GetTimeCount.php',
            //data: postdata,
//            dataType: 'json',
//            success: function(data) {
                //$array =  array('valid'=>1,'Years'=> $y,'Days'=>$d ,'Hours'=>$h,'Mins'=>$m);
//                if(data.valid == 1) {                    
//                   
//                }               
//            }
//        });
    var now = new Date();
    var end = new Date("January 31, 2015 23:59:59");

    // end - start returns difference in milliseconds 
    var diff = new Date(end - now);

    // get days
    days = Math.floor(diff/1000/60/60/24);                                    
    hours = (Math.floor(diff/1000/60/60))% 24;
    mins = (Math.floor(diff/1000/60))% 60;
    secs = (Math.floor(diff/1000))% 60;
       
       $(".days").text(days);
       $(".hours").text(hours);
       $(".minutes").text(mins);
       $(".seconds").text(secs);
    setTimeout("GetTime()",999);
}

