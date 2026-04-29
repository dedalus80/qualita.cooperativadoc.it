<?php
include("../lib/class-db.php");
include("../lib/fpdf.php");
include("../lib/sendEmail.php");
include("./lang.php");
require_once __DIR__.'/../vendor/autoload.php';

//$_REQUEST['id'] = '915';
//$_REQUEST['from'] = 'sharing';

$from = $_REQUEST['from'];
$ID   = intval($_REQUEST['id']);

if(!$ID) exit;

global $LOGO_PDF;

$table_formule = "doc_formule";

switch($from) {
    case"campus":
        $table = "ca_preiscrizioni";
        $refer = "CA";
        $MAIL  = "booking@campussanpaolo.it";
        $LOGO_MAIL = "logo-mail-campus.png";
        $LOGO_PDF  = "logo-pdf-campus.jpg";
        $extraEmail = "booking@campussanpaolo.it";
        $extraUser  = "Booking Campus San Paolo";
		break;
    case"fossata":
        $table ="fo_preiscrizioni";
        $refer = "FO";
        $MAIL  = "booking@cascinafossata.it";
        $LOGO_MAIL = "logo-mail-cascinafossata.png";
        $LOGO_PDF  = "logo-pdf-cascinafossata.jpg";
        $extraEmail = "booking@cascinafossata.it";
        $extraUser  = "Booking Cascina Fossata";
		break;
    default:
        $table ="sh_preiscrizioni";
        $refer = "SH";
        $MAIL  = "booking@sharing.to.it";
        $LOGO_MAIL = "logo-mail-sharing.png";
        $LOGO_PDF  = "logo-pdf-sharing.jpg";
        $extraEmail = "booking@sharing.to.it";
        $extraUser  = "Booking Sharing.to.it";
		break;
}

if($_REQUEST['tipo'] =='F'){
    $tipo = $_REQUEST['tipo'];
    $LOGO_MAIL = "logo-mail-cascinafossata.png";
    $LOGO_PDF  = "logo-pdf-cascinafossata.jpg";
    $label     = "CASCINA FOSSATA";    
    $TPL       = "FOSSATA";
    $ALL       = "cascinafossata";
    $COLOR     ='26,39,69';
}else{
    $label     = "SH SHARING";    
    $TPL       = "SHARING";
    $ALL       = "sh_sharing";
    $COLOR     ='66,28,66';
}

$db = new MySql_DB("localhost", "qualita", "qualita", "00qQUFDTOlKl6O3", true);

// REcupero prima la lingua che mi serve per costruire la query 
$lang = str_replace("-","_",$db->SingleField("lang", $table, " WHERE id='" . $ID . "'" ) );

!$lang ? $lang = "it_IT":"";


$db->Query("SET lc_time_names = '".$lang."' ");


$query = " SELECT i.note, i.mailing, i.luogo_nascita , i.sesso , i.nome, i.cognome , i.email , i.cellulare ,i.privacy, i.coabitazione, n.nome as nazione, ca.nome as camera ,
i.formula as id_formula, o.nome_".$lang." as occupazione , s.nome_".$lang." as conoscenza , f.nome_".$lang." as  formula ,
c.nome_".$lang." as campus , DATE_FORMAT(i.data_in,'%a %d %M %Y') as arrivo , DATE_FORMAT(i.data_out,'%a %d %M %Y') as partenza ,
h.nome_".$lang." as housing ,  DATE_FORMAT (i.data_nascita,'%d %M %Y') as nascita FROM  ".$table." AS i 
LEFT JOIN doc_nazioni AS n ON i.nazionalita = n.id
LEFT JOIN doc_occupazioni AS o ON i.occupazione = o.id
LEFT JOIN doc_segnalato AS s ON i.conoscenza = s.id
LEFT JOIN doc_formule AS f ON i.formula = f.id
LEFT JOIN doc_campus AS c ON i.campus = c.id
LEFT JOIN doc_housing AS h ON i.housing = h.id
LEFT JOIN doc_camere AS ca ON i.campus = ca.id
WHERE i.id='" . $ID . "' ";


