<div class="wide form form-horizontal row-border">

<?php $selectedProcedura = !empty($proceduraId) ? array($proceduraId => array('selected' => true)) : array(); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route, !empty($proceduraId) ? array('id' => $proceduraId) : array()),
	'method'=>'get',
	'id' => 'search-form-int'
)); ?>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'procedura_id'); ?></label>
		<div class="col-xs-8"><?php echo $form->dropDownList($model,'procedura_id', CHtml::listData(DocumentiSoggiorniProcedura::model()->findAll(),'id','procedura'), array('empty'=>'Seleziona procedura','class' =>'form-control', 'options' => $selectedProcedura)); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'sgq'); ?></label>
		<div class="col-xs-8"><?php echo $form->dropDownList($model,'sgq', DocumentiSoggiorni::getSgq(), array('empty'=>'Seleziona Sgq','class' =>'form-control')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'tipologia'); ?></label>
		<div class="col-xs-8"><?php echo $form->dropDownList($model,'tipologia', DocumentiSoggiorni::getTipologia(), array('empty'=>'Seleziona tipologia','class' =>'form-control')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'codice'); ?></label>
		<div class="col-xs-8"><?php echo $form->textField($model,'codice',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'numero'); ?></label>
		<div class="col-xs-8"><?php echo $form->textField($model,'numero',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'revisione'); ?></label>
		<div class="col-xs-8"><?php echo $form->textField($model,'revisione',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'data_revisione'); ?></label>
		<div class="col-xs-8"><?php echo $form->textField($model,'data_revisione',array('size'=>60,'maxlength'=>255,'class'=>'form-control hasDatepicker form-size calendar','size' => '10', 'maxlength' => '12')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'titolo'); ?></label>
		<div class="col-xs-8"><?php echo $form->textField($model,'titolo',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'redige'); ?></label>
		<div class="col-xs-8"><?php echo $form->textField($model,'redige',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'archivia'); ?></label>
		<div class="col-xs-8"><?php echo $form->textField($model,'archivia',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'riesamina'); ?></label>
		<div class="col-xs-8"><?php echo $form->textField($model,'riesamina',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'autorizza'); ?></label>
		<div class="col-xs-8"><?php echo $form->textField($model,'autorizza',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'approva'); ?></label>
		<div class="col-xs-8"><?php echo $form->textField($model,'approva',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'periodicita_riesame'); ?></label>
		<div class="col-xs-8"><?php echo $form->textField($model,'periodicita_riesame',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'modalita_archiviazione'); ?></label>
		<div class="col-xs-8"><?php echo $form->textField($model,'modalita_archiviazione',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'luogo_archiviazione'); ?></label>
		<div class="col-xs-8"><?php echo $form->textField($model,'luogo_archiviazione',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'formato'); ?></label>
		<div class="col-xs-8"><?php echo $form->dropDownList($model,'formato', DocumentiSoggiorni::getFormato(), array('empty'=>'Seleziona Formato','class' =>'form-control')); ?>
	</div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'funzione_responsabile_id'); ?></label>
		<div class="col-xs-8"><?php echo $form->textField($model,'funzione_responsabile_id',array('class'=>'form-control')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'data_inserimento'); ?></label>
		<div class="col-xs-8"><?php echo $form->textField($model,'data_inserimento',array('class'=>'form-control hasDatepicker form-size calendar','size' => '10', 'maxlength' => '12')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'data_modifica'); ?></label>
		<div class="col-xs-8"><?php echo $form->textField($model,'data_modifica',array('class'=>'form-control hasDatepicker form-size calendar', 'size' => '10', 'maxlength' => '12')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'creato_user_id'); ?></label>
		<div class="col-xs-8"><?php echo $form->textField($model,'creato_user_id',array('class'=>'form-control')); ?></div>
	</div>

	<div class="form-group">
		<label class="col-xs-3 control-label"><?php echo $form->labelEx($model,'modificato_user_id'); ?></label>
		<div class="col-xs-8"><?php echo $form->textField($model,'modificato_user_id',array('class'=>'form-control')); ?></div>
	</div>

	<!--<div class="row buttons">
		<?php //echo CHtml::submitButton('Search'); ?>
	</div>-->

<?php $this->endWidget(); ?>

</div><!-- search-form -->
