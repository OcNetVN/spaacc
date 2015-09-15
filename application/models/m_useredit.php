<?php
class M_useredit extends CI_Model{
    public $errorStr;
    private $db2; 
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('thebooking', TRUE);
    }
    
    public function loadeditprofile()
    {
        $query="";
        $sodong_location_now=0;
        $query_location_now="";
        $sodong_locationparent=0;
        $query_locationparent="";
        
        $userid=$_SESSION['AccUser']['User']->UserId;
        $sql="SELECT a.`UserId`,b.* FROM `users` a, `objects` b WHERE a.`ObjectId`=b.`ObjectId` AND a.`UserId`='$userid'";
        $query=$this->db2->query($sql)->result();
        $sodong = count($query);
        
        /*echo "<pre>";
        print_r($query);
        echo "</pre>";die;*/
        //location hien tai
        $location_nowid = $query[0]->ProvinceId;
        if(isset($location_nowid) && $location_nowid!="")
        {
            $sql_location_now = "SELECT * FROM `commoncode` WHERE `CommonTypeId`='LOCATION' AND CommonId= '$location_nowid'  order by CommonId desc";
            $query_location_now=$this->db->query($sql_location_now)->result();
            $sodong_location_now=count($query_location_now);
            
            $sql_locationparent = "SELECT * FROM `commoncode` WHERE `CommonId`= LEFT('$location_nowid',3) and `CommonTypeId`='LOCATION' order by CommonId desc";
            $query_locationparent=$this->db->query($sql_locationparent)->result();
            $sodong_locationparent=count($query_locationparent);
            
            //lay location 
            $id_parent=$query_locationparent[0]->CommonId;
            $sql_location_first = "SELECT * FROM `commoncode` WHERE `CommonTypeId`='LOCATION' AND LENGTH(`CommonId`)= 3 and CommonId <> '$id_parent'  order by CommonId desc";
            $query_location_first=$this->db->query($sql_location_first)->result();
            $sodong_location_first = count($query_location_first);
            
            //laylocationchild
            $parent_id = $query_locationparent[0]->CommonId;
            $id_child=$query_location_now[0]->CommonId;
            $sql_locationchild = "SELECT * FROM `commoncode` WHERE `CommonId` like '$parent_id%' AND LENGTH(`CommonId`)=5 and CommonId <>'$id_child'";
            $query_locationchild=$this->db->query($sql_locationchild)->result();
            $sodong_locationchild=count($query_locationchild);
        }
        else
        {
            //lay location 
            $sql_location_first = "SELECT * FROM `commoncode` WHERE `CommonTypeId`='LOCATION' AND LENGTH(`CommonId`)= 3  order by CommonId desc";
            $query_location_first=$this->db->query($sql_location_first)->result();
            $sodong_location_first = count($query_location_first);
            
            //laylocationchild
            $parent_id = $query_location_first[0]->CommonId;
            $sql_locationchild = "SELECT * FROM `commoncode` WHERE `CommonId` like '$parent_id%' AND LENGTH(`CommonId`)=5";
            $query_locationchild=$this->db->query($sql_locationchild)->result();
            $sodong_locationchild=count($query_locationchild);
        }
        //lay hinh profile
        $objid=$query[0]->ObjectId;
        $sql_hinh="SELECT * FROM `objectlinks` WHERE `ObjectIDD`='$objid' ORDER BY id";
        $query_hinh=$this->db2->query($sql_hinh)->result();
        $sodong_hinh=count($query_hinh);
        
        $res = array("rowuser"=>$query,"sodong"=>$sodong,
                    "rowhinh"=>$query_hinh,"sodong_hinh"=>$sodong_hinh,
                    "first_location"=>$query_location_first, //list location cap 1
                    "sodong_first_location"=>$sodong_location_first,
                    "locationparent"=>$query_locationparent, ////lay location cap 1 hien tai
                    "sodong_locationparent"=>$sodong_locationparent,
                    "locationchild"=>$query_locationchild, //list location cap 2 theo cap id cap 1
                    "sodong_locationchild"=>$sodong_locationchild, 
                    "locationchild_now"=>$query_location_now, //lay location cap 2 hien tai
                    "sodong_locationchild_now"=>$sodong_location_now); 
        return $res;
    }
    public function loadlocationchild()
    {
        $Locationparentid=$_POST['Locationparentid'];
        $sql_locationchild = "SELECT * FROM `commoncode` WHERE `CommonId` like '$Locationparentid%' AND LENGTH(`CommonId`)=5";
        $query_locationchild=$this->db->query($sql_locationchild)->result();
        $sodong_locationchild=count($query_locationchild);
        $res = array("lst"=>$query_locationchild,"sodong"=>$sodong_locationchild);
        return $res;
    }
    public function btnsave()
    {
            $query=-1;
            $tbwebsite="";
            $tbngaycap="";
            $tbngaysinh="";
            $flagngaycap=0;
            $flagngaysinh=0;
            $userid=$_SESSION['AccUser']['User']->UserId;
            $dinputtel="";
            if(isset($_POST['dinputtel']))
                $dinputtel = $_POST['dinputtel'];
            $dse_dis = $_POST['dse_dis'];
            $dinputadd="";
            if(isset($_POST['dinputadd']))
                $dinputadd = $_POST['dinputadd'];
            $dinputname="";
            if(isset($_POST['dinputname']))
                $dinputname = $_POST['dinputname'];
            $dinputcmnd="";
            if(isset($_POST['dinputcmnd']))
                $dinputcmnd = $_POST['dinputcmnd'];
            $dinputngaycap="";
            if(isset($_POST['dinputngaycap']))
                $dinputngaycap = $_POST['dinputngaycap'];
            $dinputnoicap="";
            if(isset($_POST['dinputnoicap']))
                $dinputnoicap = $_POST['dinputnoicap'];
            $dinputngaysinh="";
            if(isset($_POST['dinputngaysinh']))
                $dinputngaysinh = $_POST['dinputngaysinh'];
            $dinputnoisinh="";
            if(isset($_POST['dinputnoisinh']))
                $dinputnoisinh = $_POST['dinputnoisinh'];
            $dinputtamtru="";
            if(isset($_POST['dinputtamtru']))
                $dinputtamtru = $_POST['dinputtamtru'];
            $dinputthuongtru="";
            if(isset($_POST['dinputthuongtru']))
                $dinputthuongtru = $_POST['dinputthuongtru'];
            $dse_gander=1;
            if(isset($_POST['dse_gander']))
                $dse_gander = $_POST['dse_gander'];
            $dinputfax="";
            if(isset($_POST['dinputfax']))
                $dinputfax = $_POST['dinputfax'];
            $dinputwebsite="";
            if(isset($_POST['dinputwebsite']))
                $dinputwebsite = $_POST['dinputwebsite'];
            $dinputmsthue="";
            if(isset($_POST['dinputmsthue']))
                $dinputmsthue = $_POST['dinputmsthue'];
            $dinputghichu="";
            if(isset($_POST['dinputghichu']))
                $dinputghichu = $_POST['dinputghichu'];
            $user=$this->layusertheouserid($userid);
            $objectid=$user->ObjectId;
            $object=$this->layobjecttheouserid($userid);
            
                if($dinputngaycap!="")
                {
                    $arr_ngaycap=explode("/",$dinputngaycap);
                    if(count($arr_ngaycap)==3)
                    {
                        $thang=$arr_ngaycap[0];
                        $ngay=$arr_ngaycap[1];
                        $nam=$arr_ngaycap[2];
                        if(checkdate($thang,$ngay,$nam)) // ham kiem tra ngay thang nam hop le
        				    $trngaycap=$nam."-".$thang."-".$ngay;
                        else
                            $flagngaycap=-1;
                    }
                    else
                        $flagngaycap=-1;
                }
                else
                    $trngaycap="";
                    
                if($dinputngaysinh!="")
                {
                    $arr_ngaysinh=explode("/",$dinputngaysinh);
                    if(count($arr_ngaysinh)==3)
                    {
                        $thangs=$arr_ngaysinh[0];
                        $ngays=$arr_ngaysinh[1];
                        $nams=$arr_ngaysinh[2];
                        if(checkdate($thangs,$ngays,$nams)) // ham kiem tra ngay thang nam hop le
        				    $trngaysinh=$nams."-".$thangs."-".$ngays;
                        else
                            $flagngaysinh=-1;
                    }
                    else
                        $flagngaysinh=-1;
                }
                else
                    $trngaysinh="";
                /*echo $trngaysinh." ";
                echo $trngaycap;die;*/
                if($flagngaysinh!=-1 && $flagngaysinh!="-1")
                {
                    if($flagngaycap!=-1 || $flagngaycap!="-1")
                    {
                        if(!isset($_POST['dinputwebsite']) || $_POST['dinputwebsite']=="" || (isset($_POST['dinputwebsite']) && filter_var($dinputwebsite,FILTER_VALIDATE_URL)))   
                        {
                            $sql="UPDATE `objects` SET `FullName` = '$dinputname', `PID` = '$dinputcmnd', 
                                `PIDState` = '$trngaycap', `PIDIssue` = '$dinputnoicap', `DoB` = '$trngaysinh', 
                                `PoB` = '$dinputnoisinh', `PerAdd` = '$dinputthuongtru', `TemAdd` = '$dinputtamtru', `Gender` = $dse_gander, `ProvinceId` = '$dse_dis', 
                                `Tel` = '$dinputtel', `Fax` = '$dinputfax', `Website` = '$dinputwebsite', 
                                `TaxCode` = '$dinputmsthue', `Note` = '$dinputghichu', `ModifiedBy` = '$userid', `ModifiedDate` = NOW() 
                                WHERE `ObjectId` = '$objectid'";
                            $query=$this->db2->query($sql);
                            // 1 - load user
                            $arr_user = $this->m_user->lay_User_theo_id1($userid);
                            // 2 - load Object 
                            $arr_Object = $this->m_user->lay_object_theo_ObjectID($arr_user[0]->ObjectId);
                            // 3 - Load Role
                            $arr_Role = $this->m_user->lay_Role_theo_RoleID($arr_user[0]->RoleId);
                            // 4 - Load RoleMenuModule
                            $arr_RoleMenuModule = $this->m_user->lay_RoleMenuModule_theo_RoleID($userid);
                            // chuoi menu
                            $menuStr = $this->GetMenuStr($arr_user[0]->RoleId);
                            
                             // lấy các module có quyèn
                              $module = $this->m_index->GetModuleOfRole($arr_user[0]->RoleId);
                            
                            $arr_session = array("User"=>$arr_user[0],"Object"=>$arr_Object[0],
                            "Role" => $arr_Role[0], "ListMenu"=>$arr_RoleMenuModule,"MenuSTR"=>$menuStr,"CacModule"=>$module);
                            $_SESSION['AccUser']=$arr_session;
                        }
                        else
                            $tbwebsite = 'Website không đúng';
                    }
                    else
                        $tbngaycap="Không chính xác";
                }
                else
                    $tbngaysinh="Không chính xác";
                    
            $arr=array(
                        "tbwebsite"=>$tbwebsite,
                        "tbngaycap"=>$tbngaycap,
                        "tbngaysinh"=>$tbngaysinh,
                        "resquery"=>$query
                        );
            return $arr;
    }
    public function layusertheouserid($userid)
    {
        $sql="SELECT *  FROM `users` WHERE `UserId`='$userid'";
        $query=$this->db2->query($sql)->row();
        return $query;
    }
    public function layobjecttheouserid($userid)
    {
        $sql="SELECT a.*,b.ScoreBalance FROM `objects` a, `users` b WHERE a.`ObjectId`=b.`ObjectId` AND b.`UserId`='$userid'";
        //echo $sql;die;
        $query=$this->db2->query($sql)->row();
        return $query;
    }
    public function btndoipass()
    {
        $tbmatkhau="";
        $query=-1;
        if(isset($_POST['dOldPassword']) && $_POST['dOldPassword']!="" && isset($_POST['dNewPassword']) && $_POST['dNewPassword']!="")
        {
            $dOldPassword = $_POST['dOldPassword'];
            $dNewPassword = md5($_POST['dNewPassword']);
            $userid=$_SESSION['AccUser']['User']->UserId;
            $user=$this->m_user->lay_nguoi_dung($userid,$dOldPassword);
            //print_r($user);die;
            if(!$user)
            {
                $tbmatkhau="Mật khẩu không đúng";
            }
            else
            {
                $sql="UPDATE `users` SET `Pwd` = '$dNewPassword', `ModifiedBy` = '$userid', `ModifiedDate` = NOW() 
                WHERE `UserId` = '$userid'";
                $query=$this->db2->query($sql);
            }
            $arr=array("tbmatkhau"=>$tbmatkhau,"query"=>$query);
            return $arr;
        }
    }
    //session accuser
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
    
}
?>