<?php 
class M_object extends CI_Model
{
    private $db2;
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('thebooking', TRUE); 
    }
    public function danh_sach_object()
    {
        $results=$this->db2->get('objects');
        if($results->num_rows()>0)
            return $results->result();
        return false;
    }
    public function danh_sach_object_phan_trang($limits,$start)
    {
        $this->db2->limit($limits,$start);
        $results=$this->db2->get('objects');
        if($results->num_rows()>0)
            return $results->result();
        return false;
    }
    public function them_object($ObjectID,$ObjectGroup,$ObjectType,$FullName,$PID,$PIDState,$PIDIssue,$DoB,$PoB,$PerAdd,$TemAdd,$Gender,$Image,$ProvinceId,$Tel,
	$Fax,$Email,$Website,$TaxCode,$Note,$Status,$CreatedBy,$CreateDate)
    {
        $data = array(
           'ObjectID' => $ObjectID ,
           'ObjectGroup' => $ObjectGroup ,
           'ObjectType' => $ObjectType ,
           'FullName' => $FullName ,
           'PID' => $PID ,
           'PIDState' => $PIDState ,
           'PIDIssue' => $PIDIssue ,
           'DoB' => $DoB,
           'PoB' => $PoB ,
           'PerAdd' => $PerAdd ,
           'TemAdd' => $TemAdd ,
           'Gender' => $Gender ,
           'Image' => $Image ,
           'ProvinceId' => $ProvinceId ,
           'Tel' => $Tel,
           'Fax' => $Fax ,
           'Email' => $Email ,
           'Website' => $Website,
           'TaxCode' => $TaxCode ,
           'Note' => $Note ,
           'Status' => $Status ,
           'CreatedBy' => $CreatedBy ,
           'CreatedDate' => $CreateDate ,
        );
        $resutls=$this->db2->insert('objects',$data);
        return $resutls;
    }
    public function update_object($ObjectID,$ObjectGroup,$ObjectType,$FullName,$PID,$PIDState,$PIDIssue,$DoB,$PoB,$PerAdd,$TemAdd,$Gender,$Image,$ProvinceId,$Tel,
	$Fax,$Email,$Website,$TaxCode,$Note,$Status,$ModifiedBy,$ModifiedDate)
    {
        $data = array(
            'ObjectGroup' => $ObjectGroup ,
           'ObjectType' => $ObjectType ,
           'FullName' => $FullName ,
           'PID' => $PID ,
           'PIDState' => $PIDState ,
           'PIDIssue' => $PIDIssue ,
           'DoB' => $DoB,
           'PoB' => $PoB ,
           'PerAdd' => $PerAdd ,
           'TemAdd' => $TemAdd ,
           'Gender' => $Gender ,
           'Image' => $Image ,
           'ProvinceId' => $ProvinceId ,
           'Tel' => $Tel,
           'Fax' => $Fax ,
           'Email' => $Email ,
           'Website' => $Website,
           'TaxCode' => $TaxCode ,
           'Note' => $Note ,
           'Status' => $Status,
           'ModifiedBy' => $ModifiedBy ,
           'ModifiedDate' => $ModifiedDate,
        );
         $this->db2->where('ObjectId',$ObjectID);
        $resutls=$this->db2->update('objects',$data);
        return $resutls;
    }
    public function lay_danh_ObjectGroup()
    {
        $this->db->select('CommonId,StrValue1');
        $this->db->where('CommonTypeId','ObjectGroup');
        $ds_loai=$this->db->get('commoncode');
        $mang_loai=array();
        foreach($ds_loai->result() as $loai)
        {
            $mang_loai[$loai->CommonId]=$loai->StrValue1;
        }
        return $mang_loai;
    }
    public function lay_danh_ObjectType()
    {
        $this->db->select('CommonId,StrValue1');
        $this->db->where('CommonTypeId','ObjectType');
        $ds_loai=$this->db->get('commoncode');
        $mang_loai=array();
        foreach($ds_loai->result() as $loai)
        {
            $mang_loai[$loai->CommonId]=$loai->StrValue1;
        }
        return $mang_loai;
    }
    
    public function lay_obid_obname()
    {
        $this->db2->select('ObjectId,FullName');
        $ds_loai=$this->db2->get('objects');
        $mang_loai=array();
        foreach($ds_loai->result() as $loai)
        {
            $mang_loai[$loai->ObjectId]=$loai->FullName;
        }
        return $mang_loai;
    }
    
    public function xoa_object($id)
    {
        $results=$this->db2->delete('objects', array('ObjectId' => $id));
        return $results; 
    }
    public function xoa_nhieu_object($str_id)
    {
        $results=$this->db2->query('delete from objects where ObjectId in '.'('.$str_id.')');
        return $results; 
    }
    
    public function lay_object_theo_id($id)
    {
        $this->db2->where('ObjectId',$id);
        $results=$this->db2->get('objects');
        if($results->num_rows()>0)
            return $results->row();
        return false;
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
    
    //viet them cho ajax
    //viet them cho ajax
    public function layobjgroup()
    {
        $sql="select * from commoncode where CommonTypeId='ObjectGroup' order by StrValue1";
        $results=$this->db->query($sql)->result();
        $sodong=count($results);
        $res = array("sql"=>$sql,"lst"=>$results,"sodong"=>$sodong);
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
    public function search_objects()
    {
        $Objgroup    = $_POST['Objgroup'];            
        $Objtype    = $_POST['Objtype'];
        $Timwebsite    = $_POST['Timwebsite'];
        $Timhoten    = $_POST['Timhoten'];
        $Timdienthoai    = $_POST['Timdienthoai'];
        $Timemail    = $_POST['Timemail'];
        $page       = $_POST["Page"];
      
        $sql = "SELECT '1' AS STT,objects.* FROM `objects`";       
        $sql1 = "SELECT count(*) as Total FROM `objects`";
                
        $sql = $sql." where 1=1";
        $sql1 = $sql1." where 1=1";            
      
        if($Objgroup !="0"){
            $sql = $sql." and `ObjectGroup` = '".$Objgroup."'";
            $sql1 = $sql1." and `ObjectGroup` = '".$Objgroup."'";
        }
        
        if($Objtype !="0"){
            $sql = $sql." and `ObjectType` = '".$Objtype."'";
            $sql1 = $sql1." and `ObjectType` = '".$Objtype."'";
        }
        if($Timwebsite !=''){
            $sql = $sql." and `Website` like '%".$Timwebsite."%'";
            $sql1 = $sql1." and `Website` like '%".$Timwebsite."%'";
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
            
        $res = array("TotalRecord"=>$TotalRecord,"TotalPage"=>$TotalPage,"CurPage"=>$page,"lst"=>$_arrSpa, "sql1"=>$sql1,"Toto"=>$ResTotalPage);
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
    public function dialogobjects()
    {
        $ObjectId    = $_POST['dObjectId'];
        $ObjectGroup    = $_POST['dObjectGroup'];
        $ObjectType    = $_POST['dObjectType'];
        $results=NULL;
        $results1=NULL;
        $results2=NULL;
        $sql = "SELECT * FROM `objects` where ObjectId='$ObjectId'";   
        $results=$this->db2->query($sql)->result();  
        
        $sql1 = "SELECT * FROM `commoncode` WHERE `CommonId`= '$ObjectGroup' and CommonTypeId='ObjectGroup'";   
        $results1=$this->db->query($sql1)->result();  
        $sql2 = "SELECT * FROM `commoncode` WHERE `CommonId`= '$ObjectType' and CommonTypeId='ObjectType'";   
        $results2=$this->db->query($sql2)->result(); 
        
        $res = array("lstobjects"=>$results,"lstobjgroup"=>$results1,"lstobjtype"=>$results2);
        return $res;
    }
    //them objects
    public function btnthem()
    {  
        $thongbaochung="";
        $thongbaoten="";
        $thongbaoemail="";
        $ObjectID=0;
        $sql="";
        
        $FullName    = $_POST['thotenthem'];
        $Status    = $_POST['tstatusthem'];   
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
                            $int=(string)"03".date("Y").date("m").date("d");
                            $ObjectID=$this->phatsinhma('objects','ObjectId',$int);
                                
                            $sql_obj="INSERT INTO `objects` (`ObjectId`, `ObjectGroup`, `ObjectType`, `FullName`, `PID`, `PIDState`, `PIDIssue`, `DoB`, `PoB`, `PerAdd`, `TemAdd`, `Gender`, `ProvinceId`, `Tel`, `Fax`, `Email`, `Website`, `TaxCode`, `Note`, `Status`, `CreatedBy`, `CreatedDate`) 
                            VALUES ('$ObjectID', '$ObjectGroup', '$ObjectType', '$FullName', '$PID', '$PIDState', '$PIDIssue', '$DoB', '$PoB', '$PerAdd', '$TemAdd', $Gender, '$ProvinceId', '$Tel', '$Fax', '$Email', '$Website', '$TaxCode', '$Note', '$Status', '$CreatedBy', '$CreatedDate')";
                            $results_obj=$this->db2->query($sql_obj);
                            $thongbaochung="Thêm thành công! Mời bạn upload hình";
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
        
        $res = array("ObjectID"=>$ObjectID,"tbchung"=>$thongbaochung,"tbhoten"=>$thongbaoten,"tbemail"=>$thongbaoemail);
        //print_r($res);
        return $res;
    }
    //end them objects
    //edit
    public function editobjects()
    {
        $ObjectId    = $_POST['dObjectId'];
        $ObjectGroup    = $_POST['dObjectGroup'];
        $ObjectType    = $_POST['dObjectType'];
        $Gender    = $_POST['dGender'];
        $sql_obj="SELECT * FROM `objects` WHERE `ObjectId` ='$ObjectId'";
        $res_obj=$this->db2->query($sql_obj)->result();
        $sql_objgroup="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ObjectGroup'";
        $res_objgroup=$this->db->query($sql_objgroup)->result();
        $sql_objtype="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ObjectType'";
        $res_objtype=$this->db->query($sql_objtype)->result();
        $res = array("lst_obj"=>$res_obj,"lst_objgroup"=>$res_objgroup,"trow_objgroup"=>count($res_objgroup),"lst_objtype"=>$res_objtype,"trow_objtype"=>count($res_objtype),"ObjectId"=>$ObjectId,"ObjectGroup"=>$ObjectGroup,"ObjectType"=>$ObjectType,"Gender"=>$Gender);
        return $res;
    }
    public function btnedit()
    {  
        $thongbaochung="";
        $thongbaoten="";
        $tedit_obj    = $_POST['tedit_obj'];   
        $FullName    = $_POST['thotenedit'];
        $Status    = $_POST['tstatusedit'];     
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
            $thongbaoten="Không được rỗng";
        }
        else
        {  
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
    public function xoaobjects()
    {
        $ObjectId    = $_POST['dobjid'];   
        $sql_xoalinkshinh="select * from objectlinks where ObjectIDD = '".$ObjectId."'";
        $query_xoalinkshinh=$this->db2->query($sql_xoalinkshinh)->result();
        //print_r($query_xoalinkshinh);die;
        if(count($query_xoalinkshinh)>0)
        {
            foreach($query_xoalinkshinh as $row)
            {
                $url=$row->URL;
				 //echo $url;
                 unlink($url);
            }      
            $sql_xoatbl_link="delete from objectlinks where ObjectIDD = '".$ObjectId."'";
            $query_xoatbl_link=$this->db2->query($sql_xoatbl_link);
        }
        else
        {
            $query_xoatbl_link=true;
        }
        $sql_obj="DELETE FROM `objects` WHERE `objects`.`ObjectId` = '$ObjectId'";
        $res_obj=$this->db2->query($sql_obj);
        if($res_obj && $query_xoatbl_link)
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
        $sql = "SELECT * FROM objectlinks WHERE `ObjectIDD`='$PromotionID'"; //lấy cấp 2
        $List = $this->db2->query($sql)->result();
        return $List;
    }
    public function InsertLinks($Id, $url)
    {
        $arr = explode('.',$url);
        $arr1 = explode('/',$url);
        $type ="OBJECT";
        $ext= $arr[count($arr)-1];
        $filename = $arr1[count($arr1)-1];
        if(isset($arr))
        $createdby = $arr['User']->UserId;
        $sql ="INSERT INTO objectlinks (`ObjectIDD`,`URL`,`Type`,`FileExtension`,`FileName`,`Status`,`UploadedBy`,`UploadedDate`) VALUES ('$Id','$url','$type','$ext','$filename','1','$createdby',NOW())";
        
        try{
            $this->db2->query($sql);
        }
        catch(Exception $e)
        {
            
        }
    }
    //end upload hinh
    
    
}

?>