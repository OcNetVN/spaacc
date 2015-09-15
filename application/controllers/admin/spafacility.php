<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Spafacility extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/m_spafacility');
        //$this->load->model('m_object');
    }
    function  CheckQuyen($id)
    {
        // 1: allow New
        // 2: allow Edit
        // 3: allow Delete
        // 4: allow View
        // 5: allow Print
        // 6: Status
        
        $page = "admin/spafacility";
        
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
            $req['loaicha'] = $this->m_spafacility->lay_loai_san_pham_cha();
	       $this->load->view($lang.'/admin/spafacility/v_spafacility',$req);
        }
        else
        {
           $this->load->view($lang.'/admin/v_accessdenied');
        }
      
	}   
    public function search_producttype()
    {
        $ckq = $this->CheckQuyen(4);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_spafacility->search_producttype();
        }
        echo json_encode($req);
    }
    
    public function themloaisp()
    {
        $ckq = $this->CheckQuyen(1);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_spafacility->themloaisp();
        }
        echo json_encode($req);
    }
    public function suasanpham()
    {
        $ckq = $this->CheckQuyen(2);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_spafacility->suasanpham();
        }
        echo json_encode($req);
    }
    public function layloaisptheoid()
    {
        $req = $this->m_spafacility->lay_loai_sp_theo_id();
        echo json_encode($req);
    }
    public function xoaloai()
    {
        $ckq = $this->CheckQuyen(3);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_spafacility->xoaloai();
        }
        echo json_encode($req);
    }
    
}



