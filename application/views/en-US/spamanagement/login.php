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

    <title>System Administration Website</title>

   <link href="<?php echo base_url('resources/spamanagement/css/bootstrap.min.css')?>" rel="stylesheet">
   <script src="<?php echo base_url('resources/spamanagement/js/ie-emulation-modes-warning.js')?>"></script>

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('resources/spamanagement/css/signin.css')?>" rel="stylesheet">

  </head>

  <body>

    <div class="container">
        
        <?php if(isset($error))echo $error ?>
      <form class="form-signin" method="post" action="">
        <h2 class="text-input">Sign In</h2>
        <label for="username" class="sr-only">Username</label>
        <input type="text" id="username" name="username" class="form-control" value="<?php echo set_value('username','') ?>"placeholder="Gõ Tên Đăng Nhập">
        <?php echo form_error('username') ?>
        <label for="password" class="text-input">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Mời Nhập Mật Khẩu">
        <?php echo form_error('password') ?>
        <!-- <label for="mxt" class="sr-only">Mã Xác Thực</label>
        <?php
            echo $image;
        ?>
        <input type="text" id="mxt" name="mxt" class="form-control" placeholder="Mã Xác Thực" >
        <?php echo form_error('mxt') ?> -->
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Sign in" id="dang_nhap" name="dang_nhap" >
        
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url('resources/spamanagement/js/common/jquery-2.1.4.min.js')?>"></script>
    <script src="<?php echo base_url('resources/spamanagement/js/common/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('resources/spamanagement/js/ie10-viewport-bug-workaround.js')?>"></script>
  </body>
</html>
