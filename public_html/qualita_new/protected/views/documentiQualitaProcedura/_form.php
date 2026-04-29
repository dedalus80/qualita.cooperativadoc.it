<?php
/* @var $this DocumentiQualitaProceduraController */
/* @var $model DocumentiQualitaProcedura */
/* @var $form CActiveForm */
?>

<div class="panel-body">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'documenti-qualita-procedura-form',
		'enableAjaxValidation'=>false,
	)); ?>

	<p class="note">Campi con <span class="required">*</span> sono obbligatori.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row row-10 row-bottom">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'procedura'); ?>
			<?php echo $form->textField($model,'procedura',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'procedura'); ?>
		</div>
	</div>

	<div class="panel-footer">
		<div class="pull-right row buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Crea' : 'Salva', array('class' => 'btn btn-orange btn-submit-form')); ?>
		</div>
	</div>
	<?php $this->endWidget(); ?>
</div>
