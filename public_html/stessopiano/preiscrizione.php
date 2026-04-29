<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$_REQUEST['id'] = 3; 

include("/var/www/vhosts/cooperativadoc.it/qualita.cooperativadoc.it/stessopiano/class/class-db.php");
include("/var/www/vhosts/cooperativadoc.it/qualita.cooperativadoc.it/stessopiano/class/fpdf.php");
include("/var/www/vhosts/cooperativadoc.it/qualita.cooperativadoc.it/stessopiano/class/sendEmail.php");
include("/var/www/vhosts/cooperativadoc.it/qualita.cooperativadoc.it/stessopiano/lang_new.php");
include("/var/www/vhosts/cooperativadoc.it/childrenpark.cooperativadoc.it/libreria_mailer/PHPMailerAutoload.php");

$db = new MySql_DB("localhost", "qualita_1_sito", "qualita_1_sito", '^B&FpWPQ7*;TDFm', true);

// RECUPERO PRIMA LA LINGUA 
$l = $db->SingleField("lang", "sp_preiscrizioni", "WHERE id='" . $_REQUEST['id'] . "' ");

if ($l == 'en-GB')
    $langDB = '_en';

$query = "SELECT r.* , n.nome as nazione, o.nome" . $langDB . " as lavoro , c.nome" . $langDB . " as conoscenza ,   p.nome as prov ,
    ca.nome" . $langDB . " as camera_det , ap.nome" . $langDB . " as appartamento_det , l.nome" . $langDB . " as livello_det 
    ,DATE_FORMAT(r. scadenza_documento, '%d-%m-%Y' ) as  scadenza , co.nome" . $langDB . " as coabitazione_det  ,
    DATE_FORMAT(r.data_in, '%d-%m-%Y' ) as arrivo ,DATE_FORMAT(r.data_out, '%d-%m-%Y') as partenza, DATE_FORMAT(r.data_nascita, '%d-%m-%Y') as nascita 

FROM sp_preiscrizioni AS r
LEFT JOIN    doc_nazioni AS n ON r.nazionalita = n.id 
LEFT JOIN    sp_occupazione AS o ON r.occupazione = o.id 
LEFT JOIN    sp_province AS p ON r.provincia = p.id 
LEFT JOIN    sp_conoscenza AS c ON r.conoscenza = c.id 
LEFT JOIN    sp_camera AS ca ON r.tipo_camera = ca.id 
LEFT JOIN    sp_appartamento AS ap ON r.tipo_appartamento = ap.id 
LEFT JOIN    sp_livello AS l ON r.livello = l.id 
LEFT JOIN    sp_coabitazione AS co ON r.coabitazione = co.id 
WHERE r.id='" . $_REQUEST['id'] . "' ";

$q = $db->FetchArray($db->Query($query));

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



