<?

include("../lib/class-db.php");
include("../lib/fpdf.php");
include("../lib/sendEmail.php");
include("./lang.php");
include("/var/www/vhosts/cooperativadoc.it/childrenpark.cooperativadoc.it/libreria_mailer/PHPMailerAutoload.php");


$db = new MySql_DB('localhost', 'qualita_scuolanaturamilano', 'qualitaSNM', 'kVz$h159', true);
$user = $db->FetchArray($db->Query("SELECT * FROM iscrizioni_casamia WHERE id='" . $_REQUEST['id'] . "'"));

$fileName = "preiscrizione_convegno_casa_mia_e_il_mondo_" . $_REQUEST['id'] . ".pdf";
$oggetto = $db->SingleField("txt", "_config", "WHERE val_key ='OGGETTO-CASAMIA' ");
$email = $db->SingleField("txt", "_config", "WHERE val_key='EMAIL-CASAMIA' ");
$email = str_replace("[DATA]", $data, $email);
$email = str_replace("[NOME]", utf8_decode($user['nome']), $email);
$email = str_replace("[COGNOME]", utf8_decode($user['cognome']), $email);

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
$mailC->setFrom('ED.EventoScuolaNatura@comune.milano.it', 'Convegno Scuola Natura: Casa Mia è il Mondo ');
$mailC->addReplyTo('ED.EventoScuolaNatura@comune.milano.it', 'Convegno Scuola Natura: Casa Mia è il Mondo ');
$mailC->msgHTML($email, dirname(__FILE__), true);
$mailC->AltBody = $email;
$mailC->addAddress('djamal@archynet.it', 'Adoum Djamal');
$mailC->addAttachment('./tmp/' . $fileName);
$mailC->addAttachment('./tmp/Programma_convegno_4_02_2017.pdf');
$mailC->send();


?>