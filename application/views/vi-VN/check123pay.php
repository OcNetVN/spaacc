<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- InstanceBeginEditable name="doctitle" -->
	<title>the Booking - Spa</title>
	<!-- InstanceEndEditable -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('resources/front/favicon.ico'); ?>" />
    <script src="<?php echo base_url('resources/front/js/jquery.js'); ?>"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
        
    <script type="text/javascript" src="<?php echo base_url('resources/front/js/check123pay.js'); ?>"></script>
</head>

<body>

<header>
    <div class="clearfix"></div>
    
	<!-- InstanceBeginEditable name="Full Content" -->
    <!-- InstanceEndEditable -->    
    
    <div class="container" style="padding-top:10px; padding-bottom:10px;">
    <!-- InstanceBeginEditable name="Main Content" -->
    
    <div id="content_page1">
    <div id="loadcontent1">
    	<h1 class="page-title-bar" style="display: none;">Thông tin thanh toán</h1>
        <div class="tab-content">
        
        <!--thanh toan bang 123pay-->
        <?php 
                $tongtien=0;
                //$userid=$_SESSION['AccUser']['User']->UserId;
                foreach($arr_pay123 as $row_pay)
                {
                    $tongtien+= $row_pay['tongtien'];
                }
                //giam gia
                if(isset($_SESSION['discount']))
                {
                    if($_SESSION['discount']['DiscountType']=='Member')
                        $tongtien-=(float)($tongtien*$_SESSION['discount']['Percentage'])/100;
                    else
                    {
                        if($_SESSION['discount']['DiscountType']=='Voucher')
                            $tongtien-=$_SESSION['discount']['DiscountAmt'];
                        else
                        {
                            if($_SESSION['discount']['DiscountType']=='Point')
                                $tongtien-=$_SESSION['discount']['DiscountAmt'];
                            else
                            {
                                if($_SESSION['discount']['DiscountType']=='Outstanding')
                                    $tongtien-=$_SESSION['discount']['DiscountAmt'];
                            }
                        }
                    }
                        
                }
                //end giam gia(con 1 phan o duoi)
         ?>
         <div class="row" style="display: none;">
            <div class="col-md-6 col-md-offset-3">
                <table width="100%" class="table table-bordered">
                      <tr>
                        <td>Tên khách hàng</td>
                        <td><?php if(isset($user_object->FullName) && $user_object->FullName!="") echo $user_object->FullName; else "Chưa cung cấp"; ?></td>
                      </tr>
                      <tr>
                        <td>Giới tính</td>
                        <td>
                            <?php 
                                if(($user_object->Gender)==0 || ($user_object->Gender)=="0")
                                    $gioitinh="Nữ";
                                elseif(($user_object->Gender)==1 || ($user_object->Gender)=="1")
                                    $gioitinh="Nam";
                                else
                                    $gioitinh="Không cung cấp";
                                echo $gioitinh;
                             ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Địa chỉ</td>
                        <td><?php $user_object->PerAdd; ?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><?php echo $user_object->Email; ?></td>
                      </tr>
                      <tr>
                        <td>Điện thoại</td>
                        <td><?php echo $user_object->Tel; ?></td>
                      </tr>
                      <tr>
                        <td>Tổng tiền</td>
                        <td><?php echo number_format($tongtien); ?> VNĐ</td>
                      </tr>
                    </table>
                </div>
            </div>
        <?php
            include 'resources/front/123pay/rest.client.class.php';
            include 'resources/front/123pay/common.class.php';
            function createUniqueOrderId($orderIdPrefix)
            {
            	return $orderIdPrefix.time();
            }
            $mTransactionID = '';// session_id() + hhmmss
            $orderIdPrefix = 'micode';
            
            $result = null;
            $resultMessage = '';
            
            if(isset($_POST['Submit']))
            {
                $username=$user_object->FullName;
                $peradd=$user_object->PerAdd;
                if(($user_object->Gender)==0 || ($user_object->Gender)=="0")
                    $gioitinh="F";
                elseif(($user_object->Gender)==1 || ($user_object->Gender)=="1")
                    $gioitinh="M";
                else
                    $gioitinh="U";
                /*$ngaysinh=$user_object->DoB;
                if($ngaysinh!="")
                {
                    $arr_ngaysinh=explode(" ",$ngaysinh);
                    $arr_ngaysinh=explode("-",$arr_ngaysinh[0]);
                    $ngaysinh=$arr_ngaysinh[2]."/".$arr_ngaysinh[1]."/".$arr_ngaysinh[0];
                }
                else*/
                    $ngaysinh="";
                if(count($user_object->Tel)>=9)
                    $sdt=$user_object->Tel;
                else
                    $sdt="";
                $email=$user_object->Email;
                
                //$cancelURL="http://localhost:99/nhaplieuspa/successpay123"; 
                //$redirectURL="http://localhost:99/nhaplieuspa/successpay123";
                //$errorURL="http://localhost:99/nhaplieuspa/successpay123"; 
                //$actual_link = 'http://'.$_SERVER['HTTP_HOST']. base_url();
				$actual_link = 'http://'.$_SERVER['HTTP_HOST']."/";				
                //echo $actual_link;die;
                $cancelURL= $actual_link . $this->m_mail->getSetting("PayOnlineCancelURL");                
                $redirectURL= $actual_link .  $this->m_mail->getSetting("PayOnlineRedirectURL");                
                $errorURL= $actual_link .  $this->m_mail->getSetting("PayOnlineErrorURL");
                //$ipaddress
                
                $mTransactionID=session_id().time(); //$bookingID;
                $_SESSION['mTransactionID']=$mTransactionID;
                
                $merchantCode=$this->m_mail->GetSetting('merchantCode'); //lay trong settingxml
                $bankCode=$typefor123pay;
                //$bankCode=$this->m_mail->GetSetting('bankCode'); //lay trong settingxml
                $passcode=$this->m_mail->GetSetting('passcode'); //lay trong settingxml
                
            	$aData = array
            	(
            		'mTransactionID' => $mTransactionID, //ma duy nhat minh cung cap cho 123pay
            		'merchantCode' =>$merchantCode, //ma doi tac, do 123pay cung cap cho minh
            		'bankCode' =>$bankCode, //cai nay co dinh
            		'totalAmount' =>$tongtien, //tongtien
            		'clientIP' =>$ipaddress, //dia chi id cua may
                    
                    //'clientIP' =>'192.168.1.8', //dia chi id cua may
            		'custName' =>$username,
            		'custAddress' =>$peradd,
            		'custGender' =>$gioitinh, //M nam, F nữ, U: không có giá trị
            		'custDOB' =>$ngaysinh, // ngay thang nam sinh
            		'custPhone' =>$sdt,
            		'custMail' =>$email,
            		'description' =>'Mua hang tai thebooking.vn', //tieng viet khong dau
            		'cancelURL' => $cancelURL,
                    'redirectURL' => $redirectURL,
                    'errorURL' => $errorURL,
            		'passcode' =>$passcode, //123pay cung cap
            		'checksum' =>'', //ma hoa sha1 do 123pay cung cap
            		'addInfo' =>''
            	);
                /*echo "<pre>";
            	print_r($aData);
                echo "</pre>";die;*/
            	
            	$aConfig = array
            	(
            		'url'=>'https://mi.123pay.vn/createOrder1',
            		'key'=>'SPATHEBOOKINGVNoOAj5Aj8AN',
            		'passcode'=>$passcode,
            		'cancelURL' => 'merchantCancelURL', //fill cancelURL here
            		'redirectURL' => 'merchantRedirectURL', //fill redirectURL here
                    'errorURL' => 'merchantErrorURL', //fill errorURL here
            	);
            	
            	try
            	{
            		$data = Common::callRest($aConfig, $aData);//call 123Pay service
            		$result = $data->return;
            		if($result['httpcode'] ==  200)
            		{
            			//call service success do success flow
            			if($result[0]=='1')//service return success
            			{
            				//re-create checksum
            				$rawReturnValue = '1'.$result[1].$result[2];
            				$reCalChecksumValue = sha1($rawReturnValue.$aConfig['key']);
            				if($reCalChecksumValue == $result[3])//check checksum
            				{
            					/*$resultMessage .= 'Call service result:<hr>';
                                $resultMessage .=  $username.'<br>';
                                $resultMessage .=  $peradd.'<br>';
                                $resultMessage .=  $gioitinh.'<br>';
                                $resultMessage .=  $ngaysinh.'<br>';
                                $resultMessage .=  $sdt.'<br>';
                                $resultMessage .=  $email.'<br>';
                                $resultMessage .=  $cancelURL.'<br>';
                                $resultMessage .=  $redirectURL.'<br>';
                                $resultMessage .=  $errorURL.'<br>';
            					$resultMessage .=  'mTransactionID='.$mTransactionID.'<br>';
            					$resultMessage .=  '123PayTransactionID='.$result[1].'<br>';
            					$resultMessage .=  'URL='.$result[2].'<br>';*/
                                //insert vao database
                                $arr_session=$_SESSION['Cart'];
                 
                                $CreatedDate=date("Y-m-d h:m:s");
                                if(isset($_SESSION['AccUser']))
                                {
                                    $CreatedBy=$_SESSION['AccUser']['User']->UserId;
                                    $ObjectId=$_SESSION['AccUser']['User']->ObjectId;
                                }
                                else //ton tai session object
                                {
                                    $CreatedBy=$_SESSION['object']->ObjectId;
                                    $ObjectId=$_SESSION['object']->ObjectId;
                                }
                                $totaltien=0;
                                $chay=0;
                                if(isset($_SESSION['discount']))
                                {
                                    $txtcode=$_SESSION['discount']['DiscountCode'];
                                    $generatedID=$_SESSION['discount']['generatedID'];
                                    if($_SESSION['discount']['DiscountType']=="Voucher" || $_SESSION['discount']['DiscountType']=="Point" || $_SESSION['discount']['DiscountType']=="Outstanding") //ma code la voucher or point
                                    {
                                        $_SESSION['discountbookingdetail']=$_SESSION['discount']['DiscountAmt']; //dung cho add giam gia vao bookingdetail
                                    }
                                }
                                foreach($arr_session as $row_cart)
                                {
                                    $chay++;
                                    //print_r($row_cart);die;
                                    $int=(string)"99".date("Y").date("m").date("d");
                                    $bookingID=$this->m_checkout->phatsinhma('booking','bookingID',$int);
                                    $tongtienspa=0;
                                    $flag=1;
                                    foreach($row_cart['list_product'] as $row_tt) // tinh tong tien 1 spa
                                    {
                                        $tongtienspa+=($row_tt['Price']*$row_tt['Qty']);
                                        $totaltien+=($row_tt['Price']*$row_tt['Qty']);
                                    }
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
                                                //chinh sua ngay 09/03/2015
                                                //==1: ap dung cho tat ca sp KHONG khuyen mai
                                                //them ==2: ap dung cho tat ca cac spa va moi san pham
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
                                        else //ma code la the thanh vien
                                        {
                                            if($_SESSION['discount']['DiscountType']=="Member")
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
                                                    $tiengiam=$_SESSION['discount']['DiscountAmt']; //1 diem = ? vnd
                                                    if($tongtienspa>$tiengiam)
                                                    {
                                                        $totaldiscount=$tiengiam;
                                                        $_SESSION['discount']['DiscountAmt']=$_SESSION['discount']['DiscountAmt']-$tiengiam;
                                                        
                                                        $pointtomoneymember = $this->m_checkout->ScoreRate();
                                                        $ScoreRate=500;
                                                        if(isset($pointtomoneymember) && count($pointtomoneymember)>0)
                                                            $ScoreRate = (float)$pointtomoneymember->NumValue1;
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
                                                        
                                                        $pointtomoneymember = $this->m_checkout->ScoreRate();
                                                        $ScoreRate=500;
                                                        if(isset($pointtomoneymember) && count($pointtomoneymember)>0)
                                                            $ScoreRate = (float)$pointtomoneymember->NumValue1;
                                                        $sodiemdabook=(float)$totaldiscount/$ScoreRate; //-diem cua member
                                                        $sodiemdabook=-$sodiemdabook;
                                                        $sql_scodebalance="INSERT INTO `scoretrans` (`Id`, `ObjectIDD`, `RefID`, `TotalScore`, `CreatedDate`, `CreatedBy`) 
                                                                    VALUES (NULL, '$CreatedBy', '$bookingID', '$sodiemdabook', '$CreatedDate', '$CreatedBy')";
                                                        //$sql_scodebalance="INSERT INTO `scorebalance` (`id`, `ObjectIDD`, `Type`, `ScoreBalance`, `ModifiedBy`, `ModifiedDate`) 
                                                            //VALUES (NULL, '$bookingID', 'MEMBER', '$sodiemdabook', '$CreatedBy', '$CreatedDate')";
                                                        $query_scorebalance=$this->db2->query($sql_scodebalance);
                                                    }
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
                                                                if($sooutstandingdabook>0)
                                                                {
                                                                    $sooutstandingdabook=-$sooutstandingdabook;
                                                                    $sql_outstanding="INSERT INTO `outstanding` (`id`, `UserId`, `TotalAmt`, `Ref`, `CreatedBy`, `CreatedDate`) 
                                                                    VALUES (NULL, '$CreatedBy', '$sooutstandingdabook', '$bookingID', '$CreatedBy', '$CreatedDate')";
                                                                    $query_outstanding=$this->db2->query($sql_outstanding);
                                                                }
                                                        }
                                                        else
                                                        {
                                                            $totaldiscount=$tongtienspa;
                                                            $_SESSION['discount']['DiscountAmt']=$_SESSION['discount']['DiscountAmt']-$totaldiscount;
                                                            //echo $totaldiscount."-".$_SESSION['discount']['DiscountAmt']." === ";
                                                                
                                                                $sooutstandingdabook=(float)$totaldiscount; //-outstanding cua member
                                                                if($sooutstandingdabook>0)
                                                                {
                                                                    $sooutstandingdabook=-$sooutstandingdabook;
                                                                    $sql_outstanding="INSERT INTO `outstanding` (`id`, `UserId`, `TotalAmt`, `Ref`, `CreatedBy`, `CreatedDate`) 
                                                                    VALUES (NULL, '$CreatedBy', '$sooutstandingdabook', '$bookingID', '$CreatedBy', '$CreatedDate')";
                                                                    $query_outstanding=$this->db2->query($sql_outstanding);
                                                                }
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
                                    try{
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
                                                                     //chinh sua ngay 09/03/2015
                                                                    //==1: ap dung cho tat ca sp KHONG khuyen mai
                                                                    //them ==2: ap dung cho tat ca cac spa va moi san pham
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
                                            $AmtBT=$row_cart1['Price']*$row_cart1['Qty'];
                                            if($DiscountID!="")
                                                $sql_bookingdetail="INSERT INTO `bookingdetails` (`bookingID`, `ProductID`, `Qty`, `Price`, `AmtBT`, `Tax`, `AmtAT`, `Status`, `FromTime`, `ToTime`, `PromotionID`, `Discount`, `TotalAmt`) 
                                                VALUES ('$bookingID', '".$row_cart1['ProductID']."', '".$row_cart1['Qty']."', '".$row_cart1['Price']."', '".$AmtBT."', '0', '".$AmtBT."', '$status', '".$row_cart1['FromTime']."', '".$row_cart1['ToTime']."','$DiscountID', $totaldiscount, $tienphaitra)";
                                            else
                                                $sql_bookingdetail="INSERT INTO `bookingdetails` (`bookingID`, `ProductID`, `Qty`, `Price`, `AmtBT`, `Tax`, `AmtAT`, `Status`, `FromTime`, `ToTime`, `Discount`, `TotalAmt`) 
                                                VALUES ('$bookingID', '".$row_cart1['ProductID']."', '".$row_cart1['Qty']."', '".$row_cart1['Price']."', '".$AmtBT."', '0', '".$AmtBT."', '$status', '".$row_cart1['FromTime']."', '".$row_cart1['ToTime']."', $totaldiscount, $tienphaitra)";
                                            $this->db->query($sql_bookingdetail);
                                            
                                            $sql_payment="INSERT INTO `bookingpayment` (`bookingID`, `ProductID`, `PayMethod`, `CreatedDate`, `CreatedBy`) 
                                                    VALUES ('$bookingID', '".$row_cart1['ProductID']."', '01', '$CreatedDate', '$CreatedBy')";
                                            $this->db->query($sql_payment);
                                            $mTransactionID=$_SESSION['mTransactionID']; 
                                            $sql_payonline="INSERT INTO `bookingonlinepay` (`bookingID`, `mTransactionID`, `ProductID`, `PayAmt`, `CardNo`, `CardHolderName`, `ExpiredDate`, `CardeType`, `Bank`, `Status`, `CreatedBy`, `CreatedDate`) 
                                            VALUES ('$bookingID', '$mTransactionID', '".$row_cart1['ProductID']."', '".$AmtBT."', NULL, NULL, NULL, NULL, NULL, 0, '$CreatedBy', '$CreatedDate')";
                                            $this->db->query($sql_payonline);
                                        }
                                        $this->db->trans_complete();
                                        if ($this->db->trans_status() === FALSE)
                                        {
                                            $this->db->trans_rollback();
                                            echo "Có lỗi xảy ra, mời load lại trang";
                                            die;
                                        }
                                    }
                                    catch(exception $e)
                                    {
                                        echo "Có lỗi xảy ra";
                                        die;
                                    }
                                }
                                if(isset($_SESSION['discountbookingdetail']))
                                    unset($_SESSION['discountbookingdetail']);
                                //die;
            					header('Location: '.$result[2]);
            				}else
            				{
            					//Call 123Pay service create order fail, return checksum is invalid
            					$resultMessage .=  'Return data is invalid<br>';
            				}
            			}else{
            				//Call 123Pay service create order fail, please refer to API document to understand error code list
            				//$result[0]=error code, $result[1] = error description
            				$resultMessage .=  $result[0].': '.$result[1];
            			}
            		}else{
            			//call service fail, do error flow
            			$resultMessage .=  'Call 123Pay service fail. Please recheck your network connection<br>';
            		}
            	}catch(Exception $e)
            	{
            		$resultMessage .=  '<pre>';
            		$resultMessage .= $e->getMessage();
            	}
            	//create new orderid
            }
            $mTransactionID = createUniqueOrderId($orderIdPrefix);
            ?>
            
            <?php
            //show result
            //echo '<span style="color: red; font-weight: bold;">''</span>';
            ?>
        <!--end thanh toan banng 123pay-->
        </div>
       	</div>
        </div>
        <div id="content_page2">
        </div>
        <br />
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="2"><span style="color: red; font-weight: bold; margin-left:20px;"><?php echo $resultMessage; ?></span></td>
                    </tr>
                  <tr>
                    <td><button type="button" class="btn btn-danger" style="display: none;" onClick="parent.location='<?php echo base_url("checkout2"); ?>'">Back</button></td>
                    <td>
                        <form name="frmMain" name="frmMain" method="post" enctype="multipart/form-data">
                            <input style="display: none;" type="submit" name="Submit" id="Submit" size="20" value="Continue" class="btn btn-danger pull-right" />
                        </form>
                    </td>
                  </tr>
                </table>
            </div>
       </div> 
	<!-- InstanceEndEditable -->
    </div>
</header>

</body>
<!-- InstanceEnd --></html>
