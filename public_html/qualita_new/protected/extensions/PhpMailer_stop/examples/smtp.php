<?php
echo "Start";
/**
 * This example shows making an SMTP connection with authentication.
 */
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require '../PHPMailerAutoload.php';


echo"1";

$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->Host = "mail.archynet.it";
$mail->Port = 25;
$mail->SMTPAuth = true;
$mail->Username = "coopdoc@archynet.it";
$mail->Password = "smtpcoopdoc#1";

$mail->setFrom('booking@cooperativadoc.it', 'Booking Children Park');
echo"2";
$mail->addReplyTo('booking@cooperativadoc.it', 'Booking Children Park');
echo"3";
$mail->addAddress('djamal@archynet.it', 'Adoum Djamal');
echo"4";
$mail->Subject = 'Conferma Prenotazione visita Children Park';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
#$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

echo "Stop";