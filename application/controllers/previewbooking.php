<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Previewbooking extends CI_Controller
{
       function __construct()
       {
            parent::__construct();
            $this->load->model('m_checkout');
            $this->load->model('m_index');
            $this->load->model('m_mail');
       }
       
       public function index()
       {
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
            $id=$this->uri->segment(3);
            if(isset($id) && $id!="")
                $str = $this->m_checkout->previewbooking($id);
            //print_r($str);die;
            if(isset($str) && $str!="")
                $data['str']=$str;
            $data['MenuString'] = $this->m_index->getMenuStr();
            $data['CommentString'] = $this->m_index->getCommentStr();
            //$lang = $_SESSION['Lang'];
            $this->load->view($lang.'/previewbooking',$data);
       }
}
?>