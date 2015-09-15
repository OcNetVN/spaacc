<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Welcome extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/m_object');
    }
    
    function  CheckQuyen($id)
    {
        // 1: allow New
        // 2: allow Edit
        // 3: allow Delete
        // 4: allow View
        // 5: allow Print
        
        $page = "admin/welcome";
        
        $arr = (array) $_SESSION['AccUser'];
        $list =  (array)$arr['ListMenu'];
        $val= false;
        $str="";
        for($i=0;$i<count($list);$i++)
        {
            if($list[$i]->url == $page)
            {
                $str =$list[$i];
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
                        // allow edit
                        if($list[$i]->AllowPrint == 1)
                        {
                            $val=true;
                        }
                        break;
                    }
                }
                break;
            }
        }
        //$res = array("quyen"=>$str,"Value"=>$val);
        //echo json_encode($res);
        return $val;
    }
    
    public function TestQuyenInsert()
    {
        $res = $this->CheckQuyen(1);
        if($res==true)
        {
            echo "1";
        }
        else
        {
            echo "-1";
        }        
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
		$this->load->view($lang.'/admin/v_welcome');
	}
    public function logout()
	{
	   $this->session->sess_destroy();
       unset($_SESSION['user_name']);
		redirect('login');
	}
    public function object()
	{
	   $this->load->library('form_validation');
	   $list=$this->m_object->danh_sach_object();
       //print_r($list_object);die;
       
       $id=$this->uri->segment(3);
        $total_rows = count($list); //lay tong so sp cung loai
        
        //xu ly phan trang
        $this->load->library('pagination');
        $config['base_url'] = base_url().'welcome/object';
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 10;
        $config['uri_segment'] = 3; //da duoc mac dinh la 3
        $config['use_page_numbers'] = FALSE; //true: tra ve trang so may; flase: tra ve gia tri bat dau cua trang
        $config['first_link'] = 'First'; 
        $config['last_link'] = 'Last';
        $this->pagination->initialize($config); 
        $page=$this->uri->segment(3)?$this->uri->segment(3):0;
        $data['links']=$this->pagination->create_links();
        $data['list_object']=$this->m_object->danh_sach_object_phan_trang($config['per_page'],$page,$id);
        
        
        //xoa nhieu
        if(isset($_POST['mul_delete']))
        {
            if(isset($_POST['arr_ObjectId']))
            {
                $arr_ma=$_POST['arr_ObjectId'];
                //print_r($arr_ma);die;
    			$str_ma="";
    			for($j=0;$j<count($arr_ma);$j++)
    			{
    				$str_ma.=$arr_ma[$j].", ";
    			}
    			$lenght=strlen($str_ma)-2;
    			$str_ma=substr($str_ma,0,$lenght);
                $this->m_object->xoa_nhieu_object($str_ma);
                redirect('welcome/object');
            }
        }
        
        $this->load->helper('form');
        $data['path'] = array('object/v_object.php');
        $this->load->view('v_welcome.php',$data);
	}
    public function insert()
	{
	   $this->load->library('form_validation');
       /*$this->form_validation->set_rules('ObjectId','ObjectId','required');
        $this->form_validation->set_rules('ObjectGroup','ObjectGroup','required');
        $this->form_validation->set_rules('ObjectType','FieldObjectType','required');*/
        $this->form_validation->set_rules('FullName','FullName','required');
        
        $this->form_validation->set_message('required','<span style="color:red">%s not null</span>');
        //$this->form_validation->set_message('integer','<span style="color:red">%s is number</span>');
            if($this->form_validation->run()) //chay va kiem tra gia tri cua form
            {
                //$ObjectID=$this->input->post('ObjectID');
                $ObjectGroup=$this->input->post('ObjectGroup');
                $ObjectType=$this->input->post('ObjectType');
                $int=(string)$ObjectGroup.$ObjectType.date("y").date("m").date("d");
                $max_objectid=$this->m_object->max_objectid($int);
                if($max_objectid->max!='')
                {
                    $tam=(int)substr($max_objectid->max,-6);
                    $dau=(string)substr($max_objectid->max,0,-6);
                    //echo $dau;die;
                    $tam+=1;
                    $arr_str=array(
                                    "1"=>"00000",
                                    "2"=>"0000",
                                    "3"=>"000",
                                    "4"=>"00",
                                    "5"=>"0",
                                    "6"=>"",
                    );
                    $ObjectID=$dau.(string)$arr_str[strlen($tam)].(string)$tam;
                    //echo $ObjectID;die;
                }
                else
                    $ObjectID=$int."000001";
                //string $a="000001";
                $FullName=$this->input->post('FullName');
                $PID=$this->input->post('PID');
                if($this->input->post('PIDState'))
                {
                    $ngayPID=explode("/",$this->input->post('PIDState'));
                    $PIDState=date("Y-m-d h:m:s",mktime(0,0,0,$ngayPID[0],$ngayPID[1],$ngayPID[2]));
                }
                else
                    $PIDState="";
                    
                //echo $PIDState;die;
                $PIDIssue=$this->input->post('PIDIssue');
                if($this->input->post('DoB'))
                {
                    $ngayDoB=explode("/",$this->input->post('DoB'));
                    $DoB=date("Y-m-d h:m:s",mktime(0,0,0,$ngayDoB[0],$ngayDoB[1],$ngayDoB[2]));
                }
                else
                    $DoB="";
                //$DoB=$this->input->post('DoB');
                $PoB=$this->input->post('PoB');
                $PerAdd=$this->input->post('PerAdd');
                $TemAdd=$this->input->post('TemAdd');
                $Gender=$this->input->post('Gender');
                $Image=$this->input->post('Image');
                
                $ProvinceId=$this->input->post('ProvinceId');
                $Tel=$this->input->post('Tel');
                $Fax=$this->input->post('Fax');
                $Email=$this->input->post('Email');
                $Website=$this->input->post('Website');
                $TaxCode=$this->input->post('TaxCode');
                $Note=$this->input->post('Note');
                $Status=$this->input->post('Status');
                $CreatedDate=date("Y-m-d h:m:s");
                //echo $CreatedDate;die;
                
                //$ngaycapnhat=dmy_to_ymd($ngaycapnhat);
                //$Image=$_FILES['hinh'];
                //move_uploaded_file($Image['tmp_name'],'./public/hinh_tam/'.$Image['name']);
                $Image=$_FILES['Image'];
                if($Image['name']!='') // co hinh vip moi
				{
				    include_once('public/kiem_tra_hinh_upload.php');
					$kt2 = kiem_tra_hinh($Image); //kiem_tra_hinh_upload.php truyen file hinh
					if($kt2=='') // hinh vip moi hop le
					{
						$name_Image = time()."_".$Image['name'];
						move_uploaded_file($Image['tmp_name'],'public/images/objects/'.$name_Image);
					}
					else // hinh vip moi khong hop le
                        $data['loi']='Figure invalid';
				}
                else
                    $name_Image="";
                
                $kq=$this->m_object->them_object($ObjectID,$ObjectGroup,$ObjectType,$FullName,$PID,$PIDState,$PIDIssue,$DoB,$PoB,
                        $PerAdd,$TemAdd,$Gender,$name_Image,$ProvinceId,$Tel,
	$Fax,$Email,$Website,$TaxCode,$Note,$Status,$_SESSION["user_name"],$CreatedDate);
                        if($kq)
                            redirect('welcome/object');
                        else
                            $data['loi']='Add unsuccessful';
            }
        $this->load->helper('form');
        $data['ds_ObjectGroup']=$this->m_object->lay_danh_ObjectGroup();
        $data['ds_ObjectType']=$this->m_object->lay_danh_ObjectType();
        //print_r($data['ds_loai']);
        
        $data['path'] = array('object/v_insert');
        $this->load->view('v_welcome.php',$data);
	}
    public function delete()
	{
	   $id=$this->uri->segment(3);
       if(isset($id))
            $this->m_object->xoa_object($id);
       //echo $id;die;
	   redirect('welcome/object');
	}
     public function edit()
	{
	   $id=$this->uri->segment(3);
       $data['Object']=$this->m_object->lay_object_theo_id($id);
	   $this->load->library('form_validation');
        $this->form_validation->set_rules('FullName','FullName','required');
        $this->form_validation->set_message('required','<span style="color:red">%s not null</span>');
        //$this->form_validation->set_message('integer','<span style="color:red">%s is number</span>');
            if($this->input->post('submit')) //chay va kiem tra gia tri cua form
            {
                //echo "dfdf";die;
                //$ObjectID=$this->input->post('ObjectID');
                $ObjectGroup=$this->input->post('ObjectGroup');
                $ObjectType=$this->input->post('ObjectType');
                $int=(string)"11".date("Y").date("m").date("d");
                $max_objectid=$this->m_object->max_objectid($int);
                if($max_objectid->max!='')
                {
                    $tam=(int)substr($max_objectid->max,-6);
                    $dau=(string)substr($max_objectid->max,0,-6);
                    //echo $dau;die;
                    $tam+=1;
                    $arr_str=array(
                                    "1"=>"00000",
                                    "2"=>"0000",
                                    "3"=>"000",
                                    "4"=>"00",
                                    "5"=>"0",
                                    "6"=>"",
                    );
                    $ObjectID=$dau.(string)$arr_str[strlen($tam)].(string)$tam;
                    //echo $ObjectID;die;
                }
                else
                    $ObjectID=$int."000001";
                $FullName=$this->input->post('FullName');
                $PID=$this->input->post('PID');
                if($this->input->post('PIDState'))
                {
                    $ngayPID=explode("/",$this->input->post('PIDState'));
                    $PIDState=date("Y-m-d h:m:s",mktime(0,0,0,$ngayPID[0],$ngayPID[1],$ngayPID[2]));
                }
                else
                    $PIDState="";
                    
                //echo $PIDState;die;
                $PIDIssue=$this->input->post('PIDIssue');
                if($this->input->post('DoB'))
                {
                    $ngayDoB=explode("/",$this->input->post('DoB'));
                    $DoB=date("Y-m-d h:m:s",mktime(0,0,0,$ngayDoB[0],$ngayDoB[1],$ngayDoB[2]));
                }
                else
                    $DoB="";
                //$DoB=$this->input->post('DoB');
                $PoB=$this->input->post('PoB');
                $PerAdd=$this->input->post('PerAdd');
                $TemAdd=$this->input->post('TemAdd');
                $Gender=$this->input->post('Gender');
                $Image=$this->input->post('Image');
                
                $ProvinceId=$this->input->post('ProvinceId');
                $Tel=$this->input->post('Tel');
                $Fax=$this->input->post('Fax');
                $Email=$this->input->post('Email');
                $Website=$this->input->post('Website');
                $TaxCode=$this->input->post('TaxCode');
                $Note=$this->input->post('Note');
                $Status=$this->input->post('Status');
                $CreatedDate=date("Y-m-d h:m:s");
                //echo $CreatedDate;die;
                
                //$ngaycapnhat=dmy_to_ymd($ngaycapnhat);
                //$Image=$_FILES['hinh'];
                //move_uploaded_file($Image['tmp_name'],'./public/hinh_tam/'.$Image['name']);
                $Image=$_FILES['Image'];
                if($Image['name']!='') // co hinh vip moi
				{
				    include_once('public/kiem_tra_hinh_upload.php');
					$kt2 = kiem_tra_hinh($Image); //kiem_tra_hinh_upload.php truyen file hinh
					if($kt2=='') // hinh vip moi hop le
					{
						$name_Image = time()."_".$Image['name'];
						move_uploaded_file($Image['tmp_name'],'public/images/objects/'.$name_Image);
					}
					else // hinh vip moi khong hop le   
                        $data['loi']='Figure invalid';
				}
                else
                    $name_Image=$data['Object']->Image;
                
                $kq=$this->m_object->update_object($id,$ObjectGroup,$ObjectType,$FullName,$PID,$PIDState,$PIDIssue,$DoB,$PoB,
                        $PerAdd,$TemAdd,$Gender,$name_Image,$ProvinceId,$Tel,
	$Fax,$Email,$Website,$TaxCode,$Note,$Status,$_SESSION["user_name"],$CreatedDate);
                        if($kq)
                            redirect('welcome/object');
                        else
                            $data['loi']='Update failed';
            }
        $this->load->helper('form');
        $data['ds_ObjectGroup']=$this->m_object->lay_danh_ObjectGroup();
        $data['ds_ObjectType']=$this->m_object->lay_danh_ObjectType();
        //print_r($data['ds_loai']);
        
        $data['path'] = array('object/v_update');
        $this->load->view('v_welcome.php',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */