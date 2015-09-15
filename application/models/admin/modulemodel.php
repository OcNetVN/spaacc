<?php

class Modulemodel extends CI_Model{
        public $errorStr; 
        
        public function __construct()
        {
            parent::__construct();
        }
        
        public function ajax_list(){
            $moduleID    = $_POST['ModuleID']; 
            $description = $_POST['ModuleNotes'];
            $page        = $_POST["Page"];
            
             $sql = "SELECT '1' AS STT,`module`.* FROM `module`"; 
             $sql1 = "SELECT COUNT(*) AS Total FROM `module`";
                    
            $sql = $sql." where 1=1 ";
            $sql1 = $sql1." where 1=1 ";
            
            if($moduleID !=''){
                $sql = $sql." and `ModuleId` like '%".$moduleID."%'";
                $sql1 = $sql1." and `ModuleId` like '%".$moduleID."%'"; 
            }
            if($description !=''){
                $sql = $sql." and  `Description` like '%".$description."%'";
                $sql1 = $sql1." and  `Description` like '%".$description."%'";
            }
            $sql = $sql." ORDER BY `CreatedDate` DESC ";
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
        
        
        public function ajax_capnhat_module(){
            $ModuleID = $_POST['ModuleID'];
            $Description = $_POST['Description'];
            $res = 0;
            try{
                $sql = "UPDATE `module` SET `Description` = '$Description' WHERE `ModuleId` = '$ModuleID'";
                $this->db->query($sql);
                $res = 1;
            }
            catch(exception $e)
            {
                $res    = 0;
            }

            return $res;
        }
             
        
  }
?>
