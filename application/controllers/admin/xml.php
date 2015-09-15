<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Xml extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/m_xml');
        
    }
    
    function  CheckQuyen($id)
    {
        // 1: allow New
        // 2: allow Edit
        // 3: allow Delete
        // 4: allow View
        // 5: allow Print
        // 6: Status
        
        $page = "admin/xml";
        
        $arr = (array) $_SESSION['AccUser'];
        $list =  (array)$arr['ListMenu'];
        $val= false;
        $str="";
        for($i=0;$i<count($list);$i++)
        {
            if($list[$i]->url == $page)
            {
                $str =$list[$i];
                switch($id)
                {
                    case 1:
                    {
                        // allow new
                        if($list[$i]->AllowNew == 1)
                        {
                            $val=true;
                        }
                        break;
                    }
                    case 2:
                    {
                        // allow edit
                        if($list[$i]->AllowEdit == 1)
                        {
                            $val=true;
                        }
                        break;
                    }
                    case 3:
                    {
                        // allow Delete
                        if($list[$i]->AllowDelete == 1)
                        {
                            $val=true;
                        }
                        break;
                    }
                    case 4:
                    {
                        // allow View
                        if($list[$i]->AllowView == 1)
                        {
                            $val=true;
                        }
                        break;
                    }
                    case 5:
                    {
                        // allow edit
                        if($list[$i]->AllowPrint == 1)
                        {
                            $val=true;
                        }
                        break;
                    }
                    case 6:
                    {
                        // Status
                        if($list[$i]->Status == 1)
                        {
                            $val=true;
                        }
                        break;
                    }
                }
                break;
            }
        }
        return $val;
    }
    
    
    
    public function index()
    {
       $lang = $_SESSION['Lang'];
       if($this->CheckQuyen(6)){
          $getSetting = $this->m_xml->getSetting();
          $this->load->view($lang.'/admin/xml/v_xml',array('setting' =>$getSetting));   
       }
       else{
           $this->load->view($lang.'/admin/v_accessdenied');
       }
           
    }
    
    
      
    public function updatesetting()
    {
      // Load Product
      $lang = $_SESSION['Lang'];
      if($this->CheckQuyen(2)){
           $res = $this->m_xml->updatesetting();
           echo json_encode($res);
           
      }
      else{
          $this->load->view($lang.'/admin/v_accessdenied');
      }
    }  

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */