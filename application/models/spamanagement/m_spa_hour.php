<?php
    class M_spa_hour extends CI_Model{
        public function __construct()
        {
            parent::__construct();
        }
        /*
        |----------------------------------------------------------------
        |function save spa hour
        |----------------------------------------------------------------
        */
        public function btnsave_spa_hour()
        {
            $spaid                  =   $_SESSION["AccSpa"]["spaid"];
            
            $arrcbdayofweek         =   $_POST["arrcbdayofweek"];
            $arr_hour               =   $_POST["arr_hour"];
            
            foreach( $arr_hour as $row_hour)
            {
                $flag               =   array_search ($row_hour["dayofweek"],$arrcbdayofweek);
                if($flag            === false)
                {
                    $time_from      =   0;
                    $time_to        =   0;
                }
                else
                {
                    $time_from      =   (int)substr($row_hour["time_from"],0,2);
                    $time_to        =   (int)substr($row_hour["time_to"],0,2);
                }
                    
                $sql                =   "UPDATE `spatime` SET 
                                                `AvailableHourFrom` = '".$time_from."', 
                                                `AvailableHourTo` = '".$time_to."' 
                                            WHERE `spaID` = '$spaid' AND `DayOfWeek` = ".$row_hour["dayofweek"];
                $query              =   $this->db->query($sql);
            }
            
            if($query)
                $stt                =   1;
            else
                $stt                =   0;
                
            //return
            $arr                    =   array("stt"     =>  $stt);
            return      $arr;
        }
        
    }
?>
