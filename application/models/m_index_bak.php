<?php
class M_index extends CI_Model{
    public $errorStr; 
    private $db2;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_mail');
        $this->load->model('m_register');
        $this->db2 = $this->load->database('thebooking', TRUE); 
    }
    
    public function GetMenuCap1($roleID,$moduleID) 
    {
          $sql ="SELECT a.*,b.`MenuName`,b.`Description`,b.`url` FROM `rolemenumodule` a INNER JOIN `menu` b ON a.`MenuId`=b.`MenuId`  WHERE a.`RoleId`='$roleID' AND a.`ModuleId`='$moduleID' AND LENGTH(a.`MenuId`)=2";
          $res= $this->db->query($sql)->result();
          $arr = (array)$res;
          return $arr;
              //print_r($arr);
    } 
          
    public function GetMenuCap2($roleID, $Cap1) 
    {
          $sql ="SELECT a.*,b.`MenuName`,b.`Description`,b.`url` FROM `rolemenumodule` a LEFT JOIN `menu` b ON a.`MenuId`=b.`MenuId`  WHERE a.`RoleId`='$roleID' AND LENGTH(a.`MenuId`)=4 AND   LEFT(a.`MenuId`,2)= '$Cap1'";
          $res= $this->db->query($sql)->result();
          $arr = (array)$res;
          return $arr;
          //print_r($arr);
    }
          
   public function GetMenuStrAdmin($RoleId)
    {
        $str="";
        //$arr = (array)$_SESSION['AccUser'];
        
            $arr_menu_cap1 = $this->GetMenuCap1($RoleId,'admin');
           // $str ="";
            for($i=0;$i<count($arr_menu_cap1);$i++)
            {                    
                $str = $str. "<li id=\"MenuCha".$arr_menu_cap1[$i]->MenuId."\">";
                if($arr_menu_cap1[$i]->url == "" || $arr_menu_cap1[$i]->url == null)
                {
                    $str = $str. "<a href=\"#\" class=\"nav-top-item \">";
                }
                else
                {
                    $str = $str. "<a href=\"".base_url($arr_menu_cap1[$i]->url)."\" class=\"nav-top-item \">";
                }
                $str = $str.$arr_menu_cap1[$i]->MenuName ."</a>";
                //Duyet menu cap 2
                $arr_menu_cap2 = $this->GetMenuCap2($RoleId,$arr_menu_cap1[$i]->MenuId);
                if(count($arr_menu_cap2)>0)
                {
                    $str = $str."<ul>";
                    for($j=0;$j<count($arr_menu_cap2);$j++)
                    {
                        $str = $str."<li id=\"menuCon".$arr_menu_cap2[$j]->MenuId."\">";
                        $str = $str. "<a href=\"". base_url($arr_menu_cap2[$j]->url) ."\">";
                        $str = $str. $arr_menu_cap2[$j]->MenuName;
                        $str = $str. "</a>";
                        $str = $str."</li>";
                    }
                    $str = $str."</ul>";
                }
                
                $str = $str. "</li>";
            }
       
        //$mang = array("MenuStr"=>$str);
        //echo json_encode($mang);
        return $str;
    }
    
    public function GetModuleOfRole($roleID)
    {
        $sql="SELECT DISTINCT a.`ModuleId` , b.`Description`, b.`url` FROM `rolemenumodule` a INNER JOIN `module` b ON a.`ModuleId` = b.`ModuleId` WHERE `RoleId` = '$roleID'";
        $cap1 = $this->db->query($sql)->result();
        $arr1 = (array) $cap1;
        return $arr1;
    }
    
    public function listProductType()
    {
        $val = $_POST['name'];
        $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND LENGTH(`CommonId`)=2";
        $cap1 = $this->db->query($sql)->result();
        $arr1 = (array) $cap1;
        $res = array();
        //$n=0;
        if(count($arr1)>0)
        {
            for($i=0; $i<count($arr1); $i++)
            {
                $MaCap1= $arr1[$i]->CommonId;
                $sql1= "SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND LENGTH(`CommonId`)=4 AND LEFT(`CommonId`,2)='$MaCap1' AND (`StrValue2` LIKE '%$val%' OR `StrValue1` LIKE '%$val%')";
                $cap2 = $this->db->query($sql1)->result();
                $arr2 = (array) $cap2;
                for($j=0; $j<count($arr2); $j++)
                {
                   $item = array("label"=>$arr2[$j]->StrValue2,"category"=>$arr1[$i]->StrValue2,"ProductType"=>$arr2[$j]->CommonId,"value"=>$arr2[$j]->StrValue2) ;
                   array_push($res,$item);
                }
            }
        } 
        return $res;   
    }
    
    // kiểm tra product type có trong database khoog 
    public function checkproducttype(){
         $productype = $_POST['Productype'];
         $sql = "SELECT * FROM `commoncode` WHERE `CommonTypeId`= 'ProductType' AND LENGTH(`CommonId`)=4 AND `StrValue2` = '$productype' ";
         $arr = $this->db->query($sql)->result();
         $lst = (array)$arr;
         $str = "";
         if(count($lst) > 0){
             $str = 1;
         }
         else{
             $str = 0;
         }
         
         $list = array('str'=> $str,'sql'=>$arr);
        
         return $list;
    }
    
    public function listLocation()
    {
        $val = $_POST['name'];
        
        $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId`='Location' AND LENGTH(`CommonId`)=3";
        $cap1 = $this->db->query($sql)->result();
        $arr1 = (array) $cap1;
        $res = array();
        //$n=0;
        if(count($arr1)>0)
        {
            for($i=0; $i<count($arr1); $i++)
            {
                $MaCap1= $arr1[$i]->CommonId;
                $SoHuyen = intval($arr1[$i]->NumValue1);
                // show chính xác location co spa ngày 08/01/2015
                //$sql1= "SELECT * FROM `commoncode` WHERE `CommonTypeId`='Location' AND LENGTH(`CommonId`)=5 AND LEFT(`CommonId`,3)='$MaCap1' AND `StrValue1` LIKE '%$val%' LIMIT $SoHuyen";
                $sql1= "SELECT DISTINCT a.*  FROM `commoncode` a INNER JOIN `spalocation` b ON a.`CommonId` = b.`LocationID` WHERE LEFT(a.`CommonId`,3)='$MaCap1' AND a.`StrValue1` LIKE '$val%' LIMIT $SoHuyen";
                $cap2 = $this->db->query($sql1)->result();
                $arr2 = (array) $cap2;
                for($j=0; $j<count($arr2); $j++)
                {
                   $item = array("label"=>$arr2[$j]->StrValue1,"category"=>$arr1[$i]->StrValue1,"LocationId"=>$arr2[$j]->CommonId,"value"=>$arr2[$j]->StrValue1) ;
                   array_push($res,$item);
                }
            }
        } 
        return $res;   
    }
    
    public function GetSetting($key)
   {
       $val= $this->m_mail->GetSetting($key);
       return $val;
   }
   
   public function getMenuStr(){
        $soproducttype=$this->GetSetting('catelogyTotalProductperPage');
        $str="";
        try
        {
            $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND LENGTH(`CommonId`)=2 AND  `NumValue1` = '1'";
            $cap1 =$this->db->query($sql)->result();
            $arr1 = (array) $cap1;
            
            if(count($arr1)>0)
            {
                
                for($i=0; $i<count($arr1); $i++)
                {
                    $str=$str . "<li class=\"dropdown yamm-fw\">";
                    $str=$str . "<a href=\"#\" class=\"dropdown-toggle \"  style=\"font-weight: bold; \" data-toggle=\"dropdown\">" .$arr1[$i]->StrValue1. "</a>";
                    $MaCap1= $arr1[$i]->CommonId;
                    //$sql1="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND LENGTH(`CommonId`)=4 AND LEFT(`CommonId`,2)='$MaCap1' ORDER BY `NumValue2` DESC LIMIT 5";
                    $sql1="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND LENGTH(`CommonId`)=4 AND LEFT(`CommonId`,2)='$MaCap1' AND  `NumValue1` = '1'  ORDER BY `NumValue2` DESC LIMIT 5  ";
                    $cap2 =$this->db->query($sql1)->result();
                    $arr2 = (array) $cap2;
                    
                    $str=$str . "<ul class=\"dropdown-menu\" style=\"background-color: #E7E7E7 !important;\">";
                    $str=$str . "<li>";
                    $str=$str . "<div class=\"yamm-content\">";
                    $str=$str . "<div class=\"row\">";
                    if(count($arr2)>0)
                    {  
                        $j = 1;                      
                        $str=$str . "<div class=\"col-md-4\">";
                        for($j=0; $j<count($arr2); $j++)        
                        {
                             $str=$str . "<ul class=\"nav nav-pills nav-stacked\" id=\"menucon_".$arr2[$j]->CommonId."\">";
                             $str=$str . "<li role=\"presentation\"><a href=\"javascript:void(0);\" commid=\"".$arr2[$j]->CommonId."\" onclick=\"SearchProType('".$arr2[$j]->StrValue2."');\">".$arr2[$j]->StrValue2."</a></li>";
                             $str=$str . "</ul>";
                        }
                        $str = $str."<ul class=\"nav nav-pills nav-stacked\">";
                        $str = $str."<li role=\"presentation\"><a href=\"javascript:void(0);\" commid=\"".$arr1[$i]->CommonId."\" onclick=\"SearchProTypeParent('".$arr1[$i]->CommonId."');\"><i>Xem thêm...</i></a></li>";
                        $str = $str."</ul>";
                        $str=$str . "</div>";       
                    }
                    $sql2 ="SELECT * FROM `products` WHERE LEFT(`ProductType`,2)='$MaCap1' ORDER BY `CreatedDate` DESC LIMIT 2";
                    $pro = $this->db->query($sql2)->result();
                    $arr3 = (array) $pro;    
                    if(count($arr3)> 0)
                    {
                        for($j=0; $j<count($arr3); $j++)   
                        {
                            $masp =$arr3[$j]->ProductID;
                            $str=$str ."<div class=\"col-md-4\">";
                            $str=$str ."<div class=\"box-on-menu \">";
                            $str=$str ."<a data-target=\"#serviceModal\" data-toggle=\"modal\" href=\"javascript:void(0)\" onclick=\"showdetailpro('".$masp."');\" >";
                            //$str=$str .$arr3[$j]->Description;
                            $sql4 ="SELECT * FROM `links` WHERE `ObjectIDD`='$masp' ORDER BY `UploadedDate` DESC LIMIT 1";
                            $links = $this->db->query($sql4)->result();
                            $arr4 = (array)$links;
                            if(count($arr4)>0)
                            {
                                $str=$str ."<div class=\"wrap-thumb\" style=\"background-image:url(". base_url($arr4[0]->URL) .");padding:10px;margin-bottom: 10px;\"></div>";    
                            }
                            else
                            {
                                $str=$str ."<div class=\"wrap-thumb\" style=\"background-image:url(". base_url("resources/front/images/images.jpg") .");padding:10px;margin-bottom: 10px;\"></div>";
                            }
                            $str=$str ."<h4>".$arr3[$j]->Name."</h4>";
                            if(strlen($arr3[$j]->Description) >100)
                            {
                                $descr = substr($arr3[$j]->Description,0,100);
                                //$descr =str_replace("/<[^>]*>/","",$descr);
                                $descr =str_replace("<p>","",$descr);
                                $descr =str_replace("</p>","",$descr);
                                $descr =str_replace("<","",$descr);
                                $descr =str_replace("</","",$descr);
                                $descr =str_replace(">","",$descr);
                                $str=$str .$descr."...";
                            }
                            else
                            {
                                $str=$str .$arr3[$j]->Description;
                            }
                            
                            $str=$str ."";
                            $str=$str ."</a>";
                            $str=$str ."</div>";
                            $str=$str ."</div>";
                        }
                    }
                    
                    $str=$str . "</div>";
                    $str=$str . "</div>";
                    $str=$str . "</li>";
                    $str=$str . "</ul>";
                    $str=$str . "</li>";
                }
            }
            
        }
        catch(exception $e)
        {
            $str = "" ;
        }
        return  $str;
    }
    public function getMenuStr1(){
        $soproducttype=$this->GetSetting('catelogyTotalProductperPage');
        $str="";
        try
        {
            $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND LENGTH(`CommonId`)=2 AND  `NumValue1` = '1'";
            $cap1 =$this->db->query($sql)->result();
            $arr1 = (array) $cap1;
            
            if(count($arr1)>0)
            {
                
                for($i=0; $i<count($arr1); $i++)
                {
                    $str=$str . "<li class=\"dropdown yamm-fw\">";
                    $str=$str . "<a href=\"#\" class=\"dropdown-toggle \"  style=\"font-weight: bold; \" data-toggle=\"dropdown\">" .$arr1[$i]->StrValue1. "</a>";
                    $MaCap1= $arr1[$i]->CommonId;
                    $sql1="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND LENGTH(`CommonId`)=4 AND LEFT(`CommonId`,2)='$MaCap1' ORDER BY `NumValue2` DESC LIMIT 5";
                    //$sql1="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND LENGTH(`CommonId`)=4 AND LEFT(`CommonId`,2)='$MaCap1' AND  `NumValue1` = '1'  ORDER BY `NumValue2` DESC LIMIT 5  ";
                    $cap2 =$this->db->query($sql1)->result();
                    $arr2 = (array) $cap2;
                    
                    $str=$str . "<ul class=\"dropdown-menu\" style=\"background-color: #E7E7E7 !important;\">";
                    $str=$str . "<li>";
                    $str=$str . "<div class=\"yamm-content\">";
                    $str=$str . "<div class=\"row\">";
                    if(count($arr2)>0)
                    {  
                        $j = 1;                      
                        $str=$str . "<div class=\"col-md-4 col-md-41\">";
                        for($j=0; $j<count($arr2); $j++)        
                        {


                             $str=$str . "<ul class=\"nav nav-pills nav-stacked\">";
                             $str=$str . "<li role=\"presentation\"><a href=\"javascript:void(0);\" onclick=\"SearchProType('".$arr2[$j]->CommonId."','');\">".$arr2[$j]->StrValue2."</a></li>";

                            //if($j%$soproducttype == 1)
//                            {
//                                if($j == 1)

                                $str=$str . "<ul class=\"nav nav-pills nav-stacked\" id=\"menucon_".$arr2[$j]->CommonId."\">";
                             
                             $str=$str . "<li role=\"presentation\"><a href=\"javascript:void(0);\" commid=\"".$arr2[$j]->CommonId."\" onclick=\"SearchProType('".$arr2[$j]->StrValue2."');\">".$arr2[$j]->StrValue2."</a></li>";

                             $str=$str . "</ul>";
                        }
                        $str=$str . "</div>";       
                    }
                    $sql2 ="SELECT * FROM `products` WHERE LEFT(`ProductType`,2)='$MaCap1' ORDER BY `CreatedDate` DESC LIMIT 2";
                    $pro = $this->db->query($sql2)->result();
                    $arr3 = (array) $pro;    
                    if(count($arr3)> 0)
                    {
                        for($j=0; $j<count($arr3); $j++)   
                        {
                            $masp =$arr3[$j]->ProductID;
                            $str=$str ."<div class=\"col-md-4 col-md-42\">";
                            $str=$str ."<div class=\"box-on-menu \">";
                            $str=$str ."<a data-target=\"#serviceModal\" data-toggle=\"modal\" href=\"javascript:void(0)\" onclick=\"showdetailpro('".$masp."');\" >";
                            //$str=$str .$arr3[$j]->Description;
                            $sql4 ="SELECT * FROM `links` WHERE `ObjectIDD`='$masp' ORDER BY `UploadedDate` DESC LIMIT 1";
                            $links = $this->db->query($sql4)->result();
                            $arr4 = (array)$links;
                            if(count($arr4)>0)
                            {
                                $str=$str ."<div class=\"wrap-thumb\" style=\"background-image:url(". base_url($arr4[0]->URL) .")\"></div>";    
                            }
                            else
                            {
                                $str=$str ."<div class=\"wrap-thumb\" style=\"background-image:url(". base_url("resources/front/images/images.jpg") .")\"></div>";
                            }
                            $str=$str ."<h4>".$arr3[$j]->Name."</h4>";
                            if(strlen($arr3[$j]->Description) >100)
                            {
                                $descr = substr($arr3[$j]->Description,0,100);
                                //$descr =str_replace("/<[^>]*>/","",$descr);
                                $descr =str_replace("<p>","",$descr);
                                $descr =str_replace("</p>","",$descr);
                                $descr =str_replace("<","",$descr);
                                $descr =str_replace("</","",$descr);
                                $descr =str_replace(">","",$descr);
                                $str=$str .$descr."...";
                            }
                            else
                            {
                                $str=$str .$arr3[$j]->Description;
                            }
                            
                            $str=$str ."";
                            $str=$str ."</a>";
                            $str=$str ."</div>";
                            $str=$str ."</div>";
                        }
                    }
                    
                    $str=$str . "</div>";
                    $str=$str . "</div>";
                    $str=$str . "</li>";
                    $str=$str . "</ul>";
                    $str=$str . "</li>";
                }
            }
            
        }
        catch(exception $e)
        {
            $str = "" ;
        }
        return  $str;
    }
    
    
    public function getCommentStr(){
        $str = "";
        try{
            $sql = "SELECT * FROM `comments` WHERE `ObjectIDD` = 'homepage'  AND `Status` = '1' ORDER BY `CreatedDate` DESC  LIMIT 0,3";
            $arr_commonet = $this->db->query($sql)->result();
            $list = (array) $arr_commonet;
            $sql_creadby = "SELECT a.*, b.`FullName` FROM `users` a  INNER JOIN `objects` b ON a.`ObjectId` = b.`ObjectId`";
            $arr_creadbyComment = $this->db2->query($sql_creadby)->result();
            $list_creadbyComment = (array) $arr_creadbyComment;
            if(count($list) > 0){
                for($i = 0;$i < count($list);$i++){
                    $str = $str ."<li>";
                    $str = $str ."<div class=\"wrap-2-columns-left\">";
                    $str = $str ."<div class=\"wrapper\">";
                    $str = $str ."<div class=\"content\">".$list[$i]->Content."</div>";
                    $str = $str ."</div>";
                    if(count($list_creadbyComment) > 0){
                       for($j = 0; $j < count($list_creadbyComment); $j++){
                            if($list_creadbyComment[$j]->UserId == $list[$i]->CreatedBy){
                                $image = $list_creadbyComment[$j]->Avatar;
                                if($image == ""){
                                    $image = "resources/front/images/Happy-Woman.jpg";   
                                }
                                $str = $str ."<div class=\"sidebar\"><div class=\"wrap-thumb circle-thumb\" style=\"background-image:url(".$image.")\"></div>";
                                $str = $str ."<div class=\"thumb-title\">".$list_creadbyComment[$j]->UserId."</div>";
                            }
                       }
                    }
                   
                    
                    $str = $str ."</div>";
                    $str = $str ."</li>";
                }
                
            } 
        }
        catch(exception $e){
            
            $str = "";
        }
           return $str;
    }
    
    //function generateRandomPassword() {
          //Initialize the random password
//          $password = '';
          //Initialize a random desired length
//          $desired_length = rand(8, 12);

//          for($length = 0; $length < $desired_length; $length++) {
            //Append a random ASCII character (including symbols)
//            $password .= chr(rand(32, 126));
//          }

//          return $password;
//    }
    
    function generateRandomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }
    
    public function forgetpass(){
        $email = $_POST['email'];
        $res = 0;                  
        $sql = "SELECT * FROM `users` WHERE `UserId` = '$email' AND `Status` = '1' AND `UserType` IS NULL ";
        // database thứ 2
         $_arremail = $this->db2->query($sql)->result();;
        $arr_email = (array)$_arremail;
        $MTC = "";
        if(count($arr_email) > 0)
        {   
             $passwordsend = $this->generateRandomPassword();
             $passwordnew = md5($passwordsend);  
             $sql_update = "UPDATE `users` SET `Pwd` = '$passwordnew' WHERE `UserId` = '$email'";
             $this->db2->query($sql_update);
             // goi mail cho khach hang
             $MTC = $this->GuiMailForget($email,$passwordsend);
             $res = 1;
                  
        }
        else{
            $res = 0;
        }
        
        $arr = array("Return" =>$res,"GMT"=>$MTC);
        return  $arr;
    }
    
    // ham goi mail 
    public function GuiMailForget($uid,$passwordnew)
    {
           $usr = $this->m_register->getUserInfo($uid);
            $obj = null;
            if(isset($usr))
            {
                $obj = $this->m_register->getObject($usr[0]->ObjectId);
            }
                       
            $mail = $this->m_mail->CreateMail();
            $guiden = $obj[0]->Email;
            $Ten    = $obj[0]->FullName;
            $Tel    = $obj[0]->Tel;
            $objectId = $obj[0]->ObjectId;
            $passnew = $passwordnew;
            $mail->addAddress($guiden, $Ten);              
            $mail->addCC('thuan.nguyenngockim@gmail.com');
            //$mail->addCC('huunghia1810@gmail.com');
            $mail->addCC('occbuu@gmail.com');
            $mail->isHTML(true);                                 
            $mail->Subject = 'Cap lai mat khau';           
            $body = $this->m_mail->GetMailTemplate("ForgetPass");
            $body = str_replace("[FullName]",$Ten, $body);
            $body = str_replace("[UserID]",$guiden, $body);
            $body = str_replace("[Object_FullName]",$Ten, $body);
            $body = str_replace("[Tel]",$Tel, $body);
            $body = str_replace("[PasswordNew]",$passnew, $body);
            $body = str_replace("[TongDaiHotLine]","(08) 62555657", $body);
            $body = str_replace("[EmailHotLine]","info@thebooking.vn", $body);
            $body = str_replace("[SMS]","0903384050", $body);
            $mail->Body    = $body;
            $mail->AltBody = 'Bạn đã được cấp password thành công!!';
            if(!$mail->send()) {
               return 0;
            } else {
                return 1;
            }
    }
    //////////////
    public function listkind(){
        $Loai=$_POST['Loai'];
        $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' ORDER BY `StrValue2` DESC";
        $results=$this->db->query($sql)->result();
        $sodong=count($results);
        $res = array("sql"=>$sql,"lst"=>$results,"sodong"=>$sodong);
        return $res;
    }
    public function listplace(){
        $Loai=$_POST['Loai'];
        $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId`='LOCATION' ORDER BY `StrValue1` DESC";
        $results=$this->db->query($sql)->result();
        $sodong=count($results);
        $res = array("sql"=>$sql,"lst"=>$results,"sodong"=>$sodong);
        return $res;
    }
    //dsd
    public function listplaceadv(){
        //$Loai=$_POST['Loai'];
        $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId`='LOCATION' AND LENGTH(`CommonId`)=3 ORDER BY `StrValue1`";
        $results=$this->db->query($sql)->result();
        $arr=array();
        $arr_tinh=array();
        foreach($results as $key)
        {
            $arr_tinh['key']=$key->CommonId;
            $arr_tinh['name']=$key->StrValue1;
            $arr_tinh['arr']=$this->layhuyentheotinh($key->CommonId);
            $arr[]=$arr_tinh;
        }
        return $arr;
        /*$sodong=count($results);
        $res = array("sql"=>$sql,"lst"=>$results,"sodong"=>$sodong);
        return $res;*/
    }
    
    public function layhuyentheotinh($matinh)
    {
        $sql1="SELECT * FROM `commoncode` WHERE `CommonTypeId`='LOCATION' AND LENGTH(`CommonId`)=5 and CommonId like '$matinh%' ORDER BY `StrValue1`";
        $results=$this->db->query($sql1)->result();
        if(count($results)>0)
        {
            $loai_sp=array();
            foreach($results as $item)
            {
                $loai_sp[$item->CommonId]=$item->StrValue1;
            }
            return $loai_sp;
        }
            return $results;
        return false;
    }
    //sfdsf
    public function listpro_limit4(){
        $sql="SELECT * FROM `products` ORDER BY `CreatedDate` DESC LIMIT 0,4";
        try{
            $results=$this->db->query($sql)->result();
            $errorStr =null;
            return $results;
        }catch(Exception $e){
               $errorStr =  $e;
               return null;                    
        }
    }
    
    public function laylink($id)
    {
        $sql="SELECT * FROM `links`  WHERE `ObjectIDD`='$id' AND `Status`='1' ORDER BY `UploadedDate` DESC LIMIT 1";
        try{
                $results=$this->db->query($sql)->result();
                $arr = (array) $results;
                if(count($arr)>0) 
                {
                    return base_url($arr[0]->URL);
                    $errorStr =null;
                }
                else
                {
                    return base_url("resources/front/images/nospaimages.png");
                }
        }
        catch(Exception $e){
               $errorStr =  $e;
               return base_url("resources/images/front/nospaimages.png");                    
        }        
    }
    public function layspaname_theoproductid($idsp)
    {
        $sql="SELECT a.*,CONCAT(LEFT(a.`Intro`,100),'...') AS info1 FROM `spa` a, `products` b WHERE b.`ProductID`='$idsp' AND a.`spaID`=b.`SpaID`";
        $query=$this->db->query($sql)->row();
        return $query;
    }
    public function layplace($id)
    {
        $sql="SELECT DISTINCT a.*, b.* FROM `spalocation` a INNER JOIN `commoncode` b ON a.`LocationID`=b.`CommonId` INNER JOIN `spa` c ON a.`spaID` = c.`spaID` WHERE a.`spaID` IN (SELECT `SpaID` FROM `products` WHERE `ProductID`='$id')"; //note chua biet location sp la gi
        try{
                $results=$this->db->query($sql)->row();
                if(count($results)>0) 
                {
                    echo $results->StrValue1;
                }
                else
                    echo "Chưa có địa điểm";
                $errorStr =null;
        }
        catch(Exception $e){
               $errorStr =  $e;
               return null;                    
        }
    }
    public function layloaiconsp(){
        $sql = "SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND LENGTH(`CommonId`)=4"; //l?y c?p 2
        $ListProductTypes = $this->db->query($sql)->result();
        return $ListProductTypes;
    }
    public function lay1sptheoloai($id)
    {
        $sql="select * from products where ProductType='$id' ORDER BY `Name` DESC"; //note chua biet location sp la gi
        try{
                $results=$this->db->query($sql)->row();
                return $results;
                $errorStr =null;
        }
        catch(Exception $e){
               $errorStr =  $e;
               return null;                    
        }
    }
    public function laydssp_sxtheongay($limit)
    {
        //$sql="SELECT * FROM `products` ORDER BY `ModifiedDate` DESC, `CreatedDate` DESC LIMIT 0,$limit";
        $sql="SELECT * FROM `products` ORDER BY RAND() LIMIT 0,$limit";
        try{
                $results=$this->db->query($sql)->result();
                return $results;
                $errorStr =null;
        }
        catch(Exception $e){
               $errorStr =  $e;
               return null;                    
        }
        
    }
    
    // sản phẩm khuyến mãi dành cho packet ngày 17/01/2014
    public function getlistporduct($id){
        $sql = "SELECT *,CONCAT(LEFT(`Description`,250),'...') AS desc1  FROM `products` WHERE `ProductID` = '$id' AND `Status` = '1' ";
        try{
                $results=$this->db->query($sql)->row();
                return $results;
                $errorStr =null;
        }
        catch(Exception $e){
               $errorStr =  $e;
               return null;                    
        }
    }
    //xu ly dang nhap login
    public function actionlogin()
    {
        $username=$_POST['Username_login'];
        $password=$_POST['ExampleInputPassword2'];
        
        $sql="select * from users where UserId = '".$username."' and Pwd = '".$password."'";
        $results=$this->db->query($sql)->result();
        $sodong=count($results);
        if($sodong==1)
        {
             $arr_session = array(
            'user_name' => $username);
            $_SESSION['AccUser']=$arr_session;
        }
        $res = array("sql"=>$sql,"lst"=>$results,"sodong"=>$sodong);
        return $res;
    }
    //dang ki
    public function actionregister()
    {
        $username=$_POST['username'];
        $pass1=$_POST['pass1'];
        $pass2=$_POST['pass2'];
        $ho=$_POST['ho'];
        $ten=$_POST['ten'];
        $gioitinh=$_POST['gioitinh'];
        $Pcode=$_POST['Pcode'];
        
        $sql_check="select * from users where UserId='".$username."'";
        $query_check=$this->db2->query($sql_check)->result();
        $sodong_check=count($query_check);
        $thongbao_email="";
        $thongbao_pass="";
        $sql_insert="";
        if($sodong_check>0)
        {
            $thongbao_email="Email đã tồn tại";
        }
        else
        {
            if(filter_var($username,FILTER_VALIDATE_EMAIL))
            { //email hop le
                if($pass1!=$pass2)
                $thongbao_pass="Nhập lại password chưa đúng";
                else
                {
                    $sql_insert="INSERT INTO `users` (`UserId`, `Pwd`, `Status`, `CreatedDate`) 
                    VALUES ('$username', $pass1, 0, NOW())";
                    $results=$this->db2->query($sql_insert);
                }
            }
            else
            { //email khong hop le
                $thongbao_email="Email không hợp lệ";
            }
        }
        $res = array("sql_insert"=>$sql_insert,"thongbao_email"=>$thongbao_email,"thongbao_pass"=>$thongbao_pass);
        return $res;
    }
    
    public function bookintoSession()
    {
		if(isset($_POST['masp']))
		{
			$id=$_POST['masp'];
			$ngay =$_POST['NgaySD'];
			$gio =$_POST['GioSD'];
			$promotionid=$_POST['promotionid'];
			$ret = $this->bookintoSession2($id,$ngay,$gio,$promotionid);
			/*echo "<pre>";
				print_r($ret);
			echo "</pre>"; die;*/
			return $ret;
		}
    }
    
    
    public function bookintoSession1($id,$ngay,$gio)
    {
        $return =0;
        //try
//        {
            $arr_sanpham = array();
        
            $sql1= "SELECT * FROM `products` WHERE `ProductID`='$id'";
            $res1 = $this->db->query($sql1)->result();
            $arr_Pro = (array)$res1;
            $proID ="";
            $proName="";
            $minutes_to_add = 60;
            if(count($arr_Pro)>0)
            {
                $proID = $arr_Pro[0]->ProductID;
                $proName = $arr_Pro[0]->Name;
                $minutes_to_add = intval($arr_Pro[0]->Duration);
            }
                    
            $sql2= "SELECT * FROM `price` WHERE `ProductID`='$id' ORDER BY `CreatedDate` DESC LIMIT 1";
            $res2 = $this->db->query($sql2)->result();
            $arr_Price = (array)$res2;        //
            $price = 0;        
            if(count($arr_Price)>0)
            {
                $price = floatval($arr_Price[0]->Price);
            }
            
            $spaID= $arr_Pro[0]->SpaID;        
            $sql4= "SELECT * FROM  `spa` WHERE `spaID`='$spaID'";
            $res4 = $this->db->query($sql4)->result();
            $arr_Spa = (array)$res4;
            $spaName ="";
            $spaAdd ="";
            //
            if(count($arr_Spa)>0)
            {
                $spaName =$arr_Spa[0]->spaName;
                $spaAdd = $arr_Spa[0]->Address;
                //echo json_encode($arr_Spa[0]);
                //die();
                
            }
            $qty = 1;
            $tt = $qty*$price;
            
            $d="";$m="";$y="";
            $arrDay =explode('/',$ngay);
            $time = new DateTime();
            if(count($arrDay)==3)
            {
                $d=$arrDay[0];
                $m=$arrDay[1];
                $y="20".$arrDay[2];
                $time = new DateTime($y.'-'.$m.'-'.$d.' '. $gio);
            }
            

            $Ftime = $time->format('Y-m-d H:i');
            $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

            $TTime = $time->format('Y-m-d H:i');
                                        
            $sp=array("spaName"=>$spaName,"SpaAdd"=>$spaAdd, "ProductID"=>$proID,"ProductName"=>$proName,
                        "Qty"=>$qty,"Price"=>$price,"AmtBT"=>$tt,"FromTime"=>$Ftime,"ToTime"=>$TTime);
            
            
            if(isset($_SESSION['Cart']))
            {
                $arr_sanpham =(array)$_SESSION['Cart'];    
                $i=0;
                do{
                    $FTCu = new DateTime($arr_sanpham[$i]['FromTime']);
                    $FTMoi = new DateTime($Ftime);
                    //$months = $dt->format('m'); 
                    //"Y-m-d H:i:s"                
                    
                    if($arr_sanpham[$i]['ProductID']== $proID && $FTCu->format("Y-m-d H:i")== $FTMoi->format("Y-m-d H:i"))
                    {
                        //echo $FTCu->format("Y-m-d H:i:s");
//                        echo "<br>";
//                        echo $FTMoi->format("Y-m-d H:i:s");
//                        die();
                        
                        $sl_cu = floatval($arr_sanpham[$i]['Qty']);
                        $tt_moi = ($sl_cu + $qty ) * $price;
                        $arr_sanpham[$i]['Qty'] =$sl_cu + $qty;
                        $arr_sanpham[$i]['AmtBT'] = $tt_moi;
                        $return=2;
                        break;
                    }
                    $i = $i+1;
                } while($i<count($arr_sanpham));        
                
                if($i==count($arr_sanpham))
                {
                    array_push($arr_sanpham,$sp);
                }            
            }
            else
            {
                array_push($arr_sanpham,$sp);
            }
            
            $_SESSION['Cart'] =$arr_sanpham;  
            $return =1;
       // }
//        catch(exception $e)
//        {
//            $return =0;    
//        }  
        return $return;          
    }
    
    //nghia viet them
    public function bookintoSession2($id, $ngay, $gio,$promotionid)
    {
        $return =0;
        //try
//        {
            $arr_sanpham = array();
        
            $sql1= "SELECT * FROM `products` WHERE `ProductID`='$id'";
            $res1 = $this->db->query($sql1)->result();
            $arr_Pro = (array)$res1;
            $proID ="";
            $proName="";
            $minutes_to_add = 60;
            if(count($arr_Pro)>0)
            {
                $proID = $arr_Pro[0]->ProductID;
                $minutes_to_add = intval($arr_Pro[0]->Duration);
            }
                            
            $spaID= $arr_Pro[0]->SpaID;        
            
            $qty = 1;
            $d="";$m="";$y="";
            $arrDay =explode('/',$ngay);
            $time = new DateTime();
            if(count($arrDay)==3)
            {
                $d=$arrDay[0];
                $m=$arrDay[1];
                if(strlen($y)==4)
                {
                    $y=$arrDay[2];    
                }
                else
                {
                    $y="20".$arrDay[2];
                }
                
                $time = new DateTime($y.'-'.$m.'-'.$d.' '. $gio);
				$nghiatime = $y.'-'.$m.'-'.$d.' '. $gio;
            }
            
                            //
                            $price = 0; 
                            if($promotionid!="" && $promotionid!=0 && $promotionid!="0")
                            {
                                $spkm=$this->laykm_theoproid_promotionid($id,$promotionid);
                                //$nowtime=strtotime(date("Y-m-d H:m:s"));
                                $booktime=strtotime($nghiatime);
                                //echo $booktime;die;
                                if(strtotime($spkm->BeginDateTime)<=$booktime && $booktime<=strtotime($spkm->EndDateTime)) //sp co khuyen mai
                                {
                                    $price = floatval($spkm->Price);
                                }
                                else //khi book sp da khong con khuyen mai
                                {
                                    $promotionid=0;
                                    $sql2= "SELECT * FROM `price` WHERE `ProductID`='$id' ORDER BY `CreatedDate` DESC LIMIT 1";
                                    $res2 = $this->db->query($sql2)->result();
                                    $arr_Price = (array)$res2;  
                                    if(count($arr_Price)>0)
                                    {
                                        $price = floatval($arr_Price[0]->Price);
                                    }
                                }
                            }
                            else //sp khong co khuyen mai
                            {
                                $promotionid=0;
                                $sql2= "SELECT * FROM `price` WHERE `ProductID`='$id' ORDER BY `CreatedDate` DESC LIMIT 1";
                                $res2 = $this->db->query($sql2)->result();
                                $arr_Price = (array)$res2;   
                                if(count($arr_Price)>0)
                                {
                                    $price = floatval($arr_Price[0]->Price);
                                }
                            }
                            //

            $Ftime = $time->format('Y-m-d H:i');
            $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
            $TTime = $time->format('Y-m-d H:i');
             
            $arr_product = array("ProductID"=>$proID,"Qty"=>$qty,"Price"=>$price,"FromTime"=>$Ftime,"ToTime"=>$TTime,"promotionid"=>$promotionid);
            
            $arr_list_pro = array();
            array_push($arr_list_pro,$arr_product);
                                
            $arr_spa=array(
                            "spaid"=>$spaID,
                            "list_product"=>$arr_list_pro
                            );
            $arr_Return = array();
            
            if(isset($_SESSION['Cart']))
            { // da co cart
                $arr_Cart_cu =(array)$_SESSION['Cart'];  				
                $i=0;
                for($i=0;$i<count($arr_Cart_cu);$i++)
                {
                    if($arr_Cart_cu[$i]['spaid']== $spaID)
                    {   // da co spa nay
						$flag=1;
                        $j=0;
                        foreach($arr_Cart_cu[$i]['list_product'] as $row_pro)
                        {
							$temfromtime= $row_pro['FromTime'];
							$date = date_create($temfromtime);
							$FTCu = date_format($date, 'Y-m-d H:i');
							$datemoi = date_create($nghiatime);
							$FTMoi = date_format($datemoi, 'Y-m-d H:i');
							//echo $FTCu.' ';
							//echo $FTMoi.' ';
							//echo strtotime($$row_pro['FromTime']).' ';
							//echo strtotime($time).' ';
							//echo $FTMoi;
                            //if($flag_khuyenmai==1 || $flag_khuyenmai=="1")
                            if($row_pro['ProductID']==$proID && strtotime($FTCu)==strtotime($FTMoi) && $row_pro['promotionid']==$promotionid)
                            {  // da co san pham nay
                                $sl_cu = floatval($row_pro['Qty']);
                                $arr_Cart_cu[$i]['list_product'][$j]['Qty'] = $sl_cu + $qty;
                                //$return=2;
                                break;
                            }     
                            $j++;
                        }
                        if($j== count($arr_Cart_cu[$i]['list_product']))
                        {  // ko co ton tai trog cart , chua co sp nay
                            $arr_pro_new = $arr_Cart_cu[$i]['list_product'];
                            array_push($arr_pro_new,$arr_product);
                            $arr_Cart_cu[$i]['list_product']= $arr_pro_new;
                        }
                        
                        $arr_Return = $arr_Cart_cu;    
                        break;                    
                    }                    
                }		
                if($i==count($arr_Cart_cu))		
                {
                    // chua co spa nay
                    $arr_Return = $arr_Cart_cu;
                    array_push($arr_Return,$arr_spa);
                }
            }
            else
            { // chua co cart
                array_push($arr_Return,$arr_spa);
            }
            
            $_SESSION['Cart'] = $arr_Return;  
            $return = 1;
        return $return;          
    }
    
    public function getdetailpro()
    {
        if(isset($_POST['masp']))
        {
            $price_save=0;
            $id=$_POST['masp'];
            if(isset($_POST['promotionid']))
                $promotionid=$_POST['promotionid'];
            else
                $promotionid=0;
            
            $sql1= "SELECT * FROM `products` WHERE `ProductID`='$id'";
            $res1 = $this->db->query($sql1)->result();
            $arr_Pro = (array)$res1;
            
            if(isset($promotionid) && $promotionid!="" && $promotionid!=0 && $promotionid!="0")
            {
                $sql_price_save="SELECT * FROM `promotiondetails` WHERE `PromotionId`='$promotionid' AND `ProductId`='$id'";
                $query_price_save = $this->db->query($sql_price_save)->row();
                $price_save=$query_price_save->Price;
                //echo $price_save;die;
            }
                
            $sql2= "SELECT * FROM `price` WHERE `ProductID`='$id' ORDER BY `CreatedDate` DESC LIMIT 1";
            $res2 = $this->db->query($sql2)->result();
            $arr_Price = (array)$res2;
            
            $sql3= "SELECT * FROM `producttime` WHERE `ProductID`='$id'";
            $res3 = $this->db->query($sql3)->result();
            $arr_ProTime = (array)$res3;
            
            $spaID= $arr_Pro[0]->SpaID;
            
            $sql4= "SELECT * FROM  `spa` WHERE `spaID`='$spaID'";
            $res4 = $this->db->query($sql4)->result();
            $arr_Spa = (array)$res4;
            
            $sql5= "SELECT * FROM  `spatime` WHERE `spaID`='$spaID'";
            $res5 = $this->db->query($sql5)->result();
            $arr_SpaTime = (array)$res5;
            
            $sql5= "SELECT b.* FROM `spalocation` a INNER JOIN `commoncode` b ON a.`LocationID`=b.`CommonId` WHERE b.`CommonTypeId`='LOCATION' AND a.`spaID`='$spaID'";
            $res5 = $this->db->query($sql5)->result();
            $arr_Location = (array)$res5;
            
            // viet them vao ngay 10/01/2015 comment cha
            $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
            // comment cha/
            $sql6 = "SELECT a.*,b.`FullName` 
                    FROM `comments` a, `spabooking_thebookingdev`.`objects` b, `spabooking_thebookingdev`.`users` c
                    WHERE a.`ObjectIDD`='$id' 
                    AND a.`Level`='0' 
                    AND a.`CreatedBy`= c.`UserId` AND c.`ObjectId`=b.`ObjectId`
                    AND a.`ApprovedBy` IS NOT NULL 
                    AND a.`ApprovedDate` IS NOT NULL
                    AND a.`Status` = '1' 
                    ORDER BY a.`ModifiedDate` DESC LIMIT 0,5";
            if(strpos($actual_link,"localhost")>0 || strpos($actual_link,"127.0.0.1")>0)
            {
               $sql6 = "SELECT a.*,b.`FullName` 
                    FROM `comments` a, `thebooking`.`objects` b, `thebooking`.`users` c
                    WHERE a.`ObjectIDD`='$id' 
                    AND a.`Level`='0' 
                    AND a.`CreatedBy`= c.`UserId` AND c.`ObjectId`=b.`ObjectId`
                    AND a.`ApprovedBy` IS NOT NULL 
                    AND a.`ApprovedDate` IS NOT NULL
                    AND a.`Status` = '1' 
                    ORDER BY a.`ModifiedDate` DESC LIMIT 0,5"; 
            }
            $res6 = $this->db->query($sql6)->result();
            $arr_Comment = (array)$res6;
 
            // comment con
            $sql7 = "SELECT a.*,b.`FullName` 
                    FROM `comments` a, `spabooking_thebookingdev`.`objects` b, `spabooking_thebookingdev`.`users` c
                    WHERE a.`ObjectIDD`='$id' 
                    AND a.`Level`='1' 
                    AND a.`CreatedBy`= c.`UserId` AND c.`ObjectId`=b.`ObjectId`
                    AND a.`ApprovedBy` IS NOT NULL 
                    AND a.`ApprovedDate` IS NOT NULL
                    AND a.`Status` = '1' 
                    ORDER BY a.`ModifiedDate` DESC LIMIT 0,5";
             if(strpos($actual_link,"localhost")>0 || strpos($actual_link,"127.0.0.1")>0)
            {
               $sql7 = "SELECT a.*,b.`FullName` 
                    FROM `comments` a, `thebooking`.`objects` b, `thebooking`.`users` c
                    WHERE a.`ObjectIDD`='$id' 
                    AND a.`Level`='1' 
                    AND a.`CreatedBy`= c.`UserId` AND c.`ObjectId`=b.`ObjectId`
                    AND a.`ApprovedBy` IS NOT NULL 
                    AND a.`ApprovedDate` IS NOT NULL
                    AND a.`Status` = '1' 
                    ORDER BY a.`ModifiedDate` DESC LIMIT 0,5"; 
            }
            
            $res7 = $this->db->query($sql7)->result();
            $list_Commentcon = (array)$res7;
            
            // người tạo ra comment con ngày 13/01/2015
            $sql8 = "SELECT a.*,b.`FullName` FROM `users` a INNER JOIN `objects` b ON a.`ObjectId` = b.`ObjectId` ";
            $res8 = $this->db2->query($sql8)->result();
            $CreadyBy_Comment = (array) $res8;
            
            $getlink = $this->laylink($id); 
            $arr_Pro0=null;
            $arr_Price0=null;
            $arr_Location0 =null;
            $arr_Spa0=null;
            $arr_Comment0 = null;
            if(count($arr_Pro)>0 )
            {
                $arr_Pro0 = $arr_Pro[0];
            }
            if(count($arr_Price)>0 )
            {
                $arr_Price0=$arr_Price[0];
            }
            if(count($arr_Spa)>0 )
            {
                $arr_Spa0=$arr_Spa[0];
            }
            if(count($arr_Location)>0 )
            {
                $arr_Location0=$arr_Location[0];
            }
            //if(count($arr_Comment) > 0){
//                $arr_Comment0=$arr_Comment[0];
//            }        
            
            $link_spainfo = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $res = array("Product"=>$arr_Pro0,
                        "Price"=>$arr_Price0,
                        "ProductTime"=>$arr_ProTime,
                        "Spa"=>$arr_Spa0,
                        "Location"=>$arr_Location0,
                        "ImgLinks"=>$getlink,
                        "SpaTime"   =>$arr_SpaTime,
                        "price_save"=>$price_save,
                        "promotionid"=>$promotionid,
                        "linkpro"   =>$link_spainfo,
                        "Comment"   =>$arr_Comment,
                        "CommentCon"=>$list_Commentcon,

                        "CreadbyComment"=>$CreadyBy_Comment

                        //"PresonCha"=>$PresonCha

                        );
            //print_r($res);die;
            return $res;
        }
    }
    
    public function get_cmt_level1($id)
    {
        $sql='SELECT * FROM `comments` WHERE `Level`=0 AND `ApprovedDate` IS NOT NULL AND `ParentID` IS NULL and ObjectIDD="'.$id.'"';
        $results=$this->db->query($sql)->result();
        return $results;
        
    }
    
    public function ReloadTimeForProduct($timeStep){
        $resStr="";
        
        $ProID = $_POST['masp'];
        $Ngay = $_POST['ngaybook'];
        
        $arrDay =explode('/',$Ngay);
        $time = new DateTime();
        
        $thu = "";
        if(count($arrDay)==3)
        {
            $d=$arrDay[0];
            $m=$arrDay[1];
            $y=$arrDay[2];
            if(strlen($y)==2)
            {
                $y="20".$arrDay[2];
            }
            $time = new DateTime($y.'-'.$m.'-'.$d);
            //$time = '2014-12-20';
            $thu = date('l', strtotime( $y.'-'.$m.'-'.$d));
        }
        $intThu=0;
        switch($thu)
        {
            case "Monday":
            {
                $intThu =2;
                break;
            }
            case "Tuesday":
            {
                $intThu =3;
                break;
            }
            case "wednesday":
            {
                $intThu =4;
                break;
            }
            case "Thursday":
            {
                $intThu =5;
                break;
            }
            case "Friday":
            {
                $intThu =6;
                break;
            }
            case "Saturday":
            {
                $intThu =7;
                break;
            }
            case "Sunday":
            {
                $intThu =8;
                break;
            }
        }
        
        // check ngay le (chua xu ly ) $intThu =9;
        $duration = 60;
        $sql0 = "SELECT * FROM `products` WHERE  `ProductID`='$ProID'";
        $result= (array) $this->db->query($sql0)->result();
        if(count($result)>0)
        {
            $duration = intval($result[0]->Duration);
        }
        
        
        
        $sql="SELECT a.*  FROM  `producttime` a WHERE a.`ProductID`='$ProID' AND a.`DayOfWeek`='$intThu'";
        $results= (array) $this->db->query($sql)->result();
        $sodong=count($results);
        if($sodong>0)
        {
            //$duration = 60;
            $from = intval($results[0]->AvailableHourFrom);
            $to = intval($results[0]->AvailableHourTo);
            $last = ceil($duration/60);
            $to = $to - $last;
            if($from < $to)
            {
                do 
                {
                    
                   $fromstr = "";
                   if($from<10)
                   {
                       $fromstr = "0". $from ;
                   }
                   else
                   {
                       $fromstr = $from;
                   }
                   
                   if($timeStep=="30" || $timeStep == 30)
                   {                   
                       $resStr = $resStr . "<li><a href=\"javascript:void(0);\" onclick=\"selectHourProduct('".$fromstr.":00');\">".$fromstr.":00</a></li>"; 
                       $resStr = $resStr . "<li><a href=\"javascript:void(0);\" onclick=\"selectHourProduct('".$fromstr.":30');\">".$fromstr.":30</a></li>"; 
                   }
                   if($timeStep=="15" || $timeStep == 15)
                   {                   
                       $resStr = $resStr . "<li><a href=\"javascript:void(0);\" onclick=\"selectHourProduct('".$fromstr.":00');\">".$fromstr.":00</a></li>"; 
                       $resStr = $resStr . "<li><a href=\"javascript:void(0);\" onclick=\"selectHourProduct('".$fromstr.":15');\">".$fromstr.":15</a></li>"; 
                       $resStr = $resStr . "<li><a href=\"javascript:void(0);\" onclick=\"selectHourProduct('".$fromstr.":30');\">".$fromstr.":30</a></li>"; 
                       $resStr = $resStr . "<li><a href=\"javascript:void(0);\" onclick=\"selectHourProduct('".$fromstr.":45');\">".$fromstr.":45</a></li>"; 
                   }
                   if($timeStep=="60" || $timeStep == 60)
                   {                   
                       $resStr = $resStr . "<li><a href=\"javascript:void(0);\" onclick=\"selectHourProduct('".$fromstr.":00');\">".$fromstr.":00</a></li>";                        
                   }
                   
                   $from  = $from +1;
                } while ($from != $to);
            }
                        
        }
        else
        {
            $sql1="SELECT a.* FROM `spatime` a, `products` b WHERE a.`spaID` = b.`spaID` AND a.`DayOfWeek` = '$intThu' AND b.`ProductID` = '$ProID'";
            $results1 = (array) $this->db->query($sql1)->result();
            if(count($results1)>0)
            {
                $from = intval($results1[0]->AvailableHourFrom);
                $to = intval($results1[0]->AvailableHourTo);
                $last = ceil($duration/60);
                $to = $to - $last;
                if($from < $to)
                {
                    do 
                    {                        
                       $fromstr = "";
                       if($from<10)
                       {
                           $fromstr = "0". $from ;
                       } 
                       else
                       {
                           $fromstr = $from;
                       }                  
                       if($timeStep=="30" || $timeStep == 30)
                       {                   
                           $resStr = $resStr . "<li><a href=\"javascript:void(0);\" onclick=\"selectHourProduct('".$fromstr.":00');\">".$fromstr.":00</a></li>"; 
                           $resStr = $resStr . "<li><a href=\"javascript:void(0);\" onclick=\"selectHourProduct('".$fromstr.":30');\">".$fromstr.":30</a></li>"; 
                       }
                       if($timeStep=="15" || $timeStep == 15)
                       {                   
                           $resStr = $resStr . "<li><a href=\"javascript:void(0);\" onclick=\"selectHourProduct('".$fromstr.":00');\">".$fromstr.":00</a></li>"; 
                           $resStr = $resStr . "<li><a href=\"javascript:void(0);\" onclick=\"selectHourProduct('".$fromstr.":15');\">".$fromstr.":15</a></li>"; 
                           $resStr = $resStr . "<li><a href=\"javascript:void(0);\" onclick=\"selectHourProduct('".$fromstr.":30');\">".$fromstr.":30</a></li>"; 
                           $resStr = $resStr . "<li><a href=\"javascript:void(0);\" onclick=\"selectHourProduct('".$fromstr.":45');\">".$fromstr.":45</a></li>"; 
                       }
                       if($timeStep=="60" || $timeStep == 60)
                       {                   
                           $resStr = $resStr . "<li><a href=\"javascript:void(0);\" onclick=\"selectHourProduct('".$fromstr.":00');\">".$fromstr.":00</a></li>";                        
                       }
                       $from  = $from +1;
                    } while ($from != $to);
                }
            }
        }
        
        return $resStr;
    }
    //nghia viet them 26/12/2014
    public function laydanhsachkhuyenmai()
    {
        $sql="SELECT DISTINCT `PromotionName`, `PromotionId` FROM `promotions` WHERE NOW() BETWEEN `BeginDateTime` AND `EndDateTime`";
        $query=$this->db->query($sql)->result();
        return $query;
    }
    public function laydanhsachkhuyenmaivang()
    {
        //$sql="SELECT DISTINCT `PromotionName`, `PromotionId` FROM `promotions` WHERE `PromotionType`='GoldHour' and NOW() BETWEEN `BeginDateTime` AND `EndDateTime`";
        $sql="SELECT DISTINCT `PromotionName`, `PromotionId` FROM `promotions` WHERE NOW() BETWEEN `BeginDateTime` AND `EndDateTime`";
        $query=$this->db->query($sql)->result();
        return $query;
    }
    public function laylistspkhuyenmai_theomakhuyenmai($makhuyenmai)
    {
        $sql="SELECT * FROM `promotiondetails` WHERE `PromotionId`='$makhuyenmai'";
        $query=$this->db->query($sql)->result();
        return $query;
    }
    public function layttsp_theomasp($masp)
    {
        $sql="SELECT b.`ProductID`,b.`Name`, a.`SpaID`,a.`spaName` FROM `spa` a,`products` b WHERE a.`spaID`=b.`SpaID` AND b.`ProductID`='$masp'";
        //echo $sql;die;
        $query=$this->db->query($sql)->row();
        return $query;
    }
    public function layhinhspa_theospaid($spaid)
    {
        $sql="SELECT * FROM `links` WHERE `Type`='SPA' AND `ObjectIDD`='$spaid' order by id desc";
        $query=$this->db->query($sql)->row();
        return $query;
    }
    
    public function layhinhproduct_theoproid($productID)
    {
        $sql="SELECT * FROM `links` WHERE `Type`='PRODUCT' AND `ObjectIDD`='$productID' order by id desc";
        $query=$this->db->query($sql)->row();
        return $query;
    }
    public function laydiadiemspa_theospaid($spaid)
    {
        $sql="SELECT b.`StrValue1` FROM `spalocation` a, `commoncode` b WHERE a.`LocationID`=b.`CommonId` AND b.`CommonTypeId`='LOCATION' AND a.`spaID`='$spaid'";
        $query=$this->db->query($sql)->row();
        return $query;
    }
    public function layspkhuyenmai() //khuyen mai thuong cho trang index
    {
        $list_khuyenmai=$this->laydanhsachkhuyenmaivang();
        if(isset($list_khuyenmai) && count($list_khuyenmai)>0)
        {
            $arr=array();
            for($i=0;$i<count($list_khuyenmai);$i++)
            {
                $arr_product=array();
                $makhuyenmai=$list_khuyenmai[$i]->PromotionId;
                $listspkhuyenmai=$this->laylistspkhuyenmai_theomakhuyenmai($makhuyenmai);
                //print_r($listspkhuyenmai);die;
                $chay=0;
                foreach($listspkhuyenmai as $row_spkm)
                {
                    //echo $row_spkm->ProductId." ";
                    $ttsp=$this->layttsp_theomasp($row_spkm->ProductId);
                    if(count($ttsp)>0)
                    {
                        //print_r($ttsp);echo "<br />";
                        //print_r($ttsp);die;
                        //$arr_product[$chay]['hinh']=$this->layhinhspa_theospaid($ttsp->SpaID);
                        $arr_product[$chay]['hinh']=$this->layhinhproduct_theoproid($row_spkm->ProductId);
                        $arr_product[$chay]['ttsp']=$ttsp;
                        $arr_product[$chay]['diadiemspa']=$this->laydiadiemspa_theospaid($ttsp->SpaID);
                        $chay++;
                    }
                }
                $arr[$i]['makhuyenmai']=$list_khuyenmai[$i]->PromotionId;
                $arr[$i]['tenkhuyenmai']=$list_khuyenmai[$i]->PromotionName;
                $arr[$i]['listproduct']=$arr_product;
            }
            return $arr;
        }
        else
            return -1;
    }
    public function laylist_khuyenmaivang()
    {
        $sql="SELECT a.*,b.`PromotionName`,b.`PromotionType`,b.`BeginDateTime`, b.`EndDateTime` 
                FROM `promotiondetails` a, `promotions` b 
                WHERE a.`PromotionId`=b.`PromotionId` AND b.`PromotionType`='GoldHour'";
        $query=$this->db->query($sql)->result();
        return $query;
    }
    
    
    
    // thêm phần lấy list khuyến mãi packet
    public function laylist_kmpacket()
    {
        $sql=" SELECT a.*,b.`PromotionName`,b.`PromotionType`,b.`BeginDateTime`, b.`EndDateTime` 
                FROM `promotiondetails` a, `promotions` b 
                WHERE a.`PromotionId`= b.`PromotionId` AND b.`PromotionType`='KMDB'
                AND NOW() BETWEEN b.`BeginDateTime` AND b.`EndDateTime`
                ORDER BY `CreatedDate` DESC
                LIMIT 0,3 ";
        $query=$this->db->query($sql)->result();
        return $query;
    }
    public function laygiasp_theomasp($productid)
    {
        $sql="SELECT * FROM `price` WHERE `ProductID`='$productid' ORDER BY `CreatedDate` DESC";
        $query=$this->db->query($sql)->row();
        return $query;
        
    }
    public function laykm_theoproid_promotionid($proid,$promotionid)
    {
        $sql="SELECT a.*,b.`PromotionName`,b.`PromotionType`,b.`BeginDateTime`,b.`EndDateTime` 
                FROM `promotiondetails` a,`promotions` b  
                WHERE a.`PromotionId`=b.`PromotionId` AND a.`PromotionId`='$promotionid' AND a.`ProductId`='$proid' LIMIT 1";
        $query=$this->db->query($sql)->row();
        return $query;
        
    }
    
    // thêm mới comment vào ngày 14/10/2015
    public function sendcomments(){
        $comment = $_POST['content'];
        $proID   = $_POST['proID'];
        $arr = array();
        if(isset($_SESSION['AccUser'])){
            $arr = (array)$_SESSION['AccUser'];
        }
         
        $res=0;
        if(!empty($arr) ){
            $creadedby = $arr['User']->UserId;
            try{
                 $sql = "INSERT INTO `comments`(`ObjectIDD`,`Content`,`CreatedBy`,`CreatedDate`,`Status`,`Level`) VALUES('$proID','$comment','$creadedby',NOW(),'1','0') ";
                 $this->db->query($sql);
                 $res=1;
            }
            catch(exception $e){
                     $res=0;
              }
        }
        else{
            $res=0;
        }
        
        
        return $res;
    }
    
    public function sendcommentcone(){
        $comment = $_POST['content'];
        $proID   = $_POST['proID'];
        $parentID = $_POST['parentID'];
        $arr = array();
        if(isset($_SESSION['AccUser']))
         $arr = (array)$_SESSION['AccUser'];
        $res = 0;
        if(!empty($arr) ){
            $creadedby = $arr['User']->UserId;
            try{
                 $sql = "INSERT INTO `comments`(`ObjectIDD`,`Content`,`CreatedBy`,`CreatedDate`,`ParentID`,`Status`,`Level`) VALUES('$proID','$comment','$creadedby',NOW(),'$parentID','1','1') ";
                 $this->db->query($sql);
                 $res = 1;
            }
            catch(exception $e){
                     $res = 0;
              }
            
        }
        
        return $res;
    }
    //nghia viet them 22/01/2015 show khuyen mai
    public function layspkm_rand($limit)
    {
        $sql="SELECT a.`PromotionId`, b.*, d.`spaName` FROM `promotiondetails` a, `products` b, `price` c, `spa` d 
                WHERE a.`ProductId`=b.`ProductID` AND b.`ProductID`=c.`ProductID` AND c.`Status`=1 AND d.`spaID`=b.`SpaID` ORDER BY RAND() LIMIT 0,$limit";
        $query=$this->db->query($sql)->result();
        return $query;
    }
    public function layspbosungspkm_index($limit)
    {
        $sql="SELECT DISTINCT a.* FROM `products` a 
                WHERE a.`Status` = 1 AND a.`ProductID` NOT IN (SELECT DISTINCT `ProductId` FROM `promotiondetails`) order by rand() LIMIT 0,$limit";
        $query=$this->db->query($sql)->result();
        return $query;
    }
    public function layspkm_rand2($limiit)
    {
        //ham nay chi lay danh sach sp km voi loai km chi co 1 sp
        $sql="SELECT * FROM `promotions` WHERE NOW() BETWEEN `BeginDateTime` AND `EndDateTime` ORDER BY rand()";
        $query=$this->db->query($sql)->result();
        $arrspkm=array();
        if(count($query)>0)
        {
            foreach($query as $row)
            {
                $recordkm_inchitietkm=$this->countpromotionid_intbl_promotiondetail($row->PromotionId);
                $sd_intblpromotiondetail=count($recordkm_inchitietkm);
                
                if($sd_intblpromotiondetail==1 || $recordkm_inchitietkm=="1")
                {
                    $ProductId=$recordkm_inchitietkm[0]->ProductId;
                    $ttsp=$this->laysp_theomasp($ProductId);
                    if(count($ttsp)>0)
                        $arrspkm[]=$ttsp;
                    if(count($arrspkm)==$limiit || count($arrspkm)>$limiit)
                        break;
                }
            }
        }
        if(count($arrspkm)<$limiit) //bo sung sp khi spkm khong du $limit
        {
            $limiitspbosung=$limiit-count($arrspkm);
            $rowspbosung=$this->layspbosungspkm_index($limiitspbosung);
            foreach($rowspbosung as $rowbosung)
            {
                $arrspkm[]=$rowbosung;
            }
        }
        //print_r($arrspkm);die;
        return $arrspkm;
    }
    public function countpromotionid_intbl_promotiondetail($promotionid)
    {
        $sql="SELECT * FROM `promotiondetails` WHERE `PromotionId`='$promotionid'";
        $query=$this->db->query($sql)->result();
        return $query;
    }
    public function laysp_theomasp($masp)
    {
        $sql="SELECT * FROM `products` WHERE `ProductId`='$masp' and `Status` = 1";
        $query=$this->db->query($sql)->row();
        return $query;
    }
    public function laylist_khuyenmai()
    {
        $sql="SELECT a.*,b.`PromotionName`,b.`PromotionType`,b.`BeginDateTime`, b.`EndDateTime` 
                FROM `promotiondetails` a, `promotions` b 
                WHERE a.`PromotionId`=b.`PromotionId` and NOW() BETWEEN b.`BeginDateTime` AND b.`EndDateTime`";
        $query=$this->db->query($sql)->result();
        return $query;
    }
    //end nghia viet them 22/01/2015 show khuyen mai
}
?>

