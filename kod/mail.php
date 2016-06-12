<?php
require 'PHPMailer/PHPMailerAutoload.php';
 
$mail = new PHPMailer;
 
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'dejan.pavkovic@gmail.com';
$mail->Password = 'suky89';
$mail->SMTPSecure = 'tls';
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
 
$mail->From = 'dejan.pavkovic@gmail.com';
$mail->FromName = 'Notiflyer';
 
$mail->WordWrap = 50;
$mail->isHTML(true);
?>