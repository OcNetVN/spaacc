<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voucher extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/m_voucher');
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
            $this->load->view($lang.'/admin/discount/v_voucher');
        }
        else
        {
           $this->load->view($lang.'/admin/v_accessdenied');
        }
    }
    public function layloaithe()
    {
        $ckq = $this->CheckQuyen(4);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_voucher->layloaithe();
        }
        echo json_encode($req);
    }
    public function layloaithethem()
    {
        $ckq = $this->CheckQuyen(1);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_voucher->layloaithethem();
        }
        echo json_encode($req);
    }
    public function searchvoucher()
    {
        $ckq = $this->CheckQuyen(4);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_voucher->searchvoucher();
        }
        echo json_encode($req);
    }
    public function clickbtnsearch()
    {
        $ckq = $this->CheckQuyen(4);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_voucher->clickbtnsearch();
        }
        echo json_encode($req);
    }
    public function clickbtnthem()
    {
        $ckq = $this->CheckQuyen(1);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_voucher->clickbtnthem();
        }
        echo json_encode($req);
    }
    //
    public function searchpro()
    {
        $ckq = $this->CheckQuyen(4);
        $req = -1;
        if($ckq == true)
         {
            $req = $this->m_voucher->searchpro();
         }
        echo json_encode($req);
    }
    //
    public function sua()
    {
        $ckq = $this->CheckQuyen(2);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_voucher->sua();
        }
        echo json_encode($req);
    }
    public function clickbtnsua()
    {
        $ckq = $this->CheckQuyen(2);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_voucher->clickbtnsua();
        }
        echo json_encode($req);
    }
    public function xoa()
    {
        $ckq = $this->CheckQuyen(3);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_voucher->xoa();
        }
        echo json_encode($req);
    }
    public function export_excel_voucher()
    {
        $ckq = $this->CheckQuyen(4);
        $req = -1;
        if($ckq == true)
        {
            $export_excel=$this->m_voucher->export_excel_voucher();
            if(count($export_excel)>0)
            {
                $this->load->file("public/php-excel.class.php");
                 //echo $sql_ex;die;
                // create a simple 2-dimensional array
                $arr_re=array();
                $i=0;
                $arr_re[$i][]="Mã voucher";
                $arr_re[$i][]="Mã phát sinh";
                $arr_re[$i][]="Ngày bắt đầu";
                $arr_re[$i][]="Ngày hết hạn";
                $arr_re[$i][]="Giá tiền thẻ";
                $arr_re[$i][]="UserID";
                $arr_re[$i][]="Loại thẻ";
                $arr_re[$i][]="Trạng thái";
                $arr_re[$i][]="Áp dụng";
                $arr_re[$i][]="Giá tối thiểu áp dụng";
                
                foreach($export_excel as $row)
                {
                	$i++;
                	$arr_re[$i][]=(int)$row->VoucherID; //ma phieu
                	$arr_re[$i][]=$row->GeneratedID; 
                    
                    $datefrom=$row->ValidForm;
                    $datefrom=explode(" ",$datefrom);
                    $datefrom=explode("-",$datefrom[0]);
                    $datefrom=$datefrom[2]."-".$datefrom[1]."-".$datefrom[0];
                    
                    $dateto=$row->ValidTo;
                    $dateto=explode(" ",$dateto);
                    $dateto=explode("-",$dateto[0]);
                    $dateto=$dateto[2]."-".$dateto[1]."-".$dateto[0];
                    
                	$arr_re[$i][]=$datefrom; 
                	$arr_re[$i][]=$dateto; 
                	$arr_re[$i][]=$row->Discount;
                    $arr_re[$i][]=$row->RefUserID;
                	$arr_re[$i][]=$row->VoucherType;
                    if($row->Status==1 || $row->Status=="1")
                        $trangthai="Đang dùng";
                    else
                        $trangthai="Đã huỷ";
                    $arr_re[$i][]=$trangthai;
                    
                    if($row->AppliedForAll==1 || $row->AppliedForAll=="1")
                        $apdung="Tất cả";
                    else
                        $apdung="Một số sản phẩm";
                    $arr_re[$i][]=$apdung;
                    $arr_re[$i][]=$row->PriceMin;
                }
                
                // generate file (constructor parameters are optional)
                $xls = new Excel_XML('UTF-8', false, 'Workflow Management');
                $xls->addArray($arr_re);
                $xls->generateXML('datavoucher');
            }
            else
            {
                echo "<span style=\"color:red;font-weight:bold;\">Không có dữ liệu để export</span>";
            }
        }
    }
    public function export_excel_them()
    {
        $ckq = $this->CheckQuyen(4);
        $req = -1;
        if($ckq == true)
        {
            $export_excel=$this->m_voucher->export_excel_them();
            if(count($export_excel)>0)
            {
                $this->load->file("public/php-excel.class.php");
                 //echo $sql_ex;die;
                // create a simple 2-dimensional array
                $arr_re=array();
                $i=0;
                $arr_re[$i][]="Mã voucher";
                $arr_re[$i][]="Mã phát sinh";
                $arr_re[$i][]="Ngày bắt đầu";
                $arr_re[$i][]="Ngày hết hạn";
                $arr_re[$i][]="Giá tiền thẻ";
                $arr_re[$i][]="UserID";
                $arr_re[$i][]="Loại thẻ";
                $arr_re[$i][]="Trạng thái";
                $arr_re[$i][]="Áp dụng";
                $arr_re[$i][]="Giá tối thiểu áp dụng";
                
                foreach($export_excel as $row)
                {
                	$i++;
                	$arr_re[$i][]=(int)$row->VoucherID; //ma phieu
                	$arr_re[$i][]=$row->GeneratedID; 
                    
                    $datefrom=$row->ValidForm;
                    $datefrom=explode(" ",$datefrom);
                    $datefrom=explode("-",$datefrom[0]);
                    $datefrom=$datefrom[2]."-".$datefrom[1]."-".$datefrom[0];
                    
                    $dateto=$row->ValidTo;
                    $dateto=explode(" ",$dateto);
                    $dateto=explode("-",$dateto[0]);
                    $dateto=$dateto[2]."-".$dateto[1]."-".$dateto[0];
                    
                	$arr_re[$i][]=$datefrom; 
                	$arr_re[$i][]=$dateto; 
                	$arr_re[$i][]=$row->Discount;
                    $arr_re[$i][]=$row->RefUserID;
                	$arr_re[$i][]=$row->VoucherType;
                    if($row->Status==1 || $row->Status=="1")
                        $trangthai="Đang dùng";
                    else
                        $trangthai="Đã huỷ";
                    $arr_re[$i][]=$trangthai;
                    
                    if($row->AppliedForAll==1 || $row->AppliedForAll=="1")
                        $apdung="Tất cả";
                    else
                        $apdung="Một số sản phẩm";
                    $arr_re[$i][]=$apdung;
                    $arr_re[$i][]=$row->PriceMin;
                }
                
                // generate file (constructor parameters are optional)
                $xls = new Excel_XML('UTF-8', false, 'Workflow Management');
                $xls->addArray($arr_re);
                $xls->generateXML('datavoucher');
            }
            else
            {
                echo "<span style=\"color:red;font-weight:bold;\">Không có dữ liệu để export</span>";
            }
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */