<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_sample extends CI_Controller{
    
    function  __construct(){
        parent::__construct();
    }
    
    function send(){
        // Load PHPMailer library
        $this->load->library('phpmailer_lib');
        
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        // print_r($mail);
        
        // SMTP configuration
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
        );
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'flippinskip@gmail.com';
        $mail->Password = 'Sucker11';
        $mail->SMTPSecure = 'tls';
        $mail->Port     = 587;
        
        $mail->setFrom('info@example.com', 'CodexWorld');
        $mail->addReplyTo('info@example.com', 'CodexWorld');
        
        // Add a recipient
        $mail->addAddress('flippinskip@gmail.com');
        
        // Add cc or bcc 
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
        
        // Email subject
        $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
            <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
        $mail->Body = $mailContent;

        // $mail->send();
        
        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }
    }
    

    function ci_email(){
        $this->load->library('email');

        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'mail.amti.com.ph',
            'smtp_port' =>  587,
            'smtp_user' => 'noreply',
            'smtp_pass' => 'password@123',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            // 'SMTPDebug' => 2
        );
        $this->email->initialize($config);
        $this->email->from('flippinskip@gmail.com', 'Pol');
        $this->email->to('pol.kharlo.villa@gmail.com');
        $this->email->cc('another@another-example.com');
        $this->email->bcc('them@their-example.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        //$this->email->send();
        if (!$this->email->send()) {
            echo 'error';
            //echo 'mailer error'. $email->ErrorInfo;
        }else{
            echo 'sent';
        }
    }
}