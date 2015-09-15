<?php


class M_spafacility extends CI_Model{
        public function __construct()
      {
            parent::__construct();
      } 
        public function search_producttype(){  
            $page       = $_POST["Page"];
            $sql="select * from commoncode where CommonTypeId = 'SpaFacility'";
            $sql1="select count(*) as Total from commoncode where CommonTypeId = 'SpaFacility'";
            
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
            $sql="select * from commoncode where CommonTypeId = 'SpaFacility' order by CommonId";
            $ListProductTypes = $this->db->query($sql)->result();
            return $ListProductTypes;
        }
       
        public function lay_loai_san_pham_cha()
        {
            $sql="select * from commoncode where CommonTypeId = 'SpaFacility' order by CommonId desc";
            $results=$this->db->query($sql);
            if($results->num_rows()>0)
            {
                $loai_sp=array();
                foreach($results->result() as $item)
                {
                    $loai_sp[$item->CommonId]=$item->StrValue1;
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
            $Tenvn="";
            $Tenen="";
            $Trangthai=0;
            
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
            if(isset($_POST['Tenvn']))
                $Tenvn=$_POST['Tenvn'];
            if(isset($_POST['Tenen']))
                $Tenen=$_POST['Tenen'];
            if(isset($_POST['Trangthai']))
                $Trangthai=$_POST['Trangthai'];
            $nguoitao=$_SESSION['AccUser']['User']->UserId;
            $sql="INSERT INTO `commoncode` (`CommonTypeId`, `CommonId`, `StrValue1`, `StrValue2`, `NumValue1`, `CancelDelete`, `CreatedBy`, `CreatedDate`) 
            VALUES ('SpaFacility', '$ma', '$Tenvn', '$Tenen', $Trangthai, 0, '$nguoitao', NOW())";
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
                    SET StrValue1 = '".$Tenvn."', StrValue2 = '".$Tenen."', NumValue1 = ".$Trangthai.", ModifiedBy = '".$ModifiedBy."', ModifiedDate = NOW() WHERE CommonTypeId = 'SpaFacility' AND CommonId = '".$ID."'";
            $results=$this->db->query($sql);
            $res = array("lst"=>$results);
            return $res;
        }
        public function lay_loai_sp_theo_id()
        {
            $ID=$_POST['ID'];
            $sql="select * from commoncode where CommonId = '".$ID."' and CommonTypeId='SpaFacility'";
            $results=$this->db->query($sql)->result();
             
            $res = array("lst"=>$results);
            return $res;
            //return $results;
        }
        //xoa
        public function xoaloai()
        {
            $ma=$_POST['ma'];
            $loaicha=0;
            $thongbao="";
                $sql_spcon="select * from spainfo where commonId = '".$ma."' and commonTypeId='SpaFacility'"; //xem co ton tai loai sp con khong
                $results_spcon=$this->db->query($sql_spcon)->result();
                if(count($results_spcon)>0) //co ma cua loai cha trong do nen phai khac 1
                {
                    $thongbao="Tiện ích này có Spa sử dụng, không được xoá!";
                    $results="";
                }
                else
                {
                    $sql_checkcanceldelete="select * from commoncode where CommonId = '".$ma."' and CommonTypeId='SpaFacility'";  
                    $results_checkcanceldelete=$this->db->query($sql_checkcanceldelete)->row();
                    if($results_checkcanceldelete->CancelDelete==1 || $results_checkcanceldelete->CancelDelete=='1') //khong co quyen xoa
                    {
                        $thongbao="Tiện ích này không được xoá!";
                        $results="";
                    }
                    else
                    {
                        $sql="DELETE FROM commoncode WHERE CommonId = '".$ma."' and CommonTypeId='SpaFacility'";
                        $results=$this->db->query($sql);
                        $thongbao="Xoá thành công!";
                    }
                }
            $res = array("lst"=>$results,"thongbao"=>$thongbao);
            return $res;
        }
  }
?>
