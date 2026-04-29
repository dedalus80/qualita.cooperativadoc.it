<?php
/* @var $this ComunicazioniController */
/* @var $data Comunicazioni */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destinatario')); ?>:</b>
	<?php echo CHtml::encode($data->destinatario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ruolo')); ?>:</b>
	<?php echo CHtml::encode($data->ruolo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tutti')); ?>:</b>
	<?php echo CHtml::encode($data->tutti); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('messaggio')); ?>:</b>
	<?php echo CHtml::encode($data->messaggio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_invio')); ?>:</b>
	<?php echo CHtml::encode($data->data_invio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('risposta')); ?>:</b>
	<?php echo CHtml::encode($data->risposta); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('struttura')); ?>:</b>
	<?php echo CHtml::encode($data->struttura); ?>
	<br />

	*/ ?>

</div>