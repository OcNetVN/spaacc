<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Objects extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/m_object');
    }
	function  CheckQuyen($id)
    {
        // 1: allow New 
        // 2: allow Edit
        // 3: allow Delete
        // 4: allow View
        // 5: allow Print
        // 6: Status
        
        $page = "admin/objects";
        
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
            $this->load->view($lang.'/admin/objects/v_objects.php');
        }
        else
        {
			$this->load->view($lang.'/admin/v_accessdenied');
        }
	}
    public function layobjgroup()
    {
		$ckq = $this->CheckQuyen(4);
        $req = -1;
        if($ckq == true)
        {
			$req = $this->m_object->layobjgroup();
		}
        echo json_encode($req);
    }
    public function layobjtype()
    {
        $ckq = $this->CheckQuyen(4);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_object->layobjtype();
        }
        echo json_encode($req);
    }
    //
    public function search_objects()
    {
        $ckq = $this->CheckQuyen(4);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_object->search_objects();
        }
        echo json_encode($req);
    }
    public function dialogobjects()
    {
        $ckq = $this->CheckQuyen(4);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_object->dialogobjects();
        }
        echo json_encode($req);
    }
    //**
    public function loadobjgroup()
    {
        $req = $this->m_object->loadobjgroup();
        echo json_encode($req);
    }
    public function loadobjtype()
    {
        $req = $this->m_object->loadobjtype();
        echo json_encode($req);
    }
    public function loadrole()
    {
        $req = $this->m_object->loadrole();
        echo json_encode($req);
    }
    //**
    public function btnthem()
    {
         $ckq = $this->CheckQuyen(1);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_object->btnthem();
        }
        //print_r($req);
        echo json_encode($req);
        //$a=json_encode($req);
    }
    public function editobjects()
    {
         $ckq = $this->CheckQuyen(2);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_object->editobjects();
        }
        echo json_encode($req);
    }
    public function btnedit()
    {
         $ckq = $this->CheckQuyen(2);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_object->btnedit();
        }
        echo json_encode($req);
    }
    public function xoaobjects()
    {
         $ckq = $this->CheckQuyen(3);
        $req = -1;
        if($ckq == true)
        {
            $req = $this->m_object->xoaobjects();
        }
        echo json_encode($req);
    }
    //hinh up load hinh
    public function UploadFile($MaDoiTuong){
    //$TM_Con ="";
        $TM_Con = $MaDoiTuong;
                
        $mimes = array(
            'image/jpeg', 'image/png', 'image/gif'
        );
        if (!file_exists('resources/img/objects/'.$TM_Con)) {
        mkdir('resources/img/objects/'.$TM_Con, 0777, true);
        }
        sleep(1);
        if (isset($_FILES['myfile'])) {
            $fileName = $_FILES['myfile']['name'];
            $fileType = $_FILES['myfile']['type'];
            $fileError = $_FILES['myfile']['error'];
            $fileStatus = array(
                'status' => 0,
                'message' => ''    
            );
            if ($fileError== 1) { //Lỗi vượt dung lượng
                $fileStatus['message'] = 'Dung lượng quá giới hạn cho phép';
            } elseif (!in_array($fileType, $mimes)) { //Kiểm tra định dạng file
                $fileStatus['message'] = 'Không cho phép định dạng này';
            } else { //Không có lỗi nào
                move_uploaded_file($_FILES['myfile']['tmp_name'], 'resources/img/objects/'.$TM_Con.'/'.$fileName);                
                // insert vao bang links
                $strURL = 'resources/img/objects/'.$TM_Con.'/'.$fileName;
                $this->m_object->InsertLinks($MaDoiTuong, $strURL);
                                
                $url= 'resources/img/objects/'.$TM_Con.'/'.$fileName;
                $fileStatus['status'] = 1;
                $fileStatus['message'] = "Bạn đã upload $fileName thành công";
                $fileStatus['url'] = $url;
               // $lst_cm = array();
        //                array_push($lst_cm,$cm);
            }    
        echo json_encode($fileStatus);
        exit();        
        }
    }
    public function UploadFile_edit($MaDoiTuong){
    //$TM_Con ="";
        $TM_Con = $MaDoiTuong;
                
        $mimes = array(
            'image/jpeg', 'image/png', 'image/gif'
        );
        if (!file_exists('resources/img/objects/'.$TM_Con)) {
        mkdir('resources/img/objects/'.$TM_Con, 0777, true);
        }
        sleep(1);
        if (isset($_FILES['myfile_edit'])) {
            $fileName = $_FILES['myfile_edit']['name'];
            $fileType = $_FILES['myfile_edit']['type'];
            $fileError = $_FILES['myfile_edit']['error'];
            $fileStatus = array(
                'status' => 0,
                'message' => ''    
            );
            if ($fileError== 1) { //Lỗi vượt dung lượng
                $fileStatus['message'] = 'Dung lượng quá giới hạn cho phép';
            } elseif (!in_array($fileType, $mimes)) { //Kiểm tra định dạng file
                $fileStatus['message'] = 'Không cho phép định dạng này';
            } else { //Không có lỗi nào
                move_uploaded_file($_FILES['myfile_edit']['tmp_name'], 'resources/img/objects/'.$TM_Con.'/'.$fileName);                
                // insert vao bang links
                $strURL = 'resources/img/objects/'.$TM_Con.'/'.$fileName;
                $this->m_object->InsertLinks($MaDoiTuong, $strURL);
                                
                $url= 'resources/img/objects/'.$TM_Con.'/'.$fileName;
                $fileStatus['status'] = 1;
                $fileStatus['message'] = "Bạn đã upload $fileName thành công";
                $fileStatus['url'] = $url;
               // $lst_cm = array();
        //                array_push($lst_cm,$cm);
            }    
        echo json_encode($fileStatus);
        exit();        
        }
    }
     public function gethinhpromotion()
    {
        $req = $this->m_object->get_hinh_promotion();
        //$arr = array("Str"=>$req);
        echo json_encode($req);
    }
    //end upload hinh
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */