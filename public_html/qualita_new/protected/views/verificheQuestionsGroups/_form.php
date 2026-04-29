<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl('//verificheQuestionsGroups/create', array('id'=>$vid)),
	'method'=>'post',
	'id'=>'insert-group-form'
)); ?>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name', array('class'=>'form-control',)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rank'); ?>
		<?php echo $form->textField($model,'rank', array('class'=>'form-control',)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->