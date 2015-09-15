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
            $cap1 = $this->db->query($sql)->result_array();
            // $arr1 = (array) $cap1;     
            //func_print_test($cap1);
            return $cap1;
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
            if(isset($_POST['sortby'])){
                $sortby=$_POST['sortby'];    
            }
            else
            {
                $sortby= '01';   
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
            else
            {
                if(isset($_POST["SpaName"]))
                {
                    $spaname = $_POST["SpaName"];
                    $arr_spaname=$this->layspatheospaname($spaname);
                    $arr_spaname=array_unique($arr_spaname);
                    $count_spaname=count($arr_spaname);
                }
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
         //   func_print_test($_POST['producttype']);
            if(isset($_SESSION['indexsearch']))
            {
                $name_childproducttype = "";
                if(isset($_SESSION['indexsearch']['producttype']))
                    $name_childproducttype=$_SESSION['indexsearch']['producttype'];
                //echo  $name_childproducttype;
                $id_childproducttype=$this->layidloaisp_theotenloaisp($name_childproducttype);   
                $producttype=substr($id_childproducttype,0,2);
                //echo  $producttype;

                if(isset($_SESSION['indexsearch']['producttypepanter']))
                    $producttype = $_SESSION['indexsearch']['producttypepanter'];    
            }
            else
            {
                if(isset($_POST['producttype']) && $_POST['producttype']!=0 && $_POST['producttype']!='0' && $_POST['producttype']!="")
                {
                    $producttype=$_POST['producttype'];
                }

            }       
             
            // search theo loại sản phẩm cha
            // if(isset($_SESSION['indexsearch']))
            //        {
            //$producttype = "";
            //            if(isset($_SESSION['indexsearch']['producttypepanter']))
            //                $producttype = $_SESSION['indexsearch']['producttypepanter'];
            //            
            //        }

            //$producttype='0103';
            if(isset($_POST['page']) && $_POST['page'] != "")
                $page=$_POST['page'];
            else
                $page=1;
            //$page=1;


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
                    //echo   $sql_spaproducttype;

                }
                else
                {
                    $sql_spaproducttype="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND `CommonId` like '$producttype%' AND LENGTH(`CommonId`)=4";
                    //echo   $sql_spaproducttype;
                }
            }
            else
            {
                $sql_spaproducttype="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND LENGTH(`CommonId`)=4";
                //echo   $sql_spaproducttype;

            }

            //if(isset($producttypepanter) && $producttypepanter !="" &&  $producttypepanter != "0" &&  $producttypepanter!=0 ){
            //            
            //        }
            if(($count_childproducttype!=0 || $count_childproducttype!="0") && isset($producttype) && $producttype!="" && $producttype!=0) 
            {
                $sql_spaproducttype="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND `commonId` IN ($str_childproducttype)";
                //echo  $sql_spaproducttype;
            }

            $query_spaproducttype=$this->db->query($sql_spaproducttype)->result();
            //echo "<pre>";
            //        print_r($query_spaproducttype);
            //        die();
            $arr_pro=array();
            //set gia
            if(!isset($fromprice) || $fromprice=="" || $fromprice==0 || $fromprice=='0')
                $fromprice=0;
            if(!isset($toprice) || $toprice=="" || $toprice==0 || $toprice=='0')
                $toprice=10000000000;
            //end set gia
            foreach($query_spaproducttype as $row_spaproducttype)
            {         
                if($sortby == '02')
                {
                    $arr_pro[]=$this->laysptheoproducttype_vs_price($row_spaproducttype->CommonId,$fromprice,$toprice,1); 
                }
                else
                {                
                    $arr_pro[]=$this->laysptheoproducttype_vs_price($row_spaproducttype->CommonId,$fromprice,$toprice,0);
                }
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
            /*echo "<pre>";
            print_r($arr_pro2);
            echo "</pre>";   die; */ 
            
            //dung de tim phan tu chung khi search sp khuyen mai
            $str_pro = "";
            $arr_pro_discount = array();
            
            $arr_spa_unique=array();
            foreach($arr_pro2 as $row_pro3)
            {
                //dung de tim phan tu chung khi search sp khuyen mai
                $arr_pro_discount[] = $row_pro3->ProductID;
                $str_pro .= $row_pro3->ProductID.", ";
                                                
                $arr_spa_unique[]=$row_pro3->SpaID;
            }
            $str_pro = substr($str_pro,0,(strlen($str_pro)-2));
            
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
            if($sortby == '03')
            {
                $array_spaKM = array();

                foreach($arr_spa_unique as $row_spa_unique1)
                {
                    $sql="SELECT  DISTINCT(p.spaID)    
                            FROM (SELECT `ProductId` 
                                    FROM `promotiondetails` 
                                    WHERE  `PromotionId` IN (SELECT `PromotionId`
                                                 FROM `promotions`
                                                 WHERE CURDATE() BETWEEN DATE(`BeginDateTime`) 
                                                 AND DATE(`EndDateTime`))) pr ,`products` p 
                            WHERE pr.`ProductId` = p.`ProductId` and p.`ProductId` in ($str_pro) and  p.`spaID`='$row_spa_unique1' ";  
                    $ob_spaid=$this->db->query($sql)->result_array(); 
                    if(count($ob_spaid)>0)      
                        $array_spaKM[] =  $row_spa_unique1;  
                }
               
                $arr_spa_unique = $array_spaKM;
                //$arr_spa_unique=array_intersect ($arr_spa_unique, $array_spaKM); //lay phan tu giong nhau giua 2 mang
               // func_print_test($arr_spa_unique); 
            }
            
            if($sortby == '04')
            {
                $array_view = array();

                foreach($arr_spa_unique as $row_spa_unique1)
                {
                    $sql="SELECT CountView FROM `spa` WHERE `spaID`='$row_spa_unique1' ";  
                    $ob_count_view=$this->db->query($sql)->row();
                    $count_view = $ob_count_view->CountView;   
                    $array_view[$row_spa_unique1]  =  $count_view;
                }
                arsort($array_view) ;  
                $arr_spa_unique_step2 = array();
                foreach($array_view as $k=>$v){
                    $arr_spa_unique_step2[] =  $k;
                }
                $arr_spa_unique =    $arr_spa_unique_step2; 
            }
            if($sortby == '05')
            {
                $array_bookindex = array();

                foreach($arr_spa_unique as $row_spa_unique1)
                {
                    $sql="SELECT BookIndex FROM `spa` WHERE `spaID`='$row_spa_unique1' ";  
                    $ob_bookindex=$this->db->query($sql)->row();
                    $bookindex = $ob_bookindex->BookIndex;   
                    $array_bookindex[$row_spa_unique1]  =  $bookindex;
                }
                asort($array_bookindex) ;  
                $arr_spa_unique_step2 = array();
                foreach($array_bookindex as $k=>$v){
                    $arr_spa_unique_step2[] =  $k;
                }
                $arr_spa_unique =    $arr_spa_unique_step2; 
            }

           
            
            
            //func_print_test($arr_spa_unique); die;   

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
                            if($sortby == 3) //sort theo khuyen mai
                            {
                                $list_spkm_theo_spa = $this->lay_sp_khuyen_mai_theo_spa($row_spa_unique);
                                foreach($list_spkm_theo_spa as $row_spkm)
                                {
                                    $arr_productid[]=$row_spkm->ProductID;
                                }
                                $arr_productid=array_intersect ($arr_productid, $arr_pro_discount); //lay phan tu giong nhau giua 2 mang
                            }
                            else //k co sort theo khuyen mai
                            {
                                foreach($arr_pro2 as $row_product)
                                {
                                    if($row_spa_unique==$row_product->SpaID)
                                    {
                                        $arr_productid[]=$row_product->ProductID;
                                    }
                                }
                            }
                            $arr_productid=array_unique($arr_productid);
                            
                            $arr_product=array();
                            foreach($arr_productid as $row_productid)
                            {
                                $arr_product[]=$this->layproducttheoproductid($row_productid);
                            }
                            if($sortby == 2)
                            {
                                $arr_product_temp =  array();
                                foreach($arr_product as $row_product2)
                                {
                                    $arr_product_temp[$row_product2->ProductID] = $row_product2->Price;
                                }
                                asort($arr_product_temp); 
                                $arr_productid2 = array();
                                foreach($arr_product_temp as $key => $val)
                                {
                                    $arr_productid2[] = $key;
                                }     
                                $arr_product2 = array();  
                                foreach($arr_productid2 as $row_productid2)
                                {
                                    $arr_product2[]=$this->layproducttheoproductid($row_productid2);
                                }   
                            }
                                             
                            //$arr2 = array_msort($arr_product, array('Price'=>SORT_ASC, 'ProductID'=>SORT_ASC));
                            /*usort($arr_product, function($a, $b)
                            {
                                return strcmp($a->Price, $b->Price);
                            });*/
                            if($sortby == 2)
                                $arr_res[$i]["listpro"]=$arr_product2;
                            else
                                $arr_res[$i]["listpro"]=$arr_product;
                            $arr_res[$i]["hinhspa"] = $this->layhinhtheospaid($row_spa_unique);
                        }
                    }

                }      
            }
            
            /*echo "<pre>";
            print_r($arr_res);
            echo "</pre>";
            die;*/ 
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
                        $str.='<span class="st_facebook_large" displaytext="Facebook" st_processed="yes"> ';
                        $str.= '<span style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton">';
                        $str.= '<span class="stLarge" style="background-image: url(http://w.sharethis.com/images/facebook_32.png);"></span></span></span>';
                        
                        $str.='<span st_processed="yes" class="st_twitter_large" displaytext="Tweet"><span class="stButton" style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;"><span style="background-image: url(&quot;http://w.sharethis.com/images/twitter_32.png&quot;);" class="stLarge"></span></span></span>';
                        $str.='<span st_processed="yes" class="st_linkedin_large" displaytext="LinkedIn"><span class="stButton" style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;"><span style="background-image: url(&quot;http://w.sharethis.com/images/linkedin_32.png&quot;);" class="stLarge"></span></span></span>';
                        $str.='<span st_processed="yes" class="st_googleplus_large" displaytext="Google +"><span class="stButton" style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;"><span style="background-image: url(&quot;http://w.sharethis.com/images/googleplus_32.png&quot;);" class="stLarge"></span></span></span>';
                        $str.='<span st_processed="yes" class="st_sharethis_large" displaytext="ShareThis"><span class="stButton" style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;"><span style="background-image: url(&quot;http://w.sharethis.com/images/sharethis_32.png&quot;);" class="stLarge"></span></span></span>';
                        $str.='</div>';
                        $str.='</div>';

                        if(count($row['listpro'])>0)
                        { 
                            $str.='<table class=" table table-striped table-hover wrap-product-lists col-md-12" width="100%" border="0" cellspacing="0" cellpadding="5">';

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
                                if(count($listPromo) == 0)
                                {  
                                        $str.='<td class="item-title"><a href="javascript:void(0)"><span data-toggle="modal" data-target="#serviceModal" onclick="showdetailpro(\''.$row['listpro'][$i]->ProductID.'\');">'.$row['listpro'][$i]->Name.'</span></a></td>';
                                        $str.='<td class="item-discount"></td>';
                                        $str.='<td class="item-price"><button onclick="showdetailpro(\''.$row['listpro'][$i]->ProductID.'\');" class="btn btn-default price" data-toggle="modal" data-target="#serviceModal"><span>'.number_format($row['listpro'][$i]->Price).'</span> VNĐ</button></td>'; 
                                }
                                else {
                                    
                                    // $nowtime = strtotime(date("Y-m-d H:m:s"));
                                    // if(strtotime($listPromo[0]->BeginDateTime) <= $nowtime && $nowtime<=strtotime($listPromo[0]->EndDateTime)){
                                        
                                        $a=(($row['listpro'][$i]->Price)-($listPromo[0]->Price))/($row['listpro'][$i]->Price)*100;
                                        $savepercent=round($a);       
                                        $str.='<td class="item-title"><a href="javascript:void(0)"><span data-toggle="modal" data-target="#serviceModal" onclick="showdetailpro(\''.$row['listpro'][$i]->ProductID.'\',\''.$listPromo[0]->PromotionId.'\');">'.$row['listpro'][$i]->Name.'</span></a></td>';
                                        $str.='<td class="item-discount"><span class="savings"><img width=70 src="'.base_url('resources/front/images/discount.png').'"><span class="title"></span><span class="value">'.$savepercent.'%</span></span></td>';
                                        $str.='<td class="item-price"><button onclick="showdetailpro(\''.$row['listpro'][$i]->ProductID.'\',\''.$listPromo[0]->PromotionId.'\');" class="btn btn-default price" data-toggle="modal" data-target="#serviceModal"><span>'.number_format($listPromo[0]->Price).'</span> VNĐ</button></td>';
                                    //}
                                    

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
            WHERE a.`PromotionId`=b.`PromotionId`
            AND a.`ProductId`='$ProductId' 
            AND CURDATE() BETWEEN DATE(b.`BeginDateTime`) 
            AND DATE(b.`EndDateTime`) ";
            $query = $this->db->query($sql)->result();
            return $query;
        }

        public function layspatheolocationid($locationid)
        {
            $sql="SELECT `spaID`,`LocationID` FROM `spalocation` WHERE `LocationID`= '$locationid'";
            $query=$this->db->query($sql)->result();
            return $query;
        }
        public function laysptheoproducttype_vs_price($producttype,$fromprice,$toprice,$sort)
        {
            if($sort == 0)
            {
                $sql="SELECT a.`ProductID`, a.`Name`, b.`Price`, a.`SpaID` 
                FROM `products` a, `price` b 
                WHERE a.`ProductID`=b.`ProductID` 
                and b.`Status`=1 
                and a.`Status`=1 
                and a.ProductType='$producttype' 
                and b.Price > ".$fromprice." and b.Price < ".$toprice;   
            }
            else
            {
                $sql="SELECT a.`ProductID`, a.`Name`, b.`Price`, a.`SpaID` 
                FROM `products` a, `price` b 
                WHERE a.`ProductID`=b.`ProductID` 
                and b.`Status`=1 
                and a.`Status`=1 
                and a.ProductType='$producttype' 
                and b.Price > ".$fromprice." and b.Price < ".$toprice. " order by  b.`Price` ASC";  
            }     
            $query=$this->db->query($sql)->result();
            return $query;
        }
        public function layspatheoid($spaid)
        {
            $sql="SELECT spaID,spaName,Address,Intro,CountView FROM `spa` WHERE `spaID`='$spaid' AND `Status` = '1'";
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
            AND a.`Status` = 1 
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
               // func_print_test($producttype) ;
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
                        $str .= '<input type="checkbox" name="childproducttype" class="childproducttype" id="childproducttype_'.$row->CommonId.'" value="'.$row->CommonId.'"  onclick="re_searchspa();" />'.$row->StrValue2;
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
        //
        public function lay_sp_khuyen_mai_theo_spa($spaid)
        {
            $sql = "SELECT DISTINCT a.`ProductID` 
                    FROM `products` a, `spa` b 
                    WHERE a.`SpaID` = b.`spaID` AND a.`Status` = 1 AND b.`spaID` = '$spaid' AND 
                    a.`ProductID` IN (SELECT c.`ProductId` FROM `promotiondetails` c,`promotions` d 
                    			WHERE c.`PromotionId` = d.`PromotionId` AND CURDATE() BETWEEN DATE(d.`BeginDateTime`) AND DATE(d.`EndDateTime`))";
            $query = $this->db->query($sql)->result();
            return $query;
        }
        function cmp($a, $b)
        {
            return strcmp($a->Price, $b->ProductID);
        }
    }  
?>
