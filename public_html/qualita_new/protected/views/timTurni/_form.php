<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'tim-turni-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>
<div class="wide form form-horizontal row-border">
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    <div class="form-group first-row" >
        <label class="col-xs-2 control-label"><?php echo $form->labelEx($model, 'codice'); ?></label>
        <div class="col-xs-8"><?php echo    $form->textField($model,'codice',array('class'=> 'form-control')); ?></div>
    </div>
    <div class="form-group " >
        <label class="col-xs-2 control-label"><?php echo $form->labelEx($model, 'iscrizione'); ?></label>
        <div class="col-xs-8">
                 <? echo $form->dropDownList($model, "iscrizione", $model->selectSoggiorni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group " >
        <label class="col-xs-2 control-label"><?php echo $form->labelEx($model, 'data_inizio'); ?></label>
        <div class="col-xs-8">
            <div class="input-group date">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <?php echo $form->textField($model, 'data_inizio', array('class' => 'form-control hasDatepicker richiamo',  'value' => Yii::app()->MyUtils->reverseDate($model->data_inizio))); ?>
            </div>
        </div>
    </div>
    <div class="form-group " >
        <label class="col-xs-2 control-label"><?php echo $form->labelEx($model, 'data_fine'); ?></label>
        <div class="col-xs-8">
            <div class="input-group date">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <?php echo $form->textField($model, 'data_fine', array('class' => 'form-control hasDatepicker richiamo',  'value' => Yii::app()->MyUtils->reverseDate($model->data_fine))); ?>
            </div>
        </div>
    </div>
    <div class="form-group " >
        <label class="col-xs-2 control-label"><?php echo $form->labelEx($model, 'data_fine'); ?></label>
        <div class="col-xs-8">
            <div class="input-group date">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <?php echo $form->textField($model, 'data_fine', array('class' => 'form-control hasDatepicker richiamo',  'value' => Yii::app()->MyUtils->reverseDate($model->data_fine))); ?>
            </div>
        </div>
    </div>
    <div class="form-group " >
        <label class="col-xs-2 control-label"><?php echo $form->labelEx($model, 'online'); ?></label>
        <div class="col-xs-8 top7">
            <?php echo $form->radioButtonList($model, 'online', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange  btn-submit-form', 'data-refer' => 'tim-turni-form')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
