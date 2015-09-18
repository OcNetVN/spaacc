<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>System Adminnistrator Website</title>

   <link href="<?php echo base_url('resources/spamanagement/css/bootstrap.min.css')?>" rel="stylesheet">
   <script src="<?php echo base_url('resources/spamanagement/js/ie-emulation-modes-warning.js')?>"></script>

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('resources/spamanagement/css/signin.css')?>" rel="stylesheet">

  </head>

  <body>

    <div class="container">
        
        <?php if(isset($error))echo $error ?>
      <form class="form-signin" method="post" action="" >
        <img src="<?php echo base_url()?>/resources/front/images/logo-thebookingspa.png" style="margin-bottom: 20px;">
        <!-- <h2 class="text-input">Đăng Nhập</h2> -->
        <label for="username" class="sr-only">Username</label>
        <input type="text" id="username" name="username" class="form-control" value="<?php echo set_value('username','') ?>"placeholder="Tên Đăng Nhập"><br/>
        <label for="password" class="text-input sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Mật Khẩu">
        

        <!-- <label for="mxt" class="sr-only">Mã Xác Thực</label>
        <?php
            echo $image;
        ?>
        <input type="text" id="mxt" name="mxt" class="form-control" placeholder="Mã Xác Thực" >
        <?php echo form_error('mxt') ?> -->


        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Keep me logged in
          </label>
        </div>
       
        <?php
            echo form_error('username') ;
            echo form_error('password') ;

            if(isset( $_SESSION['error'])){
                echo  '<center style="margin: 10px 0px;"><span style="color: red;clear: both;text-align: right;font-size: 12px;font-weight: bold;">'.$_SESSION['error'].'</span></center>';
                unset($_SESSION['error']);
            }
          ?>
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Sign in" id="dang_nhap" name="dang_nhap" >
        
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url('resources/spamanagement/js/common/jquery-2.1.4.min.js')?>"></script>
    <script src="<?php echo base_url('resources/spamanagement/js/common/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('resources/spamanagement/js/ie10-viewport-bug-workaround.js')?>"></script>
  </body>
</html>
