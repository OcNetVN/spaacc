<?php
@session_start();
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        
        <title>Spa booking Admin | Sign In</title>
        
        <!--                       CSS                       -->
      
        <!-- Reset Stylesheet -->
        <link rel="stylesheet" href="<?php echo base_url('resources/css/reset.css');?>" type="text/css" media="screen" />
      
        <!-- Main Stylesheet -->
        <link rel="stylesheet" href="<?php echo base_url('resources/css/style.css')?>" type="text/css" media="screen" />
        
        <!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
        <link rel="stylesheet" href="<?php echo base_url('resources/css/invalid.css')?>" type="text/css" media="screen" />    
        
        <!-- Colour Schemes
      
        Default colour scheme is green. Uncomment prefered stylesheet to use it.
        
        <link rel="stylesheet" href="resources/css/blue.css" type="text/css" media="screen" />
        
        <link rel="stylesheet" href="resources/css/red.css" type="text/css" media="screen" />  
     
        -->
        
        <!-- Internet Explorer Fixes Stylesheet -->
        
        <!--[if lte IE 7]>
            <link rel="stylesheet" href="resources/css/ie.css" type="text/css" media="screen" />
        <![endif]-->
        
        <!--                       Javascripts                       -->
      
        <!-- jQuery -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery-1.3.2.min.js')?>"></script>
        
        <!-- jQuery Configuration -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/simpla.jquery.configuration.js')?>"></script>
        
        <!-- Facebox jQuery Plugin -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/facebox.js')?>"></script>
        
        <!-- jQuery WYSIWYG Plugin -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.wysiwyg.js')?>"></script>
        
        <!-- Internet Explorer .png-fix -->
        
        <!--[if IE 6]>
            <script type="text/javascript" src="resources/scripts/DD_belatedPNG_0.0.7a.js"></script>
            <script type="text/javascript">
                DD_belatedPNG.fix('.png_bg, img, li');
            </script>
        <![endif]-->
        
    </head>
  
    <body id="login">
        
        <div id="login-wrapper" class="png_bg">
            <div id="login-top">
            
                <h1>Spa booking</h1>
                <!-- Logo (221px width) -->
                <img id="logo" src="<?php echo base_url('resources/images/logo.png')?>" alt="Simpla Admin logo" />
            </div> <!-- End #logn-top -->
            
            <div id="login-content">
                
                <?php echo form_open_multipart('login') ?>
                
                    <div class="notification information png_bg">
                        
                    </div>
                    
                    <p>
                        <label>Username</label>
                        <?php
                            $data=array(
                                'name' => 'username',
                                'id' => 'username',
                                'value' => set_value('username',''),
                                'class' => 'text-input'
                                //'style' => 'text-align:center'
                            );
                            echo form_input($data);
                            echo '<p style="width:100%; clear:both;">';
                            echo form_error('username');
                            echo '</p>';
                        ?>
                    </p>
                    <div class="clear"></div>
                    <p>
                        <label>Password</label>
                        <?php
                            $data=array(
                                'name' => 'password',
                                'id' => 'password',
                                'value' => set_value('password',''),
                                'class' => 'text-input'
                                //'style' => 'text-align:center',
                            );
                            echo form_password($data);
                            echo '<p style="width:100%; clear:both;">';
                            echo form_error('password');
                            echo '</p>';
                        ?>
                        <!--<input class="text-input" type="password" />-->
                    </p>
                    <div class="clear"></div>
                    <!--<p>
                        <label>Code ID</label>
                        <?php
                            //echo '<span style="margin-left:15px;"></span>'.$image.'<br>';
                        ?>
                    </p>
                    <div class="clear"></div>
                    <p>
                        <label></label>
                            <?php
                            /*$data=array(
                                'name' => 'captcha',
                                'id' => 'captcha',
                                'value' => set_value('captcha',''),
                                'class' => 'text-input'
                            );
                            echo form_input($data);
                            echo '<p style="width:100%; clear:both;">';
                            echo form_error('captcha');
                            echo '</p>';*/
                        ?>
                    </p>
                    <div class="clear"></div>-->
                    <p id="remember-password">
                        <input type="checkbox" id="checkremember" name="checkremember" value="1"/>Remember me
                    </p>
                    <div class="clear"></div>
                    <p>
                        <?php echo $this->session->flashdata('flashmss'); ?>
                    </p>
                    <div class="clear"></div>
                    <p>
                        <?php
                            $data=array(
                                'name' => 'signin',
                                'value' => 'Sign In',
                                'class' => 'button'
                            );
                            echo form_submit($data);
                        ?>
                    </p>
                <?php
                 echo form_close();
                ?>
            </div> <!-- End #login-content -->
            
        </div> <!-- End #login-wrapper -->
        
  </body>
  </html>
