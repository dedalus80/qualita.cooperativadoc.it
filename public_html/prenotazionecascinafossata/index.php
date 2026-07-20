<?php
	session_start();
	error_reporting(E_ALL & ~E_NOTICE);
	ini_set('display_errors', 1);

	require_once '../lib/class-db.php';
	require_once 'assets/php/lang.php';

	define ('LANG', 'it_IT');
	
	if(!$_SESSION['referer_site']) {
		$referer = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
		
		if($referer == 'sh-sharing.it')
			$_SESSION['referer_site'] = 'P';
		else
			$_SESSION['referer_site'] = 'S';
	}

//~ $tmp = get_locale() ;

//~ $tmp == 'en_US' ? $tmp ='en_GB':'';

//~ define('LANG', $tmp );

//~ require_once(ABSPATH . 'wp-register/includes/class-db.php');
//~ require_once(ABSPATH . 'wp-register/includes/lang.php');

	// FROM SHARING 
	$db = new MySql_DB("localhost", "qualita_1_sito", "qualita_1_sito", '^B&FpWPQ7*;TDFm', true, "utf8"); 

	$nazionalita    = $db->CycleAssochId($db->Query("SELECT id, nome FROM doc_nazioni   "));
	$occupazione    = $db->CycleAssochId($db->Query("SELECT id, nome_" .LANG. " as nome FROM doc_occupazioni"));
	$conoscienza    = $db->CycleAssochId($db->Query("SELECT id, nome_" .LANG. " as nome FROM doc_segnalato"));
	$formule        = $db->CycleAssochId($db->Query("SELECT id, nome_" .LANG. " as nome FROM doc_formule WHERE form_fossata = 'Y' AND show_on_q = 'Y'"));
	
	$campus         = $db->Query("SELECT formulaId, id, nome_" .LANG. " as nome  FROM doc_campus WHERE formulaId IN (1,2,4,9) ORDER BY formulaId, nome_" .LANG);
 	
	while($v = $db->FetchAssoc($campus)) {
		$rooms[$v['formulaId']][$v['id']] = $v['nome'];
	}

	//$housing        = $db->CycleAssochId($db->Query("SELECT id, nome_" .LANG. " as nome FROM doc_housing"));
	//$campus         = $db->CycleAssochId($db->Query("SELECT id, nome_" .LANG. " as nome  FROM doc_campus"));
	//$housing_fossata = $db->CycleAssochId($db->Query("SELECT id, nome_" .LANG. " as nome FROM doc_housing_fossata WHERE attivo = 'Y'"));
	//$campus_fossata  = $db->CycleAssochId($db->Query("SELECT id, nome_" .LANG. " as nome  FROM doc_campus_fossata WHERE attivo = 'Y'"));

	//$camere         = $db->CycleAssochId($db->Query("SELECT id, nome_" .LANG. " as nome  FROM doc_camere"));
	//$camereFossata  = $db->CycleAssochId($db->Query("SELECT id, nome_" .LANG. " as nome  FROM doc_camere_fossata"));

	// Classe 
