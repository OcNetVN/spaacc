<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>the Booking - Spa - About Thebooking.vn</title>
    <!-- InstanceEndEditable -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
   <?php require("head.php"); ?>
 
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
    
    <div class="container" style="padding-top:10px; padding-bottom:10px;">
    <!-- InstanceBeginEditable name="Main Content" -->
        <h1 class="page-title-bar">Tuyển dụng THEBOOKING.VN</h1>
        <div class="wrap-2cols nav-left normal-page">
            <div class="col-nav">
              <?php
                require("cm_about.php");
              ?>
            </div>
            <div class="col-content">
                <div class="content">
                
                 <?php
                     echo  $HTMLInfo;
                 ?>
                     
                    <div class="clearfix"></div>     
              </div>
            </div>
            
        </div>
    <!-- InstanceEndEditable -->
    </div>
    
</header>

<?php
     require("footer.php");
?>
    

<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button id="btnCloseloginModal" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Đăng nhập</h4>
      </div>
      <div class="modal-body">
          <div class="row">            
            <div class="col-md-12">
            
                <form class="form" role="form">
                  <div class="form-group">
                    <button type="button" class="btn btn-default btn-google" style="width:100%;">Google Account</button>
                  </div>
                      <div class="form-group DaLogin">
                    <button type="button" class="btn btn-default btn-facebook" style="width:100%;">Facebook Account</button>
                  </div>
                  <hr />
                  
                  <div class="form-group">
                    Email đăng nhập
                    <div class="input-group">
                      <div class="input-group-addon">@</div>
                      <input id="txtUserIDEmail" class="form-control" type="email" placeholder="Enter email">
                    </div>
                  </div>
                  <div class="form-group">
                    Mật mã
                    <label class="sr-only" for="exampleInputPassword2">Password</label>
                    <input id="txtPass" type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"> Nhớ cho lần đăng nhập sau
                    </label>
                  </div>
                  <div class="form-group">
                    <button type="button" class="btn btn-success" onClick="DoLogin();">Đăng nhập</button> 
                      
                  </div>
                    <div class="form-group">
                    <a href="#" onClick="">Quên mật mã?</a>
                  </div>
                  <div >
                    <span id="spanTBLogin" class="informationNote" style="display: none; color: red;" > Lỗi đăng nhập!!!</span>
                  </div>
                </form>                
            </div>
        </div>
      </div>
</div>
<!-- End Modal -->
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">
var switchTo5x=true;
stLight.options({
    publisher: "42ca428d-6cd0-4b93-b360-fa0d0bfa3696", 
    doNotHash: false, 
    doNotCopy: false, 
    hashAddressBar: false
});

</script> 
    
</body>
<!-- InstanceEnd --></html>
