<?php
/**
 * Template Name: Qualita DOC
 * Description: A template for displaying the Qualita DOC form
 */

get_header();

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Include necessary files
//require_once get_template_directory() . '/lib/class-db.php';
require_once get_stylesheet_directory() . '/form_qualita/lang.php';

define('WPLANG_E', 'it-IT');

// Database connection
//$db = new MySql_DB("localhost", "qualita", "qualita", "00qQUFDTOlKl6O3", true);
//$strutture = $db->CycleAssochId($db->Query("SELECT id, nome FROM doc_unita WHERE qdoc ='Y' ORDER BY nome"));
//$tipologie = $db->CycleAssochId($db->Query("SELECT id, nome FROM doc_tipologie_clienti ORDER BY nome"));
//$conoscenza = $db->CycleAssochId($db->Query("SELECT id, nome FROM doc_conoscenza ORDER BY nome"));

$tipologie = array(
    '2' => 'COPPIE',
    '1' => 'FAMIGLIE',
    '3' => 'GRUPPI / AMICI',
    '4' => 'SCUOLE',
    '7' => 'STUDENTE',
    '6' => 'VIAGGIATORI PER LAVORO',
    '5' => 'VIAGGIATORI SINGOLI',
);

$conoscenza = array(
    '4' => 'CONSIGLIATO DA AMICI/PARENTI',
    '1' => 'PUBBLICITA\'', 
    '2' => 'SITI INTERNET',
    '3' => 'SOCIAL NETWORK'
);

?>

