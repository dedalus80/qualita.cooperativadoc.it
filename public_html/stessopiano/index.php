<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);

define("ASSETS", "https://qualita.cooperativadoc.it");
define("ICONE", ASSETS . "/stessopiano/img/icone");
define("CSS", ASSETS . "/stessopiano/css");

if (!$_SESSION['lang'])
    $_SESSION['lang'] = 'it';

$lang = $_SESSION['lang'];

if ($_SESSION['response_type']) {
    $mess = $_SESSION['response'];
    $messType = $_SESSION['response_type'];
    unset($_SESSION['response']);
    unset($_SESSION['response_type']);
}

if ($_SESSION['field']) {
    foreach ($_SESSION['field'] AS $id => $val) {
        $field[$id] = $val;
        unset($_SESSION['field'][$id]);
    }
}

require_once('./include/class-db.php');
require_once('./include/class-sp.php');
require_once('./include/lang_new.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Iscrizioni Online Stesso Piano</title>
        <meta name="language" content="en" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-touch-fullscreen" content="yes" />
        <meta name="description" content="Iscrizione Online Stessopiano.it" />
        <meta name="author" content="Iscrizione online Stessopiano.it"  />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,700" rel="stylesheet" type="text/css"/>   
        <link href="<?= ASSETS ?>/assets-avalon/fonts/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />      
        <link href="<?= ASSETS ?>/assets-avalon/css/styles.css" type="text/css" rel="stylesheet"/>                                 
        <link href="<?= ASSETS ?>/assets-avalon/plugins/jstree/dist/themes/avalon/style.min.css" type="text/css" rel="stylesheet"/>    
        <link href="<?= ASSETS ?>/assets-avalon/css/custom-styles.css" type="text/css" rel="stylesheet"/> 
        <link href="<?= CSS ?>/normalize.css" rel="stylesheet" type="text/css" />
        <link href="<?= CSS ?>/custom.css" rel="stylesheet" type="text/css" />
        <link href="<?= CSS ?>/custom_mobile.css" rel="stylesheet" type="text/css" />
        <link href="<?= ASSETS ?>/assets-avalon/plugins/iCheck/skins/all.css" type="text/css" rel="stylesheet" />
        <link href="<?= ICONE ?>/icona16x16.png" rel="stylesheet" />
        <link href="<?= ICONE ?>/icona16x16.png" rel="shortcut icon" type="image/x-icon" />
        <link href="<?= ICONE ?>/icona16x16.png"  rel="apple-touch-icon" /> 
        <link href="<?= ICONE ?>/icona76x76.png"  rel="apple-touch-icon" sizes="76x76" />
        <link href="<?= ICONE ?>/icona120x120.png" rel="apple-touch-icon" sizes="120x120"  />
        <link href="<?= ICONE ?>/icona152x152.png" rel="apple-touch-icon" sizes="152x152" />
        <link href="<?= ICONE ?>/splash-ipad-landscape.png" rel="apple-touch-startup-image" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)" />
        <link href="<?= ICONE ?>/splash-ipad.png" rel="apple-touch-startup-image" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)" />
        <link href="<?= ICONE ?>/splash-iphone.png" rel="apple-touch-startup-image"  media="screen and (max-device-width: 320px)" />
    </head>
    <body class="focused-form"  >
        <div id="body"   ></div>
        <div class="container" id="login-form">
            <div class="login-logo" id="space-top" >

            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default" style="border: none !important">
                        <div class="panel-heading" style="padding: 30px 30px ;text-align: center;border: none !important;position:relative">
							<div class='icona' style="position: absolute; top:10px ; right: 10px"  >
								<a href='#' data-lang='<?= $lang ?>' id='icona-lingua' >
									<? if($lang=='it'): ?>
										<img src="<?= ASSETS ?>/stessopiano/img/uk.png" style='width: 30px;' />
									<? else: ?>
										<img src="<?= ASSETS ?>/stessopiano/img/italy.png" />
									<? endif; ?>
								</a>
								
							</div>
							<a href='http://www.stessopiano.it' target='_blank' title='Stessopiano' ><img src="<?= ASSETS ?>/stessopiano/img/logo_sp.jpg" id="login-img-top" class="img-responsive" style="display: inline-block" /></a></div>
                        <div class="panel-body" style="border: none !important;text-align: left" >   
                            <?php if ($messType == 'success'): ?>
                                <div class="iscrizione-result"><p><?= $text[$lang]['result'] ?></p></div>
                            <?php else: ?>
                                <?php if ($mess && $messType == 'error'): ?>
                                    <div class="alert alert-dismissable alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                        <i class="fa fa-fw fa-warning"></i>&nbsp; <strong>Attenzione</strong><br /><?= $mess ?>
                                    </div>
                                <?php endif; ?>
                                <form name="form_iscrizione" id="form_iscrizione" method='POST' action='https://qualita.cooperativadoc.it/stessopiano/subscribe.php'  class='form-horizontal row-border'>
                                    <input type="hidden" name="language" id="language" value='<?= $lang ?>' />
                                    <div class="row">
                                        <div class=" col-xs-12"><p><?= $text[$lang]['intro_2'] ?></p>
                                            <div class="obbligatori"><?= $text[$lang]['label_obbligatori'] ?></div>	
                                        </div>
                                    </div>
                                    <div id='box-1'>	
                                        <div class="row titolo">
                                            <div class=" col-xs-10">
                                                <div class='table-label'><?= $text[$lang]['dati'] ?></div>
                                            </div>
                                            <div class='col-xs-2 input-right'>
                                                <span class='orange badge' id='badge-1'>1/4</span>
                                            </div>
                                        </div>
                                        <div class="form-group first-row">
                                            <label class="col-sm-3 control-label"><?= $text[$lang]['label_nome'] ?><em>*</em></label>
                                            <div class="col-sm-7"><input data-tipo='text' type='text' class='form-control obli step step-1 obli-1' name='nome' id='nome' value="<?= $field['nome'] ?>" data-step='1' /></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?= $text[$lang]['label_cognome'] ?><em>*</em></label>
                                            <div class="col-sm-7"><input type='text' class='form-control obli step-1 step obli-1' name ='cognome' id='cognome' value="<?= $field['cognome'] ?>" data-step='1' data-tipo='text' /></div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-sm-3 control-label"><?= $text[$lang]['label_email'] ?><em>*</em></label>
                                            <div class="col-sm-7">
                                                <div class="input-group">
                                                    <span class="input-group-addon"> <i class="fa fa-envelope"></i> </span>
                                                    <input  class="form-control obli step-1 step obli-1" name="email" id="email" type="text" data-step='1' data-tipo='email' value="<?= $field['email'] ?>" />
                                                </div>
                                            </div>	
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?= $text[$lang]['label_cellulare'] ?><em>*</em></label>
                                            <div class="col-sm-7">
                                                <div class="input-group">
                                                    <span class="input-group-addon"> <i class="fa fa-phone"></i> </span>
                                                    <input  class="form-control obli step-1 step obli-1" name="cellulare" id="cellulare" type="text" data-step='1' data-tipo='cellulare'  value="<?= $field['cellulare'] ?>" />
                                                </div>
                                            </div>	
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?= $text[$lang]['label_natoil'] ?><em>*</em></label>
                                            <div class="col-sm-7">
                                                <div class="input-group">							
                                                    <span class="input-group-addon open-calendar" data-calendar="data_nascita"   >  <i class="fa fa-calendar"></i>   </span>
                                                    <input  class="form-control obli step-1 step obli-1" name="data_nascita" id="data_nascita" type="text" placeholder='gg-mm-aaaa' data-step='1' data-tipo='data' value="<?= $field['data_nascita'] ?>" /> 
                                                </div>
                                            </div>	
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?= $text[$lang]['label_natoa'] ?><em>*</em></label>
                                            <div class="col-sm-7"><input  class="form-control data-control obli  step-1 step obli-1" name="luogo_nascita" id="luogo_nascita" type="text" data-step='1' data-tipo='text' value="<?= $field['luogo_nascita'] ?>" /> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?= $text[$lang]['label_nazionalita'] ?><em>*</em></label>
                                            <div class="col-sm-7">
                                                <select name ='nazionalita' id="nazionalita" class="form-control obli  step-1 step obli-1" data-step='1' data-tipo='number' value="" >
                                                    <option value='' ><?= $text[$lang]['label_scegli'] ?></option>
                                                    <?php
                                                    foreach ($sel['nazionalita'] as $id => $val) {

                                                        $id == $field['nazionalita'] ? $selected = 'selected="selected"' : $selected = '';
                                                        ?>
                                                        <option  value='<?= $id ?>'  <?= $selected ?>  ><?= $val ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?= $text[$lang]['label_sesso'] ?><em>*</em></label>
                                            <div class="col-sm-7 top5">
                                                <input type='radio' class='radio-purple sesso' name ='sesso' id='sesso_m' value='M' data-step="1" data-refer="sesso"  <?= $field['sesso'] == "M" ? "checked='checked'" : "" ?>  />&nbsp;<span class='normal-text'><?= $text[$lang]['label_sm_pdf'] ?>&nbsp;&nbsp;&nbsp;</span>
                                                <input type='radio' class='radio-purple sesso' name ='sesso' id='sesso_f' value='F' data-refer="sesso" data-step='1'  <?= $field['sesso'] == "F" ? "checked='checked'" : "" ?>/>&nbsp;<span class='normal-text'><?= $text[$lang]['label_sf_pdf'] ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?= $text[$lang]['label_residenza'] ?><em>*</em></label>
                                            <div class="col-sm-7"><input  class="form-control obli step-1 step obli-1" name="residenza" id="residenza" type="text"  data-tipo="text" data-step='1' value="<?= $field['residenza'] ?>" placeholder="<?php echo $text[$lang]['pl_residente_in']?>" /> </div>
                                        </div>
                                        <!--<div class="form-group">
                                            <label class="col-sm-3 control-label"><?php // $text[$lang]['label_indirizzo'] ?><em>*</em></label>
                                            <div class="col-sm-7"><input  class="form-control step-1 step obli obli-1" name="indirizzo" id="indirizzo" type="text" data-tipo="text"  data-step='1' value="<?= $field['indirizzo'] ?>"   /> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php // $text[$lang]['label_n'] ?><em>*</em></label>
                                            <div class="col-sm-7">
                                                <input  class="form-control step-1 step obli obli-1" name="numero_civico" id="numero_civico" size='5' type="text" data-tipo="numero" data-step='1' value="<?= $field['numero_civico'] ?>"  />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php // $text[$lang]['label_cap'] ?><em>*</em></label>
                                            <div class="col-sm-7">
                                                <input  class="form-control step-1 step obli obli-1"  data-tipo="cap" name="cap" id="cap" size='5' type="text" data-step='1' value="<?= $field['cap'] ?>"  /> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php // $text[$lang]['label_provincia'] ?><em>*</em></label>
                                            <div class="col-sm-7">
                                                <select name ='provincia' id="provincia" class="form-control step-1 obli step obli-1" data-step='1' data-tipo='numero'  >
                                                    <option value ='' ><?php // $text[$lang]['label_scegli'] ?></option> 
                                                    <?php/*
                                                    foreach ($sel['provincie'] as $id => $val) {
                                                    $id == $field['provincia'] ? $selected ='selected="selected"' : $selected='';
                                                     ?>
                                                    <option  value='<?= $id ?>'  <?= $selected ?>  ><?= utf8_encode($val) ?></option>
													<?php } */?>
                                                </select>

                                            </div>
                                        </div>-->
                                        <div class="form-group first-row" id='next-1' data-step='1'>
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-7  input-right">
                                                <a href="#" id="button-1" class="btn btn-stessopiano next disabled btn-scrool" data-scrool='codice_fiscale' data-step='1' ><?= $text[$lang]['label_prosegui'] ?></a> 
                                            </div>
                                        </div>
                                    </div>
									
<!--
                                    <div id='box-2' class='hidden-on-start' >
                                        <div class="row titolo">
                                            <div class=" col-xs-10">
                                                <div class='table-label'><?php // $text[$lang]['documenti'] ?></div>
                                            </div>
                                            <div class='col-xs-2 input-right'>
                                                <span class='orange badge' id='badge-2'>2/5</span>
                                            </div>
                                        </div>
                                        <div class="form-group first-row">
                                            <label class="col-sm-3 control-label"><?php // $text[$lang]['label_codice_fiscale'] ?></label>
                                            <div class="col-sm-7"><input  class="form-control step step-2" name="codice_fiscale" id="codice_fiscale" type="text" data-tipo="testo_numerico" data-step='2' value='<?php // $field['codice_fiscale'] ?>' size='16' /> </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-sm-3 control-label"><?php // $text[$lang]['label_tipo_documento'] ?><em>*</em></label>
                                            <div class="col-sm-7"><input  class="form-control step-2 step obli obli-2" name="tipo_documento" id="tipo_documento" type="text" data-tipo="text"  data-step='2' value='<?php // $field['tipo_documento'] ?>' /> </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-sm-3 control-label"><?php // $text[$lang]['label_numero_documento'] ?><em>*</em></label>
                                            <div class="col-sm-7"><input  class="form-control step step-2 obli obli-2" name="numero_documento" id="numero_documento" value='<?php // $field['numero_documento'] ?>' type="text" data-tipo="alfa" data-step='2' />  </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-sm-3 control-label"><?php // $text[$lang]['label_scadenza_documento'] ?><em>*</em></label>
                                            <div class="col-sm-7">
                                                <div class="input-group">							
                                                    <span class="input-group-addon open-calendar" data-calendar="scadenza_documento" > <i class="fa fa-calendar"></i></span>
                                                    <input value='<?php // $field['scadenza_documento'] ?>'  class="form-control step step-2 obli obli-2" name="scadenza_documento" id="scadenza_documento" type="text" placeholder='gg-mm-aaaa' data-tipo='data' data-step='2'  /> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-sm-3 control-label"><?php // $text[$lang]['label_permesso'] ?></label>
                                            <div class="col-sm-7"><input  class="form-control step step-2" name="permesso_soggiorno" id="permesso_soggiorno" value='<?php // $field['permesso_soggiono'] ?>' type="text" data-step='2' />  </div>
                                        </div>
                                        <div class="form-group first-row" id='next-2'  >
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-7  input-right">
                                                <a href="#" id="button-2" class="btn btn-stessopiano next disabled" data-step='2' ><?php // $text[$lang]['label_prosegui'] ?></a> 
                                            </div>
                                        </div>

                                    </div>
-->									
                                    <div id="box-2" class="hidden-on-start">
                                        <div class="row titolo">
                                            <div class=" col-xs-10">
                                                <div class='table-label'><?= $text[$lang]['label_altre_info'] ?></div>
                                            </div>
                                            <div class='col-xs-2 input-right'>
                                                <span class='orange badge' id='badge-2'>2/4</span>
                                            </div>
                                        </div>
                                        <div class="form-group first-row">
                                            <label class="col-sm-3 control-label"><?= $text[$lang]['label_alloggio_attuale'] ?></label>
                                            <div class="col-sm-7">
                                                <select name='dove_vive' id="dove_vive"   class='form-control step step-2 other' data-valore='7' data-step="2" >
                                                    <option value='' ><?= $text[$lang]['label_scegli'] ?></option>
                                                    <?php
                                                        foreach ($sel['alloggi'] as $id => $val) {
                                                            $id == $field['dove_vive'] ? $selected ='selected="selected"' : $selected='';
                                                    ?>
                                                    <option  value='<?= $id ?>'  <?= $selected ?>  ><?= $val ?></option>
                                                    <?php } ?>
                                                </select> 
                                            </div>
                                        </div>

                                        <div class="form-group first-row" id ="dove_vive-extra" style="display: <?= $field['dove_vive'] =='7' ? 'block':'none' ?>" >
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-7">
                                                <input  class="form-control" data-step='2'  data-refer="dove_vive" name="dove_vive_altro" id="dove_vive_dettaglio" type="text"  placeholder="<?= $text[$lang]['label_occupazione_dettaglio']."*" ?>" value='<?= $field['dove_vice_altro'] ?>' />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-sm-3 control-label"><?= $text[$lang]['label_occupazione'] ?><em>*</em></label>
                                            <div class="col-sm-7">
                                                <select data-valore='4' data-step='2' name='occupazione' id="occupazione" class='form-control obli obli-2 step step-2' >
                                                    <option value ='' ><?= $text[$lang]['label_scegli'] ?></option>
                                                    <?php
														foreach ($sel['occupazione'] as $id => $val) {
															$id == $field['occupazione'] ? $selected ='selected="selected"' : $selected='';
                                                    ?>
                                                    <option  value='<?= $id ?>'  <?= $selected ?>  ><?= $val ?></option>
                                                    <?php
														}
													?>
                                                </select>
                                                <!--<div  id="occupazione-extra" style="display: <?= $field['occupazione'] =='4' ? 'block':'none' ?>; padding-top: 5px" >
                                                    <input data-step='2' class="form-control" name="occupazione_det" id="occupazione_dettaglio" type="text"  placeholder="<?= $text[$lang]['label_occupazione_dettaglio']."*" ?>" value='<?= $field['occupazione_det'] ?>' />
                                                </div>
												<div  id="studente-extra" style="display: <?= $field['occupazione'] =='1' ? 'block':'none' ?>;" >
													<div style="padding-top:5px">
														<input data-step='2' class="form-control" name="studente_det" id="studente_dettaglio" type="text" placeholder="<?= $text[$lang]['label_studente_dettaglio']."*" ?>" value='<?= $field['studente_det'] ?>' />
													</div>
													<div style="padding-top:5px">
														<input data-step='2' class="form-control" name="studente_livello" id="studente_livello" type="text" placeholder="<?= $text[$lang]['label_studente_livello']."*" ?>" value='<?= $field['studente_livello'] ?>' />
													</div>
												</div>
												
												<div id="lavoratore-extra" style="display: <?= $field['occupazione'] =='2' ? 'block':'none' ?>;" >
													<div style="padding-top:5px">
														<input data-step='2' class="form-control" name="lavoratore_settore" id="lavoratore_settore" type="text" placeholder="<?= $text[$lang]['label_lavoratore_settore']."*" ?>" value='<?= $field['lavoratore_settore'] ?>' />
													</div>
													<div style="padding-top:5px">
														<input data-step='2' class="form-control" name="lavoratore_contratto" id="lavoratore_contratto" type="text" placeholder="<?= $text[$lang]['label_lavoratore_contratto']."*" ?>" value='<?= $field['lavoratore_contratto'] ?>' />
													</div>
													<div style="padding-top:5px">
														<input data-step='2' class="form-control" name="lavoratore_scadenza" id="lavoratore_scadenza" type="text" placeholder="<?= $text[$lang]['label_lavoratore_scadenza']."*" ?>" value='<?= $field['lavoratore_scadenza'] ?>' />
													</div>
												</div>-->
                                            </div>
                                        </div>

                                        <div class="form-group studente-extra" style="display:none">
                                            <label class="col-sm-3 control-label"><?= $text[$lang]['label_studente_facolta'] ?><em>*</em></label>
                                            <div class="col-sm-7">
                                                <input data-step="2" class="form-control step step-2" name="studente_det" id="studente_det" type="text" value="" />   
                                            </div>
                                        </div>

                                        <div class="form-group studente-extra" style="display:none">
                                            <label class="col-sm-3 control-label"><?= $text[$lang]['label_studente_livello'] ?><em>*</em></label>
                                            <div class="col-sm-7">
                                                <input data-step="2" class="form-control step step-2" name="studente_livello" id="studente_livello" type="text" value="" />   
                                            </div>
                                        </div>

                                        <div class="form-group lavoratore-extra" style="display:none">
                                            <label class="col-sm-3 control-label"><?= $text[$lang]['label_lavoratore_tipo'] ?><em>*</em></label>
                                            <div class="col-sm-7">                                                
                                                <select id="lavoratore_tipo" name="lavoratore_tipo" class="form-control step step-2" data-step="2">
                                                    <option value=""><?= $text[$lang]['label_scegli'] ?></option>
                                                    <?php
                                                        foreach ($sel['lavoratore'] as $id => $val) {
                                                            $id == $field['lavoratore'] ? $selected ='selected="selected"' : $selected='';
                                                    ?>
                                                    <option value="<?= $id ?>" <?= $selected ?>><?= utf8_encode($val) ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group lavoratore-extra-altro" style="display:none">
                                            <label class="col-sm-3 control-label"><?= $text[$lang]['label_lavoratore_altro'] ?><em>*</em></label>
                                            <div class="col-sm-7">
                                                <input data-step='2' class="form-control step step-2" name="lavoratore_altro" id="lavoratore_altro" type="text" value="" />    
                                            </div>
                                        </div>

                                        <div class="form-group lavoratore-extra-tipo" style="display:none">
                                            <label class="col-sm-3 control-label"><?= $text[$lang]['label_lavoratore_scadenza'] ?><em>*</em></label>
                                            <div class="col-sm-7">
                                                <div class="input-group">							
                                                    <span class="input-group-addon open-calendar" data-calendar="lavoratore_scadenza"> <i class="fa fa-calendar"></i></span>
                                                    <input class="form-control step step-2" name="lavoratore_scadenza" id="lavoratore_scadenza" type="text" placeholder="gg-mm-aaaa" data-tipo="data" data-step="2" /> 
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group occupazione-extra" style="display:none">
                                            <label class="col-sm-3 control-label"><?= $text[$lang]['label_occupazione_altro'] ?><em>*</em></label>
                                            <div class="col-sm-7">
                                                <input data-step='2' class="form-control step step-2" name="occupazione_det" id="occupazione_dettaglio" type="text" value='<?= $field['occupazione_det'] ?>' />
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label class="col-sm-3 control-label"><?= $text[$lang]['label_fumatore'] ?></label>
                                            <div class="col-sm-7 top5">
                                                <input  <?= $field['fumatore']=='Y' ? "checked='checked'":"" ?> type='radio' class='radio-green fumatore' name='fumatore' id='' value='Y' data-refer="fumatore" data-step='2'/>&nbsp;&nbsp;
												<span class='normal-text'><?= $text[$lang]['label_si'] ?>&nbsp;&nbsp;&nbsp;</span>
                                                <input <?= $field['fumatore']=='N' ? "checked='checked'":"" ?> type='radio' class='radio-red fumatore' name='fumatore' id='' value='N' data-refer="fumatore" data-step='2' />&nbsp;&nbsp;
												<span class='normal-text'><?= $text[$lang]['label_no'] ?> </span>
                                            </div>
                                        </div>
										
                                       
                                        <div class="form-group ">
                                            <label class="col-sm-3 control-label"><?= $text[$lang]['label_animali'] ?></label>
                                            <div class="col-sm-7 top5">
                                                <input <?= $field['animali']=='Y' ? "checked='checked'":"" ?> type='radio' class='radio-green animali' data-step='2' name='animali'  value='Y' data-refer="animali" />
												<span class='normal-text'>&nbsp;&nbsp;<?= $text[$lang]['label_si'] ?> &nbsp;&nbsp;&nbsp;</span>
                                                <input <?= $field['animali']=='N' ? "checked='checked'":"" ?> type='radio' class='radio-red animali' data-step='2' name='animali'  value='N' data-refer="animali" />
												<span class='normal-text'>&nbsp;&nbsp;<?= $text[$lang]['label_no'] ?> </span>
                                            </div>
                                        </div>
                                        <div class="form-group first-row" id="animali-extra" style="display:<?= $field['animali']=='Y' ? "block":"none" ?>">
                                            <label class="col-sm-3 control-label"><?= $text[$lang]['label_animali_det'] ?><em>*</em></label>
                                            <div class="col-sm-7" style="margin-bottom: 5px;">
                                                <input data-step='2' class="form-control" data-refer="animali" name="animali_det" id="animali_dettaglio" type="text" placeholder='<?= $text[$lang]['label_quali'] ?>' value='<?= $field['animali_det'] ?>' />
                                            </div>
                                        </div>
                                        <div class="form-group first-row " id='next-2'>
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-7  input-right">
                                                <a href="#" id='button-2' class="btn btn-stessopiano next disabled" data-step='2' ><?= $text[$lang]['label_prosegui'] ?></a> 
                                            </div>
                                        </div>
                                    </div>
									
                                    <div id='box-3' class='hidden-on-start' >
                                        <div class="row titolo" style="margin-top: 20px" >
                                            <div class=" col-xs-10">
                                                <div class='table-label'><?= $text[$lang]['label_allogio'] ?></div>
                                            </div>
                                            <div class='col-xs-2 input-right'>
                                                <span class='orange badge' id='badge-3'>3/4</span>
                                            </div>
                                        </div>
                                        <div class="form-group  first-row">
                                            <label class="col-sm-6 control-label label-left"><?= $text[$lang]['label_conoscenza'] ?></label>
                                            <div class="col-sm-4 input-right">
                                                <select name='conoscenza' id="conoscenza" class='form-control step step-3 other'  data-valore='11' data-step='3' >
                                                    <option value='' ><?= $text[$lang]['label_scegli'] ?></option>
                                                    <?php foreach ($sel['conoscienza'] as $id => $val) { ?>
                                                    <option  value='<?= $id ?>'><?=$val?></option>
                                                    <?php } ?>
                                                </select>
                                                <div id='conoscenza-extra' style="display: none; padding-top:5px">
                                                    <input type='text' class='form-control' name='conoscenza_det' id='conoscenza_dettaglio' placeholder="<?= $text[$lang]['label_occupazione_dettaglio']."*" ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-6 control-label label-left"><?= $text[$lang]['label_prima_volta'] ?><em>*</em></label>
                                            <div class="col-sm-4 input-right top5">
                                                <input type='radio' <?= $field['prima_volta']== 'Y' ? 'checked="checked"':'' ?> class='radio-green prima_volta' name ='prima_volta' id='' value='Y' data-refer="prima_volta" data-step='3' /><span class='normal-text'>&nbsp;<?= $text[$lang]['label_si'] ?>&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                                                <input type='radio'<?= $field['prima_volta']== 'N' ? 'checked="checked"':'' ?> class='radio-red prima_volta' name ='prima_volta' id='' value='N' data-refer="prima_volta" data-step='3' />&nbsp;<span class='normal-text'> <?= $text[$lang]['label_no'] ?></span> 
                                            </div>
                                        </div>
                                        <div class="form-group" >
                                            <label class="col-sm-6 control-label label-left"><?= $text[$lang]['label_camera_amici'] ?></label>
                                            <div class="col-sm-4 input-right">
                                                <input type='radio' class='radio-green camera_amici ' name ='camera_amici' id='' value='Y' data-refer="camera_amici" <?= $field['camera_amici']== 'Y' ? 'checked="checked"':'' ?> data-step='3' /><span class='normal-text'>&nbsp;<?= $text[$lang]['label_si'] ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                <input type='radio' <?= $field['camera_amici']== 'N' ? 'checked="checked"':'' ?> class='radio-red camera_amici' name ='camera_amici' id='' value='N' data-refer="camera_amici" data-step='3' /><span class='normal-text'>&nbsp;  <?= $text[$lang]['label_no'] ?></span> 
                                            </div>
                                        </div>
                                        <div class="form-group first-row" id="camera_amici-extra" style="display: <?= $field['camera_amici']== 'Y' ? 'block':'none' ?>; ">
                                            <label class="col-sm-6 control-label label-left"><?= $text[$lang]['label_amici_specifica'] ?></label>
                                            <div class="col-sm-4 input-right">
                                                <input type='text' class='form-control dettaglio' name='camera_amici_dettaglio' id='camera_amici_dettaglio' data-refer="camera_amici" placeholder="<?= $text[$lang]['label_amici_specifica'] ?>" <?= $field['camera_amici_dettaglio'] ?> />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-6 control-label label-left"><?= $text[$lang]['label_livello_new'] ?></label>
                                            <div class="col-sm-4 input-right">
                                                <select name='livello' id="livello"  class="form-control step step-4 other" data-valore='7' data-step='3' > 
                                                    <option value='' ><?= $text[$lang]['label_scegli'] ?></option>
                                                    <?php
														foreach ($sel['livello'] as $id => $val) {
															$id == $field['livello'] ? $selected ='selected="selected"' : $selected='';
                                                    ?>
                                                    <option  value='<?= $id ?>'  <?= $selected ?>  ><?= $val ?></option>
                                                    <?php
														}
													?>
                                                </select>
                                                <div  id="livello-extra" style="display:  <?= $field['livello'] =='7' ? "block":"none" ?>; padding-top: 5px;">
                                                    <input type='text' class='form-control dettaglio' data-refer="livello" name ='livello_det' id='livello_dettaglio' value='<?= $livello['livello_det'] ?>'  placeholder="<?= $text[$lang]['label_occupazione_dettaglio']."*" ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-sm-6 control-label label-left"><?= $text[$lang]['label_sposta_residenza'] ?><em>*</em></label>
                                            <div class="col-sm-4 input-right">
                                                <select name='nuova_residenza' id="nuova_residenza"  class="form-control step step-3 obli obli-3" data-step='3' > 
                                                    <option value='' ><?= $text[$lang]['label_scegli'] ?></option>
                                                    <?php
														foreach ($sel['residenza'] as $id => $val) {
															$id == $field['residenza'] ? $selected ='selected="selected"' : $selected='';
                                                    ?>
                                                    <option  value='<?= $id ?>'  <?= $selected ?>  ><?= $val ?></option>
                                                    <?php
														}
													?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" >
                                            <label class="col-sm-6 control-label label-left"><?= $text[$lang]['label_amici_quanti'] ?></label>
                                            <div class="col-sm-4 input-right">
                                                <select data-step="3" id="amici_quanti" name="amici_quanti" class="form-control numerico step step-3">
                                                    <option value=""><?= $text[$lang]['label_scegli'] ?></option>
                                                    <?php
														foreach ($sel['amici_quanti'] as $id => $val) {
															$id == $field['amici_quanti'] ? $selected ='selected="selected"' : $selected='';
                                                    ?>
                                                    <option  value='<?= $id ?>'  <?= $selected ?>  ><?= $val ?></option>
                                                    <?php
														}
													?>
                                                </select>
                                            </div>
                                        </div>
                                        <div id='coinquilini_si' style='display: <?= $field['amici_quanti'] >= 1 ? "block":"none" ?>'>
                                            <div class="col-xs-12 inter-label " style='padding-left: 0px !important'>
                                                <span class=''><?= $text[$lang]['label_amici_si'] ?></span>
                                            </div>
                                            <div class="form-group first-row">
                                                <label class="col-sm-6 control-label label-left"><?= $text[$lang]['label_amici_genere'] ?></label>
                                                <div class="col-sm-4 input-right">
                                                    <select name='amici_genere' id="amici_genere"  class="form-control  step step-3 "  data-step='3'> 
                                                        <option value='' ><?= $text[$lang]['label_scegli'] ?></option>
                                                        <?php
															foreach ($sel['amici_genere'] as $id => $val) {
																$id == $field['amici_genere'] ? $selected ='selected="selected"' : $selected='';
                                                        ?>
                                                        <option  value='<?= $id ?>'  <?= $selected ?>  ><?= $val ?></option>
														<?php
															}
														?>
                                                    </select>
                                                </div>
                                            </div>
											<div class="form-group">
                                                <label class="col-sm-6 control-label label-left"><?= $text[$lang]['label_amici_fumatori'] ?></label>
                                                <div class="col-sm-4 input-right">
                                                    <select name='amici_fumo' id="amici_fumo"  class="form-control  step step-3" data-step='3' > 
                                                        <option value='' ><?= $text[$lang]['label_scegli'] ?></option>
                                                        <?php
															foreach ($sel['amici_fumatori'] as $id => $val) {
																$id == $field['amici_fumatori'] ? $selected ='selected="selected"' : $selected='';
                                                        ?>
                                                        <option  value='<?= $id ?>'  <?= $selected ?>  ><?= $val ?></option>
														<?php
															}
														?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label label-left"><?= $text[$lang]['label_amici_occupazione'] ?></label>
                                                <div class="col-sm-4 input-right">
                                                    <select name='amici_occupazione' id="amici_occupazione"  class="form-control  step step-3"  data-step='3' > 
                                                        <option value='' ><?= $text[$lang]['label_scegli'] ?></option>
                                                        <?php
															foreach ($sel['amici_occupazione'] as $id => $val) {
																$id == $field['amici_occupazione'] ? $selected ='selected="selected"' : $selected='';
                                                        ?>
                                                        <option  value='<?= $id ?>'  <?= $selected ?>  ><?= $val ?></option>
														<?php
															}
														?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label label-left"><?= $text[$lang]['label_amici_eta'] ?></label>
                                                <div class="col-sm-4 input-right">
                                                    <select name='amici_eta' id="amici_eta"  class="form-control step step-3 " data-step='3' > 
                                                        <option value='' ><?= $text[$lang]['label_scegli'] ?></option>
                                                        <?php
															foreach ($sel['amici_eta'] as $id => $val) {
																$id == $field['amici_eta'] ? $selected ='selected="selected"' : $selected='';
                                                        ?>
                                                        <option  value='<?= $id ?>'  <?= $selected ?>  ><?= utf8_encode($val) ?></option>
														<?php
															}
														?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label label-left"><?= $text[$lang]['label_amici_animali'] ?></label>
                                                <div class="col-sm-4 input-right">
                                                    <select name='amici_animali' id="amici_animali" class="form-control step step-3 other" data-valore='1' data-step='3' > 
                                                        <option value='' ><?= $text[$lang]['label_scegli'] ?></option>
                                                        <?php
															foreach ($sel['amici_animali'] as $id => $val) {
																$id == $field['amici_animali'] ? $selected ='selected="selected"' : $selected='';
                                                        ?>
                                                        <option  value='<?= $id ?>'  <?= $selected ?>  ><?= $val ?></option>
														<?php
															}
														?>
                                                    </select>
                                                    <div id='amici_animali-extra' style='display: <?= $field['amici_animali'] =='1' ? "block":"none" ?>; padding-top: 5px'>
                                                        <input type='text' class='form-control'  name ='amici_animali_dettaglio' id='amici_animali_dettaglio' placeholder="<?= $text[$lang]['label_occupazione_dettaglio']."*" ?>" value='<?= $field['amici_animali_dettaglio'] ?>'  />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>	

                                        <div class="form-group first-row" id="next-3">
                                            <label class="col-sm-2 control-label"></label>
                                            <div class="col-sm-8  input-right">
                                                <a href="#" id="button-3" class="btn btn-stessopiano next disabled" data-step='3' ><?= $text[$lang]['label_prosegui'] ?></a> 
                                            </div>
                                        </div>
                                    </div>
									
	
                                    <div id="box-4" class='hidden-on-start' >
                                        <div class="row titolo" style="margin-top: 20px" >
                                            <div class=" col-xs-10">
                                                <div class='table-label'><?= $text[$lang]['label_allogio'] ?></div>
                                            </div>
                                            <div class='col-xs-2 input-right'>
                                                <span class='orange badge' id='badge-4'>4/4</span>
                                            </div>
                                        </div>
                                        <div class="form-group first-row" id='label_camera_check'>
                                            <label class="col-sm-4 control-label label-right" ><?= $text[$lang]['label_cosa_cerchi'] ?></label>
                                            <div class="col-sm-8 top5">
                                                <input <?= $field['camera_singola'] =="Y" ? "checked='checked'":"" ?> type='checkbox' class='check-purple scelta_camera' name ='camera_singola' data-step='4' id='camera_singola' value='Y' data-refer="" /><span class='normal-text'>&nbsp;<?= $text[$lang]['label_camera_singola'] ?></span>
                                                <input <?= $field['camera_doppia'] =="Y" ? "checked='checked'":"" ?> type='checkbox' class='check-purple scelta_camera' name ='camera_doppia' data-step='4' id='camera_doppia' value='Y' data-refer="" /><span class="normal-text">&nbsp;<?= $text[$lang]['label_camera_doppia'] ?></span>
                                                <input <?= $field['camera_indiferente'] =="Y" ? "checked='checked'":"" ?> type='checkbox' class='check-purple scelta_camera' name ='camera_indiferente' data-step='4' id='camera_indiferente' value='Y' data-refer="" /><span class='norma-text'>&nbsp;<?= $text[$lang]['label_appartamento'] ?></span>
                                            </div>
                                        </div>
                                        <div class="row row-20">
                                            <div class="col-xs-6  smal-10">
                                                <label> <?= $text[$lang]['label_periodo_permaneza'] ?><em>*</em></label>
                                                <div class="input-group">							
                                                    <span class="input-group-addon  open-calendar" data-calendar="data_in"> <i class="fa fa-calendar"></i> </span>
                                                    <input  class="form-control obli obli-4 step step-4" name="data_in" id="data_in" type="text" placeholder='gg-mm-aaaa' data-tipo='data'  data-step='4' value='<?= $field['data_in'] ?>' /> 
                                                </div>
                                            </div>
                                            <div class="col-xs-6 ">
                                                <label> <?= $text[$lang]['label_al'] ?><em>*</em></label>
                                                <div class="input-group">							
                                                    <span class="input-group-addon open-calendar" data-calendar="data_out" > <i class="fa fa-calendar"></i> </span>
                                                    <input  class="form-control obli obli-4 step step-4" name="data_out" id="data_out" type="text" placeholder='gg-mm-aaaa' data-tipo='data' data-step='4' value='<?= $field['data_out'] ?>' /> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-20">
                                            <div class="col-xs-6  smal-10">
                                                <label> <?= $text[$lang]['label_interesse_new'] ?></label>
                                                <textarea  rows='2' name='interesse' id='interesse' class='form-control step step-4 ' data-tipo='text' ><?= $field['interesse'] ?></textarea>
                                            </div>
                                            <div class="col-xs-6 ">
                                                <label> <?= $text[$lang]['label_giorni_visite'] ?></label>
                                                <textarea  rows='2' name='giorni_visita' id='giorni_visita' class='form-control step step-4' data-tipo='text' ><?= $field['giorni_visita'] ?></textarea>
                                            </div>
                                        </div>	
                                        <div class="row row-20">
                                            <div class="col-xs-6  smal-10">
                                                <label> <?= $text[$lang]['label_quartieri'] ?></label>
                                                <select name ='quartiere[]' id="quartiere" multiple='multiple' class="form-control step-4"  size='4' data-tipo='select' > 
                                                    <option value=''  selected="selected" ><?= $text[$lang]['label_scegli'] ?></option>
                                                    <?php
														foreach ($sel['quartieri'] as $id => $val) {
															$id == $field['quartieri'] ? $selected ='selected="selected"' : $selected='';
                                                    ?>
                                                    <option  value='<?= $id ?>'  <?= $selected ?>  ><?= $val ?></option>
													<?php
														}
													?>
                                                </select>
                                            </div>

                                            <div class="col-xs-6 ">
                                                <label> <?= $text[$lang]['label_note'] ?></label>
                                                <textarea  rows='4' name='note' id='note' class='form-control step step-4' data-tipo='text' ><?= $field['note'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row row-30">
                                            <div class="col-xs-12  col34">
                                                <input type="checkbox" name="privacy" id="privacy" value="Y" class="check-green" data-refer="privacy" /><label>&nbsp;&nbsp;<?= $text[$lang]['label_condizioni'] ?><em>*</em><span id='error_privacy' class='error-text'  style='disp'></span></label>
											</div>
                                        </div>
                                        <div class="row row-10">
                                            <h4><?= $text[$lang]['label_privacy'] ?><em>*</em></h4>
                                            <div class="col-xs-12  col34">
                                                <label class="radio-inline">
                                                    <input name="consenso" type="radio" id="consenso_y" value="Y" class="radio-green" data-step="4"><span class='normal-text'>&nbsp;Autorizzo</span>
                                                </label>
                                                <label class="radio-inline">
                                                    <input name="consenso" type="radio" id="consenso_n" value="N" class="radio-red" data-step="4"><span class='normal-text'>&nbsp;Non autorizzo</span>
                                                </label>
                                            </div>
                                            <span id="error_consenso" class="error-text"></span>
                                        </div>
                                        <div class="row row-10">
                                            <h4><?= $text[$lang]['label_consenso_new'] ?><em>*</em></h4>
                                            <div class="col-xs-12  col34">
                                                <label class="radio-inline">
                                                    <input name="mailing" type="radio" id="mailing_y" value="Y" class="radio-green" data-step="4"><span class='normal-text'>&nbsp;Autorizzo</span>
                                                </label>
                                                <label class="radio-inline">
                                                    <input name="mailing" type="radio" id="mailing_n" value="N" class="radio-red" data-step="4"><span class='normal-text'>&nbsp;Non autorizzo</span>
                                                </label>
                                            </div>
                                            <span id="error_mailing" class="error-text"></span>
                                        </div>
                                        <div class="row row-10">
                                            <h4><?= $text[$lang]['label_media'] ?><em>*</em></h4>
                                            <div class="col-xs-12  col34">
                                                <label class="radio-inline">
                                                    <input name="media" type="radio" id="media_y" value="Y" class="radio-green" data-step="4"><span class='normal-text'>&nbsp;Autorizzo</span>
                                                </label>
                                                <label class="radio-inline">
                                                    <input name="media" type="radio" id="media_n" value="N" class="radio-red" data-step="4"><span class='normal-text'>&nbsp;Non autorizzo</span>
                                                </label>
                                            </div>
                                            <span id="error_media" class="error-text"></span>
                                        </div>
                                        


                                        <div class="row row-30">
                                            <div class="col-xs-6  smal-10">
                                                <div class="g-recaptcha" data-sitekey="6LcjLiATAAAAAN6cqlYioVPxaxWfCsgnPYnnPII7"></div>
                                                <span id='error_captcha_code' class='error-text' ></span>
                                            </div>
                                            <div class="col-xs-6 ">
                                                <div class="normal-text"><?= $text[$lang]['label_obbligatori'] ?></div>
                                            </div>
                                        </div>
                                    </div>	
                                </form>
<?php endif; ?>
                        </div>
                        <div class="panel-footer">
                            <div class="clearfix" style="text-align: center; padding:20px;">
                                <a href="#" id="button-4" class="btn btn btn-stessopiano hidden-on-start"  ><?= $text[$lang]['label_pulsante'] ?></a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style='width:400px'>

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title" style='color:#FFF'><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?= $text[$lang]['label_attenzione'] ?></h5>
            </div>
            <div class="modal-body">
                <p><?= $text[$lang]['label_verificare'] ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn btn-stessopiano" data-dismiss="modal"><?= $text[$lang]['label_chiudi'] ?></button>
            </div>
        </div>
    </div>
</div>
		<div class="modal fade" id="wait" role="dialog">
            <div class="modal-dialog">
                <h2><i class='fa fa-spin fa-circle-o-notch fa-fw ' style='font-size: 20px;'></i>&nbsp;Stiamo elaborando la sua iscrizione. Attendere ...</h2>
            </div>
        </div>
		
		
		
        <div class="modal fade" id="infoModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-info-circle"></i>&nbsp;Informativa ex art. 13 D.lgs. 196/2003</h4>
                    </div>
                    <div class="modal-body" style="font-size: 13px">
                        <h4>INFORMATIVA AI SENSI DELL'ART. 13 DEL D. Lgs. 196/2003</h4>
                        <p>
                            Informativa ex art. 13 D.lgs. 196/2003 "Codice in materia di protezione dei dati personali"
						</p>
						<ul>
							<li>- I dati da Lei forniti verranno trattati con la finalit&agrave; di invio di materiale pubblicitario / informativo / promozionale e di aggiornamenti su iniziative ed offerte volte a premiare i Clienti. Tali attivit&agrave; potranno riguardare prodotti e servizi della nostra societ&agrave; nonch&eacute; di Partner commerciali e potranno essere eseguite tramite invio di mail all?indirizzo di posta elettronica indicato o SMS (Short Message Service) che potr&agrave; ricevere sull'utenza che stai registrando.</li>
                            <li>- Il trattamento sar&agrave; effettuato con modalit&agrave; informatizzate.</li>
                            <li>- I dati saranno comunicati esclusivamente ai soggetti necessari all'espletamento delle attivit&agrave; sopra citate. Non sar&agrave; data altra diffusione dei dati al di fuori di questo ambito.</li>
                            <li>- Il consenso al trattamento dei dati per le predette finalit&agrave; potr&agrave; essere revocato.</li>
                            <li>- Il titolare e responsabile del trattamento &egrave;: StessoPiano S.c.s Via Michele Buniva 8, Torino.</li>
                            <li>- Per ogni altra informazione relativa alla tutela della sua privacy la invitiamo ad inviarci una email all'indirizzo <a href='mailto:info@stessopiano.it'>info@stessopiano.it</a></li>
						</ul>
				    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn btn-stessopiano" data-dismiss="modal">Chiudi</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="<?php ASSETS ?>/assets-avalon/js/bootstrap.min.js"></script> 								
        <script src="<?php ASSETS ?>/assets-avalon/plugins/iCheck/icheck.min.js"></script>
        <script src="<?php ASSETS ?>/assets-avalon/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<?php if ($lang == 'it') { ?>
            <script src="<?php ASSETS ?>/assets-avalon/plugins/bootstrap-datepicker/bootstrap-datepicker.it.js"></script>
<?php } ?>
        <script src="<?php ASSETS ?>/stessopiano/js/jquery.scrollTo.min.js"></script> 
        <script src="<?php ASSETS ?>/stessopiano/js/functions.js"></script> 
        <ul class="vakata-context">
        </ul>
        <div id="jstree-marker" style="display: none;">&nbsp;</div> 
    </body>
</html>
