 <ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
    <li><a href="<?php echo base_url();?>">Quản lý Spa</a></li>
    <li class="active">Chính sách SPA</li>            
  </ol>
  <h1>Chính sách SPA</h1>
 
  <div class="row">
    <div class="col-md-12">
      <form role="form" id="templatemo-preferences-form" method="POST" action="">
   
      <div class="row">
        <div class="col-md-12 margin-bottom-15">
          <textarea class="form-control ckeditor" name="txtMoreInfo" rows="7" id="txtMoreInfo" >
              <?php echo $spa_policy->MoreInfo; ?>
          </textarea>
        </div>
      </div>
       
      <div class="row">
          <div class="col-md-12">
                <div class="alert alert-danger"style="color: red; display: none;" id="notifyerr">
                  <span >Cập nhật thất bại</span>
                </div>
                <div class="alert alert-success"style="color: blue; display: none;" id="notifysuccess">
                  <span >Cập nhật thành công</span>
                </div>
          </div>
      </div>
      <div class="row templatemo-form-buttons">
        <div class="col-md-12">
          <button type="button" id="btnsave" class="btn btn-primary">Cập nhật</button>
          <button type="button" id="btnreset" class="btn btn-default">Reset</button>    
        </div>
      </div>
    </form>
   
  </div>
</div>