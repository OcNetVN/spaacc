<?php
    class M_spa_info extends CI_Model{
        public function __construct()
        {
            parent::__construct();
        }
        /*
    	|----------------------------------------------------------------
    	| get location by spa
    	|----------------------------------------------------------------
    	*/
        public function getlocation_by_spa()
        {
            $str_location_level1    = "";
            $spaid                  =   $_SESSION["AccSpa"]["spaid"];
            $row_locationspa        =   $this->m_common->get_spalocation_by_spaid($spaid);
            
            if($row_locationspa->LocationID == "" || $row_locationspa->LocationID == 0)
                $location_level1    = 0;
            else
                $location_level1    = substr($row_locationspa->LocationID,0,3);
            $arr_location_lever1    = $this->m_common->get_list_location_by_level("LOCATION",3,0,DATABASE_1);
            foreach($arr_location_lever1 as $row_3)
            {
                if($location_level1 == $row_3->CommonId)
                    $str_location_level1 .= "<option value=\"".$row_3->CommonId."\" selected=\"selected\">".$row_3->StrValue1."</option>";
                else
                    $str_location_level1 .= "<option value=\"".$row_3->CommonId."\">".$row_3->StrValue1."</option>";
            }
            
            //return
            $arr    =   array(
                            "str_location_level1"   =>  $str_location_level1,
                            "location_level1"       =>  $location_level1,
                            "LocationID"            =>  $row_locationspa->LocationID,
                        );
            return $arr;
        }
        /*
        |----------------------------------------------------------------
        |function save edit spa
        |----------------------------------------------------------------
        */
        public function btnsave_spainfo()
        {
            $spaid                  =   $_SESSION["AccSpa"]["spaid"];
            
            $txtSpaName             =   $_POST["txtSpaName"];
            $txtSpaAdd              =   $_POST["txtSpaAdd"];
            $txtTel1                =   $_POST["txtTel1"];
            $txtTel                 =   $_POST["txtTel"];
            $txtEmail1              =   $_POST["txtEmail1"];
            $txtEmail               =   $_POST["txtEmail"];
            $txtLoctionGPS          =   $_POST["txtLoctionGPS"];
            $txtLoctionName         =   $_POST["txtLoctionName"];
            $sedistrict             =   $_POST["sedistrict"];
            $txtWebsite             =   $_POST["txtWebsite"];
            $txtIntro               =   $_POST["txtSpaName"];
            $txtMoreInfo            =   $_POST["txtMoreInfo"];
            $txtNote                =   $_POST["txtNote"];
            
            $location               =   $txtLoctionGPS."|".$txtLoctionName;
            
            $sql                    =   "UPDATE `spa` SET 
                                                `spaName`           = '$txtSpaName', 
                                                `Address`           = '$txtSpaAdd', 
                                                `Tel1`              = '$txtTel1', 
                                                `Email1`            = '$txtEmail1', 
                                                `Note`              = '$txtNote', 
                                                `ModifiedBy`        = 'Spa', 
                                                `ModifiedDate`      = NOW(), 
                                                `Intro`             = '$txtIntro', 
                                                `MoreInfo`          = '$txtMoreInfo', 
                                                `Location`          = '$location', 
                                                `Website`           = '$txtWebsite', 
                                                `Tel`               = '$txtTel', 
                                                `Email`             = '$txtEmail' 
                                WHERE `spaID` = '$spaid'";
            $query                  =   $this->db->query($sql);
            
            $sql_location           =   "UPDATE `spalocation` SET `LocationID` = '$sedistrict'  
                                    WHERE `spaID` = '$spaid'";
            $query_location         =   $this->db->query($sql_location);
            if($query && $query_location)
                $stt                =   1;
            else
                $stt                =   0;
                
            //return
            $arr                    =   array("stt"     =>  $stt);
            return      $arr;
        }
        /**
        |----------------------------------------------------------------
        * @table  insert table link
        |----------------------------------------------------------------
        **/
        public function insert_tbl_links($ObjectIDD,$URL,$Type,$Status,$UploadedBy)
        {
            //url: resources/img/news/10/vourcher_news.jpg
            
            $arr_url    = explode("/",$URL);
            $filename_upload        = $arr_url[(count($arr_url)-1)];
            $arr_filename_upload          = explode(".",$filename_upload);
            $str_FileExtension          = $arr_filename_upload[(count($arr_filename_upload)-1)];
            $filename                   = substr($filename_upload,0,(strlen($filename_upload)-4));
            
            $sql = "INSERT INTO `links` (`id`,   `ObjectIDD`,     `URL`,      `Type`,     `FileExtension`,    `FileName`,   `Status`, `UploadedBy`, `UploadedDate`) 
                                 VALUES (NULL, '$ObjectIDD',     '$URL',     '$Type', '$str_FileExtension',  '$filename', '$Status', '$UploadedBy',    NOW())";
            $query = $this->db->query($sql);
            return $query;
        }
        /*
        |----------------------------------------------------------------
        | function preview image uploaded
        |----------------------------------------------------------------
        */
        public function previewimage_spainfo() 
        {
            if(isset($_POST["id"]))
            {
                $id                     = $_POST["id"];
                $str_res                = "";
                
                $flag                   = 0;
                $list_links             = $this->m_common->get_tbl_links($id,"SPA",1);
                if(count($list_links) > 0)
                {
                    $flag               = 1;
                    foreach( $list_links as $row_list_links )
                    {
                        $str_res            .= '  <div class="col-sm-6 col-md-4">
                                                    <div class="thumbnail">
                                                      <img src="'.base_url($row_list_links->URL).'">
                                                      <div class="caption">
                                                        <button type="button" class="btn btn-primary" role="button" onclick="deleteimage(\''.$row_list_links->id.'\',\'SPA\');">Xoá</button>
                                                      </div>
                                                    </div>
                                                  </div>';
                    }
                }
                //return 
                $arr        = array("str_res" => $str_res,"flag"=>$flag);
                return $arr;
            }
        }
        
    }
?>
