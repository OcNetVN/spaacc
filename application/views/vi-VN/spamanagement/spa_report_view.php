<ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
    <li class="active">Báo cáo</li>            
  </ol>
<html>
<nav>
  <ul class="pagination">
    <li>
      <a href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li>
      <a href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>

<h2>Báo Cáo</h2>
<p><?php echo anchor('log-in/doanh-thu/sua-tin-tuc','Thêm Sửa Báo Cáo') ?></p>
<label for="loai">Theo Loại</label>
<select class="combobox">
  <option></option>
  <option value="PA">Theo ngày</option>
  <option value="CT">Theo tháng</option>
  <option value="NY">Theo năm</option>
  <option value="MD">Theo tuần</option>
  <option value="VA">Theo quý</option>
</select>

<script type="text/javascript">
  $(document).ready(function(){
    $('.combobox').combobox();
  });
</script>

<label for="from">Từ ngày</label>
<head>
    <link href="jquery-ui-1.10.1.min.css" rel="stylesheet" />
    <script src="modernizr-2.6.2.min.js"></script>
    <script src="jquery-1.9.1.min.js"></script>
    <script src="jquery-ui-1.10.1.min.js"></script>
    <script>
        $(function() {
            if (!Modernizr.inputtypes['date']) {
                $('input[type=date]').datepicker({
                    dateFormat: 'yy-mm-dd'
                });
            }
        });
    </script>
</head>
<body>
    <input type="date">
</body>



<label for="to">Ðến ngày</label>
<head>
    <link href="jquery-ui-1.10.1.min.css" rel="stylesheet" />
    <script src="modernizr-2.6.2.min.js"></script>
    <script src="jquery-1.9.1.min.js"></script>
    <script src="jquery-ui-1.10.1.min.js"></script>
    <script>
        $(function() {
            if (!Modernizr.inputtypes['date']) {
                $('input[type=date]').datepicker({
                    dateFormat: 'yy-mm-dd'
                });
            }
        });
    </script>
</head>
<body>
    <input type="date">
</body>

<button type="baocao" style="height:38px;width:100px;background-color: #B1CEA0;">Báo Cáo</button>

<form class="navbar-form" role="search">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
        <div class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-md-12">
      <form role="form" id="templatemo-preferences-form" method="POST" action="">
      <div class="row">
        <div class="col-md-12 margin-bottom-15">
          <label for="txtNote">Nhập báo cáo</label>
          <textarea class="form-control ckeditor" name="txtMoreInfo" rows="3" id="txtMoreInfo">
            <?php echo $spa_info->MoreInfo; ?>
          </textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 margin-bottom-15">
          <label for="txtNote">Ghi chú</label>
          <textarea class="form-control ckeditor" name="txtNote" rows="3" id="txtNote">
            <?php echo $spa_info->Note; ?>
          </textarea>
        </div>
      </div>
      <div class="form-group" id="divuploadimage">
            <label class="col-lg-2 col-sm-2 control-label">Hình ?nh: </label>
            <div class="col-lg-9">
                <div class="content-box-content">    
                    <div class="tab-content default-tab">
                        <form role="form" action="#" method="post" enctype="multipart/form-data" >
                        <div class="form-group">
                            <input class="btn btn-success" type="file" name="myfile" id="myfile" multiple />
                            <input type="button" style="margin-top: 5px;" class="btn btn-info" value="T?i ?nh" onclick="return doUpload1('<?php echo base_url('spaman/home_controller/uploadimage_spainfo/')  ?>');" />
                            <input type="button" style="margin-top: 5px;" class="btn btn-warning" value="Hu?" onclick="cancleUpload();"/>
                        </div> 
                        </form>
                        <hr />
                        <div id="progress-group">
                            <div class="progress">
                              <div class="progress-bar" style="width: 30%;">
                                Tên file
                              </div>
                              <div class="progress-text text-center">
                                  Tiến trình
                              </div>
                            </div>
                        </div>
                      <div class="clear"></div>
                      <input type="hidden" id="didUrlImage"/>
                        <p>
                          <input  id ="" class="btn btn-default" name="btnthem" onclick="previewimage_spainfo();" type="button" data-toggle="modal" data-target="#modalviewimage" value="Xem l?i hình" />
                    </div> 
               </div> 
            </div>
        </div>  
      <div class="col-md-8 col-md-offset-2">
            <span style="color: red; display: none;" id="notifyerr">Sửa không thành công</span>
            <span style="color: blue; display: none;" id="notifysuccess">Sửa thành công</span>
      </div>
      <div class="row templatemo-form-buttons">
        <div class="col-md-12">
          <button type="button" id="btnsave" class="btn btn-primary">Cập nhật</button>
          <button type="button" id="btnreset" class="btn btn-default">Reset</button>    
        </div>
      </div>
    </form>
    <!-- Modal view image -->
        <div class="modal fade" id="modalviewimage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Xem lại hình</h4>
              </div>
              <div class="modal-body">
                    <p style="color: red; display: none;" id="notifylistimage">Không tìm thấy hình nào</p>
                    <div class="row" id="divlistimage">
                        <!--load data-->
                    </div>
                    <div class="row">
                        <span style="color: red; display: none;" id="notifyerrdelimage">Có lỗi xảy ra</span>
                        <span style="color: blue; display: none;" id="notifysuccessdelimage">Thành công</span>
                    </div>
              </div>
              <div class="modal-footer">
                <button id="btncloseadd" type="button" class="btn btn-default" data-dismiss="modal">Ðóng</button>
              </div>
            </div>
          </div>
        </div>
      <!-- end Modal view image -->
  </div>
</div>

</html>