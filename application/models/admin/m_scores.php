<?php
class M_scores extends CI_Model{
        public $errorStr; 
        private $db2;
        public function __construct()
        {
            parent::__construct();
            $this->db2 = $this->load->database('thebooking', TRUE);
        }
        
       
       public function getTypeNew(){
           $sql = "SELECT * FROM `commoncode` WHERE `CommonTypeId` = 'NewsCategory'";
           $newtype = $this->db->query($sql)->result();
           return $newtype;
       } 
       
        public function get_news($id){
            $sql = "SELECT * FROM `news` WHERE `id` = '$id'";
            $News = $this->db->query($sql)->result();
            $arr = (array)$News;
            return $arr;
        }
        public function get_news_links($id){
            $sql = "SELECT * FROM `links` WHERE `ObjectIDD`='$id'";
            $News = $this->db->query($sql)->result();
            $arr = (array)$News;
            return $arr;
        }
        
        
        public function get_hinh_news()
        {
            $ID    = $_POST['ProductID']; 
            $sql = "SELECT * FROM `links` WHERE `ObjectIDD`='$ID'"; //lấy cấp 2
            $List = $this->db->query($sql)->result();
            return $List;
        }
        
        public function xoa_news()
        {
            $id    = $_POST['ID']; 
            $res = "0";
            $sql = "DELETE FROM `news` WHERE `id`='$id'";
            $sql1 = "DELETE FROM `links` WHERE `ObjectIDD`='$id'";
                
                try{
                    $this->db->query($sql);
                    $this->db->query($sql1);
                    $res ="1";
                }
                catch(exception $e)
                {
                    $res = "0";    
                }
            
            return $res;
        }
        
        public function restScore()
        {
            $ID      = $_POST['ID']; 
            $score   = $_POST['Score'];
            
            $sql1 = "SELECT * FROM `scorebalance` WHERE `ObjectIDD` = '$ID'";
            $arr = null;
            try{
                // database thứ 2
                $res1 = $this->db2->query($sql1)->result();    
                $arr = (array) $res1;
                if($arr != null && count($arr)>0)
                {
                    $sql = "UPDATE `scorebalance` SET `ScoreBalance` = '$score' WHERE `ObjectIDD` = '$ID'";
                    $this->db2->query($sql);
                    $res = 1;
                }
                
            }
            catch(exception $e)
            {  
                $res = 0;              
            }
            
            return $res;
        }
                
        
       
        public function search_scores(){            
            $ID      = $_POST['ID'];            
            $Name    = $_POST['Name'];
            $newstypeObj    = $_POST['NewTypeObj'];
            $page       = $_POST["Page"];
            if($newstypeObj != ""){
                if($newstypeObj == "SPA"){
                    // kết hợp giữa database thứ 2 với database thứ 1
                     $sql = "SELECT '1' AS STT, b.`spaID` AS ID,b.`spaName` AS  NAME,a.* FROM `spabooking_thebookingdev`.`scorebalance` a INNER JOIN `spa` b ON a.`ObjectIDD` = b.`spaID`";       
                     $sql1 = "SELECT COUNT(*) AS Total FROM `spabooking_thebookingdev`.`scorebalance` a INNER JOIN `spa` b ON a.`ObjectIDD` = b.`spaID`";  
                     $sql = $sql." where 1=1 ";
                     $sql1 = $sql1." where 1=1 ";
                     if($ID != ''){
                         $sql = $sql." and b.`spaID` like '%".$ID."%'";
                         $sql1 = $sql1." and b.`spaID` like '%".$ID."%'";
                     }
                     
                     if($Name != ''){
                         $sql = $sql." and b.`spaName` like '%".$Name."%'";
                         $sql1 = $sql1." and b.`spaName` like '%".$Name."%'";
                     }
                }
                else{
                    
                     $sql = "SELECT '1' AS STT,a.*,b.`UserId` AS ID,c.`FullName` AS NAME  FROM `spabooking_thebookingdev`.`scorebalance` a  INNER JOIN `spabooking_thebookingdev`.`users` b ON a.`ObjectIDD` = b.`UserId` INNER JOIN  `spabooking_thebookingdev`.`objects` c ON b.`ObjectId` = c.`ObjectId`";       
                     $sql1 = "SELECT COUNT(*) AS Total FROM `spabooking_thebookingdev`.`scorebalance` a INNER JOIN `spabooking_thebookingdev`.`users` b ON a.`ObjectIDD` = b.`UserId` INNER JOIN  `spabooking_thebookingdev`.`objects` c ON b.`ObjectId` = c.`ObjectId`";  
                     $sql = $sql." where 1=1 ";
                     $sql1 = $sql1." where 1=1 ";
                     if($ID != ''){
                         $sql = $sql." and c.`ObjectId` like '%".$ID."%'";
                         $sql1 = $sql1." and c.`ObjectId` like '%".$ID."%'";
                     }
                     
                     if($Name != ''){
                         $sql = $sql." and c.`FullName` like '%".$Name."%'";
                         $sql1 = $sql1." and c.`FullName` like '%".$Name."%'";
                     }
                }
                
                $StartPos =1;
                $StartPos = ($page - 1)*10;
                $EndPos =  10;
                
                if($page != '' ){
                    $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
                }
                
                $_arrNews = $this->AddSTT1($this->db->query($sql)->result(),$page);    
                $ResTotalPage = $this->db->query($sql1)->result();
                $TotalRecord = ( $ResTotalPage[0]->Total);
                $TotalPage = 1;
                if($TotalRecord % 10 !=0)
                {
                    $TotalPage = floor($TotalRecord /10) + 1;
                }
                else
                {
                    $TotalPage = floor($TotalRecord /10) ;
                }
                    
            $res = array("TotalRecord"=>$TotalRecord,"TotalPage"=>$TotalPage,"CurPage"=>$page,"lst"=>$_arrNews,"Toto"=>$ResTotalPage);
            return $res;
                
       }
       else{
           $res = 0;
           return $res;
       }
          
}

       public function show_scores(){
           $ID      = $_POST['ID'];
           try{
                $sql = "SELECT  * FROM `scoretrans` WHERE `ObjectIDD` = '$ID'";
                $arr_ScoreTrans = $this->db2->query($sql)->result();
                $res =  array("lst" => $arr_ScoreTrans);
           } 
           catch(exception $e)
            {  
                $res = 0;              
            }
          
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
  }
?>
