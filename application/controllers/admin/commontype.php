<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Commontype extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/m_commontype');
    }
	function  CheckQuyen($id)
    {
        // 1: allow New 
        // 2: allow Edit
        // 3: allow Delete
        // 4: allow View
        // 5: allow Print
        // 6: Status
        
        $page = "admin/commontype";
        
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
            $this->load->view($lang.'/admin/commontype/v_commontype.php');
        }
        else
        {
			$this->load->view($lang.'/admin/v_accessdenied');
        }
	}
    public function loadcmtypeid()
    {
		$ckq = $this->CheckQuyen(4);
        $req = -1;
        if($ckq == true)
        {
			$req = $this->m_commontype->loadcmtypeid();
		}
        echo json_encode($req);
    }
    public function search_commontype()
    {
        $ckq = $this->CheckQuyen(4);
        $req = -1;
        if($ckq == true)
        {
			$req = $this->m_commontype->search_commontype();
		}
        echo json_encode($req);
    }
    public function btnthem_cmtype()
    {
         $ckq = $this->CheckQuyen(1);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_commontype->btnthem_cmtype();
        }
        //print_r($req);
        echo json_encode($req);
        //$a=json_encode($req);
    }
    public function editcommontype()
    {
         $ckq = $this->CheckQuyen(2);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_commontype->editcommontype();
        }
        echo json_encode($req);
    }
    public function btnedit()
    {
         $ckq = $this->CheckQuyen(2);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_commontype->btnedit();
        }
        echo json_encode($req);
    }
    public function xoacommontype()
    {
         $ckq = $this->CheckQuyen(3);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_commontype->xoacommontype();
        }
        echo json_encode($req);
    }
 }