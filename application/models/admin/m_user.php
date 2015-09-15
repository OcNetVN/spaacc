<?php 
class M_user extends CI_Model
{
    private $db2;
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('thebooking', TRUE); 
    }
    public function getUsetInfo($UserId)
    {
        $this->db2->select('*');
        $this->db2->where('UserId',$UserId);        
        $results=$this->db2->get('users');
        if($results->num_rows()>0)
            return $results->row();
        else
            return false;
    }
    
    public function lay_nguoi_dung($UserId,$Pwd)
    {
        $this->db2->select('*');
        $this->db2->where('UserId',$UserId);
        $this->db2->where('Pwd',md5($Pwd));
        $results=$this->db2->get('users');
        if($results->num_rows()>0)
            return $results->row();
        else
            return false;
    }
    
    public function lay_RoleMenuModule_theo_RoleID($id)
    {
        $sql ="SELECT a.*,b.`MenuName`,b.`url`,b.`Description` 
                FROM `rolemenumodule` a 
                INNER JOIN `menu` b ON a.`MenuId`= b.`MenuId` 
                 WHERE a.`RoleId`='$id'";
        $res = $this->db->query($sql)->result();
        $arr = (array) $res;
        if(count($arr)>=1)
            return $arr;
        else
            return null;
    }
    
    public function lay_Role_theo_RoleID($id)
    {
        $sql ="SELECT * FROM `roles` WHERE `RoleId`='$id'";
        
        $res = $this->db->query($sql)->result();
        $arr = (array) $res;
        if(count($arr)>=1)
            return $arr;
        else
            return null;
    }
    
    public function lay_User_theo_id1($id)
    {
        $sql ="SELECT * FROM `users` WHERE `UserId`='$id'";
        
        $res = $this->db2->query($sql)->result();
        $arr = (array) $res;
        if(count($arr)>=1)
            return $arr;
        else
            return null;
    }
    
    public function lay_object_theo_ObjectID($objID)
    {
        $sql ="SELECT * FROM `objects` WHERE `ObjectId`='$objID'";
        
        $res = $this->db2->query($sql)->result();
        $arr = (array) $res;
        if(count($arr)>=1)
            return $arr;
        else
            return null;
    }
    
    public function lay_object_theo_Email($email)
    {
        $sql ="SELECT * FROM `objects` WHERE `Email`='$email'";
        
        $res = $this->db2->query($sql)->result();
        $arr = (array) $res;
        if(count($arr)>=1)
            return $arr;
        else
            return null;
    }
    
    public function lay_object_theo_user($iduser)
    {
        $this->db2->select('users.ObjectId');
        $this->db2->from('objects');
        $this->db2->join('users', 'users.ObjectId = objects.ObjectId');
        $results = ($this->db2->get());
        if($results->num_rows()>0)
            return (array) $results->row();
        else
            return null;
    }
    
    public function danh_sach_user()
    {
        $results=$this->db2->get('users');
        if($results->num_rows()>0)
            return $results->result();
        return false;
    }
    public function danh_sach_user_phan_trang($limits,$start)
    {
        $this->db2->limit($limits,$start);
        $results=$this->db2->get('users');
        if($results->num_rows()>0)
            return $results->result();
        return false;
    }
    
    public function them_user($UserId,$Pwd,$ObjectId,$Status,$CreatedBy,$CreateDate,$RoleId,$ScoreBalance)
    {
        $data = array(
           'UserId' => $UserId ,
           'Pwd' => $Pwd ,
           'ObjectId' => $ObjectId ,
           'Status' => $Status ,
           'CreatedBy' => $CreatedBy ,
           'CreatedDate' => $CreateDate ,
           'RoleId' => $RoleId ,
           'ScoreBalance' => $ScoreBalance ,
           
        );
        $resutls=$this->db2->insert('users',$data);
        return $resutls;
    }
    public function update_user($UserId,$Pwd,$ObjectId,$Status,$RoleId,$ScoreBalance,$ModifiedBy,$ModifiedDate)
    {
        $data = array(
           'Pwd' => $Pwd ,
           'ObjectId' => $ObjectId ,
           'Status' => $Status ,
           'RoleId' => $RoleId ,
           'ScoreBalance' => $ScoreBalance ,
           'ModifiedBy' => $ModifiedBy ,
           'ModifiedDate' => $ModifiedDate ,
        );
         $this->db2->where('UserId',$UserId);
        $resutls=$this->db2->update('users',$data);
        return $resutls;
    }
    public function update_lastlogin_user($UserId,$LastLogin)
    {
        $data = array(
           'LastLogin' => $LastLogin ,
        );
         $this->db2->where('UserId',$UserId);
        $resutls=$this->db2->update('users',$data);
        return $resutls;
    }
    public function danh_sach_role()
    {
        $ds_loai=$this->db->get('roles');
        $mang_loai=array();
        foreach($ds_loai->result() as $loai)
        {
            $mang_loai[$loai->RoleId]=$loai->RoleName;
        }
        return $mang_loai;
    }
    public function lay_danh_ObjectGroup()
    {
        $this->db->select('StrValue1,StrValue1');
        $this->db->where('CommonTypeId','ObjectGroup');
        $ds_loai=$this->db->get('commoncode');
        $mang_loai=array();
        foreach($ds_loai->result() as $loai)
        {
            $mang_loai[$loai->StrValue1]=$loai->StrValue1;
        }
        return $mang_loai;
    }
    
    public function xoa_user($id)
    {
        $results=$this->db2->delete('users', array('UserId' => $id));
        return $results; 
    }
    public function xoa_nhieu_user($str_id)
    {
        $results=$this->db2->query('delete from users where UserId in '.'('.$str_id.')');
        return $results; 
    }
    public function lay_nhieu_object($str_id)
    {
        $results=$this->db2->query('select ObjectId from users where UserId in '.'('.$str_id.')');
        if($results->num_rows()>0)
            return $results->result();
        return false;
    }
    
    public function lay_user_theo_id($id)
    {
        $this->db2->where('UserId',$id);
        $results=$this->db2->get('users');
        if($results->num_rows()>0)
            return $results->row();
        return false;
    }
    //them
    public function layobjgroup()
    {
        $sql="select * from commoncode where CommonTypeId='ObjectGroup' order by StrValue1";
        $results=$this->db->query($sql)->result();
        $sodong=count($results);
        $res = array("lst"=>$results,"sodong"=>$sodong);
        return $res;
    }
    public function layobjtype()
    {
        $sql="select * from commoncode where CommonTypeId='ObjectType' order by StrValue1";
        $results=$this->db->query($sql)->result();
        $sodong=count($results);
        $res = array("lst"=>$results,"sodong"=>$sodong);
        return $res;
    }
    public function search_user()
    {
        $Objgroup        = $_POST['Objgroup'];            
        $Objtype         = $_POST['Objtype'];
        $Timtendn        = $_POST['Timtendn'];
        $Timhoten        = $_POST['Timhoten'];
        $Timdienthoai    = $_POST['Timdienthoai'];
        $Timemail        = $_POST['Timemail'];
        $tungay          = $_POST['tungay'];
        if($tungay != ""){
           $listtungay      =  explode("/", $tungay);
           $timebegin       =  $listtungay[2]."-".$listtungay[0]."-".$listtungay[1];
        }
        else{
            $timebegin    = ""; 
        }
        $denngay         = $_POST['denngay'];
        if($denngay != ""){
           $listdenngay     =  explode("/", $denngay);
           $timeend         =  $listdenngay[2]."-".$listdenngay[0]."-".$listdenngay[1]; 
        }
        else{
            $timeend = "";
        } 
        
        $page            = $_POST["Page"];
        $sql = "SELECT '1' AS STT,users.UserId,objects.* FROM `users`,`objects`";       
        $sql1 = "SELECT count(*) as Total FROM `users`,`objects`";
                
        $sql = $sql." where 1=1 and users.`ObjectId`=`objects`.`ObjectId`";
        $sql1 = $sql1." where 1=1 and users.`ObjectId`=`objects`.`ObjectId`";            
      
        if($Objgroup !="0"){
            $sql = $sql." and `ObjectGroup` = '".$Objgroup."'";
            $sql1 = $sql1." and `ObjectGroup` = '".$Objgroup."'";
        }
        
        if($Objtype !="0"){
            $sql = $sql." and `ObjectType` = '".$Objtype."'";
            $sql1 = $sql1." and `ObjectType` = '".$Objtype."'";
        }
        if($Timtendn !=''){
            $sql = $sql." and `UserId` like '%".$Timtendn."%'";
            $sql1 = $sql1." and `UserId` like '%".$Timtendn."%'";
        }
        if($Timhoten !=''){
            $sql = $sql." and `FullName` like '%".$Timhoten."%'";
            $sql1 = $sql1." and `FullName` like '%".$Timhoten."%'";
        }
        if($Timdienthoai !=''){
            $sql = $sql." and `Tel` like '%".$Timdienthoai."%'";
            $sql1 = $sql1." and `Tel` like '%".$Timdienthoai."%'";
        }
        if($Timemail !=''){
            $sql = $sql." and `Email` like '%".$Timemail."%'";
            $sql1 = $sql1." and `Email` like '%".$Timemail."%'";
        }
        if($tungay != "" && $denngay != ""){
            $sql = $sql."AND users.`CreatedDate` BETWEEN '$timebegin' AND '$timeend'";
            $sql1 = $sql1."AND users.`CreatedDate` BETWEEN '$timebegin' AND '$timeend'";
        }
        
        $StartPos =1;
        $StartPos = ($page - 1)*10;
        $EndPos =  10;
        
        if($page != '' ){
            $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
        }
        
        $_arrSpa = $this->AddSTT($this->db2->query($sql)->result(),$page); 
        //$_arrSpa = $this->db->query($sql)->result(); 
        /// duyet cho stt zo
               
        $ResTotalPage = $this->db2->query($sql1)->result();
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
            
        $res = array("TotalRecord"=>$TotalRecord,"TotalPage"=>$TotalPage,"CurPage"=>$page,"lst"=>$_arrSpa,"Toto"=>$ResTotalPage);
        return $res;
    }
    public function AddSTT($arr,$page)
    {
        $arr1 = (array) $arr;
        for($i=0;$i<count($arr1);$i++)
        {
            $arr1[$i]->STT = (($page-1)*10+($i+1));
        }
        return $arr1;
    }
    public function dialoguser()
    {
        $UserId    = $_POST['dUserId'];            
        $ObjectId    = $_POST['dObjectId'];
        $ObjectGroup    = $_POST['dObjectGroup'];
        $ObjectType    = $_POST['dObjectType'];
        $results=NULL;
        $results1=NULL;
        $results2=NULL;
        $sql = "SELECT users.UserId,objects.* FROM `users`,`objects` where users.`ObjectId`=`objects`.`ObjectId` and UserId='$UserId'";   
        $results=$this->db2->query($sql)->result();  
        
        $sql1 = "SELECT * FROM `commoncode` WHERE `CommonId`= '$ObjectGroup' and CommonTypeId='ObjectGroup'";   
        $results1=$this->db->query($sql1)->result();  
        $sql2 = "SELECT * FROM `commoncode` WHERE `CommonId`= '$ObjectType' and CommonTypeId='ObjectType'";   
        $results2=$this->db->query($sql2)->result(); 
        
        $res = array("lstuser"=>$results,"lstobjgroup"=>$results1,"lstobjtype"=>$results2);
        return $res;
    }
    public function loadobjgroup()
    {
        $sql = "SELECT * FROM `commoncode` WHERE CommonTypeId='ObjectGroup' order by StrValue1";   
        $results=$this->db->query($sql)->result();  
        $sodong=count($results);
        $res = array("lst"=>$results,"sodong"=>$sodong);
        return $res;
    }
    public function loadobjtype()
    {
        $sql = "SELECT * FROM `commoncode` WHERE CommonTypeId='ObjectType' order by StrValue1";   
        $results=$this->db->query($sql)->result();  
        $sodong=count($results);
        $res = array("lst"=>$results,"sodong"=>$sodong);
        return $res;
    }
    public function loadrole()
    {
        $sql = "SELECT * FROM `roles` ORDER BY `RoleName`";   
        $results=$this->db->query($sql)->result();  
        $sodong=count($results);
        $res = array("lst"=>$results,"sodong"=>$sodong);
        return $res;
    }
    //them user
    public function btnthem()
    {  
        $thongbaochung="";
        $thongbaouserid="";
        $thongbaopass="";
        $thongbaoten="";
        $thongbaoemail="";
        $ObjectID=0;
        $sql="";
        $ScoreBalance=0;
        
        $UserId    = $_POST['ttendnthem'];            
        $Pwd       = md5($_POST['tpasswordthem']);
        $FullName    = $_POST['thotenthem'];
        $RoleId    = $_POST['trolethem'];
        $Status    = $_POST['tstatusthem'];   
        if(!isset($_POST['tscorethem'])||$_POST['tscorethem']=="")
            $ScoreBalance=0;
        else
            $ScoreBalance    = $_POST['tscorethem'];
        $ObjectGroup    = $_POST['tobjgroupthem'];
        $ObjectType    = $_POST['tobjtypethem'];
        $PID    = $_POST['tpidthem'];  
        if(isset($_POST['tpdistatethem']))
        {
            $ngayPID=explode("/",$_POST['tpdistatethem']);
            $PIDState=date("Y-m-d h:m:s",mktime(0,0,0,$ngayPID[0],$ngayPID[1],$ngayPID[2]));
        }
        else
            $PIDState="";          
        //$PIDState    = $_POST['tpdistatethem'];
        $PIDIssue    = $_POST['tpidissuethem'];
        if(isset($_POST['tdobthem']))
        {
            $ngayDoB=explode("/",$_POST['tdobthem']);
            $DoB=date("Y-m-d h:m:s",mktime(0,0,0,$ngayDoB[0],$ngayDoB[1],$ngayDoB[2]));
        }
        else
            $DoB="";   
        //$DoB    = $_POST['tdobthem'];            
        $PoB    = $_POST['tpobthem'];
        $PerAdd    = $_POST['tperaddthem'];
        $TemAdd    = $_POST['ttemaddthem'];
        $Gender    = $_POST['tgerderthem'];            
        $ProvinceId    = $_POST['tprovinceidthem'];
        $Tel    = $_POST['ttelthem'];
        $Fax    = $_POST['tfaxthem'];
        $Email    = $_POST['temailthem'];
        $Website    = $_POST['twebsitethem'];
        $TaxCode    = $_POST['ttaxcodethem'];
        $Note    = $_POST['tnotethem'];
        $CreatedDate=date("Y-m-d h:m:s");
        $CreatedBy=$_SESSION['AccUser']['User']->UserId;
        if(!isset($UserId)||$UserId=="") //ten dang nhap khong duoc rong
        {
            $thongbaouserid="Không được rỗng";
            
        }
        else
        {
            $sql_checktendn="select * from users where UserId ='".$UserId."'";
            $query_checktendn=$this->db2->query($sql_checktendn)->result();
            $count_checktendn=count($query_checktendn);
            if($count_checktendn>0)
            {
                $thongbaouserid="Tên đăng nhập này đã tồn tại";
            }
            else
            {
                if(filter_var($UserId,FILTER_VALIDATE_EMAIL))
                {
                    /*if (!preg_match("/(.*)[^a-zA-Z0-9\_](.*)/",$UserId)) //truong hop dung
                    {*/
                        if(!isset($Pwd)||$Pwd=="") //pass khong duoc rong
                        {
                            $thongbaopass="Không được rỗng";
                            $res = array("ObjectID"=>$ObjectID,"tbchung"=>$thongbaochung,"tbtendn"=>$thongbaouserid,"tbpass"=>$thongbaopass,"tbhoten"=>$thongbaoten,"tbemail"=>$thongbaoemail);
                        }
                        else
                        {
                            if(!isset($FullName)||$FullName=="") //ho ten khong duoc rong
                            {
                                $thongbaoten="Không được rỗng";
                            }
                            else
                            {
                                if(!isset($Email)||$Email=="") //email khong duoc rong
                                {
                                    $thongbaoemail="Không được rỗng";
                                }
                                else
                                {
                                    try
                                    {
                                        $sql_checkemail="select * from objects where Email ='".$Email."'";
                                        $query_checkemail=$this->db2->query($sql_checkemail)->result();
                                        $count_checkemail=count($query_checkemail);
                                        if($count_checkemail>0)
                                        {
                                            $thongbaoemail="Email này đã tồn tại";
                                        }
                                        else // hop le
                                        {
                                            if(filter_var($Email,FILTER_VALIDATE_EMAIL))
                                            {
                                                $int=(string)"11".date("Y").date("m").date("d");
                                                $ObjectID=$this->phatsinhma('objects','ObjectId',$int);
                                                
                                                $sql="INSERT INTO `users` (`UserId`, `Pwd`, `ObjectId`, `Status`, `CreatedBy`, `CreatedDate`, `RoleId`, `ScoreBalance`) 
                                                    VALUES ('$UserId', '$Pwd', '$ObjectID', '$Status', '$CreatedBy', '$CreatedDate', '$RoleId', $ScoreBalance);";
                                                $results=$this->db2->query($sql);
                                                $sql_obj="INSERT INTO `objects` (`ObjectId`, `ObjectGroup`, `ObjectType`, `FullName`, `PID`, `PIDState`, `PIDIssue`, `DoB`, `PoB`, `PerAdd`, `TemAdd`, `Gender`, `ProvinceId`, `Tel`, `Fax`, `Email`, `Website`, `TaxCode`, `Note`, `Status`, `CreatedBy`, `CreatedDate`) 
                                                VALUES ('$ObjectID', '$ObjectGroup', '$ObjectType', '$FullName', '$PID', '$PIDState', '$PIDIssue', '$DoB', '$PoB', '$PerAdd', '$TemAdd', $Gender, '$ProvinceId', '$Tel', '$Fax', '$Email', '$Website', '$TaxCode', '$Note', '$Status', '$CreatedBy', '$CreatedDate')";
                                                $results_obj=$this->db2->query($sql_obj);
                                                $thongbaochung="Thêm thành công";
                                            }
                                            else
                                            {
                                                $thongbaoemail="Email không dúng";
                                            }
                                        }
                                    }
                                    catch(exception $e)
                                    {
                                        return $e;
                                    }
                                    
                                }
                            }
                        }
                    /*}
                    else
                    {
                        $thongbaouserid="Tên dang nh?p không du?c ch?a kí t? d?c bi?t";
                    }*/
                }
                else
                {
                    $thongbaouserid="Tên đăng nhập phải là email";
                }
            }
        }
        
        $res = array("ObjectID"=>$ObjectID,"tbchung"=>$thongbaochung,"tbtendn"=>$thongbaouserid,"tbpass"=>$thongbaopass,"tbhoten"=>$thongbaoten,"tbemail"=>$thongbaoemail,"UserId"=>$UserId);
        //print_r($res);
        return $res;
    }
    //phat sinh ma tu dong
     public function phatsinhma($table,$col,$int)
    {
        $ma=0;
        $sql="select * from $table where $col like '".$int."%'";
        $results=$this->db2->query($sql)->result();
        if(count($results)>0) //co ton tai ma like $int trong csdl
        {
            for($i=0;$i<count($results);$i++)
            {
                $id=$results[$i]->$col;
                $id=(int)substr($id,-6); //lay kieu int 6 so cuoi
                if(($id-$i)>1)
                {
                    $ma=$i+1;
                    break;
                }
            }
            if($ma==0) //ma lien tiep nhau thi them ma lon 1
            {
                $vitri = count($results)-1; //vi tri cuoi cung cua mang chuoi
                $id=$results[$vitri]->$col;
                $id=(int)substr($id,-6);
                $ma=$id+1;
            }
        }
        else
        {
            $ma=1;
        }
        $arr_str=array(
            "1"=>"00000",
            "2"=>"0000",
            "3"=>"000",
            "4"=>"00",
            "5"=>"0",
            "6"=>"",
        );
        $ma=(string)$int.(string)$arr_str[strlen($ma)].(string)$ma;
        return $ma;
    }
    //edit
    public function edituser()
    {
        $UserId    = $_POST['dUserId'];
        $Name    = $_POST['dName'];
        $ObjectId    = $_POST['dObjectId'];
        $ObjectGroup    = $_POST['dObjectGroup'];
        $ObjectType    = $_POST['dObjectType'];
        $RoleId    = $_POST['dRoleId'];
        $Gender    = $_POST['dGender'];
        $sql_user="SELECT * FROM users WHERE UserId ='$UserId'";
        $res_user=$this->db2->query($sql_user)->result();
        $sql_obj="SELECT * FROM `objects` WHERE `ObjectId` ='$ObjectId'";
        $res_obj=$this->db2->query($sql_obj)->result();
        $sql_objgroup="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ObjectGroup'";
        $res_objgroup=$this->db->query($sql_objgroup)->result();
        $sql_objtype="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ObjectType'";
        $res_objtype=$this->db->query($sql_objtype)->result();
        $sql_role="SELECT * FROM `roles`";
        $res_role=$this->db->query($sql_role)->result();
        $res = array("lst_user"=>$res_user,"lst_obj"=>$res_obj,"lst_objgroup"=>$res_objgroup,"trow_objgroup"=>count($res_objgroup),"lst_objtype"=>$res_objtype,"trow_objtype"=>count($res_objtype),"lst_role"=>$res_role,"trow_role"=>count($res_role),"UserId"=>$UserId,"ObjectId"=>$ObjectId,"ObjectGroup"=>$ObjectGroup,"ObjectType"=>$ObjectType,"RoleId"=>$RoleId,"Gender"=>$Gender);
        return $res;
    }
    public function btnedit()
    {  
        $thongbaochung="";
        $thongbaoten="";
        $Pwd    =   "";
        $UserId    = $_POST['ttendnedit'];  
        $tedit_obj    = $_POST['tedit_obj'];  
        if($_POST['tpasswordedit'] != "") 
            $Pwd    = md5($_POST['tpasswordedit']);
        $FullName    = $_POST['thotenedit'];
        $RoleId    = $_POST['troleedit'];
        $Status    = $_POST['tstatusedit'];            
        $ScoreBalance    = $_POST['tscoreedit'];
        $ObjectGroup    = $_POST['tobjgroupedit'];
        $ObjectType    = $_POST['tobjtypeedit'];
        $PID    = $_POST['tpidedit'];  
        if(isset($_POST['tpdistateedit']))
        {
            $ngayPID=explode("/",$_POST['tpdistateedit']);
            $PIDState=date("Y-m-d h:m:s",mktime(0,0,0,$ngayPID[0],$ngayPID[1],$ngayPID[2]));
        }
        else
            $PIDState=date("Y-m-d h:m:s");  
        //echo $PIDState." ";       
        //$PIDState    = $_POST['tpdistateedit'];
        $PIDIssue    = $_POST['tpidissueedit'];
        if(isset($_POST['tdobedit']))
        {
            $ngayDoB=explode("/",$_POST['tdobedit']);
            $DoB=date("Y-m-d h:m:s",mktime(0,0,0,$ngayDoB[0],$ngayDoB[1],$ngayDoB[2]));
        }
        else
            $DoB=date("Y-m-d h:m:s");
        //echo $DoB;die;
        //$DoB    = $_POST['tdobedit'];            
        $PoB    = $_POST['tpobedit'];
        $PerAdd    = $_POST['tperaddedit'];
        $TemAdd    = $_POST['ttemaddedit'];
        $Gender    = $_POST['tgerderedit'];            
        $ProvinceId    = $_POST['tprovinceidedit'];
        $Tel    = $_POST['tteledit'];
        $Fax    = $_POST['tfaxedit'];
        $Website    = $_POST['twebsiteedit'];
        $TaxCode    = $_POST['ttaxcodeedit'];
        $Note    = $_POST['tnoteedit'];
        $ModifiedDate=date("Y-m-d h:m:s");
        $ModifiedBy=$_SESSION['AccUser']['User']->UserId;
        if(!isset($FullName)||$FullName=="") //ho ten khong duoc rong
        {
            $thongbaoten="Không du?c r?ng";
        }
        else
        {    
            if(!isset($Pwd)||$Pwd=="") //pass rong
            {
                $sql_user="UPDATE `users` SET 
                `Status` = '$Status',`RoleId` = '$RoleId',`ScoreBalance` = '$ScoreBalance', `ModifiedBy` = '$ModifiedBy', `ModifiedDate` = '$ModifiedDate' 
                WHERE `UserId` = '$UserId'";
            }
            else //co pass moi
            {
                $sql_user="UPDATE `users` SET 
                `Status` = '$Status',`Pwd` = '$Pwd',`RoleId` = '$RoleId',`ScoreBalance` = '$ScoreBalance', `ModifiedBy` = '$ModifiedBy', `ModifiedDate` = '$ModifiedDate' 
                WHERE `UserId` = '$UserId'";
            }
            
            $query_user=$this->db2->query($sql_user);
            $sql_obj="UPDATE `objects` 
            SET `ObjectGroup` = '$ObjectGroup', `ObjectType` = '$ObjectType', `FullName` = '$FullName', 
            `PID` = '$PID', `PIDState` = '$PIDState', `PIDIssue` = '$PIDIssue', `DoB` = '$DoB', 
            `PoB` = '$PoB', `PerAdd` = '$PerAdd', `TemAdd` = '$TemAdd', `Gender` = $Gender, `ProvinceId` = '$ProvinceId', 
            `Tel` = '$Tel', `Fax` = '$Fax', `Website` = '$Website', `TaxCode` = '$TaxCode', 
            `Note` = '$Note', `Status` = '$Status', `ModifiedBy` = '$ModifiedBy', `ModifiedDate` = '$ModifiedDate' 
            WHERE `ObjectId` = '$tedit_obj'";
            $query_obj=$this->db2->query($sql_obj);
            $thongbaochung="Update thành công";
        }
        $res = array("tbchung"=>$thongbaochung,"tbten"=>$thongbaoten);
        return $res;
    }
    public function xoauser()
    {
     $UserId    = $_POST['duserid'];
     $ObjectId    = $_POST['dobjid'];   
     $sql_xoalinkshinh="select * from links where ObjectIDD = '".$UserId."'";
    $query_xoalinkshinh=$this->db->query($sql_xoalinkshinh)->result();
    //print_r($query_xoalinkshinh);die;
    if(count($query_xoalinkshinh)>0)
    {
        foreach($query_xoalinkshinh as $row)
        {
            $url=$row->URL;
    		 //echo $url;
             unlink($url);
        }      
        $sql_xoatbl_link="delete from links where ObjectIDD = '".$UserId."'";
        $query_xoatbl_link=$this->db->query($sql_xoatbl_link);
    }
    else
    {
        $query_xoatbl_link=true;
    }
     $sql_obj="DELETE FROM `objects` WHERE `objects`.`ObjectId` = '$ObjectId'";
     $res_obj=$this->db2->query($sql_obj);
     $sql_user="DELETE FROM `users`WHERE `UserId`='$UserId'";
     $res_user=$this->db2->query($sql_user);
     if($res_obj && $res_user && $query_xoatbl_link)
        $tbxoa="Xoá thành công";
     else
        $tbxoa="Có lỗi xảy ra";
     $res = array("tbchung"=>$tbxoa);
     return $res;   
    }
    //up load hinh
    public function get_hinh_promotion()
    {
        $PromotionID    = $_POST['Promotion'];
        //print_r($_POST['Promotion_edit']); 
        $id=$this->layuseridtheomaobject($PromotionID);
        $sql = "SELECT * FROM `links` WHERE `ObjectIDD`='$id'"; //lấy cấp 2
        $List = $this->db->query($sql)->result();
        return $List;
    }
    
    //up load hinh
    public function gethinhpromotionedit()
    {
        $PromotionID    = $_POST['Promotion_edit'];
        //print_r($_POST['Promotion_edit']); 
        $id=$this->layuseridtheomaobject($PromotionID);
        $sql = "SELECT * FROM `links` WHERE `ObjectIDD`='$id'"; //lấy cấp 2
        $List = $this->db->query($sql)->result();
        return $List;
    }
    
    public function InsertLinks($Id, $url)
    {
        $arr = explode('.',$url);
        $arr1 = explode('/',$url);
        $type ="USER";
        $ext= $arr[count($arr)-1];
        $filename = $arr1[count($arr1)-1];
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
    //dung cho viec doi id object thanh id user cho luu hinh ( vi id user co chua @)
    public function layuseridtheomaobject($objid)
    {
        $sqllayuser="select * from users where ObjectId = '".$objid."'";
        $res=$this->db2->query($sqllayuser)->result();
        if(count($res) > 0){
           return $res[0]->UserId; 
        }
        
    }
}

?>