<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class CheckOut3 extends CI_Controller
{
       function __construct()
       {
            parent::__construct();
            $this->load->model('m_checkout');
            $this->load->model('admin/m_user');
            $this->load->model('m_index');
            $this->load->model('m_mail');
       }
       
       public function index()
       {
            if(isset($_SESSION['AccUser']))
            {
                $paywith=$this->uri->segment(3)?$this->uri->segment(3):0;
                $data['paywith'] = $paywith;
                $lang = "vi-VN";
               if(isset($_SESSION['Lang']))
               {
                  $lang = $_SESSION['Lang'];
               }
               else
               {
                   $_SESSION['Lang']=$this->m_mail->getSetting("LangaugeDefault");
                   //$lang= 
               }
                //$data['Payment']=$this->m_checkout->gethinhthucthanhtoan();
                $this->load->view($lang.'/checkout3',$data);
            }
            else
           {
               redirect("index");
           }
       }
}
?>