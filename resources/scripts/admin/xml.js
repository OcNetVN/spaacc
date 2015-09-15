// event select box ojbiect
  $(document).ready(function(){
      $('.box').hide();
        $('#dropdown').change(function() {
          $('.box').hide();
          $('.' + $(this).val()).show();
       }).trigger('change');
      });
      
  
  function UpdateSetting(){
     var thongso = $("#dropdown").val();
     var v_setting = $("#valuesetting" + thongso).val();
     if(thongso == ""){
         alert("Vui lòng chọn thông số để sửa đổi");
         return;
     }
     
     
     $.ajax({
        type:"POST",
        url:getUrspal() + "admin/xml/updatesetting",
        dataType:"text",
        data: {
                thongso:thongso,
                value:v_setting
            },
        cache:false,
        success:function (data) {
            if( data== "-1" || data==="-1" || data==-1 )
            {
                alert("Bạn không có quyền trên chức năng này ở trang này !!! ");                    
            }
            else
            {
                UpdateSetting_Complete(data);
            }
          //alert(data);
        }
    }); 
}

function UpdateSetting_Complete(data){
    var res = data;
    if(res != null)
    {
        if(res == "1" || res == 1){
            alert("Update thanh công");
        }
    }
}