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
    
	<script type="text/javascript" src="<?php echo base_url('resources/front/js/checkout3.js'); ?>"></script>
</head>

<body>
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
    	<h1 class="page-title-bar">Check Out: Step 3/3</h1>
        
        <h3>Your Shopping Cart</h3>
        <div class="wrap-table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
            <tr>
              <th>No</th>
              <th>Service</th>
              <th>Date & Time</th>
              <th>Location</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Money</th>
            </tr>
            <?php 
                $arr_pro = $_SESSION['Cart'];
                //print_r($_SESSION['Cart']);
                $i=0;
                $totalmoney=0;
                foreach($_SESSION['Cart'] as $row_pro)
                {
                    //$proid = $arr_pro['ProductID'];
                    $stt=$i+1;
                    echo '<tr id="trBookingTemp'.$row_pro['ProductID'].'">';
                    echo "<td>".$stt."</td>";
                    echo '<td><a href="javascript:void(0);" data-toggle="modal" data-target="#serviceModal">'.$row_pro['ProductName'].'</a></td>';
                    echo ' <td>Từ: <span>'.$row_pro['FromTime'].'</span> đến <span>'.$row_pro['ToTime'].'</span></td>';
                    echo '<td> Tên Spa: <span>'.$row_pro['spaName'].'</span><br /> Địa chỉ <span>'.$row_pro['SpaAdd'].'</span></td>';
                    echo '<td><span>'.$row_pro['Qty'].'</span></td>';   
                    echo '<td nowrap="nowrap"><span>'.number_format($row_pro['Price']).'</span> VNĐ';
                    echo '</td>';
                    echo '<td><span>'.number_format($row_pro['AmtBT']).'</span> VNĐ';
                    echo '</td>';
                    echo '</tr>';
                    $i++;
                    $totalmoney+=$row_pro['AmtBT'];
                }
                 ?>
            <tr>
              <td colspan="5" align="right"><span style="font-size:15px;"><strong>TOTAL:</strong></span></td>
              <td colspan="2" nowrap="nowrap"><strong><span style="font-size:15px;"><?php echo number_format($totalmoney); ?></span> VND</strong></td>
            </tr>
          </table>
        </div>
        
        <h3>Payment Method</h3>
        
        <p>Pay with: <span id="paywith"><?php if(isset($paywith) && $paywith!=0 && $paywith !="") echo $paywith; ?></span></p>
        
        <br />
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><button type="submit" class="btn btn-danger pull-right" onClick="parent.location='check-out-finish.html'">Place Order</button></td>
          </tr>
        </table>
        
    
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
