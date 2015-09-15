<?php
class M_indexuser extends CI_Model{
    public $errorStr; 
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('thebooking', TRUE);
    }
        //0: chua thanh toan ma huy
        //1:chua thanh toan
        //2:da thanh toan
        //3:member da thanh toan ma huy nhung cho xet duyet cua admin
        //4:xac nhan huy cua admin
        //5: xac nhan khong cho huy cua admin
        
        //6: table booking: co nhieu sp trong 1 booking co huy THANH CONG + CHUA HUY
        //7: table booking: co nhieu sp trong 1 booking co DANG CHO DUYET + CHUA HUY
        //8: table booking: co nhieu sp trong 1 booking co huy THANH CONG + DANG CHO DUYET
        //9: table booking: co nhieu sp trong 1 booking co huy THANH CONG + DANG CHO DUYET + CHUA HUY
        //10: table booking: co nhieu sp trong 1 booking co xac nhan huy cua admin
        //11: table booking: co nhieu sp trong 1 booking co xac nhan KHONG DUOC huy cua admin
    public function loadService()
    {
        if(isset($_POST['dpage']))
        {
            $page=$_POST['dpage'];
            $userid=$_SESSION['AccUser']['User']->UserId;
            if($page==1 || $page<1 || $page=="")
                $start=0;
            else
                $start=6*($page-1)+1;
            $limit=6;
                        
            $sql="SELECT a.*,b.`CreatedBy`,b.`CreatedDate`,`c`.`Name`,`d`.`spaName` 
                FROM `bookingdetails` a,`booking` b,`products` c,`spa` d 
                WHERE a.`bookingID` = b.`bookingID` 
                        AND c.`ProductID`=a.`ProductID` 
                        AND c.`SpaID`=d.`spaID` 
                        AND b.`CreatedBy`='$userid' 
                        ORDER BY b.`CreatedDate` DESC 
                        limit $start,$limit";
            //echo $sql;die;
            $res_list=$this->db->query($sql)->result();
            //print_r($res_list);die;
            $sql_count="SELECT COUNT(*) as total FROM `bookingdetails`,`booking` WHERE `booking`.`bookingID`=`bookingdetails`.`bookingID` AND `booking`.`CreatedBy`='$userid'";
            $query_count=$this->db->query($sql_count)->row();
            $res_count=$query_count->total;
            
            //tao giao dien
            $str_res="";
            if($res_count>0)
            {
                $str_res.='<table class="table table-striped table-hover table-responsive" width="100%" border="0" cellspacing="0" cellpadding="0">';
                  $str_res.='<tr>';
                    $str_res.='<th>Tên sản phẩm, dịch vụ</th>';
                    $str_res.='<th>Mã đặt chổ</th>';
                    $str_res.='<th>Ngày đặt</th>';
                    $str_res.='<th>Từ</th>';
                    $str_res.='<th>Đến</th>';
                    $str_res.='<th>Địa điểm spa</th>';
                    $str_res.='<th align="right" nowrap="nowrap">Giá</th>';
                    $str_res.='<th align="left">Trạng thái</th>';
                    $str_res.='<th align="left">Tình trạng</th>';
                    $str_res.='<th align="left"></th>';
                  $str_res.='</tr>';
                    foreach($res_list as $row)
                    {
                        $str_res.='<tr>';
                            $str_res.='<td valign="top"><strong>'.$row->Name.'</strong></td>';
                            $temid= (int)substr($row->bookingID,-6);
                            $shotbookingID="99#".$temid;
                            $str_res.='<td valign="top">'.$shotbookingID.'</td>';
                            $str_res.='<td valign="top">'.$row->CreatedDate.'</td>';
                            $str_res.='<td valign="top">'.$row->FromTime.'</td>';
                            $str_res.='<td valign="top">'.$row->ToTime.'</td>';
                            $str_res.='<td valign="top">'.$row->spaName.'</td>';
                            $str_res.='<td align="right" valign="top" nowrap="nowrap">'.number_format($row->AmtAT).' VNĐ</td>';
                            if($row->ToTime)
                            $ngayhomnay = date("Y-m-d h:m:s");
                            $ngayhenhan=$row->ToTime;
                            if(strtotime($ngayhenhan)>=strtotime($ngayhomnay))
                                $status='<span class="text-blue">Còn hạn</span>';
                            else
                                $status='<span class="text-red">Hết hạn</span>';
                            $str_res.='<td align="left" valign="top">'.$status.'</td>';
                            if($row->Status=='0')
                                $ttrang = "Đã huỷ";
                            else
                            {
                                if($row->Status=='1')
                                    $ttrang = "Chưa thanh toán";
                                else
                                    if($row->Status=='3')
                                        $ttrang = "Chờ xác nhận huỷ";
                                    else
                                        if($row->Status=='4')
                                            $ttrang = "Đã huỷ";
                                        else
                                            if($row->Status=='5')
                                                $ttrang = "Không được huỷ";
                                            else
                                                if($row->Status=='2')
                                                    $ttrang = "Đã thanh toán";
                            }
                                
                            $str_res.='<td align="left" valign="top">'.$ttrang.'</td>';
                            ////
                            $fromtime=$row->FromTime;
                            $diff = abs(strtotime($fromtime) - strtotime($ngayhomnay));
                            $hours = floor(($diff)/(60*60));
                            if($hours >= 48 && strtotime($fromtime)>strtotime($ngayhomnay) && ($row->Status!=0 && $row->Status!="0" && $row->Status!=3 && $row->Status!="3" && $row->Status!=5 && $row->Status!="5" && $row->Status!=4 && $row->Status!="4"))
                                $str_res.='<td align="left" valign="top"><a href="javascript:void(0);" onClick="cancelbooking('.$row->id.','.$page.');">Huỷ</a></td>';
                            else
                                $str_res.='<td align="left" valign="top"></td>';
                          $str_res.='</tr>';
                    }                         
                $str_res.='</table>';
            }
            
            //tinh so trang
            $num_page=ceil($res_count/6);
            $str_numpage="";
            if($num_page>0)
            {
                $str_numpage .= '<ul class="pagination pull-right">';
                    $str_numpage .= '<li class="disabled"><a href="javascript:void(0);"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>';
                    for($i=1;$i<=$num_page;$i++)
                    {
                        $str_numpage .= '<li><a href="javascript:void(0);" onclick="loadService('.$i.')">'.$i.' <span class="sr-only">(current)</span></a></li>';
                    }
                    //<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                    //if($i==)
                    $str_numpage .= '<li><a href="javascript:void(0);" onclick="loadService('.($i+1).')"><span class="sr-only">Next</span></a></li>';
                  $str_numpage .='</ul>';
            }
            //tinh outstanding
            $str_outstanding="";
            $ttuser_db2 = $this->layuser_db2_theouserid($userid); //lay table user trong database 2
            if(isset($ttuser_db2->OutStanding) && $ttuser_db2->OutStanding!="" && ($ttuser_db2->OutStanding)>0)
            {
                $str_outstanding.= "Số dư: <span>".number_format($ttuser_db2->OutStanding)."</span> VNĐ";
            }
            else
                $str_outstanding.= "Số dư: 0 VNĐ";
            //tinh outstanding
            $res = array("str"=>$str_res,"str_numpage"=>$str_numpage,"str_outstanding"=>$str_outstanding);
            return $res;  
        }   
    }
    public function cancelbooking()
    {
        if(isset($_POST['dbookingid']))
        {
            $userid=$_SESSION['AccUser']['User']->UserId;
            $outstanding=0;
            $bookingid=$_POST['dbookingid'];//id nay khong phai labooking id ma la id stt
            $page=$_POST['dpage'];
            $sql_idupdate="SELECT * FROM `bookingdetails` WHERE `id`='$bookingid'";
            $booking_update=$this->db->query($sql_idupdate)->row();
            $outstanding=$booking_update->TotalAmt;
            $bookingID_update=$booking_update->bookingID;
            $ProductID_update=$booking_update->ProductID;
            $stt_update=$booking_update->Status;
            
            $this->db->trans_start();
                    if($stt_update==1 || $stt_update=="1") //chua thanh toan ma huy
                    {
                        $sql="UPDATE `bookingdetails` SET `Status` = '0' WHERE `id` = $bookingid";
                    }
                    if($stt_update==2 || $stt_update=="2") //da thanh toan ma huy
                    {
                        $sql="UPDATE `bookingdetails` SET `Status` = '3' WHERE `id` = $bookingid";
                    }
                    $this->db->query($sql);
                    
                    //$sql_updateoutstanding="INSERT INTO `outstanding` (`id`, `UserId`, `TotalAmt`, `Ref`, `CreatedBy`, `CreatedDate`) 
                            //VALUES (NULL, '$userid', '$outstanding', 'abc@gmail.com', '$userid', NOW())";
                    //$this->db2->query($sql_updateoutstanding);
                    
                    $sql_counttotal="SELECT count(*) as totalrow FROM `bookingdetails` WHERE `bookingID`='$bookingID_update'";
                    $countrowtotal=$this->db->query($sql_counttotal)->row()->totalrow;
                    
                    $sql_count_chuatt="SELECT count(*) as totalrow FROM `bookingdetails` WHERE `bookingID`='$bookingID_update' and `Status`=0"; 
                    $countrowchuatt=$this->db->query($sql_count_chuatt)->row()->totalrow;
                    
                    $sql_count_datt="SELECT count(*) as totalrow FROM `bookingdetails` WHERE `bookingID`='$bookingID_update' and `Status`=3"; 
                    $countrowdatt=$this->db->query($sql_count_datt)->row()->totalrow;
                    
                    if($countrowchuatt==$countrowtotal)
                    {
                        $sql_booking="UPDATE `booking` SET `Status` = '0' WHERE `bookingID` = '$bookingID_update'";
                        $this->db->query($sql_booking);
                    }
                    if($countrowdatt==$countrowtotal)
                    {
                        $sql_booking="UPDATE `booking` SET `Status` = '3' WHERE `bookingID` = '$bookingID_update'";
                        $this->db->query($sql_booking);
                    }
                    if($countrowchuatt<$countrowtotal && $countrowdatt==0)
                    {
                        $sql_booking="UPDATE `booking` SET `Status` = '6' WHERE `bookingID` = '$bookingID_update'";
                        $this->db->query($sql_booking);
                    }
                    if($countrowdatt<$countrowtotal && $countrowchuatt==0)
                    {
                        $sql_booking="UPDATE `booking` SET `Status` = '7' WHERE `bookingID` = '$bookingID_update'";
                        $this->db->query($sql_booking);
                    }
                    if(($countrowchuatt+$countrowdatt)==$countrowtotal && $countrowchuatt!=0 && $countrowdatt!=0)
                    {
                        $sql_booking="UPDATE `booking` SET `Status` = '8' WHERE `bookingID` = '$bookingID_update'";
                        $this->db->query($sql_booking);
                    }
                    if(($countrowchuatt+$countrowdatt)<$countrowtotal && $countrowchuatt!=0 && $countrowdatt!=0)
                    {
                        $sql_booking="UPDATE `booking` SET `Status` = '9' WHERE `bookingID` = '$bookingID_update'";
                        $this->db->query($sql_booking);
                    }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $tb="";
                break;
            }
            else
            {
                $tb="ok";
            }
            $res = array("tb"=>$tb,"page"=>$page);
            return $res; 
        }
    }
    public function countbookingid()
    {
        $userid=$_SESSION['AccUser']['User']->UserId;
        $sql_count="SELECT COUNT(*) as total FROM `bookingdetails`,`booking` 
                    WHERE `booking`.`bookingID`=`bookingdetails`.`bookingID` AND `booking`.`CreatedBy`='$userid'";
                    //echo $sql_count;die;
        $query_count=$this->db->query($sql_count)->row();
        return $query_count;
    }
    public function layobjecttheouserid($userid)
    {
        $sql="SELECT a.`UserId`,b.* FROM `users` a, `objects` b WHERE a.`ObjectId`=b.`ObjectId` AND a.`UserId`='$userid'";
        $query=$this->db2->query($sql)->row();
        return $query;
    }
    public function layhinhtheoobject($objectid)
    {
        $sql_hinh="SELECT * FROM `objectlinks` WHERE `ObjectIDD`='$objectid' ORDER BY id desc";
        $query_hinh=$this->db2->query($sql_hinh)->result();
        return $query_hinh;
    }
    public function layuser_db2_theouserid($userid)
    {
        $sql="SELECT * FROM `users` WHERE `UserId`='$userid'";
        $query=$this->db2->query($sql)->row();
        return $query;
    }
    public function nsertobjectlinks($objectid,$urlhinh)
    {
        $userid=$_SESSION['AccUser']['User']->UserId;
        $FileExtension=substr($urlhinh,-3);
        $arr=explode("/",$urlhinh);
        $vtfilename=count($arr)-1;
        $FileName=$arr[$vtfilename];
        $sqldelete="DELETE FROM `objectlinks` WHERE `ObjectIDD` = '$objectid'";
        $this->db2->query($sqldelete);
        $sql="INSERT INTO `objectlinks` (`id`, `ObjectIDD`, `URL`, `Type`, `FileExtension`, `FileName`, `Status`, `UploadedBy`, `UploadedDate`) 
        VALUES (NULL, '$objectid', '$urlhinh', 'USER', '$FileExtension', '$FileName', '1', '$userid', NOW())";
        $query=$this->db2->query($sql);
        return $query;
    }
    public function rrmdir($dir) {
       if (is_dir($dir)) {
         $objects = scandir($dir);
         foreach ($objects as $object) {
           if ($object != "." && $object != "..") {
             if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
           }
         }
         reset($objects);
         rmdir($dir);
       }
     }
        
}
?>