<div class="container">
    <div class="py-5 text-left">
        <p class="lead"><?= $text[WPLANG_E]['q_intro'] ?></p>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <form id="form_questionario" name="form_questionario">
                <!-- Vacation Section -->
                <div id="vacanza" class="boxed-group">
                    <div class="x-row-fluid intestazione">
                        <div class="x-span12"><span class="badge" id="badge-1">1/6</span>&nbsp;&nbsp;<?php echo $text[WPLANG_E]['q_label_vacanza']; ?></div>
                    </div>
                    <div class="x-row-fluid quesito ptop10">
                        <div class="x-span3 prl">
                            <label><?php echo $text[WPLANG_E]['q_label_arrivo']; ?><span class="error ml-2" id="error_arrivo"></span></label>
                            <div class="input-group date" id="datepicker-pastdisabled">
                                <span class="input-group-addon" id="arrivo-pick"><i class="fas fa-calendar"></i></span>
                                <input data-provide="datepicker" type="text" class="form-control sm-input wpcf7-form fullwidth viaggio resetError" id="arrivo" name="arrivo" maxlength="10" size="10" value="" />
                            </div>
                        </div>
                        <div class="x-span3 prl">
                            <label><?php echo $text[WPLANG_E]['q_label_partenza']; ?><span class="error ml-2" id="error_partenza"></span></label>
                            <div class="input-group date" id="datepicker-pastdisabled">
                                <span class="input-group-addon" id="partenza-pick"><i class="fas fa-calendar"></i></span>
                                <input data-provide="datepicker" type="text" class="form-control sm-input wpcf7-form fullwidth viaggio" id="partenza" name="partenza" value="" />
                            </div>
                        </div>
                    </div>

                    <div class="x-row-fluid quesito bottom10">
                        <div class="x-span6 prl">
                            <label><?= $text[WPLANG_E]['q_label_tipologia'] ?><span class="error ml-2" id="error_tipologia"></span></label> 
                            <select name="tipologia" id="tipologia" class="form-control input-full nop viaggio resetError">
                                <option value ='' ><?= $text[WPLANG_E]['q_scegli'] ?></option>
                                <? foreach ($tipologie as $id => $val) { ?>
                                    <option  value='<?= $id ?>'><?= $val ?></option>
                                <? } ?>
                            </select>
                        </div>
                        <div class="x-span6 prl">
                            <label><?= $text[WPLANG_E]['q_label_conoscenza'] ?><span class="error ml-2" id="error_conoscenza"></span></label> 
                            <select name="conoscenza" id="conoscenza" class="form-control input-full nop viaggio resetError">
                                <option value ='' ><?= $text[WPLANG_E]['q_scegli'] ?></option>
                                <? foreach ($conoscenza as $id => $val) { ?>
                                    <option  value='<?= $id ?>'><?= $val ?></option>
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
                        <div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_complessivo'] ?><span class='error ml-2' id='error_viaggio_complessivo'></span></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="viaggio_complessivo" id="viaggio_complessivo_1"  value='I' class="radio-ins  viaggio_complessivo " /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="viaggio_complessivo" id="viaggio_complessivo_2" value='S' class="radio-suf viaggio_complessivo" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?> </span><input type="radio"   name="viaggio_complessivo" id="viaggio_complessivo_3" value='B' class="radio-buo viaggio_complessivo" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="viaggio_complessivo" id="viaggio_complessivo_4" value='E' class="radio-ott viaggio_complessivo" /></div>
                    </div>
                </div>

                <div id="struttura" class="boxed-group">
                    <div class="x-row-fluid intestazione" >
                        <div class="x-span12"><span class='badge' id="badge-2" >2/6</span>&nbsp;&nbsp;<?= $text[WPLANG_E]['q_label_albergo'] ?></div>
                    </div>
                    <div class="x-row-fluid leggenda" id='intestazione-struttura' >
                        <div class="x-span4"><?= $text[WPLANG_E]['q_label_quesito'] ?></div>
                        <div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_insufficiente'] ?></div>
                        <div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_sufficiente'] ?></div>
                        <div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_buono'] ?></div>
                        <div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_eccellente'] ?></div>
                    </div>
                    <div class="x-row-fluid quesito quesito-white" >
                        <div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_complessivo'] ?><span class="error ml-2" id="error_struttura_complessivo"></span></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="struttura_complessivo" id="struttura_complessivo_1"  value='I' class="radio-ins  struttura_complessivo" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="struttura_complessivo" id="struttura_complessivo_2" value='S' class="radio-suf struttura_complessivo" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="struttura_complessivo" id="struttura_complessivo_3" value='B' class="radio-buo struttura_complessivo" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="struttura_complessivo" id="struttura_complessivo_4" value='E' class="radio-ott struttura_complessivo" /></div>
                    </div>
                    <div class="x-row-fluid quesito" >
                        <div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_pulizia_ambienti'] ?><span class="error ml-2" id="error_struttura_pulizia"></span></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="struttura_pulizia" id="struttura_pulizia_1"  value='I' class="radio-ins struttura_pulizia" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="struttura_pulizia" id="struttura_pulizia_2" value='S' class="radio-suf struttura_pulizia" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="struttura_pulizia" id="struttura_pulizia_3" value='B' class="radio-buo struttura_pulizia" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="struttura_pulizia" id="struttura_pulizia_4" value='E' class="radio-ott struttura_pulizia " /></div>
                    </div>
                </div>
                
                <div id="camera" class="boxed-group">
                    <div class="x-row-fluid intestazione" >
                        <div class="x-span12"><span class='badge' id="badge-3" >3/6</span>&nbsp;&nbsp;<?= $text[WPLANG_E]['q_label_camera'] ?></div>
                    </div>
                    <div class="x-row-fluid leggenda" id='intestazione-camera' >
                        <div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_quesito'] ?></div>
                        <div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_insufficiente'] ?></div>
                        <div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_sufficiente'] ?></div>
                        <div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_buono'] ?></div>
                        <div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_eccellente'] ?></div>
                    </div>
                    <div class="x-row-fluid quesito quesito-white" >
                        <div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_complessivo'] ?><span class="error ml-2" id="error_camera_complessivo"></span></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="camera_complessivo" id="camera_complessivo_1"  value='I' class="radio-ins camera_complessivo" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="camera_complessivo" id="camera_complessivo_2" value='S' class="radio-suf camera_complessivo" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="camera_complessivo" id="camera_complessivo_3" value='B' class="radio-buo camera_complessivo" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="camera_complessivo" id="camera_complessivo_4" value='E' class="radio-ott camera_complessivo" /></div>
                    </div>
                    <div class="x-row-fluid quesito" >
                        <div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_confort'] ?><span class="error ml-2" id="error_camera_comfort"></span></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="camera_comfort" id="camera_comfort_1"  value='I' class="radio-ins camera_comfort" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="camera_comfort" id="camera_comfort_2" value='S' class="radio-suf camera_comfort" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="camera_comfort" id="camera_comfort_3" value='B' class="radio-buo camera_comfort" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="camera_comfort" id="camera_comfort_4" value='E' class="radio-ott camera_comfort" /></div>
                    </div>
                </div>
                
                <div id="ristorante"  class="boxed-group">
                    <div class="x-row-fluid intestazione" >
                        <div class="x-span12"><span class='badge' id="badge-4"   >4/6</span>&nbsp;&nbsp;<?= $text[WPLANG_E]['q_label_ristorante'] ?></div>
                    </div>
                    <div class="x-row-fluid leggenda" id='intestazione-ristorante' >
                        <div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_quesito'] ?></div>
                        <div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_insufficiente'] ?></div>
                        <div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_sufficiente'] ?></div>
                        <div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_buono'] ?></div>
                        <div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_eccellente'] ?></div>
                    </div>
                    <div class="x-row-fluid quesito quesito-white" >
                        <div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_complessivo'] ?><span class="error ml-2" id="error_ristorante_complessivo"></span></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="ristorante_complessivo" id="ristorante_complessivo_1"  value='I' class="radio-ins  ristorante_complessivo " /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="ristorante_complessivo" id="ristorante_complessivo_2" value='S' class="radio-suf ristorante_complessivo" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="ristorante_complessivo" id="ristorante_complessivo_3" value='B' class="radio-buo ristorante_complessivo" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="ristorante_complessivo" id="ristorante_complessivo_4" value='E' class="radio-ott ristorante_complessivo" /></div>
                    </div>
                    <div class="x-row-fluid quesito" >
                        <div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_servizio'] ?><span class="error ml-2" id="error_ristorante_servizio"></span></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="ristorante_servizio" id="ristorante_servizio_1"  value='I' class="radio-ins ristorante_servizio" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="ristorante_servizio" id="ristorante_servizio_2" value='S' class="radio-suf ristorante_servizio" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="ristorante_servizio" id="ristorante_servizio_3" value='B' class="radio-buo ristorante_servizio" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="ristorante_servizio" id="ristorante_servizio_4" value='E' class="radio-ott ristorante_servizio" /></div>
                    </div>
                    <div class="x-row-fluid quesito quesito-white" >
                        <div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_qualita_cibo'] ?><span class="error ml-2" id="error_ristorante_qualita"></span></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="ristorante_qualita" id="ristorante_qualita_1"  value='I' class="radio-ins ristorante_qualita" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="ristorante_qualita" id="ristorante_qualita_2" value='S' class="radio-suf ristorante_qualita" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="ristorante_qualita" id="ristorante_qualita_3" value='B' class="radio-buo ristorante_qualita" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="ristorante_qualita" id="ristorante_qualita_4" value='E' class="radio-ott ristorante_qualita" /></div>
                    </div>
                </div>
                
                <div id="personale" class="boxed-group">
                    <div class="x-row-fluid intestazione" >
                        <div class="x-span12"><span class='badge' id="badge-5" >5/6</span>&nbsp;&nbsp;<?= $text[WPLANG_E]['q_label_personale'] ?></div>
                    </div>
                    <div class="x-row-fluid leggenda" id='intestazione-personale' >
                        <div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_quesito'] ?></div>
                        <div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_insufficiente'] ?></div>
                        <div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_sufficiente'] ?></div>
                        <div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_buono'] ?></div>
                        <div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_eccellente'] ?></div>
                    </div>
                    <div class="x-row-fluid quesito quesito-white" >
                        <div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_complessivo'] ?><span class="error ml-2" id="error_personale_complessivo"></span></div>
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
                        <div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_personale_professione'] ?><span class="error ml-2" id="error_personale_professionalita"></span></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="personale_professionalita" id="personale_professionalita_1"  value='I' class="radio-ins personale_professionalita" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="personale_professionalita" id="personale_professionalita_2" value='S' class="radio-suf personale_professionalita" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="personale_professionalita" id="personale_professionalita_3" value='B' class="radio-buo personale_professionalita" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="personale_professionalita" id="personale_professionalita_4" value='E' class="radio-ott personale_professionalita" /></div>
                    </div>
                    <div class="x-row-fluid quesito" >
                        <div class="x-span4 label-mobile"><?= $text[WPLANG_E]['q_label_personale_animazione'] ?><span class="error ml-2" id="error_personale_animazione"></span></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_insufficiente'] ?></span><input type="radio"  name="personale_animazione" id="personale_animazione_1"  value='I' class="radio-ins personale_animazione" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_sufficiente'] ?></span><input type="radio"  name="personale_animazione" id="personale_animazione_2" value='S' class="radio-suf personale_animazione" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_buono'] ?></span><input type="radio"   name="personale_animazione" id="personale_animazione_3" value='B' class="radio-buo personale_animazione" /></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_eccellente'] ?></span><input type="radio" name="personale_animazione" id="personale_animazione_4" value='E' class="radio-ott personale_animazione" /></div>
                    </div>
                </div>
                
                <div id="dati" class="boxed-group"> 
                    <div class="x-row-fluid intestazione" >
                        <div class="x-span12"><span class='badge' id="badge-6" >6/6</span>&nbsp;&nbsp;<?= $text[WPLANG_E]['q_label_riepiologo'] ?></div>
                    </div>
                    <div class="x-row-fluid leggenda" id='' >
                        <div class="x-span6"></div>
                        <div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_no'] ?></div>
                        <div class="x-span2 centered "><?= $text[WPLANG_E]['q_label_forse'] ?></div>
                        <div class="x-span2 centered "></span><?= $text[WPLANG_E]['q_label_si'] ?></div>
                    </div>
                    <div class="x-row-fluid quesito quesito-white" >
                        <div class="x-span6 label-mobile "><?= $text[WPLANG_E]['q_label_consiglio'] ?><span class="error ml-2" id="error_consiglia"></span></div>
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
                        <div class="x-span8 label-mobile"><?= $text[WPLANG_E]['q_label_ricevere'] ?><span class="error ml-2" id="error_info"></span></div>
                        <div class="x-span2 centered "><span class="only-mobile"><?= $text[WPLANG_E]['q_label_no'] ?></span><input type="radio" name="info" id="info_1" value='N' class="radio-ins"/>&nbsp;&nbsp;<span class="nomobile">No</span></div>
                        <div class="x-span2 centered "><span class="only-mobile"><?= $text[WPLANG_E]['q_label_si'] ?></span><input type="radio" name="info" id="info_2" value='S' class="radio-ott"/>&nbsp;&nbsp;<span class="nomobile">Si</span></div>
                    </div>

                    <div class="x-row-fluid quesito" id="dati-utente" style="display:none" >
                        <div class="x-span3 prl">
                            <label><?= $text[WPLANG_E]['q_label_nome'] ?><span class="error ml-2" id="error_nome"></span></label> 
                            <input type='text' class="wpcf7-form fullwidth resetError" name='nome' id='nome' />
                        </div>
                        <div class="x-span3 prl">
                            <label><?= $text[WPLANG_E]['q_label_cognome'] ?><span class="error ml-2" id="error_cognome"></span></label> 
                            <input type='text' class="wpcf7-form fullwidth resetError" name='cognome' id='cognome' />
                        </div>
                        <div class="x-span3 prl">
                            <label><?= $text[WPLANG_E]['q_label_email'] ?><span class="error ml-2" id="error_email"></span></label> 
                                <div class="input-group date" id="datepicker-pastdisabled">
                                <span class="input-group-addon"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control sm-input wpcf7-form fullwidth resetError" id="email" name="email" value=""/>
                            </div>
                        </div>
                        <div class="x-span3 prl">
                            <label><?= $text[WPLANG_E]['q_label_cellulare'] ?><span class="error ml-2" id="error_cellulare"></span></label> 
                                <div class="input-group date" id="datepicker-pastdisabled">
                                <span class="input-group-addon"><i class="fas fa-plus"></i></span>
                                <input type="text" class="form-control sm-input wpcf7-form fullwidth resetError" id="cellulare" name="cellulare" value=""/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="x-row-fluid quesito" style="padding-top: 20px" > 
                        <div class="x-span6">
                            <input type='checkbox' name='informativa' id='informativa' value='Y' class="check-blue resetError" />
                            <?= $text[WPLANG_E]['label_informativa_letta'] ?>*<br /> <span id='error_informativa'class='checkerror' ></span>
                            <div class="tanks" style="padding-top: 10px"><?= $text[WPLANG_E]['q_label_grazie'] ?></div>
                        </div>
                    </div>
                    <div class="x-row-fluid quesito" >
                        <div class="x-span12 prl" style="text-align: center; padding-bottom: 20px; padding-top: 30px">
                            <button type="submit" class="btn-send"><?= $text[WPLANG_E]['q_label_invia'] ?></button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="language" id="language" value="<?= WPLANG_E ?>" />
                <input type="hidden" name="idQ" id="idQ" value='' />
                <input type="hidden" name="from" id="from" value='D' />
                <input type="hidden" name="albergo" id="albergo" value="19" />
            </form>
        </div>
    </div>
