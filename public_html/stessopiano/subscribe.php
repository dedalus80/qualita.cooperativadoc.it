<?php
session_start();
include("./include/class-db.php");

function reverseDate($date) {
    $d = explode("-", $date);
    return $d[2] . "-" . $d[1] . "-" . $d[0];
}

function goToLocation($location) {
    header("Location: $location ");
}

function isValidField($field, $type = NULL, $max_lenght = NULL, $min_length = null) {

    switch ($type) {
        case"email":
            $pattern = "/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9_\.\-]+\.[a-z]{2,6}$/";
            break;
        case"nome":
        case"cognome":
            $pattern = "/^[a-zA-Z������ ]*$/";
            break;
        case"misti":
            $pattern = "/^[a-zA-Z0-9������ ]*$/";
            break;
        case"password":
            $pattern = "/^[a-zA-Z0-9]*$/";
            break;
        case"numero":
            $pattern = "/^[0-9]*$/";
            break;
        case"data":
            $pattern = "/^([0-9]{2}-[0-9]{2}-[0-9]{4})*$/";
            $pattern = "/^[0-9]*$/";
            break;
        default:
            $pattern = "/^[a-zA-Z0-9������_\. -]*$/";
            break;
    }

    if (preg_match($pattern, $field)) {
        if ($max_lenght && strlen($field) > $max_lenght)
            $ko = 1;
        if ($min_length && strlen($field) < $min_length)
            $ko = 1;
    }
    else
        $ko = 1;

    if ($ko == 1)
        return "no valid";
    else
        return $field;
}


$db = new MySql_DB("localhost", "qualita_1_sito", "qualita_1_sito", '^B&FpWPQ7*;TDFm', true);
$q = $_POST;

$enumCampi = array("S", "M", "S", "N", "U", "I", "E", "Y", "GE", "SO", "AL", "AM", "PE", "AB", "ALT", "L","F");

$data = array("data_in", "data_out", "data_nascita", "scadenza_documento", "lavoratore_scadenza");
$alfanumerici = array('giorni_visita', 'note', 'interesse');
$misti = array('numero_documento', 'permesso_soggiorno');
$numerici = array(
                'amici_quanti', 'cap', 'numero_civico', 'provincia', 'nazionalita', 'occupazione', 'coabitare', 'conoscenza', 'cellulare', 'tipo_appartamento', 'tipo_camera', 'livello',
                'livello_det', 'coinquilini_quanti', "dove_vive", 'camera_amici', 'amici_genere', 'amici_occupazione', 'amici_eta', 'amici_fumo', 'amici_animali', 'nuova_residenza', 'dove_vive',
                'lavoratore_tipo'
            );
$testuali = array(
                'camera_amici_dettaglio', 'occupazione_det',  'studente_det','dove_vive_altro', 'livello_det', 'camera_amici_dettaglio', 'amici_animali_dettaglio', 'dove_vive_altro',
                'conoscenza_det', 'tipo_documento', 'nome', 'cognome', 'luogo_nascita', 'occupazione_det', 'animali_det', 'codice_fiscale', 'residenza', 'indirizzo','studente_livello','lavoratore_altro'
            );
$enum = array('camera_amici', 'camera_singola', 'camera_doppia', 'camera_indiferente', 'prima_volta', 'appartamento', 'camera', 'coinquilini', 'fumatore', 'animali', 'consenso', 'mailing', 'media', 'privacy', "sesso");
$obbligatori = array('nome', 'cognome', 'email', 'cellulare', 'data_nascita', 'luogo_nascita', 'nazionalita', 'sesso', 'residenza', 'occupazione', 'prima_volta', 'privacy', "data_in", "data_out");
$error = 0;

foreach ($q AS $id => $val) {
    if (!in_array($id, $misti) && !in_array($id, $data) && !in_array($id, $alfanumerici) && !in_array($id, $numerici) && !in_array($id, $testuali) && !in_array($id, $enum))
        $manca .= "MANCO CONTROLLO " . $id . " => " . $val . "<br />";
}


#CAMPI OBBLIGATORI ------------------------------------------------------------------------------------------------------------------------------------------------------------
foreach ($obbligatori as $id => $val) {
    if (!$q[$val])
        $error .= "errore campo obbligatorio " . $id . " == >" . $q[$val] . ":" . $val . " \n <br>";
}




