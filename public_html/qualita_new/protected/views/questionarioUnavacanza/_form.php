<?php
/* @var $this QuestionarioUnavacanzaController */
/* @var $model QuestionarioUnavacanza */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'questionario-unavacanza-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cognome'); ?>
		<?php echo $form->textField($model,'cognome',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cognome'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'turno'); ?>
		<?php echo $form->textField($model,'turno'); ?>
		<?php echo $form->error($model,'turno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'attivita'); ?>
		<?php echo $form->textField($model,'attivita'); ?>
		<?php echo $form->error($model,'attivita'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'privacy'); ?>
		<?php echo $form->textField($model,'privacy',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'privacy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'informativa'); ?>
		<?php echo $form->textField($model,'informativa',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'informativa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cellulare'); ?>
		<?php echo $form->textField($model,'cellulare',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cellulare'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_insert'); ?>
		<?php echo $form->textField($model,'data_insert'); ?>
		<?php echo $form->error($model,'data_insert'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->