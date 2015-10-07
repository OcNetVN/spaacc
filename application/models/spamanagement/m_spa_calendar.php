<?php
    class M_spa_calendar extends CI_Model{
        public function __construct()
        {
            parent::__construct();

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

         

        
    }
?>
