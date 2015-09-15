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

class M_products extends CI_Model{
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
        
        public function search_spa(){
            
            $spaName    = $_POST['spaName'];            
            $page       = $_POST["Page"];
          
            $sql = "SELECT '1' AS STT,spa.* FROM spa";       
            $sql1 = "SELECT count(*) as Total FROM spa  ";
                    
            $sql = $sql." where 1=1 ";
            $sql1 = $sql1." where 1=1 ";            
          
            if($spaName !=''){
                $sql = $sql." and `spaName` like '%".$spaName."%'";
                $sql1 = $sql1." and `spaName` like '%".$spaName."%'";
            }
            
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            
            $_arrSpa = $this->AddSTT($this->db->query($sql)->result()); 
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
        
        public function search_spa_id(){
            $spaID = $_POST['spaid'];
            $sql = "SELECT spa.* FROM spa WHERE `spaID`='".$spaID."'";       
           
            $_arrSpa = $this->db->query($sql)->result(); 
        
            return $_arrSpa;
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
          
            $sql = "SELECT '1' AS STT, products.*,CONCAT(LEFT(`Description`,100),'...') AS desc1 FROM products";       
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
        
        public function Them_Moi_Product()
        {
            $proID    = "";  
            
            $checkpromo = $_POST['CheckPromo'];
            $SpaID =   $_POST['SpaID'];
            $proName    = $_POST['proName'];            
            $desciption    = $_POST['desciption'];
            $Status =$_POST['Status'];            
            $proType    = $_POST['proType'];
            $policy    = $_POST['policy'];
            
            
            $CurrentVouchers = $_POST['CurrentVouchers'];
            $Duration       = $_POST['Duration'];
            $MaxProductatOnce    = $_POST['MaxProductatOnce'];
            //$ValidTimeFrom    = $_POST['ValidTimeFrom'] . " 00:00:00";
            $date1 = strtotime($_POST['ValidTimeFrom']);
            //$ValidTimeFrom = $date1->format('Y-m-d H:i:s');
            $ValidTimeFrom = date( 'Y-m-d H:i:s', $date1 );
            $date2 = strtotime($_POST['ValidTimeTo']);
            $ValidTimeTo = date( 'Y-m-d H:i:s',$date2);
            $Restriction    = $_POST['Restriction'] ;
            $Tips    = $_POST['Tips'];
            $Price    = $_POST['Price'];
            $arr = (array)$_SESSION['AccUser'];
            if(isset($arr))
             $createdby = $arr['User']->UserId;
            
            try
            {
                if($checkpromo == 1)
                $proID = $this->getProducctID();
                else
                 // thêm cho phần khuyến mãi packet
                 $proID = $this->getProducctID2();
                $sql = "INSERT INTO `products`(`ProductID`,`SpaID`,`Name`,`Description`,`Status`,`ProductType`,`CurrentVouchers`,`Duration`,`MaxProductatOnce`,`ValidTimeFrom`,`ValidTimeTo`,`Policy`,`CreatedDate`,`Restriction`,`Tips`,`CreatedBy`) VALUES ('$proID','$SpaID','$proName','$desciption','$Status','$proType','$CurrentVouchers','$Duration','$MaxProductatOnce','$ValidTimeFrom','$ValidTimeTo','$policy',NOW(),'$Restriction','$Tips','$createdby');";
                $this->db->query($sql);
                try{
                    $sql1 = "INSERT INTO `price`(`ProductID`,`Price`,`CreatedBy`,`CreatedDate`) VALUES('$proID','$Price','$createdby',NOW());";
                    $this->db->query($sql1);    
                }
                catch(exception $oo)
                {
                    
                }
            }
            catch(exception $e)
            {
                $proID    = "";
            }
            return $proID;
        }
        
        
        public function Cap_Nhat_Product()
        {
            $proID    = $_POST['ProductID'];
            
            $SpaID =   $_POST['SpaID'];
            $proName    = $_POST['proName'];            
            $desciption    = $_POST['desciption'];
            $Status =$_POST['Status'];            
            $proType    = $_POST['proType'];
            $policy    = $_POST['policy'];
            
            $CurrentVouchers = $_POST['CurrentVouchers'];
            $Duration    = $_POST['Duration'];
            $MaxProductatOnce    = $_POST['MaxProductatOnce'];
            //$ValidTimeFrom    = $_POST['ValidTimeFrom'] . " 00:00:00";
            $date1 = strtotime($_POST['ValidTimeFrom']);
            //$ValidTimeFrom = $date1->format('Y-m-d H:i:s');
            $ValidTimeFrom = date( 'Y-m-d H:i:s', $date1 );
            $date2 = strtotime($_POST['ValidTimeTo']);
            $ValidTimeTo = date( 'Y-m-d H:i:s',$date2);
            $Restriction    = $_POST['Restriction'] ;
            $Tips    = $_POST['Tips'];
            $Price    = $_POST['Price'];
            $arr = (array)$_SESSION['AccUser'];
            if(isset($arr))
             $modifedby = $arr['User']->UserId;
            
            try
            {
                //$proID = $this->getProducctID(); `ProductID`,
                $sql = "UPDATE `products` SET `SpaID`='$SpaID',`Name`='$proName',`Description`='$desciption',`Status`='$Status',`ProductType`='$proType',`CurrentVouchers`='$CurrentVouchers',`Duration`='$Duration',`MaxProductatOnce`='$MaxProductatOnce',`ValidTimeFrom`='$ValidTimeFrom',`ValidTimeTo`='$ValidTimeTo',`Policy`='$policy',`Restriction`='$Restriction',`Tips`='$Tips',`ModifiedDate` = NOW(),`ModifiedBy` = '$modifedby' WHERE `ProductID`='$proID'";
                $this->db->query($sql);
                try{
                    $sql1 = "INSERT INTO `price`(`ProductID`,`Price`,`CreatedBy`,`CreatedDate`) VALUES('$proID','$Price','$modifedby',NOW());";
                    $this->db->query($sql1);    
                }
                catch(exception $oo)
                {
                    
                }
            }
            catch(exception $e)
            {
                $proID    = "";
            }
            return $proID;
        }
        
        
         public function getProducctID()
        {
            // [02][yyyyMMDD][000001]            
            ///- [02] : Mã mac dinh cua PRODUCT
            ///- [YYYYMMDD] : Ngày tháng năm tạo 
            ///- [000001]: số chạy
            
            $id =  (string)"02".date("Y").date("m").date("d");
            $sql="SELECT `ProductID` FROM `products` WHERE LEFT(`ProductID`,10) = '".$id."' ";
            
            $arr = $this->db->query($sql)->result();
            $lst = (array)$arr;
            $stt=1;
            if(count($lst)>0)
            {
                $i=0;
                for($i =0; $i<count($lst);$i++)
                {
                    $id_daco = $lst[$i]->ProductID;
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
        
        
         public function getProducctID2()
        {
            // [12][yyyyMMDD][000001]            
            ///- [12] : Mã mac dinh cua PRODUCT co gói khuyến mãi 
            ///- [YYYYMMDD] : Ngày tháng năm tạo
            ///- [000001]: số chạy
                                                     
            $id =  (string)"12".date("Y").date("m").date("d");
            $sql="SELECT `ProductID` FROM `products` WHERE LEFT(`ProductID`,10) = '".$id."' ";
            
            $arr = $this->db->query($sql)->result();
            $lst = (array)$arr;
            $stt=1;
            if(count($lst)>0)
            {
                $i=0;
                for($i =0; $i<count($lst);$i++)
                {
                    $id_daco = $lst[$i]->ProductID;
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
        
        public function InsertLinks($Id, $url)
        {
            $arr = explode('.',$url);
            $arr1 = explode('/',$url);
            $type ="PRODUCT";
            $ext= $arr[count($arr)-1];
            $filename = $arr1[count($arr1)-1];

            $arr = (array)$_SESSION['AccUser'];
            if(isset($arr))
             $creadedby = $arr['User']->UserId;
            
            $sql ="INSERT INTO `links` (`ObjectIDD`,`URL`,`Type`,`FileExtension`,`FileName`,`Status`,`UploadedBy`,`UploadedDate`) VALUES ('$Id','$url','$type','$ext','$filename','1','$creadedby',NOW())";
            
            try{
                $this->db->query($sql);
            }
            catch(Exception $e)
            {
                
            }
        }
        
        public function Capnhat_Time_Product()
        {
            $proID = $_POST['ProductID'];;
            
            $ft2 =   $_POST['ft2'];
            $ft3 =   $_POST['ft3'];
            $ft4 =   $_POST['ft4'];
            $ft5 =   $_POST['ft5'];
            $ft6 =   $_POST['ft6'];
            $ft7 =   $_POST['ft7'];
            $ftcn =   $_POST['ftcn'];
            $ftle =   $_POST['ftle'];
            
            $tt2 =   $_POST['tt2'];
            $tt3 =   $_POST['tt3'];
            $tt4 =   $_POST['tt4'];
            $tt5 =   $_POST['tt5'];
            $tt6 =   $_POST['tt6'];
            $tt7 =   $_POST['tt7'];
            $ttcn =   $_POST['ttcn'];
            $ttle =   $_POST['ttle'];
            
            $t2 = array("ft"=>$ft2,"tt"=>$tt2 );
            $t3 = array("ft"=>$ft3,"tt"=>$tt3 );
            $t4 = array("ft"=>$ft4,"tt"=>$tt4 );
            $t5 = array("ft"=>$ft5,"tt"=>$tt5 );
            $t6 = array("ft"=>$ft6,"tt"=>$tt6 );
            $t7 = array("ft"=>$ft7,"tt"=>$tt7 );
            $tcn= array("ft"=>$ftcn,"tt"=>$ttcn );
            $tle= array("ft"=>$ftle,"tt"=>$ttle );
            
            $arr = array($t2,$t3,$t4,$t5,$t6,$t7,$tcn,$tle);
            
            for($i=0; $i<count($arr);$i++)
            {
                //capnhatPROtime($ft, $tt, $day, $proid);
                $this->capnhatPROtime($arr[$i]['ft'],$arr[$i]['tt'],$i,$proID);
            }    
            return "1";        
        }
        
        public function capnhatPROtime($ft, $tt, $day, $proid)
        {
            $i= 0;
            switch($day)
            {
                case 0: // thứ 2
                {
                    $i =2;
                    break;
                }
                case 1: // thứ 3
                {
                    $i =3;
                    break;
                }
                case 2: // thứ 4
                {
                    $i =4;
                    break;
                }
                case 3: // thứ 5
                {
                    $i =5;
                    break;
                }
                case 4: // thứ 6
                {
                    $i =6;
                    break;
                }
                case 5: // thứ 7
                {
                    $i =7;
                    break;
                }
                case 6: // Chu nhat
                {
                    $i =8;
                    break;
                }
                case 7: // Ngay LE
                {
                    $i =9;
                    break;
                }
            }
            
            $sql_sel = "SELECT * FROM `producttime` WHERE `ProductID`='$proid' AND `DayOfWeek` = '$i'; ";
            $sql ="";
            try{
                $res = $this->db->query($sql_sel)->result();
                $arr = (array)$res;
                if(count($arr)>0)                
                {
                   $sql = "UPDATE `producttime` SET  `AvailableHourFrom`=$ft,`AvailableHourTo`='$tt' WHERE `ProductID`='$proid' AND `DayOfWeek` = '$i';" ; // update
                   
                }
                else
                {
                    $sql = "INSERT INTO `producttime` (`ProductID`,`DayOfWeek`,`AvailableHourFrom`,`AvailableHourTo`) VALUES ('$proid','$i',$ft,$tt);" ; // insert
                }
                
                try{
                       $this->db->query($sql);
                   }
                   catch(exceptin $ee)
                   {
                       
                   }
                
            }
            catch(exception $e)
            {
                
            }
            
        }
        
  }
?>
