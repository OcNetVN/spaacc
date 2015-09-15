<?php
  class M_xml extends CI_Model{
    public $errorStr; 
    public function __construct()
    {
        parent::__construct();
    }

    public function getSetting()
    {
        $xml ="";
        try{
            $xml = simplexml_load_file("resources/setting/Setting.xml");       
            //foreach($xml as $key=>$row ){
//                echo $key;
//            }
//            die();           
        }catch(exception $e)
        {
            $xml = "";
        }
        return $xml;
    }
    
    public function updatesetting()
    {
        $thongso = $_POST['thongso'];
        $value   = $_POST['value'];
        $res = 0;
        if(file_exists("resources/setting/Setting.xml"))
        {
           $xml = simplexml_load_file("resources/setting/Setting.xml"); 
           // update
           $xml->$thongso = $value;
           $xml->asXML('resources/setting/Setting.xml');
           $res = 1; 
        }
        
        return $res;
        
    }
        
}