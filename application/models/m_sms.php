<?php
  class M_sms extends CI_Model{
    public $errorStr; 
    public function __construct()
    {
        parent::__construct();
		$this->db2 = $this->load->database('thebooking', TRUE);
    }
    
    public function SendSMSBookingSuccess($bookingId)
    {
		$temid= (int)substr($bookingId,-6);
        $bk="99#".$temid;	   
       $lang = "vi-VN";
       if(isset($_SESSION['Lang']))
       {
          $lang = $_SESSION['Lang'];
       }
       else
       {
           $_SESSION['Lang']=$this->m_mail->getSetting("LangaugeDefault");
       }
        
        $sql="SELECT * FROM `booking` WHERE `bookingID`= '$bookingId'";
        $cap1 = $this->db->query($sql)->result();
        $arr1 = (array) $cap1;
        
        if(count($arr1)>0)
        {
            if(isset($arr1[0]->ObjectID) && $arr1[0]->ObjectID!= "" )
            {
                $objid = $arr1[0]->ObjectID;
                $sql1="SELECT * FROM `objects` WHERE `ObjectId`='$objid'";
                $cap2 = $this->db2->query($sql1)->result();
                $arr2 = (array) $cap2; 
                if(count($arr2)>0 && $this->CheckTel($arr2[0]->Tel))
                {
                    $tel = $arr2[0]->Tel;
                    $content ="";
                    if($lang=="vi-VN")
                    {
                        $content = $this->getSetting("SMSMsgClientVi");
                    }
                    else
                    {
                        $content = $this->getSetting("SMSMsgClientEn");
                    }
                    $content = str_replace("[bookingid]",$bk, $content);
                    $this->SendSMS($content,$tel);
                }  
            }
            else
            {
                $objid = $arr1[0]->CreatedBy;
                $sql1="SELECT * FROM `objects` WHERE `ObjectId`='$objid'";
                $cap2 = $this->db2->query($sql1)->result();
                $arr2 = (array) $cap2; 
                if(count($arr2)>0 && $this->CheckTel($arr2[0]->Tel))
                {
                    $tel = $arr2[0]->Tel;
                    $content ="";
                    if($lang=="vi-VN")
                    {
                        $content = $this->getSetting("SMSMsgClientVi");
                    }
                    else
                    {
                        $content = $this->getSetting("SMSMsgClientEn");
                    }
                    $content = str_replace("[bookingid]",$bk, $content);
                    $this->SendSMS($content,$tel);
                }
            }    
        }           
    }
    public function SendSMSBookingSuccessSpa($bookingId,$spaname,$spaPhone)
    {
		$temid= (int)substr($bookingId,-6);
        $bk="99#".$temid;	   
       $lang = "vi-VN";
       if(isset($_SESSION['Lang']))
       {
          $lang = $_SESSION['Lang'];
       }
       else
       {
           $_SESSION['Lang']=$this->m_mail->getSetting("LangaugeDefault");
       }
        
        $sql="SELECT * FROM `booking` WHERE `bookingID`= '$bookingId'";
        $cap1 = $this->db->query($sql)->result();
        $arr1 = (array) $cap1;
        
        if(count($arr1)>0)
        {
			if($this->CheckTel($spaPhone))
			{
				//echo $bookingId." ".$spaname." ".$spaPhone;die;
				$tel=$spaPhone;
				$content ="";
				if($lang=="vi-VN")
				{
					$content = $this->getSetting("SMSMsgSpaVi");
				}
				else
				{
					$content = $this->getSetting("SMSMsgSpaEn");
				}
				$content = str_replace("[bookingid]",$bk, $content);
				$content = str_replace("[SpaID]",$spaname, $content);
				$this->SendSMS($content,$tel);
			} 
        }           
    }
	
    public function CheckTel($phone)       
    {
    return ( ! preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i", $phone) && ! preg_match("/^([1]-)?[0-9]{3}.[0-9]{3}.[0-9]{4}$/i", $phone) &&  ! preg_match("/^([1]-)?\([0-9]{3}\) [0-9]{3}-[0-9]{4}$/i", $phone) && ! preg_match("/^[0-9]{10}$/i", $phone)&& ! preg_match("/^[0-9]{11}$/i", $phone)&& ! preg_match("/^[0-9]{12}$/i", $phone)&& ! preg_match("/^[0-9]{13}$/i", $phone)) ? FALSE : TRUE ;
    }  
    
    
    public function SendSMS($content, $sim)
    {
        $soapClient = new SoapClient("http://203.162.53.70:8080/WS/SMSService.asmx?wsdl");
   
       
        $ap_param = array(
                    'Content'     =>    $content,
                    'SIM'     =>    $sim
                    );
        $res = array("Return"=>"1","Msg"=>"") ;          
        // Call RemoteFunction ()
        $error = 0;
        try {
            $info = $soapClient->__call("SendSMS", array($ap_param));
        } catch (SoapFault $fault) {
            $error = 1;
            $res = array("Return"=>"0","Msg"=>$fault,"info"=>$info) ;    
        }
       
        if ($error == 0) {       
            $auth_num = $info->SendSMSResult;
              
            $res = array("Return"=>"1","Msg"=>$auth_num,"info"=>$info) ; 
            
        }
        return $res;    
    }
    
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
    
    public function SetPriceStatus()
    {   
        $res = 0;
        $sql0= "UPDATE `price` SET `Status`='1'";
        $this->db->query($sql0);
        
        $sql="SELECT DISTINCT `ProductID` FROM `price` GROUP BY `ProductID` HAVING COUNT(`ProductID`) >1;";
        $cap1 = $this->db->query($sql)->result();
        $arr1 = (array) $cap1; 
        if(count($arr1)>0)
        {
            $i = 0;
            for($i=0; $i<count($arr1);$i++)
            {
               $proid = $arr1[$i]->ProductID;
               $sql1="SELECT * FROM `price` WHERE `ProductID`='$proid'  ORDER BY `CreatedDate` DESC";
               $cap2 = $this->db->query($sql1)->result();
               $arr2 = (array) $cap2; 
               if(count($arr2)>0)
               {
                    for($j=0; $j<count($arr2);$j++)
                    {
                        if($j>0)
                        {
                            $id=  $arr2[$j]->Id;
                            $sql2="UPDATE `price` SET `Status`='0' WHERE `Id`='$id'";
                            $this->db->query($sql2);    
                        }
                    }    
               }
            }
            $res = $i;
        }
        return $res;      
    }   
        
}    
?>

