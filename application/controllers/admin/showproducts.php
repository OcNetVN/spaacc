<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Showproducts extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
         $this->load->model('m_showproducts');
    }
	public function index()
	{
	   //echo "sds";die;
	   $id=$this->uri->segment(3);
	    $data['products']=$this->m_showproducts->lay_products_theo_id($id);
        //print_r($data['products']);die;
        $data['links']=$this->m_showproducts->lay_hinh_theo_id($id);
        //count($data['links']);die;
        //
        //print_r($data['spa']);die;
		$this->load->view('showproducts.php',$data);
	}
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */