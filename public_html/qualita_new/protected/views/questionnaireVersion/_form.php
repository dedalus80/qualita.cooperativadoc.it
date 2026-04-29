<?php
/* @var $this QuestionnaireVersionController */
/* @var $model QuestionnaireVersion */
/* @var $form CActiveForm */
?>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Dati Versione Questionario</h3>
            </div>
            <div class="panel-body">

                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'questionnaire-version-form',
                    'enableAjaxValidation'=>true,
                    'htmlOptions' => array('class'=>'form-horizontal'),
                )); ?>

                <p class="note">I campi con <span class="required">*</span> sono obbligatori.</p>

                <?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

                <?php echo $form->hiddenField($model,'questionnaire_id'); ?>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'version_number', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php echo $form->textField($model,'version_number',array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'version_number', array('class'=>'text-danger')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'description', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php echo $form->textArea($model,'description',array('rows'=>4,'class'=>'form-control')); ?>
                        <?php echo $form->error($model,'description', array('class'=>'text-danger')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crea' : 'Salva', array('class'=>'btn btn-primary')); ?>
                        <?php echo CHtml::link('Annulla', array('index'), array('class'=>'btn btn-default')); ?>
                    </div>
                </div>

                <?php $this->endWidget(); ?>

            </div>
        </div>

    </div>
</div>
