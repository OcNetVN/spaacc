<!--<script type="text/javascript" src="<?php echo base_url('resources/ckeditor/ckeditor.js'); ?>"></script>-->
<script src="<?php echo base_url('resources/spamanagement/js/spa_calendar.js'); ?>"></script>




<!--<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script> 
  <script>
  $(function() {
    $( "#ngay_xem" ).datepicker();
    $( "#ngay_xem" ).datepicker( "option", "dateFormat", "yy-mm-dd" );

  });
  </script>
-->



<script type="text/javascript" src="../resources/datetime/jquery.simple-dtpicker.js"></script>
  <link type="text/css" href="../resources/datetime/jquery.simple-dtpicker.css" rel="stylesheet" />
  <!---->
  <script type="text/javascript">
    $(function(){
      $('*[name=Edit_FromTime]').appendDtpicker();
      $('*[name=Edit_ToTime]').appendDtpicker();
      
      $('*[name=Add_FromTime]').appendDtpicker();
      $('*[name=Add_ToTime]').appendDtpicker();


 	  $('*[name=ngay_xem]').appendDtpicker();

    });
  </script>