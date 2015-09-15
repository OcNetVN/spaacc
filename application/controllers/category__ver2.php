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
            //$this->load->library('mydb');
       }
       public function index(){
            $res['listpro_limit4'] = $this->m_index->listpro_limit4();
            $res['loaispcon'] = $this->m_index->layloaiconsp();
            $res['MenuString'] = $this->m_index->getMenuStr();
            $res['CommentString'] = $this->m_index->getCommentStr();
            $res['SortBy'] = $this->m_category->GetSortBy();
            $res['link_spainfo'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $res['ProductTypeCap1'] = $this->m_category->GetProductTypeCap1();
            $res['listtienichspa'] = $this->m_category->laytienichspa();
            $res['listloaispa'] = $this->m_category->layloaispa();  
            
            if(isset($_SESSION['indexsearch']))
            {
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
            }
            
            $res['listspa'] = $this->m_category->searchspa();
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
       public function test()
       {
            $this->m_category->searchspa(); 
       }
       public function searchspa()
       {
            //echo $_POST['ProductType'];die;        
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
            {   
                $type = $_POST['producttype'];
                $sql  = "SELECT * FROM `commoncode` WHERE `CommonTypeId` = 'ProductType' AND  `StrValue2`  = '$type'";
                $arr = $this->db->query($sql)->result();
                $lst = (array)$arr;
                $str = "";
                $count = 0;
                if(count($lst) > 0){
                    $count = 1;
                    $numvalue2 =  $arr[0]->NumValue2;
                    $commonid  =  $arr[0]->CommonId;
                    if($numvalue2 == null){
                        
                        $sql_update = "UPDATE `commoncode` SET `NumValue2` = '$count' WHERE `CommonTypeId` = 'ProductType' AND `CommonId` = '$commonid'";
                        $this->db->query($sql_update);
                    }
                    else{
                        $numvalue2 += $count;
                        $sql_update = "UPDATE `commoncode` SET `NumValue2` = '$numvalue2' WHERE `CommonTypeId` = 'ProductType' AND `CommonId` = '$commonid'";
                        $this->db->query($sql_update);
                    }
                 }
               
                       
                $producttype=$_POST['producttype'];     
            }
             
            if(isset($_POST['location']))
                $location=$_POST['location'];
            if(isset($producttype))
                $_SESSION['indexsearch']['producttype']=$producttype;
            if(isset($location))
                $_SESSION['indexsearch']['location']=$location;
       }
       
}
?>