if ($q) {
    if ($q['lang']) {
        $lang = $q['lang'];
    }
    else
        $lang = 'it-IT';

    $nf = $_REQUEST['id'];
	
    

    class PDF extends FPDF {

        function Header() {
            $this->Image('./img/logo_piccolo.jpg', 100, 12, '100');
            $this->SetFont('Arial', '', 12);
        }

        function Footer() {
            $this->SetY(-6);
            $this->SetFont('Arial', '', 10);

            $this->Cell(0, 0, 'STESSOPIANO Via Michele Buniva 8, Torino - IT T +39 011 6686812 E info@stessopiano.it', 0, 0, 'C');
        }

        function ChapterBody($file) {
            $txt = fread($f, filesize($file));
            $this->MultiCell(0, 5, $txt);
            $this->Ln();
            $this->SetFont('', 'I');
            $this->Cell(0, 5, '(end of excerpt)');
        }

    }

    $pdf = new PDF();
    $pdf->SetDrawColor(125, 125, 125);
    $pdf->SetLineWidth(0.5);

    $pdf->AddPage();
    $pdf->Ln(30);

    $pdf->Cell(50, 5, $text[$lang]['label_torino'] . ' :' . date('d') . '-' . date('m') . '-' . date('Y'), 0);
    $pdf->Ln(5);
    $pdf->Cell(100, 5, $text[$lang]['label_preiscrizione'] . " N:" . $nf, 0);

    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFillColor(166, 76, 148);
    $pdf->Cell(0, 6, $text[$lang]['label_dati'], 0, 1, 'L', true);
    $pdf->Ln(3);


    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(60, 5, $text[$lang]['label_nome'], 0);
    $pdf->Cell(60, 5, $text[$lang]['label_cognome'], 0);
    $pdf->Cell(60, 5, $text[$lang]['label_sesso'], 0);
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(60, 5, iconv('UTF-8', 'windows-1252', $q['nome']), 0);
    $pdf->Cell(60, 5, iconv('UTF-8', 'windows-1252', $q['cognome']), 0);
    $pdf->Cell(60, 5, $q['sesso'] == 'M' ? $text[$lang]['label_sm_pdf'] : $text[$lang]['label_sf_pdf'], 0);
    $pdf->Ln(7);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(60, 5, $text[$lang]['label_natoa'], 0);
    $pdf->Cell(60, 5, $text[$lang]['label_natoil'], 0);
    $pdf->Cell(60, 5, $text[$lang]['label_nazionalita_pdf'], 0);
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(60, 5, iconv('UTF-8', 'windows-1252', $q['luogo_nascita']), 0);
    $pdf->Cell(60, 5, $q['nascita'], 0);
    $pdf->Cell(60, 5, $q['nazione'], 0);
    $pdf->Ln(7);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(60, 5, $text[$lang]['label_cellulare'], 0);
    $pdf->Cell(60, 5, $text[$lang]['label_email'], 0);
    $pdf->Cell(60, 5, $text[$lang]['label_occupazione'], 0);
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(60, 5, $q['cellulare'], 0);
    $pdf->Cell(60, 5, $q['email'], 0);
    $pdf->Cell(60, 5, $q['lavoro'] . " " . $q['occupazione_det'], 0);
    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(60, 5, $text[$lang]['label_residenza'], 0);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(0, 5, $q['residenza'] . " " . $q['indirizzo'] . " " . $q['numero_civico'] . " " . $q['cap'] . " " . $q['prov'], 0);
    $pdf->Ln(7);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(60, 5, $text[$lang]['label_codice_fiscale'], 0);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(0, 5, $q['codice_fiscale'], 0);
    $pdf->Ln(7);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(60, 5, $text[$lang]['label_tipo_documento'], 0);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(0, 5, $q['tipo_documento'] . " N�" . $q['numero_documento'] . " " . $text[$lang]['label_scadenza_documento'] . " " . $q['scadenza'], 0);
    $pdf->Ln(7);

    if ($q['permesso_soggiorno']) {
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(60, 5, $text[$lang]['label_permesso'], 0);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 5, $q['permesso_soggiorno'], 0);
        $pdf->Ln(7);
    }

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFillColor(166, 76, 148);
    $pdf->Cell(0, 6, $text[$lang]['label_altre_informazioni'], 0, 1, 'L', true);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Ln(3);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(60, 5, $text[$lang]['label_alloggio_attuale_pdf'], 0);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(0, 5, $q['dove_vive'] == '7' ? $q['dove_vive_altro'] : $alloggioAttuale[$lang][$q['dove_vive']], 0);

    $pdf->Ln(5);

    $ricerca = '';
    $q['camera_singola'] == 'Y' ? $ricerca .= $text[$lang]['label_camera_singola'] . " " : "";
    $q['camera_doppia'] == 'Y' ? $ricerca .= $text[$lang]['label_camera_doppia'] . " " : "";
    $q['camera_indiferente'] == 'Y' ? $ricerca .= $text[$lang]['label_indifferente'] . " " : "";
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(60, 5, $text[$lang]['label_sto_cercando_pdf'], 0);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(0, 5, $ricerca, 0);

    $pdf->Ln(5);

    if ($q['camera_amici'] == 'Y')
        $amici = $text[$lang]['label_camera_amici_pdf_si'] . " " . $q['camera_amici_dettaglio'];
    else
        $amici = $text[$lang]['label_camera_amici_pdf_no'];

    $pdf->Cell(0, 5, $amici, 0);
    $pdf->Ln(7);


    $q['amici_eta'] == 'U' ? $eta = $text[$lang]['label_amici_eta_uguale_pdf'] : $eta = $text[$lang]['label_amici_indiferente'];
    $q['amici_fumo'] == 'N' ? $fumo = $text[$lang]['label_amici_fumatori'] : $fumo = $text[$lang]['label_amici_indiferente'];




    if ($q['amici_animali'] == 'Y')
        $animali = $text[$lang]['label_amici_animali_si'] . " di " . $q['amici_animali_dettaglio'];
    else if ($q['amici_animali'] == 'N')
        $animali = $text[$lang]['label_amici_animali_no'];
    else if ($q['amici_animali'] == 'I')
        $animali = $text[$lang]['label_amici_indiferente'];



    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(0, 5, $text[$lang]['label_amici_si_pdf'], 0);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Ln(5);
    $pdf->Cell(60, 5, $text[$lang]['label_amici_genere'] . ": " . getNewText($q['amici_genere'], $lang), 0);
    $pdf->Cell(60, 5, $text[$lang]['label_amici_occupazione'] . ": " . getNewText($q['amici_occupazione'], $lang), 0);
    $pdf->Cell(60, 5, $text[$lang]['label_amici_eta_pdf'] . ": " . $eta, 0);
    $pdf->Ln(5);
    $pdf->Cell(60, 5, $text[$lang]['label_amici_fumo'] . ": " . $fumo, 0);
    $pdf->Cell(60, 5, $text[$lang]['label_amici_animali'] . ": " . $animali, 0);
    $pdf->Ln(7);

    if ($q['nuova_residenza'] == 'Y')
        $pdf->Cell(0, 5, $text[$lang]['label_sposta_residenza_si'], 0);
    else
        $pdf->Cell(0, 5, $text[$lang]['label_sposta_residenza_no'], 0);
    $pdf->Ln(5);

    if ($q['prima_volta'] == "Y")
        $pdf->Cell(0, 5, $text[$lang]['label_prima_volta_si'], 0);
    else
        $pdf->Cell(0, 5, $text[$lang]['label_prima_volta_no'], 0);

    $pdf->Ln(5);
    $pdf->Write(5, $text[$lang]['label_conoscenza_fattura'] . ': ' . $q['conoscenza']);


    $pdf->Ln(7);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetFillColor(166, 76, 148);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(0, 6, $text[$lang]['label_dati_formula'], 0, 1, 'L', true);

    $pdf->Ln(5);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(60, 5, $text[$lang]['label_periodo'], 0);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(0, 5, $text[$lang]['label_dal'] . " " . $q['arrivo'] . " " . $text[$lang]['label_al'] . "  " . $q['partenza'], 0);
    $pdf->Ln(5);

    if ($q['camera'] == 'Y') {
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(60, 5, $text[$lang]['label_camera'], 0);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(60, 5, $q['camera_det'], 0);
        $pdf->Ln(5);
    }
    if ($q['appartamento'] == 'Y') {
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(60, 5, $text[$lang]['label_appartamento'], 0);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(60, 5, $q['appartamento_det'], 0);
        $pdf->Ln(5);
    }
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(60, 5, $text[$lang]['label_livello_pdf'], 0);
    $pdf->SetFont('Arial', '', 11);
    if ($q['livello'] == '7')
        $livello = $q['livello_altro'] . " Euro";
    else
        $livello = str_replace("&euro;", "Euro", $q['livello_det']);

    $pdf->Cell(60, 5, $livello, 0);
    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(60, 5, $text[$lang]['label_fumatore_pdf'], 0);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(60, 5, $q['fumatore'] == 'Y' ? getYesNo($lang) : "No", 0);
    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(60, 5, $text[$lang]['label_coinquilini_pdf'], 0);
    $pdf->SetFont('Arial', '', 11);
    if ($q['coinquilini'] == 'Y')
        $coinquilini = getYesNo($lang) . " " . $q['coinquilini_n'];
    else
        $coinquilini = 'No';

    $pdf->Cell(60, 5, $coinquilini, 0);
    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(60, 5, $text[$lang]['label_animali_pdf'], 0);
    $pdf->SetFont('Arial', '', 11);
    if ($q['animali'] == 'Y')
        $animali = getYesNo($lang) . " " . $q['animali_det'];
    else
        $animali = 'No';

    $pdf->Cell(60, 5, $animali, 0);
    $pdf->Ln(5);

    if ($q['coabitazione']) {
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(60, 5, $text[$lang]['label_coabitare_pdf'], 0);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(60, 5, $q['coabitazione_det'], 0);
        $pdf->Ln(5);
    }
    if ($q['quartieri']) {
        $quartieri = explode(",", $q['quartieri']);
        for ($x = 0; $x < count($quartieri); $x++)
            $qua .= $db->SingleField("nome", "sp_quartiere", "WHERE id='" . $quartieri[$x] . "' ") . " ";
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(60, 5, $text[$lang]['label_quartieri_pdf'], 0);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(60, 5, $qua, 0);
        $pdf->Ln(5);
    }

    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 11);
    $pdf->SetFillColor(166, 76, 148);
    $pdf->Cell(0, 1, ' ', 0, 1, 'L', true);

    $pdf->Ln(3);

    if ($q['interessato']) {
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(40, 5, $text[$lang]['label_interessato_pdf'], 0);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 5, utf8_decode($q['interessato']), 0);
        $pdf->Ln(5);
    }

    if ($q['note']) {
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(40, 5, $text[$lang]['label_note'], 0);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 5, utf8_decode($q['note']), 0);
        $pdf->Ln(5);
    }

    if ($q['giorni_visita']) {
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(40, 5, $text[$lang]['label_giorni_visite_pdf'], 0);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 5, utf8_decode($q['giorni_visita']), 0);
        $pdf->Ln(5);
    }

    if ($q['privacy']) {
        $pdf->Ln(5);
        $pdf->Write(5, $text[$lang]['label_privacy_pdf']);
        $pdf->Ln(5);
    }

    $pdf->Output("/var/www/vhosts/cooperativadoc.it/qualita.cooperativadoc.it/stessopiano/tmp/preiscrizione_" . $nf . ".pdf", "F");
    chmod("/var/www/vhosts/cooperativadoc.it/qualita.cooperativadoc.it/stessopiano/tmp/preiscrizione_" . $nf . ".pdf", 0777);

    $allegato = "preiscrizione_" . $nf . ".pdf";

    $oggetto = $db->SingleField("valore", "config", "WHERE chiave='OGGETTO_" . str_replace("-", "_", $lang) . "_STESSOPIANO'");
    $oggetto = str_replace("[NF]", $nf, $oggetto);

    $email = "<div style='text-align: right; margin-right: 70px; margin-top: 30px' ><img src='./img/logo_piccolo.jpg' height='50'>";
    $email .="<p style='text-align:left; margin-top:30px'>";

    $email .= $db->SingleField("valore", "config", "WHERE chiave='RISPOSTA_" . str_replace("-", "_", $lang) . "_STESSOPIANO'");
    $email = str_replace("[DATA]", $data, $email);
    $email = str_replace("[NOME]", utf8_decode($q['nome']), $email);
    $email = str_replace("[COGNOME]", utf8_decode($q['cognome']), $email);

    $mailQ = new PHPMailer;
    $mailQ->isSMTP();
    $mailQ->SMTPDebug = 0;
    $mailQ->Debugoutput = 'html';
    $mailQ->Host = "mail.archynet.it";
    $mailQ->Port = 25;
    $mailQ->SMTPAuth = true;
    $mailQ->Username = "coopdoc@archynet.it";
    $mailQ->Password = "smtpcoopdoc#1";
    $mailQ->Subject = $oggetto;
    $mailQ->setFrom('info@stessopiano.it', 'Booking Stessopiano.it');
    $mailQ->addReplyTo('info@stessopiano.it', 'Booking Stessopiano.it');
    $mailQ->msgHTML($email, dirname(__FILE__), true);
    $mailQ->AltBody = $email;
    $mailQ->addAddress('info@stessopiano.it', 'Qualita cooperativadoc.it');
    $mailQ->addAttachment('./tmp/' . $allegato);
    $mailQ->send();

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
    $mail->addReplyTo($q['email'], $q['nome'] . " " . $q['cognome']);
    $mail->msgHTML($email, dirname(__FILE__), true);
    $mail->AltBody = $email;
    $mail->addAddress('stessopiano@cooperativadoc.it', 'Stesso Piano');
    $mail->addAttachment('./tmp/' . $allegato);
    $mail->send();
    
    
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
    $mailC->send();

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
    $mailM->send();
    
     unlink("/var/www/vhosts/cooperativadoc.it/qualita.cooperativadoc.it/stessopiano/tmp/preiscrizione_" . $nf . ".pdf");

    
}
?>
