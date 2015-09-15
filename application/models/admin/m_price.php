<?php 
class M_price extends CI_Model{
    public $errorStr; 
    public function __construct()
    { 
        parent::__construct();
    }
            
    public function lay_loai_cha()
    {
        $sql = "SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND LENGTH(`CommonId`)=2 order by StrValue2"; //l?y c?p 2
        $ListProductTypes = $this->db->query($sql)->result();
        $sodong=count($ListProductTypes);
        $res = array("lst"=>$ListProductTypes,"sodong"=>$sodong);
        return $res;
    }
    public function lay_spa()
    {
        $sql = "SELECT * FROM `spa` order by spaName"; //l?y c?p 2
        $ListProductTypes = $this->db->query($sql)->result();
        $sodong=count($ListProductTypes);
        $res = array("lst"=>$ListProductTypes,"sodong"=>$sodong);
        return $res;
    }
    public function lay_loaicon()
    {
        $IDCha=$_POST['IDCha'];
        $sql="";
        $ListProductTypes="";
        $sodong=0;
        if($IDCha!=0)
        {
            $sql = "SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND LENGTH(`CommonId`)=4 and CommonId like '".$IDCha."%' and CommonId <> '".$IDCha."' order by StrValue2"; //l?y c?p 2
            $ListProductTypes = $this->db->query($sql)->result();
            $sodong=count($ListProductTypes);
        }
        $res = array("lst"=>$ListProductTypes,"sodong"=>$sodong);
        return $res;
    }
    //search
    public function search_products(){            
        $Loaicha    = $_POST['Loaicha'];            
        $Listspa    = $_POST['Listspa'];
        $Loaicon    = $_POST['Loaicon'];
        $Timten    = $_POST['Timten'];
        $page       = $_POST["Page"];
      
        $sql = "SELECT '1' AS STT,products.*,CONCAT(LEFT(`Description`,100),'...') AS desc1 FROM products";       
        $sql1 = "SELECT count(*) as Total FROM products  ";
                
        $sql = $sql." where 1=1 ";
        $sql1 = $sql1." where 1=1 ";            
      
        if($Loaicha !="0"){
            $sql = $sql." and `ProductType` like '".$Loaicha."%'";
            $sql1 = $sql1." and `ProductType` like '".$Loaicha."%'";
        }
        
        if($Loaicon !="0"){
            $sql = $sql." and `ProductType` = '".$Loaicon."'";
            $sql1 = $sql1." and `ProductType` = '".$Loaicon."'";
        }
        
        if($Listspa !="0"){
            $sql = $sql." and `SpaID` = '".$Listspa."'";
            $sql1 = $sql1." and `SpaID` = '".$Listspa."'";
            
        }
        
        if($Timten !=''){
            $sql = $sql." and `name` like '%".$Timten."%'";
            $sql1 = $sql1." and `name` like '%".$Timten."%'";
        }
        
        $StartPos =1;
        $StartPos = ($page - 1)*10;
        $EndPos =  10;
        
        if($page != '' ){
            $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
        }
        
        $_arrSpa = $this->AddSTT($this->db->query($sql)->result(),$page); 
        //$_arrSpa = $this->db->query($sql)->result(); 
        /// duyet cho stt zo
               
        $ResTotalPage = $this->db->query($sql1)->result();
        $TotalRecord = ( $ResTotalPage[0]->Total);
        //$TotalRecord = 0;
        $TotalPage = 1;
        if($TotalRecord % 10 !=0)
        {
            $TotalPage = floor($TotalRecord /10) + 1;
        }
        else
        {
            $TotalPage = floor($TotalRecord /10) ;
        }
            
        $res = array("TotalRecord"=>$TotalRecord,"TotalPage"=>$TotalPage,"CurPage"=>$page,"lst"=>$_arrSpa, "Toto"=>$ResTotalPage);
        return $res;
    }
    public function AddSTT($arr,$page)
    {
        $arr1 = (array) $arr;
        for($i=0;$i<count($arr1);$i++)
        {
            $arr1[$i]->STT = (($page-1)*10+($i+1));
        }
        return $arr1;
    }
    //lay danh sach gia cua san pham
    public function ViewGia(){            
        $id = $_POST['id'];   
        $page  = $_POST["Page"];
        $NAME = $_POST['NAME'];

        $sql = "SELECT '1' AS STT, b.*, a.`Name`,a.`SpaID` FROM `products` a INNER JOIN `price` b ON a.`ProductID`=b.`ProductID` WHERE a.`ProductID`='$id'";  //lay ten nen phai ket voi bang products     
        $sql1 = "SELECT count(*) as Total FROM price where `ProductID` = '".$id."'";
        
        $StartPos =1;
        $StartPos = ($page - 1)*10;
        $EndPos =  10;
        
        if($page != '' ){
            $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
        }
        
        $_arrSpa = $this->AddSTT($this->db->query($sql)->result(),$page); 
        //$_arrSpa = $this->db->query($sql)->result(); 
        /// duyet cho stt zo
        $ResTotalPage = $this->db->query($sql1)->result();
        $TotalRecord = ( $ResTotalPage[0]->Total);
        //$TotalRecord = 0;
        $TotalPage = 1;
        if($TotalRecord % 10 !=0)
        {
            $TotalPage = floor($TotalRecord /10) + 1;
        }
        else
        {
            $TotalPage = floor($TotalRecord /10) ;
        }
            
        $res = array("TotalRecord"=>$TotalRecord,"TotalPage"=>$TotalPage,"CurPage"=>$page,"lst"=>$_arrSpa,"Toto"=>$ResTotalPage,"tensp"=>$NAME);
        return $res;
    }
    public function themgia()
    {
        $id  = $_POST["id"];
        $tensp  = $_POST["tensp"];
        $Giathem  = $_POST["Giathem"];
        $nguoitao=$_SESSION['AccUser']['User']->UserId;
        $slq_update = "UPDATE `price` SET `Status`='0' WHERE `ProductID`= '$id' AND `Status`='1'";
        $this->db->query($slq_update);
        $sql="INSERT INTO `price` (`Id`, `ProductID`, `Price`, `CreatedBy`, `CreatedDate`,`Status`) VALUES (NULL, '$id', '$Giathem', '$nguoitao',NOW(),'1')";
        $results=$this->db->query($sql);
        $res = array("lst"=>$results,"masp"=>$id,"tensp"=>$tensp);
        return $res;
    }
    public function xoagia()
    {
        $ma=$_POST['ma']; //ma gia
        $masanpham=$_POST['IDsanpham'];
        $ten=$_POST['ten'];
        $thongbao="";
        $sql_sel = "SELECT * FROM `price` WHERE `Id` = '$ma' AND `Status` = '1'";
        $getproID = $this->db->query($sql_sel)->result();      
        try{
            
            if(count($getproID)> 0){
                $proID =  $getproID[0]->ProductID;
                $sql_listpro = "SELECT  * FROM `price` WHERE `ProductID` = '$proID' AND `Status` = '0' ORDER BY `CreatedDate` DESC LIMIT 0,1";
                $list_prostatus = $this->db->query($sql_listpro)->result();
                if(count($list_prostatus) > 0){
                    $idprice = $list_prostatus[0]->Id;
                    $slq_update = "UPDATE `price` SET `Status`='1' WHERE `Id` = '$idprice'";
                    $this->db->query($slq_update); 
                }
                
            }
            
            $sql="DELETE FROM price WHERE Id = '".$ma."'";
            $results = $this->db->query($sql);
            
        }catch(exception $e)
        {
               
        }
        
        $thongbao="Xoa thanh cong!";
        $res = array("lst"=>$results,"masanpham"=>$masanpham,"ten"=>$ten,"thongbao"=>$thongbao,"magia"=>$ma);
        return $res;
    }
    
}
?>