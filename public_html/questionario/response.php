<?
include("../lib/class-db.php");

$db = new MySql_DB("localhost", "cooperativa_qualita", "coop_qualita", "coop5369s", true);

$qu = $_POST;


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
            $pattern = "/^[a-zA-Zאטילעש ]*$/";
            break;
        case"password":
            $pattern = "/^[a-zA-Z0-9]*$/";
            break;
        case"numero":
            $pattern = "/^[0-9]*$/";
            break;
        case"char":
            $pattern = "/^[A-Z]*$/";
            break;
            default:
            $pattern = "/^[a-zA-Zאטילעש_\. -]*$/";
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
        return false;
    else
        return true;
}

$campi = array('campi_Doc' => array(
        'char' => array('vacanza', 'struttura_pulizia', 'struttura_complessivo', 'stanza_confort', 'stanza_arredi', 'stanza_pulizia', 'stanza_complessivo', 'ristorante_servizio', 'ristorante_attesa', 'ristorante_cibo', 'ristorante_menu', 'ristorante_complessivo', 'personale_cortesia', 'personale_professionalita', 'personale_complessivo', 'consiglia'),
        'multi_char' => array('nome', 'cognome'),
        'note' => 'suggerimenti'
    ),
    'campi_keluar' => array(
        'char' => array('camera_pulizia', 'camera_confort', 'rapporto_keluar', 'trasporto_nome', 'trasporto_qualita', 'trasporto_cortesia', 'trasporto_tempi', 'ristorante_servizio', 'ristorante_cibo', 'ristorante_menu', 'personale_cortesia', 'personale_disponibilita', 'escursioni_itinerari', 'escursioni_guida', 'neve_noleggio', 'neve_scuola', 'laboratori_tecnici', 'laboratori_competenze', 'consiglia'),
        'multi_char' => array('nome', 'cognome', 'sede_operativa', 'scuola', 'trasporto_nome'),
        'note' => 'suggerimenti'
    ),
    'campi_sharing' => array(
        'char' => array('struttura_pulizia', 'struttura_complessivo', 'stanza_confort', 'stanza_arredi', 'stanza_pulizia', 'stanza_complessivo', 'ristorante_servizio', 'ristorante_attesa', 'ristorante_cibo', 'ristorante_menu', 'ristorante_complessivo', 'personale_cortesia', 'personale_professionalita', 'personale_complessivo'),
        'multi_char' => array('nome', 'cognome'),
        'note' => 'suggerimenti'
    )
);


