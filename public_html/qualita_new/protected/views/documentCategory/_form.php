<?php
/* @var $this DocumentCategoryController */
/* @var $model DocumentsCategory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'documents-category-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">I campi con <span class="required">*</span> sono obbligatori.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'name'); ?>
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'name'); ?>
		</div>
	</div>

	<div class="panel-footer" style="margin-top:20px">
		<div class="pull-right">
			<?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="fa fa-edit"></i>&nbsp;Crea' : '<i class="fa fa-edit"></i>&nbsp;Aggiorna', array('type'=>'submit', 'class' => 'btn btn-orange')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->