<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);

require_once '../lib/class-db.php';
require_once 'lang.php';

if($_REQUEST['lang'] == 'en') {
	$lang = 'en-GB';
}
else {
	$lang = 'it-IT';
}


define ('WPLANG_E', $lang);
//define ('WPLANG_E', 'en-GB');

//~ define("ASSETS", "https://qualita.cooperativadoc.it");
//~ define("ICONE", ASSETS . "/assets-forms/img/icone");
//~ define("CSS", ASSETS . "/assets-forms/css");

//~ if (!$_SESSION['lang'])
//~     $_SESSION['lang'] = 'it';

//~ $lang = $_SESSION['lang'];

//~ if ($_SESSION['response_type']) {
//~     $mess = $_SESSION['response'];
//~     $messType = $_SESSION['response_type'];
//~     unset($_SESSION['response']);
//~     unset($_SESSION['response_type']);
//~ }

//~ if ($_SESSION['field']) {
//~     foreach ($_SESSION['field'] AS $id => $val) {
//~         $field[$id] = $val;
//~         unset($_SESSION['field'][$id]);
//~     }
//~ }


$db = new MySql_DB("localhost", "qualita", "qualita", "00qQUFDTOlKl6O3", true);
$strutture = $db->CycleAssochId($db->Query("SELECT id, nome FROM doc_unita WHERE qkeluar='Y' ORDER BY nome"));

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Keluar ::: Questionario qualità</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
		<style>
			.checkerror{color:#dc3545;font-weight:bold;font-size:0.8em}			
			body {
				background: url(../assets-forms/img/back_keluar.jpg) no-repeat center center fixed;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
			}
			.container {background-color:#FFFFFF}
			.sf-q-title {background-color:#ec7a1d;color:#FFFFFF}
			.sf-q-quesito {background-color:#7f192c;color:#FFFFFF}
		</style>
    </head>
    <body>
		<div class="container">
			<div class="py-5 text-left">
				<div class="row">
					<div class="col-lg-12 text-right">
						<a href="./?lang=it" title="IT"><img src="../icon/flags/it.png" class="rounded" /></a>
						<a href="./?lang=en" title="EN"><img src="../icon/flags/uk.png" class="rounded" /></a>
					</div>
				</div>
				<img class="d-block mx-auto mb-4" src="https://qualita.cooperativadoc.it/img/qu-keluar.png" alt="" >
				<!--<h2>Checkout form</h2>-->
				<p class="lead"><?php echo $text[WPLANG_E]['q_intro'];?></p>
			</div>
			
			<div class="row">
				
				<div class="col-xl-12">
					<!--<form id="form_questionario" method="post" name="form_questionario" action="./form.php">-->
					<form id="form_questionario" name="form_questionario">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td colspan="5" class="sf-q-title"><?= $text[WPLANG_E]['q_label_tipo_cliente'] ?>&nbsp;<span class="checkerror" id="error_scuola"></span></td>
								</tr>
								<tr>
									<td colspan="5"><input type="text" class="form-control input-full nop resetError" name="scuola" id="scuola" /></td>
								</tr>
								
								<tr>
									<td class="sf-q-quesito"><?= $text[WPLANG_E]['q_label_quesito'] ?></td>
									<td class="sf-q-quesito text-center"><?= $text[WPLANG_E]['q_label_insufficiente'] ?></td>
									<td class="sf-q-quesito text-center"><?= $text[WPLANG_E]['q_label_sufficiente'] ?></td>
									<td class="sf-q-quesito text-center"><?= $text[WPLANG_E]['q_label_buono'] ?></td>
									<td class="sf-q-quesito text-center"><?= $text[WPLANG_E]['q_label_eccellente'] ?></td>
								</tr>
								<tr>
									<td colspan="5" class="sf-q-title"><?= $text[WPLANG_E]['q_label_viaggio'] ?></td>
								</tr>
								<tr id="viaggio_complessivo">
									<td class=""><?= $text[WPLANG_E]['q_label_complessivo'] ?>&nbsp;&nbsp;<span class="checkerror" id='error_viaggio_complessivo'></span></td>
									<td class="text-center"><input type="radio" name="viaggio_complessivo" id="viaggio_complessivo_1"  value='I' class="radio-ins" /></td>
									<td class="text-center"><input type="radio" name="viaggio_complessivo" id="viaggio_complessivo_2" value='S' class="radio-suf" /></td>
									<td class="text-center"><input type="radio" name="viaggio_complessivo" id="viaggio_complessivo_3" value='B' class="radio-buo" /></td>
									<td class="text-center"><input type="radio" name="viaggio_complessivo" id="viaggio_complessivo_4" value='E' class="radio-ott" /></td>
								</tr>
								<tr id="rapporto_keluar">
									<td class=""><?= $text[WPLANG_E]['q_label_rapporto'] ?>&nbsp;&nbsp;<span class="checkerror" id="error_rapporto_keluar" ></span></td>
									<td class="text-center"><input type="radio" name="rapporto_keluar" id="rapporto_keluar_1"  value='I' class="radio-ins" /></td>
									<td class="text-center"><input type="radio" name="rapporto_keluar" id="rapporto_keluar_2" value='S' class="radio-suf" /></td>
									<td class="text-center"><input type="radio" name="rapporto_keluar" id="rapporto_keluar_3" value='B' class="radio-buo" /></td>
									<td class="text-center"><input type="radio" name="rapporto_keluar" id="rapporto_keluar_4" value='E' class="radio-ott" /></td>
								</tr>
								<tr >
									<td colspan="4" class="sf-q-title"><span style='height:34px; line-height: 34px'><?= $text[WPLANG_E]['q_label_trasporto'] ?>&nbsp;</td>
									<td class="sf-q-title"><input type="text" name="trasporto_nome" id="trasporto_nome" class="form-control input-full nop resetError" /></td>
								</tr>
								<tr id="trasporto_qualita">
									<td class=""><?= $text[WPLANG_E]['q_label_trasporto_qualita'] ?>&nbsp;&nbsp;<span class="checkerror" id="error_trasporto_qualita" ></span></td>
									<td class="text-center"><input type="radio" name="trasporto_qualita" id="trasporto_qualita_1"  value='I' class="radio-ins" /></td>
									<td class="text-center"><input type="radio" name="trasporto_qualita" id="trasporto_qualita_2" value='S' class="radio-suf" /></td>
									<td class="text-center"><input type="radio" name="trasporto_qualita" id="trasporto_qualita_3" value='B' class="radio-buo" /></td>
									<td class="text-center"><input type="radio" name="trasporto_qualita" id="trasporto_qualita_4" value='E' class="radio-ott" /></td>
								</tr>
								<tr id="trasporto_cortesia">
									<td class=""><?= $text[WPLANG_E]['q_label_trasporto_cortesia'] ?>&nbsp;&nbsp;<span class="checkerror" id="error_trasporto_cortesia" ></span></td>
									<td class="text-center"><input type="radio" name="trasporto_cortesia" id="trasporto_cortesia_1"  value='I' class="radio-ins" /></td>
									<td class="text-center"><input type="radio" name="trasporto_cortesia" id="trasporto_cortesia_2" value='S' class="radio-suf" /></td>
									<td class="text-center"><input type="radio" name="trasporto_cortesia" id="trasporto_cortesia_3" value='B' class="radio-buo" /></td>
									<td class="text-center"><input type="radio" name="trasporto_cortesia" id="trasporto_cortesia_4" value='E' class="radio-ott" /></td>
								</tr>
								<tr id="trasporto_tempi">
									<td class=""><?= $text[WPLANG_E]['q_label_trasporto_tempi'] ?>&nbsp;&nbsp;<span class="checkerror" id="error_trasporto_tempi" ></span></td>
									<td class="text-center"><input type="radio" name="trasporto_tempi" id="trasporto_tempi_1"  value='I' class="radio-ins" /></td>
									<td class="text-center"><input type="radio" name="trasporto_tempi" id="trasporto_tempi_2" value='S' class="radio-suf" /></td>
									<td class="text-center"><input type="radio" name="trasporto_tempi" id="trasporto_tempi_3" value='B' class="radio-buo" /></td>
									<td class="text-center"><input type="radio" name="trasporto_tempi" id="trasporto_tempi_4" value='E' class="radio-ott" /></td>
								</tr>
								<tr>
									<td colspan="3" class="sf-q-title"><?= $text[WPLANG_E]['q_label_albergo'] ?> </td>
									<td colspan="2" class="sf-q-title text-center">
										<select name ="struttura_nome" id="struttura_nome" class="form-control input-full nop resetError">
											<option value=""><?= $text[WPLANG_E]['q_scegli'] ?></option>
											<?php foreach($strutture as $id => $val) { ?>
												<option  value='<?= $id ?>'><?= $val ?></option>
											<?php } ?>
										</select>
										<span id='error_struttura_nome' class='checkerror'></span>
									</td>
								</tr>
								<tr id="struttura_complessivo">
									<td class=""><?= $text[WPLANG_E]['q_label_complessivo'] ?>&nbsp;&nbsp;<span class="checkerror" id="error_struttura_complessivo" ></span></td>
									<td class="text-center"><input type="radio" name="struttura_complessivo" id="struttura_complessivo_1"  value='I' class="radio-ins" /></td>
									<td class="text-center"><input type="radio" name="struttura_complessivo" id="struttura_complessivo_2" value='S' class="radio-suf" /></td>
									<td class="text-center"><input type="radio" name="struttura_complessivo" id="struttura_complessivo_3" value='B' class="radio-buo" /></td>
									<td class="text-center"><input type="radio" name="struttura_complessivo" id="struttura_complessivo_4" value='E' class="radio-ott" /></td>
								</tr>
								<tr>
									<td colspan="5" class="sf-q-title"><?= $text[WPLANG_E]['q_label_camera'] ?></td>
								</tr>
								<tr id="camera_pulizia">
									<td class=""><?= $text[WPLANG_E]['q_label_pulizia'] ?>&nbsp;&nbsp;<span class="checkerror" id="error_camera_pulizia" ></span></td>
									<td class="text-center"><input type="radio" name="camera_pulizia" id="camera_pulizia_1"  value='I' class="radio-ins" /></td>
									<td class="text-center"><input type="radio" name="camera_pulizia" id="camera_pulizia_2" value='S' class="radio-suf" /></td>
									<td class="text-center"><input type="radio" name="camera_pulizia" id="camera_pulizia_3" value='B' class="radio-buo" /></td>
									<td class="text-center"><input type="radio" name="camera_pulizia" id="camera_pulizia_4" value='E' class="radio-ott" /></td>
								</tr>
								<tr id="camera_confort">
									<td class=""><?= $text[WPLANG_E]['q_label_confort'] ?>&nbsp;&nbsp;<span class="checkerror" id="error_camera_confort" ></span></td>
									<td class="text-center"><input type="radio" name="camera_confort" id="camera_confort_1"  value='I' class="radio-ins" /></td>
									<td class="text-center"><input type="radio" name="camera_confort" id="camera_confort_2" value='S' class="radio-suf" /></td>
									<td class="text-center"><input type="radio" name="camera_confort" id="camera_confort_3" value='B' class="radio-buo" /></td>
									<td class="text-center"><input type="radio" name="camera_confort" id="camera_confort_4" value='E' class="radio-ott" /></td>
								</tr>
								<tr>
									<td colspan="5" class="sf-q-title"><?= $text[WPLANG_E]['q_label_ristorante'] ?></td>
								</tr>
								<tr id="ristorante_servizio">
									<td class=""><?= $text[WPLANG_E]['q_label_servizio'] ?>&nbsp;&nbsp;<span class="checkerror" id="error_ristorante_servizio" ></span></td>
									<td class="text-center"><input type="radio" name="ristorante_servizio" id="ristorante_servizio_1"  value='I' class="radio-ins" /></td>
									<td class="text-center"><input type="radio" name="ristorante_servizio" id="ristorante_servizio_2" value='S' class="radio-suf" /></td>
									<td class="text-center"><input type="radio" name="ristorante_servizio" id="ristorante_servizio_3" value='B' class="radio-buo" /></td>
									<td class="text-center"><input type="radio" name="ristorante_servizio" id="ristorante_servizio_4" value='E' class="radio-ott" /></td>
								</tr>
								<tr id="ristorante_cibo">
									<td class=""><?= $text[WPLANG_E]['q_label_qualita_cibo'] ?>&nbsp;&nbsp;<span class="checkerror" id="error_ristorante_cibo" ></span></td>
									<td class="text-center"><input type="radio" name="ristorante_cibo" id="ristorante_cibo_1"  value='I' class="radio-ins" /></td>
									<td class="text-center"><input type="radio" name="ristorante_cibo" id="ristorante_cibo_2" value='S' class="radio-suf" /></td>
									<td class="text-center"><input type="radio" name="ristorante_cibo" id="ristorante_cibo_3" value='B' class="radio-buo" /></td>
									<td class="text-center"><input type="radio" name="ristorante_cibo" id="ristorante_cibo_4" value='E' class="radio-ott" /></td>
								</tr>
								<tr id="ristorante_menu">
									<td class=""><?= $text[WPLANG_E]['q_label_varieta'] ?>&nbsp;&nbsp;<span class="checkerror" id="error_ristorante_menu" ></span></td>
									<td class="text-center"><input type="radio" name="ristorante_menu" id="ristorante_menu_1"  value='I' class="radio-ins" /></td>
									<td class="text-center"><input type="radio" name="ristorante_menu" id="ristorante_menu_2" value='S' class="radio-suf" /></td>
									<td class="text-center"><input type="radio" name="ristorante_menu" id="ristorante_menu_3" value='B' class="radio-buo" /></td>
									<td class="text-center"><input type="radio" name="ristorante_menu" id="ristorante_menu_4" value='E' class="radio-ott" /></td>
								</tr>

								<tr>
									<td colspan="5" class="sf-q-title"><?= $text[WPLANG_E]['q_label_personale'] ?></td> 
								</tr>
								<tr id="personale_cortesia">
									<td class=""><?= $text[WPLANG_E]['q_label_cortesia'] ?>&nbsp;&nbsp;<span class="checkerror" id="error_personale_cortesia" ></span></td>
									<td class="text-center"><input type="radio" name="personale_cortesia" id="personale_cortesia_1"  value='I' class="radio-ins" /></td>
									<td class="text-center"><input type="radio" name="personale_cortesia" id="personale_cortesia_2" value='S' class="radio-suf" /></td>
									<td class="text-center"><input type="radio" name="personale_cortesia" id="personale_cortesia_3" value='B' class="radio-buo" /></td>
									<td class="text-center"><input type="radio" name="personale_cortesia" id="personale_cortesia_4" value='E' class="radio-ott" /></td>
								</tr>
								<tr id="personale_disponibilita">
									<td class=""><?= $text[WPLANG_E]['q_label_disponibilita'] ?>&nbsp;&nbsp;<span class="checkerror" id="error_personale_disponibilita" ></span></td>
									<td class="text-center"><input type="radio" name="personale_disponibilita" id="personale_disponibilita_1"  value='I' class="radio-ins" /></td>
									<td class="text-center"><input type="radio" name="personale_disponibilita" id="personale_disponibilita_2" value='S' class="radio-suf" /></td>
									<td class="text-center"><input type="radio" name="personale_disponibilita" id="personale_disponibilita_3" value='B' class="radio-buo" /></td>
									<td class="text-center"><input type="radio" name="personale_disponibilita" id="personale_disponibilita_4" value='E' class="radio-ott" /></td>
								</tr>
								<tr>
									<td colspan="5" class="sf-q-title"><?= $text[WPLANG_E]['q_label_escursioni'] ?></td> 
								</tr>
								<tr id="escursioni_itinerari">
									<td class=""><?= $text[WPLANG_E]['q_label_itinerari'] ?>&nbsp;&nbsp;<span class="checkerror" id="error_escursioni_itinerari" ></span></td>
									<td class="text-center"><input type="radio" name="escursioni_itinerari" id="escursioni_itinerari_1"  value='I' class="radio-ins" /></td>
									<td class="text-center"><input type="radio" name="escursioni_itinerari" id="escursioni_itinerari_2" value='S' class="radio-suf" /></td>
									<td class="text-center"><input type="radio" name="escursioni_itinerari" id="escursioni_itinerari_3" value='B' class="radio-buo" /></td>
									<td class="text-center"><input type="radio" name="escursioni_itinerari" id="escursioni_itinerari_4" value='E' class="radio-ott" /></td>

								</tr>
								<tr id="escursioni_guida">
									<td class=""><?= $text[WPLANG_E]['q_label_guida'] ?>&nbsp;&nbsp;<span class="checkerror" id="error_escursioni_guida" ></span></td>
									<td class="text-center"><input type="radio" name="escursioni_guida" id="escursioni_guida_1"  value='I' class="radio-ins" /></td>
									<td class="text-center"><input type="radio" name="escursioni_guida" id="escursioni_guida_2" value='S' class="radio-suf" /></td>
									<td class="text-center"><input type="radio" name="escursioni_guida" id="escursioni_guida_3" value='B' class="radio-buo" /></td>
									<td class="text-center"><input type="radio" name="escursioni_guida" id="escursioni_guida_4" value='E' class="radio-ott" /></td>
								</tr>

								<tr>
									<td colspan="5" class="sf-q-title"><?= $text[WPLANG_E]['q_label_neve'] ?></td> 
								</tr>
								<tr id="neve_noleggio">
									<td class=""><?= $text[WPLANG_E]['q_label_noleggio'] ?>&nbsp;&nbsp;<span class="checkerror" id="error_neve_noleggio" ></span></td>
									<td class="text-center"><input type="radio" name="neve_noleggio" id="neve_noleggio_1"  value='I' class="radio-ins" /></td>
									<td class="text-center"><input type="radio" name="neve_noleggio" id="neve_noleggio_2" value='S' class="radio-suf" /></td>
									<td class="text-center"><input type="radio" name="neve_noleggio" id="neve_noleggio_3" value='B' class="radio-buo" /></td>
									<td class="text-center"><input type="radio" name="neve_noleggio" id="neve_noleggio_4" value='E' class="radio-ott" /></td>
								</tr>
								<tr id="neve_scuola">
									<td class=""><?= $text[WPLANG_E]['q_label_scuola'] ?>&nbsp;&nbsp;<span class="checkerror" id="error_neve_scuola" ></span></td>
									<td class="text-center"><input type="radio" name="neve_scuola" id="neve_scuola_1"  value='I' class="radio-ins" /></td>
									<td class="text-center"><input type="radio" name="neve_scuola" id="neve_scuola_2" value='S' class="radio-suf" /></td>
									<td class="text-center"><input type="radio" name="neve_scuola" id="neve_scuola_3" value='B' class="radio-buo" /></td>
									<td class="text-center"><input type="radio" name="neve_scuola" id="neve_scuola_4" value='E' class="radio-ott" /></td>
								</tr>
								<tr>
									<td colspan="5" class="sf-q-title"><?= $text[WPLANG_E]['q_label_laboratorio'] ?></td> 
								</tr>
								<tr id="laboratori_tecnici">
									<td class=""><?= $text[WPLANG_E]['q_label_competenza'] ?>&nbsp;&nbsp;<span class="checkerror" id="error_laboratori_tecnici" ></span></td>
									<td class="text-center"><input type="radio" name="laboratori_tecnici" id="laboratori_tecnici_1"  value='I' class="radio-ins" /></td>
									<td class="text-center"><input type="radio" name="laboratori_tecnici" id="laboratori_tecnici_2" value='S' class="radio-suf" /></td>
									<td class="text-center"><input type="radio" name="laboratori_tecnici" id="laboratori_tecnici_3" value='B' class="radio-buo" /></td>
									<td class="text-center"><input type="radio" name="laboratori_tecnici" id="laboratori_tecnici_4" value='E' class="radio-ott" /></td>

								</tr>
								<tr id="laboratori_competenze">
									<td class=""><?= $text[WPLANG_E]['q_label_acquisizione'] ?>&nbsp;&nbsp;<span class="checkerror" id="error_laboratori_competenze" ></span></td>
									<td class="text-center"><input type="radio" name="laboratori_competenze" id="laboratori_competenze_1"  value='I' class="radio-ins" /></td>
									<td class="text-center"><input type="radio" name="laboratori_competenze" id="laboratori_competenze_2" value='S' class="radio-suf" /></td>
									<td class="text-center"><input type="radio" name="laboratori_competenze" id="laboratori_competenze_3" value='B' class="radio-buo" /></td>
									<td class="text-center"><input type="radio" name="laboratori_competenze" id="laboratori_competenze_4" value='E' class="radio-ott" /></td>
								</tr>
								<tr>
									<td colspan="5" class="sf-q-title"><?= $text[WPLANG_E]['q_label_consiglio'] ?>&nbsp; &nbsp;<span id='error_consiglia' class='checkerror'></span></td>
								</tr>
								<tr id="consiglia">
									<td class=""><?= $text[WPLANG_E]['q_label_si'] ?></td>
									<td class="text-center"><input type="radio" name="consiglia" id="consiglia_1" value='S' class="radio-ins"/></td>
									<td colspan="3" class=""></td>
								</tr>
								<tr>
									<td class=""><?= $text[WPLANG_E]['q_label_forse'] ?></td>
									<td class="text-center"><input type="radio" name="consiglia" id="consiglia_2" value='F' class="radio-suf"/></td>
									<td colspan="3" class=""></td>
								</tr>
								<tr>
									<td class=""><?= $text[WPLANG_E]['q_label_no'] ?></td>
									<td class="text-center"><input type="radio" name="consiglia" id="consiglia_3" value='N' class="radio-ott"/></td>
									<td colspan="3" class=""></td>
								</tr>
								<tr>
									<td colspan="5" class="sf-q-title"><?= $text[WPLANG_E]['q_label_suggerimenti'] ?></td>
								</tr>
								<tr>
									<td colspan="5" class="white left"><textarea id="suggerimenti" name="suggerimenti" class="form-control" rows="6"></textarea></td>
								</tr>
								<tr>
									<td colspan="5" class="sf-q-title"><?= $text[WPLANG_E]['q_label_dati'] ?></td>
								</tr>
								<tr>
									<td colspan="5">
										<div class="row">
											<div class="col-md-6 mb-3">
												<label for="nome"><?= $text[WPLANG_E]['q_label_nome'] ?>&nbsp;&nbsp;<span id="error_nome" class="checkerror"></span></label>
												<input type="text" name="nome" id="nome" class="form-control input-small resetError" />
											</div>

											<div class="col-md-6 mb-3">
												<label for="cognome"><?= $text[WPLANG_E]['q_label_cognome'] ?>&nbsp;&nbsp;<span id="error_cognome" class="checkerror"></span></label>
												<input type="text" name="cognome" id="cognome" class="form-control input-small resetError" />
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
						
						<div class="row">
							<div class="col-md-6 mb-3">
								<div class="g-recaptcha" data-sitekey="6Le5oZgeAAAAALF9TotLnUZz_Z3pPMU0WLzmdnXB"></div>
								<span id="error_captcha_code"class="checkerror" ></span>
							</div>
							<div class="col-md-6 mb-3">
								<input type="checkbox" name="informativa" id="informativa" value="Y" class="check-blue resetError" />
								<?= $text[WPLANG_E]['label_informativa_letta'] ?>* <span id="error_informativa" class="checkerror" ></span><br />
								<div class="tanks"><?= $text[WPLANG_E]['q_label_grazie'] ?></div>
							</div>
						</div>
						
						<div class="mb-3 text-center">
							<a href="javascript:void();" class="btn btn-info btn-send"><?= $text[WPLANG_E]['q_label_invia'] ?></a>
						</div>
						<input type="hidden" name="language" id="language" value='<?= WPLANG_E ?>' />
					</form>
				</div>
			</div>
		</div>
		
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
		<script src="https://www.google.com/recaptcha/api.js"></script>
		<script src="functions.js"></script>
		
		<div id="validationModal" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"><i class="fas fa-exclamation-triangle"></i>&nbsp;<?= $text[WPLANG_E]['label_attenzione'] ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p><?= $text[WPLANG_E]['label_verificare'] ?></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $text[WPLANG_E]['label_chiudi'] ?></button>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="modal fade" id="infoModal" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times</button>
						<h4 class="modal-title"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;<?= $text[WPLANG_E]['label_informativa'] ?></h4>
					</div>
				   <div class="modal-body">
						<p> Informativa ex art. 13 D.lgs. 196/2003 "Codice in materia di protezione dei dati personali"  </p>
						<ul>
							<li> I dati da Lei forniti verranno trattati con la finalit&agrave; di invio di materiale pubblicitario / informativo / promozionale e di aggiornamenti su iniziative ed offerte volte a premiare i Clienti. Tali attivit&agrave; potranno riguardare prodotti e servizi della nostra societ&agrave; nonch&eacute; di Partner commerciali e potranno essere eseguite tramite invio di mail all' indirizzo di posta elettronica indicato o SMS (Short Message Service) che potr&agrave; ricevere sull'utenza che stai registrando. </li>
							<li> Il trattamento sar&agrave; effettuato con modalit&agrave; informatizzate. - I dati saranno comunicati esclusivamente ai soggetti necessari all'espletamento delle attivit&agrave; sopra citate. Non sar&agrave; data altra diffusione dei dati al di fuori di questo ambito. </li>
							<li> Il consenso al trattamento dei dati per le predette finalit&agrave; potr&agrave; essere revocato. </li>
							<li>Il titolare e responsabile del trattamento &egrave;: Keluar s.r.l. Via Assietta, 16/b - 10128, Torino. </li>
							<li>Per ogni altra informazione relativa alla tutela della sua privacy la invitiamo ad inviarci una email all'indirizzo <a href="mailto:info@keluar.it">info@keluar.it.</a></li>
						</ul>
					</div>
					<div class="modal-footer">
						<button type="button" class="button" data-dismiss="modal"><?= $text[WPLANG_E]['label_chiudi'] ?></button> 
					</div>
				</div>
			</div>
		</div>
    </body>
</html>