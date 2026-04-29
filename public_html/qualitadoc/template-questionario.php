<?php
/*
  Template Name: Questionario
 */
global $avia_config;

/*
 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
 */

get_header();
$title = get_the_title($ID);

if ($title == 'Satisfaction survey') {
    $_SESSION['lang'] = 'en-GB';
}else
    $_SESSION['lang'] = 'it-IT';

define('WPLANG_E', $_SESSION['lang'] ? $_SESSION['lang'] : 'it-IT');


require_once(ABSPATH . 'wp-preiscrizione/assets/class-db.php');
require_once(ABSPATH . 'wp-preiscrizione/assets/lang.php');

if (get_post_meta(get_the_ID(), 'header', true) != 'no')
    echo avia_title();

do_action('ava_after_main_title');


$db = new MySql_DB("localhost", "cooperativa_qualita", "coop_qualita", "coop5369s", true);
$strutture = $db->CycleAssochId($db->Query("SELECT id, nome FROM doc_unita WHERE qdoc ='Y' ORDER BY nome"));
$tipologie = $db->CycleAssochId($db->Query("SELECT id, nome FROM doc_tipologie_clienti ORDER BY nome"));
$conoscenza = $db->CycleAssochId($db->Query("SELECT id, nome FROM doc_conoscenza ORDER BY nome"));
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?= $sufix ?>../wp-preiscrizione/assets/css/datapicker.css" />
<link rel="stylesheet" type="text/css" href="<?= $sufix ?>../wp-preiscrizione/assets/css/custom.css" />
<link rel="stylesheet" type="text/css" href="<?= $sufix ?>../wp-preiscrizione/assets/skins/all.css" />

