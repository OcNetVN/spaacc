<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//include the facebook.php from libraries directory
require_once APPPATH.'libraries/facebook/facebook.php';

class Register extends CI_Controller
{
       function __construct()
       {
            parent::__construct();
            $this->db2 = $this->load->database('thebooking', TRUE);
            $this->load->model('m_index');
            $this->load->model('m_register');
            $this->load->model('admin/m_user');
            $this->load->model('m_mail');  
            $this->load->library('session');  //Load the Session 
            $this->config->load('facebook'); //Load the facebook.php file which is located in config directory
            
        }
        
        function GetMenuCap1($roleID,$moduleID) 
        {
              $sql ="SELECT a.*,b.`MenuName`,b.`Description`,b.`url` FROM `rolemenumodule` a INNER JOIN `menu` b ON a.`MenuId`=b.`MenuId`  WHERE a.`RoleId`='$roleID' AND a.`ModuleId`='$moduleID' AND LENGTH(a.`MenuId`)=2";
              $res= $this->db->query($sql)->result();
              $arr = (array)$res;
              return $arr;
              //print_r($arr);
        } 
          
    function GetMenuCap2($roleID, $Cap1) 
      {
          $sql ="SELECT a.*,b.`MenuName`,b.`Description`,b.`url` FROM `rolemenumodule` a LEFT JOIN `menu` b ON a.`MenuId`=b.`MenuId`  WHERE a.`RoleId`='$roleID' AND LENGTH(a.`MenuId`)=4 AND   LEFT(a.`MenuId`,2)= '$Cap1'";
          $res= $this->db->query($sql)->result();
          $arr = (array)$res;
          return $arr;
          //print_r($arr);
      }
          
    function GetMenuStrAdmin($RoleId)
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
        
