<?php
/* @var $this QuestionnaireSectionController */
/* @var $model QuestionnaireSection */
/* @var $form CActiveForm */
?>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Dati Sezione</h3>
            </div>
            <div class="panel-body">

                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'questionnaire-section-form',
                    'enableAjaxValidation'=>true,
                    'htmlOptions' => array('class'=>'form-horizontal'),
                )); ?>

                <p class="note">I campi con <span class="required">*</span> sono obbligatori.</p>

                <?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

                <?php echo $form->hiddenField($model,'version_id'); ?>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'title', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
                        <?php echo $form->error($model,'title', array('class'=>'text-danger')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'order', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php echo $form->textField($model,'order',array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'order', array('class'=>'text-danger')); ?>
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
