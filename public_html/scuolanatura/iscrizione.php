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

$refer = $_REQUEST['refer'];

switch($refer){
    
     case "ns":
        $table ='iscrizioni_nuovesfide';
        $fileName = "preiscrizione_convegno_le_nuove_sfide_";
        $OGGETTO  = "OGGETTO-NUOVESFIDE";
        $EMAILTEXT = "EMAIL-NUOVESFIDE";
        $TESTO ="Grazie per aver provveduto alla richiesta di iscrizione al Convegno, seguir&agrave; conferma di partecipazione inviata all'indirizzo mail indicato.</span> ";
        
        break;    
        
    case "vdg":
        $table ='iscrizioni_leviedelgusto';
        $fileName = "preiscrizione_convegno_le_vie_del_gusto_";
        $OGGETTO  = "OGGETTO-LEVIEDELGUSTO";
        $EMAILTEXT = "EMAIL-LEVIEDELGUSTO";
        $FROM = "Le vie del gusto e della biodiversità - Università Scienze Gastronomiche slow food di POLLENZO";
        $TESTO ='Grazie per aver formulato la sua richiesta di prenotazione all\'Educational Le vie del Gusto e della Biodiversità |Pollenzo (Cn) | 24 marzo 2018<br>A causa della disponibilità limitata di posti le domande saranno accolte  rispettando l\'ordine di arrivo delle richieste.<br>A breve la contatteremo via mail solo nel caso la sua  partecipazione venisse confermata.</span> ';
        break;
    
    case "cas":
        $table ='iscrizioni_casamia';
        $fileName = "preiscrizione_convegno_torna_in_citta_";
        $OGGETTO  = "OGGETTO-CASAMIA";
        $EMAILTEXT = "EMAIL-CASAMIA";
        $FROM = 'Tavola Rotonda Scuola Natura:  Minori e diritto alla salute: partecipazione e competenze di bambini e adolescenti';
        $TESTO ='Grazie per la Sua iscrizione al Convegno<br <br><br><br>Tavola Rotonda<br><br>
        Minori e diritto alla salute: partecipazione<br/>e competenze di bambini e adolescenti<br />Fabbrica del Vapore |  Via Procaccini, 4 MILANO<br />22 Novembre 2017 | dalle ore 16.00 alle 18.00</span> ';
        break;
}

$db = new MySql_DB('localhost', 'qualita_scuolanaturamilano', 'qualitaSNM', 'kVz$h159', true);
$user = $db->FetchArray($db->Query("SELECT * FROM ".$table." WHERE id='" . $_REQUEST['id'] . "'"));


if($table =='iscrizioni_nuovesfide'){
    $totale = $db->SingleField("COUNT(id)",$table," WHERE 1 ");
    if($totale > 120 ){
        $TESTO = "Grazie per aver provveduto alla richiesta di iscrizione al Convegno, Le comunichiamo che abbiamo gi&agrave; raggiunto la disponibilit&agrave; massima per l'evento che sar&agrave; soggetta a riconferma da parte dei partecipanti.Sar&agrave; nostra cura confermare l'iscrizione mediante mail in caso di nuove disponibilit&agrave; </span>";
    }
}




require_once "./libreria_qrcode/qrlib.php";

$code = $user['id'] . "_" . generateCode();

// Aggiorno il qrcode
$db->Query("UPDATE ".$table." SET code ='" . $code . "' WHERE id ='" . $_REQUEST['id'] . "'");

$url = "https://qualita.cooperativadoc.it/scuolanatura/validate.php?refer=".$refer."code=" . $code;
QRcode::png($url, "./code/" . $code . ".png", "H", "4", 2);

// PREPARO PDF SCHEDA SANITARIA
require_once "./voucher.php";
require_once('./libreria_html2pdf/html2pdf.class.php');

$html2pdf = new HTML2PDF('P', 'A4', 'fr');
$html2pdf->WriteHTML($content);

$fileName .=  $_REQUEST['id'] . ".pdf";
$html2pdf->Output("./tmp/" . $fileName, "F");

if (chmod("./tmp/" . $fileName, 0777)) {
    // MANDO LA MAIL
    
    $oggetto = $db->SingleField("txt", "_config", "WHERE val_key ='".$OGGETTO."' ");
    $email = $db->SingleField("txt", "_config", "WHERE val_key='".$EMAILTEXT."' ");
    $email = str_replace("[DATA]", $data, $email);
    $email = str_replace("[NOME]", utf8_decode($q['nome']), $email);
    $email = str_replace("[COGNOME]", utf8_decode($q['cognome']), $email);
    $email = str_replace("[TESTO]", $TESTO, $email);
    
    
    
    $destinatari = array(
        "0" => array("nome" => "Adoum Djamal" , "email" => "djamal@archynet.it"),
        "1" => array("nome" => "Scuola Natura Milano", "email" => "ed.eventoScuolaNatura@comune.milano.it"),
        "2" => array("nome" => "Mario Ferretti", "email" => "mario.ferretti@cooperativadoc.it"),
        "3" => array("nome" => $user['nome']." ".$user['cognome'] , "email" => $user['email']),
        
    );
    
    for($x=0; $x < count($destinatari); $x++){

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 3;
        $mail->Debugoutput = 'html';
        $mail->SMTPAuth = true;
        
        
        $mail->Host = "smtp.office365.com";
        $mail->Port = 587;
        $mail->Username = "eventi@scuolanaturamilano.it";
        #$mail->Password = "Juxa6249";
        $mail->Password = "Docscs325!";
        
        /*
        $mail->Host = "mail.archynet.it";
        $mail->Port = 25;
        $mail->Username = "coopdoc@archynet.it";
        $mail->Password = "smtpcoopdoc#1";
        */
        
        $mail->Subject = $oggetto;
        $mail->setFrom('eventi@scuolanaturamilano.it', $FROM);
        $mail->addReplyTo('ed.eventoScuolaNatura@comune.milano.it',$FROM);
        $mail->msgHTML($email, dirname(__FILE__), true);
        $mail->AltBody = $email;
        $mail->addAddress($destinatari[$x]['email'] , $destinatari[$x]['nome']);
        $mail->addAttachment('./tmp/' . $fileName);
        $table =='iscrizioni_nuovesfide' ? $mail->addAttachment('./tmp/ESEC_programma 2018_revULTIMA4.pdf'):"";
        
        $mail->send();
    }
    
}
?>
