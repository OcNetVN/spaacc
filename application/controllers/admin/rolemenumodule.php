<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rolemenumodule extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/rolemenumodulemodel');
    }
    public function index()
    {
       $list_menu = $this->rolemenumodulemodel->get_Menu_new();
       $list_module = $this->rolemenumodulemodel->get_Module_new(); 
       $list_role = $this->rolemenumodulemodel->get_Roles();
       $lang = $_SESSION['Lang']; 
       $this->load->view($lang.'/admin/roles/Viewrolemenumodule',array('menu' =>$list_menu,'module' => $list_module,'role'=>$list_role ));
    }
    
     function  CheckQuyen($id)
    {
        // 1: allow New
        // 2: allow Edit
        // 3: allow Delete
        // 4: allow View
        // 5: allow Print
        // 6: Status
        
        $page = "admin/rolemenumodule";
        
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
           $req = $this->rolemenumodulemodel->ajax_list();
         }
         echo json_encode($req);
         
       }
    
    public function capnhat_rolemenumodule(){
         $ckq = $this->CheckQuyen(2);
         $req = -1;
         if($ckq == true)
         {
           $req = $this->rolemenumodulemodel->capnhat_rolemenumodule();
         }
         echo json_encode($req);
    }
    
    public function them_moi_rolemenumodule(){
        $ckq = $this->CheckQuyen(1);
         $req = -1;
         if($ckq == true)
         {
           $req = $this->rolemenumodulemodel->them_moi_role_menumodule();
         }
         echo json_encode($req);
    }
    
    public function delete_rolemenumodule(){
         $ckq = $this->CheckQuyen(3);
         $req = -1;
         if($ckq == true)
         {
           $req = $this->rolemenumodulemodel->delete_menu_module();
         }
         echo json_encode($req);
    }
}

