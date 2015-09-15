<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<?php
    if(!isset($_SESSION['AccUser']['user_name']))
    {
        redirect('login');
    } 
?>
 <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        <title>Spa Booking Nhập Liệu </title>
        <link rel="stylesheet" href="<?php echo base_url('resources/css/reset.css'); ?>" type="text/css" media="screen" />
      
        <link rel="stylesheet" href="<?php echo base_url('resources/css/style.css'); ?>" type="text/css" media="screen" />
        
        <link rel="stylesheet" href="<?php echo base_url('resources/css/invalid.css'); ?>" type="text/css" media="screen" />    
        
        <!-- jQuery -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery-1.3.2.min.js'); ?>"></script>
        <script src="<?php echo base_url('resources/front/js/common.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/menu.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/simpla.jquery.configuration.js'); ?>"></script>
        
        <!-- Facebox jQuery Plugin -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/facebox.js'); ?>"></script>
        
        <!-- jQuery WYSIWYG Plugin -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.wysiwyg.js'); ?>"></script>
        
        <!-- jQuery Datepicker Plugin -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.datePicker.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.date.js'); ?>"></script>
        
        <link href="<?php echo base_url('themes/1/js-image-slider.css'); ?>" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url('themes/1/js-image-slider.js'); ?>" type="text/javascript"></script>
        <link href="<?php echo base_url('generic.css'); ?>" rel="stylesheet" type="text/css" />
        <!--[if IE]><script type="text/javascript" src="resources/scripts/jquery.bgiframe.js"></script><![endif]-->
        
    </head>
  
    <body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
        <div id=""> <!-- Main Content Section with everything -->
            <?php 
            if(count($links)>0)
            {
                ?>
                <div id="sliderFrame">
                    <div id="slider">
                        
                        <?php
                        
                        foreach($links as $row)
                        {
                            echo ' <img src="'.$row->URL.'" width="700px" height="300px" />';
                        }
                        ?>
                    </div>
                    <div id="htmlcaption" style="display: none;">
                        <em>HTML</em> caption. Link to <a href="http://www.google.com/">Google</a>.
                    </div>
                </div>
                <?php
            }
            else
                echo ' <div class="notification information png_bg" style:"height:50px;">
                <div>
                    Không có hình.
                </div>
            </div>'
            ?>
            
            <div style="margin: 50px 0;"></div>
            <div class="clear"></div> <!-- End .clear -->
            
            <div class="content-box column-left">
                
                <div class="content-box-header">
                    
                    <h3>Content box left</h3>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab">
                       <div class="notification success png_bg">
                            <div>
                                 <strong>SpaName</strong>: <?php echo $spa->spaName ?>
                            </div>
                        </div>
                       <div class="notification success png_bg"><div><strong>Address:</strong> <?php echo $spa->Address ?></div>
                        </div>
                       <div class="notification success png_bg"><div><strong>Tel:</strong> <?php echo $spa->Tel ?></div>
                        </div>
                       <div class="notification success png_bg"><div><strong>Email</strong>: <?php echo $spa->Email ?></div>
                        </div>
                       
                       <div class="notification success png_bg"><div><strong>CreatedBy</strong>: <?php echo $spa->CreatedBy ?></div>
                        </div>
                       <div class="notification success png_bg"><div><strong>CreatedDate</strong>: <?php echo $spa->CreatedDate ?></div>
                        </div>
                       <div class="notification success png_bg"><div><strong>ModifiedBy</strong>: <?php echo $spa->ModifiedBy ?></div>
                        </div>
                       <div class="notification success png_bg"><div><strong>ModifiedDate</strong>: <?php echo $spa->ModifiedDate ?></div>
                        </div>
                       <div class="notification success png_bg"><div><strong>Intro</strong>: <?php echo $spa->Intro ?></div>
                        </div>
                       <div class="notification success png_bg"><div><strong>MoreInfo</strong>: <?php echo $spa->MoreInfo ?></div>
                        </div>
                       
            
                        
                        
                    </div> <!-- End #tab3 -->        
                    
                </div> <!-- End .content-box-content -->
                
            </div> <!-- End .content-box -->
            
            <div class="content-box column-right">
                
                <div class="content-box-header"> <!-- Add the class "closed" to the Content box header to have it closed by default -->
                    
                    <h3>Content box right</h3>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab">
                    <div class="notification success png_bg" style="height: 300px;"><div>
                    <strong >Note</strong>: <?php echo $spa->Note ?></div></div>
                     <div class="notification success png_bg"><div><strong>CreatedBy</strong>: <?php echo $spa->CreatedBy ?></div>
                        </div>
                       <div class="notification success png_bg"><div><strong>CreatedDate</strong>: <?php echo $spa->CreatedDate ?></div>
                        </div><br />   
                    </div> <!-- End #tab3 -->        
                    
                </div> <!-- End .content-box-content -->
                
            </div> <!-- End .content-box -->
            <div class="clear"></div>
            
            <div id="footer">
                <small> <!-- Remove this notice or replace it with whatever you want -->
                        &#169; Copyright 2009 Your Company | Powered by <a href="http://themeforest.net/item/simpla-admin-flexible-user-friendly-admin-skin/46073">Simpla Admin</a> | <a href="#">Top</a>
                </small>
            </div><!-- End #footer -->
            
        </div> <!-- End #main-content -->
        
    </div></body>
  

<!-- Download From www.exet.tk-->
</html>
