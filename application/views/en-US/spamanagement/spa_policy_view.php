 <ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
    <li><a href="<?php echo base_url();?>">Manager Spa</a></li>
    <li class="active">SPA Policy</li>            
  </ol>
  <h1>SPA Policy</h1>
 
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
                  <span >Update failed</span>
                </div>
                <div class="alert alert-success"style="color: blue; display: none;" id="notifysuccess">
                  <span >Update success</span>
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
   
  </div>
</div>