<?php 
class M_bookingsearch extends CI_Model{
    public function __construct()
    { 
        parent::__construct();
    }
            
    public function search_booking()
    {
        $str="";
        if(isset($_POST['Page']) && $_POST['Page']!="")
        {
            $page=$_POST['Page'];
            $sql = "SELECT * FROM `booking` ORDER BY `CreatedDate` DESC";
            $sqlcount = "SELECT count(*) as totalrow FROM `booking`";
            
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            
            $Listbooking = $this->db->query($sql)->result();
            $querycount = $this->db->query($sqlcount)->row();
            $arrre=array();
            for($i=0;$i<count($Listbooking);$i++)
            {
                $arrre[$i]['booking']=$Listbooking[$i];
                $bookingdetail= $this->laybookingdetailtheoid($Listbooking[$i]->bookingID);
                $arrre[$i]['bookingdetail']=$bookingdetail;
                $object=$this->layobjecttheobookingid($Listbooking[$i]->bookingID);
                $arrre[$i]['object']=$object;
            }
            //print_r($arrre);die;
            
            $_arrSpa = $this->AddSTT($arrre,$page); 
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
            //print_r($_arrSpa);die;
            if(count($_arrSpa)>0)
            {
                foreach($_arrSpa as $rowarr)
                {
                    $str .= '<tr>';
                    $str .= '<td>'.$rowarr['STT'].'</td>';
                    $str .= '<td>'.$rowarr['booking']->bookingID.'</td>';
                    $str .= '<td>'.$rowarr['bookingdetail'][0]->spaName.'</td>';
                    $str .= '<td>Tổng tiền '.number_format($rowarr['booking']->TotalAmt).'<br />Trạng thái: ';
                    if($rowarr['booking']->Status==2 || $rowarr['booking']->Status=='2')
                        $tthai="Đã thanh toán";
                    elseif($rowarr['booking']->Status==1 || $rowarr['booking']->Status=='1')
                        $tthai="Chưa thanh toán";
                    else
                        $tthai="Đã huỷ";
                    $str .=  $tthai;  
                    $str .= '</td>';
                    $str .= '<td>Người tạo: '.$rowarr['object']->FullName.'<br />Ngày tạo: '.$rowarr['booking']->CreatedDate.'</td>';
                    $str .= '<td>';                                        
                    $str .= '<a href="javascript:void(0);" onclick="xemdetail(\''.$rowarr['booking']->bookingID.'\',\'1\');" title="Xem chi tiết"><img src="'.base_url('resources/images/icons/show.png').'" alt="Xem chi tiết" /></a>';
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
            $arr1[$i]['STT'] = (($page-1)*10+($i+1));
        }
        return $arr1;
    }
    public function laybookingdetailtheoid($bookingid)
    {
        $sql="SELECT c.`Name`, d.`spaName`
                FROM `bookingdetails` b,`products` c,`spa` d 
                WHERE b.`ProductID`=c.`ProductID` AND c.`SpaID`=d.`spaID` AND b.`bookingID`='$bookingid'";
        $query=$this->db->query($sql)->result();
        return $query;
    }
    
    public function layobjecttheobookingid($bookingid)
    {
        $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
        $sql="SELECT a.* FROM `spabooking_thebookingdev`.`objects` a, `booking` b WHERE a.`ObjectId`=b.`ObjectID` AND b.`bookingID`= '$bookingid'";
        if(strpos($actual_link,"localhost")>0 || strpos($actual_link,"127.0.0.1")>0)
        {
             $sql="SELECT a.* FROM thebooking.`objects` a, `booking` b WHERE a.`ObjectId`=b.`ObjectID` AND b.`bookingID`= '$bookingid'";
        }
        $query=$this->db->query($sql)->row();
        return $query;
    }
    
    //searchproduct
    public function search_product(){
        if(isset($_POST["Page"]))
        {
            $productName    = $_POST['productName'];            
            $page       = $_POST["Page"];
          
            $sql = "SELECT '1' AS STT,products.*, spa.spaName FROM products, spa where spa.`spaID`=`products`.`SpaID` ";       
            $sql1 = "SELECT count(*) as Total FROM products , spa where spa.`spaID`=`products`.`SpaID` ";
                    
            if($productName !=''){
                $sql = $sql." and `Name` like '%".$productName."%'";
                $sql1 = $sql1." and `Name` like '%".$productName."%'";
            }
            
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            
            $_arrSpa = $this->AddSTT1($this->db->query($sql)->result(),$page); 
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
    }
     public function AddSTT1($arr,$page)
    {
        $arr1 = (array) $arr;
        for($i=0;$i<count($arr1);$i++)
        {
            $arr1[$i]->STT = (($page-1)*10+($i+1));
        }
        return $arr1;
    }
    //end search product
    //nhan nut tim
    public function btntim()
    {
        if(isset($_POST['dtimten']) || isset($_POST['dtimthanhtoan']))
        {
            $dtimten   = $_POST['dtimten'];            
            $dtimuserid  = $_POST['dtimuserid'];
            $dtimbookingid   = $_POST['dtimbookingid'];
            $dtimthanhtoan  = $_POST['dtimthanhtoan'];
            $dtimngay  = $_POST['dtimngay'];
            $dspanSPAList  = $_POST['dspanSPAList'];
            $dspanproductList = $_POST['dspanproductList'];
            $page       = $_POST["Page"];
            
            $List_ = explode(';', $dspanSPAList);
            $List_STR = "";
            for($i=0; $i<count($List_)-1;$i++)
            {
                if($i==0)
                {
                    $List_STR = $List_STR ."'" .$List_[$i]."'";
                }
                else
                {
                    $List_STR = $List_STR .",'" .$List_[$i]."'";
                }
            }
            $List_product = explode(';', $dspanproductList);
            $List_STRproduct = "";
            for($i=0; $i<count($List_product)-1;$i++)
            {
                if($i==0)
                {
                    $List_STRproduct = $List_STRproduct ."'" .$List_product[$i]."'";
                }
                else
                {
                    $List_STRproduct = $List_STRproduct .",'" .$List_product[$i]."'";
                }
            }
          
            $sql = "SELECT a.`bookingID`, a.`CreatedBy`, a.`CreatedDate`, a.`TotalAmt`, e.`FullName`, d.`spaName`, b.`Status`, d.`spaID`, c.`ProductID` 
            FROM `booking` a, `bookingdetails` b, `products` c, `spa` d, `spabooking_thebookingdev`.`objects` e 
            WHERE a.`bookingID`=b.`bookingID` AND b.`ProductID`=c.`ProductID` AND c.`SpaID`=d.`spaID` AND a.`ObjectID`=e.`ObjectId`";       
            $sql1 = "SELECT count(*) as Total 
            FROM `booking` a, `bookingdetails` b, `products` c, `spa` d, `spabooking_thebookingdev`.`objects` e 
            WHERE a.`bookingID`=b.`bookingID` AND b.`ProductID`=c.`ProductID` AND c.`SpaID`=d.`spaID` AND a.`ObjectID`=e.`ObjectId`";
             
            $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
            if(strpos($actual_link,"localhost")>0 || strpos($actual_link,"127.0.0.1")>0)
            {
                 $sql = "SELECT a.`bookingID`, a.`CreatedBy`, a.`CreatedDate`, a.`TotalAmt`, e.`FullName`, d.`spaName`, b.`Status`, d.`spaID`, c.`ProductID` 
                FROM `booking` a, `bookingdetails` b, `products` c, `spa` d, `thebooking`.`objects` e 
                WHERE a.`bookingID`=b.`bookingID` AND b.`ProductID`=c.`ProductID` AND c.`SpaID`=d.`spaID` AND a.`ObjectID`=e.`ObjectId`";       
                $sql1 = "SELECT count(*) as Total 
                FROM `booking` a, `bookingdetails` b, `products` c, `spa` d, `thebooking`.`objects` e 
                WHERE a.`bookingID`=b.`bookingID` AND b.`ProductID`=c.`ProductID` AND c.`SpaID`=d.`spaID` AND a.`ObjectID`=e.`ObjectId`";
            }
                   
            if($dtimten !=""){
                $sql = $sql." and e.`FullName` like '%".$dtimten."%'";
                $sql1 = $sql1." and e.`FullName` like '%".$dtimten."%'";
            }
            
            if($dtimuserid !=''){
                $sql = $sql." and a.`CreatedBy` like '%".$dtimuserid."%'";
                $sql1 = $sql1." and a.`CreatedBy` like '%".$dtimuserid."%'";
            }
            if($dtimbookingid !=''){
                $sql = $sql." and a.`bookingID` like '%".$dtimbookingid."%'";
                $sql1 = $sql1." and a.`bookingID` like '%".$dtimbookingid."%'";
            }
            if($dtimthanhtoan !=''){
                $sql = $sql." and b.`Status` like '%".$dtimthanhtoan."%'";
                $sql1 = $sql1." and b.`Status` like '%".$dtimthanhtoan."%'";
            }
            if($dtimngay !=''){
                $sql = $sql." and a.`CreatedDate` like '%".$dtimngay."%'";
                $sql1 = $sql1." and a.`CreatedDate` like '%".$dtimngay."%'";
            }
            if($dspanSPAList !='')
            {
                $sql = $sql." and d.`SpaID` in (".$List_STR.")";
                $sql1 = $sql1." and d.`SpaID` in  (".$List_STR.") ";
            }
            if($dspanproductList !='')
            {
                $sql = $sql." and  c.`ProductID` in (".$List_STRproduct.")";
                $sql1 = $sql1." and  c.`ProductID` in  (".$List_STRproduct.") ";
            }
            $sql .= " group by a.`bookingID` ORDER BY a.`CreatedDate` DESC";
            $sql1 .= " group by a.`bookingID` ORDER BY a.`CreatedDate` DESC";
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            
            $_arrSpa = $this->AddSTT1($this->db->query($sql)->result(),$page); 
            //$_arrSpa = $this->db->query($sql)->result(); 
            /// duyet cho stt zo
                   
            $ResTotalPage = $this->db->query($sql1)->result();
            $TotalRecord = ( count($ResTotalPage));
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
    }
    //end nhan nut tim
    //xem chi tiet
    public function xemdetail()
    {
        $sodong=0;
        $str="";
        if(isset($_POST['dbookingid']))
        {
            $dbookingid  = $_POST['dbookingid'];            
            $dpagetype  = $_POST['dpagetype'];
            $Page  = $_POST['Page'];
            $sql="SELECT a.`bookingID`, a.`CreatedDate`, a.`CreatedBy`, a.`Status` AS Statuschung, b.`Status`, a.`TotalAmt`, 
                    e.`FullName`, d.`spaName`, d.`spaID`, c.`ProductID`, c.`Name`, b.`FromTime`, b.`ToTime`, b.`Price`,b.`Qty`, 
                    e.`Tel` 
                FROM `booking` a, `bookingdetails` b, `products` c, `spa` d, `spabooking_thebookingdev`.`objects` e 
                WHERE a.`bookingID`=b.`bookingID` AND b.`ProductID`=c.`ProductID` AND c.`SpaID`=d.`spaID` 
                        AND a.`ObjectID`=e.`ObjectId` AND a.`bookingID`='$dbookingid'
                ORDER BY a.`CreatedDate` DESC";
            $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
            if(strpos($actual_link,"localhost")>0 || strpos($actual_link,"127.0.0.1")>0)
             {
                $sql="SELECT a.`bookingID`, a.`CreatedDate`, a.`CreatedBy`, a.`Status` AS Statuschung, b.`Status`, a.`TotalAmt`, 
                    e.`FullName`, d.`spaName`, d.`spaID`, c.`ProductID`, c.`Name`, b.`FromTime`, b.`ToTime`, b.`Price`,b.`Qty`, 
                    e.`Tel` 
                FROM `booking` a, `bookingdetails` b, `products` c, `spa` d, `thebooking`.`objects` e 
                WHERE a.`bookingID`=b.`bookingID` AND b.`ProductID`=c.`ProductID` AND c.`SpaID`=d.`spaID` 
                        AND a.`ObjectID`=e.`ObjectId` AND a.`bookingID`='$dbookingid'
                ORDER BY a.`CreatedDate` DESC";
             }
            $query=$this->db->query($sql)->result();
            $sodong=count($query);
            
            //noidung
            if($sodong>0)
            {
                $str .= '<div style="margin-left:20px;">';
                $str .= '<table width="100%" border="0">';
                $str .= '<tr>';
                $str .= '<td><strong>Mã đặt chổ: </strong></td>';
                $str .= '<td>'.$query[0]->bookingID.'</td>';
                $str .= '<td><strong>Tên người tạo:</strong></td>';
                $str .= '<td>'.$query[0]->FullName.'</td>';
                $str .= '</tr>';
                $str .= '<tr>';
                $str .= '<td><strong>Userid đăng nhập:</strong></td>';
                $str .= '<td>'.$query[0]->CreatedBy.'</td>';
                $str .= '<td><strong>Ngày tạo:</strong></td>';
                $str .= '<td>'.$query[0]->CreatedDate.'</td>';
                $str .= '</tr>';
                $str .= '<tr>';
                $str .= '<td><strong>Mã spa:</strong></td>';
                $str .= '<td>'.$query[0]->spaID.'</td>';
                $str .= '<td><strong>Tổng tiền:</strong></td>';
                $str .= '<td>'.number_format($query[0]->TotalAmt).' VNĐ</td>';
                $str .= '</tr>';
                $str .= '<tr>';
                $str .= '<td><strong>Tên spa:</strong></td>';
                $str .= '<td>'.$query[0]->spaName.'</td>';
                $str .= '<td><strong>Tình trạng chung:</strong></td>';
                $str .= '<td>';
                    $ttrang="";
                    if($query[0]->Statuschung==2 || $query[0]->Statuschung=='2')
                        $ttrang="Đã thanh toán";
                    if($query[0]->Statuschung==1 || $query[0]->Statuschung=='1')
                        $ttrang="Chưa thanh toán";
                    if($query[0]->Statuschung==0 || $query[0]->Statuschung=='0')
                        $ttrang="Đã huỷ";
                    $str .= $ttrang;
                $str .= '</td>';
                $str .= '</tr>';
                $str .= '<tr>';
                $str .= '<td colspan="6">&nbsp;</td>';
                $str .= '</tr>';
                $str .= '<tr>';
                $str .= '<td><strong>Tên sản phẩm</strong></td>';
                $str .= '<td><strong>Giá</strong></td>';
                $str .= '<td><strong>Số lượng</strong></td>';
                $str .= '<td><strong>Tổng tiền</strong></td>';
                $str .= '<td><strong>Trạng thái</strong></td>';
                $str .= '<td><strong>Thời gian</strong></td>';
                $str .= '</tr>';
                foreach($query as $row)
                {
                    $str .= '<tr>';
                        $str .= '<td>'.$row->Name.'</td>';
                        $str .= '<td>'.number_format($row->Price).' VNĐ</td>';
                        $str .= '<td>'.number_format($row->Qty).' VNĐ</td>';
                        $str .= '<td>'.number_format($row->Price*$row->Qty).' VNĐ</td>';
                        $str .= '<td>';
                            $tthai="";
                            if($row->Status==2 || $row->Status=='2')
                                $tthai="Đã thanh toán";
                            if($row->Status==1 || $row->Status=='1')
                                $tthai="Chưa thanh toán";
                            if($row->Status==0 || $row->Status=='0')
                                $tthai="Đã huỷ";
                            $str .= $tthai;
                        $str .= '</td>';
                        $str .= '<td>Từ: '.$row->FromTime.'<br />Đến: '.$row->ToTime.'</td>';
                    $str .= '</tr>';
                }
                $str .= '</tr>';
                $str .= '</table>';
                $str .= '</div>';
            }
            else
                $str= '<div style="color:#F00; font-weight:bold; margin: 20px 20px;">Không tìm thấy kết quả</div>';
            
            $arr=array(
                    "str"=>$str,"dpagetype"=>$dpagetype,"Page"=>$Page
                        );
            return $arr;
        }
    }
    //end xem chi tiet
}
?>