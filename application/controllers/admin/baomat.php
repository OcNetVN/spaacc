<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Baomat extends CI_Controller
{
       function __construct()
       {
            parent::__construct();
            $this->load->model('m_category'); 
            $this->load->model('m_index');        
            $this->load->model('m_mail');   
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
            $res['listpro_limit4'] = $this->m_index->listpro_limit4();
            $res['loaispcon'] = $this->m_index->layloaiconsp();
            $res['MenuString'] = $this->m_index->getMenuStr();
            $res['SortBy'] = $this->m_category->GetSortBy();
            $res['ProductTypeCap1'] = $this->m_category->GetProductTypeCap1();
            $res['CommentString'] = $this->m_index->getCommentStr();
            //$lang = $_SESSION['Lang'];
            //$lang = $_SESSION['Lang'];
            $res['HTMLInfo'] = $this->m_mail->GetHTML("baomat.html",$lang);
            $this->load->view($lang.'/baomat',$res);
       }
}
?>
