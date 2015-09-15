<?php
class M_category extends CI_Model{
    public $errorStr; 
    public function __construct()
    {
        parent::__construct();
    }
    
    public function GetSortBy()
    {
        $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId`='SortBy'";
        $cap1 = $this->db->query($sql)->result();
        $arr1 = (array) $cap1;
        return $arr1;
    }
    
    public function GetProductTypeCap1()
    {
        $sql="SELECT * FROM  `commoncode` WHERE `CommonTypeId`='ProductType' AND LENGTH(`CommonId`)=2";
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
                    return $arr[0]->URL;
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
    
    public function gettotalspa(){
        $sql = "SELECT COUNT(*) AS totalscore FROM `spa` WHERE `Status` = '1'";
        $results=$this->db->query($sql)->row();
        return $results;
    }
    //nghia viet them 18/12/2014
    public function searchspa()
    {
        $soproductperpage=$this->GetSetting('catelogyTotalProductperPage');
        $count_spafacilities=0;
        if(isset($_POST['arrspafacilities']))
        {
            $arrspafacilities=$_POST['arrspafacilities'];
            $str_spafacilities="";
            foreach($arrspafacilities as $row_spafacilities)
            {
                $str_spafacilities.=$row_spafacilities.", ";
            }
            $str_spafacilities=substr($str_spafacilities,0,(strlen($str_spafacilities)-2));
            $arr_spafacilities=$this->layspatheolisttienich($str_spafacilities);
            $arr_spafacilities=array_unique($arr_spafacilities);
            $count_spafacilities=count($arrspafacilities);
        }
        $count_spatype=0;
        if(isset($_POST['arrspatype']))
        {
            $arrspatype=$_POST['arrspatype'];
            $str_spatype="";
            foreach($arrspatype as $row_spatype)
            {
                $str_spatype.=$row_spatype.", ";
            }
            $str_spatype=substr($str_spatype,0,(strlen($str_spatype)-2));
            $arr_spatype=$this->layspatheolistloaispa($str_spatype);
            $arr_spatype=array_unique($arr_spatype);
            $count_spatype=count($arrspatype);
        }
        
        // search theo loại con của sản phẩm 
        $count_childproducttype=0;
        if(isset($_SESSION['indexsearch']))
        {
            $childproducttype = "";
            $productypeparent = "";
            if(isset($_SESSION['indexsearch']['producttype']))
            $childproducttype=$_SESSION['indexsearch']['producttype'];
            $str_childproducttype=$this->layidloaisp_theotenloaisp($childproducttype);
            //echo $str_childproducttype;die;
            if($str_childproducttype!="")
                $count_childproducttype=1;
        }
        else
        {
            if(isset($_POST['arrchildproducttype']))
            {
                $arrchildproducttype=$_POST['arrchildproducttype'];
                $str_childproducttype="";
                foreach($arrchildproducttype as $row_childproducttype)
                {
                    $str_childproducttype.=$row_childproducttype.", ";
                }
                $str_childproducttype=substr($str_childproducttype,0,(strlen($str_childproducttype)-2));
                $count_childproducttype=count($arrchildproducttype);
            }
        }
        
        $count_spaname=0;
        if(isset($_SESSION['indexsearch']['searchspaname']) && $_SESSION['indexsearch']['searchspaname']!="")
        {
            $spaname=$_SESSION['indexsearch']['searchspaname'];
            $arr_spaname=$this->layspatheospaname($spaname);
            $arr_spaname=array_unique($arr_spaname);
            $count_spaname=count($arr_spaname);
            unset($_SESSION['indexsearch']['searchspaname']);
        }
        if(isset($_POST['amount']))
        {
            $amount=$_POST['amount'];
            $arr_amount=explode(" - ",$amount);
            $fromprice=(int)substr($arr_amount[0],0,(strlen($arr_amount[0])-1));
            $fromprice=$fromprice*1000;
            $toprice=(int)substr($arr_amount[1],0,(strlen($arr_amount[1])-1));
            $toprice=$toprice*1000;
        }
        
        if(isset($_SESSION['indexsearch']))
        {
            $name_childproducttype = "";
            if(isset($_SESSION['indexsearch']['producttype']))
            $name_childproducttype=$_SESSION['indexsearch']['producttype'];
            $id_childproducttype=$this->layidloaisp_theotenloaisp($name_childproducttype);
            $producttype=substr($id_childproducttype,0,2);
        }
        else
        {
            if(isset($_POST['producttype']) && $_POST['producttype']!=0 && $_POST['producttype']!='0' && $_POST['producttype']!="")
            {
                $producttype=$_POST['producttype'];
                }
                
        }
        
        // search theo loại sản phẩm cha
        if(isset($_SESSION['indexsearch']))
        {
            $producttype = "";
            if(isset($_SESSION['indexsearch']['producttypepanter']))
                $producttype = $_SESSION['indexsearch']['producttypepanter'];
            
        }
        
        //$producttype='0103';
        if(isset($_POST['page']))
            $page=$_POST['page'];
        else
            $page=1;
        //$page=1;
      
        if(isset($_POST['sortby']))
            $sortby=$_POST['sortby'];
        //if(isset($_POST['fromprice']))
        //$fromprice=$_POST['fromprice'];
        //$fromprice=100000;
        //if(isset($_POST['toprice']))
        //$toprice=$_POST['toprice'];
        //$toprice=200000;
        //$location='80007'; 
        //location spa
        if(isset($_SESSION['indexsearch']))
        {
            $location = "";
            if(isset($_SESSION['indexsearch']['location']))
            $location=$_SESSION['indexsearch']['location']; //location spa
           
            $location=$this->layidlocationtheoten($location);
            if($location==-1 || $location=="-1")
                $location="";
        }
        else
        {
            if(isset($_POST['location']))
            {
                $location=$_POST['location']; //location spa
                
                $location=$this->layidlocationtheoten($location);
                if($location==-1 || $location=="-1")
                    $location="";
            }
        }
        //echo $location." - ";
        /*$somautin=5;
        $start =1;
        $start = ($page - 1)*$somautin;
        $final =  $somautin;*/
       
        if(isset($producttype) && $producttype!="" && $producttype!=0 && $producttype!="0")
        {
            if(strlen($producttype)==4)
            {
                
          
                $sql_spaproducttype="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND `CommonId`='$producttype'";
                
            }
            else
            {
                $sql_spaproducttype="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND `CommonId` like '$producttype%' AND LENGTH(`CommonId`)=4";
               
            }
        }
        else
        {
            $sql_spaproducttype="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND LENGTH(`CommonId`)=4";
           
        }
        
        //if(isset($producttypepanter) && $producttypepanter !="" &&  $producttypepanter != "0" &&  $producttypepanter!=0 ){
//            
//        }
        if(($count_childproducttype!=0 || $count_childproducttype!="0") && isset($producttype) && $producttype!="" && $producttype!=0) 
        {
            $sql_spaproducttype="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND `commonId` IN ($str_childproducttype)";
        }
        
        $query_spaproducttype=$this->db->query($sql_spaproducttype)->result();
        $arr_pro=array();
        //set gia
        if(!isset($fromprice) || $fromprice=="" || $fromprice==0 || $fromprice=='0')
            $fromprice=0;
        if(!isset($toprice) || $toprice=="" || $toprice==0 || $toprice=='0')
            $toprice=10000000000;
        //end set gia
        foreach($query_spaproducttype as $row_spaproducttype)
        {
            $arr_pro[]=$this->laysptheoproducttype_vs_price($row_spaproducttype->CommonId,$fromprice,$toprice);
        }
        
        //lay str spaid
        $layspatheolocationid = "";
        if(isset($location) && $location != "")
            $layspatheolocationid=$this->layspatheolocationid($location); //ra list spaid
        
        
        $arr_spaid=array();
        if($layspatheolocationid!="" && count($layspatheolocationid)>0)
        {
            foreach($layspatheolocationid as $row_spatheolocationid)
            {
                $arr_spaid[]=$row_spatheolocationid->spaID;
            }
        }
        
        
        //end lay str spaid
        /*echo "<pre>";
                print_r($arr_spaid);
            echo "</pre>"; */   //die;  
        $arr_pro2=array();
        if(count($arr_spaid)>0)
        {
            foreach($arr_pro as $row_pro)
            {
                foreach($row_pro as $row_pro2)
                {
                    if(in_array($row_pro2->SpaID, $arr_spaid))
                    {
                        $arr_pro2[]=$row_pro2;
                    }
                }
            }
        }
        else
        {
            foreach($arr_pro as $row_pro)
            {
                foreach($row_pro as $row_pro2)
                {
                    $arr_pro2[]=$row_pro2;
                }
            }
            //$arr_pro2=$arr_pro;
        }
        
        $arr_spa_unique=array();
        foreach($arr_pro2 as $row_pro3)
        {
            $arr_spa_unique[]=$row_pro3->SpaID;
        }
        
        $arr_spa_unique=array_unique($arr_spa_unique);  
        
        if($count_spafacilities!=0 || $count_spafacilities!="0") 
        {
            $arr_spa_unique=array_intersect ($arr_spa_unique, $arr_spafacilities); //lay phan tu giong nhau giua 2 mang
        }
        
        if($count_spatype!=0 || $count_spatype!="0") 
        {
            $arr_spa_unique=array_intersect ($arr_spa_unique, $arr_spatype); //lay phan tu giong nhau giua 2 mang
        }
       
        if($count_spaname!=0 || $count_spaname!="0") 
        {
            $arr_spa_unique=array_intersect ($arr_spa_unique, $arr_spaname); //lay phan tu giong nhau giua 2 mang
        }
        
        $somautin=$this->GetSetting('catelogyTotalSpaperPage');
        //if(count($arr_spa_unique)<=$somautin)
            //$page=1;
        if($page!=1)
        {
            //$start=($page-1)*$somautin+1;
            $start=($page-1)*$somautin;
            //if($start)
            $final=$page*$somautin-1;
        }
        if($page==1)
        {
            $start=($page-1)*$somautin;
            $final=$somautin-1;
        }  
       //echo $start." - ".$final;die;
        /*echo "<pre>";
        print_r($arr_spa_unique);
        echo "</pre>";*/
        //die; 
        $arr_res=array();
        $i=-1;
        //$demtotal = 0;
        foreach($arr_spa_unique as $row_spa_unique)
        {
            if($row_spa_unique!="")
            {
                //echo $row_spa_unique." - ";
                $spaIDtotal =  $this->layspatheoid($row_spa_unique);
                if(count($spaIDtotal) > 0)
                {
                    $i++;
                    //echo $i." - ";
                    if($i>=$start && $i<=$final)
                    {
                        $arr_res[$i]["spa"] = $this->layspatheoid($row_spa_unique);
                        //if(count($arr_res[$i]["spa"]) > 0)
                         //$demtotal++;
                        $arr_productid=array();
                        foreach($arr_pro2 as $row_product)
                        {
                            if($row_spa_unique==$row_product->SpaID)
                            {
                                $arr_productid[]=$row_product->ProductID;
                            }
                        }
                        $arr_productid=array_unique($arr_productid);
                        $arr_product=array();
                        foreach($arr_productid as $row_productid)
                        {
                            $arr_product[]=$this->layproducttheoproductid($row_productid);
                        }
                        $arr_res[$i]["listpro"]=$arr_product;
                        $arr_res[$i]["hinhspa"] = $this->layhinhtheospaid($row_spa_unique);
                    }
                }
            }
            
           
        }
        /*echo "<pre>";
        print_r($arr_res);
        echo "</pre>";
        die; */
        //return $arr_res;
        // viết edit chỗ này nè coi thử có tác dụng không nhé 28/01/2015
        //$total = $this->gettotalspa();
        //if(count($total)> 0)
        //$tongmautin=$total->totalscore;
        $tongmautin = $i+1;
        //echo  $tongmautin;
//        die();
         //$tongmautin = $demtotal;
        if($tongmautin%$somautin!=0)
            $sotrang=floor($tongmautin/$somautin)+1;
        if($tongmautin%$somautin==0)
            $sotrang=$tongmautin/$somautin;
        //chuoi show ra view
        $str="";
        if(count($arr_res)>0)
        {       
            foreach($arr_res as $row)
            {
                if(count($row['spa']) > 0)
                {
                    if(count($row['hinhspa'])>0)
                        $linkhinh=$row['hinhspa']->URL;
                    else
                        $linkhinh=base_url('resources/front/images/nospaimages.png');
                    $str.='<div class="cat-product-box shadow-box box-padding">';
                        $str.='<a href="'.base_url('spadetail/index/'.$row['spa']->spaID).'" class="wrap-thumb" style="background-image:url('.$linkhinh.');"></a>';
                        $str.='<div class="wrap-description">';
                            $str.='<h3 class="title" id="bookmark_'.$row['spa']->spaID.'" name="bookmark_'.$row['spa']->spaID.'"><a href="'.base_url('spadetail/index/'.$row['spa']->spaID).'">'.$row['spa']->spaName.'</a>';
                            //$str.='<div class="wrap-button-like"><iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.aotambikini.com&amp;layout=button_count&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp" style="overflow:hidden;width:100%;height:80px;" scrolling="no" frameborder="0" allowTransparency="true"></iframe></div>';
                          $str.='<div class="wrap-button-like"><div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div></div>';
                          $str.='</h3>';
                            $str.='<div class="shop-location">'.$row['spa']->Address.'</div>';
                            
                            $str.='<div class="wrap-share-button">';
                                $str.='<span class="label">Share this: </span>';
                                $str.='<span class=\'st_facebook_large\' displayText=\'Facebook\'></span>';
                                $str.='<span class=\'st_twitter_large\' displayText=\'Tweet\'></span>';
                                $str.='<span class=\'st_linkedin_large\' displayText=\'LinkedIn\'></span>';
                                $str.='<span class=\'st_googleplus_large\' displayText=\'Google +\'></span>';
                                $str.='<span class=\'st_sharethis_large\' displayText=\'ShareThis\'></span>';
                            $str.='</div>';
                         $str.='</div>';
                        
                        if(count($row['listpro'])>0)
                        {
                             $str.='<table class=" table table-striped table-hover wrap-product-lists col-md-12" width="100%" border="0" cellspacing="0" cellpadding="5">';
                            /*echo "<pre>";
                            print_r($row['listpro']);
                            echo "</pre>";die;*/
                            //if(isset($_POST['limitproduct']))
                            //$str.='<tbody id="tbody_'.$row['spa']->spaID.'">';
                            $j=1;
                            for($i=0;$i<count($row['listpro']);$i++)
                            {
                                if($j%$soproductperpage==1)
                                {
                                    $pagepro=floor($j/$soproductperpage)+1;
                                    if($j==1)
                                        $str.='<tbody id="tbody_'.$row['spa']->spaID.'_'.$pagepro.'">';
                                    else
                                        $str.='<tbody id="tbody_'.$row['spa']->spaID.'_'.$pagepro.'" style="display:none;">';
                                }
                                
                                $str.='<tr class="product-item">';
                                
                                $listPromo = $this->getPromotion($row['listpro'][$i]->ProductID);
                                $savepercent=0;
                                if(count($listPromo) > 0)
                                {
                                      $a=(($row['listpro'][$i]->Price)-($listPromo[0]->Price))/($row['listpro'][$i]->Price)*100;
                                      $savepercent=round($a);
                                      $str.='<td class="item-title"><a href="javascript:void(0)" data-toggle="modal" data-target="#serviceModal" onclick="showdetailpro(\''.$row['listpro'][$i]->ProductID.'\',\''.$listPromo[0]->PromotionId.'\');">'.$row['listpro'][$i]->Name.'</a></td>';
                                      $str.='<td class="item-discount"><span class="savings"><img width=70 src="'.base_url('resources/front/images/discount.png').'"><span class="title"></span><span class="value">'.$savepercent.'%</span></span></td>';
                                      $str.='<td class="item-price"><button onclick="showdetailpro(\''.$row['listpro'][$i]->ProductID.'\',\''.$listPromo[0]->PromotionId.'\');" class="btn btn-default price" data-toggle="modal" data-target="#serviceModal"><span>'.number_format($listPromo[0]->Price).'</span> VNĐ</button></td>';
                                }
                                else{
                                       $str.='<td class="item-title"><a href="javascript:void(0)" data-toggle="modal" data-target="#serviceModal" onclick="showdetailpro(\''.$row['listpro'][$i]->ProductID.'\');">'.$row['listpro'][$i]->Name.'</a></td>';
                                       $str.='<td class="item-discount"></td>';
                                       $str.='<td class="item-price"><button onclick="showdetailpro(\''.$row['listpro'][$i]->ProductID.'\');" class="btn btn-default price" data-toggle="modal" data-target="#serviceModal"><span>'.number_format($row['listpro'][$i]->Price).'</span> VNĐ</button></td>'; 
                                }
                                
                                 
                                $str.='</tr>';
                                if($j%$soproductperpage==0)
                                {
                                    $str.='</tbody>';
                                }
                                $j++;
                            }
                            $str.='</tbody>';
                            if(count($row['listpro'])>$soproductperpage)
                            {
                                $str.='<tbody id="trbutton_'.$row['spa']->spaID.'">';
                                    $str.='<tr class="product-item">';
                                    $str.='<td><button id="btnxembot_'.$row['spa']->spaID.'" class="btn btn-default" style="display:none;" onclick="showless(\''.$row['spa']->spaID.'\');">Show less</button></td>';
                                    $str.='<td></td>';
                                    $str.='<td><button id="btnxemthem_'.$row['spa']->spaID.'" class="btn btn-default" onclick="showlistpro(\''.$row['spa']->spaID.'\',2,\''.$pagepro.'\');">Xem thêm</button></td>';
                                    $str.='</tr>';
                                $str.='</tbody>';
                            }
                          $str.='</table>';
                    }
                $str.='</div>';
            }
          }
        }
        else
            $str.="<h2>Không tìm thấy kết quả</h2>";
        //echo $str;die; 
            $res=array("str"=>$str,"tongmautin"=>$tongmautin,"sotrang"=>$sotrang,"TrangHienTai"=>$page);
        return $res;
    }
    
    public function getPromotion($ProductId){
         $sql = "SELECT a.*,b.`PromotionName`,b.`PromotionType`,b.`BeginDateTime`, b.`EndDateTime` 
                FROM `promotiondetails` a, `promotions` b 
                WHERE a.`PromotionId`=b.`PromotionId` AND a.`ProductId`='$ProductId'";
        $query = $this->db->query($sql)->result();
        return $query;
    }
    
    public function layspatheolocationid($locationid)
    {
        $sql="SELECT `spaID`,`LocationID` FROM `spalocation` WHERE `LocationID`= '$locationid'";
        $query=$this->db->query($sql)->result();
        return $query;
    }
    public function laysptheoproducttype_vs_price($producttype,$fromprice,$toprice)
    {
        $sql="SELECT a.`ProductID`, a.`Name`, b.`Price`, a.`SpaID` 
            FROM `products` a, `price` b 
            WHERE a.`ProductID`=b.`ProductID` 
            and b.`Status`=1 
            and a.ProductType='$producttype' 
            and b.Price > ".$fromprice." and b.Price < ".$toprice;
        $query=$this->db->query($sql)->result();
        return $query;
    }
    public function layspatheoid($spaid)
    {
        $sql="SELECT spaID,spaName,Address,Intro FROM `spa` WHERE `spaID`='$spaid' AND `Status` = '1'";
        $query=$this->db->query($sql)->row();
        return $query;
    }
    public function layproducttheospaid($spaid)
    {
        $sql="SELECT * FROM `products` WHERE `SpaID`='$spaid' AND `Status` = '1'";
        $query=$this->db->query($sql)->result();
        return $query;
    }
    public function layproducttheoproductid($proid)
    {
        $sql="SELECT a.`ProductID`, a.`Name`, b.`Price` 
                FROM `products` a, price b 
                WHERE a.`ProductID`='$proid' 
                AND a.`ProductID`=b.`ProductID` 
                AND b.`Status` = 1 
                ORDER BY a.`ModifiedDate` DESC,a.`CreatedDate` DESC";
        $query=$this->db->query($sql)->row();
        return $query;
    }
    public function layidlocationtheoten($locationstr)
    {
        $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId`='Location' AND `StrValue1` LIKE '%$locationstr%'";
        $query=$this->db->query($sql)->row();
        if(count($query)>0)
            return $query->CommonId;
        else
            return -1;
    }
    public function layhinhtheospaid($spaid)
    {
        $sql="SELECT * FROM `links` WHERE `ObjectIDD`= '$spaid' AND `Type`= 'SPA'";
        $query=$this->db->query($sql)->row();
        return $query;
    }
    public function laytienichspa()
    {
        $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId`='SpaFacility'";
        $query=$this->db->query($sql)->result();
        return $query;
    }
    public function layspatheolisttienich($str_spafacilities)
    {
        $sql="SELECT `spaId` FROM `spainfo` WHERE `commonTypeId`='SpaFacility' AND `commonId` IN ($str_spafacilities)";
        $query=$this->db->query($sql)->result();
        $arr=array();
        foreach($query as $row)
        {
            $arr[]=$row->spaId;
        }
        return $arr;
    }
     public function layloaispa()
    {
        $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId`='SpaType'";
        $query=$this->db->query($sql)->result();
        return $query;
    }
    public function layspatheolistloaispa($str_spatypeid)
    {
        $sql="SELECT `spaId` FROM `spainfo` WHERE `commonTypeId`='SpaType' AND `commonId` IN ($str_spatypeid)";
        $query=$this->db->query($sql)->result();
        $arr=array();
        foreach($query as $row)
        {
            $arr[]=$row->spaId;
        }
        return $arr;
    }
    /*public function layspatheostrloaispcon($str_loaispcon)
    {
        $sql="SELECT `spaId` FROM `spainfo` WHERE `CommonTypeId`='ProductType' AND `commonId` IN ($str_loaispcon)";
        $query=$this->db->query($sql)->result();
        $arr=array();
        foreach($query as $row)
        {
            $arr[]=$row->spaId;
        }
        return $arr;
    }*/
    
