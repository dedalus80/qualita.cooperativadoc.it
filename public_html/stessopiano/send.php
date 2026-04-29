<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);



include("./include/class-db.php");
include("./include/lang_new.php");
include("./include/libreria_html2pdf/html2pdf.class.php");
include(__DIR__."/../vendor/autoload.php");

function cleanText($text){
	
	$tmp = str_replace("à","&agrave;",$text);
	$tmp = str_replace("è","&egrave;",$tmp);
	$tmp = str_replace("ì","&igrave;",$tmp);
	$tmp = str_replace("ò","&ograve;",$tmp);
	$tmp = str_replace("ù","&ugrave;",$tmp);
	
	return $tmp;
	
}



$nf = intval($_REQUEST['id']);

if(!$nf) {
	http_response_code(403);
	exit();
}

$db = new MySql_DB("localhost", "qualita_1_sito", "qualita_1_sito", '^B&FpWPQ7*;TDFm', true);

$lang = $db->SingleField("lang", "sp_preiscrizioni", "WHERE id='" . $nf . "' ");


$l = "_".$lang;

if($lang == 'en')
	$ll = "_".$lang ;



$query = "SELECT r.* , r.occupazione as occ , n.nome as nazione, o.nome" . $ll . " as lavoro , c.nome" . $ll . " as conoscenza ,   p.nome as prov ,
    ca.nome" . $ll . " as camera_det , ap.nome" . $ll . " as appartamento_det , l.nome" . $ll . " as nome_livello 
    ,DATE_FORMAT(r. scadenza_documento, '%d-%m-%Y' ) as  scadenza , co.nome" . $ll . " as coabitazione_det  ,
    DATE_FORMAT(r.data_in, '%d-%m-%Y' ) as arrivo ,DATE_FORMAT(r.data_out, '%d-%m-%Y') as partenza, DATE_FORMAT(r.data_nascita, '%d-%m-%Y') as nascita  , ag.nome" . $l . " as genere , ao.nome" . $l . " as occupazione , ae.nome" . $l . " as eta , aa.nome" . $l . " as animali , af.nome" . $l . " as fumo , re.nome" . $l . " as n_residenza , aq.nome" . $l . " as coinquilini , al.nome" . $l . " as alloggio , na.nome" . $l . " as numero_amici

FROM sp_preiscrizioni AS r
LEFT JOIN    doc_nazioni AS n ON r.nazionalita = n.id 
LEFT JOIN    sp_occupazione AS o ON r.occupazione = o.id 
LEFT JOIN    sp_province AS p ON r.provincia = p.id 
LEFT JOIN    sp_conoscenza AS c ON r.conoscenza = c.id 
LEFT JOIN    sp_camera AS ca ON r.tipo_camera = ca.id 
LEFT JOIN    sp_appartamento AS ap ON r.tipo_appartamento = ap.id 
LEFT JOIN    sp_livello AS l ON r.livello = l.id 
LEFT JOIN    sp_coabitazione AS co ON r.coabitazione = co.id
LEFT JOIN    sp_amici AS na ON r.amici_quanti = na.id

LEFT JOIN    sp_alloggio AS al ON r.dove_vive = al.id
LEFT JOIN    sp_amici_genere AS ag ON r.amici_genere = ag.id 
LEFT JOIN    sp_amici_occupazione AS ao ON r.amici_occupazione = ao.id 
LEFT JOIN    sp_amici_eta AS ae ON r.amici_eta = ae.id 
LEFT JOIN    sp_amici_animali AS aa ON r.amici_animali = aa.id 
LEFT JOIN    sp_amici_fumatori AS af ON r.amici_fumo = af.id
LEFT JOIN    sp_residenza  AS re ON r.nuova_residenza = re.id
LEFT JOIN    sp_amici  AS aq ON r.amici_quanti = aq.id 
WHERE r.id='" . $_REQUEST['id'] . "' ";

$dati = $db->FetchArray($db->Query($query));
// PREPARO PDF SCHEDA SANITARIA
include("./voucher.php");

$html2pdf = new HTML2PDF('P', 'A4', 'fr');
$html2pdf->WriteHTML($content);

$fileName = "preiscrizione_" . $nf . ".pdf";
$html2pdf->Output("./tmp/" . $fileName, "F");

if (chmod("./tmp/" . $fileName, 0777)) {

	$code = $lang."_".strtoupper($lang);
	
    $oggetto = $db->SingleField("valore", "config", "WHERE chiave='OGGETTO_" . $code . "_STESSOPIANO'");
    $oggetto = str_replace("[NF]", $nf, $oggetto);
    $destinatari = array(
        //"0" => array("nome" => "Tech", "email" => "tech@messageglobe.it"),
       	"1" => array("nome" => $dati['nome'] . " " . $dati['cognome'], "email" => $dati['email']),
       	"2" => array("nome" => "Info Stesso Piano", "email" => "info@stessopiano.it"),
       	"3" => array("nome" => "Mario Ferretti", "email" => "mario.ferretti@cooperativadoc.it") 
   );
		
	
    $email .= $db->SingleField("valore", "config", "WHERE chiave='RISPOSTA_" .$code . "_STESSOPIANO'");
    $email = str_replace("[DATA]", date("d")."-".date("m")."-".date("Y"), $email);
    $email = str_replace("[NOME]", utf8_decode($dati['nome']), $email);
    $email = str_replace("[COGNOME]", utf8_decode($dati['cognome']), $email);
    
	
    for ($x = 0; $x < count($destinatari); $x++) {
    	$mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = "smtp.office365.com";
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = "iscrizioni@stessopiano.it";
        $mail->Password = "J*776888663017uc";
        $mail->Subject = $oggetto;
        $mail->setFrom('iscrizioni@stessopiano.it', 'Booking Stessopiano.it');
		$mail->addReplyTo($dati['email'], $dati['nome'] . " " . $dati['cognome']);
        $mail->msgHTML($email, dirname(__FILE__), true);
        $mail->AltBody = $email;
		$mail->addAddress($destinatari[$x]['email'], $destinatari[$x]['nome']);
        $mail->addAttachment('./tmp/' . $fileName);
        $mail->send();
    }

    @unlink("./tmp/" . $fileName);
}
?>
