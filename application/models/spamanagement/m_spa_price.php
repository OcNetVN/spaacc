<?php
    class M_spa_price extends CI_Model{
        public function __construct()
        {
            parent::__construct();
        }


        /*
        |----------------------------------------------------------------
        |function search products
        |----------------------------------------------------------------
        */

        public function search_products(){
            $spaid    = $_POST['spaid'];
            $keyword    = $_POST['keyword'];
            $page       = $_POST["Page"];
          
            $sql= "SELECT '1' AS STT, '2' AS Giahientai, '3' AS GiaEdit, '4' AS Loai, p.*";
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

            $this->AddSTT($_arrSpa,$page); 

            $this->AddGiahientai($_arrSpa); 

            $this->AddGiaEdit($_arrSpa); 

            $this->AddLoai($_arrSpa); 



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
        public function AddSTT($arr,$page)
        {
            $arr1 = (array) $arr;
            for($i=0;$i<count($arr1);$i++)
            {
                $arr1[$i]->STT = (($page-1)*10+($i+1));
            }
            return $arr1;
        }
        public function AddGiahientai($arr)
        {
            $arr1 = (array) $arr;
            for($i=0;$i<count($arr1);$i++)
            {
                $arr1[$i]->Giahientai = $this->get_product_price_today($arr1[$i]->ProductID)->Price;
            }
            return $arr1;
        }
        public function AddGiaEdit($arr)
        {
            $arr1 = (array) $arr;
            for($i=0;$i<count($arr1);$i++)
            {
                $arr1[$i]->GiaEdit = $this->get_product_price_edit($arr1[$i]->ProductID)->Price;
            }
            return $arr1;
        }
        public function AddLoai($arr)
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
        public function get_product_price_today($ProductID)
        {
            $sql    =   "SELECT * FROM `price` WHERE `ProductID`=$ProductID AND `Status`=1 AND `ApprovedBy`!='' AND `ApprovedDate`!='' ORDER by `CreatedDate` DESC limit 0,1";
            $query  =   $this->db->query($sql)->row();
            return $query;
        }
        public function get_product_price_edit($ProductID)
        {
            $sql    =   "SELECT * FROM `price` WHERE `ProductID`=$ProductID AND `Status`=0 AND `ApprovedBy`!='' AND `ApprovedDate`!='' ORDER by `CreatedDate` DESC limit 0,1";
            $query  =   $this->db->query($sql)->row();
            return $query;
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
            
            $_arrSpa = $this->AddSTT($this->db->query($sql)->result(),$page); 
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
        |function save spa hour
        |----------------------------------------------------------------
        */
        public function btnsave_spa_price()
        {
            $spaid                  =   $_SESSION["AccSpa"]["spaid"];
            
            $arrcbdayofweek         =   $_POST["arrcbdayofweek"];
            $arr_price               =   $_POST["arr_price"];
            
            foreach( $arr_price as $row_price)
            {
                $flag               =   array_search ($row_price["dayofweek"],$arrcbdayofweek);
                if($flag            === false)
                {
                    $time_from      =   0;
                    $time_to        =   0;
                }
                else
                {
                    $time_from      =   (int)substr($row_price["time_from"],0,2);
                    $time_to        =   (int)substr($row_price["time_to"],0,2);
                }
                    
                $sql                =   "UPDATE `spatime` SET 
                                                `AvailableHourFrom` = '".$time_from."', 
                                                `AvailableHourTo` = '".$time_to."' 
                                            WHERE `spaID` = '$spaid' AND `DayOfWeek` = ".$row_price["dayofweek"];
                $query              =   $this->db->query($sql);
            }
            
            if($query)
                $stt                =   1;
            else
                $stt                =   0;
                
            //return
            $arr                    =   array("stt"     =>  $stt);
            return      $arr;
        }

        
    }
?>
