<?php
    class M_spa_user extends CI_Model{
        public function __construct()
        {
            parent::__construct();
        }
        
        /*
        |----------------------------------------------------------------
        |function save spa user
        |----------------------------------------------------------------
        */
        public function getlistuser()
        {
            /*
            |   tab: 9: taball,
            |   tab: 1: tabadmin,
            |   tab: 2: tabhotro,
            |   tab: 3: tabnhanvien,
            */
            if(isset($_POST["page"]))
            {
                $spaid                  =   $_SESSION["AccSpa"]["spaid"];
                $page                   =   $_POST["page"];
                $tab                    =   $_POST["tab"];
                
                $RecordOnePage          =   $this->m_common->getSetting("RecordOnePageListHoinhom");
                $totalrow_listuser      =   $this->get_totalrow_list_user($tab,$spaid);
                $totalrow               =   $totalrow_listuser->total;
                $page                   =   $this->m_common->check_page_invalid($totalrow,$page,$RecordOnePage);
                if($page    ==  1 || $page  <   1 || $page  ==  "")
                    $start              =   0;
                else
                    $start              =   $RecordOnePage*($page-1);
                $limit                  =   $RecordOnePage;
                
                $list_user              =   $this->get_list_user($start,$limit,$tab,$spaid);
                
                $str_list="";
                $str_numpage="";
                $notfound="<strong style=\"margin:10px;\">Không tìm thấy</strong>";
                if(count($list_user)>0)
                {
                    $notfound="";
                    $stt=$start+1;
                    foreach($list_user as $row)
                    {
                        $str_list .= '<tr>';
                            $str_list .= '<td>'.$stt.'</td>';
                            $str_list .= '<td>Họ tên: '.$row->FullName.'<br />Email: '.$row->Email.'</td>';
                            
                            if($row->LastLogin != "")
                                $lastlogin      =   substr($row->LastLogin,8,2)."-".substr($row->LastLogin,5,2)."-".substr($row->LastLogin,0,4)." ".substr($row->LastLogin,-8);
                            else
                                $lastlogin      = "";
                            $str_list .= '<td>Tên đăng nhập: ';
                                            $str_list .= $row->UserID."<br />Lần cuối đăng nhập: ";
                                            $str_list .= $lastlogin.'</td>';
                            
                            if($row->Mainstatus==1 || $row->Mainstatus=="1")
                                $str_list .= '<td><span class="glyphicon glyphicon-ok-circle" onclick="changestatus(0,\''.$row->UserID.'\')" style="margin:0 3px; font-size:medium; cursor: pointer;" aria-hidden="true"></span></td>';
                            else
                                $str_list .= '<td><span class="glyphicon glyphicon-remove-circle" onclick="changestatus(1,\''.$row->UserID.'\')" style="margin:0 3px; font-size:medium; cursor: pointer;" aria-hidden="true"></span></td>';
                            
                            if($row->RoleId == "adminspa")
                                $str_list .= '<td>
                                                <select class="form-control" id="serole_'.$row->id.'" onchange="changerole(\''.$row->id.'\');">
                                                    <option value="adminspa" selected="selected">Admin spa</option>
                                                    <option value="hotrospa">Hỗ trợ spa</option>
                                                    <option value="nhanvienspa">Nhân viên spa</option>
                                                </select>
                                                </td>';
                            else
                                if($row->RoleId == "hotrospa")
                                $str_list .= '<td>
                                                <select class="form-control" id="serole_'.$row->id.'" onchange="changerole(\''.$row->id.'\');">
                                                    <option value="adminspa">Admin spa</option>
                                                    <option value="hotrospa" selected="selected">Hỗ trợ spa</option>
                                                    <option value="nhanvienspa">Nhân viên spa</option>
                                                </select>
                                                </td>';
                                else
                                    if($row->RoleId == "nhanvienspa")
                                        $str_list .= '<td>
                                                        <select class="form-control" id="serole_'.$row->id.'" onchange="changerole(\''.$row->id.'\');">
                                                            <option value="adminspa">Admin spa</option>
                                                            <option value="hotrospa">Hỗ trợ spa</option>
                                                            <option value="nhanvienspa" selected="selected">Nhân viên spa</option>
                                                        </select>
                                                        </td>';
                            $str_list .= '<td>                
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true" style="margin:0 3px; cursor: pointer;" onclick="btndelete(\''.$row->id.'\')"></span>
                                            </td>';
                            
                        $str_list .= '</tr>';
                        $stt++;
                    }
                    //tinh so trang
                    $num_page=ceil($totalrow/$limit);
    
                    //set previous page of current page
                    if($page<=3)
                        $limitprecurrentpage=1;
                    else
                        $limitprecurrentpage=$page-2;
                    //set next page of current page
                    if($page>=($num_page -2))
                        $limitnextcurrentpage=$num_page;
                    else
                        $limitnextcurrentpage=$page+2;
                    
                    if($num_page>0)
                    {
                        $str_numpage .= '<ul class="pagination">';
                            if($page==1)
                                $str_numpage .= '<li class="disabled"><a href="javascript:void(0);" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                            else
                                $str_numpage .= '<li ><a href="javascript:void(0);" onclick="getlistuser('.($page-1).',\''.$tab.'\')" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                            $runpre=0;
                            $runnext=0;
                            $flag=0;
                            for($i=1;$i<=$num_page;$i++)
                            {
                                if($i>=$limitprecurrentpage && $i<=$limitnextcurrentpage)
                                {
                                    if($page == $i)
                                        $str_numpage .= '<li class="active"><a href="javascript:void(0);" >'.$i.'</a></li>';
                                    else
                                        $str_numpage .= '<li><a href="javascript:void(0);" onclick="getlistuser('.$i.',\''.$tab.'\')" >'.$i.'</a></li>';
                                }
                                else
                                {
                                    if($i<=$page)
                                    {
                                        if($runpre==0)
                                        {
                                            $str_numpage .= '<li><span>..</span></li>'; 
                                            $runpre++;
                                        }
                                    } 
                                    if($i>=$page)
                                    {
                                        if($runnext==0)
                                        {
                                            $str_numpage .= '<li><span>..</span></li>'; 
                                            $runnext++;
                                        }
                                    }
                                }
                            }
                            if($page==$num_page)
                                $str_numpage .= '<li class="disabled"><a href="javascript:void(0);" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
                            else
                                $str_numpage .= '<li ><a href="javascript:void(0);" onclick="getlistuser('.($page+1).',\''.$tab.'\')" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
                          $str_numpage .='</ul>';
                    }
                }
                $arr = array("totalrow"=>$totalrow,"str_list"=>$str_list,"str_numpage"=>$str_numpage,"notfound"=>$notfound);
                return $arr;
            }
        }
        /*
        |----------------------------------------------------------------
        |function get totalrow list user by tab 
        |----------------------------------------------------------------
        */
        public function get_totalrow_list_user($tab,$spaid)
        {
            /*
            |   tab: 9: taball,
            |   tab: 1: tabadmin,
            |   tab: 2: tabhotro,
            |   tab: 3: tabnhanvien,
            */
            $sql_plus               =   "";
            if($tab     == 1)
                $sql_plus           =   " AND b.`RoleId` = 'adminspa' ";
            if($tab     == 2)
                $sql_plus           =   " AND b.`RoleId` = 'hotrospa' ";
            if($tab     == 3)
                $sql_plus           =   " AND b.`RoleId` = 'nhanvienspa' ";
                
            $sql="SELECT COUNT(*) AS total FROM `".DATABASE_1."`.`spauser` a, `".DATABASE_2."`.`users` b 
                WHERE a.`UserID` =  b.`UserId` $sql_plus AND `SpaID` = '$spaid'";
            $query=$this->db->query($sql)->row();
            return $query;
        }
        /*
    	|----------------------------------------------------------------
    	| get database list user by request
    	|----------------------------------------------------------------
    	*/
        public function get_list_user($start,$limit,$tab,$spaid)
        {
            /*
            |   tab: 9: taball,
            |   tab: 1: tabadmin,
            |   tab: 2: tabhotro,
            |   tab: 3: tabnhanvien,
            */
            $sql_plus               =   "";
            if($tab     == 1)
                $sql_plus           =   " AND b.`RoleId` = 'adminspa' ";
            if($tab     == 2)
                $sql_plus           =   " AND b.`RoleId` = 'hotrospa' ";
            if($tab     == 3)
                $sql_plus           =   " AND b.`RoleId` = 'nhanvienspa' ";
                
            $sql="SELECT a.`id`, a.`SpaID`, a.`UserID`, a.`Status` AS Mainstatus, b.`RoleId` , b.`LastLogin`, c.* 
                    FROM `".DATABASE_1."`.`spauser` a, `".DATABASE_2."`.`users` b, `".DATABASE_2."`.`objects` c 
                    WHERE a.`UserID` = b.`UserId` AND b.`ObjectId` = c.`ObjectId` AND a.`SpaID` = '$spaid' $sql_plus order by b.`RoleId` 
                    LIMIT $start, $limit";
            $query=$this->db->query($sql)->result();
            return $query;
        }
        /*
        |----------------------------------------------------------------
        |function change status spa user
        |----------------------------------------------------------------
        */
        public function changestatus_spauser()
        {
            if(isset($_POST['status']) && isset($_POST['id']))
            {
                $status             =   $_POST['status'];
                $id                 =   $_POST['id'];
                $error              =   "Có lỗi xảy ra";
                $success            =   "Thành công";
                
                $sql="UPDATE `".DATABASE_1."`.`spauser` SET `Status` = '$status' WHERE `UserId` = '$id'";
                $query=$this->db->query($sql);
                if($query)
                    $arr=array("status"=>1,"notify"=>$success);
                else
                    $arr=array("status"=>0,"notify"=>$error);
                return $arr;
            }
        }
        /*
        |----------------------------------------------------------------
        |function click button load infomation user edit
        | call function from public model m_commmon.php
        |----------------------------------------------------------------
        */
        public function btnedit()
        {
            if(isset($_POST['id']))
            {
                $id = $_POST['id'];
                
                $user_info = $this->get_user_by_id($id);
                
                //show value
                $id = "";
                $str_location_level1 = "";
                $str_objectgeder = "";
                //load location
                if($user_info->ProvinceId == "" || $user_info->ProvinceId == 0)
                    $location_level1 = 0;
                else
                    $location_level1 = substr($user_info->ProvinceId,0,3);
                $arr_location_lever1 = $this->m_common->get_list_location_by_level("LOCATION",3,0,DATABASE_2);
                foreach($arr_location_lever1 as $row_3)
                {
                    if($location_level1 == $row_3->CommonId)
                        $str_location_level1 .= "<option value=\"".$row_3->CommonId."\" selected=\"selected\">".$row_3->StrValue1."</option>";
                    else
                        $str_location_level1 .= "<option value=\"".$row_3->CommonId."\">".$row_3->StrValue1."</option>";
                }
                //get object by objectid
                $object = $this->get_object_by_id($user_info->ObjectId);
                //load gender
                if($object->Gender == 1)
                {
                    $str_objectgeder .= '<input name="regender" value="1" type="radio" checked="checked" />'.$this->lang->line(LANG_MALE).'
                                        <br />
                                        <input name="regender" value="0" type="radio" />'.$this->lang->line(LANG_FEMALE);
                }
                else
                {
                    $str_objectgeder .= '<input name="regender" value="1" type="radio" />'.$this->lang->line(LANG_MALE).'
                                        <br />
                                        <input name="regender" value="0" type="radio" checked="checked" />'.$this->lang->line(LANG_FEMALE);
                }
                
                //return
                $arr=array("str_userlevel"          =>  $str_userlevel,
                            "str_usertype"          =>  $str_usertype,
                            "str_userstatus"        =>  $str_userstatus,
                            "user_info"             =>  $user_info,
                            "id"                    =>  $user_info->id,
                            "str_location_level1"   =>  $str_location_level1,
                            "location_level1"       =>  $location_level1,
                            "object"                =>  $object,
                            "str_objectgeder"      =>  $str_objectgeder);
                return $arr;
            }
        }
        /*
        |----------------------------------------------------------------
        |function get user by userid
        |----------------------------------------------------------------
        */
        public function get_user_by_id($id)
        {
            $sql="SELECT b.*, c.* FROM `".DATABASE_1."`.`spauser` a, `".DATABASE_2."`.`users` b, `".DATABASE_2."`.`objects` c 
                    WHERE a.`UserID` = b.`UserId` AND a.`UserID` = '$id' AND b.`ObjectId` = c.`ObjectId`";        
            $query = $this->db->query($sql)->row();
            return $query;
        }
        /*
        |----------------------------------------------------------------
        |function get object by objectid
        |----------------------------------------------------------------
        */
        public function get_object_by_id($objectid)
        {
            $sql="SELECT * FROM `".DATABASE_2."`.`objects` WHERE `ObjectId` = '$objectid'";        
            $query = $this->db->query($sql)->row();
            return $query;
        }
        /*
        |----------------------------------------------------------------
        |function change role spa user
        |----------------------------------------------------------------
        */
        public function changerole_spauser()
        {
            if(isset($_POST["id"]))
            {
                $id             =   $_POST["id"];
                $value          =   $_POST["value"];
                $stt            =   0;
                $notify         =   "Có lỗi xảy ra";
                
                $row_spauser    =   $this->get_spauser_by_id($id);
                if(count($row_spauser) > 0)
                {
                    $flag       =   1;
                    $updaterole =   $this->update_roleuser_by_userid($row_spauser->UserID,$value);
                    if($updaterole)
                    {
                        $notify =   "Thành công";
                        $stt    =   1;
                    }
                }
                else
                    $flag       =   0;
                
                //return
                $arr            =   array(
                                            "flag"                  =>  $flag,
                                            "stt"                   =>  $stt,
                                            "notify"                =>  $notify,
                                            );
                return $arr;
            }
            
        }
        /*
        |----------------------------------------------------------------
        |function get spauser by id (id autoincrease)
        |----------------------------------------------------------------
        */
        public function get_spauser_by_id($id)
        {
            $sql        =   "SELECT * FROM `".DATABASE_1."`.`spauser` WHERE `id` = '$id'";
            $query      =   $this->db->query($sql)->row();
            return $query;
        }
        /*
        |----------------------------------------------------------------
        |function get user by userid
        |----------------------------------------------------------------
        */
        public function get_user_by_userid($userid)
        {
            $sql        =   "SELECT * FROM `".DATABASE_2."`.`users` WHERE `UserId` = '$userid'";
            $query      =   $this->db->query($sql)->row();
            return $query;
        }
        /*
        |----------------------------------------------------------------
        |function update role user by userid
        |----------------------------------------------------------------
        */
        public function update_roleuser_by_userid($userid,$role)
        {
            $sql        =   "UPDATE `".DATABASE_2."`.`users` SET `RoleId` = '$role' WHERE `UserId` = '$userid'";
            $query      =   $this->db->query($sql);
            return $query;
        }
        /*
        |----------------------------------------------------------------
        |function click button delete user
        |----------------------------------------------------------------
        */
        public function btndelete_spauser()
        {
            if(isset($_POST['id']))
            {
                $id         =   $_POST['id'];
                $error      =   "Có lỗi xảy ra";
                $success    =   "Thành công";
                
                $sql        =   "DELETE FROM `".DATABASE_1."`.`spauser` WHERE `id` = $id";
                $query      =   $this->db->query($sql);
                if($query)
                    $arr    =   array("status"  =>  1, "notify"  =>    $success);
                else
                    $arr    =   array("status"  =>  0, "notify"  =>  $error);
                return $arr;
            }
        }
        /*
        |----------------------------------------------------------------
        |function get number user to show ultab
        |----------------------------------------------------------------
        */
        public function get_number_user_show_ultab()
        {
            $spaid                  =   $_SESSION["AccSpa"]["spaid"];
            /*
            |   tab: 9: taball,
            |   tab: 1: tabadmin,
            |   tab: 2: tabhotro,
            |   tab: 3: tabnhanvien,
            */
            $total_taball           =   $this->get_totalrow_list_user(9,$spaid)->total;
            $total_tabadmin         =   $this->get_totalrow_list_user(1,$spaid)->total;
            $total_tabhotro         =   $this->get_totalrow_list_user(2,$spaid)->total;
            $total_tabnhanvien      =   $this->get_totalrow_list_user(3,$spaid)->total;
            
            //return
            $arr                    =   array(
                                                "total_taball"          =>  $total_taball, 
                                                "total_tabadmin"        =>  $total_tabadmin,
                                                "total_tabhotro"        =>  $total_tabhotro,
                                                "total_tabnhanvien"     =>  $total_tabnhanvien,
                                                );
            return $arr;
            
        }
        /*
        |----------------------------------------------------------------
        |function search user by username, email spa user 
        |----------------------------------------------------------------
        */
        public function searchuser_spauser()
        {
            if(isset($_POST["txtsearch"]))
            {
                $txtsearch      =   $_POST["txtsearch"];
                $page           =   $_POST["page"];
                
                $sql            =   "SELECT DISTINCT a.`UserId`, b.* 
                                    FROM `".DATABASE_2."`.`users` a, `".DATABASE_2."`.`objects` b 
                                    WHERE (a.`UserId` LIKE '%ad%' OR b.`Email` LIKE '%huu%') AND a.`ObjectId` = b.`ObjectId`";
                $query          =   $this->db->query($sql)->result();
                
                $RecordOnePage          =   $this->m_common->getSetting("RecordOnePageListSpauserModal");
                $totalrow_listuser      =   $this->get_totalrow_list_user_by_txtsearch($txtsearch);
                $totalrow               =   $totalrow_listuser->total;
                $page                   =   $this->m_common->check_page_invalid($totalrow,$page,$RecordOnePage);
                if($page    ==  1 || $page  <   1 || $page  ==  "")
                    $start              =   0;
                else
                    $start              =   $RecordOnePage*($page-1);
                $limit                  =   $RecordOnePage;
                
                $list_user              =   $this->get_list_user_by_txtsearch($start,$limit,$txtsearch);
                
                $str_list="";
                $str_numpage="";
                $notfound="<strong style=\"margin:10px;\">Không tìm thấy</strong>";
                if(count($list_user)>0)
                {
                    $notfound="";
                    $stt=$start+1;
                    foreach($list_user as $row)
                    {
                        $str_list .= '<tr>';
                            $str_list .= '<td>'.$stt.'</td>';
                            $str_list .= '<td><input type="checkbox" name="cbchooseusermodal" value="'.$row->UserId.'"/></td>';
                            $str_list .= '<td>'.$row->FullName.'</td>';
                            $str_list .= '<td>'.$row->UserId.'</td>';
                            $str_list .= '<td>'.$row->Email.'</td>';
                        $str_list .= '</tr>';
                        $stt++;
                    }
                    //tinh so trang
                    $num_page=ceil($totalrow/$limit);
    
                    //set previous page of current page
                    if($page<=3)
                        $limitprecurrentpage=1;
                    else
                        $limitprecurrentpage=$page-2;
                    //set next page of current page
                    if($page>=($num_page -2))
                        $limitnextcurrentpage=$num_page;
                    else
                        $limitnextcurrentpage=$page+2;
                    
                    if($num_page>0)
                    {
                        $str_numpage .= '<ul class="pagination">';
                            if($page==1)
                                $str_numpage .= '<li class="disabled"><a href="javascript:void(0);" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                            else
                                $str_numpage .= '<li ><a href="javascript:void(0);" onclick="searchuser('.($page-1).',\''.$txtsearch.'\')" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                            $runpre=0;
                            $runnext=0;
                            $flag=0;
                            for($i=1;$i<=$num_page;$i++)
                            {
                                if($i>=$limitprecurrentpage && $i<=$limitnextcurrentpage)
                                {
                                    if($page == $i)
                                        $str_numpage .= '<li class="active"><a href="javascript:void(0);" >'.$i.'</a></li>';
                                    else
                                        $str_numpage .= '<li><a href="javascript:void(0);" onclick="searchuser('.$i.',\''.$txtsearch.'\')" >'.$i.'</a></li>';
                                }
                                else
                                {
                                    if($i<=$page)
                                    {
                                        if($runpre==0)
                                        {
                                            $str_numpage .= '<li><span>..</span></li>'; 
                                            $runpre++;
                                        }
                                    } 
                                    if($i>=$page)
                                    {
                                        if($runnext==0)
                                        {
                                            $str_numpage .= '<li><span>..</span></li>'; 
                                            $runnext++;
                                        }
                                    }
                                }
                            }
                            if($page==$num_page)
                                $str_numpage .= '<li class="disabled"><a href="javascript:void(0);" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
                            else
                                $str_numpage .= '<li ><a href="javascript:void(0);" onclick="searchuser('.($page+1).',\''.$txtsearch.'\')" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
                          $str_numpage .='</ul>';
                    }
                }
                $arr = array("totalrow"=>$totalrow,"str_list"=>$str_list,"str_numpage"=>$str_numpage,"notfound"=>$notfound);
                return $arr;
            }
        }
        /*
        |-------------------------------------
        | function get totalrow list user by txtsearch
        |-------------------------------------
        */
        public function get_totalrow_list_user_by_txtsearch($txtsearch)
        {
            $sql="SELECT COUNT(DISTINCT a.`UserId`) AS total 
                    FROM `".DATABASE_2."`.`users` a, `".DATABASE_2."`.`objects` b 
                    WHERE (a.`UserId` LIKE '%$txtsearch%' OR b.`Email` LIKE '%$txtsearch%') AND a.`ObjectId` = b.`ObjectId` AND a.`Status` = 1";
            $query=$this->db->query($sql)->row();
            return $query;
        }
        /*
        |-------------------------------------
        | function get list user by txtsearch, start, limit
        |-------------------------------------
        */
        public function get_list_user_by_txtsearch($start,$limit,$txtsearch)
        {
            $sql="SELECT DISTINCT a.`UserId`, b.* 
                    FROM `".DATABASE_2."`.`users` a, `".DATABASE_2."`.`objects` b 
                    WHERE (a.`UserId` LIKE '%$txtsearch%' OR b.`Email` LIKE '%$txtsearch%') AND a.`ObjectId` = b.`ObjectId` AND a.`Status` = 1 
                    LIMIT $start,$limit";
            $query=$this->db->query($sql)->result();
            return $query;
        }
        /*
        |----------------------------------------------------------------
        |function add spa user modal
        |----------------------------------------------------------------
        */
        public function addspausermodal_spauser()
        {
            if(isset($_POST["arrcbchooseusermodal"]))
            {
                $spaid                          =   $_SESSION["AccSpa"]["spaid"];
                $arrcbchooseusermodal           =   $_POST["arrcbchooseusermodal"];
                $serolemodal                    =   $_POST["serolemodal"];
                $flag                           =   1;
                
                if(count($arrcbchooseusermodal) > 0)
                {
                    foreach($arrcbchooseusermodal as $row_cbchooseusermodal)
                    {
                        $checkisset                     =   (int)$this->check_isset_spauser($row_cbchooseusermodal)->total;
                        if($checkisset == 0)
                        {
                            $sql                        =   "INSERT INTO `spauser` 
                                                                        (`id`,  `SpaID`,        `UserID`,           `Status`, `CreatedBy`, `CreatedDate`) 
                                                                VALUES  (NULL, '$spaid', '$row_cbchooseusermodal',     '1',     'spa',          NOW())";
                            $query                      =   $this->db->query($sql);
                        }
                        $this->update_roleuser_by_userid($row_cbchooseusermodal,$serolemodal);
                    }
                }
                
                //return
                $arr                            =   array(  
                                                            "flag"          =>  $flag,
                                                            );
                return $arr;
            }
        }
        /*
        |----------------------------------------------------------------
        |function add spa user modal
        |----------------------------------------------------------------
        */
        public function check_isset_spauser($UserID)
        {
            $sql            =   "SELECT COUNT(*) AS total FROM `".DATABASE_1."`.`spauser` WHERE `UserID` = '$UserID'";
            $query          =   $this->db->query($sql)->row();
            return $query;
        }
    }
?>
