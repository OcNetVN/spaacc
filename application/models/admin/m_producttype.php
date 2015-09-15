<?php

class ProductsObject {   
   public   $ProductID;
   public   $SpaID ;
   public   $Name;
   public   $Description;
   public   $Status;
   public   $ProductType;
   public   $CurrentVouchers;
   public   $Duration;
   public   $MaxProductatOnce;
   public   $ValidTimeFrom;
   public   $ValidTimeTo;
   public   $Policy;
   public   $CreatedDate;
   public   $Restriction;
   public   $Tips;
   public   $CreatedBy;
}

class M_producttype extends CI_Model{
        public $errorStr; 
        
        public function __construct()
      {
            parent::__construct();
      }
        
                
        public function get_product_types(){
            $sql = "SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND LENGTH(`CommonId`)=4"; //l?y c?p 2
            $ListProductTypes = $this->db->query($sql)->result();
            return $ListProductTypes;
        }
        public function search_producttype(){            
            $PrTy    = $_POST['PrTy'];   
            $page       = $_POST["Page"];
            $sql="select * from commoncode where CommonTypeId = 'ProductType' and LENGTH(CommonId)=2";
            $sql1="select count(*) as Total from commoncode where CommonTypeId = 'ProductType' and LENGTH(CommonId)=2";
            
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            $_arrSpa = $this->AddSTT($this->db->query($sql)->result(),$page); 
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
        // product type con
        public function search_producttype_con(){            
            $PrTy    = $_POST['PrTy'];
            $id    = $_POST['id'];
            $page       = $_POST["Page"];
            
            $sql="select * from commoncode where CommonTypeId = 'ProductType' and LENGTH(CommonId)=4 and left(CommonId,2)='".$id."'";
            $sql1="select count(*) as Total from commoncode where CommonTypeId = 'ProductType' and LENGTH(CommonId)=4 and left(CommonId,2)='".$id."'";
            $sql2="select * from commoncode where CommonId = '".$id."' and CommonTypeId = 'ProductType'";
            $results2=$this->db->query($sql2)->result();
            if(count($results2))
                $loaicha=$results2[0]->StrValue2;
            else
                $loaicha="";
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            $_arrSpa = $this->AddSTT($this->db->query($sql)->result(),$page); 
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
                
        $res = array("TotalRecord"=>$TotalRecord,"TotalPage"=>$TotalPage,"CurPage"=>$page,"lst"=>$_arrSpa,"Toto"=>$ResTotalPage,"idcha"=>$id,"loaicha"=>$loaicha);
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
        //phat sinh loai
        public function phatsinhmaloai()
        {
            $sql="select * from commoncode where CommonTypeId = 'ProductType' and LENGTH(CommonId)=2 order by CommonId";
            $ListProductTypes = $this->db->query($sql)->result();
            return $ListProductTypes;
        }
        public function timlikeloaicha($idcha)
        {
            $sql="select * from commoncode where CommonTypeId = 'ProductType' and LENGTH(CommonId)=4 and left(CommonId,2)='".$idcha."' order by CommonId";
            $ListProductTypes = $this->db->query($sql)->result();
            return $ListProductTypes;
        }
        public function lay_loai_san_pham_cha()
        {
            $sql="select * from commoncode where CommonTypeId = 'ProductType' and LENGTH(CommonId)=2 order by CommonId desc";
            $results=$this->db->query($sql);
            if($results->num_rows()>0)
            {
                $loai_sp=array();
                foreach($results->result() as $item)
                {
                    $loai_sp[$item->CommonId]=$item->StrValue2;
                }
                return $loai_sp;
            }
                return $results->result();
            return false;
        }
        //them
        public function themloaisp()
        {
            $ma="";
            $Cap=0;
            $Loaispcha="";
            $Tenvn="";
            $Tenen="";
            $Trangthai=0;
            if(isset($_POST['Cap']))
                $Cap=$_POST['Cap'];
            if(isset($_POST['Loaispcha']))
                $Loaispcha=(string)$_POST['Loaispcha'];
            if($Cap==2) //tao ma loai cha
            {
                $ma="";
                $req = $this->phatsinhmaloai();
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
            }
            if($Cap==1)
            {
                $ma="";
                $req2=$this->timlikeloaicha($Loaispcha);
                //print_r($req2);die;
                $idcha=(string)$Loaispcha;
                if(count($req2)>0)
                {
                    $req2_ma=(int)substr($req2[0]->CommonId,2,2);
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
            if(isset($_POST['Tenvn']))
                $Tenvn=$_POST['Tenvn'];
            if(isset($_POST['Tenen']))
                $Tenen=$_POST['Tenen'];
            if(isset($_POST['Trangthai']))
                $Trangthai=$_POST['Trangthai'];
            $nguoitao=$_SESSION['AccUser']['User']->UserId;
            $sql="INSERT INTO `commoncode` (`CommonTypeId`, `CommonId`, `StrValue1`, `StrValue2`, `NumValue1`, `CancelDelete`, `CreatedBy`, `CreatedDate`) 
            VALUES ('ProductType', '$ma', '$Tenen', '$Tenvn', $Trangthai, 0, '$nguoitao', NOW())";
            $results=$this->db->query($sql);
            $res = array("lst"=>$results);
            return $res;
        }
        public function suasanpham()
        {
            $ID=$_POST['ID'];
            $Tenvn=$_POST['Tenvn'];
            $Tenen=$_POST['Tenen'];
            $Trangthai=$_POST['Trangthai'];
            $ModifiedBy=$_SESSION['AccUser']['User']->UserId;
            $ModifiedDate=$_POST['ModifiedDate'];
            $sql="UPDATE commoncode 
                    SET StrValue1 = '".$Tenen."', StrValue2 = '".$Tenvn."', NumValue1 = ".$Trangthai.", ModifiedBy = '".$ModifiedBy."', ModifiedDate = NOW() WHERE CommonTypeId = 'ProductType' AND CommonId = '".$ID."'";
            $results=$this->db->query($sql);
            $res = array("lst"=>$results);
            return $res;
        }
        public function lay_loai_sp_theo_id()
        {
            $ID=$_POST['ID'];
            $sql="select * from commoncode where CommonId = '".$ID."' and CommonTypeId='ProductType'";
            $results=$this->db->query($sql)->result();
                        
            $loaicha="";
            if(strlen($ID)==2)
                $loai="Loai cha";
            if(strlen($ID)==4)
            {
                $sql1="select * from commoncode where CommonId = '".substr($ID,0,2)."' and CommonTypeId='ProductType'";
                $results1=$this->db->query($sql1)->result();
                $loaicha=$results1[0]->StrValue2;
                $loai="Loai con";
            }
            /*if($results[0]->NumValue1==1)
                 $stt="Dang ";*/
            $res = array("lst"=>$results,"loai"=>$loai,"loaicha"=>$loaicha);
            return $res;
            //return $results;
        }
        //xoa
        public function xoaloai()
        {
            $ma=$_POST['ma'];
            $loaicha=0;
            $thongbao="";
            $Caploai=$_POST['Caploai'];
            if($Caploai==1) //loai con
            {
                $sql_spcon="select * from products where ProductType = '".$ma."'"; //xem co ton tai loai sp con khong
                $results_spcon=$this->db->query($sql_spcon)->result();
                if(count($results_spcon)>0) //co ma cua loai cha trong do nen phai khac 1
                {
                    $thongbao="Loại này không được xoá!";
                    $results="";
                    $sql="";
                    $loaicha=substr($ma,0,2);
                }
                else
                {
                    $sql_caneldelete="select * from commoncode WHERE CommonId = '".$ma."' and CommonTypeId='ProductType'"; //check quyen xoa thong qua canceldelete
                    $results_caneldelete=$this->db->query($sql_caneldelete)->row();
                    if($results_caneldelete->CancelDelete==1 || $results_caneldelete->CancelDelete=='1')
                    {
                        $thongbao="Loại này không được xoá!";
                        $results="";
                        $sql="";
                        $loaicha=substr($ma,0,2);
                    }
                    else
                    {
                        $sql="DELETE FROM commoncode WHERE CommonId = '".$ma."' and CommonTypeId='ProductType'";
                        $results=$this->db->query($sql);
                        $loaicha=substr($ma,0,2);
                        $thongbao="Xoá thành công!";
                    }
                } 
            }
            else //loai cha
            {
                //$sql="DELETE FROM commoncode WHERE CommonId = '".$ma."'";
                $sql_loaicon="select * from commoncode where CommonId like '".$ma."%' and CommonTypeId='ProductType'"; //xem co ton tai loai sp con khong
                $results_loaicon=$this->db->query($sql_loaicon)->result();
                if(count($results_loaicon)>1) //co ma cua loai cha trong do nen phai khac 1
                {
                    $thongbao="Loại này không được xoá!";
                    $results="";
                }
                else
                {
                    $sql_caneldelete="select * from commoncode WHERE CommonId = '".$ma."' and CommonTypeId='ProductType'"; //check quyen xoa thong qua canceldelete
                    $results_caneldelete=$this->db->query($sql_caneldelete)->row();
                    if($results_caneldelete->CancelDelete==1 || $results_caneldelete->CancelDelete=='1')
                    {
                        $thongbao="Loại này không được xoá!";
                        $results="";
                    }
                    else
                    {
                        $sql="DELETE FROM commoncode WHERE CommonId = '".$ma."' and CommonTypeId='ProductType'";
                        $results=$this->db->query($sql);
                        $thongbao="Xoa thanh cong!";
                    }
                }    
                
                //$results=$this->db->query($sql)->result();
            }
            $res = array("lst"=>$results,"loai"=>$ma,"loaicha"=>$loaicha,"thongbao"=>$thongbao);
            return $res;
        }
  }
?>
