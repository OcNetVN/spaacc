<?php 
class M_commontype extends CI_Model
{
    public function loadcmtypeid()
    {
        $sql = "SELECT * FROM `commontype` order by CommonTypeId";   
        $results=$this->db->query($sql)->result();  
        $sodong=count($results);
        $res = array("lst"=>$results,"sodong"=>$sodong);
        return $res;
    }
    public function search_commontype()
    {
        $Cmtypeid    = $_POST['Cmtypeid'];            
        $Mota    = $_POST['Mota'];
        $Ghichu    = $_POST['Ghichu'];
        $Ngaytao    = $_POST['Ngaytao'];
        if($Ngaytao!='')
        {
            $arr_day= explode("/",$Ngaytao);
            $Ngaytao=$arr_day[2]."-".$arr_day[0]."-".$arr_day[1];
        }
        $page       = $_POST["Page"];
      
        $sql = "SELECT '1' AS STT,commontype.* FROM `commontype`";       
        $sql1 = "SELECT count(*) as Total FROM `commontype`";
                
        $sql = $sql." where 1=1";
        $sql1 = $sql1." where 1=1";            
      
        if($Cmtypeid !="0"){
            $sql = $sql." and `CommonTypeId` = '".$Cmtypeid."'";
            $sql1 = $sql1." and `CommonTypeId` = '".$Cmtypeid."'";
        }
        
        if($Mota !=''){
            $sql = $sql." and `Description` like '".$Objtype."'";
            $sql1 = $sql1." and `Description` like '".$Objtype."'";
        }
        if($Ghichu !=''){
            $sql = $sql." and `Note` like '%".$Ghichu."%'";
            $sql1 = $sql1." and `Note` like '%".$Ghichu."%'";
        }
        if($Ngaytao !=''){
            $sql = $sql." and `CreatedDate` like '%".$Ngaytao."%'";
            $sql1 = $sql1." and `CreatedDate` like '%".$Ngaytao."%'";
        }
        $StartPos =1;
        $StartPos = ($page - 1)*10;
        $EndPos =  10;
        
        if($page != '' ){
            $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
        }
        
        $_arrSpa = $this->AddSTT($this->db->query($sql)->result(),$page); 
        //$_arrSpa = $this->db->query($sql)->result(); 
        /// duyet cho stt zo
               
        $ResTotalPage = $this->db->query($sql1)->result();
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
    //them commontype
    public function btnthem_cmtype()
    {  
        $thongbaochung="";
        $thongbaocmttypeid="";
        $sql="";
        
        $Cmttypeidthem    = $_POST['Cmttypeidthem'];
        $Motathem    = $_POST['Motathem'];   
        $Ghichuthem    = $_POST['Ghichuthem'];
        $Phatsinhmathem    = $_POST['Phatsinhmathem'];
        $CreatedDate=date("Y-m-d h:m:s");
        $CreatedBy=$_SESSION['AccUser']['User']->UserId;
       
        if(!isset($Cmttypeidthem)||$Cmttypeidthem=="") //ho ten khong duoc rong
        {
            $thongbaocmttypeid="Không được rỗng";
        }
        else
        {   
            $sql_checkemail="select * from commontype where CommonTypeId ='".$Cmttypeidthem."'";
            $query_checkemail=$this->db->query($sql_checkemail)->result();
            $count_checkemail=count($query_checkemail);
            if($count_checkemail>0)
            {
                $thongbaocmttypeid="CommontypeId này đã tồn tại";
            }
            else // hop le
            {
                $sql_obj="INSERT INTO `commontype` (`CommonTypeId`, `Description`, `Note`,`IDgenerateType`, `CreatedBy`, `CreatedDate`) 
                VALUES ('$Cmttypeidthem', '$Motathem', '$Ghichuthem', $Phatsinhmathem, '$CreatedBy', '$CreatedDate')";
                $results_obj=$this->db->query($sql_obj);
                $thongbaochung="Thêm thành công!";
            }
        }
        
        $res = array("tbchung"=>$thongbaochung,"tbcmttypeid"=>$thongbaocmttypeid);
        //print_r($res);
        return $res;
    }
    //end them objects
    //edit
     public function editcommontype()
    {
        $cmtypeid    = $_POST['dcmtypeid'];
        $sql_obj="SELECT * FROM `commontype` WHERE `CommonTypeId` ='$cmtypeid'";
        $res_obj=$this->db->query($sql_obj)->result();
        $res = array("lst_cmtype"=>$res_obj);
        return $res;
    }
    public function btnedit()
    {  
        $thongbaochung="";
        $cmttypeidedit    = $_POST['dcmttypeidedit'];   
        $motaedit    = $_POST['dmotaedit'];
        $ghichuedit    = $_POST['dghichuedit'];
        $ModifiedDate=date("Y-m-d h:m:s");
        $ModifiedBy=$_SESSION['AccUser']['User']->UserId;
        
            $sql_obj="UPDATE `commontype` 
            SET `Description` = '$motaedit', `Note` = '$ghichuedit', `ModifiedBy` = '$ModifiedBy', `ModifiedDate` = '$ModifiedDate' 
            WHERE `CommonTypeId` = '$cmttypeidedit'";
            $query_obj=$this->db->query($sql_obj);
            $thongbaochung="Update thành công";
        $res = array("tbchung"=>$thongbaochung);
        return $res;
    }
    //delete
    public function xoacommontype()
    {
        $tbxoa="";
        $cmtypeId    = $_POST['dobjid'];   
        $sql_cmcode="select * from commoncode where CommonTypeId ='$cmtypeId'";
        $query_cmcode=$this->db->query($sql_cmcode)->result();
        $count_cmcode=count($query_cmcode);
        if($count_cmcode>0)
            $tbxoa="CommonType này có loại con, không được xoá!";
        else
        {
            $sql_obj="DELETE FROM `commontype` WHERE `CommonTypeId` = '$cmtypeId'";
            $res_obj=$this->db->query($sql_obj);
            if($res_obj)
                $tbxoa="Xoá thành công";
            else
                $tbxoa="Có lỗi xảy ra";
        }
        $res = array("tbchung"=>$tbxoa);
        return $res; 
    }
}
?>