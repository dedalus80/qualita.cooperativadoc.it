<div class="wide form form-horizontal row-border">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'id' => 'search-form-int'
)); ?>

	<?php $selectedCategory = !empty($categoryId) ? array($categoryId => array('selected' => true)) : array(); ?>
	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'category_id'); ?></label>
		<div class="col-xs-8"><?php echo $form->dropDownList($model,'category_id', CHtml::listData(DocumentsCategory::model()->findAll(), 'id', 'name'), array('empty'=>'Seleziona categoria','class' =>'form-control', 'options' => $selectedCategory)); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'procedura_id'); ?></label>
		<div class="col-xs-8"><?php
		$procedures = array();
		if($model->category_id) {
			$procedures = CHtml::listData(
				DocumentsProcedures::model()->findAll('category_id = :category_id', array(':category_id' => $model->category_id)),
				'id',
				'procedura'
			);
		} else {
			$procedures = CHtml::listData(DocumentsProcedures::model()->findAll(), 'id', 'procedura');
		}
		echo $form->dropDownList($model,'procedura_id', $procedures, array('empty'=>'Seleziona procedura','class' =>'form-control')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'titolo'); ?></label>
		<div class="col-xs-8"><?php echo $form->textField($model,'titolo',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'description'); ?></label>
		<div class="col-xs-8"><?php echo $form->textArea($model,'description',array('rows'=>4,'class'=>'form-control')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'publication_date'); ?></label>
		<div class="col-xs-8"><?php echo $form->textField($model,'publication_date',array('class'=>'form-control hasDatepicker form-size calendar','size' => '10', 'maxlength' => '12')); ?></div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