</div>

<?php
// Enqueue necessary styles and scripts
wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css');
wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css');
wp_enqueue_style('qualitadoc-custom', get_stylesheet_directory_uri() . '/form_qualita/custom.css');
wp_enqueue_style('qualitadoc-datepicker', get_stylesheet_directory_uri() . '/form_qualita/datepicker.css');
wp_enqueue_script('bootstrap-datepicker', get_stylesheet_directory_uri() . '/form_qualita/bootstrap-datepicker.js', array('jquery'), '', true);
wp_enqueue_script('bootstrap-datepicker-it', get_stylesheet_directory_uri() . '/form_qualita/bootstrap-datepicker.it.js', array('jquery'), '', true);
wp_enqueue_script('qualitadoc-functions', get_stylesheet_directory_uri() . '/form_qualita/functions.js', array('jquery'), '', true);
wp_localize_script('qualitadoc-functions', 'qualitadocAjax', array(
    'ajaxurl' => admin_url('admin-ajax.php'),
    'nonce'   => wp_create_nonce('qualitadoc_form_nonce')
));

?>
<script>
    var recaptchaSiteKey = '<?php echo esc_attr('6LfsKGUrAAAAAPA_R7ek5LNQ8k3o0goDRBaaRNgp'); ?>';
</script>
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo esc_attr('6LfsKGUrAAAAAPA_R7ek5LNQ8k3o0goDRBaaRNgp'); ?>"></script>
<?php
get_footer();
?> 