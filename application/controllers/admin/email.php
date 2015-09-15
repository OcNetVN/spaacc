<?php

/**
* SENDS EMAIL WITH GMAIL
*/
class Email extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('My_PHPMailer');
    }
    
    public function send_mail() {
        $mail = new PHPMailer();
        $mail->IsSMTP(); // we are going to use SMTP
        $mail->SMTPAuth   = true; // enabled SMTP authentication
        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
        $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
        $mail->Port       = 465;                   // SMTP port to connect to GMail
        $mail->Username   = "thuan.nguyenngockim@gmail.com";  // user email address
        $mail->Password   = "08158291";            // password in GMail
        $mail->SetFrom('thuan.nguyenngockim@gmail.com', 'Firstname Lastname');  //Who is sending the email
        $mail->AddReplyTo("thuan.nguyenngockim@gmail.com","Firstname Lastname");  //email address that receives the response
        $mail->Subject    = "Email subject";
        $mail->Body      = "HTML message
";
        $mail->AltBody    = "Plain text message";
        $destino = "addressee@example.com"; // Who is addressed the email to
        $mail->AddAddress($destino, "John Doe");

        $mail->AddAttachment("images/phpmailer.gif");      // some attached files
        $mail->AddAttachment("images/phpmailer_mini.gif"); // as many as you want
        if(!$mail->Send()) {
            echo "send not suffl";
        } else {
            echo "Message sent correctly!";
           
        }
        //$this->load->view('sent_mail',$data);
    }
}

?>
      