<?php

class Rolemenumodulemodel extends CI_Model{
        public $errorStr; 
        
        public function __construct()
        {
            parent::__construct();
        }
        
        public function ajax_list(){
            $roleID         = $_POST['RoleID']; 
            $menuID         = $_POST['MenuID'];
            $moduleID       = $_POST['ModuleID'];
            $page           = $_POST["Page"];
            
             $sql = "SELECT '1' AS STT,`rolemenumodule`.*,IF(`AllowNew`= '1','Có','Không') AS allnew,IF(`AllowEdit` = '1','Có','Không')AS alledit,IF(`AllowDelete`='1','Có','Không')AS allde,IF(`AllowView`='1','Có','Không')AS allview,IF(`AllowPrint`='1','Có','Không')AS allprint,IF(`Status`='1','Có','Không')AS statu FROM `rolemenumodule`"; 
             $sql1 = "SELECT COUNT(*) AS Total FROM `rolemenumodule`";
                    
            $sql = $sql." where 1=1 ";
            $sql1 = $sql1." where 1=1 ";
            
            if($roleID !=''){
                $sql = $sql."   and   `RoleId` like '%".$roleID."%'";
                $sql1 = $sql1." and `RoleId` like '%".$roleID."%'"; 
            }
            if($menuID !=''){
                $sql = $sql."   and  `MenuId` like '%".$menuID."%'";
                $sql1 = $sql1." and  `MenuId` like '%".$menuID."%'";
            }
            if($moduleID !=''){
                $sql = $sql."   and  `ModuleId` like '%".$moduleID."%'";
                $sql1 = $sql1." and  `ModuleId` like '%".$moduleID."%'";
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
        
        public function get_Menu_new1(){
            $str="<optgroup label=\"Không chọn\"><option value=\"\">Không chọn...</option></optgroup>";
            $sql = "SELECT * FROM `menu` WHERE LENGTH(`MenuId`)=2 "; //lấy cấp 1
            $ListCap1 = $this->db->query($sql)->result();
            $arr1= (array)$ListCap1;
            for($i=0; $i<count($arr1);$i++)
            {
                $str = $str."<optgroup label=\"".$arr1[$i]->MenuId." - ".$arr1[$i]->MenuName."\">";
                //$str = $str."<optgroup value=\"".$arr1[$i]->MenuId."\">".$arr1[$i]->MenuName." - ".$arr1[$i]->MenuName;
                $cap1=$arr1[$i]->MenuId;
                $sql1 = "SELECT * FROM `menu` WHERE LENGTH(`MenuId`)=4 AND LEFT(`MenuId`,2)='$cap1'";
                $ListCap2 = $this->db->query($sql1)->result();
                $arr2= (array)$ListCap2;
                for($j=0; $j<count($arr2);$j++)
                {
                    $str = $str."<option value=\"".$arr2[$j]->MenuId ."\">".$arr2[$j]->MenuId." - ".$arr2[$j]->MenuName."</option>";
                }  
                $str = $str."</optgroup>"; 
            }
            return $str;
        }
        
         public function get_Menu_new(){
            $str="<option value=\"\">Không chọn...</option>";
            $sql = "SELECT * FROM `menu` "; //lấy cấp 1
            $ListCap1 = $this->db->query($sql)->result();
            $arr2= (array)$ListCap1;
            for($j=0 ; $j < count($arr2);$j++){
                  $str = $str."<option value=\"".$arr2[$j]->MenuId ."\">".$arr2[$j]->MenuId." - ".$arr2[$j]->MenuName."</option>";
             }
            return $str;
        }
        
        public function get_Module_new(){
             $str = "<option value=\"\">Không chọn...</option>";
             $sql = "SELECT * FROM `module`";
             $list = $this->db->query($sql)->result();
             $arr = (array)$list;
             for($i=0 ; $i < count($arr);$i++){
                  $str = $str."<option value=\"".$arr[$i]->ModuleId ."\">".$arr[$i]->ModuleId."</option>";
             }
             
             //$str = $str."</optgroup>"; 
             
             return $str;
        }
        
        public function get_Roles(){
             $str = "<option value=\"\">Không chọn...</option>";
             $sql = "SELECT * FROM `roles`";
             $list = $this->db->query($sql)->result();
             $arr = (array)$list;
             for($i=0 ; $i < count($arr);$i++){
                  $str = $str."<option value=\"".$arr[$i]->RoleId ."\">".$arr[$i]->RoleId." - ".$arr[$i]->RoleName."</option>";
             }
             
             //$str = $str."</optgroup>"; 
             
             return $str;
        }
        
        public function capnhat_rolemenumodule(){
            $RoleID = $_POST['RoleID'];
            $MenuID = $_POST['MenuID'];
            $ModuleID = $_POST['ModuleID'];
            $AllowNew = $_POST['AllowNew'];
            $AllowEdit = $_POST['AllowEdit'];
            $AllowPrint = $_POST['AllowPrint'];
            $AllowView = $_POST['AllowView'];
            $AllowDelete = $_POST['AllowDelete'];
            $arr = (array)$_SESSION['AccUser'];
            if(isset($arr))
             $createdby = $arr['User']->UserId;
            $res = 0;
            try{
                $sql = "UPDATE `rolemenumodule` SET `AllowNew` =b'$AllowNew',`AllowEdit`=b'$AllowEdit',`AllowDelete`=b'$AllowDelete',`AllowView`=b'$AllowView',`AllowPrint`=b'$AllowPrint',`ModifiedBy`='$createdby',`ModifiedDate`=NOW() WHERE `RoleId` = '$RoleID' AND `MenuId`='$MenuID' AND `ModuleId`='$ModuleID'";
                $this->db->query($sql);
                $res = 1;
            }
            catch(exception $e)
            {
                $res    = 0;
            }

            return $res;
        }
        
        public function them_moi_role_menumodule(){
            $RoleID = $_POST['RoleID'];
            $MenuID = $_POST['MenuID'];
            $ModuleID = $_POST['ModuleID'];
            $litMenuID = $_POST['ListMenuID'];
            $AllowNew = $_POST['AllowNew'];
            $AllowEdit = $_POST['AllowEdit'];
            $AllowPrint = $_POST['AllowPrint'];
            $AllowView = $_POST['AllowView'];
            $AllowDelete = $_POST['AllowDelete'];
            $arr = (array)$_SESSION['AccUser'];
            if(isset($arr))
             $createdby = $arr['User']->UserId;
            $res = 0;
            $str = "";
            $sql_sel = "SELECT * FROM `rolemenumodule`
                         WHERE `RoleId` = '$RoleID' 
                         AND `ModuleId` = '$ModuleID'";  
           try{
                $list_res = $this->db->query($sql_sel)->result();
                $arr = (array)$list_res;
                if(count($arr) !=0)                
                {
                    //$str = "Quyền hạn đã được phân quyền ";
                    $sql_del = "DELETE FROM `rolemenumodule`
                                WHERE `RoleId` = '$RoleID' 
                                AND `ModuleId` = '$ModuleID'";
                    $req = $this->db->query($sql_del);
                    if($req)
                    {
                         if(isset($litMenuID))
                        {
                            $Category_Array = array();
                            $Category_Array = explode(';',$litMenuID);
                            $sql ="";                   
                            for($i =0; $i<= count($Category_Array)-1; $i++)
                            {
                                 $maCate =str_replace("[","",$Category_Array[$i]);
                                 $maCate =str_replace("]","",$maCate);
                                 if($maCate != 0)
                                 { 

                                     $sql = "INSERT INTO `rolemenumodule`(`RoleId`,`MenuId`,`ModuleId`,`AllowNew`,`AllowEdit`,`AllowDelete`,`AllowView`,`AllowPrint`,`Status`,`CreatedBy`,`CreatedDate`)
                                            VALUES('$RoleID','$maCate','$ModuleID',b'$AllowNew',b'$AllowEdit',b'$AllowDelete',b'$AllowView',b'$AllowPrint','1','$createdby',NOW())";
                                    $this->db->query($sql);

                                 }
                             }

                                
                                $res = 1;
                        }
                    }
                }
                else
                {
                    if(isset($litMenuID))
                    {
                        $Category_Array = array();
                        $Category_Array = explode(';',$litMenuID);
                        $sql ="";                   
                        for($i =0; $i<= count($Category_Array)-1; $i++)
                        {
                             $maCate =str_replace("[","",$Category_Array[$i]);
                             $maCate =str_replace("]","",$maCate);
                             if($maCate != 0)
                             { 

                                 $sql = "INSERT INTO `rolemenumodule`(`RoleId`,`MenuId`,`ModuleId`,`AllowNew`,`AllowEdit`,`AllowDelete`,`AllowView`,`AllowPrint`,`Status`,`CreatedBy`,`CreatedDate`)
                                        VALUES('$RoleID','$maCate','$ModuleID',b'$AllowNew',b'$AllowEdit',b'$AllowDelete',b'$AllowView',b'$AllowPrint','1','$createdby',NOW())";
                                $this->db->query($sql);

                             }
                         }
                            
                            $res = 1;
                    }
                    
                }
                
            }
            catch(exception $e)
            {
                $res    = 0;
            } 
            
             $_list =  array('res'=>$res,'str'=>$str);
            return $_list;
        }
        
        public function delete_menu_module()
        {
             $RoleID = $_POST['RoleID'];
             $MenuD =  $_POST['MenuID'];
             $ModuleID = $_POST['ModuleID'];
             $res = 0;
             try{
                    $sql = "DELETE FROM `rolemenumodule` WHERE `RoleId` = '$RoleID' AND `MenuId` = '$MenuD' AND `ModuleId` = '$ModuleID'";
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
