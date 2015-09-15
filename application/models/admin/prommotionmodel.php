<?php

class ProductsObject {   
   public   $ProductID;
   public   $SpaID ;
   public   $Name;
   public   $Description;
   public   $Status;
   public   $ProductType;
   public   $CurrentVouchers;
   public   $Duration;
   public   $MaxProductatOnce;
   public   $ValidTimeFrom;
   public   $ValidTimeTo;
   public   $Policy;
   public   $CreatedDate;
   public   $Restriction;
   public   $Tips;
   public   $CreatedBy;
}

class Prommotionmodel extends CI_Model{
        public $errorStr; 
        
        public function __construct()
        {
            parent::__construct();
        }
        
        public function get_product($id){
            $sql = "SELECT * FROM `products` WHERE `ProductID`='$id'";
            $Product = $this->db->query($sql)->result();
            $arr = (array)$Product;
            return $arr;
        }
        public function get_product_links($id){
            $sql = "SELECT * FROM `links` WHERE `ObjectIDD`='$id'";
            $Product = $this->db->query($sql)->result();
            $arr = (array)$Product;
            return $arr;
        }
        public function get_product_prices($id){
            $sql = "SELECT * FROM `price` WHERE `ProductID`='$id' ORDER BY `CreatedDate` DESC LIMIT 0,5";
            $Product = $this->db->query($sql)->result();
            $arr = (array)$Product;
            return $arr;
        }
        public function get_product_times($id){
            $sql = "SELECT * FROM `producttime` WHERE `ProductID`='$id' ";
            $Product = $this->db->query($sql)->result();
            $arr = (array)$Product;
            return $arr;
        }
        
        public function get_hinh_products()
        {
            $ProductID    = $_POST['ProductID']; 
            $sql = "SELECT * FROM `links` WHERE `ObjectIDD`='$ProductID'"; //lấy cấp 2
            $List = $this->db->query($sql)->result();
            return $List;
        }
        
        public function xoa_products()
        {
            $id    = $_POST['ProductID']; 
            $res = "0";
                            
                $sql = "DELETE FROM `producttime` WHERE `ProductID`='$id'";
                $sql1 = "DELETE FROM `price` WHERE `ProductID`='$id'";
                $sql2 = "DELETE FROM `products` WHERE `ProductID`='$id'";
                $sql3 = "DELETE FROM `links` WHERE `ObjectIDD`='$id'";
                
                try{
                    $this->db->query($sql);
                    $this->db->query($sql1);
                    $this->db->query($sql2);
                    $this->db->query($sql3);
                    $res ="1";
                }
                catch(exception $e)
                {
                    $res = "0";    
                }
            
            return $res;
        }
        
        public function xoa_hinh()
        {
            $id    = $_POST['ID']; 
            
            $sql1 = "select * from `links` WHERE id='$id'";
            $arr= null;
            try{
                $res1 = $this->db->query($sql1)->result();    
                $arr = (array) $res1;
            }
            catch(exception $e)
            {                
            }
            $res =0;
            
            if($arr != null && count($arr)>0)
            {
                $filename = $arr[0]->URL;
                try{
                    unlink($filename);
                }
                catch(exception $e)
                {
                    
                }                
                $sql = "DELETE FROM `links` WHERE id='$id'"; //lấy cấp 2
                
                try{
                    $this->db->query($sql);
                    $res ="1";
                }
                catch(exception $e)
                {
                    $res = "0";    
                }
            }
            return $res;
        }
                
        public function get_product_types(){
            $sql = "SELECT * FROM `commoncode` WHERE ``='ProductType' AND LENGTH(`CommonId`)=4 AND `NumValue1`=1"; //lấy cấp 2
            $ListProductTypes = $this->db->query($sql)->result();
            return $ListProductTypes;
        }
        
        
        
        public function get_product_types_new(){
            $str="<optgroup label=\"Không chọn\"><option value=\"\">Không chọn...</option></optgroup>";
            $sql = "SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND LENGTH(`CommonId`)=2 AND `NumValue1`=1 "; //lấy cấp 1
            $ListCap1 = $this->db->query($sql)->result();
            $arr1= (array)$ListCap1;
            for($i=0; $i<count($arr1);$i++)
            {
                $str = $str."<optgroup label=\"".$arr1[$i]->CommonId." - ".$arr1[$i]->StrValue1."\">";
                $cap1=$arr1[$i]->CommonId;
                $sql1 = "SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType'  AND `NumValue1`=1 AND LENGTH(`CommonId`)=4 AND LEFT(`CommonId`,2)='$cap1'";
                $ListCap2 = $this->db->query($sql1)->result();
                $arr2= (array)$ListCap2;
                for($j=0; $j<count($arr2);$j++)
                {
                    $str = $str."<option value=\"".$arr2[$j]->CommonId ."\">".$arr2[$j]->CommonId." - ".$arr2[$j]->StrValue1."</option>";
                }  
                $str = $str."</optgroup>"; 
            }
            return $str;
        }
        
