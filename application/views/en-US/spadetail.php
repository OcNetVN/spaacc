<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <title>the Booking - Spa - <?php echo $ttspa->spaName; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta property="og:description" content="<?php echo strip_tags(substr($ttspa->Intro,0,250)). "..."; ?>" />
    <meta property="og:title" content="<?php echo $ttspa->spaName;?>" />
     <meta property="og:image" content=" <?php 
                            if(isset($hinhspa) && count($hinhspa)>0)
                            {        
                                echo base_url($hinhspa[0]->URL);
                            }
                            ?>" />
    <meta property="og:image:width" content="420" /> 
    <meta property="og:image:height" content="242" />
    <meta property="og:url" content="http://spa.thebooking.vn/" />
    <meta property="og:site_name" content="Spa booking online" />
    <meta property="fb:app_id" content="1562058260674106" />
    <link rel="icon" href="<?php echo base_url('resources/front/favicon.ico'); ?>" />
    <?php require("head.php"); ?>
    <script src="<?php echo base_url('resources/front/js/spadetail.js'); ?>"></script>
    <!-- InstanceBeginEditable name="head" -->
  		<script src="<?php echo base_url('resources/front/js/jquery-ui.min.js'); ?>"></script>
		<link href="<?php echo base_url('resources/front/css/jquery-ui.theme.min.css'); ?>" rel="stylesheet" type="text/css" />
        <script>
       
		  $(function() {
			$( "#accordion" ).accordion({
			  heightStyle: "content"
			});
			$( "#accordion-popup" ).accordion({
			  heightStyle: "content"
			});
            
		  });
          $(document).ready(function(){                 
                $('.product_banner').bxSlider({
                    auto: true       
                  });
                                      
            });
		</script>
    <!-- InstanceEndEditable -->
    
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
    	<div class="product-top-box box-padding">
        	<h1 class="title"><?php echo $ttspa->spaName; ?>
            	<div class="wrap-button-like"><!--<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.aotambikini.com&amp;layout=button_count&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp" style="overflow:hidden;width:100%;height:80px;" scrolling="no" frameborder="0" allowTransparency="true"></iframe>-->
                <div id="fb-root"></div>
                <div class="fb-like" data-href="<?php echo $link_spainfo; ?>" data-layout="button_count"  data-action="like" data-show-faces="true" data-share="false"></div>
                
                </div>
            </h1>
            <div class="shop-location">
                <?php echo $ttspa->Address; ?>
            </div>
            <div class="wrap-2cols">
            	<div class="col-content">
                	<div class="content">
                        <?php 
                            if(isset($hinhspa) && count($hinhspa)>0)
                            {
                                echo '<ul id="product-banner" class="product_banner">';
                                foreach($hinhspa as $row_hinh)
                                {
                                    echo '<li><div class="banner-pic" style="background-image:url('.base_url($row_hinh->URL).');"></div></li>';
                                }
                                echo '</ul>';
                            }
                        ?>
                    	<!--<ul id="product-banner">
                          <li><div class="banner-pic" style="background-image:url(images/Spa-Massage.jpg);"></div></li>   
                           <li><div class="banner-pic" style="background-image:url(images/SpaPackages1.jpg);"></div></li>                        
                        </ul>-->
                    </div>                	
                </div>
                <div class="col-nav"> 
                    <h4 style="text-transform:uppercase; width:100%; clear:both;">Giới thiệu</h4>
                    <?php 
                        if(isset($ttspa->Intro) && $ttspa->Intro!="") //gioi thieu
                        {
                            echo substr($ttspa->Intro,0,250);
                            echo '<p><a href="javascript:void(0);" onclick="bookmarkgioithieu();">Xem thêm…</a></p>';
                        }
                        else
                        {
                            echo "Chưa có";
                        }
                    ?>
                    <!--<br />
					Tagged as: <a href="#">Hotel Spa</a> | <a href="#">Day Spa</a> | <a href="#">Fitness Centre</a>-->
                </div>                                
            </div>
        </div>
        <script type="text/javascript">
			
		</script>
        
        <div class="wrap-2cols spa-detail">
            	<div class="col-content">
                	<div class="content">
                    	<!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                          <li><a href="#overview" role="tab" data-toggle="tab" >Tổng quan</a></li>
                          <li class="active"><a href="#services" role="tab" data-toggle="tab">Dịch vụ, sản phẩm</a></li>
                          <li><a href="#reviews" role="tab" data-toggle="tab">Bình luận (<span class="fb-comments-count" data-href="<?php echo $link_spainfo; ?>"></span>)</a></li>
                        </ul>
                        
                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div class="tab-pane" id="overview">
                              <?php
                                    if(isset($ttspa->Intro) && $ttspa->Intro!="") //gioi thieu
                                    {
                                        echo "<h3 id=\"bookmark_gioithieu\" name=\"bookmark_gioithieu\">Giới thiệu</h3>";
                                        echo '<p>'.$ttspa->Intro.'</p>';
                                    }
                                    if(isset($ttspa->Note) && $ttspa->Note!="") //ghi chu
                                    {
                                        echo "<h3>Ghi chú</h3>";
                                        echo '<p>'.$ttspa->Note.'</p>';
                                    }
                                    if(isset($info) && count($info)>0) //tien ich cua spa
                                    {
                                        echo "<h3>Tiện ích</h3>";
                                        echo '<p>';
                                            foreach($info as $row_info)
                                            {
                                                echo "- ".$row_info->StrValue1." ".$row_info->value."<br />"; //- wifi : wifi1
                                            }
                                        echo '</p>';
                                    }
                                    if(isset($spatype) && $spatype!="") //tien ich cua spa
                                    {
                                        echo "<h3>Loại spa, hình thức Spa</h3>";
                                        echo "- ".$spatype;
                                    }
                                    
                               ?>

                          </div>
                          <div class="tab-pane active" id="services">
                                <?php 
                                    if(!isset($arr_protype_pro) || (isset($arr_protype_pro) && count($arr_protype_pro)==0)) 
                                        echo "<h3>Không có dịch vụ nào</h3>";
                                    else
                                    {
                                ?>
                                <div id="accordion">
                                    <?php 
                                        foreach($arr_protype_pro as $name_protype=>$list_pro)
                                        {
                                            if(isset($list_pro) && count($list_pro)>0)
                                            {
                                                echo "<h3>".$name_protype."</h3>";
                                                echo '<div>';
                                                    echo '<table class=" table table-striped table-hover wrap-product-lists" width="100%" border="0" cellspacing="0" cellpadding="5">';
                                                        //print_r($list_pro);
                                                        foreach($list_pro as $row_list_pro)
                                                        {
                                                            //khuyen mai
                                                            $promotionid=0;
                                                            $idsp=$row_list_pro->ProductID;
                                                            $dsspkhuyenmai=$this->m_index->laylist_khuyenmaivang();
                                                            $flagkhuyenmai=0;
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
                                                                        $flagkhuyenmai=1;
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            //end khuyen mai
                                                            echo '<tr class="product-item">';
                                                            // viết khuyến mãi  % cho danh sách sản phẩm có khuyến mãi 
                                                            $listPromo = $this->m_spadetail->getPromotion($idsp);
                                                            $savepercent=0;
                                                            if(count($listPromo) > 0)
                                                            {
                                                                $a=(($row_list_pro->Price)-($listPromo[0]->Price))/($row_list_pro->Price)*100;
                                                                $savepercent=round($a);
                                                                echo '<td class="item-title"><a href="javascript:void(0);"><span onclick="showdetailpro(\''.$idsp.'\',\''.$listPromo[0]->PromotionId.'\');" data-toggle="modal" data-target="#serviceModal">'.$row_list_pro->Name.'</span></a></td>';
                                                                echo '<td class="item-discount">'.number_format($listPromo[0]->Price).' VNĐ <span class="savings">Giảm<span class="title"></span><span class="value">'.$savepercent.'%</span></span></td>';
                                                                echo '<td class="item-price"><button class="btn btn-default" onclick="showdetailpro(\''.$idsp.'\',\''.$listPromo[0]->PromotionId.'\');" data-toggle="modal" data-target="#serviceModal">BOOK</button></td>';
                                                            }
                                                            else{
                                                                echo '<td class="item-title"><a href="javascript:void(0);"><span onclick="showdetailpro(\''.$idsp.'\',\''.$promotionid.'\');" data-toggle="modal" data-target="#serviceModal">'.$row_list_pro->Name.'</span></a></td>';
                                                                echo '<td class="item-discount">'.number_format($row_list_pro->Price).' VNĐ</td>';
                                                                echo '<td class="item-price"><button class="btn btn-default" onclick="showdetailpro(\''.$idsp.'\',\''.$promotionid.'\');" data-toggle="modal" data-target="#serviceModal">BOOK</button></td>';
                                                            }
                                                               
                                                            echo '</tr>';
                                                        }
                                                    echo '</table>';
                                                echo '</div>';
                                            }
                                        }
                                    ?>
                                </div>
                                <?php } ?>
                          </div>
                          <div class="tab-pane" id="reviews">
                          		<h3>Reviews</h3>
                                <h6 style="font-weight:bold;"><span class="fb-comments-count" data-href="<?php echo $link_spainfo; ?>"></span>  <b>comments</b></h6>
                                <div class="fb-comments" data-href="<?php echo $link_spainfo; ?>" data-numposts="5" data-colorscheme="light">
                                </div>
                                <button class="btn btn-default pull-right" onClick="$('#addcomment__0').toggle(300);">Write a review</button>
                                
                                <div id="addcomment__0" style="display: none" class="wrap-add-comment">
                                    <form role="form">
                                        <div class="form-group">
                                            <label>Nội dung bình luận</label>
                                            <textarea class="form-control" rows="3" id="contentaddcmt_0"></textarea>
                                        </div>
                                        <button type="button" class="btn btn-default pull-right" onclick="btnsendcomment(0,<?php echo $ttspa->spaID; ?>);">Gửi bình luận</button>
                                    </form>
                                </div>  
                            
                                <div class="wrap-review-list">
                                <?php 
                                    if(isset($arr_cmt) && count($arr_cmt)>0)
                                    {
                                        foreach($arr_cmt as $cmt1=>$list_cmt2)
                                        {
                                            $arr_cmt1=explode('___',$cmt1);
                                            $contentcmt1=$arr_cmt1[2];
                                            $idcmt1=$arr_cmt1[0];
                                            $namecmt1=$arr_cmt1[1]; 
                                            echo '<div class="wrap-2cols nav-left wrap-review">';
                                                echo '<div class="col-nav">';
                                                    echo '<div class="wrap-thumb" style="background-image:url('.base_url('resources/front/images/nouserimages.png').'"> </div>';
                                                echo '</div>';
                                                echo '<div class="col-content">';
                                                    echo '<div class="content">';
                                                        echo '<table width="100%" border="0" cellspacing="0" cellpadding="2">';
                                                          echo '<tr>';
                                                            echo '<td><strong>'.$namecmt1.'</strong></td>';
                                                            echo '<td align="right"><span class="small">Posted 4 weeks ago</span></td>';
                                                          echo '</tr>';
                                                          echo '<tr>';
                                                            echo '<td>&nbsp;</td>';
                                                            echo '<td align="right"><small class="small">Visisted October 2014</small></td>';
                                                          echo '</tr>';
                                                          echo '<tr>';
                                                            echo '<td colspan="2">';
                                                               echo $contentcmt1;
                                                            echo '</td>';
                                                          echo '</tr>';
                                                          echo '<tr>';
                                                            echo '<td colspan="2" align="right"><a href="javascript:void(0)" onClick="$(\'#addcomment__'.$idcmt1.'\').toggle(300);">Comment</a></td>';
                                                            
                                                            echo '<td colspan="2">';    
                                                                echo '<tr>';
                                                                  	echo '<td colspan="2">';
                                                                    	echo '<div id="addcomment__'.$idcmt1.'" style="display: none" class="wrap-add-comment">';
                                                                            echo '<form role="form">';
                                                                                echo '<div class="form-group">';
                                                                                    echo '<label>Nội dung bình luận</label>';
                                                                                    echo '<textarea class="form-control" rows="3" id="contentaddcmt_'.$idcmt1.'"></textarea>';
                                                                                echo '</div>';
                                                                                echo '<button type="button" class="btn btn-default pull-right" onclick="btnsendcomment('.$idcmt1.','.$ttspa->spaID.');">Gửi bình luận</button>';
                                                                            echo '</form>';
                                                                          echo '</div>';
                                                                    echo '</td>';
                                                                echo '</tr>';
                                                            echo '</td>';
                                                            if(count($list_cmt2)>0)
                                                            {
                                                                echo '<td colspan="2">'; //cmt con
                                                                foreach($list_cmt2 as $row_cmt2)
                                                                {
                                                                    echo '<div class="wrap-2cols nav-left wrap-review">';
                                                                        echo '<div class="col-nav">';
                                                                            echo '<div class="wrap-thumb" style="background-image:url('.base_url('resources/front/images/nouserimages.png').');"> </div>';
                                                                        echo '</div>';
                                                                        echo '<div class="col-content">';
                                                                            echo '<div class="content">';
                                                                                echo '<table width="100%" border="0" cellspacing="0" cellpadding="2">';
                                                                                  echo '<tr>';
                                                                                    echo '<td><strong>'.$row_cmt2->FullName.'</strong></td>';
                                                                                    echo '<td align="right"><span class="small">Posted 4 weeks ago</span></td>';
                                                                                  echo '</tr>';
                                                                                  echo '<tr>';
                                                                                    echo '<td>&nbsp;</td>';
                                                                                    echo '<td align="right"><small class="small">Visisted October 2014</small></td>';
                                                                                  echo '</tr>';
                                                                                  echo '<tr>';
                                                                                    echo '<td colspan="2">';
                                                                                        echo $row_cmt2->Content;
                                                                                    echo '</td>';
                                                                                  echo '</tr>';
                                                                                echo '</table>';
                                        
                                                                            echo '</div>';
                                                                        echo '</div>';
                                                                    echo '</div>';
                                                                }
                                                                echo '</td>'; //end cmt con
                                                            }
                                                          echo '</tr>';
                                                        echo '</table>';
                                                    echo '</div>';
                                                echo '</div>';
                                            echo '</div>';
                                        }
                                    }
                                    
                                ?>
                                </div>
                                
                                
                          </div>
                        </div><!-- End Tab Content -->
                         <br />
                        <h3>Các spa khác</h3>
                        <div class="wrap-products1 related-products">
                            <?php if(count($listspatt) > 0){
                                   foreach($listspatt as $arr_spa){  
                                       $listlocation = $this->m_spadetail->loadspalocation($arr_spa->spaID);
                                       if(!empty($listlocation)) 
                                       $locationtt   = $listlocation->LocationID;
                                       $locationspacurrent = "";
                                       if(!empty($spalocation))
                                       $locationspacurrent = $spalocation->LocationID;
                                       if(isset($locationtt) && isset($locationspacurrent)){
                                        if($locationtt == $locationspacurrent){?>
                                            <div class="wrap-product shadow-box">
                                                <a href="<?php echo base_url('spadetail/index/'.$arr_spa->spaID); ?>" >
                                                    <div class="wrap-thumb" style="background-image:url(<?php $imglnk = $this->m_index->laylink($arr_spa->spaID);echo $imglnk;?>);">
                                                        <div class="wrap-sales">Địa điểm</div>
                                                    </div>
                                                </a>
                                                <div class="wrap-content">
                                                    <a href="<?php echo base_url('spadetail/index/'.$arr_spa->spaID); ?>" >
                                                        <h3 class="title"><?php echo $arr_spa->spaName; ?></h3>
                                                        <h4 class="shop"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span><?php echo $listlocation->StrValue1?></h4>               
                                                    </a>                       
                                                </div>
                                            </div> 
                               <?php   }
                                      }
                                    }
                                } ?>
                             <br />
                            <!--<h3>Theo loại spa</h3>
                            <div class="wrap-product shadow-box">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#serviceModal">
                                    <div class="wrap-thumb" style="background-image:url(images/spa-couple.jpg);">
                                        <div class="wrap-sales">Save<br /><span class="amount">20%</span></div>
                                    </div>
                                </a>
                                <div class="wrap-content">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#serviceModal">
                                        <h3 class="title">Blow-Dry & Make-Up</h3>
                                        <h4 class="shop"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Barnard Castle</h4>               
                                    </a>                      
                                </div>
                                <div class="wrap-buttons"><button type="button" class="btn btn-default btn-grey" data-toggle="modal" data-target="#serviceModal">BOOK</button></div>
                            </div> -->
                             <!--
                            <div class="wrap-product shadow-box">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#serviceModal">
                                    <div class="wrap-thumb" style="background-image:url(images/spa-couple.jpg);">
                                        <div class="wrap-sales">Save<br /><span class="amount">20%</span></div>
                                    </div>
                                </a>
                                <div class="wrap-content">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#serviceModal">
                                        <h3 class="title">Blow-Dry & Make-Up</h3>
                                        <h4 class="shop"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Barnard Castle</h4>               
                                    </a>                        
                                </div>
                                <div class="wrap-buttons"><button type="button" class="btn btn-default btn-grey" data-toggle="modal" data-target="#serviceModal">BOOK</button></div>
                            </div>  -->
                            
                            <!--<div class="wrap-product shadow-box">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#serviceModal">
                                    <div class="wrap-thumb" style="background-image:url(images/spa-couple.jpg);">
                                        <div class="wrap-sales">Save<br /><span class="amount">20%</span></div>
                                    </div>
                                </a>
                                <div class="wrap-content">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#serviceModal">
                                        <h3 class="title">Blow-Dry & Make-Up</h3>
                                        <h4 class="shop"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Barnard Castle</h4>               
                                    </a>                       
                                </div>
                                <div class="wrap-buttons"><button type="button" class="btn btn-default btn-grey" data-toggle="modal" data-target="#serviceModal">BOOK</button></div>
                            </div>-->
                        </div>
                    </div>                	
                </div>
                <div class="col-nav">                	 
                    <h3 class="section-title-filter"><?php echo $ttspa->spaName; ?></h3>
                    <?php echo $ttspa->Address; ?>
                    <div class="wrap-shop-map">
                    	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                        <div style="overflow:hidden;height:268px;width:100%;">
                        <div id="gmap_canvas" style="height:268px;width:100%;"></div>
                        <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
                        <a class="google-map-code" href="http://www.trivoo.net" id="get-map-data">www.trivoo.net</a>
                        </div>
                        <?php
                            $strLoc = $ttspa->Location;
                            $_x ="";
                            $_y="";
                            $_contentLoc="";
                            if($strLoc!="")
                            {
                               $arr_loc = explode('|',$strLoc);
                               $_contentLoc =  $arr_loc[1];
                               $arr_toado = explode(',',$arr_loc[0]);
                               if(!empty($arr_toado[0]))
                                    $_x = $arr_toado[0];
                               if(!empty($arr_toado[1]))
                                    $_y = $arr_toado[1];
                            }
                        ?>
                        <script type="text/javascript"> 
                            function init_map(){
                                var myOptions = {
                                    zoom:15,
                                    center:new google.maps.LatLng(<?php echo $_x;  ?>,<?php echo $_y;  ?>),
                                    mapTypeId: google.maps.MapTypeId.ROADMAP};
                                map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
                                marker = new google.maps.Marker({
                                    map: map,
                                    position: new google.maps.LatLng(<?php echo $_x;  ?>, <?php echo $_y;  ?>)
                                    });
                                infowindow = new google.maps.InfoWindow({
                                    content:"<b><?php echo $ttspa->spaName;  ?></b><br/><?php echo $_contentLoc;  ?>" 
                                    });
                                google.maps.event.addListener(marker, "click", function(){
                                    infowindow.open(map,marker);
                                    });
                                infowindow.open(map,marker);
                            }
                            google.maps.event.addDomListener(window, 'load', init_map);
                        </script>
                    </div>
                    <div class="wrap-method-contact">
                    	<dl class="dl-horizontal">
                          <dt><img src="<?php echo base_url('resources/front/images/icon-tel.png'); ?>" width="21" height="21" alt="Telephone" /></dt>
                          <dd><?php echo $ttspa->Tel; ?></dd>
                          <dt><img src="<?php echo base_url('resources/front/images/icon-email.png'); ?>" width="21" height="21" alt="Email" /></dt>
                          <dd><?php echo $ttspa->Email; ?></dd>
                          <dt><img src="<?php echo base_url('resources/front/images/icon-hand.png'); ?>" width="21" height="21" alt="Website" /></dt>
                          <dd><a href="http://<?php echo $ttspa->Website; ?>" target="_blank"><?php echo $ttspa->Website; ?></a></dd>
                        </dl>
                    </div>
                  <h3 class="section-title-filter">Giờ hoạt động</h3>
                    <table width="100%" border="0" cellspacing="2" cellpadding="2" style="margin-bottom:20px;">
                        <?php
                            $arr_thu=array(
                                            "2"=>"Thứ 2",
                                            "3"=>"Thứ 3",
                                            "4"=>"Thứ 4",
                                            "5"=>"Thứ 5",
                                            "6"=>"Thứ 6",
                                            "7"=>"Thứ 7",
                                            "8"=>"Chủ nhật",
                                            "9"=>"Ngày lễ",
                            );
                            foreach($timehoatdong as $row_time)
                            {
                                echo "<tr>";
                                    echo "<td nowrap=\"nowrap\">".$arr_thu[$row_time->DayOfWeek]."</td>";
                                    echo '<td width="100%" align="right">'.$row_time->AvailableHourFrom.':00 - '.$row_time->AvailableHourTo.':00</td>';
                                echo "</tr>";
                            }
                         ?>
                    </table>
                    
                    <div class="booking-option">
                    	<dl class="dl-horizontal">
                          <dt><img src="<?php echo base_url('resources/front/images/icon-mouse.png'); ?>" width="45" height="44" alt="Accept Online Booking" /></dt>
                          <dd>Accept Online Booking</dd>
                          <dt><img src="<?php echo base_url('resources/front/images/icon-ticket.png'); ?>" width="45" height="44" alt="Accepts eVouchers" /></dt>
                          <dd>Accepts eVouchers</dd>
                          <!--<dt><img src="<?php //echo base_url('resources/front/images/icon-no-gift.png'); ?>" width="45" height="44" alt="no gift voucher" /></dt>
                          <dd>Wahanda gift voucher not accepted</dd>-->
                        </dl>
                    </div>


                </div>                                
            </div>
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
