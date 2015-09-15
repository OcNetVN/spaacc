<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Indexuser extends CI_Controller
{
       function __construct()
       {
            parent::__construct();
            $this->load->model('m_indexuser');
            $this->load->model('m_useredit');
            $this->load->model('m_index');
            $this->load->model('m_mail');
            $this->db2 = $this->load->database('thebooking', TRUE);
       }
       //0: chua thanh toan ma huy
        //1:chua thanh toan
        //2:da thanh toan
        //3:member da thanh toan ma huy nhung cho xet duyet cua admin
        //4:xac nhan huy cua admin
        //5: xac nhan khong cho huy cua admin
        //6: table booking: co nhieu sp trong 1 booking nhung huy chua het
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
            if(isset($_SESSION['AccUser']))
            {
                $userid=$_SESSION['AccUser']['User']->UserId;
                $data['MenuString'] = $this->m_index->getMenuStr();
                $data['count_bookingid']=$this->m_indexuser->countbookingid();
                //print_r($data['count_bookingid']);die;
                $data['CommentString'] = $this->m_index->getCommentStr();
                $data['ttuser_db2'] = $this->m_indexuser->layuser_db2_theouserid($userid); //lay table user trong database 2
                //print_r($res['ttuser_db2']);die;
                $data['ttuser']=$this->m_useredit->layobjecttheouserid($userid);
                $this->load->view($lang.'/indexuser',$data);
            }
            else
           {
               redirect("index");
           }
       }
       public function loadService()
       {
            if(isset($_SESSION['AccUser']))
            {
                $req = $this->m_indexuser->loadService();
                echo json_encode($req);
            }
            else
           {
               redirect("index");
           }
       }
       public function cancelbooking()
       {
            if(isset($_SESSION['AccUser']))
            {
                $req = $this->m_indexuser->cancelbooking();
                echo json_encode($req);
            }
            else
           {
               redirect("index");
           }
       }
       public function loadhinh()
       {
            if(isset($_SESSION['AccUser']))
            {
                $userid=$_SESSION['AccUser']['User']->UserId;
                $user = $this->m_indexuser->layobjecttheouserid($userid);
                $objectid=$user->ObjectId;
                //echo $objectid;die;
                $listhinh = $this->m_indexuser->layhinhtheoobject($objectid);
                if(count($listhinh)>0)
                {
                    $sd=1;
                    $urlhinh=$listhinh[0]->URL;
                    $arr=array("sd"=>$sd,"urlhinh"=>$urlhinh);
                }
                else
                {
                    $sd=0;
                    $urlhinh="";
                    $arr=array("sd"=>$sd,"urlhinh"=>$urlhinh);
                }
                echo json_encode($arr);
            }
            else
           {
               redirect("index");
           }
       }
       public function ajaxupload()
       {
            $valid_exts = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
            $max_size = 20 * 1024 * 1024; // max file size 20mb
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            	if( ! empty($_FILES['image']) ) {
            	   
            	   $inputobjectid = $_POST['inputobjectid'];
                   
                   $urldelete=base_url("resources/img/user/".$inputobjectid);
                   $this->m_indexuser->rrmdir($urldelete);
                   
                   //echo $inputobjectid;die;
            	   if (!file_exists('resources/img/user/'.$inputobjectid)) {
                        mkdir('resources/img/user/'.$inputobjectid, 0777, true);
                        }
                        $path = "resources/img/user/".$inputobjectid;//'uploads/'; // upload directory
                        $path=$path."/";
            		// get uploaded file extension
            		$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            		// looking for format and size validity
            		if (in_array($ext, $valid_exts) AND $_FILES['image']['size'] < $max_size) {
            			$path = $path . uniqid(). '.' .$ext;
            			// move uploaded file from temp to uploads directory
            			if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
            				//echo "<img src='$path' />";
                            echo '<div style="background-image:url('.$path.');" class="wrap-avatar">
                                </div>';
                            $this->m_indexuser->nsertobjectlinks($inputobjectid,$path);
            			}
            		} else {
            			echo 'Invalid file!';
            		}
            	} else {
            		echo 'File not uploaded!';
            	}
            } else {
            	echo 'Bad request!';
            }
       }
}
?>