<?php
  $arr = (array)$_SESSION['AccUser'];
  
?>
<div id="profile-links">
    Hello, <?php if(isset($arr)) echo $arr['Object']->FullName; ?>
    <br />
    <a href="<?php echo base_url('admin/welcome/'); ?>" title="View the Site">Trang chủ</a> | <a href="<?php echo base_url('admin/user/logout'); ?>" title="Thoát">Thoát</a>
</div>   
<ul id="main-nav">  <!-- Accordion Menu -->
    <?php
        echo $arr['MenuSTR'];
     ?>
</ul> <!-- End #main-nav -->

