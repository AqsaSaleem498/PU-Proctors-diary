<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
function sendMail($to,$subject,$message){
$mail=new PHPMailer(true);
try{
$mail->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->SMTPAuth=true;
$mail->Username='puproctorsdiary@gmail.com';
$mail->Password='esnn wonj vfmh qejj';
$mail->SMTPSecure='tls';
$mail->Port=587;
$mail->setFrom(
'puproctorsdiary@gmail.com',
'PU Proctors Diary'
);
$mail->addAddress($to);
$mail->isHTML(true);
$mail->Subject=$subject;
$mail->Body=$message;
$mail->send();
return true;
}
catch(Exception $e){
die($mail->ErrorInfo);
 }
}
?>