<div class='container_wrap container_wrap_first main_color <?php avia_layout_class('main'); ?> '>
    <div class='container x-container-fluid'>
        <main class='template-page content  <?php avia_layout_class('content'); ?> units' <?php avia_markup_helper(array('context' => 'content', 'post_type' => 'page')); ?> style="padding-right: 10px">

            <div>
                <h5 class="av-special-heading-tag" itemprop="headline"><?= $text[WPLANG_E]['questionario'] ?></h5>
            </div>
            <form id='form_questionario' method='post' name='form_questionario' action='https://<?php echo $_SERVER["SERVER_NAME"] ?>/site/wp-preiscrizione/questionario.php'>  
                <input type="hidden" name="from" id="from" value='D' />
                <input type="hidden" name="language" id="language" value='<?= WPLANG_E ?>' />
                <input type="hidden" name="idQ" id="idQ" value='' />
                <input type="hidden" name="data_compilazione" id='data_compilazione' value ='<?= date("d") . "-" . date("m") . "-" . date("Y") ?>' size='8' />
                <div class="x-row-fluid ">
                    <p  class='' ><?= $text[WPLANG_E]['q_intro'] ?> </p>
                </div>

                <div id="vacanza"   class="boxed-group" >
                    <div class="x-row-fluid intestazione"  >
                        <div class="x-span12"><span class='badge' id="badge-1"   >1/6</span>&nbsp;&nbsp;<?= $text[WPLANG_E]['q_label_vacanza'] ?></div>
                    </div>
                    <div class="x-row-fluid quesito ptop10 " >
                        <div class="x-span6 prl">
                            <label><?= $text[WPLANG_E]['q_label_struttura'] ?>&nbsp;&nbsp;<span class='error' id='error_albergo'></span> </label>
                            <select name ='albergo' id="albergo" class='input-full nop viaggio resetError' >
                                <option value ='' ><?= $text[WPLANG_E]['q_scegli'] ?></option>
                                <? foreach ($strutture as $id => $val) { ?>
                                    <option  value='<?= $id ?>'><?= $val ?></option>
                                <? } ?>
                            </select>
                        </div>
                        <div class="x-span3 prl">
                            <label><?= $text[WPLANG_E]['q_label_arrivo'] ?>&nbsp;&nbsp;<span class='error' id='error_arrivo'></span></label> 
                            <div class="input-group date" id="datepicker-pastdisabled">
                                <span class="input-group-addon" id="arrivo-pick"  ><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control sm-input wpcf7-form fullwidth viaggio resetError" id='arrivo' name='arrivo'  maxlength="10" size="10"  value=""/>
                            </div>
                        </div>
                        <div class="x-span3 prl">
                            <label><?= $text[WPLANG_E]['q_label_partenza'] ?>&nbsp;&nbsp;<span class='error' id='error_partenza'></span></label> 
                            <div class="input-group date" id="datepicker-pastdisabled">
                                <span class="input-group-addon" id="partenza-pick" ><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control sm-input wpcf7-form fullwidth viaggio" id='partenza' name='partenza'   value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="x-row-fluid quesito bottom10">
                        <div class="x-span6 prl">
                            <label><?= $text[WPLANG_E]['q_label_tipologia'] ?>&nbsp;&nbsp;<span class='error' id='error_tipologia'></span></label> 
                            <select name ='tipologia' id="tipologia" class='input-full nop viaggio resetError' >
                                <option value ='' ><?= $text[WPLANG_E]['q_scegli'] ?></option>
                                <? foreach ($tipologie as $id => $val) { ?>
                                    <option  value='<?= $id ?>'><?= $val ?></option>
                                <? } ?>
                            </select>
                        </div>
                        <div class="x-span6 prl">
                            <label><?= $text[WPLANG_E]['q_label_conoscenza'] ?>&nbsp;&nbsp;<span class='error' id='error_conoscenza'></span></label> 
                            <select name ='conoscenza' id="conoscenza" class='input-full nop  viaggio resetError' >
                                <option value ='' ><?= $text[WPLANG_E]['q_scegli'] ?></option>
                                <? foreach ($conoscenza as $id => $val) { ?>
                                    <option  value='<?= $id ?>'><?= $val ?></option>
                                <? } ?>
                            </select>
                        </div>
                    </div>


                    <div class="x-row-fluid leggenda" id='intestazione-generale' >
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
                <div id="struttura" class="boxed-group hidden-box"  >
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
                    <div class="x-row-fluid pulsante-salta" id='skip-struttura-block' >
                        <div class="x-span6"><span class='progress'></span></div>
                        <div class="x-span6"><span class='skip-button' id="skip-struttura"  >PROSEGUI</span></div>
                    </div>
                </div>
                <div id="camera"  class="boxed-group hidden-box"  >
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
                    <div class="x-row-fluid pulsante-salta" id='skip-camera-block' >
                        <div class="x-span6"><span class='progress'></span></div>
                        <div class="x-span6"><span class='skip-button' id="skip-camera"  >PROSEGUI</span></div>
                    </div>
                </div>
                <div id="ristorante"  class="boxed-group hidden-box"  >
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
                    <div class="x-row-fluid pulsante-salta" id='skip-ristorante-block' >
                        <div class="x-span6"><span class='progress'></span></div>
                        <div class="x-span6"><span class='skip-button' id="skip-ristorante"  >PROSEGUI</span></div>
                    </div>
                </div>
                <div id="personale" class="boxed-group hidden-box"  >
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
                    <div class="x-row-fluid pulsante-salta" id='skip-personale-block' >
                        <div class="x-span6"><span class='progress'></span></div>
                        <div class="x-span6"><span class='skip-button' id="skip-personale"  >PROSEGUI</span></div>
                    </div>
                </div>
                <div  id='dati' class="boxed-group hidden-box"  > 
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
                        <div class="x-span6 label-mobile "><?= $text[WPLANG_E]['q_label_consiglio'] ?></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_no'] ?></span><input type="radio" name="consiglia" id="consiglia_1" value='N' class="radio-ins"/></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_forse'] ?></span><input type="radio" name="consiglia" id="consiglia_2" value='F' class="radio-suf"/></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_si'] ?></span><input type="radio" name="consiglia" id="consiglia_3" value='S' class="radio-ott"/></div>
                    </div>
                    <div class="x-row-fluid leggenda" id="isTrue" >
                        <div class="x-span12 label-mobile"><?= $text[WPLANG_E]['q_label_suggerimenti'] ?></div>
                    </div>
                    <div class="x-row-fluid quesito" >
                        <div class="x-span12 prl"><textarea id="suggerimenti" name="suggerimenti" rows='4' ></textarea></div>
                    </div>
                    <div class="x-row-fluid quesito quesito-white" >
                        <div class="x-span8 label-mobile"><?= $text[WPLANG_E]['q_label_ricevere'] ?></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_no'] ?></span><input type="radio" name="info" id="info_1" value='N' class="radio-ins"/>&nbsp;&nbsp;<span class='nomobile'>No</span></div>
                        <div class="x-span2 centered "><span class='only-mobile'><?= $text[WPLANG_E]['q_label_si'] ?></span><input type="radio" name="info" id="info_2" value='S' class="radio-ott"/>&nbsp;&nbsp;<span class='nomobile'>Si</span></div>
                    </div>
                    <div class="x-row-fluid quesito" id='dati-utente' style="display:none" >
                        <div class="x-span3 prl">
                            <label><?= $text[WPLANG_E]['q_label_nome'] ?>&nbsp;&nbsp;<span class='error' id='error_nome'></span></label> 
                            <input type='text' class="wpcf7-form fullwidth resetError" name='nome' id='nome' />
                        </div>
                        <div class="x-span3 prl">
                            <label><?= $text[WPLANG_E]['q_label_cognome'] ?>&nbsp;&nbsp;<span class='error' id='error_cognome'></span></label> 
                            <input type='text' class="wpcf7-form fullwidth resetError" name='cognome' id='cognome' />
                        </div>
                        <div class="x-span3 prl">
                            <label><?= $text[WPLANG_E]['q_label_email'] ?>&nbsp;&nbsp;<span class='error' id='error_email'></span></label> 
                             <div class="input-group date" id="datepicker-pastdisabled">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="text" class="form-control sm-input wpcf7-form fullwidth resetError" id='email' name='email'   value=""/>
                            </div>
                        </div>
                        <div class="x-span3 prl">
                            <label><?= $text[WPLANG_E]['q_label_cellulare'] ?>&nbsp;&nbsp;<span class='error' id='error_cellulare'></span></label> 
                             <div class="input-group date" id="datepicker-pastdisabled">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control sm-input wpcf7-form fullwidth resetError" id='cellulare' name='cellulare'   value=""/>
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
                            <a href="javascript:rispondi('')"  class='button'><?= $text[WPLANG_E]['q_label_invia'] ?></a>
                        </div>
                    </div>
                </div>
            </form>
        </main>
        <?php
        $avia_config['currently_viewing'] = 'page';
        get_sidebar();
        ?>
    </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times</button>
                <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?= $text[WPLANG_E]['label_attenzione'] ?></h4>
            </div>
            <div class="modal-body">
                <p><?= $text[WPLANG_E]['label_verificare'] ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="button" data-dismiss="modal"><?= $text[WPLANG_E]['label_chiudi'] ?></button>
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
                Informativa ex art. 13 D.lgs. 196/2003 "Codice in materia di protezione dei dati personali"
                - I dati da Lei forniti verranno trattati con la finalit&agrave; di invio di materiale pubblicitario / informativo / promozionale e di aggiornamenti su iniziative ed offerte volte a premiare i Clienti. Tali attivit&agrave; potranno riguardare prodotti e servizi della nostra societ&agrave; nonch&eacute; di Partner commerciali e potranno essere eseguite tramite invio di mail all?indirizzo di posta elettronica indicato o SMS (Short Message Service) che potr&agrave; ricevere sull'utenza che stai registrando.
                - Il trattamento sar&agrave; effettuato con modalit&agrave; informatizzate.
                - I dati saranno comunicati esclusivamente ai soggetti necessari all'espletamento delle attivit&agrave; sopra citate. Non sar&agrave; data altra diffusione dei dati al di fuori di questo ambito.
                - Il consenso al trattamento dei dati per le predette finalit&agrave; potr&agrave; essere revocato.
                - Il titolare e responsabile del trattamento &egrave;:
                DOC S.c.s Via Assietta, 16/b - 10128, Torino.
                - Per ogni altra informazione relativa alla tutela della sua privacy la invitiamo ad inviarci una email all'indirizzo info@cooperativadoc.it.
            </div>
            <div class="modal-footer">
                <button type="button" class="button" data-dismiss="modal"><?= $text[WPLANG_E]['label_chiudi'] ?></button>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>