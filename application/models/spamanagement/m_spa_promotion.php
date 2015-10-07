<?php
    class M_spa_promotion extends CI_Model{
        public function __construct()
        {
            parent::__construct();

        }


        /*
        |----------------------------------------------------------------
        |function list products
        |----------------------------------------------------------------
        */

        public function list_promotions(){
            $spaid    = $_POST['spaid'];
            $keyword    = $_POST['keyword'];
            $page       = $_POST["Page"];

            $sql = "SELECT distinct(p.`PromotionId`) ,pp.*, '0' AS DS_Products FROM `promotiondetails` p , `promotions` pp, `products` pro WHERE p.`ProductId` = pro.`ProductID` AND p.`PromotionId` = pp.`PromotionId` AND pro.`SpaID` = '$spaid'";           
            $sql1 ="SELECT count(distinct(p.`PromotionId`)) as Total FROM `promotiondetails` p , `promotions` pp, `products` pro WHERE p.`ProductId` = pro.`ProductID` AND p.`PromotionId` = pp.`PromotionId` AND pro.`SpaID` = '$spaid'";

            
            if($keyword  !=''){
                $sql = $sql." and `name` like '%".$keyword ."%'";
                $sql1 = $sql1." and `name` like '%".$keyword ."%'";
            }

            $sql = $sql." order by pp.EndDateTime DESC";
            
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            // return $sql;

            $_arrSpa = $this->db->query($sql)->result();

            $this->AddSTT_product($_arrSpa,$page); 

            $this->Add_product($_arrSpa); 

            $ResTotalPage = $this->db->query($sql1)->result();
            $TotalRecord = ( $ResTotalPage[0]->Total);
            //$TotalRecord = 0;
            $TotalPage = 1;
            if($TotalRecord % 10 !=0)
            {
                $TotalPage = floor($TotalRecord /10) + 1;
            }
            else
            {
                $TotalPage = floor($TotalRecord /10) ;
            }
                
            $res = array("TotalRecord"=>$TotalRecord,"TotalPage"=>$TotalPage,"CurPage"=>$page,"lst"=>$_arrSpa, "Toto"=>$ResTotalPage);
            return $res;
        }

         /*
        |----------------------------------------------------------------
        |function search_nangcao_Promotions
        |----------------------------------------------------------------
        */

        public function search_nangcao_Promotions(){

            $spaid    = $_POST['spaid'];
            $PromotionId    = $_POST['PromotionId'];
            $PromotionName    = $_POST['PromotionName'];
            $PromotionType    = $_POST['PromotionType'];
            $page       = $_POST["Page"];
          
            $sql = "SELECT distinct(p.`PromotionId`) ,pp.*, '0' AS DS_Products FROM `promotiondetails` p , `promotions` pp, `products` pro WHERE p.`ProductId` = pro.`ProductID` AND p.`PromotionId` = pp.`PromotionId` AND pro.`SpaID` = '$spaid'";           
            $sql1 ="SELECT count(distinct(p.`PromotionId`)) as Total FROM `promotiondetails` p , `promotions` pp, `products` pro WHERE p.`ProductId` = pro.`ProductID` AND p.`PromotionId` = pp.`PromotionId` AND pro.`SpaID` = '$spaid'";

                    
            // $sql = $sql." where 1=1 ";
            // $sql1 = $sql1." where 1=1 ";            
          
            
            if($PromotionId  !=''){
                $sql = $sql." and p.`PromotionId` like '%".$PromotionId ."%'";
                $sql1 = $sql1." and p.`PromotionId` like '%".$PromotionId ."%'";
            }
            if($PromotionName  !=''){
                $sql = $sql." and pp.`PromotionName` like '%".$PromotionName ."%'";
                $sql1 = $sql1." and pp.`PromotionName` like '%".$PromotionName ."%'";
            }
            if($PromotionType  !=''){
                $sql = $sql." and pp.`PromotionType` = '".$PromotionType ."'";
                $sql1 = $sql1." and pp.`PromotionType` = '".$PromotionType ."'";
            }

             $sql = $sql." order by pp.`EndDateTime` DESC";
            
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            // return $sql;

            $_arrSpa = $this->db->query($sql)->result();

            $this->AddSTT_product($_arrSpa,$page); 


            $this->Add_product($_arrSpa); 
            // return $_arrSpa;



            //$_arrSpa = $this->db->query($sql)->result(); 
            /// duyet cho stt zo
                   
            $ResTotalPage = $this->db->query($sql1)->result();
            $TotalRecord = ( $ResTotalPage[0]->Total);
            //$TotalRecord = 0;
            $TotalPage = 1;
            if($TotalRecord % 10 !=0)
            {
                $TotalPage = floor($TotalRecord /10) + 1;
            }
            else
            {
                $TotalPage = floor($TotalRecord /10) ;
            }
                
            $res = array("TotalRecord"=>$TotalRecord,"TotalPage"=>$TotalPage,"CurPage"=>$page,"lst"=>$_arrSpa, "Toto"=>$ResTotalPage);
            return $res;
        }

        public function AddSTT_product($arr,$page)
        {
            $arr1 = (array) $arr;
            for($i=0;$i<count($arr1);$i++)
            {
                $arr1[$i]->STT = (($page-1)*10+($i+1));
            }
            return $arr1;
        }
        public function Add_product($arr)
        {
            $arr1 = (array) $arr;
            for($i=0;$i<count($arr1);$i++)
            {
                $sql = "SELECT pro.* FROM `promotiondetails` p ,`products` pro WHERE p.`PromotionId` = ".$arr1[$i]->PromotionId." AND pro.`ProductID`= p.`ProductId`";
                // return $sql;
                $arr1[$i]->DS_Products =  $this->db->query($sql)->result();
                // $arr1[$i]->DS_Products =  $sql; 
            }
            return $arr1;
        }
        

        public function get_product_types(){
            $str="<option value=\"\">Chọn loại dịch vụ</option>";
            $sql = "SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND LENGTH(`CommonId`)=2 AND `NumValue1`=1 "; //lấy cấp 1
            $ListCap1 = $this->db->query($sql)->result();
            $arr1= (array)$ListCap1;
            for($i=0; $i<count($arr1);$i++)
            {
                $str = $str."<optgroup label=\"".$arr1[$i]->CommonId." - ".$arr1[$i]->StrValue2."\">";
                $cap1=$arr1[$i]->CommonId;
                $sql1 = "SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType'  AND `NumValue1`=1 AND LENGTH(`CommonId`)=4 AND LEFT(`CommonId`,2)='$cap1'";
                $ListCap2 = $this->db->query($sql1)->result();
                $arr2= (array)$ListCap2;
                for($j=0; $j<count($arr2);$j++)
                {
                    $str = $str."<option value=\"".$arr2[$j]->CommonId ."\">".$arr2[$j]->CommonId." - ".$arr2[$j]->StrValue2."</option>";
                }
                $str = $str."</optgroup>"; 
            }
            return $str;
        }
        public function get_producttype_by_spaid($spaid)
        {
            $sql        =   "SELECT s.`ProductType`,c.`StrValue2` FROM `spaproductype` s, `commoncode` c WHERE c.`CommonId` = s.`ProductType` AND s.`spaID` = '$spaid' ORDER BY s.`ProductType`";
            
            $query      =   $this->db->query($sql)->result();
            
            return $query;
        }

        public function get_product_types_spa(){
            $spaid = $_SESSION["AccSpa"]["spaid"];
            $str="<option value=\"\">Chọn loại dịch vụ</option>";
            $sql = "SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND LENGTH(`CommonId`)=2 AND `NumValue1`=1 "; //lấy cấp 1
            $ListCap1 = $this->db->query($sql)->result();
            $arr1= (array)$ListCap1;

            $spa_producttype        =   $this->get_producttype_by_spaid($spaid);
            $arr2= (array)$spa_producttype;
            
            for($i=0; $i<count($arr1);$i++)
            {
                $str = $str."<optgroup label=\"".$arr1[$i]->CommonId." - ".$arr1[$i]->StrValue2."\">";
                $cap1=$arr1[$i]->CommonId;

                for($j=0; $j<count($arr2);$j++)
                {
                    $kitu = substr($arr2[$j]->ProductType, 0, 2);
                    if($cap1 == $kitu ){
                        $str = $str."<option value=\"".$arr2[$j]->ProductType ."\">".$arr2[$j]->ProductType." - ".$arr2[$j]->StrValue2."</option>";
                    }
                }
                $str = $str."</optgroup>"; 
            }
            return $str;
        }


        /*
        |----------------------------------------------------------------
        |function add_thongtin_product
        |----------------------------------------------------------------
        */

        public function add_thongtin_promotion(){ 
            $PromotionId =  $this->getPromotionID();
            $PromotionName  = $_POST["PromotionName"];
            $PromotionType  = "Package";
            $Quantity  = $_POST["Quantity"];
            $BeginDateTime  = $_POST["BeginDateTime"]." 00:00:00";
            $EndDateTime  = $_POST["EndDateTime"]." 00:00:00";
            $TotalAmount  = $_POST["TotalAmount"];
            $PromoText  = $_POST["PromoText"];
            $CreatedBy=$_SESSION['AccSpa']['User']->UserId;

            $PrintToBill=1;

            $Product_check        =   $_POST["Product_check"];

            $SpaID = $_SESSION["AccSpa"]["spaid"];
            // return $PromotionID;
            
            $Tong_hientai=0;
            foreach( $Product_check as $row_Product)
            {
                $sql_t= "SELECT `Price` FROM `price` WHERE `ProductID`=$row_Product AND `Status`=1 AND `ApprovedBy`!='' ORDER by `CreatedDate` DESC limit 0,1";
                $query_t  =   $this->db->query($sql_t)->row();
                $Tong_hientai = $Tong_hientai+ $query_t->Price;
            }
            $phantram = 100-(($TotalAmount/$Tong_hientai)*100);
            $phantram =round($phantram);
            // return $phantram;
            if($phantram > 50){
                $res = array("result"=>"over","PromotionId"=>$PromotionId,"phantram"=>$phantram);
                return $res;
            }


  
            $sql="INSERT INTO `promotions`(`PromotionId`,`PromotionName`,`PromotionType`,`BeginDateTime`,`EndDateTime`,`CreatedDate`,`CreatedBy`,`PromoText`,`PrintToBill`,`TotalAmount`) VALUES ('$PromotionId', '$PromotionName', '$PromotionType','$BeginDateTime','$EndDateTime',NOW(),'$CreatedBy','$PromoText','$PrintToBill','$TotalAmount')";
            // return $sql;
            $query              =   $this->db->query($sql);
            if(!$query){
                return query;
            }
            foreach( $Product_check as $row_Product)
            {
                $sql_promotion="INSERT INTO `promotiondetails` (`PromotionId`,`ProductId`,`Quantity`,`Price`,`TotalAmount`) VALUES ('$PromotionId', '$row_Product', '$Quantity','0','0')";
                $query_promotion=$this->db->query($sql_promotion);
                
                if(!$query_promotion){
                    $sql_del="DELETE FROM `promotions` WHERE `PromotionId`= '$PromotionId' ";
                    $this->db->query($sql_del);
                    return false;
                }    

                
            }

            $res = array("result"=>$query,"PromotionId"=>$PromotionId);
            return $res;
        }

        public function getPromotionID()
        {
            // [02][yyyyMMDD][000001]            
            ///- [02] : Mã mac dinh cua PRODUCT
            ///- [YYYYMMDD] : Ngày tháng năm tạo 
            ///- [000001]: số chạy
            
            $id =  (string)"88".date("Y").date("m").date("d");
            $sql="SELECT `PromotionId` FROM `promotions` WHERE LEFT(`PromotionId`,10) = '".$id."' ";
            
            $arr = $this->db->query($sql)->result();
            $lst = (array)$arr;
            $stt=1;
            if(count($lst)>0)
            {
                $i=0;
                for($i =0; $i<count($lst);$i++)
                {
                    $id_daco = $lst[$i]->PromotionId;
                    $stt = intval (substr($id_daco,10,strlen($id_daco)));
                    if ($stt != $i + 1)
                    {
                        $stt = $i + 1;
                        break;
                    }
                    if ($i == count($lst)-1)
                    {
                        $stt = count($lst) + 1;
                    }
                }
                
            }
            else
            {
                $stt=1;
            }
            $s_stt ="";
            if ($stt < 10)
                $s_stt = "00000" . strval($stt);
            else if (($stt < 100) && ($stt >= 10))
                $s_stt = "0000" . strval($stt);
            else if (($stt < 1000) && ($stt >= 100))
                $s_stt = "000" . strval($stt);
            else if (($stt < 10000) && ($stt >= 1000))
                $s_stt = "00" . strval($stt);
            else if (($stt < 100000) && ($stt >= 10000))
                $s_stt = "0" . strval($stt);
            else
                $s_stt = strval($stt);
            
            $id= $id. $s_stt;
            return $id;
        }


       

        
    }
?>
