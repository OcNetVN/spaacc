<ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
    <li><a href="index.html">Quản lý Spa</a></li>
    <li class="active">Thông tin chi tiết SPA</li>            
  </ol>
  <h1>Thông tin chi tiết SPA</h1>
 
  <div class="row">
    <div class="col-md-12">
      <form role="form" id="templatemo-preferences-form" method="POST" action="">
        <div class="row">
          <div class="col-md-5 margin-bottom-15">
            <label for="firstName" class="control-label">Tên SPA <span style="color: red;">(*)</span></label>
            <input type="text" class="form-control" id="txtSpaName" value="<?php echo $spa_info->spaName; ?>" />    
            <span style="color: red; display: none;" id="notifyspaname">Không được rỗng</span>              
          </div>
          <div class="col-md-7 margin-bottom-15">
            <label for="lastName" class="control-label">Địa chỉ</label>
            <input type="text" class="form-control" id="txtSpaAdd" value="<?php echo $spa_info->Address; ?>" />                 
          </div>
        </div>
        <div class="row">
          <div class="col-md-5 margin-bottom-15">
            <label>Mã spa</label>
            <p class="form-control-static" id="txtSpaID"><?php echo $spa_info->spaID; ?></p>
            <label>Ngày tạo</label>
            <?php 
                $hour_create        =   substr($spa_info->CreatedDate,-8);
                $createdate         =   substr($spa_info->CreatedDate,0,10);  //yyyy-mm-dd
                $createdate         =   substr($createdate,-2)."-".substr($createdate,5,2)."-".substr($createdate,0,4);
            ?>
            <p class="form-control-static" id="txtCreatedDate"><?php echo $hour_create." ".$createdate; ?></p>
            <label>Ngày cập nhật</label>
            <?php 
                if($spa_info->ModifiedDate      !=  "")
                {
                    $hour_modified  =   substr($spa_info->ModifiedDate,-8);
                    $modifieddate   =   substr($spa_info->ModifiedDate,0,10);  //yyyy-mm-dd
                    $modifieddate   =   substr($modifieddate,-2)."-".substr($modifieddate,5,2)."-".substr($modifieddate,0,4);
                }
                else
                    $modifieddate       =   "";
            ?>
            <p class="form-control-static" id="txtModifiedDate"><?php echo $hour_modified." ".$modifieddate; ?></a></p>    
            <label>Người cập nhật</label>
            <p class="form-control-static" id="txtModifiedBy"><?php echo $spa_info->ModifiedBy; ?></p>                     
          </div>
          <div class="col-md-7 margin-bottom-15">
            <label>Số ĐT quảng cáo</label>
            <input type="text" class="form-control" maxlength="15" id="txtTel1" value="<?php echo $spa_info->Tel1; ?>" />
            <label>Số ĐT nhận thông báo</label>
            <input type="text" class="form-control" maxlength="15" id="txtTel" value="<?php echo $spa_info->Tel; ?>" />
              <br />
            <label>Email quảng cáo</label>
            <input type="text" class="form-control" id="txtEmail1" value="<?php echo $spa_info->Email1; ?>" /> 
            <span style="color: red; display: none;" id="notifyemail1">Email không đúng</span>      
                                
            <label>Email nhận thông báo</label>
            <input type="text" class="form-control" id="txtEmail" value="<?php echo $spa_info->Email; ?>" />   
            <span style="color: red; display: none;" id="notifyemail">Email không đúng</span>                 
          </div>
        </div>
        <div class="row">
            <div class="col-md-5 margin-bottom-15">
                <label for="txtLoctionGPS">Location GPS</label>
                <?php 
                    if($spa_info->Location  != "")
                        $arr_location       =   explode("|",$spa_info->Location);
                    else
                    {
                        $arr_location[0]    =   "";
                        $arr_location[1]    =   "";
                    }
                ?>
                <input type="text" class="form-control" id="txtLoctionGPS" value="<?php echo $arr_location[0]; ?>" /> 
                <span style="color: red; display: none;" id="notifylocation">Location không đúng</span>    
              </div>
              <div class="col-md-7 margin-bottom-15">
                  <label for="txtLoctionName">Location Name</label>
                <input type="text" class="form-control" id="txtLoctionName" value="<?php echo $arr_location[1]; ?>">
              </div>
          </div>
          <div class="row">
            <div class="col-md-5">
                  <div style="overflow:hidden;height:200px;width:350px;">
                        <div id="gmap_canvas" style="height:200px;width:450px;"></div>
                    </div>
            </div>
            <div class="col-md-7">
                <label for="Status">Trạng thái</label>
                <?php
                    if($spa_info->Status    ==  1)
                        
                ?>
                <select name="Status" id="cboStatusTab2" class="form-control" disabled="disabled" >
                    <option value="0" <?php if($spa_info->Status    ==  0) echo "selected=\"selected\""; ?>>Khóa </option>
                    <option value="1" <?php if($spa_info->Status    ==  1) echo "selected=\"selected\""; ?>>Đang hoạt động </option>
                </select>
                <label for="secity">Tỉnh, thành phố</label>
                <select class="form-control" id="secity">
                    <!--load data-->
                </select>
                <label for="sedistrict">Quận, huyện</label>
                <select class="form-control" id="sedistrict">
                    <!--load data-->
                </select>
            </div>
          </div>
        
        <div class="row">
          <div class="col-md-5 margin-bottom-15">&nbsp;
          </div>
          <div class="col-md-7 margin-bottom-15">
              <label for="txtWebsite">Website</label>
            <input type="text" class="form-control" id="txtWebsite" value="<?php echo $spa_info->Website; ?>" />
            <span style="color: red; display: none;" id="notifywebsite">Website không chính xác</span>
          </div>
        </div>
        
      <div class="row">
        <div class="col-md-12 margin-bottom-15">
          <label for="txtIntro">Thông tin</label>
          <textarea class="form-control ckeditor" name="txtIntro" rows="7" id="txtIntro" >
              <?php echo $spa_info->Intro; ?>
          </textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 margin-bottom-15">
          <label for="txtNote">Thông tin thêm</label>
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