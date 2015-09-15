<?php 
class M_bookingpayment extends CI_Model{
    public function __construct()
    { 
        parent::__construct();
        $this->db2 = $this->load->database('thebooking', TRUE);
        $this->load->model('m_sms');
        $this->load->model('admin/m_user');
        $this->load->model('m_mail');
        $this->load->model('m_checkout');
    }
            
    public function search_booking()
    {
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
        $str="";
        if(isset($_POST['Page']) && $_POST['Page']!="")
        {
            $page               =   $_POST['Page'];
            $txtspanamesearch   =   $_POST['txtspanamesearch'];
            $txtdatesearch      =   $_POST['txtdatesearch'];
            
            $sql_plus = "";
            if($txtspanamesearch !="")
                $sql_plus .= " AND c.`spaName` like '%$txtspanamesearch%'";
            if($txtdatesearch    !="")
            {
                $arr_day = explode("/",$txtdatesearch);
                $str_day  = $arr_day[2]."-".$arr_day[0]."-".$arr_day[1];
                $sql_plus .= " AND e.`CreatedDate` like '$str_day%'";
            }
            $sql = "SELECT a.`bookingID`,a.`Qty`,a.`Price`,a.`FromTime`,a.`ToTime`,b.`Name`,c.`spaName`,d.`FullName`,d.`ObjectId`,d.`Email`,f.`UserId`, e.`CreatedBy`, e.`CreatedDate`, b.`ProductID` 
                    FROM `bookingdetails` a,`products` b, `spa` c, `spabooking_thebookingdev`.`objects` d, `booking` e, `spabooking_thebookingdev`.`users` f 
                    WHERE e.`bookingID`=a.`bookingID` AND a.`ProductID`=b.`ProductID` AND d.ObjectId=f.ObjectId 
                        AND b.`SpaID`=c.`spaID` AND e.`ObjectID`=d.`ObjectId` AND a.`Status`=1 $sql_plus";
             
            $sqlcount = "SELECT count(*) as totalrow 
                    FROM `bookingdetails` a,`products` b, `spa` c, `spabooking_thebookingdev`.`objects` d, `booking` e, `spabooking_thebookingdev`.`users` f 
                    WHERE e.`bookingID`=a.`bookingID` AND a.`ProductID`=b.`ProductID` AND d.ObjectId=f.ObjectId 
                        AND b.`SpaID`=c.`spaID` AND e.`ObjectID`=d.`ObjectId` AND a.`Status`=1 $sql_plus";
                                  
            $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
             if(strpos($actual_link,"localhost")>0 || strpos($actual_link,"127.0.0.1")>0)
            {
                $sql = "SELECT a.`bookingID`,a.`Qty`,a.`Price`,a.`FromTime`,a.`ToTime`,b.`Name`,c.`spaName`,d.`FullName`,d.`ObjectId`,d.`Email`,f.`UserId`, e.`CreatedBy`, e.`CreatedDate`, b.`ProductID` 
                    FROM `bookingdetails` a,`products` b, `spa` c, `thebooking`.`objects` d, `booking` e, `thebooking`.`users` f 
                    WHERE e.`bookingID`=a.`bookingID` AND a.`ProductID`=b.`ProductID` AND d.ObjectId=f.ObjectId 
                    AND b.`SpaID`=c.`spaID` AND e.`ObjectID`=d.`ObjectId` AND a.`Status`=1 $sql_plus";
                
            }
            
            if(strpos($actual_link,"localhost")>0 || strpos($actual_link,"127.0.0.1")>0)
            {
                $sqlcount = "SELECT count(*) as totalrow 
                        FROM `bookingdetails` a,`products` b, `spa` c, `thebooking`.`objects` d, `booking` e, `thebooking`.`users` f 
                        WHERE e.`bookingID`=a.`bookingID` AND a.`ProductID`=b.`ProductID` AND d.ObjectId=f.ObjectId 
                    	    AND b.`SpaID`=c.`spaID` AND e.`ObjectID`=d.`ObjectId` AND a.`Status`=1 $sql_plus";
                
            }
            
            // export excel 
            $sql_excel = $sql;
            $arr_excel = $this->db->query($sql_excel)->result();
            if(count($arr_excel)>0)
                $_SESSION['array_excel']=$arr_excel;
            // end export excel
                
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            
            $Listbooking = $this->db->query($sql)->result();
            $querycount = $this->db->query($sqlcount)->row();
            
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
            //print_r($_arrSpa);die;
            if(count($_arrSpa)>0)
            {
                foreach($_arrSpa as $rowarr)
                {
                    $str .= '<tr id="tr_'.$rowarr->bookingID.'">';
                    $str .= '<td>'.$rowarr->STT.'</td>';
                    $str .= '<td>'.$rowarr->bookingID.'</td>';
                    $str .= '<td>'.$rowarr->spaName.'</td>';
                    $str .= '<td>Tên sản phẩm: '.$rowarr->Name.'<br />Tổng tiền: ';
                        $ttien=$rowarr->Qty*$rowarr->Price;
                        $str .= number_format($ttien).'<br />Từ: '.$rowarr->FromTime.'<br />Đến: '.$rowarr->ToTime;
                    $str .= '</td>';
                    $str .= '<td>Người tạo: '.$rowarr->FullName.'<br />Ngày tạo: '.$rowarr->CreatedDate.'</td>';
                    $str .= '<td>';                                        
                    $str .= ' <input type="radio" name="payment" id="athome" value="03" onclick="checkpayment(\'03\',\''.$rowarr->bookingID.'\',\''.$rowarr->ProductID.'\',\''.$rowarr->UserId.'\',\''.$rowarr->Email.'\',\''.$rowarr->ObjectId.'\');"/>
                              Tại nhà 
                              <input type="radio" name="payment" id="atvanue" value="02" onclick="checkpayment(\'02\',\''.$rowarr->bookingID.'\',\''.$rowarr->ProductID.'\',\''.$rowarr->UserId.'\',\''.$rowarr->Email.'\',\''.$rowarr->ObjectId.'\');"/>
                              Tại Spa';
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
    public function checkpayment()
    {
        if(isset($_POST['dpage']))
        {
            $page=$_POST['dpage'];
            $dpaymenttype=$_POST['dpaymenttype'];
            $dbookingid=$_POST['dbookingid'];
            $dproductid=$_POST['dproductid'];
            $UserId=$_POST['UserId'];
            $Email=$_POST['Email'];
            $ObjectId=$_POST['ObjectId'];
            $sql= "UPDATE `bookingdetails` SET `Status` = '2' WHERE `ProductID` = '$dproductid' AND `bookingID`='$dbookingid'";
            //$sql= "select * from `bookingdetails`";
            $res = 0;
            try{
                 $this->db->query($sql);
                $res = 1;
            }
            catch(exception $e){
                $res = 0;
            }
            $arr = array("status"=>$res,"page"=>$page,"arr_bookingid"=>$dbookingid,"UserId"=>$UserId,"Email"=>$Email,"ObjectId"=>$ObjectId);
            return $arr;
        }
    }
    //nghia viet them 14/1/2015
    public function searchcancel()
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
            $txtspanamesearch   =   $_POST['txtspanamesearch'];
            $txtdatesearch      =   $_POST['txtdatesearch'];
            
            $sql_plus = "";
            if($txtspanamesearch !="")
                $sql_plus .= " AND c.`spaName` like '%$txtspanamesearch%'";
            if($txtdatesearch    !="")
            {
                $arr_day = explode("/",$txtdatesearch);
                $str_day  = $arr_day[2]."-".$arr_day[0]."-".$arr_day[1];
                $sql_plus .= " AND e.`CreatedDate` like '$str_day%'";
            }
            
            $sql = "SELECT a.`id`, a.`bookingID`,a.`Qty`,a.`Price`,a.`FromTime`,a.`ToTime`,a.`Status`,b.`Name`,c.`spaName`,d.`FullName`, e.`CreatedBy`, e.`CreatedDate`, b.`ProductID` 
                    FROM `bookingdetails` a,`products` b, `spa` c, `spabooking_thebookingdev`.`objects` d, `booking` e 
                    WHERE e.`bookingID`=a.`bookingID` AND a.`ProductID`=b.`ProductID` 
                    	AND b.`SpaID`=c.`spaID` AND e.`ObjectID`=d.`ObjectId` AND (a.`Status`=0 OR a.`Status`=3 OR a.`Status`=4)$sql_plus ORDER BY a.`id` DESC";
            $sqlcount = "SELECT count(*) as totalrow  
                    FROM `bookingdetails` a,`products` b, `spa` c, `spabooking_thebookingdev`.`objects` d, `booking` e 
                    WHERE e.`bookingID`=a.`bookingID` AND a.`ProductID`=b.`ProductID` 
                    	AND b.`SpaID`=c.`spaID` AND e.`ObjectID`=d.`ObjectId` AND (a.`Status`=0 OR a.`Status`=3 OR a.`Status`=4)$sql_plus";
            $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
             if(strpos($actual_link,"localhost")>0 || strpos($actual_link,"127.0.0.1")>0)
            {
                $sql = "SELECT a.`id`, a.`bookingID`,a.`Qty`,a.`Price`,a.`FromTime`,a.`ToTime`,a.`Status`,b.`Name`,c.`spaName`,d.`FullName`, e.`CreatedBy`, e.`CreatedDate`, b.`ProductID` 
                    FROM `bookingdetails` a,`products` b, `spa` c, `thebooking`.`objects` d, `booking` e 
                    WHERE e.`bookingID`=a.`bookingID` AND a.`ProductID`=b.`ProductID` 
                        AND b.`SpaID`=c.`spaID` AND e.`ObjectID`=d.`ObjectId` AND (a.`Status`=0 OR a.`Status`=3 OR a.`Status`=4)$sql_plus ORDER BY a.`id` DESC";
                $sqlcount = "SELECT count(*) as totalrow  
                    FROM `bookingdetails` a,`products` b, `spa` c, `thebooking`.`objects` d, `booking` e 
                    WHERE e.`bookingID`=a.`bookingID` AND a.`ProductID`=b.`ProductID` 
                        AND b.`SpaID`=c.`spaID` AND e.`ObjectID`=d.`ObjectId` AND (a.`Status`=0 OR a.`Status`=3 OR a.`Status`=4)$sql_plus";  
            }
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            
            $Listbooking = $this->db->query($sql)->result();
            $querycount = $this->db->query($sqlcount)->row();
            
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
            //print_r($_arrSpa);die;
            if(count($_arrSpa)>0)
            {
                foreach($_arrSpa as $rowarr)
                {
                    $str .= '<tr id="tr_'.$rowarr->bookingID.'">';
                    $str .= '<td>'.$rowarr->STT.'</td>';
                    $str .= '<td>'.$rowarr->bookingID.'</td>';
                    $str .= '<td>'.$rowarr->spaName.'</td>';
                    $str .= '<td>Tên sản phẩm: '.$rowarr->Name.'<br />Tổng tiền: ';
                        $ttien=$rowarr->Qty*$rowarr->Price;
                        $str .= number_format($ttien).'<br />Từ: '.$rowarr->FromTime.'<br />Đến: '.$rowarr->ToTime;
                    $str .= '</td>';
                    $str .= '<td>Người tạo: '.$rowarr->FullName.'<br />Ngày tạo: '.$rowarr->CreatedDate.'</td>';
                    $str .= '<td>';    
                    if($rowarr->Status==3 || $rowarr->Status=="3")    
                    {
                        $str .= '<input type="button" class="button" id="btnhuytt" onclick="btnhuytt(\''.$rowarr->id.'\',\''.$page.'\');" value="Huỷ"/>&nbsp;';
                        $str .= '<input type="button" class="button" id="btnkhongchohuytt" onclick="btnkhongchohuytt(\''.$rowarr->id.'\',\''.$page.'\');" value="Không cho huỷ"/>';
                    }   
                    $str .= '</td>';
                    $str .= '</tr>';
                }
            }
            $res = array("TotalRecord"=>$TotalRecord,"TotalPage"=>$TotalPage,"CurPage"=>$page,"lst"=>$_arrSpa,"str"=>$str);
            return $res;
        }
    }
    public function btnhuytt()
    {
        if(isset($_POST['bookingdetailid']) && isset($_POST['page']))
        {
            $userid=$_SESSION['AccUser']['User']->UserId;
            $bookingdetailid=$_POST['bookingdetailid'];
            //echo $bookingdetailid;
            $page=$_POST['page'];
            $sql="SELECT * FROM `bookingdetails` WHERE `id`=$bookingdetailid";
            $query=$this->db->query($sql)->row();
            $tien=$query->TotalAmt;
            $bookingID=$query->bookingID;
            $sql_book="SELECT * FROM `booking` WHERE `bookingID`=$bookingID";
            $query_book=$this->db->query($sql_book)->row();
            $ObjectID=$query_book->ObjectID;
            $userid_book=$query_book->CreatedBy;
            $tien=-$tien;
            $stt=$query->Status;
            if($stt==3 || $stt=="3")
            {
                $sql_update="UPDATE `bookingdetails` SET `Status` = '4' WHERE `id` = $bookingdetailid";
                $query_update=$this->db->query($sql_update);
                $sql_updatebooking="UPDATE `booking` SET `Status` = '10' WHERE `bookingID` = '$bookingID'";
                $query_updatebooking=$this->db->query($sql_updatebooking);
                if($query_update && $query_updatebooking)
                {
                    $sql_user="INSERT INTO `outstanding` (`id`, `UserId`, `TotalAmt`, `Ref`, `CreatedBy`, `CreatedDate`) 
                    VALUES (NULL, '$userid_book', '$tien', '$bookingID', '$userid', NOW())";
                    $this->db2->query($sql_user);
                    $sql_cmcode="SELECT * FROM `commoncode` WHERE `CommonTypeId`='ScoreRate' AND `CommonId`='03'";
                    $query_cmcode=$this->db->query($sql_cmcode)->row();
                    if(count($query_cmcode)>0)
                        $moneychange=$query_cmcode->NumValue1;
                    else
                        $moneychange=500;
                    $tien=-$tien;
                    $diem=floor((float)$tien/$moneychange);
                    $diem=-$diem;
                    $sql_scoretrans="INSERT INTO `scoretrans` (`Id`, `ObjectIDD`, `RefID`, `TotalScore`, `CreatedDate`, `CreatedBy`, `Description`, `Type`) 
                        VALUES (NULL, '$userid_book', '$bookingID', '$diem', NOW(), '$userid', 'Cancel booking in admin panel', 'MEMBER')";
                    $this->db2->query($sql_scoretrans);    
                    $arr=array("tb"=>"1","page"=>$page);
                }
                else
                    $arr=array("tb"=>"0","page"=>$page);
            }
            else
                $arr=array("tb"=>"0","page"=>$page);
            return $arr;
        }
    }
    public function btnkhongchohuytt()
    {
        if(isset($_POST['bookingdetailid']) && isset($_POST['page']))
        {
            $userid=$_SESSION['AccUser']['User']->UserId;
            $bookingdetailid=$_POST['bookingdetailid'];
            $page=$_POST['page'];
            $sql="SELECT * FROM `bookingdetails` WHERE `id`=$bookingdetailid";
            $query=$this->db->query($sql)->row();
            $tien=$query->TotalAmt;
            $bookingID=$query->bookingID;
            $tien=-$tien;
            $stt=$query->Status;
            if($stt==3 || $stt=="3")
            {
                $sql_update="UPDATE `bookingdetails` SET `Status` = '5' WHERE `id` = $bookingdetailid";
                $query_update=$this->db->query($sql_update);
                $sql_updatebooking="UPDATE `booking` SET `Status` = '11' WHERE `bookingID` = '$bookingID'";
                $query_updatebooking=$this->db->query($sql_updatebooking);
                if($query_update && $query_updatebooking)
                {
                    /*$sql_user="INSERT INTO `outstanding` (`id`, `UserId`, `TotalAmt`, `Ref`, `CreatedBy`, `CreatedDate`) 
                    VALUES (NULL, '$userid', '$tien', 'fs@gmai.com', '$userid', NOW())";
                    $this->db2->query($sql_user);*/
                    $arr=array("tb"=>"1","page"=>$page);
                }
                else
                    $arr=array("tb"=>"0","page"=>$page);
            }
            else
                $arr=array("tb"=>"0","page"=>$page);
            return $arr;
        }
    }
    public function sendmail()
    {
        if(isset($_POST['dstr_bookingid']))
        {
            $dstr_bookingid=$_POST['dstr_bookingid'];            
            $dUserId=$_POST['UserId'];
            $dEmail=$_POST['Email'];
            $dObjectId=$_POST['ObjectId'];
            $arr_bookingid=explode(", ",$dstr_bookingid);
            $somabooking=count($arr_bookingid);
            //echo $somabooking;die;
            $tongtienphaitra=0;
            $str_bookingid="";
            $str_showtep3="";
            $TotalAmtBT=0;
            $TotalTax=0;
            $TotalAmtAT=0;
            $Discount=0;
            $TotalAmt=0;
            for($j=0;$j<$somabooking;$j++)
            {             
                $strmailspa=""; //dung gui mail cho spa
                $dbookingID=$arr_bookingid[$j];
                //echo $dbookingID;die;
                $this->m_sms->SendSMSBookingSuccess($dbookingID);
                $temid= (int)substr($dbookingID,-6);
                $shotbookingID="99#".$temid;
                $str_bookingid.=$shotbookingID.", ";
                //echo $str_bookingid;die;
                $ttspa=$this->m_checkout->layttspatheobookingid($dbookingID);
                //print_r($ttspa);die;
                $emailspa = "huunghia1810@gmail.com"; //dung cho gui mail spa
                //$emailspa = $ttspa->Email1; //dung cho gui mail spa
                $spaName = $ttspa->spaName; //dung cho gui mail spa
                $spaPhone = $ttspa->Tel; //dung cho gui mail spa
                //echo $spaPhone;die;
                $laybooking= $this->m_checkout->laybookingtheoid($dbookingID);
                $spaid=$laybooking[0]->ObjectID;
                
                    $nguoitao="";
                    $nguoinhan ="";
                    $obj_id= "";
                    
                        $nguoitao=$dUserId;
                        $nguoinhan = $dEmail;
                        $obj_id =$dObjectId;
                        
                    //echo $nguoitao;
                    //$arr_user = $this->m_user->lay_User_theo_id1($nguoitao);
                    //print_r($arr_user);die;
                    $arr_Object = $this->m_user->lay_object_theo_ObjectID($obj_id);
                    $tenuser=$arr_Object[0]->FullName;
                    //echo $tenuser;die;
                    $TongDaiHotLine=$this->GetSetting('TongDaiHotLine');
                    $EmailHotLine=$this->GetSetting('EmailHotLine');   
                     //echo "dsfsdf".$TongDaiHotLine." ".$EmailHotLine;die;
                     $sql_booking="SELECT * FROM `booking` WHERE `bookingID`='$dbookingID'";
                     $query_booking=$this->db->query($sql_booking)->result();
                     
                     //$dPayment_method=$query_booking[0]->Status;
                     $query_bookingpayment=$this->m_checkout->laybookingpaymenttheoid($dbookingID);
                     $dPayment_method=$query_bookingpayment[0]->PayMethod;
                     $timebook = $query_booking[0]->CreatedDate;
                     $status_booking=$query_booking[0]->Status;
                     if($status_booking==1 || $status_booking=="1")
                        $Status="Chưa thanh toán";
                     if($status_booking==0 || $status_booking=="0")
                        $Status="Đã huỷ";
                     if($status_booking==2 || $status_booking=="2")
                        $Status="Đã thanh toán";
                     if($status_booking==3 || $status_booking=="3")
                        $Status="Đã thanh toán";
                     
                    $paymentwith="";
                    $sql_cmcode="select * from commoncode where CommonTypeId='PaymentType' and CommonId = '$dPayment_method'";
                    $res_cmcode=$this->db->query($sql_cmcode)->result();
                    if(count($res_cmcode)>0)
                        $paymentwith=$res_cmcode[0]->StrValue1;   
                
                $query_bookingpayment=$this->m_checkout->laybookingtheoid($dbookingID);
                //print_r($query_bookingpayment);die;
                foreach($query_bookingpayment as $row_bookingpayment)
                 {
                     $TotalAmtBT += $row_bookingpayment->TotalAmtBT;
                     $TotalTax += $row_bookingpayment->TotalTax;
                     $TotalAmtAT += $row_bookingpayment->TotalAmtAT;
                     $Discount += $row_bookingpayment->Discount;
                     $TotalAmt += $row_bookingpayment->TotalAmt;
                 }
                
                $i=0;
                $totalmoney=0;
                
                $str_showtep3 .= '<table cellpadding="1" cellspacing="1" style="margin: 10px;" width="97%">';
                    $str_showtep3 .= '<tr bgcolor="#0072cc">';
                        $str_showtep3 .= '<td colspan="5" align="left" style="font-family: arial; margin: 0px; padding: 5px; font-weight: bold; color: rgb(255, 255, 255); font-size: 12px;" width="10%">';
                            $str_showtep3 .='<strong>Tên spa: '.$ttspa->spaName.'</strong><br />';
                            $str_showtep3 .='Địa chỉ: '.$ttspa->Address.'<br />';
                            $str_showtep3 .='Điện thoại: <span style="color:#FFF;">'.$ttspa->Tel.'</span><br />';
                            $str_showtep3 .='Email: <span style="color:#FFF;">'.$ttspa->Email.'</span><br />';
                            $str_showtep3 .='Website: <span style="color:#FFF;">'.$ttspa->Website.'</span>';
                        $str_showtep3 .= '</td>';
                    $str_showtep3 .= '</tr>';
                    $str_showtep3 .= '<tr bgcolor="#FFFFCC" style="font-weight: bold;">';
                        $str_showtep3 .= '<td align="center" style="font-family: arial; margin: 0px; padding: 5px; font-weight: bold; font-size: 12px;" width="10%">STT</td>';
                        $str_showtep3 .= '<td align="center" style="font-family: arial; margin: 0px; padding: 5px; font-weight: bold;font-size: 12px;">Thông tin</td>';
                        $str_showtep3 .= '<td align="center" style="font-family: arial; margin: 0px; padding: 5px; font-weight: bold; font-size: 12px;">Số lượng</td>';
                        $str_showtep3 .= '<td align="center" style="font-family: arial; margin: 0px; padding: 5px; font-weight: bold; font-size: 12px;">Giá</td>';
                        $str_showtep3 .= '<td align="center" style="font-family: arial; margin: 0px; padding: 5px; font-weight: bold; font-size: 12px;">Thành tiền</td>';
                    $str_showtep3 .= '</tr>';
                    
                    $strmailspa .= '<table cellpadding="1" cellspacing="1" style="margin: 10px;" width="97%">';
                    $strmailspa .= '<tr bgcolor="#FFFFCC" style="font-weight: bold;">';
                        $strmailspa .= '<td align="center" style="font-family: arial; margin: 0px; padding: 5px; font-weight: bold; font-size: 12px;" width="10%">STT</td>';
                        $strmailspa .= '<td align="center" style="font-family: arial; margin: 0px; padding: 5px; font-weight: bold;font-size: 12px;">Thông tin</td>';
                        $strmailspa .= '<td align="center" style="font-family: arial; margin: 0px; padding: 5px; font-weight: bold; font-size: 12px;">Số lượng</td>';
                        $strmailspa .= '<td align="center" style="font-family: arial; margin: 0px; padding: 5px; font-weight: bold; font-size: 12px;">Giá</td>';
                        $strmailspa .= '<td align="center" style="font-family: arial; margin: 0px; padding: 5px; font-weight: bold; font-size: 12px;">Thành tiền</td>';
                    $strmailspa .= '</tr>';
                
                $list_pro= $this->m_checkout->layttbookingtheoid($dbookingID);
                //print_r($list_pro);die;
                $ttgiamgiaspa=0;
                foreach($list_pro as $row_listpro)
                {
                    $stt=$i+1;
                    $str_showtep3 .= '<tr bgcolor="#FFFFCC">';
                    $str_showtep3 .= '<td align="center" style="font-family: arial; margin: 0px; padding: 5px; font-size: 12px;">'.$stt.'</td>';
                                //xu ly thoi gian                                    
                                $fromtime=substr($row_listpro->FromTime,-8,5);
                                $totime=substr($row_listpro->ToTime,-8,5);
                                $datebook=explode(" ",$row_listpro->ToTime);
                                $arrdate=explode("-",$datebook[0]);
                                $daybook=$arrdate[2];
                                $monthbook=$arrdate[1];
                                $yearbook=$arrdate[0];
                                $fidate=$daybook."-".$monthbook."-".$yearbook;
                                //xu ly thoi gian      
                    $str_showtep3 .= '<td align="left" style="font-family: arial; margin: 0px; padding: 5px; font-size: 12px;">Tên sản phẩm, dịch vụ: '.$row_listpro->Name.'<br />Từ: <span>'.$fromtime.'</span> đến <span>'.$totime.' '.$fidate.'</span></td>';
                    $str_showtep3 .= '<td align="center" style="font-family: arial; margin: 0px; padding: 5px; font-size: 12px;"><span>'.$row_listpro->Qty.'</span></td>';   
                    $str_showtep3 .= '<td align="center" style="font-family: arial; margin: 0px; padding: 5px; font-size: 12px;"><span>'.number_format($row_listpro->Price).'</span> VNĐ';
                    $str_showtep3 .= '</td>';
                    $str_showtep3 .= '<td align="center" style="font-family: arial; margin: 0px; padding: 5px; font-size: 12px;"><span>'.number_format($row_listpro->AmtBT).'</span> VNĐ';
                    $str_showtep3 .= '</td>';
                    $str_showtep3 .= '</tr>';
                    
                    $strmailspa .= '<tr bgcolor="#FFFFCC">';
                    $strmailspa .= '<td align="center" style="font-family: arial; margin: 0px; padding: 5px; font-size: 12px;">'.$stt.'</td>';
                    $strmailspa .= '<td align="left" style="font-family: arial; margin: 0px; padding: 5px; font-size: 12px;">Tên sản phẩm, dịch vụ: '.$row_listpro->Name.'<br />Từ: <span>'.$fromtime.'</span> đến <span>'.$totime.' '.$fidate.'</span></td>';
                    $strmailspa .= '<td align="center" style="font-family: arial; margin: 0px; padding: 5px; font-size: 12px;"><span>'.$row_listpro->Qty.'</span></td>';   
                    $strmailspa .= '<td align="center" style="font-family: arial; margin: 0px; padding: 5px; font-size: 12px;"><span>'.number_format($row_listpro->Price).'</span> VNĐ';
                    $strmailspa .= '</td>';
                    $strmailspa .= '<td align="center" style="font-family: arial; margin: 0px; padding: 5px; font-size: 12px;"><span>'.number_format($row_listpro->AmtBT).'</span> VNĐ';
                    $strmailspa .= '</td>';
                    $strmailspa .= '</tr>';
                    
                    $i++;
                    $totalmoney+=$row_listpro->AmtBT;
                    $ttgiamgiaspa+=$row_listpro->Discount;
                    $tongtienphaitra+=$row_listpro->AmtBT;
                }
                $str_showtep3 .='<tr bgcolor="#0099CC">';
                $str_showtep3 .='<td align="right" colspan="4" style="font-family: arial; margin: 0px; padding: 5px; color: rgb(255, 255, 255); font-weight: bold; font-size: 12px;">Tổng cộng</td>';
                $str_showtep3 .='<td align="center" style="font-family: arial; margin: 0px; padding: 5px; color: rgb(255, 255, 0); font-weight: bold; font-size: 12px;"><span>'.number_format($totalmoney).'</span> VNĐ</td>';
                $str_showtep3 .='</tr>';
                $str_showtep3 .='<tr bgcolor="#0099CC">';
                $str_showtep3 .='<td align="right" colspan="4" style="font-family: arial; margin: 0px; padding: 5px; color: rgb(255, 255, 255); font-weight: bold; font-size: 12px;">Giảm giá</td>';
                $str_showtep3 .='<td align="center" style="font-family: arial; margin: 0px; padding: 5px; color: rgb(255, 255, 0); font-weight: bold; font-size: 12px;"><span>'.number_format($ttgiamgiaspa).'</span> VNĐ</td>';
                $str_showtep3 .='</tr>';
                $str_showtep3 .='<tr bgcolor="#0099CC">';
                $str_showtep3 .='<td align="right" colspan="4" style="font-family: arial; margin: 0px; padding: 5px; color: rgb(255, 255, 255); font-weight: bold; font-size: 12px;">Phải trả</td>';
                $str_showtep3 .='<td align="center" style="font-family: arial; margin: 0px; padding: 5px; color: rgb(255, 255, 0); font-weight: bold; font-size: 12px;"><span>'.number_format($totalmoney-$ttgiamgiaspa).'</span> VNĐ</td>';
                $str_showtep3 .='</tr>';
                $str_showtep3 .= '</table>';
                
                $strmailspa .='<tr bgcolor="#0099CC">';
                $strmailspa .='<td align="right" colspan="4" style="font-family: arial; margin: 0px; padding: 5px; color: rgb(255, 255, 255); font-weight: bold; font-size: 12px;">Tổng cộng</td>';
                $strmailspa .='<td align="center" style="font-family: arial; margin: 0px; padding: 5px; color: rgb(255, 255, 0); font-weight: bold; font-size: 12px;"><span>'.number_format($totalmoney).'</span> VNĐ</td>';
                $strmailspa .='</tr>';
                $strmailspa .='<tr bgcolor="#0099CC">';
                $strmailspa .='<td align="right" colspan="4" style="font-family: arial; margin: 0px; padding: 5px; color: rgb(255, 255, 255); font-weight: bold; font-size: 12px;">Giảm giá</td>';
                $strmailspa .='<td align="center" style="font-family: arial; margin: 0px; padding: 5px; color: rgb(255, 255, 0); font-weight: bold; font-size: 12px;"><span>'.number_format($ttgiamgiaspa).'</span> VNĐ</td>';
                $strmailspa .='</tr>';
                $strmailspa .='<tr bgcolor="#0099CC">';
                $strmailspa .='<td align="right" colspan="4" style="font-family: arial; margin: 0px; padding: 5px; color: rgb(255, 255, 255); font-weight: bold; font-size: 12px;">Phải trả</td>';
                $strmailspa .='<td align="center" style="font-family: arial; margin: 0px; padding: 5px; color: rgb(255, 255, 0); font-weight: bold; font-size: 12px;"><span>'.number_format($totalmoney-$ttgiamgiaspa).'</span> VNĐ</td>';
                $strmailspa .='</tr>';
                $strmailspa .= '</table>';
                
                //gui mail cho spa
                if(isset($emailspa) && $emailspa!="")
                {
                    $this->m_sms->SendSMSBookingSuccessSpa($dbookingID,$spaName,$spaPhone); //sendsms spa
                    
                    $mailspa = $this->m_mail->CreateMail();
                    //$mailspa->SMTPDebug = 3;                               // Enable verbose debug output
                    $mailspa->addAddress($emailspa);     // Add a recipient
                    //$mailspa->addAddress('ellen@example.com');               // Name is optional
                    
                    $mailspa->addCC('occbuu@gmail.com', 'Hao Lee');
                    //$mailspa->addBCC('bcc@example.com');
                    $mailspa->addCC('cs@thebooking.vn');
        
                    //$mailspa->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                    //$mailspa->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                    $mailspa->isHTML(true);                                  // Set email format to HTML
        
                    $mailspa->Subject = 'Thong bao dat cho tu Thebooking.vn';
                    $mailspa->CharSet = "utf-8";
                    $bodyspa = $this->m_mail->GetMailTemplate("BookingSuccessSpa");
                    $bodyspa = str_replace("[BookingID]",$shotbookingID, $bodyspa);
                    $bodyspa = str_replace("[SpaName]",$spaName, $bodyspa);
                    $bodyspa = str_replace("[ListPro]",$strmailspa, $bodyspa);
                    $bodyspa = str_replace("[TongDaiHotLine]",$TongDaiHotLine, $bodyspa);
                    $bodyspa = str_replace("[EmailHotLine]",$EmailHotLine, $bodyspa);
                    $bodyspa = str_replace("[Booking_Payment]",$paymentwith, $bodyspa);
                    $bodyspa = str_replace("[BookedBy]",$tenuser . "<br>" . $nguoinhan, $bodyspa);
                    $bodyspa = str_replace("[Booking_CreatedDate]",$timebook, $bodyspa);
                    $bodyspa = str_replace("[TotalAmtBT]",number_format($TotalAmtBT)." VNĐ", $bodyspa);
                    $bodyspa = str_replace("[TotalTax]",number_format($TotalTax)." VNĐ", $bodyspa);
                    $bodyspa = str_replace("[TotalAmtAT]",number_format($TotalAmtAT)." VNĐ", $bodyspa);
                    $bodyspa = str_replace("[Discount]",number_format($Discount)." VNĐ", $bodyspa);
                    $bodyspa = str_replace("[TotalAmt]",number_format($TotalAmt)." VNĐ", $bodyspa);
                    $bodyspa = str_replace("[Status]",$Status, $bodyspa);
                    
                    $mailspa->Body    = $bodyspa;
                    $mailspa->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
                    if(!$mailspa->send()) {
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mailspa->ErrorInfo;
                    } else {
                        echo 'Message has been sent';
                    }   
                }
                
                //end gui mail cho spa
            } 
            //die;   
            //echo $str_showtep3;die;
            //require 'PHPMailerAutoload.php';
            $mail = $this->m_mail->CreateMail();
            //$mail->SMTPDebug = 3;                               // Enable verbose debug output
            $mail->addAddress($nguoinhan);     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            
            $mail->addCC('occbuu@gmail.com', 'Hao Lee');
            $mail->addCC('cs@thebooking.vn');
            //$mail->addBCC('bcc@example.com');

            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Xac nhan dat cho tu Thebooking.vn';
            $mail->CharSet = "utf-8";
            $body = $this->m_mail->GetMailTemplate("BookingSuccess");
            $body = str_replace("[BookingID]",substr($str_bookingid,0,(strlen($str_bookingid)-2)), $body);
            $body = str_replace("[FullName]",($tenuser=="" || $tenuser==null)?$nguoinhan:$tenuser, $body);
            $body = str_replace("[ListPro]",$str_showtep3, $body);
            $body = str_replace("[TongDaiHotLine]",$TongDaiHotLine, $body);
            $body = str_replace("[EmailHotLine]",$EmailHotLine, $body);
            $body = str_replace("[Booking_Payment]",$paymentwith, $body);
            $body = str_replace("[BookedBy]",$tenuser . "<br>" . $nguoinhan, $body);
            $body = str_replace("[Booking_CreatedDate]",$timebook, $body);
            $body = str_replace("[TotalAmtBT]",number_format($TotalAmtBT)." VNĐ", $body);
            $body = str_replace("[TotalTax]",number_format($TotalTax)." VNĐ", $body);
            $body = str_replace("[TotalAmtAT]",number_format($TotalAmtAT)." VNĐ", $body);
            $body = str_replace("[Discount]",number_format($Discount)." VNĐ", $body);
            $body = str_replace("[TotalAmt]",number_format($TotalAmt)." VNĐ", $body);
            $body = str_replace("[Status]",$Status, $body);
            
            $mail->Body    = $body;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }
        }
    }
    /*----------------
    |--------------------------------
    |function load spaname for serach
    |---------------------------------
    */
    public function load_spaname_search()
    {
        $sql="SELECT `spaName` FROM `spa` ORDER BY `spaName`";
        $query=$this->db->query($sql)->result();
        $str_res="";
        if(count($query)>0)
        {
            foreach($query as $row_spa)
            {
                if($row_spa->spaName !="")
                    $str_res.='<option value="'.$row_spa->spaName.'">';
            }
        }
        $arr=array("str_res"=>$str_res);
        return $arr;
    }
    public function GetSetting($key)
    {
       $val= $this->m_mail->GetSetting($key);
       return $val;
    }    
    // export Excel
        public function export_excel()
        {
            $result=array();
            if(isset($_SESSION['array_excel']) && $_SESSION['array_excel']!="")
            {
                $sql_ex = $_SESSION['array_excel'];
                //print_r($sql_ex);die;
                //$result=$this->db->query($sql_ex)->result();
                $result = $sql_ex;
            }
            //print_r($result);die;
            return $result;
        }
       // end export Excel 
}
?>