        public function get_product_types_new1($id){
            $str="<optgroup label=\"Không chọn\"><option value=\"\">Không chọn...</option></optgroup>";
            $sql = "SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND LENGTH(`CommonId`)=2 AND `NumValue1`=1 "; //lấy cấp 1
            $ListCap1 = $this->db->query($sql)->result();
            $arr1= (array)$ListCap1;
            for($i=0; $i<count($arr1);$i++)
            {
                $str = $str."<optgroup label=\"".$arr1[$i]->CommonId." - ".$arr1[$i]->StrValue1."\">";
                $cap1=$arr1[$i]->CommonId;
                $sql1 = "SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType'  AND `NumValue1`=1 AND LENGTH(`CommonId`)=4 AND LEFT(`CommonId`,2)='$cap1'";
                $ListCap2 = $this->db->query($sql1)->result();
                $arr2= (array)$ListCap2;
                for($j=0; $j<count($arr2);$j++)
                {
                    if($id == $arr2[$j]->CommonId)
                    {
                         $str = $str."<option value=\"".$arr2[$j]->CommonId ."\" selected= \"selected\">".$arr2[$j]->CommonId." - ".$arr2[$j]->StrValue1."</option>";
                    }
                    else{
                        $str = $str."<option value=\"".$arr2[$j]->CommonId ."\">".$arr2[$j]->CommonId." - ".$arr2[$j]->StrValue1."</option>";
                    }
                    
                }  
                $str = $str."</optgroup>"; 
            }
            return $str;
        }
        
        public function search_price_current(){
            $price = 0;
            $ProID = $_POST['ProductID'];
            try{
                $sql = "SELECT DISTINCT `price` FROM `price` WHERE `ProductID` = '$ProID' ORDER BY `CreatedDate` DESC";
                $list = $this->db->query($sql)->result();
                $price = $list[0]->price;
            }
            catch(exception $e){
                $price = 0;
            }
            
            return $price;
        }
               
