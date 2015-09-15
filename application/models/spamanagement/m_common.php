<?php
    class M_common extends CI_Model{
        public $errorStr; 
        public function __construct()
        {
            parent::__construct();
        }
        
        /*
        | function get spa by spaid
        */
        public function get_spa_by_spaid($spaid)
        {
            $sql    =   "SELECT * FROM `spa` WHERE `spaID` = '$spaid'";
            $query  =   $this->db->query($sql)->row();
            return $query;
        }
        /*
        | function get spa hour by spaid
        */
        public function get_spa_hour_by_spaid($spaid)
        {
            $sql    =   "SELECT * FROM `spatime` WHERE `spaID` = '$spaid' ORDER BY `DayOfWeek`";
            $query  =   $this->db->query($sql)->result();
            return $query;
        }
        /*
        | function get list util of spa
        */
        public function get_list_util()
        {
            $sql    =   "SELECT * FROM `commoncode` WHERE `CommonTypeId` = 'SpaFacility' ORDER BY `CommonId`";
            $query  =   $this->db->query($sql)->result();
            return $query;
        }
        /*
        | function get spa util by spaid
        */
        public function get_spa_util_by_spaid($spaid)
        {
            $sql        =   "SELECT `commonId` FROM `spainfo` WHERE `CommonTypeId` = 'SpaFacility' AND `spaId` = '$spaid'";
            $query      =   $this->db->query($sql)->result();
            if(count($query) > 0)
            $arr        =   array();
            foreach($query as $row)
            {
                $arr[]  =   $row->commonId;
            }
            return $arr;
        }
        /*
        | function get list type of spa
        */
        public function get_list_type()
        {
            $sql        =   "SELECT * FROM `commoncode` WHERE `CommonTypeId` = 'SpaType' ORDER BY `CommonId`";
            $query      =   $this->db->query($sql)->result();
            return $query;
        }
        /*
        | function get spa type by spaid
        */
        public function get_spa_type_by_spaid($spaid)
        {
            $sql        =   "SELECT `commonId` FROM `spainfo` WHERE `CommonTypeId` = 'SpaType' AND `spaId` = '$spaid'";
            //echo $sql;die;
            $query      =   $this->db->query($sql)->result();
            if(count($query) > 0)
            $arr        =   array();
            foreach($query as $row)
            {
                $arr[]  =   $row->commonId;
            }
            $arr        =   array_unique($arr);
            return $arr;
        }
        
        /*
        | function get list producttype of spa
        */
        public function get_list_producttype()
        {
            $sql        =   "SELECT * FROM `commoncode` WHERE `CommonTypeId` = 'ProductType' AND LENGTH(`CommonId`) = 4 ORDER BY `CommonId`";
            $query      =   $this->db->query($sql)->result();
            return $query;
        }
        public function get_producttype_by_spaid($spaid)
        {
            $sql        =   "SELECT `ProductType` FROM `spaproductype` WHERE `spaID` = '$spaid' ORDER BY `ProductType`";
            //echo $sql;die;
            $query      =   $this->db->query($sql)->result();
            if(count($query) > 0)
            $arr        =   array();
            foreach($query as $row)
            {
                $arr[]  =   $row->ProductType;
            }
            $arr        =   array_unique($arr);
            return $arr;
        }
        /*
        | function get spa location by spaid
        */
        public function get_spalocation_by_spaid($spaid)
        {
            $sql    =   "SELECT * FROM `spalocation` WHERE `spaID` = '$spaid'";
            $query  =   $this->db->query($sql)->row();
            return $query;
        }
        /*
        |----------------------------------------------------------------
        |function get value from table commoncode of database 2
        |----------------------------------------------------------------
        */
        public function get_list_location_by_level($commondtypeid,$level,$commonid,$db)
        {
            if($commondtypeid == "LOCATION" && $level == 3) //get value 0: show option 0
             $plussql=" OR LENGTH(`CommonId`)=1";
            if($commonid == 0)
                    $sql="SELECT `CommonId`,`StrValue1` FROM `$db`.`commoncode` WHERE `CommonTypeId` = '$commondtypeid' AND (LENGTH(`CommonId`)=$level $plussql) ORDER BY `CommonId`";
            else
                $sql="SELECT `CommonId`,`StrValue1` FROM `$db`.`commoncode` WHERE `CommonTypeId` = '$commondtypeid' AND (LENGTH(`CommonId`)=$level $plussql) AND `CommonId` <>'$commonid' ORDER BY `CommonId`";
            
            $query=$this->db->query($sql)->result();
            return $query;
        }
        /*
        |----------------------------------------------------------------
        |click district when change city 
        |----------------------------------------------------------------
        */
        public function load_location_child_by_location_parent()
        {
            if(isset($_POST['Locationparentid']))
            {
                $db1 = DATABASE_1;
                $Locationparentid=$_POST['Locationparentid'];
                if($Locationparentid == 0)
                    $sql_locationchild = "SELECT * FROM `$db1`.`commoncode` WHERE `CommonId` = '$Locationparentid' AND LENGTH(`CommonId`)=1 AND `CommonTypeId` = 'LOCATION'";
                else
                    $sql_locationchild = "SELECT * FROM `$db1`.`commoncode` WHERE `CommonId` like '$Locationparentid%' AND LENGTH(`CommonId`)=5 AND `CommonTypeId` = 'LOCATION'";            
                
                $query_locationchild=$this->db->query($sql_locationchild)->result();
                $sodong_locationchild=count($query_locationchild);
                $res = array("lst"=>$query_locationchild,"sodong"=>$sodong_locationchild);
                return $res;
            }
        }
        /**
        |----------------------------------------------------------------
        * @table get table link
        |----------------------------------------------------------------
        **/
        public function get_tbl_links($ObjectIDD,$Type,$Status)
        {
            $sql = "SELECT * FROM `links` 
                WHERE `ObjectIDD` = '$ObjectIDD' AND `Type` = '$Type' AND `Status` = $Status ORDER BY `UploadedDate` DESC";
            $query = $this->db->query($sql)->result();
            return $query;
        }
        /*
        |----------------------------------------------------------------
        | function delete image
        |----------------------------------------------------------------
        */
        public function deleteimage()
        {
            if(isset($_POST["objectidd"]))
            {
                $objectidd          = $_POST["objectidd"];
                $type               = $_POST["type"];
                    
                $sql_xoalinkshinh="select * from `links` where `id` = '$objectidd' AND `Type` = '$type'";
                $query_xoalinkshinh=$this->db->query($sql_xoalinkshinh)->row();
                if(count($query_xoalinkshinh)>0)
                {
                    $url=$query_xoalinkshinh->URL;
                    unlink($url);
                }
                $sql                = "DELETE FROM `links` WHERE `id` = '$objectidd' AND `Type` = '$type'";
                $query              = $this->db->query($sql);
                if($query)
                    return 1;
                else
                    return 0;
            }
        }
        /*
        |----------------------------------------------------------------
        |function check value page invalid or not
        |----------------------------------------------------------------
        */
        public function check_page_invalid($total_record, $page,$limit_record_perpage)
        {
            $res=1;
            for($i=$page;$i>0;$i--)
            {
                if($total_record > (($i-1)*$limit_record_perpage))
                {
                    $res = $i;
                    break;
                }
            }
            return $res;
        }
        /*
    	|----------------------------------------------------------------
    	| get value from file xml
    	|----------------------------------------------------------------
    	*/
        public function getSetting($key)
        {
            $value ="";
            try{
                $xml = simplexml_load_file("resources/setting/Setting.xml");       
                $value = (string) $xml->$key;              
            }catch(exception $e)
            {
                
            }
            return $value;
        }
    }  
?>
