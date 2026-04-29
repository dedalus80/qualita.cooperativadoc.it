<?php
/* @var $this SnPreiscrizioniController */
/* @var $data SnPreiscrizioni */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('ruolo')); ?>:</b>
	<?php echo CHtml::encode($data->ruolo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('altro_ruolo')); ?>:</b>
	<?php echo CHtml::encode($data->altro_ruolo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ente')); ?>:</b>
	<?php echo CHtml::encode($data->ente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('focus')); ?>:</b>
	<?php echo CHtml::encode($data->focus); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('percorso')); ?>:</b>
	<?php echo CHtml::encode($data->percorso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_insert')); ?>:</b>
	<?php echo CHtml::encode($data->data_insert); ?>
	<br />

	*/ ?>

</div>