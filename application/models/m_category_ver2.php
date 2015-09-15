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
    
    //nghia viet ngay 30/12/2014
    //nghia viet ngay 30/12/2014
    public function xuly($ProductType_Cha,$List_ProductType_Con,$PriceFrom,$PriceTo,$Location,$List_Uti,$List_LoaiSpa,$SpaName,$RecordStart)
    {
        //echo $List_ProductType_Con;die;
        $RecordPerPage=$this->GetSetting('catelogyTotalSpaperPage');
        $sql="SELECT DISTINCT a.`spaID` FROM `products` a INNER JOIN `spa` b ON a.`SpaID` = b.`SpaID`
			  LEFT JOIN `price` c ON a.`ProductID` = c.`ProductID`
			  LEFT JOIN `spainfo` d ON a.`spaID`= d.`spaId`
			  LEFT JOIN `spainfo` e ON a.`spaID`= e.`spaId`
			  LEFT JOIN `spalocation` f ON a.`spaID`= f.`spaID`
		WHERE d.`commonTypeId`='SpaFacility'
		AND e.`commonTypeId`='SpaType'
        AND a.`Status` = '1'";
        $sqlcount="SELECT count(DISTINCT a.`spaID`) as TotalSpa FROM `products` a INNER JOIN `spa` b ON a.`SpaID` = b.`SpaID`
			  LEFT JOIN `price` c ON a.`ProductID` = c.`ProductID`
			  LEFT JOIN `spainfo` d ON a.`spaID`= d.`spaId`
			  LEFT JOIN `spainfo` e ON a.`spaID`= e.`spaId`
			  LEFT JOIN `spalocation` f ON a.`spaID`= f.`spaID`
		WHERE d.`commonTypeId`='SpaFacility'
		AND e.`commonTypeId`='SpaType'
        AND a.`Status` = '1'";
        if(isset($ProductType_Cha) && $ProductType_Cha!="" && $ProductType_Cha!="0" && $ProductType_Cha!=0)
        {
            $sql .=" AND a.`ProductType` LIKE '$ProductType_Cha%'";
            $sqlcount .=" AND a.`ProductType` LIKE '$ProductType_Cha%'";
        } 
        if(isset($List_ProductType_Con) && $List_ProductType_Con!="")
        {
            $sql .=" AND FIND_IN_SET(a.`ProductType`, '$List_ProductType_Con')";
            $sqlcount .=" AND FIND_IN_SET(a.`ProductType`, '$List_ProductType_Con')";
        }
        if(!isset($PriceFrom) || (isset($PriceFrom) && $PriceFrom==""))
	       $PriceFrom=0;
        if(!isset($PriceTo) || (isset($PriceTo) && $PriceTo==""))
	       $PriceTo=9000000000;
        $sql .=" AND c.`Price` BETWEEN $PriceFrom AND $PriceTo";
        $sqlcount .=" AND c.`Price` BETWEEN $PriceFrom AND $PriceTo";
        if(isset($Location) && $Location!="")
        {
            $sql .=" AND f.`LocationID` = '$Location'";
            $sqlcount .=" AND f.`LocationID` = '$Location'";
        }
        if(isset($List_Uti) && $List_Uti!="")
        {
            $sql .=" AND FIND_IN_SET(d.`commonId`, '$List_Uti')";
            $sqlcount .=" AND FIND_IN_SET(d.`commonId`, '$List_Uti')";
        }
        if(isset($SpaName) && $SpaName!="")
        {
            $sql .=" AND b.`spaName` LIKE '%$SpaName%'";
            $sqlcount .=" AND b.`spaName` LIKE '%$SpaName%'";
        }
        if(isset($RecordStart) && $RecordStart!="" && $RecordStart>0)
            $sql .=" LIMIT $RecordStart,$RecordPerPage";
        else
            $sql .= " LIMIT 0,$RecordPerPage";
        //echo $sql;die;    
        $query=$this->db->query($sql)->result();
        $querycount=$this->db->query($sqlcount)->row();
        
        $arr=array("listspa"=>$query,
                    "totalspa"=>$querycount->TotalSpa);
        return $arr;
        
    }
    public function searchspa()
    {
        //echo $_POST['producttype'];die;
        $str="";
        $RecordPerPage=$this->GetSetting('catelogyTotalSpaperPage');
        $soproductperpage=$this->GetSetting('catelogyTotalProductperPage');
        $ProductType_Cha="";
        $List_ProductType_Con="";
        $PriceFrom=0;
        $PriceTo=9000000000;
        $Location="";
        $List_Uti="";
        $List_LoaiSpa="";
        $SpaName="";
        if(isset($_SESSION['indexsearch'])) //loai sp cha
        {
            if(isset($_SESSION['indexsearch']['producttypecha']) && $_SESSION['indexsearch']['producttypecha']!="") //loai sp cha
            {
                $ProductType=$_SESSION['indexsearch']['producttypecha'];
                if(isset($ProductType) && $ProductType!="")
                    $ProductType_Cha=$this->layidloaispcha_theotenloaisp($ProductType);
            }
        }
        else
        {
            if(isset($_POST['producttype']))
            {
                $ProductType_Cha=$_POST['producttype'];
                //echo $ProductType;die;
            }
        }
        if(isset($_SESSION['indexsearch'])) //loai sp con
        {
            if(isset($_SESSION['indexsearch']['producttype']) && $_SESSION['indexsearch']['producttype']!="") //loai sp cha
            {
                $childproducttype=$_SESSION['indexsearch']['producttype'];
                if(isset($childproducttype) && $childproducttype!="")
                    $List_ProductType_Con=$this->layidloaisp_theotenloaisp($childproducttype);
            }
        }
        else
        {
            if(isset($_POST['arrchildproducttype']))
            {
                $arrchildproducttyppe=$_POST['arrchildproducttype'];
                $List_ProductType_Con="";
                foreach($arrchildproducttyppe as $row_childproducttype)
                {
                    $List_ProductType_Con.=$row_childproducttype.", ";
                }
                $List_ProductType_Con=substr($List_ProductType_Con,0,(strlen($List_ProductType_Con)-2));
            }
        }
        //echo $List_ProductType_Con;die;
        if(isset($_SESSION['indexsearch'])) //location
        {
            if(isset($_SESSION['indexsearch']['location']) && $_SESSION['indexsearch']['location']!="") //loai sp cha
            {
                $Location=$_SESSION['indexsearch']['location'];
                $Location=$this->layidlocationtheoten($Location);
                if(isset($Location) && count($Location)>0)
                    $Location=$Location->CommonId;
                else
                    $Location="";
            }
        }
        else
        {
            if(isset($_POST['location']))
            {
                $Location=$_POST['location'];
                $Location=$this->layidlocationtheoten($Location);
                if(isset($Location) && count($Location)>0)
                    $Location=$Location->CommonId;
                else
                    $Location="";
            }
        }
        if(isset($_POST['amount']))
        {
            $amount=$_POST['amount'];
            $arr_amount=explode(" - ",$amount);
            $PriceFrom=(int)substr($arr_amount[0],0,(strlen($arr_amount[0])-1));
            $PriceFrom=$PriceFrom*1000;
            $PriceTo=(int)substr($arr_amount[1],0,(strlen($arr_amount[1])-1));
            $PriceTo=$PriceTo*1000;
        }
        if(isset($_POST['arrspafacilities'])) //tien ich spa
        {
            $arrspafacilities=$_POST['arrspafacilities'];
            $List_Uti="";
            foreach($arrspafacilities as $row_spafacilities)
            {
                $List_Uti.=$row_spafacilities.", ";
            }
            $List_Uti=substr($List_Uti,0,(strlen($List_Uti)-2));
        }
        if(isset($_POST['arrspatype'])) //loai spa
        {
            $arrspatype=$_POST['arrspatype'];
            $List_LoaiSpa="";
            foreach($arrspatype as $row_spatype)
            {
                $List_LoaiSpa.=$row_spatype.", ";
            }
            $List_LoaiSpa=substr($List_LoaiSpa,0,(strlen($List_LoaiSpa)-2));
        }
        $RecordStart=0;
        if(isset($_POST['page']) && $_POST['page']>0)
            $RecordStart=($_POST['page']-1)*$RecordPerPage;
        if(isset($_SESSION['indexsearch'])) //loai sp con
        {
            if(isset($_SESSION['indexsearch']['SpaName']) && $_SESSION['indexsearch']['SpaName']!="") //loai sp cha
            {
                $SpaName=$_SESSION['indexsearch']['SpaName'];
            }
        }
        else
        {
            if(isset($_POST['SpaName']))
                $SpaName=$_POST['SpaName'];
        }
        if(!isset($_SESSION['indexsearch']) && ($ProductType_Cha=="0" || $ProductType_Cha==0))
            $List_ProductType_Con="";
        $res=$this->xuly($ProductType_Cha,$List_ProductType_Con,$PriceFrom,$PriceTo,$Location,$List_Uti,$List_LoaiSpa,$SpaName,$RecordStart);
        
        $tongmautin=$res['totalspa'];
        if($tongmautin%$RecordPerPage!=0)
            $sotrang=floor($tongmautin/$RecordPerPage)+1;
        if($tongmautin%$RecordPerPage==0)
            $sotrang=$tongmautin/$RecordPerPage;
        $page=floor($RecordStart/$RecordPerPage)+1;
        //
        $str="";
        if(count($res['listspa'])>0)
        {       
            foreach($res['listspa'] as $row)

            {   
                $spaid = $row->spaID;
                $hinhspa=$this->layhinhspa_theospaid($spaid);
                $ttspa=$this->layttspa_theospaid($spaid);
                // viết thêm vào ngày 09/01/2015
                $listspspa = "";
                if(isset($_POST['arrchildproducttype']))
                {
                    $arrchildproducttyppe=$_POST['arrchildproducttype'];
                    $List_ProductType_Con="";
                    foreach($arrchildproducttyppe as $row_childproducttype)
                    {
                        $List_ProductType_Con.=$row_childproducttype.", ";
                    }
                    $List_ProductType_Con=substr($List_ProductType_Con,0,(strlen($List_ProductType_Con)-2));
                }
                //echo $List_ProductType_Con;die;
                $listspspa=$this->laylistsp_theospaid_gia($spaid,$ProductType_Cha,$List_ProductType_Con,$PriceFrom,$PriceTo);
                //$listspspa=$this->laylistsp_theospaid_gia($spaid,$PriceFrom,$PriceTo);
            
                if(count($hinhspa)>0)
                    $linkhinh=$hinhspa->URL;
                else
                    $linkhinh=base_url('resources/front/images/nospaimages.png');

                $str.='<div class="cat-product-box shadow-box box-padding">';

            //$str.='<a href="../nhaplieuspa/spadetail/index/'.$row['spa']->spaID.'" class="wrap-thumb" style="background-image:url(images/business.jpg);"></a>';

                    $str.='<a href="'.base_url('spadetail/index/'.$spaid).'" class="wrap-thumb" style="background-image:url('.$linkhinh.');"></a>';

                    $str.='<div class="wrap-description">';
                        $str.='<h3 class="title" id="bookmark_'.$spaid.'" name="bookmark_'.$spaid.'"><a href="'.base_url('spadetail/index/'.$spaid).'">'.$ttspa->spaName.'</a>';
                        $str.='<div class="wrap-button-like"><div class="fb-like" data-href="'.base_url('spadetail/index/'.$spaid).'" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div></div>';
                      $str.='</h3>';
                        $str.='<div class="shop-location">'.$ttspa->Address.'</div>';
                        
                        $str.='<div class="wrap-share-button">';
                            $str.='<span class="label">Share this: </span>';
                            $str.='<span class=\'st_facebook_large\' displayText=\'Facebook\'></span>';
                            $str.='<span class=\'st_twitter_large\' displayText=\'Tweet\'></span>';
                            $str.='<span class=\'st_linkedin_large\' displayText=\'LinkedIn\'></span>';
                            $str.='<span class=\'st_googleplus_large\' displayText=\'Google +\'></span>';
                            $str.='<span class=\'st_sharethis_large\' displayText=\'ShareThis\'></span>';
                        $str.='</div>';
                     $str.='</div>';
                    
                    if(count($listspspa)>0)
                    {
                        $str.='<table class=" table table-striped table-hover wrap-product-lists col-md-12" width="100%" border="0" cellspacing="0" cellpadding="5">';
                        
                        $j=1;
                        for($i=0;$i<count($listspspa);$i++)
                        {
                            $promotionid=0;
                            $idsp=$listspspa[$i]->ProductID;
                            //khuyen mai
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
                                                        $pricekm=$this->m_index->laygiasp_theomasp($idsp);
                                                        $flagkhuyenmai=1;
                                                        break;
                                                    }
                                                }
                                            }
                                            if($flagkhuyenmai==1 || $flagkhuyenmai=="1") //khuyen mai vang
                                            {
                                                
                                                
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
                            $pricegoc=$this->laygiasp_theomasp($listspspa[$i]->ProductID)->Price;
                            if($j%$soproductperpage==1)
                            {
                                $pagepro=floor($j/$soproductperpage)+1;
                                if($j==1)
                                    $str.='<tbody id="tbody_'.$spaid.'_'.$pagepro.'">';
                                else
                                    $str.='<tbody id="tbody_'.$spaid.'_'.$pagepro.'" style="display:none;">';
                            }
                            $str.='<tr class="product-item">';
                              $str.='<td class="item-title"><a href="javascript:void(0)" data-toggle="modal" data-target="#serviceModal" onclick="showdetailpro(\''.$listspspa[$i]->ProductID.'\',\''.$promotionid.'\');">'.$listspspa[$i]->Name.'</a></td>';
                              if($flagkhuyenmai!="0" && $flagkhuyenmai!=0)
                                    $str.='<td><strike>'.number_format($pricegoc).'</strike></td>';
                              $str.='<td><button onclick="showdetailpro(\''.$listspspa[$i]->ProductID.'\',\''.$promotionid.'\');" class="btn btn-default price" data-toggle="modal" data-target="#serviceModal"><span>';
                                if($flagkhuyenmai!="0" && $flagkhuyenmai!=0)
                                    $str.= number_format($pricekm);
                                else
                                    $str.= number_format($pricegoc);
                              $str.='</span> VNĐ</button></td>';
                            $str.='</tr>';
                            if($j%$soproductperpage==0)
                            {
                                $str.='</tbody>';
                            }
                            $j++;
                        }
                        $str.='</tbody>';
                        if(count($listspspa)>$soproductperpage)
                        {
                            $str.='<tbody id="trbutton_'.$spaid.'">';
                                $str.='<tr class="product-item">';
                                $str.='<td><button id="btnxembot_'.$spaid.'" class="btn btn-default" style="display:none;" onclick="showless(\''.$spaid.'\');">Show less</button></td>';
                                $str.='<td><button id="btnxemthem_'.$spaid.'" class="btn btn-default" onclick="showlistpro(\''.$spaid.'\',2,\''.$pagepro.'\');">Xem thêm</button></td>';
                                $str.='</tr>';
                            $str.='</tbody>';
                        }
                      $str.='</table>';
                    }
                $str.='</div>';
            }
        }
        else
            $str.="<h2>Không tìm thấy kết quả</h2>";
        //echo $str;die;
            $res=array("str"=>$str,"tongmautin"=>$tongmautin,"sotrang"=>$sotrang,"TrangHienTai"=>$page);
        return $res;
    }
    public function layidlocationtheoten($locationstr)
    {
        $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId`='Location' and `StrValue1` = '$locationstr'";
        $query=$this->db->query($sql)->row();
            return $query;
    }
    public function layttspa_theospaid($spaid)
    {
        $sql="SELECT * FROM `spa` WHERE `spaID`='$spaid' AND `Status` = '1'";
        $query=$this->db->query($sql)->row();
        return $query;
    }
    public function laylistsp_theospaid_gia($spaid,$typeCha,$List_ProductType_Con,$fromgia,$togia)
    {
        if($typeCha==0 || $typeCha=="0") //loai cha la any
        {
            $sql= "SELECT DISTINCT a.`ProductID`, a.`SpaID`, a.`Name`,b.`Price` FROM `products` a, `price` b 
                WHERE a.`ProductID`=b.`ProductID` AND a.`SpaID`= '$spaid' AND b.`Price` BETWEEN $fromgia AND $togia  AND a.`Status`= '1'
                ORDER BY b.`CreatedDate` DESC"; //AND a.`Status`=1
        }
        else
        {
            if($List_ProductType_Con=="") //co loai cha va khong co list loai con
            {
                $sql= "SELECT DISTINCT a.`ProductID`, a.`SpaID`, a.`Name`,b.`Price` FROM `products` a, `price` b 
                    WHERE a.`ProductID`=b.`ProductID` AND `ProductType` LIKE '$typeCha%' AND a.`SpaID`= '$spaid' AND b.`Price` BETWEEN $fromgia AND $togia  AND a.`Status`= '1'
                    ORDER BY b.`CreatedDate` DESC";
            }
            else //co loai cha va co list loai con
            {
                $sql= "SELECT DISTINCT a.`ProductID`, a.`SpaID`, a.`Name`,b.`Price` FROM `products` a, `price` b 
                    WHERE a.`ProductID`=b.`ProductID` AND `ProductType` IN ($List_ProductType_Con) AND a.`SpaID`= '$spaid' AND b.`Price` BETWEEN $fromgia AND $togia AND a.`Status`= '1'
                    ORDER BY b.`CreatedDate` DESC";
            }
        }
        
        $query=$this->db->query($sql)->result();
        return $query;
    }
    // viết thêm vào ngày 09/01/2015
    /* public function laylistsp_theospaid_gia($spaid,$typeCha,$List_ProductType_Con,$fromgia,$togia)
    {
        $typelist = array();
        $typelist = explode(',',$List_ProductType_Con);
        
        if(isset($List_ProductType_Con))
        {
             for($i =0; $i<= count($typelist)-1; $i++){
             $maCate = $typelist[$i];
             if($maCate !=0){
           
                $sql= "SELECT DISTINCT a.`ProductID`, a.`SpaID`, a.`Name`,b.`Price` FROM `products` a, `price` b 
                    WHERE a.`ProductID`=b.`ProductID` AND a.`SpaID`= '$spaid' AND a.`ProductType` = '$maCate' AND b.`Price` BETWEEN $fromgia AND $togia 
                    ORDER BY b.`CreatedDate` DESC"; //AND b.`Status`=1
                    $query=$this->db->query($sql)->result();
                    return $query;
                 }
             }
                
        }
        else{
            
             $sql= "SELECT DISTINCT a.`ProductID`, a.`SpaID`, a.`Name`,b.`Price` FROM `products` a, `price` b 
               WHERE a.`ProductID`=b.`ProductID` AND a.`SpaID`= '$spaid' AND b.`Price` BETWEEN $fromgia AND $togia 
               ORDER BY b.`CreatedDate` DESC"; //AND b.`Status`=1
              $query=$this->db->query($sql)->result();
              return   $query;  
        }
        
    }*/

    
    public function layhinhspa_theospaid($spaid)
    {
        $sql="SELECT * FROM `links` WHERE `Type`='SPA' AND `ObjectIDD`='$spaid' ORDER BY `id` DESC";
        $query=$this->db->query($sql)->row();
        return $query;
    }
    public function GetSetting($key)
   {
       $val= $this->m_mail->GetSetting($key);
       return $val;
   }
   public function laygiasp_theomasp($masp)
    {
        $sql="SELECT * FROM `price` WHERE `ProductID`='$masp' ORDER BY `Id` DESC";
        $query=$this->db->query($sql)->row();
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
            WHERE a.`ProductID`= b.`ProductID` and a.`Status` = '1' and a.ProductType='$producttype' and b.Price > ".$fromprice." and b.Price < ".$toprice;
        $query=$this->db->query($sql)->result();
        return $query;
    }
    public function layspatheoid($spaid)
    {
        $sql="SELECT spaID,spaName,Address,Intro FROM `spa` WHERE `spaID`='$spaid' AND `Status` = '1' ";
        $query=$this->db->query($sql)->row();
        return $query;
    }
    public function layproducttheospaid($spaid)
    {
        $sql="SELECT * FROM `products` WHERE `SpaID`='$spaid' AND `Status` = '1' ";
        $query=$this->db->query($sql)->result();
        return $query;
    }
    public function layproducttheoproductid($proid)
    {
        $sql="SELECT a.`ProductID`, a.`Name`, b.`Price` FROM `products` a, price b WHERE a.`ProductID`='$proid' AND a.`ProductID`=b.`ProductID` AND a.`Status` = '1'";
        $query=$this->db->query($sql)->row();
        return $query;
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
                    //foreach($query as $row)
                        //$str .= '<input type="checkbox" name="childproducttype" class="childproducttype" id="childproducttype_'.$row->CommonId.'" value="'.$row->CommonId.'"  onclick="stepcbb();" checked="checked"/>'.$row->StrValue2.'<br />';
                    //$str .= '</div>';
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
    
   public function layspatheospaname($spaname)
    {
        $sql="SELECT `spaID` FROM `spa` WHERE `spaName` LIKE '%$spaname%' AND `Status` = '1' ";
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
    public function layloaispcon_theoidloaispcha($idloaispcha)
    {
        $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND `CommonId` like '$idloaispcha%' AND LENGTH(CommonId)=4";
        $query=$this->db->query($sql)->result();
        return $query;
    }
   
}
?>