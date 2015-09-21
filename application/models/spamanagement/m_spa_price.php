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
          
            $sql= "SELECT '1' AS STT,p.`ProductID`,p.`Name`,p.`Status`,p.`ProductType`,p.`Duration`,p.`CurrentVouchers`,p.`MaxProductatOnce`,p.`ValidTimeFrom`,p.`ValidTimeTo`,p.`CreatedBy`,p.`CreatedDate`,c.`StrValue2`";
            $sql.=" FROM products p , price pr , commoncode c";
            $sql.=" WHERE p.`ProductID` = pr.`ProductID`AND c.`CommonId` = p.`ProductType`AND p.`SpaID` = '$spaid'";


  
            $sql1 ="SELECT count(*) as Total  FROM products p";
            $sql1.=" WHERE p.`SpaID` = '$spaid'";
                    
            // $sql = $sql." where 1=1 ";
            // $sql1 = $sql1." where 1=1 ";            
          
            
            if($keyword  !=''){
                $sql = $sql." and `name` like '%".$keyword ."%'";
                $sql1 = $sql1." and `name` like '%".$keyword ."%'";
            }
            
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
