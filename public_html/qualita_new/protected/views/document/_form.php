<?php
/* @var $this DocumentController */
/* @var $model Documents */
/* @var $form CActiveForm */
/* @var $categoryId integer */

$procedures = CHtml::listData(
	DocumentsProcedures::model()->findAll('category_id = :category_id', array(':category_id' => $categoryId)),
	'id',
	'procedura'
);

$publicationDate = $model->publication_date;
if($publicationDate && preg_match('/^\d{4}-\d{2}-\d{2}$/', $publicationDate)) {
	$publicationDate = Yii::app()->MyUtils->reverseDate($publicationDate);
}
else if($model->isNewRecord && !$publicationDate) {
	$publicationDate = date('d-m-Y');
}
?>
<div class="panel-body">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'documents-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
			'enctype' => 'multipart/form-data',
		),
	)); ?>

	<p class="note">I campi con <span class="required">*</span> sono obbligatori.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'procedura_id'); ?>
			<?php echo $form->dropDownList($model,'procedura_id', $procedures, array('empty'=>'Seleziona procedura','class' =>'form-control')); ?>
			<?php echo $form->error($model,'procedura_id'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'titolo'); ?>
			<?php echo $form->textField($model,'titolo',array('size'=>60,'maxlength'=>255,'class' => 'form-control')); ?>
			<?php echo $form->error($model,'titolo'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'description'); ?>
			<?php echo $form->textArea($model,'description',array('rows'=>5,'class' => 'form-control')); ?>
			<?php echo $form->error($model,'description'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'publication_date'); ?>
			<div class="input-group date">
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				<?php echo $form->textField($model, 'publication_date', array('class' => 'form-control hasDatepicker form-size calendar', 'size' => '10', 'maxlength' => '12', 'value' => $publicationDate)); ?>
			</div>
			<?php echo $form->error($model,'publication_date'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'external_url'); ?>
			<?php echo $form->textField($model,'external_url',array('size'=>60,'maxlength'=>255,'class' => 'form-control','placeholder'=>'https://www.youtube.com/... oppure https://vimeo.com/...')); ?>
			<?php echo $form->error($model,'external_url'); ?>
		</div>
	</div>

	<div class="row row-10 row-bottom">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'document'); ?>
			<?php echo $form->fileField($model,'document', array('class'=>'form-control')); ?>
			<?php echo (!$model->isNewRecord ? '<span>'.CHtml::encode($model->filename).'</span>' :'');?>
			<?php echo $form->error($model,'document'); ?>
		</div>
	</div>

	<div class="panel-footer">
		<div class="pull-right row buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Crea' : 'Salva', array('class' => 'btn btn-orange btn-submit-form')); ?>
		</div>
	</div>

	<?php echo $form->hiddenField($model,'category_id', array('value' => $categoryId)); ?>
	<?php $this->endWidget(); ?>
</div>
