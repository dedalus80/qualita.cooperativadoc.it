<?php
/* @var $this ReclamiAzioniController */
/* @var $data ReclamiAzioni */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_reclamo')); ?>:</b>
	<?php echo CHtml::encode($data->id_reclamo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($data->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cognome')); ?>:</b>
	<?php echo CHtml::encode($data->cognome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('entro_il')); ?>:</b>
	<?php echo CHtml::encode($data->entro_il); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('effettuata_il')); ?>:</b>
	<?php echo CHtml::encode($data->effettuata_il); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descrizione')); ?>:</b>
	<?php echo CHtml::encode($data->descrizione); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('allegato')); ?>:</b>
	<?php echo CHtml::encode($data->allegato); ?>
	<br />

	*/ ?>

</div>