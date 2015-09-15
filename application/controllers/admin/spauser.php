<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class spauser extends CI_Controller
{
       var  $i = 0;
       function __construct()
       {
            parent::__construct();
            $this->load->helper('url');
            $this->load->Model('admin/spamodel');
            $this->load->Model('admin/spausermodel');
        }
        
        public function index(){
            //$data  =   $this->spausermodel->get_spauser();
            $arr_spa = $this->spamodel->get_spa();   
            //phan trang 
            $list=$this->spausermodel->danh_sach_spauser();
            $id=$this->uri->segment(3);
            $total_rows = count($list); //lay tong so sp cung loai
            $this->load->library('pagination');
            $config['base_url'] = base_url().'admin/spa/index';
            $config['total_rows'] = $total_rows;
            $config['per_page'] = 10;
            $config['uri_segment'] = 3; //da duoc mac dinh la 3
            $config['use_page_numbers'] = FALSE; //true: tra ve trang so may; flase: tra ve gia tri bat dau cua trang
            $config['first_link'] = 'First'; 
            $config['last_link'] = 'Last';
            $this->pagination->initialize($config); 
            $page=$this->uri->segment(3)?$this->uri->segment(3):0;
            $links=$this->pagination->create_links();
            $data=$this->spausermodel->danh_sach_spauser_phan_trang($config['per_page'],$page);
            $this->load->view('admin/spauser/view_index', array('query' => $data,'spa' => $arr_spa, 'links' => $links));
            
        }
        public function insert(){

            //$datestring     =  "%Y/%m/%d %h:%i:%s";
            //$date_added     =  mdate($datestring, time() - 60*60);
            $date_added         =  date('Y-m-d H:i:s');
            $str_spaID      = $this->input->post('spaID');
            $str_userID    = $this->input->post('userID');
            $str_createdby  = 'admin';
            $str_createdDate = $date_added;

            try{
                $arr =  array(
                            'SpaID' =>  $str_spaID,
                            'UserID' => $str_userID,
                            'CreatedBy' => $str_createdby,
                            'CreatedDate' => $str_createdDate
                            );
                
                $this->spausermodel->insert_spauser($arr);             
                redirect('spauser');
                
            }catch(Exception $e){
                echo "Them moi spa user khong thanh cong";
            }
        }
        public function edit($spaId,$userID){
            
            $arr_spa = $this->spamodel->get_spa(); 
            $arr_spauser = $this->spausermodel->edit_spauser($spaId,$userID);           
            $this->load->view('view_editSpauser', array('spauser' => $arr_spauser,'spa' => $arr_spa));
        }
        
        public function delete($spaId,$userID){
            
            try{
                    $this->spausermodel->delete_spauser($spaId,$userID);
                    redirect('spauser');
                }catch(Exception $e){
                    echo "Xóa thất bại";
                }                       
        }
        
        public function update(){
            
            //$datestring         =   "%Y/%m/%d %h:%i:%s";
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
    
}
  
?>
