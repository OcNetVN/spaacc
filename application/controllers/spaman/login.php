<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Login extends CI_Controller
{
       function __construct()
       {
            parent::__construct();
            $this->load->model('spamanagement/m_index');
            $this->load->model('spamanagement/m_user');
            $this->load->model('spamanagement/m_mail');
            $this->load->model('spamanagement/m_spa');
            $this->load->helper('language_helper');
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
          
       public function GetMenuStr($RoleId)
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
                            $str = $str."<li id=\"MenuCon".$arr_menu_cap2[$j]->MenuId."\">";
                            $str = $str. "<a href=\"". base_url($arr_menu_cap2[$j]->url) ."\">";
                            $str = $str. $arr_menu_cap2[$j]->MenuName;
                            $str = $str. "</a>";
                            $str = $str."</li>";
                        }
                        $str = $str."</ul>";
                    }
                    
                    $str = $str. "</li>";
                }
           
            return $str;
        }
        
        public function index(){
                $lang = change_language();

                $this->load->library('form_validation');
                $this->form_validation->set_rules('username','User name','required');
                $this->form_validation->set_rules('password','Password','required');
                //$this->form_validation->set_rules('captcha','Code ID','required');
                // $lang = $_SESSION['Lang'];
                
                $this->form_validation->set_message('required','<center><span style="color: red;clear: both;text-align: right;font-size: 12px;font-weight: bold;">%s is required</span></center>');
                if($this->form_validation->run()) //chay va kiem tra gia tri cua form
                {
                        $username=$this->input->post('username');
                        $password=$this->input->post('password');
                        $user=$this->m_user->lay_nguoi_dung($username,$password);
                        // print_r($user->UserId);
                        // return;
                        
                        if(!$user){
                            $_SESSION['error'] = "Sorry, we were unable to log you in. Please check your username and password are correct.";
                            redirect('spaman/login');
                        }
                        else
                        {
                            // 1 - load user
                            $arr_user = $this->m_user->lay_User_theo_id1($username);

                            // print_r($arr_user[0]->UserId);
                            // // 2 - load Object 
                            // $arr_Object = $this->m_user->lay_object_theo_ObjectID($arr_user[0]->ObjectId);
                            //  // print_r($arr_Object);
                            // // 3 - Load Role
                            // $arr_Role = $this->m_user->lay_Role_theo_RoleID($arr_user[0]->RoleId);
                            //  // print_r($arr_Role);
                            // // 4 - Load RoleMenuModule
                            // $arr_RoleMenuModule = $this->m_user->lay_RoleMenuModule_theo_RoleID($arr_user[0]->RoleId);
                            //  // print_r($arr_RoleMenuModule);
                              
                             // 5 - Load Spa
                             $arr_Spa = $this->m_spa->lay_info_Spa($arr_user[0]->UserId);
                             if(!$arr_Spa){
                                 $_SESSION['error'] = "Sorry, we were unable to log you in. Please check your username and password are correct.";
                                 redirect('spaman/login');
                             }
                             // print_r($arr_Spa);
                             // return;
                            // chuoi menu
                            //$menuStr = $this->GetMenuStr($arr_user[0]->RoleId);
                            


                            //  // láº¥y cÃ¡c module cÃ³ quyÃ¨n
                            //   $module = $this->m_index->GetModuleOfRole($arr_user[0]->RoleId);
                            // // $id_spa = $arr_user[0]->UserId;
                            $arr_session = array("spaid"=>$arr_Spa[0]->spaID,
                                                // "Spa"=>$arr_Spa[0] ,
                                                 "User"=>$arr_user[0],
                                                // "Object"=>$arr_Object[0],
                                                // "Role" => $arr_Role[0],
                                                // "ListMenu"=>$arr_RoleMenuModule,
                                                // "MenuSTR"=>$menuStr,"CacModule"=>$module
                                                );
                            $_SESSION['AccSpa']=$arr_session;
                            
                            if(isset($_SESSION['object']))
                            {
                                unset($_SESSION['object']);
                            }
                            //echo $arr_user[0]->RoleId;
                            //print($menuStr);
                           // die;
                            //$_SESSION['user_name']=$user->UserId;
                            $LastLogin=date("Y-m-d H:m:s");
                            $this->m_user->update_lastlogin_user($user->UserId,$LastLogin);

                            //$this->session->set_userdata($arr_session);
                            redirect('spaman/spa_statistics');
                        }
                    //}
                }
                $this->load->view($lang.'/spamanagement/login');
        }
        public function logout()
        {
            unset($_SESSION["AccSpa"]);

            redirect('spaman/login');
        }
}
  
?>