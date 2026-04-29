<?
/*
include("/var/www/vhosts/cooperativadoc.it/qualita.cooperativadoc.it/stessopiano/class/class-db.php");
include("/var/www/vhosts/cooperativadoc.it/qualita.cooperativadoc.it/stessopiano/class/fpdf.php");
include("/var/www/vhosts/cooperativadoc.it/qualita.cooperativadoc.it/stessopiano/class/sendEmail.php");
include("/var/www/vhosts/cooperativadoc.it/qualita.cooperativadoc.it/stessopiano/lang.php");
include("/var/www/vhosts/cooperativadoc.it/childrenpark.cooperativadoc.it/libreria_mailer/PHPMailerAutoload.php");
$db = new MySql_DB("localhost", "cooperativa_qualita", "coop_qualita", "coop5369s", true);

$_REQUEST['id'] = 642;

$q = $db->FetchArray($db->Query("SELECT * FROM sp_preiscrizioni WHERE id='" . $_REQUEST['id'] . "'"));

if ($q) {
    if ($q['lang'])
        $lang = $q['lang'];
    else
        $lang = 'it-IT';

    $nf = $_REQUEST['id'];

    $data_in = explode("-", $q['data_in']);
    $data_out = explode("-", $q['data_out']);
    $data_n = explode("-", $q['data_nascita']);

    $q['a_g'] = $data_in[2];
    $q['a_m'] = $data_in[1];
    $q['a_a'] = $data_in[0];
    $q['p_g'] = $data_out[2];
    $q['p_m'] = $data_out[1];
    $q['p_a'] = $data_out[0];
    $q['n_g'] = $data_n[2];
    $q['n_m'] = $data_n[1];
    $q['n_a'] = $data_n[0];

    #GENERO LA MAPPA E LA SALVO SUL SERVER ------------------------------------------------------------------------------------------------------------------------------------------------------------
    $data = date('d') . '/' . date('m') . '/' . date('Y');

    function getYesNo($lang) {

        switch ($lang) {
            case"en-GB":
                $yes = "Yes";
                break;
            default :
                $yes = "Si";
        }
        return $yes;
    }

    $allegato = "preiscrizione_" . $nf . ".pdf";

    $oggetto = $db->SingleField("valore", "config", "WHERE chiave='OGGETTO_" . str_replace("-", "_", $lang) . "_STESSOPIANO'");
    $oggetto = str_replace("[NF]", $nf, $oggetto);

    $email = "<div style='text-align: right; margin-right: 70px; margin-top: 30px' ><img src='http://www.stessopiano.it/site/wp-preiscrizione/img/logo_piccolo.jpg' height='50'>";
    $email .="<p style='text-align:left; margin-top:30px'>";

    $email .= $db->SingleField("valore", "config", "WHERE chiave='RISPOSTA_" . str_replace("-", "_", $lang) . "_STESSOPIANO'");
    $email = str_replace("[DATA]", $data, $email);
    $email = str_replace("[NOME]", utf8_decode($q['nome']), $email);
    $email = str_replace("[COGNOME]", utf8_decode($q['cognome']), $email);

    /*
      sendEmail($q['email'], "stessopiano@cooperativadoc.it", $oggetto, $email, '', $allegato, '/tmp/');
      sendEmail($q['email'], "info@stessopiano.it", $oggetto, $email, '', $allegato, '/tmp/');
      sendEmail("info@stessopiano.it", $q['email'], $oggetto, $email, '', $allegato, '/tmp/');
      sendEmail("info@stessopiano.it", "djamal@archynet.it", $oggetto, $email, '', $allegato, '/tmp/');
     */


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
    $mail->addAddress('stessopiano@cooperativadoc.it', 'Stesso Piano');
    $mail->addAddress('info@stessopiano.it', 'Stesso Piano');
    $mail->addAttachment('./tmp/' . $allegato);
    if ($mail->send())
        echo "MAIL INVIATA ". $q['email']." ".$q['nome'] . " " . $q['cognome'] . "<br /> ";
    else
        echo "*** ERRORE INVIO EMAIL ". $q['email']." ".$q['nome'] . " " . $q['cognome'] . "<br /> ";

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
    $mailC->setFrom('info@stessopiano.it', 'Booking Stessopiano.it');
    $mailC->addReplyTo('info@stessopiano.it', 'Booking Stessopiano.it');
    $mailC->msgHTML($email, dirname(__FILE__), true);
    $mailC->AltBody = $email;
    $mailC->addAddress('djamal@archynet.it', 'Adoum Djamal');
    $mailC->addAttachment('./tmp/' . $allegato);
    if ($mailC->send())
        echo "MAIL INVIATA ". $q['email']." ".$q['nome'] . " " . $q['cognome'] . "<br /> ";
    else
        echo "*** ERRORE INVIO EMAIL ". $q['email']." ".$q['nome'] . " " . $q['cognome'] . "<br /> ";

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
    $mailM->setFrom('info@stessopiano.it', 'Booking Stessopiano.it');
    $mailM->addReplyTo('info@stessopiano.it', 'Booking Stessopiano.it');
    $mailM->msgHTML($email, dirname(__FILE__), true);
    $mailM->AltBody = $email;
    $mailM->addAddress($q['email'], $q['nome'] . " " . $q['cognome']);
    $mailM->addAttachment('./tmp/' . $allegato);
    if ($mailM->send())
        echo "MAIL INVIATA ". $q['email']." ".$q['nome'] . " " . $q['cognome'] . "<br /> ";
    else
        echo "*** ERRORE INVIO EMAIL ". $q['email']." ".$q['nome'] . " " . $q['cognome'] . "<br /> ";
}


echo "END;" */

?>


