<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Showspa extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
         $this->load->model('m_showspa');
    }
	public function index()
	{
	   $id=$this->uri->segment(3);
	    $data['spa']=$this->m_showspa->lay_spa_theo_id($id);
        $data['links']=$this->m_showspa->lay_hinh_theo_id($id);
        //count($data['links']);die;
        //print_r($data['links']);die;
        //print_r($data['spa']);die;
		$this->load->view('showspa.php',$data);
	}
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */