<?php
class M_register extends CI_Model{
    public $errorStr; 
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('thebooking', TRUE);
    }
    
    
    public function signupfb()
    {
        
        
    }
    
    public function get_provincel(){
            $str="<optgroup label=\"Không chọn\"><option value=\"\">Không chọn...</option></optgroup>";
            $sql = "SELECT * FROM `commoncode` WHERE `CommonTypeId`='LOCATION' AND LENGTH(`CommonId`)=3 "; //lấy cấp 1
            $ListCap1 = $this->db->query($sql)->result();
            $arr1= (array)$ListCap1;
            for($i=0; $i<count($arr1);$i++)
            {
                $str = $str."<optgroup label=\"".$arr1[$i]->CommonId." - ".$arr1[$i]->StrValue1."\">";
                $cap1=$arr1[$i]->CommonId;
                $sql1 = "SELECT * FROM `commoncode` WHERE `CommonTypeId`='LOCATION'  AND LENGTH(`CommonId`)=5 AND LEFT(`CommonId`,3)='$cap1'";
                $ListCap2 = $this->db->query($sql1)->result();
                $arr2= (array)$ListCap2;
                for($j=0; $j<count($arr2);$j++)
                {
                    $str = $str."<option value=\"".$arr2[$j]->CommonId ."\">".$arr2[$j]->CommonId." - ".$arr2[$j]->StrValue1."</option>";
                }  
                $str = $str."</optgroup>"; 
            }
            return $str;
    }
    //public function get_provincel(){
