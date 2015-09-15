<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Successpay123 extends CI_Controller
{
       function __construct()
       {
            parent::__construct();
            $this->load->model('m_checkout');
            $this->load->model('admin/m_user');
            $this->load->model('m_mail');
            $this->load->model('m_index');
            $this->db2 = $this->load->database('thebooking', TRUE);
       }
       
       public function index(){
          $status = 0;
          if(isset($_GET['status']))
          {
              $status = intval($_GET['status']);
          }         
          
          if($status==1)
          {
               if( (isset($_SESSION['AccUser']) || isset($_SESSION['object']))  && isset($_SESSION['Cart']))
               {
                    $data['MenuString'] = $this->m_index->getMenuStr();
                    $data['CommentString'] = $this->m_index->getCommentStr();
                    $lang = "vi-VN";
                     if(isset($_SESSION['Lang']))
                          $lang = $_SESSION['Lang'];
                      else
                           $_SESSION['Lang']=$this->m_mail->getSetting("LangaugeDefault");
                    //nghia viet them theo ss cart moi
                    $this->load->view($lang.'/successpay123',$data);
               }
               else
               {
                        redirect("index");
               }
               if(isset($_SESSION['check_goto123pay']))    
                    unset($_SESSION["check_goto123pay"]);
          }
          else
          {
                if(isset($_SESSION['check_goto123pay']))    
                    unset($_SESSION["check_goto123pay"]);
              redirect("cancelpay123");
          }
       }
       public function getvalue123pay()
       {
          
                if((isset($_SESSION['AccUser']) || isset($_SESSION['object']))  && isset($_SESSION['check123pay']) && isset($_SESSION['check2']) && isset($_SESSION['Cart']))
                {
                    $data['MenuString'] = $this->m_index->getMenuStr();
                    $req = $this->m_checkout->getvalue123pay();
                    echo json_encode($req);
                }
               else
               {
                   redirect("index");
               }   
         
       } 
       public function post123pay()
       {
            if( (isset($_SESSION['AccUser']) || isset($_SESSION['object'])) && isset($_SESSION['check123pay']) && isset($_SESSION['check2']) && isset($_SESSION['Cart']))
            {
                @include_once 'resources/front/123pay/common.class.php';
                $data['MenuString'] = $this->m_index->getMenuStr();
                $req = $this->m_checkout->post123pay();
                echo json_encode($req);
            }
           else
           {
               redirect("index");
           }   
       } 
     
}
?>