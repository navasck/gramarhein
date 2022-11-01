<?php

include('phpmailer.class.php');



if (isset($_POST['submit'])) {

    $mail = new PHPMailer();
    $mail2 = new PHPMailer();
    $mail->IsHTML(true);

    $mail->From = 'cknavas123@gmail.com';
    
    $reply_to = array($_POST['email']);
    $mail->FromName = $_POST['name'];

    $ip = $_SERVER['REMOTE_ADDR'];

         $mail->Subject = "Gramarhein-QUICK ENQUIRY FROM IP ".$ip;

    $toaddress = array('cknavas123@gmail.com');
       
     
    ob_start();

    $fields=array('name'=>'Name',
        'subject'=>'Subject',
'email'=>'Email',
'mob'=>'Phone',
'message'=>'Message',
   );

    require_once('emailer/Enquiry.php');
    $mail->Body = ob_get_contents();
    ob_end_clean();




    foreach ($toaddress as $toAddress) {
        $mail->AddAddress($toAddress);
    }
    foreach ($reply_to as $reply) {
        $mail->AddReplyTo($reply);
    }

    $mail->Send();






    $mail2->IsHTML(true);

    $mail2->From = 'no-reply@gramarhein.com';
    $mail2->FromName = 'Gramarhein';


    $mail2->Subject = "Your Enquiry Submitted Successfully";



    ob_start();
    require_once('emailer/Successful-message.php');
    $mail2->Body = ob_get_contents();
    ob_end_clean();

    $mail2->AddAddress($_POST['email']);

    $mail2->Send();
  header('location:../thank-you.html');
} 