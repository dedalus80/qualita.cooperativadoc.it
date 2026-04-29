<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'azioni-verifiche-sicurezza-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'), 'clientOptions' => array('validateOnSubmit' => true,),));
?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    <div class="row">
        <div class="col-xs-12">
            <legend>Incaricato verifica: <span class='orange return-block'> <?= Yii::app()->MyUtils->getSelectValue($model->autore,'dettaglio_admin')  ?></span></legend>
        </div>
    </div>
    
    <div class="row row-10">
        <div class="col-xs-12 col-sm-2 ">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'data'); ?></label>
            <div class="input-group date" >
                <span class="input-group-addon data-calendar" data-refer="AzioniVerificheSicurezza_data"><i class="fa fa-calendar"></i></span>
                <?php echo $form->textField($model, 'data', array('class' => 'form-control hasDatepicker richiamo', 'value' => Yii::app()->MyUtils->reverseDate($model->data))); ?>
            </div>  
        </div>
        <div class="col-xs-6 col-sm-2 ">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'ora_inizio'); ?></label>
            <div class="input-group">							
                <span class="input-group-addon"><i class="fa fa-clock-o data-timer" data-refer='AzioniVerificheSicurezza_ora_inizio' ></i></span>
                <?php echo $form->textField($model, 'ora_inizio', array('class' => 'orario form-control ', 'value' => substr($model->ora_inizio, 0, 5))); ?>
            </div>
        </div>
        <div class="col-xs-6 col-sm-2 ">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'ora_fine'); ?></label>
            <div class="input-group">							
                <span class="input-group-addon"><i class="fa fa-clock-o data-timer" data-refer='AzioniVerificheSicurezza_ora_fine' ></i></span>
                <?php echo $form->textField($model, 'ora_fine', array('class' => 'orario form-control', 'data-refer' => '', 'value' => substr($model->ora_fine, 0, 5))); ?>
            </div>
        </div>
        <div class="col-xs-6 col-sm-2 ">

            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'apertura_nc'); ?></label>
            <div class='radio-line'><?php echo $form->radioButtonList($model, 'apertura_nc', array('Y' => '&nbsp;SI&nbsp;&nbsp;&nbsp;', 'N' => '&nbsp;NO&nbsp;&nbsp;&nbsp;'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green', 'separator' => '&nbsp&nbsp;')); ?></div>

        </div>
        <div class="col-xs-12 col-sm-4 ">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'tipo_valutazione'); ?></label>
            <div class='radio-line'><?php echo $form->radioButtonList($model, 'tipo_valutazione', array('A' => '&nbsp;AUTOVALUTAZIONE&nbsp;&nbsp;&nbsp;', 'V' => '&nbsp;VALUTAZIONE&nbsp;&nbsp;&nbsp;'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green', 'separator' => '&nbsp&nbsp;')); ?></div>
        </div>
    </div>
    <div class="row row-10 descrizione">
        <div class="col-xs-12 ">
            <p>La check list di BASE &egrave; articolata in 1 SEZIONE<br />
                Ogni sezione richiede di verificare la conformit&agrave; o meno ai singoli requisiti. Dopo la verifica l'ispettore riporti  a margine e/o in calce ad ogni sezione le eventuali note ed il numero di NON CONFORMIT&Agrave; registrate. A fine controllo riporti il totale delle Non conformit&agrave; nell'ultima pagina della check list lasciando copia al gestore dell'Unit&agrave; Ristorativa. <br />
                Il valutatore indichi il giudizio UNICAMENTE con le sigle: <b>C</b> (voce conforme), <b>NC</b> (voce non conforme), <b>NA</b> (non applicabile), <b>NR</b> (non rilevata)</p>
        </div>
    </div>
      <div class="row">
        <div class="col-md-12">
            <div class="panel-group panel-default" id="accordionA" style=" ">
                <?php for ($k = 1; $k <= count($model->campiSezioni); $k++) { ?>
                    <div class="panel panel-default">            
                        <a data-toggle="collapse" data-parent="#accordionA" href="#collapse_<?= $k ?>" aria-expanded="<?= $k == 1 ? 'true' : 'false' ?>" class="">
                            <div class="panel-heading">
                                <h2><?= $model->bar['sezione_' . $k]['titolo'] ?></h2>
                                <div class="panel-ctrls panel-ctrls-verifica" >
                                    <div class="progress progress-verifica" >
                                        <div id="progress-sezione-<?= $k ?>"   class="progress-bar progress-bar-<?= $model->bar['sezione_' . $k]['color'] ?>" style="width:<?= $model->bar['sezione_' . $k]['percent'] ?>%"></div>
                                    </div>
                                    <div style="; display: inline-block">
                                        <div class="nc-count dropdown toolbar-icon-bg" style="display: inline-block">
                                            <span class="icon-bg"><i class="fa fa-fw fa-thumbs-o-down"></i></span><span id="badge-sezione-<?= $k ?>" class="badge  badge-<?= $model->bar['sezione_' . $k]['badgecolor'] ?>" data-html="true" data-placement='bottom' data-toggle = 'tooltip' title = 'Totale non conformit&agrave;'  ><?= $model->bar['sezione_' . $k]['complete_nc'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div id="collapse_<?= $k ?>" class="collapse <?= $k == 1 ? 'in' : '' ?> " aria-expanded="<?= $k == 1 ? 'true' : 'false' ?>"  style="">
                            <div class="panel-body panel-body-verifica"  style='padding-top: 0px' id='panel-verifica-<?= $k ?>' >
                                <div class="row row-10 intestazione-sezione hidden-480">
                                    <div class="col-xs-12 col-sm-5 pdl">PARAMETRO DA VALUTARE</div>
                                    <div class="col-xs-12 col-sm-2 centered">GIUDIZIO</div>
                                    <div class="col-xs-12 col-sm-5 centered">NOTE SINGOLA VOCE</div>
                                </div>
                                <?php
                                for ($x = 0; $x < count($model->campiSezioni['sezione_' . $k]); $x++) {
                                    if ($k == 2 && $x == '0')
                                        echo '<div class="row row-10 sub-intestazione-sezione pdl"><div class="col-xs-12 ">IL SISTEMA DI GESTIONE AMBIENTALE &Egrave; STATO CORRETTAMENTE IMPLEMENTATO?NELLO SPECIFICO SONO STATI CORRETTAMENTE COMPLETATI I SEGUENTI DOCUMENTI? (RILEVAMENTO DI ALMENO 2 CAMPIONI DI 2 GRUPPI DI RIFERIMENTO).</div></div>';
                                    ?>
                                    <div class="row row-10 bor-bot">
                                        <div class="col-xs-12 col-sm-5"><?php echo $form->labelEx($model, $model->campiSezioni['sezione_' . $k][$x]); ?></div>
										<div class="col-xs-12 only-phone">GIUDIZIO</div>
                                        <div class="col-xs-12 col-sm-2"><? echo $form->dropDownList($model, $model->campiSezioni['sezione_' . $k][$x], $model->selectValutazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control sezione sezione-' . $k, 'data-class' => 'sezione-' . $k)); ?></div>
                                        <div class="col-xs-12 col-sm-5"><span class='only-phone'>NOTE SINGOLA VOCE</span><? echo $form->textArea($model, $model->campiSezioni['sezione_' . $k][$x] . "_note", array('maxlength' => 320, 'rows' => 2, 'cols' => 30, 'class' => 'form-control')); ?></div>
                                    </div>
                                <?php } ?>
                                <div class="row row-10 bor-bot">
                                    <div class="col-xs-12 col-sm-5">
                                        <?php echo $form->labelEx($model, 'note'); ?>
                                        <? echo $form->hiddenField($model, "numero_non_conformita"); ?> 
                                        <input type="hidden" name="totale-sezione-<?= $k ?>" id="totale-sezione-<?= $k ?>" value="<?= count($model->campiSezioni['sezione_' . $k]) ?>" />
                                    </div>
                                    <div class="col-xs-12 col-sm-7"><? echo $form->textArea($model, "note_" . $k, array('maxlength' => 320, 'rows' => 3, 'cols' => 30, 'class' => 'form-control')); ?></div>
                                </div>
                                <div class="row row-10 bor-bot">
                                    <div class="col-xs-12 col-sm-5"><?php echo $form->labelEx($model, 'osservazioni_' . $k); ?></div>
                                    <div class="col-xs-12 col-sm-7"><? echo $form->textArea($model, "osservazioni_" . $k, array('maxlength' => 320, 'rows' => 3, 'cols' => 30, 'class' => 'form-control')); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div>    
        <div class='row row-10 row-bottom' style="margin-top: 15px" >
            <div class="col-xs-12">
                <p> I campi contrasegnati con <em>*</em> sono obbligatori</p> 
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <div class="pull-right">
            <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange btn-submit-form ', 'data-refer' => 'azioni-verifiche-sicurezza-form')); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>