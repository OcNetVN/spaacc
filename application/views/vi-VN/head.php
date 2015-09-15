    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Đặt chỗ ONLINE các dịch vụ làm đẹp và chăm sóc sức khỏe tại SPA & BEAUTY SALON trên toàn quốc nhanh nhất, an toàn nhất với giá ưu đãi nhất.">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('resources/front/favicon.ico'); ?>" />
<!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('resources/front/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('resources/front/css/datepicker.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/datetimepicker/tcal.css'); ?>" />
    
    <link href="<?php echo base_url('resources/front/css/yamm.css'); ?>" rel="stylesheet">
    

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug>
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
        <!-- Bootstrap core JavaScript
    ================================================== -->
	<!--analytic-->
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-58783948-1', 'auto');
	  ga('send', 'pageview');

	</script>
	<!--end analytic-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo base_url('resources/front/js/bootstrap.min.js'); ?>"></script>
    <!-- Bootstrap date picker -->
    <script src="<?php echo base_url('resources/front/js/jquery.js'); ?>"></script>
    <script src="<?php echo base_url('resources/front/js/bootstrap-datepicker.js'); ?>"></script>
    <script src="<?php echo base_url('resources/front/js/header.js'); ?>"></script>
    <script src="<?php echo base_url('resources/scripts/jquery.number.js'); ?>"></script>
    
    <script src="<?php echo base_url('resources/front/js/jquery.bgpos.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('resources/front/js/jquery.bpopup.min.js'); ?>" type="text/javascript"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="<?php echo base_url('resources/front/js/spachung.js'); ?>"></script>
    <script src="<?php echo base_url('resources/front/js/index.js'); ?>"></script>
    
    
         <script src="https://apis.google.com/js/client:platform.js" async defer></script>
  <!-- JavaScript specific to this application that is not related to API
     calls -->
    <script src="<?php echo base_url('resources/front/js/googleacess.js'); ?>"></script>
        
    
    <script>
        $(function(){
            $('.datepicker').datepicker({
                format: 'mm-dd-yyyy'
            });            
        });
        
        $(document).on('click', '.yamm .dropdown-menu', function(e) {
          e.stopPropagation()
        })
    </script>

    <!-- bxSlider Javascript file -->
    <script src="<?php echo base_url('resources/front/js/jquery.bxslider.min.js'); ?>"></script>
   
    <!-- bxSlider CSS file -->
    <link href="<?php echo base_url('resources/front/css/jquery.bxslider.css'); ?>" rel="stylesheet" type="text/css" />
    
    <script type="text/javascript">
        $(document).ready(function(){
            $('.bxslider').bxSlider({
                controls:false,
                autoHover:true,
                autoStart:true,
                minSlides: 1,
                maxSlides: 1,
                moveSlides: 1,
                slideMargin: 10
          });
        });
    </script>
    
    <!-- InstanceBeginEditable name="head" -->
        
    <!-- InstanceEndEditable -->
    <link href="<?php echo base_url('resources/front/css/style.css'); ?>" rel="stylesheet" type="text/css" />
    <style>
      .informationNote{
        font-weight: bold;
        padding: .2em .4em;
        margin: .8em 0 .2em;
        line-height: 1.5; 
      }
      .ui-autocomplete-category {
        font-weight: bold;
        padding: .2em .4em;
        margin: .8em 0 .2em;
        line-height: 1.5;
      }
      .ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
        /* prevent horizontal scrollbar */
        overflow-x: hidden;
      }
      /* IE 6 doesn't support max-height
       * we use height instead, but this forces the menu to always be this tall
       */
      * html .ui-autocomplete {
        height: 200px;
      }
  </style>
  
  <script>
  $.widget( "custom.catcomplete", $.ui.autocomplete, {
    _create: function() {
      this._super();
      this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
    },
    _renderMenu: function( ul, items ) {
      var that = this,
        currentCategory = "";
      $.each( items, function( index, item ) {
        var li;
        if ( item.category != currentCategory ) {
          ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
          currentCategory = item.category;
        }
        li = that._renderItemData( ul, item );
        if ( item.category ) {
          li.attr( "aria-label", item.category + " : " + item.label );
        }
      });
    }
  });
  </script>
  <script>
  $(function() {    
    $("#txtProductTypeSearch").catcomplete({
      delay: 500,
      autoFocus: true,
      source: function(request, response)
      {
          var req1= request.term;//
          //var req= $("#txtProductTypeSearch").val();          
          var res = [];
          $.ajax({
              url: getUrspal() + "index/listProductType",
              type:"POST",
              dataType: "json",
              data: {
                name: req1
              },
              success: function( data ) {
                response( data );
                //res = JSON.parse(data);
                res = data;
              }
          }); 
          return res; 
      },
      minLength: 0,
      select: function( event, ui ) {
        //log( ui.item ?
//          "Selected: " + ui.item.label :
//          "Nothing selected, input was " + this.value);
        //($("#txtProductTypeSearch")).focus();
      },
      open: function() {
        $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
      },
      close: function(event, ui) {
        $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
        //($("#txtProductTypeSearch")).focus();
      }
    }).focus(function(){
            if (this.value == "")
                {
                    $(this).catcomplete("search");
                }
        });
    
          
    
    $("#txtLocationSearch").catcomplete({
      delay: 2000,
      autoFocus: true,
      source: function(request, response)
      {
          var req1= request.term;//
          var res1 = [];
          $.ajax({
              url: getUrspal() + "index/listlocation",
              type:"POST",
              dataType: "json",
              data: {
                name: req1
              },
              success: function( data ) {
                response( data );
                //res = JSON.parse(data);
                res1 = data;
              }
          });
          return res1; 
      },
      minLength: 0,
      select: function( event, ui ) {
        //log( ui.item ?
//          "Selected: " + ui.item.label :
//          "Nothing selected, input was " + this.value);
      },
      open: function() {
        $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
      },
      close: function() {
        $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
      }
    }).focus(function(){
            if (this.value == "")
                {
                    $(this).catcomplete("search");
                }
        });
    
  }); 
  
      
  
  //txtProductTypeSearch
  </script>
  <!-- ham js chung cho tất cả các file 22/12/2014 -->
    