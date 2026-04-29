<?php
/* @var $this TimPreiscrizioniController */
/* @var $model TimPreiscrizioni */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nome'); ?>
		<?php echo $form->textField($model,'nome',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cognome'); ?>
		<?php echo $form->textField($model,'cognome',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codice_fiscale'); ?>
		<?php echo $form->textField($model,'codice_fiscale',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nascita_luogo'); ?>
		<?php echo $form->textField($model,'nascita_luogo',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nascita_data'); ?>
		<?php echo $form->textField($model,'nascita_data'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nascita_provincia'); ?>
		<?php echo $form->textField($model,'nascita_provincia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nazionalita'); ?>
		<?php echo $form->textField($model,'nazionalita'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'indirizzo'); ?>
		<?php echo $form->textField($model,'indirizzo',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'citta'); ?>
		<?php echo $form->textField($model,'citta',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'provincia'); ?>
		<?php echo $form->textField($model,'provincia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cap'); ?>
		<?php echo $form->textField($model,'cap',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'soggiorno'); ?>
		<?php echo $form->textField($model,'soggiorno'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'turno'); ?>
		<?php echo $form->textField($model,'turno'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'partenza'); ?>
		<?php echo $form->textField($model,'partenza'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'operatore_supporto'); ?>
		<?php echo $form->textField($model,'operatore_supporto',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'operatore_supporto_dettaglio'); ?>
		<?php echo $form->textField($model,'operatore_supporto_dettaglio',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'allergie'); ?>
		<?php echo $form->textField($model,'allergie',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'allergie_dettaglio'); ?>
		<?php echo $form->textField($model,'allergie_dettaglio',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'genitore_nome'); ?>
		<?php echo $form->textField($model,'genitore_nome',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'genitore_cognome'); ?>
		<?php echo $form->textField($model,'genitore_cognome',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'genitore_codice_fiscale'); ?>
		<?php echo $form->textField($model,'genitore_codice_fiscale',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'genitore_societa'); ?>
		<?php echo $form->textField($model,'genitore_societa'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'genitore_funzione'); ?>
		<?php echo $form->textField($model,'genitore_funzione'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cid'); ?>
		<?php echo $form->textField($model,'cid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'localita'); ?>
		<?php echo $form->textField($model,'localita',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'genitore_provincia'); ?>
		<?php echo $form->textField($model,'genitore_provincia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'genitore_cap'); ?>
		<?php echo $form->textField($model,'genitore_cap',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'genitore_telefono'); ?>
		<?php echo $form->textField($model,'genitore_telefono',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'genitore_cellulare'); ?>
		<?php echo $form->textField($model,'genitore_cellulare',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'genitore_email'); ?>
		<?php echo $form->textField($model,'genitore_email',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'genitore_lavoro'); ?>
		<?php echo $form->textField($model,'genitore_lavoro',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'secondo_genitore_nome'); ?>
		<?php echo $form->textField($model,'secondo_genitore_nome',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'secondo_genitore_cognome'); ?>
		<?php echo $form->textField($model,'secondo_genitore_cognome',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'secondo_genitore_codice_fiscale'); ?>
		<?php echo $form->textField($model,'secondo_genitore_codice_fiscale',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'secondo_genitore_nascita_luogo'); ?>
		<?php echo $form->textField($model,'secondo_genitore_nascita_luogo',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'secondo_genitore_nascita_data'); ?>
		<?php echo $form->textField($model,'secondo_genitore_nascita_data'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'secondo_genitore_provincia'); ?>
		<?php echo $form->textField($model,'secondo_genitore_provincia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'iscrizione'); ?>
		<?php echo $form->textField($model,'iscrizione'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reddito'); ?>
		<?php echo $form->textField($model,'reddito'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_iscrizione'); ?>
		<?php echo $form->textField($model,'data_iscrizione'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->