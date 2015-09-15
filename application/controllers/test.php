<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Test extends CI_Controller
{
       function __construct()
       {
            parent::__construct();

            //$this->load->model('m_index');
            //$this->load->model('m_mail');
            //$this->load->model('admin/m_test');

            $this->load->model('m_index');
            $this->load->model('m_mail');
            $this->load->model('m_sms');
            $this->load->model('admin/m_test');

       }
       
       public function index(){
            
            $this->load->view('ViewTest1');
       }
       public function usetsession($name){
           unset($_SESSION[$name]);
       }
       public function testCT($tel){
           
           $res = $this->m_sms->CheckTel($tel);
           echo "<pre>";
           print_r($res);
           echo "</pre>";
       }
       
       public function SetPriceStatus(){
           
           $res = $this->m_sms->SetPriceStatus();
           echo "<pre>";
           print_r($res);
           echo "</pre>";
           
       }
       public function testSMSbk(){
           
           $res = $this->m_sms->SendSMSBookingSuccess('9920150119000002');
           echo "<pre>";
           print_r($res);
           echo "</pre>";
       }
       public function testSMS($tel){
           
           $res = $this->m_sms->SendSMS('Test bang WS... lan 3',$tel);
           echo "<pre>";
           print_r($res);
           echo "</pre>";
       }
       
       public function showseesion($name){
           echo "<pre>";
           print_r($_SESSION[$name]);
           echo "</pre>";
       }
       
       public function mulitiDB(){
           //$val = $this->m_test->MulitiDB();
            $sql="SELECT a.`bookingID`, a.`CreatedBy`, c.`FullName`
FROM `spabooking`.`booking` a INNER JOIN `thebooking`.`users` b ON a.`CreatedBy` = b.`UserId`
    INNER JOIN `thebooking`.`objects` c ON b.`ObjectId` = c.`ObjectId`";
            $cap1 =$this->db->query($sql)->result();
            $arr1 = (array) $cap1;
           echo "<pre>";
           print_r($arr1);
           echo "</pre>";
       }
       
       public function GetSetting($key)
       {
           $val= $this->m_mail->GetSetting($key);
           echo $val;
       }
       public function unsetsession($sessionname)
       {
           unset($_SESSION[$sessionname]);
       }
       public function GetMailTemplate()
       {
        $body = $this->m_mail->GetMailTemplate("BookingSuccess");
        str_replace("[FullName]","Kim Thuan Nguyen Ngoc", $body);
        echo $body;
       }
       
       public function sendmail(){            
           //require 'PHPMailerAutoload.php';
            $mail = $this->m_mail->CreateMail();

            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->addAddress('occbuu@gmail.com', 'Hao Lee');     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            
            $mail->addCC('thuan.nguyenngockim@gmail.com');
            $mail->addCC('huunghia1810@gmail.com');
            //$mail->addBCC('bcc@example.com');

            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Hello From The Booking...';
            $body = $this->m_mail->GetMailTemplate("BookingSuccess");
            $body = str_replace("[FullName]","Kim Thuan Nguyen Ngoc", $body);
            $mail->Body    = $body;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }
       }
       
       public function test01()
       {
           $data = $_POST['ObjectSend'];
           $arr = array("Return"=>" hsadh askjdhasdaslk");
           //echo $data;//->{spaID};
           $str = json_encode($arr);           
           echo $str;
       }
       public function register(){
            $this->load->view('register');
       }
       public function listkind()
       {
            $req = $this->m_index->listkind();
            echo json_encode($req);
       }
       public function listplaceadv()
       {
            $res['loaispcon'] = $this->m_index->listplaceadv();
            /*echo "<pre>";
            print_r($res['loaispcon']);
            echo "</pre>";
            die;*/
       }
       public function listplace()
       {
            $req = $this->m_index->listplace();
            echo json_encode($req);
       }
       public function actionlogin()
       {
            $req = $this->m_index->actionlogin();
            echo json_encode($req);
       }
       //kiem tra session user khi lan dau load trang
       public function checkuser()
       {
            if(isset($_SESSION['AccUser']['user_name']))
            {
                $res = array("check"=>"yes","user_name"=>$_SESSION['AccUser']['user_name'],"sodong"=>1);
            }
            else
            {
                $res = array("check"=>"no","user_name"=>"","sodong"=>0);
            }
            echo json_encode($res);
       }
       //thoat dang nhap user
       public function actionlogout()
       {
            if(isset($_SESSION['AccUser']['user_name']))
            {
                unset($_SESSION['AccUser']['user_name']);
                $res = array("check"=>"yes");
            }else
                $res = array("check"=>"no");
            echo json_encode($res);
       }
       public function getdetailpro()
       {
            $req = $this->m_index->getdetailpro();
            echo json_encode($req);
       }
       public function laycmt()
       {
            //$id=$_POST['Id'];
            $id="0220141119000002";
            $req = $this->m_index->get_cmt_level1($id);
            /*print_r($req);
            echo count($req);
            die;*/
            $str="";
            if(count($req)>0)
            {
                    foreach($req as $row)
                    {
                        $str.='<div class="wrap-2cols nav-left wrap-review">';
                            $str.='<div class="col-nav">';
                                $str.='<div class="wrap-thumb" style="background-image:url('.base_url('resources/front/images/no-pic-avatar.png').');"></div>';
                            $str.='</div>';
                            $str.='<div class="col-content">';
                                $str.='<div class="content">';
                                    $str.='<table width="100%" border="0" cellspacing="0" cellpadding="2">';
                                      $str.='<tbody><tr>';
                                        $str.='<td><strong>'.$row->CreatedBy.'</strong></td>';
                                        $str.='<td align="right"><span class="small">Posted 4 weeks ago</span></td>';
                                      $str.='</tr>';
                                      $str.='<tr>';
                                        $str.='<td>&nbsp;</td>';
                                        $str.='<td align="right"><small class="small">Visisted October 2014</small></td>';
                                      $str.='</tr>';
                                      $str.='<tr>';
                                        $str.='<td colspan="2">'.$row->Content.'</td>';
                                      $str.='</tr>';
                                      $str.='<tr>';
                                        $str.='<td colspan="2" align="right"><a href="javascript:void(0)" onclick="';
                                        $str.="$('#wrap-add-comment2-popup')";
                                        $str.='.toggle(300);">Comment</a></td>';
                                      $str.='</tr>';
                                      $str.='<tr>';
                                        $str.='<td colspan="2">';
                                            $str.='<div id="wrap-add-comment2-popup" style="display: none" class="wrap-add-comment">';
                                                $str.='<form role="form">';
                                                    $str.='<div class="form-group">';
                                                        $str.='<label>N?i dung b?nh lu?n</label>';
                                                        $str.='<textarea class="form-control" rows="3"></textarea>';
                                                    $str.='</div>';
                                                    $str.='<button type="submit" class="btn btn-default pull-right">G?i b?nh lu?n</button>';
                                                $str.='</form>';
                                              $str.='</div>';
                                        $str.='</td>';
                                      $str.='</tr>';
                                      
                                    $str.='</tbody></table>';
        
                                $str.='</div>';
                            $str.='</div>';
                        $str.='</div>';
                    }
            }
            //echo $str;die;
            $res = array("check"=>"yes");
            echo json_encode($res);
       }
       public function actionregister()
       {
            $req = $this->m_index->actionregister();
            echo json_encode($req);
       }
       
}
?>