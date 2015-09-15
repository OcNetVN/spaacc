<?php
class M_productdetail extends CI_Model
{
    private $db2;
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('thebooking', TRUE);
    }
    public function layproduct_theoma($productid)
    {
        //$sql="SELECT c.`spaName`,d.`StrValue1`, b.`Price`,a.* FROM `products` a, `price` b,`spa` c, `commoncode` d, `spalocation` e
                //WHERE a.`ProductID`=b.`ProductID` AND a.`SpaID`=c.`spaID` AND c.`spaID`=e.`spaID` AND e.`LocationID`=d.`CommonId` 
                //AND d.`CommonTypeId`='LOCATION' AND b.`Status`=1 AND a.`ProductID`='$productid'";
        $sql="SELECT c.`spaName`, b.`Price`,a.* FROM `products` a, `price` b,`spa` c
            WHERE a.`ProductID`=b.`ProductID` AND a.`Status` = 1 AND a.`SpaID`=c.`spaID` AND b.`Status`=1 AND a.`ProductID`='$productid'";
        
        $query=$this->db->query($sql)->row();
        return $query;
    }
    public function checkpromotion()
    {
        $masp=$_POST['masp'];
        $promotionid=0;
        $sql="SELECT * FROM `promotiondetails` WHERE `ProductId`='$masp'";
        $query=$this->db->query($sql)->row();
        $sd=count($query);
        if($sd==1 || $sd == "1")
            $promotionid=$query->PromotionId;
        $arr=array("masp"=>$masp,"promotionid"=>$promotionid);
        return $arr;
    }
    
    
}
?>