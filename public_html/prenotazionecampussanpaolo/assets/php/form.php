<?php
	session_start();
	
	header('Access-Control-Allow-Origin: https://'.$_SERVER['SERVER_NAME']);
	header('Access-Control-Allow-Methods: POST');
	header("Content-Type: application/json");
	
	require_once '../../../lib/class-db.php';
	require_once '../../../lib/form_functions.php';
	require_once './lang.php';


	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

		$db = new MySql_DB("localhost", "qualita", "qualita", "00qQUFDTOlKl6O3", true, 'utf8');
		$q = $_POST;

		$form = $_POST['from'];

		$campi    = array('nazionalita', 'occupazione', 'conoscienza','cellulare', 'nome', 'cognome', 'luogo_nascita','email','formula','facolta');

		switch($form) {
			case "campus":
				$table  = "ca_preiscrizioni";
				$q['formula'] = 1;
				break;
				
			case "sharing":
				$table  = "sh_preiscrizioni";
				break;
				
			case"fossata":
				$table  = "fo_preiscrizioni";
				break;
		}

		!$q['language'] ? $q['language'] ='it_IT':"";

		$lingua = $text[$q['language']] ;

		$folder = substr($q['language'], 0, 2);

		$error = "";


		#CAMPI NUMERICI
		foreach ($campi as $val) {
			if ($q[$val] ==  "" || !$q[$val])
				$error .= str_replace("[CAMPO]",$val,$lingua['error_obbligatorio']);
			else if(!isValidField($q[$val], $val))
				$error .= str_replace("[CAMPO]",$val,$lingua['error_nonvalido']);
		}

		if($form == 'sharing' || $form == 'fossata' ){
			if ($q['formula'] == 1 && ( !$q['campus'] || !isValidField($q['campus'], "numero")))
				$error .= $lingua['error_campus'];
			else if ($q['formula'] == 2 && ( !$q['housing'] || !isValidField($q['housing'], "numero")))
				$error .= $lingua['error_housing'];
			else
				$error .= $lingua['error_formula'];
		}
        else {
            $q['housing'] = 0;
        }

		#CAMPO NOTE
//~ 		if ($q['note'] != '' && !isValidField($q['note'],"note"))
//~ 			 $error .= str_replace("[CAMPO]",$val,$lingua['error_nonvalido']);
    
        if($q['note'] != '')
            $q['note'] = filter_var($q['note'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK);

		#CAMPO COABITAZIONE   
		if ($q['coabitazione'] != '' && !isValidField($q['coabitazione'],"note"))
			 $error .= str_replace("[CAMPO]",$val,$lingua['error_nonvalido']);

		#CAMPO PRIMA VOLTA
		if ($q['prima_volta'] != 'Y' && $q['prima_volta'] != 'N')
			   $error .= $lingua['error_privavolta'];

		#CAMPO PRIVACY
		if ($q['privacy'] != 'Y')
			   $error .= $lingua['error_privacy'];
			
		// VERIFICA CAPTCHA GOOGLE 
		$validationCaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LfUDhkTAAAAALqqSoDjoMg-9Zi284Mhk2Wo46so&response=' . $_POST['g-recaptcha-response'] . '&remoteip=' . $_SERVER['REMOTE_ADDR']);
		$recaptcha = json_decode($validationCaptcha, true);
		
		if ($recaptcha['success'] === false ) {
			$error .= "Codice captcha non valido <br>";
		}


		if (!$error) {
		
			$referer = $_SESSION['referer_site'];
			if(!$referer) $referer = 'S';

			$query = "INSERT INTO ".$table." (nome, cognome, data_nascita, luogo_nascita, nazionalita, sesso, email, cellulare, occupazione, prima_volta, conoscenza, formula, campus, housing, coabitazione, data_in, data_out, privacy, mailing, note, data_insert,lang , anno,refer, facoltaId)
					VALUES ('" . $db->escapeString($q['nome']) . "', '" . $db->escapeString($q['cognome']) . "', '" . reverseDate($q['data_nascita']) . "', '" . $db->escapeString($q['luogo_nascita']) . "', '" . $q['nazionalita'] . "',
					'" . $q['sesso'] . "', '" . $q['email'] . "', '" . $q['cellulare'] . "', '" . $q['occupazione'] . "', '" . $q['prima_volta'] . "', '" . $q['conoscienza'] . "',
					'" . $q['formula'] . "', '" . $q['campus'] . "', '" . $q['housing'] . "', '" . $db->escapeString($q['coabitazione']) . "', '" . reverseDate($q['data_arrivo']) . "', 
					'" . reverseDate($q['data_partenza']) . "', '" . $q['privacy'] . "', '" . $q['mailing'] . "', '" . $db->escapeString($q['note']) . "', NOW() ,'" . str_replace("_","-",$q['language']) . "' ,'".date("Y")."','".$referer."', '".$q['facolta']."' )";
			
			if($db->Query($query)) {
			
				$nf = $db->LastId();
				//$lines = file('https://qualita.cooperativadoc.it/politecnico/iscrizione.php?from='.$form.'&id='. $nf);
				
				$arrContextOptions=array(
					"ssl"=>array(
						"verify_peer"=>false,
						"verify_peer_name"=>false,
					),
				);  

				@file_get_contents('https://qualita.cooperativadoc.it/politecnico/iscrizione.php?from='.$form.'&id='. $nf, false, stream_context_create($arrContextOptions));
				
			
				$response = [
					'success' => true,
					'html' => '<div class="alert alert-success" role="alert">Richiesta di prenotazione inviata correttamente!</div>'
				];
				
				unset($_SESSION['referer_site']);
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