<?php
	session_start();
	error_reporting(E_ALL & ~E_NOTICE);
	ini_set('display_errors', 1);

	require_once '../lib/class-db.php';
	require_once 'assets/php/lang.php';

	define ('LANG', 'it_IT');

//~ $tmp = get_locale() ;

//~ $tmp == 'en_US' ? $tmp ='en_GB':'';

//~ define('LANG', $tmp );

//~ require_once(ABSPATH . 'wp-register/includes/class-db.php');
//~ require_once(ABSPATH . 'wp-register/includes/lang.php');

	// FROM SHARING 
	$db = new MySql_DB("localhost", "qualita", "qualita", "00qQUFDTOlKl6O3", true); 

	$nazionalita    = $db->CycleAssochId($db->Query("SELECT id, nome FROM doc_nazioni   "));
	$occupazione    = $db->CycleAssochId($db->Query("SELECT id, nome_" .LANG. " as nome FROM doc_occupazioni   "));
	$conoscienza    = $db->CycleAssochId($db->Query("SELECT id, nome_" .LANG. " as nome FROM doc_segnalato   "));
	$formule        = $db->CycleAssochId($db->Query("SELECT id, nome_" .LANG. " as nome FROM doc_formule WHERE form_sh = 'Y' AND show_on_q = 'Y'"));

	$housing        = $db->CycleAssochId($db->Query("SELECT id, nome_" .LANG. " as nome FROM doc_housing  "));
//~ 	$campus         = $db->CycleAssochId($db->Query("SELECT id, nome_" .LANG. " as nome  FROM doc_campus WHERE formulaId IN (5)"));

	$campus         = $db->Query("SELECT formulaId, id, nome_" .LANG. " as nome  FROM doc_campus WHERE formulaId IN (2,5,7,8) ORDER BY formulaId, nome_" .LANG);
	
//~ 	print_r($campus);
 	
	while($v = $db->FetchAssoc($campus)) {
		$rooms[$v['formulaId']][$v['id']] = $v['nome'];
	}
	
	//$housing_fossata        = $db->CycleAssochId($db->Query("SELECT id, nome_" .LANG. " as nome FROM doc_housing_fossata  "));
	//$campus_fossata         = $db->CycleAssochId($db->Query("SELECT id, nome_" .LANG. " as nome  FROM doc_campus_fossata   "));

	//$camere         = $db->CycleAssochId($db->Query("SELECT id, nome_" .LANG. " as nome  FROM doc_camere WHERE formulaId = 5"));
	//$camereFossata  = $db->CycleAssochId($db->Query("SELECT id, nome_" .LANG. " as nome  FROM doc_camere_fossata   "));
	
