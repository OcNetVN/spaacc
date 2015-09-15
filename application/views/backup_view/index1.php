<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="<?php echo base_url('resources/front/Templates/template.dwt'); ?>" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>the Booking - Spa</title>
    <!-- InstanceEndEditable -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <?php require("head.php"); ?>
    
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
    <div class="full-bar wrap-banner" style="background-image:url(<?php echo base_url('resources/front/images/banner1.jpg'); ?>);">
        <div class="wrap-quick-booking">
            <div class="container">
                <h2 class="banner-title">WHERE WOULD YOU LIKE TO TAKE YOUR SPA?<br />GET STARTED BY REQUESTING A BRIEF TOUR</h2>
                <ul class="nav nav-tabs quick-booking-tab" role="tablist">
                  <li class="active"><a href="#book-treatment" role="tab" data-toggle="tab">Book Treatment</a></li>
                  <li><a href="#spa-day" role="tab" data-toggle="modal" data-target="#specialofferModal">BOOK A SPA DAY OR BREAK</a></li>
                </ul>
                
                <!-- Tab panes -->
                <div class="tab-content">
                  <div class="tab-pane active" id="book-treatment">
                      <form class="form" role="form">
                        <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12 wrap-control">
                            <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
                              <input id="txtProductTypeSearch" class="form-control" type="text" placeholder="Bạn muốn dịch vụ Spa nào?" value="">
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-md-4 col-sm-4 col-xs-6 wrap-control">
                            <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></div>
                                  <input id="txtLocationSearch" class="form-control" type="text" placeholder="Chọn địa điểm">
                                </div>
                              </div>
                        </div>
                        
                        <div class="col-md-2 col-sm-2 col-xs-6 wrap-control">
                            <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                  <input id="txtDateSearch" class="form-control datepicker" type="text" placeholder="Chọn ngày">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-2 col-sm-2 col-xs-12 wrap-control">
                            <button type="button" class="btn btn-default" onclick="Search3();">Tìm kiếm</button>
                        </div>
                        </div>
                    </form>
                  </div>
                  <div class="tab-pane" id="spa-day">
                      <form class="form" role="form">
                        <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12 wrap-control">
                            <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></div>
                              <input class="form-control" type="text" placeholder="Enter City or Region Name">
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-md-4 col-sm-4 col-xs-6 wrap-control">
                            <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                  <input class="form-control datepicker" type="text" placeholder="Any date">
                                </div>
                              </div>
                        </div>
                        
                        <div class="col-md-2 col-sm-2 col-xs-6 wrap-control">
                            <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon"><span class="glyphicon glyphicon-time"></span></div>
                                  <input class="form-control" type="text" placeholder="Any Duration">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-2 col-sm-2 col-xs-12 wrap-control">
                            <button type="submit" class="btn btn-default">SEARCH</button>
                        </div>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>        
    </div>
    <!-- InstanceEndEditable -->    
    
    <div class="container" style="padding-top:10px; padding-bottom:10px;">
    <!-- InstanceBeginEditable name="Main Content" -->
        <div class="row">
            <div class="col-md-6">
                <div class="service-box shadow-box">                
                    <div class="wrap-thumb" style="background-image:url(<?php echo base_url($HotNews['NewsImg']); ?>);">
    <!--                       <img src="images/business.jpg" width="980" height="400" alt="The Booking Spa" /> -->
                    </div>
                    <h3 class="box-title"><a href="javascript:void(0)" data-toggle="modal" data-target="#serviceModal">
                    <?php echo $HotNews['News']->Title; ?> 
                    </a></h3>
                    <?php echo $HotNews['News']->NewsBrief ."..."; ?> 
                    <div class="wrap-buttons"><button type="button" class="btn btn-default btn-grey" >XEM CHI TIẾT</button></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="service-box shadow-box">                
                    <div class="wrap-thumb" style="background-image:url(<?php echo base_url('resources/front/images/business.jpg'); ?>);">
    <!--                       <img src="images/business.jpg" width="980" height="400" alt="The Booking Spa" /> -->
                    </div>
                    <h3 class="box-title"><a href="javascript:void(0)" data-toggle="modal" data-target="#serviceModal">LOREM IPSUM DOLOR SIT AMET</a></h3>
                    Consectetur adipiscing elit. Suspendisse auctor, ipsum facilisis iaculis venenatis, tellus dolor consectetur enim, et semper nisl tortor ut erat. Ut feugiat elit odio. Nulla vitae mi in quam egestas scelerisque vitae quis metus.
                    <div class="wrap-buttons"><button type="button" class="btn btn-default btn-grey" data-toggle="modal" data-target="#serviceModal">BOOK NOW</button></div>
                </div>
            </div>
        </div>        
        
        <h1 class="title">SẢN PHẨM KHUYẾN MÃI <span class="title-small">NOW OR MISS IT (SAVE UP TO 60%)</span></h1>
        
        <div class="row">
            <div class="col-md-12 wrap-products">
                <?php
                    /*foreach($loaispcon as $loaicon)
                    {
                        //echo $loaicon->CommonId." "listproduct;
                        $sp = $this->m_index->lay1sptheoloai($loaicon->CommonId);
                        if(count($sp)>0)
                        {
                            $idsp=$sp->ProductID;
                            $_SESSION['idsp']=$idsp;*/
                ?>
                        <!--<div class="wrap-product shadow-box">
                            <a href="javascript:void(0)" onclick="showdetailpro('<?php //echo $idsp;?>');" data-toggle="modal" data-target="#serviceModal">
                                <div class="wrap-thumb" style="background-image:url(<?php                                 
                                 //$imglnk = $this->m_index->laylink($idsp); 
                                 //echo $imglnk;
                                 ?>);">
                                    <div class="wrap-sales">Save<br /><span class="amount">20%</span></div>
                                </div>
                            </a>
                            <div class="wrap-content">
                                <a href="javascript:void(0)" onclick="showdetailpro('<?php //echo $idsp;?>');" data-toggle="modal" data-target="#serviceModal">
                                    <h3 class="title"><?php //echo $sp->Name; ?></h3>
                                    <h4 class="shop"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> <?php //$this->m_index->layplace($idsp); ?></h4>               
                                </a>                       
                            </div>
                            <div class="wrap-buttons"><button type="button" onclick="showdetailpro('<?php //echo $idsp;?>');" class="btn btn-default btn-grey" data-toggle="modal" data-target="#serviceModal">BOOK</button></div>
                        </div>-->
                <?php
                        //}
                    //}
                ?>
                <?php
                    if(isset($listproduct) && count($listproduct)>0)
                    {
                        foreach($listproduct as $row_listproduct)
                        {
                                $idsp=$row_listproduct->ProductID;
                                $_SESSION['idsp']=$idsp;
                ?>
                                <div class="wrap-product shadow-box">
                                    <a href="javascript:void(0)" onclick="showdetailpro('<?php echo $idsp;?>');" data-toggle="modal" data-target="#serviceModal">
                                        <div class="wrap-thumb" style="background-image:url(<?php                                 
                                         $imglnk = $this->m_index->laylink($idsp); 
                                         echo $imglnk;
                                         ?>);">
                                            <div class="wrap-sales">Save<br /><span class="amount">20%</span></div>
                                        </div>
                                    </a>
                                    <div class="wrap-content">
                                        <a href="javascript:void(0)" onclick="showdetailpro('<?php echo $idsp;?>');" data-toggle="modal" data-target="#serviceModal">
                                            <h3 class="title"><?php echo $row_listproduct->Name; ?></h3>
                                            <h4 class="shop"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> <?php $this->m_index->layplace($idsp); ?></h4>               
                                        </a>                       
                                    </div>
                                    <div class="wrap-buttons"><button type="button" onclick="showdetailpro('<?php echo $idsp;?>');" class="btn btn-default btn-grey" data-toggle="modal" data-target="#serviceModal">BOOK</button></div>
                                </div>
                <?php
                        }
                    }
                    else
                        echo '<h3 class="title">Không có sản phẩm nào</h3>';
                ?>
            </div>
        </div>        
        
        <div class="row">
            <div class="col-xs-4">
                <div class="wrap-likebox">
                   <div class="fb-like-box" data-href="https://www.facebook.com/pages/BookingSpa/1735662483326180?ref=hl" data-colorscheme="light" data-width="280" data-height="260" data-show-faces="true" data-header="true" data-stream="false" data-show-border="false"></div>
                  
                </div>                
            </div>
            <div class="col-xs-8">
                <div class="wrap-likebox">
                    <div class="fb-like-box" data-href="https://www.facebook.com/pages/BookingSpa/1735662483326180?ref=hl" data-width="600" data-height="260" data-colorscheme="light" data-show-faces="false" data-header="true" data-stream="true" data-show-border="false"></div>
                 </div>
            </div>
        </div>
        