        public function GuiMailRegister($uid)
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
            //$link   = "http://$_SERVER[HTTP_HOST]/nhaplieuspa/register/kichhoat/".$objectId;//[Link_Review]
            $link     = "http://$_SERVER[HTTP_HOST]/".base_url("register/kichhoat/".$objectId);
            $mail->addAddress($guiden, $Ten);              
            $mail->addCC('thuan.nguyenngockim@gmail.com');
            $mail->addCC('cs@thebooking.vn');
            //$mail->addCC('occbuu@gmail.com');
            $mail->isHTML(true);                                 
            $mail->Subject = 'Dang ky thanh vien thanh cong...';
            $mail->CharSet = "utf-8";
            $body = $this->m_mail->GetMailTemplate("RegisterSuccess");
            $body = str_replace("[FullName]",$Ten, $body);
            $body = str_replace("[UserID]",$guiden, $body);
            $body = str_replace("[Object_FullName]",$Ten, $body);
            $body = str_replace("[Tel]",$Tel, $body);
            $body = str_replace("[Link_Active]",$link, $body);
            $body = str_replace("[TongDaiHotLine]","(08) 62555657", $body);
            $body = str_replace("[EmailHotLine]","cs@thebooking.vn", $body);
            $mail->Body    = $body;
            $mail->AltBody = 'Bạn đã đăng ký thành công!!';
            if(!$mail->send()) {                   
               return 0;
            } else {                     
                return 1;
            }
        }
        
        public function kichhoat($id){
           $lang = "vi-VN";
           if(isset($_SESSION['Lang']))
           {
              $lang = $_SESSION['Lang'];
           }
           else
           {
               $_SESSION['Lang']=$this->m_mail->getSetting("LangaugeDefault");
           }
            $res['message'] = $this->m_register->kichhoat($id);
            $this->load->view($lang.'/v_kichhoat',$res);
            //redirect("index");
        }
        
        public function index(){
          $lang = "vi-VN";
           if(isset($_SESSION['Lang']))
           {
              $lang = $_SESSION['Lang'];
           }
           else
           {
               $_SESSION['Lang']=$this->m_mail->getSetting("LangaugeDefault");
           }
            $res['MenuString'] = $this->m_index->getMenuStr();
            $res['CommentString'] = $this->m_index->getCommentStr();
            $res['ProvinceString'] = $this->m_register->get_provincel();
            //$lang = $_SESSION['Lang'];
            $this->load->view($lang.'/register',$res);
        }
        
        public function signup(){
            $req = $this->m_register->signup();
           // $check = $this->GuiMailRegister($req);
            
            if($req == ""){
                $res= 0;
            }
            else{
                $res = 1;
            }
            //GuiMailRegister
            $GuiMailTC = $this->GuiMailRegister($req);
            $ret = array("GuiMailTC"=>$GuiMailTC,"ThemMoiTC"=>$res);
            echo json_encode($ret);
        }
        
        public function checkemail(){
            $res = $this->m_register->checkemail();
            echo json_encode($res);
        }
        
        function logout(){
            $base_url=$this->config->item('base_url'); //Read the baseurl from the config.php file
            $this->session->sess_destroy();  //session destroy
            header('Location: '.$base_url);  //redirect to the home page
        
        }
        
        public function fblogin(){
            $fb_data =$_POST['DuLieuFB'];
            $data = json_decode($fb_data);
            $res = array("Return"=>0);
            $uid= $data->id;
            $sql ="SELECT * FROM `users` WHERE `UserId`='$uid' AND `UserType`='FB'";
            $req = $this->db2->query($sql)->result();
            $arr_Usr = (array) $req;
            if(count($arr_Usr)>0)
            {
                // dang nhap luon ko can Insert vao db
                // da co du lieu trog he thong
                if($arr_Usr[0]->Status == "1")
                {      
                    // 1 - load user
                    $arr_user = $this->m_user->lay_User_theo_id1($uid);
                    // 2 - load Object 
                    $arr_Object = $this->m_user->lay_object_theo_ObjectID($arr_user[0]->ObjectId);
                    // 3 - Load Role
                    $arr_Role = $this->m_user->lay_Role_theo_RoleID($arr_user[0]->RoleId);
                    // 4 - Load RoleMenuModule
                    $arr_RoleMenuModule = $this->m_user->lay_RoleMenuModule_theo_RoleID($arr_user[0]->RoleId);
                    // chuoi menu admin
                    $menuStr = $this->GetMenuStrAdmin($arr_user[0]->RoleId);
                    // lấy các module có quyèn
                    $module = $this->m_index->GetModuleOfRole($arr_user[0]->RoleId);
                    
                    
                    $arr_session = array("User"=>$arr_user[0],"Object"=>$arr_Object[0],
                    "Role" => $arr_Role[0], "ListMenu"=>$arr_RoleMenuModule,"MenuSTR"=>$menuStr,"CacModule"=>$module);
                    $_SESSION['AccUser']=$arr_session;
                    
                    if(isset($_SESSION['object']))
                    {
                        unset($_SESSION['object']);
                    }
                    $LastLogin=date("Y-m-d h:m:s");
                    $this->m_user->update_lastlogin_user($arr_user[0]->UserId,$LastLogin);
                    //redirect('index');
                    $res = array("Return"=>1);
                }
                else
                {
                     $res = array("Return"=>-1);
                }
            }
            else
            {
                // dang nhap luon va  Insert vao db
                // them data base (user, Object)
                $email           = $data->email;
                $password          = null;
                $fullname          = $data->name;
               // $preAdd            = $data->hometown->name;
               // $TemAdd            = $data->location->name;
                $preAdd             = '';
                $TemAdd             = '';
                $province          = '';
                $image             = '';
                $Tel               = '';
                $Dob = "";
                if(isset($data->birthday))
                $Dob               = $data->birthday;
                $cmnd              = '';
                $pidissue          = '';
                $pidi              = '';
                $fax               = '';
                $website           = '';
                $note              = "FB links: ". $data->link . " <br/> ";
                //$note = $note . " Locale: ". $data->locale . " <br/> ";
                //$note = $note . " timezone: ". $data->timezone . " <br/> ";
                //$note = $note . " updated_time: ". $data->updated_time . " <br/> ";
                //$note = $note . " work: ". json_encode($data->work) . " <br/> ";
                $genter =0;
                if($data->gender == "female")
                {
                   $genter = 1; 
                }
                
                //$arr = (array)$_SESSION['AccUser'];
    //            if(isset($arr))
    //            $createdby = $arr['User']->UserId;
                $ObjectId = "";
               
                    try{
                        $this->db2->trans_start();
                        //get Promotion ID
                        $ObjectId = $this->m_register->getObjectID();
                        //insert table objects
                        $sql = "INSERT INTO `objects` (`ObjectId`, `ObjectGroup`, `ObjectType`, `FullName`, `PID`, `PIDState`, `PIDIssue`, `DoB`, `PoB`, `PerAdd`, `TemAdd`, `Gender`, `ProvinceId`, `Tel`, `Fax`, `Email`, `Website`, `TaxCode`, `Note`, `Status`, `CreatedBy`, `CreatedDate`) VALUES ('$ObjectId', '01', '01', '$fullname', '$pidi', '', '$pidissue', '$Dob', '', '$preAdd', '$TemAdd', $genter, '$province', '$Tel', '$fax', '$email', '$website', '', '$note', '1', 'admin',NOW())";
                        $this->db2->query($sql);
                         // insert table user   
                        $sql1 = "INSERT INTO `users` (`UserId`, `Pwd`, `ObjectId`, `Status`, `CreatedBy`, `CreatedDate`, `RoleId`, `ScoreBalance`,`UserType`)VALUES ('$uid', '$password', '$ObjectId', '1', 'admin',NOW(), 'member',0,'FB');";
                        $this->db2->query($sql1);
                        // select userID
                        $this->db2->trans_complete();
                        if ($this->db2->trans_status() === FALSE)
                        {
                            $this->db2->trans_rollback();
                        }
                       
                        // 1 - load user
                        $arr_user = $this->m_user->lay_User_theo_id1($uid);
                        // 2 - load Object 
                        $arr_Object = $this->m_user->lay_object_theo_ObjectID($arr_user[0]->ObjectId);
                        // 3 - Load Role
                        $arr_Role = $this->m_user->lay_Role_theo_RoleID($arr_user[0]->RoleId);
                        // 4 - Load RoleMenuModule
                        $arr_RoleMenuModule = $this->m_user->lay_RoleMenuModule_theo_RoleID($arr_user[0]->RoleId);
                        // chuoi menu admin
                        $menuStr = $this->GetMenuStrAdmin($arr_user[0]->RoleId);
                        // lấy các module có quyèn
                        $module = $this->m_index->GetModuleOfRole($arr_user[0]->RoleId);
                        
                        
                        $arr_session = array("User"=>$arr_user[0],"Object"=>$arr_Object[0],
                        "Role" => $arr_Role[0], "ListMenu"=>$arr_RoleMenuModule,"MenuSTR"=>$menuStr,"CacModule"=>$module);
                        $_SESSION['AccUser']= $arr_session;
                        //echo $arr_user[0]->RoleId;
                        //print($menuStr);
                       // die;
                        //$_SESSION['user_name']=$user->UserId;
                        $LastLogin=date("Y-m-d h:m:s");
                        $this->m_user->update_lastlogin_user($arr_user[0]->UserId,$LastLogin);
                        
                        //redirect('index');
                        $res = array("Return"=>1);
                    }
                    catch(exception $e)
                    {
                        $res = array("Return"=>0);
                    }                  
                    
            }
            echo json_encode($res);
        } 
        
        public function googlelogin1(){
            $fb_data =$_POST['DuLieuGoogle'];
            if(isset($_SESSION['AccUser']))
            {
                
            }
            else
            {
                 $this->googlelogin($fb_data)   ;
            }
            //$data = json_decode($fb_data);
            //echo json_encode($data);
         }   
          
        public function googlelogin($fb_data){
            //$fb_data =$_POST['DuLieuGoogle'];
            $data = json_decode($fb_data);
            $res = array("Return"=>0);;
            $uid= $data->id;
            $sql ="SELECT * FROM `users` WHERE `UserId`='$uid' AND `UserType`='GP'";
            $req = $this->db2->query($sql)->result();
            $arr_Usr = (array) $req;
            if(count($arr_Usr)>0)
            {
                // dang nhap luon ko can Insert vao db
                // da co du lieu trog he thong
                if($arr_Usr[0]->Status == "1")
                {      
                    // 1 - load user
                    $arr_user = $this->m_user->lay_User_theo_id1($uid);
                    // 2 - load Object 
                    $arr_Object = $this->m_user->lay_object_theo_ObjectID($arr_user[0]->ObjectId);
                    // 3 - Load Role
                    $arr_Role = $this->m_user->lay_Role_theo_RoleID($arr_user[0]->RoleId);
                    // 4 - Load RoleMenuModule
                    $arr_RoleMenuModule = $this->m_user->lay_RoleMenuModule_theo_RoleID($arr_user[0]->RoleId);
                    // chuoi menu admin
                    $menuStr = $this->GetMenuStrAdmin($arr_user[0]->RoleId);
                    // lấy các module có quyèn
                    $module = $this->m_index->GetModuleOfRole($arr_user[0]->RoleId);
                    
                    
                    $arr_session = array("User"=>$arr_user[0],"Object"=>$arr_Object[0],
                    "Role" => $arr_Role[0], "ListMenu"=>$arr_RoleMenuModule,"MenuSTR"=>$menuStr,"CacModule"=>$module);
                    $_SESSION['AccUser']=$arr_session;
                    
                    if(isset($_SESSION['object']))
                    {
                        unset($_SESSION['object']);
                    }
                    $LastLogin=date("Y-m-d h:m:s");
                    $this->m_user->update_lastlogin_user($arr_user[0]->UserId,$LastLogin);
                    //redirect('index');
                    $res = array("Return"=>1);
                }
                else
                {
                     $res = array("Return"=>-1);
                }
            }
            else
            {
                // dang nhap luon va  Insert vao db
                // them data base (user, Object)
                $email           = "";
                if(isset($data->emails[0]))
                {
                    $email           = $data->emails[0]->value;
                }
                $password          = null;
                $fullname          = "";
                if(isset($data->displayName))
                {
                    $fullname          = $data->displayName;
                }
                $preAdd            = null;
                $TemAdd            = null;
                $province          = '';
                $image             = "";
                if(isset($data->image->url))
                {
                    $image             = $data->image->url;
                }
                $Tel               = '';
                $Dob               = null;
                $cmnd              = '';
                $pidissue          = '';
                $pidi              = '';
                $fax               = '';
                $website           = '';
                $note              = "";
                if(isset($data->url))
                {
                    $note              = "Google Plus links: ". $data->url . " <br/> ";
                }
                $genter =0;
                
                if(isset($data->gender) && $data->gender == "female")
                {
                   $genter = 1; 
                }
                
                //$arr = (array)$_SESSION['AccUser'];
    //            if(isset($arr))
    //            $createdby = $arr['User']->UserId;
                $ObjectId = "";
               
                    try{
                        $this->db2->trans_start();
                        //get Promotion ID
                        $ObjectId = $this->m_register->getObjectID();
                        //insert table objects
                        $sql = "INSERT INTO `objects` 
                        (`ObjectId`, `ObjectGroup`, `ObjectType`, `FullName`, `PID`, `PIDState`, `PIDIssue`, `DoB`, `PoB`, `PerAdd`, `TemAdd`, `Gender`, `ProvinceId`, `Tel`, `Fax`, `Email`, `Website`, `TaxCode`, `Note`, `Status`, `CreatedBy`, `CreatedDate`) 
                 VALUES ('$ObjectId', '01', '01', '$fullname', '$pidi', NULL, '$pidissue', '$Dob', '', '$preAdd', '$TemAdd', $genter, '$province', '$Tel', '$fax', '$email', '$website', '', '$note', '1', 'admin',NOW())";
                        $this->db2->query($sql);
                         // insert table user   
                        $sql1 = "INSERT INTO `users` 
                        (`UserId`, `Pwd`, `ObjectId`, `Status`, `CreatedBy`, `CreatedDate`, `RoleId`, `ScoreBalance`,`UserType`) 
                 VALUES ('$uid', '$password', '$ObjectId', '1', 'admin',NOW(), 'member',0,'GP');";
                        $this->db2->query($sql1);
                        // Insert IMAGE
                        $sql2 = "INSERT INTO `objectlinks` (`ObjectIDD`,`URL`,`Type`,`Status`,`UploadedBy`,`UploadedDate`) 
                                               VALUES('$uid','$image','MEMBER','1','$uid',NOW());";
                        $this->db2->query($sql2);
                        $this->db2->trans_complete();
                        if ($this->db2->trans_status() === FALSE)
                        {
                            $this->db2->trans_rollback();
                        }
                       
                        // 1 - load user
                        $arr_user = $this->m_user->lay_User_theo_id1($uid);
                        // 2 - load Object 
                        $arr_Object = $this->m_user->lay_object_theo_ObjectID($arr_user[0]->ObjectId);
                        // 3 - Load Role
                        $arr_Role = $this->m_user->lay_Role_theo_RoleID($arr_user[0]->RoleId);
                        // 4 - Load RoleMenuModule
                        $arr_RoleMenuModule = $this->m_user->lay_RoleMenuModule_theo_RoleID($arr_user[0]->RoleId);
                        // chuoi menu admin
                        $menuStr = $this->GetMenuStrAdmin($arr_user[0]->RoleId);
                        // lấy các module có quyèn
                        $module = $this->m_index->GetModuleOfRole($arr_user[0]->RoleId);
                        
                        
                        $arr_session = array("User"=>$arr_user[0],"Object"=>$arr_Object[0],
                        "Role" => $arr_Role[0], "ListMenu"=>$arr_RoleMenuModule,"MenuSTR"=>$menuStr,"CacModule"=>$module);
                        $_SESSION['AccUser']= $arr_session;
                        //echo $arr_user[0]->RoleId;
                        //print($menuStr);
                       // die;
                        //$_SESSION['user_name']=$user->UserId;
                        $LastLogin=date("Y-m-d h:m:s");
                        $this->m_user->update_lastlogin_user($arr_user[0]->UserId,$LastLogin);
                        
                        //redirect('index');
                        $res = array("Return"=>1);
                        //redirect("index");
                    }
                    catch(exception $e)
                    {
                        $res = array("Return"=>0,"Error"=> $e);
                    }                  
                    
            }
            echo json_encode($res);
        }
       
}
?>