<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Spadetail extends CI_Controller
{
       function __construct()
       {
            parent::__construct();
            $this->load->model('m_spadetail');
            $this->load->model('admin/m_user');
            $this->load->model('m_index');
       }
       
       public function index()
       {
            $id=$this->uri->segment(3); //id spa
            if(isset($id) && $id!="")
            {
                $this->m_spadetail->countview($id);
                $data['ttspa'] = $this->m_spadetail->getspa($id);
                $data['link_spainfo'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                if(count($data['ttspa'])>0)
                {
                    $data['timehoatdong']=$this->m_spadetail->loadtimehoatdong($id);
                    $data['info']=$this->m_spadetail->loadspainfo($id); //tien ich cua spa
                    $data['spatype']=$this->m_spadetail->layhinhthucspa_theospaid($id); //loai spa, hinh thuc spa
                    $data['spalocation'] = $this->m_spadetail->getspalocationID($id);
                    
                    $loaispcuaspa=$this->m_spadetail->loadloaisanpham($id); //loai san pham cua spa cung cap

                    if(count($loaispcuaspa)>0)
                    {
                        $arr_protype_pro=array(); //mang list product type va product cua producttype do
                        foreach($loaispcuaspa as $row)
                        {
                            $tenproducttype=$this->m_spadetail->laytenproducttypetheoid($row->ProductType);
                            $list_pro=$this->m_spadetail->loadsanpham($id,$row->ProductType);
                            if(count($list_pro)>0)
                                $arr_protype_pro[$tenproducttype->StrValue2]=$list_pro;
                        }
                        $data['arr_protype_pro']=$arr_protype_pro;
                    }
                    /*echo "<pre>";
                    print_r($data['arr_protype_pro']);
                    echo "</pre>";die;*/
                    $cmtcap1=$this->m_spadetail->loadcommentfirst($id); //load cmt cap 1 cua spa
                    if(count($cmtcap1)>0)
                    {
                        $arr_cmt=array(); //mang list product type va product cua producttype do
                        foreach($cmtcap1 as $row_cmt1)
                        {
                            $list_cmt2=$this->m_spadetail->loadcommentafter($id,$row_cmt1->id);
                            $arr_cmt[$row_cmt1->id."___".$row_cmt1->FullName."___".$row_cmt1->Content]=$list_cmt2;
                        }
                        $data['arr_cmt']=$arr_cmt;
                    }
                    /*echo "<pre>";
                    print_r($data['arr_cmt']);
                    echo "</pre>";
                    die;*/
                    $data['hinhspa']=$this->m_spadetail->loadhinhspa($id); //load list hinh cua spa
                    $data['MenuString'] = $this->m_index->getMenuStr();
                    $data['CommentString'] = $this->m_index->getCommentStr();
                    $data['listspatt'] = $this->m_spadetail->getlistspa();
                    //$data['imagefrist'] = $this->m_spadetail->getfristhinh($id);
                    $lang = "vi-VN";
                     if(isset($_SESSION['Lang']))
                          $lang = $_SESSION['Lang']; 
                       else
                           $_SESSION['Lang']=$this->m_mail->getSetting("LangaugeDefault");
                      
                    $this->load->view($lang.'/spadetail',$data);
                }
                else
                {
                    redirect('index');
                }
            }
            else
            {
                redirect('index');
            }
       }
        public function btnsendcomment()
        {
            $req = $this->m_spadetail->btnsendcomment();
            echo json_encode($req);
        }
       //dang nhap
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