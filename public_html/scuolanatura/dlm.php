<?php

include("../lib/class-db.php");
include("../lib/fpdf.php");
include("../lib/sendEmail.php");
include("./lang.php");
include("/var/www/vhosts/cooperativadoc.it/childrenpark.cooperativadoc.it/libreria_mailer/PHPMailerAutoload.php");

function generateCode($lunghezza = '8') {
    $tipo = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F", "G", "H", "M", "N", "P", "Q", "R", "S", "T", "U", "V", "Z");
    $possibilita = sizeof($tipo);
    $code = "";
    for ($x = 0; $lunghezza > $x; $x++) {
        $num = rand(0, $possibilita - 1);
        $code .= $tipo[$num];
    }
    return $code;
}

function cleanText($text) {

    $t = str_replace("à", "&agrave;", $text);  
    $t = str_replace("ù", "&ugrave;", $t);
    $t = str_replace("è", "&egrave;", $t);
    $t = str_replace("ì", "&igrave;", $t);
    $t = str_replace("ò", "&ograve;", $t);
    return $t;
}



$db = new MySql_DB('localhost', 'qualita_scuolanaturamilano', 'qualitaSNM', 'kVz$h159', true);
$user = $db->FetchArray($db->Query("SELECT * FROM iscrizioni_dicolamia WHERE id='" . $_REQUEST['id'] . "'"));

require_once "./libreria_qrcode/qrlib.php";

$code = $user['id'] . "_" . generateCode();

// Aggiorno il qrcode
$db->Query("UPDATE iscrizioni_dicolamia SET code ='" . $code . "' WHERE id ='" . $_REQUEST['id'] . "'");

$url = "https://qualita.cooperativadoc.it/scuolanatura/validate.php?code=" . $code;
QRcode::png($url, "./code/" . $code . ".png", "H", "4", 2);

// PREPARO PDF SCHEDA SANITARIA
require_once "./voucher.php";
require_once('./libreria_html2pdf/html2pdf.class.php');

$html2pdf = new HTML2PDF('P', 'A4', 'fr');
$html2pdf->WriteHTML($content);

$fileName = "iscrizione_dicolamia_" . $_REQUEST['id'] . ".pdf";
$html2pdf->Output("./tmp/" . $fileName, "F");

if (chmod("./tmp/" . $fileName, 0777)) {
    // MANDO LA MAIL

    $oggetto = $db->SingleField("txt", "_config", "WHERE val_key ='OGGETTO-CASAMIA' ");
    $email = $db->SingleField("txt", "_config", "WHERE val_key='EMAIL-CASAMIA' ");
    $email = str_replace("[DATA]", $data, $email);
    $email = str_replace("[NOME]", utf8_decode($q['nome']), $email);
    $email = str_replace("[COGNOME]", utf8_decode($q['cognome']), $email);
    
    
    /*
    $mailA = new PHPMailer;
    $mailA->isSMTP();
    $mailA->SMTPDebug = 0;
    $mailA->Debugoutput = 'html';
    $mailA->Host = "smtp.office365.com";
    $mailA->Port = 587;
    $mailA->SMTPAuth = true;
    $mailA->Username = "progettoscuolanatura@cooperativadoc.it";
    $mailA->Password = "Keluar*03";
    $mailA->Subject = $oggetto;
    $mailA->setFrom('ED.EventoScuolaNatura@comune.milano.it', 'Convegno Scuola Natura: Casa Mia è il Mondo ');
    $mailA->addReplyTo('ED.EventoScuolaNatura@comune.milano.it', 'Convegno Scuola Natura: Casa Mia è il Mondo ');
    $mailA->msgHTML($email, dirname(__FILE__), true);
    $mailA->AltBody = $email;
    $mailA->addAddress('mario.ferretti@cooperativadoc.it', 'Mario Ferretti');
    $mailA->addAttachment('./tmp/' . $fileName);
    $mailA->addAttachment('./tmp/Programma_convegno_4_02_2017.pdf');
    $mailA->send();

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = 'html';
    $mail->Host = "mail.archynet.it";
    $mail->Port = 25;
    $mail->SMTPAuth = true;
    $mail->Username = "coopdoc@archynet.it";
    $mail->Password = "smtpcoopdoc#1";
    $mail->Subject = $oggetto;
    $mail->setFrom('ED.EventoScuolaNatura@comune.milano.it', 'Convegno Scuola Natura: Casa Mia è il Mondo ');
    $mail->addReplyTo('ED.EventoScuolaNatura@comune.milano.it', 'Convegno Scuola Natura: Casa Mia è il Mondo ');
    $mail->msgHTML($email, dirname(__FILE__), true);
    $mail->AltBody = $email;
    $mail->addAddress('rosalia.castiglioni@comune.milano.it', 'Rosalia Castiglioni');
    $mail->addAttachment('./tmp/' . $fileName);
    $mail->addAttachment('./tmp/Programma_convegno_4_02_2017.pdf');
    $mail->send();
    
    
    $mailM = new PHPMailer;
    $mailM->isSMTP();
    $mailM->SMTPDebug = 0;
    $mailM->Debugoutput = 'html';
    $mailM->Host = "mail.archynet.it";
    $mailM->Port = 25;
    $mailM->SMTPAuth = true;
    $mailM->Username = "coopdoc@archynet.it";
    $mailM->Password = "smtpcoopdoc#1";
    $mailM->Subject = $oggetto;
    $mailM->setFrom('ED.EventoScuolaNatura@comune.milano.it', 'Convegno Scuola Natura: Casa Mia è il Mondo ');
    $mailM->addReplyTo('ED.EventoScuolaNatura@comune.milano.it', 'Convegno Scuola Natura: Casa Mia è il Mondo ');
    $mailM->msgHTML($email, dirname(__FILE__), true);
    $mailM->AltBody = $email;
    $mailM->addAddress($user['email'], $user['nome'] . " " . $user['cognome']);
    $mailM->addAttachment('./tmp/' . $fileName);
    $mailM->addAttachment('./tmp/Programma_convegno_4_02_2017.pdf');
    $mailM->send();
    
     * 
     */
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
    $mailC->setFrom('ed.estatevacanza@comune.milano.it', 'Convegno Scuola Natura: Dico La Mia ');
    $mailC->addReplyTo('ed.estatevacanza@comune.milano.it', 'Convegno Scuola Natura: Dico La Mia ');
    $mailC->msgHTML($email, dirname(__FILE__), true);
    $mailC->AltBody = $email;
    $mailC->addAddress('djamal@archynet.it', 'Adoum Djamal');
    //$mailC->addAttachment('./tmp/' . $fileName);
    $mailC->addAttachment('./tmp/Programma_convegno_4_02_2017.pdf');
    $mailC->send();
}
?>