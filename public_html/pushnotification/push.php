<?php
session_start();
//include("/var/www/vhosts/cooperativadoc.it/childrenpark.cooperativadoc.it/libreria_mailer/PHPMailerAutoload.php");
include("./class-db.php");
include("./class-push.php");

$push = new Push_Notification("localhost", "qualita", "qualita", "00qQUFDTOlKl6O3", true);



$push->Q_site       = $_REQUEST['site'];
$push->Q_id         = $_REQUEST['id'];
$push->pushType     = $_REQUEST['tipo'];
$push->pushRefer    = $_REQUEST['refer'];


// SETTO GLI UTENTI CHE RICEVERANNO LA NOTIFICA
$push->pushTags = array(array('key' => $push->setKeySite(), 'relation' => '=', 'value' => '1'));

// SETTO IL GIUDIZIO COMPLESSIVO DELLA NOTIFICA ...  SERVE PER IL TESTO DA MANDARE 

$push->setGiudizio();

// PREPARO IL TESTO DELLA NOTIFICA
$push->setPushText();

// INVIO LA NOTIFICA 
$push->sendNotification();

// SALVO LA NOTIFICA NELLA TABELLA COMMUNICAZIONI 
$push->savePush();


?>