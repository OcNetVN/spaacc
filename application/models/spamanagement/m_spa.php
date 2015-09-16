<?php
class M_spa extends CI_Model{
    public $errorStr; 
    public function __construct()
    {
        parent::__construct();
    }
      
   
    public function lay_info_Spa($UserId)
    {
        $sql="SELECT spa.* FROM spa , spauser WHERE spauser.SpaID = spa.spaID and spauser.UserId='$UserId'";
        $results=$this->db->query($sql)->result();
        return $results;
    }
    
    

}  
?>
