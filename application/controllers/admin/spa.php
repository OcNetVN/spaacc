<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Spa extends CI_Controller
{
              
       function __construct()
       {
            parent::__construct();
            $this->load->helper('url');
            $this->load->Model('admin/spamodel');
            $this->load->model('admin/m_products');
            $this->load->Model('admin/commoncodemodel');
            //$this->load->Model('admin/spaproductype');
        }
        
         function  CheckQuyen($id)
         {
        // 1: allow New
        // 2: allow Edit
        // 3: allow Delete
        // 4: allow View
        // 5: allow Print
        // 6: Status
        
        $page = "admin/spa";
        
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
        
        public function index(){
            $lang = $_SESSION['Lang'];
            if($this->CheckQuyen(6))
            {
                $arr_productype = $this->m_products->get_product_types_new();
                $this->load->view($lang.'/admin/spa/ViewSpa', array('list_productype' => $arr_productype));
            }
            else{
                
                $this->load->view($lang.'/admin/v_accessdenied');
            }
                
        }
       
       public function  ajax_get_list(){
         $ckq = $this->CheckQuyen(4);
         $req = -1;
         if($ckq == true)
         {
           $req = $this->spamodel->ajax_list();
         }
           echo json_encode($req);
       }
         
         public function themspa()      
         {
             $ckq = $this->CheckQuyen(1);
             $res = -1;
             if($ckq == true){
                $res = $this->spamodel->Them_Spa(); 
             }
             
             $arr = array("SpaID"=>$res);
             echo json_encode($arr);
         }
         public function themspaproduct(){
             $ckq = $this->CheckQuyen(1);
             $res = -1;
             if($ckq == true){
               $res = $this->spamodel->Them_Spaproduct();  
             }
             $arr = array("SpaID"=>$res);
             echo json_encode($arr);
         }
         public function themmoiImage(){
             $ckq = $this->CheckQuyen(1);
             $res = -1;
             if($ckq == true){
                $res = $this->spamodel->Them_SpaImage();
             }
             $arr = array("SpaID"=>$res);
             echo json_encode($arr);
         }
         
         public function xoa_mot_spa(){
             $ckq = $this->CheckQuyen(3);
             $res = -1;
             if($ckq == true){
                $res = $this->spamodel->deleSpa();
             }

             $arr = array("Result"=> $res);
             
             echo json_encode($arr);
         }
         //capnhat_time_spa
         public function capnhat_time_spa()
        {
            $ckq = $this->CheckQuyen(2);
            $req = -1;
            if($ckq == true){
                $req = $this->spamodel->Capnhat_Time_Spa();
             }
            $arr = array("Result"=>$req);
            echo json_encode($arr);
        }            
        
        public function get_spa_times()
        {
            $SpaId = $_POST['SpaID'];
            $ListTime    = $this->spamodel->get_spa_times($SpaId);
            echo json_encode($ListTime);
        }
        
        public function updatespa()
        {
            $ckq = $this->CheckQuyen(2);
            $req = -1;
            if($ckq == true){
                $req = $this->spamodel->Update_Spa();
            }
            $arr = array("Result"=>$req);
            echo json_encode($arr);
        }
        
        public function updateproduct(){
            $ckq = $this->CheckQuyen(2);
            $req = -1;
            if($ckq == true){
                $req = $this->spamodel->Upadte_Product();
            }
            $arr = array("Result"=>$req);
            echo json_encode($arr);
        }
        public function edit($SpaId){
        // Load Spa
        $lang = $_SESSION['Lang'];
        if($this->CheckQuyen(6))
            {
               $spa             = $this->spamodel->get_spa_news($SpaId);
               $ListImage       = $this->spamodel->get_spa_links($SpaId);
               $ListProduct     = $this->spamodel->get_spa_product($SpaId);
               $ListTime        = $this->spamodel->get_spa_times($SpaId);
               $productType     = $this->m_products->get_product_types_new();
               $this->load->view($lang.'/admin/spa/ViewEditSpa', array('spa' => $spa, 'listimage' => $ListImage, 'listproduct' => $ListProduct,"listtime"=>$ListTime,"productypelist"=>$productType)); 
            }
        else{
            $this->load->view($lang.'/admin/v_accessdenied');
        }
    }
        
    public function delete($id){
            try{
                    $this->spamodel->delete_spa($id);
                    redirect('spa');
                }
            catch(Exception $e){
                    echo "Xóa thất bại";
            }                       
        }
        
        public function update(){
            $date_added         =  date('Y-m-d H:i:s');
            $str_spaID = $this->input->post('spaID');
            $str_spaName = $this->input->post('spaName');
            $str_address = $this->input->post('address');
            $str_tel = $this->input->post('Tel');
            $str_email = $this->input->post('email');
            $str_note = $this->input->post('Note');
            $str_modifiedby = 'admin';
            $str_modifiedDate = $date_added;
            
            try{
                $arr    =   array(
                            'spaID' =>  $str_spaID,
                            'spaName' => $str_spaName,
                            'Address' => $str_address,
                            'Tel'   => $str_tel,
                            'Email' => $str_email,
                            'Note'  => $str_note,
                            'ModifiedBy' => $str_modifiedby,
                            'ModifiedDate' => $str_modifiedDate
                            );
                
                $arr_update = $this->spamodel->update_spa($str_spaID,$arr); 
                         
                redirect('spa');
                
            }catch(Exception $e){
                echo "Chỉnh sửa spa khong thanh cong";
            }
            
        }
    
    public function UploadFile($MaDoiTuong){
        //$TM_Con ="";
        $TM_Con = $MaDoiTuong;
                
        $mimes = array(
            'image/jpeg', 'image/png', 'image/gif'
        );
        if (!file_exists('resources/img/spa/'.$TM_Con)) {
        mkdir('resources/img/spa/'.$TM_Con, 0777, true);
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
                move_uploaded_file($_FILES['myfile']['tmp_name'], 'resources/img/spa/'.$TM_Con.'/'.$fileName);
                $strURL = 'resources/img/spa/'.$TM_Con.'/'.$fileName;
                $this->spamodel->InsertLinks($MaDoiTuong, $strURL);
                 
                $url='resources/img/spa/'.$fileName;
                $fileStatus['status'] = 1;
                $fileStatus['message'] = "Bạn đã upload $fileName thành công";
                $fileStatus['url'] = $url;
            }    
        echo json_encode($fileStatus);
        exit();        
        }
    }
}

?>
