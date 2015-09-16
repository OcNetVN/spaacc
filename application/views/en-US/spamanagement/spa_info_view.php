<ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
    <li><a href="index.html">Management Spa</a></li>
    <li class="active">Information details SPA</li>            
  </ol>
  <h1>Information details SPA</h1>
 
  <div class="row">
    <div class="col-md-12">
      <form role="form" id="templatemo-preferences-form" method="POST" action="">
        <div class="row">
          <div class="col-md-5 margin-bottom-15">
            <label for="firstName" class="control-label">Name SPA <span style="color: red;">(*)</span></label>
            <input type="text" class="form-control" id="txtSpaName" value="<?php echo $spa_info->spaName; ?>" />    
            <span style="color: red; display: none;" id="notifyspaname">Không được rỗng</span>              
          </div>
          <div class="col-md-7 margin-bottom-15">
            <label for="lastName" class="control-label">Address</label>
            <input type="text" class="form-control" id="txtSpaAdd" value="<?php echo $spa_info->Address; ?>" />                 
          </div>
        </div>
        <div class="row">
          <div class="col-md-5 margin-bottom-15">
            <label>Code spa</label>
            <p class="form-control-static" id="txtSpaID"><?php echo $spa_info->spaID; ?></p>
            <label>Create Date</label>
            <?php 
                $hour_create        =   substr($spa_info->CreatedDate,-8);
                $createdate         =   substr($spa_info->CreatedDate,0,10);  //yyyy-mm-dd
                $createdate         =   substr($createdate,-2)."-".substr($createdate,5,2)."-".substr($createdate,0,4);
            ?>
            <p class="form-control-static" id="txtCreatedDate"><?php echo $hour_create." ".$createdate; ?></p>
            <label>Modified Date</label>
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
            <label>Modified By</label>
            <p class="form-control-static" id="txtModifiedBy"><?php echo $spa_info->ModifiedBy; ?></p>                     
          </div>
          <div class="col-md-7 margin-bottom-15">
            <label>Phone number advertisement</label>
            <input type="text" class="form-control" maxlength="15" id="txtTel1" value="<?php echo $spa_info->Tel1; ?>" />
            <label>Phone number notify</label>
            <input type="text" class="form-control" maxlength="15" id="txtTel" value="<?php echo $spa_info->Tel; ?>" />
              <br />
            <label>Email to advertisement</label>
            <input type="text" class="form-control" id="txtEmail1" value="<?php echo $spa_info->Email1; ?>" /> 
            <span style="color: red; display: none;" id="notifyemail1">Email incorrect</span>      
                                
            <label>Email to notify</label>
            <input type="text" class="form-control" id="txtEmail" value="<?php echo $spa_info->Email; ?>" />   
            <span style="color: red; display: none;" id="notifyemail">Email incorrect</span>                 
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
                <span style="color: red; display: none;" id="notifylocation">Location incorrect</span>    
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
                <label for="Status">Status</label>
                <?php
                    if($spa_info->Status    ==  1)
                        
                ?>
                <select name="Status" id="cboStatusTab2" class="form-control" disabled="disabled" >
                    <option value="0" <?php if($spa_info->Status    ==  0) echo "selected=\"selected\""; ?>>Lock </option>
                    <option value="1" <?php if($spa_info->Status    ==  1) echo "selected=\"selected\""; ?>>Active </option>
                </select>
                <label for="secity">Province, City</label>
                <select class="form-control" id="secity">
                    <!--load data-->
                </select>
                <label for="sedistrict">District</label>
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
            <span style="color: red; display: none;" id="notifywebsite">Website incorrect</span>
          </div>
        </div>
        
      <div class="row">
        <div class="col-md-12 margin-bottom-15">
          <label for="txtIntro">Information</label>
          <textarea class="form-control ckeditor" name="txtIntro" rows="7" id="txtIntro" >
              <?php echo $spa_info->Intro; ?>
          </textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 margin-bottom-15">
          <label for="txtNote">Information More</label>
          <textarea class="form-control ckeditor" name="txtMoreInfo" rows="3" id="txtMoreInfo">
            <?php echo $spa_info->MoreInfo; ?>
          </textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 margin-bottom-15">
          <label for="txtNote">Notes</label>
          <textarea class="form-control ckeditor" name="txtNote" rows="3" id="txtNote">
            <?php echo $spa_info->Note; ?>
          </textarea>
        </div>
      </div>
      <div class="form-group" id="divuploadimage">
            <label class="col-lg-2 col-sm-2 control-label">Picture: </label>
            <div class="col-lg-9">
                <div class="content-box-content">    
                    <div class="tab-content default-tab">
                        <form role="form" action="#" method="post" enctype="multipart/form-data" >
                        <div class="form-group">
                            <input class="btn btn-success" type="file" name="myfile" id="myfile" multiple />
                            <input type="button" style="margin-top: 5px;" class="btn btn-info" value="Upload images" onclick="return doUpload1('<?php echo base_url('spaman/home_controller/uploadimage_spainfo/')  ?>');" />
                            <input type="button" style="margin-top: 5px;" class="btn btn-warning" value="Cancel" onclick="cancleUpload();"/>
                        </div> 
                        </form>
                        <hr />
                        <div id="progress-group">
                            <div class="progress">
                              <div class="progress-bar" style="width: 30%;">
                                File Name
                              </div>
                              <div class="progress-text text-center">
                                  Process
                              </div>
                            </div>
                        </div>
                      <div class="clear"></div>
                      <input type="hidden" id="didUrlImage"/>
                        <p>
                          <input  id ="" class="btn btn-default" name="btnthem" onclick="previewimage_spainfo();" type="button" data-toggle="modal" data-target="#modalviewimage" value="View images" />
                    </div> 
               </div> 
            </div>
        </div>  
        <div class="row">
          <div class="col-md-12">
                <div class="alert alert-danger"style="color: red; display: none;" id="notifyerr">
                  <span >Update Failed</span>
                </div>
                <div class="alert alert-success"style="color: blue; display: none;" id="notifysuccess">
                  <span >Update Success</span>
                </div>
          </div>
        </div>
      <div class="row templatemo-form-buttons">
        <div class="col-md-12">
          <button type="button" id="btnsave" class="btn btn-primary">Update</button>
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
                <h4 class="modal-title" id="myModalLabel">View images</h4>
              </div>
              <div class="modal-body">
                    <p style="color: red; display: none;" id="notifylistimage">not found</p>
                    <div class="row" id="divlistimage">
                        <!--load data-->
                    </div>
                    <div class="row">
                        <span style="color: red; display: none;" id="notifyerrdelimage">Error</span>
                        <span style="color: blue; display: none;" id="notifysuccessdelimage">Success</span>
                    </div>
              </div>
              <div class="modal-footer">
                <button id="btncloseadd" type="button" class="btn btn-default" data-dismiss="modal">Losed</button>
              </div>
            </div>
          </div>
        </div>
      <!-- end Modal view image -->
  </div>
</div>