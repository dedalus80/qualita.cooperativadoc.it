<?php
/* @var $this SendEmailController */
/* @var $data SendEmail */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo')); ?>:</b>
	<?php echo CHtml::encode($data->tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destinatari')); ?>:</b>
	<?php echo CHtml::encode($data->destinatari); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_destinatari')); ?>:</b>
	<?php echo CHtml::encode($data->id_destinatari); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sender')); ?>:</b>
	<?php echo CHtml::encode($data->sender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('testo')); ?>:</b>
	<?php echo CHtml::encode($data->testo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quanti')); ?>:</b>
	<?php echo CHtml::encode($data->quanti); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('data_invio')); ?>:</b>
	<?php echo CHtml::encode($data->data_invio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tutti')); ?>:</b>
	<?php echo CHtml::encode($data->tutti); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('effettuati')); ?>:</b>
	<?php echo CHtml::encode($data->effettuati); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_visita')); ?>:</b>
	<?php echo CHtml::encode($data->data_visita); ?>
	<br />

	*/ ?>

</div>