<?php
/* @var $this CaPreiscrizioniController */
/* @var $data CaPreiscrizioni */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($data->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cognome')); ?>:</b>
	<?php echo CHtml::encode($data->cognome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_nascita')); ?>:</b>
	<?php echo CHtml::encode($data->data_nascita); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('luogo_nascita')); ?>:</b>
	<?php echo CHtml::encode($data->luogo_nascita); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nazionalita')); ?>:</b>
	<?php echo CHtml::encode($data->nazionalita); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sesso')); ?>:</b>
	<?php echo CHtml::encode($data->sesso); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cellulare')); ?>:</b>
	<?php echo CHtml::encode($data->cellulare); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('occupazione')); ?>:</b>
	<?php echo CHtml::encode($data->occupazione); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prima_volta')); ?>:</b>
	<?php echo CHtml::encode($data->prima_volta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('conoscenza')); ?>:</b>
	<?php echo CHtml::encode($data->conoscenza); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('formula')); ?>:</b>
	<?php echo CHtml::encode($data->formula); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('campus')); ?>:</b>
	<?php echo CHtml::encode($data->campus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('housing')); ?>:</b>
	<?php echo CHtml::encode($data->housing); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('coabitazione')); ?>:</b>
	<?php echo CHtml::encode($data->coabitazione); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_in')); ?>:</b>
	<?php echo CHtml::encode($data->data_in); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_out')); ?>:</b>
	<?php echo CHtml::encode($data->data_out); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('privacy')); ?>:</b>
	<?php echo CHtml::encode($data->privacy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mailing')); ?>:</b>
	<?php echo CHtml::encode($data->mailing); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('note')); ?>:</b>
	<?php echo CHtml::encode($data->note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_insert')); ?>:</b>
	<?php echo CHtml::encode($data->data_insert); ?>
	<br />

	*/ ?>

</div>