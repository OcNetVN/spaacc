<?php
  class M_checkout extends CI_Model{
    public $errorStr; 
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('thebooking', TRUE);
        $this->load->model('m_sms');
    }
    public function changeQty_step1()
    {
        if(isset($_POST['dvitrisession']))
        {
            $dvitrisession=$_POST['dvitrisession']; //vi tri cua dong trong gio hang
            $dproID=$_POST['dproID']; //id san pham trong gio hang
            $didQtyPro=$_POST['didQtyPro']; //id cua cot chinh so luong san pham trong gio hang
            $dQty_proID=$_POST['dQty_proID']; //so luong cua san pham trong gio hang
            $Cart=$_SESSION['Cart'];
            $arr_sanpham=array();
            $idmoneypro="Money_".$dproID; //id tien cua row cua san pham trong gio hang
            $_SESSION['Cart'][$dvitrisession]['Qty'] = $dQty_proID;
            
            $money =  $_SESSION['Cart'][$dvitrisession]['Price']*$_SESSION['Cart'][$dvitrisession]['Qty'];//tong so tien 1 san pham
            //echo $money;
            $totalmoney=0;
            //print_r($_SESSION['Cart']);
            foreach($_SESSION['Cart'] as $row)
            {
                $totalmoney += $row['Price']*$row['Qty'];
            }
            
            //echo $totalmoney;
            $res = array("idmoneypro"=>$idmoneypro,"money"=>number_format($money),"totalmoney"=>number_format($totalmoney));
            //print_r($res);
            return $res;
        }
    }
    public function deletesubcart()
    {
        if(isset($_POST['dvitridong']))
        {
            $dvitridong=$_POST['dvitridong'];
            $arr_sanpham=array();
            $sodong=0;
            for($i=0;$i<count($_SESSION['Cart']);$i++)
            {
                if($i!=$dvitridong)
                {
                    $arr_sanpham[]=$_SESSION['Cart'][$i];
                }
            }
            //echo "<pre>";
            //print_r($arr_sanpham);
            //echo "</pre>";
            $_SESSION['Cart']=$arr_sanpham;
            //print_r($_SESSION['Cart']);
            $sodong=count($arr_sanpham);
            
            //tao list product de load ra view
            $i=0;
            $totalmoney=0;
            $str_chuoi="";
            $str_chuoi .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">';
                $str_chuoi .= '<tr>';
                  $str_chuoi .= '<th>No</th>';
                  $str_chuoi .= '<th>Service</th>';
                  $str_chuoi .= '<th>Date & Time</th>';
                  $str_chuoi .= '<th>Location</th>';
                  $str_chuoi .= '<th>Quantity</th>';
                  $str_chuoi .= '<th>Price</th>';
                  $str_chuoi .= '<th>Money</th>';
                  $str_chuoi .= '<th>&nbsp;</th>';
                $str_chuoi .= '</tr>';
            foreach($_SESSION['Cart'] as $row_pro)
            {
                $stt=$i+1;
                $str_chuoi .= '<tr>';
                $str_chuoi .= "<td>".$stt."</td>";
                $str_chuoi .= '<td><a href="javascript:void(0);" data-toggle="modal" data-target="#serviceModal">'.$row_pro['ProductName'].'</a></td>';
                $str_chuoi .= ' <td>Từ: '.$row_pro['FromTime'].' đến '.$row_pro['ToTime'].'</td>';
                $str_chuoi .= '<td>'.$row_pro['spaName'].'</td>';
                $str_chuoi .= '<td><input name="Qty_'.$row_pro['ProductID'].'" onchange="changeQty_step1(\''.$row_pro['ProductID'].'\','.$i.'" id="Qty_'.$row_pro['ProductID'].'" type="number" style="width:40px; text-align:center;"';
                if($row_pro['Qty']>0) 
                    $str_chuoi .= 'value="'.$row_pro['Qty'].'"'; 
                else
                    $str_chuoi .= 'value="1"';  
                 $str_chuoi .= '/></td>';
            ?>
                        <td><input name="Qty_<?php echo $row_pro['ProductID']; ?>" onchange="changeQty_step1('<?php echo $row_pro['ProductID']; ?>',<?php echo $i; ?>)" id="Qty_<?php echo $row_pro['ProductID']; ?>" type="number" style="width:40px; text-align:center;" <?php if($row_pro['Qty']>0) echo 'value="'.$row_pro['Qty'].'"'; else 'value="1"'; ?> /></td>
            <?php    
                $str_chuoi .= '<td nowrap="nowrap" id="Price_'.$row_pro['ProductID'].'">'.number_format($row_pro['Price']).' VNĐ</td>';
                $str_chuoi .= '<td id="Money_'.$row_pro['ProductID'].'">'.number_format($row_pro['Price']*$row_pro['Qty']).' VNĐ</td>';
                $str_chuoi .= '<td><button type="button" class="btn btn-default" onclick="deletesubcart('.$i.');">Remove</button></td>';
                $str_chuoi .= '</tr>';
                $i++;
                $totalmoney+=$row_pro['Price']*$row_pro['Qty'];
                
                $str_chuoi .= '<tr>';
                    $str_chuoi .= '<td colspan="6" align="right"><span style="font-size:15px;"><strong>TOTAL:</strong></span></td>';
                    $str_chuoi .= '<td colspan="2" nowrap="nowrap"><strong><span style="font-size:15px;" id="totalmoney">'.number_format($totalmoney).' VNĐ</span></strong></td>';
                $str_chuoi .= '</tr>';
            }
            $res = array("sodong"=>$sodong, "listpro"=>$str_chuoi);
            return $res;
        }
    }
    public function gotostep2()
    {
        
        if(isset($_POST['listspa']))
        {
            $list = $_POST['listspa'];
            $list_spa  = json_decode($list);
            $array_ss=array();
            $i=0;
            foreach($list_spa as $row_listspa)
            {
                if(count($row_listspa->listpro)>0)
                {
                    $array_ss[$i]['spaid']=$row_listspa->spaid;
                    $arr_pro=array();
                    $j=0;
                    foreach($row_listspa->listpro as $row_pro)
                    {
                        $arr_pro[$j]['ProductID']=$row_pro->ProductID;
                        $arr_pro[$j]['Qty']=$row_pro->Qty;
                        $arr_pro[$j]['Price']=$row_pro->Price;
                        $arr_pro[$j]['FromTime']=$row_pro->FromTime;
                        $arr_pro[$j]['ToTime']=$row_pro->ToTime;
                        if(isset($_SESSION['Cart'])) //dung de check va lay lai promotionid neu nhu sp do co km
                        {
                            foreach($_SESSION['Cart'] as $row_cart)
                            {
                                foreach($row_cart['list_product'] as $row_cart2)
                                {
                                    if($row_pro->ProductID==$row_cart2['ProductID'])
                                    {
                                        if(isset($row_cart2['promotionid']) && $row_cart2['promotionid']!=0 && $row_cart2['promotionid']!="0" && $row_cart2['promotionid']!="")
                                            $arr_pro[$j]['promotionid']=$row_cart2['promotionid'];
                                    }
                                }
                            }
                        }
                        $j++;
                    }
                    $array_ss[$i]['list_product']=$arr_pro;
                }
                $i++;
            }
            $_SESSION['Cart']=$array_ss;
            //print_r($_SESSION['Cart']);die;
        }
    }
    //dung cho step2
    public function gethinhthucthanhtoan()
    {
        $sql="select * from commoncode where CommonTypeId = 'PaymentType'  AND `NumValue1`=1 order by CommonId";
        $res = $this->db->query($sql)->result();
        return $res;
    }
    
     public function phatsinhma($table,$col,$int)
    {
        $ma=0;
        $sql="select * from $table where $col like '".$int."%'";
        $results=$this->db->query($sql)->result();
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
    public function gotostep3()
    {
        if(isset($_SESSION['AccUser']))
            $userid=$_SESSION['AccUser']['User']->UserId;
        else
        {
            if(isset($_SESSION['object']))
            {
                $userid=$_SESSION['object']->ObjectId;
            }
        }
        $tb123pay=0;  //dung cho 123pay 0: don hang da dc notify toi cap nhat truoc va k gui mail; 1: chua dc cap nhat status va gio moi cap nhat+gui mail; 2: k cap nhat dc, rollback  
        $tbchung="";
        $str_showtep3="";
        $str_showtep3_1="";
                    $list_booking="";
                    $email="";
                    $ngaytao="";
                    $status_str3="";
                    $totalamtbt=0;
                    $totaltax=0;
                    $totalamtat=0;
                    $totalDiscount=0;
                    $totalamt=0;
                    $paywith=0;
                    $list_spa="";
         if(isset($_POST['dPayment_method']) && $_POST['dPayment_method']!="")
         {
                $dPayment_method = $_POST['dPayment_method'];
                //$LoaiThe = $_POST['LoaiThe'];
                 $arr_session=$_SESSION['Cart'];
                 
                $CreatedDate=date("Y-m-d h:m:s");
                $CreatedBy="";
                $ObjectId="";
                if(isset($_SESSION['AccUser']))
                {
                    $CreatedBy=$_SESSION['AccUser']['User']->UserId;
                    $ObjectId=$_SESSION['AccUser']['User']->ObjectId;
                }
                if(isset($_SESSION['object']))
                {               
                    $CreatedBy=$_SESSION['object']->ObjectId;
                    $ObjectId=$_SESSION['object']->ObjectId;
                }
                $totaltien=0;
                $tongdiemcantra=0;
                $arr_bookingid="";
                $chay=0;
                if(isset($_SESSION['discount']))
                {
                    $txtcode=$_SESSION['discount']['DiscountCode'];
                    $generatedID=$_SESSION['discount']['generatedID'];
                    if($_SESSION['discount']['DiscountType']=="Voucher" || $_SESSION['discount']['DiscountType']=="Point" || $_SESSION['discount']['DiscountType']=="Outstanding") //ma code la voucher or point or outstanding
                    {
                        $_SESSION['discountbookingdetail']=$_SESSION['discount']['DiscountAmt']; //dung cho add giam gia vao bookingdetail
                    }
                }
                foreach($arr_session as $row_cart)
                {
                    $chay++;
                    //print_r($row_cart);die;
                    $int=(string)"99".date("Y").date("m").date("d");
                    $bookingID=$this->phatsinhma('booking','bookingID',$int);
                    $tongtienspa=0;
                    $flag=1;
                    foreach($row_cart['list_product'] as $row_tt) // tinh tong tien 1 spa
                    {
                        $tongtienspa+=($row_tt['Price']*$row_tt['Qty']);
                        $totaltien+=($row_tt['Price']*$row_tt['Qty']);
                    }
                    try{
                        if($dPayment_method == "01") // la pay123
                        {
                            $mTransactionID = $_SESSION['mTransactionID'];
                            $this->db->trans_start();
                    
                            $sql_laybookingid="SELECT * FROM `bookingonlinepay` WHERE `mTransactionID`='$mTransactionID'";
                            $query_laybookingid=$this->db->query($sql_laybookingid)->result();
                            $a=0;
                            $bookingID=$query_laybookingid[$a]->bookingID;
                            //print_r($query_laybookingid);die;
            				if($query_laybookingid[0]->Status==1 || $query_laybookingid[0]->Status=='1')
                            {
                                $tb123pay=0; //da cap nhat roi, khong cap nhat nua
                            }	
                            else //booking chua thanh toan
                            {
                                $sql_123pay="UPDATE `bookingonlinepay` SET `Status` = 1 WHERE mTransactionID = '$mTransactionID'";
                                $this->db->query($sql_123pay);
                                $tb123pay=1; //chua thanh cong truoc do, gio moi cap nhat
                                
                                $sql_updatebookingdetail="UPDATE `bookingdetails` SET `Status` = 2 WHERE `bookingID` = '$bookingID'";                
                                $this->db->query($sql_updatebookingdetail);    
                            }
                            if($chay==1)
                            {
                                $sql_layarrbooking="SELECT DISTINCT `bookingID` FROM `bookingonlinepay` WHERE `mTransactionID`='$mTransactionID'";
                                $query_layarrbooking=$this->db->query($sql_layarrbooking)->result();
                                foreach($query_layarrbooking as $row_arrbooking)
                                {
                                    $arr_bookingid.=$row_arrbooking->bookingID.", ";
                                }
                            }
                            $this->db->trans_complete();
                            if ($this->db->trans_status() === FALSE)
                            {
                                $this->db->trans_rollback();
                                $tb123pay= 2;
                                break;
                            }
                        }
                        else
                        {
                            if($dPayment_method == "04") //thanh toan bang diem
                            {
                                $status=3; //trang thai = 3 khi thanh toan bang diem
                                $totalpoint = $this->getpoint();
                                $ScoreRate=$this->ScoreRate()->NumValue1;
                                $diemcanco=ceil($tongtienspa/$ScoreRate);
                                $tongdiemcantra+=$diemcanco;
                                $diemconlai=$totalpoint['rowpoint']-$diemcanco;
                                $this->db->trans_start();
                                $sql_booking="INSERT INTO `booking` (`bookingID`, `CreatedDate`, `CreatedBy`, `Status`, `TotalAmtBT`, `TotalTax`, `TotalAmtAT`, `Discount`, `TotalAmt`, `ObjectID`) 
                                            VALUES ('$bookingID', '$CreatedDate', '$CreatedBy', '$status', '0', '0', '0', '0', '0', '$ObjectId')";
                                $this->db->query($sql_booking);
                                //echo $sql_booking."<br />";
                                               
                                foreach($row_cart['list_product'] as $row_cart1)
                                {
                                    $AmtBT=$row_cart1['Price']*$row_cart1['Qty'];
                                    $sql_bookingdetail="INSERT INTO `bookingdetails` (`bookingID`, `ProductID`, `Qty`, `Price`, `AmtBT`, `Tax`, `AmtAT`, `Status`, `FromTime`, `ToTime`, `Discount`, `TotalAmt`) 
                                    VALUES ('$bookingID', '".$row_cart1['ProductID']."', '".$row_cart1['Qty']."', '".$row_cart1['Price']."', '0', '0', '0', '$status', '".$row_cart1['FromTime']."', '".$row_cart1['ToTime']."',0,0)";
                                    $this->db->query($sql_bookingdetail);
                                    
                                    $moneypoint=($row_tt['Price']*$row_tt['Qty']);
                                    $diemcancoonebook=ceil($moneypoint/$ScoreRate);
                                    $diemcancoonebook=-$diemcancoonebook;
                                    $sql_point="INSERT INTO `scoretrans` (`Id`, `ObjectIDD`, `RefID`, `TotalScore`, `CreatedDate`, `CreatedBy`) 
                                            VALUES (NULL, '$CreatedBy', '$bookingID', '$diemcancoonebook', NOW(), '$CreatedBy')";
                                    $this->db2->query($sql_point);
                                    
                                    $sql_payment="INSERT INTO `bookingpayment` (`bookingID`, `ProductID`, `PayMethod`, `CreatedDate`, `CreatedBy`) 
                                            VALUES ('$bookingID', '".$row_cart1['ProductID']."', '$dPayment_method', '$CreatedDate', '$CreatedBy')";
                                    $this->db->query($sql_payment);
                                }
                                
                                //$sql_point="UPDATE `users` SET `ScoreBalance` = '$diemconlai' WHERE `UserId` = '$CreatedBy'";
                                //$this->db2->query($sql_point);
                                $this->db->trans_complete();
                                if ($this->db->trans_status() === FALSE)
                                {
                                    $this->db->trans_rollback();
                                    $tbchung= "-1";
                                    break;
                                }
                                
                                $arr_bookingid.=$bookingID.", ";
                            }
                            else //thanh toan tai nha, tai spa,...
                            {
                                        //giam gia luu vao table booking
                                        $DiscountID="";
                                        $totaldiscount=0;
                                        if(isset($_SESSION['discount']))
                                        {
                                            $txtcode=$_SESSION['discount']['DiscountCode'];
                                            $generatedID=$_SESSION['discount']['generatedID'];
                                            if($_SESSION['discount']['DiscountType']=="Voucher") //ma code la voucher
                                            {
                                                $tiengiam=$_SESSION['discount']['DiscountAmt'];
                                                $voucher = $this->m_checkout->layvoucher_theouserid($generatedID,$txtcode);
                                                if($voucher->AppliedForAll==1 || $voucher->AppliedForAll=="1" || $voucher->AppliedForAll==2 || $voucher->AppliedForAll=="2") 
                                                {
                                                    //them ngay 09/03/2015
                                                    //==1: ap dung cho tat ca sp KHONG khuyen mai
                                                    //==2: ap dung cho tat ca cac spa va moi san pham
                                                    if($tongtienspa>$tiengiam)
                                                    {
                                                        $totaldiscount=$tiengiam;
                                                        $_SESSION['discount']['DiscountAmt']=$_SESSION['discount']['DiscountAmt']-$tiengiam;
                                                    }
                                                    else
                                                    {
                                                        $totaldiscount=$tongtienspa;
                                                        $_SESSION['discount']['DiscountAmt']=$_SESSION['discount']['DiscountAmt']-$totaldiscount;
                                                    }
                                                } 
                                                else //chi ap dung cho 1 so sp nhat dinh
                                                {
                                                    foreach($row_cart['list_product'] as $row_cartvoucher)
                                                    {
                                                        $spvoucher=$this->m_checkout->layvoucherdetail_theovoucherid($_SESSION['discount']['DiscountCode']);
                                                        foreach($spvoucher as $row_spvoucher)
                                                        {
                                                            if($row_cartvoucher['ProductID']==$row_spvoucher->ProductID)
                                                            {
                                                                $tiengiam=$_SESSION['discount']['DiscountAmt'];
                                                                if($tongtienspa>$tiengiam)
                                                                {
                                                                    $totaldiscount=$tiengiam;
                                                                    $_SESSION['discount']['DiscountAmt']=$_SESSION['discount']['DiscountAmt']-$tiengiam;
                                                                    break;
                                                                } 
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            else 
                                            {
                                                if($_SESSION['discount']['DiscountType']=="Member") //ma code la the thanh vien
                                                {
                                                    $percentgiamgia=$_SESSION['discount']['Percentage'];
                                                    $totaldiscount=(float)($tongtienspa*$percentgiamgia)/100;
                                                    //echo $tongtien." ";
                                                    //echo $totaldiscount;die;
                                                }
                                                else
                                                {
                                                    if($_SESSION['discount']['DiscountType']=="Point") //dung diem giam gia
                                                    {
                                                        $pointtomoneymember = $this->ScoreRate();
                                                        $ScoreRate=500;
                                                        if(isset($pointtomoneymember) && count($pointtomoneymember)>0)
                                                            $ScoreRate = (float)$pointtomoneymember->NumValue1;
                                                                
                                                        $tiengiam=$_SESSION['discount']['DiscountAmt']; //1 diem = ? vnd
                                                        if($tongtienspa>$tiengiam)
                                                        {
                                                            $totaldiscount=$tiengiam;
                                                            $_SESSION['discount']['DiscountAmt']=$_SESSION['discount']['DiscountAmt']-$tiengiam;
                                                            
                                                                $sodiemdabook=(float)$totaldiscount/$ScoreRate; //-diem cua member
                                                                $sodiemdabook=-$sodiemdabook;
                                                                $sql_scodebalance="INSERT INTO `scoretrans` (`Id`, `ObjectIDD`, `RefID`, `TotalScore`, `CreatedDate`, `CreatedBy`) 
                                                                VALUES (NULL, '$CreatedBy', '$bookingID', '$sodiemdabook', '$CreatedDate', '$CreatedBy')";
                                                                //$sql_scodebalance="INSERT INTO `scorebalance` (`id`, `ObjectIDD`, `Type`, `ScoreBalance`, `ModifiedBy`, `ModifiedDate`) 
                                                                    //VALUES (NULL, '$bookingID', 'MEMBER', '$sodiemdabook', '$CreatedBy', '$CreatedDate')";
                                                                $query_scorebalance=$this->db2->query($sql_scodebalance);
                                                        }
                                                        else
                                                        {
                                                            $totaldiscount=$tongtienspa;
                                                            $_SESSION['discount']['DiscountAmt']=$_SESSION['discount']['DiscountAmt']-$totaldiscount;
                                                            //echo $totaldiscount."-".$_SESSION['discount']['DiscountAmt']." === ";
                                                                
                                                                $sodiemdabook=(float)$totaldiscount/$ScoreRate; //-diem cua member
                                                                $sodiemdabook=-$sodiemdabook;
                                                                $sql_scodebalance="INSERT INTO `scoretrans` (`Id`, `ObjectIDD`, `RefID`, `TotalScore`, `CreatedDate`, `CreatedBy`) 
                                                                    VALUES (NULL, '$CreatedBy', '$bookingID', '$sodiemdabook', '$CreatedDate', '$CreatedBy')";
                                                                //$sql_scodebalance="INSERT INTO `scorebalance` (`id`, `ObjectIDD`, `Type`, `ScoreBalance`, `ModifiedBy`, `ModifiedDate`) 
                                                                    //VALUES (NULL, '$bookingID', 'MEMBER', '$sodiemdabook', '$CreatedBy', '$CreatedDate')";
                                                                $query_scorebalance=$this->db2->query($sql_scodebalance);
                                                        }
                                                        //echo $_SESSION['discount']['DiscountAmt']." - ";
                                                    }
                                                    else
                                                    {
                                                        if($_SESSION['discount']['DiscountType']=="Outstanding") //dung Outstanding giam gia
                                                        {
                                                            $tiengiam=$_SESSION['discount']['DiscountAmt']; 
                                                            if($tongtienspa>$tiengiam)
                                                            {
                                                                $totaldiscount=$tiengiam;
                                                                $_SESSION['discount']['DiscountAmt']=$_SESSION['discount']['DiscountAmt']-$tiengiam;
                                                                
                                                                    $sooutstandingdabook=(float)$totaldiscount; //-outstanding cua member
                                                                    $sooutstandingdabook=-$sooutstandingdabook;
                                                                    
                                                                    $sql_outstanding="INSERT INTO `outstanding` (`id`, `UserId`, `TotalAmt`, `Ref`, `CreatedBy`, `CreatedDate`) 
                                                                    VALUES (NULL, '$CreatedBy', '$sooutstandingdabook', '$bookingID', '$CreatedBy', '$CreatedDate')";
                                                                    $query_outstanding=$this->db2->query($sql_outstanding);
                                                            }
                                                            else
                                                            {
                                                                $totaldiscount=$tongtienspa;
                                                                $_SESSION['discount']['DiscountAmt']=$_SESSION['discount']['DiscountAmt']-$totaldiscount;
                                                                //echo $totaldiscount."-".$_SESSION['discount']['DiscountAmt']." === ";
                                                                    
                                                                    $sooutstandingdabook=(float)$totaldiscount; //-outstanding cua member
                                                                    $sooutstandingdabook=-$sooutstandingdabook;
                                                                    $sql_outstanding="INSERT INTO `outstanding` (`id`, `UserId`, `TotalAmt`, `Ref`, `CreatedBy`, `CreatedDate`) 
                                                                    VALUES (NULL, '$CreatedBy', '$sooutstandingdabook', '$bookingID', '$CreatedBy', '$CreatedDate')";
                                                                    $query_outstanding=$this->db2->query($sql_outstanding);
                                                            }
                                                            //echo $_SESSION['discount']['DiscountAmt']." - ";
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        if($totaldiscount>0)
                                            $DiscountID=$_SESSION['discount']['DiscountCode'];
                                        $tienphaitra=$tongtienspa-$totaldiscount;
                                        $textrequestmember="";
                                        if(isset($_SESSION['textrequestmember']) && $_SESSION['textrequestmember']!="")
                                            $textrequestmember=$_SESSION['textrequestmember'];
                                        //end giam gia luu vao table booking
                                $status=1;
                                $this->db->trans_start();
                                $sql_booking="INSERT INTO `booking` (`bookingID`, `CreatedDate`, `CreatedBy`, `Status`, `TotalAmtBT`, `TotalTax`, `TotalAmtAT`, `Discount`, `TotalAmt`, `ObjectID`,`DiscountID`,`Note`) 
                                            VALUES ('$bookingID', '$CreatedDate', '$CreatedBy', '$status', '$tongtienspa', '0', '$tongtienspa', '$totaldiscount', '$tienphaitra', '$ObjectId','$DiscountID','$textrequestmember')";
                                $this->db->query($sql_booking);
                                //echo $sql_booking."<br />";
                                               
                                foreach($row_cart['list_product'] as $row_cart1)
                                {
                                            //giam gia luu vao table bookingdetail
                                            $tongtiensp=$row_cart1['Price']*$row_cart1['Qty'];
                                            $DiscountID="";
                                            $totaldiscount=0;
                                            if(isset($_SESSION['discount']))
                                            {
                                                $txtcode=$_SESSION['discount']['DiscountCode'];
                                                $generatedID=$_SESSION['discount']['generatedID'];
                                                if($_SESSION['discount']['DiscountType']=="Voucher") //ma code la voucher
                                                {
                                                    $tiengiam=$_SESSION['discountbookingdetail'];
                                                    $voucher = $this->m_checkout->layvoucher_theouserid($generatedID,$txtcode);
                                                    if($voucher->AppliedForAll==1 || $voucher->AppliedForAll=="1" || $voucher->AppliedForAll==2 || $voucher->AppliedForAll=="2") 
                                                    {
                                                        //them ngay 09/03/2015
                                                        //==1: ap dung cho tat ca sp KHONG khuyen mai
                                                        //==2: ap dung cho tat ca cac spa va moi san pham
                                                        if($tongtiensp>$tiengiam)
                                                        {
                                                            $totaldiscount=$tiengiam;
                                                            $_SESSION['discountbookingdetail']=$_SESSION['discountbookingdetail']-$tiengiam;
                                                        }
                                                        else
                                                        {
                                                            $totaldiscount=$tongtiensp;
                                                            $_SESSION['discountbookingdetail']=$_SESSION['discountbookingdetail']-$totaldiscount;
                                                        }
                                                    } 
                                                    else //chi ap dung cho 1 so sp nhat dinh
                                                    {
                                                            $spvoucher=$this->m_checkout->layvoucherdetail_theovoucherid($_SESSION['discount']['DiscountCode']);
                                                            
                                                            foreach($spvoucher as $row_spvoucher)
                                                            {
                                                                if($row_cart1['ProductID']==$row_spvoucher->ProductID)
                                                                {
                                                                    $tiengiam=$_SESSION['discountbookingdetail'];
                                                                    if($tongtiensp>$tiengiam)
                                                                    {
                                                                        $totaldiscount=$tiengiam;
                                                                        $_SESSION['discountbookingdetail']=$_SESSION['discountbookingdetail']-$tiengiam;
                                                                        break;
                                                                    } 
                                                                }
                                                        }
                                                    }
                                                    
                                                }
                                                else //ma code la the thanh vien
                                                {
                                                    if($_SESSION['discount']['DiscountType']=="Member")
                                                    {
                                                        $percentgiamgia=$_SESSION['discount']['Percentage'];
                                                        $totaldiscount=(float)($tongtiensp*$percentgiamgia)/100;
                                                    }
                                                    else
                                                    {
                                                        if($_SESSION['discount']['DiscountType']=="Point") //dung diem giam gia
                                                        {
                                                            $tiengiam=$_SESSION['discountbookingdetail'];
                                                            if($tongtiensp>$tiengiam)
                                                            {
                                                                $totaldiscount=$tiengiam;
                                                                $_SESSION['discountbookingdetail']=$_SESSION['discountbookingdetail']-$tiengiam;
                                                            }
                                                            else
                                                            {
                                                                $totaldiscount=$tongtiensp;
                                                                $_SESSION['discountbookingdetail']=$_SESSION['discountbookingdetail']-$totaldiscount;
                                                            }
                                                        }
                                                        else
                                                        {
                                                            if($_SESSION['discount']['DiscountType']=="Outstanding") //dung outstanding giam gia
                                                            {
                                                                $tiengiam=$_SESSION['discountbookingdetail'];
                                                                if($tongtiensp>$tiengiam)
                                                                {
                                                                    $totaldiscount=$tiengiam;
                                                                    $_SESSION['discountbookingdetail']=$_SESSION['discountbookingdetail']-$tiengiam;
                                                                }
                                                                else
                                                                {
                                                                    $totaldiscount=$tongtiensp;
                                                                    $_SESSION['discountbookingdetail']=$_SESSION['discountbookingdetail']-$totaldiscount;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            if($totaldiscount>0)
                                                $DiscountID=$_SESSION['discount']['DiscountCode'];
                                            $tienphaitra=$tongtiensp-$totaldiscount;
                                            //end giam gia luu vao table bookingdetail
                                    
                                    $status=1;
                                    //echo $row_cart1['ProductID']." - ".$productidbookingdetail."<br />";
                                    $AmtBT=$row_cart1['Price']*$row_cart1['Qty'];
                                    if($DiscountID!="")
                                    {
                                        $sql_bookingdetail="INSERT INTO `bookingdetails` (`bookingID`, `ProductID`, `Qty`, `Price`, `AmtBT`, `Tax`, `AmtAT`, `Status`, `FromTime`, `ToTime`, `PromotionID`, `Discount`, `TotalAmt`) 
                                        VALUES ('$bookingID', '".$row_cart1['ProductID']."', '".$row_cart1['Qty']."', '".$row_cart1['Price']."', '".$AmtBT."', '0', '".$AmtBT."', '$status', '".$row_cart1['FromTime']."', '".$row_cart1['ToTime']."','$DiscountID', $totaldiscount, $tienphaitra)";
                                    }
                                    else
                                        $sql_bookingdetail="INSERT INTO `bookingdetails` (`bookingID`, `ProductID`, `Qty`, `Price`, `AmtBT`, `Tax`, `AmtAT`, `Status`, `FromTime`, `ToTime`, `Discount`, `TotalAmt`) 
                                        VALUES ('$bookingID', '".$row_cart1['ProductID']."', '".$row_cart1['Qty']."', '".$row_cart1['Price']."', '".$AmtBT."', '0', '".$AmtBT."', '$status', '".$row_cart1['FromTime']."', '".$row_cart1['ToTime']."', $totaldiscount, $tienphaitra)";
                                    $this->db->query($sql_bookingdetail);
                                    $sql_payment="INSERT INTO `bookingpayment` (`bookingID`, `ProductID`, `PayMethod`, `CreatedDate`, `CreatedBy`) 
                                            VALUES ('$bookingID', '".$row_cart1['ProductID']."', '$dPayment_method', '$CreatedDate', '$CreatedBy')";
                                    $this->db->query($sql_payment);
                                }
                                $this->db->trans_complete();
                                if ($this->db->trans_status() === FALSE)
                                {
                                    $this->db->trans_rollback();
                                    $tbchung= "-1";
                                    break;
                                }
                                $arr_bookingid.=$bookingID.", ";
                            }
                        }
                    }
                    catch(exception $e)
                    {
                        $flag    = "0";
                    }
                    if($flag=="0" || $flag==0)
                    {
                        $tbchung= "-1";
                        break;
                    }
                        
                    //biet hinh thuc thanh toan
                    $paymentwith="";
                    $sql_cmcode="select * from commoncode where CommonTypeId='PaymentType' and CommonId = '$dPayment_method'";
                    $res_cmcode=$this->db->query($sql_cmcode)->result();
                    if(count($res_cmcode)>0)
                        $paymentwith=$res_cmcode[0]->StrValue1;
                    $sql_tblbooking="select * from booking where bookingID = '$bookingID'";
                    $sql_tbl_object_user ="";
                    $res_tblbooking=$this->db->query($sql_tblbooking)->result();
                            
                            //
                            if($res_tblbooking[0]->Status==2 || $res_tblbooking[0]->Status=="2")
                                $trangthai="Đã thanh toán";
                            if($res_tblbooking[0]->Status==3 || $res_tblbooking[0]->Status=="3")
                                $trangthai="Đã thanh toán";
                              if($res_tblbooking[0]->Status==1 || $res_tblbooking[0]->Status=="1")
                                $trangthai="Chưa thanh toán";
                              if($res_tblbooking[0]->Status==0 || $res_tblbooking[0]->Status=="0")
                                $trangthai="Đã huỷ";
                              //  
                        
                            $temid= (int)substr($res_tblbooking[0]->bookingID,-6);
                            $shotbookingID="99#".$temid;
                            if($dPayment_method!='01')
                                $list_booking.=$shotbookingID.", ";
                            else
                            {
                                if($chay==1)
                                {
                                    $arr_idbooking=explode(", ",$arr_bookingid);
                                    for($k=0;$k<(count($arr_idbooking)-1);$k++)
                                    {
                                        $tem123id= (int)substr($arr_idbooking[$k],-6);
                                        $shotbooking123ID="99#".$tem123id;
                                        $list_booking.=$shotbooking123ID.", ";
                                    }
                                }
                            }
                            $email ="Chưa rõ";
                            if(isset($_SESSION['AccUser']))
                            {
                                if(isset($_SESSION['AccUser']['Object']->Email) && $_SESSION['AccUser']['Object']->Email!="")
                                    $email = $_SESSION['AccUser']['Object']->Email;
                            }
                            else
                            {
                                if(isset($_SESSION['object']))
                                {
                                    $email = $_SESSION['object']->Email;
                                }
                            }
                            //$email=$res_tblbooking[0]->CreatedBy;
                            $ngaytao=$res_tblbooking[0]->CreatedDate;
                            $status_str3=$trangthai;
                            $totalamtbt+=$res_tblbooking[0]->TotalAmtBT;
                            $totaltax+=$res_tblbooking[0]->TotalTax;
                            $totalamtat+=$res_tblbooking[0]->TotalAmtAT;
                            $totalDiscount+=$res_tblbooking[0]->Discount;
                            $totalamt+=$res_tblbooking[0]->TotalAmt;
                            $paywith=$paymentwith;
                            
                            $i=0;
                            $ttspa=0;
                            $ttinspa=$this->layttspatheoid($row_cart['spaid']);
                            $tenspa=$ttinspa->spaName;
                            $dcspa=$ttinspa->Address;
                            $sdtspa=$ttinspa->Tel;
                            $emailspa=$ttinspa->Email;
                            $websitespa=$ttinspa->Website;
                            //$list_spa.=$chay.". <strong>Tên spa: ".$tenspa."</strong><br />Địa chỉ: ".$dcspa."<br />Điện thoại: ".$sdtspa."<br />Email: ".$emailspa."<br />Website: ".$websitespa."<br /><br />";
                            $str_showtep3 .= '<div class="wrap-table">';
                                $str_showtep3 .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">';
                                $str_showtep3 .= '<tr>';
                                    $str_showtep3 .= '<td colspan="6">';
                                        $str_showtep3 .= "<strong>Tên spa: ".$tenspa."</strong><br />Địa chỉ: ".$dcspa."<br />Điện thoại: ".$sdtspa."<br />Email: ".$emailspa."<br />Website: ".$websitespa;
                                    $str_showtep3 .= '</td>';
                                $str_showtep3 .= '</tr>';
                                $str_showtep3 .= '<tr>';
                                  $str_showtep3 .= '<th>STT</th>';
                                  $str_showtep3 .= '<th>Tên sản phẩm, dịch vụ</th>';
                                  $str_showtep3 .= '<th>Thời gian</th>';
                                  $str_showtep3 .= '<th>Số lượng</th>';
                                  $str_showtep3 .= '<th>Giá</th>';
                                  $str_showtep3 .= '<th>Thành tiền</th>';
                                $str_showtep3 .= '</tr>';
                            foreach($row_cart['list_product'] as $row_pro)
                            {
                                $sospcuaspa=count($row_cart['list_product']);
                                $stt=$i+1;
                                
                                $AmtBT=$row_pro['Price']*$row_pro['Qty'];
                                $proname=$this->laytensptheoid($row_pro['ProductID'])->Name;
                                $str_showtep3 .= '<tr id="trBookingTemp'.$row_pro['ProductID'].'">';
                                //if($stt==1)
                                    //$str_showtep3 .= "<td rowspan=\"".$sospcuaspa."\">Tên spa: ".$tenspa."<br />Địa chỉ: ".$dcspa."<br />Điện thoại: ".$sdtspa."<br />Email: ".$emailspa."<br />Website: ".$websitespa."</td>";
                                            //khuyen mai
                                            $promotionid=0;
                                            $idsp=$row_pro['ProductID'];
                                            $dsspkhuyenmai=$this->m_index->laylist_khuyenmaivang();
                                            $flagkhuyenmai=0;
                                            //$flagkhuyenmai = 1: khuyen mai vang
                                            //$flagkhuyenmai = 2: khuyen mai thuong
                                            foreach($dsspkhuyenmai as $row_spkhuyenmai)
                                            {
                                                if($row_spkhuyenmai->ProductId==$idsp)
                                                {
                                                    //echo date("Y-m-d H:m:s");
                                                    $nowtime=strtotime(date("Y-m-d H:m:s"));
                                                    if(strtotime($row_spkhuyenmai->BeginDateTime)<=$nowtime && $nowtime<=strtotime($row_spkhuyenmai->EndDateTime))
                                                    {
                                                        $promotionid=$row_spkhuyenmai->PromotionId;
                                                        $flagkhuyenmai=1;
                                                        break;
                                                    }
                                                }
                                            }
                                            //end khuyen mai
                                $str_showtep3 .= "<td>".$stt."</td>";
                                $str_showtep3 .= '<td><a href="javascript:void(0);" onclick="showdetailpro(\''.$idsp.'\',\''.$promotionid.'\');" data-toggle="modal" data-target="#serviceModal">'.$proname.'</a></td>';
                                    //xu ly thoi gian                                    
                                    $fromtime=substr($row_pro['FromTime'],-5);
                                    $totime=substr($row_pro['ToTime'],-5);
                                    $datebook=explode(" ",$row_pro['ToTime']);
                                    $arrdate=explode("-",$datebook[0]);
                                    $daybook=$arrdate[2];
                                    $monthbook=$arrdate[1];
                                    $yearbook=$arrdate[0];
                                    $fidate=$daybook."-".$monthbook."-".$yearbook;
                                    //xu ly thoi gian         
                                $str_showtep3 .= ' <td>Từ: <span>'.$fromtime.'</span> đến <span>'.$totime." ".$fidate.'</span></td>';
                                $str_showtep3 .= '<td><span>'.$row_pro['Qty'].'</span></td>';   
                                $str_showtep3 .= '<td nowrap="nowrap"><span>'.number_format($row_pro['Price']).'</span> VNĐ';
                                $str_showtep3 .= '</td>';
                                $str_showtep3 .= '<td><span>'.number_format($AmtBT).'</span> VNĐ';
                                $str_showtep3 .= '</td>';
                                $str_showtep3 .= '</tr>';
                                $i++;
                                $ttspa+=$AmtBT;
                            }
                                $str_showtep3 .= '<tr>';
                                  $str_showtep3 .= '<td colspan="5" align="right"><span style="font-size:15px;">Giảm giá:</span></td>';
                                  $str_showtep3 .= '<td colspan="2" nowrap="nowrap"><span style="font-size:15px;">'.number_format($res_tblbooking[0]->Discount).' VNĐ</span></td>';
                                $str_showtep3 .= '</tr>';
                                $str_showtep3 .= '<tr>';
                                    $str_showtep3 .= '<td colspan="5" align="right"><span style="font-size:13px;"><strong>Tổng tiền của Spa '.$tenspa.':</strong></span></td>';
                                    $str_showtep3 .= '<td nowrap="nowrap"><strong><span style="font-size:13px;">'.number_format($ttspa-$res_tblbooking[0]->Discount).'</span> VND</strong></td>';
                                    if($dPayment_method == "04") //thanh toan bang diem
                                    {
                                        $diemcancospa=ceil($ttspa/$ScoreRate);
                                        $str_showtep3 .= '<tr>';
                                            $str_showtep3 .= '<td colspan="5" align="right"><span style="font-size:13px;"><strong>Tổng điểm thanh toán cho Spa '.$tenspa.':</strong></span></td>';
                                            $str_showtep3 .= '<td nowrap="nowrap"><strong><span style="font-size:13px;">'.number_format($diemcancospa).'</span> điểm</strong></td>';
                                        $str_showtep3 .= '</tr>';
                                    }
                                $str_showtep3 .= '</tr>';
                      
                }
                $str_showtep3 .= '</table>';
                    $str_showtep3 .= '</div>';
                    $str_showtep3 .= '</div>';
              $str_showtep3 .= '<div class="col-md-10 col-md-offset-1">';
              $str_showtep3 .= '<table width="60%" border="0" cellspacing="0" cellpadding="0" class="table table-striped" style="text-align:left;">';
                $str_showtep3 .= '<tr>';
                  $str_showtep3 .= '<td colspan="5" align="right"><span style="font-size:15px;"><strong>Tổng tiền phải trả:</strong></span></td>';
                  $str_showtep3 .= '<td nowrap="nowrap"><strong><span style="font-size:15px;">'.number_format($totalamt).'</span> VND';
                  if($dPayment_method == "04") //thanh toan bang diem
                    {
                        $str_showtep3 .= ' ~ '.number_format($tongdiemcantra).' điểm';
                    }
                  $str_showtep3 .= '</strong></td>';
                $str_showtep3 .= '</tr>';
              $str_showtep3 .= '</table>';
              $str_showtep3 .= '</div>';
                
                unset($_SESSION['Cart']);
                unset($_SESSION['check2']);
                $_SESSION['check3']="check3";
                
                //lay noi dung show len step3
                $str_showtep3_1 .= '<h1 class="page-title-bar">Check Out: Step 3/3</h1>';
                
                $str_showtep3_1 .= '<div class="col-md-7 col-md-offset-1">';
                $str_showtep3_1 .= '<h3>Thông tin booking của bạn</h3>';
                $str_showtep3_1 .= '<div style="text-align:left;">';
                    $str_showtep3_1 .= '<table width="60%" border="0" cellspacing="0" cellpadding="0" class="table table-striped" style="text-align:left;">';
                    $str_showtep3_1 .= '<tr>';
                        $str_showtep3_1 .= '<th>Mã đặt chổ</th>';
                        $str_showtep3_1 .= '<td>'.substr($list_booking,0,(strlen($list_booking)-2)).'</td>';
                    $str_showtep3_1 .= '</tr>';
                    $str_showtep3_1 .= '<tr>';
                        $str_showtep3_1 .= '<th>Email</th>';
                        $str_showtep3_1 .= '<td>'.$email.'</td>';
                    $str_showtep3_1 .= '</tr>';
                    $str_showtep3_1 .= '<tr>';
                        //xu ly thoi gian           
                        $timetao=substr($ngaytao,-5);
                        $datetao=explode(" ",$ngaytao);
                        $arrdate=explode("-",$datetao[0]);
                        $daytao=$arrdate[2];
                        $monthtao=$arrdate[1];
                        $yeartao=$arrdate[0];
                        $fidatetao=$daytao."-".$monthtao."-".$yeartao;
                        //xu ly thoi gian         
                        $str_showtep3_1 .= '<th>Ngày tạo</th>';
                        $str_showtep3_1 .= '<td>'.$timetao." ".$fidatetao.'</td>';
                    $str_showtep3_1 .= '</tr>';  
                    $str_showtep3_1 .= '<tr>';
                        $str_showtep3_1 .= '<th>Trạng thái</th>';
                        $str_showtep3_1 .= '<td>'.$status_str3.'</td>';
                    $str_showtep3_1 .= '</tr>';
                    if($dPayment_method == "04") //thanh toan bang diem
                    {
                        $str_showtep3_1 .= '<tr>';
                            $str_showtep3_1 .= '<th>Tổng tiền trước thuế</th>';
                            $str_showtep3_1 .= '<td>'.number_format($totalamtbt).'</td>';
                        $str_showtep3_1 .= '</tr>';
                        $str_showtep3_1 .= '<tr>';
                            $str_showtep3_1 .= '<th>Tổng tiền thuế</th>';
                            $str_showtep3_1 .= '<td>'.number_format($totaltax).'</td>';
                        $str_showtep3_1 .= '</tr>';  
                        $str_showtep3_1 .= '<tr>';
                            $str_showtep3_1 .= '<th>Tổng tiền sau thuế</th>';
                            $str_showtep3_1 .= '<td>'.number_format($totalamtat).'</td>';
                        $str_showtep3_1 .= '</tr>';  
                        $str_showtep3_1 .= '<tr>';
                            $str_showtep3_1 .= '<th>Khuyến mãi</th>';
                            $str_showtep3_1 .= '<td>'.number_format($totalDiscount).'</td>';
                        $str_showtep3_1 .= '</tr>';
                        $str_showtep3_1 .= '<tr>';
                            $str_showtep3_1 .= '<th>Phải trả</th>';
                            $str_showtep3_1 .= '<td>'.number_format($tongdiemcantra).' điểm</td>';
                        $str_showtep3_1 .= '</tr>';
                    }
                    else
                    {
                       $str_showtep3_1 .= '<tr>';
                            $str_showtep3_1 .= '<th>Tổng tiền trước thuế</th>';
                            $str_showtep3_1 .= '<td>'.number_format($totalamtbt).' VNĐ</td>';
                        $str_showtep3_1 .= '</tr>';
                        $str_showtep3_1 .= '<tr>';
                            $str_showtep3_1 .= '<th>Tổng tiền thuế</th>';
                            $str_showtep3_1 .= '<td>'.number_format($totaltax).' VNĐ</td>';
                        $str_showtep3_1 .= '</tr>';  
                        $str_showtep3_1 .= '<tr>';
                            $str_showtep3_1 .= '<th>Tổng tiền sau thuế</th>';
                            $str_showtep3_1 .= '<td>'.number_format($totalamtat).' VNĐ</td>';
                        $str_showtep3_1 .= '</tr>';  
                        $str_showtep3_1 .= '<tr>';
                            $str_showtep3_1 .= '<th>Khuyến mãi</th>';
                            $str_showtep3_1 .= '<td>'.number_format($totalDiscount).' VNĐ</td>';
                        $str_showtep3_1 .= '</tr>';
                        $str_showtep3_1 .= '<tr>';
                            $str_showtep3_1 .= '<th>Phải trả</th>';
                            $str_showtep3_1 .= '<td>'.number_format($totalamt).' VNĐ</td>';
                        $str_showtep3_1 .= '</tr>'; 
                    }
                    $str_showtep3_1 .= '<tr>';
                        $str_showtep3_1 .= '<th>Hình thức thanh toán</th>';
                        $str_showtep3_1 .= '<td>'.$paywith.'</td>';
                    $str_showtep3_1 .= '</tr>';
                    /*$str_showtep3_1 .= '<tr>';
                        $str_showtep3_1 .= '<th>Spa đã đặt chổ</th>';
                        $str_showtep3_1 .= '<td>'.$list_spa.'</td>';
                    $str_showtep3_1 .= '</tr>';*/
                      
                  $str_showtep3_1 .= '</table>';
                $str_showtep3_1 .= '</div>';
                $str_showtep3_1 .= '</div>';
                $str_showtep3_1 .= '<div class="col-md-10 col-md-offset-1">';
                $str_showtep3_1 .= '<h3>Chi tiết đặt chổ</h3>';
                                        
                $str_showtep3=$str_showtep3_1.$str_showtep3;
                if(isset($_SESSION['mTransactionID']))
                    unset($_SESSION['mTransactionID']);
                if(isset($_SESSION['the']))
                    unset($_SESSION['the']);
                
                //huy trang thai active cua the voucher/the thanh vien
                if(isset($_SESSION['discount']))
                {
                    if($_SESSION['discount']['DiscountType']=="Voucher")
                        $this->huyactive_voucher($_SESSION['discount']['DiscountCode']);
                    //if($_SESSION['discount']['DiscountType']=="Member")
                        //$this->huyactive_membercard($_SESSION['discount']['DiscountCode']);
                }
                if(isset($_SESSION['discountbookingdetail']))
                    unset($_SESSION['discountbookingdetail']);
               $res = array("tbchung"=>$tbchung,"str_showtep3"=>$str_showtep3,"arr_bookingid"=>$arr_bookingid,"tb123pay"=>$tb123pay);
                return $res;
         }          
          
    }
    //check out
    //checkout
       public function loadeditprofile()
        {
            //lay location 
            $sql_location_first = "SELECT * FROM `commoncode` WHERE `CommonTypeId`='LOCATION' AND LENGTH(`CommonId`)= 3";
            $query_location_first=$this->db->query($sql_location_first)->result();
            $sodong_location_first = count($query_location_first);
            
            $res = array(
                        "first_location"=>$query_location_first, //list location cap 1
                        "sodong_first_location"=>$sodong_location_first); 
            return $res;
        }
        public function loadlocationchild()
        {
            if(isset($_POST['Locationparentid']))
            {
                $Locationparentid=$_POST['Locationparentid'];
                $sql_locationchild = "SELECT * FROM `commoncode` WHERE `CommonId` like '$Locationparentid%' AND LENGTH(`CommonId`)=5";
                $query_locationchild=$this->db->query($sql_locationchild)->result();
                $sodong_locationchild=count($query_locationchild);
                $res = array("lst"=>$query_locationchild,"sodong"=>$sodong_locationchild);
                return $res;
            }
        }
        
        //
        function GetMenuCap1($roleID,$moduleID) 
          {
             $sql ="SELECT a.*,b.`MenuName`,b.`Description`,b.`url` FROM `rolemenumodule` a INNER JOIN `menu` b ON a.`MenuId`=b.`MenuId`  WHERE a.`RoleId`='$roleID' AND a.`ModuleId`='$moduleID' AND LENGTH(a.`MenuId`)=2";
              $res= $this->db->query($sql)->result();
              $arr = (array)$res;
              return $arr;
              //print_r($arr);
          } 
          
        function GetMenuCap2($roleID, $Cap1) 
          {
              $sql ="SELECT a.*,b.`MenuName`,b.`Description`,b.`url` FROM `rolemenumodule` a LEFT JOIN `menu` b ON a.`MenuId`=b.`MenuId`  WHERE a.`RoleId`='$roleID' AND LENGTH(a.`MenuId`)=4 AND   LEFT(a.`MenuId`,2)= '$Cap1'";
              $res= $this->db->query($sql)->result();
              $arr = (array)$res;
              return $arr;
              //print_r($arr);
          }
        public function GetMenuStr($RoleId)
        {
            $str="";
            //$arr = (array)$_SESSION['AccUser'];
            
                $arr_menu_cap1 = $this->GetMenuCap1($RoleId,'admin');
               // $str ="";
                for($i=0;$i<count($arr_menu_cap1);$i++)
                {                    
                    $str = $str. "<li id=\"MenuCha".$arr_menu_cap1[$i]->MenuId."\">";
                    if($arr_menu_cap1[$i]->url == "" || $arr_menu_cap1[$i]->url == null)
                    {
                        $str = $str. "<a href=\"#\" class=\"nav-top-item \">";
                    }
                    else
                    {
                        $str = $str. "<a href=\"".base_url($arr_menu_cap1[$i]->url)."\" class=\"nav-top-item \">";
                    }
                    $str = $str.$arr_menu_cap1[$i]->MenuName ."</a>";
                    //Duyet menu cap 2
                    $arr_menu_cap2 = $this->GetMenuCap2($RoleId,$arr_menu_cap1[$i]->MenuId);
                    if(count($arr_menu_cap2)>0)
                    {
                        $str = $str."<ul>";
                        for($j=0;$j<count($arr_menu_cap2);$j++)
                        {
                            $str = $str."<li id=\"MenuCon".$arr_menu_cap2[$j]->MenuId."\">";
                            $str = $str. "<a href=\"". base_url($arr_menu_cap2[$j]->url) ."\">";
                            $str = $str. $arr_menu_cap2[$j]->MenuName;
                            $str = $str. "</a>";
                            $str = $str."</li>";
                        }
                        $str = $str."</ul>";
                    }
                    
                    $str = $str. "</li>";
                }
           
            return $str;
        }
       
       
         
       
       
        
        
        public function btnsubmit()
        {
            $tbemail="";
            $tbchung="";
            if(isset($_POST['fullname']))
            {
                $fullname=$_POST['fullname'];
                $Email=$_POST['Email'];
                $sdt=$_POST['sdt'];
                $dc=$_POST['dc'];
                $dis=$_POST['dis'];
                $CreatedDate=date("Y-m-d h:m:s");
                if(filter_var($Email,FILTER_VALIDATE_EMAIL))
                {
                    $sql="SELECT count(*) as row FROM `objects` WHERE `Email`='$Email'";
                    $query=$this->db2->query($sql)->row();                    
                    $sl = $query->row;
                    //$arr_obj = 
                    if($sl==1)
                    {
                        $sqloo = "SELECT * FROM `objects` WHERE `Email`='$Email'";
                        $query1 =$this->db2->query($sqloo)->row();
                        
                        $ObjectID = $query1->ObjectId;
                        $tbemail="Email này của bạn đã có trong hệ thống, đã tồn tại, Thông tin của bạn đã được cập nhật!";
                        $sql_obj="UPDATE `objects` SET `FullName`='$fullname', `ProvinceId`='$dis', `Tel`='$sdt',
                                    `ModifiedBy`= '$Email', `ModifiedDate`=NOW()
                                    WHERE `ObjectId`='$ObjectID'";
                        $this->db2->query($sql_obj);
                        
                        $arr_Object = $this->m_user->lay_object_theo_ObjectID($ObjectID);                        
                        $_SESSION['object']=$arr_Object[0];
                        $tbchung="ok";
                        
                    }
                    else
                    {
                        $int=(string)"03".date("Y").date("m").date("d");
                        $ObjectID=$this->getObjectID();
                        $this->db2->trans_start();
                        $sql_obj="INSERT INTO `objects` (`ObjectId`,`FullName`, `ObjectGroup`, `ObjectType`, `ProvinceId`, `Tel`, `Email`, `Status`, `CreatedBy`, `CreatedDate`) 
                                    VALUES ('$ObjectID', '$fullname', '01', '01', '$dis', '$sdt', '$Email', 1, '$Email', '$CreatedDate')";
                        
                        $this->db2->query($sql_obj);
                        $this->db2->trans_complete();
                        if ($this->db2->trans_status() === FALSE)
                        {
                            $this->db2->trans_rollback();
                        }
                        else
                        {
                                $arr_Object = $this->m_user->lay_object_theo_ObjectID($ObjectID);
                                
                                //$arr_session = array("Object"=>$arr_Object[0]);
                                $_SESSION['object']=$arr_Object[0];
								/*echo "<pre>";
									print_r($_SESSION['object']);
								echo "</pre>";die;*/
                             $tbchung="ok";
                        }
                    }
                }
                else
                    $tbemail="Email không đúng";
                $res = array(
                            "tbemail"=>$tbemail, //list location cap 1
                            "tbchung"=>$tbchung); 
                return $res;  
            }
        }
        //send mail
        public function GetSetting($key)
           {
               $val= $this->m_mail->GetSetting($key);
               return $val;
           }
           
        public function sendmail()
        {
            if(isset($_POST['dstr_bookingid']))
            {
                $dstr_bookingid=$_POST['dstr_bookingid'];
                $arr_bookingid=explode(", ",$dstr_bookingid);
                //print_r($arr_bookingid);die;
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
                for($j=0;$j<($somabooking-1);$j++)
                {
                    $strmailspa=""; //dung gui mail cho spa
                    $dbookingID=$arr_bookingid[$j];
                    $this->m_sms->SendSMSBookingSuccess($dbookingID);
                    $temid= (int)substr($dbookingID,-6);
                    $shotbookingID="99#".$temid;
                    $str_bookingid.=$shotbookingID.", ";
                    //echo $str_bookingid;die;
                    $ttspa=$this->layttspatheobookingid($dbookingID);
                    $emailspa = $ttspa->Email1; //dung cho gui mail spa
                    $spaName = $ttspa->spaName; //dung cho gui mail spa
                    $spaPhone = $ttspa->Tel; //dung cho gui mail spa
                    //echo $spaPhone;
                    $laybooking= $this->laybookingtheoid($dbookingID);
                    $spaid=$laybooking[0]->ObjectID;
                    if($j==0)
                    {
                        $nguoitao="";
                        $nguoinhan ="";
                        $obj_id= "";
                        if(isset($_SESSION['AccUser']))
                        {
                            $nguoitao=$_SESSION['AccUser']['User']->UserId;
                            if(isset($_SESSION['AccUser']['Object']->Email) && $_SESSION['AccUser']['Object']->Email!="")
                                $nguoinhan = $_SESSION['AccUser']['Object']->Email;
                            $obj_id =$_SESSION['AccUser']['Object']->ObjectId;
                        }
                        if(isset($_SESSION['object']))
                        {
                            //$nguoitao=$_SESSION['AccUser']['User']->UserId;
                            if(isset( $_SESSION['object']->Email) &&  $_SESSION['object']->Email!="")
                                $nguoinhan = $_SESSION['object']->Email;
                            $obj_id =$_SESSION['object']->ObjectId;
                        }
                        //echo $nguoitao;
                        //$arr_user = $this->m_user->lay_User_theo_id1($nguoitao);
                        //print_r($arr_user);die;
                        $arr_Object = $this->m_user->lay_object_theo_ObjectID($obj_id);
                        $tenuser=$arr_Object[0]->FullName;
                        //echo $tenuser;die;
                        $TongDaiHotLine=$this->GetSetting('TongDaiHotLine');
                        $EmailHotLine=$this->GetSetting('EmailHotLine');   
                         
                         $sql_booking="SELECT * FROM `booking` WHERE `bookingID`='$dbookingID'";
                         $query_booking=$this->db->query($sql_booking)->result();
                         
                         //$dPayment_method=$query_booking[0]->Status;
                         $query_bookingpayment=$this->laybookingpaymenttheoid($dbookingID);
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
                    }
                    $query_bookingpayment=$this->laybookingtheoid($dbookingID);
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
                    
                    $list_pro= $this->layttbookingtheoid($dbookingID);
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
                
                unset($_SESSION['Cart']);
                unset($_SESSION['check1']); 
                unset($_SESSION['check2']);
                if(isset($_SESSION['discount']))
                    unset($_SESSION['discount']); 
                if(isset($_SESSION['textrequestmember']))
                    unset($_SESSION['textrequestmember']); 
                if(isset($_SESSION['check_goto123pay']))    
                    unset($_SESSION["check_goto123pay"]);
            }
        }
        public function previewbooking($bookingID)
        {
            if(isset($_SESSION['AccUser']))
                $userid=$_SESSION['AccUser']['User']->UserId;
            else
            {
                if(isset($_SESSION['object']))
                {
                    $userid=$_SESSION['object']->ObjectId;
                }
            }
            $nguoinhan ="";
            if(isset($_SESSION['AccUser']))
            {
                if(isset($_SESSION['AccUser']['Object']->Email) && $_SESSION['AccUser']['Object']->Email!="")
                    $nguoinhan = $_SESSION['AccUser']['Object']->Email;
            }
            $sql_tblbooking="select * from booking where bookingID = '$bookingID'";
            $res_tblbooking=$this->db->query($sql_tblbooking)->result();
            if(count($res_tblbooking)>0)
            {
                $sql_tblbookingpayment="select * from bookingpayment where bookingID = '$bookingID'";
                $res_tblbookingpayment=$this->db->query($sql_tblbookingpayment)->result();
                $dPayment_method=$res_tblbookingpayment[0]->PayMethod;
                
                $paymentwith="";
                $sql_cmcode="select * from commoncode where CommonTypeId='PaymentType' and CommonId = '$dPayment_method'";
                $res_cmcode=$this->db->query($sql_cmcode)->result();
                if(count($res_cmcode)>0)
                    $paymentwith=$res_cmcode[0]->StrValue1;
                $str_showtep3="";
                $str_showtep3 .= '<div class="col-md-6 col-md-offset-3">';
                $str_showtep3 .= '<h3>Thông tin booking của bạn</h3>';
                $str_showtep3 .= '<div style="text-align:left;">';
                    $str_showtep3 .= '<table width="60%" border="0" cellspacing="0" cellpadding="0" class="table table-striped" style="text-align:left;">';
                    $str_showtep3 .= '<tr>';
                            //
                            if($res_tblbooking[0]->Status==2 || $res_tblbooking[0]->Status=="2")
                                $trangthai="Đã thanh toán";
                            if($res_tblbooking[0]->Status==3 || $res_tblbooking[0]->Status=="3")
                                $trangthai="Đã thanh toán";
                              if($res_tblbooking[0]->Status==1 || $res_tblbooking[0]->Status=="1")
                                $trangthai="Chưa thanh toán";
                              if($res_tblbooking[0]->Status==0 || $res_tblbooking[0]->Status=="0")
                                $trangthai="Đã huỷ";
                              //  
                    $str_showtep3 .= '<th>Mã đặt chổ</th>';
                        //tao short id
                        $temid= (int)substr($res_tblbooking[0]->bookingID,-6);
                        $shotbookingID="99#".$temid;
                        $str_showtep3 .= '<td>'.$shotbookingID.'</td>';
                    $str_showtep3 .= '</tr>';
                    $str_showtep3 .= '<tr>';
                        $str_showtep3 .= '<th>Email</th>';
                        $str_showtep3 .= '<td>'.$nguoinhan.'</td>';
                    $str_showtep3 .= '</tr>';
                    $str_showtep3 .= '<tr>';
                        $str_showtep3 .= '<th>Loại tài khoản</th>';
        
                            if(isset($_SESSION['AccUser']))
                            {
                                $ttuser=$this->layuser_theouserid($userid);
                                $vtloaitk=$ttuser->UserType;
                                if(!isset($vtloaitk) || (isset($vtloaitk) && $vtloaitk==""))
                                    $loaitk="Member";
                                else
                                {
                                    if(isset($vtloaitk) && $vtloaitk!="")
                                    {
                                        if($vtloaitk=="FB")
                                            $loaitk="Facebook";
                                        else
                                        {
                                            if($vtloaitk=="GP")
                                                $loaitk="GooglePlus";
                                        }
                                    }
                                }
                            }
                            else
                            {
                                if(isset($_SESSION['object']))
                                {
                                    $loaitk="Đặt chổ nhanh";
                                }
                                else
                                    $loaitk="Không rõ";
                            }
                            
                        $str_showtep3 .= '<td>'.$loaitk.'</td>';
                    $str_showtep3 .= '</tr>';
                    $str_showtep3 .= '<tr>';
                        $str_showtep3 .= '<th>Ngày tạo</th>';
                        $str_showtep3 .= '<td>'.$res_tblbooking[0]->CreatedDate.'</td>';
                    $str_showtep3 .= '</tr>';  
                    $str_showtep3 .= '<tr>';
                        $str_showtep3 .= '<th>Trạng thái</th>';
                        $str_showtep3 .= '<td>'.$trangthai.'</td>';
                    $str_showtep3 .= '</tr>';
                    if($res_tblbooking[0]->TotalAmtBT>0) //thanh toan bang tien
                    {
                        $str_showtep3 .= '<tr>';
                            $str_showtep3 .= '<th>Tổng tiền trước thuế</th>';
                            $str_showtep3 .= '<td>'.number_format($res_tblbooking[0]->TotalAmtBT).' VNĐ</td>';
                        $str_showtep3 .= '</tr>';
                        $str_showtep3 .= '<tr>';
                            $str_showtep3 .= '<th>Tổng tiền thuế</th>';
                            $str_showtep3 .= '<td>'.number_format($res_tblbooking[0]->TotalTax).' VNĐ</td>';
                        $str_showtep3 .= '</tr>';  
                        $str_showtep3 .= '<tr>';
                            $str_showtep3 .= '<th>Tổng tiền sau thuế</th>';
                            $str_showtep3 .= '<td>'.number_format($res_tblbooking[0]->TotalAmtAT).' VNĐ</td>';
                        $str_showtep3 .= '</tr>';  
                        $str_showtep3 .= '<tr>';
                            $str_showtep3 .= '<th>Khuyến mãi</th>';
                            $str_showtep3 .= '<td>'.number_format($res_tblbooking[0]->Discount).' VNĐ</td>';
                        $str_showtep3 .= '</tr>';
                        $str_showtep3 .= '<tr>';
                            $str_showtep3 .= '<th>Phải trả</th>';
                            $str_showtep3 .= '<td>'.number_format($res_tblbooking[0]->TotalAmt).' VNĐ</td>';
                        $str_showtep3 .= '</tr>';
                        $str_showtep3 .= '<tr>';
                            $phaitra=$res_tblbooking[0]->TotalAmt;
                            $scoremember=$this->m_checkout->ScoreRatemember()->NumValue1;
                            if($phaitra>0)
                                $poitsave=(float)$phaitra/$scoremember;
                            else
                                $poitsave=0;
                            $str_showtep3 .= '<th>Điểm tích luỷ</th>';
                            $str_showtep3 .= '<td>'.number_format($poitsave).' điểm</td>';
                        $str_showtep3 .= '</tr>';
                        $str_showtep3 .= '<tr>';
                            $str_showtep3 .= '<th>Hình thức thanh toán</th>';
                            $str_showtep3 .= '<td>'.$paymentwith.'</td>';
                        $str_showtep3 .= '</tr>';
                    }
                    else 
                    {
                        if($res_tblbooking[0]->TotalAmtBT==0 || $res_tblbooking[0]->TotalAmtBT=="0") //thanh toan bang diem
                        {
                            //chua xu ly
                            //chua xu ly
                            //chua xu ly
                            $list_pro= $this->layttbookingttbangdiem_theoid($dbookingID);
                            foreach($list_pro as $row_listpro) 
                            {
                                $tongdiem+=(float)$row_listpro;
                            }
                            $str_showtep3 .= '<tr>';
                                $str_showtep3 .= '<th>Số điểm thanh toán</th>';
                                $str_showtep3 .= '<td>'.number_format($res_tblbooking[0]->TotalAmt).' điểm</td>';
                            $str_showtep3 .= '</tr>';
                            $str_showtep3 .= '<tr>';
                                $str_showtep3 .= '<th>Điểm tích luỷ</th>';
                                $str_showtep3 .= '<td>0 điểm</td>';
                            $str_showtep3 .= '</tr>';
                            $str_showtep3 .= '<tr>';
                                $str_showtep3 .= '<th>Hình thức thanh toán</th>';
                                $str_showtep3 .= '<td>'.$paymentwith.'</td>';
                            $str_showtep3 .= '</tr>';
                        }
                    }
                  $str_showtep3 .= '</table>';
                $str_showtep3 .= '</div>';
                $str_showtep3 .= '</div>';
                
                $str_showtep3 .= '<div class="col-md-10 col-md-offset-1">';
                $str_showtep3 .= '<h3>Giỏ hàng của bạn</h3>';
                $str_showtep3 .= '<div class="wrap-table">';
                    $str_showtep3 .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">';
                    $str_showtep3 .= '<tr>';
                      $str_showtep3 .= '<th>STT</th>';
                      $str_showtep3 .= '<th>Tên sản phẩm, dịch vụ</th>';
                      $str_showtep3 .= '<th>Thời gian</th>';
                      $str_showtep3 .= '<th>Vị trí</th>';
                      $str_showtep3 .= '<th>Số lượng</th>';
                      $str_showtep3 .= '<th>Giá</th>';
                      $str_showtep3 .= '<th>Thành tiền</th>';
                    $str_showtep3 .= '</tr>';
                        
                        $sql_tblbookingdetail="SELECT a.*,b.`Name`,c.`spaName`,c.`Address` FROM `bookingdetails` a,`products` b,`spa` c WHERE a.`ProductID`=b.`ProductID` AND b.`SpaID`=c.`spaID` AND `bookingID`='$bookingID'";
                        $res_tblbookingdetail=$this->db->query($sql_tblbookingdetail)->result();
                        
                        $i=0;
                        $totalmoney=0;
                        foreach($res_tblbookingdetail as $row_pro)
                        {
                            //$proid = $arr_pro['ProductID'];
                            $stt=$i+1;
                            $str_showtep3 .= '<tr id="trBookingTemp'.$row_pro->ProductID.'">';
                            $str_showtep3 .= "<td>".$stt."</td>";
                            $str_showtep3 .= '<td><a href="javascript:void(0);" data-toggle="modal" data-target="#serviceModal">'.$row_pro->Name.'</a></td>';
                            $str_showtep3 .= ' <td>Từ: <span>'.$row_pro->FromTime.'</span> đến <span>'.$row_pro->ToTime.'</span></td>';
                            $str_showtep3 .= '<td> Tên Spa: <span>'.$row_pro->spaName.'</span><br /> Địa chỉ <span>'.$row_pro->Address.'</span></td>';
                            $str_showtep3 .= '<td><span>'.$row_pro->Qty.'</span></td>';   
                            $str_showtep3 .= '<td nowrap="nowrap"><span>'.number_format($row_pro->Price).'</span> VNĐ';
                            $str_showtep3 .= '</td>';
                            $str_showtep3 .= '<td><span>'.number_format($row_pro->AmtBT).'</span> VNĐ';
                            $str_showtep3 .= '</td>';
                            $str_showtep3 .= '</tr>';
                            $i++;
                            $totalmoney+=$row_pro->AmtBT;
                        }
                    $str_showtep3 .= '<tr>';
                      $str_showtep3 .= '<td colspan="5" align="right"><span style="font-size:15px;"><strong>TOTAL:</strong></span></td>';
                      $str_showtep3 .= '<td colspan="2" nowrap="nowrap"><strong><span style="font-size:15px;">'.number_format($totalmoney).'</span> VND</strong></td>';
                    $str_showtep3 .= '</tr>';
                  $str_showtep3 .= '</table>';
                $str_showtep3 .= '</div>';
                $str_showtep3 .= '</div>';
            }
            else
                $str_showtep3="";
            //echo $str_showtep3;die;
            //$res = array("str_review"=>$str_showtep3); 
            return $str_showtep3;    
        }
        //10.12.2014 nghia viet cho session cart moi
        public function layttspatheoid($spaid)
        {
            $sql="SELECT * FROM `spa` WHERE `SpaID`='$spaid'";
            $query=$this->db->query($sql)->row();
            return $query;
        }
        public function layproducttheoid($proid,$Qty,$Price,$FromTime,$ToTime)
        {
            $sql="SELECT $Qty as Qty,$Price as cartPrice,'$FromTime' as FromTime,'$ToTime' as ToTime,a.*, b.`Price` FROM `products` a LEFT JOIN `price` b ON a.`ProductID`=b.`ProductID` WHERE a.`ProductID`='$proid'";
            $query=$this->db->query($sql)->row();
            return $query;
        }
        public function layttbookingtheoid($bookingid)
        {
            $sql="SELECT a.`Name`,c.*
                    FROM `products` a, `bookingdetails` c 
                    WHERE c.`ProductID`=a.`ProductID` AND c.`bookingID`='$bookingid'";
            $query=$this->db->query($sql)->result();
            return $query;
        }
         public function layttbookingttbangdiem_theoid($bookingid)
        {
            $sql="SELECT c.*
                    FROM `products` a, `bookingdetails` c 
                    WHERE c.`ProductID`=a.`ProductID` AND c.`bookingID`='$bookingid'";
            $query=$this->db->query($sql)->result();
            return $query;
        }
        public function laytensptheoid($proid)
        {
            $sql="SELECT Name FROM `products` WHERE `ProductID`='$proid'";
            $query=$this->db->query($sql)->row();
            return $query;
        }
        public function layttspatheobookingid($bookingid)
        {
            $sql="SELECT c.* 
                FROM `bookingdetails` a, `products` b,`spa` c 
                WHERE a.`ProductID`=b.`ProductID` 
                AND b.`SpaID`=c.`spaID` 
                AND a.`bookingID`='$bookingid'";
            $query=$this->db->query($sql)->row();
            return $query;
        }
        public function laybookingtheoid($bookingid)
        {
            $sql="SELECT * FROM `booking` WHERE `bookingID`='$bookingid'";
            $query=$this->db->query($sql)->result();
            return $query;
        }
        public function laybookingpaymenttheoid($bookingid)
        {
            $sql="SELECT * FROM `bookingpayment` WHERE `bookingID`='$bookingid'";
            $query=$this->db->query($sql)->result();
            return $query;
        }
        //123pay
        public function check123pay()
        {
            $arr_sscheck123pay=$_SESSION['Cart'];
            $count_sscart=count($_SESSION['Cart']);
            for($i=0;$i<$count_sscart;$i++)
            {
                $tongtien=0;
                foreach($arr_sscheck123pay[$i]["list_product"] as $row_pro)
                {
                    $tongtien+=$row_pro['Qty']*$row_pro['Price'];
                }
                $arr_sscheck123pay[$i]["tongtien"]=$tongtien;
            }
            $_SESSION['check123pay']=$arr_sscheck123pay;
            return $arr_sscheck123pay;
        }
        
        public function getvalue123pay()
        {            
            //$mTransactionID=$_SESSION['check123pay'][0]['bookingid'];
            $mTransactionID = $_SESSION['mTransactionID'];
            
            $merchantCode='SPATHEBOOKINGVN';
            $actual_link = 'http://'.$_SERVER['HTTP_HOST']. base_url();
            if(strpos($actual_link,"localhost")>0 || strpos($actual_link,"127.0.0.1")>0)
                $clientip='192.168.1.64';
            else
                $clientip=$this->getRealIPAddress();            
            
            $passcode='SPATHEBOOKINGVNxHHs5JShyA';
            $arr=array('mTransactionID'=>$mTransactionID,'merchantCode'=>$merchantCode,'clientip'=>$clientip,'passcode'=>$passcode);
            //unset($_SESSION['mTransactionID']);
            return $arr;
        }
        
        public function post123pay()
        {
            $tbao="";
            @include_once 'resources/front/123pay/common.class.php';
            $result ="";
            if(isset($_POST['dmTransactionID']) && isset($_POST['dmerchantCode']) && isset($_POST['dclientip']) && isset($_POST['dpasscode']))
            {
                $dmTransactionID=$_POST['dmTransactionID'];
                $dmerchantCode=$_POST['dmerchantCode'];
                $dclientip=$_POST['dclientip'];
                $dpasscode=$_POST['dpasscode'];
                
                $mTransactionID = $dmTransactionID;
            	$aData = array
            	(
            		'mTransactionID' => $mTransactionID,
            		'merchantCode' =>$dmerchantCode,
            		'clientIP' =>$dclientip,
            		'passcode' =>$dpasscode,
            		'checksum' =>'',
            	);
            	
            	$aConfig = array
            	(
            		'url'=>'https://mi.123pay.vn/queryOrder1',
            		'key'=>'SPATHEBOOKINGVNoOAj5Aj8AN',
            		'passcode'=>'SPATHEBOOKINGVNxHHs5JShyA',
            	);
            	try
            	{
            		$data = Common::callRest($aConfig, $aData);
            		$result = $data->return;
            		if($result['httpcode'] ==  200)
            		{
            			if($result[0]=='1')
            			{
            			     //unset($_SESSION['check2']);
                             unset($_SESSION['check123pay']);
            				$tbao="ok";
            			}else{
            				$tbao = 'Có lỗi xảy ra';
            			}
            		}else{
            			//do error call service.
            			$tbao = 'Có lỗi xảy ra';
            		}
            	}catch(Exception $e)
            	{
            		$tbao = $e;
            	}
            }
            $arr=array("tbao"=>$tbao,"Result"=>$result);
            return $arr;
        }
        
        public function statusbookingonline($mTransactionID,$transactionStatus)
        {
            if(isset($mTransactionID) && isset($transactionStatus) && $mTransactionID!="" && $transactionStatus!="")
            {
                $tbchung=1;
                $arr_bookingid="";
                if($transactionStatus==1 || $transactionStatus=='1') //thanh cong
                {
                    $this->db->trans_start();
                    
                    $sql_laybookingid="SELECT * FROM `bookingonlinepay` WHERE `mTransactionID`='$mTransactionID'";
                    $query_laybookingid=$this->db->query($sql_laybookingid)->result();
                    //print_r($query_laybookingid);die;
    				if($query_laybookingid[0]->Status==1 || $query_laybookingid[0]->Status=='1')
                    {
                        /*$sql_arrbooking="SELECT DISTINCT `bookingID` FROM `bookingonlinepay` WHERE `mTransactionID`='$mTransactionID'";
                        $query_arrbooking=$this->db->query($sql_arrbooking)->result();
                        foreach($query_arrbooking as $row_arrbooking)
                        {
                            $arr_bookingid.=$row_arrbooking->bookingID.", ";
                        }
                        $this->sendmailnotify($arr_bookingid);*/
                        $tbchung=2; //da cap nhat roi, khong cap nhat nua
                    }	
                    else //booking chua thanh toan
                    {
                        $sql_123pay="UPDATE `bookingonlinepay` SET `Status` = 1 WHERE mTransactionID = '$mTransactionID'";
                        $this->db->query($sql_123pay);
                        $tbchung=1; //chua thanh cong truoc do, gio moi cap nhat
                        $a=0;
                        $bookingID=$query_laybookingid[$a]->bookingID;
                        
                        $sql_updatebookingdetail="UPDATE `bookingdetails` SET `Status` = 2 WHERE `bookingID` = '$bookingID'";                
                        $this->db->query($sql_updatebookingdetail);
                        
                        //sendmail
                        $sql_arrbooking="SELECT DISTINCT `bookingID` FROM `bookingonlinepay` WHERE `mTransactionID`='$mTransactionID'";
                        $query_arrbooking=$this->db->query($sql_arrbooking)->result();
                        foreach($query_arrbooking as $row_arrbooking)
                        {
                            $arr_bookingid.=$row_arrbooking->bookingID.", ";
                        }
                        $this->sendmailnotify($arr_bookingid);
                    }   
                    
                    //end sendmail
                    //foreach($query_laybookingid as $row_laybookingid)
    //                {
    //                    $idbooking=$row_laybookingid->bookingID;
                        //$sql_updatebooking="UPDATE `booking` SET `Status` = 2 WHERE `bookingID` = '$idbooking'";
                        //$this->db->query($sql_updatebooking);
    //                    $sql_updatebookingdetail="UPDATE `bookingdetails` SET `Status` = 2 WHERE `bookingID` = '$idbooking'";
    //                    $this->db->query($sql_updatebookingdetail);
    //                }
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE)
                    {
                        $this->db->trans_rollback();
                        $tbchung= -1;
                        break;
                    }
                }
                else //don hang tu sever cap nhat that bai (status = 0)
                {
                    $this->db->trans_start();
                    $sql_123pay="UPDATE `bookingonlinepay` SET `Status` = 0 WHERE mTransactionID = '$mTransactionID'";
                    $this->db->query($sql_123pay);
                    $sql_laybookingid="SELECT `bookingID` FROM `bookingonlinepay` WHERE `mTransactionID`='$mTransactionID'";
                    $query_laybookingid=$this->db->query($sql_laybookingid)->result();
                    if(count($query_laybookingid)>0)
                    {
        				if($query_laybookingid[0]->Status==0 || $query_laybookingid[0]->Status=='0')
        					$tbchung=1;
                        $a=0;
                        $bookingID=$query_laybookingid[$a]->bookingID;
                        foreach($query_laybookingid as $row_laybookingid)
                        {
                            $idbooking=$row_laybookingid->bookingID;
                            $sql_updatebooking="UPDATE `booking` SET `Status` = 1 WHERE `bookingID` = '$idbooking'";
                            $this->db->query($sql_updatebooking);
                            $sql_updatebookingdetail="UPDATE `bookingdetails` SET `Status` = 1 WHERE `bookingID` = '$idbooking'";
                            $this->db->query($sql_updatebookingdetail);
                        }
                        $this->db->trans_complete();
                        if ($this->db->trans_status() === FALSE)
                        {
                            $this->db->trans_rollback();
                            $tbchung= -1;
                            break;
                        }
                    }
                    else
                    {
                        $tbchung=1;
                    }
                    
                }
                return $tbchung;
            }
            else
            {
                echo "Khong dung tham so truyen vao";
            }
        }
        public function layobjecttheouserid($userid)
        {
            $sql="SELECT * FROM `users` a, `objects` b WHERE a.`ObjectId`=b.`ObjectId` AND a.`UserId`='$userid'";
            $query=$this->db2->query($sql)->row();
            return $query;
        }
        
        
        public function layobjecttheObjectID($id)
        {
            $sql="SELECT * FROM `objects`  WHERE `ObjectId`='$id'";
            $query=$this->db2->query($sql)->row();
            return $query;
        }
        
        
        public function cancelpay123()
        {
            if(isset($_SESSION['mTransactionID']))
            {
                $mid = $_SESSION['mTransactionID'];
                $sql="SELECT DISTINCT `bookingID`  FROM `bookingonlinepay` WHERE `mTransactionID`='$mid'";                
                $res =$this->db->query($sql)->result();
                $arr_bkid =(array) $res;
                if(count($arr_bkid)>0)
                {
                    $this->db->trans_start();
                    for($i=0; $i < count($arr_bkid) ;$i++)
                    {
                        $id= $arr_bkid[$i]->bookingID;
                        $sql_del_bkpay = "DELETE FROM `bookingpayment` WHERE `bookingID`='$id'";
                        $res1 =$this->db->query($sql_del_bkpay);
                        $sql_del_bkonl = "DELETE FROM `bookingonlinepay` WHERE `bookingID`='$id'";
                        $res1 =$this->db->query($sql_del_bkonl);
                        $sql_del_bkdet = "DELETE FROM `bookingdetails` WHERE `bookingID`='$id'";
                        $res1 =$this->db->query($sql_del_bkdet);
                        $sql_del_bkinfo = "DELETE FROM `bookinginfo` WHERE `bookingID`='$id'";
                        $res1 =$this->db->query($sql_del_bkinfo);
                        $sql_del_book = "DELETE FROM `booking` WHERE `bookingID`='$id'";
                        $res1 =$this->db->query($sql_del_book);
                        $sql_del_bkpay = "DELETE FROM `scorebalance` WHERE `ObjectIDD`='$id'";
                        $res1 =$this->db2->query($sql_del_bkpay);
                    }
                    $this->db->trans_complete();
                    
                    
                    if ($this->db->trans_status() === FALSE)
                    {
                        $this->db->trans_rollback();                        
                    }
                    else
                    {
                        unset($_SESSION['mTransactionID']);
                    }
                }
                
            }
        }
        
        public function getRealIPAddress(){  
            if(!empty($_SERVER['HTTP_CLIENT_IP'])){
                //check ip from share internet
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                //to check ip is pass from proxy
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }else{
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            return $ip;
        }
        //thanh toan bang diem
        public function getpoint()
        {
            if(isset($_SESSION['AccUser']))
            {
                $tendn=$_SESSION['AccUser']['User']->UserId;
                $sql="SELECT * FROM `users` WHERE `UserId`='$tendn'";
                $query=$this->db2->query($sql)->row()->ScoreBalance;
                $sodong=count($query);
                    $res = array(
                                "rowpoint"=>$query, //list location cap 1
                                "sodong"=>$sodong); 
            }
            else
            {
                $res = array(
                                "rowpoint"=>"", //list location cap 1
                                "sodong"=>0); 
            }
            return $res;
        }
        public function ScoreRate()
        {
            $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId` = 'ScoreRate' AND `CommonId`='03'";
            $query=$this->db->query($sql)->row();
            return $query;
        }
        //thanh toan bang the thanh vien va voucher
        public function laygiamgia_theomathethanhvien($mathethanhvien)
        {
            $sql="SELECT b.`NumValue1` FROM `membercard` a, `commoncode` b 
                    WHERE b.`CommonTypeId`='MemberCard' AND a.`CardType`=b.`CommonId` AND a.`CardNo`='$mathethanhvien'";
            $query=$this->db2->query($sql)->row();
            if(count($query)>0)
                $percentgiam=$query->NumValue1;
            else
                $percentgiam=0;
            return $percentgiam;
        }
        public function laymathethanhvien_theouserid($txtgenerated,$txtcode)
        {
            $sql="SELECT * FROM `membercard` WHERE `CardNo`='$txtcode' AND `Status`=1 AND NOW()<=`ExpireDate` AND `generatedID`='$txtgenerated'";
            $query=$this->db2->query($sql)->row();
            return $query;
        }
        public function layvoucher_theouserid($txtgenerated,$voucherid)
        {
            $sql="SELECT * FROM `voucher` 
                    WHERE `VoucherType`='SPA' AND `VoucherID`='$voucherid' AND 
                    `Status`=1 AND `ValidForm`<=NOW() AND `ValidTo`>=NOW() AND `GeneratedID`='$txtgenerated'";
            //echo $sql;die;
            $query=$this->db2->query($sql)->row();
            //print_r($query);
            return $query;
        }
        public function layvoucherdetail_theovoucherid($voucherid)
        {
            $sql="SELECT * FROM `voucherdetail` WHERE `VoucherID`='$voucherid'";
            $query=$this->db2->query($sql)->result();
            return $query;
        }
        public function applycodediscount()
       {
            if(isset($_POST['codetype']) && isset($_POST['txtcode']))
            {
                $tbkhongapdung=$this->GetSetting('tbdiscountNotUse');
                $arr_discount=array();
                $flag=0;
                $str="";
                if(isset($_SESSION['AccUser']))
                    $userid=$_SESSION['AccUser']['User']->UserId;
                else
                {
                    if(isset($_SESSION['object']))
                    {
                        $userid=$_SESSION['object']->ObjectId;
                    }
                }
                //$codetype ==1: the thanh vien
                //$codetype ==2: ma voucher
                $codetype=$_POST['codetype'];
                $txtcode=$_POST['txtcode'];
                $txtgenerated=$_POST['txtgenerated']; //ma generated
                if($txtcode!="")
                {
                    if(strlen($txtcode)>=2)
                    {
                        $loaithe=substr($txtcode,0,2);
                        if(($codetype==1 || $codetype=="1") && ($loaithe==57 || $loaithe=="57")) //dung ma the thanh vien
                        {
                            //$checkmembercard=$this->laymathethanhvien_theouserid($userid,$txtcode);
                            $checkmembercard=$this->laymathethanhvien_theouserid($txtgenerated,$txtcode);
                            if(isset($checkmembercard) && count($checkmembercard)!=0)
                            {
                                        $tongtien=0;
                                        foreach($_SESSION['Cart'] as $row_cart)
                                        {
                                            foreach($row_cart['list_product'] as $row_pro)
                                            {
                                                $tongtien+=$row_pro['Price']*$row_pro['Qty'];
                                            }
                                        }
                                $mathethanhvien=$checkmembercard->CardNo;
                                $percentgiamgia=$this->laygiamgia_theomathethanhvien($mathethanhvien);
                                
                                $arr_discount=array(
                                    "DiscountType" => "Member", //member/Voucher
                                    "Percentage" => $percentgiamgia,
                                    "DiscountAmt"=> ""
                                );
                                /*$_SESSION['discount']=$arr_discount;*/
                                $tiengiam=(float)($tongtien*$percentgiamgia)/100;
                                $str .= "Giảm: ".$percentgiamgia."% (".number_format($tiengiam)." VNĐ)<br />";
                                $str .= '<h4>Phải trả: '.number_format($tongtien-$tiengiam).' VNĐ</h4>';
                                $flag=1;
                            }
                        }
                        else
                        {
                           if(($codetype==2|| $codetype=="2") && ($loaithe==68 || $loaithe=="68")) //dung ma voucher
                            {
                                //$voucher = $this->layvoucher_theouserid($userid,$txtcode);  
                                $voucher = $this->layvoucher_theouserid($txtgenerated,$txtcode);       
                                if(isset($voucher) && count($voucher)!=0)
                                {
                                    $voucherid=$voucher->VoucherID;
                                    if($voucher->AppliedForAll==2 || $voucher->AppliedForAll=="2") //ap dung cho tat ca cac spa va moi san pham
                                    {
                                        //them ngay 09/03/2015
                                        //dung cho tat ca sp co khuyen mai va k co khuyen mai
                                        $tongtien=0;
                                        foreach($_SESSION['Cart'] as $row_cart)
                                        {
                                            foreach($row_cart['list_product'] as $row_pro)
                                            {
                                                $tongtien+=$row_pro['Price']*$row_pro['Qty'];
                                            }
                                        }
                                        if($tongtien>$voucher->Discount)
                                        {
                                            $arr_discount=array(
                                                "DiscountType" => "Voucher", //member/Voucher
                                                "Percentage" => "",
                                                "DiscountAmt"=> $voucher->Discount
                                            );
                                            $DiscountAmt=$voucher->Discount;                                            
                                            $str .= "Giảm: ".number_format($DiscountAmt)." VNĐ<br />";
                                            $str .= '<h4>Phải trả: '.number_format($tongtien-$DiscountAmt).' VNĐ</h4>';
                                            $flag=1;
                                        }
                                    }
                                    else
                                    {
                                        if($voucher->AppliedForAll==1 || $voucher->AppliedForAll=="1") //==1: ap dung cho tat ca cac spa va moi san pham khong co khuyen mai
                                        {
                                            //voucher ap dung tat ca sp KHONG PHAI LA SP KHUYEN MAI\
                                            $tongtien=0;
                                            foreach($_SESSION['Cart'] as $row_cart)
                                            {
                                                foreach($row_cart['list_product'] as $row_pro)
                                                {
                                                    $tongtien+=$row_pro['Price']*$row_pro['Qty'];
                                                }
                                            }
                                            if($tongtien>$voucher->Discount)
                                            {
                                                $arr_discount=array(
                                                    "DiscountType" => "Voucher", //member/Voucher
                                                    "Percentage" => "",
                                                    "DiscountAmt"=> $voucher->Discount
                                                );
                                                /*$_SESSION['discount']=$arr_discount;*/
                                                $DiscountAmt=$voucher->Discount;                                            
                                                $str .= "Giảm: ".number_format($DiscountAmt)." VNĐ<br />";
                                                $str .= '<h4>Phải trả: '.number_format($tongtien-$DiscountAmt).' VNĐ</h4>';
                                                $flag=1;
                                            }
                                            
                                            //check co sp nao khuyen mai khong
                                            foreach($_SESSION['Cart'] as $row)
                                            {
                                                foreach($row['list_product'] as $row2)
                                                {
                                                    if(isset($row2['promotionid']) && $row2['promotionid']!=0 && $row2['promotionid']!="0")
                                                    {
                                                        $flag=0;
                                                        break;  
                                                    }
                                                }
                                            }
                                        } 
                                        else //chi ap dung cho 1 so sp nhat dinh
                                        {
                                            $flag_checkproid=0;
                                            $arr_mangproid=array();
                                            foreach($_SESSION['Cart'] as $row_cart)
                                            {
                                                foreach($row_cart['list_product'] as $row_pro)
                                                {
                                                    $arr_mangproid[]=$row_pro['ProductID'];
                                                }
                                            }
                                            $resvoucherdetail=$this->layvoucherdetail_theovoucherid($voucherid);
                                            $arr_product_voucher=array();
                                            foreach($resvoucherdetail as $row_resvoucherdetail)
                                            {
                                                $checkinarr=in_array($row_resvoucherdetail->ProductID,$arr_mangproid); //kiem tra sp trong cart co ap dung voucher hay khong
                                                if($checkinarr==true || $checkinarr==1 || $checkinarr=="1") //tim thay ma sp giam gia cua voucher trong session cart
                                                    $arr_product_voucher[]=$row_resvoucherdetail->ProductID;
                                            }
                                            //print_r($arr_product_voucher); 
                                            if(count($arr_product_voucher)>0)
                                            {
                                                $totalprice=0;
                                                foreach($_SESSION['Cart'] as $row_cartvoucher)
                                                {
                                                    foreach($row_cartvoucher['list_product'] as $row_listpro)
                                                    {
                                                        foreach($arr_product_voucher as $row_pro_voucher)
                                                        {
                                                            if($row_pro_voucher==$row_listpro['ProductID'])
                                                            {
                                                                $pricepro=$row_listpro['Qty']*$row_listpro['Price'];
                                                                $totalprice+=$pricepro;
                                                            }
                                                        }
                                                    }
                                                }
                                                //echo $totalprice;die;
                                                if($voucher->Discount<$totalprice)
                                                {
                                                    $arr_discount=array(
                                                        "DiscountType" => "Voucher", //member/Voucher
                                                        "Percentage" => "",
                                                        "DiscountAmt"=> $voucher->Discount
                                                    );
                                                            $tongtien=0;
                                                            foreach($_SESSION['Cart'] as $row_cart)
                                                            {
                                                                foreach($row_cart['list_product'] as $row_pro)
                                                                {
                                                                    $tongtien+=$row_pro['Price']*$row_pro['Qty'];
                                                                }
                                                            }
                                                    $DiscountAmt=$voucher->Discount;                                            
                                                    $str .= "Giảm: ".number_format($DiscountAmt)." VNĐ<br />";
                                                    $str .= '<h4>Phải trả: '.number_format($tongtien-$DiscountAmt).' VNĐ</h4>';
                                                    $flag=1;
                                                } 
                                                else
                                                {
                                                    $flag=1;
                                                    $str .="<span style=\"color:red; font-weight:bold;\">".$tbkhongapdung."</span>";
                                                } 
                                            }
                                            else
                                            {
                                                $flag=1;
                                                $str .="<span style=\"color:red; font-weight:bold;\">".$tbkhongapdung."</span>";
                                            }
                                        } 
                                    }
                                }
                            } 
                        }
                    }
                }
                $tbkhongdung=$this->GetSetting('tbdiscountNotTrue');
                $array=array("str"=>$str,"flag"=>$flag,"discount"=>$arr_discount,"tbkhongdung"=>$tbkhongdung);
                return $array;       
            } 
        }
        public function laygiasp_theomasp($productid)
        {
            $sql="SELECT * FROM `price` WHERE `ProductID`='$productid' AND Status=1 ORDER BY `CreatedDate` DESC"; 
            //echo $sql;die;
            $query=$this->db->query($sql)->row();
            return $query;
        }
        public function laysp_theomasp($productid)
        {
            $sql="SELECT * FROM `products` WHERE `ProductID`='$productid'";
            $query=$this->db->query($sql)->row();
            return $query;
        }
        public function layspaid_theomasp($proid)
        {
            $sql="SELECT a.`SpaID`,b.`spaName` FROM `products` a,`spa` b  WHERE a.`ProductID`='$proid' AND a.`SpaID`=b.`spaID`";
            $query=$this->db->query($sql)->row();
            return $query;
        }
        public function huyactive_membercard($membercardid)
        {
            $sql="UPDATE `membercard` SET `Status` = '0' WHERE `CardNo` = '$membercardid'";
            $query=$this->db2->query($sql);
            return $query;
        }
        public function huyactive_voucher($voucherid)
        {
            $sql="UPDATE `voucher` SET `Status` = '0' WHERE `VoucherID` = '$voucherid'";
            $query=$this->db2->query($sql);
            return $query;
        }
        //end thanh toan bang the thanh vien va voucher
        //nghia viet them 16/1/2015
        public function getpointuser()
        {
            if(isset($_SESSION['AccUser']))
            {
                $userid=$_SESSION['AccUser']['User']->UserId;
                $sql="SELECT * FROM `users` WHERE `UserId`='$userid'";
                $query=$this->db2->query($sql)->row();
                if(count($query)>0)
                    $arr=array(
                                "sodong"=>1,
                                "point"=>$query->ScoreBalance
                                );
            }
            else
            {
                if(isset($_SESSION['object']))
                {
                    $arr=array(
                            "sodong"=>1,
                            "point"=>0
                            );
                }
            }
            
            return $arr;
        }
        public function ScoreRatemember()
        {
            $sql="SELECT * FROM `commoncode` WHERE `CommonTypeId` = 'ScoreRate' AND `CommonId`='02'";
            $query=$this->db->query($sql)->row();
            return $query;
        }
        //end nghia viet them 16/1/2015
        public function layuser_theouserid($userid)
        {
            $sql="SELECT * FROM `users` WHERE `UserId`='$userid'";
            $query=$this->db2->query($sql)->row();
            if(count($query)==0 || count($query)=="0")
            {
                $sql="SELECT * FROM `users` WHERE `UserId`='$userid'";
                $query=$this->db->query($sql)->row();
            }    
            return $query;
        }

        public function applypointdiscount()
        {
            if(isset($_POST['havepoint']))
            {
                $havepoint = $_POST['havepoint'];
                $inputpoint = $_POST['inputpoint'];
                $tongtien=0;
                foreach($_SESSION['Cart'] as $row)
                {
                    foreach($row['list_product'] as $row2)
                    {
                        $tongtien += $row2['Price']*$row2['Qty'];
                    }
                }
                
                $pointtomoneymember = $this->ScoreRate();
                $ScoreRate=500;
                if(isset($pointtomoneymember) && count($pointtomoneymember)>0)
                    $ScoreRate = (float)$pointtomoneymember->NumValue1;
                    
                $tieninput=$inputpoint*$ScoreRate;
                $flag=0;
                if($tieninput<=$tongtien)
                {
                    $flag=1;
                    $conlai=$havepoint-$inputpoint;
                    $str='<label style="color: red;">1 điểm = '.$ScoreRate.' VNĐ</label><br />';
                    $str.="<label>Bạn đã dùng ".number_format($inputpoint)." điểm ~ ".number_format($tieninput)." VNĐ</label><span id=\"diemdadung\" style=\"display:none;\">".$inputpoint."</span><br />";
                    $str.="<label>Bạn còn ".number_format($conlai)." điểm</label><span id=\"diemconlai\" style=\"display:none;\">".$conlai."</span><br />";
                    $str.="<button type=\"button\" class=\"btn btn-default\" id=\"reloadpoint\" onclick=\"reloaddifpoint();\">Reload</button>";
                    $arr=array("str"=>$str,"flag"=>$flag);
                }
                else
                {
                    $str="<label>Điểm của bạn lớn hơn điểm cần thanh toán</label><br />";
                    $str.="<button type=\"button\" class=\"btn btn-default\" id=\"reloadpoint\" onclick=\"reloaddifpoint();\">Reload</button>";
                    $arr=array("str"=>$str,"flag"=>$flag);
                }
                return $arr;
            }
        }
        public function applyoutstandingdiscount()
        {
            if(isset($_POST['haveoutstanding']))
            {
                $str="";
                $haveoutstanding = $_POST['haveoutstanding'];
                $inputoutstanding = $_POST['inputoutstanding'];
                $tongtien=0;
                foreach($_SESSION['Cart'] as $row)
                {
                    foreach($row['list_product'] as $row2)
                    {
                        $tongtien += $row2['Price']*$row2['Qty'];
                    }
                }
                $tieninput=$inputoutstanding;
                $flag=0;
                if($tieninput<=$tongtien)
                {
                    $flag=1;
                    $conlai=$haveoutstanding-$inputoutstanding;
                    $str.="<label>Bạn đã dùng ".number_format($tieninput)." VNĐ</label><span id=\"outstandingdadung\" style=\"display:none;\">".$inputoutstanding."</span><br />";
                    $str.="<label>Bạn còn ".number_format($conlai)." VNĐ</label><span id=\"outstandingconlai\" style=\"display:none;\">".$conlai."</span><br />";
                    $str.="<button type=\"button\" class=\"btn btn-default\" id=\"reloadoutstanding\" onclick=\"reloaddifoutstanding();\">Reload</button>";
                    $arr=array("str"=>$str,"flag"=>$flag);
                }
                else
                {
                    $flag=1;
                    $conlai=$haveoutstanding-$tongtien;
                    $str.="<label>Bạn đã dùng ".number_format($tongtien)." VNĐ</label><span id=\"outstandingdadung\" style=\"display:none;\">".$tongtien."</span><br />";
                    $str.="<label>Bạn còn ".number_format($conlai)." VNĐ</label><span id=\"outstandingconlai\" style=\"display:none;\">".$conlai."</span><br />";
                    $str.="<button type=\"button\" class=\"btn btn-default\" id=\"reloadoutstanding\" onclick=\"reloaddifoutstanding();\">Reload</button>";
                    $arr=array("str"=>$str,"flag"=>$flag);
                }
                return $arr;
            }
        }
        public function loaddiemuser()
        {
            //k cho book neu nhu cart co spkm va gia tien <50k (tien set trong xml)
            if(isset($_SESSION['AccUser']))
            {
                $userid=$_SESSION['AccUser']['User']->UserId;
            }
            else
            {
                if(isset($_SESSION['object']))
                {
                    $userid=$_SESSION['object']->ObjectId;
                }
            }
            $user=$this->layuser_theouserid($userid);
            if(count($user)>0)
                $diem=$user->ScoreBalance;
            else
                $diem=0;
            $flag=0;
            foreach($_SESSION['Cart'] as $row)
            {
                foreach($row['list_product'] as $row2)
                {
                    if(isset($row2['promotionid']) && $row2['promotionid']!=0 && $row2['promotionid']!="0")
                    {
                        $flag=1;
                        break;  
                    }
                }
            }
            $tongtiencart=0;
            $MinPricePoint=$this->m_checkout->GetSetting('MinPricePoint');
            foreach($_SESSION['Cart'] as $row_tt)
            {
                foreach($row_tt['list_product'] as $row_tt2)
                {
                    $tongtiencart+=$row_tt2['Qty']*$row_tt2['Price'];
                }
            }
            if($tongtiencart<=$MinPricePoint)
                $flag=1;
            $NoteBookByPoint=$this->m_checkout->GetSetting('NoteBookByPoint');
            $arr=array("flag"=>$flag,"diem"=>$diem,"NoteBookByPoint"=>$NoteBookByPoint);
            //print_r($arr);die;
            return $arr;
        }
        public function loadoutstandinguser()
        {
            //k cho book neu nhu cart co spkm va gia tien <50k (tien set trong xml)
            if(isset($_SESSION['AccUser']))
            {
                $userid=$_SESSION['AccUser']['User']->UserId;
            }
            else
            {
                if(isset($_SESSION['object']))
                {
                    $userid=$_SESSION['object']->ObjectId;
                }
            }
            $user=$this->layuser_theouserid($userid);
            if(count($user)>0)
                $outstanding=$user->OutStanding;
            else
                $outstanding=0;
            $flag=0;
            $arr=array("flag"=>$flag,"outstanding"=>$outstanding);
            //print_r($arr);die;
            return $arr;
        }
        
        
         public function getObjectID()
        {
            // [11][yyyyMMDD][000001]            
            ///- [11] : Mã mac dinh cua Objects
            ///- [YYYYMMDD] : Ngày tháng năm tạo 
            ///- [000001]: số chạy
            
            $id =  (string)"11".date("Y").date("m").date("d");
            $sql="SELECT `ObjectId` FROM `objects` WHERE LEFT(`ObjectId`,10) = '".$id."' ORDER BY `ObjectId` ";
            
            $arr = $this->db2->query($sql)->result();
            $lst = (array)$arr;
            $stt=1;
            if(count($lst)>0)
            {
                $i=0;
                for($i =0; $i<count($lst);$i++)
                {
                    $id_daco = $lst[$i]->ObjectId;
                    $stt = intval (substr($id_daco,10,strlen($id_daco)));
                    if ($stt != $i + 1)
                    {
                        $stt = $i + 1;
                        break;
                    }
                    if ($i == count($lst)-1)
                    {
                        $stt = count($lst) + 1;
                    }
                }
                
            }
            else
            {
                $stt=1;
            }
            $s_stt ="";
            if ($stt < 10)
                $s_stt = "00000" . strval($stt);
            else if (($stt < 100) && ($stt >= 10))
                $s_stt = "0000" . strval($stt);
            else if (($stt < 1000) && ($stt >= 100))
                $s_stt = "000" . strval($stt);
            else if (($stt < 10000) && ($stt >= 1000))
                $s_stt = "00" . strval($stt);
            else if (($stt < 100000) && ($stt >= 10000))
                $s_stt = "0" . strval($stt);
            else
                $s_stt = strval($stt);
            
            $id= $id. $s_stt;
            return $id;
     }
     public function getmaxpointdiscount()
     {
        $pointtomoneymember = $this->ScoreRate();
        $ScoreRate=500;
        if(isset($pointtomoneymember) && count($pointtomoneymember)>0)
            $ScoreRate = (float)$pointtomoneymember->NumValue1;
                
        $tongtiencart=0;
        $maxdiscountpoint=0;
        $maxdiscountmoney=0;
        $MinPricePoint=$this->m_checkout->GetSetting('MinPricePoint');
        foreach($_SESSION['Cart'] as $row_tt)
        {
            foreach($row_tt['list_product'] as $row_tt2)
            {
                $tongtiencart+=$row_tt2['Qty']*$row_tt2['Price'];
            }
        }
        if($tongtiencart>=$MinPricePoint)
        {
            $maxdiscountpoint=floor((float)(($tongtiencart-$MinPricePoint)/$ScoreRate));
            $maxdiscountmoney = $tongtiencart-$MinPricePoint;
        }
        $arr=array("maxdiscountpoint"=>$maxdiscountpoint,"maxdiscountmoney"=>$maxdiscountmoney);
        return $arr;
     }
     public function sendmailnotify($dstr_bookingid)
     {
            //echo $dstr_bookingid;die;
            $arr_bookingid=explode(", ",$dstr_bookingid);
            //print_r($arr_bookingid);die;
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
            for($j=0;$j<($somabooking-1);$j++)
            {
                $strmailspa=""; //dung gui mail cho spa
                $dbookingID=$arr_bookingid[$j];
                $this->m_sms->SendSMSBookingSuccess($dbookingID);
                $temid= (int)substr($dbookingID,-6);
                $shotbookingID="99#".$temid;
                $str_bookingid.=$shotbookingID.", ";
                //echo $str_bookingid;die;
                $ttspa=$this->layttspatheobookingid($dbookingID);
                $emailspa = $ttspa->Email1; //dung cho gui mail spa
                $spaName = $ttspa->spaName; //dung cho gui mail spa
                $spaPhone = $ttspa->Tel;
                $laybooking= $this->laybookingtheoid($dbookingID);
                $createby=$laybooking[0]->ObjectID; //co the la userid hoac objectid
                if($j==0)
                {
                    $nguoitao="";
                    $nguoinhan ="";
                    $obj_id= "";
                    $arr_email_objectid = $this->objectid_mailnotify($createby);
                    //print_r($arr_email_objectid);die;
                    $nguoinhan = $arr_email_objectid['email'];
                    $obj_id = $arr_email_objectid['objectid'];
                    
                    $arr_Object = $this->m_user->lay_object_theo_ObjectID($obj_id);
                    if(count($arr_Object)>0)
                        $tenuser=$arr_Object[0]->FullName;
                    else
                        $tenuser="";
                    //echo $tenuser;die;
                    $TongDaiHotLine=$this->GetSetting('TongDaiHotLine');
                    $EmailHotLine=$this->GetSetting('EmailHotLine');   
                     
                     $sql_booking="SELECT * FROM `booking` WHERE `bookingID`='$dbookingID'";
                     $query_booking=$this->db->query($sql_booking)->result();
                     
                     //$dPayment_method=$query_booking[0]->Status;
                     $query_bookingpayment=$this->laybookingpaymenttheoid($dbookingID);
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
                }
                $query_bookingpayment=$this->laybookingtheoid($dbookingID);
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
                
                $list_pro= $this->layttbookingtheoid($dbookingID);
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
                        //echo 'Message could not be sent.';
                        //echo 'Mailer Error: ' . $mailspa->ErrorInfo;
                    } else {
                        //echo 'Message has been sent';
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
                //echo 'Message could not be sent.';
                //echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Message has been sent';
            }
            if(isset($_SESSION['Cart']))
                unset($_SESSION['Cart']);
            if(isset($_SESSION['check1']))
                unset($_SESSION['check1']); 
            if(isset($_SESSION['check2']))
                unset($_SESSION['check2']);
            if(isset($_SESSION['discount']))
                unset($_SESSION['discount']); 
            if(isset($_SESSION['textrequestmember']))
                unset($_SESSION['textrequestmember']); 
    }
    public function objectid_mailnotify($createby)
    {
        $objectid="";
        $email="";
        $user = $this->layuser_theouserid($createby);
        if(count($user)>0) //createby la userid
        {
            $objectid=$user->ObjectId;
            $object=$this->layobjecttheouserid($createby);
            if(count($object)>0)
                $email=$object->Email;
        }
        else //createby la objectid
        {
            $objectid=$createby;
            $object=$this->layobjecttheObjectID($createby);
            if(count($object)>0)
                $email=$object->Email;
        }
        $arr=array("objectid"=>$objectid,"email"=>$email);
        return $arr;
    }
    public function getmoneymemberbypoint()
    {
        $ScoreRate=500;
        if(isset($pointtomoneymember) && count($pointtomoneymember)>0)
            $ScoreRate = (float)$pointtomoneymember->NumValue1;
        $arr=array("ScoreRate"=>$ScoreRate);
        return $arr;
    }
  }
?>