switch ($qu['from']) {

    case"D":

        $field = "campi_doc";

        $query = " INSERT INTO questionario_doc (struttura_nome,nome, cognome, data_consegna, data_restituzione, vacanza,";
        $query .=" struttura_pulizia, struttura_complessivo, stanza_confort, stanza_arredi, stanza_pulizia, stanza_complessivo, ristorante_servizio, ";
        $query .=" ristorante_attesa, ristorante_cibo, ristorante_menu, ristorante_complessivo, personale_cortesia, personale_professionalita,";
        $query .=" personale_complessivo, consiglia, suggerimenti) VALUES ('" . $qu['struttura_nome'] . "','" . $qu['nome'] . "', '" . $qu['cognome'] . "', NOW(), NOW(), '" . $qu['vacanza'] . "', '" . $qu['struttura_pulizia'] . "',";
        $query .=" '" . $qu['struttura_complessivo'] . "', '" . $qu['stanza_confort'] . "','" . $qu['stanza_arredi'] . "', '" . $qu['stanza_pulizia'] . "', '" . $qu['stanza_complessivo'] . "', ";
        $query .=" '" . $qu['ristorante_servizio'] . "', '" . $qu['ristorante_attesa'] . "', '" . $qu['ristorante_cibo'] . "', '" . $qu['ristorante_menu'] . "', '" . $qu['ristorante_complessivo'] . "', ";
        $query .=" '" . $qu['personale_cortesia'] . "','" . $qu['personale_professionalita'] . "', '" . $qu['personale_complessivo'] . "', '" . $qu['consiglia'] . "', '" . strip_tags($qu['suggerimenti']). "')";
        $table ="questionario_doc";
        break;

    case"K":

        $field = "campi_keluar";

        $query = "INSERT INTO questionario_keluar ( nome, cognome, sede_operativa, scuola, data_consegna, data_restituzione, viaggio_complessivo,camera_pulizia,camera_confort,";
        $query .="struttura_complessivo,struttura_nome, rapporto_keluar, trasporto_nome, trasporto_qualita, trasporto_cortesia, trasporto_tempi, ristorante_servizio, ";
        $query .="ristorante_cibo, ristorante_menu, personale_cortesia, personale_disponibilita, escursioni_itinerari, escursioni_guida, neve_noleggio,";
        $query .="neve_scuola, laboratori_tecnici, laboratori_competenze, consiglia, suggerimenti) VALUES ('" . $qu['nome'] . "','" . $qu['cognome'] . "', '" . $qu['sede_operativa'] . "', '" . $qu['scuola'] . "',";
        $query .="NOW(), NOW(), '" . $qu['viaggio_complessivo'] . "','" . $qu['camera_pulizia'] . "','" . $qu['camera_confort'] . "', '" . $qu['struttura_complessivo'] . "','" . $qu['struttura_nome'] . "', '" . $qu['rapporto_keluar'] . "', '" . $qu['trasporto_nome'] . "', '" . $qu['trasporto_qualita'] . "', ";
        $query .="'" . $qu['trasporto_cortesia'] . "', '" . $qu['trasporto_tempi'] . "', '" . $qu['ristorante_servizio'] . "', '" . $qu['ristorante_cibo'] . "', '" . $qu['ristorante_menu'] . "', ";
        $query .=" '" . $qu['personale_cortesia'] . "', '" . $qu['personale_disponibilita'] . "', '" . $qu['escursioni_itinerari'] . "', '" . $qu['escursioni_guida'] . "', '" . $qu['neve_noleggio'] . "', '" . $qu['neve_scuola'] . "',";
        $query .="'" . $qu['laboratori_tecnici'] . "', '" . $qu['laboratori_competenze'] . "', '" . $qu['consiglia'] . "', '" . strip_tags($qu['suggerimenti']) . "');";
        $table ="questionario_keluar";
        break;

    case"S":

        $field = "campi_sharing";
        $query = "INSERT INTO questionario_sharing (nome, cognome, data_consegna, data_restituzione, vacanza, struttura_pulizia,";
        $query .="struttura_complessivo, stanza_confort, stanza_arredi, stanza_pulizia, stanza_complessivo, ristorante_servizio, ";
        $query .="ristorante_attesa, ristorante_cibo, ristorante_menu, ristorante_complessivo, personale_cortesia, personale_professionalita, ";
        $query .="personale_complessivo, consiglia, suggerimenti) VALUES ( '" . $qu['nome'] . "', '" . $qu['cognome'] . "', NOW(), NOW(), '" . $qu['vacanza'] . "',";
        $query .="'" . $qu['struttura_pulizia'] . "', '" . $qu['struttura_complessivo'] . "', '" . $qu['stanza_confort'] . "', '" . $qu['stanza_arredi'] . "', '" . $qu['stanza_pulizia'] . "',";
        $query .="'" . $qu['stanza_complessivo'] . "', '" . $qu['ristorante_servizio'] . "', '" . $qu['ristorante_attesa'] . "', '" . $qu['ristorante_cibo'] . "', '" . $qu['ristorante_menu'] . "', ";
        $query .="'" . $qu['ristorante_complessivo'] . "', '" . $qu['personale_cortesia'] . "', '" . $qu['personale_professionalita'] . "', '" . $qu['personale_complessivo'] . "', '" . $qu['consiglia'] . "', '" .strip_tags($qu['suggerimenti']) . "');";
        $table ="questionario_sharing";
        break;
}

$error = 0;

foreach ($qu AS $name => $value) {
    
    if ($campi[$field]['char'][$name] && !isValidField($value, 'char', 1))
        $error = 1;
    else if ($campi[$field]['multi_char'][$name] && !isValidField($value, 'text'))
        $error = 1;
    else if ($campi[$field][$name] && !isValidField($value, 'long_text'))
        $error = 1;
}

if($error=='0'){
    
    #Verifico se nome e cognome hanno giא compilato il questionario
    
    $userExist = $db->SingleField("id",$table, " WHERE nome = '".$qu['nome']."'  AND cognome ='".$qu['cognome']."' ");
    if(!$userExist)
        $db->Query($query);
    else
        $more = "&more=y";
    
    goToLocation("./rispondi.php?from=".$qu['from'].$more);
}
else{
     $more = "&more=n";
    goToLocation("./rispondi.php?from=".$qu['from'].$more);

}?>
