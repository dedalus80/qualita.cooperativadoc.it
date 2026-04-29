<?php
include("../lib/class-db.php");
include("../lib/fpdf.php");
include("../lib/libreria_html2pdf/html2pdf.class.php");
include("../lib/sendEmail.php");
include("/var/www/vhosts/cooperativadoc.it/childrenpark.cooperativadoc.it/libreria_mailer/PHPMailerAutoload.php");

$parentele = array("C" => "Coniuge", "FR" => "Fratello", "F" => "Figlio / a", "SO" => "Sorella");
$parenteleGenitori = array("G" => "Genitore", "S" => "Suocero / a");

function cleanText($text) {
    $t = str_replace("à", "&agrave;", $text);
    $t = str_replace("ù", "&ugrave;", $t);
    $t = str_replace("è", "&egrave;", $t);
    $t = str_replace("ì", "&igrave;", $t);
    $t = str_replace("ò", "&ograve;", $t);
    return $t;
}

$db = new MySql_DB('52.214.192.71', 'iscrizioni', 'iscrizioni', 'LVnPq8ACRgyqSWqm', true);

switch ($_REQUEST['tipo']) {
    case "UVO":
        $tipo = "UVO";
        $query = "SELECT p.nome as province , i.*, DATE_FORMAT(i.nascita_genitore_1, '%d-%m-%Y')  AS ng1, DATE_FORMAT(i.nascita_genitore_2, '%d-%m-%Y')  AS ng2, DATE_FORMAT(i.nascita_partecipante_1, '%d-%m-%Y')  AS np1 , DATE_FORMAT(i.nascita_partecipante_3, '%d-%m-%Y')  AS np3,";
        $query .=" DATE_FORMAT(i.nascita_partecipante_2, '%d-%m-%Y')  AS np2,  CONCAT(t.turno , '&deg; Turno dal ', DATE_FORMAT(t.dal ,'%d-%m-%Y'),' al ', DATE_FORMAT(t.al ,'%d-%m-%Y'))  AS turno_iniziativa   ";
        $logo = "logo_unavacanzaperognieta.png";
        $table = 'iscrizioni_unavacanzaperognieta';
        $iniziativa = "Una Vacanza Per Ogni Et&agrave;";
        $oggetto = "Una Vacanza Per Ogni Età";
        $template = "EMAIL-ISCRIZIONE-UVO";
        break;
    case "UVI":
        $tipo = "UVI";
        $query = "SELECT p.nome as province , i.*, DATE_FORMAT(i.disabile_nascita, '%d-%m-%Y')  AS nd, DATE_FORMAT(i.accompagnatore_1_nascita, '%d-%m-%Y')  AS na1, DATE_FORMAT(i.accompagnatore_2_nascita, '%d-%m-%Y')  AS na2, ";
        $query .=" DATE_FORMAT(i.accompagnatore_3_nascita, '%d-%m-%Y')  AS na3,  CONCAT(t.turno , '&deg; Turno dal ', DATE_FORMAT(t.dal ,'%d-%m-%Y'),' al ', DATE_FORMAT(t.al ,'%d-%m-%Y'))  AS turno_iniziativa   ";
        $table = 'iscrizioni_unavacanzainsieme';
        $logo = "logo_unavacanzainsieme.png";
        $iniziativa = "Una Vacanza Insieme";
        $oggetto = "Una Vacanza Insieme";
        $template = "EMAIL-ISCRIZIONE-UVI";
        break;
}

$dati = $db->FetchArray($db->Query($query . " FROM " . $table . " AS i LEFT JOIN _turni AS t ON i.turno = t.id LEFT JOIN _provincia AS p ON i.provincia = p.id WHERE i.id='" . $_REQUEST['id'] . "'"));

// PREPARO PDF SCHEDA SANITARIA
include("./voucher.php");

$html2pdf = new HTML2PDF('P', 'A4', 'fr');
$html2pdf->WriteHTML($content);

$fileName = "pre" . $table . "_" . $_REQUEST['id'] . ".pdf";
$html2pdf->Output("./tmp/" . $fileName, "F");

if (chmod("./tmp/" . $fileName, 0777)) {
    // MANDO LA MAIL

    $oggetto = "Iscrizione " . $oggetto;

    $destinatari = array(
        "0" => array("nome" => "Adoum Djamal", "email" => "djamal@archynet.it"),
        "1" => array("nome" => $dati['nome'] . " " . $dati['cognome'], "email" => $dati['email']),
        "2" => array("nome" => "Mario Ferretti", "email" => "mario.ferretti@cooperativadoc.it")
    );

    $email = $db->SingleField("txt", "_config", "WHERE val_key='" . $template . "' ");
    $email = str_replace("[DATA]", date("d") . "-" . date("m") . "-" . date("Y"), $email);
    $email = str_replace("[NOME]", utf8_decode(strtoupper($dati['nome'])), $email);
    $email = str_replace("[COGNOME]", utf8_decode(strtoupper($dati['cognome'])), $email);
    $email = str_replace("[INIZIATIVA]", utf8_decode($iniziativa), $email);
    $email = str_replace("[TURNO]", utf8_decode($dati['turno_iniziativa']), $email);
    $email = str_replace("[LOGO]", $logo, $email);

    for ($x = 0; $x < count($destinatari); $x++) {

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = "smtp.office365.com";
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = "info@unavacanzaunaesperienza.it";
        $mail->Password = "Uvue1357?";
        $mail->Subject = $oggetto;
        $mail->setFrom('info@unavacanzaunaesperienza.it', $oggetto);
        $mail->addReplyTo('info@unavacanzaunaesperienza.it', $oggetto);
        $mail->msgHTML($email, dirname(__FILE__), true);
        $mail->AltBody = $email;
        $mail->addAddress($destinatari[$x]['email'], $destinatari[$x]['nome']);
        $mail->addAttachment('./tmp/' . $fileName);
        $mail->send();
    }
}
?>