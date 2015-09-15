<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Index extends CI_Controller
{
       function __construct()
       {
            parent::__construct();
            $this->load->model('m_index');
            $this->load->model('m_news');
            $this->load->model('m_mail');
            $this->load->model('admin/m_user');
            $this->load->library('session'); 
            $this->load->helper('cookie');
            $this->load->view('layout');
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
           
            $res['listpro_limit4'] = $this->m_index->listpro_limit4();
            $res['loaispcon'] = $this->m_index->layloaiconsp();
            $res['MenuString'] = $this->m_index->getMenuStr();
            $res['link_spainfo'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $news =$this->m_news->GetNewsForIndex();
            $newsImg = $this->m_news->laylinkImages($news[0]->id);
            $res['HotNews'] = array("News"=>$news[0],"NewsImg"=>$newsImg);
            $res['linkyoutube'] = $this->m_mail->getSetting("LinkYoutube");
            
            // show new 3 post cho sider tin tuc
            $res['listnew'] = $this->m_news->GetNewMeLimit();
            $listnews       =   $this->m_news->GetNewMeLimit();
            $res['imageNews'] = $this->m_news->laylinkImages($listnews[0]->id);
            //if(count($res['links'])>0) echo $ra->id;
            $limitproduct=$this->m_mail->getSetting("LimitRecordProductIndex");
            
            $conditionshowproductindex=$this->m_index->GetSetting('conditionshowproductindex');
            if($conditionshowproductindex==1 || $conditionshowproductindex=="1") //random ngau nhien
            {
                $res['listproduct'] = $this->m_index->laydssp_sxtheongay($limitproduct);
            }
            else
            {
                if($conditionshowproductindex==2 || $conditionshowproductindex=="2") //lay khuyen mai randdom 
                {
                    $res['listproduct'] = $this->m_index->layspkm_rand2($limitproduct);
                    
                }
                else
                {
                    
                }
            }
            /*echo "<pre>";
                        print_r($res['listproduct']);
                    echo "</pre>";die;  */ 
            //nghia viet 26/12/2014
            $res['listspkm']=$this->m_index->layspkhuyenmai();
            // get comment ngày 12/01/2015
            $res['CommentString'] = $this->m_index->getCommentStr();
            //$this->load->view('index1',$res);
            // get sản phẩm patpect
            $res['listproPromo'] = $this->m_index->laylist_kmpacket();
            //echo "<pre>";
//            print_r($res['listproPromo']);
            
            //cookie dang nhap
            if(isset($_COOKIE["cookieuser"]) && $_COOKIE["cookieuser"]!="")
            {
                //unset($_COOKIE["cookieuser"]);
                //setcookie("cookieuser", "", time()-3600*24*30);
                //echo $_COOKIE["cookieuser"];die;
                $strcookieuser = $_COOKIE["cookieuser"];
                $arrcookieuser = explode("|",$strcookieuser);
                if(count($arrcookieuser)>1)
                {
                    $uid=$arrcookieuser[0];
                    $pwd=$arrcookieuser[1];
                    //$uid="";
                    //$pwd="";
                    //echo $uid." ".$pwd;
                    $this->login_cookie($uid,$pwd);
                }
            } 
            //end cookie dang nhap
            $this->load->view($lang.'/index1',$res);
       }
     public function TestMenu()
     {
         $res = $this->m_index->getMenuStr();
         echo $res;
     }  
       //////////////
    
    public function TestInsertSession($id)
    {
        $i = $this->m_index->bookintoSession1($id,"09/12/14","15:00");
        echo $i;// $_SESSION['Cart'];
        
    }
     public function bookintoSession()
    {
        $i = $this->m_index->bookintoSession();
        echo $i;// $_SESSION['Cart'];
        
    }
    public function TestDateTime()
    {
        //$i = $this->m_index->bookintoSession1($id,"09/12/14","15:00");
        $ngay = "09/12/14";
        $gio ="15:00";
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
            $minutes_to_add = 45;
            $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

            $TTime = $time->format('Y-m-d H:i');

            //$TTime = $temp->format('Y-m-d H:i');    
        echo "Tu luc: $Ftime  <br> Den luc: $TTime";// $_SESSION['Cart'];
        
    }
    
    public function login_cookie($userid,$pass)
    { //y chang ham loogin ma thay gi posst thi cai nay truyen tham so o ham
        if(isset($userid) && $userid!="" && isset($pass) && $pass!="")
        {
            $username = $userid;
            $password = $pass;
            //$res="";
            $user=$this->m_user->lay_nguoi_dung($username,$password);
            if(!$user)
            {
                //$res = array("Return"=>0);
            }
            else
            {
                if($user->Status == "1")
                {            
                
                 // 1 - load user
                $arr_user = $this->m_user->lay_User_theo_id1($username);
                // 2 - load Object 
                $arr_Object = $this->m_user->lay_object_theo_ObjectID($arr_user[0]->ObjectId);
                // 3 - Load Role
                $arr_Role = $this->m_user->lay_Role_theo_RoleID($arr_user[0]->RoleId);
                // 4 - Load RoleMenuModule
                $arr_RoleMenuModule = $this->m_user->lay_RoleMenuModule_theo_RoleID($arr_user[0]->RoleId);
                // chuoi menu admin
                $menuStr = $this->m_index->GetMenuStrAdmin($arr_user[0]->RoleId);
                // lấy các module có quyèn
                $module = $this->m_index->GetModuleOfRole($arr_user[0]->RoleId);
                
                
                $arr_session = array("User"=>$arr_user[0],"Object"=>$arr_Object[0],
                "Role" => $arr_Role[0], "ListMenu"=>$arr_RoleMenuModule,"MenuSTR"=>$menuStr,"CacModule"=>$module);
                $_SESSION['AccUser']= $arr_session;
                
                if(isset($_SESSION['object']))
                {
                    unset($_SESSION['object']);
                }
                //echo $arr_user[0]->RoleId;
                //print($menuStr);
               // die;
                //$_SESSION['user_name']=$user->UserId;
                $LastLogin=date("Y-m-d h:m:s");
                $this->m_user->update_lastlogin_user($user->UserId,$LastLogin);
                //$res = array("Return"=>1,"Users"=>$arr_user[0],"Objects"=>$arr_Object[0],"Modules"=>$module);
                }
                else
                {
                     //$res = array("Return"=>-1);
                }
            }
        }
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
            if($user->Status == "1")
            {            
            
             // 1 - load user
            $arr_user = $this->m_user->lay_User_theo_id1($username);
            // 2 - load Object 
            $arr_Object = $this->m_user->lay_object_theo_ObjectID($arr_user[0]->ObjectId);
            // 3 - Load Role
            $arr_Role = $this->m_user->lay_Role_theo_RoleID($arr_user[0]->RoleId);
            // 4 - Load RoleMenuModule
            $arr_RoleMenuModule = $this->m_user->lay_RoleMenuModule_theo_RoleID($arr_user[0]->RoleId);
            // chuoi menu admin
            $menuStr = $this->m_index->GetMenuStrAdmin($arr_user[0]->RoleId);
            // lấy các module có quyèn
            $module = $this->m_index->GetModuleOfRole($arr_user[0]->RoleId);
            
            
            $arr_session = array("User"=>$arr_user[0],"Object"=>$arr_Object[0],
            "Role" => $arr_Role[0], "ListMenu"=>$arr_RoleMenuModule,"MenuSTR"=>$menuStr,"CacModule"=>$module);
            $_SESSION['AccUser']= $arr_session;   
            if(isset($_SESSION['object']))
            {
                unset($_SESSION['object']);
            }
            //echo $arr_user[0]->RoleId;
            //print($menuStr);
           // die;
            //$_SESSION['user_name']=$user->UserId;
            $LastLogin=date("Y-m-d h:m:s");
            $this->m_user->update_lastlogin_user($user->UserId,$LastLogin);
            $res = array("Return"=>1,"Users"=>$arr_user[0],"Objects"=>$arr_Object[0],"Modules"=>$module);
            }
            else
            {
                 $res = array("Return"=>-1);
            }
        }
        echo json_encode($res);
    }
    
     public function ForgetPass(){
         $res = $this->m_index->forgetpass();
         echo json_encode($res);
     }
                                              
      public function checkproducttype(){
          $res = $this->m_index->checkproducttype();
          echo json_encode($res);
      } 
       public function listProductType()
       {
           $req = $this->m_index->listProductType();
           echo json_encode($req);
       }
       
       public function sendcomments(){
           $req = $this->m_index->sendcomments();
           echo json_encode($req);
      }
      
      public function sendcommentcone(){
           $req = $this->m_index->sendcommentcone();
           echo json_encode($req);
      }
    
       public function listlocation()
       {
           $req = $this->m_index->listlocation();
           echo json_encode($req);
       }
       public function nghiatestss()
	   {
			echo '<pre>';
			print_r($_SESSION['Cart']);
			echo '</pre>';
	   }
       public function register(){
            $this->load->view('register');
       }
       public function listkind()
       {
            $req = $this->m_index->listkind();
            echo json_encode($req);
       }
       public function listplaceadv()
       {
            $res['loaispcon'] = $this->m_index->listplaceadv();
            /*echo "<pre>";
            print_r($res['loaispcon']);
            echo "</pre>";
            die;*/
       }
       public function listplace()
       {
            $req = $this->m_index->listplace();
            echo json_encode($req);
       }
       public function actionlogin()
       {
            $req = $this->m_index->actionlogin();
            echo json_encode($req);
       }
       //kiem tra session user khi lan dau load trang
       public function checkuser()
       {
            if(isset($_SESSION['AccUser']['user_name']))
            {
                $res = array("check"=>"yes","user_name"=>$_SESSION['AccUser']['user_name'],"sodong"=>1);
            }
            else
            {
                $res = array("check"=>"no","user_name"=>"","sodong"=>0);
            }
            echo json_encode($res);
       }
       //thoat dang nhap user
       public function actionlogout()
       {
            if(isset($_SESSION['AccUser']['user_name']))
            {
                unset($_SESSION['AccUser']['user_name']);
                // thêm session
                $this->session->sess_destroy();
                $res = array("check"=>"yes");
            }else
                $res = array("check"=>"no");
            echo json_encode($res);
       }
       public function getdetailpro()
       {
            $req = $this->m_index->getdetailpro();
            echo json_encode($req);
       }
       public function laycmt()
       {
            //$id=$_POST['Id'];
            $id="0220141119000002";
            $req = $this->m_index->get_cmt_level1($id);
            /*print_r($req);
            echo count($req);
            die;*/
            $str="";
            if(count($req)>0)
            {
                    foreach($req as $row)
                    {
                        $str.='<div class="wrap-2cols nav-left wrap-review">';
                            $str.='<div class="col-nav">';
                                $str.='<div class="wrap-thumb" style="background-image:url('.base_url('resources/front/images/no-pic-avatar.png').');"></div>';
                            $str.='</div>';
                            $str.='<div class="col-content">';
                                $str.='<div class="content">';
                                    $str.='<table width="100%" border="0" cellspacing="0" cellpadding="2">';
                                      $str.='<tbody><tr>';
                                        $str.='<td><strong>'.$row->CreatedBy.'</strong></td>';
                                        $str.='<td align="right"><span class="small">Posted 4 weeks ago</span></td>';
                                      $str.='</tr>';
                                      $str.='<tr>';
                                        $str.='<td>&nbsp;</td>';
                                        $str.='<td align="right"><small class="small">Visisted October 2014</small></td>';
                                      $str.='</tr>';
                                      $str.='<tr>';
                                        $str.='<td colspan="2">'.$row->Content.'</td>';
                                      $str.='</tr>';
                                      $str.='<tr>';
                                        $str.='<td colspan="2" align="right"><a href="javascript:void(0)" onclick="';
                                        $str.="$('#wrap-add-comment2-popup')";
                                        $str.='.toggle(300);">Comment</a></td>';
                                      $str.='</tr>';
                                      $str.='<tr>';
                                        $str.='<td colspan="2">';
                                            $str.='<div id="wrap-add-comment2-popup" style="display: none" class="wrap-add-comment">';
                                                $str.='<form role="form">';
                                                    $str.='<div class="form-group">';
                                                        $str.='<label>N?i dung b?nh lu?n</label>';
                                                        $str.='<textarea class="form-control" rows="3"></textarea>';
                                                    $str.='</div>';
                                                    $str.='<button type="submit" class="btn btn-default pull-right">G?i b?nh lu?n</button>';
                                                $str.='</form>';
                                              $str.='</div>';
                                        $str.='</td>';
                                      $str.='</tr>';
                                      
                                    $str.='</tbody></table>';
        
                                $str.='</div>';
                            $str.='</div>';
                        $str.='</div>';
                    }
            }
            //echo $str;die;
            $res = array("check"=>"yes");
            echo json_encode($res);
       }
       public function actionregister()
       {
            $req = $this->m_index->actionregister();
            echo json_encode($req);
       }
       
       public function ReloadTimeForProduct()
       {
           $timeStep =$this->m_mail->getSetting("TimeStepForProduct");
           $req = $this->m_index->ReloadTimeForProduct($timeStep);
           $havedata = "";
           if($req!="")
           {
                $havedata = "yes";              
           }           
           $arr = array("ReturnValue"=>$req,"GotData"=>$havedata);
           echo json_encode($arr);
       }
       
       public function getvalueindex()
       {
            if(isset($_POST['producttype']))
            {
                 $type = $_POST['producttype'];
                 $sql = "SELECT * FROM `commoncode` WHERE `CommonTypeId`= 'ProductType' AND LENGTH(`CommonId`)=4 AND  `StrValue2` = '$type' ";
                 $arr = $this->db->query($sql)->result();
                 $lst = (array)$arr;
                 $str = "";
                 if(count($lst) > 0){
                     $producttype = $_POST['producttype']; 
                     //echo $producttype;
//                     die();
                 }
                 else{
                     $producttype=""; 
                 }
                    
            }
             
            if(isset($_POST['location']))
            {
                $location = $_POST['location'];
                $sql1 = "SELECT * FROM `commoncode` WHERE `CommonTypeId`='Location' AND LENGTH(`CommonId`)= 5  AND  `StrValue1` = '$location' ";
                 $arr = $this->db->query($sql1)->result();
                 $lst_location = (array)$arr;
                 $str = "";
                 if(count($lst_location) > 0){
                     $location=$_POST['location'];
                 }
                 else{
                     $location=""; 
                 }
            }
                
            if(isset($producttype)&& $producttype != ""){
                $_SESSION['indexsearch']['producttype']=$producttype;
                //print_r($_SESSION['indexsearch']['producttype']);
//                die();
            } 
                
            if(isset($location))
                $_SESSION['indexsearch']['location']=$location;
       }
       public function rememberuser()
       {
            if(isset($_POST['uid']) && isset($_POST['pwd']))
            {
                $uid =$_POST['uid'];
                $pwd =$_POST['pwd'];
                $ck=$uid."|".$pwd;
                $arr=array("uid"=>$uid,"pwd"=>$pwd);
                setcookie("cookieuser",$ck,time() + 24*3600*30); //ton tai 1 thang
                //echo json_encode($arr);
                //echo $_COOKIE["cookieuser"];die;
            }
       }
}
?>