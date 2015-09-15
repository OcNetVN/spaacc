<?php
class M_new extends CI_Model{
        public $errorStr; 
        
        public function __construct()
      {
            parent::__construct();
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
        
        public function search_new(){            
            $title    = $_POST['title'];            
            $time    = $_POST['time'];
            $newscont    = $_POST['newscont'];
            $newstype    = $_POST['NewsType'];
            $page       = $_POST["Page"];
          
            $sql = "SELECT '1' AS STT, `news`.*  FROM `news`";       
            $sql1 = "SELECT count(*) as Total FROM `news`  ";
                    
            $sql = $sql." where 1=1 ";
            $sql1 = $sql1." where 1=1 ";            
          
            if($title !=''){
                $sql = $sql." and `Title` like '%".$title."%'";
                $sql1 = $sql1." and `Title` like '%".$title."%'";
            }
            
            if($time !=''){
                $sql = $sql." and `Time` like '%".$time."%'";
                $sql1 = $sql1." and `Time` like '%".$time."%'";
            }
            
            if($newstype !=''){
                $sql = $sql."   and `CategoryID` like '%".$newstype."%'";
                $sql1 = $sql1." and `CategoryID` like '%".$newstype."%'";
            }
            
            if($newscont !=''){
                $sql = $sql." and `NewsBrief` = '".$newscont."'";
                $sql1 = $sql1." and `NewsBrief` = '".$newscont."'";
            }
            
            
            
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            
            $_arrNews = $this->AddSTT1($this->db->query($sql)->result(),$page); 
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
                
        $res = array("TotalRecord"=>$TotalRecord,"TotalPage"=>$TotalPage,"CurPage"=>$page,"lst"=>$_arrNews,"Toto"=>$ResTotalPage);
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
        
       
        
        public function Them_Moi_News()
        {    
            //$date1 = strtotime($_POST['ValidTimeFrom']);
            //$ValidTimeFrom = $date1->format('Y-m-d H:i:s');
            //$ValidTimeFrom = date( 'Y-m-d H:i:s', $date1 );
            $title = $_POST['title'];
            $newtype = $_POST['NewsType'];
            $newBrief = $_POST['NewsBrief'];
            $newDetail = $_POST['NewDetail'];
            $arr = (array)$_SESSION['AccUser'];
            $id_new = "";
            if(isset($arr))
             $createdby = $arr['User']->UserId;
            try
            {
                $sql = "INSERT INTO `news`(`Time`,`CategoryID`,`Title`,`NewsBrief`,`NewsDetail`,`CreatedBy`,`Editor`) VALUES(NOW(),'$newtype','$title','$newBrief','$newDetail','','$createdby')";
                $this->db->query($sql);
                $res = 1;
                $sql_sel = "SELECT MAX(`id`)AS id FROM `news`";
                $id =  $this->db->query($sql_sel)->result();
                $l_id = $id[0]->id;
                
            }
            catch(exception $e)
            {
               $res = 0;
            }
            $arr_new = array('res'=>$res,'id'=>$l_id);
            return $arr_new;
        }
        
          public function Cap_Nhat_News(){
            $id = $_POST['id'];
            $title = $_POST['title'];
            $newtype = $_POST['NewsType'];
            $newBrief = $_POST['NewsBrief'];
            $newDetail = $_POST['NewDetail'];
            $arr = (array)$_SESSION['AccUser'];
            if(isset($arr))
            $createdby = $arr['User']->UserId;
            $sql_sel = "SELECT * FROM `news` WHERE `id` = '$id'";
            $sql = "";
            try
            {
                $res = $this->db->query($sql_sel)->result();
                $arr = (array)$res;
                if(count($arr)>0)
                {
                   $sql = "UPDATE `news` SET `Time` = NOW(),`CategoryID` ='$newtype',`Title` = '$title',`NewsBrief`='$newBrief',`NewsDetail`='$newDetail' WHERE `id` = '$id'";//update
                   
                }
                else{   
                        $sql = "INSERT INTO `news`(`Time`,`CategoryID`,`Title`,`NewsBrief`,`NewsDetail`,`CreatedBy`,`Editor`) VALUES(NOW(),'$title','$newtype','$newBrief','$newDetail','','$createdby')"; // insert
                        
                }
                try{
                    
                        $this->db->query($sql);
                        $res = 1;
                }
                catch(exception $ee)
                {
                    $res = 0;   
                }
            }
            catch(exception $e)
            {
                $res     = 0;
            }
            return $res;
        }
        
        
        
        public function InsertLinks($Id, $url)
        {
            $arr = explode('.',$url);
            $arr1 = explode('/',$url);
            $type ="NEWS";
            $ext= $arr[count($arr)-1];
            $filename = $arr1[count($arr1)-1];

            $arr = (array)$_SESSION['AccUser'];
            if(isset($arr))
             $creadedby = $arr['User']->UserId;
            
            $sql ="INSERT INTO `links` (`ObjectIDD`,`URL`,`Type`,`FileExtension`,`FileName`,`Status`,`UploadedBy`,`UploadedDate`) VALUES ('$Id','$url','$type','$ext','$filename','99','$creadedby',NOW())";
            
            try{
                $this->db->query($sql);
            }
            catch(Exception $e)
            {
                
            }
        }
       
  }
?>
