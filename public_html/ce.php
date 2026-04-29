<?php
    require_once __DIR__.'/vendor/autoload.php';

    $mail = new \PHPMailer\PHPMailer\PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
    $mail->Debugoutput = 'error_log';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.office365.com";
    $mail->Port = 587;
    $mail->Username = "form@cooperativadoc.it";
    $mail->Password = "Docscs325!";
    $mail->Subject = $oggetto;
    $mail->setFrom('form@cooperativadoc.it', 'Booking Sh-Sharing');
    $mail->addReplyTo('booking@sh-sharing.it', 'Booking Sh-Sharing');
    $mail->msgHTML('test', dirname(__FILE__), true);
    $mail->AltBody = 'test';
    //$mail->addAttachment($allegato);
    $mail->addAddress('dedalus80@gmail.com', '');
    $mail->send();
?>