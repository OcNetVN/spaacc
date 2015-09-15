<?php
    class M_spa_util extends CI_Model{
        public function __construct()
        {
            parent::__construct();
        }
        /*
        |----------------------------------------------------------------
        |function save spa util
        |----------------------------------------------------------------
        */
        public function btnsave_spa_util()
        {
            $spaid                  =   $_SESSION["AccSpa"]["spaid"];
            
            $arrcbutil              =   $_POST["arrcbutil"];
            $cbtype                 =   $_POST["cbtype"];
            $arr_producttype        =   $_POST["arr_producttype"];
            
            //print_r($arrcbutil);die;
            $this->db->trans_start();
            $sqldelutil             =   "DELETE FROM `spainfo` WHERE `spaId` = '$spaid' AND `commonTypeId` = 'SpaFacility'";
            $querydelutil           =   $this->db->query($sqldelutil);
            foreach( $arrcbutil as $row_util)
            {
                $sql                =   "INSERT INTO `spainfo` 
                                                (`id`,  `spaId`, `commonTypeId`, `commonId`, `createdBy`, `createdDate`, `value`) 
                                        VALUES (NULL,   '$spaid', 'SpaFacility', '$row_util',   'spa ',     NOW(),        NULL)";
                $query              =   $this->db->query($sql);
            }
            
            $sqldel_type            =   "DELETE FROM `spainfo` WHERE `spaId` = '$spaid' AND `commonTypeId` = 'SpaType'";
            $querydel_type          =   $this->db->query($sqldel_type);
            $sqltype                =   "INSERT INTO `spainfo` 
                                                (`id`,  `spaId`, `commonTypeId`, `commonId`, `createdBy`, `createdDate`, `value`) 
                                        VALUES (NULL,   '$spaid', 'SpaType',    '$cbtype',      'spa ',     NOW(),        NULL)";
            $querytype              =   $this->db->query($sqltype);
            
            $sqldelproducttype      =   "DELETE FROM `spaproductype` WHERE `spaID` = '$spaid'";
            $querydelproducttype    =   $this->db->query($sqldelproducttype);
            foreach( $arr_producttype as $row_producttype)
            {
                $sqlproducttype     =   "INSERT INTO `spaproductype` 
                                            (`spaID`,   `ProductType`,    `Status`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) 
                                    VALUES ('$spaid', '$row_producttype',   '1',        NULL,       NULL,           'spa',          NOW())";
                $queryproducttype   =   $this->db->query($sqlproducttype);
            }
            
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {
                $stt                =   0;
                $this->db->trans_rollback();
            }
            else
                $stt                =   1;
                
            //return
            $arr                    =   array("stt"     =>  $stt);
            return      $arr;
        }
        
    }
?>