    public function getlistloaicommcon($producttype){
        $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND `CommonId` like '$producttype%' AND LENGTH(`CommonId`)=4";
            $query=$this->db->query($sql)->result();
            return $query;
    }
    public function loadloaispcon()
    {
        $count=0;
        $str="";
        if(isset($_POST['producttype']))
        {
            $producttype=$_POST['producttype'];
            $tenloaicha=$this->layloaispchatheoid($producttype)->StrValue1;
            $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND `CommonId` like '$producttype%' AND LENGTH(`CommonId`)=4";
            $query=$this->db->query($sql)->result();
            $count=count($query);
            if($count>0)
            {
                $str .= '<div class="section-filter">';
                    $str .= '<h3 class="section-title-filter">'.$tenloaicha.' có '.$count.' loại:</h3>'; 
                    $str .= '<div class="filters">';
                    foreach($query as $row){
                        $str .= '<div class="checkbox">';
                        $str .= '<label>';
                        $str .= '<input type="checkbox" name="childproducttype" class="childproducttype" id="childproducttype_'.$row->CommonId.'" value="'.$row->CommonId.'"  onclick="searchspa();" />'.$row->StrValue2;
                        $str .= '</label>';
                        $str .= '</div>';
                   
                    }
                     $str .= '</div>';
                $str .= '</div>';
            }
            $arr=array(
                    "sodong"=>$count,
                    "str"=>$str
                    );
            return $arr;
        }
    }
    public function layloaispchatheoid($producttypeid)
    {
        $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND `CommonId`='$producttypeid'";
        $query=$this->db->query($sql)->row();
        return $query;
        
    }
    public function GetSetting($key)
   {
       $val= $this->m_mail->GetSetting($key);
       return $val;
   }
   public function layspatheospaname($spaname)
    {
        $sql="SELECT `spaID` FROM `spa` WHERE `spaName` LIKE '%$spaname%'";
        $query=$this->db->query($sql)->result();
        $arr=array();
        foreach($query as $row)
        {
            $arr[]=$row->spaID;
        }
        return $arr;
        
    }
    public function layidloaisp_theotenloaisp($tenloaisp)
    {
        if($tenloaisp !="")
        {
            $sql="SELECT `CommonId` FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND `StrValue2` = '$tenloaisp' AND LENGTH(CommonId)=4";
            $query=$this->db->query($sql)->row();
            return $query->CommonId;
        }
        else   
            return "";
    }
    // thuan edit ham lay productype ca cha lan con  26/01/2015
    public function getlistproductypeparent($tenloaisp)
    {
        if($tenloaisp !="")
        {
            $sql="SELECT `CommonId` FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND `StrValue2` = '$tenloaisp' AND LENGTH(CommonId)=2 ";
            $query=$this->db->query($sql)->row();
            return $query->CommonId;
        }
        else   
            return "";
    }
    // end function edit ham lay productype cua cha lan con ngay 26/1/2015
    public function layloaispcon_theoidloaispcha($idloaispcha)
    {
        $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND `CommonId` like '$idloaispcha%' AND LENGTH(CommonId)=4";
        $query=$this->db->query($sql)->result();
        return $query;
    }
}  
?>
