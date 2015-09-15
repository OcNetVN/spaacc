<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>the Booking - Sign Up</title>
    <!-- InstanceEndEditable -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('resources/front/favicon.ico'); ?>">
    <?php require("head.php"); ?>
    <script src="<?php echo base_url('resources/front/js/register.js'); ?>"></script>
</head>

<body>

<header>
    <div class="navbar" role="navigation">
        <div class="full-bar top-bar">
            <div class="container">
                <div class="row">
                    <?php
                         require("header.php");
                     ?>
                </div>                       
            </div>
        </div>
        <div class="clearfix"></div>
        <?php
             require("headersearch.php");
         ?>
     </div>
    <?php
             require("menu.php");
    ?>   
    <div class="clearfix"></div>
    
    <!-- InstanceBeginEditable name="Full Content" -->
    <!-- InstanceEndEditable -->    
    <?php if(isset($email)){
        echo $email;
    }?>
    <div class="container" style="padding-top:10px; padding-bottom:10px;">
    <!-- InstanceBeginEditable name="Main Content" -->
        <div class="row">
            <div class="col-md-6 col-sm-offset-3">
                <h1 class="title-page" style="text-align:center;">Đăng Ký Thành Viên</h1>            
                <div class="divregister">
                    <div class="fields">
                    <form class="form-horizontal" role="form" style="margin-top:20px;">
                        <div class="form-group">
                            <button type="button" class="col-sm-offset-2 btn btn-default btn-google" href="javascript:void(0)" onclick="singupgoogle();" style="width:350px;">Google Account</button>
                          </div>
                        <div class="form-group DaLogin">
                            <button type="button" class="col-sm-offset-2 btn btn-default btn-facebook" href="javascript:void(0)" onclick="singupfacebook();" style="width:350px;">Facebook Account</button>
                            <div id="fb-root"></div>
                        </div>
                      <hr />
                      <div class="form-group">
                        <div class="col-sm-6">
                          <label for="inputEmail3" class="control-label">Email đăng nhập<span style="color: red;">(*)</span></label>
                          <input type="email" class="form-control" id="inputEmail" placeholder="Nhập Email">
                          <span id="email_err" style="display: none; color: red; font-weight: bold; margin-left: 5px;"></span>
                        </div>
                        <div class="col-sm-6">
                             <label for="inputPassword3" class="control-label">Mật khẩu<span style="color: red;">(*)</span></label>
                             <input type="password" class="form-control" id="inputPassword" placeholder="Nhập mật khẩu">
                        </div>
                      </div>
                       <div class="form-group">
                            <div class="col-sm-6">
                              <label for="inputname1" class="control-label">Họ tên<span style="color: red;">(*)</span></label>
                              <input type="text" class="form-control" id="inputname" placeholder="">
                            </div>
                            
                            <div class="col-sm-6">
                            <label for="re_inputPassword3" class="control-label">Xác nhận mật khẩu<span style="color: red;">(*)</span></label>
                            <input type="password" class="form-control" id="re_inputPassword" placeholder="Nhập lại mật khẩu"><span id="pass_err" style="display: none; color: red; font-weight: bold; margin-left: 5px;"></span>
                            </div>
                      </div>
                     
                     
                      <div class="form-group">
                        
                        <div class="col-sm-6">
                        <label for="inputname2" class="control-label">Địa chỉ thường trú</label>
                          <input type="text" class="form-control" id="inputPerAdd" placeholder="">
                        </div>
                        <div class="col-sm-6">
                        <label for="inputname2" class=" control-label">Địa chỉ tạm trú</label>
                          <input type="text" class="form-control" id="inputTemAdd" placeholder="">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-6">
                        <label for="inputname2" class=" control-label">Thành phố</label>
                          <select class="form-control" id="inputProvinceId">
                                <?php
                                    echo $ProvinceString;
                                ?>
                          </select>
                        </div>
                        
                        <div class="col-sm-6">
                          <label for="inputname2" class=" control-label">Hình ảnh</label>
                          <input type="file"  id="inputImage" placeholder="">
                        </div>
                      </div>
                      <div class="form-group">
                        
                        <div class="col-sm-6">
                        <label for="inputname2" class=" control-label">Điện thoại<span style="color: red;">(*)</span></label>
                          <input type="text" class="form-control" id="inputTel" placeholder="">
                        </div>
                        
                        <div class="col-sm-6">
                        <label for="inputname2" class=" control-label">Ngày sinh</label>
                          <input type="text" class="form-control datepicker" id="inputDoB" placeholder="">
                        </div>
                      </div>
                      <div class="form-group">
                        
                        <div class="col-sm-6">
                        <label for="inputname2" class=" control-label">CMND</label>
                          <input type="text" class="form-control" id="inputcmnd" placeholder="">
                        </div>
                        
                        <div class="col-sm-6">
                          <label for="inputname2" class=" control-label">Ngày cấp CMND</label>
                          <input type="text" class="form-control datepicker" id="inputPIDI" placeholder="">
                        </div>
                      </div>
                      <div class="form-group">
                        
                        <div class="col-sm-6">
                          <label for="inputname2" class=" control-label">Nơi cấp CMND</label>
                          <input type="text" class="form-control" id="inputPIDIssue" placeholder="">
                        </div>
                        
                        <div class="col-sm-6">
                          <label for="inputname2" class=" control-label">Fax</label>
                          <input type="text" class="form-control" id="inputFax" placeholder="">
                        </div>
                      </div>
                      <div class="form-group">
                        
                        <div class="col-sm-6">
                          <label for="inputname2" class="control-label">Website</label>
                          <input type="text" class="form-control" id="inputWebsite" placeholder="">
                        </div>
                       <div class="col-sm-6">
                        <label for="sex" class="control-label">Giới tính</label><br />
                        <input type="radio"  name="sex" value="0" checked="checked" /> 
                          Nữ
                          <input type="radio" name="sex" value="1" /> 
                          Nam
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-10">
                          <label for="inputname2" class="control-label">Ghi chú</label>
                          <textarea  id="inputNote" style="width: 443px; height: 110px;"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-10 control-label" id="thongbaochung" style="display: none; color: green; font-weight: bold;">Đã đăng ký thành công, vui lòng vào mail để kiểm tra. Hãy kiểm tra trong mục Hộp thư đến hoặc trong mục Spam. </label>
                      </div>

                      <!--<div class="form-group">
                        <div class=" col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> Nhận thông tin từ The Booking Spa
                            </label>
                          </div>
                        </div>
                      </div>-->
                      
                      <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-10">
                          <button type="button" class="btn btn-default" onclick="actionregister();">Register</button>
                        </div>
                      </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- InstanceEndEditable -->
    </div>
    
</header>

<!-- include footer -->
<?php
     require("footer.php");
?>

<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "42ca428d-6cd0-4b93-b360-fa0d0bfa3696", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script> 

    
</body>
<!-- InstanceEnd -->
</html>