#CAMPI NUMERICI ------------------------------------------------------------------------------------------------------------------------------------------------------------
foreach ($numerici as $val) {
    if ($q[$val] == "0" && !isValidField($q[$val], "numero"))
        $error .= "errore campo numerico " . $id . " == >" . $q[$val] . ":" . $val . " \n <br>";
}

#CAMPI TESTUTALI CON SPAZIO ------------------------------------------------------------------------------------------------------------------------------------------------------------
foreach ($testuali as $id => $val) {
    if ($q[$val] != "" && !isValidField($q[$val], "nome"))
        $error .= "errore campo Testo " . $id . " == >" . $q[$val] . ":" . $val . " \n <br>";
    else
        $q[$val] = addslashes($q[$val]);
}

#CAMPI MISTI TESTO / NUMERICI CON SPAZIO ------------------------------------------------------------------------------------------------------------------------------------------------------------
foreach ($misti as $id => $val) {
    if ($q[$val] != "" && !isValidField($q[$val], "misti"))
        $error .= "errore campo Misto " . $id . " == >" . $q[$val] . ":" . $val . " \n <br>";
    else
        $q[$val] = addslashes($q[$val]);
}


#CAMPO CHECBOX ------------------------------------------------------------------------------------------------------------------------------------------------------------
foreach ($enum as $id => $val) {
    if ($q[$val] != "" && !in_array($q[$val], $enumCampi))
        $error .= "errore campo checkBox " . $id . " == >" . $q[$val] . ":" . $val . " \n <br>";
}

#CAMPO TESTO LIBERO ------------------------------------------------------------------------------------------------------------------------------------------------------------
foreach ($alfanumerici as $id => $val) {
    if ($q[$val] != "" && !isValidField($q[$val], "testo"))
        $error .= "errore campo Testo lungo " . $id . " == >" . $q[$val] . ":" . $val . " \n <br>";
    else
        $q[$val] = addslashes($q[$val]);
}

#CAMPO EMAIL ------------------------------------------------------------------------------------------------------------------------------------------------------------
if (!isValidField($q['email'], "email"))
    $error .= "errore campo email " . $q['email'] . " \n <br>";

// VERIFICA CAPTCHA GOOGLE 
$response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LcjLiATAAAAADxhqLN1ykknoGAoFOxa80cH56KW&response=' . $_POST['g-recaptcha-response'] . '&remoteip=' . $_SERVER['REMOTE_ADDR']);
$responseDecoded = json_decode($response);
if ($responseDecoded->success == false)
    $error .= " Codice captcha non valido <br>";




