<?php

include("/var/www/vhosts/cooperativadoc.it/qualita.cooperativadoc.it/stessopiano/class/class-db.php");
include("/var/www/vhosts/cooperativadoc.it/qualita.cooperativadoc.it/stessopiano/class/fpdf.php");
include("/var/www/vhosts/cooperativadoc.it/qualita.cooperativadoc.it/stessopiano/class/sendEmail.php");
include("/var/www/vhosts/cooperativadoc.it/qualita.cooperativadoc.it/stessopiano/lang.php");
include("/var/www/vhosts/cooperativadoc.it/childrenpark.cooperativadoc.it/libreria_mailer/PHPMailerAutoload.php");

$db = new MySql_DB("localhost", "cooperativa_qualita", "coop_qualita", "coop5369s", true);

$oggetto = "Iscrizione Vacanza dallo Smog";
$email = "Iscrizione nuovo utente <br><br>";

$dati = $db->FetchArray($db->Query("SELECT * FROM cm_preiscrizioni WHERE id='".$_REQUEST['id']."' "));

file("https://qualita.cooperativadoc.it/pushnotification/push.php?site=COM&id=" . $_POST['id']);

foreach ($dati AS $id => $val){
    $email .= $id." === > ".$val." <br />";
}

$mailC = new PHPMailer;
$mailC->isSMTP();
$mailC->SMTPDebug = 0;
$mailC->Debugoutput = 'html';
$mailC->Host = "mail.archynet.it";
$mailC->Port = 25;
$mailC->SMTPAuth = true;
$mailC->Username = "coopdoc@archynet.it";
$mailC->Password = "smtpcoopdoc#1";
$mailC->Subject = $oggetto;
$mailC->setFrom('info@comunemilano.it', 'Booking Comune milano.it');
$mailC->addReplyTo('info@comunemilano.it', 'Booking Comune milano.it');
$mailC->msgHTML($email, dirname(__FILE__), true);
$mailC->AltBody = $email;
$mailC->addAddress('djamal@archynet.it', 'Adoum Djamal');
$mailC->send();
?>