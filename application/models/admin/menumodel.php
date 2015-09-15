<?php

class Menumodel extends CI_Model{
        public $errorStr; 
        
        public function __construct()
        {
            parent::__construct();
        }
        
        public function ajax_list(){
            $menuID    = $_POST['MenuID']; 
            $menuName    = $_POST['MenuName'];
            $menuNotes    = $_POST['MenuNotes'];
            $page       = $_POST["Page"];
            
             $sql = "SELECT '1' AS STT,`menu`.* FROM `menu`"; 
             $sql1 = "SELECT COUNT(*) AS Total FROM `menu`";
                    
            $sql = $sql." where 1=1 ";
            $sql1 = $sql1." where 1=1 ";
            
            if($menuID !=''){
                $sql = $sql." and MenuId like '%".$menuID."%'";
                $sql1 = $sql1." and MenuId like '%".$menuID."%'"; 
            }
            if($menuName !=''){
                $sql = $sql." and  MenuName like '%".$menuName."%'";
                $sql1 = $sql1." and  MenuName like '%".$menuName."%'";
            }
            if($menuNotes !=''){
                $sql = $sql." and Description like '%".$menuNotes ."%'";
                $sql1 = $sql1." and Description like '%".$menuNotes ."%'";
            }
            $sql = $sql." ORDER BY `CreatedDated` DESC ";
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
        
        
        public function AddSTT($arr)
        {
            $arr1 = (array) $arr;
            for($i=0;$i<count($arr1);$i++)
            {
                $arr1[$i]->STT = ($i+1);
            }
            return $arr1;
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
        
        public function ajax_capnhat_menu(){
            $MenuId = $_POST['MenuID'];
            $MenuName = $_POST['MenuName'];
            $res = 0;
            try{
                $sql = "UPDATE `menu` SET `MenuName` = '$MenuName' WHERE `MenuId` = '$MenuId'";
                $this->db->query($sql);
                $res = 1;
            }
            catch(exception $e)
            {
                $res    = 0;
            }

            return $res;
        }
        

        // load data của bảng product và spa
        
        public function Capnhat_Promotion(){
            $promoID      =   $_POST['PromoID'];
            $promoName    = $_POST['Name'];            
            $Notes        = $_POST['Notes'];
            $PrintToBill  =  $_POST['Inbill'];            
            $date1        = strtotime($_POST['Begin']);
            $BeginDateTime = date( 'Y-m-d H:i:s', $date1 );
            $date2         = strtotime($_POST['To']);
            $EndDateTime   = date( 'Y-m-d H:i:s',$date2);
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
                   $sql = "UPDATE `promotions` SET `PromotionName`='$promoName',`BeginDateTime`='$BeginDateTime',`EndDateTime`='$EndDateTime',`ModifiedBy`='$createdby',`ModifiedDate`=NOW(),`PromoText`='$Notes',`PrintToBill`='$PrintToBill' WHERE `PromotionId` = '$promoID'";//update
                }
                else{   
                        $sql = "INSERT INTO `promotions`(`PromotionId`,`PromotionName`,`BeginDateTime`,`EndDateTime`,`CreatedDate`,`CreatedBy`,`PromoText`,`PrintToBill`)VALUES ('$promoID','$promoName','$BeginDateTime','$EndDateTime',NOW(),'$createdby','$Notes','$PrintToBill')"; // insert
                        
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
        
        
  }
?>
