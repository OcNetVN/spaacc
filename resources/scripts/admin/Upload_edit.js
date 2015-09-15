//Biến toàn cục
var http_arr = new Array();

function doUpload_edit(url) {
	document.getElementById('progress-group_edit').innerHTML = ''; //Reset lại progress-group_edit
	var files = document.getElementById('myfile_edit').files; 
	for (i=0;i<files.length;i++) {
		var fileName = files[i].name; //Tên file
        if(fileName.indexOf(" ")>0 || fileName.indexOf("@")>0)
        {
            alert("Ten file không được có ký tự đặc biệt hoặc khoảng trắng ! Tên file đang ko hợp lệ : " + fileName);
        }
        else
        {
            uploadFile(files[i], i,url);
        }
	}
   
	return false;
}



function uploadFile(file, index, url) {
	var http = new XMLHttpRequest();
	http_arr.push(http);
	/** Khởi tạo vùng tiến trình **/
	//Div.progress-group_edit
	var ProgressGroup = document.getElementById('progress-group_edit');
	//Div.Progress
	var Progress = document.createElement('div');
	Progress.className = 'progress_edit';
	//Div.Progress-bar
	var ProgressBar = document.createElement('div');
	ProgressBar.className = 'progress-bar_edit';
	//Div.Progress-text
	var ProgressText = document.createElement('div');
	ProgressText.className = 'progress-text_edit';	
	//Thêm Div.Progress-bar và Div.Progress-text vào Div.Progress
	Progress.appendChild(ProgressBar);
	Progress.appendChild(ProgressText);
	//Thêm Div.Progress và Div.Progress-bar vào Div.progress-group_edit	
	ProgressGroup.appendChild(Progress);


	//Biến hỗ trợ tính toán tốc độ
	var oldLoaded = 0;
	var oldTime = 0;
	//Sự kiện bắt tiến trình
	http.upload.addEventListener('progress_edit', function(event) {	
		if (oldTime == 0) { //Set thời gian trước đó nếu như bằng không.
			oldTime = event.timeStamp;
		}	
		//Khởi tạo các biến cần thiết
		var fileName = file.name; //Tên file
		var fileLoaded = event.loaded; //Đã load được bao nhiêu
		var fileTotal = event.total; //Tổng cộng dung lượng cần load
		var fileProgress = parseInt((fileLoaded/fileTotal)*100) || 0; //Tiến trình xử lý
		var speed = speedRate(oldTime, event.timeStamp, oldLoaded, event.loaded);
		//Sử dụng biến
		ProgressBar.innerHTML = fileName + ' đang được upload...';
		ProgressBar.style.width = fileProgress + '%';
		ProgressText.innerHTML = fileProgress + '% Upload Speed: '+speed+'KB/s';
		//Chờ dữ liệu trả về
		if (fileProgress == 100) {
			ProgressBar.style.background = 'url("images/progressbar.gif")';
		}
		oldTime = event.timeStamp; //Set thời gian sau khi thực hiện xử lý
		oldLoaded = event.loaded; //Set dữ liệu đã nhận được
	}, false);
	

	//Bắt đầu Upload
	var data = new FormData();
	data.append('filename_edit', file.name);
	data.append('myfile_edit', file);
	http.open('POST', url, true); ///
	http.send(data);
    var getUrLD = url + "/" + file.name;
    //GetUrlImage(getUrLD);
    var sss=$("#didUrlImage_edit").val();
                              
        sss = sss + getUrLD +";";     
        $("#didUrlImage_edit").val(sss);           


	//Nhận dữ liệu trả về
	http.onreadystatechange = function(event) {
		//Kiểm tra điều kiện
		if (http.readyState == 4 && http.status == 200) {
			ProgressBar.style.background = ''; //Bỏ hình ảnh xử lý
			try { //Bẫy lỗi JSON
				var server = JSON.parse(http.responseText);
				if (server.status) {
					ProgressBar.className += ' progress-bar-success_edit'; //Thêm class Success
					ProgressBar.innerHTML = server.message; //Thông báo				
				} else {
					ProgressBar.className += ' progress-bar-danger_edit'; //Thêm class Danger
					ProgressBar.innerHTML = server.message; //Thông báo
				}
			} catch (e) {
				ProgressBar.className += ' progress-bar-danger_edit'; //Thêm class Danger
				ProgressBar.innerHTML = 'Có lỗi xảy ra'; //Thông báo
			}
		}
        XemLaiHinhDaUp_edit();
		http.removeEventListener('progress_edit'); //Bỏ bắt sự kiện
        
        
	}
}

function GetUrlImage(url){
    if(url = null){
        $listurl = [];
        $listurl.push(url);
        $("#didUrlImage_edit").val($listurl);
    }
    
}
function cancleUpload() {
	for (i=0;i<http_arr.length;i++) {
		http_arr[i].removeEventListener('progress_edit');
		http_arr[i].abort();
	}
	var ProgressBar = document.getElementsByClassName('progress-bar_edit');
	for (i=0;i<ProgressBar.length;i++) {
		ProgressBar[i].className = 'progress_edit progress-bar_edit progress-bar-danger_edit';
	}	
}


function speedRate(oldTime, newTime, oldLoaded, newLoaded) {
		var timeProcess = newTime - oldTime; //Độ trễ giữa 2 lần gọi sự kiện
		if (timeProcess != 0) {
			var currentLoadedPerMilisecond = (newLoaded - oldLoaded)/timeProcess; // Số byte chuyển được 1 Mili giây
			return parseInt((currentLoadedPerMilisecond * 1000)/1024); //Trả về giá trị tốc độ KB/s
		} else {
			return parseInt(newLoaded/1024); //Trả về giá trị tốc độ KB/s
		}
}
    //show nhung hinh cua object do
    function XemLaiHinhDaUp_edit() {
        var PromoID = $("#edit_obj").val(); 
        //$("#divXemLaiHinhDaUp").show(500); 
        $.ajax({
            url: "/nhaplieuspa/admin/objects/gethinhpromotion",
            type: "POST",
            data: { Promotion: PromoID },
            cache: false,
            dataType: "text",
            //contentType: "application/json; charset=utf-8",
            success:
                    function (data) {
                        XemLaiHinhDaUp_edit_Complete(data);
                    },
            error: function () {
            }
        });
    }
    function XemLaiHinhDaUp_edit_Complete(data) {
        //var sRes = data;  
        var sRes = JSON.parse(data);
        if (sRes != null) {
            var str = "<div style=\"float: left;\">";
    
            for (i = 0; i < sRes.length; i++) {
                str = str + "<span id=\"divLinks" + sRes[i].id + "\" style=\"padding: 10px; float: left\">";
                str = str + "<img src=\"/nhaplieuspa/" + sRes[i].URL + "\" width=\"100\"/>";
                str = str + "<a href=\"javascript:void(0);\" onclick=\"XoaHinhProduct('" + sRes[i].id + "');\">Xóa</a>";
                str = str + "</span>";
            }
    
            str = str + "</div>";
            $("#divXemLaiHinhDaUp_edit").html("");
            $("#divXemLaiHinhDaUp_edit").append(str);
        }
    }