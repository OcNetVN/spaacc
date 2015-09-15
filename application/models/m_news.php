<?php
class M_news extends CI_Model{
    public $errorStr; 
    public function __construct()
    {
        parent::__construct();
    }
    
    public function GetNewsForIndex()
    {
        $sql="SELECT * FROM `news` ORDER BY `Time` DESC LIMIT 1";
        $cap1 = $this->db->query($sql)->result();
        $arr1 = (array) $cap1;
        return $arr1;
    }
    
    public function GetNewMeLimit()
    {
        //$sql="SELECT * FROM `news` ORDER BY `Time` DESC LIMIT 3";
        $sql="SELECT *,CONCAT(LEFT(`NewsBrief`,230),'...') AS NewsBrief1,CONCAT(LEFT(`Title`,28),'...') AS Title1 FROM `news` ORDER BY `Time` DESC LIMIT 3";
        $cap1 = $this->db->query($sql)->result();
        $arr1 = (array) $cap1;
        return $arr1;
    }
    public function GetNewsImages($id,$Ava)
    {
        $sql="SELECT * FROM `links` WHERE `Type`='NEWS' AND `ObjectIDD`='$id'";
        if($Ava==true)
        {
            $sql="SELECT * FROM `links` WHERE `Type`='NEWS' AND `ObjectIDD`='$id' AND `Status`='99'";            
        }
        else
        {
            $sql="SELECT * FROM `links` WHERE `Type`='NEWS' AND `ObjectIDD`='$id' ORDER BY `UploadedDate` DESC LIMIT 1";
        }
        //$sql="SELECT * FROM `news` ORDER BY `Time` DESC LIMIT 1";
        $cap1 = $this->db->query($sql)->result();
        $arr1 = (array) $cap1;
        return $arr1;
    }
    