if ($error == "0") {

    $quartieri = implode(",", $q['quartiere']);

    if ($q['language'])
        $lang = $q['language'];
    else
        $lang = 'it-IT';

    $valueQuery = array();
    foreach($q as $key => $value) {
        if(!is_array($value))
            $valueQuery[$key] = $db->escape($value);
    }

    $query = " INSERT INTO sp_preiscrizioni (
        nome, cognome, data_nascita, luogo_nascita, nazionalita, codice_fiscale, residenza, cap, provincia, studente_livello, lavoratore_tipo, lavoratore_altro, lavoratore_scadenza,
        indirizzo, numero_civico, tipo_documento, numero_documento, scadenza_documento, permesso_soggiorno, 
        sesso, email, cellulare, occupazione, occupazione_det, prima_volta, conoscenza, conoscenza_det, 
        dove_vive, dove_vive_altro, camera_amici, camera_amici_dettaglio, amici_genere, amici_occupazione,
        amici_eta, amici_fumo, amici_animali, amici_animali_dettaglio, nuova_residenza, giorni_visita,
        appartamento, tipo_appartamento, camera, tipo_camera, livello, livello_altro,
        coinquilini, coinquilini_n, quartieri, fumatore, animali, animali_det, interessato,
        coabitazione, data_in, data_out, privacy, mailing, note, data_insert, formula, lang, anno ,amici_quanti ,camera_singola, camera_doppia, camera_indiferente, studente_det, media) VALUES ( ";

    $query .=" '" . $valueQuery['nome'] . "','" . $valueQuery['cognome'] . "', '" . reverseDate($valueQuery['data_nascita']) . "','" . $valueQuery['luogo_nascita'] . "','" . $valueQuery['nazionalita'] . "',  '" . $valueQuery['codice_fiscale'] . "', '" . $valueQuery['residenza'] . "',
        '" . $valueQuery['cap'] . "', '" . $valueQuery['provincia'] . "', 
        '".$valueQuery['studente_livello']."', '".$valueQuery['lavoratore_tipo']."', '".$valueQuery['lavoratore_altro']."', '".reverseDate($valueQuery['lavoratore_scadenza'])."',
        '" . $valueQuery['indirizzo'] . "', '" . $valueQuery['numero_civico'] . "', '" . $valueQuery['tipo_documento'] . "', '" . $valueQuery['numero_documento'] . "', 
        '" . reverseDate($valueQuery['scadenza_documento']) . "', '" . $valueQuery['permesso_soggiorno'] . "', '" . $valueQuery['sesso'] . "', '" . $valueQuery['email'] . "', '" . $valueQuery['cellulare'] . "','" . $valueQuery['occupazione'] . "', 
        '" . $valueQuery['occupazione_det'] . "', '" . $valueQuery['prima_volta'] . "', '" . $valueQuery['conoscenza'] . "', '" . $valueQuery['conoscenza_det'] . "', '" . $valueQuery['dove_vive'] . "','" . $valueQuery['dove_vive_altro'] . "',
        '" . $valueQuery['camera_amici'] . "', '" . $valueQuery['camera_amici_dettaglio'] . "', '" . $valueQuery['amici_genere'] . "', '" . $valueQuery['amici_occupazione'] . "', '" . $valueQuery['amici_eta'] . "', '" . $valueQuery['amici_fumo'] . "',
        '" . $valueQuery['amici_animali'] . "', '" . $valueQuery['amici_animali_dettaglio'] . "', '" . $valueQuery['nuova_residenza'] . "', '" . $valueQuery['giorni_visita'] . "', '" . $valueQuery['appartamento'] . "', '" . $valueQuery['tipo_appartamento'] . "',
        '" . $valueQuery['camera'] . "', '" . $valueQuery['tipo_camera'] . "', '" . $valueQuery['livello'] . "', '" . $valueQuery['livello_det'] . "', '" . $valueQuery['coinquilini'] . "', '" . $valueQuery['amici_quanti'] . "',
        '" . $quartieri . "', '" . $valueQuery['fumatore'] . "', '" . $valueQuery['animali'] . "', '" . $valueQuery['animali_det'] . "', '" . $valueQuery['interesse'] . "', '" . $valueQuery['coabitazione'] . "', 
        '" . reverseDate($valueQuery['data_in']) . "', '" . reverseDate($valueQuery['data_out']) . "', '" . $valueQuery['privacy'] . "', '" . $valueQuery['mailing'] . "', '" . $valueQuery['note'] . "',
            NOW(), '" . $valueQuery['formula'] . "',  '".$lang."', '" . date("Y") . "' ,'" . $valueQuery['amici_quanti'] . "' ,'" . $valueQuery['camera_singola'] . "','" . $valueQuery['camera_doppia'] . "','" . $valueQuery['camera_indiferente'] . "','" . $valueQuery['studente_det'] . "' ,'".$valueQuery['media']."') ";
	
    //echo $query;

    if ($db->Query($query)) {
        $idInsert = $db->LastId();
        $_SESSION['response_type']= "success";
        //file('https://qualita.cooperativadoc.it/stessopiano/send.php?id=' . $idInsert);
        //file("https://qualita.cooperativadoc.it/pushnotification/push.php?site=STEO&id=" . $idInsert);

        //echo "registrazione effettuata";
		
		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);  

		@file_get_contents('https://qualita.cooperativadoc.it/stessopiano/send.php?id=' . $idInsert, false, stream_context_create($arrContextOptions));
		@file_get_contents("https://qualita.cooperativadoc.it/pushnotification/push.php?site=STEO&id=" . $idInsert, false, stream_context_create($arrContextOptions));
    }
}
else {

    //echo $error;
    
    if($q){
        foreach ($q AS $id => $val)
            $error .= $id."====>".$val." <br /> \n";
    }
	//file('https://qualita.cooperativadoc.it/stessopiano/errori.php?errori=' . urlencode ($error));
}

//exit;
goToLocation("http://qualita.cooperativadoc.it/stessopiano");
?>
