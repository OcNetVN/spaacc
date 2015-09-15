<?php 
class M_commoncode extends CI_Model
{
    public function laycommontypetim()
    {
        $sql="select * from commontype order by CommonTypeId";
        $results=$this->db->query($sql)->result();
        $sodong=count($results);
        $res = array("lst"=>$results,"sodong"=>$sodong);
        return $res;
    }
    //nhan nut tim
    public function searchcommoncode()
    {
        $Timcmtypeid    = $_POST['Timcmtypeid'];            
        $Timgiatrichuoi1    = $_POST['Timgiatrichuoi1'];
        $Timgiatrichuoi2    = $_POST['Timgiatrichuoi2'];
        $Timgiatriso1    = $_POST['Timgiatriso1'];
        $Timgiatriso2    = $_POST['Timgiatriso2'];
        $page       = $_POST["Page"];
      
        $sql = "SELECT '1' AS STT,commoncode.* FROM `commoncode`";       
        $sql1 = "SELECT count(*) as Total FROM `commoncode`";
                
        $sql = $sql." where 1=1";
        $sql1 = $sql1." where 1=1";            
      
        if($Timcmtypeid !="0"){
            $sql = $sql." and `CommonTypeId` = '".$Timcmtypeid."'";
            $sql1 = $sql1." and `CommonTypeId` = '".$Timcmtypeid."'";
        }
        
        if($Timgiatrichuoi1 !=''){
            $sql = $sql." and `StrValue1` like '%".$Timgiatrichuoi1."%'";
            $sql1 = $sql1." and `StrValue1` like '%".$Timgiatrichuoi1."%'";
        }
        if($Timgiatrichuoi2 !=''){
            $sql = $sql." and `StrValue2` like '%".$Timgiatrichuoi2."%'";
            $sql1 = $sql1." and `StrValue2` like '%".$Timgiatrichuoi2."%'";
        }
        if($Timgiatriso1 !=''){
            $sql = $sql." and `NumValue1` like '%".$Timgiatriso1."%'";
            $sql1 = $sql1." and `NumValue1` like '%".$Timgiatriso1."%'";
        }
        if($Timgiatriso2 !=''){
            $sql = $sql." and `NumValue2` like '%".$Timgiatriso2."%'";
            $sql1 = $sql1." and `NumValue2` like '%".$Timgiatriso2."%'";
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
    //load radiobution them
    public function loadradiocapthem()
    {
        $lenght_max=1;
        $socap=1;
        $Cmtypeidthem    = $_POST['Cmtypeidthem'];
        $sql="SELECT MAX(LENGTH(CommonId)) AS maxlen FROM commoncode WHERE CommonTypeId ='$Cmtypeidthem' GROUP BY CommonId order by maxlen DESC";
        $results=$this->db->query($sql)->result();
        if(count($results)>0)
        {
            $lenght_max=$results[0]->maxlen;
            if($lenght_max>1)
                $socap= floor($lenght_max/2);
        }
        $res = array("lenght_max"=>$lenght_max,"socap"=>$socap);
        return $res;
    }
    //load ra ten cap khi thay doi list cap
    public function hiencapthem()
    {
        $query_list_commoncode="";
        $sql_list_commoncode="";
        $sodong=0;
        $Capcanthem    = $_POST['Capcanthem'];  
        //$Capcanthem = $Capcanthem-1;
        $Cmtypeidthem   = $_POST['Cmtypeidthem'];
        $sql_idmaxlen="SELECT CommonId, MAX(LENGTH(CommonId)) AS maxlen FROM commoncode WHERE CommonTypeId ='$Cmtypeidthem' GROUP BY CommonId order by maxlen DESC";
        $query_idmaxlen=$this->db->query($sql_idmaxlen)->result(); 
        if(count($query_idmaxlen)>0)
        {
            $lenght_max=$query_idmaxlen[0]->maxlen; //lay commonid dai nhat
            if($lenght_max%2==0)
                $lenght_cmid_cha=2; //chieu dai commonid cha
            if($lenght_max%2==1)
                $lenght_cmid_cha=3;
            $sql_list_commoncode="select * from commoncode where LENGTH(CommonId)=$lenght_cmid_cha and CommonTypeId ='$Cmtypeidthem' order by CommonId";
            $query_list_commoncode=$this->db->query($sql_list_commoncode)->result();
            $sodong=count($query_list_commoncode);
        }
        $res = array("sql"=>$sql_list_commoncode,"lst_cmidcha"=>$query_list_commoncode,"Capcanthem"=>$Capcanthem,"sodong"=>$sodong);
        return $res;
    }
    public function showidgerenatetype()
    {
        $Cmtypeidthem    = $_POST['Cmtypeidthem'];
        $query="";
        $sql="";
        $sodong=0;
        if($Cmtypeidthem != "0")
        {
            $sql="select * from commontype where CommonTypeId='$Cmtypeidthem'";
            $query=$this->db->query($sql)->result();
            $sodong=count($query);
        }
        $res = array("lst"=>$query,"sodong"=>$sodong,"Cmtypeidthem"=>$Cmtypeidthem);
        return $res;
    }
    public function laycommon_2cap()
    {
        $Cmtypeidthem    = $_POST['Cmtypeidthem'];
        $query="";
        $sql="";
        $sodong=0;
        if($Cmtypeidthem != "0")
        {
            $sql="select * from commoncode where CommonTypeId='$Cmtypeidthem' and LENGTH(CommonId)=2";
            $query=$this->db->query($sql)->result();
            $sodong=count($query);
        }
        $res = array("lst"=>$query,"sodong"=>$sodong,"Cmtypeidthem"=>$Cmtypeidthem);
        return $res;
    }
    public function laycm2theo1_2cap()
    {
        $Idcap_1 = $_POST['Idcap_1'];
        $query="";
        $sql="";
        $sodong=0;
        if($Idcap_1 != "0" || $Idcap_1 != 0)
        {
            $sql="select * from commoncode where CommonId like '$Idcap_1%' and LENGTH(CommonId)=4";
            $query=$this->db->query($sql)->result();
            $sodong=count($query);
        }
        $res = array("lst"=>$query,"sodong"=>$sodong,"Idcap_1"=>$Idcap_1);
        return $res;
    }
    //tao ma commonid
    public function phatsinhmaloai($cmtypeid)
    {
        $sql="select * from commoncode where CommonTypeId = '$cmtypeid' and LENGTH(CommonId)=2 order by CommonId";
        $ListProductTypes = $this->db->query($sql)->result();
        return $ListProductTypes;
    }
    public function timlikeloaicha($Cmtypeidthem,$Cmid,$dodaichuoiid,$dodaiid)
    {
        $sql="select * from commoncode where CommonTypeId = '$Cmtypeidthem' and LENGTH(CommonId)=$dodaiid and left(CommonId,$dodaichuoiid)='".$Cmid."' order by CommonId";
        $ListProductTypes = $this->db->query($sql)->result();
        return $ListProductTypes;
    }
    public function taocommonid_2cap()
    {
        $Cap = $_POST['Cap'];
        //echo $Cap;die;
        $Cmtypeidthem = $_POST['Cmtypeidthem'];
        //echo $Cmtypeidthem;die;
        $Cmid = $_POST['Cmid'];
        
        $sql_obj="SELECT * FROM `commontype` WHERE `CommonTypeId` ='$Cmtypeidthem'";
        $res_obj=$this->db->query($sql_obj)->result();
        
        if($Cap==1)
        {
            $ma="";
            $req = $this->phatsinhmaloai($Cmtypeidthem);
            //print_r($req);die;
            if(count($req)>0)
            {
                $req_ma=(int)$req[0]->CommonId;
                if($req_ma!=1)
                    $ma=(string)"01";
                else
                {
                    //echo 'sf';die;
                    for($i=0;$i<count($req)-1;$i++)
                    {
                        if(((int)$req[$i+1]->CommonId-(int)$req[$i]->CommonId)!=1)
                        {
                            $ma=(int)$req[$i]->CommonId+1;
                            break;
                        }
                    }
                    //echo $ma;die;
                    if($ma==0)
                    {
                        $ptcuoi=count($req)-1;
                        $ma=(int)$req[$ptcuoi]->CommonId+1;
                    }
                }
                //echo $ma;die;
            }
            else
                $ma=1;
            if(strlen($ma)==1)
                $ma=(string)"0".$ma;
            //echo $ma;die;
            //echo $Cap;die;
        }
        else
        {
            //echo $Cap;die;
            $dodaichuoiid=($Cap-1)*2;
            $dodaiid=$dodaichuoiid+2;
            $ma="";
            $req2=$this->timlikeloaicha($Cmtypeidthem,$Cmid,$dodaichuoiid,$dodaiid);
            
            $idcha=(string)$Cmid;
            if(count($req2)>0)
            {
                $req2_ma=(int)substr($req2[0]->CommonId,$dodaichuoiid,2);
                //echo $req2_ma;die;
                if($req2_ma!=1)
                    $ma=(string)"01";
                else
                {
                    //echo 'sf';die;
                    for($i=0;$i<count($req2)-1;$i++)
                    {
                        if(((int)substr($req2[$i+1]->CommonId,2,2)-(int)substr($req2[$i]->CommonId,2,2))!=1)
                        {
                            $ma=(int)substr($req2[$i]->CommonId,2,2)+1;
                            break;
                        }
                    }
                    //echo $ma;die;
                    if($ma==0)
                    {
                        $ptcuoi2=count($req2)-1;
                        $ma=(int)substr($req2[$ptcuoi2]->CommonId,2,2)+1;
                    }
                }
                //echo $ma;die;
            }
            else
                $ma=1;
            if(strlen($ma)==1)
                $ma=(string)"0".$ma;
            $ma=(string)$idcha.$ma;
            //echo $ma;die;
        }
         $res = array("ma"=>$ma,"lst_cmtype"=>$res_obj);
            return $res;
    }
    //auto load
    public function loadcmcode(){
        $Cmtypeidthem = $_POST['Cmtypeidthem'];
        $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId`='$Cmtypeidthem' ORDER BY `StrValue1` DESC";
        $results=$this->db->query($sql)->result();
        $sodong=count($results);
        $res = array("lst"=>$results,"sodong"=>$sodong);
        return $res;
    }
    public function btn_chonloaicha()
    {
        $ma="";
        $Loaichathem = $_POST['Loaichathem'];
        $Cmtypeidthem = $_POST['Cmtypeidthem'];
        
        if($Loaichathem!="")
        {
            $sql="select * from commoncode where StrValue1='$Loaichathem'";
            $results=$this->db->query($sql)->result();
            $sodong=count($results);
            if($sodong>0)
            {
                $CommonId=$results[0]->CommonId;
                $CommonTypeId=$results[0]->CommonTypeId;
                $dodaichuoiid=strlen($CommonId);
                $dodaiid=$dodaichuoiid+2;
                if($CommonTypeId=="LOCATION")
                {
                    $ma="";
                    $req2=$this->timlikeloaicha($CommonTypeId,$CommonId,$dodaichuoiid,$dodaiid);
                    
                    $idcha=(string)$CommonId;
                    if(count($req2)>0)
                    {
                        $req2_ma=(int)substr($req2[0]->CommonId,$dodaichuoiid,2);
                        //echo $req2_ma;die;
                        if($req2_ma!=1)
                            $ma=(string)"01";
                        else
                        {
                            //echo 'sf';die;
                            for($i=0;$i<count($req2)-1;$i++)
                            {
                                if(((int)substr($req2[$i+1]->CommonId,2,2)-(int)substr($req2[$i]->CommonId,2,2))!=1)
                                {
                                    $ma=(int)substr($req2[$i]->CommonId,2,2)+1;
                                    break;
                                }
                            }
                            //echo $ma;die;
                            if($ma==0)
                            {
                                $ptcuoi2=count($req2)-1;
                                $ma=(int)substr($req2[$ptcuoi2]->CommonId,2,2)+1;
                            }
                        }
                        //echo $ma;die;
                    }
                    else
                        $ma=1;
                    if(strlen($ma)==1)
                        $ma=(string)"0".$ma;
                    $ma=(string)$idcha.$ma;
                    //echo $ma;die;
                }
                else
                {
                    $ma="";
                    $req2=$this->timlikeloaicha($CommonTypeId,$CommonId,$dodaichuoiid,$dodaiid);
                    
                    $idcha=(string)$CommonId;
                    if(count($req2)>0)
                    {
                        $req2_ma=(int)substr($req2[0]->CommonId,$dodaichuoiid,2);
                        //echo $req2_ma;die;
                        if($req2_ma!=1)
                            $ma=(string)"01";
                        else
                        {
                            //echo 'sf';die;
                            for($i=0;$i<count($req2)-1;$i++)
                            {
                                if(((int)substr($req2[$i+1]->CommonId,2,2)-(int)substr($req2[$i]->CommonId,2,2))!=1)
                                {
                                    $ma=(int)substr($req2[$i]->CommonId,2,2)+1;
                                    break;
                                }
                            }
                            //echo $ma;die;
                            if($ma==0)
                            {
                                $ptcuoi2=count($req2)-1;
                                $ma=(int)substr($req2[$ptcuoi2]->CommonId,2,2)+1;
                            }
                        }
                        //echo $ma;die;
                    }
                    else
                        $ma=1;
                    if(strlen($ma)==1)
                        $ma=(string)"0".$ma;
                    $ma=(string)$idcha.$ma;
                    //echo $ma;die;
                }
            }
        }
        else //truong hop khong nhap gi het ma nhan nut them
        {
            if($Cmtypeidthem!="LOCATION")
            {
                $ma="01";
            }
        }
        $res = array("ma"=>$ma);
        return $res;
    }
    public function btnthem_commoncode()
    {
        $thongbaoid="";
        $thongbaochuoi1="";
        $thongbaochung="";
        $cmtypeidthem = $_POST['dcmtypeidthem'];
        $cmidthem = $_POST['dcmidthem'];
        $chuoi1them = $_POST['dchuoi1them'];
        $chuoi2them = $_POST['dchuoi2them'];
        $so1them = $_POST['dso1them'];
        $so2them = $_POST['dso2them'];
        $CreatedDate=date("Y-m-d h:m:s");
        $CreatedBy=$_SESSION['AccUser']['User']->UserId;
        
        $sql_cmt="select * from commontype where CommonTypeId='$cmtypeidthem'";
        $query_cmt=$this->db->query($sql_cmt)->result();
        $IDgenerateType=$query_cmt[0]->IDgenerateType;
        if($IDgenerateType==1 || $IDgenerateType=="1") //tu nhap id
        {
            if(strlen($cmidthem)!=2)
            {
                $thongbaoid="ID phải là số có 2 chữ số";
            }
            else
            {
                $sql_check_cmt="select * from commoncode where CommonTypeId='$cmtypeidthem' and CommonId='$cmidthem'";
                $query_check_cmt=$this->db->query($sql_check_cmt)->result();
                if(count($query_check_cmt)>0)
                {
                    $thongbaoid="ID này đã tồn tại!";
                }
                else
                {
                    if(!isset($chuoi1them)||$chuoi1them=="") //ho ten khong duoc rong
                    {
                        $thongbaochuoi1="Không được rỗng";
                    }
                    else
                    {
                        $sql="INSERT INTO `commoncode` (`CommonTypeId`, `CommonId`, `StrValue1`, `StrValue2`, `NumValue1`, `NumValue2`, `CreatedBy`, `CreatedDate`, `CancelDelete`) 
                        VALUES ('$cmtypeidthem', '$cmidthem', '$chuoi1them', '$chuoi2them', '$so1them', '$so2them', '$CreatedBy', '$CreatedDate', 0)";
                        $results=$this->db->query($sql);
                        $thongbaochung="Thêm thành công!";
                    }
                }
            }
        }
        else //id tu phat sinh
        {
            if(!isset($chuoi1them)||$chuoi1them=="") //ho ten khong duoc rong
            {
                $thongbaochuoi1="Không được rỗng";
            }
            else
            {
                $sql="INSERT INTO `commoncode` (`CommonTypeId`, `CommonId`, `StrValue1`, `StrValue2`, `NumValue1`, `NumValue2`, `CreatedBy`, `CreatedDate`, `CancelDelete`) 
                VALUES ('$cmtypeidthem', '$cmidthem', '$chuoi1them', '$chuoi2them', '$so1them', '$so2them', '$CreatedBy', '$CreatedDate', 0)";
                $results=$this->db->query($sql);
                $thongbaochung="Thêm thành công!";
            }
        }
        
        $res = array("thongbaochuoi1"=>$thongbaochuoi1,"tbchung"=>$thongbaochung,"thongbaoid"=>$thongbaoid);
        return $res;
    }
    //xoa commoncode
    public function xoacommoncode()
    {
        $tbxoa="";
        $commonId = $_POST['commonId'];
        $commonTypeId = $_POST['commonTypeId'];
        $sql="SELECT MAX(LENGTH(CommonId)) AS maxlen FROM commoncode WHERE CommonTypeId ='$commonTypeId' and CommonId like '$commonId%' GROUP BY CommonId order by maxlen DESC";
        $results=$this->db->query($sql)->result();
        $lenght_max=$results[0]->maxlen;
        $sql_cm="select * from commoncode where CommonId = '$commonId'";
        $res_cm=$this->db->query($sql_cm)->result();
        $CancelDelete=$res_cm[0]->CancelDelete;
        if(($lenght_max > strlen($commonId)) || ($CancelDelete==1 || $CancelDelete=="1"))
        {
            $tbxoa="Không được xoá loại này";
        }
        else
        {
            $sql_obj="DELETE FROM `commoncode` WHERE `CommonId` = '$commonId'";
            $res_obj=$this->db->query($sql_obj);
            if($res_obj)
                $tbxoa="Xoá thành công";
            else
                $tbxoa="Có lỗi xảy ra";
        }
        $res = array("tbchung"=>$tbxoa);
        return $res; 
    }
	public function laycmcodetheoid($id)
    {  
        $res="";
        $sodong=0;
        $commonId    = $_POST['commonId'];
        $sql="SELECT * FROM `commoncode` WHERE `CommonId`='$commonId'";
        $res=$this->db->query($sql)->result();
        $sodong=count($res);
        $res = array("lst"=>$res,"sodong"=>$sodong);
        return $res;
    }
    //sua commoncode
    public function suacommoncode()
    {  
        $res="";
        $sodong=0;
        $commonId    = $_POST['commonId'];
        $sql="SELECT * FROM `commoncode` WHERE `CommonId`='$commonId'";
        $res=$this->db->query($sql)->result();
        $sodong=count($res);
        $res = array("lst"=>$res,"sodong"=>$sodong);
        return $res;
    }
    public function btnsua_commoncode()
    {
        $tbchuoi="";
        $thongbaochung="";
        $Cmtidsua = $_POST['Cmtidsua'];
         $Cmidsua = $_POST['Cmidsua'];
        $Chuoi1sua = $_POST['Chuoi1sua'];
         $Chuoi2sua = $_POST['Chuoi2sua'];
        $So1sua = $_POST['So1sua'];
         $So2sua = $_POST['So2sua'];
         $CreatedDate=date("Y-m-d h:m:s");
         if(!isset($Chuoi1sua)||$Chuoi1sua=="") //ho ten khong duoc rong
        {
            $tbchuoi="Không được rỗng";
        }
        else
        {
            $CreatedBy=$_SESSION['AccUser']['User']->UserId;
            $sql="UPDATE `commoncode` SET `StrValue1` = '$Chuoi1sua', `StrValue2` = '$Chuoi2sua', `NumValue1` = '$So1sua', `NumValue2` = '$So2sua', `ModifiedBy` = '$CreatedBy', `ModifiedDate` = '$CreatedDate' 
            WHERE `CommonTypeId` = '$Cmtidsua' AND `CommonId` = '$Cmidsua'";
            $query=$this->db->query($sql);
            $thongbaochung="Update thành công";
        }
        $res = array("tbchung"=>$thongbaochung,"tbchuoi"=>$tbchuoi);
        return $res;
    }
}





?>