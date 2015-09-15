<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class CheckOut extends CI_Controller
{
       function __construct()
       {
            parent::__construct();
            $this->load->model('m_checkout');
            $this->load->model('admin/m_user');
            $this->load->model('m_index');
            $this->load->model('m_mail');
       }
       
       public function index()
       {
           $lang = "vi-VN";
           if(isset($_SESSION['Lang']))
           {
              $lang = $_SESSION['Lang'];
           }
           else
           {
               $_SESSION['Lang']=$this->m_mail->getSetting("LangaugeDefault");
               //$lang= 
           }
            if(!isset($_SESSION['AccUser']) && isset($_SESSION['Cart']))
           {
                $res['MenuString'] = $this->m_index->getMenuStr();
                $res['CommentString'] = $this->m_index->getCommentStr();
                //$lang = $_SESSION['Lang'];
                $this->load->view($lang.'/checkout',$res);
           }
           else
           {
                redirect("index");
           }
       }
       public function loadeditprofile()
       {
            if(!isset($_SESSION['AccUser']) && isset($_SESSION['Cart']))
            {
                $data['MenuString'] = $this->m_index->getMenuStr();
                $req = $this->m_checkout->loadeditprofile();
                echo json_encode($req);
            }
            else
           {
               redirect("index");
           }
       }
       public function loadlocationchild()
       {
            if(!isset($_SESSION['AccUser']) && isset($_SESSION['Cart']))
            {
                $req = $this->m_checkout->loadlocationchild();
                echo json_encode($req);
            }
            else
           {
               redirect("index");
           }
       }
       public function btnsubmit()
       {
            if(!isset($_SESSION['AccUser']) && isset($_SESSION['Cart']))
            {
                $req = $this->m_checkout->btnsubmit();
				/*echo "<pre>";
					print_r($req);
				echo "</pre>";die;*/
                echo json_encode($req);
            }
            else
           {
               redirect("index");
           }
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
        public function Login()
    {
        $username = $_POST['uid'];
        $password = $_POST['pwd'];
        $res="";
        $user=$this->m_user->lay_nguoi_dung($username,$password);
        if(!$user)
        {
            $res = array("Return"=>0);
        }
        else
        {
            
             // 1 - load user
            $arr_user = $this->m_user->lay_User_theo_id1($username);
            // 2 - load Object 
            $arr_Object = $this->m_user->lay_object_theo_ObjectID($arr_user[0]->ObjectId);
            // 3 - Load Role
            $arr_Role = $this->m_user->lay_Role_theo_RoleID($arr_user[0]->RoleId);
            // 4 - Load RoleMenuModule
            $arr_RoleMenuModule = $this->m_user->lay_RoleMenuModule_theo_RoleID($username);
            // chuoi menu admin
            $menuStr = $this->GetMenuStrAdmin($arr_user[0]->RoleId);
            // lấy các module có quyèn
            $module = $this->m_index->GetModuleOfRole($arr_user[0]->RoleId);
            
            
            $arr_session = array("User"=>$arr_user[0],"Object"=>$arr_Object[0],
            "Role" => $arr_Role[0], "ListMenu"=>$arr_RoleMenuModule,"MenuSTR"=>$menuStr,"CacModule"=>$module);
            $_SESSION['AccUser']=$arr_session;
            //echo $arr_user[0]->RoleId;
            //print($menuStr);
           // die;
            //$_SESSION['user_name']=$user->UserId;
            $LastLogin=date("Y-m-d h:m:s");
            $this->m_user->update_lastlogin_user($user->UserId,$LastLogin);
            $res = array("Return"=>1,"Users"=>$arr_user[0],"Objects"=>$arr_Object[0],"Modules"=>$module);
        }
        echo json_encode($res);
    }
}
?>