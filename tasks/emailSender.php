<?php 
require "PHPMailer/PHPMailerAutoload.php";

function sendEmail($subject,$sender,$sender_name,$to,$msg){
  


$mail = new PHPMailer();

// SMTP settings
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = "ishyigasoftware900@gmail.com";
$mail->Password = 'ishyigasoftware2020';
$mail->Port = 465;    //587
$mail->SMTPSecure = "ssl";   // tls

// Email settings
$mail->isHTML(true);       
$mail->setFrom($sender, $sender_name);      // specify who sending email (sender)
$mail->addAddress($to);    // specify where email sended (reciever)
$mail->Subject = $subject;
 
   $mail->Body = $msg;
   if($mail->send())
      return true;
    else
      return false;

}

   

?>