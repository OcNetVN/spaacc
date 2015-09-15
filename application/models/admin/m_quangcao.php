<?php
class M_quangcao extends CI_Model{
        public $errorStr; 
        
        public function __construct()
        {
            parent::__construct();
        }

       public function uploadfile(){
           
            $info = $_POST['info'];
            $lang = $_POST['lang'];
            
            $files = $_FILES['myfile'];
            $fileName = $_FILES['myfile']['name'];
            $fileType = $_FILES['myfile']['type'];
            $fileError = $_FILES['myfile']['error'];
 
            $res = 0;
            $sql1 = "SELECT * FROM `commoncode` WHERE `CommonTypeId` = 'Advertising' AND `CommonId` = '$info'"; 
            $array1 = $this->db->query($sql1)->result();
            $arr_Info =  (array)$array1;
            
            $sql2 = "SELECT * FROM `commoncode` WHERE `CommonTypeId` = 'Language' AND `CommonId` = '$lang'"; 
            $array2 = $this->db->query($sql2)->result();
            $arr_lang =  (array)$array2;
          
            if (!file_exists('resources/front/images/Ads/')) {
                mkdir('resources/front/images/Ads/', 0777, true);
            }   
            try{
              
              move_uploaded_file($_FILES['myfile']['tmp_name'],'resources/front/images/Ads/'.$arr_Info[0]->StrValue2);
              $res =1;
              $filenameup= $_FILES['myfile']['tmp_name'];
              $filesave = 'resources/front/images/Ads/'.$arr_Info[0]->StrValue2;
              }             
              catch(exception $e){
                 $res = $e;  
              }          
              $arr = array("res"=>$res,"FileUp"=>$filenameup,"FileSave"=>$filesave); 
              return $arr;               
            }  
     
     public function UploadHtml($info, $fileName){
           try{
              $sql_sel = "SELECT * FROM `commoncode` WHERE `CommonTypeId` = 'Advertising' AND `CommonId` = '$info'"; 
              $array = $this->db->query($sql_sel)->result();
              $arr =  (array)$array;
              
              if(count($arr)>0)
                {
                   $sql = "UPDATE `commoncode` SET `StrValue2` = '$fileName' WHERE `CommonTypeId` = 'Advertising' AND `CommonId` = '$info'";//update
                   
                }
                else{   
                        $sql = "INSERT INTO `commoncode`(`CommonTypeId`,`CommonId`,`StrValue2`) VALUES('Advertising','$info','$fileName')"; // insert
                        
                }
                try{
                    
                        $this->db->query($sql);
                        $res = 1;
                }
                catch(exception $e)
                {
                    $res = 0;   
                }
              }             
              catch(exception $e){
                 $res = 0;  
              }
            
               return $res;
       }
       
  }
?>
