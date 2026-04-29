<?
include("/var/www/vhosts/cooperativadoc.it/childrenpark.cooperativadoc.it/libreria_mailer/PHPMailerAutoload.php");
$mailC = new PHPMailer;
$mailC->isSMTP();
$mailC->SMTPDebug = 0;
$mailC->Debugoutput = 'html';
$mailC->Host = "mail.archynet.it";
$mailC->Port = 25;
$mailC->SMTPAuth = true;
$mailC->Username = "coopdoc@archynet.it";
$mailC->Password = "smtpcoopdoc#1";
$mailC->Subject = "Errori preiscrizioni Stesso Piano";
$mailC->setFrom('info@stessopiano.it', 'Booking Stessopiano.it');
$mailC->addReplyTo('info@stessopiano.it', 'Booking Stessopiano.it');
$mailC->msgHTML($_REQUEST['errori'], dirname(__FILE__), true);
$mailC->AltBody = $_REQUEST['errori'];
$mailC->addAddress('djamal@archynet.it', 'Adoum Djamal');
$mailC->send();
?>