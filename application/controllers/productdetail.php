<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Productdetail extends CI_Controller
{
       function __construct()
       {
            parent::__construct();
            $this->load->model('m_productdetail');
            $this->load->model('admin/m_user');
            $this->load->model('m_index');
            $this->load->model('m_spadetail');
       }
       
       public function index()
       {
            $id=$this->uri->segment(3); //id spa
            if(isset($id) && $id!="")
            {
                $data['ttsp'] = $this->m_productdetail->layproduct_theoma($id);
                $this->m_spadetail->countview($data['ttsp']->SpaID);
                if(count($data['ttsp'])>0)
                {
                    $data['MenuString'] = $this->m_index->getMenuStr();
                    $data['CommentString'] = $this->m_index->getCommentStr();
                    $lang = "vi-VN";
                     if(isset($_SESSION['Lang']))
                          $lang = $_SESSION['Lang']; 
                       else
                           $_SESSION['Lang']=$this->m_mail->getSetting("LangaugeDefault");
                      
                    $this->load->view($lang.'/productdetail',$data);
                }
                else
                {
                    redirect('index');
                }
            }
            else
            {
                redirect('index');
            }
       }
       public function checkttsp()
       {
            $url=$_POST['url'];
            $flag=0;
            $masp="";
            $arrurl=explode("/",$url);
            $vtid= count($arrurl)-1;
            $id=$arrurl[$vtid];
            //echo $id;die;
            if(isset($id) && $id!="")
            {
                $ttsp = $this->m_productdetail->layproduct_theoma($id);
                if(count($ttsp)>0)
                {
                    $masp=$ttsp->ProductID;
                }
                    $flag=1;
            }
            $arr=array("flag"=>$flag,"masp"=>$masp);
            echo json_encode($arr);
       }
       public function checkpromotion()
       {
            $req = $this->m_productdetail->checkpromotion();
            echo json_encode($req);
       }
}
?>