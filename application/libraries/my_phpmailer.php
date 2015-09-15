<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_phpmailer {
    var $mail;
     public function __construct()
    {
        require_once('PHPMailer/PHPMailerAutoload.php');
 
        // the true param means it will throw exceptions on errors, which we need to catch
        $this->mail = new PHPMailer(true);
 
        $this->mail->IsSMTP(); // telling the class to use SMTP
 
        $this->mail->CharSet = "utf-8";                  // 一定要設定 CharSet 才能正確處理中文
        $this->mail->SMTPDebug  = 0;                     // enables SMTP debug information
        $this->mail->SMTPAuth   = true;                  // enable SMTP authentication
        $this->mail->SMTPSecure = "tls";                 // sets the prefix to the servier
        $this->mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $this->mail->Port       = 465;                   // set the SMTP port for the GMAIL server
        $this->mail->Username   = "thuan.nguyenngockimthuan@gmail.com";// GMAIL username
        $this->mail->Password   = "08158291";       // GMAIL password
        $this->mail->AddReplyTo('thuan.nguyenngockimthuan@gmail.com', 'kim thuân');
        $this->mail->SetFrom('thuan.nguyenngockimthuan@gmail.com', 'kimthuan');
    }
 
    public function sendmail($to, $to_name, $subject, $body){
        try{
            $this->mail->AddAddress($to, $to_name);
 
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;
 
            $this->mail->Send();
                echo "Message Sent OK</p>\n";
 
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
        }
    }
}