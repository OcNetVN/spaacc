/**
* public function for all
* 
* @package   system Shop
* @author    Creater: Nguyen Huu Nghia - <huunghia1810@gmail.com>
* @author    Updater: Nguyen Huu Nghia - <huunghia1810@gmail.com>
* @copyright 2015 By Huu Nghia Nguyen
*/

//only press number
jQuery.fn.ForceNumericOnly =
function () {
    return this.each(function () {
        $(this).keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
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
//end only press number

/*
|----------------------------------------------------------------
| function check specialchars
|----------------------------------------------------------------
*/
//not press special character
jQuery.fn.NotPressSpecialCharacter =
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
                (key >= 75 && key <= 90) ||
                (key >= 48 && key <= 57) ||
                (key >= 97 && key <= 122));
        });
    });
};
/*
|----------------------------------------------------------------
| function check specialchars
|----------------------------------------------------------------
*/
var specialChars = "<>@!#$%^&*()_+[]{}?:;|'\"\\,./~`-="
var checkspecialchars = function(string){
 for(i = 0; i < specialChars.length;i++){
   if(string.indexOf(specialChars[i]) > -1){
       return true
    }
 }
 return false;
}
/*
|----------------------------------------------------------------
| function check email
|----------------------------------------------------------------
*/
function checkemail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}

function init_map(x, y,contentVal,iddivshow){
    var myOptions = {
        zoom:16,
        center:new google.maps.LatLng(x,y),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById(iddivshow), myOptions);
    marker = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(x, y)}
        );
    infowindow = new google.maps.InfoWindow({
        content:contentVal });
    google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});
    infowindow.open(map,marker);
}