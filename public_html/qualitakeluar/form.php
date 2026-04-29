<?php
//~ 	session_start();
	
	header('Access-Control-Allow-Origin: https://'.$_SERVER['SERVER_NAME']);
	header('Access-Control-Allow-Methods: POST');
	header("Content-Type: application/json");
	
	require_once '../lib/class-db.php';
	
	//include("./assets/sendEmail.php");
	//include("./assets/lang.php");
	//include("./assets/functions.php");
	
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') { 

		$db = new MySql_DB("localhost", "qualita", "qualita", "00qQUFDTOlKl6O3", true);
		$qu = $_POST;

		

		$img = "qu-keluar.png";
		$mail = "info@keluar.it";

		$campi = array('campi_keluar' => array (
				'char' => array('camera_pulizia', 'camera_confort', 'rapporto_keluar', 'trasporto_tempi', 'ristorante_servizio', 'ristorante_cibo', 'ristorante_menu', 'personale_cortesia', 'personale_disponibilita', 'consiglia'),
				'multi_char' => array('nome', 'cognome', 'scuola'),
				'note' => 'suggerimenti'
			),
		);

	//~ if (!$_POST['data_compilazione'])
	//~     $data = date("Y") . "-" . date("m") . "-" . date("d");
	//~ else {
	//~     $d = explode("-", $_POST['data_compilazione']);
	//~     $data = $d[2] . "-" . $d[1] . "-" . $d[0];
	//~ }

		$field = "campi_keluar";

		$query = "INSERT INTO questionario_keluar ( nome, cognome, sede_operativa, scuola, data_consegna, data_restituzione, viaggio_complessivo,camera_pulizia,camera_confort,";
		$query .="struttura_complessivo,struttura_nome, rapporto_keluar, trasporto_nome,trasporto_qualita,trasporto_cortesia,trasporto_tempi, ristorante_servizio, ";
		$query .="ristorante_cibo, ristorante_menu, personale_cortesia, personale_disponibilita, escursioni_itinerari, escursioni_guida, neve_noleggio,";
		$query .="neve_scuola, laboratori_tecnici, laboratori_competenze, consiglia, suggerimenti,anno) VALUES ('" . $db->escapeString($qu['nome']) . "','" . $db->escapeString($qu['cognome']) . "', '" . $db->escapeString($qu['sede_operativa']) . "', '" . $db->escapeString($qu['scuola']) . "',";
		$query .=" '" . $db->escapeString($data) . "', '" . date('Y-m-d') . "' , '" . $db->escapeString($qu['viaggio_complessivo']) . "','" . $db->escapeString($qu['camera_pulizia']) . "','" . $db->escapeString($qu['camera_confort']) . "', '" . $db->escapeString($qu['struttura_complessivo']) . "','" . $db->escapeString($qu['struttura_nome']) . "', '" . $db->escapeString($qu['rapporto_keluar']) . "', '" . $db->escapeString($qu['trasporto_nome']) . "', '" . $db->escapeString($qu['trasporto_qualita']) . "', ";
		$query .="'" . $db->escapeString($qu['trasporto_cortesia']) . "', '" . $db->escapeString($qu['trasporto_tempi']) . "', '" . $db->escapeString($qu['ristorante_servizio']) . "', '" . $db->escapeString($qu['ristorante_cibo']) . "', '" . $db->escapeString($qu['ristorante_menu']) . "', ";
		$query .=" '" . $db->escapeString($qu['personale_cortesia']) . "', '" . $db->escapeString($qu['personale_disponibilita']) . "', '" . $db->escapeString($qu['escursioni_itinerari']) . "', '" . $db->escapeString($qu['escursioni_guida']) . "', '" . $db->escapeString($qu['neve_noleggio']) . "', '" . $db->escapeString($qu['neve_scuola']) . "',";
		$query .="'" . $db->escapeString($qu['laboratori_tecnici']) . "', '" . $db->escapeString($qu['laboratori_competenze']) . "', '" . $db->escapeString($qu['consiglia']) . "', '" . strip_tags($db->escapeString($qu['suggerimenti'])) . "' ,'".date("Y")."');";
		$table = "questionario_keluar";

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
			else if ($name == 'email' && !isValidField($value, 'email'))
				$error .= $name . " <br>";
			else if ($name == 'cellulare' && !isValidField($value, 'cellulare'))
				$error .= $name . " <br>";
		}

		// VERIFICA CAPTCHA GOOGLE 
		$validationCaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6Le5oZgeAAAAAHNwkN_Qj4Fh6lKIorv_r6ZV4c7Y&response=' . $_POST['g-recaptcha-response'] . '&remoteip=' . $_SERVER['REMOTE_ADDR']);
		
		$recaptcha = json_decode($validationCaptcha, true);
		
		if ($recaptcha['success'] === false ) {
			$error .= "Codice captcha non valido <br>";
		}

		if (!$error) {
			if ($qu['nome'] != '' && $qu['cognome'] != '' && $qu['nome'] != 'unknown' && $qu['cognome'] != 'unknown')
				$userExist = $db->SingleField("id", $table, " WHERE nome = '" . $db->escapeString($qu['nome']) . "'  AND cognome ='" . $db->escapeString($qu['cognome']) . "' ");
			

			if (!$userExist && $qu['nome'] != 'unknown' && $qu['cognome'] != 'unknown') {
				if ($db->Query($query)) {
					file("https://qualita.cooperativadoc.it/pushnotification/push.php?site=KELL&id=" . $db->LastId());
				
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
					'html' => '<div class="alert alert-danger" role="alert">Questionario già compilato!</div>',
					'sql' => $query
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