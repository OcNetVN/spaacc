<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="<?php echo base_url('resources/front/Templates/template.dwt'); ?>" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>The Booking - Spa</title>
    <!-- InstanceEndEditable -->
    
    <?php require("head.php"); ?>
<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//v2.zopim.com/?2rhn5mv3FaQ6zM8uPOW8rnt611WoByrX';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zopim Live Chat Script-->
    
</head>

<body>
<!--<a href="https://plus.google.com/100814839491973152937" rel="publisher">Google+</a>-->
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
                <h2 class="banner-title">HỆ THỐNG ĐẶT CHỖ DỊCH VỤ SPA & BEAUTY SALON ĐẦU TIÊN TẠI VIỆT NAM<br />VỚI HƠN 1000 DỊCH VỤ LÀM ĐẸP ĐƯỢC CẬP NHẬT MỖI NGÀY</h2>
                <ul class="nav nav-tabs quick-booking-tab" role="tablist">
                  <li class="active"><a href="#book-treatment" role="tab" data-toggle="tab">Đặt chỗ</a></li>
                  <li><a href="#spa-day" role="tab" data-toggle="modal" data-target="#specialofferModal">KHUYẾN MÃI</a></li>
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
                              <input id="txtProductTypeSearch" class="form-control" type="text" placeholder="Bạn muốn tìm kiếm dich vụ gi?" value="">
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
                <div class="service-box shadow-box " style="height: 410px;">  
                <div id="myCarousel1" class="carousel slide"  data-interval="3000" data-ride="carousel">      
                    <div class="carousel-inner"> 
                        <?php
                             for($i = 0; $i < count($listnew); $i++){
                                if($i == 0){ ?>
                                  <div class="active item">  
                               <?php }else{  ?>
                                    <div class="item">
                                 <?php }  ?>
                                <!--<div class="active item">-->
                                    <?php 
                                        $urlnews="News/index/".$listnew[$i]->id;
                                     ?>
                                    
                                    <div class="wrap-thumb1" style="background-image:url(<?php $imglnk = $this->m_news->laylinkImages($listnew[$i]->id);echo $imglnk;?>);background-size: 541px 200px;"></div>  
                                     <h3 class="box-title1">
                                        <a href="<?php echo base_url($urlnews); ?>"><?php echo $listnew[$i]->Title1; ?> </a>
                                     </h3>                                        
                                     <span class="spanNewsDetail"> 
                                         <?php echo $listnew[$i]->NewsBrief1; ?>
                                     </span>
                                     <div class="wrap-buttons"><form method="GET" action="<?php echo base_url($urlnews); ?>"><input type="hidden" value="<?php echo $HotNews['News']->id; ?>" /><button type="submit" class="btn btn-default btn-grey" >XEM CHI TIẾT</button></form></div>
                                </div> 
                         <?php }?>
                    </div>
                    <a class="carousel-control left" href="#myCarousel1" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="carousel-control right" href="#myCarousel1" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="service-box shadow-box" style="height: 410px;">                                 
                    <div id="myCarousel" class="carousel slide" data-interval="4000" data-ride="carousel">
                    <!-- Carousel indicators -->
                      
                   <!-- Carousel items -->
                    <div class="carousel-inner">
                     <!-- show infomation KM cho sản phẩm  ngày 17/01/2015-->
                      <?php   if(isset($listproPromo) && count($listproPromo) > 0)
                              {                             
                                foreach($listproPromo as $key=>$arr_pro)
                                {
                                    $idsp = $arr_pro->ProductId;
                                    $_SESSION['idsp']=$idsp;
                                    //echo date("Y-m-d H:m:s");
                                    //$promotionid=$arr_pro->PromotionId;
                                    $nowtime=strtotime(date("Y-m-d H:m:s"));
                                    if(strtotime($arr_pro->BeginDateTime)<=$nowtime && $nowtime<=strtotime($arr_pro->EndDateTime))
                                    {
                                        $promotionid=$arr_pro->PromotionId;
                                        $price=$this->m_index->laygiasp_theomasp($idsp);
                                        $a=(($price->Price)-($arr_pro->Price))/($price->Price)*100;
                                        $savepercent=round($a); 
                                        
                                        
                                     if($key == 0){  ?>
                                           <div class="active item">
                               <?php      }else{    ?>
                                           <div class="item">
                                <?php     }
                                     ?> 
                                     
                                      <!--<div class="active item"> -->
                                        
                                        <div class="wrap-thumb1" style="background-image:url(<?php $imglnk = $this->m_index->laylink($idsp);echo $imglnk;?>);background-size: 541px 200px;"></div>
                                            <h3 class="box-title1"><a href="javascript:void(0)" data-toggle="modal" data-target="#serviceModal"><?php echo $arr_pro->PromotionName;?></a>  
                                            <br />
                                            <img src="<?php echo base_url('resources/front/images/discount.png'); ?>" alt="Giảm giá" />                                            
                                            <span class="spanDiscountPM"> <?php echo $savepercent;?>%</span> </h3>
                                            <span class="spanNewsDetail"><?php echo $this->m_index->layspaname_theoproductid($idsp)->spaName; ?><?php echo $this->m_index->layspaname_theoproductid($idsp)->info1; ?> </span>
                                            <div class="wrap-buttons"><button type="button" class="btn btn-default btn-grey" onclick="showdetailpro('<?php echo $idsp;?>','<?php echo $promotionid ?>');" data-toggle="modal" data-target="#serviceModal">BOOK NOW</button></div>
                                      </div> 
                            <?php   }
                                    
                                }
                              }
                        ?>
                        
                        <!--<div class="active item">
                            <h2 class="h2carousel">Slide 2</h2>
                            <div class="wrap-thumb" style="background-image:url(<?php echo base_url('resources/front/images/business.jpg'); ?>);">                
                                </div>
                                <h3 class="box-title1"><a href="javascript:void(0)" data-toggle="modal" data-target="#serviceModal">LOREM IPSUM DOLOR SIT AMET</a></h3>
                                <span class="spanNewsDetail">Consectetur adipiscing elit. Suspendisse auctor, ipsum facilisis iaculis venenatis, tellus dolor consectetur enim, et semper nisl tortor ut erat. Ut feugiat elit odio. Nulla vitae mi in quam egestas scelerisque vitae quis metus.
                                </span>
                                <div class="wrap-buttons"><button type="button" class="btn btn-default btn-grey" data-toggle="modal" data-target="#serviceModal">BOOK NOW</button></div>
                        </div>   -->
                        <!--<div class="item">
                            <h2 class="h2carousel">Slide 3</h2>
                            <div class="wrap-thumb" style="background-image:url(<?php echo base_url('resources/front/images/business.jpg'); ?>);">
                                </div>
                                <h3 class="box-title1"><a href="javascript:void(0)" data-toggle="modal" data-target="#serviceModal">LOREM IPSUM DOLOR SIT AMET</a></h3>
                                <span class="spanNewsDetail">Consectetur adipiscing elit. Suspendisse auctor, ipsum facilisis iaculis venenatis, tellus dolor consectetur enim, et semper nisl tortor ut erat. Ut feugiat elit odio. Nulla vitae mi in quam egestas scelerisque vitae quis metus.
                                </span>
                                <div class="wrap-buttons"><button type="button" class="btn btn-default btn-grey" data-toggle="modal" data-target="#serviceModal">BOOK NOW</button></div>
                        </div> -->
                    </div>
                    <!-- Carousel nav -->
                    <a class="carousel-control left" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="carousel-control right" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
                </div>
            </div>
        </div>        
        
        <h1 class="title">NHANH TAY CHỌN DỊCH VỤ GIẢM GIÁ LÊN TỚI 60%</h1>
        
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
                                $promotionid=0;
                                $idsp=$row_listproduct->ProductID;
                                /*echo "<pre>";
                                    print_r($row_listproduct);
                                echo "</pre>";*/
                                //echo $idsp;
                                $_SESSION['idsp']=$idsp; //cai nay k pit ai luu, luu de lam gi??
                                            
                                            //khuyen mai
                                            /*$dsspkhuyenmai=$this->m_index->laylist_khuyenmaivang();
                                            $flagkhuyenmai=0;
                                            $savepercent=0;
                                            //$flagkhuyenmai = 1: khuyen mai vang
                                            //$flagkhuyenmai = 2: khuyen mai thuong
                                            foreach($dsspkhuyenmai as $row_spkhuyenmai)
                                            {
                                                if($row_spkhuyenmai->ProductId==$idsp)
                                                {
                                                    //echo date("Y-m-d H:m:s");
                                                    $nowtime=strtotime(date("Y-m-d H:m:s"));
                                                    if(strtotime($row_spkhuyenmai->BeginDateTime)<=$nowtime && $nowtime<=strtotime($row_spkhuyenmai->EndDateTime))
                                                    {
                                                        $promotionid=$row_spkhuyenmai->PromotionId;
                                                        $price=$this->m_index->laygiasp_theomasp($idsp);
                                                        $a=(($price->Price)-($row_spkhuyenmai->Price))/($price->Price)*100;
                                                        $savepercent=round($a);
                                                        $flagkhuyenmai=1;
                                                        break;
                                                    }
                                                }
                                            }*/
                                            
                                            //nghia viet them 23/01/2015
                                            //hien tai km nao cung giong nhau
                                            $dsspkhuyenmai=$this->m_index->laylist_khuyenmai();
                                            $flagkhuyenmai=0;
                                            $savepercent=0;
                                            //$flagkhuyenmai = 1: khuyen mai
                                            foreach($dsspkhuyenmai as $row_spkhuyenmai)
                                            {
                                                if($row_spkhuyenmai->ProductId==$idsp)
                                                {
                                                    //echo date("Y-m-d H:m:s");
                                                    $nowtime=strtotime(date("Y-m-d H:m:s"));
                                                    if(strtotime($row_spkhuyenmai->BeginDateTime)<=$nowtime && $nowtime<=strtotime($row_spkhuyenmai->EndDateTime))
                                                    {
                                                        $promotionid=$row_spkhuyenmai->PromotionId;
                                                        $price=$this->m_index->laygiasp_theomasp($idsp);
                                                        $a=(($price->Price)-($row_spkhuyenmai->Price))/($price->Price)*100;
                                                        $savepercent=round($a);
                                                        $flagkhuyenmai=1;
                                                        break;
                                                    }
                                                }
                                            }
                                            //end nghia viet them 23/01/2015
                ?>
                                <div class="wrap-product shadow-box">
                                    <a href="javascript:void(0)" onclick="showdetailpro('<?php echo $idsp;?>','<?php echo $promotionid ?>');" data-toggle="modal" data-target="#serviceModal">
                                        <div class="wrap-thumb" style="background-image:url(<?php $imglnk = $this->m_index->laylink($idsp);echo $imglnk;?>);">
                                         <?php 
                                            if($flagkhuyenmai==1 || $flagkhuyenmai=="1") //< ngay 23/01/2015:khuyen mai vang, ngay 23/01/2015: khuyen mai
                                            {
                                                
                                                echo '<div class="wrap-sales">Save<br /><span class="amount">'.$savepercent.'%</span></div>';
                                            }
                                            else
                                            {
                                                if($flagkhuyenmai==2 || $flagkhuyenmai=="2") //khuyen mai thuong, ngay 23/01/2015: k use cai nay nua
                                                {
                                                }
                                                else //khong khuyen mai
                                                {
                                                    
                                                }
                                            }
                                         ?>
                                            
                                        </div>
                                    </a>
                                    <div class="wrap-content">
                                        <a href="javascript:void(0)" onclick="showdetailpro('<?php echo $idsp;?>','<?php echo $promotionid ?>');" data-toggle="modal" data-target="#serviceModal">
                                            <h3 class="title"><?php echo $row_listproduct->Name; ?></h3>
                                            <h6><?php echo $this->m_index->layspaname_theoproductid($idsp)->spaName; ?></h6>
                                            <h4 class="shop"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> <?php $this->m_index->layplace($idsp); ?></h4>               
                                        </a>                       
                                    </div>
                                    <div class="wrap-buttons"><button type="button" onclick="showdetailpro('<?php echo $idsp;?>','<?php echo $promotionid ?>');" class="btn btn-default btn-grey" data-toggle="modal" data-target="#serviceModal">BOOK</button></div>
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
            <div class="col-xs-5">
                <div class="wrap-likebox">
                   <div class="fb-like-box" data-href="https://www.facebook.com/pages/BookingSpa/1735662483326180?ref=hl" data-colorscheme="light" data-width="350" data-height="260" data-show-faces="true" data-header="true" data-stream="false" data-show-border="false"></div>
                </div>                
            </div>
            <div class="col-xs-7">
                <div class="wrap-likebox">
                    <div class="bottomborder1 uiBoxLightblue1">
                       <span class="tieudeyoutube">Youtube Chanel</span>
                   </div>
                   <div style="margin-top:10px;">
                   <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 60%; }</style><div class='embed-container'><iframe src="<?php echo $linkyoutube; ?>" frameborder='0' allowfullscreen></iframe></div>
                       
                        <!--<div class="fb-like-box" data-href="https://www.facebook.com/pages/BookingSpa/1735662483326180?ref=hl" data-width="650" data-height="260" data-colorscheme="light" data-show-faces="false" data-header="true" data-stream="true" data-show-border="false"></div> -->
                    </div>
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
        <h4 class="modal-title" id="myModalLabel">NHANH TAY CHỌN CÁC DỊCH VỤ KHUYẾN MÃI VỚI GIÁ SỐC</h4>
      </div>
      <div class="modal-body">
          <!--<h1 class="title">SẢN PHẨM KHUYẾN MÃI</h1>-->
          <div class="row">
            <div class="col-md-12 wrap-products popup-products">
                <?php 
                    if(isset($listspkm) && $listspkm!=-1 && $listspkm!="") //theo yeu cau thi da sua lai cai nay chi gom khuyen mai vang thoi chu khong phai la tat ca khuyen mai
                    {
                        //ngay 4/2/2015 doi thanh tat ca sp km
                        //print_r($listspkm);die;
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
                                
                                            //khuyen mai
                                            $promotionid=0;
                                            $idsp=$row_spkm2['ttsp']->ProductID;
                                            //$dsspkhuyenmai=$this->m_index->laylist_khuyenmaivang();
                                            $dsspkhuyenmai=$this->m_index->laylist_khuyenmai();
                                            $flagkhuyenmai=0;
                                            $savepercent=0;
                                            //$flagkhuyenmai = 1: khuyen mai vang
                                            //$flagkhuyenmai = 2: khuyen mai thuong
                                            //ngay 4/2/2015: khong con la khuyen mai vang nua ma la tat ca khuyen mai
                                            foreach($dsspkhuyenmai as $row_spkhuyenmai)
                                            {
                                                if($row_spkhuyenmai->ProductId==$idsp)
                                                {
                                                    //echo date("Y-m-d H:m:s");
                                                    $nowtime=strtotime(date("Y-m-d H:m:s"));
                                                    if(strtotime($row_spkhuyenmai->BeginDateTime)<=$nowtime && $nowtime<=strtotime($row_spkhuyenmai->EndDateTime))
                                                    {
                                                        $promotionid=$row_spkhuyenmai->PromotionId;
                                                        $price=$this->m_index->laygiasp_theomasp($idsp);
                                                        $a=(($price->Price)-($row_spkhuyenmai->Price))/($price->Price)*100;
                                                        $savepercent=round($a);
                                                        $flagkhuyenmai=1;
                                                        break;
                                                    }
                                                }
                                            }
                                            //end khuyen mai
                                echo '<div class="wrap-product shadow-box">';
                                    echo '<a href="javascript:void(0)" data-toggle="modal" data-target="#serviceModal">';
                                        echo '<div class="wrap-thumb" onclick="showdetailpro(\''.$idsp.'\',\''.$promotionid.'\');" style="background-image:url('.base_url($urlhinh).');">';
                                        
                                            //khuyen mai
                                            if($flagkhuyenmai==1 || $flagkhuyenmai=="1") //khuyen mai vang
                                            {
                                                
                                                echo '<div class="wrap-sales">Save<br /><span class="amount">'.$savepercent.'%</span></div>';
                                            }
                                            else
                                            {
                                                if($flagkhuyenmai==2 || $flagkhuyenmai=="2") //khuyen mai thuong
                                                {
                                                }
                                                else //khong khuyen mai
                                                {
                                                    
                                                }
                                            }
                                            //end khuyen mai
                                            
                                        echo '</div>';
                                    echo '</a>';
                                    echo '<div class="wrap-content">';
                                        echo '<a href="javascript:void(0)" data-toggle="modal" data-target="#serviceModal">';
                                            echo '<h3 class="title">'.$row_spkm2['ttsp']->Name.'</h3>';
                                            echo '<h6>'.$this->m_index->layspaname_theoproductid($idsp)->spaName.'</h6>';
                                            echo '<h4 class="shop"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> '.$diadiem.'</h4>';               
                                        echo '</a>';                        
                                    echo '</div>';
                                    echo '<div class="wrap-buttons"><button type="button" onclick="showdetailpro(\''.$idsp.'\',\''.$promotionid.'\');" class="btn btn-default btn-grey" data-toggle="modal" data-target="#serviceModal">BOOK</button></div>';
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