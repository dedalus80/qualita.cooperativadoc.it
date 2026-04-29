<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'azioni-verifiche-amministrazione-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'), 'clientOptions' => array('validateOnSubmit' => true,),));
?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    <div class="row row-10">
        <div class="col-xs-12 col-sm-2 ">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'data'); ?></label>
            <div class="input-group date" >
                <span class="input-group-addon data-calendar" data-refer="AzioniVerificheAmministrazione_data"><i class="fa fa-calendar"></i></span>
                <?php echo $form->textField($model, 'data', array('class' => 'form-control hasDatepicker richiamo', 'value' => Yii::app()->MyUtils->reverseDate($model->data))); ?>
            </div>  
        </div>
        <div class="col-xs-6 col-sm-2 ">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'ora_inizio'); ?></label>
            <div class="input-group">							
                <span class="input-group-addon"><i class="fa fa-clock-o data-timer" data-refer='AzioniVerificheAmministrazione_ora_inizio' ></i></span>
                <?php echo $form->textField($model, 'ora_inizio', array('class' => 'orario form-control ', 'value' => substr($model->ora_inizio, 0, 5))); ?>
            </div>
        </div>
        <div class="col-xs-6 col-sm-2 ">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'ora_fine'); ?></label>
            <div class="input-group">							
                <span class="input-group-addon"><i class="fa fa-clock-o data-timer" data-refer='AzioniVerificheAmministrazione_ora_fine' ></i></span>
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
                Il valutatore indichi il giudizio UNICAMENTE con le sigle: <B></b> (voce conforme), <b>NC</b> (voce non conforme), <b>NA</b> (non applicabile), <b>NR</b> (non rilevata)</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel-group panel-default" id="accordionA">
                <div class="panel panel-default panel-noshadow panel-nomargin" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
                    <a data-toggle="collapse" data-parent="#accordionA" href="#collapse_1" aria-expanded="true" class="">
                        <div class="panel-heading">
                            <h2> 1. GESTIONE DELLA CASSA E DEI DOCUMENTI</h2>
                            <div class="panel-ctrls" style="padding-top: 14px; padding-right: 15px">
                                <div class="progress" style="display: inline-block ; margin-bottom: 0px ; margin: 0px">
                                    <div id="progress-sezione-1"   class="progress-bar progress-bar-<?= $model->bar['color'] ?>" style="width:<?= $model->bar['percent'] ?>%"></div>
                                </div>
                                <div style="; display: inline-block">
                                    <div class="nc-count dropdown toolbar-icon-bg" style="display: inline-block">
                                        <span class="icon-bg"><i class="fa fa-fw fa-thumbs-o-down"></i></span><span id="badge-sezione-1" class="badge  badge-<?= $model->bar['badgecolor'] ?>" data-html="true" data-placement='bottom' data-toggle = 'tooltip' title = 'Totale non conformit&agrave;'  ><?= $model->numero_non_conformita ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div id="collapse_1" class="collapse in " aria-expanded="true"  style="">
                        <div class="panel-body"  style='padding-top: 0px' >
                            <div class="row row-10 intestazione-sezione">
                                <div class="col-xs-12 col-sm-5 pdl">PARAMETRO DA VALUTARE</div>
                                <div class="col-xs-12 col-sm-2 centered">GIUDIZIO</div>
                                <div class="col-xs-12 col-sm-5 centered">NOTE SINGOLA VOCE</div>
                            </div> 
                            <div class="row row-10 bor-bot">
                                <div class="col-xs-12 col-sm-5"><?php echo $form->labelEx($model, 'ordine'); ?></div>
                                <div class="col-xs-12 col-sm-2"><? echo $form->dropDownList($model, "ordine", $model->selectValutazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control sezione sezione-1', 'data-class' => 'sezione-1')); ?></div>
                                <div class="col-xs-12 col-sm-5"><? echo $form->textArea($model, "ordine_note", array('maxlength' => 320, 'rows' => 1, 'cols' => 30, 'class' => 'form-control')); ?></div>
                            </div>
                            <div class="row row-10 bor-bot">
                                <div class="col-xs-12 col-sm-5"><?php echo $form->labelEx($model, 'saldo'); ?></div>
                                <div class="col-xs-12 col-sm-2"><? echo $form->dropDownList($model, "saldo", $model->selectValutazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control sezione sezione-1', 'data-class' => 'sezione-1')); ?></div>
                                <div class="col-xs-12 col-sm-5"><? echo $form->textArea($model, "saldo_note", array('maxlength' => 320, 'rows' => 1, 'cols' => 30, 'class' => 'form-control')); ?></div>
                            </div> 
                            <div class="row row-10 bor-bot">
                                <div class="col-xs-12 col-sm-5"><?php echo $form->labelEx($model, 'archiviazione'); ?></div>
                                <div class="col-xs-12 col-sm-2"><? echo $form->dropDownList($model, "archiviazione", $model->selectValutazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control sezione sezione-1', 'data-class' => 'sezione-1')); ?></div>
                                <div class="col-xs-12 col-sm-5"><? echo $form->textArea($model, "archiviazione_note", array('maxlength' => 320, 'rows' => 1, 'cols' => 30, 'class' => 'form-control')); ?></div>
                            </div> 
                            <div class="row row-10 bor-bot">
                                <div class="col-xs-12 col-sm-5"><?php echo $form->labelEx($model, 'documenti'); ?></div>
                                <div class="col-xs-12 col-sm-2"><? echo $form->dropDownList($model, "documenti", $model->selectValutazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control sezione sezione-1', 'data-class' => 'sezione-1')); ?></div>
                                <div class="col-xs-12 col-sm-5"><? echo $form->textArea($model, "documenti_note", array('maxlength' => 320, 'rows' => 1, 'cols' => 30, 'class' => 'form-control')); ?></div>
                            </div> 
                            <div class="row row-10 bor-bot">
                                <div class="col-xs-12 col-sm-5"><?php echo $form->labelEx($model, 'intestazione'); ?></div>
                                <div class="col-xs-12 col-sm-2"><? echo $form->dropDownList($model, "intestazione", $model->selectValutazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control sezione sezione-1', 'data-class' => 'sezione-1')); ?></div>
                                <div class="col-xs-12 col-sm-5"><? echo $form->textArea($model, "intestazione_note", array('maxlength' => 320, 'rows' => 1, 'cols' => 30, 'class' => 'form-control')); ?></div>
                            </div>
                            <div class="row row-10 bor-bot">
                                <div class="col-xs-12 col-sm-5"><?php echo $form->labelEx($model, 'importo'); ?></div>
                                <div class="col-xs-12 col-sm-2"><? echo $form->dropDownList($model, "importo", $model->selectValutazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control sezione sezione-1', 'data-class' => 'sezione-1')); ?></div>
                                <div class="col-xs-12 col-sm-5"><? echo $form->textArea($model, "importo_note", array('maxlength' => 320, 'rows' => 1, 'cols' => 30, 'class' => 'form-control')); ?></div>
                            </div>
                            <div class="row row-10 bor-bot">
                                <div class="col-xs-12 col-sm-5"><?php echo $form->labelEx($model, 'ragione_sociale'); ?></div>
                                <div class="col-xs-12 col-sm-2"><? echo $form->dropDownList($model, "ragione_sociale", $model->selectValutazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control sezione sezione-1', 'data-class' => 'sezione-1')); ?></div>
                                <div class="col-xs-12 col-sm-5"><? echo $form->textArea($model, "ragione_sociale_note", array('maxlength' => 320, 'rows' => 1, 'cols' => 30, 'class' => 'form-control')); ?></div>
                            </div>
                            <div class="row row-10 bor-bot">
                                <div class="col-xs-12 col-sm-5"><?php echo $form->labelEx($model, 'prezzi_conformi'); ?></div>
                                <div class="col-xs-12 col-sm-2"><? echo $form->dropDownList($model, "prezzi_conformi", $model->selectValutazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control sezione sezione-1', 'data-class' => 'sezione-1')); ?></div>
                                <div class="col-xs-12 col-sm-5"><? echo $form->textArea($model, "prezzi_conformi_note", array('maxlength' => 320, 'rows' => 1, 'cols' => 30, 'class' => 'form-control')); ?></div>
                            </div>
                            <div class="row row-10 bor-bot">
                                <div class="col-xs-12 col-sm-5"><?php echo $form->labelEx($model, 'utilizzo_modulistica'); ?></div>
                                <div class="col-xs-12 col-sm-2"><? echo $form->dropDownList($model, "utilizzo_modulistica", $model->selectValutazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control sezione sezione-1', 'data-class' => 'sezione-1')); ?></div>
                                <div class="col-xs-12 col-sm-5"><? echo $form->textArea($model, "utilizzo_modulistica_note", array('maxlength' => 320, 'rows' => 1, 'cols' => 30, 'class' => 'form-control')); ?></div>
                            </div>
                            <div class="row row-10 bor-bot">
                                <div class="col-xs-12 col-sm-5"><?php echo $form->labelEx($model, 'moduli_spese'); ?></div>
                                <div class="col-xs-12 col-sm-2"><? echo $form->dropDownList($model, "moduli_spese", $model->selectValutazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control sezione sezione-1', 'data-class' => 'sezione-1')); ?></div>
                                <div class="col-xs-12 col-sm-5"><? echo $form->textArea($model, "moduli_spese_note", array('maxlength' => 320, 'rows' => 1, 'cols' => 30, 'class' => 'form-control')); ?></div>
                            </div>
                            <div class="row row-10 bor-bot">
                                <div class="col-xs-12 col-sm-5"><?php echo $form->labelEx($model, 'rapporto_giornaliero'); ?></div>
                                <div class="col-xs-12 col-sm-2"><? echo $form->dropDownList($model, "rapporto_giornaliero", $model->selectValutazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control sezione sezione-1', 'data-class' => 'sezione-1')); ?></div>
                                <div class="col-xs-12 col-sm-5"><? echo $form->textArea($model, "rapporto_giornaliero_note", array('maxlength' => 320, 'rows' => 1, 'cols' => 30, 'class' => 'form-control')); ?></div>
                            </div>
                            <div class="row row-10 bor-bot">
                                <div class="col-xs-12 col-sm-5"><?php echo $form->labelEx($model, 'numero_clienti'); ?></div>
                                <div class="col-xs-12 col-sm-2"><? echo $form->dropDownList($model, "numero_clienti", $model->selectValutazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control sezione sezione-1', 'data-class' => 'sezione-1')); ?></div>
                                <div class="col-xs-12 col-sm-5"><? echo $form->textArea($model, "numero_clienti_note", array('maxlength' => 320, 'rows' => 1, 'cols' => 30, 'class' => 'form-control')); ?></div>
                            </div>
                            <div class="row row-10 bor-bot">
                                <div class="col-xs-12 col-sm-5"><?php echo $form->labelEx($model, 'scheda_veicoli'); ?></div>
                                <div class="col-xs-12 col-sm-2"><? echo $form->dropDownList($model, "scheda_veicoli", $model->selectValutazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control sezione sezione-1', 'data-class' => 'sezione-1')); ?></div>
                                <div class="col-xs-12 col-sm-5"><? echo $form->textArea($model, "scheda_veicoli_note", array('maxlength' => 320, 'rows' => 1, 'cols' => 30, 'class' => 'form-control')); ?></div> 
                            </div>
                            <div class="row row-10 bor-bot">
                                <div class="col-xs-12 col-sm-5">
                                    <?php echo $form->labelEx($model, 'note'); ?>
                                    <? echo $form->hiddenField($model, "numero_non_conformita"); ?> 
                                    <input type="hidden" name="totale-sezione-1" id="totale-sezione-1" value="<?= $model->campi ?>" /></input>
                                </div>
                                <div class="col-xs-12 col-sm-7"><? echo $form->textArea($model, "note", array('maxlength' => 320, 'rows' => 3, 'cols' => 30, 'class' => 'form-control')); ?></div>
                            </div>
                            <div class="row row-10 bor-bot">
                                <div class="col-xs-12 col-sm-5"><?php echo $form->labelEx($model, 'osservazioni'); ?></div>
                                <div class="col-xs-12 col-sm-7"><? echo $form->textArea($model, "osservazioni", array('maxlength' => 320, 'rows' => 3, 'cols' => 30, 'class' => 'form-control')); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
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
            <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange btn-submit-form ', 'data-refer' => 'azioni-verifiche-amministrazione-form')); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>