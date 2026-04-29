<?

include("/var/www/vhosts/cooperativadoc.it/qualita.cooperativadoc.it/progettoscuolanatura/class/class-db.php");
include("/var/www/vhosts/cooperativadoc.it/qualita.cooperativadoc.it/progettoscuolanatura/class/sendEmail.php");
include("/var/www/vhosts/cooperativadoc.it/qualita.cooperativadoc.it/progettoscuolanatura/lang.php");
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

if (!$_REQUEST['id'])
    $_REQUEST['id'] = "5";

$SN = new MySql_DB("localhost", "qualita", "qualita", "00qQUFDTOlKl6O3", true);

$query = "SELECT sn.* , r.nome as n_ruolo , f.nome as n_focus, p.nome as n_percorso  FROM sn_preiscrizioni as sn
LEFT JOIN sn_ruoli As r  ON sn.ruolo = r.id
LEFT JOIN sn_percorsi AS p ON sn.percorso = p.id
LEFT JOIN sn_focus AS f  ON sn.focus = f.id

WHERE sn.id='" . $_REQUEST['id'] . "'";

$user = $SN->FetchArray($SN->Query($query));
require_once "./libreria_qrcode/qrlib.php";

$code = $user['id'] . "_" . generateCode();
$url = "http://qualita.cooperativadoc.it/progettoscuolanatura/validate.php?code=" . $code;
QRcode::png($url, "./code/" . $code . ".png", "H", "4", 2);

#CONTEGGIO 
$totale = $SN->SingleField("COUNT(id)", "sn_preiscrizioni", "WHERE percorso ='" . $user['percorso'] . "'  AND id !='" . $user['id'] . "'");
if ($totale >= '75') {
    $stato = "R";
    $testo = "<b>NB:&nbsp;</b>Purtroppo la sua richiesta eccede il numero di posti disponibili per il tour guidato,<br /> verificheremo il giorno del convegno se sar&agrave; possibile accettare la richiesta";
} else {
    $stato = "C";
    $testo = "";
}

$SN->Query("UPDATE sn_preiscrizioni SET code='" . $code . "' , percorso_stato='" . $stato . "'   WHERE id= '" . $user['id'] . "' ");

// PREPARO PDF SCHEDA SANITARIA
require_once "./voucher.php";
require_once('./libreria_html2pdf/html2pdf.class.php');

$html2pdf = new HTML2PDF('P', 'A4', 'fr');
$html2pdf->WriteHTML($content);

$fileName = "la_scuola_oltre_la_scuola_" . $code . ".pdf";
$html2pdf->Output("./tmp/" . $fileName, "F");


if (chmod("./tmp/" . $fileName, 0777)) {
    // MANDO LA MAIL

    $mailText = $SN->SingleField("valore", "config", "WHERE id ='15'");
    $mailText = str_replace("[DATA]", date("d") . " " . date("m") . " " . date("Y"), $mailText);
    $mailText = str_replace("[NOME]", $user['nome'], $mailText);
    $mailText = str_replace("[COGNOME]", $user['cognome'], $mailText);
    $mailText = str_replace("[TESTO]", $testo, $mailText);

    
    $mail3 = new PHPMailer;
    $mail3->isSMTP();
    
    $mail3->SMTPDebug = 0;
    $mail3->Debugoutput = 'html';
    $mail3->Host = "mail.archynet.it";
    $mail3->Port = 25;
    $mail3->SMTPAuth = true;
    $mail3->Username = "coopdoc@archynet.it";
    $mail3->Password = "smtpcoopdoc#1";
    $mail3->Subject = 'Conferma iscrizione convegno la scuola oltre la scuola';
    $mail3->setFrom('ED.eventoscuolanatura@comune.milano.it', 'Scuola natura comune milano');
    $mail3->addReplyTo('ED.eventoscuolanatura@comune.milano.it', 'Scuola natura comune milano');
    $mail3->msgHTML($mailText, dirname(__FILE__), true);
    $mail3->AltBody = $mailText;
    $mail3->addAddress('djamal@archynet.it', 'Adoum Djamal');
    $mail3->addAttachment('./tmp/' . $fileName);
    $mail3->send();
    
    /*
    $mail1 = new PHPMailer;
    $mail1->isSMTP();

    $mail1->SMTPDebug = 0;
    $mail1->Debugoutput = 'html';
    $mail1->Host = "mail.archynet.it";
    $mail1->Port = 25;
    $mail1->SMTPAuth = true;
    $mail1->Username = "coopdoc@archynet.it";
    $mail1->Password = "smtpcoopdoc#1";
    $mail1->Subject = 'Conferma iscrizione convegno la scuola oltre la scuola';
    $mail1->setFrom($user['email'], $user['nome'] . " " . $user['cognome']);
    $mail1->addReplyTo($user['email'], $user['nome'] . " " . $user['cognome']);
    $mail1->msgHTML($mailText, dirname(__FILE__), true);
    $mail1->AltBody = $mailText;
    $mail1->addAddress('mario.ferretti@cooperativadoc.it', 'Mario Ferretti');
    $mail1->addAttachment('./tmp/' . $fileName);
    $mail1->send();

   
      $mail2 = new PHPMailer;
      $mail2->isSMTP();
      $mail2->SMTPDebug = 0;
      $mail2->Debugoutput = 'html';
      $mail2->Host = "mail.archynet.it";
      $mail2->Port = 25;
      $mail2->SMTPAuth = true;
      $mail2->Username = "coopdoc@archynet.it";
      $mail2->Password = "smtpcoopdoc#1";
      $mail2->Subject = 'Conferma iscrizione convegno la scuola oltre la scuola';
      $mail2->setFrom($user['email'], $user['nome'] . " " . $user['cognome']);
      $mail2->addReplyTo($user['email'], $user['nome'] . " " . $user['cognome']);
      $mail2->msgHTML($mailText, dirname(__FILE__), true);
      $mail2->AltBody = $mailText;
      $mail2->addAddress('ED.eventoscuolanatura@comune.milano.it', 'Scuola natura comune milano');
      $mail2->addAttachment('./tmp/' . $fileName);
      $mail2->send();


    
      $mailC = new PHPMailer;
      $mailC->isSMTP();

      $mailC->SMTPDebug = 0;
      $mailC->Debugoutput = 'html';
      $mailC->Host = "mail.archynet.it";
      $mailC->Port = 25;
      $mailC->SMTPAuth = true;
      $mailC->Username = "coopdoc@archynet.it";
      $mailC->Password = "smtpcoopdoc#1";
      $mailC->Subject = 'Conferma iscrizione convegno la scuola oltre la scuola';
      $mailC->setFrom('ED.eventoscuolanatura@comune.milano.it', 'Scuola natura comune milano');
      $mailC->setFrom('ED.eventoscuolanatura@comune.milano.it', 'Scuola natura comune milano');
      $mailC->msgHTML($mailText, dirname(__FILE__), true);
      $mailC->AltBody = $mailText;
      $mailC->addAddress($user['email'], $user['nome'] . " " . $user['cognome']);
      $mailC->addAttachment('./tmp/' . $fileName);
      $mailC->send();
      */
     
}
?>


