<?php
/* @var $this FormazioneTitoloCorsiController */
/* @var $model FormazioneTitoloCorsi */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'formazione-titolo-corsi-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
	'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
)); ?>

	<div class="row row-10">
        <div class="col-xs-12">
			<p class="note">I campi con <span class="required">*</span> sono obbligatori.</p>
		</div>
	</div>

	<div class="row row-10">
        <div class="col-xs-12">
			<?php echo $form->errorSummary($model); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-md-12">
			<label for="" class="control-label"><?php echo $form->labelEx($model,'titolo_corso'); ?></label>
			<?php echo $form->textField($model,'titolo_corso',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'titolo_corso'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-12 col-md-12">
			<label for="" class="control-label"><?php echo $form->labelEx($model,'categoria'); ?></label>
			<?php echo $form->dropDownList($model, 'categoria', FormazioneTitoloCorsi::getcategoriaOptions(), array('class' => 'form-control', 'empty' => 'Seleziona')); ?>
			<?php echo $form->error($model,'categoria'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-12 col-md-12">
			<label for="" class="control-label"><?php echo $form->labelEx($model, 'attivo'); ?></label>
			<?php echo $form->radioButtonList($model, 'attivo', array('Y' => 'SI', 'N' => 'NO'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
			<?php echo $form->error($model,'attivo'); ?>
		</div>
	</div>

	<div class="panel-footer">
		<div class="pull-right">
			<?php echo CHtml::submitButton(($model->isNewRecord ? 'Inserisci' : 'Aggiorna'), array('class' => 'btn btn-orange', 'id' => 'btn-formazione-titolo-corso')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
