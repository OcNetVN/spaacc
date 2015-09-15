<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class CheckOut1 extends CI_Controller
{
       function __construct()
       {
            parent::__construct();
            $this->load->model('m_checkout');
            $this->load->model('admin/m_user');
            $this->load->model('m_index');
            $this->db2 = $this->load->database('thebooking', TRUE);
       }
       
       public function index(){
			//nghia them session de lam cart
            /*$arr_pro1=array(
                                array("proid"=>"0100010223000002","Qty"=>2,"Price"=>500000,"FromTime"=>'2014-12-11 01:04:32',"ToTime"=>'2014-12-11 02:04:32'),
                                array("proid"=>"0220141119000001","Qty"=>1,"Price"=>700000,"FromTime"=>'2014-12-12 12:55:32',"ToTime"=>'2014-12-11 13:55:32')
                                );
            $arr_spa1=array(
                            "spaid"=>"3320141118000001",
                            "list_product"=>$arr_pro1
                            );
            $arr_pro2=array(
                                array("proid"=>"0220141119000004","Qty"=>1,"Price"=>400000,"FromTime"=>'2014-12-10 07:40:32',"ToTime"=>'2014-12-11 08:40:32'),
                                array("proid"=>"0100010223000005","Qty"=>1,"Price"=>200000,"FromTime"=>'2014-12-12 05:15:32',"ToTime"=>'2014-12-11 06:15:32'),
                                array("proid"=>"0220141204000001","Qty"=>3,"Price"=>900000,"FromTime"=>'2014-12-15 12:23:32',"ToTime"=>'2014-12-11 13:23:32')
                                );
            $arr_spa2=array(
                            "spaid"=>"3320141118000003",
                            "list_product"=>$arr_pro2
                            );
            $arr_spa=array();
            $arr_spa[]=$arr_spa1;
            $arr_spa[]=$arr_spa2;
            $_SESSION['Cart']=$arr_spa;*/
            /*echo "<pre>";
            print_r($_SESSION['Cart']);
            echo "</pre>";die;*/
            /*$arr_sanpham=array(
                            //array("SpaID","ProductID","Qty","Price","Status","FromTime","ToTime"),
                            array("spaName"=>"The Beauty Lounge London Ltd, Hounslow","SpaAdd"=>"114 Nguyen Du, Q3", "ProductID"=>"0100010223000002","ProductName"=>"Spa tối ngày sáng đêm","Qty"=>"2","Price"=>"1500000","AmtBT"=>"3000000","FromTime"=>"2014-12-11 01:04:32","ToTime"=>"2014-12-11 03:04:32"),
                            array("spaName"=>"Fami Hair & Beauty Institute, Ilford","SpaAdd"=>"214 le loi, Q1","ProductID"=>"0100010223000013","ProductName"=>"Spa sáng ngày tối đêm","Qty"=>"3","Price"=>"2500000","AmtBT"=>"7500000","FromTime"=>"2014-12-11 04:04:32","ToTime"=>"2014-12-11 05:15:32"),
                            array("spaName"=>"Nhà của Nghĩa", "SpaAdd"=>"1 Nguyen Trai, Q1","ProductID"=>"0100010223000005","ProductName"=>"Massage cả đêm","Qty"=>"3","Price"=>"3000000","AmtBT"=>"9000000","FromTime"=>"2014-12-11 12:25:32","ToTime"=>"2014-12-11 16:55:19")
            );
            $_SESSION['Cart']=$arr_sanpham;*/
            //echo "<pre>";
            //print_r($_SESSION['Cart']);
            //echo "</pre>";
            //echo "<br><br>";
            
            //nghia viet them 13/05/2015
            //if((isset($_SESSION['AccUser']) || isset($_SESSION['object'])) && isset($_SESSION['Cart']))
           if(isset($_SESSION['Cart']))
           {
                $res['listpro_limit4'] = $this->m_index->listpro_limit4();
                $res['loaispcon'] = $this->m_index->layloaiconsp();
                $res['MenuString'] = $this->m_index->getMenuStr();
                $res['CommentString'] = $this->m_index->getCommentStr();
                //nghia viet them theo ss cart moi
                $arr_session=array(); //chua tat ca thong tin day du cua session cart
                foreach($_SESSION['Cart'] as $row_cart)
                {
                    $spaid=$row_cart['spaid']; 
                    $ttspa=$this->m_checkout->layttspatheoid($spaid); // lay thong tin cua spa theo id
                    
                    $arr_product=array();
                    foreach($row_cart['list_product'] as $key=>$row_pro) //lay thong tin day du cua san pham theo id san pham
                    {
                        $onerow_pro=$this->m_checkout->layproducttheoid($row_pro['ProductID'],$row_pro['Qty'],$row_pro['Price'],$row_pro['FromTime'],$row_pro['ToTime']);
                        //$arr_product[]=$onerow_pro;
                        array_push($arr_product,$onerow_pro);
                    }
                    $onerow_spa=array(
                                    "spa"=>$ttspa,
                                    "list_pro"=>$arr_product
                                    ); //gom lai thanh 1 dong chua day du thong tin cua spa va sp cua spa do
                     array_push($arr_session,$onerow_spa);
                    
                }
                //echo "<pre>";
                //print_r($arr_session);
                //echo "</pre>";die;
                
                $_SESSION['check1']=$arr_session;
                $res['list_info_session']=$arr_session;
                //end nghia viet them theo ss cart moi
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
                $this->load->view($lang.'/checkout1',$res);
           }
           else
           {
                //nghia viet them 13/05/2015            
                /*if((!isset($_SESSION['AccUser']) || !isset($_SESSION['object'])) && isset($_SESSION['Cart']))
                    redirect("checkout");
                else*/
                    redirect("index");
           }
       }
     public function TestMenu()
     {
         $res = $this->m_index->getMenuStr();
         echo $res;
     }  
       //////////////
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
    
       
       public function listProductType()
       {
           $req = $this->m_index->listProductType();
           echo json_encode($req);
       }
       
       public function listlocation()
       {
           $req = $this->m_index->listlocation();
           echo json_encode($req);
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
            if(isset($_SESSION['AccUser']) || isset($_SESSION['object']))
            {
                $res = array("check"=>"yes","user_name"=>$_SESSION['AccUser'],"sodong"=>1);
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
            if(isset($_SESSION['AccUser']) || isset($_SESSION['object']))
            {
                unset($_SESSION['AccUser']);
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
       //nghia viet them cho checkout1
       //nghia viet them cho checkout1
        public function changeQty_step1()
        {
            if((isset($_SESSION['AccUser']) || isset($_SESSION['object'])) && isset($_SESSION['Cart']))
           {
                $req = $this->m_checkout->changeQty_step1();
                echo json_encode($req);
           }
           else
           {
               redirect("index");
           }
        }
        public function deletesubcart()
        {
            if((isset($_SESSION['AccUser']) || isset($_SESSION['object'])) && isset($_SESSION['Cart']))
           {
                $req = $this->m_checkout->deletesubcart();
                echo json_encode($req);
           }
           else
           {
               redirect("index");
           }
        }
        public function getmoneymemberbypoint()
        {
            if((isset($_SESSION['AccUser']) || isset($_SESSION['object'])) && isset($_SESSION['Cart']))
           {
                $req = $this->m_checkout->getmoneymemberbypoint();
                echo json_encode($req);
           }
           else
           {
               redirect("index");
           }
        }
        public function gotostep2(){
            if(isset($_SESSION['Cart']))
           {
                $_SESSION['checkout1']="checkout1";
                unset($_SESSION['check1']);
                $req = $this->m_checkout->gotostep2();
                $arr = array("Pro"=>$req);
                echo json_encode($arr);
            }
           else
           {
               redirect("index");
           }
        }
        //nghia viet them 16/1/2015
        public function getpointuser()
        {
             if((isset($_SESSION['AccUser']) || isset($_SESSION['object'])) && isset($_SESSION['Cart']))
               {
                    $req = $this->m_checkout->getpoint();
                    echo json_encode($req);
               }
               else
               {
                   redirect("index");
               }
        }
        public function applypointdiscount()
        {
            if((isset($_SESSION['AccUser']) || isset($_SESSION['object'])) && isset($_SESSION['Cart']))
               {
                    $req = $this->m_checkout->applypointdiscount();
                    echo json_encode($req);
               }
               else
               {
                   redirect("index");
               }
        }
        public function applyoutstandingdiscount()
        {
            if((isset($_SESSION['AccUser']) || isset($_SESSION['object'])) && isset($_SESSION['Cart']))
               {
                    $req = $this->m_checkout->applyoutstandingdiscount();
                    echo json_encode($req);
               }
               else
               {
                   redirect("index");
               }
        }
        public function loaddiemuser()
        {
            if((isset($_SESSION['AccUser']) || isset($_SESSION['object'])) && isset($_SESSION['Cart']))
               {
                    $req = $this->m_checkout->loaddiemuser();
                    echo json_encode($req);
               }
               else
               {
                   redirect("index");
               }
        }
        public function loadoutstandinguser()
        {
            if((isset($_SESSION['AccUser']) || isset($_SESSION['object'])) && isset($_SESSION['Cart']))
               {
                    $req = $this->m_checkout->loadoutstandinguser();
                    echo json_encode($req);
               }
               else
               {
                   redirect("index");
               }
        }
        public function xoasessiongiamgia_diem()
        {
            if(isset($_SESSION['Cart']))
               {
                    if(isset($_SESSION['discount']))
                        unset($_SESSION['discount']);
                    if(isset($_SESSION['discountpoint']))
                        unset($_SESSION['discountpoint']);
               }
               else
               {
                   redirect("index");
               }
        }
        public function getmaxpointdiscount()
        {
            if((isset($_SESSION['AccUser']) || isset($_SESSION['object'])) && isset($_SESSION['Cart']))
           {
               $req = $this->m_checkout->getmaxpointdiscount();
               echo json_encode($req);
           }
           else
           {
               redirect("index");
           }
        }
        public function checkissetsession()
        {
            if((isset($_SESSION['AccUser']) || isset($_SESSION['object'])) && isset($_SESSION['Cart']))
           {
                echo 1;
           }
           else
           {
               echo 0;
           }
        }
}
?>