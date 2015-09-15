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
     <script src="<?php echo base_url('resources/front/js/checkout.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('resources/front/js/checkout1.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('resources/front/js/checkout2.js'); ?>"></script>
    <style>
     .modalloading {
        display:    none;
        position:   fixed;
        z-index:    99999999;
        top:        0;
        left:       0;
        height:     100%;
        width:      100%;
        background: rgba( 255, 255, 255, .8 ) 
                    /*url('http://i.stack.imgur.com/FhHRx.gif') */
                    url('<?php echo base_url('resources/front/images/categoryloading.gif'); ?>')
                    50% 50% 
                    no-repeat;
        }
        
        /* When the body has the loading class, we turn
           the scrollbar off with overflow:hidden */
        body.loading {
            overflow: hidden;   
        }
        
        /* Anytime the body has the loading class, our
           modal element will be visible */
        body.loading .modalloading {
            display: block;
        }
     </style>  
</head>

<body>
<div class="modalloading"><!-- Place at bottom of page --></div>
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
        <h1 class="page-title-bar">Check Out: Step 1/3</h1>
        <div id="divcontent">
        <div class="row">
            <div class="col-md-8">
                    <?php
                        $totalmoney=0;
                        foreach($list_info_session as $row_info)
                        {
                            echo '<div class="DivSpa" id="div_'.$row_info['spa']->spaID.'">';
                            echo '<div style="display: none;">'.$row_info['spa']->spaID.'</div>';
                            echo '<h4>Tên Spa: '.$row_info['spa']->spaName.'</h4>';
                            echo '<p>Địa chỉ: '.$row_info['spa']->Address.'</p>';
                            echo '<p>Số điện thoại: '.$row_info['spa']->Tel.'</p>';
                            echo '<p>Email: '.$row_info['spa']->Email.'</p>';
                            echo '<div class="wrap-table">';
                                echo '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped" id="tbl_resproduct_'.$row_info['spa']->spaID.'">';
                                echo '<tr>';
                                  echo '<th>STT</th>';
                                  echo '<th>Sản phẩm, dịch vụ</th>';
                                  echo '<th>Thời gian</th>';
                                  echo '<th>Số lượng</th>';
                                  echo '<th>Giá</th>';
                                  echo '<th>Thành tiền</th>';
                                  echo '<th>&nbsp;</th>';
                                echo '</tr>';
                                
                                $i=0;
                                $totalspamoney=0;
                                foreach($row_info['list_pro'] as $row_pro)
                                {
                                    $stt=$i+1;
                                    //xu ly thoi gian                                    
                                    $fromtime=substr($row_pro->FromTime,-5);
                                    $totime=substr($row_pro->ToTime,-5);
                                    $datebook=explode(" ",$row_pro->ToTime);
                                    $arrdate=explode("-",$datebook[0]);
                                    $daybook=$arrdate[2];
                                    $monthbook=$arrdate[1];
                                    $yearbook=$arrdate[0];
                                    $fidate=$daybook."-".$monthbook."-".$yearbook;
                                    //xu ly thoi gian                                    
                                    echo '<tr id="trBookingTemp'.$row_pro->ProductID.$stt.'">';
                                    echo "<td>".$stt."</td>";
                                                        //khuyen mai
                                                        $promotionid=0;
                                                        $idsp=$row_pro->ProductID;
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
                                    echo '<td><a href="javascript:void(0);" onclick="showdetailpro(\''.$idsp.'\',\''.$promotionid.'\');" data-toggle="modal" data-target="#serviceModal">'.$row_pro->Name.'</a></td>';
                                    echo ' <td>';
                                            echo '<span style="display:none;">'.$row_pro->FromTime.'</span>';
                                            echo '<span style="display:none;">'.$row_pro->ToTime.'</span>';
                                    echo 'Từ: <span>'.$fromtime.'</span> đến <span>'.$totime." ".$fidate.'</span>';
                                    echo '</td>';
                                    ?>
                                            <td><input name="Qty_<?php echo $row_pro->ProductID; ?>" onchange="changeQty_step1('<?php echo $row_pro->ProductID."','".$row_info['spa']->spaID."','".$stt; ?>')" id="Qty_<?php echo $row_pro->ProductID; ?>" type="number" min="1" class="numberic" style="width:40px; text-align:center;" <?php if($row_pro->Qty>0) echo 'value="'.$row_pro->Qty.'"'; else 'value="1"'; ?> />
                                            </td>
                                            
                                    <?php    
                                    echo '<td nowrap="nowrap"><span>'.number_format($row_pro->cartPrice).'</span> VNĐ';
                                    echo '</td>';
                                    echo '<td><span>'.number_format($row_pro->cartPrice*$row_pro->Qty).'</span> VNĐ';
                                    echo '</td>';
                                    echo '<td><button type="button" class="btn btn-default" onclick="deletesubcart(\''.$row_pro->ProductID.'\',\''.$row_info['spa']->spaID.'\',\''.$stt.'\');">Remove</button></td>';
                                    echo '<td style="display:none;">'.$row_pro->ProductID.'</td>';
                                    echo '</tr>';
                                    $i++;
                                    $totalspamoney+=$row_pro->cartPrice*$row_pro->Qty; //tong tien san pham, dich vu cua 1 spa
                                    $totalmoney+=$row_pro->cartPrice*$row_pro->Qty; //tong tien chung het phai tra
                                }
                                echo '<tr>';
                                      echo '<td colspan="5" align="right"><span style="font-size:15px;"><strong>Tổng tiền spa '.$row_info['spa']->spaName.':</strong></span></td>';
                                      echo '<td colspan="2" nowrap="nowrap"><strong><span style="font-size:13px;" id="totalmoney_'.$row_info['spa']->spaID.'">'.number_format($totalspamoney).'</span> VNĐ</strong></td>';
                                    echo '</tr>';
                                echo "</table>";
                                echo "</div>";
                            echo "</div>";
                        }
                    ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped" id="tblbutton_resproduct">
                            <td colspan="3" align="left" style="font-size:18px;" >
                                Bạn đã đặt chổ ở <span id="totalspa"><?php echo count($list_info_session); ?></span> Spa
                                <span id="totalspasession" style="display: none;"><?php echo count($list_info_session); ?></span>
                            </td>
                            <td colspan="5" align="right"><span style="font-size:17px;"><strong>Tổng thành tiền:</strong></span></td>
                            <td ><strong style="font-size:17px;"><span id="totalmoney"><?php echo number_format($totalmoney); ?></span> VNĐ</strong></td>
                      </table>
            </div>
            <div class="col-md-3" id="idpricecode">
                    <?php
                        //echo "<pre>";