//~ 	print_r($rooms);

	// Classe 
	$oneHalf ="flex_column av_one_half  flex_column_div av-zero-column-padding   avia-builder-el-7  el_before_av_one_half  avia-builder-el-first  ";
	$row     ="flex_column_table av-equal-height-column-flextable av-break-at-tablet-flextable row";
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Sharing ::: Prenotazione</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
		<link rel="stylesheet" href="assets/css/custom.css" />
		<link rel="stylesheet" href="assets/css/datapicker.css" />
		<style>
			.checkerror{color:#dc3545;font-weight:bold;font-size:0.8em}			
			body {
				background: url(assets/img/back_sharing.jpg) no-repeat center center fixed;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
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
				<!--<img class="d-block mx-auto mb-4" src="https://qualita.cooperativadoc.it/img/qu-sharing.png" alt="" />-->
				<h2>Prenota su Sharing Torino</h2>
				<!--<p class="lead"><?= $text[WPLANG_E]['q_intro'] ?></p>-->
				<p class="lead">Compila il form per prenotare il tuo posto su Sharing Torino!</p>
			</div>
			
			<div class="row">
				
				<div class="col-xl-12">
					<form id="form-sharing" method="POST">
						<input type='hidden' name='language' id='language' value='<?= LANG ?>' />
						<input type='hidden' name='from' id='from' value='sharing' />
								
						<div id="form-dati">
							<h3>
								<?= $text[LANG]['dati'] ?>
							</h3>
							
							<div class="form-group row">
								<div class="col-sm-6">
									<label for="nome"><?= $text[LANG]['label_nome'] ?>*</label>
									<input id="nome" name="nome" type="text" class="form-control obbligatorio valida" data-label="<?= $text[LANG]['label_nome'] ?>" />
								</div>
								<div class="col-sm-6">
									<label for="cognome"><?= $text[LANG]['label_cognome'] ?>*</label>
									<input id="cognome" name="cognome" type="text" class="form-control obbligatorio valida" data-label="<?= $text[LANG]['label_cognome'] ?>" />
								</div>
							</div>
                            <div class="form-group row">
								<div class="col-sm-6">
									<label for="email"><?= $text[LANG]['label_email'] ?>*</label>
									<div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        <input id="email" name="email" data-tipo="email" type="text" class="form-control obbligatorio valida" data-label="<?= $text[LANG]['label_email'] ?>">
                                    </div>
								</div>
								<div class="col-sm-6">
									<label for="cellulare"><?= $text[LANG]['label_cellulare'] ?>*</label>
									<div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                        </div>
                                        <input id="cellulare" name="cellulare" data-tipo="numero" type="text" class="form-control obbligatorio valida" data-label="<?= $text[LANG]['label_cellulare'] ?>">
                                    </div>
                                </div>
							</div>
                            <div class="form-group row">
								<div class="col-sm-6">
									<label for="email"><?= $text[LANG]['label_natoa'] ?>*</label>
                                    <input id="luogo_nascita" name="luogo_nascita" data-tipo="text" type="text" class="form-control obbligatorio valida" data-label="<?= $text[LANG]['label_natoa'] ?>">
								</div>
								<div class="col-sm-6">
									<label for="cellulare"><?= $text[LANG]['label_natoil'] ?>*</label>
									<div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text data data_picker" data-refer="data_nascita"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input id="data_nascita" name="data_nascita" data-tipo="data" type="text" class="form-control obbligatorio valida" data-label="<?= $text[LANG]['label_natoil'] ?>" placeholder="gg-mm-aaaa">
                                    </div>
                                </div>
							</div>
                            
                            <div class="form-group row">
								<div class="col-sm-6">
                                    <label for="nazionalita"><?= $text[LANG]['label_nazionalita'] ?>*</label>
                                    <select name="nazionalita" id="nazionalita" class="form-control obbligatorio valida" data-label="<?= $text[LANG]['label_nazionalita'] ?>">
										<option value=""><?= $text[LANG]['label_scegli'] ?></option>
										<?php foreach ($nazionalita as $id => $val): ?>
										<option value="<?= $id ?>"><?= $val ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="occupazione"><?= $text[LANG]['label_occupazione'] ?>*</label>
									<select name="occupazione" id="occupazione" class="form-control obbligatorio valida" data-tipo="number" data-label="<?= $text[LANG]['label_occupazione'] ?>">
                                        <option value=""><?= $text[LANG]['label_scegli'] ?></option>
                                        <?php foreach ($occupazione as $id => $val): ?>
                                        <option value="<?= $id ?>"><?= $val ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <legend class="col-form-label"><?= $text[LANG]['label_sesso'] ?>*</legend>
                                <div class="row">
                                    <div class="col-sm-10">
                                        <div class="form-check form-check-inline">
                                            <input name="sesso" id="sesso_m" value="M" class="form-check-input check-error" type="radio">
                                            <label class="form-check-label" for="sesso_m"><?= $text[LANG]['label_sm_pdf'] ?></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input name="sesso" id="sesso_f" value="F" class="form-check-input check-error" type="radio">
                                            <label class="form-check-label" for="sesso_f"><?= $text[LANG]['label_sf_pdf'] ?></label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
						</div>
								
						<div id="form-richiesta">
							<h3>
								<?= $text[LANG]['label_allogio'] ?>
							</h3>
                            
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="conoscienza"><?= $text[LANG]['label_conoscenza_sharing'] ?> *&nbsp;&nbsp;&nbsp;</label>
									<select name="conoscienza" id="conoscienza" class="form-control obbligatorio valida" data-label="<?= $text[LANG]['label_conoscenza_sharing'] ?>">
										<option value=""><?= $text[LANG]['label_scegli'] ?></option>
										<?php foreach ($conoscienza as $id => $val): ?>
											<option value="<?= $id ?>"><?php echo $val;?></option>
										<?php endforeach; ?>
									</select>
                                </div>
                                <div class="col-sm-6">
                                    <fieldset class="form-group">
                                        <legend class="col-form-label"><?= $text[LANG]['label_prima_volta_sharing'] ?>*</legend>
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <div class="form-check form-check-inline">
                                                    <input name="prima_volta" id="prima_volta_y" value="Y" class="form-check-input check-error" type="radio" data-label="<?= $text[LANG]['label_prima_volta'] ?>">
                                                    <label class="form-check-label" for="prima_volta_y"><?= $text[LANG]['label_si'] ?></label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input name="prima_volta" id="prima_volta_n" value="N" class="form-check-input check-error" type="radio">
                                                    <label class="form-check-label" for="prima_volta_n"><?= $text[LANG]['label_no'] ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="data_arrivo"><?= $text[LANG]['label_arrivo'] ?>*</label>
									<div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text data data_picker" data-refer="data_arrivo"><i class="fa fa-calendar"></i></span>
										</div>
                                        <input type="text" id="data_arrivo" name="data_arrivo" placeholder="gg-mm-aaaaa" data-tipo="data" class="form-control valida obbligatorio data-picker" data-label="<?= $text[LANG]['label_arrivo'] ?>">
									</div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="data_partenza"><?= $text[LANG]['label_partenza'] ?>*</label>
									<div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text data data_picker" data-refer="data_partenza"><i class="fa fa-calendar"></i></span>
										</div>
                                        <input type="text" id="data_partenza" name="data_partenza" placeholder="gg-mm-aaaaa" data-tipo="data" class="form-control valida obbligatorio data-picker" data-label="<?= $text[LANG]['label_partenza'] ?>">
									</div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="formula"><?= $text[LANG]['label_formula'] ?>*</label>
									<select name="formula" id="formula" data-label="<?= $text[LANG]['label_formula'] ?>" data-tipo="number" class="form-control valida obbligatorio update-formula">
										<option value=""><?= $text[LANG]['label_scegli'] ?></option>
										<?php foreach ($formule as $id => $val): ?>
										<option value="<?= $id ?>"><?php echo $val; ?></option>
										<?php endforeach; ?>
                                    </select>
                                </div>
                                <div id="formula-housing" class="col-sm-3" style="display:none">
                                    <label for="housing"><?= $text[LANG]['label_housing'] ?>*</label>
									<select name="housing" id="housing" data-label="<?= $text[LANG]['label_housing'] ?>" data-tipo="number" class="form-control">
                                        <option value=""><?= $text[LANG]['label_scegli'] ?></option>
										<?php foreach ($housing as $id => $val): ?>
										<option value="<?php echo $id; ?>"><?php echo $val; ?></option>
										<?php endforeach; ?>
                                    </select>
                                </div>
                                <div id="formula-campus" class="col-sm-3" style="display:none">
                                    <label for="campus"><?= $text[LANG]['label_campus'] ?>*</label>
									<select name="campus" id="campus" data-label="<?= $text[LANG]['label_campus'] ?>" data-tipo="number" class="form-control">
                                        <option value=""><?= $text[LANG]['label_scegli'] ?></option>
                                        <?php //foreach ($campus as $id => $val): ?>
                                        <!--<option value="<?php //echo $id; ?>"><?php //echo utf8_encode($val); ?></option>-->
                                        <?php //endforeach; ?>
                                    </select>
                                </div>

								<div class="col-sm-3" id='coabitazione' style='display: none'>
									<label for="coabitazione"><?= $text[LANG]['label_abbinamento'] ?>**</label>
									<input type='text' class="form-control valida" data-tipo='text' name='coabitazione' id='coabitazione' data-label="<?= $text[LANG]['label_abbinamento'] ?>" />
								</div>

                            </div>


							
							
							<div class='<?= $row ?>'>
								<div class='col-sm-12'>
									<label><?= $text[LANG]['label_note'] ?></label>
									<textarea rows='4' name='note' id='note' class="form-control valida" data-label="<?= $text[LANG]['label_note'] ?>" data-tipo="text" ></textarea>
								</div>
							</div>
							<div class='<?= $row ?>'>
								<div class=''>
									<input type='checkbox' name='informativa' id='informativa' value='Y' class="check-blue check-error" data-refer='informativa' />
									<?= $text[LANG]['label_informativa_letta'] ?>* <span id='error_informativa' class='error_text'></span>
								</div>
							</div>
							<div class='<?= $row ?>'>
								<div class=''>
									<input type='checkbox' name='privacy' id='privacy'  value='Y' class="check-blue check-error" data-refer='privacy' />
									<?= $text[LANG]['label_privacy'] ?>* <span id='error_privacy' class='error_text'></span>
								</div>
							</div>
							<div class='<?= $row ?>'>
								<div class=''>
									<input type='checkbox' name='mailing' id='mailing' value='Y' class="check-blue" />
									<?= $text[LANG]['label_consenso'] ?>
								</div>
							</div>
							<div class='<?= $row ?>'>
								<div class='<?= $oneHalf ?> first'>
									<div class="g-recaptcha" data-sitekey="6LfUDhkTAAAAAGqM-lsmYLjwSkqyp2MJTFyfkJy0"></div>
									<span id='error_captcha_code' class='error_text'></span>
								</div>
								<div class='<?= $oneHalf ?> '>
									<?= $text[LANG]['label_obbligatori'] ?>
								</div>
							</div>
								
							<div class='<?= $row ?>'>
								<hr>
								<div class="box-button">
									<a href="" class='button' id='btn-submit-form' data-refer ='form-sharing'>
										<?= $text[LANG]['label_pulsante'] ?>
									</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
		<script src="https://www.google.com/recaptcha/api.js"></script>
		<script src="assets/js/functions.js"></script>
		<script src="assets/js/lang.js"></script>
		<script src="assets/js/bootstrap-datepicker.js"></script>
		<script src="assets/js/bootstrap-datepicker.it.js"></script>
		
		<script>
			<?php echo "var rooms = ".json_encode($rooms)."\n"; ?>
		</script>
		
		<!--<div id="validationModal" class="modal fade" tabindex="-1" role="dialog">
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
		</div>-->
		
		<div class="modal fade" id="validationModal" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 id="modal-info-title" class="modal-title"><i class="fas fa-exclamation-triangle"></i>&nbsp;</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="modal-info-text"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $text[LANG]['label_chiudi'] ?></button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modal-privacy" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">X</button>
						<h4 class="modal-title"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;<?= $text[LANG]['label_informativa'] ?></h4>
					</div>
					<div class="modal-body">
					<?php  require_once('./assets/php/informativa_'.LANG.'.php'); ?>
					</div>
					<div class="modal-footer box-button">
						<button type="button" class="button" data-dismiss="modal"><?= $text[LANG]['label_chiudi'] ?></button>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>