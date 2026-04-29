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


	$db = new MySql_DB("localhost", "qualita", "qualita", "00qQUFDTOlKl6O3", true);
	$tipologie = $db->CycleAssochId($db->Query("SELECT id, nome FROM doc_tipologie_clienti ORDER BY nome"));
	$conoscenza = $db->CycleAssochId($db->Query("SELECT id, nome FROM doc_conoscenza ORDER BY nome"));
	$strutture = $db->CycleAssochId($db->Query("SELECT id, nome FROM doc_unita WHERE qformazione='Y' ORDER BY nome"));
	$tipo_corso = $db->CycleAssochId($db->Query("SELECT id, nome FROM doc_tipologie_formazione WHERE attivo ='Y' ORDER BY nome"));
	$titoli = $db->CycleAssochId($db->Query("SELECT id, titolo_corso AS nome FROM doc_formazione_titolo_corsi WHERE attivo = 'Y' ORDER BY nome"));

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Cooperativa DOC ::: Questionario qualità</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
		<link rel="stylesheet" href="custom.css" />
		<link rel="stylesheet" href="datepicker.css" />
		<style>
			.checkerror{color:#dc3545;font-weight:bold;font-size:0.8em}			
//~ 			body {
//~ 				background: url(../assets-forms/img/back_keluar.jpg) no-repeat center center fixed;
//~ 				-webkit-background-size: cover;
//~ 				-moz-background-size: cover;
//~ 				-o-background-size: cover;
//~ 				background-size: cover;
//~ 			}
			.container {}
			.sf-q-title {background-color:#ec7a1d;color:#FFFFFF}
			.sf-q-quesito {background-color:#7f192c;color:#FFFFFF}
//~ 			.boxed-group label {color:#384b57}
		</style>
    </head>
    <body>
		<div class="container">
			<div class="py-5 text-left">
				<img class="d-block mx-auto mb-4" src="https://qualita.cooperativadoc.it/img/qu-doc.png" alt="" >
				<!--<h2>Checkout form</h2>-->
				<p class="lead"><?= $text[WPLANG_E]['f_intro'] ?></p>
				<p class="lead"><?= $text[WPLANG_E]['f_grazie'] ?></p>
			</div>
			
			<div class="row">
				
				<div class="col-xl-12">
					<form id="form_formazione" name="form_formazione">
						<div id="vacanza" class="boxed-group">
							<div class="x-row-fluid quesito ptop10">
								<div class="x-span3 prl">
									<label><?= $text[WPLANG_E]['f_data'] ?>&nbsp;&nbsp;<span class="error" id="error_data_corso"></span></label> 
									<div class="input-group date" id="datepicker-pastdisabled">
										<span class="input-group-addon" id="data_corso-pick" ><i class="fas fa-calendar"></i></span>
										<input data-provide="datepicker" type="text" class="form-control viaggio resetError" id="data_corso" name="data_corso" maxlength="10" size="10" value=""/>
									</div>
								</div>
								<div class="x-span3 prl">
									<label><?= $text[WPLANG_E]['f_tipo_corso'] ?>&nbsp;&nbsp;<span class="error" id="error_tipo_corso"></span> </label>
									<select name="tipo_corso" id="tipo_corso" class="form-control input-full nop viaggio resetError">
										<option value ='' ><?= $text[WPLANG_E]['q_scegli'] ?></option>
										<? foreach ($tipo_corso as $id => $val) { ?>
											<option  value='<?= $id ?>'><?= $val ?></option>
										<? } ?>
									</select>
								</div>
								<div class="x-span6 prl">
									<label><?= $text[WPLANG_E]['f_titolo'] ?>&nbsp;&nbsp;<span class="error" id="error_titolo"></span></label> 
									<!--<input type="text" class="form-control wpcf7-form fullwidth resetError" name="titolo" id="titolo" />-->

									<select class="form-control wpcf7-form fullwidth resetError" name="titolo" id="titolo">
										<option value="">Seleziona...</option>
										<?php foreach($titoli as $id => $titolo):?>
										<option value="<?php echo $id;?>"><?php echo $titolo;?></option>
										<?php endforeach;?>
									</select>

								</div>
							</div>
							<div class="x-row-fluid quesito bottom10">
								<div class="x-span4 prl">
									<label><?= $text[WPLANG_E]['f_nome'] ?>&nbsp;&nbsp;<span class="error" id="error_nome"></span></label> 
									<input type="text" class="form-control wpcf7-form fullwidth resetError" name="nome" id="nome" />
								</div>
								<div class="x-span4 prl">
									<label><?= $text[WPLANG_E]['f_cognome'] ?>&nbsp;&nbsp;<span class="error" id="error_cognome"></span></label> 
									<input type='text' class="form-control wpcf7-form fullwidth resetError" name="cognome" id="cognome" />
								</div>
								<div class="x-span4 prl">
								   <label><?= $text[WPLANG_E]['f_ente'] ?>&nbsp;&nbsp;<span class='error' id='error_ente'></span> </label>
									<input type='text' class="form-control wpcf7-form fullwidth resetError" name='ente_corso' id='ente_corso' />
								</div>
							</div>
							<div class="x-row-fluid intestazione nomobile" id='intestazione-struttura' >
								<div class="x-span4"><?= $text[WPLANG_E]['q_label_quesito'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_insufficiente'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_sufficiente'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_buono'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_eccellente'] ?></div>
							</div>
							<div class="x-row-fluid quesito" >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['f_giudizio'] ?>&nbsp;&nbsp;<span class='error' id='error_giudizio'></span></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="giudizio" id="giudizio_1"  value='I' class="radio-ins giudizio" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="giudizio" id="giudizio_2" value='S' class="radio-suf giudizio" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="giudizio" id="giudizio_3" value='B' class="radio-buo giudizio" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="giudizio" id="giudizio_4" value='E' class="radio-ott giudizio " /></div>
							</div>
							<div class="x-row-fluid quesito quesito-white" >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['f_temi'] ?>&nbsp;&nbsp;<span class='error' id='error_temi'></span></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="temi" id="temi_1"  value='I' class="radio-ins temi" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="temi" id="temi_2" value='S' class="radio-suf temi" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="temi" id="temi_3" value='B' class="radio-buo temi" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="temi" id="temi_4" value='E' class="radio-ott temi " /></div>
							</div> 
							<div class="x-row-fluid quesito " >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['f_conduzione'] ?>&nbsp;&nbsp;<span class='error' id='error_conduzione'></span></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="conduzione" id="conduzione_1"  value='I' class="radio-ins conduzione" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="conduzione" id="conduzione_2" value='S' class="radio-suf conduzione" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="conduzione" id="conduzione_3" value='B' class="radio-buo conduzione" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="conduzione" id="conduzione_4" value='E' class="radio-ott conduzione " /></div>
							</div> 
							<div class="x-row-fluid quesito quesito-white" >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['f_spazi'] ?>&nbsp;&nbsp;<span class='error' id='error_spazi'></span></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="spazi" id="spazi_1"  value='I' class="radio-ins spazi" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="spazi" id="spazi_2" value='S' class="radio-suf spazi" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="spazi" id="spazi_3" value='B' class="radio-buo spazi" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="spazi" id="spazi_4" value='E' class="radio-ott spazi " /></div>
							</div> 
							<div class="x-row-fluid quesito" >
								<div class="x-span4 label-mobile"><?= $text[WPLANG_E]['f_livello'] ?>&nbsp;&nbsp;<span class='error' id='error_livello'></span></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="livello" id="livello_1"  value='I' class="radio-ins livello" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="livello" id="livello_2" value='S' class="radio-suf livello" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="livello" id="livello_3" value='B' class="radio-buo livello" /></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="livello" id="livello_4" value='E' class="radio-ott livello " /></div>
							</div>
							 <div class="x-row-fluid intestazione nomobile" id="intestazione-struttura">
								<div class="x-span8"></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_no_big'] ?></div>
								<div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_si_big'] ?></div>
							</div>
							<div class="x-row-fluid quesito quesito-white" >
								<div class="x-span8 label-mobile"><?= $text[WPLANG_E]['f_consiglio'] ?>&nbsp;&nbsp;<span class='error' id='error_consiglia'></span></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_no_'] ?></span><input type="radio" name="consiglia" id="consiglia_1" value='N' class="radio-ins consiglia"/></div>
								<div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_si'] ?></span><input type="radio" name="consiglia" id="consiglia_3" value='S' class="radio-ott consiglia"/></div>
							 </div> 
							<div class="x-row-fluid quesito" id="isTrue" >
								<div class="x-span12 label-mobile"><?= $text[WPLANG_E]['f_suggerimenti'] ?></div>
							</div>
							<div class="x-row-fluid quesito" >
								<div class="x-span12 prl"><textarea class="form-control mb-2" id="suggerimenti" name="suggerimenti" rows="4"></textarea></div>
							</div>
							<div class="x-row-fluid  quesito quesito-white" id="isTrue" >
								<div class="x-span12 label-mobile"><?= $text[WPLANG_E]['f_argomenti'] ?></div>
							</div>
							<div class="x-row-fluid quesito quesito-white" >
								<div class="x-span12 prl"><textarea class="form-control mb-2" id="argomenti" name="argomenti" rows='4' ></textarea></div>
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
							
							<div class="x-row-fluid quesito">
								<div class="x-span12 prl" style="text-align: center; padding-bottom: 20px; padding-top: 30px">
									<a href="#" class="btn-send"><?= $text[WPLANG_E]['q_label_invia'] ?></a>
								</div>
							</div>
						</div>
						<input type="hidden" name="language" id="language" value="<?= WPLANG_E ?>" />
						<input type="hidden" name="idQ" id="idQ" value="" />
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