//                        print_r($_SESSION['Cart']);
//                        die();
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
                            echo '<h4><strong>Tổng tiền: <span id="totalPricecode">'.number_format($tongtien).'</span> VNĐ</strong></h4>';
                        }
                    ?>
                        <div id="divdiscount">
                            <div id="inputdiscount">
                                <h4>Mã thẻ giảm giá</h4>
                                <label><input type="radio" name="disccode" value="4" checked="checked"/>Không áp dụng</label><br />
                                <label><input type="radio" name="disccode" value="1" />Mã thành viên</label><br />
                                <label><input type="radio" name="disccode" value="2" />Mã giảm giá</label><br />
                                <label><input type="radio" name="disccode" value="3"/>Dùng điểm</label><br />
                                <label><input type="radio" name="disccode" value="5"/>Dùng số tiền dư</label><br />
                                <div id="divusecode" style="display: none;">
                                    <input type="text" class="form-control" id="txtcardcode" />
                                    <p id="pcodeid" style="display: none;"><label>Mã code: </label><input type="text" class="form-control" id="txtgenerated" /></p>
                                    <span id="tberr_pcodeid" style="color: red; font-weight: bold; display: none;"></span><br />
                                    <span id="tberr" style="color: red; font-weight: bold; display: none;"></span>
                                    <span id="clickok" style="display: none;">1</span><br />
                                    <button type="button" class="btn btn-danger" id="applycode" onclick="applycodediscount();">Xác nhận</button>
                                </div>
                                <div id="divusepoint" style="display: none;">
                                    <label style="color: red;">1 điểm = 
                                    <?php 
                                    $pointtomoneymember = $this->m_checkout->ScoreRate();
                                    $ScoreRate=500;
                                    if(isset($pointtomoneymember) && count($pointtomoneymember)>0)
                                        $ScoreRate = (float)$pointtomoneymember->NumValue1;
                                        echo $ScoreRate;
                                    ?> VNĐ</label><br />
                                    <label>Bạn đang có <span id="havepoint">0</span> điểm</label>
                                    <span id="hidehavepoint" style="display: none;"></span><br />
                                    <label style="width:100%;"><label>Bạn muốn dùng </label><input type="text" class="form-control" id="inputpoint" /> <label> điểm</label></label><br />
                                    <p id="errpoint" style="display: none; color: red;"></p>
                                    <span style="color: blue;"><?php $NoteBookByPoint=$this->m_checkout->GetSetting('NoteBookByPoint'); echo $NoteBookByPoint; ?></span><br />
                                    <button type="button" class="btn btn-danger" id="applypoint" onclick="applypointdiscount();">Xác nhận</button>
                                </div>
                                <div id="divuseoutstanding" style="display: none;">
                                    <label>Bạn đang có <span id="haveoutstanding">0</span> VNĐ</label>
                                    <span id="hidehaveoutstanding" style="display: none;"></span><br />
                                    <label style="width:100%;"><label>Bạn muốn dùng </label><input type="text" class="form-control" id="inputoutstanding" />*1000 <label> VNĐ</label></label><br />
                                    <p id="erroutstanding" style="display: none; color: red;"></p>
                                    <button type="button" class="btn btn-danger" id="applyoutstanding" onclick="applyoutstandingdiscount();">Xác nhận</button>
                                </div>
                                <div id="divresultvouchermembercard" style="display: none;"></div>
                                <div id="divresultpoint" style="display: none;"></div>
                                <div id="divresultoutstanding" style="display: none;"></div>
                            </div>
                            <div id="divbtnreload" style="display: none;">
                            </div>
                            <div id="resdiscount" style="display: none;">
                                <span id="spanDiscountCode" style="display: none;"></span>
                                <span id="spanDiscountType" style="display: none;"></span>
                                <span id="spanPercentage" style="display: none;"></span>
                                <span id="spanDiscountAmt" style="display: none;"></span>
                                <span id="spangeneratedID" style="display: none;"></span>
                            </div>
                        </div>
                            <br />
                            <br />
            </div>
        
          </div>
          <div id="divcontentnull" style="display: none;"><h2 style="margin: 30px;">Không có dữ liệu, vui lòng reload lại trang</h2></div>
            <button type="button" id="btnReload" class="btn btn-danger pull-left" style="display: none;" onclick="parent.location='checkout1'">Reload</button>
            <button type="submit" id="btncontinue" class="btn btn-danger pull-right" onClick="gotostep2();">Continue</button>
        </div>    
    
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
<!-- InstanceEnd -->
</html>
