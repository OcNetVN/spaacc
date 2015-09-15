<?php
class M_spadetail extends CI_Model
{
    private $db2;
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('thebooking', TRUE);
    }
    public function getspa($spaid)
    {
        $sql="SELECT * FROM `spa` WHERE `spaID`='$spaid' AND `Status` = '1' ";
        $query=$this->db->query($sql)->row();
        return $query;
    }
    
    public function getspalocationID($spaid)
    {
        $sql="SELECT * FROM `spalocation`  WHERE `spaID`='$spaid'";
        $query=$this->db->query($sql)->row();
        return $query;
    }
    
    public function getlistspa(){
         $sql="SELECT * FROM `spa` WHERE  `Status` = '1'  ORDER BY `CreatedDate` DESC ";
         $query=$this->db->query($sql)->result();
         return $query;
    }
    public function loadtimehoatdong($spaid)
    {
        $sql="SELECT * FROM `spatime` WHERE `spaID`='$spaid'";
        $query=$this->db->query($sql)->result();
        return $query;
    }
    public function loadspainfo($spaid) //lay list tien ich
    {
        $sql="SELECT a.`value`,b.* 
            FROM `spainfo` a, `commoncode` b 
            WHERE a.`commonId`=b.`CommonId` 
                AND b.`CommonTypeId`='SpaFacility' 
                AND a.`spaId`='$spaid' 
                GROUP BY b.`CommonId`";
        $query=$this->db->query($sql)->result();
        return $query;
    }
    
    public function loadspalocation($spaid) //lay list tien ich
    {
        $sql="  SELECT a.*,b.`StrValue1`
                FROM `spalocation` a 
                INNER JOIN `commoncode` b  ON a.`LocationID` = b.`CommonId`
                WHERE a.`spaID` = '$spaid'";
        $query=$this->db->query($sql)->row();
        return $query;
    }
    
    public function loadspatype($spaid) //lay list loai spa, hinh thuc spa, giong nhu list tien ich
    {
        $sql="SELECT a.`value`,b.* 
            FROM `spainfo` a, `commoncode` b 
            WHERE a.`commonId`=b.`CommonId` 
                AND b.`CommonTypeId`='SpaType' 
                AND a.`spaId`='$spaid' 
                GROUP BY b.`CommonId`";
        $query=$this->db->query($sql)->result();
        return $query;
    }
    
    // chỗ này dùng để load sản phẩm lên nè ngày đây là nguyên nhân vì sao mà không có sản phẩm 28/01/2015
    public function loadloaisanpham($spaid) //lay list loai san pham cua spa do
    {
        $sql="SELECT ProductType 
                FROM `spaproductype` 
                WHERE `spaID`='$spaid'";
        $query=$this->db->query($sql)->result();
        return $query;
    }
    // end chỗ này dùn để load sản phẩm cố lên nào 
    public function laytenproducttypetheoid($producttypeid) //lay list loai san pham cua spa do
    {
        $sql="SELECT `StrValue1`,`StrValue2` FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND `CommonId`='$producttypeid'";
        $query=$this->db->query($sql)->row();
        return $query;
    }
    public function loadsanpham($spaid,$productType) //lay list san pham cua spa
    {
        $sql="SELECT a.*,b.`Price` FROM `products` a,`price` b 
              WHERE a.`ProductID`=b.`ProductID` AND a.`SpaID`='$spaid' 
              AND a.`ProductType`='$productType'  
              AND a.`Status` = '1'  AND b.`Status` = '1'
              GROUP BY a.`ProductID` 
              ORDER BY a.`CreatedDate` DESC";
        //echo $sql;
        $query=$this->db->query($sql)->result();
        return $query;
    }
    public function loadhinhspa($spaid) //list hinh cua spa do
    {
        $sql="SELECT * FROM `links` WHERE `Type`='SPA' AND `ObjectIDD` = '$spaid'";
        $query=$this->db->query($sql)->result();
        return $query;
    }
    //get image frist ngày 06/01/2015
     public function getfristhinh($spaid) //list hinh cua spa do
    {
        $sql="SELECT * FROM `links` WHERE `Type`='SPA' AND `ObjectIDD` = '$spaid'";
        $query=$this->db->query($sql)->result();
        $image = $query[0]->URL;
        return $image;
    }
    public function loadcommentfirst($spaid) //list comment cap 1
    {
        $actual_link = 'http://'.$_SERVER['HTTP_HOST'];   
        $sql="SELECT a.*,b.`FullName` FROM `comments` a,spabooking_thebookingdev.`objects` b,spabooking_thebookingdev.`users` c
                WHERE a.`ObjectIDD`='$spaid' AND a.`Level`='1'
                      AND a.`CreatedBy`= c.`UserId` AND c.`ObjectId`=b.`ObjectId`
                    AND a.`ApprovedBy` IS NOT NULL AND a.`ApprovedDate` IS NOT NULL 
                    ORDER BY a.`ModifiedDate` DESC";
                    
        if(strpos($actual_link,"localhost")>0 || strpos($actual_link,"127.0.0.1")>0)
        {
            $sql="SELECT a.*,b.`FullName` FROM `comments` a, `thebooking`.`objects` b, `thebooking`.`users` c
                WHERE a.`ObjectIDD`='$spaid' AND a.`Level`='1'
                      AND a.`CreatedBy`= c.`UserId` AND c.`ObjectId`=b.`ObjectId`
                    AND a.`ApprovedBy` IS NOT NULL AND a.`ApprovedDate` IS NOT NULL 
                    ORDER BY a.`ModifiedDate` DESC";
        }
        
        $query=$this->db->query($sql)->result();
        return $query;
    }
    public function loadcommentafter($spaid,$cmtid) //list comment cap 1
    {
        $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
        
        $sql="SELECT a.*,b.`FullName` FROM `comments` a, spabooking_thebookingdev.`objects` b, spabooking_thebookingdev.`users` c
                WHERE a.`ObjectIDD`='$spaid' AND a.`Level`='2' AND a.`ParentID`=$cmtid 
		              AND a.`CreatedBy`= c.`UserId` AND c.`ObjectId`=b.`ObjectId`
                	AND a.`ApprovedBy` IS NOT NULL AND a.`ApprovedDate` IS NOT NULL 
                	ORDER BY a.`ModifiedDate` DESC";
        if(strpos($actual_link,"localhost")>0 || strpos($actual_link,"127.0.0.1")>0)
        {
           $sql="SELECT a.*,b.`FullName` FROM `comments` a, `thebooking`.`objects` b, `thebooking`.`users` c
                WHERE a.`ObjectIDD`='$spaid' AND a.`Level`='2' AND a.`ParentID`=$cmtid 
                      AND a.`CreatedBy`= c.`UserId` AND c.`ObjectId`=b.`ObjectId`
                    AND a.`ApprovedBy` IS NOT NULL AND a.`ApprovedDate` IS NOT NULL 
                    ORDER BY a.`ModifiedDate` DESC"; 
        }
        $query=$this->db->query($sql)->result();
        return $query;
    }
    public function btnsendcomment()
    {
        $dcmtid=$_POST['dcmtid'];
        $dspaid=$_POST['dspaid'];
        $dcontent=$_POST['dcontent'];
        $CreatedBy=$_SESSION['AccUser']['User']->UserId;
        $CreatedDate=date("Y-m-d h:m:s");
        
        if($dcmtid==0 || $dcmtid=="0")
            $sql="INSERT INTO `comments` (`Content`, `CreatedBy`, `CreatedDate`, `Status`, `ObjectIDD`, `Level`) 
                VALUES ('$dcontent', '$CreatedBy', '$CreatedDate', '1', '$dspaid', 1)";
        else
            $sql="INSERT INTO `comments` (`Content`, `CreatedBy`, `CreatedDate`, `ParentID`, `Status`, `ObjectIDD`, `Level`) 
                VALUES ('$dcontent', '$CreatedBy', '$CreatedDate', '$dcmtid', '1', '$dspaid', 2)";
        $query=$this->db->query($sql);
        
        if($query)
            $tbchung="ok";
        else
            $tbchung="";
        $res = array("tbchung"=>$tbchung,"formcmt"=>$dcmtid);
        return $res;
    }
    public function layspatype_theocommonid($commonid)
    {
        $sql="SELECT `CommonId`,`StrValue1` FROM `commoncode` WHERE `CommonTypeId` = 'SpaType' AND `CommonId` = '$commonid'";
        //echo $sql;
        $query=$this->db->query($sql)->row();
        return $query;
    }
    public function layhinhthucspa_theospaid($spaid)
    {
        $sql="SELECT `commonId` FROM `spainfo` WHERE `commonTypeId`='SpaType' AND `spaId` = '$spaid'";
        //echo $sql."<br />";
        $a=$this->db->query($sql)->row();
        if(isset($a->commonId) && $a->commonId!="")
            $nametienich=$this->layspatype_theocommonid($a->commonId)->StrValue1;
        else   
            $nametienich="";
        return $nametienich;
    }
    
    public function getPromotion($ProductId){
         $sql = "SELECT a.*,b.`PromotionName`,b.`PromotionType`,b.`BeginDateTime`, b.`EndDateTime` 
                FROM `promotiondetails` a, `promotions` b 
                WHERE a.`PromotionId`=b.`PromotionId` AND a.`ProductId`='$ProductId'";
        $query = $this->db->query($sql)->result();
        return $query;
    }
    public function countview($spaid)
    {
        $sql="SELECT * FROM `spa` WHERE `spaID`='$spaid'";
        $query=$this->db->query($sql)->row();
        if(count($query)>0)
        {
            $totalview=(float)$query->CountView;
            $totalview+=1;
            //echo $totalview;die;
            $sql_update="UPDATE `spa` SET `CountView` = $totalview WHERE `spaID` = '$spaid'";
            //echo $sql_update;
            $this->db->query($sql_update);
        }
    }
        
}
?>