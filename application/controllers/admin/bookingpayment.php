<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bookingpayment extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/m_bookingpayment');
        $this->load->model('admin/m_user');
        $this->load->model('m_mail');
        $this->load->model('m_sms');
        $this->db2 = $this->load->database('thebooking', TRUE);
        //$this->load->model('admin/m_products');
        //$this->load->model('m_object');
    }
    function  CheckQuyen($id)
    {
        // 1: allow New
        // 2: allow Edit
        // 3: allow Delete
        // 4: allow View
        // 5: allow Print
        // 6: Status
        
        $page = "admin/bookingpayment";
        
        $arr = (array) $_SESSION['AccUser'];
        $list =  (array)$arr['ListMenu'];
        $val= false;
        for($i=0;$i<count($list);$i++)
        {
            if($list[$i]->url == $page)
            {
                switch($id)
                {
                    case 1:
                    {
                        // allow new
                        if($list[$i]->AllowNew == 1)
                        {
                            $val=true;
                        }
                        break;
                    }
                    case 2:
                    {
                        // allow edit
                        if($list[$i]->AllowEdit == 1)
                        {
                            $val=true;
                        }
                        break;
                    }
                    case 3:
                    {
                        // allow Delete
                        if($list[$i]->AllowDelete == 1)
                        {
                            $val=true;
                        }
                        break;
                    }
                    case 4:
                    {
                        // allow View
                        if($list[$i]->AllowView == 1)
                        {
                            $val=true;
                        }
                        break;
                    }
                    case 5:
                    {
                        // allow print
                        if($list[$i]->AllowPrint == 1)
                        {
                            $val=true;
                        }
                        break;
                    }
                    case 6:
                    {
                        // Status
                        if($list[$i]->Status == 1)
                        {
                            $val=true;
                        }
                        break;
                    }
                }
                break;
            }
        }
        return $val;
    }
    public function index()
    {
        $lang = $_SESSION['Lang'];
        if($this->CheckQuyen(6))
        {
            $this->load->view($lang.'/admin/booking/v_bookingpayment');
        }
        else
        {
           $this->load->view($lang.'/admin/v_accessdenied');
        }
    }
    public function search_booking()
    {
        $ckq = $this->CheckQuyen(4);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_bookingpayment->search_booking();
        }
        echo json_encode($req);
    }
    public function searchcancel()
    {
        $ckq = $this->CheckQuyen(4);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_bookingpayment->searchcancel();
        }
        echo json_encode($req);
    }
    
    public function checkpayment()
    {
        $ckq = $this->CheckQuyen(2);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_bookingpayment->checkpayment();
        }
        echo json_encode($req);
    } 
    public function load_spaname_search()
    {
        $ckq = $this->CheckQuyen(4);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_bookingpayment->load_spaname_search();
        }
        echo json_encode($req);
    } 
    public function btnhuytt()
    {
        $ckq = $this->CheckQuyen(2);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_bookingpayment->btnhuytt();
        }
        echo json_encode($req);
    }
    public function btnkhongchohuytt()
    {
        $ckq = $this->CheckQuyen(2);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_bookingpayment->btnkhongchohuytt();
        }
        echo json_encode($req);
    }
    public function sendmail()
   {            
        if(isset($_SESSION['AccUser']))
        {
             $req = $this->m_bookingpayment->sendmail();
                echo json_encode($req);
        }
        else
       {
           redirect("../index");
       }  
   } 
   
    // file export execel
    public function export_excel()
    {
        $ckq = $this->CheckQuyen(4);
        $req = -1;
        if($ckq == true)
        {
            $export_excel=$this->m_bookingpayment->export_excel();
            if(count($export_excel)>0)
            {
                $this->load->file("public/php-excel.class.php");
                 //echo $sql_ex;die;
                // create a simple 2-dimensional array
                $arr_re=array();
                $i=0;
                $arr_re[$i][]="Tên Spa";
                $arr_re[$i][]="Tên Dịch vụ";
                $arr_re[$i][]="Tổng tiền";
                $arr_re[$i][]="Thời gian bắt đầu";
                $arr_re[$i][]="Thời gian kết thúc";
                $arr_re[$i][]="Trạng thái thanh toán";
                $arr_re[$i][]="Địa chỉ thanh toán";
                
                
                foreach($export_excel as $row)
                {
                    $i++;
                    $arr_re[$i][]=$row->spaName; //ma phieu
                    $arr_re[$i][]=$row->Name; 
                    $arr_re[$i][] = $row->desc1;
                    if($row->Status==1 || $row->Status=="1")
                        $trangthai="Hoạt động";
                    else
                        $trangthai="Đã huỷ";
                    $arr_re[$i][]=$trangthai;
                    $arr_re[$i][] = $row->ProductTypeName;
                    $arr_re[$i][] = $row->Duration;
                    $arr_re[$i][] = $row->CurrentVouchers;
                    $arr_re[$i][] = $row->MaxProductatOnce;
                    $datefrom=$row->ValidTimeFrom;
                    $datefrom=explode(" ",$datefrom);
                    $datefrom=explode("-",$datefrom[0]);
                    $datefrom=$datefrom[2]."-".$datefrom[1]."-".$datefrom[0];
                    
                    $dateto=$row->ValidTimeTo;
                    $dateto=explode(" ",$dateto);
                    $dateto=explode("-",$dateto[0]);
                    $dateto=$dateto[2]."-".$dateto[1]."-".$dateto[0];
                    
                    $arr_re[$i][]=$datefrom; 
                    $arr_re[$i][]=$dateto; 
                   
                }
                
                // generate file (constructor parameters are optional)
                $xls = new Excel_XML('UTF-8', false, 'Workflow Management');
                $xls->addArray($arr_re);
                $xls->generateXML('listproducts');
            }
            else
            {
                echo "<span style=\"color:red;font-weight:bold;\">Vui long tim kiem danh sach de xuat duoc file excel</span>";
            }
        }
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */