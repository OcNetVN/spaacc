function xemUrl()
{       
    alert(getUrspal());
}

function getUrspal()
{
//http://www.test.com:8082/index.php#tab2?foo=123
// window.location.host                   www.test.com:8082
//window.location.hostname               www.test.com
//window.location.port                   8082
//window.location.protocol               http
//window.location.pathname               index.php
//window.location.href                   http://www.test.com:8082/index.php#tab2
//window.location.hash                   #tab2
//window.location.search                 ?foo=123

    var str= window.location.href.toString() ;
    var host = window.location.host.toString() ;
    str = str.toLowerCase();
    var res = "";
    if(str.indexOf("localhost") >=0 || str.indexOf("127.0.0.1")>=0 || str.indexOf("nhaplieuspa")>=0)
    {
        var str1 =  window.location.pathname;
        //alert("str1 : "+str1);
        var arr = str1.split('/');
        res= "http://" + host + "/" + arr[1] + "/";    
        //return res;    
    }
    else
    {
       res = "http://" + host + "/";   
       //alert("str : "+str);
       
    }
    return res;
}