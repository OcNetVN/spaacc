<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Goldhour extends CI_Controller {
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -  
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
     public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/goldhourmodel');
    }
    public function index()
    {
        $lang = $_SESSION['Lang'];
        if($this->CheckQuyen(6))
        {
            $this->load->view($lang.'/admin/products/ViewGoldHour');
        }
        else
        {
            $this->load->view($lang.'/admin/v_accessdenied');
        }
    }
    
    function  CheckQuyen($id)
    {
        // 1: allow New
        // 2: allow Edit
        // 3: allow Delete
        // 4: allow View
        // 5: allow Print
        // 6: Status
        
        $page = "admin/goldhour";
        
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
                        if($list[$i]->AllowPrint == 1)
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
           $req = $this->goldhourmodel->ajax_list();
         }
         echo json_encode($req);
       }
       
    public function them_moi_promotion(){
        $ckq = $this->CheckQuyen(1);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->goldhourmodel->Them_Moi_Promotion();
            $arr = array("PromotionId"=>$req); 
        }
        echo json_encode($arr);
    }
    
     public function them_moi_promotiondetail(){
         $ckq = $this->CheckQuyen(1);
         $req = -1;
         if($ckq == true)
         {
              $req = $this->goldhourmodel->Them_Moi_PromotionDetail();
              $arr = array("PromotionId"=>$req);
         }  
        echo json_encode($arr);
    }
    
    public function searchproductspa()
    {
         $ckq = $this->CheckQuyen(1);
         $req = -1;
         if($ckq == true)
         {
            $req = $this->goldhourmodel->search_spaproduct();
        echo json_encode($req);
         }
    }
    
     public function gethinhpromotion()
    {
        $req = $this->goldhourmodel->get_hinh_promotion();
        //$arr = array("Str"=>$req);
        echo json_encode($req);
    }
    
    public function showlistproductprom(){
        $req = $this->goldhourmodel->get_list_product();
        //$arr = array("Str"=>$req);
        echo json_encode($req);
    }
    
       public function UploadFile($MaDoiTuong){
        //$TM_Con ="";
        $TM_Con = $MaDoiTuong;
                
        $mimes = array(
            'image/jpeg', 'image/png', 'image/gif'
        );
        if (!file_exists('resources/img/promotion/'.$TM_Con)) {
        mkdir('resources/img/promotion/'.$TM_Con, 0777, true);
        }
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
                move_uploaded_file($_FILES['myfile']['tmp_name'], 'resources/img/promotion/'.$TM_Con.'/'.$fileName);                
                // insert vao bang links
                $strURL = 'resources/img/promotion/'.$TM_Con.'/'.$fileName;
                $this->goldhourmodel->InsertLinks($MaDoiTuong, $strURL);
                                
                $url= 'resources/img/promotions/'.$TM_Con.'/'.$fileName;
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
    
    public function xoapromotions()
    {
        $ckq = $this->CheckQuyen(3);
         $req = -1;
         if($ckq == true)
         {
            $req = $this->goldhourmodel->xoa_promotion();
         }
        $arr = array("Result"=>$req);
        echo json_encode($arr);
    }
    
    public function edit($PromoID,$ProductID){
        $lang = $_SESSION['Lang'];
        if($this->CheckQuyen(2)){
            // Load khuyến mãi
           $promo         = $this->goldhourmodel->get_list_promotion($PromoID);
           $ListImage     = $this->goldhourmodel->get_list_links($PromoID);
           $ListProduct   = $this->goldhourmodel->get_list_product_spa($PromoID,$ProductID);
           $arrPro        = $this->goldhourmodel->get_list_product1($PromoID);
           $this->load->view($lang.'/admin/products/ViewEditGoldhour', array('promo' => $promo, 'listimage' => $ListImage, 'listproduct' => $ListProduct,'listpro' =>$arrPro )); 
           }
       else{
          $this->load->view($lang.'/admin/v_accessdenied');
      }
    }
      
    // phần cật nhật khuyến mãi  
    public function capnhat_promotion(){
         $ckq = $this->CheckQuyen(2);
         $req = -1;
         if($ckq == true)
         {
            $req = $this->goldhourmodel->Capnhat_Promotion();
         }
        $arr = array("PromotionId"=>$req);
        echo json_encode($arr);
    }
    
    public function capnhat_promotiondetail(){
         $ckq = $this->CheckQuyen(2);
         $req = -1;
         if($ckq == true)
         {
            $req = $this->goldhourmodel->Capnhat_PromotionDetail();
         }
        $arr = array("PromotionId"=>$req);
        echo json_encode($arr);
    }
    
    // edit transaction 
     public function capnhat_promotiondetail1(){
         $ckq = $this->CheckQuyen(2);
         $req = -1;
         if($ckq == true)
         {
            $req = $this->goldhourmodel->Capnhat_PromotionDetail1();
         }
        $arr = array("PromotionId"=>$req);
        echo json_encode($arr);
    }
    
    public function capnhat_promotiontotal(){
        $ckq = $this->CheckQuyen(2);
         $req = -1;
         if($ckq == true)
         {
            $req = $this->goldhourmodel->Capnhat_PromotionTotal();
         }
        $arr = array("PromotionId"=>$req);
        echo json_encode($arr);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */