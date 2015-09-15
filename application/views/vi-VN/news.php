<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>the Booking - Spa - About Thebooking.vn</title>
    <!-- InstanceEndEditable -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('resources/front/favicon.ico'); ?>">
    <?php
          require("head.php"); 
     ?>
    <link href="<?php echo base_url('resources/front/css/news.css'); ?>" rel="stylesheet">
    <script src="<?php echo base_url('resources/front/js/news.js'); ?>" type="text/javascript"></script>    
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
        <hr />
        <div id="page">
          <div id="sidebar">
            <ul>
              <li id="menu">
                <ul id="dsloai">
                <?php 
                    if(isset($dsloai) && count($dsloai)>0)
                    {
                        $chay_loai=0;
                        foreach($dsloai as $row_loai)
                        {
                            if($chay_loai==0)
                            {
                                echo '<li class="active" id="li_'.$row_loai->CommonId.'" ><a href="javascript:void(0)" onclick="loadloai(\''.$row_loai->CommonId.'\');" >'.$row_loai->StrValue1.'</a></li>';
                            }
                            else
                            {
                                echo '<li id="li_'.$row_loai->CommonId.'" ><a href="javascript:void(0)" onclick="loadloai(\''.$row_loai->CommonId.'\');" >'.$row_loai->StrValue1.'</a></li>';
                            }
                            $chay_loai++;
                        }
                    }
                ?>
                </ul>
              </li>
              <li id="newsintopic"><!--tin theo chu de-->
                <span id="headnewsintopic">
                <?php 
                    if(isset($dsloai) && count($dsloai)>0 && isset($dstintheoloaidautien) && $dstintheoloaidautien!=-1 && $dstintheoloaidautien!="-1")
                    {
                        echo '<h2><span>'.$dsloai[0]->StrValue1.'</h2>';
                    }
                    
                ?>
                </span>
                <ul id="dstintheochude">
                    <?php 
                     if(isset($dstintheoloaidautien) && $dstintheoloaidautien!=-1 && $dstintheoloaidautien!="-1")
                    {
                        $chay_tintheoloaidau=0;
                        foreach($dstintheoloaidautien as $row_tintheoloaidautien)
                        {
                            if($chay_tintheoloaidau<=4)
                            {
                                $newstopic_time=$row_tintheoloaidautien->Time;
                                $newstopic_time=explode(" ",$newstopic_time);
                                $newstopic_time=explode('-',$newstopic_time[0]);
                                $newstopic_date=$newstopic_time[2]."/".$newstopic_time[1];
                                $newstopic_createby=$row_tintheoloaidautien->CreatedBy;
                                if(isset($newstopic_createby) && $newstopic_createby!="")
                                    $strtoic_createby="Post by: ".$newstopic_createby."</h3>";
                                else
                                    $strtoic_createby="</h3>";
                                echo '<li>';
                                    echo '<h3><span>'.$newstopic_date.':</span> '.$strtoic_createby;
                                    
                                    echo '<p><a href="javascript:void(0)" onclick="loadnews(\''.$row_tintheoloaidautien->id.'\');" >'.$row_tintheoloaidautien->Title.'</a></p>';
                                echo '</li>';
                            }
                            $chay_tintheoloaidau++;
                        }
                    }
                    ?>
                </ul>
                <ul id="pagenewsintopic">
                <?php
                     if(isset($dstintheoloaidautien) && count($dstintheoloaidautien)>5)
                     {
                        echo '<li>';
                            echo '1<a href="javascript:void(0)" onclick="loadpage(\'0\',2,\''.$dsloai[0]->CommonId.'\');" > > </a>';
                        echo '</li>';
                     }
                ?>
                </ul>
              </li><!--end tin theo chu de-->
              <li id="newnews"><!--tin moi nhat-->
                <h2><span>Tin tức mới nhất</h2>
                <ul id="dstinmoi">
                    <?php 
                     if(isset($dstintucmoinhat) && count($dstintucmoinhat)>0)
                     {
                        $chay_tinmoi=0;
                        foreach($dstintucmoinhat as $row_dstinmoi)
                        {
                            if($chay_tinmoi<=4)
                            {
                                $new_time=$row_dstinmoi->Time;
                                $new_time=explode(" ",$new_time);
                                $new_time=explode('-',$new_time[0]);
                                $new_date=$new_time[2]."/".$new_time[1];
                                $new_createby=$row_dstinmoi->CreatedBy;
                                if(isset($new_createby) && $new_createby!="")
                                    $str_createby="Post by: ".$new_createby."</h3>";
                                else
                                    $str_createby="</h3>";
                                echo '<li>';
                                    echo '<h3><span>'.$new_date.':</span> '.$str_createby;
                                    
                                    echo '<p><a href="#" onclick="loadnews(\''.$row_dstinmoi->id.'\');" >'.$row_dstinmoi->Title.'</a></p>';
                                echo '</li>';
                            }
                            $chay_tinmoi++;
                        }
                     }
                    ?>
                </ul>
                <ul id="pagedstinmoi">
                <?php
                     if(isset($dstintucmoinhat) && count($dstintucmoinhat)>5)
                     {
                        echo '<li>';
                            echo '1<a href="javascript:void(0)" onclick="loadpage(\'1\',2,\'0\');" > > </a>';
                        echo '</li>';
                     }
                ?>
                </ul>
              </li><!--end tin moi nhat-->
            </ul>
          </div>
          <div id="contentNews">
            <div id="welcome">
            <?php 
                if(isset($mainnews) && count($mainnews)!=0)
                {
                    echo '<h1 class="title">'.$mainnews->Title.'</h1>';
                    
                    $mainnews_time=$mainnews->Time;
                    $mainnews_time=explode(" ",$mainnews_time);
                    $mainnews_time=explode('-',$mainnews_time[0]);
                    $mainnews_date=$mainnews_time[2]."/".$mainnews_time[1];
                    $mainnews_createby=$mainnews->CreatedBy;
                    if(isset($mainnews_createby) && $mainnews_createby!="")
                        $strmainnews_createby="Post by: ".$mainnews_createby."</p>";
                    else
                        $strmainnews_createby="</p>";
                        echo '<p><span>'.$mainnews_date.':</span> '.$strmainnews_createby;
                    if(isset($hinh))
                    {
                        echo '<img src="'.base_url($hinh->URL).'" alt="" width="118" height="118" class="left" />&nbsp;';
                        echo $mainnews->NewsDetail."<br />";
                    }
                    else
                    {
                        echo '<img src="'.base_url('resources/front/images/nonewsimages.png').'" alt="" width="118" height="118" class="left" />&nbsp;';
                        echo $mainnews->NewsDetail."<br />";
                    }
                }
                else
                {
                    echo '<h1 class="title">Chưa có tin tức nào</h1>';
                }
            ?>
            </div>
            <div class="twocols">
                   <div class="col1" id="firstrelatednews">
                    <?php 
                        if(isset($listmainnews) && count($listmainnews)>0)
                        {
                            echo '<h2 class="title"><a href="#" onclick="loadnews(\''.$listmainnews[0]->id.'\');">'.$listmainnews[0]->Title.'</a></h2>';
                            echo '<p>'.$listmainnews[0]->NewsBrief.'</p>';
                            echo '<p><a href="#" onclick="loadnews(\''.$listmainnews[0]->id.'\');">Read more&hellip;</a></p>';
                        }
                    ?>
                  </div>
                  <div class="col1" id="secondrelatednews">
                    <?php 
                        if(isset($listmainnews) && count($listmainnews)>1)
                        {
                            echo '<h2 class="title"><a href="javascript:void(0)" onclick="loadnews(\''.$listmainnews[1]->id.'\');">'.$listmainnews[1]->Title.'</a></h2>';
                            echo '<p>'.$listmainnews[1]->NewsBrief.'</p>';
                            echo '<p><a href="#" onclick="loadnews(\''.$listmainnews[1]->id.'\');">Read more&hellip;</a></p>';
                        }
                    ?>
                  </div>
                  <div class="col2" id="avlistmain">
                    <h2 class="title">Tin liên quan</h2>
                    <ul class="list" id="listtinlienquan">
                        <?php 
                            
                            if(isset($listmainnews) && count($listmainnews)>3)
                            {
                                $chay_mainnews=0;
                                for($i=2;$i<count($listmainnews);$i++)
                                {
                                    if($chay_mainnews<5)
                                        echo '<li><a href="#" onclick="loadnews(\''.$listmainnews[$i]->id.'\');">'.$listmainnews[$i]->Title.'</a></li>';
                                    $chay_mainnews++;
                                }
                            }
                            else
                            {
                                echo "<li>Chưa có!</li>";
                            }
                        ?>
                    </ul>
                    <div id="pagetinlienquan">
                    <?php
                         if(isset($listmainnews) && count($listmainnews)>7)
                         {
                            echo '<span>';
                                echo '1<a href="javascript:void(0)" onclick="loadpage(\'2\',2,\''.trim($listmainnews[1]->CategoryID)."__".$listmainnews[1]->id.'\');" > > </a>';
                            echo '</span>';
                         }
                    ?>
                    </div>
                  </div>
            </div>
          </div>
          <div style="clear: both;">&nbsp;</div>
        </div>
        <hr />
    <!-- InstanceEndEditable -->
    </div>
    
</header>

<?php
     require("footer.php");
?>

<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "42ca428d-6cd0-4b93-b360-fa0d0bfa3696", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script> 
    
</body>
<!-- InstanceEnd --></html>
