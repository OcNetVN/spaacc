<?php 
class M_vouchertype extends CI_Model{
    public function __construct()
    { 
        parent::__construct();
        $this->db2 = $this->load->database('thebooking', TRUE);
    }
    public function btnthem()
    {
        if(isset($_POST['vouchertype']))
        {
            $userid=$_SESSION['AccUser']['User']->UserId;
            $vouchertype=$_POST['vouchertype'];
            $appid=$_POST['appid'];
            $mota=$_POST['mota'];
            $sql="INSERT INTO `vouchertype` (`id`, `VourcherType`, `AppID`, `Description`, `CreatedDate`, `CreatedBy`) 
                    VALUES (NULL, '$vouchertype', '$appid', '$mota', NOW(), '$userid')";
            $query=$this->db2->query($sql);
            if($query)
                $arr=array(
                            "sd"=>1,
                            "tb"=>"Thêm thành công"
                            );
            else
                $arr=array(
                            "sd"=>0,
                            "tb"=>"Thêm không thành công"
                            );
            return $arr;
        }
    } 
    public function searchvoucher()
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
            $sql = "SELECT * FROM `vouchertype` ORDER BY `VourcherType`";
            $sqlcount = "SELECT count(*) as totalrow 
                    FROM `vouchertype` ORDER BY `VourcherType`";
            
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
                    $str .= '<tr id="tr_'.$rowarr->id.'">';
                    $str .= '<td>'.$rowarr->STT.'</td>';
                    $str .= '<td>'.$rowarr->VourcherType.'</td>';
                    $str .= '<td>'.$rowarr->AppID.'</td>';
                    $str .= '<td>'.$rowarr->Description.'</td>';
                    $str .= '<td>';
                        $str .= '<a href="javascript:void(0);" onclick="sua('.$rowarr->id.')" title="Sửa"><img src="'.base_url('resources/images/icons/pencil.png').'" alt="Sửa" /></a> ';
                        $str .= ' <a href="javascript:void(0);" onclick="xoa('.$rowarr->id.');"  title="Xóa"><img src="'.base_url('resources/images/icons/cross.png').'" alt="Xóa" /></a>';
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
            $sql = "SELECT * FROM `vouchertype` WHERE `id`='$id'";
            $query=$this->db2->query($sql)->row();
            return $query;
        }
    }
    public function btnsua()
    {
        if(isset($_POST['vouchertype']))
        {
            $userid=$_SESSION['AccUser']['User']->UserId;
            $id=$_POST['id'];
            $vouchertype=$_POST['vouchertype'];
            $appid=$_POST['appid'];
            $mota=$_POST['mota'];
            $sql="UPDATE `vouchertype` 
                SET `VourcherType` = '$vouchertype', `AppID` = '$appid', `Description` = '$mota', `CreatedDate` = NOW(), `CreatedBy` = '$userid' 
                WHERE `id` = $id";
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
            $vouchertype=$this->layvouchertype_theoma($id);
            $vouchertypeid=$vouchertype->VourcherType;
            $totalvoucher=$this->layvoucher_theovouchertype($vouchertypeid)->totalrow;
            if($totalvoucher>0)
            {
                $arr=array("tt"=>2,"page"=>$page);
            }
            else
            {
                $del=$this->xoavouchertype_theovouchertypeid($id);
                if($del)
                    $arr=array("tt"=>1,"page"=>$page);
                else
                    $arr=array("tt"=>0,"page"=>$page);
            }
            return $arr;
        }
    }
    public function layvoucher_theovouchertype($vouchertypeid)
    {
        $sql = "SELECT COUNT(*) as totalrow FROM `voucher` WHERE `VoucherType`='$vouchertypeid'";
        $query=$this->db2->query($sql)->row();
        return $query;
    }
    public function xoavouchertype_theovouchertypeid($id)
    {
        $sql = "DELETE FROM `vouchertype` WHERE `id` = $id";
        $query=$this->db2->query($sql);
        return $query;
    }
    public function layvouchertype_theoma($vouchertypeid)
    {
        $sql = "SELECT * FROM `vouchertype` WHERE `id`='$vouchertypeid'";
        $query=$this->db2->query($sql)->row();
        return $query;
    }
}
?>