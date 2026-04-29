<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include(__DIR__."/../vendor/autoload.php");

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->Host = "smtp.office365.com";
$mail->Port = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->SMTPAuth = true;
$mail->Username = "iscrizioni@stessopiano.it";
$mail->Password = "J*776888663017uc";
$mail->Subject = 'test';
$mail->setFrom('iscrizioni@stessopiano.it', 'Booking Stessopiano.it');
//$mail->addReplyTo($dati['email'], $dati['nome'] . " " . $dati['cognome']);
$mail->msgHTML('test', dirname(__FILE__), true);
$mail->AltBody = 'test';
$mail->addAddress('tech@messageglobe.it');
//$mail->addAttachment('./tmp/' . $fileName);
$mail->send();

?>