    public function laylinkImages($id)
    {
        $sql="SELECT * FROM `links` WHERE `Type`='NEWS' AND `ObjectIDD`='$id' AND `Status`='99' ORDER BY `UploadedDate` DESC LIMIT 1";
        try{
                $results=$this->db->query($sql)->result();
                $arr = (array) $results;
                if(count($arr)>0) 
                {
                    return base_url($arr[0]->URL);
                    $errorStr =null;
                }
                else
                {
                    return base_url("resources/front/images/nonewsimages.png");
                }
        }
        catch(Exception $e){
               $errorStr =  $e;
               return base_url("resources/images/front/nonewsimages.png");                    
        }        
    }
    //nghia viet them 25/12/2014
    public function laytatcaloainews()
    {
        $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId`='NewsCategory'";
        $results=$this->db->query($sql)->result();
        return $results;
    }
    public function laytintucmoi()
    {
        $sql="SELECT * FROM `news` ORDER BY `Time` DESC";
        $results=$this->db->query($sql)->result();
        return $results;
    }
    public function laytintucmoi_phantrang($start,$limit)
    {
        $sql="SELECT * FROM `news` ORDER BY `Time` DESC LIMIT $start,$limit";
        $results=$this->db->query($sql)->result();
        return $results;
    }
    public function tongsotintuc()
    {
        $sql="SELECT count(*) as total FROM `news` ORDER BY `Time` DESC";
        $results=$this->db->query($sql)->row();
        return $results;
    }
    public function dstintuc_theomaloaitintuc($maloaitintuc)
    {
        $sql="SELECT * FROM `news` WHERE `CategoryID`='$maloaitintuc' ORDER BY `Time` DESC";
        $results=$this->db->query($sql)->result();
        return $results;
    }
    public function dstintuc_theomaloaitintuc_phantrang($maloaitintuc,$start,$limit)
    {
        $sql="SELECT * FROM `news` WHERE `CategoryID`='$maloaitintuc' ORDER BY `Time` DESC LIMIT $start,$limit";
        $results=$this->db->query($sql)->result();
        return $results;
    }
    public function sotintuc_theomaloaitintuc($maloaitintuc)
    {
        $sql="SELECT count(*) as total FROM `news` WHERE `CategoryID`='$maloaitintuc' ORDER BY `Time` DESC";
        $results=$this->db->query($sql)->row();
        return $results;
    }
    public function laytintuc_theomatintuc($matintuc)
    {
        $sql="SELECT * FROM `news` WHERE `id`='$matintuc' ORDER BY `Time` DESC";
        $results=$this->db->query($sql)->row();
        return $results;
    }
    
    public function laydstin_theoloaidautien()
    {
        $sql="SELECT `CommonId` FROM `commoncode` WHERE `CommonTypeId`='NewsCategory'";
        $res=$this->db->query($sql)->row();
        if(count($res)>0)
        {
            $CommonId=$res->CommonId;
            $list=$this->dstintuc_theomaloaitintuc($CommonId);
            return $list;
        }
        else
            return -1;
    }
    public function dstintuc_theomaloaitintuc_khacid($maloaitintuc,$matintuc)
    {
        $sql="SELECT * FROM `news` WHERE `CategoryID`='$maloaitintuc' and id<>'$matintuc' ORDER BY `Time` DESC";
        $results=$this->db->query($sql)->result();
        return $results;
    }
    public function dstintuc_theomaloaitintuc_khacid_phantrang($maloaitintuc,$matintuc,$start,$limit)
    {
        $sql="SELECT * FROM `news` WHERE `CategoryID`='$maloaitintuc' and id<>'$matintuc' ORDER BY `Time` DESC LIMIT $start,$limit";
        //echo $sql;die;
        $results=$this->db->query($sql)->result();
        return $results;
    }
    public function layhinhtintuc_theomatintuc($matintuc)
    {
        $sql="SELECT * FROM `links` WHERE `ObjectIDD`='$matintuc' AND `Type`='NEWS' ORDER BY `id` DESC";
        $results=$this->db->query($sql)->row();
        return $results;
    }
    public function layloaitin_theomaloaitin($maloaitintuc)
    {
        $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId`='NewsCategory' AND `CommonId`='$maloaitintuc'";
        $results=$this->db->query($sql)->row();
        return $results;
    }
    //xu li ajax
    public function loadloai()
    {
        if(isset($_POST['maloaitin']))
        {
            $str="";
            $tenloaitin="";
            $maloaitin=$_POST['maloaitin'];
            $loaitin=$this->layloaitin_theomaloaitin($maloaitin);
            if(count($loaitin)!=0)
                $tenloaitin=$loaitin->StrValue1;
            $res=$this->dstintuc_theomaloaitintuc($maloaitin);
            $sodong=count($res);
            if($sodong>0)
            {
                $str .='<span id="headnewsintopic">';
                    $str .='<h2><span>'.$tenloaitin.'</h2>';
                $str .='</span>';
                $str .='<ul id="dstintheochude">';
                        $chay_tintheoloaidau=0;
                        foreach($res as $row_tintheoloaidautien)
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
                                $str .= '<li>';
                                    $str .= '<h3><span>'.$newstopic_date.':</span> '.$strtoic_createby;
                                    
                                    $str .= '<p><a href="javascript:void(0)" onclick="loadnews(\''.$row_tintheoloaidautien->id.'\');" >'.$row_tintheoloaidautien->Title.'</a></p>';
                                $str .= '</li>';
                            }
                            $chay_tintheoloaidau++;
                        }
                $str .='</ul>';
                $str .='<ul id="pagenewsintopic">';
                     if(count($res)>5)
                     {
                        $str .= '<li>';
                            $str .= '1<a href="javascript:void(0)" onclick="loadpage(\'0\',2,\''.$maloaitin.'\');" > > </a>';
                        $str .= '</li>';
                     }
                $str .='</ul>';
            }
            else
            {
                $str .='<span id="headnewsintopic">';
                    $str .='<h2><span>'.$tenloaitin.'</h2>';
                $str .='</span>';
                $str .="Chưa có tin nào!";
            }
            $arr=array(
                    "str"=>$str,
                    "maloaitin"=>$maloaitin
                    );
            return $arr;
        }
    }
    public function loadnews()
    {
        if(isset($_POST['newsid']))
        {
            $newsid=$_POST['newsid'];
            //echo $newsid;die;
            $mainnews=$this->laytintuc_theomatintuc($newsid);
            $hinh=$this->layhinhtintuc_theomatintuc($newsid);
           
            if(isset($mainnews) && count($mainnews)>0)
            {
                $listmainnews=$this->dstintuc_theomaloaitintuc_khacid($mainnews->CategoryID,$mainnews->id);
            }
            
            //load noi dung cua tin tuc
            $str_mainnews="";
            if(isset($mainnews) && count($mainnews)!=0)
            {
                $str_mainnews .= '<h1 class="title">'.$mainnews->Title.'</h1>';
                
                $mainnews_time=$mainnews->Time;
                $mainnews_time=explode(" ",$mainnews_time);
                $mainnews_time=explode('-',$mainnews_time[0]);
                $mainnews_date=$mainnews_time[2]."/".$mainnews_time[1];
                $mainnews_createby=$mainnews->CreatedBy;
                if(isset($mainnews_createby) && $mainnews_createby!="")
                    $strmainnews_createby="Post by: ".$mainnews_createby."</p>";
                else
                    $strmainnews_createby="</p>";
                    $str_mainnews .= '<p><span>'.$mainnews_date.':</span> '.$strmainnews_createby;
                if(isset($hinh) && count($hinh)!=0)
                {
                    $str_mainnews .= '<img src="'.base_url($hinh->URL).'" alt="" width="118" height="118" class="left" />&nbsp;';
                    $str_mainnews .= $mainnews->NewsDetail."<br />";
                }
                else
                {
                    $str_mainnews .= '<img src="'.base_url('resources/front/images/nonewsimages.png').'" alt="" width="118" height="118" class="left" />&nbsp;';
                    $str_mainnews .= $mainnews->NewsDetail."<br />";
                }
            }
            else
            {
                $str_mainnews .= '<h1 class="title">Chưa có tin tức nào</h1>';
            }
            
            //load cac tin lien quan
            $str_firstrelatednews="";
            if(isset($listmainnews) && count($listmainnews)>0)
            {
                $str_firstrelatednews .='<h2 class="title"><a href="#" onclick="loadnews(\''.$listmainnews[0]->id.'\');">'.$listmainnews[0]->Title.'</a></h2>';
                $str_firstrelatednews .='<p>'.$listmainnews[0]->NewsBrief.'</p>';
                $str_firstrelatednews .= '<p><a href="#" onclick="loadnews(\''.$listmainnews[0]->id.'\');">Read more&hellip;</a></p>';
            }
            $str_secondrelatednews="";
            if(isset($listmainnews) && count($listmainnews)>1)
            {
                $str_secondrelatednews .='<h2 class="title"><a href="#" onclick="loadnews(\''.$listmainnews[1]->id.'\');">'.$listmainnews[1]->Title.'</a></h2>';
                $str_secondrelatednews .='<p>'.$listmainnews[1]->NewsBrief.'</p>';
                $str_secondrelatednews .= '<p><a href="#" onclick="loadnews(\''.$listmainnews[1]->id.'\');">Read more&hellip;</a></p>';
            }
            $str_listrelatednews="";
            if(isset($listmainnews) && count($listmainnews)>3)
            {
                $chay_mainnews=0;
                for($i=2;$i<count($listmainnews);$i++)
                {
                    if($chay_mainnews<5)
                        $str_listrelatednews .= '<li><a href="#" onclick="loadnews(\''.$listmainnews[$i]->id.'\');">'.$listmainnews[$i]->Title.'</a></li>';
                    $chay_mainnews++;
                }
            }
            else
            {
                $str_listrelatednews .= "<li>Chưa có!</li>";
            }
            $str_pagerelatednews="";
            if(isset($listmainnews) && count($listmainnews)>7)
             {
                $str_pagerelatednews .= '<span>';
                    $str_pagerelatednews .= '1<a href="javascript:void(0)" onclick="loadpage(\'2\',2,\''.$listmainnews[1]->CategoryID."__".$listmainnews[1]->id.'\');" > > </a>';
                $str_pagerelatednews .= '</span>';
             }
            
            
            $arr=array(
                    "str_mainnews"=>$str_mainnews,
                    "str_firstrelatednews"=>$str_firstrelatednews,
                    "str_secondrelatednews"=>$str_secondrelatednews,
                    "str_listrelatednews"=>$str_listrelatednews,
                    "str_pagerelatednews"=>$str_pagerelatednews
                    );
            return $arr;
        }
    }
    public function loadpage()
    {
        if(isset($_POST['vitriload']))
        {
            $str="";
            $vitriload=$_POST['vitriload'];
            $page=$_POST['page'];
            $maloaitin=$_POST['maloaitintuc'];
            $limit=5;
            $start=($page-1)*5;
            if($vitriload==0 || $vitriload=="0")
            {
                $somautin=$this->sotintuc_theomaloaitintuc($maloaitin)->total;
                $listnewsintopic=$this->dstintuc_theomaloaitintuc_phantrang($maloaitin,$start,$limit);
                
                //
                $sodongintopic=count($listnewsintopic);
                if($sodongintopic>0)
                {
                    $tenloaitin="";
                    $loaitin=$this->layloaitin_theomaloaitin($maloaitin);
                    if(count($loaitin)!=0)
                        $tenloaitin=$loaitin->StrValue1;
                    $str .='<span id="headnewsintopic">';
                        $str .='<h2><span>'.$tenloaitin.'</h2>';
                    $str .='</span>';
                    $str .='<ul id="dstintheochude">';
                            $chay_tintheoloaidau=0;
                            foreach($listnewsintopic as $row_tintheoloaidautien)
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
                                    $str .= '<li>';
                                        $str .= '<h3><span>'.$newstopic_date.':</span> '.$strtoic_createby;
                                        
                                        $str .= '<p><a href="javascript:void(0)" onclick="loadnews(\''.$row_tintheoloaidautien->id.'\');" >'.$row_tintheoloaidautien->Title.'</a></p>';
                                    $str .= '</li>';
                                }
                                $chay_tintheoloaidau++;
                            }
                    $str .='</ul>';
                    $str .='<ul id="pagenewsintopic">';
                            $str .= '<li>';
                                if($page==1 && $somautin>5)
                                {
                                        $str .= '1<a href="javascript:void(0)" onclick="loadpage(\'0\',2,\''.$maloaitin.'\');" > > </a>';
                                }
                                else
                                {
                                    if($page>=2)
                                        $str .= '<a href="javascript:void(0)" onclick="loadpage(\'0\','.($page-1).',\''.$maloaitin.'\');" > < </a>';
                                    if(($somautin/5)>$page)
                                        $str .= $page.'<a href="javascript:void(0)" onclick="loadpage(\'0\','.($page+1).',\''.$maloaitin.'\');" > > </a>';
                                    else
                                        $str .= $page;
                                }
                            $str .= '</li>';
                    $str .='</ul>';
                }
            }
            
            //
            if($vitriload==1 || $vitriload=="1")
            {
                $somautin=$this->tongsotintuc()->total;
                $dstintucmoinhat=$this->laytintucmoi_phantrang($start,$limit);
                $str .='<h2><span>Tin tức mới nhất</h2>';
                $str .='<ul id="dstinmoi">';
                     if(isset($dstintucmoinhat) && count($dstintucmoinhat)>0)
                     {
                        foreach($dstintucmoinhat as $row_dstinmoi)
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
                            $str .= '<li>';
                                $str .= '<h3><span>'.$new_date.':</span> '.$str_createby;
                                
                                $str .= '<p><a href="javascript:void(0)" onclick="loadnews(\''.$row_dstinmoi->id.'\');" >'.$row_dstinmoi->Title.'</a></p>';
                            $str .= '</li>';
                        }
                     }
                $str .='</ul>';
                $str .='<ul id="pagedstinmoi">';
                        $str .= '<li>';
                            if($page==1 && $somautin>5)
                                {
                                        $str .= '1<a href="javascript:void(0)" onclick="loadpage(\'1\',2,\''.$maloaitin.'\');" > > </a>';
                                }
                                else
                                {
                                    if($page>=2)
                                        $str .= '<a href="javascript:void(0)" onclick="loadpage(\'1\','.($page-1).',\''.$maloaitin.'\');" > < </a>';
                                    if(($somautin/5)>$page)
                                        $str .= $page.'<a href="javascript:void(0)" onclick="loadpage(\'1\','.($page+1).',\''.$maloaitin.'\');" > > </a>';
                                    else
                                        $str .= $page;
                                }
                        $str .= '</li>';
                $str .='</ul>';
            }
            
            //
            if($vitriload==2 || $vitriload=="2")
            {
                $maloaitin=explode("__",$maloaitin);
                $start=$start+3;
                //echo $start;die;
                $somautin=$this->sotintuc_theomaloaitintuc($maloaitin[0])->total;
                $listmainnews=$this->dstintuc_theomaloaitintuc_khacid_phantrang($maloaitin[0],$maloaitin[1],$start,$limit);
                //print_r($listmainnews);die;
                $str .='<h2 class="title">Tin liên quan</h2>';
                $str .='<ul class="list" id="listtinlienquan">';
                for($i=0;$i<count($listmainnews);$i++)
                {
                    $str .= '<li><a href="javascript:void(0)" onclick="loadnews(\''.$listmainnews[$i]->id.'\');">'.$listmainnews[$i]->Title.'</a></li>';
                }
                $str .='</ul>';
                $str .='<div id="pagetinlienquan">';
                    if($page==1 && $somautin>8)
                    {
                            $str .= '1<a href="javascript:void(0)" onclick="loadpage(\'2\',2,\''.trim($listmainnews[1]->CategoryID)."__".$maloaitin[1].'\');" > > </a>';
                    }
                    else
                    {
                        if($page>=2)
                            $str .= '<a href="javascript:void(0)" onclick="loadpage(\'2\','.($page-1).',\''.trim($listmainnews[1]->CategoryID)."__".$maloaitin[1].'\');" > < </a>';
                        if((($somautin-3)/5)>$page)
                            $str .= $page.'<a href="javascript:void(0)" onclick="loadpage(\'2\','.($page+1).',\''.trim($listmainnews[1]->CategoryID)."__".$maloaitin[1].'\');" > > </a>';
                        else
                            $str .= $page;
                    }
                $str .='</div>';
            }
            
            
            $arr=array(
                    "str"=>$str,
                    "vitriload"=>$vitriload
                    );
            return $arr;
        }
    }
}  
?>
