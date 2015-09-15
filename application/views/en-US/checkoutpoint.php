<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- InstanceBeginEditable name="doctitle" -->
	<title>the Booking - Spa</title>
	<!-- InstanceEndEditable -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('resources/front/favicon.ico'); ?>" />
    <?php require("head.php"); ?>
    <script type="text/javascript" src="<?php echo base_url('resources/front/js/checkoutpoint.js'); ?>"></script>
</head>

<body>
<?php require("loadloading.php"); ?>
<header>
    <div class="navbar" role="navigation">
        <div class="full-bar top-bar">
            <div class="container">
                    <div class="row">
                        <?php
                             require("header.php");
                         ?>
                    </div>                    
            </div>
        </div>
        <div class="clearfix"></div>
        <?php
             require("headersearch.php");
         ?>
      
    </div>
    
    <?php
             require("menu.php");
    ?>
    <div class="clearfix"></div>
    
	<!-- InstanceBeginEditable name="Full Content" -->
    <!-- InstanceEndEditable -->    
    
    <div class="container" style="padding-top:10px; padding-bottom:10px;">
    <!-- InstanceBeginEditable name="Main Content" -->
    <div id="loadcontent1">
    	<h1 class="page-title-bar">Check Out: Step Point</h1>
        
        <div class="tab-content">
        <?php
            $continue=0;
            if(isset($arrdiemuser))
            {
                $tongtien=0;
                if(isset($_SESSION['Cart']) && count($_SESSION['Cart'])>0)
                {
                    foreach($_SESSION['Cart'] as $row_cart)
                    {
                        foreach($row_cart['list_product'] as $row_listproduct)
                        {
                            $tongtien+=$row_listproduct['Price']*$row_listproduct['Qty'];
                        }
                    }
                }
                $ScoreRate=$this->m_checkout->ScoreRate()->NumValue1;
                $diemcanco=ceil($tongtien/$ScoreRate);
                /*echo $arrdiemuser['rowpoint']."<br />";
                echo $diemcanco."<br />";
                echo $tongtien;die;*/
                
                if($diemcanco <= $arrdiemuser['rowpoint'])
                {
                    $continue=1;
                    $diemconlai=$arrdiemuser['rowpoint']-$diemcanco;
                    echo "<h5>Tổng điểm phải trả là ".number_format($diemcanco)."</h5>";
                    echo "<h5>Điểm còn lại là ".number_format($diemconlai)."</h5>";
                }
                else
                {
                    echo "<h4> Bạn không đủ điểm để thực hiện gia dịch này</h4>";
                    
                }
            }
         ?>
       	</div>
        <br />
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><button type="submit" class="btn btn-danger" onClick="parent.location='<?php echo base_url("checkout1"); ?>'">Back</button></td>
            <?php
                if($continue==1 || $continue=="1")
                {
                    echo '<td><button type="submit" class="btn btn-danger pull-right" onClick="checkpointgotostep3();">Continue</button></td>';
                }
             ?>
            
          </tr>
        </table>
       </div> 
       <!--step 3-->
       <div id="loadcontent2" style="display: none;">
       
       </div>
       <div id="loadtb" class="col-md-8 col-md-offset-2" style="display: none; color: green; font-weight: bold;">
       
       </div>
        <!--end step 3-->
    
	<!-- InstanceEndEditable -->
    </div>
    <?php require("booking.php"); ?>
</header>

<?php
     require("footer.php");
 ?> 


<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "42ca428d-6cd0-4b93-b360-fa0d0bfa3696", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script> 
    
</body>
<!-- InstanceEnd --></html>