//~ 	$oneHalf = "flex_column av_one_half  flex_column_div av-zero-column-padding   avia-builder-el-7  el_before_av_one_half  avia-builder-el-first  ";
//~ 	$row     = "flex_column_table av-equal-height-column-flextable av-break-at-tablet-flextable row";
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Cascina Fossata ::: modulo prenotazioni</title>
		<link rel="stylesheet" href="../css/bootstrap/4.5.3/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/font-awesome/5.15.1/css/all.min.css" />
		<link rel="stylesheet" href="assets/css/custom.css" />
		<link rel="stylesheet" href="assets/css/datepicker.css" />
		<style>
			.checkerror{color:#dc3545;font-weight:bold;font-size:0.8em}			
			body {
				background: url(assets/img/back_fossata.jpg) no-repeat center center fixed;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
			}
			label, legend, h3 {color:#1a2545;font-weight:bold}
			.form-check label {color:#000000;font-weight:normal}
			.container {background-color:#FFFFFF}
		</style>
    </head>
    <body>
		<div class="container">
			<div class="row py-5">
				<div class="col-md-2">
					<img class="img-responsive" style="width:100px;" src="./assets/img/logo_fossata.png">
				</div>
				<div class="col-md-10 my-auto">
					<h4>Prenota a Cascina Fossata</h4>
					<p class="lead">Compila il form per prenotare il tuo appartamento a Cascina Fossata!</p>
				</div>
			</div>
			
			<div class="row">
				
				<div class="col-xl-12">
					<form id="form-fossata" method="POST">
						<input type="hidden" name="language" id="language" value="<?= LANG ?>" />
						<input type="hidden" name="from" id="from" value="fossata" />
						<input type="hidden" name="referer" value="<?php echo $_SESSION['referer_site'];?>" />
								
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
									<label for="data_nascita"><?= $text[LANG]['label_natoil'] ?>*</label>
									<div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text data data_picker" data-refer="data_nascita"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input id="data_nascita" name="data_nascita" data-tipo="date" type="text" class="form-control obbligatorio valida" data-label="<?= $text[LANG]['label_natoil'] ?>" placeholder="gg-mm-aaaa">
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

							<div class="form-group row">
								<div class="col-sm-12">
									<label for="sesso_m"><?= $text[LANG]['label_sesso'] ?>*</label>
									<div>
										<div class="form-check form-check-inline">
											<input name="sesso" id="sesso_m" value="M" class="form-check-input check-error" type="radio" data-label="<?= $text[LANG]['label_sesso'] ?>">
											<label class="form-check-label" for="sesso_m"><?= $text[LANG]['label_sm_pdf'] ?></label>
										</div>
										<div class="form-check form-check-inline">
											<input name="sesso" id="sesso_f" value="F" class="form-check-input check-error" type="radio" data-label="<?= $text[LANG]['label_sesso'] ?>">
											<label class="form-check-label" for="sesso_f"><?= $text[LANG]['label_sf_pdf'] ?></label>
										</div>
									</div>
								</div>
							</div>
						</div>
								
						<div id="form-richiesta">
							<h3><?= $text[LANG]['label_allogio'] ?></h3>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="conoscienza"><?= $text[LANG]['label_conoscenza_fossata'] ?>*</label>
									<select name="conoscienza" id="conoscienza" class="form-control obbligatorio valida" data-label="<?= $text[LANG]['label_conoscenza_fossata'] ?>">
										<option value=""><?= $text[LANG]['label_scegli'] ?></option>
										<?php foreach ($conoscienza as $id => $val): ?>
											<option value="<?= $id ?>"><?= $val ?></option>
										<?php endforeach; ?>
									</select>
                                </div>
                                <div class="col-sm-6">
									<label for="prima_volta_y"><?= $text[LANG]['label_prima_volta_fossata'] ?>*</label>
									<div>
										<div class="form-check form-check-inline">
											<input name="prima_volta" id="prima_volta_y" value="Y" class="form-check-input check-error" type="radio" data-label="<?= $text[LANG]['label_prima_volta_fossata'] ?>">
											<label class="form-check-label" for="prima_volta_y"><?= $text[LANG]['label_si'] ?></label>
										</div>
										<div class="form-check form-check-inline">
											<input name="prima_volta" id="prima_volta_n" value="N" class="form-check-input check-error" type="radio" data-label="<?= $text[LANG]['label_prima_volta_fossata'] ?>">
											<label class="form-check-label" for="prima_volta_n"><?= $text[LANG]['label_no'] ?></label>
										</div>
									</div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="data_arrivo"><?= $text[LANG]['label_arrivo'] ?>*</label>
									<div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text data data_picker" data-refer="data_arrivo"><i class="fa fa-calendar"></i></span>
										</div>
                                        <input type="text" id="data_arrivo" name="data_arrivo" placeholder="gg-mm-aaaaa" data-tipo="date" class="form-control valida obbligatorio data-picker" data-label="<?= $text[LANG]['label_arrivo'] ?>">
									</div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="data_partenza"><?= $text[LANG]['label_partenza'] ?>*</label>
									<div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text data data_picker" data-refer="data_partenza"><i class="fa fa-calendar"></i></span>
										</div>
                                        <input type="text" id="data_partenza" name="data_partenza" placeholder="gg-mm-aaaaa" data-tipo="date" class="form-control valida obbligatorio data-picker" data-label="<?= $text[LANG]['label_partenza'] ?>">
									</div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="formula"><?= $text[LANG]['label_formula'] ?>*</label>
									<select name="formula" id="formula" data-label="<?= $text[LANG]['label_formula'] ?>" data-tipo="number" class="form-control valida obbligatorio update-formula">
										<option value=""><?= $text[LANG]['label_scegli'] ?></option>
										<?php foreach ($formule as $id => $val): ?>
										<option value="<?= $id ?>"><?= $val ?></option>
										<?php endforeach; ?>
                                    </select>
                                </div>
                                <div id="formula-housing" class="col-sm-6" style="display:none">
                                    <label for="housing"><?= $text[LANG]['label_housing'] ?>*</label>
									<select name="housing" id="housing" data-label="<?= $text[LANG]['label_housing'] ?>" data-tipo="number" class="form-control">
                                        <option value=""><?= $text[LANG]['label_scegli'] ?></option>
										<?php //foreach ($housing_fossata as $id => $val): ?>
										<!-- <option value="<?= $id ?>"><?= $val ?></option> -->
										<?php //endforeach; ?>
                                    </select>
                                </div>
                                <div id="formula-campus" class="col-sm-6" style="display:none">
                                    <label for="campus"><?= $text[LANG]['label_campus'] ?>*</label>
									<select name="campus" id="campus" data-label="<?= $text[LANG]['label_campus'] ?>" data-tipo="number" class="form-control">
                                        <option value=""><?= $text[LANG]['label_scegli'] ?></option>
                                        <?php foreach ($campus as $id => $val): ?>
                                        <option value="<?= $id ?>"><?= $val ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
								<div id="coabitazione" class="col-sm-3" style="display:none">
									<label for="abbinamento"><?= $text[LANG]['label_abbinamento'] ?>**</label>
									<input type="text" class="form-control valida" data-tipo="text" name="abbinamento" id="abbinamento" data-label="<?= $text[LANG]['label_abbinamento'] ?>">
								</div>
                            </div>
							
							<div class="form-group row">
								<div class="col-sm-12">
									<label for="note"><?= $text[LANG]['label_note'] ?></label>
									<textarea rows="4" name="note" id="note" class="form-control valida" data-label="<?= $text[LANG]['label_note'] ?>" data-tipo="text"></textarea>
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-sm-12">
									<div class="form-check">
										<input class="form-check-input check-error" type="checkbox" value="Y" name="informativa" id="informativa" data-refer="informativa">
										<label class="form-check-label" for="informativa">
											<?= $text[LANG]['label_informativa_letta'] ?>* <span id="error_informativa" class="error_text"></span>
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input check-error" type="checkbox" value="Y" name="privacy" id="privacy" data-refer="privacy">
										<label class="form-check-label" for="privacy">
											<?= $text[LANG]['label_privacy'] ?>* <span id="error_privacy" class="error_text"></span>
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input check-error" type="checkbox" value="Y" name="mailing" id="mailing">
										<label class="form-check-label" for="mailing">
											<?= $text[LANG]['label_consenso'] ?>
										</label>
									</div>
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-sm-6">
									<div class="g-recaptcha" data-sitekey="6LfUDhkTAAAAAGqM-lsmYLjwSkqyp2MJTFyfkJy0"></div>
									<span id="error_captcha_code" class="error_text"></span>
								</div>
								
								<div class="col-sm-6">
									<p class="ml-5"><?= $text[LANG]['label_obbligatori'] ?></p>
								</div>
							</div>
						</div>
						
						<div class="row mt-3">
							<div class="col-sm-12 text-right">
								<div class="box-button">
									<a href="#" class="button" id="btn-submit-form" data-refer="form-fossata">
										<?= $text[LANG]['label_pulsante'] ?>
									</a>
									<img id="loading" src="./assets/img/loading.gif" style="display:none" />
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
		
<!-- 		<div id="validationModal" class="modal fade" tabindex="-1" role="dialog">
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
		 -->
		
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
