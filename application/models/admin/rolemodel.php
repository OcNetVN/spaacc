<?php

class Rolemodel extends CI_Model{
        public $errorStr; 
        
        public function __construct()
        {
            parent::__construct();
        }
        
        public function ajax_list(){
            $roleID         = $_POST['RoleID']; 
            $roleName       = $_POST['RoleName'];
            $page           = $_POST["Page"];
            
             $sql = "SELECT '1' AS STT,`roles`.* FROM `roles`"; 
             $sql1 = "SELECT COUNT(*) AS Total FROM `roles`";
                    
            $sql = $sql." where 1=1 ";
            $sql1 = $sql1." where 1=1 ";
            
            if($roleID !=''){
                $sql = $sql." and   `RoleId` like '%".$roleID."%'";
                $sql1 = $sql1." and `RoleId` like '%".$roleID."%'"; 
            }
            if($roleName !=''){
                $sql = $sql."   and  `RoleName` like '%".$roleName."%'";
                $sql1 = $sql1." and  `RoleName` like '%".$roleName."%'";
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
                
         $res = array("TotalRecord"=>$TotalRecord,"TotalPage"=>$TotalPage,"CurPage"=>$page,"lst"=>$_arrSpa, "Toto"=>$ResTotalPage);
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
        
        public function ajax_capnhat_role(){
            $RoleID = $_POST['RoleID'];
            $RoleName = $_POST['RoleName'];
            $res = 0;
            try{
                $sql = "UPDATE `roles` SET `RoleName` = '$RoleName' WHERE `RoleId` = '$RoleID'";
                $this->db->query($sql);
                $res = 1;
            }
            catch(exception $e)
            {
                $res    = 0;
            }

            return $res;
        }
        
        public function them_moi_role(){
            $RoleID = $_POST['RoleID'];
            $RoleName = $_POST['RoleName'];
            $arr = (array)$_SESSION['AccUser'];
            if(isset($arr))
             $createdby = $arr['User']->UserId;
            $res = 0;
            if($RoleID != 'admin'){
               try{
                    $sql = "INSERT INTO `roles`(`RoleId`,`RoleName`,`CreatedBy`,`CreatedDate`) VALUES('$RoleID','$RoleName','$createdby',NOW())";
                    $this->db->query($sql);
                    $res = 1;
                }
                catch(exception $e)
                {
                    $res    = 0;
                } 
            }
            else{
                $res = 0;
            }
            
            return $res;
            
        }
        
        public function delete_role(){
             $RoleID = $_POST['RoleID'];
             $res = 0;
             try{
                   $sql = "DELETE FROM `roles` WHERE `RoleId` = '$RoleID'";
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
