<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Check123pay extends CI_Controller
{
       function __construct()
       {
            parent::__construct();
            $this->load->model('m_checkout');
            $this->load->model('admin/m_user');
            $this->load->model('m_index');
            $this->load->model('m_mail');
            $this->db2 = $this->load->database('thebooking', TRUE);
       }
       
       public function index()
       {
            if(isset($_SESSION["check_goto123pay"]))
            {
                if((isset($_SESSION['AccUser']) || isset($_SESSION['object'])) && isset($_SESSION['check2']) && isset($_SESSION['Cart']))
                {
                    $typefor123pay= $_SESSION['the'];
                    //echo $typefor123pay;die;
                    //$_SESSION['check123pay']="check123pay";
                    $data['MenuString'] = $this->m_index->getMenuStr();
                    $data['CommentString'] = $this->m_index->getCommentStr();
                    $data['arr_pay123'] = $this->m_checkout->check123pay();
                    
                    $actual_link = 'http://'.$_SERVER['HTTP_HOST']. base_url();   
                    $data['ipaddress'] = $this->m_checkout->getRealIPAddress();
                    if(strpos($actual_link,"localhost")>0 || strpos($actual_link,"127.0.0.1")>0)
                        $data['ipaddress'] = "192.168.1.99";
                    
                    $data['typefor123pay']=$typefor123pay;
                    //echo $data['ipaddress'];die;
                    /*echo "<pre>";
                        print_r($data['arr_pay123']);
                    echo "</pre>";die;*/
                    if(isset($_SESSION['AccUser']))
                    {
                        $data['user_object']=$this->m_checkout->layobjecttheouserid($_SESSION['AccUser']['User']->UserId);
                    }
                    if(isset($_SESSION['object']))
                    {
                        $data['user_object']=$this->m_checkout->layobjecttheObjectID($_SESSION['object']->ObjectId);
                    }
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
                    $this->load->view($lang.'/check123pay',$data);
                }
                else
               {
                   redirect("index");
               }
            }
            else
                redirect("checkout2");
       }
       
       public function sendmail()
       {            
            if((isset($_SESSION['AccUser'])||isset($_SESSION['object'])) && isset($_SESSION['check3']))
            {
                 $req = $this->m_checkout->sendmail();
                    echo json_encode($req);
            }
            else
           {
               redirect("index");
           }  
       } 
}
?>