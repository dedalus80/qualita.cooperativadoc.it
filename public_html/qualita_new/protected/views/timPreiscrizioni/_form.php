<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'tim-preiscrizioni-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array('validateOnSubmit' => true,),));
?>
    <div>
        <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
        <div class="row row-10" style='margin-top: 20px'>
            <div class="col-xs-12 col-md-12">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'iscrizione'); ?></label>
                <?php echo $form->dropDownList($model, "iscrizione", $model->selectSoggiorni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
            </div>
        </div>
        <fieldset>
            <legend>Dati partecipante</legend>
            <div class="row row-10" style='margin-top: 20px'>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nome'); ?></label>
                    <?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'cognome'); ?></label>
                    <?php echo $form->textField($model, 'cognome', array('class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'codice_fiscale'); ?></label>
                    <?php echo $form->textField($model, 'codice_fiscale', array('class' => 'form-control')); ?>
                </div>
            </div>
            <div class="row row-10">
                <div class="col-xs-12 col-md-3">
                    <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'nascita_data'); ?></label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <?php echo $form->textField($model, 'nascita_data', array('class' => 'form-control hasDatepicker form-size richiamo', 'size' => '10', 'maxlength' => '12', 'value' => Yii::app()->MyUtils->reverseDate($model->nascita_data))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nascita_luogo'); ?></label>
                    <?php echo $form->textField($model, 'nascita_luogo', array('class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nascita_provincia'); ?></label>
                    <?php echo $form->dropDownList($model, "nascita_provincia", $model->selectProvincie, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nazionalita'); ?></label>
                    <? echo $form->dropDownList($model, "nazionalita", $model->selectNazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="row row-10">
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'indirizzo'); ?></label>
                    <?php echo $form->textField($model, 'indirizzo', array('class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'citta'); ?></label>
                    <?php echo $form->textField($model, 'citta', array('class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'provincia'); ?></label>
                    <?php echo $form->dropDownList($model, "provincia", $model->selectProvincie, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-2">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'cap'); ?></label>
                    <?php echo $form->textField($model, 'cap', array('class' => 'form-control')); ?>
                </div>
            </div>
            <div class="row row-10" style='margin-top: 20px'>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'soggioro'); ?></label>
                    <?php echo $form->dropDownList($model, "soggiorno", $model->selectCentri, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'turno'); ?></label>
                    <?php echo $form->dropDownList($model, "turno", $model->selectTurni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'partenza'); ?></label>
                    <?php echo $form->dropDownList($model, "partenza", $model->selectPartenze, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="row row-10" style='margin-top: 20px' >
                <div class="col-xs-12 col-md-2">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'operatore_supporto'); ?></label><br />
                    <?php echo $form->radioButtonList($model, 'operatore_supporto', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
                </div>
                <div class="col-xs-12 col-md-2">
                    <div id='tim-supporto-dettaglio' style='display:<?= $model->operatore_supporto =='Y' ? "block":"none" ?>'>
                        <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'operatore_supporto_dettaglio'); ?></label>
                        <?php echo $form->textField($model, 'operatore_supporto_dettaglio', array('class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-md-2">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'allergie'); ?></label><br />
                    <?php echo $form->radioButtonList($model, 'allergie', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
                </div>
                <div class="col-xs-12 col-md-2">
                    <div id='tim-allergie-dettaglio' style='display:<?= $model->allergie =='Y' ? "block":"none" ?>'>
                        <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'allergie_dettaglio'); ?></label>
                        <?php echo $form->textField($model, 'allergie_dettaglio', array('class' => 'form-control')); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-md-2">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'problema_sanitario'); ?></label><br />
                    <?php echo $form->radioButtonList($model, 'problema_sanitario', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
                </div>
                <div class="col-xs-12 col-md-2">
                    <div id='tim-problema-dettaglio' style='display:<?= $model->problema_sanitario =='Y' ? "block":"none" ?>'>
                        <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'problema_sanitario_dettaglio'); ?></label>
                        <?php echo $form->textField($model, 'problema_sanitario_dettaglio', array('class' => 'form-control')); ?>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset style="margin-top: 20px;  ">
            <legend>Dati del genitore dipendente</legend>
            <div class="row row-10" style='margin-top: 20px'>
                <div class="col-xs-12 col-md-3">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'genitore_nome'); ?></label>
                    <?php echo $form->textField($model, 'genitore_nome', array('class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'genitore_cognome'); ?></label>
                    <?php echo $form->textField($model, 'genitore_cognome', array('class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'genitore_codice_fiscale'); ?></label>
                    <?php echo $form->textField($model, 'genitore_codice_fiscale', array('class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'reddito'); ?></label>
                    <?php echo $form->dropDownList($model, "genitore_societa", $model->selectFascie, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="row row-10" style='margin-top: 20px'>
                <div class="col-xs-12 col-md-3">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'genitore_societa'); ?></label>
                    <?php echo $form->dropDownList($model, "genitore_societa", $model->selectSocieta, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'genitore_funzione'); ?></label>
                    <?php echo $form->dropDownList($model, "genitore_funzione", $model->selectFunzioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'cid'); ?></label>
                    <?php echo $form->textField($model, 'cid', array('class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'genitore_lavoro'); ?></label>
                    <?php echo $form->dropDownList($model, "genitore_lavoro", $model->selectSedi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="row row-10" style='margin-top: 20px'>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'localita'); ?></label>
                    <?php echo $form->textField($model, 'localita', array('class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'genitore_provincia'); ?></label>
                    <?php echo $form->dropDownList($model, "genitore_provincia", $model->selectProvincie, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'genitore_cap'); ?></label>
                    <?php echo $form->textField($model, 'genitore_cap', array('class' => 'form-control')); ?>
                </div>
            </div>
            <div class="row row-10" style='margin-top: 20px'>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'genitore_telefono'); ?></label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <?php echo $form->textField($model, 'genitore_telefono', array('class' => 'form-control ', 'size' => '10', 'maxlength' => '12',)); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'genitore_cellulare'); ?></label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <?php echo $form->textField($model, 'genitore_cellulare', array('class' => 'form-control ', 'size' => '10', 'maxlength' => '12',)); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'genitore_email'); ?></label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <?php echo $form->textField($model, 'genitore_email', array('class' => 'form-control ', 'size' => '10', 'maxlength' => '12',)); ?>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset style="margin-top: 20px;maring-bottom: 20px; display:<?= $model->altro_genitore =='Y' ? "block":"none" ?>">
            <legend>Dati dell'altro genitore</legend>
            <div class="row row-10" style='margin-top: 20px'>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'secondo_genitore_nome'); ?></label>
                    <?php echo $form->textField($model, 'secondo_genitore_nome', array('class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'secondo_genitore_cognome'); ?></label>
                    <?php echo $form->textField($model, 'secondo_genitore_cognome', array('class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'secondo_genitore_codice_fiscale'); ?></label>
                    <?php echo $form->textField($model, 'secondo_genitore_codice_fiscale', array('class' => 'form-control')); ?>
                </div>
            </div>
            <div class="row row-10" style=' margin-bottom: 20px'>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'secondo_genitore_nascita_data'); ?></label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <?php echo $form->textField($model, 'secondo_genitore_nascita_data', array('class' => 'form-control hasDatepicker form-size richiamo', 'size' => '10', 'maxlength' => '12', 'value' => Yii::app()->MyUtils->reverseDate($model->secondo_genitore_nascita_data))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'secondo_genitore_nascita_luogo'); ?></label>
                    <?php echo $form->textField($model, 'secondo_genitore_nascita_luogo', array('class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'secondo_genitore_provincia'); ?></label>
                    <?php echo $form->dropDownList($model, "secondo_genitore_provincia", $model->selectProvincie, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
                </div>
            </div>
        </fieldset>
         <fieldset style="margin-top: 20px; display:<?= $model->modulo_conformita ||  $model->modulo_genitore ? "block":"none" ?>">
            <legend>Documentazione</legend>
             <div class="row row-10" style='margin-top: 20px'>
                 <div class="col-xs-12 ">
                 <b>Copia conformità informazioni:<a target='_blank' href='http://iscrizionitim.keluar.it/uploads/<?= $model->modulo_conformita ?>'>&nbsp;&nbsp;<?= $model->modulo_conformita ?></a></b>
                 </div>
             </div>
             <div class="row row-10" style='margin-top: 20px'>
                 <div class="col-xs-12 ">
                 <b>Copia documento primo genitore:<a target='_blank' href='http://iscrizionitim.keluar.it/uploads/<?= $model->modulo_genitore ?>'>&nbsp;&nbsp;<?= $model->modulo_genitore ?></a></b>
                 </div>
             </div>
             <?php if($model->modulo_secondo_genitore ):?>
             <div class="row row-10" style='margin-top: 20px'>
                 <div class="col-xs-12 ">
                 <b>Copia documento secondo genitore:<a target='_blank' href='http://iscrizionitim.keluar.it/uploads/<?= $model->modulo_secondo_genitore ?>'>&nbsp;&nbsp;<?= $model->modulo_secondo_genitore ?></a></b>
                 </div>
             </div>
             <?php endif; ?>
        </fieldset>
    </div>
    <div class="panel-footer">
        <div class=" pull-right">
            <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange ', 'id' => 'tim-preiscrizioni-btn')); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
