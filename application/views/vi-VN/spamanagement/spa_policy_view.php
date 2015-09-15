<ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
    <li><a href="index.html">Quản lý Spa</a></li>
    <li class="active">Thông tin chi tiết SPA</li>            
  </ol>
  <h1>Chính sách SPA</h1>
 
  <div class="row">
    <div class="col-md-12">
      <form role="form" id="templatemo-preferences-form" method="POST" action="">
   
      <div class="row">
        <div class="col-md-12 margin-bottom-15">
          <label for="txtIntro">Thông tin</label>
          <textarea class="form-control ckeditor" name="txtIntro" rows="7" id="txtIntro" >
              <?php echo $spa_policy->MoreInfo; ?>
          </textarea>
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
   
  </div>
</div>