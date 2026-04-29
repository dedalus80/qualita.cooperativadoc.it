<?php
	header('Access-Control-Allow-Origin: https://'.$_SERVER['SERVER_NAME']);
	header('Access-Control-Allow-Methods: POST');
	header("Content-Type: application/json");
	
	require_once '../lib/class-db.php';
	require_once '../lib/form_functions.php';

    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

        $db = new MySql_DB("localhost", "qualita", "qualita", "00qQUFDTOlKl6O3", true, 'utf8');
        
        $qu = $_POST;

        $campi = array('campi_Doc' => array(
                'obli' => array("albergo", "arrivo", "partenza", "tipologia", "conoscenza","tipologia_soggiorno" ),
                'char' => array('vacanza', 'struttura_pulizia', 'struttura_complessivo', 'stanza_confort', 'stanza_arredi', 'stanza_pulizia', 'stanza_complessivo', 'personale_cortesia', 'personale_professionalita', 'personale_complessivo', 'consiglia'),
                'multi_char' => array('nome', 'cognome'),
                'note' => 'suggerimenti',
                'email' => 'email',
                'cellulare' => 'numero'
            )
        );

//~ if (!$_REQUEST['data_compilazione'])
//~     $data = date("Y") . "-" . date("m") . "-" . date("d");
//~ else {
//~     $data = reverseDate($_POST['data_compilazione']);
//~ }

        $giorni = getNight($_POST['arrivo'], $_POST['partenza']);
        $arrivo = reverseDate($_POST['arrivo']);
        $partenza = reverseDate($_REQUEST['partenza']);

        if($qu['tipologia_soggiorno']=='2')
            $attivita = $qu['attivita_complessivo'];

		if ($qu['idQ']) {
			$query = "UPDATE questionario_sharing SET
						lingua ='" . $qu['language'] . "' , 
						data_restituzione ='" . $data . "' , 
						soggiorno ='" . $qu['albergo'] . "' , 
						data_arrivo ='" . $arrivo . "' , 
						data_partenza ='" . $partenza . "' , 
						tipologia_cliente ='" . $qu['tipologia'] . "' , 
						tipologia_soggiorno ='" . $qu['tipologia_soggiorno'] . "' ,     
						giorni_permanenza ='" . $giorni . "' , 
						conoscenza ='" . $qu['conoscenza'] . "' , 
						vacanza ='" . $qu['viaggio_complessivo'] . "' , 
						attivita_complessivo ='" . $qu['attivita_complessivo'] . "' , 
						struttura_complessivo ='" . $qu['struttura_complessivo'] . "' , 
						struttura_pulizia ='" . $qu['struttura_pulizia'] . "' , 
						stanza_complessivo ='" . $qu['camera_complessivo'] . "' , 
						stanza_confort ='" . $qu['camera_comfort'] . "' , 
						ristorante_complessivo ='" . $qu['ristorante_complessivo'] . "' , 
						ristorante_servizio ='" . $qu['ristorante_servizio'] . "' , 
						ristorante_cibo ='" . $qu['ristorante_qualita'] . "' , 
						personale_complessivo ='" . $qu['personale_complessivo'] . "' , 
						personale_cortesia ='" . $qu['personale_cortesia'] . "' , 
						personale_professionalita ='" . $qu['personale_professionalita'] . "' , 
						consiglia ='" . $qu['consiglia'] . "' , 
						suggerimenti ='" . addslashes($qu['suggerimenti']) . "' , 
						info ='" . $qu['info'] . "' , 
						nome ='" . addslashes($qu['nome']) . "' , 
						cognome ='" . addslashes($qu['cognome']) . "' , 
						email ='" . $qu['email'] . "' , 
						cellulare ='" . $qu['cellulare'] . "',
						refer ='SHARING',
						anno='" . date("Y") . "'
						WHERE id ='" . $qu['idQ'] . "'";
		}
		else {
			$query = "INSERT INTO questionario_sharing ( nome, cognome, lingua, email, cellulare, data_arrivo, data_partenza, conoscenza,
						tipologia_cliente, giorni_permanenza,  data_restituzione, vacanza, struttura_pulizia, soggiorno,
						struttura_complessivo, stanza_confort,  stanza_complessivo, ristorante_servizio,tipologia_soggiorno,attivita_complessivo ,
						ristorante_cibo, ristorante_complessivo, personale_cortesia, personale_professionalita,
						personale_complessivo, consiglia, suggerimenti, info, anno ,refer ) VALUES 
						('" . addslashes($qu['nome']) . "','" . addslashes($qu['cognome']) . "' , '" . $qu['language'] . "', '" . $qu['email'] . "', '" . $qu['cellulare'] . "', '" . $arrivo . "', '" . $partenza . "', '" . $qu['conoscenza'] . "',
						'" . $qu['tipologia'] . "', '" . $giorni . "','" . date('Y-m-d') . "', '" . $qu['viaggio_complessivo'] . "', '" . $qu['struttura_pulizia'] . "', '" . $qu['albergo'] . "',
						'" . $qu['struttura_complessivo'] . "', '" . $qu['camera_comfort'] . "', '" . $qu['camera_complessivo'] . "', '" . $qu['ristorante_servizio'] . "', '" . $qu['tipologia_soggiorno'] . "' , '" . $attivita . "',
						'" . $qu['ristorante_qualita'] . "', '" . $qu['ristorante_complessivo'] . "', '" . $qu['personale_cortesia'] . "', '" . $qu['personale_professionalita'] . "',
						'" . $qu['personale_complessivo'] . "', '" . $qu['consiglia'] . "', '" . addslashes($qu['suggerimenti']) . "','" . $qu['info'] . "', '" . date("Y") . "' ,'SHARING' );";
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
			else if ($name == 'email' && $value && !isValidField($value, 'email'))
				$error .= $name . " <br>";
			else if ($name == 'cellulare' && $value && !isValidField($value, 'cellulare'))
				$error .= $name . " <br>";
		}


		// VERIFICA CAPTCHA GOOGLE 
		$validationCaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LfUDhkTAAAAALqqSoDjoMg-9Zi284Mhk2Wo46so&response=' . $_POST['g-recaptcha-response'] . '&remoteip=' . $_SERVER['REMOTE_ADDR']);
		$recaptcha = json_decode($validationCaptcha, true);
		
		if ($recaptcha['success'] === false ) {
			$error .= "Codice captcha non valido <br>";
		}

		if (!$error){
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
//~ 		$mailC->Subject = "Questionario Qualita Sharing";
//~ 		$mailC->setFrom('questionario@sharing.to.it', 'Questionario Qualita Sharing.it');
//~ 		$mailC->addReplyTo('questionario@sharing.to.it', 'Questionario Qualita Sharing.it');
//~ 		$mailC->msgHTML($email, dirname(__FILE__), true);
//~ 		$mailC->AltBody = $email;
//~ 		$mailC->addAddress('djamal@archynet.it', 'Adoum Djamal');

//~ 		$mailC->send();

//~ 		// MANDO EMAIL AL CENTRO NOTIFICHE 
//~ 		file("https://qualita.cooperativadoc.it/pushnotification/push.php?site=SHA&id=".$db->LastId());


//~ 		if ($qu['language'] == 'en-GB')
//~ 			goToLocation("http://" . $_SERVER["SERVER_NAME"] . "/site/surbey");
//~ 		else
//~ 			goToLocation("http://" . $_SERVER["SERVER_NAME"] . "/site/questionario");

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