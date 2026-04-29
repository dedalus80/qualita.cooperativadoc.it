<?php
/* @var $this DocumentiSoggiorniController */
/* @var $model DocumentiSoggiorni */
/* @var $form CActiveForm */
?>
<div class="panel-body">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'documenti-qualita-form',
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
			<?php echo $form->dropDownList($model,'procedura_id', CHtml::listData(DocumentiSoggiorniProcedura::model()->findAll(),'id','procedura'), array('empty'=>'Seleziona procedura','class' =>'form-control', 'options' => $selectedProcedura)); ?>
			<?php echo $form->error($model,'procedura'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'sgq'); ?>
			<?php echo $form->dropDownList($model,'sgq', DocumentiSoggiorni::getSgq(), array('empty'=>'Seleziona Sgq','class' =>'form-control')); ?>
			<?php echo $form->error($model,'sgq'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'tipologia'); ?>			
			<?php echo $form->dropDownList($model,'tipologia', DocumentiSoggiorni::getTipologia(), array('empty'=>'Seleziona tipologia','class' =>'form-control')); ?>
			<?php echo $form->error($model,'tipologia'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'codice'); ?>
			<?php echo $form->dropDownList($model,'codice', DocumentiSoggiorni::getCodice(), array('empty'=>'Seleziona Codice','class' =>'form-control')); ?>
			<?php echo $form->error($model,'codice'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'numero'); ?>
			<?php echo $form->textField($model,'numero',array('size'=>60,'maxlength'=>255,'class' => 'form-control')); ?>
			<?php echo $form->error($model,'numero'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'revisione'); ?>
			<?php echo $form->textField($model,'revisione',array('size'=>60,'maxlength'=>255,'class' => 'form-control')); ?>
			<?php echo $form->error($model,'revisione'); ?>
		</div>	
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'data_revisione'); ?>
			<div class="input-group date">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <?php echo $form->textField($model, 'data_revisione', array('class' => 'form-control hasDatepicker form-size calendar', 'size' => '10', 'maxlength' => '12','value' => $model->isNewRecord ? date('d-m-Y') : Yii::app()->MyUtils->reverseDate($model->data_revisione))); ?>
            </div>
			<?php echo $form->error($model,'data_revisione'); ?>
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
			<?php echo $form->labelEx($model,'redige'); ?>
			<?php echo $form->textField($model,'redige',array('size'=>60,'maxlength'=>255,'class' => 'form-control')); ?>
			<?php echo $form->error($model,'redige'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'archivia'); ?>
			<?php echo $form->textField($model,'archivia',array('size'=>60,'maxlength'=>255,'class' => 'form-control')); ?>
			<?php echo $form->error($model,'archivia'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'riesamina'); ?>
			<?php echo $form->textField($model,'riesamina',array('size'=>60,'maxlength'=>255,'class' => 'form-control')); ?>
			<?php echo $form->error($model,'riesamina'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'autorizza'); ?>
			<?php echo $form->textField($model,'autorizza',array('size'=>60,'maxlength'=>255,'class' => 'form-control')); ?>
			<?php echo $form->error($model,'autorizza'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'approva'); ?>
			<?php echo $form->textField($model,'approva',array('size'=>60,'maxlength'=>255,'class' => 'form-control')); ?>
			<?php echo $form->error($model,'approva'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'periodicita_riesame'); ?>
			<?php echo $form->textField($model,'periodicita_riesame',array('size'=>60,'maxlength'=>255,'class' => 'form-control')); ?>
			<?php echo $form->error($model,'periodicita_riesame'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'modalita_archiviazione'); ?>
			<?php echo $form->textField($model,'modalita_archiviazione',array('size'=>60,'maxlength'=>255,'class' => 'form-control')); ?>
			<?php echo $form->error($model,'modalita_archiviazione'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'luogo_archiviazione'); ?>
			<?php echo $form->textField($model,'luogo_archiviazione',array('size'=>60,'maxlength'=>255,'class' => 'form-control')); ?>
			<?php echo $form->error($model,'luogo_archiviazione'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'formato'); ?>
			<?php echo $form->dropDownList($model,'formato', DocumentiSoggiorni::getFormato(), array('empty'=>'Seleziona Formato','class' =>'form-control')); ?>
			<?php echo $form->error($model,'formato'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'funzione_responsabile_id'); ?>
			<?php echo $form->dropDownList($model,'funzione_responsabile_id', CHtml::listData(Funzioni::model()->findAll(),'id','nome'), array('empty'=>'Seleziona funzione responsabile','class' =>'form-control')); ?>
			<?php echo $form->error($model,'funzione_responsabile_id'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'data_inserimento'); ?>
			<div class="input-group date">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <?php echo $form->textField($model, 'data_inserimento', array('class' => 'form-control hasDatepicker form-size calendar', 'size' => '10', 'maxlength' => '12','value' => $model->isNewRecord ? date('d-m-Y') : Yii::app()->MyUtils->reverseDate($model->data_inserimento))); ?>
            </div>
			<?php echo $form->error($model,'data_inserimento'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'data_modifica'); ?>
			<div class="input-group date">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <?php echo $form->textField($model, 'data_modifica', array('class' => 'form-control hasDatepicker form-size calendar', 'size' => '10', 'maxlength' => '12','value' => $model->isNewRecord ? '' : Yii::app()->MyUtils->reverseDate($model->data_modifica))); ?>
            </div>
			<?php echo $form->error($model,'data_modifica'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6"> 
			<?php echo $form->labelEx($model,'creato_user_id'); ?>
			<?php echo $form->textField($model,'creato_da_utente',array('class' => 'form-control', 'readonly' => 'readonly')); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'modificato_user_id'); ?>
			<?php echo $form->textField($model,'modificato_da_utente',array('class' => 'form-control', 'readonly' => 'readonly')); ?>
		</div>
	</div>

	<div class="row row-10 row-bottom">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'document'); ?>			
			<?php echo $form->fileField($model,'document', array('class'=>'form-control')); ?>
			<?php echo (!$model->isNewRecord ? '<span>'.$model->filename.'</span>' :'');?>
			<?php echo $form->error($model,'document'); ?>
		</div>
		<div class="col-xs-6"></div>
	</div>
	<div class="panel-footer">
		<div class="pull-right row buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Crea' : 'Salva', array('class' => 'btn btn-orange btn-submit-form')); ?>
		</div>
	</div>
	<?php $this->endWidget(); ?>
</div>
