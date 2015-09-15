<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Quangcao extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/m_information');
        $this->load->model('admin/m_quangcao');
        
    }
    
    function  CheckQuyen($id)
    {
        // 1: allow New
        // 2: allow Edit  
        // 3: allow Delete
        // 4: allow View
        // 5: allow Print
        // 6: Status
        
        $page = "admin/quangcao";
        
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
          $TypeInfo = $this->m_information->getTypeInfoA();
          $TypeLange = $this->m_information->getTypeLange();
          $this->load->view($lang.'/admin/advertising/v_advertising',array('infotype' =>$TypeInfo,'langtype'=>$TypeLange));   
       }
       else{
           $this->load->view($lang.'/admin/v_accessdenied');
       }
           
    }
    
    public function uploadfile(){
        $ckq = $this->CheckQuyen(2);
        $req = -1;
        if($ckq == true)
        {
            $req1 = $this->m_quangcao->uploadfile();
            $req = $req1['res'];
        }
        $arr = array("Result"=>$req,"Array"=>$req1);
        echo json_encode($arr);
                
         
           
        }
        
         public function UploadFile1(){
            $info = $_POST['info'];
            $lange = $_POST['langue'];
            //if($lange != ""){
//                if($lange == '01'){
//                    $TM_Con = 'vi-VN';
//                }
//                else{
//                    $TM_Con = 'en-US';
//                }
//            }
            if (isset($_FILES['myfile'])) {
                $fileName = $_FILES['myfile']['name'];
                $fileType = $_FILES['myfile']['type'];
                $fileError = $_FILES['myfile']['error'];
                $fileStatus = array(
                    'status' => 0,
                    'message' => ''    
                );
            if ($fileError== 1) { //Lỗi vượt dung lượng
                $fileStatus['message'] = 'Dung lượng quá giới hạn cho phép';
            } else { //Không có lỗi nào
                //move_uploaded_file($_FILES['myfile']['tmp_name'], 'resources/front/images/Ads/'.$TM_Con.'/'.$fileName);
                move_uploaded_file($_FILES['myfile']['tmp_name'], 'resources/front/images/Ads/'.$fileName);                
                // insert vao bang links
                //$strURL = 'resources/front/images/Ads/'.$TM_Con.'/'.$fileName;
                $strURL = 'resources/front/images/Ads/'.$fileName;
                $this->m_quangcao->UploadHtml($info,$fileName);
                                
                //$url= 'resources/front/images/Ads/'.$TM_Con.'/'.$fileName;
                $url= 'resources/front/images/Ads/'.$fileName;
                $fileStatus['status'] = 1;
                $fileStatus['message'] = "Bạn đã upload $fileName thành công";
                $fileStatus['url'] = $url;
               // $lst_cm = array();
//                array_push($lst_cm,$cm);
            }    
            echo json_encode($fileStatus);
            exit();        
        }
    }
   
       
    
}
