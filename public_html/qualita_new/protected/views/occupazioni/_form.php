<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'occupazioni-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>
<div class="wide form form-horizontal row-border">
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    <div class="form-group first-row">
        <label class="col-xs-2 control-label">
            <?php echo $form->labelEx($model, 'nome'); ?></label>
        <div class="col-xs-8">
            <?php echo    $form->textField($model,'nome',array('class'=> 'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-2 control-label">
            <?php echo $form->labelEx($model, 'nome_it_IT'); ?></label>
        <div class="col-xs-8">
            <?php echo    $form->textField($model,'nome_it_IT',array('class'=> 'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-2 control-label">
            <?php echo $form->labelEx($model, 'nome_en_GB'); ?></label>
        <div class="col-xs-8">
            <?php echo    $form->textField($model,'nome_en_GB',array('class'=> 'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-2 control-label">
            <?php echo $form->labelEx($model, 'nome_es_ES'); ?></label>
        <div class="col-xs-8">
            <?php echo    $form->textField($model,'nome_es_ES',array('class'=> 'form-control')); ?>
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange btn-submit-form', 'data-refer' => 'occupazioni-form')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
