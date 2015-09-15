<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Producttype extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/m_producttype');
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
        
        $page = "admin/producttype";
        
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
            $req['loaicha'] = $this->m_producttype->lay_loai_san_pham_cha();
	       $this->load->view($lang.'/admin/producttype/v_producttype',$req);
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
            $req = $this->m_producttype->search_producttype();
        }
        echo json_encode($req);
    }
    public function search_producttype_con()
    {
        $ckq = $this->CheckQuyen(4);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_producttype->search_producttype_con();
        }
        echo json_encode($req);
    }
    public function taocap()
    {
        $TaoCap=$_POST['TaoCap'];
        if($TaoCap==1)
        {
            $str="display:nomal";
        }
        else
            $str="display:none";
        $res = array('kq'=>$str);
        echo json_encode($res);
    }
    public function phatsinhmaloai()
    {
        $cap  = $_POST['Capsanpham'];
        if($cap==1) // cap 1
        {
            $ma="";
            $req = $this->m_producttype->phatsinhmaloai();
            if(count($req)>0)
            {
                $req_ma=(int)$req[0]['CommonId'];
                if($req_ma!=1)
                    $ma="01";
                else
                {
                    $j=2;
                    for($i=1;$i<count($req);$i++)
                    {
                        if(((int)$req[$j]-(int)$req[$i])!=1)
                        {
                            $ma=(int)$req[$j]+1;
                            if(strlen($ma)==1)
                                $ma="0".$ma;
                            break;
                        }
                        $j++;
                    }
                    if($ma==""||$ma=0)
                    {
                        $ptcuoi=count($req)-1;
                        $ma=(int)$req[$ptcuoi]['CommonId']+1;
                    }
                }
            }
            else
                $ma="01";
        }
        else //cap 2
        {
            $ma="";
            $req = $this->m_producttype->phatsinhmaloai_2();
            if(count($req)>0)
            {
                $req_ma=(int)$req[0]['CommonId'];
                if($req_ma!=1)
                    $ma="0001";
                else
                {
                    $j=2;
                    for($i=1;$i<count($req);$i++)
                    {
                        if(((int)$req[$j]-(int)$req[$i])!=1)
                        {
                            $ma=(int)$req[$j]+1;
                            if(strlen($ma)==1)
                                $ma="0".$ma;
                            break;
                        }
                        $j++;
                    }
                    if($ma==""||$ma=0)
                    {
                        $ptcuoi=count($req)-1;
                        $ma=(int)$req[$ptcuoi]['CommonId']+1;
                    }
                }
            }
            else
                $ma="01";
        }
        
            echo $ma;die;
        $res=array('ma'=>$ma);
        echo json_encode($res);
    }
    public function themloaisp()
    {
        $ckq = $this->CheckQuyen(1);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_producttype->themloaisp();
        }
        echo json_encode($req);
    }
    public function suasanpham()
    {
        $ckq = $this->CheckQuyen(2);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_producttype->suasanpham();
        }
        echo json_encode($req);
    }
    public function layloaisptheoid()
    {
        $req = $this->m_producttype->lay_loai_sp_theo_id();
        echo json_encode($req);
    }
    public function xoaloai()
    {
        $ckq = $this->CheckQuyen(3);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_producttype->xoaloai();
        }
        echo json_encode($req);
    }
    
}



