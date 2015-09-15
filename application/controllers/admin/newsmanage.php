<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Newsmanage extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/m_new');
        
    }
    
        function  CheckQuyen($id)
         {
        // 1: allow New
        // 2: allow Edit
        // 3: allow Delete
        // 4: allow View
        // 5: allow Print
        // 6: Status
        
        $page = "admin/newsmanage";
        
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
          $TypeNew = $this->m_new->getTypeNew();
          $this->load->view($lang.'/admin/new/v_new',array('newtype' =>$TypeNew));   
       }
       else{
           $this->load->view($lang.'/admin/v_accessdenied');
       }
           
    }
    
    public function search_new(){
        $ckq = $this->CheckQuyen(4);
        $res = -1;
        if($ckq ==  true){
            $res =  $this->m_new->search_new();
        }
        
        echo json_encode($res);
        
    }
      
    public function edit($id)
    {
      // Load Product
      $lang = $_SESSION['Lang'];
      if($this->CheckQuyen(2)){
           $news = $this->m_new->get_news($id);
           $ListImage = $this->m_new->get_news_links($id);
           $TypeNew = $this->m_new->getTypeNew();
           $this->load->view($lang.'/admin/new/v_newsedit', array('news' => $news, 'listimage' => $ListImage, 'typeNew' => $TypeNew)); 
      }
      else{
          $this->load->view($lang.'/admin/v_accessdenied');
      }
    }
    
    public function cap_nhat_news()
    {
        $ckq = $this->CheckQuyen(2);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_new->Cap_Nhat_News();
        }
        $arr = array("ProductID"=>$req);
        echo json_encode($arr);
    } 
    
    public function xoanews()
    {
        $ckq = $this->CheckQuyen(3);
        $req = -1;
        if($ckq == true)
         {
            $req = $this->m_new->xoa_news();
         }
        $arr = array("Result"=>$req);
        echo json_encode($arr);
    }
    
   
    
   
    
    public function xoahinh()
    {
        $req = $this->m_new->xoa_hinh();
        $arr = array("Result"=>$req);
        echo json_encode($arr);
    }
    
    public function gethinh()
    {
        $req = $this->m_new->get_hinh_news();
        //$arr = array("Str"=>$req);
        echo json_encode($req);
    }
    
  
    
    
    
    public function them_moi_new()
    {
        $ckq = $this->CheckQuyen(1);
        $res = -1;
        if($ckq == true)
        {
            $res = $this->m_new->Them_Moi_News();
        }
        
        echo json_encode($res);
    }
    
   
    
    
    
    public function UploadFile($MaDoiTuong){
        //$TM_Con ="";
        $TM_Con = $MaDoiTuong;
                
        $mimes = array(
            'image/jpeg', 'image/png', 'image/gif'
        );
        if (!file_exists('resources/img/news/'.$TM_Con)) {
        mkdir('resources/img/news/'.$TM_Con, 0777, true);
        }
       // $url ='/resources/img/spa/'.$TM_Con.'/'.$fileName;
        sleep(1);
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
            } elseif (!in_array($fileType, $mimes)) { //Kiểm tra định dạng file
                $fileStatus['message'] = 'Không cho phép định dạng này';
            } else { //Không có lỗi nào
                move_uploaded_file($_FILES['myfile']['tmp_name'], 'resources/img/news/'.$TM_Con.'/'.$fileName);                
                // insert vao bang links
                $strURL = 'resources/img/news/'.$TM_Con.'/'.$fileName;
                $this->m_new->InsertLinks($MaDoiTuong, $strURL);
                                
                $url= 'resources/img/news/'.$TM_Con.'/'.$fileName;
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

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */