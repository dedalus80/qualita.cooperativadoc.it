<?php
/* @var $this QuestionOptionController */
/* @var $model QuestionOption */
/* @var $form CActiveForm */
?>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Dati Opzione</h3>
            </div>
            <div class="panel-body">

                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'question-option-form',
                    'enableAjaxValidation'=>true,
                    'htmlOptions' => array('class'=>'form-horizontal'),
                )); ?>

                <p class="note">I campi con <span class="required">*</span> sono obbligatori.</p>

                <?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

                <?php echo $form->hiddenField($model,'question_id'); ?>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'option_text', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php echo $form->textField($model,'option_text',array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'option_text', array('class'=>'text-danger')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'value', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php echo $form->textField($model,'value',array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'value', array('class'=>'text-danger')); ?>
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
                        <?php echo CHtml::link('Annulla', array('question/view', 'id'=>$model->question_id), array('class'=>'btn btn-default')); ?>
                    </div>
                </div>

                <?php $this->endWidget(); ?>

            </div>
        </div>

    </div>
</div>
