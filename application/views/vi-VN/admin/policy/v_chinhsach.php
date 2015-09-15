<ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
    <li><a href="index.html">Quản lý Spa</a></li>
    <li class="active">Chính sách của SPA</li>            
  </ol>
  <h1>Chính sách SPA</h1>
 
  <div class="row">
    <div class="col-md-12">
      <form role="form" id="templatemo-preferences-form" method="POST" action="">
      <div class="row">
        <div class="col-md-12 margin-bottom-15">
          <label for="txtNote">Nhập thông tin chính sách</label>
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
            <label class="col-lg-2 col-sm-2 control-label">Hình ảnh: </label>
            <div class="col-lg-9">
                <div class="content-box-content">    
                    <div class="tab-content default-tab">
                        <form role="form" action="#" method="post" enctype="multipart/form-data" >
                        <div class="form-group">
                            <input class="btn btn-success" type="file" name="myfile" id="myfile" multiple />
                            <input type="button" style="margin-top: 5px;" class="btn btn-info" value="Tải ảnh" onclick="return doUpload1('<?php echo base_url('spaman/home_controller/uploadimage_spainfo/')  ?>');" />
                            <input type="button" style="margin-top: 5px;" class="btn btn-warning" value="Huỷ" onclick="cancleUpload();"/>
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
                          <input  id ="" class="btn btn-default" name="btnthem" onclick="previewimage_spainfo();" type="button" data-toggle="modal" data-target="#modalviewimage" value="Xem lại hình" />
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
                <button id="btncloseadd" type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
              </div>
            </div>
          </div>
        </div>
      <!-- end Modal view image -->
  </div>
</div>