<?php require("booking.php"); ?>

<!-- Modal -->
<div class="modal fade" id="specialofferModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Special Offer</h4>
      </div>
      <div class="modal-body">
          <h1 class="title">SẢN PHẨM KHUYẾN MÃI</h1>
          <div class="row">
            <div class="col-md-12 wrap-products popup-products">
                <?php 
                    if(isset($listspkm) && count($listspkm)>0)
                    {
                        foreach($listspkm as $row_spkm)
                        {
                            foreach($row_spkm['listproduct'] as $row_spkm2)
                            {
                                //echo "<pre>";print_r($row_spkm2);echo "</pre>";die;
                                if(count($row_spkm2['hinh'])>0)
                                    $urlhinh=$row_spkm2['hinh']->URL;
                                else
                                    $urlhinh='resources/front/images/nospaimages.png';
                                if(isset($row_spkm2['diadiemspa']) && count($row_spkm2['diadiemspa'])!=0)
                                    $diadiem=$row_spkm2['diadiemspa']->StrValue1;
                                else
                                    $diadiem="Chưa có địa điểm";
                                echo '<div class="wrap-product shadow-box">';
                                    echo '<a href="javascript:void(0)" data-toggle="modal" data-target="#serviceModal">';
                                        echo '<div class="wrap-thumb" onclick="showdetailpro(\''.$row_spkm2['ttsp']->ProductID.'\');" style="background-image:url('.base_url($urlhinh).');">';
                                            echo '<div class="wrap-sales">Save<br /><span class="amount">20%</span></div>';
                                        echo '</div>';
                                    echo '</a>';
                                    echo '<div class="wrap-content">';
                                        echo '<a href="javascript:void(0)" data-toggle="modal" data-target="#serviceModal">';
                                            echo '<h3 class="title">'.$row_spkm2['ttsp']->Name.'</h3>';
                                            echo '<h4 class="shop"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> '.$diadiem.'</h4>';               
                                        echo '</a>';                        
                                    echo '</div>';
                                    echo '<div class="wrap-buttons"><button type="button" onclick="showdetailpro(\''.$row_spkm2['ttsp']->ProductID.'\');" class="btn btn-default btn-grey" data-toggle="modal" data-target="#serviceModal">BOOK</button></div>';
                                echo '</div>';
                            }
                        }
                    }
                    else
                        echo '<h3 class="title">Không có sản phẩm khuyến mãi nào</h3>';
                ?>
            </div>
        </div>
      </div>
</div>
<!-- End Modal -->
        
    <!-- InstanceEndEditable -->
    </div>
    
</header>

<?php
     require("footer.php");
?>


<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">
var switchTo5x=true;
stLight.options({
    publisher: "42ca428d-6cd0-4b93-b360-fa0d0bfa3696", 
    doNotHash: false, 
    doNotCopy: false, 
    hashAddressBar: false
});

</script> 
    
</body>
<!-- InstanceEnd --></html>
