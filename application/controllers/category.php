<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Category extends CI_Controller
{
       function __construct()
       {
            parent::__construct();
            $this->load->model('m_category'); 
            $this->load->model('m_index'); 
            $this->load->model('m_mail'); 
       }
       public function index(){
            $res['listpro_limit4'] = $this->m_index->listpro_limit4();
            $res['loaispcon'] = $this->m_index->layloaiconsp();
            $res['MenuString'] = $this->m_index->getMenuStr();
            $res['CommentString'] = $this->m_index->getCommentStr();
            $res['SortBy'] = $this->m_category->GetSortBy();
       
            $res['ProductTypeCap1'] = $this->m_category->GetProductTypeCap1();
            $res['listtienichspa'] = $this->m_category->laytienichspa();
            $res['listloaispa'] = $this->m_category->layloaispa();    
            
            if(isset($_SESSION['indexsearch']))
            {
                $res['txtcategory'] = "";
                if(isset($_SESSION['indexsearch']['location']))
                $res['txtcategory']=$_SESSION['indexsearch']['location'];
                if(isset($_SESSION['indexsearch']['producttype']) && $_SESSION['indexsearch']['producttype']!="")
                {
                    $name_childproducttype=$_SESSION['indexsearch']['producttype'];
                    $id_childproducttype=$this->m_category->layidloaisp_theotenloaisp($name_childproducttype);
                    //echo $id_childproducttype." ";
                    $id_chaproducttype=substr($id_childproducttype,0,2);
                    $res['id_childproducttype']=$id_childproducttype;
                    $res['id_chaproducttype']=$id_chaproducttype;
                    $res['list_childproducttype']=$this->m_category->layloaispcon_theoidloaispcha($id_chaproducttype);
                    //echo $res['id_chaproducttype'];
                    //print_r($res['list_childproducttype']);die;
                }
                
                
                if(isset($_SESSION['indexsearch']['producttypepanter']) && $_SESSION['indexsearch']['producttypepanter']!="")
                {
                   $commonID            = $_SESSION['indexsearch']['producttypepanter'];
                   $res['CommonID_Cha'] = $_SESSION['indexsearch']['producttypepanter'];
                   $res['list_productypeCon']=$this->m_category->layloaispcon_theoidloaispcha($commonID);
                }
                
                // check loại sản phẩm loại cha
            }
            $res['listspa'] = $this->m_category->searchspa();  
         
            /*echo "<pre>";
                print_r($res['listspa']);
            echo "</pre>";die;*/
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
                //$lang = $_SESSION['Lang'];                   
                $this->load->view($lang.'/category',$res);
       }
       public function searchspa()
       {
            $req = $this->m_category->searchspa();
            echo json_encode($req);
       }
       public function getspafacilities()
       {
            $req = $this->m_category->getspafacilities();
            echo json_encode($req);
       }
       public function loadloaispcon()
       {
            $req = $this->m_category->loadloaispcon();
            echo json_encode($req);
       }
       //tu trang index goi ve
       public function getvalueindex()
       {
            if(isset($_POST['producttype']))
                $producttype=$_POST['producttype'];
            if(isset($_POST['producttypepartent']))
                $producttypepartent=$_POST['producttypepartent'];
            if(isset($_POST['location']))
                $location=$_POST['location'];
            if(isset($producttype))
                $_SESSION['indexsearch']['producttype']=$producttype;
            if(isset($producttypepartent))
                $_SESSION['indexsearch']['producttypepanter']=$producttypepartent;
            if(isset($location))
                $_SESSION['indexsearch']['location']=$location;
       }
       //test
       /*public function location()
       {
            $a=$this->m_category->searchspa();
            //$a=$this->m_category->layspalocationtheospaid('0120141128000001');
            echo "<pre>";
            print_r($a);
            echo "</pre>";
       }*/
}
?>
