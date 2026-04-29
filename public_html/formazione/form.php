<?php

//~ 	ini_set('display_errors', 1);
//~ 	error_reporting(E_ALL ^ E_NOTICE);
	
	header('Access-Control-Allow-Origin: https://'.$_SERVER['SERVER_NAME']);
	header('Access-Control-Allow-Methods: POST');
	header("Content-Type: application/json");
	
	require_once '../lib/class-db.php';
	require_once '../lib/form_functions.php';

//~ session_start();
//~ include("/var/www/vhosts/cooperativadoc.it/childrenpark.cooperativadoc.it/libreria_mailer/PHPMailerAutoload.php");
//~ include("./assets/class-db.php");
//~ include("./assets/lang.php");
//~ include("./assets/functions.php");


	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

		//$db = new MySql_DB("localhost", "cooperativa_qualita", "coop_qualita", "coop5369s", true, 'utf8');
		$db = new MySql_DB("localhost", "qualita", "qualita", "00qQUFDTOlKl6O3", true);

		$qu = $_POST;


		$campi = array('campi_Doc' => array(
				'char' => array("ente_corso", "temi", "giudizio", "conduzione", "spazi", "livello", 'consiglia'),
				'obli' => array("temi", "giudizio", "conduzione", "spazi", "livello", 'consiglia', 'nome', 'data_corso',  'cognome', 'titolo'),
				'multi_char' => array('nome', 'cognome', 'titolo','ente_corso'),
				'note' => array('suggerimenti', 'argomenti'),
			)
		);

//~ 		if (!$_REQUEST['data_compilazione'])
//~ 			$data = date("Y") . "-" . date("m") . "-" . date("d");
//~ 		else
//~ 			$data = reverseDate($_POST['data_compilazione']);

		//$data_corso = reverseDate($_POST['data_corso']);
		$data_corso = (new DateTime($_POST['data_corso']))->format('Y-m-d');
		
		$qu['titolo'] = intval($qu['titolo']);
		$qu['titolo'] = $db->SingleField('titolo_corso', 'doc_formazione_titolo_corsi', 'WHERE id = "'.$db->escapeString($qu['titolo']).'"');

		if ($qu['idQ']) {

			$query = "UPDATE questionario_formazione SET
						lingua ='" . $qu['language'] . "' , 
						data_inserimento ='" . $data . "' , 
						ente ='" . $qu['ente'] . "' , 
						ente_corso ='" . $qu['ente_corso'] . "' , 
						tipo_corso ='" . $qu['tipo_corso'] . "' , 
						data_corso ='" . $data_corso . "' , 
						titolo ='" . $db->escapeString($qu['titolo']) . "' , 
						corso ='" . $qu['temi'] . "' , 
						giudizio ='" . $qu['giudizio'] . "' , 
						conduzione ='" . $qu['conduzione'] . "' , 
						spazi ='" . $qu['spazi'] . "' , 
						livello ='" . $qu['livello'] . "' , 
						consiglerebbe ='" . $qu['consiglia'] . "' , 
						argomenti ='" . $db->escapeString($qu['argomenti']) . "' , 
						suggerimenti ='" . $db->escapeString($qu['suggerimenti']) . "' , 
						nome ='" . $db->escapeString($qu['nome']) . "' , 
						cognome ='" . $db->escapeString($qu['cognome']) . "' , 
						anno='" . date("Y") . "'
						WHERE id ='" . $db->escapeString($qu['idQ']) . "'";
		}
		else {
			$query = "INSERT INTO questionario_formazione (lingua, data_corso, titolo, nome, cognome, ente, corso, giudizio, conduzione, spazi, livello, consiglia, argomenti, suggerimenti, anno, data_inserimento,ente_corso,tipo_corso) VALUES 
					('" . $qu['language'] . "','" . $data_corso . "' , '" . $db->escapeString($qu['titolo']) . "', '" . $db->escapeString($qu['nome']) . "', '" . $db->escapeString($qu['cognome']) . "', '" . $qu['ente'] . "', '" . $qu['temi'] . "', '" . $qu['giudizio'] . "',
					'" . $qu['conduzione'] . "', '" . $qu['spazi'] . "','" . $qu['livello'] . "', '" . $qu['consiglia'] . "', '" . $db->escapeString($qu['argomenti']) . "', '" . $db->escapeString($qu['suggerimenti']) . "','" . date("Y") . "' ,NOW() ,'" . $db->escapeString($qu['ente_corso']) . "' ,'" . $db->escapeString($qu['tipo_corso']) . "');";
		}

		$error = "";

		foreach ($qu AS $name => $value) {

			if (in_array($name, $campi['obli']) && $value == '')
				$error .= $name . " <br>";
			else if (in_array($name, $campi['char']) && !isValidField($value, 'char', 1))
				$error .= $name . " <br>";
			else if (in_array($name, $campi['multi_char']) && !isValidField($value, 'long_text'))
				$error .= $name . " <br>";
			else if (in_array($name, $campi['note']) && !isValidField($value, 'note'))
				$error .= $name . " <br>";
		}

		// VERIFICA CAPTCHA GOOGLE 
		$validationCaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LfUDhkTAAAAALqqSoDjoMg-9Zi284Mhk2Wo46so&response=' . $_POST['g-recaptcha-response'] . '&remoteip=' . $_SERVER['REMOTE_ADDR']);
		
		$recaptcha = json_decode($validationCaptcha, true);
		
		if ($recaptcha['success'] === false ) {
			$error .= "Codice captcha non valido <br>";
		}
		
		if (!$error) {
			if($db->Query($query)) {
				$response = [
					'success' => true,
					'html' => '<div class="alert alert-success" role="alert">Questionario compilato correttamente!</div>'
				];
			}
			else {
				$response = [
					'success' => false,
					'html' => '<div class="alert alert-danger" role="alert">Errore interno del server, riprovare!</div>'
				];
			}
		}
		else {
			$response = [
				'success' => false,
				'error' => $error,
				'html' => '<div class="alert alert-danger" role="alert">Ci sono i seguenti errori:<p>'.$error.'</p></div>'
			];
		}

//~ 		foreach ($qu as $id => $val)
//~ 			$email .= $id . "=>" . $val . "  <br> ";


//~ 		// MANDO EMAIL CON DATI
//~ 		$mailC->Subject = "Questionario Formazione  Doc S.c.s";
//~ 		$mailC->setFrom('questionario-formazione@cooperativadoc.it', 'Questionario Formazione Cooperativadoc.it');
//~ 		$mailC->addReplyTo('questionario-formazione@cooperativadoc.it', 'Questionario Formazione Cooperativadoc.it');
//~ 		$mailC->msgHTML($email, dirname(__FILE__), true);
//~ 		$mailC->AltBody = $email;
//~ 		$mailC->addAddress('djamal@archynet.it', 'Adoum Djamal');

//~ 		$mailC->send();

//~ 		if($error !='0')
//~ 			goToLocation("http://" . $_SERVER["SERVER_NAME"] . "/site/questionario-formazione");

//~ 		if ($qu['language'] == 'en-GB')
//~ 			goToLocation("http://" . $_SERVER["SERVER_NAME"] . "/site/completamento-questionario-formazione");
//~ 		else
//~ 			goToLocation("http://" . $_SERVER["SERVER_NAME"] . "/site/completamento-questionario-formazione");

	}
	else {
		$response = [
			'success' => false,
			'html' => '<div class="alert alert-danger" role="alert">Richiesta non valida!</div>'
		];
	}
	
	echo json_encode($response);
	exit;
?>