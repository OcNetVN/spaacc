<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Commoncode extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/m_commoncode');
    }
	function  CheckQuyen($id)
    {
        // 1: allow New 
        // 2: allow Edit
        // 3: allow Delete
        // 4: allow View
        // 5: allow Print
        // 6: Status
        
        $page = "admin/commoncode";
        
        $arr = (array) $_SESSION['AccUser'];
        $list =  (array)$arr['ListMenu'];
        $val= false;
        for($i=0;$i<count($list);$i++)
        {
            if($list[$i]->url == $page)
            {
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
                        // allow print
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
		if($this->CheckQuyen(6))
        {
            $this->load->view($lang.'/admin/commoncode/v_commoncode.php');
        }
        else
        {
			$this->load->view($lang.'/admin/v_accessdenied');
        }
	}
    public function laycommontypetim()
    {
		$ckq = $this->CheckQuyen(4);
        $req = -1;
        if($ckq == true)
        {
			$req = $this->m_commoncode->laycommontypetim();
		}
        echo json_encode($req);
    }
    //nhan nut tim
    public function searchcommoncode()
    {
        $ckq = $this->CheckQuyen(4);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_commoncode->searchcommoncode();
        }
        echo json_encode($req);
    }
    //nhan nut show ra form them
     public function laycommontypethem()
    {
        $ckq = $this->CheckQuyen(1);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_commoncode->laycommontypetim();
        }
        echo json_encode($req);
    }
     public function loadradiocapthem()
    {
        $req = $this->m_commoncode->loadradiocapthem();
        echo json_encode($req);
    }
     public function hiencapthem()
    {
        $ckq = $this->CheckQuyen(1);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_commoncode->hiencapthem();
        }
        echo json_encode($req);
    }
     public function showidgerenatetype()
    {
        $ckq = $this->CheckQuyen(1);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_commoncode->showidgerenatetype();
        }
        echo json_encode($req);
    }
     public function laycommon_2cap()
    {
        $ckq = $this->CheckQuyen(1);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_commoncode->laycommon_2cap();
        }
        echo json_encode($req);
    }
     public function laycm2theo1_2cap()
    {
        $ckq = $this->CheckQuyen(1);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_commoncode->laycm2theo1_2cap();
        }
        echo json_encode($req);
    }
     public function taocommonid_2cap()
    {
        $ckq = $this->CheckQuyen(1);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_commoncode->taocommonid_2cap();
        }
        echo json_encode($req);
    }
    //autocomplete
    public function loadcmcode()
    {
        $ckq = $this->CheckQuyen(1);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_commoncode->loadcmcode();
        }
        echo json_encode($req);
    }
    public function btn_chonloaicha()
    {
        $ckq = $this->CheckQuyen(1);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_commoncode->btn_chonloaicha();
        }
        echo json_encode($req);
    }
    public function btnthem_commoncode()
    {
        $ckq = $this->CheckQuyen(1);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_commoncode->btnthem_commoncode();
        }
        echo json_encode($req);
    }
    public function xoacommoncode()
    {
         $ckq = $this->CheckQuyen(3);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_commoncode->xoacommoncode();
        }
        echo json_encode($req);
    }
    public function suacommoncode()
    {
         $ckq = $this->CheckQuyen(2);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_commoncode->suacommoncode();
        }
        echo json_encode($req);
    }
    public function btnsua_commoncode()
    {
         $ckq = $this->CheckQuyen(2);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_commoncode->btnsua_commoncode();
        }
        echo json_encode($req);
    }
}
?>