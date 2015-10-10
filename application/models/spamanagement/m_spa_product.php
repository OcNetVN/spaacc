<?php
    class M_spa_product extends CI_Model{
        public function __construct()
        {
            parent::__construct();

        }


        /*
        |----------------------------------------------------------------
        |function list products
        |----------------------------------------------------------------
        */

        public function list_products(){
            $spaid    = $_POST['spaid'];
            $keyword    = $_POST['keyword'];
            $page       = $_POST["Page"];
          
            $sql= "SELECT '1' AS STT, '2' AS Giahientai, '3' AS GiaEdit, '0' AS GiaXetDuyet, '4' AS Loai, p.*";
            $sql.=" FROM products p";
            $sql.=" WHERE p.`SpaID` = '$spaid'";
  
            $sql1 ="SELECT count(*) as Total  FROM products p";
            $sql1.=" WHERE p.`SpaID` = '$spaid'";
                    
            // $sql = $sql." where 1=1 ";
            // $sql1 = $sql1." where 1=1 ";            
          
            
            if($keyword  !=''){
                $sql = $sql." and `name` like '%".$keyword ."%'";
                $sql1 = $sql1." and `name` like '%".$keyword ."%'";
            }

            $sql = $sql." order by Status DESC, name ASC";
            
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            // return $sql;

            $_arrSpa = $this->db->query($sql)->result();

            $this->AddSTT_product($_arrSpa,$page); 

            $this->AddGiahientai_product($_arrSpa); 

            $this->AddGiaEdit_product($_arrSpa);

            $this->AddGiaXetDuyet_product($_arrSpa); 

            $this->AddLoai_product($_arrSpa); 

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

         /*
        |----------------------------------------------------------------
        |function search_nangcao_Products
        |----------------------------------------------------------------
        */

        public function search_nangcao_Products(){

            $spaid    = $_POST['spaid'];
            $ProductID    = $_POST['ProductID'];
            $Name    = $_POST['Name'];
            $ProductType    = $_POST['ProductType'];
            $page       = $_POST["Page"];
          
            $sql= "SELECT '1' AS STT, '2' AS Giahientai, '3' AS GiaEdit, '0' AS GiaXetDuyet, '4' AS Loai, p.*";
            $sql.=" FROM products p";
            $sql.=" WHERE p.`SpaID` = '$spaid'";
  
            $sql1 ="SELECT count(*) as Total  FROM products p";
            $sql1.=" WHERE p.`SpaID` = '$spaid'";
                    
            // $sql = $sql." where 1=1 ";
            // $sql1 = $sql1." where 1=1 ";            
          
            
            if($ProductID  !=''){
                $sql = $sql." and `ProductID` like '%".$ProductID ."%'";
                $sql1 = $sql1." and `ProductID` like '%".$ProductID ."%'";
            }
            if($Name  !=''){
                $sql = $sql." and `name` like '%".$Name ."%'";
                $sql1 = $sql1." and `name` like '%".$Name ."%'";
            }
            if($ProductType  !=''){
                $sql = $sql." and `ProductType` = '".$ProductType ."'";
                $sql1 = $sql1." and `ProductType` = '".$ProductType ."'";
            }

            $sql = $sql." order by Status DESC, name ASC";
            
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            // return $sql;

            $_arrSpa = $this->db->query($sql)->result();

            $this->AddSTT_product($_arrSpa,$page); 

            $this->AddGiahientai_product($_arrSpa); 

            $this->AddGiaEdit_product($_arrSpa);

            $this->AddGiaXetDuyet_product($_arrSpa); 

            $this->AddLoai_product($_arrSpa); 

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

        public function get_products_by_spa(){
            // $spaid    = $_POST['spaid'];
            $spaid = $_SESSION["AccSpa"]["spaid"];
          
            // $sql= "SELECT '1' AS STT, '2' AS Giahientai,'4' AS Loai, p.*";
            $sql= "SELECT '0' AS Giahientai, p.`ProductID`,p.`Name`";
            $sql.=" FROM products p";
            $sql.=" WHERE p.`SpaID` = '$spaid' AND p.`Status`=1 ";
            $sql = $sql." order by p.`ProductType`";
            
            
            // return $sql;

            $_arrSpa = $this->db->query($sql)->result();

            // $this->AddSTT_product($_arrSpa,1); 

            // return $_arrSpa;
            $this->AddGiahientai_product($_arrSpa); 

            // $this->AddLoai_product($_arrSpa); 

            $res = array("lst"=>$_arrSpa);
            return $res;
        }

        public function get_products_by_spa_ProductType(){
            $ProductType    = $_POST['ProductType'];
            $spaid = $_SESSION["AccSpa"]["spaid"];
          
            // $sql= "SELECT '1' AS STT, '2' AS Giahientai,'4' AS Loai, p.*";
            $sql= "SELECT '0' AS Giahientai, p.`ProductID`,p.`Name`";
            $sql.=" FROM products p";
            $sql.=" WHERE p.`SpaID` = '$spaid' AND p.`Status`=1 AND p.`ProductType`='$ProductType' ";
            $sql = $sql." order by p.`ProductType`";
            
            
            // return $sql;

            $_arrSpa = $this->db->query($sql)->result();

            // $this->AddSTT_product($_arrSpa,1); 

            // return $_arrSpa;
            $this->AddGiahientai_product($_arrSpa); 

            // $this->AddLoai_product($_arrSpa); 

            $res = array("lst"=>$_arrSpa);
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
        public function AddGiahientai_product($arr)
        {
            $arr1 = (array) $arr;
            for($i=0;$i<count($arr1);$i++)
            {
                $arr1[$i]->Giahientai = $this->get_product_price_today_product($arr1[$i]->ProductID)->Price;
            }
            return $arr1;
        }
        public function AddGiaEdit_product($arr)
        {
            $arr1 = (array) $arr;
            for($i=0;$i<count($arr1);$i++)
            {
                $arr1[$i]->GiaEdit = $this->get_product_price_edit($arr1[$i]->ProductID)->Price;
            }
            return $arr1;
        }
         public function AddGiaXetDuyet_product($arr)
        {
            $arr1 = (array) $arr;
            for($i=0;$i<count($arr1);$i++)
            {
                $arr1[$i]->GiaXetDuyet = $this->get_product_price_xetduyet_product($arr1[$i]->ProductID)->Price;
            }
            return $arr1;
        }
        public function AddLoai_product($arr)
        {
            $arr1 = (array) $arr;
            for($i=0;$i<count($arr1);$i++)
            {
                $arr1[$i]->Loai = $this->get_Loai($arr1[$i]->ProductType)->StrValue2;
            }
            return $arr1;
        }
         public function get_Loai($ProductType)
        {
            $sql    =   "SELECT * FROM `commoncode` WHERE `CommonId` = $ProductType ";
            $query  =   $this->db->query($sql)->row();
            return $query;
        }
        public function get_product_price_today_product($ProductID)
        {
            $sql    =   "SELECT * FROM `price` WHERE `ProductID`=$ProductID AND `Status`=1 AND `ApprovedBy`!='' ORDER by `CreatedDate` DESC limit 0,1";
            $query  =   $this->db->query($sql)->row();
            return $query;
        }
        public function get_product_price_edit($ProductID)
        {
            $sql    =   "SELECT * FROM `price` WHERE `ProductID`=$ProductID AND `Status`=0 AND `ApprovedBy`!='' ORDER by `CreatedDate` DESC limit 0,1";
            $query  =   $this->db->query($sql)->row();
            return $query;
        }
        public function get_product_price_xetduyet_product($ProductID)
        {
            $sql    =   "SELECT * FROM `price` WHERE `ProductID`=$ProductID AND `Status`=1 AND `ApprovedBy`='' ORDER by `CreatedDate` DESC limit 0,1";
            $query  =   $this->db->query($sql)->row();
            return $query;
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
        |function XemGia_Product
        |----------------------------------------------------------------
        */

        public function XemGia_Product(){            
            $id = $_POST['id'];   
            $page  = $_POST["Page"];
            $NAME = $_POST['NAME'];

            $sql = "SELECT '1' AS STT, b.*, a.`Name`,a.`SpaID` FROM `products` a INNER JOIN `price` b ON a.`ProductID`=b.`ProductID` WHERE a.`ProductID`='$id' AND b.`Status`=0 ORDER BY CreatedDate DESC";  //lay ten nen phai ket voi bang products     
            $sql1 = "SELECT count(*) as Total FROM price where `ProductID` = '".$id."' AND `Status`=0";
            
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            
            $_arrSpa = $this->AddSTT_product($this->db->query($sql)->result(),$page); 
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
                
            $res = array("TotalRecord"=>$TotalRecord,"TotalPage"=>$TotalPage,"CurPage"=>$page,"lst"=>$_arrSpa,"Toto"=>$ResTotalPage,"tensp"=>$NAME);
            return $res;
        }

        /*
        |----------------------------------------------------------------
        |function ThemGia_Product
        |----------------------------------------------------------------
        */

        public function ThemGia_Product(){            
            $id  = $_POST["id"];
            // $tensp  = $_POST["tensp"];
            $Giathem  = $_POST["Giathem"];
            $nguoitao=$_SESSION['AccSpa']['User']->UserId;

            $sql="INSERT INTO `price` (`ProductID`, `Price`, `CreatedBy`, `CreatedDate`,`Status`) VALUES ('$id', '$Giathem', '$nguoitao',NOW(),'1')";
            
            $results=$this->db->query($sql);
            // $res = array("lst"=>$results,"masp"=>$id,"tensp"=>$tensp);
            return $results;
        }

         /*
        |----------------------------------------------------------------
        |function Edit_Product
        |----------------------------------------------------------------
        */

        public function Edit_Product(){            
            $id  = $_POST["id"];
            $sql="SELECT * FROM `products` WHERE `ProductID` = '$id'";
            $results=$this->db->query($sql)->row();
            return $results;
        }
         /*
        |----------------------------------------------------------------
        |function Edit_Images_Product
        |----------------------------------------------------------------
        */

        public function Edit_Images_Product(){            
            $id  = $_POST["id"];
            $sql="SELECT * FROM `links` WHERE `ObjectIDD`='$id'";
            $images=$this->db->query($sql)->result();
            $results = (array)$images;
            return $results;
        }
         /*
        |----------------------------------------------------------------
        |function Edit_Time_Product
        |----------------------------------------------------------------
        */

        public function Edit_Time_Product(){            
            $id  = $_POST["id"];
            $sql="SELECT * FROM `producttime` WHERE `ProductID`='$id' ";
            $images=$this->db->query($sql)->result();
            $results = (array)$images;
            return $results;
        }

        /*
        |----------------------------------------------------------------
        |function Update_MaxProductatOnce
        |----------------------------------------------------------------
        */

        public function Update_MaxProductatOnce(){            
            $id  = $_POST["id"];
            $atOnce  = $_POST["atOnce"];

            // $nguoitao=$_SESSION['AccSpa']['User']->UserId;
            // 
            $sql="UPDATE `products` SET `MaxProductatOnce` = '$atOnce' WHERE `ProductID` = '$id'";

            $results=$this->db->query($sql);
            return $results;
        }
        /*
        |----------------------------------------------------------------
        |function update_thongtin_product
        |----------------------------------------------------------------
        */

        public function update_thongtin_product(){ 

            $ProductID  = $_POST["ProductID"];
            $Description  = $_POST["Description"];
            $CurrentVouchers  = $_POST["CurrentVouchers"];
            $MaxProductatOnce  = $_POST["MaxProductatOnce"];
            $Duration  = $_POST["Duration"];
            $ValidTimeFrom  = $_POST["ValidTimeFrom"]." 00:00:00";
            $ValidTimeTo  = $_POST["ValidTimeTo"]." 00:00:00";
            $Policy  = $_POST["Policy"];
            $Restriction  = $_POST["Restriction"];
            $Tips  = $_POST["Tips"];

            $nguoicapnhat=$_SESSION['AccSpa']['User']->UserId;

            // $ModifiedDate = NOW();
            // $ModifiedBy = $nguoicapnhat;
            // return $ModifiedDate;           

            $sql = "UPDATE `products` 
                    SET `Description` = '$Description',
                        `CurrentVouchers` = '$CurrentVouchers',
                        `MaxProductatOnce` = '$MaxProductatOnce',
                        `Duration` = '$Duration',
                        `ValidTimeFrom` = '$ValidTimeFrom',
                        `ValidTimeTo` = '$ValidTimeTo',
                        `Policy` = '$Policy',
                        `Restriction` = '$Restriction',
                        `Tips` = '$Tips',
                        `ModifiedDate` = NOW(),
                        `ModifiedBy` = '$nguoicapnhat' 
                    WHERE `ProductID` = '$ProductID' ";
            $results=$this->db->query($sql);
            return $results;
        }


        /*
        |----------------------------------------------------------------
        |function update_time_product
        |----------------------------------------------------------------
        */

        public function update_time_product(){ 

            $ProductID  = $_POST["ProductID"];
            $arr_hour  = $_POST["arr_hour"];

            foreach( $arr_hour as $row_hour)
            {
                $sql                =   "UPDATE `producttime` SET 
                                                `AvailableHourFrom` = '".$row_hour["time_from"]."', 
                                                `AvailableHourTo` = '".$row_hour["time_to"]."' 
                                            WHERE `ProductID` = '$ProductID' AND `DayOfWeek` = ".$row_hour["dayofweek"];
                $query              =   $this->db->query($sql);
                if(!$query){
                    return false;
                }

            }
            return $query;

        }


        /*
        |----------------------------------------------------------------
        |function add_time_product
        |----------------------------------------------------------------
        */

        public function add_time_product(){ 

            $ProductID  = $_POST["ProductID"];
            if(empty($ProductID)){
                return false;
            }
            $arr_hour  = $_POST["arr_hour"];

            foreach( $arr_hour as $row_hour)
            {
                $sql="INSERT INTO `producttime`(`ProductID`, `DayOfWeek`, `AvailableHourFrom`,`AvailableHourTo`) VALUES ('$ProductID', '".$row_hour["dayofweek"]."','".$row_hour["time_from_add"]."','".$row_hour["time_to_add"]."' )";
                // return $sql;
                $query              =   $this->db->query($sql);
                if(!$query){
                    return false;
                }

            }

            return $query;
        }





        /*
        |----------------------------------------------------------------
        |function Update_Trangthai
        |----------------------------------------------------------------
        */

        public function Update_Trangthai(){            
            $id  = $_POST["id"];
            $status  = $_POST["status"];

            // $nguoitao=$_SESSION['AccSpa']['User']->UserId;
            $sql="UPDATE `products` SET `Status` = 1 - '$status' WHERE `ProductID` = '$id'";

            $results=$this->db->query($sql);
            return $results;
        }



        /*
        |----------------------------------------------------------------
        |function add_thongtin_product
        |----------------------------------------------------------------
        */

        public function add_thongtin_product(){ 
            $ProductID =  $this->getProducctID();

            // return $ProductID;


            $SpaID = $_SESSION["AccSpa"]["spaid"];
            $Name  = $_POST["Name"];
            $Description  = $_POST["Description"];
            $Status = 0;
            $ProductType  = $_POST["ProductType"];
            $CurrentVouchers  = $_POST["CurrentVouchers"];
            $Duration  = $_POST["Duration"];
            $MaxProductatOnce  = $_POST["MaxProductatOnce"];
            $ValidTimeFrom  = $_POST["ValidTimeFrom"]." 00:00:00";
            $ValidTimeTo  = $_POST["ValidTimeTo"]." 00:00:00";
            $Policy  = $_POST["Policy"];
            $Restriction  = $_POST["Restriction"];
            $Tips  = $_POST["Tips"];
            $CreatedBy=$_SESSION['AccSpa']['User']->UserId;

            $Gia  = $_POST["Gia"];

            // $ModifiedDate = NOW();
            // $ModifiedBy = $nguoicapnhat;
            // return $ModifiedDate;  
            $sql="INSERT INTO `products`(`ProductID`, `SpaID`, `Name`, `Description`,`Status`,`ProductType`,`CurrentVouchers`,`Duration`,`MaxProductatOnce`,`ValidTimeFrom`,`ValidTimeTo`,`Policy`,`Restriction`,`CreatedDate`,`Tips`,`CreatedBy`) VALUES ('$ProductID', '$SpaID', '$Name','$Description','$Status','$ProductType','$CurrentVouchers','$Duration','$MaxProductatOnce','$ValidTimeFrom','$ValidTimeTo','$Policy','$Restriction',NOW(),'$Tips','$CreatedBy')";
            // return $sql;
            $query              =   $this->db->query($sql);
            if(!$query){
                return false;
            }

            $sql_price="INSERT INTO `price` (`ProductID`, `Price`, `CreatedBy`, `CreatedDate`,`Status`) VALUES ('$ProductID', '$Gia', '$CreatedBy',NOW(),'1')";
            $query_price=$this->db->query($sql_price);
            if(!$query_price){
                $sql_del="DELETE FROM `products` WHERE `ProductID`= '$ProductID' ";
                $this->db->query($sql_del);
                return false;
            }    
            $res = array("result"=>$query_price,"ProductID"=>$ProductID);
            return $res;
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


       

        
    }
?>
