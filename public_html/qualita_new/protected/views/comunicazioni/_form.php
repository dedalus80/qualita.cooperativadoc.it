<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'comunicazione-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array(  'validateOnSubmit' => true, ), ));
?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    
    <div class="row row-10">
        <div class="col-xs-6 col-md-2">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'data_invio'); ?></label>
             <div class="input-group date" >
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <?php echo $form->textField($model, 'data_invio', array('class' => 'form-control hasDatepicker form-size richiamo', 'size' => '10', 'maxlength' => '12','value' =>  Yii::app()->MyUtils->reverseDate($model->data_invio) )); ?>
            </div>
        </div>
		<div class="col-xs-6 col-md-2">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'tutti'); ?></label>
			<div class='line-34'><?php echo $form->radioButtonList($model, 'tutti', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?></div>
        </div>
       <div class="col-xs-12 col-md-2">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'tipo'); ?></label>
            <?php echo $form->dropDownList($model, "tipo", $model->selectTipi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
        
        <div class="col-xs-12 col-md-2">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'destinatario'); ?></label>
            <?php echo $form->dropDownList($model, "destinatario", $model->selectUtenti, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-2">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'ruolo'); ?></label>
            <?php echo $form->dropDownList($model, "ruolo", $model->selectRuoli, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-2">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'struttura'); ?></label>
            <?php echo $form->dropDownList($model, "struttura", $model->selectStrutture, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
    </div>
    <fieldset id="box-P" style="display: <?= $model->tipo == "P" ? "block":"none"?>">
        <legend>Notifca Push</legend>
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <label for="" class="control-label">Titolo</label>
                <?php echo $form->textField($model, "titolo", array('class' => 'form-control')); ?>
            </div>
        </div>
        <div class="row row-10">
            <div class="col-xs-12 col-md-6">
                <label for="" class="control-label"><?php echo $form->labelEx($model, 'messaggio_push'); ?></label>
                <?php echo $form->textArea($model, "messaggio_push", array('class' => 'form-control')); ?>
            </div>
        </div>
    </fieldset>
    <fieldset id="box-S" style="display: <?= $model->tipo == "S" ? "block":"none"?>">
        <legend>Invio Sms</legend>
        <div class="row row-10">
            <div class="col-xs-12 col-md-6">
                <label for="" class="control-label">Mittente</label>
                <?php echo $form->textField($model, "sender", array('class' => 'form-control')); ?>
            </div>
        </div>
        <div class="row row-10">
            <div class="col-xs-12 col-md-6">
                <label for="" class="control-label"><?php echo $form->labelEx($model, 'messaggio_sms'); ?></label>
                <?php echo $form->textArea($model, "messaggio_sms", array('class' => 'form-control')); ?>
            </div>
        </div>
    </fieldset>
    <fieldset id="box-E" style="display: <?= $model->tipo == "E" ? "block":"none"?>">
        <legend>invio Email</legend>
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <label for="" class="control-label">Oggetto</label>
                <?php echo $form->textField($model, "oggetto", array('class' => 'form-control')); ?>
            </div>
        </div>
        <div class="row row-10">
            <div class="col-xs-12 col-md-6">
                <label for="" class="control-label"><?php echo $form->labelEx($model, 'messaggio_email'); ?></label>
                <?php echo $form->textArea($model, "messaggio_email", array('class' => 'form-control')); ?>
            </div>
        </div>
    </fieldset>
    <div class='row row-10 '>
        <div class="col-xs-12">
            <p> I campi contrasegnati con <em>*</em> sono obbligatori</p> 
            <input type="hidden" name='tipo_comunicazione' id="tipo_comunicazione" value="" />
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange  ', 'id' => 'comunicazione-btn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
