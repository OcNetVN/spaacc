<?php
    class M_spa_calendar extends CI_Model{
        public function __construct()
        {
            parent::__construct();
            $this->db2 = $this->load->database('thebooking', TRUE);

        }


        /*
        |----------------------------------------------------------------
        |function Load_Calendar
        |----------------------------------------------------------------
        */

        public function Load_Calendar(){
            $spaid    = $_SESSION["AccSpa"]["spaid"];

            $ngaybatdau  = $_POST['ngay'];
            $songay  = $_POST['songay'];
            $ngayketthuc = date("Y-m-d", strtotime("$ngaybatdau + $songay day"));


          
            $sql= " SELECT bd.*,b.`ObjectID`,p.`Duration`,p.`Name`, '1' AS bookingonlinepay, '2' AS bookingpayment, '3' AS booking_object";
            $sql.=" FROM `products` p, `bookingdetails` bd, `booking` b";
            $sql.=" WHERE p.`SpaID` = '$spaid'";
            $sql.=" AND p.`ProductID` = bd.`ProductID`";
            $sql.=" AND b.`bookingID` = bd.`bookingID`";
            $sql.=" AND bd.`FromTime` > '$ngaybatdau' AND bd.`ToTime` < '$ngayketthuc'";
  
            $sql = $sql." order by bd.`FromTime` DESC";
            // return $sql;


            $sql1= " SELECT count(*) as Total";
            $sql1.=" FROM `products` p, `bookingdetails` bd, `booking` b";
            $sql1.=" WHERE p.`SpaID` = '$spaid'";
            $sql1.=" AND p.`ProductID` = bd.`ProductID`";
            $sql1.=" AND b.`bookingID` = bd.`bookingID`";
            $sql1.=" AND bd.`FromTime` > '$ngaybatdau' AND bd.`ToTime` < '$ngayketthuc'";

            // return $sql1;
            

            $Listbooking = $this->db->query($sql)->result();

            $dayBeginsHour = $this->dayBeginsHour($spaid); 
            // $dayEndsHour = $this->dayEndsHour($spaid); 

            $this->get_bookingonlinepay_by_bookingID($Listbooking); 

            $this->get_bookingpayment_by_bookingID($Listbooking); 

            $this->get_object_by_bookingID($Listbooking);
           
            $ResTotalPage = $this->db->query($sql1)->result();
            $TotalRecord = ( $ResTotalPage[0]->Total);
            

           
            $res = array("TotalRecord"=>$TotalRecord,"lst"=>$Listbooking,"dayBeginsHour"=>$dayBeginsHour);
            return $res;
        }

        public function dayBeginsHour($spaid)
        {
            $sql    =   "SELECT AvailableHourFrom FROM `spatime` WHERE `SpaID` = '$spaid' order by`AvailableHourFrom` asc limit 0,1 ";
            $dayBeginsHour  =  $this->db->query($sql)->row()->AvailableHourFrom;
            return $dayBeginsHour;
        }
        // public function dayEndsHour($spaid)
        // {
        //     $sql    =   "SELECT AvailableHourTo FROM `spatime` WHERE `SpaID` = '$spaid' order by`AvailableHourTo` desc limit 0,1 ";
        //     $dayEndsHour  =  $this->db->query($sql)->row()->AvailableHourTo;
        //     return $dayEndsHour;
        // }
        public function get_bookingonlinepay_by_bookingID($arr)
        {
            $arr1 = (array) $arr;
            for($i=0;$i<count($arr1);$i++)
            {
                $sql    =   "SELECT * FROM `bookingonlinepay` WHERE `bookingID`= '".$arr1[$i]->bookingID."' AND `ProductID` = '".$arr1[$i]->ProductID."' ";
                $arr1[$i]->bookingonlinepay  =  $this->db->query($sql)->row();
            }
            return $arr1;
        }
        public function get_bookingpayment_by_bookingID($arr)
        {
            $arr1 = (array) $arr;
            for($i=0;$i<count($arr1);$i++)
            {
                $sql    =   "SELECT b.*, c.`CommonId`, c.`StrValue1`,c.`StrValue2` FROM `bookingpayment` b, `commoncode` c WHERE b.`bookingID`= '".$arr1[$i]->bookingID."' AND b.`ProductID` = '".$arr1[$i]->ProductID."' AND b.`PayMethod` = c.`CommonId` AND `CommonTypeId` ='PaymentType'";
                $arr1[$i]->bookingpayment  =  $this->db->query($sql)->row();
            }
            return $arr1;
        }

        public function get_object_by_bookingID($arr)
        {
            $arr1 = (array) $arr;
            for($i=0;$i<count($arr1);$i++)
            {
                $sql    =   "SELECT * FROM spabooking_thebookingdev.`objects` WHERE `ObjectId`= '".$arr1[$i]->ObjectID."' ";
                $arr1[$i]->booking_object  =  $this->db->query($sql)->row();
            }
            return $arr1;
        }

        public function Submit_Booking_Detail()
        {
            $bookingID    = $_POST['bookingID'];
            $ProductID    = $_POST['ProductID'];
            $ngaybook  = $_POST['ngaybook'];

            $thu = date('l', strtotime($ngaybook));

            $intThu=0;
            switch($thu)
            {
                case "Monday":
                {
                    $intThu =2;
                    break;
                }
                case "Tuesday":
                {
                    $intThu =3;
                    break;
                }
                case "Wednesday":
                {
                    $intThu =4;
                    break;
                }
                case "Thursday":
                {
                    $intThu =5;
                    break;
                }
                case "Friday":
                {
                    $intThu =6;
                    break;
                }
                case "Saturday":
                {
                    $intThu =7;
                    break;
                }
                case "Sunday":
                {
                    $intThu =8;
                    break;
                }
            }

            $arrDay =explode(' ',$ngaybook);
            $time = explode(':',$arrDay[1]);
            $gio=$time[0];
            $phut=$time[1];

            $duration = 0;
            $sql0 = "SELECT * FROM `products` WHERE  `ProductID`='$ProductID'";
            $result= (array) $this->db->query($sql0)->result();
            if(count($result)>0)
            {
                $duration = intval($result[0]->Duration);
            }

            // $from = $gio;
            $last = $gio + ceil($duration/60);

            $sql="SELECT a.*  FROM  `producttime` a WHERE a.`ProductID`='$ProductID' AND a.`DayOfWeek`='$intThu' AND AvailableHourFrom < '$gio' AND AvailableHourTo > '$last' ";
            $results= (array) $this->db->query($sql)->result();
            // return $sql;
            if(count($results)==0){
                return count($results);
            }

            $ToTime = $this->CongThoiGian($ngaybook,$duration);

            $sql_update= "UPDATE `bookingdetails` SET `FromTime` = '$ngaybook',`ToTime` = '$ToTime' WHERE `ProductID` = '$ProductID' AND `bookingID` = '$bookingID'";
            
            $results=$this->db->query($sql_update);
            return $results;
        }


        public function CongThoiGian($ngay,$duration)
        {
            $arrDay = explode(' ',$ngay);
            $time = explode(':',$arrDay[1]);
            $gio=$time[0];
            $phut=$time[1];

            $ss = $duration+$phut;
            while ($ss > 59) {
                    $ss = $ss - 60;
                    $gio += 1 ;
            }
            return $arrDay[0]." ".$gio.":".$ss;
        }


        public function Submit_Add_Booking_Offline()
        {
            $FullName    = $_POST['FullName'];
            $Tel    = $_POST['Tel'];
            $Email  = $_POST['Email'];
            $Note  = $_POST['Note'];
            $Product_check  = $_POST['Product_check'];

            $CreatedBy =$_SESSION['AccSpa']['User']->UserId;

            $ObjectId = $this->Check_object($Tel,$Email,$FullName);

            $bookingID = $this->getBookingID();
            // return $bookingID;

            //Insert table booking detail
            //Insert table booking payment
            $Tong_Booking = 0;
            for ($i=0; $i < count($Product_check); $i++) { 
                //get price
                $proID =  $Product_check[$i]['ProductID'];
                $Qty = $Product_check[$i]['Qty'] ;
                $FromTime =  $Product_check[$i]['FromTime'];


                // Kiemtra FromTime
                
                $ToTime =  $this->Check_FromTime($FromTime,$proID);
                // return $ToTime;
                if($ToTime == 0){
                    $action = "FromTime";
                    $fix = $Product_check[$i];
                    $res = array("result"=>false,"fix"=>$fix,"action"=>$action);
                    return $res;
                }

                $price = $this->get_product_price($proID)->Price;
                $TOTAL =  $Qty * $price;
                $TotalAmt = $AmtBT = $AmtAT = $TOTAL ;
                $Tong_Booking+=$TOTAL;


                 //Insert table booking detail
            
                $sql_insert_booking_details = "INSERT INTO `bookingdetails` (`bookingID`, `ProductID`,`PromotionID`,`Qty`,`Price`,`AmtBT`,`Tax`,`AmtAT`,`Status`,`FromTime`,`ToTime`,`TotalAmt`) VALUES ('$bookingID', '$proID', '','$Qty','$price','$AmtBT','0','$AmtAT','1','$FromTime','$ToTime','$AmtBT')";
                $query_insert_booking_details =  $this->db->query($sql_insert_booking_details);
                if(!$query_insert_booking_details){

                    $sql_detele = "DELETE FROM `bookingdetails` WHERE `bookingID` = '$bookingID' ";
                    $this->db->query($sql_detele);

                    $action = "insert";
                    $fix = $Product_check[$i];
                    $res = array("result"=>false,"fix"=>$fix,"action"=>$action);
                    return $res;
                }

                //xoa
                // $sql_detele = "DELETE FROM `bookingdetails` WHERE `bookingID` = '$bookingID' ";
                // $this->db->query($sql_detele);

/////////////////////////////////////////////

                //Insert table booking payment
                $sql_insert_booking_payment = "INSERT INTO `bookingpayment` (`bookingID`, `ProductID`,`PayMethod`,`CreatedDate`,`CreatedBy`,`RefNumber`) VALUES ('$bookingID', '$proID', '11',NOW(),'$CreatedBy','')";
                $query_insert_booking_payment =  $this->db->query($sql_insert_booking_payment);
                if(!$query_insert_booking_payment){

                    $sql_detele = "DELETE FROM `bookingpayment` WHERE `bookingID` = '$bookingID' ";
                    $this->db->query($sql_detele);

                    $sql_detele = "DELETE FROM `bookingdetails` WHERE `bookingID` = '$bookingID' ";
                    $this->db->query($sql_detele);

                    $action = "insert";
                    $fix = $Product_check[$i];
                    $res = array("result"=>false,"fix"=>$fix,"action"=>$action);
                    return $res;
                }

                //xoa
                // $sql_detele = "DELETE FROM `bookingpayment` WHERE `bookingID` = '$bookingID' ";
                // $this->db->query($sql_detele);
            }




            //Insert table booking

            $sql_insert_booking = "INSERT INTO `booking` (`bookingID`, `CreatedDate`, `CreatedBy`, `Status`,`TotalAmtBT`,`TotalTax`,`TotalAmtAT`,`Discount`,`TotalAmt`,`ObjectID`,`Note`,`DiscountID`) VALUES ('$bookingID', NOW(), '$CreatedBy','1','$Tong_Booking','0','$Tong_Booking',0,'$Tong_Booking','$ObjectId','$Note','')";
            $query_insert_booking =  $this->db->query($sql_insert_booking);
            if(!$query_insert_booking){
                $sql_detele = "DELETE FROM `booking` WHERE `bookingID` = '$bookingID' ";
                $this->db->query($sql_detele);

                $sql_detele = "DELETE FROM `bookingpayment` WHERE `bookingID` = '$bookingID' ";
                $this->db->query($sql_detele);

                $sql_detele = "DELETE FROM `bookingdetails` WHERE `bookingID` = '$bookingID' ";
                $this->db->query($sql_detele);


                $action = "insert";
                $fix = [];
                $res = array("result"=>false,"fix"=>$fix,"action"=>$action);
                return $res;
            }
            //xoa
            // $sql_detele = "DELETE FROM `booking` WHERE `bookingID` = '$bookingID' ";
            // $this->db->query($sql_detele);


            $res = array("result"=>true,"bookingID"=>$bookingID);
            return $res;
        }



        public function getObjectID()
        {            
            $id =  (string)"11".date("Y").date("m").date("d");
            $sql="SELECT `ObjectId` FROM `objects` WHERE LEFT(`ObjectId`,10) = '".$id."' ";

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

        public function getBookingID()
        {            
            $id =  (string)"99".date("Y").date("m").date("d");
            $sql="SELECT `bookingID` FROM `booking` WHERE LEFT(`bookingID`,10) = '".$id."' ";

            $arr = $this->db->query($sql)->result();
            $lst = (array)$arr;
            $stt=1;
            if(count($lst)>0)
            {
                $i=0;
                for($i =0; $i<count($lst);$i++)
                {
                    $id_daco = $lst[$i]->bookingID;
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

        public function get_product_price($ProductID)
        {
            $sql    =   "SELECT * FROM `price` WHERE `ProductID`=$ProductID AND `Status`=1 AND `ApprovedBy`!='' ORDER by `CreatedDate` DESC limit 0,1";
            $query  =   $this->db->query($sql)->row();
            return $query;
        }
         

        public function Check_object($Tel,$Email,$FullName)
        {
            $CreatedBy =$_SESSION['AccSpa']['User']->UserId;
            $sql_object = "SELECT * FROM `objects` WHERE `Tel` = '$Tel' AND `Email` = '$Email' AND `Status` = 1";
            $object = $this->db2->query($sql_object)->row();
            $ObjectId = "";
            if(count($object) > 0){
                return $object->ObjectId;
            }            
            $ObjectId = $this->getObjectID();
            $sql_insert_object = "INSERT INTO `objects` (`ObjectId`, `ObjectGroup`, `ObjectType`, `FullName`,`PID`,`PIDState`,`PIDIssue`,`DoB`,`PoB`,`PerAdd`,`TemAdd`,`Gender`,`Image`,`ProvinceId`,`Tel`,`Fax`,`Email`,`Website`,`TaxCode`,`Note`,`Status`,`CreatedBy`,`CreatedDate`,`ModifiedBy`,`ModifiedDate`) VALUES ('$ObjectId', '01', '01','$FullName','','0000-00-00 00:00:00','','0000-00-00 00:00:00','' ,'','','0','','','$Tel','','$Email','','','','1','$CreatedBy',NOW(),'','')";
            $query =  $this->db2->query($sql_insert_object);
            return $ObjectId;

        }

        public function Check_FromTime($ngaybook,$ProductID)
        {
            $thu = date('l', strtotime($ngaybook));

            $intThu=0;
            switch($thu)
            {
                case "Monday":
                {
                    $intThu =2;
                    break;
                }
                case "Tuesday":
                {
                    $intThu =3;
                    break;
                }
                case "Wednesday":
                {
                    $intThu =4;
                    break;
                }
                case "Thursday":
                {
                    $intThu =5;
                    break;
                }
                case "Friday":
                {
                    $intThu =6;
                    break;
                }
                case "Saturday":
                {
                    $intThu =7;
                    break;
                }
                case "Sunday":
                {
                    $intThu =8;
                    break;
                }
            }

            $arrDay =explode(' ',$ngaybook);
            $time = explode(':',$arrDay[1]);
            $gio=$time[0];
            $phut=$time[1];

            $duration = 0;
            $sql0 = "SELECT * FROM `products` WHERE  `ProductID`='$ProductID'";
            $result= (array) $this->db->query($sql0)->result();
            if(count($result)>0)
            {
                $duration = intval($result[0]->Duration);
            }

            // $from = $gio;
            $last = $gio + ceil($duration/60);

            $sql="SELECT a.*  FROM  `producttime` a WHERE a.`ProductID`='$ProductID' AND a.`DayOfWeek`='$intThu' AND AvailableHourFrom <= '$gio' AND AvailableHourTo > '$last' ";
            $results= (array) $this->db->query($sql)->result();
            // return $sql;
            if(count($results)==0){
                return count($results);
            }

            $ToTime = $this->CongThoiGian($ngaybook,$duration);
            return $ToTime;
        }


        public function Submit_Delete_Booking_Offline()
        {
            // $bookingID    = $_POST['bookingID'];
            // $ProductID    = $_POST['ProductID'];

            // //kiemtra ton tai booking và product
            // $sql = "SELECT * FROM `bookingdetails` WHERE `bookingID` = '$bookingID' AND `ProductID` = '$ProductID'";

            // $bookingdetails= (array) $this->db->query($sql)->row();
            // if(count($bookingdetails)==0){
            //     return 0;
            // }
            // // return $bookingdetails['AmtBT'];


            // $sql_update= "UPDATE `booking` SET `TotalAmtBT` = `TotalAmtBT`- ".$bookingdetails['AmtBT'].", `TotalAmtAT` = `TotalAmtAT` - ".$bookingdetails['AmtBT'].", `TotalAmt` = `TotalAmt`- ".$bookingdetails['AmtBT']." WHERE `bookingID` = '$bookingID'";
            // $query_update = $this->db->query($sql_update);
            // if(!$query_update){                
            //     return 0;
            // }
            // $sql_detele = "DELETE FROM `bookingdetails` WHERE `bookingID` = '$bookingID' AND `ProductID` = '$ProductID' ";
            // $query = $this->db->query($sql_detele);
            // if(!$query){
            //     $sql_update= "UPDATE `booking` SET `TotalAmtBT` = `TotalAmtBT`+ ".$bookingdetails['AmtBT'].", `TotalAmtAT` = `TotalAmtAT` + ".$bookingdetails['AmtBT'].", `TotalAmt` = `TotalAmt`+ ".$bookingdetails['AmtBT']." WHERE `bookingID` = '$bookingID'";
            //     $query_update = $this->db->query($sql_update);
            //     return 0;
            // }


            // return $sql_update;
            
        }

        
    }
?>
