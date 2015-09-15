<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- InstanceBeginEditable name="doctitle" -->
	<title>the Booking - Spa</title>
	<!-- InstanceEndEditable -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('resources/front/favicon.ico'); ?>" />
    <?php require("head.php"); ?>
    <script type="text/javascript" src="<?php echo base_url('resources/front/js/checkout2.js'); ?>"></script>
    
</head>

<body>
<?php require("loadloading.php"); ?>

<header>
    <div class="navbar" role="navigation">
        <div class="full-bar top-bar">
            <div class="container">
                    <div class="row">
                        <?php
                             require("header.php");
                         ?>
                    </div>                    
            </div>
        </div>
        <div class="clearfix"></div>
        <?php
             require("headersearch.php");
         ?>
      
    </div>
    
    <?php
             require("menu.php");
    ?>
    <div class="clearfix"></div>
    
	<!-- InstanceBeginEditable name="Full Content" -->
    <!-- InstanceEndEditable -->    
    
    <div class="container" style="padding-top:10px; padding-bottom:10px;">
    <!-- InstanceBeginEditable name="Main Content" -->
    <div id="loadcontent1">
    	<h1 class="page-title-bar">Check Out: Step 2/3</h1>
        <div class="row">
            <div class="col-md-8">
                            <h3>Chọn hình thức thanh toán</h3>
                            <ul class="nav nav-tabs" role="tablist">    
                              <?php
                                $i=0;
                                $stt=1;
                                $tongtien=0;
                                if(isset($_SESSION['Cart']))
                                {
                                    foreach($_SESSION['Cart'] as $row_sscart)
                                    {
                                        foreach($row_sscart['list_product'] as $row_tt) // tinh tong tien 1 spa
                                        {
                                            $tongtien+=($row_tt['Price']*$row_tt['Qty']);
                                        }
                                    }
                                }
                                foreach($Payment as $row_pay)
                                {
                                    if($row_pay->CommonId!="04")
                                    {
                                        $leftlimitpricebookathome=$this->m_checkout->GetSetting('leftlimitpricebookathome');
                                        if($row_pay->CommonId=="03") //tt tai nha
                                        {
                                            if($tongtien>=$leftlimitpricebookathome)
                                            {
                                                $classactive="";
                                                echo '<li '.$classactive.'><a href="#p_'.$row_pay->StrValue2.'" role="tab" data-toggle="tab" id="tabpayment_0'.$stt.'">'.$row_pay->StrValue1.'</a></li>';
                                            }
                                        }
                                        else
                                        {
                                            if($i==0)
                                                $classactive='class="active"';
                                            else
                                                $classactive="";
                                            echo '<li '.$classactive.'><a href="#p_'.$row_pay->StrValue2.'" role="tab" data-toggle="tab" id="tabpayment_0'.$stt.'">'.$row_pay->StrValue1.'</a></li>';
                                        }
                                        $i++;
                                    }
                                    $stt++;
                                }
                                ?>
                              <!--<li class="active"><a href="#pay-now" role="tab" data-toggle="tab">Pay Now</a></li>
                              <li><a href="#pay-venue" role="tab" data-toggle="tab">Pay at Venue</a></li>-->
                            </ul>
                            <div class="tab-content">
                            <?php
                            $i=0;
                            foreach($Payment as $row_pay)
                            {
                                if($row_pay->CommonId=="01")
                                {
                                    if($i==0)
                                    {
                                        $checked='checked ="checked"';
                                        $classactive="active";
                                    }
                                    else
                                    {
                                        $classactive="";
                                        $checked="";                
                                    }
                                    echo '<div class="tab-pane '.$classactive.'" id="p_'.$row_pay->StrValue2.'">';
                                    echo '<label>';
                                    echo '<input type="radio" style="display:none;" name="pay-method" id="'.$row_pay->CommonId.'" value="'.$row_pay->CommonId.'" '.$checked.'>';
                                    echo '<div class="col-md-12" id="idpricecode">';
                                    echo '<input type="radio" name="SelCardTypeFor123Pay" id="SelCardTypeFor123Pay" value="123PAY" '.$checked.'> Domestic ATM &nbsp; &nbsp; &nbsp;';
                                    echo '<input type="radio" name="SelCardTypeFor123Pay" id="SelCardTypeFor123Pay" value="123PCC"> VISA / Master / JCB';
                                    echo '</div>';
                                    echo '</div>';
                                    }
                                else
                                {
                                    if($row_pay->CommonId!="04")
                                    {
                                        $leftlimitpricebookathome=$this->m_checkout->GetSetting('leftlimitpricebookathome');
                                        if($row_pay->CommonId=="03") //tt tai nha
                                        {
                                            if($tongtien>=$leftlimitpricebookathome)
                                            {
                                                if($i==0)
                                                {
                                                    $checked='checked ="checked"';
                                                    $classactive="active";
                                                }
                                                else
                                                {
                                                    $classactive="";
                                                    $checked="";
                                                }
                                                echo '<div class="tab-pane '.$classactive.'" id="p_'.$row_pay->StrValue2.'">';
                                                echo '<label>';
                                                echo '<input type="radio" name="pay-method" id="'.$row_pay->CommonId.'" value="'.$row_pay->CommonId.'" '.$checked.'>';
                                                echo $row_pay->StrValue1;
                                                echo '</label>';
                                                echo '<label>';
                                                    echo '<span style="display: none;" id="scoreuser">';
                                                    echo '</span>';
                                                echo '</label>';
                                                echo '</div>';
                                            }
                                        }
                                        else
                                        {
                                            if($i==0)
                                            {
                                                $checked='checked ="checked"';
                                                $classactive="active";
                                            }
                                            else
                                            {
                                                $classactive="";
                                                $checked="";
                                            }
                                            echo '<div class="tab-pane '.$classactive.'" id="p_'.$row_pay->StrValue2.'">';
                                            echo '<label>';
                                            echo '<input type="radio" name="pay-method" id="'.$row_pay->CommonId.'" value="'.$row_pay->CommonId.'" '.$checked.'>';
                                            echo $row_pay->StrValue1;
                                            echo '</label>';
                                            echo '<label>';
                                                echo '<span style="display: none;" id="scoreuser">';
                                                echo '</span>';
                                            echo '</label>';
                                            echo '</div>';
                                        }
                                    }
                                }
                                
                                $i++;
                            }
                             ?>
                             <?php 
                                $note=$this->m_checkout->GetSetting('notecheck2');
                                if(isset($note) && $note!="")
                                {
                             ?>
                             <div class="col-md-12">
                                 <br />
                                 <span id="spannote" style="font-size: 13px; color: red;"><?php echo $note; ?></span>
                                 <br />
                             </div>
                             <?php } ?>
                             <div class="col-md-12" id="divinfospa" style="display: none;">
                                 <label>Thông tin Spa đã đặt chổ:</label>
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
                                 <?php 
                                    foreach($_SESSION['Cart'] as $row_cartspa)
                                    {
                                            $infospa=$this->m_checkout->layttspatheoid($row_cartspa['spaid']);
                                            $spaName=$infospa->spaName;
                                            $Address=$infospa->Address;
                                            $Tel=$infospa->Tel;
                                            $Email=$infospa->Email;
                                            echo '<tr>';
                                                echo '<td>';
                                                    echo "Tên Spa: <span style=\"font-weight: bold;\">".$spaName."</span><br />";
                                                    echo "Địa chỉ: <span style=\"font-weight: bold;\">".$Address."</span><br />";
                                                    echo "Điện thoại: <span style=\"font-weight: bold;\">".$Tel."</span><br />";
                                                    echo "Email: <span style=\"font-weight: bold;\">".$Email."</span><br />";
                                                echo '</td>';
                                            echo '</tr>';
                                    }
                                 ?>
                                 </table>
                             </div>
                             
                             
                             <!----------------------------
                             |-----------------------------
                             |check 123pay
                             |----------------------------------
                             |-------------------------------->
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
                             ?>
                             <div class="row">
                                <div class="col-md-8 col-md-offset-2">
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
                                                        $gioitinh="Nam";
                                                    elseif(($user_object->Gender)==1 || ($user_object->Gender)=="1")
                                                        $gioitinh="Nữ";
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
                             <!----------------------------
                             |-----------------------------
                             |check 123pay
                             |----------------------------------
                             -->
                             <div class="col-md-12">
                             <h4>Yêu cầu của bạn:</h4>
                             <textarea rows="5" style="width:100%;" id="textrequestmember"><?php if(isset($_SESSION['textrequestmember'])) echo $_SESSION['textrequestmember']; ?></textarea>
                             </div>
                           	</div>
            </div>
            <div class="col-md-3" id="idpricecode">
                    <?php
                        if(isset($_SESSION['Cart']))
                        {
                            $tongtien=0;
                            foreach($_SESSION['Cart'] as $row_cart)
                            {
                                foreach($row_cart['list_product'] as $row_pro)
                                {
                                    $tongtien+=$row_pro['Price']*$row_pro['Qty'];
                                }
                            }
                            echo '<h4><strong>Tổng tiền: '.number_format($tongtien).' VNĐ</strong></h4>';
                        }
                        if(isset($_SESSION['discount']))
                        {
                            $tongtien=0;
                            foreach($_SESSION['Cart'] as $row_cart)
                            {
                                foreach($row_cart['list_product'] as $row_pro)
                                {
                                    $tongtien+=$row_pro['Price']*$row_pro['Qty'];
                                }
                            }
                            if($_SESSION['discount']['DiscountType']=="Member")
                                $DiscountAmt=(float)($tongtien*$_SESSION['discount']['Percentage'])/100;
                            else
                            {
                                if($_SESSION['discount']['DiscountType']=="Voucher")
                                {
                                    $DiscountAmt = $_SESSION['discount']['DiscountAmt'];
                                }
                                else
                                {
                                    if($_SESSION['discount']['DiscountType']=="Point")
                                    {
                                        $DiscountAmt = $_SESSION['discount']['DiscountAmt']; //1 diem = ? vnd
                                    }
                                    else
                                    {
                                        if($_SESSION['discount']['DiscountType']=="Outstanding")
                                        {
                                            $DiscountAmt = $_SESSION['discount']['DiscountAmt'];
                                        }
                                    }
                                }
                            }
                        }
                        else
                        {
                            $DiscountAmt=0;
                        }
                        echo "Giảm: ".number_format($DiscountAmt)." VNĐ<br />";
                        echo '<h4>Phải trả: '.number_format($tongtien-$DiscountAmt).' VNĐ</h4>';
                        $phaitra=$tongtien-$DiscountAmt;
                        $scoremember=$this->m_checkout->ScoreRatemember()->NumValue1;
                        if($phaitra>0)
                            $poitsave=(float)$phaitra/$scoremember;
                        else
                            $poitsave=0;
                        echo "Điểm tích luỷ: ".$poitsave." điểm";
                    ?>
                    
            </div>
        </div>
        
        <br />
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><button type="submit" class="btn btn-danger" onClick="parent.location='checkout1'">Back</button></td>
            <td id="td_btncontinue"><button type="submit" class="btn btn-danger pull-right" onClick="gotostep3();">Continue</button></td>
          </tr>
        </table>
       </div> 
       <!--step 3-->
       <div id="loadcontent2" style="display: none;">
       
       </div>
       <div id="loadtb" class="col-md-8 col-md-offset-2" style="display: none; color: green; font-weight: bold;">
       
       </div>
        <!--end step 3-->
    
	<!-- InstanceEndEditable -->
    </div>
<?php require("booking.php"); ?>
</header>

<?php
     require("footer.php");
 ?> 


<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "42ca428d-6cd0-4b93-b360-fa0d0bfa3696", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script> 
    
</body>
<!-- InstanceEnd --></html>
