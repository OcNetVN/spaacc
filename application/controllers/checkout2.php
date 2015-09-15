<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class CheckOut2 extends CI_Controller
{
       function __construct()
       {
            parent::__construct();
            $this->load->model('m_checkout');
            $this->load->model('admin/m_user');
            $this->load->model('m_index');
            $this->load->model('m_mail');
            $this->load->model('m_sms');
            $this->db2 = $this->load->database('thebooking', TRUE);
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
           /*----------------------------
             |-----------------------------
             |check 123pay
             |----------------------------------*/
           if(isset($_SESSION['AccUser']))
            {
                $data['user_object']=$this->m_checkout->layobjecttheouserid($_SESSION['AccUser']['User']->UserId);
            }
            if(isset($_SESSION['object']))
            {
                $data['user_object']=$this->m_checkout->layobjecttheObjectID($_SESSION['object']->ObjectId);
            }
            $data['arr_pay123'] = $this->m_checkout->check123pay();
            /*----------------------------
             |-----------------------------
             |check 123pay
             |----------------------------------*/
            if((isset($_SESSION['AccUser']) || isset($_SESSION['object'])) && isset($_SESSION['checkout1']) && isset($_SESSION['Cart']))
            {
                $_SESSION['check2']="check2";
                $data['MenuString'] = $this->m_index->getMenuStr();
                $data['CommentString'] = $this->m_index->getCommentStr();
                $data['Payment']=$this->m_checkout->gethinhthucthanhtoan();
                //$lang = $_SESSION['Lang'];
                $this->load->view($lang.'/checkout2',$data);
            }
            else
           {
               redirect("index");
           }
       }
       public function luusessionthe()
       {
            if(isset($_POST['the']))
            {
                $the=$_POST['the'];
                $_SESSION['the']=$the;
            }
            if(isset($_POST['check_gotoonlinepay']))
            {
                $check_goto123pay=$_POST['check_gotoonlinepay'];
                $_SESSION['check_goto123pay']=$check_goto123pay;
            }
       }
       
       public function gotostep3()
       {          
           
            if((isset($_SESSION['AccUser']) || isset($_SESSION['object'])) && isset($_SESSION['check2']) && isset($_SESSION['Cart']))
            {
                unset($_SESSION['check2']);
                $data['MenuString'] = $this->m_index->getMenuStr();
                $req = $this->m_checkout->gotostep3();
                echo json_encode($req);
            }
           else
           {
               redirect("index");
           }   
       }  
       public function sendmail()
       {            
            if((isset($_SESSION['AccUser']) || isset($_SESSION['object'])) && isset($_SESSION['check3']))
            {
                 $req = $this->m_checkout->sendmail();
                    echo json_encode($req);
            }
            else
           {
               redirect("index");
           }  
       } 
       public function getpoint()
       {
            if(isset($_SESSION['AccUser']) || isset($_SESSION['object']))
            {
                 $req = $this->m_checkout->getpoint();
                    echo json_encode($req);
            }
            else
           {
               redirect("index");
           }  
       }
       public function completestep()
       {
            $data['MenuString'] = $this->m_index->getMenuStr();
            $this->load->view('checkout3',$data);
       }    
       public function paypoint()
       {
            if((isset($_SESSION['AccUser']) || isset($_SESSION['object'])) && isset($_SESSION['Cart']))
            {
                $data['CommentString'] = $this->m_index->getCommentStr();
                $data['MenuString'] = $this->m_index->getMenuStr();
                $data['arrdiemuser'] = $this->m_checkout->getpoint();
                
                $lang = $_SESSION['Lang'];
                $this->load->view($lang.'/checkoutpoint',$data);
            }
            else
               redirect("index");
       }
       public function applycodediscount()
       {
            if((isset($_SESSION['AccUser']) || isset($_SESSION['object'])) && isset($_SESSION['Cart']))
            {
                 $req = $this->m_checkout->applycodediscount();
                    echo json_encode($req);
            }
            else
           {
               redirect("index");
           }  
       }
       public function savediscount()
       {
            if(isset($_POST['textrequestmember']))
            {
                $textrequestmember=$_POST['textrequestmember'];
                $_SESSION['textrequestmember']=$textrequestmember;
            }
            if(isset($_POST['DiscountType']))
            {
                if(isset($_SESSION['discount']))
                    unset($_SESSION['discount']);
                $DiscountType=$_POST['DiscountType'];
                $Percentage=$_POST['Percentage'];
                $DiscountAmt=$_POST['DiscountAmt'];
                $DiscountCode=$_POST['DiscountCode'];
                $generatedID=$_POST['generatedID'];
                if($DiscountType!="")
                {
                    $arr_discount=array(
                                        "DiscountType" => $DiscountType, //member/Voucher/point
                                        "Percentage" => $Percentage,
                                        "DiscountAmt"=> $DiscountAmt,
                                        "DiscountCode"=>$DiscountCode,
                                        "generatedID"=>$generatedID
                                    );
                    //print_r($arr_discount);die;
                    $_SESSION['discount']=$arr_discount;
                }
            }
       }
       public function usesessioncheck2()
       {
            $_SESSION['check2']="check2";
            $req=1;
            echo json_encode($req);
       }
}
?>