//        $sql  = "SELECT * FROM `commoncode` WHERE `CommonTypeId`='LOCATION' AND LENGTH(`CommonId`)= 3";
//        $list = $this->db->query($sql)->result();
//        $arr = (array) $list;
//        $str = "<option value=\"\">Không chọn...</option>";
//        if(count($arr) > 0){
//            for($i = 0;$i < count($arr) ; $i++){
//                $str = $str."<option value=\"".$arr[$i]->CommonId."\">".$arr[$i]->StrValue1."</option>";
//            }
//            
//            return $str;
//        }
//    }
    
     public function getObjectID()
     {
            // [11][yyyyMMDD][000001]            
            ///- [11] : Mã mac dinh cua Objects
            ///- [YYYYMMDD] : Ngày tháng năm tạo 
            ///- [000001]: số chạy
            
            $id =  (string)"11".date("Y").date("m").date("d");
            $sql="SELECT `ObjectId` FROM `objects` WHERE LEFT(`ObjectId`,10) = '".$id."' ORDER BY `ObjectId` ";
            
            $arr = $this->db2->query($sql)->result();
            $lst = (array)$arr;
            $stt=1;
            if(count($lst)>0)
            {
                $i=0;
                for($i =0; $i<count($lst);$i++)
                {
                    $id_daco = $lst[$i]->ObjectId;
                    $stt = intval (substr($id_daco,10,strlen($id_daco)));
                    if ($stt != $i + 1)
                    {
                        $stt = $i + 1;
                        break;
                    }
                    if ($i == count($lst)-1)
                    {
                        $stt = count($lst) + 1;
                    }
                }
                
            }
            else
            {
                $stt=1;
            }
            $s_stt ="";
            if ($stt < 10)
                $s_stt = "00000" . strval($stt);
            else if (($stt < 100) && ($stt >= 10))
                $s_stt = "0000" . strval($stt);
            else if (($stt < 1000) && ($stt >= 100))
                $s_stt = "000" . strval($stt);
            else if (($stt < 10000) && ($stt >= 1000))
                $s_stt = "00" . strval($stt);
            else if (($stt < 100000) && ($stt >= 10000))
                $s_stt = "0" . strval($stt);
            else
                $s_stt = strval($stt);
            
            $id= $id. $s_stt;
            return $id;
     }
     
     public function check_email_fbg($email){
         $sql = "SELECT `UserId` FROM `users` WHERE `UserId` = '$email' ";
         $arr = $this->db2->query($sql)->result();
         $lst = (array)$arr;
         $str = "";
         if(count($lst) > 0){
             $str = "Email này đã tồn tại";
         }
        
         return $str;
     }
     public function checkemail(){
         $email = $_POST['email'];
         //$sql = "SELECT a.`Email`,b.`UserType`  FROM `objects` a INNER JOIN `users` b ON a.`ObjectId` = b.`ObjectId` WHERE b.`UserId` = '$email'";
         $sql = "SELECT `UserId` FROM `users` WHERE `UserId` = '$email' ";
         $arr = $this->db2->query($sql)->result();
         $lst = (array)$arr;
         $str = "";
         if(count($lst) > 0){
             //if($lst[0]->UserType == null || $lst[0]->UserType == '')
//             {
                $str = "Email này đã tồn tại"; 
             //}
             
         }
        
         return $str;
     }
    
       public function signup(){
            $email             = $_POST['email'];
            $password          = md5($_POST['password']);
            $fullname          = $_POST['fullname'];
            $preAdd            = $_POST['perAdd'];
            $TemAdd            = $_POST['TemAdd'];
            $province          = $_POST['provinceId'];
            $Tel               = $_POST['Tel'];
            $Dob               = $_POST['DoB'];
            $cmnd              = $_POST['cmnd'];
            $pidissue          = $_POST['pidissue'];
            $pidi              = $_POST['pidi'];
            $fax               = $_POST['fax'];
            $website           = $_POST['website'];
            $note              = $_POST['note'];
            $genter            = $_POST['genter'];
            //$files = $_FILES['image'];
            //$fileName = $_FILES['image']['name'];
//            $fileType = $_FILES['image']['type'];
//            $fileError = $_FILES['image']['error'];
//            
//             if (!file_exists('resources/img/'.$fileName.'/')) {
//                mkdir('resources/img/'.$fileName.'/', 0777, true);
//            }   
//            try{
//              
//                move_uploaded_file($_FILES['image']['tmp_name'], 'resources/img/'.$fileName .'/');
//              
//              }             
//              catch(exception $e){
//                 $res = $e;  
//              }        
            //$arr = (array)$_SESSION['AccUser'];
//            if(isset($arr))
//            $createdby = $arr['User']->UserId;
            $ObjectId = "";
           
                try{
                    $this->db2->trans_start();
                    //get Promotion ID
                    $ObjectId = $this->getObjectID();
                    //insert table objects
                    $sql = "INSERT INTO `objects` (`ObjectId`, `ObjectGroup`, `ObjectType`, `FullName`, `PID`, `PIDState`, `PIDIssue`, `DoB`, `PoB`, `PerAdd`, `TemAdd`, `Gender`,`ProvinceId`, `Tel`, `Fax`, `Email`, `Website`, `TaxCode`, `Note`, `Status`, `CreatedBy`, `CreatedDate`) VALUES ('$ObjectId', '01', '01', '$fullname', '$pidi', '', '$pidissue', '$Dob', '', '$preAdd', '$TemAdd', $genter, '$province', '$Tel', '$fax', '$email', '$website', '', '$note', '0', 'admin',NOW())";
                    $this->db2->query($sql);
                     // insert table user   
                    $sql1 = "INSERT INTO `users` (`UserId`, `Pwd`, `ObjectId`, `Status`, `CreatedBy`, `CreatedDate`, `RoleId`, `ScoreBalance`)VALUES ('$email', '$password', '$ObjectId', '0', 'admin',NOW(), 'member', 0);";
                    $this->db2->query($sql1);
                    // select userID
                    $this->db2->trans_complete();
                    if ($this->db2->trans_status() === FALSE)
                    {
                        $this->db2->trans_rollback();
                    }
                   
                }
                catch(exception $e)
                {
                    $email = "";
                }
               //require 'PHPMailerAutoload.php';
              
                return   $email;
           
            
        }
        
        
        
         public function add_user_object_facebook($email,$fullname,$dob,$gender){
            $ObjectId = "";
                try{
                    $this->db2->trans_start();
                    //get Promotion ID
                    $ObjectId = $this->getObjectID();
                    //insert table objects
                    $sql = "INSERT INTO `objects` (`ObjectId`, `ObjectGroup`, `ObjectType`, `FullName`, `PID`, `PIDState`, `PIDIssue`, `DoB`, `PoB`, `PerAdd`, `TemAdd`, `Gender`, `ProvinceId`, `Tel`, `Fax`, `Email`, `Website`, `TaxCode`, `Note`, `Status`, `CreatedBy`, `CreatedDate`) VALUES ('$ObjectId', '01', '01','$fullname', '', '', '', '$dob', '', '', '', $gender, '', '', '', '$email', '', '', '', '1', 'admin',NOW())";
                    $this->db2->query($sql);
                     // insert table user   
                    $sql1 = "INSERT INTO `users` (`UserId`, `Pwd`, `ObjectId`, `Status`, `CreatedBy`, `CreatedDate`, `RoleId`, `ScoreBalance`)VALUES ('$email', '$password', '$ObjectId', '1', 'admin',NOW(), 'member', 0);";
                    $this->db2->query($sql1);
                    // select userID
                    $this->db2->trans_complete();
                    if ($this->db2->trans_status() === FALSE)
                    {
                        $this->db2->trans_rollback();
                    }
                   
                }
                catch(exception $e)
                {
                    $email = "";
                }
               //require 'PHPMailerAutoload.php';
              
                return   $email;
           
            
        }
        
        public function getUserInfo($UserId)
        {

            $sql = "SELECT * FROM `users` WHERE `UserId` = '$UserId'";
            $_arrUser = $this->db2->query($sql)->result(); 
            return $_arrUser;
            
            
        }
        
        
        public function getObject($oId)
        {
            $sql = "SELECT * FROM `objects` WHERE `ObjectId` = '$oId'"; 
            $_arrObject = $this->db2->query($sql)->result(); 
            return $_arrObject;
            
        }
        
        public function kichhoat($id){
            $sql_sel = "SELECT * FROM `users` WHERE `ObjectId` = '$id' AND `Status` = '1'";
            $arr = $this->db2->query($sql_sel)->result();
            $lst = (array)$arr;
            $str = "";
            if(count($lst) > 0){
                $str  = "Tài khoản của bạn đã được kích hoạt rồi";
            }
            else{
              try{
                  $sql = "UPDATE `users` SET `Status` = '1' WHERE `ObjectId` = '$id'";
                  $this->db2->query($sql);
                  $str  = "Tài khoản đăng nhập của bạn đã được kích hoạt thành công xin vui lòng đăng nhập.<br />Xin vui lòng quay lại trang chủ để sử dụng những dịch vụ spa của chúng tôi";
              }
              catch(exception $e){
                  $str = "";
              }          
                
            }
            
            return $str;
        }
        
        
}
?>
