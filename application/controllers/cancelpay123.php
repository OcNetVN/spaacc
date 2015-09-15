<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Cancelpay123 extends CI_Controller
{
       function __construct()
       {
            parent::__construct();
            $this->load->model('m_checkout');
            $this->load->model('admin/m_user');
            $this->load->model('m_index');
       }
       
       public function index(){
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
           if( (isset($_SESSION['AccUser']) || isset($_SESSION['object']))  && isset($_SESSION['Cart']) && isset($_SESSION['mTransactionID']))
           {
                $data['MenuString'] = $this->m_index->getMenuStr();
                $data['CommentString'] = $this->m_index->getCommentStr();
                //nghia viet them theo ss cart moi
                $this->m_checkout->cancelpay123();
                //$lang = $_SESSION['Lang'];
                $this->load->view($lang.'/cancelpay123',$data);
                //xoa het du lieu da add vao db
                
           }
           else
           {
                //redirect("index");
                $data['MenuString'] = $this->m_index->getMenuStr();
                $data['CommentString'] = $this->m_index->getCommentStr();
                //$lang = $_SESSION['Lang'];                
                $this->load->view($lang.'/cancelpay123',$data);
           }
       }       
       
     
}
?>