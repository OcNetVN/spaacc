<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller
{
       function __construct()
       {
            parent::__construct();
            $this->load->model('m_category'); 
            $this->load->model('m_index'); 
            $this->load->model('m_news');
            $this->load->model('m_mail');          
       }
       public function index(){
            $res['listpro_limit4'] = $this->m_index->listpro_limit4();
            $res['loaispcon'] = $this->m_index->layloaiconsp();
            $res['MenuString'] = $this->m_index->getMenuStr();
            $res['SortBy'] = $this->m_category->GetSortBy();
            $res['ProductTypeCap1'] = $this->m_category->GetProductTypeCap1();
            
            //nghia viet them 25/12/2014
            $res['dsloai'] = $this->m_news->laytatcaloainews();
            $res['dstintucmoinhat'] = $this->m_news->laytintucmoi();
            $res['dstintheoloaidautien'] =$this->m_news->laydstin_theoloaidautien();
            $res['CommentString'] = $this->m_index->getCommentStr();
            $segment3=$this->uri->segment(3);
            if(isset($segment3) && $segment3!="")
            {
                $newsid=$segment3;
            }
            else
            {
                if(isset($res['dstintucmoinhat']) && count($res['dstintucmoinhat'])>0)
                {
                    $newsid=$res['dstintucmoinhat'][0]->id;
                }
                else
                    $newsid=-1;
            }
            if($newsid!=-1 && $newsid!="-1")
            {
                $res['mainnews']=$this->m_news->laytintuc_theomatintuc($newsid);
                $hinh=$this->m_news->layhinhtintuc_theomatintuc($newsid);
                if(count($hinh)>0)
                {
                    $res['hinh']=$hinh;
                }
                if(isset($res['mainnews']) && count($res['mainnews'])>0)
                {
                    $res['listmainnews']=$this->m_news->dstintuc_theomaloaitintuc_khacid($res['mainnews']->CategoryID,$res['mainnews']->id);
                }
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
            //echo $a;die;
            $this->load->view($lang.'/news',$res);
       }
       public function loadloai()
       {
            $req = $this->m_news->loadloai();
            echo json_encode($req);
       }
       public function loadnews()
       {
            $req = $this->m_news->loadnews();
            echo json_encode($req);
       }
       public function loadpage()
       {
            $req = $this->m_news->loadpage();
            echo json_encode($req);
       }
       
}
?>