$q = $db->FetchArray($db->Query($query));

if ($q) {
    
    $db->Query("INSERT INTO 0_preiscrizioni (id_refer, refer, data) VALUES (".$ID.",'".$refer."',NOW() )");
    $IDSH = $db->LastId()."-".$refer."-".$ID;
    
    
    class PDF extends FPDF {
        
        function Header() {
            global $LOGO_PDF;
            $this->Image('./img/'.$LOGO_PDF, 120, 12, '70');
            $this->SetFont('Arial', '', 12);
        }

        function Footer() {
            global $label;

            $this->SetY(-6);
            $this->SetFont('Arial', '', 8);
            $this->Cell(0, 0, iconv('UTF-8', 'windows-1252', $label.' è una gestione Sharing s.r.l | Via Assietta 16/b 10128 Torino  | P.iva e C.F 10442110010 T +39.0112243024 F +39.0112243041'), 0, 0, 'C');
        }

        function ChapterBody($file) {
            global $f;

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

    $pdf->Cell(50, 5, $text[$lang]['label_torino'] . ' :' . date("d-m-Y"), 0);
    $pdf->Ln(5);
    $pdf->Cell(100, 5, $text[$lang]['label_preiscrizione'] . " N:" . $IDSH, 0);

    $pdf->Ln(15);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetTextColor(255, 255, 255);
    $tipo == 'F' ? $pdf->SetFillColor(26,39,69): $pdf->SetFillColor(66,28,66);
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
    $pdf->Cell(60, 5, $text[$lang]['label_natoil'], 0);
    $pdf->Cell(60, 5, $text[$lang]['label_natoa'], 0);
    $pdf->Cell(60, 5, iconv('UTF-8', 'windows-1252',$text[$lang]['label_nazionalita_pdf']), 0);

    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(60, 5, $q['nascita'], 0);
    $pdf->Cell(60, 5, iconv('UTF-8', 'windows-1252', $q['luogo_nascita']), 0);
    $pdf->Cell(60, 5, $q['nazione'], 0);
    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(60, 5, $text[$lang]['label_cellulare'], 0);
    $pdf->Cell(60, 5, $text[$lang]['label_email'], 0);
    $pdf->Cell(60, 5, $text[$lang]['label_occupazione'], 0);

    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(60, 5, $q['cellulare'], 0);
    $pdf->Cell(60, 5, $q['email'], 0);
    $pdf->Cell(60, 5, $q['occupazione'], 0);
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 11);
    $pdf->SetFillColor($COLOR);
    $pdf->Cell(0, 1, ' ', 0, 1, 'L', true);

    $pdf->Ln(5);
    $pdf->Cell(0, 5, $q['prima_volta'] == "Y" ? iconv('UTF-8', 'windows-1252', $text[$lang]['label_prima_volta_si_'.$from]): iconv('UTF-8', 'windows-1252', $text[$lang]['label_prima_volta_no_'.$from]) , 0);
    $pdf->Ln(5);

    $pdf->Write(5, iconv('UTF-8', 'windows-1252', $text[$lang]['label_conoscenza_fattura_'.$from] . ' ' . $q['conoscenza']));
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 11);
    $tipo == 'F' ? $pdf->SetFillColor(26,39,69): $pdf->SetFillColor(66,28,66);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(0, 8, $text[$lang]['label_dati_formula'], 0, 1, 'L', true);

    $pdf->Ln(5);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(50, 5, $text[$lang]['label_periodo'], 0);
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(50, 5, $text[$lang]['label_dal'] . " " . $q['arrivo'] . " " . $text[$lang]['label_al'] . "  " . $q['partenza'] , 0);
    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(100, 5, $text[$lang]['label_formula'], 0);
    //$pdf->Cell(100, 5, $q['id_formula'] == 2 ?  $text[$lang]['label_campus'] : $text[$lang]['label_housing'], 0);
    $pdf->Cell(100, 5, $text[$lang]['label_type_accomodation'], 0);
    
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(100, 5, $q['formula'], 0);
    if($from =='sharing' || $from =='fossata')
        //$pdf->Cell(100, 5, $q['id_formula'] == 2 ? $q['campus']: $q['housing'], 0);
        $pdf->Cell(100, 5, $q['campus'], 0);
    else
        $pdf->Cell(100, 5, $q['id_formula'] == 1 ? $q['camera']: $q['housing'], 0);
    
    $pdf->Ln(10);

    if ($q['coabitazione']) {
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(100, 5, $text[$lang]['label_coabitazione'], 0);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Write(5, iconv('UTF-8', 'windows-1252', $q['coabitazione']));
        $pdf->Ln(10);
    }
    
    if ($q['note']) {
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(100, 5, $text[$lang]['label_note'], 0);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Write(5, iconv('UTF-8', 'windows-1252', strip_tags($q['note'])));
        $pdf->Ln(10);
    }
    
    $pdf->SetFont('Arial', '', 11);
    $tipo == 'F' ? $pdf->SetFillColor(26,39,69): $pdf->SetFillColor(66,28,66);
    $pdf->Cell(0, 1, ' ', 0, 1, 'L', true);
    $pdf->Ln(5);
    
    if ($q['privacy']) {
        $pdf->Write(5,  str_replace("[USER]",$q['nome']." ".$q['cognome'], iconv('UTF-8', 'windows-1252',$text[$lang]['label_privacy_pdf']) ) );
        $pdf->Ln(10);
    }
    
    if ($q['mailing']) {

        $pdf->Write(5, iconv('UTF-8', 'windows-1252',$text[$lang]['label_consenso_pdf']));
        $pdf->Ln(5);
    }
    
    $allegato = "./tmp/preiscrizione_".$ALL."_" . $IDSH . ".pdf";
    
    $pdf->Output($allegato, "F");
    chmod($allegato, 0777);
    
    $oggetto = $db->SingleField("valore", "config", "WHERE chiave='OGGETTO_" .  $lang . "_".$TPL."'");
    $oggetto = str_replace("[NF]", $IDSH, $oggetto);

    $email = $db->SingleField("valore", "config", "WHERE chiave='RISPOSTA_" . $lang . "_".$TPL."'");
    
    $email = str_replace("[DATA]"," ".date("d-m-Y"), $email);
    $email = str_replace("[USER]", utf8_decode($q['nome']." ".$q['cognome']), $email);
    $email = str_replace("[EMAIL]", $MAIL,$email);
    
    $template =  $db->SingleField("valore", "config", "WHERE chiave='TEMPLATE_".$TPL."'");
    
    $email = str_replace("[MESSAGGIO]",$email, $template);
    $email = str_replace("[TITOLO]",strtoupper($oggetto), $email);
    $email = str_replace("[LOGO]",$LOGO_MAIL, $email);
    
    $dest = array (
        "0" => array("nome"=> $q['nome']." ".$q['cognome'], "email" =>$q['email']), 
        "1" => array("nome"=> "Booking Sh-Sharing.it" , "email" => "pre-iscrizioni@sh-sharing.it"), 
        "2" => array("nome"=> $extraUser , "email" => $extraEmail) ,
        //"3" => array("nome"=> "Test Developer" , "email" => "tech@messageglobe.it") 
    );
    
    foreach($dest as $recipient) {
        $mail = new \PHPMailer\PHPMailer\PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
        $mail->Debugoutput = 'error_log';
        $mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
        $mail->Host = "smtp.office365.com";
        $mail->Port = 587;
        $mail->Username = "form@cooperativadoc.it";
        $mail->Password = "Docscs325!";
        $mail->Subject = $oggetto;
        $mail->setFrom('form@cooperativadoc.it', 'Booking Sh-Sharing');
        $mail->addReplyTo('booking@sh-sharing.it', 'Booking Sh-Sharing');
        $mail->msgHTML($email, dirname(__FILE__), true);
        $mail->AltBody = $email;
        $mail->addAttachment($allegato);
        $mail->addAddress($recipient['email'], $recipient['nome']);
        $mail->send();
    }
    
    unlink($allegato);
}
