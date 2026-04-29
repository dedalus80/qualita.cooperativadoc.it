<?php
	session_start();
	error_reporting(E_ALL & ~E_NOTICE);
	ini_set('display_errors', 1);

	require_once '../lib/class-db.php';
	require_once 'lang.php';

	define ('WPLANG_E', 'it-IT');

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


//~ 	$db = new MySql_DB("localhost", "cooperativa_qualita", "coop_qualita", "coop5369s", true);
//~ 	$strutture = $db->CycleAssochId($db->Query("SELECT id, nome FROM doc_unita WHERE qdoc ='Y' ORDER BY nome"));
//~ 	$tipologie = $db->CycleAssochId($db->Query("SELECT id, nome FROM doc_tipologie_clienti ORDER BY nome"));
//~ 	$conoscenza = $db->CycleAssochId($db->Query("SELECT id, nome FROM doc_conoscenza ORDER BY nome"));
//~ 	
//~ 	
	$db = new MySql_DB("localhost", "qualita", "qualita", "00qQUFDTOlKl6O3", true);
	$strutture = $db->CycleAssochId($db->Query("SELECT id, nome FROM doc_unita WHERE qsharing ='Y' ORDER BY nome "));
	$tipologie = $db->CycleAssochId($db->Query("SELECT id, nome FROM doc_tipologie_clienti ORDER BY nome"));
	$tipologie_soggiorni = $db->CycleAssochId($db->Query("SELECT id, label_" . str_replace("-", "_", WPLANG_E) . " as nome FROM doc_tipologie_soggiorni ORDER BY nome"));
	$conoscenza = $db->CycleAssochId($db->Query("SELECT id, nome FROM doc_conoscenza ORDER BY nome"));
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Sharing ::: Questionario qualità</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
		<link rel="stylesheet" href="custom.css" />
		<link rel="stylesheet" href="datepicker.css" />
		<style>
			.checkerror{color:#dc3545;font-weight:bold;font-size:0.8em}			
			body {
//~ 				background: url(../assets-forms/img/back_doc.jpeg) no-repeat center center fixed;
//~ 				-webkit-background-size: cover;
//~ 				-moz-background-size: cover;
//~ 				-o-background-size: cover;
//~ 				background-size: cover;
			}
			.container {background-color:#FFFFFF}
			.sf-q-title {background-color:#ec7a1d;color:#FFFFFF}
			.sf-q-quesito {background-color:#7f192c;color:#FFFFFF}
//~ 			.boxed-group label {color:#384b57}
		</style>
    </head>
    <body>
		<div class="container">
			<div class="py-5 text-left">
				<img class="d-block mx-auto mb-4" src="https://qualita.cooperativadoc.it/img/qu-sharing.png" alt="" />
				<!--<h2>Questionario di gradimento Sharing</h2>-->
				<p class="lead"><?= $text[WPLANG_E]['q_intro'] ?></p>
			</div>
			
			<div class="row">
				
				<div class="col-xl-12">
					<form id="form_questionario" name="form_questionario">
						<div id="vacanza" class="boxed-group" >
							<div class="x-row-fluid intestazione">
								<div class="x-span12"><span class="badge" id="badge-1">1/7</span>&nbsp;&nbsp;<?= $text[WPLANG_E]['q_label_vacanza'] ?></div>
							</div>
							<div class="x-row-fluid quesito ptop10">
								<div class="x-span6 prl">
									<label><?= $text[WPLANG_E]['q_label_struttura'] ?>&nbsp;&nbsp;<span class="error" id="error_albergo"></span> </label>
									<select name="albergo" id="albergo" class="form-control input-full nop viaggio resetError">
										<option value ='' ><?= $text[WPLANG_E]['q_scegli'] ?></option>
										<? foreach ($strutture as $id => $val) { ?>
											<option  value='<?= $id ?>'><?= $val ?></option>
										<? } ?>
									</select>
								</div>
								<div class="x-span3 prl">
									<label><?= $text[WPLANG_E]['q_label_arrivo'] ?>&nbsp;&nbsp;<span class="error" id="error_arrivo"></span></label> 
									<div class="input-group date" id="datepicker-pastdisabled">
										<span class="input-group-addon" id="arrivo-pick"><i class="fas fa-calendar"></i></span>
										<input data-provide="datepicker" type="text" class="form-control sm-input wpcf7-form fullwidth viaggio resetError" id="arrivo" name="arrivo" maxlength="10" size="10"  value="" />
									</div>
								</div>
								<div class="x-span3 prl">
									<label><?= $text[WPLANG_E]['q_label_partenza'] ?>&nbsp;&nbsp;<span class="error" id="error_partenza"></span></label> 
									<div class="input-group date" id="datepicker-pastdisabled">
										<span class="input-group-addon" id="partenza-pick" ><i class="fas fa-calendar"></i></span>
										<input data-provide="datepicker" type="text" class="form-control sm-input wpcf7-form fullwidth viaggio" id='partenza' name='partenza'   value=""/>
									</div>
								</div>
							</div>
							<div class="x-row-fluid quesito bottom10">
								<!--<div class="x-span6 prl">
									<label><?= $text[WPLANG_E]['q_label_tipologia'] ?>&nbsp;&nbsp;<span class="error" id="error_tipologia"></span></label> 
									<select name="tipologia" id="tipologia" class="form-control input-full nop viaggio resetError">
										<option value ='' ><?= $text[WPLANG_E]['q_scegli'] ?></option>
										<? foreach ($tipologie as $id => $val) { ?>
											<option  value='<?= $id ?>'><?= $val ?></option>
										<? } ?>
									</select>
								</div>
								<div class="x-span6 prl">
									<label><?= $text[WPLANG_E]['q_label_conoscenza'] ?>&nbsp;&nbsp;<span class="error" id="error_conoscenza"></span></label> 
									<select name="conoscenza" id="conoscenza" class="form-control input-full nop viaggio resetError">
										<option value ='' ><?= $text[WPLANG_E]['q_scegli'] ?></option>
										<? foreach ($conoscenza as $id => $val) { ?>
											<option  value='<?= $id ?>'><?= $val ?></option>
										<? } ?>
									</select>
								</div>-->
								
								<div class="x-span4 prl">
									<label><?= $text[WPLANG_E]['q_label_tipologia_soggiorno'] ?>&nbsp;&nbsp;<span class="error" id="error_tipologia_soggiorno"></span></label> 
									<select name="tipologia_soggiorno" id="tipologia_soggiorno" class="form-control input-full nop viaggio resetError">
										<option value=""><?= $text[WPLANG_E]['q_scegli'] ?></option>
										<? foreach ($tipologie_soggiorni as $id => $val) { ?>
											<option  value="<?= $id ?>"><?= $val ?></option>
										<? } ?>
									</select>
								</div>
								<div class="x-span4 prl">
									<label><?= $text[WPLANG_E]['q_label_tipologia'] ?>&nbsp;&nbsp;<span class="error" id="error_tipologia"></span></label> 
									<select name="tipologia" id="tipologia" class="form-control input-full nop viaggio resetError">
										<option value=""><?= $text[WPLANG_E]['q_scegli'] ?></option>
										<? foreach ($tipologie as $id => $val) { ?>
											<option value="<?= $id ?>"><?= $val ?></option>
										<? } ?>
									</select>
								</div>

								<div class="x-span4 prl">
									<label><?= $text[WPLANG_E]['q_label_conoscenza'] ?>&nbsp;&nbsp;<span class="error" id="error_conoscenza"></span></label> 
									<select name="conoscenza" id="conoscenza" class="form-control input-full nop viaggio resetError">
										<option value=""><?= $text[WPLANG_E]['q_scegli'] ?></option>
										<? foreach ($conoscenza as $id => $val) { ?>
											<option value="<?= $id ?>"><?= $val ?></option>
										<? } ?>
									</select>
								</div>
								
							</div>
							<div class="x-row-fluid leggenda" id="intestazione-generale">
								<div class="x-span4"><?= $text[WPLANG_E]['q_label_quesito'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_insufficiente'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_sufficiente'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_buono'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_eccellente'] ?></div>
							</div>
							<div class="x-row-fluid quesito quesito-white quesito-mobile" >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_complessivo'] ?>&nbsp;&nbsp;<span class='error' id='error_complessivo'></span></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="viaggio_complessivo" id="viaggio_complessivo_1"  value='I' class="radio-ins  viaggio_complessivo " /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="viaggio_complessivo" id="viaggio_complessivo_2" value='S' class="radio-suf viaggio_complessivo" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?> </span><input type="radio"   name="viaggio_complessivo" id="viaggio_complessivo_3" value='B' class="radio-buo viaggio_complessivo" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="viaggio_complessivo" id="viaggio_complessivo_4" value='E' class="radio-ott viaggio_complessivo" /></div>
							</div>
						</div>
                        
						<div id="struttura" class="boxed-group">
							<div class="x-row-fluid intestazione" >
								<div class="x-span12"><span class='badge' id="badge-2" >2/7</span>&nbsp;&nbsp;<?= $text[WPLANG_E]['q_label_albergo'] ?></div>
							</div>
							<div class="x-row-fluid leggenda" id='intestazione-struttura' >
								<div class="x-span4"><?= $text[WPLANG_E]['q_label_quesito'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_insufficiente'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_sufficiente'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_buono'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_eccellente'] ?></div>
							</div>
							<div class="x-row-fluid quesito quesito-white" >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_complessivo'] ?></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="struttura_complessivo" id="struttura_complessivo_1"  value='I' class="radio-ins  struttura_complessivo" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="struttura_complessivo" id="struttura_complessivo_2" value='S' class="radio-suf struttura_complessivo" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="struttura_complessivo" id="struttura_complessivo_3" value='B' class="radio-buo struttura_complessivo" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="struttura_complessivo" id="struttura_complessivo_4" value='E' class="radio-ott struttura_complessivo" /></div>
							</div>
							<div class="x-row-fluid quesito" >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_pulizia_ambienti'] ?></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="struttura_pulizia" id="struttura_pulizia_1"  value='I' class="radio-ins struttura_pulizia" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="struttura_pulizia" id="struttura_pulizia_2" value='S' class="radio-suf struttura_pulizia" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="struttura_pulizia" id="struttura_pulizia_3" value='B' class="radio-buo struttura_pulizia" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="struttura_pulizia" id="struttura_pulizia_4" value='E' class="radio-ott struttura_pulizia " /></div>
							</div>
						</div>
                        
						<div id="camera" class="boxed-group">
							<div class="x-row-fluid intestazione" >
								<div class="x-span12"><span class='badge' id="badge-3" >3/7</span>&nbsp;&nbsp;<?= $text[WPLANG_E]['q_label_camera'] ?></div>
							</div>
							<div class="x-row-fluid leggenda" id='intestazione-camera' >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_quesito'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_insufficiente'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_sufficiente'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_buono'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_eccellente'] ?></div>
							</div>
							<div class="x-row-fluid quesito quesito-white" >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_complessivo'] ?></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="camera_complessivo" id="camera_complessivo_1"  value='I' class="radio-ins camera_complessivo" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="camera_complessivo" id="camera_complessivo_2" value='S' class="radio-suf camera_complessivo" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="camera_complessivo" id="camera_complessivo_3" value='B' class="radio-buo camera_complessivo" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="camera_complessivo" id="camera_complessivo_4" value='E' class="radio-ott camera_complessivo" /></div>
							</div>
							<div class="x-row-fluid quesito" >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_confort'] ?></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="camera_comfort" id="camera_comfort_1"  value='I' class="radio-ins camera_comfort" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="camera_comfort" id="camera_comfort_2" value='S' class="radio-suf camera_comfort" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="camera_comfort" id="camera_comfort_3" value='B' class="radio-buo camera_comfort" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="camera_comfort" id="camera_comfort_4" value='E' class="radio-ott camera_comfort" /></div>
							</div>
						</div>
						
						<div id="personale" class="boxed-group">
							<div class="x-row-fluid intestazione" >
								<div class="x-span12"><span class='badge' id="badge-4" >4/7</span>&nbsp;&nbsp;<?= $text[WPLANG_E]['q_label_personale'] ?></div>
							</div>
							<div class="x-row-fluid leggenda" id='intestazione-personale' >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_quesito'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_insufficiente'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_sufficiente'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_buono'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_eccellente'] ?></div>
							</div>
							<div class="x-row-fluid quesito quesito-white" >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_complessivo'] ?></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="personale_complessivo" id="personale_complessivo_1"  value='I' class="radio-ins personale_complessivo" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="personale_complessivo" id="personale_complessivo_2" value='S' class="radio-suf personale_complessivo" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="personale_complessivo" id="personale_complessivo_3" value='B' class="radio-buo personale_complessivo" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="personale_complessivo" id="personale_complessivo_4" value='E' class="radio-ott personale_complessivo" /></div>
							</div>
							<div class="x-row-fluid quesito" >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_personale_cortesia'] ?></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="personale_cortesia" id="personale_cortesia_1"  value='I' class="radio-ins personale_cortesia" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="personale_cortesia" id="personale_cortesia_2" value='S' class="radio-suf personale_cortesia" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="personale_cortesia" id="personale_cortesia_3" value='B' class="radio-buo personale_cortesia" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="personale_cortesia" id="personale_cortesia_4" value='E' class="radio-ott personale_cortesia" /></div>
							</div>
							<div class="x-row-fluid quesito quesito-white" >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_personale_professione'] ?></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="personale_professionalita" id="personale_professionalita_1"  value='I' class="radio-ins personale_professionalita" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="personale_professionalita" id="personale_professionalita_2" value='S' class="radio-suf personale_professionalita" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="personale_professionalita" id="personale_professionalita_3" value='B' class="radio-buo personale_professionalita" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="personale_professionalita" id="personale_professionalita_4" value='E' class="radio-ott personale_professionalita" /></div>
							</div>
							<div class="x-row-fluid quesito" >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_personale_animazione'] ?></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="personale_animazione" id="personale_animazione_1"  value='I' class="radio-ins personale_animazione" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="personale_animazione" id="personale_animazione_2" value='S' class="radio-suf personale_animazione" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="personale_animazione" id="personale_animazione_3" value='B' class="radio-buo personale_animazione" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="personale_animazione" id="personale_animazione_4" value='E' class="radio-ott personale_animazione" /></div>
							</div>
						</div>
						
						<div id="attivita" class="boxed-group">
							<div class="x-row-fluid intestazione" >
								<div class="x-span12"><span class='badge' id="badge-5">5/7</span>&nbsp;&nbsp;<?= $text[WPLANG_E]['q_label_attivita'] ?></div>
							</div>
							<div class="x-row-fluid leggenda" id='intestazione-attivita' >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_quesito'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_insufficiente'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_sufficiente'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_buono'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_eccellente'] ?></div>
							</div>
							<div class="x-row-fluid quesito quesito-white" >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_complessivo'] ?></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="attivita_complessivo" id="attivita_complessivo_1"  value='I' class="radio-ins attivita_complessivo" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="attivita_complessivo" id="attivita_complessivo_2" value='S' class="radio-suf attivita_complessivo" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="attivita_complessivo" id="attivita_complessivo_3" value='B' class="radio-buo attivita_complessivo" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="attivita_complessivo" id="attivita_complessivo_4" value='E' class="radio-ott attivita_complessivo" /></div>
							</div>
						</div>
                        
						<div id="ristorante"  class="boxed-group">
							<div class="x-row-fluid intestazione" >
								<div class="x-span12"><span class='badge' id="badge-6">6/7</span>&nbsp;&nbsp;<?= $text[WPLANG_E]['q_label_ristorante'] ?></div>
							</div>
							<div class="x-row-fluid leggenda" id='intestazione-ristorante' >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_quesito'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_insufficiente'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_sufficiente'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_buono'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_eccellente'] ?></div>
							</div>
							<div class="x-row-fluid quesito quesito-white" >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_complessivo'] ?></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="ristorante_complessivo" id="ristorante_complessivo_1"  value='I' class="radio-ins  ristorante_complessivo " /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="ristorante_complessivo" id="ristorante_complessivo_2" value='S' class="radio-suf ristorante_complessivo" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="ristorante_complessivo" id="ristorante_complessivo_3" value='B' class="radio-buo ristorante_complessivo" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="ristorante_complessivo" id="ristorante_complessivo_4" value='E' class="radio-ott ristorante_complessivo" /></div>
							</div>
							<div class="x-row-fluid quesito" >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_servizio'] ?></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="ristorante_servizio" id="ristorante_servizio_1"  value='I' class="radio-ins ristorante_servizio" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="ristorante_servizio" id="ristorante_servizio_2" value='S' class="radio-suf ristorante_servizio" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="ristorante_servizio" id="ristorante_servizio_3" value='B' class="radio-buo ristorante_servizio" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="ristorante_servizio" id="ristorante_servizio_4" value='E' class="radio-ott ristorante_servizio" /></div>
							</div>
							<div class="x-row-fluid quesito quesito-white" >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_qualita_cibo'] ?></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="ristorante_qualita" id="ristorante_qualita_1"  value='I' class="radio-ins ristorante_qualita" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="ristorante_qualita" id="ristorante_qualita_2" value='S' class="radio-suf ristorante_qualita" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="ristorante_qualita" id="ristorante_qualita_3" value='B' class="radio-buo ristorante_qualita" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="ristorante_qualita" id="ristorante_qualita_4" value='E' class="radio-ott ristorante_qualita" /></div>
							</div>
						</div>
						
						<div id="dati" class="boxed-group"> 
							<div class="x-row-fluid intestazione" >
								<div class="x-span12"><span class="badge" id="badge-7" >7/7</span>&nbsp;&nbsp;<?= $text[WPLANG_E]['q_label_riepiologo'] ?></div>
							</div>
							<div class="x-row-fluid leggenda" id='' >
								<div class="x-span6"></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_no'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_forse'] ?></div>
								<div class="x-span2 centered "></span><?= $text[WPLANG_E]['q_label_si'] ?></div>
							</div>
							<div class="x-row-fluid quesito quesito-white" >
								<div class="x-span6 label-mobile "><?= $text[WPLANG_E]['q_label_consiglio'] ?></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_no'] ?></span><input type="radio" name="consiglia" id="consiglia_1" value='N' class="radio-ins"/></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_forse'] ?></span><input type="radio" name="consiglia" id="consiglia_2" value='F' class="radio-suf"/></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_si'] ?></span><input type="radio" name="consiglia" id="consiglia_3" value='S' class="radio-ott"/></div>
							</div>
							<div class="x-row-fluid leggenda" id="isTrue" >
								<div class="x-span12 label-mobile"><?= $text[WPLANG_E]['q_label_suggerimenti'] ?></div>
							</div>
							<div class="x-row-fluid quesito" >
								<div class="x-span12 prl"><textarea id="suggerimenti" name="suggerimenti" class="form-control" rows="4"></textarea></div>
							</div>
							<div class="x-row-fluid quesito quesito-white" >
								<div class="x-span8 label-mobile"><?= $text[WPLANG_E]['q_label_ricevere'] ?></div>
								<div class="x-span2 centered "><span class="only-mobile"><?= $text[WPLANG_E]['q_label_no'] ?></span><input type="radio" name="info" id="info_1" value='N' class="radio-ins"/>&nbsp;&nbsp;<span class="nomobile">No</span></div>
								<div class="x-span2 centered "><span class="only-mobile"><?= $text[WPLANG_E]['q_label_si'] ?></span><input type="radio" name="info" id="info_2" value='S' class="radio-ott"/>&nbsp;&nbsp;<span class="nomobile">Si</span></div>
							</div>
							<div class="x-row-fluid quesito" id="dati-utente" style="display:none" >
								<div class="x-span3 prl">
									<label><?= $text[WPLANG_E]['q_label_nome'] ?>&nbsp;&nbsp;<span class="error" id="error_nome"></span></label> 
									<input type='text' class="wpcf7-form fullwidth resetError" name='nome' id='nome' />
								</div>
								<div class="x-span3 prl">
									<label><?= $text[WPLANG_E]['q_label_cognome'] ?>&nbsp;&nbsp;<span class="error" id="error_cognome"></span></label> 
									<input type='text' class="wpcf7-form fullwidth resetError" name='cognome' id='cognome' />
								</div>
								<div class="x-span3 prl">
									<label><?= $text[WPLANG_E]['q_label_email'] ?>&nbsp;&nbsp;<span class="error" id="error_email"></span></label> 
									 <div class="input-group date" id="datepicker-pastdisabled">
										<span class="input-group-addon"><i class="fas fa-envelope"></i></span>
										<input type="text" class="form-control sm-input wpcf7-form fullwidth resetError" id="email" name="email" value=""/>
									</div>
								</div>
								<div class="x-span3 prl">
									<label><?= $text[WPLANG_E]['q_label_cellulare'] ?>&nbsp;&nbsp;<span class="error" id="error_cellulare"></span></label> 
									 <div class="input-group date" id="datepicker-pastdisabled">
										<span class="input-group-addon"><i class="fas fa-phone"></i></span>
										<input type="text" class="form-control sm-input wpcf7-form fullwidth resetError" id="cellulare" name="cellulare" value=""/>
									</div>
								</div>
							</div>
						   <div class="x-row-fluid  quesito " style="padding-top: 20px" > 
								<div class="x-span6">
									<div class="g-recaptcha" data-sitekey="6LfUDhkTAAAAAGqM-lsmYLjwSkqyp2MJTFyfkJy0"></div>
									 <span id='error_captcha_code'class='checkerror' ></span>
								</div>
								 <div class="x-span6">
									<input type='checkbox' name='informativa' id='informativa' value='Y' class="check-blue resetError" />
									<?= $text[WPLANG_E]['label_informativa_letta'] ?>*<br /> <span id='error_informativa'class='checkerror' ></span>
									 <div class="tanks" style="padding-top: 10px"><?= $text[WPLANG_E]['q_label_grazie'] ?></div>
								</div>
							</div>
							 <div class="x-row-fluid quesito" >
								<div class="x-span12 prl" style="text-align: center; padding-bottom: 20px; padding-top: 30px">
									<a href="javascript:void();" class="btn-send"><?= $text[WPLANG_E]['q_label_invia'] ?></a>
								</div>
							</div>
						</div>
						<input type="hidden" name="language" id="language" value="<?= WPLANG_E ?>" />
						<input type="hidden" name="idQ" id="idQ" value='' />
						<input type="hidden" name="from" id="from" value='D' />
					</form>
				</div>
			</div>
		</div>
		
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
		<script src="https://www.google.com/recaptcha/api.js"></script>
		<script src="functions.js"></script>
		<script src="bootstrap-datepicker.js"></script>
		<script src="bootstrap-datepicker.it.js"></script>
		
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
    </body>
</html>