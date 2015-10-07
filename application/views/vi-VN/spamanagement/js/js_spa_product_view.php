<script type="text/javascript" src="<?php echo base_url('resources/ckeditor/ckeditor.js'); ?>"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
<script src="<?php echo base_url('resources/spamanagement/js/common/upload.js'); ?>"></script>
<script src="<?php echo base_url('resources/spamanagement/js/spa_product.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.tmpl.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.number.js'); ?>"></script>











<!--<script src="http://code.jquery.com/jquery-1.10.2.js"></script>-->
<!--  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script> 
  <script>
  $(function() {
    $( "#Edit_ValidTimeFrom_product" ).datepicker();
    $( "#Edit_ValidTimeTo_product" ).datepicker();

    $( "#Edit_ValidTimeFrom_product" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
    $( "#Edit_ValidTimeTo_product" ).datepicker( "option", "dateFormat", "yy-mm-dd" );


    $( "#Add_ValidTimeFrom_product" ).datepicker();
    $( "#Add_ValidTimeTo_product" ).datepicker();

    $( "#Add_ValidTimeFrom_product" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
    $( "#Add_ValidTimeTo_product" ).datepicker( "option", "dateFormat", "yy-mm-dd" );

  });
  </script>
 -->



 <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->

  <script type="text/javascript" src="../resources/datetime/jquery.simple-dtpicker.js"></script>
  <link type="text/css" href="../resources/datetime/jquery.simple-dtpicker.css" rel="stylesheet" />
  <!---->
  <script type="text/javascript">
    $(function(){
      $('*[name=Edit_ValidTimeFrom_product]').appendDtpicker();
      $('*[name=Edit_ValidTimeTo_product]').appendDtpicker();
      
      $('*[name=Add_ValidTimeFrom_product]').appendDtpicker();
      $('*[name=Add_ValidTimeTo_product]').appendDtpicker();
    });
  </script>