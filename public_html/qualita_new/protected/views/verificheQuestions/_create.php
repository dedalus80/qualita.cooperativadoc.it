<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl('//verificheQuestions/create', array('id'=>$vid)),
	'method'=>'post',
	'id'=>'insert-question-form'
)); ?>

	<div class="row">
		<?php echo $form->label($model,'question'); ?>
		<?php echo $form->textField($model,'question', array('class'=>'form-control',)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'groupId'); ?>
		<?php //echo $form->textField($model,'question', array('class'=>'form-control',)); ?>
		<?php echo $form->dropDownList($model,'groupId', CHtml::listData(VerificheQuestionsGroups::model()->findAll('tipologiaVerificaId=:id',array('id'=>$vid)),'id','name'), array('empty'=>'Seleziona gruppo','class' =>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ordine'); ?>
		<?php echo $form->textField($model,'ordine', array('class'=>'form-control',)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->