#!/usr/bin/php
<?
/*
include("../lib/class-db.php");
include("../lib/fpdf.php");
include("../lib/sendEmail.php");
include("./lang.php");
include("/var/www/vhosts/cooperativadoc.it/childrenpark.cooperativadoc.it/libreria_mailer/PHPMailerAutoload.php");


for ($x = 325; $x < 403; $x++) {

    $_REQUEST['id'] = $x;


    $db = new MySql_DB("localhost", "cooperativa_qualita", "coop_qualita", "coop5369s", true);
    $q = $db->FetchArray($db->Query("SELECT * FROM ca_preiscrizioni WHERE id='" . $_REQUEST['id'] . "'"));



    if ($q) {
        if ($q['lang'])
            $lang = $q['lang'];
        else
            $lang = 'it-IT';

        $nf = $_REQUEST['id'];


        $data = date('d') . '/' . date('m') . '/' . date('Y');


        $allegato = "preiscrizione_campussanpaolo_" . $nf . ".pdf";

        $oggetto = $db->SingleField("valore", "config", "WHERE chiave='OGGETTO_" . str_replace("-", "_", $lang) . "_CAMPUSSANPAOLO'");
        $oggetto = str_replace("[NF]", $nf, $oggetto);

        $email = $db->SingleField("valore", "config", "WHERE chiave='RISPOSTA_" . str_replace("-", "_", $lang) . "_CAMPUSSANPAOLO'");
        $email = str_replace("[DATA]", $data, $email);
        $email = str_replace("[NOME]", utf8_decode($q['nome']), $email);
        $email = str_replace("[COGNOME]", utf8_decode($q['cognome']), $email);

       
          sendEmail($q['email'], "booking@campussanpaolo.it", $oggetto, $email, '', $allegato, '/tmp/');
          sendEmail("booking@campussanpaolo.it", $q['email'], $oggetto, $email, '', $allegato, '/tmp/');
          sendEmail("info@campussanpaolo.it", "djamal@archynet.it", $oggetto, $email, '', $allegato, '/tmp/');
        
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
        $mailC->setFrom('info@campussanpaolo.it', 'Booking CampusSanPaolo.it');
        $mailC->addReplyTo('info@campussanpaolo.it', 'Booking CampusSanPaolo.it');
        $mailC->msgHTML($email, dirname(__FILE__), true);
        $mailC->AltBody = $email;
        $mailC->addAddress('djamal@archynet.it', 'Adoum Djamal');
        $mailC->addAttachment('./tmp/' . $allegato);
        $mailC->send();
        
        
       
        
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
        $mail->setFrom($q['email'], $q['nome'] . " " . $q['cognome']);
        #$mail->addReplyTo('info@stessopiano.it', 'Booking Stessopiano.it');
        $mail->msgHTML($email, dirname(__FILE__), true);
        $mail->AltBody = $email;
        $mail->addAddress('booking@campussanpaolo.it', 'Booking CampusSanPaolo.it');

        $mail->addAttachment('./tmp/' . $allegato);
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
        $mailM->setFrom('booking@campussanpaolo.it', 'Booking CampusSanPaolo.it');
        $mailM->addReplyTo('booking@campussanpaolo.it', 'Booking CampusSanPaolo.it');
        $mailM->msgHTML($email, dirname(__FILE__), true);
        $mailM->AltBody = $email;
        $mailM->addAddress($q['email'], $q['nome'] . " " . $q['cognome']);
        $mailM->addAttachment('./tmp/' . $allegato);
        if ($mailM->send())
            echo "MAIL INVIATA " . $q['email'] . " " . $q['nome'] . " " . $q['cognome'] . " \n ";
        else
            echo "*** ERRORE INVIO EMAIL " . $q['email'] . " " . $q['nome'] . " " . $q['cognome'] . "  \n ";
       */
    }
}
?>