        public function search_spaproduct(){
            $spaID      = $_POST['spaID'];   
            $proName    = $_POST['productName'];            
            $page       = $_POST["Page"];
          
            $sql = "SELECT '1' AS STT,`products`.* FROM `products`";       
            $sql1 = "SELECT count(*) as Total FROM `products` ";
                    
            $sql = $sql." where 1=1 ";
            $sql1 = $sql1." where 1=1 ";            
          
            if($proName !=''){
                $sql = $sql." and `Name` like '%".$proName."%'";
                $sql1 = $sql1." and `Name` like '%".$proName."%'";
            }
            
            $sql = $sql." and `SpaID` = $spaID ";
            $sql1 = $sql1." and `SpaID` = $spaID";
            
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            
            $_arrSpa = $this->AddSTT1($this->db->query($sql)->result(),$page); 
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
        
        public function search_spa_id(){
            $spaID = $_POST['spaid'];
            $sql = "SELECT spa.* FROM spa WHERE `spaID`='".$spaID."'";       
           
            $_arrSpa = $this->db->query($sql)->result(); 
        
            return $_arrSpa;
        }
        public function ajax_list(){
            $promoID    = $_POST['promoID']; 
            $promoName  = $_POST['promoName'];
            $proName    = $_POST['ProductName'];
            $proBegin   = $_POST['Begin'];
            $proEnd     = $_POST['End'];
            if($proBegin!="")
            {
                $begin=explode("/",$proBegin);
                $BeginDate=$begin[2]."-".$begin[0]."-".$begin[1];
            }
            if($proEnd!="")
            {
                $end    =explode("/",$proEnd);
                $EnDate =$end[2]."-".$end[0]."-".$end[1];
            }
            $spaName    = $_POST['SpaName'];
            $page       = $_POST["Page"];
            
            $sql = "SELECT '1' AS STT,a.`Price` as GiaKM,a.`Quantity` as SL,b.*,c.*,d.`spaName`
                    FROM `promotiondetails` a 
                    LEFT JOIN `products` b ON a.`ProductId`= b.`ProductID`
                    LEFT JOIN `spa` d ON d.`spaID`= b.`SpaID` 
                    INNER JOIN `promotions` c ON a.`PromotionId` = c.`PromotionId`
                    WHERE (`PromotionType` = 'KMDB' OR `PromotionType` = 'Package') "; 
            $sql1 = "SELECT COUNT(*) AS Total 
                    FROM `promotiondetails` a 
                    LEFT JOIN `products` b ON a.`ProductId`= b.`ProductID`
                    LEFT JOIN `spa` d ON d.`spaID`= b.`SpaID`
                    INNER JOIN `promotions` c ON a.`PromotionId` = c.`PromotionId`
                    WHERE (`PromotionType` = 'KMDB' OR `PromotionType` = 'Package')";
                    
            $sql = $sql." AND 1=1 ";
            $sql1 = $sql1." AND 1=1 ";
            

            if($promoID !=''){
                $sql = $sql." and a.`PromotionId` like '".$promoID."%'";
                $sql1 = $sql1." and a.`PromotionId` like '".$promoID."%'"; 
            }
            if($promoName !=''){
                $sql = $sql." and  c.`PromotionName` like '%".$promoName."%'";
                $sql1 = $sql1." and  c.`PromotionName` like '%".$promoName."%'";
            }
            if($proName !=''){
                $sql = $sql." and b.`Name` like '".$proName ."%'";
                $sql1 = $sql1." and b.`Name` like '".$proName ."%'";
            }
            if($spaName !=''){
                $sql = $sql." and d.`spaName` like '".$spaName ."%'";
                $sql1 = $sql1." and d.`spaName` like '".$spaName ."%'";
            }
           
          
            if($proBegin !='' && $proEnd =='')
            {
               $sql = $sql." and c.`BeginDateTime` BETWEEN  '".$BeginDate ."' AND CURDATE()";
                $sql1 = $sql1." and c.`BeginDateTime` BETWEEN  '".$BeginDate ."' AND CURDATE()";  
            }
            if($proBegin =='' && $proEnd !='')
            {
               $sql = $sql." and c.`EndDateTime` BETWEEN  CURDATE() AND   '".$EnDate ."'";
                $sql1 = $sql1." and c.`EndDateTime` BETWEEN   CURDATE() AND   '".$EnDate ."'";  
            }
            if($proBegin !='' && $proEnd !='')
            {
                $sql = $sql." AND c.`BeginDateTime` = '".$BeginDate ."'  AND c.`EndDateTime` = '".$EnDate ."' ";
                $sql1 = $sql1." AND c.`BeginDateTime` = '".$BeginDate ."'  AND c.`EndDateTime` = '".$EnDate ."' ";
            }
          
            $sql = $sql." ORDER BY a.`PromotionId` DESC ";
           // func_print_test($sql);
            // export excel 
            $sql_excel = $sql;
            $arr_excel = $this->db->query($sql_excel)->result();
            if(count($arr_excel)>0)
                $_SESSION['array_excel']=$arr_excel;
            // end export excel
             //phÃ¢n trang cho mÃ n hÃ¬nh quáº£n lÃ½ ngÆ°á»?i tÃ¬m viá»‡c vÃ  há»“ sÆ¡
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page!= '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            
            $_arrSpa = $this->AddSTT1($this->db->query($sql)->result(),$page);  
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
                
         $res = array("TotalRecord"=>$TotalRecord,"TotalPage"=>$TotalPage,"CurPage"=>$page,"lst"=>$_arrSpa,"Toto"=>$ResTotalPage);
            return $res;
        }
        
        public function xoa_promotion()
        {
            $id    = $_POST['PromoID']; 
            $res = "0";
                            
                $sql = "DELETE FROM `promotions` WHERE `PromotionId`='$id'";
                $sql1 = "DELETE FROM `promotiondetails` WHERE `PromotionId`='$id'";
                $sql3 = "DELETE FROM `links` WHERE `ObjectIDD`='$id'";
                
                try{
                    $this->db->query($sql);
                    $this->db->query($sql1);
                    $this->db->query($sql3);
                    $res ="1";
                }
                catch(exception $e)
                {
                    $res = "0";    
                }
            
            return $res;
        }
        
        public function search_products(){            
            $proID    = $_POST['proID'];            
            $proName    = $_POST['proName'];
            $spaList    = $_POST['spaList'];
            
            $proType    = $_POST['proType'];
            $policy    = $_POST['policy'];
            $desciption    = $_POST['desciption'];
            
            $page       = $_POST["Page"];
            ///list($month, $day, $year) = split('[/.-]', $date);
            $List_ = explode(';', $spaList);
            $List_STR = "";
            for($i=0; $i<count($List_)-1;$i++)
            {
                if($i==0)
                {
                    $List_STR = $List_STR ."'" .$List_[$i]."'";
                }
                else
                {
                    $List_STR = $List_STR .",'" .$List_[$i]."'";
                }
            }
          
            $sql = "SELECT '1' AS STT, products.* FROM products";       
            $sql1 = "SELECT count(*) as Total FROM products  ";
                    
            $sql = $sql." where 1=1 ";
            $sql1 = $sql1." where 1=1 ";            
          
            if($proID !=''){
                $sql = $sql." and `ProductID` like '%".$proID."%'";
                $sql1 = $sql1." and `ProductID` like '%".$proID."%'";
            }
            
            if($proName !=''){
                $sql = $sql." and `Name` like '%".$proName."%'";
                $sql1 = $sql1." and `Name` like '%".$proName."%'";
            }
            
            if($spaList !=''){
                $sql = $sql." and `SpaID` in (".$List_STR.")";
                $sql1 = $sql1." and `SpaID` in  (".$List_STR.") ";
            }
            
            if($proType !=''){
                $sql = $sql." and `ProductType` = '".$proType."'";
                $sql1 = $sql1." and `ProductType` = '".$proType."'";
            }
            
            if($policy !=''){
                $sql = $sql." and `Policy` like '%".$policy."%'";
                $sql1 = $sql1." and `Policy` like '%".$policy."%'";
            }
            
            if($desciption !=''){
                $sql = $sql." and `Description` like '%".$desciption."%'";
                $sql1 = $sql1." and `Description` like '%".$desciption."%'";
            }
            
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            
            $_arrSpa = $this->AddSTT1($this->db->query($sql)->result(),$page); 
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
                
        $res = array("TotalRecord"=>$TotalRecord,"TotalPage"=>$TotalPage,"CurPage"=>$page,"lst"=>$_arrSpa,"Toto"=>$ResTotalPage);
        return $res;
        }
        
        public function AddSTT1($arr,$current)
        {
            $arr1 = (array) $arr;
            for($i=0;$i<count($arr1);$i++)
            {
                $arr1[$i]->STT = ($i+10*($current - 1));
            }
            return $arr1;
        }
        
        public function AddSTT($arr)
        {
            $arr1 = (array) $arr;
            for($i=0;$i<count($arr1);$i++)
            {
                $arr1[$i]->STT = ($i+1);
            }
            return $arr1;
        }
        
        public function Them_Moi_Promotion()
        {
            $PromotionId    = "";  
            
            //$SpaID      =   $_POST['SpaID'];
            $promoName    = $_POST['Name'];            
            $Notes        = $_POST['Notes'];
            $PrintToBill  =  $_POST['Inbill'];            
            $date1        = strtotime($_POST['Begin']);
            $BeginDateTime = date( 'Y-m-d H:i:s', $date1 );
            $date2         = strtotime($_POST['To']);
            $EndDateTime   = date( 'Y-m-d H:i:s',$date2);
            $arr = (array)$_SESSION['AccUser'];
            if(isset($arr))
             $createdby = $arr['User']->UserId;
            
            try
            {
                $PromotionId = $this->getPromotionID();
                $sql = "INSERT INTO `promotions`(`PromotionId`,`PromotionName`,`BeginDateTime`,`EndDateTime`,`CreatedDate`,`CreatedBy`,`PromoText`,`PrintToBill`)VALUES ('$PromotionId','$promoName','$BeginDateTime','$EndDateTime',NOW(),'$createdby','$Notes','$PrintToBill')";
                $this->db->query($sql);
            }
            catch(exception $e)
            {
                $PromotionId    = "";
            }
            return $PromotionId;
        }
        
        
        public function Them_Moi_PromotionDetail()
        {
            $PromotionId        = $_POST['PromoID'];
            $Product            =   $_POST['ProID'];
            $Price              = $_POST['Price'];            
            $Quantity           = $_POST['Quantity'];
            $TotalAmount        = $Price*$Quantity;
            
            
            try
            {
                $sql = "INSERT INTO `promotiondetails`(`PromotionId`,`ProductId`,`Quantity`,`Price`,`TotalAmount`)VALUES('$PromotionId','$Product',$Quantity,$Price,$TotalAmount)";
                $this->db->query($sql);
            }
            catch(exception $e)
            {
                $PromotionId    = null;
            }
            return $PromotionId;
        }
        
         public function getPromotionID()
        {
            // [88][yyyyMMDD][000001]            
            ///- [88] : Mã mac dinh cua Promotion
            ///- [YYYYMMDD] : Ngày tháng năm tạo 
            ///- [000001]: số chạy
            
            $id =  (string)"88".date("Y").date("m").date("d");
            $sql="SELECT `PromotionId` FROM `promotions` WHERE LEFT(`PromotionId`,10) = '".$id."'  order by `PromotionId`";
            
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
            
            $id = $id. $s_stt;
            return $id;
        }
        
        public function get_hinh_promotion()
        {
            $PromotionID    = $_POST['Promotion']; 
            $sql = "SELECT * FROM `links` WHERE `ObjectIDD`='$PromotionID'"; //lấy cấp 2
            $List = $this->db->query($sql)->result();
            return $List;
        }
        
        //get_list_product
        public function get_list_product()
        {
            $PromotionID    = $_POST['PromoID']; 
            
            $sql = "SELECT a.*,b.`Name` FROM `promotiondetails` a INNER JOIN `products` b ON a.`ProductId`= b.`ProductID` WHERE a.`PromotionId`= '$PromotionID'"; 
            $List = $this->db->query($sql)->result();
            return $List;
        }
        
        public function InsertLinks($Id, $url)
        {
            $arr = explode('.',$url);
            $arr1 = explode('/',$url);
            $type ="PROMOTIONS";
            $ext= $arr[count($arr)-1];
            $filename = $arr1[count($arr1)-1];
            $arr = (array)$_SESSION['AccUser'];
            if(isset($arr))
             $createdby = $arr['User']->UserId;
            $sql ="INSERT INTO `links` (`ObjectIDD`,`URL`,`Type`,`FileExtension`,`FileName`,`Status`,`UploadedBy`,`UploadedDate`) VALUES ('$Id','$url','$type','$ext','$filename','1','$createdby',NOW())";
            
            try{
                $this->db->query($sql);
            }
            catch(Exception $e)
            {
                
            }
        }
        
        // load data của bảng promotions
        public function get_list_promotion($promoID){
            $sql = "SELECT * FROM `promotions` WHERE `PromotionId` = '$promoID'";
            $Promo = $this->db->query($sql)->result();
            $arr = (array)$Promo;
            return $arr;
        }
        
        public function get_list_links($promoID){
            $sql = "SELECT * FROM `links` WHERE `ObjectIDD`= '$promoID'";
            $Promo = $this->db->query($sql)->result();
            $arr = (array)$Promo;
            return $arr;
        }
        
        public function get_list_product_spa($promoID,$proID){
            $sql = "SELECT a.*,b.* FROM `promotiondetails` a INNER JOIN `products` b ON a.`ProductId` = b.`ProductId` WHERE b.`ProductId` = '$proID' AND a.`PromotionId` ='$promoID'";
            $Products = $this->db->query($sql)->result();
            $arr = (array)$Products;
            return $arr;
            
        }
        
        public function get_list_product1($promoID){
            
            $sql_sel  = "SELECT `TotalAmount` FROM `promotions` WHERE `PromotionId` = '$promoID'";
            $totalPromotion = $this->db->query($sql_sel)->result();
            $total = $totalPromotion[0]->TotalAmount;
           // echo "<pre>";
//            print_r($total);
//            echo "</pre>"; 
//            die();
            $sql = "SELECT a.*,b.`Name` 
                    FROM `promotiondetails` a 
                    INNER JOIN `products` b ON a.`ProductId`= b.`ProductID` 
                    WHERE a.`PromotionId`= '$promoID'"; 
            $List = $this->db->query($sql)->result();
            $arr_promodetail = (array)$List;
            $str = "";
            $str1 = "";
            for($i = 0;$i<count($arr_promodetail);$i++){
                if($total == '0.00'){
                    
                    $str = $str."<tr id=\"trPromotionDetail".$arr_promodetail[$i]->ProductId."\">";
                    $str = $str."<td>".$i."</td>";
                    $str = $str."<td><span>".$arr_promodetail[$i]->ProductId."</span></td>";
                    $str = $str."<td><span>".$arr_promodetail[$i]->Name."</span></td>";
                    $str = $str."<td><span class=\"SpanNumber\">".$arr_promodetail[$i]->Price."</span></td>";
                    $str = $str."<td><span>".$arr_promodetail[$i]->Quantity."</span></td>";
                    $str = $str."<td><span class=\"SpanNumber\">".$arr_promodetail[$i]->TotalAmount."</span></td>";
                    $str = $str."<td>";
                    $str = $str."<a href=\"javascript:void(0)\" onclick=\"add_product('".$arr_promodetail[$i]->ProductId."');\">+</a>";
                    $str = $str."<a href=\"javascript:void(0)\" onclick=\"sub_product('".$arr_promodetail[$i]->ProductId."');\">-</a>";
                    $str = $str."<a href=\"javascript:void(0)\" onclick=\"delete_plan('".$arr_promodetail[$i]->ProductId."');\">Xóa</a>";
                    $str = $str."</td>";
                    $str = $str."</tr>";
                    //echo "Chi tiết KM";
//                    echo "<pre>";
//                    echo($str);
//                    echo "</pre>";
//                    die();
                }
                else{

                    $str1 = $str1."<tr id=\"trPromotionDetailTotal".$arr_promodetail[$i]->ProductId."\">";
                    $str1 = $str1."<td>".$i."</td>";
                    $str1 = $str1."<td><span>".$arr_promodetail[$i]->ProductId."</span></td>";
                    $str1 = $str1."<td><span>".$arr_promodetail[$i]->Name."</span></td>";
                    //$str = $str."<td><span class=\"SpanNumber\">".$arr_promodetail[$i]->Price."</span></td>";
                    $str1 = $str1."<td><span>".$arr_promodetail[$i]->Quantity."</span></td>";
                    //$str1 = $str1."<td><span class=\"SpanNumber\">".$arr_promodetail[$i]->TotalAmount."</span></td>";
                    $str1 = $str1."<td>";
                    $str1 = $str1."<a href=\"javascript:void(0)\" onclick=\"add_product_total('".$arr_promodetail[$i]->ProductId."');\">+</a>";
                    $str1 = $str1."<a href=\"javascript:void(0)\" onclick=\"sub_product_total('".$arr_promodetail[$i]->ProductId."');\">-</a>";
                    $str1 = $str1."<a href=\"javascript:void(0)\" onclick=\"delete_plan_total('".$arr_promodetail[$i]->ProductId."');\">Xóa</a>";
                    $str1 = $str1."</td>";
                    $str1 = $str1."</tr>";
                    //echo "Tong tiền KM";
//                    echo "<pre>";
//                    echo($str1);
//                    echo "</pre>";
//                    die();
                }
                
            }
            
            $array_list =  array('str'=>$str,'str1'=>$str1,'total'=>$total);
            return $array_list; 
            
        }
        
         public function get_list_productss($promoID){
             $sql = "SELECT a.*,b.`Name` FROM `promotiondetails` a INNER JOIN `products` b ON a.`ProductId`= b.`ProductID` WHERE a.`PromotionId`= '$promoID'"; 
            $List = $this->db->query($sql)->result();
            $arr_promodetail = (array)$List;
            $str = "";
            for($i = 0;$i<count($arr_promodetail);$i++){
                $str = $str."<tr id=\"".$arr_promodetail[$i]->ProductId."\">";
                $str = $str."<td>".$i."</td>";
                $str = $str."<td><span>".$arr_promodetail[$i]->Name."</span></td>";
                $str = $str."<td><span>".$arr_promodetail[$i]->Price."</span></td>";
                $str = $str."<td><span>".$arr_promodetail[$i]->Quantity."</span></td>";
                $str = $str."<td><span>".$arr_promodetail[$i]->TotalAmount."</span></td>";
                $str = $str + "<td><a href=\"javascript:void(0)\" onclick=\"add_product('".$arr_promodetail[$i]->ProductId."');\"><img src=\"<?php echo base_url('resources/images/icons/add.png'); ?>\" title=\"Thêm số lượng\" alt=\"+\" /></a>  <a href=\"javascript:void(0)\" onclick=\"sub_product('".$arr_promodetail[$i]->ProductId."');\"><img src=\"<?php echo base_url('resources/images/icons/sub.png'); ?>\" title=\"Giảm số lượng\" alt=\"-\" /></a>  <a href=\"javascript:void(0)\" onclick=\"delete_plan('".$arr_promodetail[$i]->ProductId."');\"><img src=\"<?php echo base_url('resources/images/icons/delete.png'); ?>\" title=\"Xóa số lượng\" alt=\"Xóa\" /></a></td>"; 
                $str = $str."</tr>";
            }
            return $str;
        }

        // load data của bảng product và spa
        
        public function Capnhat_Promotion(){
            $promoID      =   $_POST['PromoID'];
            $checkpromo        = $_POST['CheckProm'];
            if($checkpromo == 0){
                $promoType = "Package";  
            }
            else{
                $promoType = "KMDB";
            }

            $promoName    = $_POST['Name'];            
            $Notes        = $_POST['Notes'];
            $PrintToBill  =  $_POST['Inbill'];            
            $date1        = strtotime($_POST['Begin']);
            $BeginDateTime = date( 'Y-m-d H:i:s', $date1 );
            $date2         = strtotime($_POST['To']);
            $EndDateTime   = date( 'Y-m-d H:i:s',$date2);
            $arr = (array)$_SESSION['AccUser'];
            if(isset($arr))
             $createdby = $arr['User']->UserId;
            $sql_sel = "SELECT * FROM `promotions` WHERE `PromotionId` = '$promoID'";
            $sql = "";
            try
            {
                $res = $this->db->query($sql_sel)->result();
                $arr = (array)$res;
                if(count($arr)>0)
                {
                   $sql = "UPDATE `promotions` SET `PromotionName`='$promoName',`BeginDateTime`='$BeginDateTime',`EndDateTime`='$EndDateTime',`ModifiedBy`='$createdby',`ModifiedDate`=NOW(),`PromoText`='$Notes',`PrintToBill`='$PrintToBill',`PromotionType`='$promoType' WHERE `PromotionId` = '$promoID'";//update
                }
                else{   
                        $sql = "INSERT INTO `promotions`(`PromotionId`,`PromotionName`,`BeginDateTime`,`EndDateTime`,`CreatedDate`,`CreatedBy`,`PromoText`,`PrintToBill`,`PromotionType`)VALUES ('$promoID','$promoName','$BeginDateTime','$EndDateTime',NOW(),'$createdby','$Notes','$PrintToBill','$promoType')"; // insert
                        
                }
                try{
                    
                        $this->db->query($sql);
                }
                catch(exception $ee)
                {
                       
                }
            }
            catch(exception $e)
            {
                $promoID    = "";
            }
            return $promoID;
        }
        
        public function Capnhat_PromotionDetail(){
            $list               = $_POST['promotiondetal'];// kho hieu promotiondetal
            // mở file js a coi
            $list_promo         = json_decode($list);
            $PromotionId        = $list_promo[0]->PromoId; // nó báo sai khúc nay fai ko???
           
            $sql_del = "DELETE FROM `promotiondetails` WHERE `PromotionId` = '$PromotionId'";
            $sql ="";
            try
            {
                $this->db->query($sql_del);
                 foreach($list_promo as $promo){     
                      $sql = "INSERT INTO `promotiondetails`(`PromotionId`,`ProductId`,`Quantity`,`Price`,`TotalAmount`)VALUES('$promo->PromoId','$promo->ProId',$promo->SL,$promo->DG,$promo->TT)";
                       $this->db->query($sql);
                }
            
                
            }
            catch(exception $e)
            {
                $PromotionId    = null;
            }
            return $PromotionId;
        }
        
        public function Capnhat_PromotionTotalDetail(){
            $list               = $_POST['promotiontotal'];// kho hieu promotiondetal
            $total              = $_POST['Total'];
            // mở file js a coi
            $list_promo         = json_decode($list);
            $PromotionId        = $list_promo[0]->PromoId; // nó báo sai khúc nay fai ko???
            $checkpromo        = $_POST['CheckProm'];
            if($checkpromo == 0){
                $promoType = "Package";  
            }
            else{
                $promoType = "KMDB";
            }

            $sql_del = "DELETE FROM `promotiondetails` WHERE `PromotionId` = '$PromotionId'";
            $sql ="";
            try
            {
                $this->db->query($sql_del);
                 foreach($list_promo as $promo){     
                      $sql = "INSERT INTO `promotiondetails`(`PromotionId`,`ProductId`,`Quantity`,`Price`,`TotalAmount`)VALUES('$promo->PromoId','$promo->ProId',$promo->SL,'$total','$total')";
                       $this->db->query($sql);
                }
                $sql_sel = "UPDATE `promotions` SET `TotalAmount` = '$total',`PromotionType` = '$promoType' WHERE `PromotionId` = '$PromotionId'";
                $this->db->query($sql_sel);
            
                
            }
            catch(exception $e)
            {
                $PromotionId    = null;
            }
            return $PromotionId;
        }
        
        
        
         public function Capnhat_PromotionTotal(){
            $total             = $_POST['Total'];
            $PromoId           = $_POST['PromoID'];
            $list              = $_POST['promotiontotal'];
            $promo             = $_POST['promotion'];
            $list_promo        = json_decode($list);
            $list_promontion   = json_decode($promo);
            $checkpromo        = $_POST['CheckProm'];
            $arr = (array)$_SESSION['AccUser'];
            if(isset($arr))
            $createdby = $arr['User']->UserId;
            if($checkpromo == 0){
                $promoType = "Package";  
            }
            else{
                $promoType = "KMDB";
            }

            $PromotionId = "";
            if($PromoId == "" || $PromoId == null)
            {
                try{
                    
                    $this->db->trans_start();
                    //get Promotion ID
                    $PromotionId = $this->getPromotionID();
                    //insert table promotions
                    $sql = "INSERT INTO `promotions`(`PromotionId`,`PromotionName`,`BeginDateTime`,`EndDateTime`,`CreatedDate`,`CreatedBy`,`PromoText`,`PrintToBill`,`TotalAmount`,`PromotionType`)VALUES ('$PromotionId','$list_promontion->Name','".date( 'Y-m-d H:i:s',strtotime($list_promontion->Begin))."','".date( 'Y-m-d H:i:s',strtotime($list_promontion->To))."',NOW(),'$createdby','$list_promontion->Notes','$list_promontion->inbill','$total','$promoType')";
                    $this->db->query($sql);
                    foreach($list_promo as $promo){     
                          $sql1 = "INSERT INTO `promotiondetails`(`PromotionId`,`ProductId`,`Quantity`,`Price`,`TotalAmount`)VALUES('$PromotionId','$promo->ProId',$promo->SL,'$total','$total')";
                           $this->db->query($sql1);
                    }
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE)
                    {
                        $this->db->trans_rollback();
                    }
            
                }
                catch(exception $e)
                {
                    $PromotionId    = "0";
                }
                
            }
            else{
                
                try{
                    $this->db->trans_start();
                    //update table promotions
                     $sql = "UPDATE `promotions` SET `PromotionName`='$list_promontion->Name',`BeginDateTime`='".date( 'Y-m-d H:i:s',strtotime($list_promontion->Begin))."',`EndDateTime`='".date( 'Y-m-d H:i:s',strtotime($list_promontion->To))."',`ModifiedBy`='$createdby',`ModifiedDate`=NOW(),`PromoText`='$list_promontion->Notes',`PrintToBill`='$list_promontion->inbill' WHERE `PromotionId` = '$PromoId'";//update
                    $this->db->query($sql);
                    
                    $sql_del = "DELETE FROM `promotiondetails` WHERE `PromotionId` = '$PromoId'";
                    $sql1 ="";
                    try
                    {
                        $this->db->query($sql_del);
                         foreach($list_promo as $promo){     
                              $sql1 = "INSERT INTO `promotiondetails`(`PromotionId`,`ProductId`,`Quantity`,`Price`,`TotalAmount`)VALUES('$promo->PromoId','$promo->ProId',$promo->SL,$promo->DG,'$total','$total')";
                               $this->db->query($sql1);
                        }
                    
                        
                    }
                    catch(exception $e)
                    {
                        $PromotionId    = "0";
                    }
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE)
                    {
                        $this->db->trans_rollback();
                    }
            
                }
                catch(exception $e)
                {
                    $PromotionId    = "0";
                }
                
            }
            if($PromotionId == "")
            {
                return "1";
            }
            else{
                return $PromotionId;
            }
            
        }
        public function Capnhat_PromotionDetail1(){
            $PromoId            = $_POST['PromoID'];
            $list              = $_POST['promotiondetal'];
            $promo             = $_POST['promotion'];
            $checkpromo        = $_POST['CheckProm'];
            $list_promo        = json_decode($list);
            $list_promontion   = json_decode($promo);
            $arr = (array)$_SESSION['AccUser'];
            if(isset($arr))
            $createdby = $arr['User']->UserId;
            $PromotionId = "";
            $promoType  = "";
            if($PromoId == "" || $PromoId == null)
            {
                try{
                    if($checkpromo == 0){
                        $promoType = "Package";  
                    }
                    else{
                        $promoType = "KMDB";
                    }
                    $this->db->trans_start();
                    //get Promotion ID
                    $PromotionId = $this->getPromotionID();
                    //insert table promotions
                    $sql = "INSERT INTO `promotions`(`PromotionId`,`PromotionName`,`BeginDateTime`,`EndDateTime`,`CreatedDate`,`CreatedBy`,`PromoText`,`PrintToBill`,`PromotionType`)VALUES ('$PromotionId','$list_promontion->Name','".date( 'Y-m-d H:i:s',strtotime($list_promontion->Begin))."','".date( 'Y-m-d H:i:s',strtotime($list_promontion->To))."',NOW(),'$createdby','$list_promontion->Notes','$list_promontion->inbill','$promoType')";
                    $this->db->query($sql);
                    foreach($list_promo as $promo){     
                          $sql1 = "INSERT INTO `promotiondetails`(`PromotionId`,`ProductId`,`Quantity`,`Price`,`TotalAmount`)VALUES('$PromotionId','$promo->ProId',$promo->SL,$promo->DG,$promo->TT)";
                           $this->db->query($sql1);
                    }
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE)
                    {
                        $this->db->trans_rollback();
                    }
            
                }
                catch(exception $e)
                {
                    $PromotionId    = "0";
                }
                
            }
            else{
                
                try{
                    $this->db->trans_start();
                    //update table promotions
                     $sql = "UPDATE `promotions` SET `PromotionName`='$list_promontion->Name',`BeginDateTime`='".date( 'Y-m-d H:i:s',strtotime($list_promontion->Begin))."',`EndDateTime`='".date( 'Y-m-d H:i:s',strtotime($list_promontion->To))."',`ModifiedBy`='$createdby',`ModifiedDate`=NOW(),`PromoText`='$list_promontion->Notes',`PrintToBill`='$list_promontion->inbill' WHERE `PromotionId` = '$PromoId'";//update
                    $this->db->query($sql);
                    
                    $sql_del = "DELETE FROM `promotiondetails` WHERE `PromotionId` = '$PromoId'";
                    $sql1 ="";
                    try
                    {
                        $this->db->query($sql_del);
                         foreach($list_promo as $promo){     
                              $sql1 = "INSERT INTO `promotiondetails`(`PromotionId`,`ProductId`,`Quantity`,`Price`,`TotalAmount`)VALUES('$promo->PromoId','$promo->ProId',$promo->SL,$promo->DG,$promo->TT)";
                               $this->db->query($sql1);
                        }
                    
                        
                    }
                    catch(exception $e)
                    {
                        $PromotionId    = "0";
                    }
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE)
                    {
                        $this->db->trans_rollback();
                    }
            
                }
                catch(exception $e)
                {
                    $PromotionId    = "0";
                }
                
            }
            if($PromotionId == "")
            {
                return "1";
            }
            else{
                return $PromotionId;
            }
            
        }
        
        // export Excel
        public function export_excel()
        {
            $result=array();
            if(isset($_SESSION['array_excel']) && $_SESSION['array_excel']!="")
            {
                $sql_ex = $_SESSION['array_excel'];
                //print_r($sql_ex);die;
                //$result=$this->db->query($sql_ex)->result();
                $result = $sql_ex;
            }
            //print_r($result);die;
            return $result;
        }
       // end export Excel 
        
        
  }
?>
