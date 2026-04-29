#!/usr/bin/php
<?php

$libDb   = dirname(__FILE__).'/../lib/class-db.php';
$libMail = dirname(__FILE__).'/../lib/libreria_mailer/PHPMailerAutoload.php';

require_once($libDb);
require_once($libMail);

$db = new MySql_DB('localhost', 'qualita', 'qualita', '00qQUFDTOlKl6O3', true);

$ieri = date('Y-m-d', strtotime(' -1 day'));

$query = "SELECT v.incaricato as incaricato ,  v.compilatore ,  v.diario , v.verbale , v.dettaglio as descrizione , v.tipo_verifica as tipo , DATE_FORMAT(data_prevista,'%d-%m-%Y') as data_verifica , t.nome as tipo_verifica , v.unita_operativa as unita_op , o.nome as unita_verifica ,
                     u.nome as nome_verifica , u.cognome as cognome_verifica , u.email as email_verifica ,v.codice as codice_verifica , u.user_type , u.id as utente
                    FROM db_verifiche AS v 
                    LEFT JOIN utenti AS u ON v.incaricato = u.id 
                    LEFT JOIN doc_tipologie_verifiche AS t ON v.tipo_verifica = t.id
                    LEFT JOIN doc_unita AS o ON v.unita_operativa = o.id WHERE v.data_prevista ='".$ieri."'    ";
						
$verifiche = $db->CycleAssoch($db->Query($query));

					
		
if(count($verifiche)){
	
	for($x = 0 ; $x < count($verifiche); $x++){
		
		$mail = new PHPMailer;
		
		$txt  ="";
		$txt .= "<p><b>Ciao ti ricordiamo di caricare sul piano delle verifiche <u>il verbale</u> per seguente verifica ispettiva</b></p>";
		$txt .= "<p>Codice Verifica: <b>" . $verifiche[$x]['codice_verifica'] . "</b> </p>";
        $txt .= "<p>Tipo Verifica: <b>" . $verifiche[$x]['tipo_verifica'] . "</b> </p>";
        $txt .= "<p>Data Verifica: <b>" . $verifiche[$x]['data_verifica'] . "</b> <br /></p>";
        $txt .= "<p>Unit&agrave; operativa: <b>" . $verifiche[$x]['unita_verifica'] . "</b> <br /></p>";
        
		if($verifiche[$x]['tipo'] =='6')
			$txt .= "<p>Descrizione: <b>" . $verifiche[$x]['descrizione'] . "</b> <br /></p>";
		
		if ($verifiche[$x]['diario']) {
            $txt .= "Diario: <b>" . $verifiche[$x]['diario'] . "</b> </p>";
			$mail->addAttachment(dirname(__FILE__)."/../qualita_new/images/diari_verifiche/" . $verifiche[$x]['diario']);
        }
		if ($verifiche[$x]['verbale']) {
            $txt .= "Verbale: <b>" . $verifiche[$x]['verbale'] . "</b> </p>";
			$mail->addAttachment(dirname(__FILE__)."/../qualita_new/images/verbali_verifiche/".$verifiche[$x]['verbale']);
        }
		
		
		if( $verifiche[$x]['compilatore'] != $verifiche[$x]['incaricato'] ){
			$compilatore = $db-FetchArray($db->Query("SELECT * FROM utenti  WHERE id ='".$verifiche[$x]['compilatore']."'"));
			if($compilatore['user_type'] =='7')
				$mail->addAddress($compilatore['email'], $compilatore['nome'] . " " . $compilatore['cognome']);
		}else{
			if($dati["user_type"] == '7')
				$mail->addAddress($verifiche[$x]['email_verifica'], $verifiche[$x]['nome_verifica'] . " " . $verifiche[$x]['cognome_verifica']);
		}
				
		$oggetto = "Aggiunta Verbale Verifica";
					
		
    	$mail->isSMTP();
    	$mail->SMTPDebug = 0;
		$mail->Debugoutput = 'html';
		$mail->Host = "mail.archynet.it";
		$mail->Port = 25;
		$mail->SMTPAuth = true;
		$mail->Username = "coopdoc@archynet.it";
		$mail->Password = "smtpcoopdoc#1";
		$mail->setFrom('gest.qualita@cooperativadoc.it', 'Qualita cooperativadoc ');
		$mail->addReplyTo('gest.qualita@cooperativadoc.it', 'Qualita cooperativadoc ');

		$template = $db->SingleField("valore" ,"config", "WHERE chiave ='TEMPLATE_EMAIL' ");
		$template = str_replace("[TITOLO]", $oggetto, $template);
		
		$mail->Subject = $oggetto;
		$mail->addAddress('djamal@archynet.it', 'Adoum Djamal');
		$mail->msgHTML(str_replace("[MESSAGGIO]", $txt, $template), dirname(__FILE__), true);
		$mail->AltBody = str_replace("[MESSAGGIO]", $txt, $template);
		$mail->send();	
		
	}
}
?>