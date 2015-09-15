<?php
  class Spautilmodel extends CI_Model{
      public function __construct()
      {
            parent::__construct();
      }
      
      public function update_location(){
            $spa_ID       = $_POST['spaID'];
          $commonID = "";
          if($_POST['commID'] != "" || $_POST['commID'] != null || $_POST['commID'] != NULL ){
          $commonID     = $_POST['commID'];
           
          }
          else{
              $sql_del =  "DELETE FROM `spalocation` WHERE `spaId` = '$spa_ID' ";
              $this->db->query($sql_del);
          }
          $arr = (array)$_SESSION['AccUser'];
          if(isset($arr))
          $createdby = $arr['User']->UserId;
          $sql_sel = "SELECT * FROM  `spalocation` WHERE `spaId` = '$spa_ID' AND `LocationID` = '$commonID' ";
          $arr_list = $this->db->query($sql_sel)->result();
          $list = (array) $arr_list;
          if(count($list) > 0){
              try{
                  $sql = "UPDATE `spalocation` SET `LocationID` = '$commonID'  WHERE `spaId` = '$spa_ID'";//update
                  $this->db->query($sql);
                  return 1;
              }
              catch(exception $e){
                  return 0;
              }
          }
          else{
               try{
                   $sql = "INSERT INTO `spalocation`(`spaID`,`LocationID`,`Status`,`CreatedDate`) VALUES('$spa_ID','$commonID','',NOW())" ; // insert into
                    $this->db->query($sql);
                    return 1;
               }
               catch(exception $e){
                   return 0;
               }
          }
      }
      public function updatespatype(){
          $spa_ID       = $_POST['spaID'];
          $commonID     = $_POST['commID'];

          if($commonID == "")
          {
              $sql_del =  "DELETE FROM `spainfo` WHERE `spaId` = '$spa_ID' AND `commonTypeId` = 'SpaType'";
              $this->db->query($sql_del);
              return 1;
          }
          else{
              $arr = (array)$_SESSION['AccUser'];
              if(isset($arr))
              $createdby = $arr['User']->UserId;
              $sql_sel = "SELECT * FROM  `spainfo` WHERE `spaId` = '$spa_ID' AND `commonTypeId` ='SpaType'";
              $arr_list = $this->db->query($sql_sel)->result();
              $list = (array) $arr_list;
              if(count($list) > 0){
                  try{
                      $sql = "UPDATE `spainfo` SET `commonId` = '$commonID'  WHERE `spaId` = '$spa_ID' AND `commonTypeId` ='SpaType' ";//update
                      $this->db->query($sql);
                      return 1;
                  }
                  catch(exception $e){
                      return 0;
                  }
              }
              else{
                   try{
                       $sql = "INSERT INTO `spainfo`(`spaId`,`commonTypeId`,`commonId`,`createdBy`,`createdDate`)VALUES('$spa_ID','SpaType','$commonID','$createdby',NOW())" ; // insert into
                        $this->db->query($sql);
                        return 1;
                   }
                   catch(exception $e){
                       return 0;
                   }
              }
          }
          
      }
      public function updatespafaclity(){
           $spa_ID = $_POST['spaID'];
           $list_commonID = json_decode($_POST['commID']);
           $sql_rel = "";
           $arr = (array)$_SESSION['AccUser'];
            if(isset($arr))
            $createdby = $arr['User']->UserId;
            $sql_del =  "DELETE FROM `spainfo` WHERE `spaId` = '$spa_ID' AND `commonTypeId` = 'SpaFacility'";
            $sql ="";
            try{
                $this->db->query($sql_del);
                for($i=0; $i<count($list_commonID);$i++)
                {
                    $sql = "INSERT INTO `spainfo`(`spaId`,`commonTypeId`,`commonId`,`createdBy`,`createdDate`)VALUES('$spa_ID','SpaFacility','$list_commonID[$i]','$createdby',NOW())" ; // update
                    $this->db->query($sql);
                }
               return 1;
               
            }
            catch(exception $e){
                return 0;
            }
      }
      public function getspainfo()
      {
          $list = json_decode($_POST['ListSpaID']); 
          //foreach($list as $spaid)
          $arr_ret = array();
          for($i=0; $i<count($list);$i++)
          {
              $spaid = $list[$i];
              $sql = "SELECT a.* ,b.`StrValue1` FROM `spainfo` a 
                      LEFT JOIN `commoncode` b ON a.`commonId` = b.`CommonId` AND a.`commonTypeId`= b.`CommonTypeId` 
                      WHERE a.`commonTypeId`='SpaFacility' AND a.`spaId`='$spaid'";
              $list_Fac = $this->db->query($sql)->result();
              $arr1 = (array)$list_Fac;
              
              $str="";
              $str_spafac  = "";
              if( count($arr1)>0)            
              {
                  for($j=0; $j < count($arr1);$j++)
                  {
                      $str = $str. "<div commonid=\"".$arr1[$j]->commonId."\" class=\"doituongDIV  divSpaFacility".$spaid.$arr1[$j]->commonId."\">";
                      $str = $str. $arr1[$j]->StrValue1;
                      $str = $str. "</div>";
                     
                      
                  }
              }
              
              $sql1 = "SELECT a.* ,b.`StrValue1` 
                        FROM `spainfo` a 
                        LEFT JOIN `commoncode` b ON a.`commonId` = b.`CommonId` AND a.`commonTypeId`= b.`CommonTypeId` 
                        WHERE a.`commonTypeId`='SpaType' AND a.`spaId`='$spaid'";
                        
              $list_SpaType = $this->db->query($sql1)->result();
              $arr2 = (array)$list_SpaType;    
              $str_spatype = "";                      
              $str1="";
              if( count($arr2)>0)            
              {
                  $str1        = $str1. "<div commonid=\"".$arr2[0]->commonId."\" class=\"doituongDIV divSpaType".$spaid.$arr2[0]->commonId."\">";
                  $str1        = $str1. $arr2[0]->StrValue1;
                  $str1        = $str1. "</div>";
                 
              }
              
              // spa location
              $sql_location = "SELECT a.* ,b.`StrValue1` 
                                FROM `spalocation` a 
                                LEFT JOIN `commoncode` b ON a.`LocationID` = b.`CommonId` 
                                WHERE b.`commonTypeId`='LOCATION' AND a.`spaId`='$spaid' ";
              
              $list_SpaLocation = $this->db->query($sql_location)->result();
              $arr_location = (array) $list_SpaLocation;                          
              $str2="";
              if( count($arr_location)>0)            
              {
                  $str2        = $str2. "<div commonid=\"".$arr_location[0]->LocationID."\" class=\"doituongDIV divSpaLocation".$spaid.$arr_location[0]->LocationID."\">";
                  $str2        = $str2. $arr_location[0]->StrValue1;
                  $str2        = $str2. "</div>";
                 
              }
               
              $row = array("SpaID"=>$spaid,"ListFacStr"=>$str,"SpaTypeStr"=>$str1,"SpaLocation"=>$str2);           
              array_push($arr_ret,$row);
          }
          return $arr_ret;
      }
      
       public function get_Spa_Facility(){
             $str = "<option value=\"\">Không chọn...</option>";
             $sql = "SELECT * FROM `commoncode` WHERE `CommonTypeId` = 'SpaFacility'";
             $list = $this->db->query($sql)->result();
             $arr = (array)$list;
             for($i=0 ; $i < count($arr);$i++){
                  $str = $str."<option value=\"".$arr[$i]->CommonId ."\">".$arr[$i]->CommonId."-".$arr[$i]->StrValue1."</option>";
             }
             
             
             return $str;
        }
        
        public function get_Spa_Type(){
             $str = "<option value=\"\">Không chọn...</option>";
             $sql = "SELECT * FROM `commoncode` WHERE `CommonTypeId` = 'SpaType'";
             $list = $this->db->query($sql)->result();
             $arr = (array)$list;
             for($i=0 ; $i < count($arr);$i++){
                  $str = $str."<option value=\"".$arr[$i]->CommonId ."\">".$arr[$i]->CommonId."-".$arr[$i]->StrValue1."</option>";
             } 
             
             return $str;
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
        public function ajax_location(){
            
            $Name    = $_POST['Name'];            
            $page       = $_POST["Page"];
          
            $sql = "SELECT '1' AS STT,`commoncode`.* FROM `commoncode` WHERE `CommonTypeId` = 'LOCATION'";       
            $sql1 = "SELECT COUNT(*) AS Total FROM `commoncode` WHERE `CommonTypeId` = 'LOCATION'";
                    
            $sql = $sql." and 1=1 ";
            $sql1 = $sql1." and 1=1 ";            
          
            if($Name !=''){
                $sql = $sql." and `StrValue1` like '%".$Name."%'";
                $sql1 = $sql1." and `StrValue1` like '%".$Name."%'";
            }
            
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            
            $_arrLocation = $this->AddSTT1($this->db->query($sql)->result(),$page); 
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
                
        $res = array("TotalRecord"=>$TotalRecord,"TotalPage"=>$TotalPage,"CurPage"=>$page,"lst"=>$_arrLocation,"Toto"=>$ResTotalPage);
        return $res;
        }
  }
?>
