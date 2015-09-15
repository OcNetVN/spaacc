<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class News extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/m_new');
        $this->load->model('admin/m_products');
    }
    
           function  CheckQuyen($id)
         {
        // 1: allow New
        // 2: allow Edit
        // 3: allow Delete
        // 4: allow View
        // 5: allow Print
        // 6: Status
        
        $page = "admin/new";
        
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
       if($this->CheckQuyen(6)){
          $TypeNew = $this->m_new->getTypeNew();
          $this->load->view('admin/new/v_new',array('newtype' =>$TypeNew));   
       }
       else{
           $this->load->view('admin/v_accessdenied');
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
           $product = $this->m_products->get_product($proID);
           $ListImage = $this->m_products->get_product_links($proID);
           $ListPrice = $this->m_products->get_product_prices($proID);
           $ListTime = $this->m_products->get_product_times($proID);
           $productType = $this->m_products->get_product_types_new1($product[0]->ProductType);
           $this->load->view($lang.'/admin/products/v_products', array('product' => $product, 'listimage' => $ListImage, 'listprice' => $ListPrice,"listtime"=>$ListTime,"productypelist"=>$productType)); 
      }
      else{
          $this->load->view($lang.'/admin/v_accessdenied');
      }
    } 
    
    public function xoaproducts()
    {
        $ckq = $this->CheckQuyen(3);
        $req = -1;
        if($ckq == true)
         {
            $req = $this->m_products->xoa_products();
         }
        $arr = array("Result"=>$req);
        echo json_encode($arr);
    }
    
   
    
   
    
    public function xoahinh()
    {
        $req = $this->m_products->xoa_hinh();
        $arr = array("Result"=>$req);
        echo json_encode($arr);
    }
    
    public function gethinhproducts()
    {
        $req = $this->m_products->get_hinh_products();
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
        if (!file_exists('resources/img/products/'.$TM_Con)) {
        mkdir('resources/img/products/'.$TM_Con, 0777, true);
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
                move_uploaded_file($_FILES['myfile']['tmp_name'], 'resources/img/products/'.$TM_Con.'/'.$fileName);                
                // insert vao bang links
                $strURL = 'resources/img/products/'.$TM_Con.'/'.$fileName;
                $this->m_products->InsertLinks($MaDoiTuong, $strURL);
                                
                $url= 'resources/img/products/'.$TM_Con.'/'.$fileName;
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