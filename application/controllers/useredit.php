<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Useredit extends CI_Controller
{
       function __construct()
       {
            parent::__construct();
            $this->load->model('m_useredit');
            $this->load->model('m_index');
            $this->load->model('m_mail');
            $this->load->model('admin/m_user');
            $this->db2 = $this->load->database('thebooking', TRUE);
       }
       
       public function index()
       {
            if(isset($_SESSION['AccUser']))
            {
                $userid=$_SESSION['AccUser']['User']->UserId;
                $data['MenuString'] = $this->m_index->getMenuStr();
                $data['CommentString'] = $this->m_index->getCommentStr();
                $data['ttuser']=$this->m_useredit->layobjecttheouserid($userid);
                $lang = "vi-VN";
                 if(isset($_SESSION['Lang']))
                      $lang = $_SESSION['Lang'];
                  else
                       $_SESSION['Lang']=$this->m_mail->getSetting("LangaugeDefault");
                $this->load->view($lang.'/useredit',$data);
            }
            else
           {
               redirect("index");
           }
       }
       public function loadeditprofile()
       {
            if(isset($_SESSION['AccUser']))
            {
                $data['MenuString'] = $this->m_index->getMenuStr();
                $req = $this->m_useredit->loadeditprofile();
                echo json_encode($req);
            }
            else
           {
               redirect("index");
           }
       }
       public function loadlocationchild()
       {
            if(isset($_SESSION['AccUser']))
            {
                $req = $this->m_useredit->loadlocationchild();
                echo json_encode($req);
            }
            else
           {
               redirect("index");
           }
       }
       public function btnsave()
       {
            if(isset($_SESSION['AccUser']))
            {
                $req = $this->m_useredit->btnsave();
                echo json_encode($req);
            }
            else
           {
               redirect("index");
           }
       }
       public function btndoipass()
       {
            if(isset($_SESSION['AccUser']))
            {
                $req = $this->m_useredit->btndoipass();
                echo json_encode($req);
            }
            else
           {
               redirect("index");
           }
       }
}
?>