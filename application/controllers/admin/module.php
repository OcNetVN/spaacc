<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/modulemodel');
    }
    public function index()
    {
      $lang = $_SESSION['Lang'];
       $this->load->view($lang.'/admin/roles/Viewmodule');
    }
    
     function  CheckQuyen($id)
    {
        // 1: allow New
        // 2: allow Edit
        // 3: allow Delete
        // 4: allow View
        // 5: allow Print
        // 6: Status
        
        $page = "admin/module";
        
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
    public function  ajax_get_list(){
         $ckq = $this->CheckQuyen(4);
         $req = -1;
         if($ckq == true)
         {
           $req = $this->modulemodel->ajax_list();
         }
         echo json_encode($req);
         
       }
    
    public function ajax_capnhat_module(){
         $ckq = $this->CheckQuyen(2);
         $req = -1;
         if($ckq == true)
         {
           $req = $this->modulemodel->ajax_capnhat_module();
         }
         echo json_encode($req);
    }
}

