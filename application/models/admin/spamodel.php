<?php

class SpaObject{
   public   $spaID;
   public   $spaName ;
   public   $Address;
   public   $Tel;
   public   $Email;
   public   $Note;
   public   $CreatedBy;
   public   $CreatedDate;
   public   $ModifiedBy;
   public   $ModifiedDate;
   public   $Intro;
   public   $MoreInfo;
   public   $Location;
}
  class Spamodel extends CI_Model{
      public function __construct()
      {
            parent::__construct();
      }
      
      public function get_spa_news($id){
            $sql = "SELECT * FROM `spa` WHERE `spaID` ='$id'";
            $Spa = $this->db->query($sql)->result();
            $arr = (array)$Spa;
            return $arr;
        }
        public function get_spa_links($id){
            $sql = "SELECT * FROM `links` WHERE `ObjectIDD`='$id'";
            $Spa = $this->db->query($sql)->result();
            $arr = (array)$Spa;
            return $arr;
        }
        
        public function get_spa_times($id){
          
            $sql = "SELECT * FROM `spatime` WHERE `spaID`='$id' ";
            $Spa = $this->db->query($sql)->result();
            $arr = (array)$Spa;
            return $arr;
        }
        public function get_spa_product($id){
            $sql = "SELECT `spaproductype`.*,`StrValue1` FROM `spaproductype` INNER JOIN  `commoncode`  ON `spaproductype`.`ProductType` = `commoncode`.`CommonId` WHERE `spaID`='$id' ";
            $Spa = $this->db->query($sql)->result();
            $arr = (array)$Spa;
            return $arr;
        }
       
       

      public function get_spa(){
        $sql="SELECT *  FROM spa ";
        $results = $this->db->query($sql);
        return $results->row();
      }
        public function max_spaid($int)
        {
            $sql="SELECT max(spaID) as max FROM spa WHERE spaID like '".$int."%'";
            $results = $this->db->query($sql);
            return $results->row();
        }
       
        
        public function Them_Spaproduct(){
                $spaID    = $_POST['spaID'];
                $Productype    = $_POST["Productype"];
                $arr = (array)$_SESSION['AccUser'];
                if(isset($arr))
                $createdby = $arr['User']->UserId;
                try{
                        if(isset($Productype)){
                        $Category_Array = array();
                        $Category_Array = explode(';',$Productype);
                        $sql ="";                   
                        for($i =0; $i<= count($Category_Array)-1; $i++){
                             $maCate =str_replace("[","",$Category_Array[$i]);
                             $maCate =str_replace("]","",$maCate);
                             if($maCate != 0){ 
                                 $data = array(
                                           'spaID' => $spaID ,
                                           'ProductType' => $maCate ,
                                           'Status' => '1',
                                           'CreatedBy' => $createdby,
                                           'CreatedDate' => 'NOW()'
                                           
                                        );

                                    /*$sql = "INSERT INTO `spaproductype`(
                                                    `spaID`,
                                                    `ProductType`,
                                                    `Status`,
                                                    `CreatedBy`,
                                                    `CreatedDate`
                                        )
                                         VALUES('".$spaID."','".$maCate."',
                                                '1','admin','NOW()' );"; 
                                                */
                                                $this->db->insert('spaproductype',$data);        
                                    }                        
                             }
                               
                          }
                }catch(exception $e){
                     $spaID = '';
                }
                
                return $spaID;
                
        }
        
        public function Upadte_Product(){
            $spa_ID = $_POST['spaID'];
            $Productype    = $_POST["Productype"];
            $sql_rel = "";
            $arr = (array)$_SESSION['AccUser'];
            if(isset($arr))
            $createdby = $arr['User']->UserId;
            $sql_del =  "DELETE FROM `spaproductype` WHERE `spaID` = '$spa_ID'";
            $sql ="";
            try{
                $this->db->query($sql_del);
                    if(isset($Productype)){
                       $Category_Array = array();
                        $Category_Array = explode(';',$Productype);
                        $sql =""; 
                        for($i =0; $i<= count($Category_Array)-1; $i++){
                             $maCate = $Category_Array[$i];
                             if($maCate !=0){
                                 $sql = "INSERT INTO `spaproductype`(`spaID`,`ProductType`,`Status`,`CreatedBy`,`CreatedDate`) VALUES('$spa_ID','$maCate','1','$createdby',NOW())" ; // update
                                 $this->db->query($sql);
                             }                   
                        }  
                    }                
                
               
                try{
                       
                       return 1;
                   }
                   catch(exception $ee)
                   {
                       return 0;
                   }
            }
            catch(exception $e){
                return 0;
            }
                
        }  
           
        
        public function InsertLinks($Id, $url)
        {
            $arr = explode('.',$url);
            $arr1 = explode('/',$url);
            $type ="SPA";
            $ext= $arr[count($arr)-1];
            $filename = $arr1[count($arr1)-1];
            $arr = (array)$_SESSION['AccUser'];
            if(isset($arr))
            $createdby = $arr['User']->UserId;
            
            $sql ="INSERT INTO `links` (`ObjectIDD`,`URL`,`Type`,`FileExtension`,`FileName`,`Status`,`UploadedBy`,`UploadedDate`) VALUES ('$Id','$url','$type','$ext','$filename','1','$createdby',NOW())";
            
            try{
                $this->db->query($sql);
            }
            catch(Exception $e)
            {
                
            }
        }
        
        public function Them_SpaImage(){
                $spaID         = $_POST['spaID'];
                $url    = $_POST["url"];
                $type = "SPA";
                $arr = (array)$_SESSION['AccUser'];
                if(isset($arr))
                 $createdby = $arr['User']->UserId;
                try{
                        if(isset($url)){
                        $Category_Array = array();
                        $Category_Array = explode(';',$url);
                        $ext = explode('.',$url);
                        var_dump($Category_Array);           
                        for($i =0; $i<= count($Category_Array)-1; $i++){
                             //$maCate =str_replace("[","",$Category_Array[$i]);
                             $maCate = $Category_Array[$i];
                            // var_dump($maCate);
//                             die();
                             //$maCate =str_replace("]","",$maCate);
                             if($maCate != ""){ 
                                 $data = array(
                                           'ObjectIDD' => $spaID ,
                                           'URL' =>  $maCate,
                                           'Type' => $type,
                                           'Status' => '1',
                                           'UploadedBy' => $createdby,
                                           'UploadedDate' => 'NOW()'
                                           
                                        );

                                    /*$sql = "INSERT INTO `spaproductype`(
                                                    `spaID`,
                                                    `ProductType`,
                                                    `Status`,
                                                    `CreatedBy`,
                                                    `CreatedDate`
                                        )
                                         VALUES('".$spaID."','".$maCate."',
                                                '1','admin','NOW()' );"; 
                                                */
                                                $this->db->insert('links',$data);        
                                    }                        
                            }
                             
                              
                          }
                }catch(exception $e){
                     $spaID = '';
                }
                
                return $spaID;
        }
        
        public function Update_Spa()
        {
            $spaID      = $_POST['spaID'];
            $spaName    = $_POST['spaName'];
            $address    = $_POST["Address"];
            $tel        = $_POST["Tel"];
            $email      = $_POST["Email"];
            $notes      = $_POST["Note"];
            $Intro      = $_POST["Intro"];
            $MoreInfo   = $_POST["MoreInfo"];
            $postion   = $_POST["Postion"];
            $status    = $_POST["Status"];
            $EmailSend  = $_POST["EmailSend"];
            $TelSend    = $_POST["TelSend"];
            $location   = $_POST["Location"]."|".$postion;
            $website    = $_POST["Website"];
            $arr = (array)$_SESSION['AccUser'];
            if(isset($arr))
            $createdby = $arr['User']->UserId;
            
            $sql_sel =  "SELECT * FROM `spa` WHERE `spaID` ='$spaID'";
            $sql ="";
            try{
                $res = $this->db->query($sql_sel)->result();
                $arr = (array)$res;
                if(count($arr)>0)                
                {
                   $sql = "UPDATE `spa` SET `spaName` = '$spaName',`Address`= '$address',`Tel1` ='$tel',`Email1` = '$email',`Note` = '$notes',`ModifiedBy` ='$createdby',`ModifiedDate` = NOW(),`Intro` = '$Intro',`MoreInfo` = '$MoreInfo',`Location` = '$location',`Status` = '$status',`Tel`= '$TelSend',`Email`='$EmailSend',`Website` = '$website' WHERE  `spaID` = '$spaID'" ; // update
                   
                }
                else
                {
                   
                    $sql = "INSERT INTO `spa`(`spaID`,`spaName`,`Address`,`Tel1`,`Email1`,`Note`,`CreatedBy`,`CreatedDate`,`Intro`,`MoreInfo`,`Location`,`Email`,`Tel`,`Status`,`Website`) VALUES ('$spaID','$spaName','$address,'$tel','$email','$notes','$createdby',NOW(),'$Intro','$MoreInfo','$location','$EmailSend','$TelSend','$status','$website');" ; // insert
                }
                
                try{
                       $this->db->query($sql);
                       return 1;
                   }
                   catch(exceptin $ee)
                   {
                       return 0;
                   }
                
            }
            catch(exception $e)
            {
                return 0;
            }
        }
        
        
        public function Them_Spa()
        {
            $spaID ="";        
           
            $spaName    = $_POST['spaName'];
            $address    = $_POST["Address"];
            $tel        = $_POST["Tel"];
            $email      = $_POST["Email"];
            $notes      = $_POST["Note"];
            $Intro      = $_POST["Intro"];
            $MoreInfo   = $_POST["MoreInfo"];
            $postion   = $_POST["Postion"];
            $status    = $_POST["Status"];
            $emailSend = $_POST["EmailSend"];
            $telSend   = $_POST["TelSend"];
            $location   = $_POST["Location"]."|".$postion;
            $website    = $_POST["Website"];
            $arr = (array)$_SESSION['AccUser'];
            if(isset($arr))
             $createdby = $arr['User']->UserId;          
            try{              
                $spaID =    $this->getSpaID();                 
                $sql ="INSERT INTO `spa`(
                                        `spaID`,
                                        `spaName`,
                                        `Address`,
                                        `Tel1`,
                                        `Email1`,
                                        `Note`,
                                        `CreatedBy`,
                                        `CreatedDate`,
                                        `Intro`,
                                        `MoreInfo`,
                                        `Location`,
                                        `Status`,
                                        `Tel`,
                                        `Email`,
                                        `Website`

                            )
                     VALUES('".$spaID."','".$spaName."','".$address."',
                            '".$tel."','".$email."','".$notes."',
                            '".$createdby."',NOW(),'".$Intro."',
                            '".$MoreInfo."','".$location."',
                            '".$status."','".$telSend."',
                            '".$emailSend."',
                            '".$website."'
                            );";
                $res = $this->db->query($sql);     
                 
            }
            catch(exception $e)
            {
                 $spaID ="";  
            }
            return $spaID;
        }
        
        public function Capnhat_Time_Spa()
        {
            $spaID = $_POST['SpaID'];
      
            $ft2 =   $_POST['ft2'];
            $ft3 =   $_POST['ft3'];
            $ft4 =   $_POST['ft4'];
            $ft5 =   $_POST['ft5'];
            $ft6 =   $_POST['ft6'];
            $ft7 =   $_POST['ft7'];
            $ftcn =   $_POST['ftcn'];
            $ftle =   $_POST['ftle'];
            
            $tt2 =   $_POST['tt2'];
            $tt3 =   $_POST['tt3'];
            $tt4 =   $_POST['tt4'];
            $tt5 =   $_POST['tt5'];
            $tt6 =   $_POST['tt6'];
            $tt7 =   $_POST['tt7'];
            $ttcn =   $_POST['ttcn'];
            $ttle =   $_POST['ttle'];
            
            $t2 = array("ft"=>$ft2,"tt"=>$tt2 );
            $t3 = array("ft"=>$ft3,"tt"=>$tt3 );
            $t4 = array("ft"=>$ft4,"tt"=>$tt4 );
            $t5 = array("ft"=>$ft5,"tt"=>$tt5 );
            $t6 = array("ft"=>$ft6,"tt"=>$tt6 );
            $t7 = array("ft"=>$ft7,"tt"=>$tt7 );
            $tcn= array("ft"=>$ftcn,"tt"=>$ttcn );
            $tle= array("ft"=>$ftle,"tt"=>$ttle );
            
            $arr = array($t2,$t3,$t4,$t5,$t6,$t7,$tcn,$tle);
            
            for($i=0; $i<count($arr);$i++)
            {
                //capnhatPROtime($ft, $tt, $day, $proid);
                $this->capnhatSpatime($arr[$i]['ft'],$arr[$i]['tt'],$i,$spaID);
            }    
            return "1";        
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
        
        public function capnhatSpatime($ft, $tt, $day, $proid)
        {
            $i= 0;
            switch($day)
            {
                case 0: // thứ 2
                {
                    $i =2;
                    break;
                }
                case 1: // thứ 3
                {
                    $i =3;
                    break;
                }
                case 2: // thứ 4
                {
                    $i =4;
                    break;
                }
                case 3: // thứ 5
                {
                    $i =5;
                    break;
                }
                case 4: // thứ 6
                {
                    $i =6;
                    break;
                }
                case 5: // thứ 7
                {
                    $i =7;
                    break;
                }
                case 6: // Chu nhat
                {
                    $i =8;
                    break;
                }
                case 7: // Ngay LE
                {
                    $i =9;
                    break;
                }
            }
            
            $sql_sel = "SELECT * FROM `spatime` WHERE `spaID`='$proid' AND `DayOfWeek` = '$i'; ";
            $sql ="";
            try{
                $res = $this->db->query($sql_sel)->result();
                $arr = (array)$res;
                if(count($arr)>0)                
                {
                   $sql = "UPDATE `spatime` SET  `AvailableHourFrom`=$ft,`AvailableHourTo`='$tt' WHERE `spaID`='$proid' AND `DayOfWeek` = '$i';" ; // update
                   
                }
                else
                {
                    $sql = "INSERT INTO `spatime` (`spaID`,`DayOfWeek`,`AvailableHourFrom`,`AvailableHourTo`) VALUES ('$proid','$i',$ft,$tt);" ; // insert
                }
                
                try{
                       $this->db->query($sql);
                   }
                   catch(exceptin $ee)
                   {
                       
                   }
                
            }
            catch(exception $e)
            {
                
            }
            
        }
        
        
        public function getSpaID()
        {
            // [01][yyyyMMDD][000001]            
            ///- [01] : Mã mac dinh cua SPA
            ///- [YYYYMMDD] : Ngày tháng năm tạo 
            ///- [000001]: số chạy
            
            $id =  (string)"01".date("Y").date("m").date("d");
            $sql="SELECT `spaID` FROM `spa` WHERE LEFT(`spaID`,10) = '".$id."' order by `spaID`";
            
            $arr = $this->db->query($sql)->result();
            $lst = (array)$arr;
            $stt=1;
            if(count($lst)>0)
            {
                $i=0;
                for($i =0; $i<count($lst);$i++)
                {
                    $id_daco = $lst[$i]->spaID;
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
        // end sản phẩm
        public function edit_spa($id){
            $query = $this->db->get_where('spa',array('spaID' => $id));
            
            return $query->result();
        }
        
     
        public function delete_spa($id){
            
            $this->db->delete('spa',array('spaID' => $id));
            
        }
        
        public function deleSpa(){
                $spaID  = $_POST['spaID'];
                $res = 0;
                try{
                    $check_pro = "SELECT * FROM `products` WHERE `SpaID` = '$spaID' AND `Status`='1'";
                    $total_pro = $this->db->query($check_pro)->result();
                    if(count($total_pro) > 0){
                         $res = 0;
                    }
                    else{
                         $this->db->delete('spa',array('spaID' => $spaID));
                         $this->db->delete('spatime',array('spaID' => $spaID));
                         $this->db->delete('spaproductype', array('spaID' => $spaID));
                         $this->db->delete('links',array('ObjectIDD' => $spaID));
                          $res = 1;
                    }
                    
                }
                catch(Exception $e){
                    $res = 0;
                }
                
                return  $res;
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
        
        public function ajax_list(){
            $spaID      = $_POST['spaID']; 
            $spaName    = $_POST['spaName'];
            $address    = $_POST["address"];
            $tel        = $_POST["Tel"];
            $email      = $_POST["email"];
            $notes      = $_POST["Notes"];
            $Intro      = $_POST["desci"];
            $MoreInfo   = $_POST["MoreInfo"];
            //$location   = $_POST["Loaction"];
            $page       = $_POST["Page"];
            
            $sql = "SELECT '1' AS STT,spa.*,CONCAT(LEFT(`Note`,100),'...') AS Note1,CONCAT(LEFT(`Intro`,100),'...') AS Intro1,CONCAT(LEFT(`MoreInfo`,100),'...') AS MoreInfo1 FROM spa";       
            $sql1 = "SELECT count(*) as Total FROM spa  ";
                    
            $sql = $sql." where 1=1 ";
            $sql1 = $sql1." where 1=1 ";
            
            if($spaID !=''){
                $sql = $sql." and spaID like '%".$spaID."%'";
                $sql1 = $sql1." and spaID like '%".$spaID."%'"; 
            }
            if($spaName !=''){
                $sql = $sql." and spaName like '%".$spaName."%'";
                $sql1 = $sql1." and spaName like '%".$spaName."%'";
            }
            if($address !=''){
                $sql = $sql." and Address like '%".$address ."%'";
                $sql1 = $sql1." and Address like '%".$address ."%'";
            }
            if($tel != -1 ){
                $sql = $sql." and Tel like '%".$tel ."%'";
                $sql1 = $sql1." and Tel like '%".$tel ."%'";
            }
            
            if($email!= '' ){
                $sql = $sql." and Email like  '%".$email ."%'";
                $sql1 = $sql1." and Email like  '%".$email ."%'";
            }
            if($notes!= '' ){
                $sql = $sql." and Note like '%".$notes ."%'";
                $sql1 = $sql1." and Note like '%".$notes ."%'";
            }
            if($Intro!= '' ){
                $sql = $sql." and Intro like '%".$Intro ."%'";
                $sql1 = $sql1." and Intro like '%".$Intro ."%'";
            }
            if($MoreInfo!= '' ){
                $sql = $sql." and MoreInfo like '%".$MoreInfo ."%'";
                $sql1 = $sql1." and MoreInfo like '%".$MoreInfo ."%'";
            }        
            $sql = $sql." ORDER BY spaID DESC ";
            
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
                
         $res = array("TotalRecord"=>$TotalRecord,"TotalPage"=>$TotalPage,"CurPage"=>$page,
                        "lst"=>$_arrSpa,"Toto"=>$ResTotalPage);     
            return $res;
        }
        
      
  }
?>
