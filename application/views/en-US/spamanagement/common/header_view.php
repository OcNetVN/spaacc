<div class="navbar navbar-inverse" role="navigation">
  <div class="navbar-header">
    <div class="logo"><h1>FCSE Spa</h1></div>
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar">?</span>
      <span class="icon-bar">?</span>
    </button> 
  </div>  
  <div class="col-md-1 top-bar-right" style="float:right">
    <ul class="nav navbar-nav navbar-right top-menu-right">
      <?php
        $arr_flag = array( 'Tiếng Việt' => 'vi-VN', 'Tiếng Anh' => 'en-US' );
        // print_r($arr_flag['Tiếng Việt']);
        ?>
          <li class="dropdown menu-flag">                          
              <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin"><img src="<?php echo base_url('resources/front/images/flag-'.$_SESSION['Lang'].'.png'); ?>" width="27" height="18" alt="Tiếng Việt" /> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <?php foreach ($arr_flag as $key => $value) { 
                          if($value!=$_SESSION['Lang']){
                ?>
                       <li role="presentation"><a role="menuitem" tabindex="-1" ><img src="<?php echo base_url('resources/front/images/flag-'.$value.'.png'); ?>" id="change_language" width="27" height="18" alt="<?php echo $key;?>" data="<?php echo $value;?>" /></a></li>
                <?php } }?>

              </ul>                   
          </li>
    </ul>
    </div> 
</div>