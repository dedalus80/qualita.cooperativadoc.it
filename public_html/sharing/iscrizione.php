<?php

include("../lib/class-db.php");
include("../lib/fpdf.php");
include("../lib/sendEmail.php");
include("./lang.php");
require_once __DIR__.'/../vendor/autoload.php';

$ID = intval($_REQUEST['id']);

$db = new MySql_DB("localhost", "qualita", "qualita", "00qQUFDTOlKl6O3", true);
$q = $db->FetchArray($db->Query("SELECT * FROM sh_preiscrizioni WHERE id='" . $ID . "'"));

if ($q) {
    if ($q['lang'])
        $lang = $q['lang'];
    else
        $lang = 'it-IT';

    $nf = $ID;


    // $nf = $db->SingleField("MAX(id_iscrizione)", "sh_preiscrizioni", " WHERE 1 ") + 1;
    // $db->Query("UPDATE  sh_preiscrizioni SET id_iscrizione ='" . $nf . "' WHERE id='" . $_REQUEST['id'] . "'");


    $data = date('d') . '/' . date('m') . '/' . date('Y');


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

    class PDF extends FPDF {

        function Header() {
            $this->Image('./img/prenotazione.jpg', 100, 12, '100');
            $this->SetFont('Arial', '', 12);
        }

        function Footer() {
            $this->SetY(-6);
            $this->SetFont('Arial', '', 8);
            $this->Cell(0, 0, 'SHARING TORINO Via Ribordone 12 10156 Torino - IT T +39 011 2243024 F +39 011 2243041 E booking@sharing.to.it', 0, 0, 'C');
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
    $pdf->Ln(50);

    $pdf->Cell(50, 5, $text[$lang]['label_torino'] . ' :' . $data, 0);
    $pdf->Ln(5);
    $pdf->Cell(100, 5, $text[$lang]['label_preiscrizione'] . " N°:" . $q['id'], 0);

    $pdf->Ln(15);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFillColor(166, 76, 148);
    $pdf->Cell(0, 6, $text[$lang]['label_dati'], 0, 1, 'L', true);
    $pdf->Ln(5);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(60, 5, $text[$lang]['label_nome'], 0);
    $pdf->Cell(60, 5, $text[$lang]['label_cognome'], 0);
    $pdf->Cell(60, 5, $text[$lang]['label_sesso'], 0);


    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(60, 5, iconv('UTF-8', 'windows-1252', $q['nome']), 0);
    $pdf->Cell(60, 5, iconv('UTF-8', 'windows-1252', $q['cognome']), 0);
    $pdf->Cell(60, 5, $q['sesso'] == 'M' ? $text[$lang]['label_sm'] : $text[$lang]['label_sf'], 0);
    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(60, 5, $text[$lang]['label_natoa'], 0);
    $pdf->Cell(60, 5, $text[$lang]['label_natoil'], 0);
    $pdf->Cell(60, 5, $text[$lang]['label_nazionalita_pdf'], 0); 

    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(60, 5, iconv('UTF-8', 'windows-1252', $q['luogo_nascita']), 0);
    $pdf->Cell(60, 5, $q['n_g'] . "-" . $q['n_m'] . "-" . $q['n_a'], 0);
    $pdf->Cell(60, 5, $db->SingleField("nome", "doc_nazioni", "WHERE id='" . $q['nazionalita'] . "'"), 0);
    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(60, 5, $text[$lang]['label_cellulare'], 0);
    $pdf->Cell(60, 5, $text[$lang]['label_email'], 0);
    $pdf->Cell(60, 5, $text[$lang]['label_occupazione'], 0);

    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(60, 5, $q['cellulare'], 0);
    $pdf->Cell(60, 5, $q['email'], 0);
    $pdf->Cell(60, 5, $db->SingleField("nome_" . str_replace("-", "_", $lang), "doc_occupazioni", "WHERE id='" . $q['occupazione'] . "'"), 0);
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 11);
    $pdf->SetFillColor(166, 76, 148);
    $pdf->Cell(0, 1, ' ', 0, 1, 'L', true);

    $pdf->Ln(10);

    if ($q['prima_volta'] == "Y")
        $pdf->Cell(0, 5, $text[$lang]['label_prima_volta_si'], 0);
    else
        $pdf->Cell(0, 5, $text[$lang]['label_prima_volta_no'], 0);
    $pdf->Ln(5);

    $pdf->Write(5, $text[$lang]['label_conoscenza_fattura'] . ' ' . $db->SingleField("nome_" . str_replace("-", "_", $lang), "doc_segnalato", "WHERE id='" . $q['conoscenza'] . "'"));
    $pdf->Ln(15);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetFillColor(166, 76, 148);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(0, 8, $text[$lang]['label_dati_formula'], 0, 1, 'L', true);

    $pdf->Ln(5);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(50, 5, $text[$lang]['label_periodo'], 0);
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(50, 5, $text[$lang]['label_dal'] . " " . $q['a_g'] . "-" . $q['a_m'] . "-" . $q['a_a'] . " " . $text[$lang]['label_al'] . "  " . $q['p_g'] . "-" . $q['p_m'] . "-" . $q['p_a'], 0);
    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(100, 5, $text[$lang]['label_formula'], 0);
    if ($q['formula'] == '1')
        $pdf->Cell(100, 5, $text[$lang]['label_campus'], 0);
    else
        $pdf->Cell(100, 5, $text[$lang]['label_housing'], 0);

    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(100, 5, $db->SingleField("nome_" . str_replace("-", "_", $lang), "doc_formule", "WHERE id='" . $q['formula'] . "'"), 0);

    if ($q['formula'] == '1')
        $pdf->Cell(100, 5, $db->SingleField("nome_" . str_replace("-", "_", $lang), "doc_campus", "WHERE id='" . $q['campus'] . "'"), 0);
    else
        $pdf->Cell(100, 5, $db->SingleField("nome_" . str_replace("-", "_", $lang), "doc_housing", "WHERE id='" . $q['housing'] . "'"), 0);

    if ($q['coabitazione']) {
        $pdf->Ln(10);
        $pdf->Cell(100, 5, $text[$lang]['label_coabitazione'] . ': ' . utf8_decode($q['coabitazione']), 0);
    }

    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 11);
    $pdf->SetFillColor(166, 76, 148);
    $pdf->Cell(0, 1, ' ', 0, 1, 'L', true);

    $pdf->Ln(10);


    if ($q['note']) {

        $pdf->Write(5, utf8_decode(strip_tags($q['note'])));
        $pdf->Ln(10);
    }
    if ($q['privacy']) {

        $pdf->Write(5, $text[$lang]['label_privacy_pdf']);
        $pdf->Ln(10);
    }

    if ($q['mailing']) {

        $pdf->Write(5, $text[$lang]['label_consenso_pdf']);
        $pdf->Ln(10);
    }

    $pdf->Output("./tmp/preiscrizione_sharing_" . $nf . ".pdf", "F");
    chmod("./tmp/preiscrizione_sharing_" . $nf . ".pdf", 0777);

    $allegato = "preiscrizione_sharing_" . $nf . ".pdf";

    $oggetto = $db->SingleField("valore", "config", "WHERE chiave='OGGETTO_" . str_replace("-", "_", $lang) . "'") . " N° " . $q['id'];

    $email = "<div style='text-align: right; margin-right: 70px; margin-top: 30px' ><img src='./img/prenotazione.jpg' height='50'>";
    $email .="<p style='text-align:left; margin-top:30px'>";

    $email .= $db->SingleField("valore", "config", "WHERE chiave='RISPOSTA_" . str_replace("-", "_", $lang) . "'");
    $email = str_replace("[DATA]", $data, $email);
    $email = str_replace("[NOME]", utf8_decode($q['nome']), $email);
    $email = str_replace("[COGNOME]", utf8_decode($q['cognome']), $email);
    	
	$dest = array (
        "0" => array("nome"=> $q['nome']." ".$q['cognome'], "email" =>$q['email']), 
        "1" => array("nome"=> "Booking Sh-Sharing.it" , "email" => "booking@sharing.to.it"), 
        //"2" => array("nome"=> "Test Developer" , "email" => "luciano@archynet.it") 
    );
	
	foreach($dest as $recipient) {
		$mail = new \PHPMailer\PHPMailer\PHPMailer;
		$mail->isSMTP();
		$mail->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
		$mail->Debugoutput = 'error_log';
		$mail->Host = "smtp.office365.com";
		$mail->Port = 587;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
		$mail->Username = "form@cooperativadoc.it";
		$mail->Password = "Docscs325!";
		$mail->Subject = $oggetto;
		$mail->SetFrom('form@cooperativadoc.it', 'Booking Sharing.to.it');
		$mail->addReplyTo('form@cooperativadoc.it', 'Booking Sharing.to.it');
		$mail->msgHTML($email, dirname(__FILE__), true);
		$mail->AltBody = $email;
		$mail->addAddress($recipient['email'], $recipient['nome']);
		$mail->addAttachment('./tmp/' . $allegato);
		$mail->send();
	}
    
    unlink("./tmp/preiscrizione_sharing_" . $nf . ".pdf");
    
}
?>