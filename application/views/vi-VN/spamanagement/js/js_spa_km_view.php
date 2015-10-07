<script type="text/javascript" src="<?php echo base_url('resources/ckeditor/ckeditor.js'); ?>"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
<script src="<?php echo base_url('resources/spamanagement/js/common/upload.js'); ?>"></script>
<script src="<?php echo base_url('resources/spamanagement/js/spa_km.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.tmpl.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.number.js'); ?>"></script>





<!--<script src="http://code.jquery.com/jquery-1.10.2.js"></script>-->
<!-- 
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script> 
  <script>
  $(function() {
    $("#Add_BeginDateTime_promotion" ).datepicker();
    $("#Add_EndDateTime_promotion" ).datepicker();

    $("#Add_BeginDateTime_promotion" ).datepicker( "option", "dateFormat", "yy-mm-dd hh:ii:ss" );
    $("#Add_EndDateTime_promotion" ).datepicker( "option", "dateFormat", "yy-mm-dd H" );
    
  });

  </script>

 -->




 <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->

  <script type="text/javascript" src="../resources/datetime/jquery.simple-dtpicker.js"></script>
  <link type="text/css" href="../resources/datetime/jquery.simple-dtpicker.css" rel="stylesheet" />
  <!---->
  <script type="text/javascript">
    $(function(){
      $('*[name=Add_BeginDateTime_promotion]').appendDtpicker();
      $('*[name=Add_EndDateTime_promotion]').appendDtpicker();
    });
  </script>