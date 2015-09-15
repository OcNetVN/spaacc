
function doUpload1(url) {
    var info = $("#info").val();
    var lang = $("#langue").val();
    var files = $("#myfile").val();
    var message = "";
    var vali=true; 
    
    
        var arr_name = files.split('.');
        if(arr_name[1] != "png"  || arr_name[1] != "jpg" || arr_name[1] != "jpeg")
        {
           message = "Tên file upload không đúng đinh dang upload" ; 
        }
        //message = "Ten file không được có ký tự đặc biệt hoặc khoảng trắng ! Tên file đang ko hợp lệ : " + fileName ;
 
    if(info == ""){
        message =  "Vui lòng loại thông tin cần cập nhật";
        vali = false;
    }

    if(lang == ""){
        message =  "Vui lòng chọn ngôn ngữ để cập nhật";
        vali = false;
    }
    
    if(vali == false){
        alert(message);
        return;
    }
    else
    {
        
    }
}

function UploadFile(){
    var fileName = "";
    var files = document.getElementById('myfile').files;  
    for (i=0;i<files.length;i++) {
        fileName = files[i].name; //Tên file
        if(i==0)
        {
            if(fileName.indexOf(" ")>0 || fileName.indexOf("@")>0)
            {
                alert("Ten file không được có ký tự đặc biệt hoặc khoảng trắng ! Tên file đang ko hợp lệ : " + fileName);   
                fileName = "";             
            }            
        }
        else
        {
            break;
        }
    }
    if(fileName!="")
    {
        var info = $("#info").val();
        var lang = $("#langue").val();
       
        var message = "";
        var vali=true; 

        //var arr_name = files.split('.');
        if(vali == false){
            alert(message);
            return;
        }
        else{
            var http = new XMLHttpRequest();
            //http_arr.push(http);
            
            var url = getUrspal() + "admin/quangcao/uploadfile";
            var data = new FormData();
            data.append('filename', files[0].name);
            data.append('myfile', files[0]);
            data.append('info', info);
            data.append('lang', lang);
            http.open('POST', url, true); ///
            http.send(data);
            
            //Nhận dữ liệu trả về
            http.onreadystatechange = function(event) {
                //Kiểm tra điều kiện
                if (http.readyState == 4 && http.status == 200) {
                    //ProgressBar.style.background = ''; //Bỏ hình ảnh xử lý
                    try { //Bẫy lỗi JSON
                        var server = JSON.parse(http.responseText);
                        if (server.status) {
                             $(".ThemThanhCong").show(500);        
                        } else {
                            $(".ThemThatBai").hide(0);
                        }
                    } catch (e) {
                    }
                }
                //http.removeEventListener('progress'); //Bỏ bắt sự kiện
                
                 $(".ThemThanhCong").show(500);
            }
         
      }
  
    }
}

function UploadFile_Complete(data) {
    if($.isEmptyObject(data))
    {
        
    }
    else
    {
        var res = data;
        if (res == "1" || res == 1) {
            $(".ThemThanhCong").show(500);
            $(".ThemThatBai").hide(0);
           
        }
        else {
            alert(res);
            $(".ThemThanhCong").hide(500);
            $(".ThemThatBai").show(500);
            
        }
    }
    
}