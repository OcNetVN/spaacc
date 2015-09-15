<div class="container">
        <nav class="navbar yamm navbar-default main-nav" role="navigation">
          <div>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?php echo base_url('index'); ?>"><img src="<?php echo base_url('resources/front/images/logo-thebookingspa.png'); ?>" width="230" height="55" alt="The Booking Spa logo" /></a>
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
            <!--Bat dau Menu tu load-->            
            <?php
                 echo $MenuString;
             ?>
             
                
            </ul> 
            <!--ket thuc Menu tu load-->    
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
    </div>