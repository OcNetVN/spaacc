<?php 
class M_membercard extends CI_Model{
    public function __construct()
    { 
        parent::__construct();
        $this->db2 = $this->load->database('thebooking', TRUE);
    }
    public function layloaithe()
    {
        $sql = "SELECT `CommonId`,`StrValue1` FROM `commoncode` WHERE `CommonTypeId`='MemberCard'";
        $query=$this->db2->query($sql)->result();
        $str='<option value="0">Tất cả</option>';
        if(count($query)>0)
        {
            foreach($query as $row)
            {
                $str .= '<option value="'.$row->CommonId.'">'.$row->StrValue1.'</option>';
            }
        }
        return $str;
    }
    public function layloaithethem()
    {
        $sql = "SELECT `CommonId`,`StrValue1` FROM `commoncode` WHERE `CommonTypeId`='MemberCard'";
        $query=$this->db2->query($sql)->result();
        $str="";
        if(count($query)>0)
        {
            foreach($query as $row)
            {
                $str .= '<option value="'.$row->CommonId.'">'.$row->StrValue1.'</option>';
            }
        }
        return $str;
    }
    public function clickbtnsearch()
    {
        if(isset($_POST['timcardno']))
        {
            $str="";
            $page=1;
            $timcardno=$_POST['timcardno'];
            $timloaithe=$_POST['timloaithe'];
            $timngaytao=$_POST['timngaytao'];
            if($timngaytao!="")
            {
                $arrngtao=explode("/",$timngaytao);
                $timngaytao=$arrngtao[2]."-".$arrngtao[1]."-".$arrngtao[0];
            }
            $timngayhethan=$_POST['timngayhethan'];
            if($timngayhethan!="")
            {
                $arrnghh=explode("/",$timngayhethan);
                $timngayhethan=$arrnghh[2]."-".$arrnghh[0]."-".$arrnghh[1];
            }
            $timnguoidung=$_POST['timnguoidung'];
            $timuerid=$_POST['timuerid'];
            $timtrangthai=$_POST['timtrangthai'];
            $sql="SELECT a.*,b.`StrValue1` 
                        FROM `membercard` a, `commoncode` b 
                        WHERE a.`CardType`=b.`CommonId` AND b.`CommonTypeId`='MemberCard'";
            if($timcardno!="")
               $sql.=" AND a.`CardNo` LIKE '%$timcardno%'"; 
            if($timloaithe!="0" && $timloaithe!=0)
               $sql.=" AND a.`CardType` = '$timloaithe'"; 
            if($timngaytao!="")
               $sql.=" AND a.`CreatedDate` LIKE '%$timngaytao%'"; 
            if($timngayhethan!="")
               $sql.=" AND a.`ExpireDate` LIKE '%$timngayhethan%'"; 
            if($timnguoidung!="")
               $sql.=" AND a.`CardHolderName` LIKE '%$timnguoidung%'"; 
            if($timuerid!="")
               $sql.=" AND a.`RefUserID` LIKE '%$timuerid%'";
            if($timtrangthai!="9" && $timtrangthai!=9)
               $sql.=" AND a.`Status` = '$timtrangthai'";  
               
            $sql.=" ORDER BY a.`CardHolderName`"; 
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            //echo $sql;die;
            $Listbooking = $this->db2->query($sql)->result();
            
            $_arrSpa = $this->AddSTT($Listbooking,$page); 
            /// duyet cho stt zo
                   
            $TotalRecord = count($Listbooking);
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
            //echo $TotalPage;die;
            //print_r($_arrSpa);die;
            if(count($_arrSpa)>0)
            {
                foreach($_arrSpa as $rowarr)
                {
                    $str .= '<tr>';
                    $str .= '<td>'.$rowarr->STT.'</td>';
                    $str .= '<td>Mã thẻ: '.$rowarr->CardNo.'<br />Loại thẻ: '.$rowarr->StrValue1.'<br />Ngày tạo: '.$rowarr->CreatedDate.'<br />Ngày hết hạn: '.$rowarr->ExpireDate.'</td>';
                    $str .= '<td>Tên người dùng:'.$rowarr->CardHolderName.'<br />UserID: '.$rowarr->RefUserID.'</td>';
                    if($rowarr->Status==1 || $rowarr->Status=="1")
                        $str .= '<td>Đang sử dụng</td>';
                    else
                        $str .= '<td>Đã huỷ</td>';
                    $str .= '<td>'.$rowarr->generatedID.'</td>';
                    $str .= '<td>';
                        $str .= '<a href="javascript:void(0);" onclick="sua('.$rowarr->CardNo.')" title="Sửa"><img src="'.base_url('resources/images/icons/pencil.png').'" alt="Sửa" /></a> ';
                        $str .= ' <a href="javascript:void(0);" onclick="xoa('.$rowarr->CardNo.');"  title="Xóa"><img src="'.base_url('resources/images/icons/cross.png').'" alt="Xóa" /></a>';
                    $str .= '</td>';
                    $str .= '</tr>';
                }
            }
            $res = array("TotalRecord"=>$TotalRecord,"TotalPage"=>$TotalPage,"CurPage"=>$page,"lst"=>$_arrSpa,"str"=>$str);
            return $res;
        }
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
    public function clickbtnthem()
    {
        if(isset($_POST['themloaithe']))
        {
            $userid=$_SESSION['AccUser']['User']->UserId;
            $int=(string)"57".date("Y").date("m").date("d");
            $CardNo=$this->phatsinhma('membercard','CardNo',$int);
            $themloaithe=$_POST['themloaithe'];
            $themngayhethan=$_POST['themngayhethan'];
            $arrngayhh=explode("/",$themngayhethan);
            $themngayhethan=$arrngayhh[2]."-".$arrngayhh[0]."-".$arrngayhh[1];
            $themnguoidung=$_POST['themnguoidung'];
            $themuerid=$_POST['themuerid'];
            $themtrangthai=$_POST['themtrangthai'];
            $generatedID=rand(5873, 9932);
            $generatedID=md5(md5(md5($generatedID)));
            $generatedID=substr($generatedID,6,10);
            $sql="INSERT INTO `membercard` (`CardNo`, `CardHolderName`, `CreatedDate`, `RefUserID`, `Status`, `ExpireDate`, `CardType`, `generatedID`) 
                VALUES ('$CardNo', '$themnguoidung', NOW(), '$themuerid', '$themtrangthai', '$themngayhethan', '$themloaithe', '$generatedID')";
            $query=$this->db2->query($sql);
            if($query)
                $arr=array(
                            "sd"=>1,
                            "tb"=>"Thêm thành công",
                            "cardno"=>$CardNo,
                            "generatedID"=>$generatedID
                            );
            else
                $arr=array(
                            "sd"=>0,
                            "tb"=>"Thêm không thành công",
                            "cardno"=>"",
                            "generatedID"=>""
                            );
            return $arr;
        }
    } 
    public function searchmembercard()
    {
        //0: chua thanh toan ma huy
        //1:chua thanh toan
        //2:da thanh toan
        //3:member da thanh toan ma huy nhung cho xet duyet cua admin
        //4:xac nhan huy cua admin
        $str="";
        if(isset($_POST['Page']) && $_POST['Page']!="")
        {
            $page=$_POST['Page'];
            $sql = "SELECT a.*,b.`StrValue1` 
                        FROM `membercard` a, `commoncode` b 
                        WHERE a.`CardType`=b.`CommonId` AND b.`CommonTypeId`='MemberCard' ORDER BY a.`CardHolderName`";
            $sqlcount = "SELECT count(*) as totalrow 
                        FROM `membercard` a, `commoncode` b 
                        WHERE a.`CardType`=b.`CommonId` AND b.`CommonTypeId`='MemberCard' ORDER BY a.`CardHolderName`";
            
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            
            $Listbooking = $this->db2->query($sql)->result();
            $querycount = $this->db2->query($sqlcount)->row();
            
            $_arrSpa = $this->AddSTT($Listbooking,$page); 
            /// duyet cho stt zo
                   
            $TotalRecord = ( $querycount->totalrow);
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
            //echo $TotalPage;die;
            //print_r($_arrSpa);die;
            if(count($_arrSpa)>0)
            {
                foreach($_arrSpa as $rowarr)
                {
                    $str .= '<tr>';
                    $str .= '<td>'.$rowarr->STT.'</td>';
                    $str .= '<td>Mã thẻ: '.$rowarr->CardNo.'<br />Loại thẻ: '.$rowarr->StrValue1.'<br />Ngày tạo: '.$rowarr->CreatedDate.'<br />Ngày hết hạn: '.$rowarr->ExpireDate.'</td>';
                    $str .= '<td>Tên người dùng:'.$rowarr->CardHolderName.'<br />UserID: '.$rowarr->RefUserID.'</td>';
                    if($rowarr->Status==1 || $rowarr->Status=="1")
                        $str .= '<td>Đang sử dụng</td>';
                    else
                        $str .= '<td>Đã huỷ</td>';
                    $str .= '<td>'.$rowarr->generatedID.'</td>';
                    $str .= '<td>';
                        $str .= '<a href="javascript:void(0);" onclick="sua('.$rowarr->CardNo.')" title="Sửa"><img src="'.base_url('resources/images/icons/pencil.png').'" alt="Sửa" /></a> ';
                        $str .= ' <a href="javascript:void(0);" onclick="xoa('.$rowarr->CardNo.');"  title="Xóa"><img src="'.base_url('resources/images/icons/cross.png').'" alt="Xóa" /></a>';
                    $str .= '</td>';
                    $str .= '</tr>';
                }
            }
            $res = array("TotalRecord"=>$TotalRecord,"TotalPage"=>$TotalPage,"CurPage"=>$page,"lst"=>$_arrSpa,"str"=>$str);
            return $res;
        }
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
    public function sua()
    {
        if(isset($_POST['id']))
        {
            $id=$_POST['id'];
            $sql = "SELECT * FROM `membercard` WHERE `CardNo`='$id'";
            $query=$this->db2->query($sql)->row();
            
            $sql_loai="SELECT `CommonId`,`StrValue1` FROM `commoncode` WHERE `CommonTypeId`='MemberCard'";
            $query_loai=$this->db2->query($sql_loai)->result();
            $str="";
            foreach($query_loai as $row_loai)
            {
                if($query->CardType==$row_loai->CommonId)
                {
                    $str .= '<option value="'.$row_loai->CommonId.'" selected="selected">'.$row_loai->StrValue1.'</option>';
                }
                else
                {
                    $str .= '<option value="'.$row_loai->CommonId.'">'.$row_loai->StrValue1.'</option>';
                }
            }
            $strtt="";
            if($query->Status=="1" || $query->Status==1)
            {
                $strtt .= '<option value="1" selected="selected">Đang dùng</option>';
                $strtt .= '<option value="0">Đã huỷ</option>';
            }
            else
            {
                $strtt .= '<option value="1">Đang dùng</option>';
                $strtt .= '<option value="0" selected="selected">Đã huỷ</option>';
            }
            $arr=array("card"=>$query,"strloai"=>$str,"strtt"=>$strtt);
            return $arr;
        }
    }
    public function clickbtnsua()
    {
        if(isset($_POST['sualoaithe']))
        {
            $suacardno=$_POST['suacardno'];
            $sualoaithe=$_POST['sualoaithe'];
            $suangayhethan=$_POST['suangayhethan'];
            $arrngayhh=explode("/",$suangayhethan);
            $suangayhethan=$arrngayhh[2]."-".$arrngayhh[0]."-".$arrngayhh[1];
            $suanguoidung=$_POST['suanguoidung'];
            $suauerid=$_POST['suauerid'];
            $suatrangthai=$_POST['suatrangthai'];
            $sql="UPDATE `membercard` SET 
                `CardHolderName` = '$suanguoidung', 
                `RefUserID` = '$suauerid', `Status` = '$suatrangthai', `ExpireDate` = '$suangayhethan', `CardType` = '$sualoaithe' 
                WHERE `CardNo` = '$suacardno'";
            $query=$this->db2->query($sql);
            if($query)
                $arr=array(
                            "sd"=>1,
                            "tb"=>"Sửa thành công"
                            );
            else
                $arr=array(
                            "sd"=>0,
                            "tb"=>"Sửa không thành công"
                            );
            return $arr;
        }
    }
    public function xoa()
    {
        if(isset($_POST['id']))
        {
            $id=$_POST['id'];
            $page=$_POST['page'];
            //echo $_POST['page'];die;
            
            $del=$this->xoamembercard_theomembercardid($id);
            if($del)
                $arr=array("tt"=>1,"page"=>$page);
            else
                $arr=array("tt"=>0,"page"=>$page);
            return $arr;
        }
    }
    public function xoamembercard_theomembercardid($id)
    {
        $sql = "DELETE FROM `membercard` WHERE `CardNo` = $id";
        $query=$this->db2->query($sql);
        return $query;
    }
}
?>